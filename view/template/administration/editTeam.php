<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$edit = isset($editTeam);

?>
<div class="wrap">
    <h2><?php echo $edit ? "Edit " : "Add "; echo get_admin_page_title(); ?></h2>
    <form method="post" action="admin.php?page=ladder_press_team" enctype="multipart/form-data">
        <input type="hidden" name="ladder_press_team_id" value=" <?php echo $edit ? $editMap->getId() : "0"; ?> ">
        <input type="hidden" name="ladder_press_team_creation" value="<?php echo $edit ?  $editMap->getName() : ""; ?>" required="required">
        <table class="form-table">
            <tbody>
                <tr>
                    <th scope="row">Team name</th>
                    <td>
                        <input type="text" name="ladder_press_map_name" value="<?php echo $edit ?  $editMap->getName() : ""; ?>" required="required">
                    </td>
                </tr>
                <tr>
                    <th scope="row">Team tag</th>
                    <td>
                        <input type="text" name="ladder_press_team_tag" value="<?php echo $edit ?  $editMap->getName() : ""; ?>" required="required">
                    </td>
                </tr>
                <tr>
                    <th scope="row">Team creator</th>
                    <td>
                        <input type="text" name="ladder_press_team_creator" value="<?php echo $edit ?  $editMap->getName() : ""; ?>" required="required">
                    </td>
                </tr>
                <!--<tr>-->
                    <!-- @TODO mettre à jour pour une image du logo -->
<!--                <tr>
                    <th scope="row">Upload Picture</th>
                    <td>
                        <?php // if($edit): ?>
                            <?php // if($editMap->getPick() != '') : ?>
                                <img alt="image de la map" src="<?php echo $editMap->getPick(); ?>" style="width: 250px; display: block; max-height: 250px;"/>
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