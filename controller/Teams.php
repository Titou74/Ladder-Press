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
        include_once $GLOBALS['ladder_press_dir_path'].'/model/utils/UserTeam.php';
        
        // Form traitment
        if (isset($_POST['submit'])) {
            
        }
        
        // Display traitment
        if(isset($_GET['page'])) {
            
        } else {
            
        }
    }
    
    public function teamsMenu() {
        if (isset($_POST['submit'])) {
            if(isset($_POST['ladder_press_remove_team_id']) && $_POST['ladder_press_remove_team_id'] != 0) {
                // Remove team
                Team::deleteTeam($_POST['ladder_press_remove_team_id']);
            } else if (isset($_POST['ladder_press_team_id']) && isset($_GET['page']) && $_GET['page'] == "detail") {
                if($_POST['ladder_press_team_id'] != 0) {
                    if(UserTeam::isUserAdminTeam(get_current_user_id(), $_POST['ladder_press_team_id'])) {
                        // Update team
                        $team = Team::getTeamById($_POST['ladder_press_team_id']);
                        $team->setDateCrea($_POST['ladder_press_team_creation']);
                        if($_POST['ladder_press_team_active'] == "on" || $_POST['ladder_press_team_active'])
                            $team->setActive(1);
                        else
                            $team->setActive (0);
                        $team->setName($_POST['ladder_press_team_name']);
                        $team->setTag($_POST['ladder_press_team_tag']);
                        $team->setIdCreator($_POST['ladder_press_team_creator']);
                        $team->setSite($_POST['ladder_press_team_site']);
                        if(isset($_FILES['ladder_press_team_logo']) && $_FILES['ladder_press_team_logo'] != '')
                        {
                            $uploadedFile = $_FILES['ladder_press_team_logo'];
                            $uploadOverrides = array( 'test_form' => false );
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
                    } else {
                        echo "Vous ne pouvez pas modifier cette équipe";
                    }
                } else {
                    
                    if(!UserTeam::isUserHasTeam(get_current_user_id())) {
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
                        /*if(isset($_FILES['ladder_press_team_logo']) && !empty($_FILES['ladder_press_team_logo']) && $_FILES['ladder_press_team_logo'] != '')
                        {
                            $uploadedFile = $_FILES['ladder_press_team_logo'];
                            $uploadOverrides = array( 'test_form' => false );
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
                            $logo_name = $movefile['url'];
                        }else{*/
                            $logo_name = "";
                        //}  
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
                        
                        $_GET['teamId'] = $team->getId();
                    } else {
                        echo "Vous ne pouvez pas créer d'équipe si vous êtes déjà membre d'une équipe.";
                    }
                }
                
            }
        }
        
        // Enfin j'affiche la vue souhaité en fonction du paramètre GET. (Pourras tu effacer les commentaires au passage)
        if(!isset($_GET['page']) || $_GET['page'] == 'team_list') {
            // Teams liste
            $allTeams = Team::getAllTeams();
            
            include_once plugin_dir_path( __FILE__ ).'../view/template/teamList.php';
        } else if($_GET['page'] == "details" && isset($_GET['teamId'])) {
            // Team details
            $team = Team::getTeamById($_GET['teamId']);
            
            include_once plugin_dir_path( __FILE__ ).'../view/template/teamDetails.php';
        } else if($_GET['page'] == "edit") {
            if(get_current_user_id() != 0) {
                if(isset($_GET['teamId'])) {
                    // Edition d'une équipe déjà existante

                } else {
                    // Création d'une équipe
                    if(!UserTeam::isUserHasTeam(get_current_user_id())) {
                        include_once plugin_dir_path( __FILE__ ).'../view/template/teamEdit.php';
                    } else {
                        echo "Vous ne pouvez pas créer d'équipe si vous êtes déjà membre d'une équipe.";
                    }
                }
            } else if($_GET['page'] == 'join_team' && isset($_GET['teamId'])) {
                $team = Team::getTeamById($_GET['teamId']);
                include_once plugin_dir_path( __FILE__ ).'../view/template/teamJoin.php';
            } else {
                echo "Vous devez être connecter pour créer ou modifier une équipe";
            }
        }
        
    }
}
