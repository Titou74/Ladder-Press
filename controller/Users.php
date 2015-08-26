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
    public function userMenu() {
        if(get_current_user_id() != 0) {
            if(!isset($_GET['page'])) {
                echo "COUCOU TRUC";
            } else if($_GET['page'] == "game_list") {
                echo "COUCOU LIST";
            } else if($_GET['page'] == "game_add") {
                echo "COUCOU ADD";
            } else if($_GET['page'] == "game_edit") {
                echo "COUCOU EDIT";
            }
        } else {
            echo "Vous devez être connecter pour accéder au module joueur";
        }
    }
}
