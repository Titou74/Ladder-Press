<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if ( ! isset( $gamesAdministration ) ) exit; // Exit if accessed directly

?>
<div class="wrap">
    <div id="icon-users" class="icon32"></div>
    <h2><?php echo get_admin_page_title(); ?></h2>
    <?php $gamesAdministration->display(); ?>
</div>

<?php

echo "fin de page - bouton ETC";