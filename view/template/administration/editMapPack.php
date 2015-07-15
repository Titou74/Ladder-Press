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
    
$maps = Map::getAllMaps();


?>
<div class="wrap">
    <h2><?php echo $edit ? "Edit " : "Add "; echo get_admin_page_title(); ?></h2>
    <form method="post" action="admin.php?page=ladder_press_m_packs">
        <input type="hidden" name="ladder_press_m_pack_id" value=" <?php echo $edit ? $editMap->getId() : "0"; ?> ">
        <table class="form-table">
            <tbody>
                <tr>
                    <th scope="row">Map pack name</th>
                    <td>
                        <input type="text" name="ladder_press_m_packs_name" value="<?php echo $edit ?  $editMap->getName() : ""; ?>" required="required">
                    </td>
                </tr>
                <tr>
                    <th scope="row">Maps to include</th>
                    <td>
                        <select name="listMaps" id="listMaps">
                        <?php foreach($maps as $map): ?>
                            <option value="<?php echo $map->getId(); ?>"><?php echo $map->getName(); ?></option>
                        <?php endforeach; ?>
                        </select>
                        <input type="button" id="addMap" value="Add this map"/>
                    </td>      
                </tr>
                <tr>
                    <th scope="row">Maps selected</th>
                    <td>
                        <div id="mapsSelected">
                        </div>
                    </td>     
                </tr>
            </tbody>
        </table>
        
        <?php submit_button(); ?>
    </form>
</div>