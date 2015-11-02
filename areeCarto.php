<?php
session_start();
if (!isset($_SESSION['username'])){$_SESSION['username']='guest';}
ini_set( "display_errors", 0);
require_once("inc/db.php");
$usr = $_SESSION['id_user'];

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
  <link href="lib/jquery_friuli/css/start/jquery-ui-1.8.10.custom.css" type="text/css" rel="stylesheet" media="screen" />
  <link href="css/scheda.css" type="text/css" rel="stylesheet" media="screen" />
  <link href="css/ico-font/css/font-awesome.min.css" type="text/css" rel="stylesheet" media="screen" />
  <link rel="shortcut icon" href="img/icone/favicon.ico" />
  <script type="text/javascript" src="lib/jquery-core/jquery-1.4.4.min.js"></script>
  <script type="text/javascript" src="lib/jquery_friuli/js/jquery-ui-1.8.10.custom.min.js"></script>
  <script type="text/javascript" src="lib/select.js"></script>
  <style type="text/css">
    div#content{border: 1px solid #C1FEAE;margin-top:50px;}
    table.mainData{width:100% !important;}
    table.mainData td{vertical-align: top !important;}
    div.slide{margin:0px 10px 0px 10px; border:1px solid #CFC4B1;padding:10px;}
    table#catalogoTable{font-size: 12px;}
    #localitaCartoWrap{display:none;}
    #localitaCarto{position:relative; display:block; width:92%;height:auto;padding:1%; border:1px solid #cacaca;}
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
   <li id="catalogoTitle" class="livAttivo">ELENCO AREE CARTOGRAFICHE</li>
  </ul>
 </div>
 
 <div id="skArcheoContent">
  <div class="inner primo">
  <div style="">
  <?php
   $query = ("
    
   ");

   $exec = pg_query($connection, $query);
   $row = pg_num_rows($exec);
   $caption = "Il database contiene ".$row."aree";
  ?> 
<?php if($usr) {?>
<div class="toggle" style="margin-bottom:10px;">
 <div class="sezioni sezAperta" style="margin:10px 10px 0px 10px; border:none;"><h2>Nuova area</h2></div>
 <div class="slide">
   <label style="text-align:center;display:block;font-weight:bold;">* CAMPI OBBLIGATORI.</label>
   <label>* NOME AREA</label>
   <textarea id="nomeArea" class="form" style="width:92.5% !important;"></textarea>
   <label>* COMUNE</label>
   <select id="comuneCarto" name="comuneCarto" class="form">
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
   
   <div id="localitaCartoWrap">
    <label>LOCALITA'</label>
    <div id="localitaCarto"></div>
    <label class="update" id="addArea">Aggiungi area </label>
   </div>
   <ul id="locTot"></ul>
   <button type="button" name="salvaAree">Salva area</button>
  </div>
</div>
<?php } ?>        
 <div style="margin:30px 10px 0px 10px;">
  <div style="float:left"><legend id="legenda"></legend></div>
  <div style="float:right">
   <form action="aree.php" id="filtra" method="get" enctype="text/plain">
    filtra ricerca:
    <select id="c" name="c" class="filtri" style="width:200px;">
     <option value="0">--tutti i comuni--</option>
      <?php
      $qf = ("SELECT DISTINCT aree.id_comune, comune.comune, comune.cap AS cap_comune
              FROM aree, comune
              WHERE aree.id_comune = comune.id
              order by comune asc;
      ");
      $qex = pg_query($connection, $qf);
      $qfr = pg_num_rows($qex);
      if($qfr != 0) {
       for ($a = 0; $a < $qfr; $a++){
        $id = pg_result($qex, $a,"id_comune"); 	
        $comune = pg_result($qex, $a,"comune");
        $comune=stripslashes($comune);
        $cap = pg_result($qex, $a,"cap");
        echo "<option value=\"$id\">$comune $cap</option>";
       }
      }
      ?>
     </select>
     <input type="Submit" value="filtra" class="submit">    
    </form>
   </div>
  </div>
  <div style="clear:both;"></div>
 <div style="margin-left:10px;"><legend id="legenda"></legend></div>
  <table id="catalogoTable">
   <caption></caption>
   <thead>
    <tr>
     <th style="width:20px">ID</th>
     <th style="width:150px">COMUNE</th>
     <th style="width:150px">LOCALITA'</th>
     <?php if($usr == 1 || $usr == 2 || $usr == 6) {echo '<th style="width:100px"></th>';} ?>
    </tr>
   </thead>
   <tbody>
   
   </tbody>
  </table>
 </div>
  
  </div>
 </div>
   </div><!--content-->
   <div id="footer"><?php require_once ("inc/footer.inc"); ?></div><!--footer-->
  </div><!-- wrap-->
 </div><!--container-->
 
 <!--div invisibili -->
<div id="dialog">  </div>
<script type="text/javascript" >
$(document).ready(function() {
 $('.slide, #addArea').hide();
 $('.sezioni').click(function(){$('.slide').slideToggle();});

 $("button[name=salvaAree]").hide();
 $("#addArea").click(function(){
  var arrLocNome = new Array();
  var arrLoc = new Array();
  var com = $("#comuneCarto option:selected").text();
  var comId = $("#comuneCarto").val();
  $("input[name=localitaCartoCheck]:checked").each(function(){
   var nome = $(this).data('loc'); 
   var id = $(this).val(); 
   arrLocNome.push(nome);
   arrLoc.push(id);
  });
  $("#locTot").append("<li><i class='fa fa-times removeArea' title='Elimina area'></i> "+com+": <span class='idLoc' data-arrloc='"+arrLoc.join()+"'>"+arrLocNome.join(", ")+"</span></li>"); 
  $(".removeArea").click(function(){$(this).parent("li").remove();checkLocLi();});
  $("#localitaCartoWrap").fadeOut('fast');
  $("#comuneCarto").val(15);
  checkLocLi();
 });

 function checkLocLi(){
  if($("#locTot li").length > 0){$("button[name=salvaAree]").show();}else{$("button[name=salvaAree]").hide();}; 
 }


 $('td.geom').click(function(){ 
  var area = $(this).parent('tr').attr('id');//id area
  var id = $(this).parent('tr').attr('idLocalita');
  var comune = $(this).parent('tr').attr('comune');
  var loc = $(this).parent('tr').attr('localita');
  window.location.href = 'aree_geom.php?id='+area+'&c='+comune+'&loc='+loc;  
 });

var legenda;
var pre = 'Il database contiene ';
var post = ' schede relative a fonti di tipo '; 
var righe = $('#catalogoTable tbody tr:visible').length;
$('#legenda').html(pre+'<b>'+righe+'</b> record');

$('.link').each(function(){
  $(this).click(function(){
    var id = $(this).attr('id');
    var idcomune = $(this).attr('idcomune');
    var idlocalita = $(this).attr('idlocalita');
    var idindirizzo = $(this).attr('idindirizzo');
    var idrubrica = $(this).attr('idrubrica');
    var comune = $(this).attr('comune');
    var localita = $(this).attr('localita');
    var indirizzo = $(this).attr('indirizzo');
    var rubrica = $(this).attr('rubrica');
    var tipo = $(this).attr('tipo');
    //alert(id+' '+ comune+' '+localita+' '+ indirizzo+' '+' '+rubrica+' '+ tipo); return false;
    $.ajax({
      url: 'inc/form_update/area_update.php',
      type: 'POST', 
      data: {id:id, idcomune:idcomune, idlocalita:idlocalita, idindirizzo:idindirizzo,idrubrica:idrubrica, comune:comune, localita:localita, indirizzo:indirizzo,rubrica:rubrica,tipo:tipo},
      success: function(data){
        $("#dialog").html(data);
        $("#dialog").dialog({
          resizable:false,
          modal:true,
          height: 630,
          width: 700,
          title: "Modifica sezione",
          position:['middle', 5]
        });
      }//success
    });//ajax
   });//click
});//each
   
});//funzione principale
</script>

</body>
</html>
