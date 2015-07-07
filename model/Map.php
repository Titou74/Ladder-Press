<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Map
{
    private $id;
    private $gameId;
    private $name;
    private $pick;
    
    function __construct() {
        
    }
    
    public function getId() {
        return $this->id;
    }

    public function getGameId() {
        return $this->gameId;
    }

    public function getName() {
        return $this->name;
    }

    public function getPick() {
        return $this->pick;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setGameId($gameId) {
        $this->gameId = $gameId;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setPick($pick) {
        $this->pick = $pick;
    }
    
    private function instancierMap($mapArray = null) {
        $map = new Map();
        if($mapArray != null) {
            $map->setId($mapArray['MAP_ID']);
            $map->setGameId($mapArray['MAP_GAM_ID']);
            $map->setName($mapArray['MAP_NAME']);
            $map->setPick($mapArray['MAP_PICK']);
        }
        return $map;
    }

    public function getAllMaps() {
        // Execution requête
        global $wpdb;
        $result = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}ladp_t_maps_map", ARRAY_A);
        
        // Initialisation tableau retour
        $maps = array();
        // Instanciation des objects "Game"
        foreach ($result as $value){
            $maps[] = self::instancierMap($value);
        }
        return $maps;
    }
    
    public function getMapById($id)
    {
        global $wpdb;
        $result = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}ladp_t_maps_map WHERE MAP_ID = $id", ARRAY_A);
        $map = self::instancierMap($result);
        
        return $map;
    }
    
    public function updateMap($map) {
        global $wpdb;
        $wpdb->update( "{$wpdb->prefix}ladp_t_maps_map", array( 
		'map_name' => $map->getName(),
		'map_gam_id' => $map->getGameId(),
                'map_pick' => $map->getPick()
            ), 
        array( 'map_id' => $map->getId() ) );
    }
    
    public function createMap($map) {
        global $wpdb;
        $wpdb->insert( "{$wpdb->prefix}ladp_t_maps_map", array( 
		'map_name' => $map->getName(),
		'map_gam_id' => $map->getGameId(),
                'map_pick' => $map->getPick()
            ) 
       );
    }
    
    public function deleteMap($mapId) {
        global $wpdb;
        $wpdb->delete( "{$wpdb->prefix}ladp_t_maps_map", array( 'map_id' => $mapId ) );
    }
    
}
