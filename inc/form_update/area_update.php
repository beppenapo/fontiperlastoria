<?php
require('../db.php');
$id = $_POST['id'];
$q=("
SELECT 
  aree.id, 
  aree.id_comune, 
  comune.comune, 
  aree.id_localita, 
  localita.localita, 
  aree.id_indirizzo, 
  indirizzo.indirizzo, 
  comune.cap AS cap_comune, 
  indirizzo.cap AS cap_indirizzo, 
  aree.tipo, 
  aree.id_rubrica, 
  anagrafica.nome as rubrica
FROM 
  public.aree
left join comune on aree.id_comune = comune.id
left join localita on aree.id_localita = localita.id
left join indirizzo on aree.id_indirizzo = indirizzo.id
left join anagrafica on aree.id_rubrica = anagrafica.id
where aree.id = $id;
");
$r = pg_query($connection, $q);
$a = pg_fetch_array($r);
$idcomune = $a['id_comune'];
$idlocalita = $a['id_localita'];
$idindirizzo = $a['id_indirizzo'];
$idrubrica = $a['id_rubrica'];
$comune = stripslashes($a['comune']);
$localita = stripslashes($a['localita']);
$indirizzo = stripslashes($a['indirizzo']);
$rubrica = stripslashes($a['rubrica']);
$tipo = $a['tipo'];
$tipologia=($tipo==1)?'area di interesse':'ubicazione';
//if($tipo==1) {$tipologia = 'area di interesse';}if($tipo==2) {$tipologia = 'ubicazione';}

?>

<div id="compilazione_form">   
   <label>* Tipologia area</label>
    <select id="tipo_update" name="tipo_update" class="form">
      <option value="<?php echo($tipo);?>"><?php echo($tipologia);?></option>
      <option value="1">area di interesse</option>
      <option value="2">ubicazione</option>
    </select>
   
   <label>* COMUNE</label>
   <select id="comuneubi_update" name="comune_update" class="form">
    <option value="<?php echo($idcomune);?>"><?php echo($comune);?></option>
    <?php
     $q1 = ("SELECT DISTINCT id, comune FROM comune order by comune asc;");
     $q1ex = pg_query($connection, $q1);
     $q1r = pg_num_rows($q1ex);
     if($q1r != 0) {
      for ($a1 = 0; $a1 < $q1r; $a1++){
       $selid = pg_result($q1ex, $a1,"id"); 	
       $selcomune = pg_result($q1ex, $a1,"comune");
       $selcomune = stripslashes($selcomune);
       echo "<option value=\"$selid\">$selcomune</option>";
     }
   }
   ?>
   </select>
   
   <label>LOCALITA'</label>
   <select id="localitaubi_update" name="localita_update" class="form">
     <option value="<?php echo($idlocalita);?>"><?php echo($localita);?></option>
   </select>
   
   <label>INDIRIZZO</label>
   <select id="indirizzoubi_update" name="indirizzo_update" class="form">
     <option value="<?php echo($idindirizzo);?>"><?php echo($indirizzo);?></option>
   </select>
   <div id="rubrica">   
   <label>RIFERIMENTO RUBRICA</label>
   <select id="rubrica_up" name="rubrica_up" class="form">
     <option value="<?php echo($idrubrica);?>"><?php echo($rubrica);?></option>
    <?php
     $q2 = ("SELECT DISTINCT id, nome FROM anagrafica WHERE id != $idrubrica order by nome asc;");
     $q2ex = pg_query($connection, $q2);
     $q2r = pg_num_rows($q2ex);
     if($q2r != 0) {
      for ($a2 = 0; $a2 < $q2r; $a2++){
       $selid = pg_result($q2ex, $a2,"id"); 	
       $selnome = pg_result($q2ex, $a2,"nome");
       echo "<option value=\"$selid\">$selnome</option>";
     }
   }
   ?>
   </select>
 
 <input type="hidden" id="id" value="<?php echo($id); ?>" />
 <div id="salva" class="login2" style="margin-top:20px;" id="compilazione_update">Salva modifiche</div>
 <div id="chiudi" class="login2">Annulla modifiche</div>
 <div id="elimina" class="login2">Elimina record</div>
</div>


<div id="delDialog" style="display:none; text-align:center;">
 <h2>Hai scelto di eliminare un'<?php echo($tipologia);?></h2>
 <p>Eliminando il record eliminerai anche i collegamenti con le schede</p>
 <p>Sei sicuro di voler eliminare il record?</p>
 <div id="no" class="login2" style="margin-top:20px;" id="compilazione_update">NO, non eliminare</div>
 <div id="si" class="login2">SI, procedi con l'eliminazione</div>
</div>
<script type="text/javascript" src="./lib/select.js"></script>
<script type="text/javascript" >
$(document).ready(function(){
 $('#chiudi, #no').click(function(){$(this).closest('.ui-dialog-content').dialog('close');});
 
 $('#elimina').click(function(){
   //$('#checkId').html(idDel);
   $("#delDialog").dialog({
      resizable:false,
      height: 300,
      width: 500,
      title: "ATTENZIONE!!!"
   });
   $('#si').click(function(){
     var idDel = $('#id').val();
     //alert('elimina il record:' + idDel); return false;
     $.ajax({
          url: 'inc/deleteArea.php',
          type: 'POST', 
          data: {idDel:idDel},
          success: function(data){
             $(data).dialog().delay(2500).fadeOut(function(){ window.location.href = 'aree.php?c=0&t=0'; });
          }//success
     });//ajax
   });     
 });//elimina
 
 $('#salva').click(function(){
     var idUpdate = $('#id').val();
     var tipo_update = $('#tipo_update').val(); 
     var comuneubi_update = $('#comuneubi_update').val();
     var localitaubi_update = $('#localitaubi_update').val(); 
     var indirizzoubi_update = $('#indirizzoubi_update').val(); 
     var rubrica_up = $('#rubrica_up').val();
     //alert('aggiorna il record:' + idUpdate+'\ntipo: '+tipo_update+'\ncomune: '+comuneubi_update+'\nloc: '+localitaubi_update+'\nind: '+indirizzoubi_update+'\nrub: '+rubrica_up); return false;
     $.ajax({
          url: 'inc/updateArea_script.php',
          type: 'POST',
          data: {idUpdate:idUpdate,tipo_update:tipo_update, comuneubi_update:comuneubi_update, localitaubi_update:localitaubi_update, indirizzoubi_update:indirizzoubi_update, rubrica_up:rubrica_up},
          success: function(data){
            alert('Record aggiornato!'); window.location.href = 'aree.php?c=0&t=0';
          }//success
     });//ajax
   });
 
});

</script>