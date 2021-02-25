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
      $this -> _f3 = $f3;
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
      global $form;
      
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
          $form->setName($fname." ".$lname);
        } else {
          $this->_f3->set("errors['name']", "Name is not valid, please try again");
        }

        //If age is valid set the age
        if(empty($age)) {
          $this->_f3->set("errors['age']", "Please enter an age");
        } else if($valid->validAge($age)) {
          $form->setAge($age);
        } else {
          $this->_f3->set("errors['age']", "Age is not valid, please try again");
        }

        if($valid->validGender($gender)) {
          $form->setGender($gender);
        } else {
          $this->_f3->set("errors['gender']", "Stop spoofing my page!");
        }

        if(empty($phone)) {
          $this->_f3->set("errors['phone']", "Please enter a phone number");
        } else if($valid->validPhone($phone)) {
          $form->setPhone($phone);
        } else {
          $this->_f3->set("errors['phone']", "Phone number must contain numbers");
        }

        if(empty($this->_f3->get('errors'))) {
          $SESSION['form'] = $form;
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
      global $valid;
      global $form;
      global $data;

      if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        $state = $_POST['state'];
        $seeking = $_POST['seeking'];
        $bio = $_POST['userBio'];

        if(!isset($valid)) {
          $this->_f3->set("errors['email']", "Email is required");
        } else if($valid->validEmail($email)) {
          $form->setEmail($email);
        } else {
          $this->_f3->set("errors['email']", "Email is not valid, please try again");
        }

        if($valid->validState($state)) {
          $form->setState($state);
        } else {
          $this->_f3->set("errors['state']", "Why are you changing this list?");
        }

        if($valid->validGender($seeking)) {
          $form->setSeeking($seeking);
        } else {
          $this->_f3->set("errors['seeking']", "Please don't");
        }

        if($valid->validBio($bio) || empty($bio)) {
          $form->setBio($bio);
        } else {
          $this->_f3->set("errors['bio']", "Could you not, please?");
        }

      }

      //get the post data from the last page
      /*
     if(isset($_POST['firstName'])){
        $_SESSION['firstName'] = $_POST['firstName'];
      }
      if(isset($_POST['lastName'])){
        $_SESSION['lastName'] = $_POST['lastName'];
      }
      if(isset($_POST['age'])){
        $_SESSION['age'] = $_POST['age'];
      }
      if(isset($_POST['gender'])){
        $gender = implode(", ", $_POST['gender']);
        $_SESSION['gender'] = $gender;
      }
      if(isset($_POST['phone'])){
        $_SESSION['phone'] = $_POST['phone'];
      }
     */
      //var_dump($_SESSION);


      
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
      
      /*
      if(isset($_POST['email'])){
        $_SESSION['email'] = $_POST['email'];
      }
      if(isset($_POST['state'])){
        $_SESSION['state'] = $_POST['state'];
      }
      if(isset($_POST['seeking'])){
        $seeking = implode(", ", $_POST['seeking']);
        $_SESSION['seeking'] = $seeking;
      }
      if(isset($_POST['userBio'])){
        $_SESSION['userBio'] = $_POST['userBio'];
      }
      */
      //var_dump($_SESSION);
  
      $this->_f3->set('indoorActivities', $data->getIndoorActivities());
      $this->_f3->set('outdoorActivities', $data->getOutDoorActivities());
  
      $view = new Template();
      echo $view->render('views/info3.html');
    }
    
    function summary()
    {
      /*
      if(isset($_POST['indoorInterest'])){
        $indoor = implode(", ", $_POST['indoorInterest']);
        $_SESSION['indoorInterest'] = $indoor;
      }
      if(isset($_POST['outdoorInterest'])){
        $outdoor = implode(", ", $_POST['outdoorInterest']);
        $_SESSION['outdoorInterest'] = $outdoor;
      }
  
       $this->_f3->set("firstName", $_SESSION['firstName']);
       $this->_f3->set("lastName", $_SESSION['lastName']);
       $this->_f3->set("age", $_SESSION['age']);
       $this->_f3->set("phone", $_SESSION['phone']);
       $this->_f3->set("state", $_SESSION['state']);
       $this->_f3->set("gender", $_SESSION['gender']);
       $this->_f3->set("seeking", $_SESSION['seeking']);
       $this->_f3->set("userBio", $_SESSION['userBio']);
       $this->_f3->set("email", $_SESSION['email']);
       $this->_f3->set("indoorInterest", $_SESSION['indoorInterest']);
       $this->_f3->set("outdoorInterest", $_SESSION['outdoorInterest']);
      */
  
      //var_dump($_SESSION);
  
      $view = new Template();
      echo $view->render('views/summary.html');
  
      session_destroy();
    }
  }