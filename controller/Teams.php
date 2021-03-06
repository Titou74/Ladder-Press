<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Teams
 *
 * @author Titou74 <titou.c.74@gmail.com>
 */
class Teams {
    
    public function __construct()
    {
        // Include models
        include_once $GLOBALS['ladder_press_dir_path'].'/model/Team.php';
        include_once $GLOBALS['ladder_press_dir_path'].'/model/User.php';
        include_once $GLOBALS['ladder_press_dir_path'].'/model/utils/UserTeam.php';
        // Form traitment
        if (isset($_POST['submit'])) {
            if(isset($_POST['ladder_press_remove_team_id'])) {
                self::processDeleteTeam();
            } else if (isset($_POST['ladder_press_team_id'])) {
                if($_POST['ladder_press_team_id'] == 0) {
                    self::processCreateTeam(); 
                } else {
                    self::processEditTeam();
                }
            } else if(isset($_POST['ladder_press_players_management'])&& $_POST['ladder_press_players_management']){
                if(isset($_POST['ladder_press_grant_user_admin']))
                {
                    $idUser = $_POST['ladder_press_grant_user_admin'];
                    $rank = 'admin';
                }else if(isset($_POST['ladder_press_remove_user_admin'])) {
                    $idUser = $_POST['ladder_press_remove_user_admin'];
                    $rank = '';
                } 
                self::processUpdateUserRank($idUser,$rank);
            }else if(isset($_POST['ladder_press_kick_user_id'])) {
                self::processKickUser();
            }
        }
        // Display traitment
        if(isset($_GET['page'])) {
            $page = $_GET['page'];
            switch (true) {
                case $page == "team_list":
                    self::displayTeamList();
                    break;
                case ($page == "details" && isset($_GET['teamId'])):
                    self::displayTeamDetail();
                    break;
                case ($page == "edit" && isset($_GET['teamId'])):
                    self::editTeam();
                    break;
                case $page == "create":
                    self::createTeam();
                    break;
                case ($page == "join_team" && isset($_GET['teamId'])):
                    self::joinTeam();
                    break;
                case ($page == "leave_team" && isset($_GET['teamId'])):
                    self::leaveTeam();
                    break;
                case $page == "adminMenu":
                    self::displayAdminMenu();
                    break;
                case ($page == "playersManagement" && isset($_GET['teamId'])):
                    self::displayPlayersManagement();
                    break;
                case ($page == "confirmKickUser" && isset($_GET['teamId'])):
                    self::displayConfirmKickUser();
                    break;
                default:
                    self::displayTeamList();
                    break;
            }
        } else {
            self::displayTeamList();
        }
    }
    
    private function displayTeamList() {
        // Teams liste
        $allTeams = Team::getAllTeams();
        include_once $GLOBALS['ladder_press_dir_path'].'/view/template/teamList.php';
    }
    
    private function displayTeamDetail() {
        // Team details
        $team = Team::getTeamById($_GET['teamId'], true);
        $userTeam = Team::getCurrentPlayerTeam(get_current_user_id());
        include_once $GLOBALS['ladder_press_dir_path'].'/view/template/teamDetails.php';
    }
    
    private function displayPlayersManagement()
    {
        $team = Team::getTeamById($_GET['teamId'], true);
        $players = UserTeam::getTeamUsers($_GET['teamId']);
        include_once $GLOBALS['ladder_press_dir_path'].'/view/template/teamPlayersManagement.php';
    }
    
    private function displayConfirmKickUser() {
        if(isset($_POST['ladder_press_kick_user'])){
            $player = get_userdata( $_POST['ladder_press_kick_user']);
            $team = Team::getTeamById($_GET['teamId'], true);
            if($team->getIdCreator() != $player->ID)
            {
                include_once $GLOBALS['ladder_press_dir_path'].'/view/template/confirmKickUser.php';
            }else{
                echo 'Vous ne pouvez pas kicker le créateur de la team !!';
            }
        }else {
            echo 'Impossible de kicker l\' utilisateur : Utilisateur non trouvé ou non valide';
        }
    }
    
    
    /**
     * Display a menu where the user can choose either the players management or edit team informations
     */
    private function displayAdminMenu() {
        // TODO gestion des rôles
        $userTeam = Team::getCurrentPlayerTeam(get_current_user_id());
        include_once $GLOBALS['ladder_press_dir_path'].'/view/template/userTeamAdminMenu.php';
    }
    
