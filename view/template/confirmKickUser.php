<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if(!isset($team) && !isset($player)) {
    exit;
}
?>
<div class="wrap">
    
    <p>Etes vous sûr de vouloir quitter l'utilisateur : <strong><?php echo $player->user_login ?></strong></p>
    
    <form style="display:inline;" method="post" action="?p=teams&page=playersManagement&teamId=<?php echo $team->getId();?>">
        <input type="hidden" name="ladder_press_kick_team_id" value="<?php echo $team->getId() ?>"/>
        <input type="hidden" name="ladder_press_kick_user_id" value="<?php echo $player->ID ?>"/>
        <input id="submit" class="button button-primary" type="submit" value="Confirmer" name="submit" />
    </form>
    <form style="display:inline;" action="?p=teams&page=playersManagement&teamId=<?php echo $team->getId();?>" method="post">
        <input id="submit" class="button" type="submit" value="Annuler" name="submit" />
    </form>
</div>