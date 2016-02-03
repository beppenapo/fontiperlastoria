<?php
session_start();
if (!isset($_SESSION['username'])){$_SESSION['username']='guest';}
$idUsr = $_SESSION['id'];
ini_set( "display_errors", 0);
require("inc/db.php");

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
  <link href="lib/jquery-ui-1.11.4/jquery-ui.min.css" type="text/css" rel="stylesheet" media="screen" />
  <link href="css/jHtmlArea.css" type="text/css" rel="stylesheet" media="screen" />
  <link href="css/jHtmlArea.ColorPickerMenu.css" type="text/css" rel="stylesheet" media="screen" />
  <link href="css/scheda.css" type="text/css" rel="stylesheet" media="screen" />
  <link href="css/post.css" type="text/css" rel="stylesheet" media="screen" />
  <link rel="shortcut icon" href="img/icone/favicon.ico" />
  
  <style type="text/css">

  </style>

</head>
<body>
 <div id="container">
  <div id="wrap">
   <?php if ($_SESSION['username']!='guest'){require("inc/sessione.php"); }?>
   <div id="content">
    <?php if ($_SESSION['username']=='guest'){?>
    <div id="wrapBacheca">
     <div id="tabProg">
      <div align="center" style="padding-top:150px;">
       <img src="img/layout/noAccess.png" />
       <h1>Attenzione! Stai cercando di entrare in una sezione privata del sito</h1>
       <h3>Per visualizzare i contenuti della pagina devi prima effettuare il login.</h3>
      </div>
     </div>
    </div>
    <?php }else{ ?>
    <div id="logoSchedaSx"><img src="img/layout/logo.png" alt="logo" /></div> 
    <div id="livelloScheda"><ul><li id="catalogoTitle" class="livAttivo">NOTEPAD</li></ul></div>
    <div id="skArcheoContent"> 
     <div class="inner primo">
      <div id='nuovoPost' class='sezioni sezAperta' style='border-top:none !important;'><h2>Nuovo post</h2></div>
      <div id='wrapEditor'>
       <div id="textarea">
         <label>Titolo</label>
         <textarea id="titoloPost" class="form"></textarea>
         <textarea id="notepad" class="form"></textarea>
       </div>   
       <div style="clear:both;padding-left:6px;"><button id="salva" usr="<?php echo($idUsr); ?>">Salva post</button><span id='msg'></span></div>
      </div>
      <div id="wrapPost">
        <table id='tbdata'>
         <?php 
           $q1=("select distinct data, to_char(data, 'YYYY') as anno, to_char(data, 'MM') as mese, to_char(data,'DD') as giorno from post order by data desc");
           $r1=pg_query($connection, $q1);
           $row1=pg_num_rows($r1);
           if($row1>0){
             for($x=0;$x<$row1;$x++){	
               $data = pg_result($r1, $x,"data");
               $anno = pg_result($r1, $x,"anno");
               $mese = pg_result($r1, $x,"mese");
               $giorno = pg_result($r1, $x,"giorno");
               echo "<tr> 
                       <td class='tddata'>
                        <div class='wrapdata'>
                         <p class='data giorno'>$giorno</p>
                         <p class='data mese'>$mese</p>
                         <p class='data anno'>$anno</p>
                        </div>
                       </td>
                       <td class='tdtesto'>
               ";
               $q2=("select p.id, p.titolo, p.utente, p.testo, u.cognome, u.nome from post p, usr u where p.utente=u.id_user and p.data = '$data' order by data desc, id asc");
               $r2=pg_query($connection, $q2);
               $row2=pg_num_rows($r2);
               if($row2>0){
                for($z=0;$z<$row2;$z++){
                   $idPost = pg_result($r2, $z,"id");
                   $utente = pg_result($r2, $z,"utente");  
                   $nome = pg_result($r2, $z, "nome");	
                   $cognome = pg_result($r2, $z, "cognome");
                   $testo = pg_result($r2, $z,"testo");
                   $testo=stripslashes($testo);
                   $titolo = pg_result($r2, $z,"titolo");
                   $titolo=stripslashes($titolo);

                   echo "<div class='wrapPostContent'>
                          <p class='headerPost'><strong>$nome $cognome</strong> ha scritto:</p>
                          <h1 id='title$idPost' class='titlePost' style='width:70% !important; margin-bottom:10px !important;'>$titolo</h1>
                          <div id='post$idPost'class='post'>$testo</div>
                          <div class='gestionePost'>
                           <label class='modPost' post='$idPost'>modifica </label> 
                           <label class='delPost' post='$idPost'>elimina</label>
                          </div>
                     ";
                   
                   $q3=("select c.id, c.data, c.utente, c.testo, u.cognome, u.nome from commenti c, usr u, post where c.utente=u.id_user and c.id_post = post.id and post.id = $idPost order by data asc, id asc");
                   $r3=pg_query($connection, $q3);
                   $row3=pg_num_rows($r3);
                   echo "<div class='wrapCommentiContent'>
                          <div class='commentiHeader'>
                           <span>Commenti inseriti: $row3</span><label class='commenta' ref='$idPost' usr='$idUsr'>commenta</label>
                          </div>";
                   if($row3>0){
                    for($w=0;$w<$row3;$w++){
                       $idCommento = pg_result($r3, $w,"id");
                       $data2 = pg_result($r3, $w, "data");
                       $utente2 = pg_result($r3, $w,"utente");  
                       $nome2 = pg_result($r3, $w, "nome");	
                       $cognome2 = pg_result($r3, $w, "cognome");
                       $testo2 = pg_result($r3, $w,"testo");
                       $testo2=stripslashes($testo2);
                       
                       echo "<div class='commentoCorpo'>
                              <p class='headerCommento'>Il $data2 $nome2 $cognome2 ha commentato:</p>
                              <div id='commento$idCommento' class='commento'>$testo2</div>
                              <div class='gestioneCommenti'>
                               <label class='modComm' comm='$idCommento'>modifica </label> 
                               <label class='delComm' comm='$idCommento'>elimina</label>
                              </div>
                             </div>
                        "; 
                    }//terzo for
                   }
                   echo "</div>"; //wrapCommentiContent
                   echo "</div>"; //wrapPostContent 
                }//secondo for
               }
               echo "</td></tr>";
             }//primo for
           }else{
             echo "<div><h2>Qualcosa è andato storto!</h2></div>";
           }
         ?>   
        </table>
      </div>
     </div>
    </div>
    <?php } ?>
   </div><!--content-->
   <div id="footer"><?php require_once ("inc/footer.inc"); ?></div><!--footer-->
  </div><!-- wrap-->
 </div><!--container-->
 
 <!--div invisibili -->
