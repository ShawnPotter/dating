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
      $bio = filter_var($bio, FILTER_SANITIZE_STRING);
      return $bio;
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
    
    function validIndoor($activities) {
      $validActivities = $this->_data->getIndoorActivities();
      $validActivities = array_keys($validActivities);
      /*var_dump($validActivities);
      echo "<br>";*/
      foreach($activities as $activity){
        if(!in_array($activity, $validActivities)){
          return false;
        }
      }
      return true;
    }
    
    function validOutdoor($activities) {
      $validActivities = $this->_data->getOutDoorActivities();
      $validActivities = array_keys($validActivities);
      /*var_dump($validActivities);
      echo "<br>";*/
      foreach($activities as $activity){
        if(!in_array($activity, $validActivities)){
          return false;
        }
      }
      return true;
    }
  }
