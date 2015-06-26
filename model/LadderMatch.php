<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class LadderMatch
{
    private $id;
    private $ladId;
    private $challengerId;
    private $challengedId;
    private $date;
    private $server;
    private $status;
    private $challengerScore;
    private $challengedScore;
    private $challengerReport;
    private $challengedReport;
    
    function __construct()
    {
        
    }
    
    public function getId() {
        return $this->id;
    }

    public function getLadId() {
        return $this->ladId;
    }

    public function getChallengerId() {
        return $this->challengerId;
    }

    public function getChallengedId() {
        return $this->challengedId;
    }

    public function getDate() {
        return $this->date;
    }

    public function getServer() {
        return $this->server;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getChallengerScore() {
        return $this->challengerScore;
    }

    public function getChallengedScore() {
        return $this->challengedScore;
    }

    public function getChallengerReport() {
        return $this->challengerReport;
    }

    public function getChallengedReport() {
        return $this->challengedReport;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setLadId($ladId) {
        $this->ladId = $ladId;
    }

    public function setChallengerId($challengerId) {
        $this->challengerId = $challengerId;
    }

    public function setChallengedId($challengedId) {
        $this->challengedId = $challengedId;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function setServer($server) {
        $this->server = $server;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function setChallengerScore($challengerScore) {
        $this->challengerScore = $challengerScore;
    }

    public function setChallengedScore($challengedScore) {
        $this->challengedScore = $challengedScore;
    }

    public function setChallengerReport($challengerReport) {
        $this->challengerReport = $challengerReport;
    }

    public function setChallengedReport($challengedReport) {
        $this->challengedReport = $challengedReport;
    }


}
