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
        $GLOBALS['ladder_press_dir_path'] = plugin_dir_path( __FILE__ );
        
        register_activation_hook(__FILE__, array('LadderPress', 'install'));
        register_deactivation_hook(__FILE__, array('LadderPress', 'uninstall')); //ONLY FOR DEVELOPMENT
        register_uninstall_hook(__FILE__, array('LadderPress', 'uninstall'));
        
        if( is_admin()) {
            include_once $GLOBALS['ladder_press_dir_path'].'/controller/Administration/LadderPress.php';

            add_action('admin_menu', array('LadderPressAdministration', 'addLadderPressMenu'), 20);
            add_action('admin_init', array('LadderPressAdministration', 'register_settings'));
        }
        
        include_once $GLOBALS['ladder_press_dir_path'].'/controller/LadderPressController.php';
        
        add_shortcode('ladder_press', array('LadderPressController', 'includeController'));
    }
    
    public static function install() {
        include_once $GLOBALS['ladder_press_dir_path'].'/install/Install.php';
        Install::install();
    }
    
    public static function uninstall() {
        include_once $GLOBALS['ladder_press_dir_path'].'/install/Uninstall.php';
        Uninstall::uninstall();
    }
    
}

function ladderPressIncludeExternalLibraries() {
    wp_register_script( 'DataTables-script', plugins_url( '/lib/DataTables/DataTables-1.10.9/media/js/jquery.dataTables.js', __FILE__ ), array( 'jquery' ) );

    wp_register_style( 'dataTables-style', plugins_url( '/lib/DataTables/DataTables-1.10.9/media/css/jquery.dataTables.css', __FILE__ ) );
    
    
    wp_enqueue_script( 'DataTables-script' );
    wp_enqueue_style( 'dataTables-style' );
    
}
add_action( 'wp_enqueue_scripts', 'ladderPressIncludeExternalLibraries' );

new LadderPress();