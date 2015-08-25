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
        add_submenu_page('ladder_press', 'Games', 'Games', 'manage_options', 'ladder_press_games', array('GamesAdministration', 'gamesMenu'));
        add_submenu_page('ladder_press', 'Maps', 'Maps', 'manage_options', 'ladder_press_maps', array('MapsAdministration', 'mapsMenu'));
        add_submenu_page('ladder_press', 'Map packs', 'Map packs', 'manage_options', 'ladder_press_m_packs', array('MPacksAdministration', 'mPacksMenu'));
        add_submenu_page('ladder_press', 'Teams', 'Teams', 'manage_options', 'ladder_press_teams', array('TeamsAdministration', 'TeamsMenu'));
        
        // Add new pages in administration
        add_options_page('ladder press','Line up','manage_options', 'ladder_press_linesup', array('LinesUpAdministration', 'linesUpMenu'));
        
    }
    
    public function ladderPressMenu()
    {
        echo '<h1>'.get_admin_page_title().'</h1>';
    }
    
    public function register_settings()

    {
        register_setting('ladder_press_settings', 'zero_newsletter_sender');
    }
}
