<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if ( ! isset( $allGames ) ) exit; // Exit if accessed directly

echo '<h1>'.get_admin_page_title().'</h1>';

echo '<table>';

foreach ($allGames as $game){
    
    $editlink  = '/wp-admin/admin.php?page=ladder_press_games&action=edit&game_id='.(int)$game->getId();

    echo '<tr id="record_'.$game->getId().'">';
        echo '<td './*$attributes.*/'>'.stripslashes($game->getName()).'</td>';
        echo '<td './*$attributes.*/'>'.stripslashes($game->getShortname()).'</td>';
        echo '<td './*$attributes.*/'>'.stripslashes($game->getActiveGuid()).'</td>';
        echo '<td './*$attributes.*/'>'.stripslashes($game->getGuidRegex()).'</td>';
        echo '<td './*$attributes.*/'>'.stripslashes($game->getGuidRegex()).'</td>';
    echo'</tr>';

}

echo '</table>';

var_dump($allGames);
