<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class GamesAdministration
{ 
    function addMenuGames() {
        add_menu_page('Games menu', 'Games', 'manage_options', 'Ladder-Press', array($this, 'menuGames'));
    }
    
    function menuGames()
    {
        echo 'COUCOU !';
    }
    
}
