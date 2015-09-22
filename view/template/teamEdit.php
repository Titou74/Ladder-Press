<?php

$edit = isset($editTeam);

?>
<form method="post" action="?p=teams&page=detail" enctype="multipart/form-data">
    
    <input type="hidden" name="ladder_press_team_id" value=" <?php echo $edit ? $editTeam->getId() : "0"; ?> ">
    
    <label for="ladder_press_team_name">Team name</label>
    <input type="text" id="ladder_press_team_name" name="ladder_press_team_name" value="<?php echo $edit ?  $editTeam->getName() : ""; ?>" required="required">
    <br>
    <label for="ladder_press_team_tag">Team tag</label>
    <input type="text" id="ladder_press_team_tag" name="ladder_press_team_tag" value="<?php echo $edit ?  $editTeam->getTag() : ""; ?>" required="required">
    <br>
    <label for="team_tag">Site URL</label>
    <input type="text" id="ladder_press_team_site" name="ladder_press_team_site" value="<?php echo $edit ?  $editTeam->getSite() : ""; ?>">
    <br>
    <label for="ladder_press_team_logo">Upload logo</th>
    <?php  if($edit): ?>
        <?php  if($editTeam->getLogoName() != '') : ?>
            <img alt="Team's logo" src="<?php echo wp_get_attachment_url( $editTeam->getLogoName() ); ?>" style="width: 250px; display: block; max-height: 250px;"/>
        <?php  else: ?>
            <p><i> No picture uploaded </i></p>
        <?php  endif; ?>
    <?php endif; ?>
    <input type="file" name="ladder_press_team_logo" id="ladder_press_team_logo"  multiple="false" />
    <br>
    <?php if($edit) : ?>
    <label for="ladder_press_team_active"> Active</label>
    <input type="checkbox" name="ladder_press_team_active" <?php if(!$edit || $editTeam->getActive())echo'checked="checked"'; ?>/> 
    <?php endif; ?>
    <br><br>
    <?php if(!$edit) : ?>
        <input id="submit" name="submit" class="button button-primary" type="submit" value="Créer une équipe" />
    <?php else : ?>
        <input id="submit" name="submit" class="button button-primary" type="submit" value="Modifier l'équipe" />
    <?php endif; ?>
</form>