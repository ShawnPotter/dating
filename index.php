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

  //create an instance of the base class
  $f3 = Base::instance();
  $valid = new DatingValidate();
  $data = new DatingDataLayer();
  $form = new Form();
  $control = new Controller($f3);
  
  $f3->set('DEBUG', 3);
  
  //Define a default route (home page)
  $f3->route('GET /', function(){
    global $control;
    $control -> home();
  });

  $f3->route('GET|POST /info', function($f3){
    global $control;
    $control -> info();
  });

  $f3->route('GET|POST /location', function($f3){
    global $control;
    $control -> location();
  });

  $f3->route('GET|POST /interests', function($f3){
    global $control;
    $control -> interests();
  });
  
  $f3->route('GET|POST /summary', function($f3){
    global $control;
    $control -> summary();
  });


  //run fat free
  $f3->run();