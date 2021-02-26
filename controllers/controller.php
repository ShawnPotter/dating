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
      //Define a default route (home page)
      $view = new Template();
      echo $view->render('views/home.html');
    }
    
    function info()
    {
      global $valid;
      //global $form;
      
      if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $fname = $_POST['firstName'];
        $lname = $_POST['lastName'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $phone = $_POST['phone'];

        //If name is valid set the name
        if(empty($fname)) {
          $this->_f3->set("errors['fname']", "Please enter a first name");
        } else if(empty($lname)){
          $this->_f3->set("errors['lname']", "Please enter a last name");
        } else if($valid->validName($fname) && $valid->validName($lname)) {
          $_SESSION['name'] = $fname." ".$lname;
        } else {
          $this->_f3->set("errors['name']", "Name is not valid, please try again");
        }

        //If age is valid set the age
        if(empty($age)) {
          $this->_f3->set("errors['age']", "Please enter an age");
        } else if($valid->validAge($age)) {
          $_SESSION['age'] = $age;
        } else {
          $this->_f3->set("errors['age']", "Age is not valid, please try again");
        }

        if($valid->validGender($gender)) {
          $_SESSION['gender'] = $gender;
        } else {
          $this->_f3->set("errors['gender']", "Stop spoofing my page!");
        }

        if(empty($phone)) {
          $this->_f3->set("errors['phone']", "Please enter a phone number");
        } else if($valid->validPhone($phone)) {
          $_SESSION['phone'] = $phone;
        } else {
          $this->_f3->set("errors['phone']", "Phone number must contain numbers");
        }

        if(empty($this->_f3->get('errors'))) {
          $this->_f3->reroute('/location');
        }
      }

      $this->_f3->set("fname", isset($fname) ? $fname : "");
      $this->_f3->set("fname", isset($lname) ? $lname : "");
      $this->_f3->set("fname", isset($age) ? $age : "");
      if(empty($_POST['gender'])){
        $this->_f3->set("genderChoice", "male");
      } else {
        $this->_f3->set("genderChoice", $_POST['gender']);
      }
      $this->_f3->set("fname", isset($phone) ? $phone : "");
      
      $view = new Template();
      echo $view->render('views/info1.html');
    }
    function location()
    {
      var_dump($_SESSION['form']);
      global $valid;
      global $data;
      //global $form;

      if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        $state = $_POST['state'];
        $seeking = $_POST['seeking'];
        $bio = $_POST['userBio'];

        if(!isset($valid)) {
          $this->_f3->set("errors['email']", "Email is required");
        } else if($valid->validEmail($email)) {
          $_SESSION['email'] = $email;
        } else {
          $this->_f3->set("errors['email']", "Email is not valid, please try again");
        }

        if($valid->validState($state)) {
          $_SESSION['state'] = $state;
        } else {
          $this->_f3->set("errors['state']", "Why are you changing this list?");
        }

        if($valid->validGender($seeking)) {
          $_SESSION['seeking'] = $seeking;
        } else {
          $this->_f3->set("errors['seeking']", "Please don't");
        }

        if($valid->validBio($bio) || empty($bio)) {
          $_SESSION['bio'] = $bio;
        } else {
          $this->_f3->set("errors['bio']", "Could you not, please?");
        }
        if(empty($this->_f3->get('errors'))) {
          $this -> _f3 -> reroute('/interests');
        }

      }
      
      $this->_f3->set('states', $data->getStates());
      $this->_f3->set("email", isset($email) ? $email : "");
      $this->_f3->set("state", isset($state) ? $state : "");
      if(empty($_POST['seeking'])){
        $this->_f3->set("seekingChoice", "male");
      } else {
        $this->_f3->set("seekingChoice", $_POST['seeking']);
      }
      $this->_f3->set("bio", isset($bio) ? $bio : "");
      $view = new Template();
      echo $view->render('views/info2.html');
    }
    
    function interests()
    {
      global $valid;
      global $data;
      //global $form;
      
      if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $indoor = $_POST['indoorInterest'];
        $outdoor = $_POST['outdoorInterest'];
        /*var_dump($indoor);
        echo "<br>";
        var_dump($outdoor);
        echo "<br>";*/
        
        if (empty($indoor)){
          $_SESSION['indoorInterests'] = "";
        } else if ($valid -> validIndoor($indoor)) {
          $_SESSION['indoorInterests'] = implode(", ", $indoor);
        } else {
          $this->_f3->set("errors['indoorActivities']", "Stop spoofing me");
        }
  
        if (empty($outdoor)){
          $_SESSION['outdoorInterests'] = "";
        } else if ($valid->validOutdoor($outdoor)) {
          $_SESSION['outdoorInterests'] = implode(", ", $outdoor);
        } else {
          $this->_f3->set("errors['outdoorActivities']", "Stop spoofing me");
        }
        if(empty($this->_f3->get('errors'))) {
          $this -> _f3 -> reroute('/summary');
        }
      }
  
      $this->_f3->set('indoorActivities', $data->getIndoorActivities());
      $this->_f3->set('outdoorActivities', $data->getOutDoorActivities());
  
      $view = new Template();
      echo $view->render('views/info3.html');
    }
    
    function summary()
    {
      $view = new Template();
      echo $view->render('views/summary.html');
      
  
      session_destroy();
    }
  }