<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Uninstall
 *
 * @author Titou
 */
class Uninstall {
    
    public function __construct() {
        
    }
    
    public static function uninstall() {
        global $wpdb;
        $wpdb->query("drop table if exists LADP_TJ_GAM_MPA_GMP;");
        $wpdb->query("drop table if exists LADP_TJ_GAM_TEA_GTE;");
        $wpdb->query("drop table if exists LADP_TJ_LAD_LUP_PARTICIPE_LLP;");
        $wpdb->query("drop table if exists LADP_TJ_MPA_MAP_MMA;");
        $wpdb->query("drop table if exists LADP_TJ_USER_GAM_UGA;");
        $wpdb->query("drop table if exists LADP_TJ_USER_LUP_ULU;");
        $wpdb->query("drop table if exists LADP_TJ_USER_TEA_UTE;");
        $wpdb->query("drop table if exists LADP_T_GAMES_GAM;");
        $wpdb->query("drop table if exists LADP_T_LADDER_LAD;");
        $wpdb->query("drop table if exists LADP_T_LADDER_MATCH_LMA;");
        $wpdb->query("drop table if exists LADP_T_LAD_DAYS_POSSIBLE_LDP;");
        $wpdb->query("drop table if exists LADP_T_LINE_UP_LUP;");
        $wpdb->query("drop table if exists LADP_T_MAPS_MAP;");
        $wpdb->query("drop table if exists LADP_T_MAP_PACKS_MPA;");
        $wpdb->query("drop table if exists LADP_T_MATCHS_MAT;");
        $wpdb->query("drop table if exists LADP_T_PLAYED_MAP_PLM;");
        $wpdb->query("drop table if exists LADP_T_PROPOSE_DATE_PDA;");
        $wpdb->query("drop table if exists LADP_T_PROPOSE_MAP_PMA;");
        $wpdb->query("drop table if exists LADP_T_TEAMS_TEA;");
        $wpdb->query("drop table if exists LADP_T_USER_MAT_COMMENTAIRE_UMC;");
    }
}
