<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class PlayedMap
{
    private $matchId;
    private $mapId;
    
    function __construct() {
        
    }
    
    public function getMatchId() {
        return $this->matchId;
    }

    public function getMapId() {
        return $this->mapId;
    }

    public function setMatchId($matchId) {
        $this->matchId = $matchId;
    }

    public function setMapId($mapId) {
        $this->mapId = $mapId;
    }


}