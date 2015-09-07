<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Teams
 *
 * @author Titou74 <titou.c.74@gmail.com>
 */
class Teams {
    public function teamsMenu() {
        
        if(!isset($_GET['page'])) {
            // Teams liste
            $allTeams = Team::getAllTeams();
            
            include_once plugin_dir_path( __FILE__ ).'../view/template/teamList.php';
        } else if($_GET['page'] == "details" && isset($_GET['teamId'])) {
            // Team details
            $team = Team::getTeamById($_GET['teamId']);
            
            include_once plugin_dir_path( __FILE__ ).'../view/template/teamDetails.php';
        }
        
    }
}
