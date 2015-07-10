/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

jQuery(document).ready(function($){
    jQuery('#addMap').click(function(){
       console.log(jQuery('#listMaps option').size());
       if(jQuery('#listMaps option').size() !== 0)
       {
            var idMap = jQuery('#listMaps option:selected').val();
            var nomMap = jQuery('#listMaps option:selected').text();
            jQuery('#mapsSelected').append('<p class="selectedMap map'+idMap+'"></p>');
            jQuery('#mapsSelected .map'+idMap).append('<input type="hidden" name="ladder_press_m_packs_maps[]" value="'+idMap+'">');
            jQuery('#mapsSelected .map'+idMap).append('<span>'+nomMap+'</span><a href="#" onClick="supprimerMap(jQuery(this))">X</a>');
            jQuery('#listMaps option:selected').remove();
       }
    });
});

function supprimerMap(element)
{
    element.parent().remove(); 
    var selectedElmtMap = element.prev().text();
    var selectedElmtMapId = element.parent().children('input').val();
    jQuery('#listMaps').append('<option value="'+selectedElmtMapId+'">'+selectedElmtMap+'</option>')
}
