<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$edit = isset($editLUP);

if($edit)
{
    $game_select = Game::getGameById($editLUP->getGameId());
    $game_select_id = $game_select->getId();
}else{
    $game_select_id = 0;
}
    
$games = Game::getAllGames();
?>
<div class="wrap">
    <h2><?php echo $edit ? "Edit " : "Add "; echo get_admin_page_title(); ?></h2>
    <form method="post" action="admin.php?page=ladder_press_teams_linesup&teamId=<?php echo $_GET['teamId']; ?>">
        <input type="hidden" name="ladder_press_lineup_id" value=" <?php echo $edit ? $editLUP->getId() : "0"; ?> ">
        <input type="hidden" name="ladder_press_lineup_team_id" value="<?php echo $_GET['teamId']; ?>">
        <input type="hidden" name="ladder_press_lineup_creation" value="<?php echo $edit ?  $editLUP->getDateCrea() : date("Y-m-d H:i:s"); ?>">
        <table class="form-table">
            <tbody>
                <tr>
                    <th scope="row">Line up name</th>
                    <td>
                        <input type="text" name="ladder_press_lineup_name" value="<?php echo $edit ?  $editLUP->getName() : ""; ?>" required="required">
                    </td>
                </tr>
                <tr>
                    <th scope="row">Shortname</th>
                    <td>
                        <input type="text" name="ladder_press_lineup_shortname" value="<?php echo $edit ?  $editLUP->getShortName() : ""; ?>" required="required">
                    </td>
                </tr>
                <tr>
                    <th scope="row">Game</th>
                    <td>
                        <select name="ladder_press_lineup_for_game" required="required">
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
            </tbody>
        </table>
        
        <?php submit_button(); ?>
    </form>
</div>