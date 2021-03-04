<?php
  class Controller
  {
    private $_f3;
    
    /**
     * Controller constructor.
     * @param Object $f3 fat-free object
     */
    public function __construct($f3)
    {
      $this->_f3 = $f3;
    }
    
    function home()
    {
      //render the home page
      $view = new Template();
      echo $view->render('views/home.html');
    }
    
    function info()
    {
      global $valid;
      global $member;
  
      // If the page has submitted it's form to itself
      if($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        // store POST data
        $fname = $_POST['firstName'];
        $lname = $_POST['lastName'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $phone = $_POST['phone'];
        $premium = $_POST['premium'];

        // If name is valid set the name
        if(empty($fname)) {
          $this->_f3->set("errors['fname']", "Please enter a first name");
        } else if(empty($lname)){
          $this->_f3->set("errors['lname']", "Please enter a last name");
        } else if($valid->validName($fname) && $valid->validName($lname)) {
          //$_SESSION['name'] = $fname." ".$lname;
          $member->setFname($fname);
          $member->setLname($lname);
        } else {
          $this->_f3->set("errors['name']", "Name is not valid, please try again");
        }

        // If age is valid set the age
        if(empty($age)) {
          $this->_f3->set("errors['age']", "Please enter an age");
        } else if($valid->validAge($age)) {
          //$_SESSION['age'] = $age;
          $member->setAge($age);
        } else {
          $this->_f3->set("errors['age']", "Age is not valid, please try again");
        }

        // If gender is valid set gender
        if($valid->validGender($gender)) {
          //$_SESSION['gender'] = $gender;
          $member->setGender($gender);
        } else {
          $this->_f3->set("errors['gender']", "Stop spoofing my page!");
        }

        // If phone number is valid set phone number
        if(empty($phone)) {
          $this->_f3->set("errors['phone']", "Please enter a phone number");
        } else if($valid->validPhone($phone)) {
          //$_SESSION['phone'] = $phone;
          $member->setPhone($phone);
        } else {
          $this->_f3->set("errors['phone']", "Phone number must contain numbers");
        }
        
        if(isset($premium)){
          if($valid->validPremium($premium)) {
            $_SESSION['isPremium'] = true;
          }
        } else {
          $_SESSION['isPremium'] = false;
        }
        

        // If errors variable is empty redirect
        if(empty($this->_f3->get('errors'))) {
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
    
    function interests()
    {
      global $valid;
      global $data;
      global $premium;
      
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
          $premium->setInDoorInterests("");
        } else if ($valid -> validIndoor($indoor)) {
          $indoor = $_SESSION['indoorInterests'] = implode(", ", $indoor);
          $premium->setInDoorInterests($indoor);
        } else {
          $this->_f3->set("errors['indoorActivities']", "Stop spoofing me");
        }
  
        // If outdoor is valid or empty submit to SESSION
        if (empty($outdoor)){
          $premium->setOutDoorInterests("");
        } else if ($valid->validOutdoor($outdoor)) {
          $outdoor = $_SESSION['outdoorInterests'] = implode(", ", $outdoor);
          $premium->setInDoorInterests($outdoor);
        } else {
          $this->_f3->set("errors['outdoorActivities']", "Stop spoofing me");
        }
        if(empty($this->_f3->get('errors'))) {
          $_SESSION['premium'] = $premium;
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
    
    function summary()
    {
      // render summary.html
      $view = new Template();
      echo $view->render('views/summary.html');
      
      //destroy the session
      session_destroy();
    }
  }