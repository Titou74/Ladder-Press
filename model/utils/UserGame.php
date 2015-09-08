<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserGame
 *
 * @author Titou74 <titou.c.74@gmail.com>
 */
class UserGame {
    private $userId;
    private $gameId;
    private $guid;
    
    function getUserId() {
        return $this->userId;
    }

    function getGameId() {
        return $this->gameId;
    }

    function getGuid() {
        return $this->guid;
    }

    function setUserId($userId) {
        $this->userId = $userId;
    }

    function setGameId($gameId) {
        $this->gameId = $gameId;
    }

    function setGuid($guid) {
        $this->guid = $guid;
    }
    
}
