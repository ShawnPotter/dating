<?php
  class PremiumMember extends Member
  {
  
    private $_inDoorInterests;
    private $_outDoorInterests;
  
    /**
     * Returns an array of indoor interests
     *
     * @return array
     */
    public function getInDoorInterests()
    {
      return $this -> _inDoorInterests;
    }
  
    /**
     * Sets an array of indoor interests
     *
     * @param array $inDoorInterests
     */
    public function setInDoorInterests($inDoorInterests)
    {
      $this -> _inDoorInterests = $inDoorInterests;
    }
  
    /**
     * Returns an array of outdoor interests
     *
     * @return array
     */
    public function getOutDoorInterests()
    {
      return $this -> _outDoorInterests;
    }
  
    /**
     * Sets an array of outdoor interests
     *
     * @param array $outDoorInterests
     */
    public function setOutDoorInterests($outDoorInterests)
    {
      $this -> _outDoorInterests = $outDoorInterests;
    }
    
  
  }
