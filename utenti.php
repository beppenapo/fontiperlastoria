<?php
session_start();
ini_set( "display_errors", 0);
require("inc/db.php");

if (!isset($_SESSION['username'])){$_SESSION['username']='guest';}
$where = ($_SESSION['tipo']==1)?'usr.tipo = lista_tipo_usr.id' : 'usr.tipo = lista_tipo_usr.id and usr.tipo != 1';
?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//IT"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="IT" >
 <head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  
  <meta name="author" content="Giuseppe Naponiello" />
  <meta name="keywords" content="gfoss, archaeology, anthropology, openlayer, jquery, grass, postgresql, postgis, qgis, webgis, informatic" />
  <meta name="description" content="Le fonti per la storia. Per un archivio delle fonti sulle valli di Primiero e Vanoi" />
  <meta name="robots" content="INDEX,FOLLOW" />
  <meta name="copyright" content="&copy;2011 Museo Provinciale" />

  <title>Le fonti per la storia. Per un archivio delle fonti sulle valli di Primiero e Vanoi</title>
  <link href="css/scheda.css" type="text/css" rel="stylesheet" media="screen" />
  <link href="lib/jquery-ui-1.11.4/jquery-ui.min.css" type="text/css" rel="stylesheet" media="screen" />
  <link rel="shortcut icon" href="img/icone/favicon.ico" />
  <style type="text/css">
    div#content{border: 1px solid #C1FEAE;margin-top:50px;}
    table.mainData{width:100% !important;}
    table.mainData td{vertical-align: top !important;}
    div.slide{margin:0px 10px 0px 10px; border:1px solid #CFC4B1;padding:10px;}
    textarea{height: 20px !important;}
  </style>

</head>
<body>
 <div id="container">
  <div id="wrap">
   <?php if ($_SESSION['username']!='guest'){require("inc/sessione.php"); }?>
   <div id="content">
   <?php require_once('inc/logoHub.php'); ?>
 <div id="livelloScheda">
  <ul>
   <li id="catalogoTitle" class="livAttivo">UTENTI</li>
  </ul>
 </div>
 
 <div id="skArcheoContent">
  <div class="inner primo">
   <?php if(($_SESSION['username']=='guest')||($_SESSION['tipo'] > 3)) {
      echo"<h1 style='text-align:center;width:80% !important;'>Per accedere alla pagina devi prima effettuare il <a href='login.php'>login</a></h1>";
    }else {?>
  <div style="">
  <?php if($_SESSION['tipo'] == 1) {?>
<div class="toggle" style="margin:30px 0px 10px;">
 <div class="sezioni sezAperta" style="margin:10px 10px 0px 10px; border:none;">
   <h2>Inserisci un nuovo utente</h2>
 </div>
 <div class="slide">
  <label style="text-align:center;display:block;font-weight:bold;">* TUTTI I CAMPI SONO OBBLIGATORI.</label>

  <label>COGNOME</label>
  <textarea id="cognome" class="form"></textarea>
  
  <label>NOME</label>
  <textarea id="nome" class="form"></textarea>
  
  <label>E-MAIL</label>
  <textarea id="email" class="form"></textarea>
 
  <label>USERNAME</label>
  <textarea id="username" class="form"></textarea> 
 
  <label>PASSWORD</label>
  <input type="password" id="password" name="password" class="form"/> 
  
  <label>CONFERMA PASSWORD</label>
  <input type="password" id="password_check" name="password_check" class="form"/> 
 
  <label>TIPOLOGIA DEL SOGGETTO</label>
  <select id="tipo" name="tipo" class="form">
      <option value="">--Seleziona una tipologia dalla lista --</option>
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
  <label for="attivo" class="input"><input type="radio" id="attivo" name="stato_usr" value="1" checked/> attivo</label><br/>
  <label for="nonattivo" class="input"><input type="radio" id="nonattivo" name="stato_usr" value="2" />non attivo</label>
  </div>
  <div id="schede_abilitate" style="margin:15px 0px;">
  <label>SCHEDE ABILITATE</label><br/>
  <?php
    $query =  ("SELECT * FROM lista_dgn_tpsch order by definizione asc;");
         $result = pg_query($connection, $query);
         $righe = pg_num_rows($result);
         $i=0;
         for ($i = 0; $i < $righe; $i++){
           $idTipo = pg_result($result, $i, "id");
           $defTipo = pg_result($result, $i, "definizione");
           echo "<label for=\"$idTipo\" class=\"input\"><input type=\"checkbox\" name=\"schede\" id=\"$idTipo\" value=\"$defTipo\" /> $defTipo</label><br/>";
         }
       ?> 
   </div>
   <label class="update" id="new_usr">Salva record </label>
  </div>
</div><!--nuvo utente -->
 <?php } ?>       
  <?php
   $query = ("
SELECT usr.id_user, usr.nome, usr.cognome, usr.email, usr.pwd, usr.username, usr.tipo AS id_tipo, lista_tipo_usr.definizione AS tipo, usr.attivo, usr.schede
FROM usr, lista_tipo_usr
WHERE $where
ORDER BY cognome ASC
");
   $exec = pg_query($connection, $query);
   $row = pg_num_rows($exec);
   $caption="Il database contiene ".$row." utenti registrati";
  ?> 
 <div style="margin-left:10px;"><legend id="legenda"></legend></div>
  <table id="catalogoTable" style="width:98%;">
   <caption></caption>
   <thead>
    <tr>
     <th>UTENTE</th> 
     <th>MAIL</th> 
     <th>USERNAME</th> 
     <th>TIPO UTENTE</th>
     <th>SCHEDE ABILITATE</th> 
     <th>STATO UTENTE</th>
    </tr>
   </thead>
   <tbody>
  <?php
   if($row != 0) {
     for ($x = 0; $x < $row; $x++){
     	 $id_user = pg_result($exec, $x,"id_user");
     	 $cognome = pg_result($exec, $x,"cognome");
     	 $nome = pg_result($exec, $x,"nome");
     	 $mail = pg_result($exec, $x,"email");
     	 $username = pg_result($exec, $x,"username"); 
     	 $tipoId = pg_result($exec, $x,"id_tipo");	
     	 $tipoDef = pg_result($exec, $x,"tipo");
     	 $stato = pg_result($exec, $x,"attivo");
     	 $stato = ($stato == 1 ? 'attivo':'non attivo');
     	 
     	 
     	 $schede = pg_result($exec, $x,"schede");
     	 
     	 //$schede = substr($schede,0 ,-2);
       echo "<tr class=\"link\" id=\"$id_user\" title=\"clicca per modificare o eliminare il record\"> 
              <td>$cognome $nome</td>
              <td>$mail</td>
              <td>$username</td>
              <td>$tipoDef</td>
              <td>$schede</td>
              <td>$stato</td>
            </tr>";
     }
   }
  ?>
  </tbody>
  </table>
  
  <input type='hidden' id='current_page' />  
  <input type='hidden' id='show_per_page' /> 
  <div class='page_navigation'></div> 
  </div>
  
  <!-- An empty div which will be populated using jQuery   
  <div class='page_navigation'></div> -->
   <?php } ?>
  </div>
 </div>
   </div><!--content-->
   <div id="footer"><?php require_once ("inc/footer.php"); ?></div><!--footer-->
  </div><!-- wrap-->
 </div><!--container-->
 
 <!--div invisibili -->
<div id="dialog">  </div>
<script type="text/javascript" src="lib/jquery-core/jquery-1.12.0.min.js"></script>
<script type="text/javascript" src="lib/jquery-ui-1.11.4/jquery-ui.min.js"></script>
<script type="text/javascript" src="lib/select.js"></script>
<script type="text/javascript" src="lib/funzioni.js"></script>
<script type="text/javascript" >
$(document).ready(function() {
   $('.slide').hide();
   $('.sezioni').click(function(){
   	$('.slide').slideToggle();
   	//$('.sezioni').toggleClass('sezAperta');
   });
   
   $('#new_usr').click(function(){
    var cognome = $('#cognome').val();
    var nome = $('#nome').val();
    var email = $('#email').val();
    var password = $('#password').val();
    var password_check = $('#password_check').val();
    var username = $('#username').val();
    var tipo = $('#tipo').val();
    var stato = $('input[name=stato_usr]:checked').val();
    var schede='';
    $("input[name=schede]:checked").each(function () {
      var scheda = $(this).val();
      schede+=scheda+', ';
    });
    //alert(cognome+'\n'+nome+'\n'+email+'\n'+password+'\n' +username+'\n'+tipo+'\n'+stato+'\n'+schede);return false;
    var errori='';
    if (!cognome) {
       errori += 'Il campo COGNOME non può essere vuoto<br/>';
       $('#cognome').addClass('errore');}
    else{$('#cognome').removeClass('errore');}
    if (!nome) {
       errori += 'Il campo NOME non può essere vuoto<br/>';
       $('#nome').addClass('errore');}
    else{$('#nome').removeClass('errore');}   
    if (!email) {
       errori += 'Il campo MAIL non può essere vuoto<br/>';
       $('#email').addClass('errore');}
    else{
       if (!validEmail(email)) {
        errori += 'La MAIL inserita non è valida<br/>';
        $('#email').addClass('errore');
       }else{$('#email').removeClass('errore');}
      $('#email').removeClass('errore');
    }
    if (!password) {
       errori += 'Il campo PASSWORD non può essere vuoto<br/>';
       $('#password').addClass('errore');}
    else{$('#password').removeClass('errore');}

    if (password != password_check) {
      errori += 'Le due PASSWORD non corrispondono<br/>';
      $('#password, #password_check').addClass('errore');}
    else{$('#password, #password_check').removeClass('errore');}

    
    if (!username) {
       errori += 'Il campo USERNAME non può essere vuoto<br/>';
       $('#username').addClass('errore');}
    else{$('#username').removeClass('errore');}
    if (!tipo) {
       errori += 'Il campo TIPOLOGIA DEL SOGGETTO non può essere vuoto<br/>';
       $('#tipo').addClass('errore');}
    else{$('#tipo').removeClass('errore');}
   
    
    if(!schede){
       errori += 'Devi scegliere almeno un valore per le SCHEDE ABILITATE<br/>';
       $('#schede_abilitate').addClass('errore');}
    else{$('#schede_abilitate').removeClass('errore');}

    if(errori){
   	errori = '<h3>I seguenti campi sono obbligatori e vanno compilati:</h3><ol>' + errori;
        $("<div id='errorDialog'>" + errori + "</ol></div>").dialog({
          resizable: false,
          width: 'auto',
          title:'Errori',
          modal: true,
          buttons: {'Chiudi finestra': function() {$(this).dialog('close');} }//buttons
       });//dialog
       return false;
   }else{
   	$.ajax({
          url: 'inc/usr_ins_script.php',
          type: 'POST', 
          data: {cognome:cognome, nome:nome, email:email, password:password, username:username, tipo:tipo, stato:stato, schede:schede},
          success: function(data){
             $(data)
               .dialog()
               .delay(2500)
               .fadeOut(function(){ $(this).dialog("close");location.reload(); });
          }//success
     });//ajax
   }
 });

	$('.link').click(function(){
	    var id = $(this).attr('id');
       //alert(id); return false;
       $.ajax({
          url: 'inc/form_update/utenti_update.php',
          type: 'POST', 
          data: {id:id},
          success: function(data){
          	 $("#dialog").html(data);
             $("#dialog").dialog({
               resizable:false,
               modal:true,
               width: 700,
               title: "Modifica sezione"
             });
          }
     });
	});
});//funzione principale
</script>

</body>
</html>
