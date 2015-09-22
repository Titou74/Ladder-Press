<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserTeam
 *
 * @author Titou74 <titou.c.74@gmail.com>
 */
class UserTeam {
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
    
    private function instancierUserTeam($userTeamArray = null) {
        $userTeam = null;
        if($userTeamArray != null) {
            $userTeam = new UserTeam();
            
            $userTeam->setTeamId($userTeamArray['UTE_TEA_ID']);
            $userTeam->setUserId($userTeamArray['UTE_USER_ID']);
            $userTeam->setRequestDate($userTeamArray['UTE_DATE_REQUEST']);
            $userTeam->setTeamAccept($userTeamArray['UTE_TEAM_ACCEPT'] == 1 ? true : false);
            $userTeam->setUserAccept($userTeamArray['UTE_USER_ACCEPT'] == 1 ? true : false);
            $userTeam->setUserRank($userTeamArray['UTE_USER_RANK']);
            $userTeam->setAcceptDate($userTeamArray['UTE_DATE_ACCEPT']);
            $userTeam->setLeaveDate($userTeamArray['UTE_DATE_LEAVE']);
        }
        return $userTeam;
    }
    
    function getUserTeam($idUser, $idTeam) {
        $idUserFormat = stripslashes_deep($idUser);
        $idTeamFormat = stripslashes_deep($idTeam);
        global $wpdb;
        $result = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}ladp_tj_user_tea_ute
                                    WHERE UTE_TEA_ID = $idTeamFormat 
                                    AND UTE_USER_ID = $idUserFormat
                                    AND (UTE_DATE_LEAVE IS NULL OR UTE_DATE_LEAVE = '0000-00-00')
                                    AND UTE_TEAM_ACCEPT = TRUE AND UTE_USER_ACCEPT = TRUE", ARRAY_A);
        $userTeam = self::instancierUserTeam($result);
        return $userTeam;
    }
    
    public function createUserTeam($userTeam) {
        global $wpdb;
        $wpdb->insert( "{$wpdb->prefix}ladp_tj_user_tea_ute", 
            array( 
                'UTE_TEA_ID' => stripslashes_deep($userTeam->getTeamId()),
		'UTE_USER_ID' => stripslashes_deep($userTeam->getUserId()),
		'UTE_DATE_REQUEST' => stripslashes_deep($userTeam->getRequestDate()),
                'UTE_TEAM_ACCEPT' => stripslashes_deep($userTeam->getTeamAccept()),
                'UTE_USER_ACCEPT' => stripslashes_deep($userTeam->getUserAccept()),
                'UTE_USER_RANK' => stripslashes_deep($userTeam->getUserRank()),
                'UTE_DATE_ACCEPT' => stripslashes_deep($userTeam->getAcceptDate()),
                'UTE_DATE_LEAVE' => stripslashes_deep($userTeam->getLeaveDate())
            ),
            array( 
                    '%d',
                    '%d',
                    '%s',
                    '%d',
                    '%d',
                    '%s',
                    '%s',
                    '%s'
            )
        );
    }
    
    public function updateUserTeam($userTeam) {
        global $wpdb;
        $wpdb->update( "{$wpdb->prefix}ladp_tj_user_tea_ute", 
            array( 
		'UTE_DATE_REQUEST' => stripslashes_deep($userTeam->getRequestDate()),
                'UTE_TEAM_ACCEPT' => stripslashes_deep($userTeam->getTeamAccept()),
                'UTE_USER_ACCEPT' => stripslashes_deep($userTeam->getUserAccept()),
                'UTE_USER_RANK' => stripslashes_deep($userTeam->getUserRank()),
                'UTE_DATE_ACCEPT' => stripslashes_deep($userTeam->getAcceptDate()),
                'UTE_DATE_LEAVE' => stripslashes_deep($userTeam->getLeaveDate())
            ),
            array( 'UTE_TEA_ID' => stripslashes_deep($userTeam->getTeamId()), 'UTE_USER_ID' => stripslashes_deep($userTeam->getUserId()) ),
            array( 
                    '%s',
                    '%d',
                    '%d',
                    '%s',
                    '%s',
                    '%s'
            )
        );
    }

    function isUserHasTeam($idUser) {
        $userTeam = Team::getCurrentPlayerTeam($idUser);
        if($userTeam == null || empty($userTeam)) {
            return false;
        } else {
            return true;
        }
    }
    
    function isUserAdminTeam($idUser, $idTeam) {
        $userTeam = self::getUserTeam($idUser, $idTeam);
        if($userTeam == null || empty($userTeam)) {
            return false;
        } else {
            if($userTeam->getUserRank() == "admin") {
                return true;
            } else {
                return false;
            }
        }
    }
}
