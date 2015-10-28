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
  <link href="lib/jquery_friuli/css/start/jquery-ui-1.8.10.custom.css" type="text/css" rel="stylesheet" media="screen" />
  <link href="css/scheda.css" type="text/css" rel="stylesheet" media="screen" />
  <link rel="shortcut icon" href="img/icone/favicon.ico" />
  <script type="text/javascript" src="lib/jquery-core/jquery-1.4.4.min.js"></script>
  <script type="text/javascript" src="lib/jquery_friuli/js/jquery-ui-1.8.10.custom.min.js"></script>
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
   
   $('#new_ricerca').click(function(){
    var denric_ins = $('#denric_ins').val();
    var enresp_ins = $('#enresp_ins').val();
    var respric_ins = $('#respric_ins').val();
    var data_ins = $('#data_ins').val();
    var redattore_ins = $('#redattore_ins').val();
    var errori='';
    
    if (!denric_ins) {errori += 'Il campo DENOMINAZIONE RICERCA non può essere vuoto<br>';$('#denric_ins').addClass('errore');}
    else{$('#denric_ins').removeClass('errore');}
    if (!enresp_ins) {errori += 'Il campo ENTE RESPONSABILE non può essere vuoto<br>';$('#enresp_ins').addClass('errore');}
    else{$('#enresp_ins').removeClass('errore');}
    if (!respric_ins) {errori += 'Il campo RESPONSABILE RICERCA non può essere vuoto<br>';$('#respric_ins').addClass('errore');}
    else{$('#respric_ins').removeClass('errore');}
    if (!data_ins) {errori += 'Il campo DATA non può essere vuoto<br>';$('#data_ins').addClass('errore');}
    else{$('#data_ins').removeClass('errore');}
    if (!redattore_ins) {errori += 'Il campo REDATTORE non può essere vuoto<br>';$('#redattore_ins').addClass('errore');}
    else{$('#redattore_ins').removeClass('errore');}

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
          url: 'inc/ricerca_ins_script.php',
          type: 'POST', 
          data: {denric_ins:denric_ins, enresp_ins:enresp_ins,respric_ins:respric_ins,redattore_ins:redattore_ins,  data_ins:data_ins},
          success: function(data){
             $(data)
               .dialog({position:['middle', 10]})
               .delay(2500)
               .fadeOut(function(){ $(this).dialog("close");window.location.href = 'ricerca.php'; });
          }//success
     });//ajax
   }
 });
  
   
   //var tipo;
	var legenda;
	var pre = 'Il database contiene ';
	var post = ' schede relative a fonti di tipo '; 
	var righe = $('#catalogoTable tbody tr:visible').length;
	$('#legenda').html(pre+'<b>'+righe+'</b> record');

	$('.link').each(function(){
	  $(this).click(function(){
	    var id = $(this).attr('id');
	    var denric = $(this).attr('denric');
	    var enresp = $(this).attr('enresp');
	    var respric = $(this).attr('respric');
       var redattore = $(this).attr('redattore');
	    var data = $(this).attr('data');
	    var schede = $(this).attr('schede');
       //alert(id+' '+ denric+' '+ enresp+' '+ respric+' '+' '+redattore+' '+ data+' '+ schede); return false;
       $.ajax({
          url: 'inc/form_update/ricerca_update.php',
          type: 'POST', 
          data: {id:id, denric:denric, respric:respric, enresp:enresp,redattore:redattore, data:data, schede:schede},
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
