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

  //require autoload file
  require_once("vendor/autoload.php");

  //create an instance of the base class
  $f3 = Base::instance();
  $f3->set('DEBUG', 3);



  //Define a default route (home page)
  $f3->route('GET /', function(){
    $view = new Template();
    echo $view->render('views/home.html');
  });


  //run fat free
  $f3->run();
