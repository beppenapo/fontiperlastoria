<?php
 include('db.php');
 $idComune = $_POST['idComune'];
 $idStato = $_POST['idStato'];
 $idProv = $_POST['idProv'];
 $stato = pg_escape_string($_POST['stato']);
 $comune = pg_escape_string($_POST['comune']);
 $prov = pg_escape_string($_POST['prov']);
 $cap = $_POST['cap'];

?>

<div class="confirm">
<h2 id="avvisi">Per annullare la modifica e chiudere la finestra utilizza il tasto in alto a destra</h2>
 <select id="stato_update" name="stato_update" class="addListe">
       <option value="<?php echo($idStato); ?>"><?php echo($stato); ?></option>
       <?php
         $query =  ("SELECT * FROM public.stato where id != $idStato order by stato asc; ");
         $result = pg_query($connection, $query);
         $righe = pg_num_rows($result);
         $i=0;
         for ($i = 0; $i < $righe; $i++){
           $sid = pg_result($result, $i, "id");
           $sdef = pg_result($result, $i, "stato");
           echo "<option value=\"$sid\">$sdef</option>";
         }
       ?>
  </select>
  <select id="prov_update" name="prov_update" class="addListe">
       <option value="<?php echo($idProv); ?>"><?php echo($prov); ?></option>
       <?php
         $query =  ("SELECT * FROM public.provincia where id != $idProv order by provincia asc; ");
         $result = pg_query($connection, $query);
         $righe = pg_num_rows($result);
         $i=0;
         for ($i = 0; $i < $righe; $i++){
           $pid = pg_result($result, $i, "id");
           $pdef = pg_result($result, $i, "provincia");
           echo "<option value=\"$pid\">$pdef</option>";
         }
       ?>
  </select>
  
  <input type="text" id="comune" value="<?php echo($comune); ?>" />
  <input type="text" id="cap" value="<?php echo($cap); ?>" placeholder="cap assente" maxlength="5" />
  
  <input type="hidden" id="idComune" value="<?php echo($idComune); ?>" />
 
 <div class="login2 update" style="font-size:10px !important" id="ok">Modifica Comune</div>
</div>

<script type="text/javascript" >
$(document).ready(function() {

//$("#stato_update").change(function() {
//  var id = $(this).val();
  //alert(id);return false;
//  $.ajax({
//   type: "POST",
//   url: "inc/dinSelProvincia.php",
//   data: {id:id},
   //cache: false,
//   success: function(html){$("#provincia_update").html(html);} 
//  });//ajax1
// });

 $('div.update').each(function(){
   $(this).click(function(){
  	 var idStato = $('#stato_update').val();
  	 var idProvincia = $('#prov_update').val();
  	 var idCom = $('#idComune').val();
  	 var comune = $('#comune').val();
  	 var cap = $('#cap').val();
  	 var stato = $('select[name="stato_update"] option:selected').text();
  	 var provincia = $('select[name="prov_update"] option:selected').text();
 	 var idTipUpdate = 'update-comune'+idCom;
 	 //alert(idStato+': '+stato+'\n'+idProvincia+': '+provincia+'\n'+idCom+': '+comune+'\n'+cap); return false;
 	 $.ajax({
      url: 'inc/updateComuneScript.php',
      type: 'POST', 
      data: {idStato:idStato, idProvincia:idProvincia, idCom:idCom, comune:comune, cap:cap}, 
      success: function(data){
      	$(data)
           .dialog({position:['middle', 10]})
           .delay(2500)
           .fadeOut(function(){ $(this).dialog("close");window.location.href = 'comune.php'; });
      }//success
    });//ajax
   });
 });
});
</script>