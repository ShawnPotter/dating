<?php
  class DatingValidate
  {
    private $_data;
    
    function __construct() {
      $this->_data = new DatingDataLayer();
    }
    
    function validName($name) {
      return !empty($name) && ctype_alpha($name);
    }
    
    function validAge($age) {
      return !empty($age) && ctype_digit($age);
    }

    function validGender($gender) {
      if($gender == "male" || $gender == "female"){
        return true;
      } else {
        return false;
      }
    }
    
    function validPhone($phone) {
      $validPhone = preg_replace('/[^0-9]/', '', $phone);
      if(strlen($validPhone) === 10){
        return !empty($validPhone) && ctype_alnum($validPhone);
      } else {
        return false;
      }
      
    }

    function validBio($bio) {
      return !empty($bio) && ctype_alpha($bio);
    }
    
    function validEmail($email) {
      if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
      } else {
        return false;
      }
    }
    
    function validState($state) {
      $validStates = $this->_data->getStates();
      return in_array($state, $validStates);
    }
    
    function validOutdoor($activity) {
      $validActivity = $this->_data->getIndoorActivities();
      return in_array($activity, $validActivity);
    }
    
    function validIndoor($activity) {
      $validActivity = $this->_data->getOutDoorActivities();
      return in_array($activity, $validActivity);
    }
  }
