<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if(!isset($deleteMapPack)) exit;

?>
<div class="wrap">
    <h2>Delete <?php echo get_admin_page_title(); ?></h2>
    
    <p>Are you sure you want to delete <strong>"<?php echo $deleteMapPack->getName() ?>"</strong> ? This action can't be undo.</p>
    
    <form style="display:inline;" method="post" action="admin.php?page=ladder_press_m_packs">
        <input type="hidden" name="ladder_press_remove_m_pack_id" value="<?php echo $deleteMapPack->getId() ?>">
        
        <input id="submit" class="button button-primary" type="submit" value="Validate" name="submit" />
    </form>
    <form style="display:inline;" action="admin.php?page=ladder_press_m_packs" method="post">
        <input id="submit" class="button" type="submit" value="No, back to map packs list" name="submit" />
    </form>
</div>