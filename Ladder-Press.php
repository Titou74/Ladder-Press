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
        include_once plugin_dir_path( __FILE__ ).'/Team.php';
        new Team();
    }
}

new LadderPress();