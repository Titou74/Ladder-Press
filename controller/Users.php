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
        
        // Form traitment
        if (isset($_POST['submit'])) {
            
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
}
