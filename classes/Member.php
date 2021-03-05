<?php
  class Member
  {
    private $_fname;
    private $_lname;
    private $_gender;
    private $_age;
    private $_phone;
    private $_email;
    private $_state;
    private $_seeking;
    private $_bio;
  
    /**
     * MemberSets varname class variable constructor.
     * @paramSets varname class variable $_fname
     * @paramSets varname class variable $_lname
     * @paramSets varname class variable $_gender
     * @paramSets varname class variable $_age
     * @param $_phone
     */
    public function __construct($_fname, $_lname, $_gender, $_age, $_phone)
    {
      $this -> _fname = $_fname;
      $this -> _lname = $_lname;
      $this -> _gender = $_gender;
      $this -> _age = $_age;
      $this -> _phone = $_phone;
    }
  
  
    /**
     * Returns $_fname class variable
     * @return String
     */
    public function getFname()
    {
      return $this -> _fname;
    }
  
    /**
     * Sets $_fname class variable
     * @param String $fname
     */
    public function setFname($fname)
    {
      $this -> _fname = $fname;
    }
  
    /**
     * Returns $_lname class variable
     * @return String
     */
    public function getLname()
    {
      return $this -> _lname;
    }
  
    /**
     * Sets $_lname class variable
     * @param String $lname
     */
    public function setLname($lname)
    {
      $this -> _lname = $lname;
    }
    
  
    /**
     * Returns $_gender class variable
     * @return String
     */
    public function getGender()
    {
      return $this -> _gender;
    }
  
    /**
     * Sets $_gender class variable
     * @param String $gender
     */
    public function setGender($gender)
    {
      $this -> _gender = $gender;
    }
  
    /**
     * Returns $_age class variable
     * @return Integer
     */
    public function getAge()
    {
      return $this -> _age;
    }
  
    /**
     * Sets $_age class variable
     * @param Integer $age
     */
    public function setAge($age)
    {
      $this -> _age = $age;
    }
  
    /**
     * Returns $_phone class variable
     * @return String
     */
    public function getPhone()
    {
      return $this -> _phone;
    }
  
    /**
     * Sets $_phone class variable
     * @param String $phone
     */
    public function setPhone($phone)
    {
      $this -> _phone = $phone;
    }
  
    /**
     * Returns $_email class variable
     * @return String
     */
    public function getEmail()
    {
      return $this -> _email;
    }
  
    /**
     * Sets $_email class variable
     * @param String $email
     */
    public function setEmail($email)
    {
      $this -> _email = $email;
    }
  
    /**
     * Returns $_state class variable
     * @return String
     */
    public function getState()
    {
      return $this -> _state;
    }
  
    /**
     * Sets $_state class variable
     * @param String $state
     */
    public function setState($state)
    {
      $this -> _state = $state;
    }
  
    /**
     * Returns $_seeking class variable
     * @return String
     */
    public function getSeeking()
    {
      return $this -> _seeking;
    }
  
    /**
     * Sets $_seeking class variable
     * @param String $seeking
     */
    public function setSeeking($seeking)
    {
      $this -> _seeking = $seeking;
    }

    /**
     * Returns $_bio class variable
     * @return String
     */
    public function getBio()
    {
      return $this -> _bio;
    }

    /**
     * Sets $_bio class variable
     * @param String $bio
     */
    public function setBio($bio)
    {
      $this -> _bio = $bio;
    }

    
  }