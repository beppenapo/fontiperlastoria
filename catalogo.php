<?php
session_start();
if (!isset($_SESSION['username'])){$_SESSION['username']='guest';}
$utente = $_SESSION['id_user'];
$tipoUsr = $_SESSION['tipo'];
$hub = $_SESSION['hub'];
ini_set( "display_errors", 0);
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
  <link href="lib/jquery_friuli/css/start/jquery-ui-1.8.10.custom.css" type="text/css" rel="stylesheet" media="screen" />
  <link href="css/scheda.css" type="text/css" rel="stylesheet" media="screen" />
  <link rel="shortcut icon" href="img/icone/favicon.ico" />
  
  <script type="text/javascript" src="lib/jquery-core/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="lib/jquery_friuli/js/jquery-ui-1.8.10.custom.min.js"></script>
  
  <style type="text/css">
    div#content{border: 1px solid #C1FEAE;margin-top:50px;}
    table.mainData{width:100% !important;}
    table.mainData td{vertical-align: top !important;}
    table#catalogoTable{margin:0 !important;}
    select#filtroCatalogo{border: 1px solid #d6d6d6 !important;border-radius: 5px !important; padding: 5px !important; background:none !important;}
    .export{display:inline-block;color:#FFBF96;padding:6px;border-radius:5px;border: 1px solid #d6d6d6;text-decoration:none !important ;font-weight:bold;}
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
   <li id="catalogoTitle" class="livAttivo">CATALOGO DATI</li>
  </ul>
 </div>
 
 <div id="skArcheoContent">
  <div class="inner primo">
  <div style="">
  <?php
     if($tipoUsr==3) {
     $query = ("
      SELECT ricerca.hub, scheda.id, scheda.dgn_numsch, scheda.dgn_tpsch, scheda.dgn_livind, lista_dgn_livind.definizione as livind, scheda.dgn_dnogg, scheda.note, scheda.fine, scheda.compilatore
      FROM scheda, lista_dgn_livind, ricerca 
      WHERE scheda.cmp_id = ricerca.id 
        AND scheda.dgn_livind = lista_dgn_livind.id 
        AND scheda.compilatore <> $utente 
        AND scheda.fine = 2
        AND ricerca.hub = $hub 
      UNION
      SELECT ricerca.hub, scheda.id, scheda.dgn_numsch, scheda.dgn_tpsch, scheda.dgn_livind, lista_dgn_livind.definizione as livind, scheda.dgn_dnogg, scheda.note, scheda.fine, scheda.compilatore
      FROM scheda, lista_dgn_livind, ricerca 
      WHERE scheda.cmp_id = ricerca.id 
        and scheda.dgn_livind = lista_dgn_livind.id 
        and scheda.compilatore = $utente 
        AND ricerca.hub = $hub
      ORDER BY dgn_numsch ASC;
    ");
  }else {
     $query = ("SELECT scheda.id, scheda.dgn_numsch, scheda.dgn_tpsch, scheda.dgn_livind, lista_dgn_livind.definizione as livind, scheda.dgn_dnogg,  scheda.note, scheda.fine FROM scheda, lista_dgn_livind, ricerca WHERE scheda.cmp_id = ricerca.id and ricerca.hub = $hub and scheda.dgn_livind = lista_dgn_livind.id ORDER BY dgn_numsch ASC;");
   }
   $exec = pg_query($connection, $query);
   $row = pg_num_rows($exec);
   if($tipo == 0) {$caption = "Il database contiene ".$row." schede";} else {$caption="Il database contiene ".$row." schede relative a fonti <b>".$legenda."</b>";}
  ?> 
  <div style="margin:30px 10px 0px 10px;">
   <div style="float:left"><legend id="legenda"></legend></div>
   <div style="float:right">
     filtra ricerca:
     <select id="filtroCatalogo">
      <option value="0" selected >tutte le fonti</option>
      <?php 
       $ql=("select * from lista_tipo_scheda where id <> 3 order by etichetta asc;");
       $qlr=pg_query($connection, $ql);
       while ($obj = pg_fetch_array($qlr)) {
        echo "<option value=".$obj["id"].">".$obj["etichetta"]."</option>";
     }
    ?>
     </select>
     <a href="#" class="export" id="csv" title="esporta dati tabella in formato csv">CSV</a>
   </div>
  </div>
  <div style="clear:both;"></div>
  
<input type='hidden' id='current_page' />  
<input type='hidden' id='show_per_page' /> 
<div class='page_navigation'></div> 
  <table id="catalogoTable">
   <caption></caption>
   <thead>
    <tr>
     <th>ID</th>
     <th style="width:90px;">NUM.SCH.</th>
     <th style="width:100px;">LIV.IND.</th>
     <th style="width:300px;">OGGETTO</th>
     <th>NOTE</th>
     <?php 
      if($tipoUSr!=3) {echo "<th style='width:60px;'>Stato scheda</th>";}
     ?>
    </tr>
   </thead>
   <tbody>
  <?php
   if($row != 0) {
     for ($x = 0; $x < $row; $x++){
       $id = pg_result($exec, $x,"id"); 	
       $numsch = pg_result($exec, $x,"dgn_numsch");
       $livind = pg_result($exec, $x,"livind");
       $dgn_note = pg_result($exec, $x,"dgn_dnogg");
       $dgn_note = stripslashes($dgn_note);
       $tpsch = pg_result($exec, $x,"dgn_tpsch");
       $note = pg_result($exec, $x,"note");
       $note = stripslashes($note);
       $fine = pg_result($exec, $x,"fine");
       if($fine==1) {$statoSch='aperta';}else {$statoSch='chiusa';}
       if($tipoUsr==3) {
         echo "<tr class='$tpsch link' title='Clicca per aprire la scheda $numsch' ref='$id'><td>$id</td><td>$numsch</td><td>$livind</td><td>$dgn_note</td><td>$note</td></tr>";
       }else {
         echo "<tr class='$tpsch link' title='Clicca per aprire la scheda $numsch' ref='$id'><td>$id</td><td>$numsch</td><td>$livind</td><td>$dgn_note</td><td>$note</td><td>$statoSch</td></tr>";
       }
     }
   }
  ?>
  </tbody>
  </table>
  </div>
  
  </div>
 </div>
   </div>
   <div id="footer"><?php require_once ("inc/footer.inc"); ?></div>
  </div>
 </div> 
 <!--div invisibili -->

<script type="text/javascript" >
$(document).ready(function() {
   //var tipo;
	var legenda;
	var pre = 'Il database contiene ';
	var post = ' schede relative a fonti '; 
	var righe = $('#catalogoTable tbody tr:visible').length;
	$('#legenda').html(pre+'<b>'+righe+'</b> schede');


    $("#filtroCatalogo").change(function(){
   	    var tipo = $(this).val();
   	    switch (tipo) {
            case '1': legenda = "<b>orali</b>"; break;
            case '2': legenda = "<b>materiali</b>"; break;
            case '4': legenda = "<b>archivistiche</b>"; break;
            case '5': legenda = "<b>bibliografiche</b>"; break;
            case '6': legenda = "<b>archeologiche</b>"; break;
            case '7': legenda = "<b>fotografiche</b>"; break;
            case '8': legenda = "<b>architettoniche</b>"; break;
            case '9': legenda = "<b>storico-artistiche</b>"; break;	
            case '10': legenda = "<b>cartografiche</b>"; break;
        }	
        if( tipo != 0){
            $("#catalogoTable tbody>tr").hide();
            $("#catalogoTable tr."+tipo).show();
            var righe = $('#catalogoTable tbody tr:visible').length;
            $('#legenda').html(pre+'<b>'+righe+'</b>'+post+legenda);
        }else{
            $("#catalogoTable tbody>tr").show();
            var righe = $('#catalogoTable tbody tr:visible').length;
            $('#legenda').html(pre+'<b>'+righe+'</b> schede');
        }
    });
	$('.link').click(function(){
        var id = $(this).attr('ref');
	    var link = 'scheda_archeo.php?id='+id;
	    window.open(link, '_blank');
    });
	//pager();
	
 function exportTableToCSV($table, filename) {
  var $rows = $table.find('tr'),
  tmpColDelim = String.fromCharCode(11),
  tmpRowDelim = String.fromCharCode(0),
  colDelim = '","',
  rowDelim = '"\r\n"',
  csv = '"' + $rows.map(function (i, row) {
    var $row = $(row), $cols = $row.find('th, td');
    return $cols.map(function (j, col) {
      var $col = $(col), text = $col.text();
      return text.replace(/"/g, '""'); // escape double quotes
    }).get().join(tmpColDelim);
  })
  .get().join(tmpRowDelim)
  .split(tmpRowDelim)
  .join(rowDelim)
  .split(tmpColDelim)
  .join(colDelim) + '"',
  // Data URI
  csvData = 'data:application/csv;charset=utf-8,' + encodeURIComponent(csv);

  $(this).attr({
    'download': filename,
    'href': csvData,
    'target': '_blank'
  });
 }
 $("#csv").click(function (event) {exportTableToCSV.apply(this, [$('#catalogoTable'), 'catalogo.csv']);}); 
});

function pager(){
    var show_per_page = 40;   
    var number_of_items = $('#catalogoTable tbody tr:visible').length; 
    var number_of_pages = Math.ceil(number_of_items/show_per_page);  
    $('#current_page').val(0);  
    $('#show_per_page').val(show_per_page);  
    var navigation_html = '<a class="previous_link" href="javascript:previous();">Prev</a>';
    var current_link = 0;
    while(number_of_pages > current_link){
      navigation_html += '<a class="page_link" href="javascript:go_to_page(' + current_link +')" longdesc="' + current_link +'">'+ (current_link + 1) +'</a>';
      current_link++;
    }
    navigation_html += '<a class="next_link" href="javascript:next();">Next</a>';
    $('.page_navigation').html(navigation_html);
    $('.page_navigation .page_link:first').addClass('active_page');
    $("#catalogoTable tbody>tr").css('display', 'none');
    $("#catalogoTable tbody>tr").slice(0, show_per_page).css('display', 'table-row');
}
function previous(){
	new_page = parseInt($('#current_page').val()) - 1;
	if($('.active_page').prev('.page_link').length==true){go_to_page(new_page);}
}

function next(){
	new_page = parseInt($('#current_page').val()) + 1;
	if($('.active_page').next('.page_link').length==true){go_to_page(new_page);}
}
function go_to_page(page_num){
	var show_per_page = parseInt($('#show_per_page').val());
	start_from = page_num * show_per_page;
	end_on = start_from + show_per_page;
	$("#catalogoTable tbody>tr").css('display', 'none').slice(start_from, end_on).css('display', 'table-row');
	$('.page_link[longdesc=' + page_num +']').addClass('active_page').siblings('.active_page').removeClass('active_page');
	$('#current_page').val(page_num);
}
</script>

</body>
</html>
