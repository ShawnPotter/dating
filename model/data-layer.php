<?php

  class DatingDataLayer
  {
    /**
     * returns an array of state names
     * @return string[] - array of states
     */
    function getStates(){
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
    function getIndoorActivities(){
      return array (
        "tv"=>"Television", "movies"=>"Movies", "cooking"=>"Cooking", "boardgames"=>"Board Games",
        "puzzles"=>"Puzzles", "reading"=>"Reading", "cards"=>"Playing Cards", "videogames"=>"Video Games"
      );
    }
  
    /**
     * returns an array of outdoor interests
     * @return string[] - array of interests
     */
    function getOutDoorActivities(){
      return array (
        "hiking"=>"Hiking","biking"=>"Biking","swimming"=>"Swimming","collecting"=>"Collecting",
        "walking"=>"Walking","climbing"=>"Climbing"
      );
    }
  
  
  }

  