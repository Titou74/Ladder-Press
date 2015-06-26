<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ProposeDate
{
    private $matchId;
    private $date;
    
    function __construct() {
        
    }
    
    public function getMatchId() {
        return $this->matchId;
    }

    public function getDate() {
        return $this->date;
    }

    public function setMatchId($matchId) {
        $this->matchId = $matchId;
    }

    public function setDate($date) {
        $this->date = $date;
    }
    
}