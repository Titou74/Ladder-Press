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
    
    public function getAllMapPacks() {
        // Execution requête
        global $wpdb;
        $result = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}ladp_t_map_packs_mpa", ARRAY_A);
        
        // Initialisation tableau retour
        $mPacks = array();
        // Instanciation des objects "Game"
        foreach ($result as $value){
            $mPacks[] = self::instancierMap($value);
        }
        return $mPacks;
    }

}