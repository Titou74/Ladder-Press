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
        
        include_once plugin_dir_path( __FILE__ ).'../../model/Team.php';
        include_once plugin_dir_path( __FILE__ ).'../../model/Game.php';
        include_once plugin_dir_path( __FILE__ ).'../../model/Ladder.php';
        include_once plugin_dir_path( __FILE__ ).'../../model/Match.php';
        include_once plugin_dir_path( __FILE__ ).'../../model/Map.php';
        include_once plugin_dir_path( __FILE__ ).'../../model/MapPack.php';
        include_once plugin_dir_path( __FILE__ ).'../../model/MapPack.php';
        include_once plugin_dir_path( __FILE__ ).'../../model/LineUp.php';
        include_once plugin_dir_path( __FILE__ ).'../../model/LineUp.php';
        include_once plugin_dir_path( __FILE__ ).'../../model/ProposeDate.php';
        include_once plugin_dir_path( __FILE__ ).'../../model/ProposeMap.php';
        include_once plugin_dir_path( __FILE__ ).'../../model/UserMatchCom.php';
        include_once plugin_dir_path( __FILE__ ).'../../model/utils/UserGame.php';
        include_once plugin_dir_path( __FILE__ ).'../../model/utils/UserTeam.php';

        include_once plugin_dir_path( __FILE__ ).'../../controller/Administration/Games.php';
        include_once plugin_dir_path( __FILE__ ).'../../controller/Administration/Maps.php';
        include_once plugin_dir_path( __FILE__ ).'../../controller/Administration/MapPacks.php';
        include_once plugin_dir_path( __FILE__ ).'../../controller/Administration/Teams.php';
        include_once plugin_dir_path( __FILE__ ).'../../controller/Administration/LinesUp.php';
        
        // Add Ladder-Press main menu
        add_menu_page('Ladder Press Home Admin Page', 'Ladder-Press', 'manage_options', 'ladder_press', array('LadderPressAdministration', 'ladderPressMenu'));

        // Add Ladder-Press sub menu
        add_submenu_page('ladder_press', 'Games', 'Games', 'manage_options', 'ladder_press_games', array('GamesAdministration', 'gamesMenu'));
        add_submenu_page('ladder_press', 'Maps', 'Maps', 'manage_options', 'ladder_press_maps', array('MapsAdministration', 'mapsMenu'));
        add_submenu_page('ladder_press', 'Map packs', 'Map packs', 'manage_options', 'ladder_press_m_packs', array('MPacksAdministration', 'mPacksMenu'));
        add_submenu_page('ladder_press', 'Teams', 'Teams', 'manage_options', 'ladder_press_teams', array('TeamsAdministration', 'TeamsMenu'));
        add_submenu_page(null,'Line up','Lines up','manage_options', 'ladder_press_teams_linesup', array('LinesUpAdministration', 'linesUpMenu'));
        
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
