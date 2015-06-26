<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Map
{
    private $id;
    private $gameId;
    private $name;
    private $pick;
    
    function __construct() {
        
    }
    
    public function getId() {
        return $this->id;
    }

    public function getGameId() {
        return $this->gameId;
    }

    public function getName() {
        return $this->name;
    }

    public function getPick() {
        return $this->pick;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setGameId($gameId) {
        $this->gameId = $gameId;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setPick($pick) {
        $this->pick = $pick;
    }


}
