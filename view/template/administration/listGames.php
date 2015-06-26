<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if ( ! isset( $allGames ) ) exit; // Exit if accessed directly

echo '<h1>'.get_admin_page_title().'</h1>';

echo '<table class="wp-list-table widefat fixed striped">';

echo '<thead><tr>';
    echo '<th scope="col">Name</th>';
    echo '<th scope="col">Short name</th>';
    echo '<th scope="col">GUID require</th>';
    echo '<th scope="col">GUID regex</th>';
echo '</tr></thead><tbody id="the-list">';

foreach ($allGames as $game){
    
    $editlink  = '/wp-admin/admin.php?page=ladder_press_games&action=edit&game_id='.(int)$game->getId();

    echo '<tr id="record_'.$game->getId().'">';
        echo '<td './*$attributes.*/'>'.stripslashes($game->getName()).'</td>';
        echo '<td './*$attributes.*/'>'.stripslashes($game->getShortname()).'</td>';
        echo '<td './*$attributes.*/'>'.stripslashes($game->getActiveGuid() ? 'Yes' : 'No').'</td>';
        echo '<td './*$attributes.*/'>'.stripslashes($game->getGuidRegex()).'</td>';
    echo'</tr>';

}

echo '</tbody></table>';

var_dump($allGames);
