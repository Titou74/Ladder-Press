<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author Titou74 <titou.c.74@gmail.com>
 */
class User {
    private $userId;
    private $userLogin;
    
    function getUserId() {
        return $this->userId;
    }

    function getUserLogin() {
        return $this->userLogin;
    }

    function setUserId($userId) {
        $this->userId = $userId;
    }

    function setUserLogin($userLogin) {
        $this->userLogin = $userLogin;
    }
    
    private function instancierUser($userArray = null) {
        $user = null;
        if($userArray != null) {
            $user = new User();
            
            $user->setUserId($userArray['ID']);
            $user->setUserLogin($userArray['user_login']);
        }
        return $user;
    }

    function getUsersOfTeam($idTeam) {
        $idTeamFormat = stripslashes_deep($idTeam);
        global $wpdb;
        
        $result = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}users
            JOIN {$wpdb->prefix}ladp_tj_user_tea_ute ON {$wpdb->prefix}users.ID = {$wpdb->prefix}ladp_tj_user_tea_ute.UTE_USER_ID
            WHERE {$wpdb->prefix}ladp_tj_user_tea_ute.UTE_TEA_ID = $idTeamFormat
            AND ({$wpdb->prefix}ladp_tj_user_tea_ute.UTE_DATE_LEAVE IS NULL OR {$wpdb->prefix}ladp_tj_user_tea_ute.UTE_DATE_LEAVE = '0000-00-00')
            AND {$wpdb->prefix}ladp_tj_user_tea_ute.UTE_TEAM_ACCEPT = 1
            AND {$wpdb->prefix}ladp_tj_user_tea_ute.UTE_USER_ACCEPT = 1", ARRAY_A);
        $users = array();
        
        // Instanciation des objects "Game"
        foreach ($result as $value){
            $users[] = self::instancierUser($value);
        }
        return $users;
    }
}