<div id="modPostForm" style="display:none;">
 <input type="hidden" id="idPostMod" value="" />
 <textarea id="modPostTitolo" class="form"></textarea>
 <textarea id="modPostTesto" class="form"></textarea>
 <div class='errormsg'><span id='msg3'></span></div>
 <div class="login2" style="margin-top:20px;" id="modPostSave">Salva</div>
 <div class="chiudiForm login2">Annulla</div>
</div>

<div id="modCommentoForm" style="display:none;">
 <input type="hidden" id="idComMod" value="" />
 <textarea id="modCommTesto" class="form"></textarea>
 <div class='errormsg'><span id='msg4'></span></div>
 <div class="login2" style="margin-top:20px;" id="modCommSave">Salva</div>
 <div class="chiudiForm login2">Annulla</div>
</div>

<div id="commentoForm" style="display:none;">
 <input type="hidden" id="idPost" value="" />
 <input type="hidden" id="idUsr" value="" />
 <textarea id="commentoTesto" class="form"></textarea>
 <div class='errormsg'><span id='msg2'></span></div>
 <div class="login2" style="margin-top:20px;" id="newComment">Salva</div>
 <div class="chiudiForm login2">Annulla</div>
</div>

<div id="delPostDialog" style="display:none; text-align:center;">
 <h2>Stai per eliminare un post</h2>
 <p>Eliminando un post eliminerai anche tutti i commenti associati</p>
 <p>Vuoi procedere con l'eliminazione?</p>
 <div class='errormsg'><span id='msg5'></span></div>
 <div id="no" class="login2">NO, non eliminare</div>
 <div id="si" class="login2">SI, procedi con l'eliminazione</div>
</div>

