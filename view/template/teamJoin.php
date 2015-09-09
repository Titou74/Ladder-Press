<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if(!isset($team)) {
    exit;
}

?>
<div class="wrap">
    
    <p>Etes vous sûr de vouloir rejoindre l'équipe : <strong><?php echo $team->getName() ?></strong></p>
    
<!--    <form style="display:inline;" method="post" action="?page=ladder_press_games">
        <input type="hidden" name="ladder_press_remove_game_id" value="">
        <input id="submit" class="button button-primary" type="submit" value="Validate" name="submit" />
    </form>-->
<!--    <form style="display:inline;" action="admin.php?page=ladder_press_games" method="post">
        <input id="submit" class="button" type="submit" value="No, back to games list" name="submit" />
    </form>-->
</div>