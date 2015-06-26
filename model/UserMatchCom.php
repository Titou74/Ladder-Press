<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UserMatchCom
{
    private $id;
    private $matchId;
    private $userId;
    private $createDate;
    private $lastModifDate;
    private $comContent;
    private $active;
    
    function __construct() {
        
    }
    
    public function getId() {
        return $this->id;
    }

    public function getMatchId() {
        return $this->matchId;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function getCreateDate() {
        return $this->createDate;
    }

    public function getLastModifDate() {
        return $this->lastModifDate;
    }

    public function getComContent() {
        return $this->comContent;
    }

    public function getActive() {
        return $this->active;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setMatchId($matchId) {
        $this->matchId = $matchId;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
    }

    public function setCreateDate($createDate) {
        $this->createDate = $createDate;
    }

    public function setLastModifDate($lastModifDate) {
        $this->lastModifDate = $lastModifDate;
    }

    public function setComContent($comContent) {
        $this->comContent = $comContent;
    }

    public function setActive($active) {
        $this->active = $active;
    }


    
}