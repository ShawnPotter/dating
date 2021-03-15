<?php
  class DatingValidate
  {
    private $_data;
    private $_dbh;
  
    /**
     * DatingValidate constructor
     *
     * DatingValidate constructor where we instaniate a new DatingDataLayer
     * Object for use in the validation process.
     *
     * @param object database object
     */
    function __construct($dbh)
    {
      $this->_dbh = $dbh;
      $this->_data = new DatingDataLayer($dbh);
    }
  
    /**
     * Checks for valid name (first and last)
     *
     * Checks for valid name (first and last), makes sure that the name param
     * isn't empty and is only alphabetic characters.
     *
     * @param String $name
     * @return bool
     */
    function validName($name)
    {
      return !empty($name) && ctype_alpha($name);
    }
  
    /**
     * Checks for valid age
     *
     * Checks to make sure that $age isn't empty, contains only digits and is
     * between 18 and 118
     *
     * @param String $age
     * @return bool
     */
    function validAge($age)
    {
      return !empty($age) && ctype_digit($age) && ($age >= 18 && $age <= 118);
    }
  
    /**
     * Checks for valid gender value
     *
     * Checks to make sure that there isn't a gender value being returned that
     * isn't provided. (spoofing)
     *
     * @param String $gender
     * @return bool
     */
    function validGender($gender)
    {
      if($gender == "male" || $gender == "female"){
        return true;
      } else {
        return false;
      }
    }
  
    /**
     * Checks for valid phone number
     *
     * Checks for valid phone number by first stripping out all characters
     * except for the numbers, and makes sure that the string is a length
     * of 10. Then it checks to make sure it's just alphanumeric numbers
     * contained within (likely redundant)
     *
     * @param String $phone
     * @return bool
     */
    function validPhone($phone)
    {
      $validPhone = preg_replace('/[^0-9]/', '', $phone);
      if(strlen($validPhone) === 10){
        return ctype_alnum($validPhone);
      } else {
        return false;
      }
      
    }
  
    /**
     * Checks for a valid Email Address
     *
     * Checks for a valid Email Address by using filter_var and FILTER_VALIDATE_EMAIL.
     *
     * @param String $email
     * @return bool
     */
    function validEmail($email)
    {
      if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
      } else {
        return false;
      }
    }
  
    /**
     * Checks for a valid State value
     *
     * Checks for a valid State value from the Select input. This is prevent
     * someone from changing the data.
     *
     * @param String $state
     * @return bool
     */
    function validState($state)
    {
      $validStates = $this->_data->getStates();
      return in_array($state, $validStates);
    }
  
  
    /**
     * Checks to see if isPremium is valid
     *
     * Check to see if isPremium is valid, the only acceptable value is a
     * String of "true" otherwise it will always return false. This will
     * prevent spoofing attempts as the value of isPremium is only used to
     * return a bool.
     *
     * @param String $isPremium
     * @return bool
     */
    function validPremium($isPremium)
    {
      if($isPremium == "true"){
        return true;
      } else {
        return false;
      }
    }
  
    /**
     * Checks for a valid indoor activities array
     *
     * Checks for a valid indoor activities array by checking it against the
     * original array in the data-layer. This is to prevent anyone from sending
     * false values to the server.
     *
     * @param array $activities
     * @return bool
     */
    function validIndoor($activities)
    {
      $validActivities = $this->_data->getIndoorActivities();
      $validActivities = array_keys($validActivities);
      /*var_dump($validActivities);
      echo "<br>";*/
      foreach($activities as $activity) {
        if(!in_array($activity, $validActivities)) {
          return false;
        }
      }
      return true;
    }
  
    /**
     * Checks for a valid outdoor activities array
     *
     * Checks for a valid outdoor activities array by checking it against the
     * original array in the data-layer. This is to prevent anyone from sending
     * false values to the server.
     *
     * @param array $activities
     * @return bool
     */
    function validOutdoor($activities)
    {
      $validActivities = $this->_data->getOutDoorActivities();
      $validActivities = array_keys($validActivities);
      /*var_dump($validActivities);
      echo "<br>";*/
      foreach($activities as $activity){
        if(!in_array($activity, $validActivities)){
          $_SESSION['outdoorValid'] = true;
          return false;
        }
      }
      $_SESSION['outdoorValid'] = true;
      return true;
    }
  }
