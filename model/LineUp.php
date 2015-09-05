<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class LineUp
{
    private $id;
    private $teamId;
    private $gameId;
    private $name;
    private $shortName;
    private $dateCreation;
    private $dateSuppression;
    private $active;
    
    function __construct() {
        
    }
    
    public function getId() {
        return $this->id;
    }

    public function getTeamId() {
        return $this->teamId;
    }

    public function getGameId() {
        return $this->gameId;
    }

    public function getName() {
        return $this->name;
    }

    public function getShortName() {
        return $this->shortName;
    }

    public function getDateCreation() {
        return $this->dateCreation;
    }

    public function getDateSuppression() {
        return $this->dateSuppression;
    }

    public function getActive() {
        return $this->active;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setTeamId($teamId) {
        $this->teamId = $teamId;
    }

    public function setGameId($gameId) {
        $this->gameId = $gameId;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setShortName($shortName) {
        $this->shortName = $shortName;
    }

    public function setDateCreation($dateCreation) {
        $this->dateCreation = $dateCreation;
    }

    public function setDateSuppression($dateSuppression) {
        $this->dateSuppression = $dateSuppression;
    }

    public function setActive($active) {
        $this->active = $active;
    }

    private function instancierLineUp($lineUpArray = null) {
        $lineUp = new LineUp();
        if($lineUpArray != null) {
            $lineUp->setId($lineUpArray['LUP_ID']);
            $lineUp->setTeamId($lineUpArray['LUP_TEA_ID']);
            $lineUp->setGameId($lineUpArray['LUP_GAM_ID']);
            $lineUp->setName($lineUpArray['LUP_NAME']);
            $lineUp->setShortname($lineUpArray['LUP_SHORT_NAME']);
            $lineUp->setDateCreation($lineUpArray['LUP_DATE_CREATION']);
            $lineUp->setDateSuppression($lineUpArray['LUP_DATE_SUPPRESSION']);
            $lineUp->setActive($lineUpArray['LUP_ACTIVE'] ? true : false);
        }
        return $lineUp;
    }
    
    public function getAllLinesUp() {
        // Execution requête
        global $wpdb;
        $result = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}ladp_t_line_up_lup", ARRAY_A);
        
        // Initialisation tableau retour
        $linesUp = array();
        
        // Instanciation des objects "Game"
        foreach ($result as $value){
            $linesUp[] = self::instancierLineUp($value);
        }
        
        return $linesUp;
    }
    
    public function getLineUpById($id)
    {
        global $wpdb;
        $result = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}ladp_t_line_up_lup WHERE LUP_ID = $id", ARRAY_A);
        $LUP = self::instancierLineUp($result);
        
        return $LUP;
    }


    public function getLinesUpByTeamId($idTeam)
    {
        global $wpdb;
        $LUPs=array();
        $result = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}ladp_t_line_up_lup WHERE LUP_TEA_ID = $idTeam", ARRAY_A);
        foreach ($result as $value){
            $LUPs[] = self::getLineUpById($value['LUP_ID']);
        }
        return $LUPs;
    }
    
    public function createLineUp($LUP) {
        global $wpdb;
        $wpdb->insert( "{$wpdb->prefix}ladp_t_line_up_lup", 
            array( 
                'lup_tea_id' => stripslashes_deep($LUP->getTeamId()),
                'lup_gam_id' => stripslashes_deep($LUP->getGameId()),
                'lup_name' => stripslashes_deep($LUP->getName()),
                'lup_short_name' => stripslashes_deep($LUP->getShortName()),
                'lup_date_creation' => stripslashes_deep($LUP->getDateCreation()),
                'lup_active' => stripslashes_deep($LUP->getActive())
            ),
            array( 
                    '%d',
                    '%d',
                    '%s',
                    '%s',
                    '%s',
                    '%d'
            )
        );
    }
    
    public function updateLineUp($LUP)
    {
        global $wpdb;
        $wpdb->update("{$wpdb->prefix}ladp_t_line_up_lup", 
            array( 
                'lup_tea_id' => stripslashes_deep($LUP->getTeamId()),
                'lup_gam_id' => stripslashes_deep($LUP->getGameId()),
                'lup_name' => stripslashes_deep($LUP->getName()),
                'lup_short_name' => stripslashes_deep($LUP->getShortName()),
                'lup_date_creation' => stripslashes_deep($LUP->getDateCreation()),
                'lup_active' => stripslashes_deep($LUP->getActive())
            ), 
            array( 'lup_id' => $LUP->getId() ),
            array(
                    '%d',
                    '%d',
                    '%s',
                    '%s',
                    '%s',
                    '%d'
            )  
        );
    }
    
    public function deleteLineUp($id)
    {
        global $wpdb;
        $wpdb->delete( "{$wpdb->prefix}ladp_t_line_up_lup", array( 'lup_id' => $id ) );
    }
    
}