<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$edit = isset($editTeam);
$users = get_users(array( 'orderby' => 'display_name','fields' => array( 'id','display_name' ) ) );
?>
<div class="wrap">
    <h2><?php echo $edit ? "Edit " : "Add "; echo get_admin_page_title(); ?></h2>
    <form method="post" action="admin.php?page=ladder_press_teams" enctype="multipart/form-data">
        <input type="hidden" name="ladder_press_team_id" value=" <?php echo $edit ? $editTeam->getId() : "0"; ?> ">
        <input type="hidden" name="ladder_press_team_creation" value="<?php echo $edit ?  $editTeam->getDateCrea() : date("Y-m-d H:i:s"); ?>">
        <table class="form-table">
            <tbody>
                <tr>
                    <th scope="row">Team name</th>
                    <td>
                        <input type="text" name="ladder_press_team_name" value="<?php echo $edit ?  $editTeam->getName() : ""; ?>" required="required">
                    </td>
                </tr>
                <tr>
                    <th scope="row">Team tag</th>
                    <td>
                        <input type="text" name="ladder_press_team_tag" value="<?php echo $edit ?  $editTeam->getTag() : ""; ?>" required="required">
                    </td>
                </tr>
                <tr>
                    <th scope="row">Team creator</th>
                    <td>
                        <select name="ladder_press_team_creator">
                            <?php foreach($users as $user): ?>
                                <?php if(isset($edit) && $user->id === $editTeam->getIdCreator()): ?>
                                    <option value="<?php echo $user->id;?>" selected="selected"><?php echo $user->display_name; ?></option>
                                <?php else: ?>
                                    <option value="<?php echo $user->id; ?>"><?php echo $user->display_name; ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Site url</th>
                    <td>
                        <input type="text" name="ladder_press_team_site" value="<?php echo $edit ?  $editTeam->getSite() : ""; ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row">Logo name</th>
                    <td>
                        <input type="text" name="ladder_press_team_logo_name" value="<?php echo $edit ?  $editTeam->getLogoName() : ""; ?>">
                    </td>
                </tr>
                <!--<tr>-->
                    <!-- @TODO mettre à jour pour une image du logo -->
<!--                <tr>
                    <th scope="row">Upload Picture</th>
                    <td>
                        <?php // if($edit): ?>
                            <?php // if($editMap->getPick() != '') : ?>
                                <img alt="image de la map" src="<?php //echo $editMap->getPick(); ?>" style="width: 250px; display: block; max-height: 250px;"/>
                            <?php // else : ?>
                                <p><i> No picture uploaded </i></p>
                            <?php // endif; ?>
                        <?php // endif; ?>
                        <input type="file" name="pick" id="pick"  multiple="false" />
                    </td>
                </tr>-->
            </tbody>
        </table>
        
        <?php submit_button(); ?>
    </form>
</div>