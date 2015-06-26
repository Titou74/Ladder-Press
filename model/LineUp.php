<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class LineUp
{
    private $id;
    private $teamId;
    private $gameId;
    private $name;
    private $shortName;
    private $dateCreation;
    private $dateSuppression;
    private $active;
    
    function __construct() {
        
    }
    
    public function getId() {
        return $this->id;
    }

    public function getTeamId() {
        return $this->teamId;
    }

    public function getGameId() {
        return $this->gameId;
    }

    public function getName() {
        return $this->name;
    }

    public function getShortName() {
        return $this->shortName;
    }

    public function getDateCreation() {
        return $this->dateCreation;
    }

    public function getDateSuppression() {
        return $this->dateSuppression;
    }

    public function getActive() {
        return $this->active;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setTeamId($teamId) {
        $this->teamId = $teamId;
    }

    public function setGameId($gameId) {
        $this->gameId = $gameId;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setShortName($shortName) {
        $this->shortName = $shortName;
    }

    public function setDateCreation($dateCreation) {
        $this->dateCreation = $dateCreation;
    }

    public function setDateSuppression($dateSuppression) {
        $this->dateSuppression = $dateSuppression;
    }

    public function setActive($active) {
        $this->active = $active;
    }


    
}