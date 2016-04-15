<?php
require('../db.php');
$id = $_POST['id'];
$nome = stripslashes($_POST['nome']);
$id_comune = $_POST['id_comune'];
$comune = stripslashes($_POST['comune']);
$id_localita = $_POST['id_localita'];
$localita = stripslashes($_POST['localita']);
$id_indirizzo = $_POST['id_indirizzo'];
$indirizzo = stripslashes($_POST['indirizzo']);
$tel = $_POST['tel'];
$cell = $_POST['cell'];
$fax = $_POST['fax'];
$mail = $_POST['mail'];
$web = $_POST['web'];
$note = stripslashes($_POST['note']);
$id_tipo = $_POST['id_tipo'];
$tipo = $_POST['tipo'];
?>

<div>
  <input type="hidden" id="id_update" name="id_update" value="<?php echo($id); ?>"  class="form"/>
     <label>* NOME</label>
     <textarea id="nome_update" class="form"><?php echo($nome); ?></textarea>

     <label>TIPOLOGIA DEL SOGGETTO</label>
     <select id="tipo_update" name="tipo_update" class="form">
      <option value="<?php echo($id_tipo);?>"><?php echo($tipo); ?></option>
       <?php
         $query =  ("SELECT * FROM lista_tipo_soggetto where id!=$id_tipo order by definizione asc;");
         $result = pg_query($connection, $query);
         $righe = pg_num_rows($result);
         $i=0;
         for ($i = 0; $i < $righe; $i++){
           $idTipo = pg_result($result, $i, "id");
           $defTipo = pg_result($result, $i, "definizione");
           echo "<option value=\"$idTipo\">$defTipo</option>";
         }
       ?>
     </select>

     <label>COMUNE</label>
     <select id="comune_update" name="comune_update" class="form">
       <option value="<?php echo($id_comune); ?>"><?php echo($comune); ?></option>
       <?php
         $query =  ("SELECT * FROM public.comune where id != $id_comune order by comune asc; ");
         $result = pg_query($connection, $query);
         $righe = pg_num_rows($result);
         $i=0;
         for ($i = 0; $i < $righe; $i++){
           $idComAna = pg_result($result, $i, "id");
           $defComAna = pg_result($result, $i, "comune");
           echo "<option value=\"$idComAna\">$defComAna</option>";
         }
       ?>
  </select>

  <label>LOCALITA'</label>
  <select id="localita_update" name="localita_update" class="form">
   <option value="<?php echo($id_localita); ?>"><?php echo($localita); ?></option>
       <?php
         $query =  ("SELECT localita.id AS id_localita, localita.localita
                     FROM public.localita
                     WHERE localita.id != $id_localita and localita.comune = $id_comune order by localita asc;");
         $result = pg_query($connection, $query);
         $righe = pg_num_rows($result);
         $i=0;
         for ($i = 0; $i < $righe; $i++){
           $idLocAna = pg_result($result, $i, "id_localita");
           $locAna = pg_result($result, $i, "localita");
           echo "<option value=\"$idLocAna\">$locAna</option>";
         }
       ?>
  </select>

 <label>INDIRIZZO</label>
  <select id="indirizzo_update" name="indirizzo_update" class="form">
   <option value="<?php echo($id_indirizzo);?>"><?php echo($indirizzo);?></option>
       <?php
         $query =  ("SELECT indirizzo.id AS id_indirizzo, indirizzo.indirizzo FROM indirizzo WHERE indirizzo.comune = $id_comune and indirizzo.id != $id_indirizzo order by indirizzo asc;");
         $result = pg_query($connection, $query);
         $righe = pg_num_rows($result);
         $i=0;
         for ($i = 0; $i < $righe; $i++){
           $idIndAna = pg_result($result, $i, "id_indirizzo");
           $indAna = pg_result($result, $i, "indirizzo");
           echo "<option value=\"$idIndAna\">$indAna</option>";
         }
       ?>
  </select>

  <label>TELEFONO</label>
  <textarea id="tel_update" class="form"><?php echo($tel);?></textarea>

  <label>CELLULARE</label>
  <textarea id="cell_update" class="form"><?php echo($cell);?></textarea>

  <label>FAX</label>
  <textarea id="fax_update" class="form"><?php echo($fax);?></textarea>

  <label>INDIRIZZO E-MAIL</label>
  <textarea id="mail_update" class="form"><?php echo($mail);?></textarea>

  <label>SITO WEB</label>
  <textarea id="web_update" class="form"><?php echo($web);?></textarea>

  <label>NOTE</label>
  <textarea id="note_update" class="form" style="height:100px !important"><?php echo($note);?></textarea>
  
  
  <div id="salva" class="login2" style="margin-top:20px;" id="compilazione_update">Salva modifiche</div>
  <div id="chiudi" class="login2">Annulla modifiche</div>
  <div id="elimina" class="login2">Elimina record</div>
</div>


<div id="delDialog" style="display:none; text-align:center;">
 <h2>Hai scelto di eliminare <?php echo ($nome); ?> dalla rubrica</h2>
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
     var idDel = $('#id_update').val();
     //alert('elimina il record:' + idDel); return false;
     $.ajax({
          url: 'inc/deleteRubrica.php',
          type: 'POST', 
          data: {idDel:idDel},
          success: function(data){
             $(data).dialog().delay(2500).fadeOut(function(){ window.location.href = 'rubrica.php'; });
          }//success
     });//ajax
   });     
 });//elimina
 
 $('#salva').click(function(){
     var idUpdate = $('#id_update').val();
     var nome_update = $('#nome_update').val();
     var comune_update = $('#comune_update').val();
     var localita_update = $('#localita_update').val();
     var indirizzo_update = $('#indirizzo_update').val();
     var tel_update = $('#tel_update').val();
     var cell_update = $('#cell_update').val();
     var fax_update = $('#fax_update').val();
     var mail_update = $('#mail_update').val();
     var web_update = $('#web_update').val();
     var note_update = $('#note_update').val();
     var tipo_update = $('#tipo_update').val();
     //alert('aggiorna il record:' + idUpdate+'\nnome_update: '+nome_update+'\ncomune_update: '+comune_update+'\nlocalita_update: '+localita_update+'\nindirizzo_update: '+indirizzo_update+'\ntel_update: '+tel_update+'\ncell_update: '+cell_update+'\nfax_update: '+fax_update+'\nmail_update: '+mail_update+'\nweb_update: '+web_update+'\nnote_update: '+note_update+'\ntipo_update: '+tipo_update); return false;
     $.ajax({
          url: 'inc/updateRubrica_script.php',
          type: 'POST',
          data: {idUpdate:idUpdate, nome_update:nome_update, comune_update:comune_update, localita_update:localita_update, indirizzo_update:indirizzo_update, tel_update:tel_update, cell_update:cell_update, fax_update:fax_update, mail_update:mail_update, web_update:web_update, note_update:note_update, tipo_update:tipo_update},
          success: function(data){
            alert('Record aggiornato!'); window.location.href = 'ricerca.php';
          }//success
     });//ajax
   });
 
});

</script>