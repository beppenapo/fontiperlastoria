<?php
require('../db.php');
$id = $_POST['id'];
$queryup = ("
SELECT usr.nome, usr.cognome, usr.email, usr.pwd, usr.username, usr.tipo AS id_tipo, lista_tipo_usr.definizione AS tipo, usr.attivo, usr.schede
FROM usr, lista_tipo_usr
WHERE usr.tipo = lista_tipo_usr.id AND id_user = $id
");
   $execup = pg_query($connection, $queryup);
   $rowup = pg_num_rows($execup);
   $arr = pg_fetch_array($execup, 0, PGSQL_ASSOC);
   $statoUp = $arr['attivo'];
   $schede = $arr['schede'];
?>

<div>
  <input type="hidden" id="id_update" name="id_update" value="<?php echo($id); ?>"  class="form"/>
  <!--<input type="hidden" id="schede_array" name="schede_array" value="<?php echo($schede); ?>"  class="form"/>-->
  <label style="text-align:center;display:block;font-weight:bold;">* TUTTI I CAMPI SONO OBBLIGATORI.</label>
  <label>COGNOME</label>
  <textarea id="cognome_up" class="form"><?php echo($arr['cognome']); ?></textarea>
  
  <label>NOME</label>
  <textarea id="nome_up" class="form"><?php echo($arr['nome']); ?></textarea>
  
  <label>E-MAIL</label>
  <textarea id="email_up" class="form"><?php echo($arr['email']); ?></textarea>
 
  <label>USERNAME</label>
  <textarea id="username_up" class="form"><?php echo($arr['username']); ?></textarea> 
 
  <label>PASSWORD</label>
  <input type="password" id="password_up" name="password_up" class="form" value="<?php echo($arr['pwd']); ?>"/> 
  
  <label>CONFERMA PASSWORD</label>
  <input type="password" id="password_check_up" name="password_check_up" class="form" value="<?php echo($arr['pwd']); ?>"/> 
 
  <label>TIPOLOGIA DEL SOGGETTO</label>
  <select id="tipo_up" name="tipo_up" class="form">
      <option value="<?php echo($arr['id_tipo']); ?>"><?php echo($arr['tipo']); ?></option>
       <?php
         $query =  ("SELECT * FROM lista_tipo_usr order by definizione asc;");
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
  <div id="stato_utente" style="margin:15px 0px;">
  <label>STATO UTENTE</label><br/>
  <label for="attivo_up" class="input"><input type="radio" id="attivo_up" name="stato_usr_up" value="1" /> attivo</label><br/>
  <label for="nonattivo_up" class="input"><input type="radio" id="nonattivo_up" name="stato_usr_up" value="2" /> non attivo</label>
  </div>
  <div id="schede_abilitate_up" style="margin:15px 0px;">
  <label>SCHEDE ABILITATE</label><br/>
   <?php 
  $trimSchede = str_replace(', ',',',$schede);
  $trimSchede = ltrim($trimSchede);
  $arrSchede= explode(",", $trimSchede);
  $i = count($arrSchede);
  $newArr ='';
  foreach($arrSchede as $element){
   $q4 =  ("SELECT id FROM lista_dgn_tpsch where definizione = '$element'; ");
   $r4 = pg_query($connection, $q4);
   $row4 = pg_num_rows($r4);
   if($row4>0) {
    for ($i = 0; $i < $row4; $i++){
      $checkSchede = pg_result($r4, $i, "id");
      $newArr.=$checkSchede.',';
    }
   }
  }
  echo "<input type='hidden' value='$newArr' id='arrSchede'/>";

  $q3 =  ("SELECT * FROM lista_dgn_tpsch order by definizione asc; ");
  $r3 = pg_query($connection, $q3);
  $row3 = pg_num_rows($r3);
  $i3=0;
  for ($i3 = 0; $i3 < $row3; $i3++){
    $id3 = pg_result($r3, $i3, "id");
    $def3 = pg_result($r3, $i3, "definizione");
    echo "<label for='scheda$id3' style='display:block;cursor:pointer;margin-bottom:3px; padding-right:3px;'><input type='checkbox' name='usrScheda' id='scheda$id3' value='$def3' />$def3</label>";
  }
?>
</div>
  

  <div id="salva" class="login2" style="margin-top:20px;" id="usr_update">Salva modifiche</div>
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
 var stato_up = "<?php echo($statoUp); ?>";

 $('input[name=stato_usr_up][value='+stato_up+']').attr('checked', true);   
 
 var al=$('#arrSchede').val();
 var el = al.split(',');
 for(var i=0;i<el.length;i++){$('#scheda'+el[i]).attr('checked', 'checked');}
   
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
          url: 'inc/deleteUtenti.php',
          type: 'POST', 
          data: {idDel:idDel},
          success: function(data){
             $(data).dialog().delay(2500).fadeOut(function(){ window.location.href = 'rubrica.php'; });
          }//success
     });//ajax
   });     
 });//elimina
 
   $('#salva').click(function(){
    var id_update = $('#id_update').val();
    var cognome_up = $('#cognome_up').val();
    var nome_up = $('#nome_up').val();
    var email_up = $('#email_up').val();
    var password_up = $('#password_up').val();
    var password_check_up = $('#password_check_up').val();
    var username_up = $('#username_up').val();
    var tipo_up = $('#tipo_up').val();
    var stato_up = $('input[name=stato_usr_up]:checked').val();
    var schede_up='';
    $("input[name=usrScheda]:checked").each(function () {
      var scheda_up = $(this).val();
      schede_up+=scheda_up+', ';
    });
    var errori_up='';
    if (!cognome_up) {
       errori_up += 'Il campo COGNOME non può essere vuoto<br/>';
       $('#cognome_up').addClass('errore');}
    else{$('#cognome_up').removeClass('errore');}
    if (!nome_up) {
       errori_up += 'Il campo NOME non può essere vuoto<br/>';
       $('#nome_up').addClass('errore');}
    else{$('#nome_up').removeClass('errore');}   
    if (!email_up) {
       errori_up += 'Il campo MAIL non può essere vuoto<br/>';
       $('#email_up').addClass('errore');}
    else{
       if (!validEmail(email_up)) {
        errori_up += 'La MAIL inserita non è valida<br/>';
        $('#email_up').addClass('errore');
       }else{$('#email_up').removeClass('errore');}
      $('#email_up').removeClass('errore');
    }
    if (!password_up) {
       errori_up += 'Il campo PASSWORD non può essere vuoto<br/>';
       $('#password_up').addClass('errore');}
    else{$('#password_up').removeClass('errore');}

    if (password_up != password_check_up) {
      errori_up += 'Le due PASSWORD non corrispondono<br/>';
      $('#password_up, #password_check_up').addClass('errore');}
    else{$('#password_up, #password_check_up').removeClass('errore');}

    
    if (!username_up) {
       errori_up += 'Il campo USERNAME non può essere vuoto<br/>';
       $('#username_up').addClass('errore');}
    else{$('#username_up').removeClass('errore');}
    if (!tipo_up) {
       errori_up += 'Il campo TIPOLOGIA DEL SOGGETTO non può essere vuoto<br/>';
       $('#tipo_up').addClass('errore');}
    else{$('#tipo_up').removeClass('errore');}
   
    
    if(!schede_up){
       errori_up += 'Devi scegliere almeno un valore per le SCHEDE ABILITATE<br/>';
       $('#schede_abilitate_up').addClass('errore');}
    else{$('#schede_abilitate_up').removeClass('errore');}

    if(errori_up){
   	errori_up = '<h3>I seguenti campi sono obbligatori e vanno compilati:</h3><ol>' + errori_up;
        $("<div id='errorDialog_up'>" + errori_up + "</ol></div>").dialog({
          resizable: false,
          height: 'auto',
          width: 'auto',
          position: 'top',
          title:'Errori',
          modal: true,
          buttons: {'Chiudi finestra': function() {$(this).dialog('close');} }//buttons
       });//dialog
       return false;
   }else{
   	$.ajax({
          url: 'inc/update_usr_script.php',
          type: 'POST', 
          data: {id_update:id_update,cognome_up:cognome_up, nome_up:nome_up, email_up:email_up, password_up:password_up, username_up:username_up, tipo_up:tipo_up, stato_up:stato_up, schede_up:schede_up},
          success: function(data){
           $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
            .delay(2500)
            .fadeOut(function(){ $(this).dialog("close");window.location.href = 'utenti.php'; })
           ;
         }//success
      });//ajax
    }
 });
 
});

</script>