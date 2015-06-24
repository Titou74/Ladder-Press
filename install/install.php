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
class Install {

    public function __construct() {
        
    }

    public static function install() {
        global $wpdb;

        $wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}LADP_TJ_GAM_MPA_GMP
                    (
                       GAM_ID               int not null,
                       MPA_ID               int not null,
                       primary key (GAM_ID, MPA_ID)
                    );");

        $wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}LADP_TJ_GAM_TEA_GTE
                    (
                       TEA_ID               int not null,
                       GAM_ID               int not null,
                       GTE_SERVER_URL       char(15),
                       GTE_SERVER_PORT      char(5),
                       primary key (TEA_ID, GAM_ID)
                    );
        ");

        $wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}LADP_TJ_LAD_LUP_PARTICIPE_LLP
                    (
                       LAD_ID               int not null,
                       LUP_ID               int not null,
                       LLP_JOIN_DATE        datetime not null,
                       LLP_LEAVE_DATE       datetime,
                       LLP_POINT            int not null,
                       LLP_CLASSEMENT       int not null,
                       LLP_INACTIVE         bool not null,
                       primary key (LAD_ID, LUP_ID)
                    );
        ");

        $wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}LADP_TJ_MPA_MAP_MMA
                    (
                       MAP_ID               int not null,
                       MPA_ID               int not null,
                       primary key (MAP_ID, MPA_ID)
                    );
        ");

        $wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}LADP_TJ_USER_GAM_UGA
                    (
                       UGA_GAM_ID           int not null,
                       UGA_USER_ID          bigint not null,
                       UGA_GUID             longtext,
                       primary key (UGA_GAM_ID, UGA_USER_ID)
                    );
        ");

        $wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}LADP_TJ_USER_LUP_ULU
                    (
                       LUP_ID               int not null,
                       ID                   bigint not null,
                       ULU_JOIN_DATE        datetime,
                       ULU_LEAVE_DATE       datetime,
                       primary key (LUP_ID, ID)
                    );
        ");

        $wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}LADP_TJ_USER_TEA_UTE
                    (
                       UTE_TEA_ID           int not null,
                       UTE_USER_ID          bigint not null,
                       UTE_DATE_REQUEST     datetime,
                       UTE_DATE_INVITE      datetime,
                       UTE_TEAM_ACCEPT      bool not null,
                       UTE_USER_ACCEPT      bool not null,
                       UTE_USER_RANK        char(10) not null,
                       primary key (UTE_TEA_ID, UTE_USER_ID)
                    );
        ");

        $wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}LADP_T_GAMES_GAM
            (
               GAM_ID               int not null auto_increment,
               GAM_NAME             char(255) not null,
               GAM_SHORT_NAME       char(5) not null,
               GAM_ACTIVE_GUID      bool not null,
               GAM_GUID_REGEX       char(255),
               primary key (GAM_ID)
            );
        ");

        $wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}LADP_T_LADDER_LAD
                    (
                       LAD_ID               int not null auto_increment,
                       LAD_GAM_ID           int not null,
                       LAD_MPA_ID           int not null,
                       LAD_DESCRIPTION      text not null,
                       LAD_LINEUP_SIZE      int not null,
                       LAD_RANK_SYSTEM      char(50) not null,
                       LAD_MAX_TEAM         int not null,
                       LAD_SIGN_AFTER_START bool not null,
                       LAD_START_DATE       datetime not null,
                       LAD_END_DATE         datetime not null,
                       LAD_INACTIVE_DURATION int not null,
                       LAD_REMOVE_INACTIVE_DURATION int not null,
                       LAD_STATUS           char(50) not null,
                       LAD_TIMEZONE         longtext not null,
                       LAD_CHALLENGER_NUMBER_SELECT_MAP int not null,
                       LAD_CHALLENGED_NUMBER_SELECT_MAP int not null,
                       LAD_CHALLENGER_NUMBER_SELECT_DATE int not null,
                       LAD_TIME_START       int not null,
                       LAD_TIME_END         int not null,
                       LAD_RESPOND_TIME     int not null,
                       LAD_FINALIZE_TIME    int not null,
                       LAD_ALLOW_AFTER_DATE_REPORT bool not null,
                       LAD_CHALLENGE_UP     int not null,
                       LAD_CHALLENGE_DOWN   int not null,
                       LAD_CHALLENGE_QUANTITY int not null,
                       LAD_MAX_ROUND        int not null,
                       LAD_TIME_SEPARATION_MATCH int not null,
                       LAD_QUALIFY_TYPE     char(50) not null,
                       LAD_RULES            text,
                       primary key (LAD_ID)
                    );
        ");

        $wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}LADP_T_LADDER_MATCH_LMA
                    (
                       MAT_ID               int not null auto_increment,
                       LMA_LAD_ID           int not null,
                       MAT_CHALLENGER_ID    int,
                       MAT_CHALLENGED_ID    int,
                       MAT_DATE             datetime,
                       MAT_SERVER           char(21),
                       MAT_STATUS           char(50),
                       MAT_CHALLENGER_SCORE int,
                       MAT_CHALLENGED_SCORE int,
                       MAT_CHALLENGER_REPORT text,
                       MAT_CHALLENGED_REPORT text,
                       primary key (MAT_ID)
                    );
        ");

        $wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}LADP_T_LAD_DAYS_POSSIBLE_LDP
                    (
                       LDP_LAD_ID           int not null,
                       LDP_DAY              datetime not null,
                       primary key (LDP_LAD_ID, LDP_DAY)
                    );
        ");

        $wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}LADP_T_LINE_UP_LUP
                    (
                       LUP_ID               int not null auto_increment,
                       LUP_TEA_ID           int not null,
                       LUP_GAM_ID           int not null,
                       LUP_NAME             char(256) not null,
                       LUP_SHORT_NAME       char(5),
                       LUP_DATE_CREATION    datetime not null,
                       LUP_DATE_SUPPRESSION datetime,
                       LUP_ACTIVE           bool not null,
                       primary key (LUP_ID)
                    );
        ");

        $wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}LADP_T_MAPS_MAP
                    (
                       MAP_ID               int not null auto_increment,
                       MAP_GAM_ID           int,
                       MAP_NAME             char(100),
                       MAP_PICK             char(100),
                       primary key (MAP_ID)
                    );
        ");

        $wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}LADP_T_MAP_PACKS_MPA
                    (
                       MPA_ID               int not null auto_increment,
                       MPA_NAME             char(100) not null,
                       primary key (MPA_ID)
                    );
        ");

        $wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}LADP_T_MATCHS_MAT
                    (
                       MAT_ID               int not null auto_increment,
                       MAT_CHALLENGER_ID    int not null,
                       MAT_CHALLENGED_ID    int not null,
                       MAT_DATE             datetime,
                       MAT_SERVER           char(21),
                       MAT_STATUS           char(50) not null,
                       MAT_CHALLENGER_SCORE int,
                       MAT_CHALLENGED_SCORE int,
                       MAT_CHALLENGER_REPORT text,
                       MAT_CHALLENGED_REPORT text,
                       primary key (MAT_ID)
                    );
        ");

        $wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}LADP_T_PLAYED_MAP_PLM
                    (
                       PLM_MAT_ID           int not null,
                       PLM_MAP_ID           int not null,
                       primary key (PLM_MAT_ID, PLM_MAP_ID)
                    );
        ");

        $wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}LADP_T_PROPOSE_DATE_PDA
                    (
                       PDA_MAT_ID           int not null,
                       PDA_DATE             datetime not null,
                       primary key (PDA_MAT_ID, PDA_DATE)
                    );
        ");

        $wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}LADP_T_PROPOSE_MAP_PMA
                    (
                       PMA_MAT_ID           int not null,
                       PMA_MAP_ID           int not null,
                       primary key (PMA_MAT_ID, PMA_MAP_ID)
                    );
        ");

        $wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}LADP_T_TEAMS_TEA
                    (
                       TEA_ID               int not null auto_increment,
                       USER_ID_CREATOR      bigint not null,
                       TEA_NAME             char(255),
                       TEA_TAG              char(5),
                       TEA_DATE_CREATION    datetime,
                       TEA_ACTIVE           bool,
                       TEA_SITE_URL         char(255),
                       TEA_LOGO_NAME        char(255),
                       primary key (TEA_ID)
                    );
        ");

        $wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}LADP_T_USER_MAT_COMMENTAIRE_UMC
                    (
                       UMC_ID               bigint not null,
                       UMC_MAT_ID           int not null,
                       UMC_USER_ID          bigint not null,
                       UMC_CREATE_DATE      datetime not null,
                       UMC_LAST_MODIF_DATE  datetime,
                       UMC_COMMENT_CONTENT  text not null,
                       UMC_ACTIVE           bool not null,
                       primary key (UMC_ID)
                    );   
        ");
    }

}