<div id="delCommDialog" style="display:none; text-align:center;">
 <h2>Stai per eliminare un commento</h2>
 <p>Vuoi procedere con l'eliminazione?</p>
 <div class='errormsg'><span id='msg6'></span></div>
 <div id="no2" class="login2">NO, non eliminare</div>
 <div id="si2" class="login2">SI, procedi con l'eliminazione</div>
</div>

<script type="text/javascript" src="lib/jquery-core/jquery-1.12.0.min.js"></script>
<script type="text/javascript" src="lib/jquery-ui-1.11.4/jquery-ui.min.js"></script>
<script type="text/javascript" src="lib/funzioni.js"></script>
<script type="text/javascript" src="lib/jHtmlArea-0.7.5.min.js"></script>
<script type="text/javascript" src="lib/jHtmlArea.ColorPickerMenu-0.7.0.js"></script>
<script type="text/javascript" >
$(document).ready(function() {
 $('#wrapEditor').hide();
 $('#nuovoPost').click(function(){$('#wrapEditor').toggle('fast');})


//************* nuovo post ***********************//
 $("#salva").click(function(){
   var usr = $(this).attr('usr');
   var post = $("#notepad").val();
   var titoloPost = $("#titoloPost").val();
   //console.log(usr + ', '+post);
   if(!titoloPost){$('#msg').text('Devi inserire un titolo per il post!');}
   else if(!post){$('#msg').text('Il post risulta vuoto! Per creare un nuovo post devi scrivere qualcosa!');}
   else{
    $.ajax({
      type: "POST",
      url: "inc/postInsertScript.php",
      data: {usr:usr,titoloPost:titoloPost, post:post},
      cache: false,
      success: function(html){$('#msg').text('post inserito correttamente').delay(2500).fadeOut(function(){location.reload();});}
    });
   } 
 });//click


//****************** nuovo commento *****************************//
 $("#commentoForm").dialog({
  autoOpen: false,
  resizable:false,
  height: 'auto',
  width: 500,
  title: "Aggiungi commento"
 });//dialog
 
 $('.commenta').click(function(){
   var idPost = $(this).attr('ref');
   var idUsr = $(this).attr('usr');
   $('#idPost').val(idPost);
   $('#idUsr').val(idUsr);
   $('#commentoForm').dialog('open');
   $("#commentoForm").dialog("option", "position", ['center','center']);
 });

$('#newComment').click(function(){
  var idPost = $('#idPost').val();
  var idUsr = $('#idUsr').val();
  var commento = $('#commentoTesto').val();
  //console.log('post: '+idPost+'\nusr: '+idUsr+'\ncommento: '+commento);
  if(!commento){$('#msg2').text('Il commeto risulta vuoto! Per commentare un post devi scrivere qualcosa!');}
   else{
    $.ajax({
      type: "POST",
      url: "inc/commentoInsertScript.php",
      data: {idPost:idPost, idUsr:idUsr, commento:commento},
      cache: false,
      success: function(html){$('#msg2').text('post inserito correttamente').delay(2500).fadeOut(function(){location.reload();});}
    });
   }
});	

//***************************  modifica post *****************************//
 $("#modPostForm").dialog({
  autoOpen: false,
  resizable:false,
  height: 'auto',
  width: 500,
  title: "Modifica post"
 });//dialog
 
 $('.modPost').click(function(){
   var modPost = $(this).attr('post');
   var modPostTitolo = $('#title'+modPost).text();
   var modPostTesto = $('#post'+modPost).html();
   $('#idPostMod').val(modPost);
   $('#modPostTitolo').val(modPostTitolo);
   //$('#modPostTesto').val(modPostTesto);
   $('#modPostForm').dialog('open');
   $("#modPostForm").dialog("option", "position", ['center','center']);
   $('#modPostTesto').htmlarea({
     toolbar: [
       ["html"]
       , ["forecolor", "|", "bold", "italic", "underline", "strikethrough"]
       , ["p", "h1", "h2", "h3"]
       , ["image","link", "unlink"]
       , ["orderedList", "unorderedList"]
       , ["indent", "justifyleft", "justifycenter", "justifyright"]
       , ["horizontalrule"]
     ],
     loaded:function(){this.pasteHTML(modPostTesto);}
   });
 });

 $('#modPostSave').click(function(){
   var modIdPost     = $('#idPostMod').val();
   var modTitoloPost = $('#modPostTitolo').val();
   var modTestoPost  = $('#modPostTesto').val();
   //console.log('titolo: '+modTitoloPost+'\ntesto: '+modTestoPost);
   if(!modTitoloPost){$('#msg3').text('Devi inserire un titolo per il post!');}
   else if(!modTestoPost){$('#msg3').text('Il post risulta vuoto! Per creare un nuovo post devi scrivere qualcosa!');}
   else{
    $.ajax({
      type: "POST",
      url: "inc/postUpdateScript.php",
      data: {modIdPost:modIdPost, modTitoloPost:modTitoloPost, modTestoPost:modTestoPost},
      cache: false,
      success: function(html){$('#msg3').text(html).delay(2500).fadeOut(function(){location.reload();});}
    });
   }
 });
//*************************************************************************************//

//***************************  modifica commento *****************************//
 $("#modCommentoForm").dialog({
  autoOpen: false,
  resizable:false,
  height: 'auto',
  width: 500,
  title: "Modifica commento"
 });//dialog
 
 $('.modComm').click(function(){
   var modComm = $(this).attr('comm');
   var modCommTesto = $('#commento'+modComm).html();
   $('#idComMod').val(modComm);
   $('#modCommentoForm').dialog('open');
   $("#modCommentoForm").dialog("option", "position", ['center','center']);
   $('#modCommTesto').htmlarea({
     toolbar: [
       ["html"]
       , ["forecolor", "|", "bold", "italic", "underline", "strikethrough"]
       , ["p", "h1", "h2", "h3"]
       , ["image","link", "unlink"]
       , ["orderedList", "unorderedList"]
       , ["indent", "justifyleft", "justifycenter", "justifyright"]
       , ["horizontalrule"]
     ],
     loaded:function(){this.pasteHTML(modCommTesto);}
   });
 });

 $('#modCommSave').click(function(){
   var modIdComm     = $('#idComMod').val();
   var modCommTesto  = $('#modCommTesto').val();
   if(!modCommTesto){$('#msg4').text('Il commento risulta vuoto! Devi scrivere qualcosa!');}
   else{
    $.ajax({
      type: "POST",
      url: "inc/commentoUpdateScript.php",
      data: {modIdComm:modIdComm, modCommTesto:modCommTesto},
      cache: false,
      success: function(html){$('#msg4').text(html).delay(2500).fadeOut(function(){location.reload();});}
    });
   }
 });
//*************************************************************************************//

//********************** elimina post ************************************************//
 $('.delPost').click(function(){
   var id = $(this).attr('post');
   $("#delPostDialog").dialog({
      resizable:false,
      height: 300,
      width: 500,
      title: "ATTENZIONE!!!"
   });
   $('#si').click(function(){
     $.ajax({
          url: 'inc/deletePost.php',
          type: 'POST',
          data: {id:id},
          success: function(data){$('#msg5').text(data).delay(2500).fadeOut(function(){location.reload();});}//success
     });//ajax
   });
   $('#no').click(function(){$(this).closest('.ui-dialog-content').dialog('close');});
 });

//********************** elimina commento ************************************************//
 $('.delComm').click(function(){
   var id = $(this).attr('comm');
   $("#delCommDialog").dialog({
      resizable:false,
      height: 300,
      width: 500,
      title: "ATTENZIONE!!!"
   });
   $('#si2').click(function(){
     $.ajax({
          url: 'inc/deleteCommento.php',
          type: 'POST',
          data: {id:id},
          success: function(data){$('#msg6').text(data).delay(2500).fadeOut(function(){location.reload();});}//success
     });//ajax
   });
   $('#no2').click(function(){$(this).closest('.ui-dialog-content').dialog('close');});
 });



 $('#notepad, #commentoTesto').htmlarea({
  toolbar: [
      ["html"]
    , ["forecolor", "|", "bold", "italic", "underline", "strikethrough"]
    , ["p", "h1", "h2", "h3"]
    , ["image","link", "unlink"]
    , ["orderedList", "unorderedList"]
    , ["indent", "justifyleft", "justifycenter", "justifyright"]
    , ["horizontalrule"]
  ]
 });

 $('.chiudiForm').click(function(){ 
  $(this).closest('.ui-dialog-content').dialog('close'); 
  $('#msg2').val('');
  $('#idPost').val('');
  $('#idUsr').val('');
 });
});//funzione principale
</script>

</body>
</html>
