<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Game
{ 
    private $id;
    private $name;
    private $shortname;
    private $activeGuid;
    private $guidRegex;
    
    public function __construct() {
       
    } 
    
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getShortname() {
        return $this->shortname;
    }

    public function getActiveGuid() {
        return $this->activeGuid;
    }

    public function getGuidRegex() {
        return $this->guidRegex;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setShortname($shortname) {
        $this->shortname = $shortname;
    }

    public function setActiveGuid($activeGuid) {
        $this->activeGuid = $activeGuid;
    }

    public function setGuidRegex($guidRegex) {
        $this->guidRegex = $guidRegex;
    }
    
    private function instancierGame($gameArray = null) {
        $game = new Game();
        if($gameArray != null) {
            $game->setId($gameArray['GAM_ID']);
            $game->setName($gameArray['GAM_NAME']);
            $game->setShortname($gameArray['GAM_SHORT_NAME']);
            $game->setActiveGuid($gameArray['GAM_ACTIVE_GUID'] == 1 ? true : false);
            $game->setGuidRegex($gameArray['GAM_GUID_REGEX']);
        }
        return $game;
    }
    
    public function getAllGames() {
        // Execution requête
        global $wpdb;
        $result = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}ladp_t_games_gam", ARRAY_A);
        
        // Initialisation tableau retour
        $games = array();
        
        // Instanciation des objects "Game"
        foreach ($result as $value){
            $games[] = self::instancierGame($value);
        }
        
        return $games;
    }
    
    public function getGameById($id)
    {
        global $wpdb;
        $result = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}ladp_t_games_gam WHERE GAM_ID = $id", ARRAY_A);
        $game = self::instancierGame($result);
        
        return $game;
    }
    
    public function createGame($game) {
        global $wpdb;
        $wpdb->insert( "{$wpdb->prefix}ladp_t_games_gam", array( 
		'gam_name' => $game->getName(),
		'gam_short_name' => $game->getShortName(),
                'gam_active_guid' => $game->getActiveGuid(),
                'gam_guid_regex' => $game->getGuidRegex()
            )
        );
    }
    
    public function updateGame($game) {
        global $wpdb;
        $wpdb->update( "{$wpdb->prefix}ladp_t_games_gam", array( 
		'gam_name' => $game->getName(),
		'gam_short_name' => $game->getShortName(),
                'gam_active_guid' => $game->getActiveGuid(),
                'gam_guid_regex' => $game->getGuidRegex()
            ), 
        array( 'gam_id' => $game->getId() ) );
    }
    
    public function deleteGame($gameId) {
        global $wpdb;
        $wpdb->delete( "{$wpdb->prefix}ladp_t_games_gam", array( 'gam_id' => $gameId ) );
    }
}
