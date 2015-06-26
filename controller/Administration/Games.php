<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class GamesAdministration
{ 
    public function gamesMenu()
    {
        $allGames = Game::getAllGames();
        
        include_once plugin_dir_path( __FILE__ ).'../../view/template/administration/listGames.php';
    }
}
