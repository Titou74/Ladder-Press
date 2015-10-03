<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


 echo "<table id=\"ladder-press-players-team\">";

    echo "<thead>"
            . "<tr>"
                . "<th><p>Login</p></th> "
                . "<th><p>Rôle</p></th>"
                . "<th><p>Promouvoir</p></th>"
            . "</tr>"
        . "</thead>";

    echo "<tbody>";

       foreach ($players as $player) {
           $user_info = get_userdata( $player->getUserId() );
           echo "<tr>"
                   . "<td><p>" . $user_info->user_login . "</p></td>"
                   . "<td><p>" . $player->getUserRank() . "</p></td>"
                   . "<td>"                   
                    ."<form method='post' action='?p=teams&page=playersManagement&teamId=".$_GET['teamId']."'>"
                    ."<input type='hidden' name='ladder_press_players_management' value='true'/>";
                    // On ne peut pas destituer le créateur
                    if($user_info->ID != $team->getIdCreator()) {
                        // Si le membre n'est pas admin on propose de le promouvoir
                            if($player->getUserRank() != 'admin'){
                                 echo "<input type='hidden' name='ladder_press_grant_user_admin' value='". $user_info->ID ."'/>"
                                 ."<input type='submit' value='Ajouter admin' name='submit'/>";
                             // Si on on propose de le destituer
                            } else if($player->getUserRank() == 'admin') {
                                     echo "<input type='hidden' name='ladder_press_remove_user_admin' value='". $user_info->ID ."'/>"
                                     ."<input type='submit' value='Enlever admin' name='submit'/>";
                            }
                        echo "</form>";
                        echo "<form method='post' action='?p=teams&page=confirmKickUser&teamId=".$_GET['teamId']."'>"
                        ."<input type='hidden' name='ladder_press_kick_user' value='". $user_info->ID ."'/>"
                        ."<input type='submit' value='Kicker' name='submit'/>"
                        ."</form>";
                   }
                   echo "</td>"
                . "</tr>";
       }
       echo "</tbody>";
    echo "</table>";