    private function createTeam() {
        if(get_current_user_id() != 0) {
            if(!UserTeam::isUserHasTeam(get_current_user_id())) {
                include_once $GLOBALS['ladder_press_dir_path'].'/view/template/teamEdit.php';
            } else {
                echo "Vous ne pouvez pas créer d'équipe si vous êtes déjà membre d'une équipe.";
            }
        } else {
            echo "Vous devez être connecté pour créer une équipe";
        }
    }
    
    private function editTeam() {
        if(get_current_user_id() != 0) {
            $editTeam = Team::getTeamById($_GET['teamId'], true);
            include_once $GLOBALS['ladder_press_dir_path'].'/view/template/teamEdit.php';
        } else {
            echo "Vous devez être connecté pour créer une équipe";
        }
    }
    
    private function joinTeam() {
        if(get_current_user_id() != 0) {
            if(!UserTeam::isUserHasTeam(get_current_user_id())) {
                $team = Team::getTeamById($_GET['teamId']);
                if($team != null) {
                    include_once $GLOBALS['ladder_press_dir_path'].'/view/template/teamJoin.php';
                } else {
                    echo "Team introuvable.";
                }
            } else {
                echo "Vous ne pouvez rejoindre d'équipe si vous êtes déjà membre d'une équipe.";
            }
        } else {
            echo "Vous devez être connecté pour rejoindre une équipe";
        }
    }
    
    private function leaveTeam() {
        if(get_current_user_id() != 0) {
            $team = Team::getTeamById($_GET['teamId'], true);
            $userTeam = Team::getCurrentPlayerTeam(get_current_user_id());
            
            if(!is_null($userTeam) && !empty($userTeam) && !is_null($team) && !empty($team) && $team->getId() == $userTeam->getId()) {
                include_once $GLOBALS['ladder_press_dir_path'].'/view/template/teamLeave.php';
            } else {
                echo "Vous ne pouvez pas quitter une équipe dans laquel vous n'êtes pas.";
            }
        } else {
            echo "Vous devez être connecté pour rejoindre une équipe";
        }
    }
    
    private function processDeleteTeam() {
        
        // TODO Vérification de droit de suppression
        //Team::deleteTeam($_POST['ladder_press_remove_team_id']);
    }
    
    /**
     * Permet de changer le rôle de l'utilisateur
     * 
     * @param String $rank rank que l'on veut attribuer à l'utilisateur
     * @param int $idUser
     */
    private function processUpdateUserRank($idUser,$rank){
        if($idUser != '' && isset($_GET['teamId']))
        {
            UserTeam::updateUserRank($_GET['teamId'],$idUser,$rank);
        }
    }
    
    private function processCreateTeam() {
        if(get_current_user_id() != 0) {
            if(!UserTeam::isUserHasTeam(get_current_user_id()) && $_POST['ladder_press_team_id'] == 0) {
                // Create team
                $team = new Team();
                $team->setDateCrea($_POST['ladder_press_team_creation']);
                if($_POST['ladder_press_team_active'] == "on" || $_POST['ladder_press_team_active'])
                    $team->setActive(1);
                else
                    $team->setActive (0);
                $team->setName($_POST['ladder_press_team_name']);
                $team->setTag($_POST['ladder_press_team_tag']);
                $team->setSite($_POST['ladder_press_team_site']);

                $team->setIdCreator(get_current_user_id());
                $team->setDateCrea(date("Y-m-d H:i:s"));
                $team->setActive(true);
                if(isset($_FILES['ladder_press_team_logo']) && !empty($_FILES['ladder_press_team_logo']) && $_FILES['ladder_press_team_logo'] != '')
                {
                    $uploadedFile = $_FILES['ladder_press_team_logo'];
                    $uploadOverrides = array( 'test_form' => false );
                    require_once( ABSPATH . 'wp-admin/includes/image.php' );
                    require_once( ABSPATH . 'wp-admin/includes/file.php' );
                    require_once( ABSPATH . 'wp-admin/includes/media.php' );
                    $movefile = wp_handle_upload($uploadedFile,$uploadOverrides);
                    if ( $movefile ) {
                        $wp_filetype = $movefile['type'];
                        $filename = $movefile['file'];
                        $wp_upload_dir = wp_upload_dir();
                        $attachment = array(
                            'guid' => $wp_upload_dir['url'] . '/' . basename( $filename ),
                            'post_mime_type' => $wp_filetype,
                            'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
                            'post_content' => '',
                            'post_status' => 'inherit'
                        );
                        $attach_id = wp_insert_attachment( $attachment, $filename);
                    }
                    $logo_name = $attach_id;
                }else{
                    $logo_name = "";
                }  
                $team->setLogoName($logo_name);
                Team::createTeam($team);

                $newUserAdmin = new UserTeam();

                $newUserAdmin->setTeamId($team->getId());
                $newUserAdmin->setUserId(get_current_user_id());
                $newUserAdmin->setRequestDate(date("Y-m-d H:i:s"));
                $newUserAdmin->setTeamAccept(true);
                $newUserAdmin->setUserAccept(true);
                $newUserAdmin->setUserRank("admin");
                $newUserAdmin->setAcceptDate(date("Y-m-d H:i:s"));
                $newUserAdmin->setLeaveDate(NULL);

                UserTeam::createUserTeam($newUserAdmin);
            } else {
                echo "Vous ne pouvez pas créer d'équipe si vous êtes déjà membre d'une équipe.";
            }
        } else {
            echo "Vous devez être connecté pour créer une équipe";
        }
    }
    
