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
                    );
        ");

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
                       UGA_USER_ID          bigint(20) unsigned not null,
                       UGA_GUID             longtext,
                       UGA_NICKNAME         longtext,
                       primary key (UGA_GAM_ID, UGA_USER_ID)
                    );
        ");

        $wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}LADP_TJ_USER_LUP_ULU
                    (
                       LUP_ID               int not null,
                       ID                   bigint(20) unsigned not null,
                       ULU_JOIN_DATE        datetime not null,
                       ULU_LEAVE_DATE       datetime,
                       primary key (LUP_ID, ID)
                    );
        ");

        $wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}LADP_TJ_USER_TEA_UTE
                    (
                       UTE_TEA_ID           int not null,
                       UTE_USER_ID          bigint(20) unsigned not null,
                       UTE_DATE_REQUEST     datetime,
                       UTE_DATE_INVITE      datetime,
                       UTE_TEAM_ACCEPT      bool not null,
                       UTE_USER_ACCEPT      bool not null,
                       UTE_USER_RANK        char(10) not null,
                       UTE_DATE_ACCEPT      datetime,
                       UTE_DATE_LEAVE       datetime,
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
                       LUP_NAME             char(255) not null,
                       LUP_SHORT_NAME       char(5) not null,
                       LUP_DATE_CREATION    datetime not null,
                       LUP_DATE_SUPPRESSION datetime,
                       LUP_ACTIVE           bool not null,
                       primary key (LUP_ID)
                    );
        ");

        $wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}LADP_T_MAPS_MAP
                    (
                       MAP_ID               int not null auto_increment,
                       MAP_GAM_ID           int not null,
                       MAP_NAME             char(100) not null,
                       MAP_PICK             char(255),
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
                       USER_ID_CREATOR      bigint(20) unsigned not null,
                       TEA_NAME             char(255) not null,
                       TEA_TAG              char(5) not null,
                       TEA_DATE_CREATION    datetime not null,
                       TEA_ACTIVE           bool not null,
                       TEA_SITE_URL         char(255),
                       TEA_LOGO_NAME        char(255),
                       primary key (TEA_ID)
                    );
        ");

        $wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}LADP_T_USER_MAT_COMMENTAIRE_UMC
                    (
                       UMC_ID               int not null auto_increment,
                       UMC_MAT_ID           int not null,
                       UMC_USER_ID          bigint(20) unsigned not null,
                       UMC_CREATE_DATE      datetime not null,
                       UMC_LAST_MODIF_DATE  datetime,
                       UMC_COMMENT_CONTENT  text not null,
                       UMC_ACTIVE           bool not null,
                       primary key (UMC_ID)
                    );
        ");
        
        $wpdb->query("
          alter table {$wpdb->prefix}LADP_TJ_GAM_MPA_GMP add constraint FK_J_GMP_GAM foreign key (GAM_ID)
                references {$wpdb->prefix}LADP_T_GAMES_GAM (GAM_ID) on delete restrict on update restrict;
        ");
        
        $wpdb->query("
          alter table {$wpdb->prefix}LADP_TJ_GAM_MPA_GMP add constraint FK_J_GMP_MPA foreign key (MPA_ID)
                references {$wpdb->prefix}LADP_T_MAP_PACKS_MPA (MPA_ID) on delete restrict on update restrict;
        ");
        
        $wpdb->query("
          alter table {$wpdb->prefix}LADP_TJ_GAM_TEA_GTE add constraint FK_J_GTE_GAM foreign key (GAM_ID)
                references {$wpdb->prefix}LADP_T_GAMES_GAM (GAM_ID) on delete restrict on update restrict;
        ");
        
        $wpdb->query("
          alter table {$wpdb->prefix}LADP_TJ_GAM_TEA_GTE add constraint FK_J_GTE_TEA foreign key (TEA_ID)
                references {$wpdb->prefix}LADP_T_TEAMS_TEA (TEA_ID) on delete restrict on update restrict;
        ");
        
        $wpdb->query("
          alter table {$wpdb->prefix}LADP_TJ_LAD_LUP_PARTICIPE_LLP add constraint FK_J_LLP_LAD foreign key (LAD_ID)
                references {$wpdb->prefix}LADP_T_LADDER_LAD (LAD_ID) on delete restrict on update restrict;
        ");
        
        $wpdb->query("
          alter table {$wpdb->prefix}LADP_TJ_LAD_LUP_PARTICIPE_LLP add constraint FK_J_LLP_LUP foreign key (LUP_ID)
                references {$wpdb->prefix}LADP_T_LINE_UP_LUP (LUP_ID) on delete restrict on update restrict;
        ");
        
        $wpdb->query("
          alter table {$wpdb->prefix}LADP_TJ_MPA_MAP_MMA add constraint FK_J_MMA_MAP foreign key (MAP_ID)
                references {$wpdb->prefix}LADP_T_MAPS_MAP (MAP_ID) on delete restrict on update restrict;
        ");
        
        $wpdb->query("
          alter table {$wpdb->prefix}LADP_TJ_MPA_MAP_MMA add constraint FK_J_MMA_MPA foreign key (MPA_ID)
                references {$wpdb->prefix}LADP_T_MAP_PACKS_MPA (MPA_ID) on delete restrict on update restrict;
        ");
        
        $wpdb->query("
          alter table {$wpdb->prefix}LADP_TJ_USER_GAM_UGA add constraint FK_J_JUS_JEU foreign key (UGA_GAM_ID)
                references {$wpdb->prefix}LADP_T_GAMES_GAM (GAM_ID) on delete restrict on update restrict;
        ");
        
        $wpdb->query("
          alter table {$wpdb->prefix}LADP_TJ_USER_GAM_UGA add constraint FK_J_JUS_USER foreign key (UGA_USER_ID)
                references {$wpdb->prefix}USERS (ID) on delete restrict on update restrict;
        ");
        
        $wpdb->query("
          alter table {$wpdb->prefix}LADP_TJ_USER_LUP_ULU add constraint FK_J_ULU_LUP foreign key (LUP_ID)
                references {$wpdb->prefix}LADP_T_LINE_UP_LUP (LUP_ID) on delete restrict on update restrict;
        ");
        
        $wpdb->query("
          alter table {$wpdb->prefix}LADP_TJ_USER_LUP_ULU add constraint FK_J_ULU_USER_UUS foreign key (ID)
                references {$wpdb->prefix}USERS (ID) on delete restrict on update restrict;
        ");
        
        $wpdb->query("
          alter table {$wpdb->prefix}LADP_TJ_USER_TEA_UTE add constraint FK_J_UTE_TEA foreign key (UTE_TEA_ID)
                references {$wpdb->prefix}LADP_T_TEAMS_TEA (TEA_ID) on delete restrict on update restrict;
        ");
        
        $wpdb->query("
          alter table {$wpdb->prefix}LADP_TJ_USER_TEA_UTE add constraint FK_J_UTE_USER foreign key (UTE_USER_ID)
                references {$wpdb->prefix}USERS (ID) on delete restrict on update restrict;
        ");
        
        $wpdb->query("
          alter table {$wpdb->prefix}LADP_T_LADDER_LAD add constraint FK_J_LAD_GAM foreign key (LAD_GAM_ID)
                references {$wpdb->prefix}LADP_T_GAMES_GAM (GAM_ID) on delete restrict on update restrict;
        ");
        
        $wpdb->query("
          alter table {$wpdb->prefix}LADP_T_LADDER_LAD add constraint FK_J_LAD_MPA foreign key (LAD_MPA_ID)
                references {$wpdb->prefix}LADP_T_MAP_PACKS_MPA (MPA_ID) on delete restrict on update restrict;
        ");
        
        $wpdb->query("
          alter table {$wpdb->prefix}LADP_T_LADDER_MATCH_LMA add constraint FK_H_LMA_MAC foreign key (MAT_ID)
                references {$wpdb->prefix}LADP_T_MATCHS_MAT (MAT_ID) on delete restrict on update restrict;
        ");
        
        $wpdb->query("
          alter table {$wpdb->prefix}LADP_T_LADDER_MATCH_LMA add constraint FK_J_LMA_LAD foreign key (LMA_LAD_ID)
                references {$wpdb->prefix}LADP_T_LADDER_LAD (LAD_ID) on delete restrict on update restrict;
        ");
        
        $wpdb->query("
          alter table {$wpdb->prefix}LADP_T_LAD_DAYS_POSSIBLE_LDP add constraint FK_J_LDP_LAD foreign key (LDP_LAD_ID)
                references {$wpdb->prefix}LADP_T_LADDER_LAD (LAD_ID) on delete restrict on update restrict;
        ");
        
        $wpdb->query("
          alter table {$wpdb->prefix}LADP_T_LINE_UP_LUP add constraint FK_J_LUP_GAM foreign key (LUP_GAM_ID)
                references {$wpdb->prefix}LADP_T_GAMES_GAM (GAM_ID) on delete restrict on update restrict;
        ");
        
        $wpdb->query("
          alter table {$wpdb->prefix}LADP_T_LINE_UP_LUP add constraint FK_J_LUP_TEA foreign key (LUP_TEA_ID)
                references {$wpdb->prefix}LADP_T_TEAMS_TEA (TEA_ID) on delete restrict on update restrict;
        ");
        
        $wpdb->query("
          alter table {$wpdb->prefix}LADP_T_MAPS_MAP add constraint FK_J_MAP_GAM foreign key (MAP_GAM_ID)
                references {$wpdb->prefix}LADP_T_GAMES_GAM (GAM_ID) on delete restrict on update restrict;
        ");
        
        $wpdb->query("
          alter table {$wpdb->prefix}LADP_T_MATCHS_MAT add constraint FK_J_MAC_LUP_CHALLENGED foreign key (MAT_CHALLENGED_ID)
                references {$wpdb->prefix}LADP_T_LINE_UP_LUP (LUP_ID) on delete restrict on update restrict;
        ");
        
        $wpdb->query("
          alter table {$wpdb->prefix}LADP_T_MATCHS_MAT add constraint FK_J_MAC_LUP_CHALLENGER foreign key (MAT_CHALLENGER_ID)
                references {$wpdb->prefix}LADP_T_LINE_UP_LUP (LUP_ID) on delete restrict on update restrict;
        ");
        
        $wpdb->query("
          alter table {$wpdb->prefix}LADP_T_PLAYED_MAP_PLM add constraint FK_J_PLM_MAC foreign key (PLM_MAT_ID)
                references {$wpdb->prefix}LADP_T_MATCHS_MAT (MAT_ID) on delete restrict on update restrict;
        ");
        
        $wpdb->query("
          alter table {$wpdb->prefix}LADP_T_PLAYED_MAP_PLM add constraint FK_J_PLM_MAP foreign key (PLM_MAP_ID)
                references {$wpdb->prefix}LADP_T_MAPS_MAP (MAP_ID) on delete restrict on update restrict;
        ");
        
        $wpdb->query("
          alter table {$wpdb->prefix}LADP_T_PROPOSE_DATE_PDA add constraint FK_J_PDA_MAC foreign key (PDA_MAT_ID)
                references {$wpdb->prefix}LADP_T_MATCHS_MAT (MAT_ID) on delete restrict on update restrict;
        ");
        
        $wpdb->query("
          alter table {$wpdb->prefix}LADP_T_PROPOSE_MAP_PMA add constraint FK_J_PMA_MAC foreign key (PMA_MAT_ID)
                references {$wpdb->prefix}LADP_T_MATCHS_MAT (MAT_ID) on delete restrict on update restrict;
        ");
        
        $wpdb->query("
          alter table {$wpdb->prefix}LADP_T_PROPOSE_MAP_PMA add constraint FK_J_PMA_MAP foreign key (PMA_MAP_ID)
                references {$wpdb->prefix}LADP_T_MAPS_MAP (MAP_ID) on delete restrict on update restrict;
        ");
        
        $wpdb->query("
          alter table {$wpdb->prefix}LADP_T_TEAMS_TEA add constraint FK_USER_TEA_CREATOR_UTC foreign key (USER_ID_CREATOR)
                references {$wpdb->prefix}USERS (ID) on delete restrict on update restrict;
        ");
        
        $wpdb->query("
          alter table {$wpdb->prefix}LADP_T_USER_MAT_COMMENTAIRE_UMC add constraint FK_J_UMC_MAC foreign key (UMC_MAT_ID)
                references {$wpdb->prefix}LADP_T_MATCHS_MAT (MAT_ID) on delete restrict on update restrict;
        ");
        
        $wpdb->query("
          alter table {$wpdb->prefix}LADP_T_USER_MAT_COMMENTAIRE_UMC add constraint FK_J_UMC_USER foreign key (UMC_USER_ID)
                references {$wpdb->prefix}USERS (ID) on delete restrict on update restrict;
        ");
    }

}
