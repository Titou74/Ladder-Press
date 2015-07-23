<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class MapPack
{
    private $id;
    private $name;
    
    function __construct()
    {
        
    }
    
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }
    
    private function instancierMapPack($mPackArray = null) {
        $mPack = new MapPack();
        if($mPack != null) {
            $mPack->setId($mPackArray['MPA_ID']);
            $mPack->setName($mPackArray['MPA_NAME']);
        }
        return $mPack;
    }
    
    public function getAllMapPacks() {
        // Execution requête
        global $wpdb;
        $result = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}ladp_t_map_packs_mpa", ARRAY_A);
        
        // Initialisation tableau retour
        $mPacks = array();
        // Instanciation des objects "Game"
        foreach ($result as $value){
            $mPacks[] = self::instancierMapPack($value);
        }
        return $mPacks;
    }
    
    public function createMapPack($mPack) {
        global $wpdb;
        $wpdb->insert( "{$wpdb->prefix}ladp_t_map_packs_mpa", array( 
		'mpa_name' => $mPack->getName()
            )      
       );
       return $wpdb->insert_id;
    }
    
    public function getMapPackById($id)
    {
        global $wpdb;
        $result = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}ladp_t_map_packs_mpa WHERE MPA_ID = $id", ARRAY_A);
        $mPack = self::instancierMapPack($result);
        
        return $mPack;
    }
    
    /**
     * Ajoute une ou plusieurs maps à un map pack
     * 
     * @global type $wpdb db handler
     * @param Map $maps la ou les maps à ajouter au map pack
     * @param MapPack $mPack map pack dans lequel on doit ajouter les maps
     */
    public function addMapsInMapPack($maps,$mPack)
    {
        global $wpdb;
        foreach ($maps as $map)
        {
            $wpdb->insert("{$wpdb->prefix}ladp_tj_mpa_map_mma", array(
                'map_id' => $map->getId(),
                'mpa_id' => $mPack->getId()
                )
            );
        }
    }
    
    public function updateMapPack($mPack) {
        global $wpdb;
        $wpdb->update( "{$wpdb->prefix}ladp_t_map_packs_mpa", 
            array( 
		'MPA_NAME' => stripslashes_deep($mPack->getName())
            ), 
            array( 'MPA_ID' => stripslashes_deep($mPack->getId()) ),
            array( 
                    '%s'
            ) 
        );
    }
    
    public function deleteMapsInMapPack($idMPack)
    {
        global $wpdb;
        $wpdb->delete( "{$wpdb->prefix}ladp_tj_mpa_map_mma", array( 'mpa_id' => $idMPack ) );
    }
    
    public function deleteMapPack($idMPack)
    {
        global $wpdb;
        $wpdb->delete( "{$wpdb->prefix}ladp_tj_mpa_map_mma", array( 'mpa_id' => $idMPack ) );
        $wpdb->delete( "{$wpdb->prefix}ladp_t_map_packs_mpa", array( 'mpa_id' => $idMPack ) );
    }

}