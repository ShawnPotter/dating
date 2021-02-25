<?php
  class DatingValidate
  {
    private $_data;
    
    function __construct(){
      $this->_data = new DatingDataLayer();
    }
    
    function validName($name){
      return !empty($name) && ctype_alpha($name);
    }
    
    function validAge($age){
      return !empty($age) && ctype_digit($age);
    }
    
    function validPhone($phone){
      if($phone.length == 10){
        return !empty($phone) && ctype_digit($phone);
      } else {
        return false;
      }
      
    }
    
    function validEmail($email){
    
    }
    
    function validState($state){
    
    }
    
    function validOutdoor($activity){
    
    }
    
    function validIndoor($activity){
    
    }
  }
