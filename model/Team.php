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
        $team = null;
        if($teamArray != null) {
            $team = new Team();
            
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
    
    public function getAllTeams() {
        // Execution requête
        global $wpdb;
        $result = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}ladp_t_teams_tea WHERE TEA_ACTIVE", ARRAY_A);
        
        // Initialisation tableau retour
        $teams = array();
        // Instanciation des objects "Game"
        foreach ($result as $value){
            $teams[] = self::instancierTeam($value);
        }
        return $teams;
    }
    
    public function createTeam($team) {
        global $wpdb;
        $wpdb->insert( "{$wpdb->prefix}ladp_t_teams_tea", 
            array( 
                'user_id_creator' => stripslashes_deep($team->getIdCreator()),
		'tea_name' => stripslashes_deep($team->getName()),
		'tea_tag' => stripslashes_deep($team->getTag()),
                'tea_date_creation' => stripslashes_deep($team->getDateCrea()),
                'tea_active' => stripslashes_deep($team->getActive()),
                'tea_site_url' => stripslashes_deep($team->getSite()),
                'tea_logo_name' => stripslashes_deep($team->getLogoName())
            ),
            array( 
                    '%d',
                    '%s',
                    '%s',
                    '%s',
                    '%d',
                    '%s',
                    '%s'
            )
        );
        $team->setId($wpdb->insert_id);
    }
    
    public function updateTeam($team) {
        global $wpdb;
        $wpdb->update( "{$wpdb->prefix}ladp_t_teams_tea", 
            array( 
                'user_id_creator' => stripslashes_deep($team->getIdCreator()),
		'tea_name' => stripslashes_deep($team->getName()),
		'tea_tag' => stripslashes_deep($team->getTag()),
                'tea_date_creation' => stripslashes_deep($team->getDateCrea()),
                'tea_active' => stripslashes_deep($team->getActive()),
                'tea_site_url' => stripslashes_deep($team->getSite()),
                'tea_logo_name' => stripslashes_deep($team->getLogoName())
            ),
            array( 'tea_id' => stripslashes_deep($team->getId()) ),
            array( 
                    '%d',
                    '%s',
                    '%s',
                    '%s',
                    '%d',
                    '%s',
                    '%s'
            )
        );
    }
    
    public function getTeamById($id)
    {
        global $wpdb;
        $result = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}ladp_t_teams_tea WHERE TEA_ID = $id", ARRAY_A);
        $team = self::instancierTeam($result);
        
        return $team;
    }
    
    public function deleteTeam($teamId) {
        $deleteTeam = self::getTeamById($teamId);
        $deleteTeam->setActive(false);
        self::updateTeam($deleteTeam);
    }
    
    public function getCurrentPlayerTeam($idUser) {
        global $wpdb;
        $result = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}ladp_t_teams_tea
            JOIN {$wpdb->prefix}ladp_tj_user_tea_ute ON {$wpdb->prefix}ladp_t_teams_tea.TEA_ID = {$wpdb->prefix}ladp_tj_user_tea_ute.UTE_TEA_ID
            WHERE {$wpdb->prefix}ladp_tj_user_tea_ute.UTE_USER_ID = $idUser
            AND {$wpdb->prefix}ladp_tj_user_tea_ute.UTE_DATE_LEAVE IS NULL
            AND {$wpdb->prefix}ladp_tj_user_tea_ute.UTE_TEAM_ACCEPT = 1
            AND {$wpdb->prefix}ladp_tj_user_tea_ute.UTE_USER_ACCEPT = 1", ARRAY_A);
        $team = self::instancierTeam($result);
        
        return $team;
    }
    
    public function getInvitationPlayerNonRepondu($idUser) {
        global $wpdb;
        $result = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}ladp_t_teams_tea
            JOIN {$wpdb->prefix}ladp_tj_user_tea_ute ON {$wpdb->prefix}ladp_t_teams_tea.TEA_ID = {$wpdb->prefix}ladp_tj_user_tea_ute.UTE_TEA_ID
            WHERE {$wpdb->prefix}ladp_tj_user_tea_ute.UTE_USER_ID = $idUser
            AND {$wpdb->prefix}ladp_tj_user_tea_ute.UTE_DATE_LEAVE IS NULL
            AND {$wpdb->prefix}ladp_tj_user_tea_ute.UTE_TEAM_ACCEPT = 1
            AND {$wpdb->prefix}ladp_tj_user_tea_ute.UTE_USER_ACCEPT IS NULL", ARRAY_A);
        $teams = array();
        // Instanciation des objects "Game"
        foreach ($result as $value){
            $teams[] = self::instancierTeam($value);
        }
        return $teams;
    }
                
    public function getDemandePlayerNonRepondu($idUser) {
        global $wpdb;
        $result = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}ladp_t_teams_tea
            JOIN {$wpdb->prefix}ladp_tj_user_tea_ute ON {$wpdb->prefix}ladp_t_teams_tea.TEA_ID = {$wpdb->prefix}ladp_tj_user_tea_ute.UTE_TEA_ID
            WHERE {$wpdb->prefix}ladp_tj_user_tea_ute.UTE_USER_ID = $idUser
            AND {$wpdb->prefix}ladp_tj_user_tea_ute.UTE_DATE_LEAVE IS NULL
            AND {$wpdb->prefix}ladp_tj_user_tea_ute.UTE_TEAM_ACCEPT IS NULL
            AND {$wpdb->prefix}ladp_tj_user_tea_ute.UTE_USER_ACCEPT = 1", ARRAY_A);
        
        $teams = array();
        // Instanciation des objects "Game"
        foreach ($result as $value){
            $teams[] = self::instancierTeam($value);
        }
        return $teams;
    }
}