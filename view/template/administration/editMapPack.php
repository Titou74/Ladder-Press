<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$edit = isset($editMapPack);
$maps = Map::getAllMaps();
if($edit) 
{
    $mapsInMapPack = Map::getMapsByMapPack($editMapPack->getId());
    $mapsInMapPackId = array_map(create_function('$o', 'return $o->getId();'), $mapsInMapPack);
}
?>
<div class="wrap">
    <h2><?php echo $edit ? "Edit " : "Add "; echo get_admin_page_title(); ?></h2>
    <form method="post" action="admin.php?page=ladder_press_m_packs">
        <input type="hidden" name="ladder_press_m_pack_id" value=" <?php echo $edit ? $editMapPack->getId() : "0"; ?> ">
        <table class="form-table">
            <tbody>
                <tr>
                    <th scope="row">Map pack name</th>
                    <td>
                        <input type="text" name="ladder_press_m_pack_name" value="<?php echo $editMapPack ?  $editMapPack->getName() : ""; ?>" required="required">
                    </td>
                </tr>
                <tr>
                    <th scope="row">Maps to include</th>
                    <td>
                        <select name="listMaps" id="listMaps">
                            <?php foreach($maps as $map): ?>
                                <?php if($edit && array_search($map->getId(), $mapsInMapPackId)=== false): ?>
                                    <!-- Si nous sommes en édition nous récuperons seulement les maps qui ne sont pas déjà dans le mapPack -->
                                    <option value="<?php echo $map->getId(); ?>"><?php echo $map->getName(); ?></option>
                                <?php else : ?>
                                    <!--Sinon on récupere toutes les maps-->
                                    <option value="<?php echo $map->getId(); ?>"><?php echo $map->getName(); ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        <input type="button" id="addMap" value="Add this map"/>
                    </td>      
                </tr>
                <tr>
                    <th scope="row">Maps selected</th>
                    <td>
                        <div id="mapsSelected">
                            <?php if($edit):?>
                                <?php foreach($mapsInMapPack as $mapSelected) :?>
                                <p class="selectedMap map<?php echo $mapSelected->getId();?>">
                                    <input type="hidden" name="ladder_press_m_pack_maps[]" value="<?php echo $mapSelected->getId();?>">
                                    <span><?php echo $mapSelected->getName(); ?></span><a href="#" onClick="supprimerMap(jQuery(this))">X</a>
                                </p>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </td>     
                </tr>
            </tbody>
        </table>
        
        <?php submit_button(); ?>
    </form>
</div>