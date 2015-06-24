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
        
        $wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}T_TEAMS_TEA
                    (
                       TEA_ID               bigint not null,
                       USER_ID_CREATOR      bigint not null,
                       TEA_NAME             char(255),
                       TEA_TAG              char(5),
                       TEA_DATE_CREATION    datetime,
                       TEA_ACTIVE           bool,
                       TEA_SITE_URL         char(255),
                       TEA_LOGO_NAME        char(255),
                       primary key (TEA_ID)
                    );");
    }
}
