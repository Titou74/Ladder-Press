<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Game
{ 
    private $id;
    private $name;
    private $shortname;
    private $activeGuid;
    private $guidRegex;
    
    public function __construct() {
       
    } 
    
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getShortname() {
        return $this->shortname;
    }

    public function getActiveGuid() {
        return $this->activeGuid;
    }

    public function getGuidRegex() {
        return $this->guidRegex;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setShortname($shortname) {
        $this->shortname = $shortname;
    }

    public function setActiveGuid($activeGuid) {
        $this->activeGuid = $activeGuid;
    }

    public function setGuidRegex($guidRegex) {
        $this->guidRegex = $guidRegex;
    }
}
