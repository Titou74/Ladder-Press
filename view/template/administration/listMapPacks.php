<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//if ( ! isset( $mapsAdministration ) ) exit; // Exit if accessed directly
//
//$games = Game::getAllGames();
?>
<!--<div class="wrap">
    <form method="post">
        <input type="hidden" name="page" value="example_list_table" />
        <?php // $mapsAdministration->search_box('Search', 'search_id'); ?>
    </form>
    <div id="icon-users" class="icon32"></div>
    <h2><?php // echo get_admin_page_title(); ?></h2>
    <label for="from_game"> Choose a game to filter the map's list </label>
    <select name="from_game" id="from_game" onchange="hideRowOtherGames()">
        <option selected="selected" value='0'>All games</option>
        <?php // foreach($games as $game): ?>
            <option value="<?php // echo $game->getId(); ?>"><?php // echo $game->getName(); ?> </option>
        <?php // endforeach;?>
    </select>
    <?php // $mapsAdministration->display(); ?>
</div>-->


<form style="display:inline;" action="?page=ladder_press_m_packs&action=add" method="post">
    <input id="submit" class="button button-primary" type="submit" value="Create a new map pack" />
</form>