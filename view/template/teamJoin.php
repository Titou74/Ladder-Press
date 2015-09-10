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
    
    <form style="display:inline;" method="post" action="?p=users">
        <input type="hidden" name="ladder_press_join_team_id" value="<?php echo $_GET['teamId']; ?>"/>
        <input id="submit" class="button button-primary" type="submit" value="Validate" name="submit" />
    </form>
    <form style="display:inline;" action="?p=teams" method="post">
        <input id="submit" class="button" type="submit" value="Retourner sur la liste des équipes" name="submit" />
    </form>
</div>