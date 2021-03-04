<?php
  /*
   * Shawn Potter
   * 1/28/2021
   * index.php
   * Fat-Free Controller Page
   */

  //The Controller

  //turn on error reporting
  ini_set('display_startup_errors', 1);
  ini_set('display_errors', 1);
  error_reporting(-1);
  

  
  //require autoload file
  require_once("vendor/autoload.php");
  
  //start a session
  session_start();

  //create an instance of the base class
  $f3 = Base::instance();
  
  //instaniate classes
  $valid = new DatingValidate();
  $data = new DatingDataLayer();
  $member = new Member();
  $premium = new PremiumMember();
  $control = new Controller($f3);
  
  //set fat-free debugging
  $f3->set('DEBUG', 3);
  
  //Define a default route (home page)
  $f3->route('GET /', function(){
    global $control;
    var_dump($_SESSION);
    $control -> home();
  });

  //define a route to the info page
  $f3->route('GET|POST /info', function(){
    global $control;
    var_dump($_SESSION);
    $control -> info();
  });

  //define a route to the location page
  $f3->route('GET|POST /location', function(){
    global $control;
    var_dump($_SESSION);
    $control -> location();
  });

  //define a route to the interests page
  $f3->route('GET|POST /interests', function(){
    global $control;
    var_dump($_SESSION);
    $control -> interests();
  });
  
  //define a route to the summary page
  $f3->route('GET /summary', function(){
    global $control;
    var_dump($_SESSION);
    $control -> summary();
    session_destroy();
  });
  
  //run fat free
  $f3->run();