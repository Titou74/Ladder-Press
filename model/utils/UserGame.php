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
    private $teamId;
    private $userId;
    private $requestDate;
    private $teamAccept;
    private $userAccept;
    private $userRank;
    private $acceptDate;
    private $leaveDate;
    
    function getTeamId() {
        return $this->teamId;
    }

    function getUserId() {
        return $this->userId;
    }

    function getRequestDate() {
        return $this->requestDate;
    }

    function getTeamAccept() {
        return $this->teamAccept;
    }

    function getUserAccept() {
        return $this->userAccept;
    }

    function getUserRank() {
        return $this->userRank;
    }

    function getAcceptDate() {
        return $this->acceptDate;
    }

    function getLeaveDate() {
        return $this->leaveDate;
    }

    function setTeamId($teamId) {
        $this->teamId = $teamId;
    }

    function setUserId($userId) {
        $this->userId = $userId;
    }

    function setRequestDate($requestDate) {
        $this->requestDate = $requestDate;
    }

    function setTeamAccept($teamAccept) {
        $this->teamAccept = $teamAccept;
    }

    function setUserAccept($userAccept) {
        $this->userAccept = $userAccept;
    }

    function setUserRank($userRank) {
        $this->userRank = $userRank;
    }

    function setAcceptDate($acceptDate) {
        $this->acceptDate = $acceptDate;
    }

    function setLeaveDate($leaveDate) {
        $this->leaveDate = $leaveDate;
    }


}
