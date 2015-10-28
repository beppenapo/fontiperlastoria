<div id="mater3_infrastrutture_form">
<input type="hidden" id="idMater3" name="idMater3" value="<?php echo($idMater3); ?>" />

        <table class="mainData" style="width:98% !important;">
             <?php
              foreach(array(
                            'rpp_lega'=>array(1, 'SI LEGA A'),
                            'rpp_taglia'=>array(2, 'TAGLIA'),
                            'rpp_tagliato'=>array(3, 'TAGLIATO DA'),
                            'rpp_conduce'=>array(4, 'CONDUCE A'),
                            'rpp_servita'=>array(5, 'SERVITO DA')                           
              ) as $campofor=>$nomefor){
                $qrif7 = ("
                   SELECT mater_infrastrutture.id AS id_mater_infr, scheda.id, scheda.dgn_numsch, lista_dgn_tpsch.css
                   FROM mater_infrastrutture, scheda, lista_dgn_tpsch
                   WHERE mater_infrastrutture.collegata = scheda.id AND
                         scheda.dgn_tpsch = lista_dgn_tpsch.id AND
                         mater_infrastrutture.scheda = $id AND
                         mater_infrastrutture.rapporto = $nomefor[0];
                ");
 
                $rrif7 = pg_query($connection, $qrif7);
                $rowrif7 = pg_num_rows($rrif7);
                   echo '<tr><td style="width:70% !important;"><label>'.$nomefor[1].'</label><div id="oldDiv_'.$campofor.'" class="valori">';
                   for ($x = 0; $x < $rowrif7; $x++){
                    $idmi = pg_result($rrif7, $x,"id_mater_infr");
                    $idLinked = pg_result($rrif7, $x,"id");
                    $linked = pg_result($rrif7, $x,"dgn_numsch");
                    $css = pg_result($rrif7, $x,"css");
                    if($rowrif7==0) {$idmi = 'Nessuna scheda segnalata';}
                    echo "<a href=\"scheda_archeo.php?id=$idLinked\" target=\"_blank\" class=\"altrif ".$css."\">$linked</a>";
                    echo '<a href="javascript:removeInfrastruttura('.$idmi.')"><img style="width:10px;height:10px;" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAACHElEQVR42n2T70tTYRTHB73ddPfubq6ld5utYOQ2lsRYm7IyK6xBoC8CK+jHin5AWLEQgugPkG48OlEqMtIKhKAfrhFkJOVwlYVBSe1FvvDFSFj0B3x7zr1udOvOA1/Oc87nex547uGaTP9ErsHsM9WItZgp22Bex6W8CnpB2YDXZGo8c5gzn3q78HtyAHP74+C18hdj73s6VEaZvLrhxw4L+3BwL8ojF1Dqi6F8qx/5fXHwvkKs0N2B8mhaZb9uXgbV1FeHHzksvlyLFz8Hz2P5zDZN5yJYGUnjTVcM+QMJrAxfxPLZSJVTnfXL4LOyesmk3cKmwy78OBbG0vFVpVpRGrqEEuvD0onWap88L0Mu0IzuGQ/sdexF0IXvvQEUD63qSAjFw6FqTSwXWA/yGn7IcamOZbc48bXbj8Uevag35XeCPDVXOSbVs1x7GAvJzfic9Om0kNyEbCwI7jFe421bPXve2Ybi1ZOY392M+U6PTh/3bETx2mlM7YyCe/WXjNqsytNdcXy7kkIhIaPQ3qhqrk1TpX6XcHPPKTzZsR18RnvKsGj1jvk8+JI+itmoC7MRp6q3XPfdNjz0SOq50s9HN2CxP4U7zW7wWW2Ng6JVmZBteL1VwgwX5XFZBO8zEp0rjDTh1pjuGTdEgd1tFDHdIoAy1TrWxFlAwL0mgVjG8ENeFwRlSBJA2YCxjF1ltddIMSAI8hrsv9/5D5EYVSAsqeh8AAAAAElFTkSuQmCC"></a>   ';
                   }
                   echo '</div></td>
                     <td style="width:25% !important;"><br/>
                        <input class="form autocomplete" id="list_'.$campofor.'" db="'.$campofor.'" rapporto="'.$nomefor[0].'" placeholder="digita nome scheda" />
                     </td>
                   </tr>';
              }
           ?>
       </table>

<label>NOTE</label>
<textarea id="mater3_rpp_note" class="form noteform"><?php echo($note7); ?> </textarea>

 <div class="login2" style="margin-top:20px;" id="mater3_infrastrutture_salva">Salva modifiche</div>
 <div class="chiudiForm login2">Annulla modifiche</div>
</div>
<script type="text/javascript" >
$(document).ready(function(){
  $('.autocomplete').each(function () {
	 var infrLista=$(this).attr('id');
	 var infrDb=$(this).attr('db');
	 var rapporto=$(this).attr('rapporto');
	 $( "#"+infrLista ).autocomplete({
        source: "inc/autocomplete2.php",
        minLength: 2,
        select: function( event, ui ) {
           //alert(ui.item.id+'\n'+ui.item.value); return false;
           $('#oldDiv_'+infrDb).append('<span class="newDiv" rapporto="'+rapporto+'" add="'+ui.item.id+'"><a href="scheda_archeo.php?id='+ui.item.id+'" target="_blank" class="altrif '+ui.item.css+'">'+ui.item.value+'</a><a href="#" class="delDiv"><img style="width:10px;height:10px;cursor:pointer;" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAACHElEQVR42n2T70tTYRTHB73ddPfubq6ld5utYOQ2lsRYm7IyK6xBoC8CK+jHin5AWLEQgugPkG48OlEqMtIKhKAfrhFkJOVwlYVBSe1FvvDFSFj0B3x7zr1udOvOA1/Oc87nex547uGaTP9ErsHsM9WItZgp22Bex6W8CnpB2YDXZGo8c5gzn3q78HtyAHP74+C18hdj73s6VEaZvLrhxw4L+3BwL8ojF1Dqi6F8qx/5fXHwvkKs0N2B8mhaZb9uXgbV1FeHHzksvlyLFz8Hz2P5zDZN5yJYGUnjTVcM+QMJrAxfxPLZSJVTnfXL4LOyesmk3cKmwy78OBbG0vFVpVpRGrqEEuvD0onWap88L0Mu0IzuGQ/sdexF0IXvvQEUD63qSAjFw6FqTSwXWA/yGn7IcamOZbc48bXbj8Uevag35XeCPDVXOSbVs1x7GAvJzfic9Om0kNyEbCwI7jFe421bPXve2Ybi1ZOY392M+U6PTh/3bETx2mlM7YyCe/WXjNqsytNdcXy7kkIhIaPQ3qhqrk1TpX6XcHPPKTzZsR18RnvKsGj1jvk8+JI+itmoC7MRp6q3XPfdNjz0SOq50s9HN2CxP4U7zW7wWW2Ng6JVmZBteL1VwgwX5XFZBO8zEp0rjDTh1pjuGTdEgd1tFDHdIoAy1TrWxFlAwL0mgVjG8ENeFwRlSBJA2YCxjF1ltddIMSAI8hrsv9/5D5EYVSAsqeh8AAAAAElFTkSuQmCC" /></a></span>');
           $('a.delDiv').click(function () {
              event.preventDefault(); 
              $(this).closest('span').remove(); 
           });
           $(this).val("");
           event.preventDefault();
        }
     });
  });
});
</script>