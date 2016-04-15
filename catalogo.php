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
  <link href="css/scheda.css" type="text/css" rel="stylesheet" media="screen" />
  <link rel="shortcut icon" href="img/icone/favicon.ico" />
 
  <style type="text/css">
    div#content{border: 1px solid #C1FEAE;margin-top:50px;}
    table.mainData{width:100% !important;}
    table.mainData td{vertical-align: top !important;}
    table#catalogoTable{table-layout: fixed;margin:0 !important;}
    select#filtroCatalogo{border: 1px solid #d6d6d6 !important;border-radius: 5px !important; padding: 5px !important; background:none !important;}
    .export{display:inline-block;color:#FFBF96;padding:6px;border-radius:5px;border: 1px solid #d6d6d6;text-decoration:none !important ;font-weight:bold;}
    #tool{margin:30px 10px 10px;}
    #tool div{display:inline-block;width:49%;}
    #tool div:nth-child(2){text-align:right;}
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
  <div id="tool">
   <div><legend id="legenda"></legend></div>
   <div>
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
  
 <table id="catalogoTable">
   <caption></caption>
   <thead>
    <tr>
     <th style="width:20px;">ID</th>
     <th style="width:90px;">NUM.SCH.</th>
     <th style="width:100px;">LIV.IND.</th>
     <th style="width:310px;">OGGETTO</th>
     <th style="width:300px;">NOTE</th>
     <th style='width:70px;'>Stato scheda</th>
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
       echo "<tr class='$tpsch link' title='Clicca per aprire la scheda $numsch' ref='$id'><td>$id</td><td>$numsch</td><td>$livind</td><td>$dgn_note</td><td>$note</td><td>$statoSch</td></tr>";
     }
   }
  ?>
  </tbody>
  </table>
  </div>
  
  </div>
 </div>
   </div>
   <div id="footer"><?php require_once ("inc/footer.php"); ?></div>
  </div>
 </div> 
 <!--div invisibili -->
<script type="text/javascript" src="lib/jquery-core/jquery-1.12.0.min.js"></script>
<script type="text/javascript" src="lib/funzioni.js"></script>
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

</script>

</body>
</html>
