<div id="area_interesse_add_form">

<table class="mainData" style="width:98% !important;">
  <tr>
   <td style="padding:0px !important;">
     <label>Seleziona un'area dall'elenco</label>
     <select id="aa" name="aa" class="form" style="width:220px !important;">
         <option value="573">COMUNITA' DI PRIMIERO</option>
             <?php
             $query =  ("
               SELECT distinct aree.id, comune.comune, localita.localita, indirizzo.indirizzo
               FROM aree, localita,comune, indirizzo
               WHERE aree.id_comune = comune.id AND
                     aree.id_localita = localita.id AND
                     aree.id_indirizzo = indirizzo.id and
                     aree.tipo = 1
               order by comune asc, localita asc;");
             $result = pg_query($connection, $query);
             $righe = pg_num_rows($result);
             $i=0;
             for ($i = 0; $i < $righe; $i++){
               $idArea = pg_result($result, $i, "id");
               $comune = pg_result($result, $i, "comune");
               $localita = pg_result($result, $i, "localita");
               $indirizzo = pg_result($result, $i, "indirizzo");
               $comune = stripslashes($comune);
               $localita = stripslashes($localita);
               $indirizzo = stripslashes($indirizzo);
               if($comune == 'Non determinabile') {$comune = '';}
               if($localita == 'Non determinabile') {$localita = '';}
               if($indirizzo == 'Non determinabile') {$indirizzo = '';}
               echo "<option value=\"$idArea\">$comune $localita $indirizzo</option>";
             }
            ?>
            </select>
          </td>
          <td style="padding:0px 0px 0px 5px!important;">
           <label>MOTIVAZIONE AREA</label>
           <select id="mu" name="mu" class="form">
            <option value="16">Non determinabile</option>
            <?php
             $query =  ("SELECT * FROM lista_ai_motiv order by definizione asc; ");
             $result = pg_query($connection, $query);
             $righe = pg_num_rows($result);
             $i=0;
             for ($i = 0; $i < $righe; $i++){
               $idMotivAi = pg_result($result, $i, "id");
               $def = pg_result($result, $i, "definizione");
               echo "<option value=\"$idMotivAi\">$def</option>";
             }
            ?>
           </select>
           </td>
           <td>
            <div class="login2" id="areeAdd" style="font-size: 1.5em; border-radius: 15px;-moz-border-radius: 15px;-webkit-border-radius: 15px;margin-top: -7px;margin-bottom: 0px;">+</div>
           </td>
          </tr>
          <tr>
           <td colspan="3">
           <div id="areeWrap">
             <div id="aree"></div>
             <div id="areeListCanc" class="login2" style="font-size:1.2em;width:250px !important;margin-top:10px;">
               Rimuovi aree inserite
             </div>
           </div>
           </td>
          </tr>
         </table>
 <div class="login2" style="margin-top:20px;" id="area_add">Salva modifiche</div>
 <div class="chiudiForm login2">Annulla modifiche</div>
</div>
<script type="text/javascript" >
$(document).ready(function() {
   $("#areeAdd, #area_add, #areeWrap, #areeListCanc").hide();
   $("#mu").change(function () {$("#areeAdd").fadeIn('slow');});

   $("#areeAdd").click(function () {
	  $("#areaDefault").remove();
	  $("#area_add").fadeIn('slow');
	  var id_area=$("#aa").val();
	  var area = $( "#aa option:selected" ).text();
	  var motiv=$("#mu").val();
	  var motivTxt = $( "#mu option:selected" ).text();
	  $("#aree").append('<div class="areeList" val="'+id_area+','+motiv+'"><div class="areeListRecord" style="width:300px;float:left;"><label>'+area+'</label></div><div class="areeListRecord" style="width:300px;float:left;"><label>'+motivTxt+'</label></div></div><div class="clear" style="clear:both;"></div>');
	  $("#areeWrap, #areeListCanc").fadeIn('slow');
   });

  $("#areeListCanc").click(function(){
    $("div[class=areeList]:last").remove();
    var areeNum = $('.areeList').length;
    if (areeNum == 0) {$(this).parent().fadeOut('slow');$(".clear").remove();}
  });
});
</script>
