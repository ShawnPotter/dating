<?php

  class DatingDataLayer
  {
    private $_dbh;
    
    /**
     * DatingDataLayer constructor.
     */
    public function __construct($dbh)
    {
      $this->_dbh = $dbh;
    }
    
    function insertMember()
    {
      $sql = "INSERT INTO members (fname, lname, age, gender, phone, email, state, seeking, bio, premium, interests) 
              VALUES (:fname, :lname, :age, :gender, :phone, :email, :state, :seeking, :bio, :premium, :interests)";

      if($statement = $this->_dbh->prepare($sql)) {
        echo "statement prepared" . "<br>";
      }
      else {
        echo "statement not prepared" . "<br>";
      }

      if($_SESSION['isPremium'] = true){
        $premium = 1;
      } else{
        $premium = 0;
      }

      $fname = $_SESSION['member']->getFname();
      echo $fname . "<br>";
      $lname = $_SESSION['member']->getLname();
      echo $lname . "<br>";
      $age = $_SESSION['member']->getAge();
      echo $age . "<br>";
      $gender = $_SESSION['member']->getGender();
      echo $gender . "<br>";
      $phone = $_SESSION['member']->getPhone();
      echo $phone . "<br>";
      $email = $_SESSION['member']->getEmail();
      echo $email . "<br>";
      $state = $_SESSION['member']->getState();
      echo $state . "<br>";
      $seeking = $_SESSION['member']->getSeeking();
      echo $seeking . "<br>";
      $bio = $_SESSION['member']->getBio();
      echo $bio . "<br>";
      $interests = "";

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
        echo $interests . "<br>";
        $statement->bindParam(":interests", $interests, PDO::PARAM_STR);
      }
      if($statement->execute())
        echo "statement executed";
      else
        echo "statement failed";

      echo "\nPDOStatement::errorInfo():\n";
      $arr = $statement->errorInfo();
      print_r($arr);


    }
    function getMembers()
    {
      $sql = "SELECT * FROM members";
      $statement = $this->_dbh->prepare($sql);
      $statement->execute();
      $row = $statement->fetchAll();
    }
    function getMember($member_id)
    {
      $sql = "SELECT * FROM members WHERE member_id = :member_id";
      $statement = $this->_dbh->prepare($sql);
      $statement->bindParam(":member_id", $member_id, PDO::PARAM_STR);
      $statement->execute();
    }
    function getInterests($member_id)
    {
      $sql = "SELECT interets FROM members WHERE member_id = :member_id";
      $statement = $this->_dbh->prepare($sql);
      $statement->bindParam(":member_id", $member_id, PDO::PARAM_STR);
      $statement->execute();
      $statement->errorInfo();
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

  