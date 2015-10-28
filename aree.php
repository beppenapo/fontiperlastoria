<?php
session_start();
if (!isset($_SESSION['username'])){$_SESSION['username']='guest';}
ini_set( "display_errors", 0);
require_once("inc/db.php");
$t = $_GET['t'];
$c = $_GET['c'];
if($t==0) {$and='>0';}else {$and = '='.$t;}
if($c==0) {$and2='>0';}else {$and2= '='.$c;}
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
   <li id="catalogoTitle" class="livAttivo">ELENCO AREE DI INTERESSE / UBICAZIONI</li>
  </ul>
 </div>
 
 <div id="skArcheoContent">
  <div class="inner primo">
  <div style="">
  <?php
     $query = ("
SELECT 
  aree.id, 
  aree.id_comune, 
  comune.comune, 
  aree.id_localita, 
  localita.localita, 
  aree.id_indirizzo, 
  indirizzo.indirizzo, 
  comune.cap AS cap_comune, 
  indirizzo.cap AS cap_indirizzo, 
  aree.tipo, 
  aree.id_rubrica, 
  anagrafica.nome,
  count(area_int_poly.*) as poly,
  count(area_int_line.*) as line,
  count(ubicazione.*) as ubi
FROM 
  public.aree
left join comune on aree.id_comune = comune.id
left join localita on aree.id_localita = localita.id
left join indirizzo on aree.id_indirizzo = indirizzo.id
left join anagrafica on aree.id_rubrica = anagrafica.id
left join area_int_poly on area_int_poly.id_area = aree.id
left join area_int_line on area_int_line.id_area = aree.id
left join ubicazione on aree.id = ubicazione.area and aree.tipo = 2
where aree.id_comune$and2 AND aree.tipo$and
group by
  aree.id, 
  aree.id_comune, 
  comune.comune, 
  aree.id_localita, 
  localita.localita, 
  aree.id_indirizzo, 
  indirizzo.indirizzo, 
  comune.cap, 
  indirizzo.cap, 
  aree.tipo, 
  aree.id_rubrica, 
  anagrafica.nome
ORDER BY tipo ASC, comune ASC, localita asc;
");

   $exec = pg_query($connection, $query);
   $row = pg_num_rows($exec);
   if($tipo == 0) {$caption = "Il database contiene ".$row." schede";}
   if($tipo == 1) {$caption="Il database contiene ".$row." aree di interesse";}
   if($tipo == 2) {$caption="Il database contiene ".$row." ubicazioni";}
  ?> 

<input type='hidden' id='current_page' />  
<input type='hidden' id='show_per_page' /> 
<div class='page_navigation' style="margin:30px 10px 0px 10px;"></div> 

<?php if($usr) {?>
<div class="toggle" style="margin-bottom:10px;">
 <div class="sezioni sezAperta" style="margin:10px 10px 0px 10px; border:none;"><h2>Nuova area/ubicazione</h2></div>
 <div class="slide">
   <label style="text-align:center;display:block;font-weight:bold;">* CAMPI OBBLIGATORI.</label>
   
   <label>* Tipologia area</label>
    <select id="newTipo" name="newTipo" class="form">
      <option value="0">--scegli dalla lista--</option>
      <option value="1">area di interesse</option>
      <option value="2">ubicazione</option>
    </select>
   
   <label>* COMUNE</label>
   <select id="comune_update" name="comune_update" class="form">
    <option value="15">--non determinabile--</option>
    <?php
     $q1 = ("SELECT DISTINCT id, comune FROM comune WHERE id != 15 order by comune asc;");
     $q1ex = pg_query($connection, $q1);
     $q1r = pg_num_rows($q1ex);
     if($q1r != 0) {
      for ($a1 = 0; $a1 < $q1r; $a1++){
       $id = pg_result($q1ex, $a1,"id"); 	
       $comune = pg_result($q1ex, $a1,"comune");
       $comune = stripslashes($comune);
       echo "<option value=\"$id\">$comune</option>";
     }
   }
   ?>
   </select>
   
   <label>LOCALITA'</label>
   <select id="localita_update" name="localita_update" class="form">
     
   </select>
   
   <label>INDIRIZZO</label>
   <select id="indirizzo_update" name="indirizzo_update" class="form">
     
   </select>
   <div id="rubrica">   
   <label>RIFERIMENTO RUBRICA</label>
   <select id="rubrica_update" name="rubrica_update" class="form">
     <option value="7">--non determinabile--</option>
    <?php
     $q2 = ("SELECT DISTINCT id, nome FROM anagrafica WHERE id != 7 order by nome asc;");
     $q2ex = pg_query($connection, $q2);
     $q2r = pg_num_rows($q2ex);
     if($q2r != 0) {
      for ($a2 = 0; $a2 < $q2r; $a2++){
       $id = pg_result($q2ex, $a2,"id"); 	
       $nome = pg_result($q2ex, $a2,"nome");
       echo "<option value=\"$id\">$nome</option>";
     }
   }
   ?>
   </select>
   </div>
   <br/>
   <label class="update" id="new_area">Inserisci area </label>
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
$qf = ("SELECT DISTINCT
  aree.id_comune, 
  comune.comune, 
  comune.cap AS cap_comune
FROM 
  public.aree, 
  public.comune
WHERE 
  aree.id_comune = comune.id
order by comune asc;");
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
     <select id="t" name="t" class="filtri">
      <option value="0">--tutte le tipologie--</option>
      <option value="1">area di interesse</option>
      <option value="2">ubicazione</option>
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
     <th style="width:200px">INDIRIZZO</th>
     <th style="width:200px">RUBRICA</th>
     <th style="width:100px">TIPOLOGIA</th>
     <?php if($usr == 1 || $usr == 2 || $usr == 6) {echo '<th style="width:100px"></th>';} ?>
    </tr>
   </thead>
   <tbody>
  <?php
   if($row != 0) {
     for ($x = 0; $x < $row; $x++){
       $id = pg_result($exec, $x,"id"); 	
       $id_comune = pg_result($exec, $x,"id_comune");
       $id_localita = pg_result($exec, $x,"id_localita");
       $id_indirizzo = pg_result($exec, $x,"id_indirizzo");
       $id_rubrica = pg_result($exec, $x,"id_rubrica");
       $comune = pg_result($exec, $x,"comune");
       $comune = stripslashes($comune);
       $cap_comune = pg_result($exec, $x,"cap_comune");
       $localita = pg_result($exec, $x,"localita");
       $localita = stripslashes($localita);
       $indirizzo = pg_result($exec, $x,"indirizzo");
       $indirizzo = stripslashes($indirizzo);
       $cap_indirizzo = pg_result($exec, $x,"cap_indirizzo");
       $rubrica = pg_result($exec, $x,"nome");
       $rubrica = stripslashes($rubrica);
       $tipo = pg_result($exec, $x,"tipo");
       $poly = pg_result($exec, $x,"poly");
       $line = pg_result($exec, $x,"line");
       $ubi = pg_result($exec, $x,"ubi");
       if($tipo==1) {$tipologia = 'area di interesse';}
       if($tipo==2) {$tipologia = 'ubicazione';}
       if($cap_comune==0) {$cap_comune='';}
       if($cap_indirizzo==0) {$cap_indirizzo='';}
       if($tipo == 1 && $poly + $line == 0) {$azione = '<span style="color:red !important">Inserisci geometrie</span>';}
       elseif($tipo ==2 && $ubi == 0) {$azione = '<span style="color:red !important">Inserisci geometrie</span>';}
       else {$azione = 'gestisci geometrie';}
       echo '
       <tr class="link" id="'.$id.'" idComune="'.$id_comune.'" idLocalita="'.$id_localita.'" idIndirizzo="'.$id_indirizzo.'" idRubrica="'.$id_rubrica.'" tipo="'.$tipo.'" comune="'.$comune.'" localita="'.$localita.'" indirizzo="'.$indirizzo.'" rubrica="'.$rubrica.'" title="clicca per modificare o eliminare il record">
         <td>'.$id.'</td>
         <td>'.$comune.' '.$cap_comune.'</td>
         <td>'.$localita.'</td>
         <td>'.$indirizzo.' '.$cap_indirizzo.'</td>
         <td>'.$rubrica.'</td>
         <td>'.$tipologia.'</td>';
       if($usr == 1 || $usr == 2 || $usr == 6) {echo '<td class="modLista geom">'.$azione.'</td>';}
       echo "</tr>";
     }
   }
  ?>
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
function pager(){
//how much items per page to show  
    var show_per_page = 40;  
    //getting the amount of elements inside content div  
    var number_of_items = $('#catalogoTable tbody tr:visible').length; 
    //calculate the number of pages we are going to have  
    var number_of_pages = Math.ceil(number_of_items/show_per_page);  
  
    //set the value of our hidden input fields  
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
	//add active_page class to the first page link
	$('.page_navigation .page_link:first').addClass('active_page');
	//hide all the elements inside content div
	$("#catalogoTable tbody>tr").css('display', 'none');
	//and show the first n (show_per_page) elements
	$("#catalogoTable tbody>tr").slice(0, show_per_page).css('display', 'table-row');
}

$(document).ready(function() {
   $('.slide').hide();
   $('.sezioni').click(function(){
   	$('.slide').slideToggle();
   	//$('.sezioni').toggleClass('sezAperta');
   });
   $("#rubrica").hide();
   $("#newTipo").change(function () {  
	  var i=$(this).val();
	  if (i==2) {$("#rubrica").fadeIn("slow");}else {$("#rubrica").fadeOut("slow");}
   });
   $('#new_area').click(function(){
    var newTipo = $('#newTipo').val();
    var comune_update = $('#comune_update').val();
    var localita_update = $('#localita_update').val();
    var indirizzo_update = $('#indirizzo_update').val();
    var rubrica_update = $('#rubrica_update').val();
    var errori='';
    
    if (newTipo==0) {errori += 'Il campo "Tipologia area" non può essere vuoto<br/>';$('#newTipo').addClass('errore');}
    else{$('#newTipo').removeClass('errore');}
    if (comune_update==15) {errori += 'Il campo "Comune" non può essere vuoto<br/>';$('#comune_update').addClass('errore');}
    else{$('#comune_update').removeClass('errore');}
    
    if(errori){
   	errori = '<h3>I seguenti campi sono obbligatori e vanno compilati:</h3><ol>' + errori;
        $("<div id='errorDialog'>" + errori + "</ol></div>").dialog({
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
          url: 'inc/insertAreaScript.php',
          type: 'POST', 
          data: {newTipo:newTipo, comune_update:comune_update, localita_update:localita_update, indirizzo_update:indirizzo_update, rubrica_update:rubrica_update},
          success: function(data){
             $(data)
               .dialog({position:['middle', 10]})
               .delay(2500)
               .fadeOut(function(){ $(this).dialog("close");window.location.href = 'aree.php?c=0&t=0'; });
          }//success
     });//ajax
   }
 });
  
   $('td.geom').click(function(){ 
	    var area = $(this).parent('tr').attr('id');//id area
	    var id = $(this).parent('tr').attr('idLocalita');
	    var tipo = $(this).parent('tr').attr('tipo');
	    var comune = $(this).parent('tr').attr('comune');
	    var loc = $(this).parent('tr').attr('localita');
	    var ind = $(this).parent('tr').attr('indirizzo');
	    if (tipo==1) {window.location.href = 'aree_geom.php?id='+area+'&c='+comune+'&loc='+loc;}
	    if (tipo==2) {window.location.href = 'point_geom.php?id='+area+'&c='+comune+'&loc='+loc+'&ind='+ind;}	    
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

function previous(){

	new_page = parseInt($('#current_page').val()) - 1;
	//if there is an item before the current active link run the function
	if($('.active_page').prev('.page_link').length==true){
		go_to_page(new_page);
	}

}

function next(){
	new_page = parseInt($('#current_page').val()) + 1;
	//if there is an item after the current active link run the function
	if($('.active_page').next('.page_link').length==true){
		go_to_page(new_page);
	}

}
function go_to_page(page_num){
	//get the number of items shown per page
	var show_per_page = parseInt($('#show_per_page').val());

	//get the element number where to start the slice from
	start_from = page_num * show_per_page;

	//get the element number where to end the slice
	end_on = start_from + show_per_page;

	//hide all children elements of content div, get specific items and show them
	$("#catalogoTable tbody>tr").css('display', 'none').slice(start_from, end_on).css('display', 'table-row');

	/*get the page link that has longdesc attribute of the current page and add active_page class to it
	and remove that class from previously active page link*/
	$('.page_link[longdesc=' + page_num +']').addClass('active_page').siblings('.active_page').removeClass('active_page');

	//update the current page input field
	$('#current_page').val(page_num);
}

</script>

</body>
</html>
