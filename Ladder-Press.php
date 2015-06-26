<?php
/**
 * Plugin Name: Ladder-Press
 * Plugin URI: https://github.com/Titou74/Ladder-Press
 * Description: Online ladder plugin for Wordpress
 * Version: 0.1
 * Author: Titouan Choron, Thibaut t****
 * License: GPLv2 or later
 * Copyright 2015-2015  
 *                      Titouan Choron  (email : titou.c.74@gmail.com)
 *                      Thibaut Dupuy   (email : t*****@gmail.com)
 * 
*/
class LadderPress
{
    public function __construct()
    {
        register_activation_hook(__FILE__, array('LadderPress', 'install'));
        register_deactivation_hook(__FILE__, array('LadderPress', 'uninstall')); //ONLY FOR DEVELOPMENT
        register_uninstall_hook(__FILE__, array('LadderPress', 'uninstall'));
        
        include_once plugin_dir_path( __FILE__ ).'/model/Team.php';
        new Team();
        
        include_once plugin_dir_path( __FILE__ ).'/model/Game.php';
        new Game();
        
        include_once plugin_dir_path( __FILE__ ).'/model/Ladder.php';
        new Ladder();
        
        include_once plugin_dir_path( __FILE__ ).'/model/Match.php';
        new Match();
        
        include_once plugin_dir_path( __FILE__ ).'/model/Map.php';
        new Map();
        
        include_once plugin_dir_path( __FILE__ ).'/model/MapPack.php';
        new MapPack();
        
    }
    
    public static function install() {
        include_once plugin_dir_path( __FILE__ ).'/install/Install.php';
        Install::install();
    }
    
    public static function uninstall() {
        include_once plugin_dir_path( __FILE__ ).'/install/Uninstall.php';
        Uninstall::uninstall();
    }
}

new LadderPress();