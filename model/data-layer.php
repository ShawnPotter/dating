<?php

  class DatingDataLayer
  {
    private $_dbh;
    
    /**
     * DatingDataLayer constructor.
     * @param object database object
     */
    public function __construct($dbh)
    {
      $this->_dbh = $dbh;
    }
  
    /**
     * Inserts a new member into a mysql table
     *
     * Inserts a new member into a mysql table using PDO
     */
    public function insertMember()
    {
      $sql = "INSERT INTO members (fname, lname, age, gender, phone, email, state, seeking, bio, premium, interests) 
              VALUES (:fname, :lname, :age, :gender, :phone, :email, :state, :seeking, :bio, :premium, :interests)";

      if($statement = $this->_dbh->prepare($sql)) {
        //echo "<br>" . "statement prepared" . "<br>";
        
        if($_SESSION['isPremium'] == true){
          $premium = 1;
        } else{
          $premium = 0;
        }
  
        $fname = $_SESSION['member']->getFname();
        $lname = $_SESSION['member']->getLname();
        $age = $_SESSION['member']->getAge();
        $gender = $_SESSION['member']->getGender();
        $phone = $_SESSION['member']->getPhone();
        $email = $_SESSION['member']->getEmail();
        $state = $_SESSION['member']->getState();
        $seeking = $_SESSION['member']->getSeeking();
        $bio = $_SESSION['member']->getBio();
        $interests = null;
  
  
  
        $statement->bindParam(":fname", $fname, PDO::PARAM_STR);
        $statement->bindParam(":lname", $lname, PDO::PARAM_STR);
        $statement->bindParam(":age", $age, PDO::PARAM_INT);
        $statement->bindParam(":gender", $gender, PDO::PARAM_STR);
        $statement->bindParam(":phone", $phone, PDO::PARAM_STR);
        $statement->bindParam(":email", $email, PDO::PARAM_STR);
        $statement->bindParam(":state", $state, PDO::PARAM_STR);
        $statement->bindParam(":seeking", $seeking, PDO::PARAM_STR);
        $statement->bindParam(":bio", $bio, PDO::PARAM_STR);
        $statement->bindParam(":premium", $premium, PDO::PARAM_INT);
  
        if($_SESSION['member'] instanceof PremiumMember){
          if($_SESSION['member']->getInDoorInterests() != null){
            $interests = $_SESSION['member']->getInDoorInterests();
          }
          if($_SESSION['member']->getOutDoorInterests() != null) {
            if(empty($interests)){
              $interests = $_SESSION['member']->getOutDoorInterests();
            } else{
              $interests .= ", " . $_SESSION['member']->getOutDoorInterests();
            }
          }
          /*
          echo $fname . "<br>";
          echo $lname . "<br>";
          echo $age . "<br>";
          echo $gender . "<br>";
          echo $phone . "<br>";
          echo $email . "<br>";
          echo $state . "<br>";
          echo $seeking . "<br>";
          echo $bio . "<br>";
          echo $interests . "<br>";
          echo $premium . "<br>";
          */ // debug
        }
        $statement->bindParam(":interests", $interests, PDO::PARAM_STR);
        $statement->execute();
        /*
        if($statement->execute())
          echo "statement executed";
        else
          echo "statement failed";
        */ // debug
  
        /*echo "\nPDOStatement::errorInfo():\n";
        $arr = $statement->errorInfo();
        print_r($arr);*/
      }
      /*
      else {
        //echo "<br>" . "statement not prepared" . "<br>";
      }
      */

     


    }
  
    /**
     * Gets all members from a mysql table
     *
     * Gets all members from a mysql table and stores them in an array of objects
     * the sql statement orders the list of members by their last names
     *
     * @return mixed array of objects from a mysql table
     */
    public function getMembers()
    {
      $sql = "SELECT * FROM members ORDER BY lname";
      $statement = $this->_dbh->prepare($sql);
      $statement->execute();
      return $statement->fetchAll();
    }
  
    /**
     * Gets a specific member by their member id
     *
     * Gets a specific member by their member id and returns that data from the
     * database
     *
     * @param $member_id integer the id number of the member
     * @return mixed an object array
     */
    public function getMember($member_id)
    {
      $sql = "SELECT * FROM members WHERE member_id = :member_id";
      $statement = $this->_dbh->prepare($sql);
      $statement->bindParam(":member_id", $member_id, PDO::PARAM_STR);
      $statement->execute();
      return $statement->fetchAll();
    }
  
    /**
     * Gets the interests of a specific member
     *
     * Gets the interests of a specific member and returns them in an object array
     *
     * @param $member_id integer the id number of the member
     * @return mixed an object array
     */
    public function getInterests($member_id)
    {
      $sql = "SELECT interests FROM members WHERE member_id = :member_id";
      $statement = $this->_dbh->prepare($sql);
      $statement->bindParam(":member_id", $member_id, PDO::PARAM_STR);
      $statement->execute();
      return $statement->fetchAll();
    }
  
  
    /**
     * returns an array of state names
     * @return string[] - array of states
     */
    function getStates()
    {
      return array (
        "Alabama","Alaska","Arizona","Arkansas","California","Colorado","Connecticut","Delaware","Florida",
        "Georgia","Hawaii","Idaho","Illinois","Indiana","Iowa","Kansas","Kentucky","Louisiana","Maine",
        "Maryland","Massachusetts","Michigan","Minnesota","Mississippi","Missouri","Montana","Nebraska","Nevada",
        "New Hampshire","New Jersey","New Mexico","New York","North Carolina","North Dakota","Ohio","Oklahoma",
        "Oregon","Pennsylvania","Rhode Island","South Carolina","South Dakota","Tennessee","Texas","Utah",
        "Vermont","Virginia","Washington","West Virginia","Wisconsin","Wyoming"
      );
    }
  
    /**
     * returns an array of indoor interests
     * @return string[] - array of interests
     */
    function getIndoorActivities()
    {
      return array (
        "tv"=>"Television", "movies"=>"Movies", "cooking"=>"Cooking", "boardgames"=>"Board Games",
        "puzzles"=>"Puzzles", "reading"=>"Reading", "cards"=>"Playing Cards", "videogames"=>"Video Games"
      );
    }
  
    /**
     * returns an array of outdoor interests
     * @return string[] - array of interests
     */
    function getOutDoorActivities()
    {
      return array (
        "hiking"=>"Hiking","biking"=>"Biking","swimming"=>"Swimming","collecting"=>"Collecting",
        "walking"=>"Walking","climbing"=>"Climbing"
      );
    }
  
  
  }

  