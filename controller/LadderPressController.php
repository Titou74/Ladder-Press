<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LadderPressController
 *
 * @author Titou74 <titou.c.74@gmail.com>
 */
class LadderPressController {
    public function includeController() {
        if(isset($_GET['p'])) {
            switch ($_GET['p']) {
                case "users":
                    include_once $GLOBALS['ladder_press_dir_path'].'/controller/Users.php';
                    new Users();
                    break;
                
                case "teams":
                    include_once $GLOBALS['ladder_press_dir_path'].'/controller/Teams.php';
                    new Teams();
                    break;

                default:
                    echo "p non reconnu";
                    break;
            }
        } else {
            echo "pas de p non reconnu";
        }
    }
}
