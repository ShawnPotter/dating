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
  require $_SERVER['DOCUMENT_ROOT'].'/../config.php';
  
  //start a session
  session_start();

  //create an instance of the base class
  $f3 = Base::instance();
  
  //instaniate classes
  $valid = new DatingValidate($dbh);
  $data = new DatingDataLayer($dbh);
  $control = new Controller($f3, $dbh);
  
  //set fat-free debugging
  $f3->set('DEBUG', 3);
  
  //Define a default route (home page)
  $f3->route('GET /', function(){
    global $control;
    $control -> home();
    // var_dump($_SESSION); // debug
  });

  //define a route to the info page
  $f3->route('GET|POST /info', function(){
    global $control;
    $control -> info();
    // var_dump($_SESSION); // debug
  });

  //define a route to the location page
  $f3->route('GET|POST /location', function(){
    global $control;
    $control -> location();
    // var_dump($_SESSION); // debug
  });

  //define a route to the interests page
  $f3->route('GET|POST /interests', function(){
    global $control;
    $control -> interests();
    // var_dump($_SESSION); // debug
  });
  
  //define a route to the summary page
  $f3->route('GET /summary', function(){

    //var_dump($_SESSION); // debug
    
    global $control;
    $control -> summary();
    // print("<pre>".print_r($_SESSION['member'],true)."</pre>"); // debug
    
    //destroy the session
    session_destroy();
  });

  $f3->route('GET /admin', function(){
    global $control;
    $control->admin();
  });
  
  //run fat free
  $f3->run();