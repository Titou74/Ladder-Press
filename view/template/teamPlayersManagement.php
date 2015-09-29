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
                   . "<td>";
                    if($player->getUserRank() != 'admin'){
                         echo "<form method='post' action='?p=teams&page=playersManagement&teamId=".$_GET['teamId']."'>"
                        ."<input type='hidden' name='ladder_press_grant_user_id' value='". $user_info->ID ."'/>"
                        ."<input type='submit' value='Ajouter admin' name='submit'/>";
                   }
                   echo "</td>"
                . "</tr>";
       }
       echo "</tbody>";
    echo "</table>";