<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if(!isset($deleteMap)) exit;

?>
<div class="wrap">
    <h2>Delete <?php echo get_admin_page_title(); ?></h2>
    
    <p>Are you sure to want to delete <strong>"<?php echo $deleteMap->getName() ?>"</strong> ? This action can't be undo.</p>
    
    <form style="display:inline;" method="post" action="admin.php?page=ladder_press_maps">
        <input type="hidden" name="ladder_press_remove_map_id" value="<?php echo $deleteMap->getId() ?>">
        
        <input id="submit" class="button button-primary" type="submit" value="Validate" name="submit" />
    </form>
    <form style="display:inline;" action="admin.php?page=ladder_press_maps" method="post">
        <input id="submit" class="button" type="submit" value="No, back to game list" name="submit" />
    </form>
</div>