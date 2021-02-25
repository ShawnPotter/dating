<?php
  class Form
  {
    private $_name;
    private $_gender;
    private $_age;
    private $_phone;
    private $_email;
    private $_state;
    private $_seeking;
    private $_bio;
    private $_interests;
  
    /**
     * Form constructor.
     * @param $_name
     * @param $_gender
     * @param $_age
     * @param $_phone
     * @param $_email
     * @param $_state
     * @param $_seeking
     * @param $_interests
     */
  
    /**
     * @return mixed
     */
    public function getName()
    {
      return $this -> _name;
    }
  
    /**
     * @param mixed $name
     */
    public function setName($name)
    {
      $this -> _name = $name;
    }
  
    /**
     * @return mixed
     */
    public function getGender()
    {
      return $this -> _gender;
    }
  
    /**
     * @param mixed $gender
     */
    public function setGender($gender)
    {
      $this -> _gender = $gender;
    }
  
    /**
     * @return mixed
     */
    public function getAge()
    {
      return $this -> _age;
    }
  
    /**
     * @param mixed $age
     */
    public function setAge($age)
    {
      $this -> _age = $age;
    }
  
    /**
     * @return mixed
     */
    public function getPhone()
    {
      return $this -> _phone;
    }
  
    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
      $this -> _phone = $phone;
    }
  
    /**
     * @return mixed
     */
    public function getEmail()
    {
      return $this -> _email;
    }
  
    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
      $this -> _email = $email;
    }
  
    /**
     * @return mixed
     */
    public function getState()
    {
      return $this -> _state;
    }
  
    /**
     * @param mixed $state
     */
    public function setState($state)
    {
      $this -> _state = $state;
    }
  
    /**
     * @return mixed
     */
    public function getSeeking()
    {
      return $this -> _seeking;
    }
  
    /**
     * @param mixed $seeking
     */
    public function setSeeking($seeking)
    {
      $this -> _seeking = $seeking;
    }

    /**
     * @return mixed
     */
    public function getBio()
    {
      return $this -> _bio;
    }

    /**
     * @param mixed $bio
     */
    public function setBio($bio)
    {
      $this -> _bio = $bio;
    }

  
    /**
     * @return mixed
     */
    public function getInterests()
    {
      return $this -> _interests;
    }
  
    /**
     * @param mixed $interests
     */
    public function setInterests($interests)
    {
      $this -> _interests = $interests;
    }
  
    
  }