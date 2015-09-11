<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Users
 *
 * @author Titou
 */
class Users {
    
    public function __construct()
    {
        // Include models
        include_once $GLOBALS['ladder_press_dir_path'].'/model/Team.php';
        include_once $GLOBALS['ladder_press_dir_path'].'/model/Game.php';
        include_once $GLOBALS['ladder_press_dir_path'].'/model/utils/UserTeam.php';
        
        // Form traitment
        if (isset($_POST['submit'])) {
            if(isset($_POST['ladder_press_join_team_id']))
            {
                self::processRequestJoinTeam();
            }
        }
        // Display traitment
        if(isset($_GET['page'])) {
            switch ($_GET['page']) {
                case "user_menu":
                    self::displayUserMenu();
                    break;
                default:
                    self::displayUserMenu();
                    break;
            }
        } else {
            self::displayUserMenu();
        }
    }
    
    private function displayUserMenu() {
        if(get_current_user_id() != 0) {
            $userGuid = null;
                
            $userTeam = Team::getCurrentPlayerTeam(get_current_user_id());

            $userTeamInvitation = Team::getInvitationPlayerNonRepondu(get_current_user_id());

            $userTeamDemande = Team::getDemandePlayerNonRepondu(get_current_user_id());

            $userHistorique = self::genererUserHistorique();

            include_once $GLOBALS['ladder_press_dir_path'].'/view/template/userMenu.php';
        } else {
            echo "Vous devez être connecter pour accéder au module joueur";
        }
    }
    
    private function genererUserHistorique() {
        return null;
    }
    
    private function processRequestJoinTeam()
    {
        if(get_current_user_id() != 0) {
            $userTeam = new UserTeam();
            $userTeam->setTeamId($_POST['ladder_press_join_team_id']);
            $userTeam->setUserId(get_current_user_id());
            $userTeam->setRequestDate(date("Y-m-d H:i:s"));
            $userTeam->setTeamAccept(0);
            $userTeam->setUserAccept(true);
            $userTeam->setAcceptDate(null);
            $userTeam->setLeaveDate(null);
            UserTeam::createUserTeam($userTeam);
        }
    }
}
