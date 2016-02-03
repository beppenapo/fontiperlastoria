<?php
session_start();
if (!isset($_SESSION['username'])){$_SESSION['username']='guest';}
ini_set( "display_errors", 0);
$hub = $_SESSION['hub'];
require_once("inc/db.php");
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
    <link href="css/scheda.css" type="text/css" rel="stylesheet" media="screen" />
    <link rel="shortcut icon" href="img/icone/favicon.ico" />
    <style type="text/css">
        div#content{border: 1px solid #C1FEAE;margin-top:50px;}
        table.mainData{width:100% !important;}
        table.mainData td{vertical-align: top !important;}
        div.slide{margin:0px 10px 0px 10px; border:1px solid #CFC4B1;padding:10px;}
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
   <li id="catalogoTitle" class="livAttivo">ELENCO RICERCHE</li>
  </ul>
 </div>
 
 <div id="skArcheoContent">
  <div class="inner primo">
  <div style="">
  <?php
     $query = ("
select r.id, r.denric, r.enresp, r.respric, r.redattore, r.data, count(scheda.id) as schede
from ricerca r 
left join scheda on scheda.prv_id = r.id
where r.id != 1 
group by r.id, r.denric, r.enresp, r.respric, r.redattore, r.data
order by r.denric asc
");
   $exec = pg_query($connection, $query);
   $row = pg_num_rows($exec);
   if($tipo == 0) {$caption = "Il database contiene ".$row." schede";} else {$caption="Il database contiene ".$row." schede relative a fonti di tipo <b>".$legenda."</b>";}
  ?> 

  <!-- the input fields that will hold the variables we will use -->  
<input type='hidden' id='current_page' />  
<input type='hidden' id='show_per_page' /> 
<div class='page_navigation' style="margin:30px 10px 0px 10px;"></div> 

<div class="toggle" style="margin-bottom:10px;">
 <div class="sezioni sezAperta" style="margin:10px 10px 0px 10px; border:none;"><h2>Nuova ricerca</h2></div>
 <div class="slide">
   <label style="text-align:center;display:block;font-weight:bold;">TUTTI I CAMPI SONO OBBLIGATORI.</label>
   <label>DENOMINAZIONE RICERCA</label>
   <textarea id="denric_ins" class="form"></textarea>
   <label>ENTE RESPONSABILE</label>
   <textarea id="enresp_ins" class="form"></textarea>
   <label>RESPONSABILE RICERCA</label>
   <textarea id="respric_ins" class="form"></textarea>
   <label>REDATTORE</label>
   <textarea id="redattore_ins" class="form"></textarea>
   <label>DATA RICERCA</label>
   <textarea id="data_ins" class="form"></textarea>
   <br/>
   <label class="update" id="new_ricerca">Inserisci ricerca </label>
   <span id="newRicMsg"></span>
  </div>
</div>
        

 <div style="margin-left:10px;"><legend id="legenda"></legend></div>
  <table id="catalogoTable">
   <caption></caption>
   <thead>
    <tr>
     <th style="width:170px;">DENOMINAZIONE RICERCA</th>
     <th style="width:170px;">ENTE RESPONSABILE</th>
     <th style="width:170px;">RESPONSABILE RICERCA</th>
     <th style="width:150px;">REDATTORE</th>
     <th style="width:100px;">DATA</th>
     <th>NUM.SCHEDE</th>
    </tr>
   </thead>
   <tbody>
  <?php
   if($row != 0) {
     for ($x = 0; $x < $row; $x++){
       $id = pg_result($exec, $x,"id"); 	
       $denric = pg_result($exec, $x,"denric");
       $enresp = pg_result($exec, $x,"enresp");
       $respric = pg_result($exec, $x,"respric");
       $redattore = pg_result($exec, $x,"redattore");
       $data = pg_result($exec, $x,"data");
       $schede = pg_result($exec, $x,"schede");
       $denric = stripslashes($denric);
       $enresp = stripslashes($enresp);
       $respric = stripslashes($respric);
       $redattore = stripslashes($redattore);
       $data = stripslashes($data);
       //$denric = pg_escape_string($denric);
       echo "<tr class='link' id='$id' denric=\"$denric\" enresp=\"$enresp\" respric=\"$respric\" redattore=\"$redattore\" data=\"$data\" schede='$schede' title='clicca per modificare o eliminare la ricerca'><td>$denric</td><td>$enresp</td><td>$respric</td><td>$redattore</td><td>$data</td><td style='text-align:center;'>$schede</td></tr>";
     }
   }
  ?>
  </tbody>
  </table>
  </div>
  
  <!-- An empty div which will be populated using jQuery   
  <div class='page_navigation'></div> -->
  
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
<script type="text/javascript" src="lib/funzioni.js"></script>
<script type="text/javascript" >
$(document).ready(function() {
   $('.slide').hide();
   $('.sezioni').click(function(){$('.slide').slideToggle();});
   
    $('#new_ricerca').click(function(){
        var denric_ins = $('#denric_ins').val();
        var enresp_ins = $('#enresp_ins').val();
        var respric_ins = $('#respric_ins').val();
        var data_ins = $('#data_ins').val();
        var redattore_ins = $('#redattore_ins').val();
        var errori='';
        if (!denric_ins) {$('#denric_ins').addClass('errore');}else{$('#denric_ins').removeClass('errore');}
        if (!enresp_ins) {$('#enresp_ins').addClass('errore');}else{$('#enresp_ins').removeClass('errore');}
        if (!respric_ins) {$('#respric_ins').addClass('errore');}else{$('#respric_ins').removeClass('errore');}
        if (!data_ins) {$('#data_ins').addClass('errore');}else{$('#data_ins').removeClass('errore');}
        if (!redattore_ins) {$('#redattore_ins').addClass('errore');}else{$('#redattore_ins').removeClass('errore');}
        var errorEl=$(".slide > .errore").length;
        if(errorEl > 0){
            $('#newRicMsg').text('I campi in rosso sono obbligatori e vanno compilati.');
            return false;
        }else{
            $('#newRicMsg').text('');
            $.ajax({
                url: 'inc/ricerca_ins_script.php',
                type: 'POST', 
                data: {denric_ins:denric_ins, enresp_ins:enresp_ins,respric_ins:respric_ins,redattore_ins:redattore_ins,  data_ins:data_ins},
                success: function(data){$('#newRicMsg').text(data).delay(2500).fadeOut(function(){ location.reload(); }); }
            });//ajax
        }
    });

    var legenda;
    var pre = 'Il database contiene ';
    var post = ' schede relative a fonti di tipo '; 
    var righe = $('#catalogoTable tbody tr:visible').length;
    $('#legenda').html(pre+'<b>'+righe+'</b> record');

    $('.link').click(function(){
        var id = $(this).attr('id');
        var denric = $(this).attr('denric');
        var enresp = $(this).attr('enresp');
        var respric = $(this).attr('respric');
        var redattore = $(this).attr('redattore');
        var data = $(this).attr('data');
        var schede = $(this).attr('schede');
       $.ajax({
            url: 'inc/form_update/ricerca_update.php',
            type: 'POST', 
            data: {id:id, denric:denric, respric:respric, enresp:enresp,redattore:redattore, data:data, schede:schede},
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
