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
      
      if($_SERVER['REQUEST_METHOD']=='POST'){
        $fname =($_POST['firstName']);
        $lname =($_POST['lastName']);
        $age =($_POST['age']);
        $gender = implode(", ", $_POST['gender']);
        $phone =($_POST['phone']);
        
        
      }
      
      $view = new Template();
      echo $view->render('views/info1.html');
    }
    function location()
    {
      global $valid;
      global $data;
      
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