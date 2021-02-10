<?php
  /*
   * Shawn Potter
   * 1/28/2021
   * index.php
   * Fat-Free Controller Page
   */

  //The Controller

  //turn on error reporting
  ini_set('display_errors', 1);
  error_reporting(E_ALL);
  
  //start a session
  session_start();

  //require autoload file
  require_once("vendor/autoload.php");
  require_once('model/data-layer.php');

  //create an instance of the base class
  $f3 = Base::instance();
  $f3->set('DEBUG', 3);



  //Define a default route (home page)
  $f3->route('GET /', function(){
    $view = new Template();
    echo $view->render('views/home.html');
  });

  $f3->route('GET /info', function($f3){
    
    
    $view = new Template();
    echo $view->render('views/info1.html');
  });

  $f3->route('POST /location', function($f3){
    //get the post data from the last page
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
    //var_dump($_SESSION);
  
    
    
    $f3->set('states', getStates());

    $view = new Template();
    echo $view->render('views/info2.html');
  });

  $f3->route('POST /interests', function($f3){
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
    //var_dump($_SESSION);
    
    $f3->set('indoorActivities', getIndoorActivities());
    $f3->set('outdoorActivities', getOutDoorActivities());

    $view = new Template();
    echo $view->render('views/info3.html');
  });
  $f3->route('POST /summary', function($f3){
    if(isset($_POST['indoorInterest'])){
      $indoor = implode(", ", $_POST['indoorInterest']);
      $_SESSION['indoorInterest'] = $indoor;
    }
    if(isset($_POST['outdoorInterest'])){
      $outdoor = implode(", ", $_POST['outdoorInterest']);
      $_SESSION['outdoorInterest'] = $outdoor;
    }
    
    $f3->set("firstName", $_SESSION['firstName']);
    $f3->set("lastName", $_SESSION['lastName']);
    $f3->set("age", $_SESSION['age']);
    $f3->set("phone", $_SESSION['phone']);
    $f3->set("state", $_SESSION['state']);
    $f3->set("gender", $_SESSION['gender']);
    $f3->set("seeking", $_SESSION['seeking']);
    $f3->set("userBio", $_SESSION['userBio']);
    $f3->set("email", $_SESSION['email']);
    $f3->set("indoorInterest", $_SESSION['indoorInterest']);
    $f3->set("outdoorInterest", $_SESSION['outdoorInterest']);
    
    //var_dump($_SESSION);

    $view = new Template();
    echo $view->render('views/summary.html');
  });


  //run fat free
  $f3->run();
