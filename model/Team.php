<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Team
{

    private $id;
    private $idCreator;
    private $name;
    private $tag;
    private $dateCrea;
    private $active;
    private $site;
    private $logoName;
    
    public function __construct() {
        add_shortcode('test', array($this, 'teamHtml'));
    }
    
    public function getId() {
        return $this->id;
    }

    public function getIdCreator() {
        return $this->idCreator;
    }

    public function getName() {
        return $this->name;
    }

    public function getTag() {
        return $this->tag;
    }

    public function getDateCrea() {
        return $this->dateCrea;
    }

    public function getActive() {
        return $this->active;
    }

    public function getSite() {
        return $this->site;
    }

    public function getLogoName() {
        return $this->logoName;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setIdCreator($idCreator) {
        $this->idCreator = $idCreator;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setTag($tag) {
        $this->tag = $tag;
    }

    public function setDateCrea($dateCrea) {
        $this->dateCrea = $dateCrea;
    }

    public function setActive($active) {
        $this->active = $active;
    }

    public function setSite($site) {
        $this->site = $site;
    }

    public function setLogoName($logoName) {
        $this->logoName = $logoName;
    }
    
    private function instancierTeam($teamArray = null) {
        $team = new Team();
        if($teamArray != null) {
            $team->setId($teamArray['TEA_ID']);
            $team->setIdCreator($teamArray['USER_ID_CREATOR']);
            $team->setName($teamArray['TEA_NAME']);
            $team->setTag($teamArray['TEA_TAG']);
            $team->setDateCrea($teamArray['TEA_DATE_CREATION']);
            $team->setActive($teamArray['TEA_ACTIVE']);
            $team->setSite($teamArray['TEA_SITE_URL']);
            $team->setLogoName($teamArray['TEA_LOGO_NAME']);
        }
        return $team;
    }
    
    public function getAllMaps() {
        // Execution requête
        global $wpdb;
        $result = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}ladp_t_teams_tea", ARRAY_A);
        
        // Initialisation tableau retour
        $maps = array();
        // Instanciation des objects "Game"
        foreach ($result as $value){
            $maps[] = self::instancierTeam($value);
        }
        return $maps;
    }
    
}