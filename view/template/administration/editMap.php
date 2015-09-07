<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$edit = isset($editMap);
if($edit)
{
    $game_select = Game::getGameById($editMap->getGameId());
    $game_select_id = $game_select->getId();
}else{
    $game_select_id = 0;
}
    
$games = Game::getAllGames();



?>
<div class="wrap">
    <h2><?php echo $edit ? "Edit " : "Add "; echo get_admin_page_title(); ?></h2>
    <form method="post" action="admin.php?page=ladder_press_maps" enctype="multipart/form-data">
        <input type="hidden" name="ladder_press_map_id" value=" <?php echo $edit ? $editMap->getId() : "0"; ?> ">
        <table class="form-table">
            <tbody>
                <tr>
                    <th scope="row">Map name</th>
                    <td>
                        <input type="text" name="ladder_press_map_name" value="<?php echo $edit ?  $editMap->getName() : ""; ?>" required="required">
                    </td>
                </tr>
                <tr>
                    <th scope="row">From Game</th>
                    <td>
                        <select name="ladder_press_map_from_game" required="required">
                            <?php foreach($games as $game): ?>
                                <?php if($game->getId() === $game_select_id): ?>
                                    <option value="<?php echo $game->getId();?>" selected="selected"><?php echo $game->getName(); ?></option>
                                <?php else: ?>
                                    <option value="<?php echo $game->getId();?>"><?php echo $game->getName(); ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Upload Picture</th>
                    <td>
                        <?php if($edit): ?>
                            <?php if($editMap->getPick() != '') : ?>
                                <img alt="image de la map" src="<?php echo wp_get_attachment_url( $editMap->getPick() ); ?>" style="width: 250px; display: block; max-height: 250px;"/>
                            <?php else : ?>
                                <p><i> No picture uploaded </i></p>
                            <?php endif; ?>
                        <?php endif; ?>
                        <input type="file" name="pick" id="pick"  multiple="false" />
                    </td>
                </tr>
            </tbody>
        </table>
        
        <?php submit_button(); ?>
    </form>
</div>