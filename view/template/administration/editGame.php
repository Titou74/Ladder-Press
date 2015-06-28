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
        <label>Game name</label>
        <input type="text" name="ladder_press_map_name" value="<?php echo $edit ?  $editGame->getName() : ""; /*echo get_option('zero_newsletter_sender')*/?>"/>
        
        <label>Game short name</label>
        <input type="text" name="ladder_press_map_name" value="<?php echo $edit ?  $editGame->getShortname() : ""; /*echo get_option('zero_newsletter_sender')*/?>"/>
        
        <?php settings_fields('ladder_press_settings') ?>
        
        <?php submit_button(); ?>
    </form>
</div>