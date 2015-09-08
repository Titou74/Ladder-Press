<?php
/**
 * Plugin Name: Ladder-Press
 * Plugin URI: https://github.com/Titou74/Ladder-Press
 * Description: Online ladder plugin for Wordpress
 * Version: 0.1
 * Author: Titouan Choron, Thibaut Dupuy
 * License: GPLv2 or later
 * Copyright 2015-2015  
 *                      Titouan Choron  (email : titou.c.74@gmail.com)
 *                      Thibaut Dupuy   (email : tdupuy53@gmail.com)
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
        
        include_once plugin_dir_path( __FILE__ ).'/model/Game.php';
        
        include_once plugin_dir_path( __FILE__ ).'/model/Ladder.php';
        
        include_once plugin_dir_path( __FILE__ ).'/model/Match.php';
        
        include_once plugin_dir_path( __FILE__ ).'/model/Map.php';
        
        include_once plugin_dir_path( __FILE__ ).'/model/MapPack.php';
        
        include_once plugin_dir_path( __FILE__ ).'/model/MapPack.php';
        
        include_once plugin_dir_path( __FILE__ ).'/model/LineUp.php';
        
        include_once plugin_dir_path( __FILE__ ).'/model/LineUp.php';
        
        include_once plugin_dir_path( __FILE__ ).'/model/ProposeDate.php';
        
        include_once plugin_dir_path( __FILE__ ).'/model/ProposeMap.php';
        
        include_once plugin_dir_path( __FILE__ ).'/model/UserMatchCom.php';
        
        include_once plugin_dir_path( __FILE__ ).'/model/utils/UserGame.php';
        
        include_once plugin_dir_path( __FILE__ ).'/model/utils/UserTeam.php';
        
        if( is_admin()) {
            include_once plugin_dir_path( __FILE__ ).'/controller/Administration/Games.php';
            include_once plugin_dir_path( __FILE__ ).'/controller/Administration/Maps.php';
            include_once plugin_dir_path( __FILE__ ).'/controller/Administration/LadderPress.php';
            include_once plugin_dir_path( __FILE__ ).'/controller/Administration/MapPacks.php';
            include_once plugin_dir_path( __FILE__ ).'/controller/Administration/Teams.php';
            include_once plugin_dir_path( __FILE__ ).'/controller/Administration/LinesUp.php';

            add_action('admin_menu', array('LadderPressAdministration', 'addLadderPressMenu'), 20);
            add_action('admin_init', array('LadderPressAdministration', 'register_settings'));
        }
        
        include_once plugin_dir_path( __FILE__ ).'/controller/Users.php';
        include_once plugin_dir_path( __FILE__ ).'/controller/Teams.php';
        
        add_shortcode('ladder_press_user_menu', array('Users', 'userMenu'));
        add_shortcode('ladder_press_team', array('Teams', 'teamsMenu'));
        
        $pages = get_pages();
        foreach($pages as $page)
        {
            if(has_shortcode($page->post_content,'ladder_press_user_menu'))
                $page_user_menu = $page->guid;
            if(has_shortcode($page->post_content,'ladder_press_team'))
                $page_team = $page->guid;
        }
        define('PAGE_TEAM', $page_team);
        define('PAGE_USER_MENU', $page_user_menu);
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