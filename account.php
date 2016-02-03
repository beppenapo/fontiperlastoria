<?php
session_start();
ini_set( "display_errors", 0);
require_once("inc/db.php");
if (!isset($_SESSION['username'])){$_SESSION['username']='guest';}
$id=$_SESSION['id_user'];
$attivo=($_SESSION['attivo']==1 ? $attivo='attivo' : $attivo='non attivo');
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
  <link rel="shortcut icon" href="img/icone/favicon.ico" />
  <style type="text/css">
    table{width:100% !important;}
    table td{vertical-align: top !important;padding:0px !important;}
    div.slide{margin:0px 10px 0px 10px; border:1px solid #CFC4B1;padding:10px;}
    textarea{height: 20px !important;}
    span.msg{margin-left:20px;color:red;}
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
   <li id="catalogoTitle" class="livAttivo">Informazioni sull'utente <b><?php echo($_SESSION['nome'].' '.$_SESSION['cognome']);?></b></li>
  </ul>
 </div>
 
 <div id="skArcheoContent">
  <div class="inner primo">
   <?php if($_SESSION['username']=='guest') {
      echo"<h1 style='text-align:center;width:80% !important;'>Per accedere alla pagina devi prima effettuare il <a href='login.php'>login</a></h1>";
    }else {?>
  <div style="">
<div class="toggle" style="margin:30px 0px 10px;">
 <div class="sezioni sezAperta" style="margin:10px 10px 0px 10px; border:none;"> </div>
 <div class="slide">
  <label style="text-align:center;display:block;font-weight:bold;">DATI MODIFICABILI</label>
  <h2 class="titoletto">Informazioni personali</h2>
  <table>
   <tr>
    <td>
     <label>COGNOME</label>
     <textarea id="cognome" class="form"><?php echo($_SESSION['cognome']);?></textarea>
    </td>
    <td>
     <label>NOME</label>
     <textarea id="nome" class="form"><?php echo($_SESSION['nome']);?></textarea>
    </td>
    <td>
     <label>E-MAIL</label>
     <textarea id="email" class="form"><?php echo($_SESSION['email']);?></textarea>
    </td>
   </tr>
   <tr>
    <td colspan="3"><label class="update" id="informazioni">modifica sezione</label><span id="infoMsg" class="msg"></span></td>
   </tr>
  </table>
    
  <h2 class="titoletto">Dati login</h2> 
  <table>
   <tr>
    <td>
     <label>USERNAME</label>
     <textarea id="username" class="form"><?php echo($_SESSION['username']);?></textarea>
    </td>
   </tr>
   <tr>
    <td><label class="update" id="datiLogin">modifica sezione</label><span id="loginMsg" class="msg"></span></td>
   </tr>
  </table>
   
  <h2 class="titoletto">Cambia password</h2>
  <table>
   <tr>
    <td>
     <label>NUOVA PASSWORD</label>
     <input type="password" id="password" name="password" class="form"/> 
    </td>
    <td>
     <label>CONFERMA NUOVA PASSWORD</label>
     <input type="password" id="password_check" name="password_check" class="form"/> 
    </td>
   </tr>
   <tr>
    <td colspan="3"><label class="update" id="cambiaPassword">modifica sezione  </label><span id="pwdMsg" class="msg"></span></td>
   </tr>
  </table>
 <hr />
  <label style="text-align:center;display:block;font-weight:bold;">DATI NON MODIFICABILI</label>
  <?php
   $query = ("
    SELECT usr.tipo AS id_tipo, lista_tipo_usr.definizione AS tipo, usr.schede 
    FROM usr, lista_tipo_usr
    WHERE usr.tipo = lista_tipo_usr.id AND id_user = $id;
");
   $exec = pg_query($connection, $query);
   $a = pg_fetch_array($exec, 0, PGSQL_ASSOC);
  ?>
  <label>TIPOLOGIA DEL SOGGETTO: </label> <label><b><?php echo($a['tipo']);?></b></label>
  <br/>
  <label>STATO UTENTE: </label> <label><b><?php echo($attivo);?></b></label>
  <br/>
  <label>SCHEDE ABILITATE: </label> <label><b><?php echo($a['schede']);?></b></label>
 
  </div>
</div>
</div>
  
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
<script type="text/javascript" src="lib/funzioni.js"></script>
<script type="text/javascript" >
var id='<?php echo($id);?>';
$(document).ready(function() {
    $('#informazioni').click(function(){
        var cognome = $('#cognome').val();
        var nome = $('#nome').val();
        var email = $('#email').val();
        if (!cognome) {
            $('#infoMsg').text('Il campo COGNOME non può essere vuoto.');
            $('#cognome').addClass('errore');
            return false;
        }else{
            $('#infoMsg').text('');
            $('#cognome').removeClass('errore');
        }
        if (!nome) {
            $('#infoMsg').text('Il campo NOME non può essere vuoto');
            $('#nome').addClass('errore');
            return false;
        }else{
            $('#infoMsg').text('');
            $('#nome').removeClass('errore');
        }
        if (!email) {
            $('#infoMsg').text('Il campo MAIL non può essere vuoto');
            $('#email').addClass('errore');
            return false;
        }else{
            if (!validEmail(email)) {
                $('#infoMsg').text('La MAIL inserita non è valida');
                $('#email').addClass('errore');
                return false;
            }else{
                $('#infoMsg').text('');
                $('#email').removeClass('errore');
            }
            $('#email').removeClass('errore');
        }
        $.ajax({
            url: 'inc/account1_update.php',
            type: 'POST', 
            data: {id:id,cognome:cognome, nome:nome, email:email},
            success: function(data){
                $('#infoMsg').text(data).delay(2500).fadeOut();
                $('#cognome').val(cognome);
                $('#nome').val(nome);
                $('#email').val(email);
            }//success
        });//ajax
    });

    $('#datiLogin').click(function(){
        var username = $('#username').val();
        if (!username) {
            $('#loginMsg').text('Il campo USERNAME non può essere vuoto');
            $('#username').addClass('errore');
            return false;
        }else{
            $('#loginMsg').text('');
            $('#username').removeClass('errore');
        }
        $.ajax({
            url: 'inc/account2_update.php',
            type: 'POST', 
            data: {id:id,username:username},
            success: function(data){
                $('#loginMsg').delay(2500).fadeOut();
                $('#username').val(username);
            }
        });
    });  
   
   $('#cambiaPassword').click(function(){
    var pwd = $('#password').val();
    var pwd_check = $('#password_check').val(); 
    if (!pwd) {
        $("#pwdMsg").text('Per cambiare password ne devi inserire una nuova!');
        $('#password').addClass('errore'); 
        return false;
    }else{
        $("#pwdMsg").text('');
        $('#password').removeClass('errore');
    }
    if (pwd != pwd_check) {
      $("#pwdMsg").text('Le due PASSWORD non corrispondono');
      $('#password, #password_check').addClass('errore');
      return false;
    }else{
        $("#pwdMsg").text('');
        $('#password, #password_check').removeClass('errore');
    }
    $.ajax({
          url: 'inc/account3_update.php',
          type: 'POST', 
          data: {id:id,pwd:pwd},
          success: function(data){
             $("#pwdMsg").text(data).delay(2500).fadeOut();
             $('#password').val('');
             $('#password_check').val('');
          }//success
     });//ajax
   });    
});//funzione principale
</script>

</body>
</html>