    private function processEditTeam () {
        if(get_current_user_id() != 0) {
            if(UserTeam::isUserAdminTeam(get_current_user_id(), $_POST['ladder_press_team_id'])) {
                // Update team
                $team = Team::getTeamById($_POST['ladder_press_team_id']);
                if($team != null) {
                    $team->setDateCrea($_POST['ladder_press_team_creation']);
                    if($_POST['ladder_press_team_active'] == "on" || $_POST['ladder_press_team_active'])
                        $team->setActive(1);
                    else
                        $team->setActive (0);
                    $team->setName($_POST['ladder_press_team_name']);
                    $team->setTag($_POST['ladder_press_team_tag']);
                    $team->setIdCreator($team->getIdCreator());
                    $team->setSite($_POST['ladder_press_team_site']);
                    if(isset($_FILES['ladder_press_team_logo']) && $_FILES['ladder_press_team_logo'] != '')
                    {
                        $uploadedFile = $_FILES['ladder_press_team_logo'];
                        $uploadOverrides = array( 'test_form' => false );
                        require_once( ABSPATH . 'wp-admin/includes/image.php' );
                        require_once( ABSPATH . 'wp-admin/includes/file.php' );
                        require_once( ABSPATH . 'wp-admin/includes/media.php' );
                        $movefile = wp_handle_upload($uploadedFile,$uploadOverrides);
                        if ( $movefile ) {
                            $wp_filetype = $movefile['type'];
                            $filename = $movefile['file'];
                            $wp_upload_dir = wp_upload_dir();
                            $attachment = array(
                                'guid' => $wp_upload_dir['url'] . '/' . basename( $filename ),
                                'post_mime_type' => $wp_filetype,
                                'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
                                'post_content' => '',
                                'post_status' => 'inherit'
                            );
                            $attach_id = wp_insert_attachment( $attachment, $filename);
                        }
                        $logo_name = $attach_id;
                    }else{
                        $logo_name = "";
                    }  
                    $team->setLogoName($logo_name);
                    Team::updateTeam($team);
                }
            } else {
                echo "Vous ne pouvez pas modifier cette équipe";
            }
        } else {
            echo "Vous devez être connecté pour créer une équipe";
        }
    }
    
    private function processKickUser() {
        $team = Team::getTeamById($_POST['ladder_press_kick_team_id'], false);
        $userTeam = UserTeam::getUserTeam($_POST['ladder_press_kick_user_id'],$_POST['ladder_press_kick_team_id']);
        if($team->getIdCreator() != $_POST['ladder_press_kick_user_id']) {
            if(!is_null($userTeam) && !empty($userTeam)) {
                $userTeam->setLeaveDate(date("Y-m-d H:i:s"));
                UserTeam::updateUserTeam($userTeam);
            }
        }else{
            echo "Vous ne pouvez pas kicker le créateur de la team";
        }
    }
}
