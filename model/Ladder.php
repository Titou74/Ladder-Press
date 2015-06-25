<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Ladder
{ 
    private $id;
    private $idGame;
    private $mpaId;
    private $description;
    private $lineUpSize;
    private $rankSystem;
    private $signAfterStart;
    private $startDate;
    private $endDate;
    private $inactiveDuration;
    private $removeInactiveDuration;
    private $status;
    private $timezone;
    private $challengerNumberSelectMap;
    private $challengedNumberSelectMap;
    private $challengerNumberSelectDate;
    private $timeStart;
    private $timeEnd;
    private $respondTime;
    private $finalizeTime;
    private $allowAfterDateReport;
    private $challengeUp;
    private $challengeDown;
    private $challengeQuantity;
    private $maxRound;
    private $timeSeparationMatch;
    private $qualifyType;
    private $rules;
    
    public function __construct() {
       
    } 
    
    public function getId() {
        return $this->id;
    }

    public function getIdGame() {
        return $this->idGame;
    }

    public function getMpaId() {
        return $this->mpaId;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getLineUpSize() {
        return $this->lineUpSize;
    }

    public function getRankSystem() {
        return $this->rankSystem;
    }

    public function getSignAfterStart() {
        return $this->signAfterStart;
    }

    public function getStartDate() {
        return $this->startDate;
    }

    public function getEndDate() {
        return $this->endDate;
    }

    public function getInactiveDuration() {
        return $this->inactiveDuration;
    }

    public function getRemoveInactiveDuration() {
        return $this->removeInactiveDuration;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getTimezone() {
        return $this->timezone;
    }

    public function getChallengerNumberSelectMap() {
        return $this->challengerNumberSelectMap;
    }

    public function getChallengedNumberSelectMap() {
        return $this->challengedNumberSelectMap;
    }

    public function getChallengerNumberSelectDate() {
        return $this->challengerNumberSelectDate;
    }

    public function getTimeStart() {
        return $this->timeStart;
    }

    public function getTimeEnd() {
        return $this->timeEnd;
    }

    public function getRespondTime() {
        return $this->respondTime;
    }

    public function getFinalizeTime() {
        return $this->finalizeTime;
    }

    public function getAllowAfterDateReport() {
        return $this->allowAfterDateReport;
    }

    public function getChallengeUp() {
        return $this->challengeUp;
    }

    public function getChallengeDown() {
        return $this->challengeDown;
    }

    public function getChallengeQuantity() {
        return $this->challengeQuantity;
    }

    public function getMaxRound() {
        return $this->maxRound;
    }

    public function getTimeSeparationMatch() {
        return $this->timeSeparationMatch;
    }

    public function getQualifyType() {
        return $this->qualifyType;
    }

    public function getRules() {
        return $this->rules;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setIdGame($idGame) {
        $this->idGame = $idGame;
    }

    public function setMpaId($mpaId) {
        $this->mpaId = $mpaId;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setLineUpSize($lineUpSize) {
        $this->lineUpSize = $lineUpSize;
    }

    public function setRankSystem($rankSystem) {
        $this->rankSystem = $rankSystem;
    }

    public function setSignAfterStart($signAfterStart) {
        $this->signAfterStart = $signAfterStart;
    }

    public function setStartDate($startDate) {
        $this->startDate = $startDate;
    }

    public function setEndDate($endDate) {
        $this->endDate = $endDate;
    }

    public function setInactiveDuration($inactiveDuration) {
        $this->inactiveDuration = $inactiveDuration;
    }

    public function setRemoveInactiveDuration($removeInactiveDuration) {
        $this->removeInactiveDuration = $removeInactiveDuration;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function setTimezone($timezone) {
        $this->timezone = $timezone;
    }

    public function setChallengerNumberSelectMap($challengerNumberSelectMap) {
        $this->challengerNumberSelectMap = $challengerNumberSelectMap;
    }

    public function setChallengedNumberSelectMap($challengedNumberSelectMap) {
        $this->challengedNumberSelectMap = $challengedNumberSelectMap;
    }

    public function setChallengerNumberSelectDate($challengerNumberSelectDate) {
        $this->challengerNumberSelectDate = $challengerNumberSelectDate;
    }

    public function setTimeStart($timeStart) {
        $this->timeStart = $timeStart;
    }

    public function setTimeEnd($timeEnd) {
        $this->timeEnd = $timeEnd;
    }

    public function setRespondTime($respondTime) {
        $this->respondTime = $respondTime;
    }

    public function setFinalizeTime($finalizeTime) {
        $this->finalizeTime = $finalizeTime;
    }

    public function setAllowAfterDateReport($allowAfterDateReport) {
        $this->allowAfterDateReport = $allowAfterDateReport;
    }

    public function setChallengeUp($challengeUp) {
        $this->challengeUp = $challengeUp;
    }

    public function setChallengeDown($challengeDown) {
        $this->challengeDown = $challengeDown;
    }

    public function setChallengeQuantity($challengeQuantity) {
        $this->challengeQuantity = $challengeQuantity;
    }

    public function setMaxRound($maxRound) {
        $this->maxRound = $maxRound;
    }

    public function setTimeSeparationMatch($timeSeparationMatch) {
        $this->timeSeparationMatch = $timeSeparationMatch;
    }

    public function setQualifyType($qualifyType) {
        $this->qualifyType = $qualifyType;
    }

    public function setRules($rules) {
        $this->rules = $rules;
    }


    
}