<?php
require('../db.php');
$id = $_POST['id'];
$areaq = "select nome from aree_carto where id = $id;";
$areaExec = pg_query($connection, $areaq);
$areaNome = pg_fetch_array($areaExec);

$listaq=("select a.id, array_to_string(array_agg(c.comune || ' (' || l.localita || ')' ), ', ') as lista from aree_carto ac, aree a, comune c, localita l where a.nome_area = ac.id and a.id_comune = c.id and a.id_localita = l.id and ac.id = $id group by a.id; ");
$listaExec = pg_query($connection, $listaq);
$listaArr;
while($lista = pg_fetch_array($listaExec)){$listaArr .="<li><input type='checkbox' name='loc' id='loc".$lista['id']."' value='".$lista['id']."' /> <label for='loc".$lista['id']."'>".$lista['lista']."</label></li>";}
?>

<div id="compilazione_form">   
    <label class='main'>* Nome area</label>
    <textarea id="nomeArea" class="form" style="height:15px;"><?php echo $areaNome['nome']; ?></textarea>
    <label class='main'>Località associate all'area, seleziona le località da eliminare</label>
    <div id="listaDiv"><ul><?php echo $listaArr; ?></ul></div>
    <label class='main'>* COMUNE</label>
    <select id="comuneCarto" name="comuneCarto" class="form"  style="width:95%;">
        <option value="15">--non determinabile--</option>
        <?php
        $q1 = ("SELECT DISTINCT id, comune FROM comune WHERE id != 15 order by comune asc;");
        $q1ex = pg_query($connection, $q1);
        $q1r = pg_num_rows($q1ex);
        while($row = pg_fetch_array($q1ex)){
            echo "<option value=".$row['id'].">".stripslashes($row['comune'])."</option>";
        }
        ?>
    </select>
    <label class='main'>LOCALITA'</label>
 
    <input type="hidden" id="id" value="<?php echo($id); ?>" />
    <div id="salva" class="login2" style="margin-top:20px;" id="compilazione_update">Salva modifiche</div>
    <div id="chiudi" class="login2">Annulla modifiche</div>
    <div id="elimina" class="login2">Elimina record</div>
</div>


<div id="delDialog" style="display:none; text-align:center;">
 <h2>Hai scelto di eliminare il record</h2>
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