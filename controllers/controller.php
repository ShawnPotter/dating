<?php
  class Controller
  {
    private $_f3;
    private $_dbh;
    
    /**
     * Controller constructor.
     *
     * Controller constructor, passes in the f3 object.
     * @param Object $f3 fat-free object
     */
    public function __construct($f3, $dbh)
    {
      $this->_f3 = $f3;
      $this->_dbh = $dbh;
    }
  
    /**
     * Instaniates the Template class as $view and then renders home.html
     */
    function home()
    {
      //render the home page
      $view = new Template();
      echo $view->render('views/home.html');
    }
  
    /**
     * Passes in globals $valid (Validate class) and $member (empty variable)
     * The the form submits to itself runs various validation checks on the
     * form data. Instantiates either Member or PremiumMember object inside
     * $_SESSION based on whether the user clicks the sign up for Premium
     * checkbox. Redirects to summary page if all data in $_POST is valid.
     * Instaniates the Template class as $view and then renders info1.html
     */
    function info()
    {
      global $valid;
      global $member;
  
      // If the page has submitted it's form to itself
      if($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        // store POST data
        $fname = "";
        $lname = "";
        $age = "";
        $gender = "";
        $phone = "";
        $isPremium = $_POST['isPremium'];

        // If name is valid set the name
        if(empty($_POST['firstName'])) {
          $this->_f3->set("errors['fname']", "Please enter a first name");
        } else if(empty($_POST['lastName'])){
          $this->_f3->set("errors['lname']", "Please enter a last name");
        } else if($valid->validName($_POST['firstName']) && $valid->validName($_POST['lastName'])) {
          //$_SESSION['name'] = $fname." ".$lname;
          $fname = $_POST['firstName'];
          $lname = $_POST['lastName'];
        } else {
          $this->_f3->set("errors['name']", "Name is not valid, please try again");
        }

        // If age is valid set the age
        if(empty($_POST['age'])) {
          $this->_f3->set("errors['age']", "Please enter an age");
        } else if($valid->validAge($_POST['age'])) {
          $age = $_POST['age'];
        } else {
          $this->_f3->set("errors['age']", "Age is not valid, please try again");
        }

        // If gender is valid set gender
        if($valid->validGender($_POST['gender'])) {
          $gender = $_POST['gender'];
          //$_SESSION['gender'] = $gender;
          //$member->setGender($gender);
        } else {
          $this -> _f3 -> set("errors['gender']", "Stop spoofing my page!");
        }

        // If phone number is valid set phone number
        if(empty($_POST['phone'])) {
          $this->_f3->set("errors['phone']", "Please enter a phone number");
        } else if($valid->validPhone($_POST['phone'])) {
          $phone = $_POST['phone'];
          //$_SESSION['phone'] = $phone;
          //$member->setPhone($phone);
        } else {
          $this->_f3->set("errors['phone']", "Phone number must contain numbers");
        }
        
        
        

        // If errors variable is empty redirect
        if(empty($this->_f3->get('errors'))) {
          if(isset($isPremium)){
            if($valid->validPremium($isPremium)) {
              $_SESSION['isPremium'] = true;
              $GLOBALS['member'] = new PremiumMember($fname, $lname, $gender, $age, $phone);
            }
          } else {
            $_SESSION['isPremium'] = false;
            $GLOBALS['member'] = new Member($fname, $lname, $gender, $age, $phone);
          }
          
          $_SESSION['member'] = $member;
          $this->_f3->reroute('/location');
        }
      }

      // sticky form
      $this->_f3->set("fname", isset($fname) ? $fname : "");
      $this->_f3->set("lname", isset($lname) ? $lname : "");
      $this->_f3->set("age", isset($age) ? $age : "");
      if(empty($_POST['gender'])){
        $this->_f3->set("genderChoice", "male");
      } else {
        $this->_f3->set("genderChoice", $_POST['gender']);
      }
      $this->_f3->set("phone", isset($phone) ? $phone : "");
      
      // render info1.html
      $view = new Template();
      echo $view->render('views/info1.html');
    }
  
    /**
     * Passes in globals $valid (Validate class) and $data (DatingDataLayer
     * class) The the form submits to itself runs various validation checks on
     * the form data. Added validate form data to the session object.
     * Redirects to the summary if Member, or summary if PremiumMember and
     * all data in $_POST is valid. Instaniates the Template class as $view
     * and then renders info2.html
     */
    function location()
    {
      global $valid;
      global $data;
  
      // If the page has submitted it's form to itself
      if($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        // Store POST data into variables
        $email = $_POST['email'];
        $state = $_POST['state'];
        $seeking = $_POST['seeking'];
        $bio = $_POST['userBio'];

        // Check to see if email is valid or empty
        if(!isset($valid)) {
          $this->_f3->set("errors['email']", "Email is required");
        } else if($valid->validEmail($email)) {
          $_SESSION['member']->setEmail($email);
        } else {
          $this->_f3->set("errors['email']", "Email is not valid, please try again");
        }

        // Check to make sure that the state value is the expected value
        if($valid->validState($state)) {
          $_SESSION['member']->setState($state);
        } else {
          $this->_f3->set("errors['state']", "Why are you changing this list?");
        }

        // Check to see that the gender value is the expected value
        if($valid->validGender($seeking)) {
          $_SESSION['member']->setSeeking($seeking);
        } else {
          $this->_f3->set("errors['seeking']", "Please don't");
        }
        
        //Sanitizes $bio before accepting it into the session array
        $bio = filter_var($bio, FILTER_SANITIZE_STRING);
        $_SESSION['member']->setBio($bio);
        
        // If there are no errors redirect
        if(empty($this->_f3->get('errors'))) {
          if($_SESSION['isPremium'] == true){
            $this -> _f3 -> reroute('/interests');
          } else {
            $this -> _f3 -> reroute('/summary');
          }
          
        }

      }
      
      // Sticky form
      $this->_f3->set('states', $data->getStates());
      $this->_f3->set("email", isset($email) ? $email : "");
      $this->_f3->set("selectedState", isset($state) ? $state : "");
      if(empty($_POST['seeking'])){
        $this->_f3->set("seekingChoice", "male");
      } else {
        $this->_f3->set("seekingChoice", $_POST['seeking']);
      }
      $this->_f3->set("bio", isset($bio) ? $bio : "");
      
      // Render info2.html
      $view = new Template();
      echo $view->render('views/info2.html');
    }
  
    /**
     * Passes in globals $valid (Validate class) and $data (DatingDataLayer
     * class) The the form submits to itself runs various validation checks on
     * the form data. Added validate form data to the session object.
     * Redirects to summary page if all data in $_POST is valid.
     * Instaniates the Template class as $view and then renders info3.html
     */
    function interests()
    {
      global $valid;
      global $data;
      
      // If the form has submitted data to itself
      if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $indoor = $_POST['indoorInterest'];
        $outdoor = $_POST['outdoorInterest'];
       
        /*var_dump($indoor); // error checking
        echo "<br>";
        var_dump($outdoor);
        echo "<br>";*/
        
        // If indoor is valid or empty submit to SESSION
        if (empty($indoor)){
          $_SESSION['member']->setInDoorInterests("");
        } else if ($valid -> validIndoor($indoor)) {
          $indoor = $_SESSION['indoorInterests'] = implode(", ", $indoor);
          $_SESSION['member']->setInDoorInterests($indoor);
        } else {
          $this->_f3->set("errors['indoorActivities']", "Stop spoofing me");
        }
  
        // If outdoor is valid or empty submit to SESSION
        if (empty($outdoor)){
          $_SESSION['member']->setOutDoorInterests("");
        } else if ($valid->validOutdoor($outdoor)) {
          $outdoor = $_SESSION['outdoorInterests'] = implode(", ", $outdoor);
          $_SESSION['member']->setOutDoorInterests($outdoor);
        } else {
          $this->_f3->set("errors['outdoorActivities']", "Stop spoofing me");
        }
        if(empty($this->_f3->get('errors'))) {
          $this -> _f3 -> reroute('/summary');
        }
      }
  
      // Set variables from data in the data-layer
      $this->_f3->set('indoorActivities', $data->getIndoorActivities());
      $this->_f3->set('outdoorActivities', $data->getOutDoorActivities());
  
      // render info3.html
      $view = new Template();
      echo $view->render('views/info3.html');
    }
  
    /**
     * Instaniates the Template class as $view and then renders summary.html
     */
    function summary()
    {
      global $data;
      $data->insertMember();
      // render summary.html
      $view = new Template();
      echo $view->render('views/summary.html');
      
    }
  
    /**
     * Creates the admin page view, import global $data and uses the
     * getMembers() function to pull all member records from the database
     * then instaniates the Template class and renders admin.html
     */
    function admin(){
      global $data;
      $row = $data->getMembers();
      $this->_f3->set("table", $row);
      /*
      echo "<pre>";
      echo print_r($this->_f3->get("table"), true);
      echo "</pre>";
      */ // debug



      $view = new Template();
      echo $view->render('views/admin.html');
    }
  }