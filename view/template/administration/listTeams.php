<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if ( ! isset( $teamsAdministration ) ) exit; // Exit if accessed directly

?>
<div class="wrap">
    <form method="post">
        <input type="hidden" name="page" value="example_list_table" />
        <?php $teamsAdministration->search_box('Search', 'search_id'); ?>
    </form>
    <div id="icon-users" class="icon32"></div>
    <h2><?php echo get_admin_page_title(); ?></h2>
    <?php $teamsAdministration->display(); ?>
</div>


<form style="display:inline;" action="?page=ladder_press_teams&action=add" method="post">
    <input id="submit" class="button button-primary" type="submit" value="Add a new team" />
</form>