<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$edit = isset($editGame);

?>
<div class="wrap">
    <h2><?php echo $edit ? "Edit " : "Add "; echo get_admin_page_title(); ?></h2>
    <form method="post" action="admin.php?page=ladder_press_games">
        <table class="form-table">
            <tbody>
                <tr>
                    <th scope="row">Game name</th>
                    <td>
                        <input type="text" id="ladder_press_game_name" value="<?php echo $edit ?  $editGame->getName() : ""; ?>"/>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Game short name</th>
                    <td>
                        <input type="text" id="ladder_press_game_short_name" value="<?php echo $edit ?  $editGame->getShortname() : ""; ?>"/>
                        <p id="ladder_press_game_short_name-description" class="description">Use by some display elements</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">GUID require</th>
                    <td>
                        <input type="checkbox" id="ladder_press_game_guid_require" value="<?php echo $edit ?  $editGame->getActiveGuid() : ""; ?>"/>
                    </td>
                </tr>
                <tr>
                    <th scope="row">GUID regex</th>
                    <td>
                        <input type="text" id="ladder_press_game_guid_regex" value="<?php echo $edit ?  $editGame->getGuidRegex() : ""; ?>"/>
                    </td>
                </tr>
            </tbody>
        </table>
        
        <?php submit_button(); ?>
    </form>
</div>