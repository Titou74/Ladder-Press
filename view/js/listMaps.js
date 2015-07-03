/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
jQuery(document).ready(function($){
//    jQuery('#from_game').click(function () {
//      jQuery('option[selected="selected"]', this).remove();
//    });
});

function hideRowOtherGames()
{
    var id_game = jQuery('#from_game').find(":selected").val();
    jQuery('.ladder-press_page_ladder_press_maps tr[class^="from_game_"]').each(function() {
        console.log(jQuery(this).hasClass('from_game_'+id_game));
        if(!jQuery(this).hasClass('from_game_'+id_game))
        {
            jQuery(this).removeClass('hide_row');
            jQuery(this).removeClass('show_row');
            jQuery(this).addClass('hide_row');
        }else{
            jQuery(this).removeClass('hide_row');
            jQuery(this).removeClass('show_row');
            jQuery(this).addClass('show_row');
        }
    });
}


