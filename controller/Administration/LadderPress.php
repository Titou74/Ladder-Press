<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LadderPressAdministration
 *
 * @author Titou
 */
class LadderPressAdministration {
    
    public function addLadderPressMenu() {
        if(!is_admin()) return;
        
        // Add Ladder-Press main menu
        add_menu_page('Ladder Press Home Admin Page', 'Ladder-Press', 'manage_options', 'ladder_press', array('LadderPressAdministration', 'ladderPressMenu'));

        // Add Ladder-Press sub menu
        add_submenu_page('ladder_press', 'Games', 'Games', 'manage_options', 'ladder_press_games', array('GamesAdministration', 'listGamesMenu'));
        add_submenu_page('ladder_press', 'Maps', 'Maps', 'manage_options', 'ladder_press_maps', array('MapsAdministration', 'listMapsMenu'));
        
    }
    
    public function ladderPressMenu()
    {
        echo '<h1>'.get_admin_page_title().'</h1>';
    }
}
