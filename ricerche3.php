<?php
session_start();
if (!isset($_SESSION['username'])){$_SESSION['username']='guest';}
$tipoUsr = $_SESSION['tipo'];
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
  <script type="text/javascript" src="lib/jquery-core/jquery-1.4.4.min.js"></script>
  <script type="text/javascript" src="lib/jquery_friuli/js/jquery-ui-1.8.10.custom.min.js"></script>
  <style type="text/css">
    div#content{border: 1px solid #C1FEAE;margin-top:50px;}
    table.mainData{width:100% !important;}
    table.mainData td{vertical-align: top !important;}
    #slider{height:5px;width:150px;margin:0px 15px;}
    .sliderTip{position: absolute;width: 30px;height:15px;background-color: rgba(0,0,0,0.7); border:2px solid #61707a; color: #fff; font-size: 8px;z-index: 20000;text-align: center;margin-top:-25px;margin-left:-12px;line-height:15px; border-radius: 5px;}
    .sliderTip:after, .sliderTip:before {top: 100%;left: 50%;border: solid transparent;content: " ";height: 0;width: 0;position: absolute;pointer-events: none;}
    .sliderTip:after {border-color: rgba(0, 0, 0, 0);border-top-color: #4c4c4c;border-width: 5px;margin-left: -5px;}
    .sliderTip:before {border-color: rgba(97, 112, 122, 0);border-top-color: #61707a;border-width: 7px;margin-left: -7px;}
    .ui-slider .ui-slider-handle{width:0.7em !important;height:0.7em !important; cursor:pointer !important;}
    #fts{width:60%;margin:10px auto;}
    #fts textarea{width:80% !important;margin:0px !important;display:inline !important;font-size: 12px;}
    #fts h1{width:100% !important;}
    #fts select{width:80px !important;font-size: 12px;}
    #sub, #sub2{width:60px; height:40px;background:url('img/icone/search.png') center center no-repeat #ddd;margin-left:-3px;cursor:pointer;}
    #sub:hover,#togglesearch:hover, #sub2:hover{background-color:#c7c7c7}
    #togglesearch{width: 82%;padding: 5px 0px;cursor:pointer;}
    .highlight{background-color:#FFF734;}
  </style>

</head>
<body>
 <div id="container">
  <div id="wrap">
   <?php if ($_SESSION['username']!='guest'){require("inc/sessione.php"); }?>
   <div id="content">
     <div id="logoSchedaSx"><img src="img/layout/logo.png" alt="logo" /></div> 
 <div id="livelloScheda">
  <ul>
   <li id="catalogoTitle" class="livAttivo">CATALOGO DATI</li>
  </ul>
 </div>
 
 <div id="skArcheoContent">
  <div class="inner primo">
  <div id="fts"> 
   <h1>RICERCA PER PAROLA CHIAVE</h1>
   <form id="ftsform">
     <textarea id="fts1" class="form" placeholder="Inserisci il termine da ricercare"></textarea>
     <input id="sub" name='sub' type="submit" value="" />     
     <div id="ftsadv">
      <select id='op1' class="form">
       <option value="&">and</option>
       <option value="|">or</option>
      </select>
      <textarea id="fts2" class="form" placeholder="Inserisci il secondo termine da ricercare"></textarea>
      <select id='op2' class="form">
       <option value="&">and</option>
       <option value="|">or</option>
      </select>
      <textarea id="fts3" class="form" placeholder="Inserisci il terzo termine da ricercare"></textarea>  
      <input id="sub2" type="submit" value="" />    
     </div>
   </form>
   <span id='msg1'></span>
   <input type="button" id="togglesearch" value="RICERCA AVANZATA" />
  </div>
  <div style="">
  <?php
     $query = ("
       SELECT scheda.id, scheda.dgn_numsch, scheda.dgn_tpsch, scheda.dgn_livind, lista_dgn_livind.definizione as livind, scheda.dgn_dnogg, scheda.note, scheda.fine, scheda.livello, c.cro_iniz, c.cro_fin, c.cro_spec
       FROM public.scheda, public.lista_dgn_livind, cronologia c 
       WHERE scheda.dgn_livind = lista_dgn_livind.id and c.id_scheda = scheda.id and scheda.fine = 2 ORDER BY dgn_numsch ASC;");
 
   $exec = pg_query($connection, $query);
   $row = pg_num_rows($exec);
   if($tipo == 0) {$caption = "Il database contiene ".$row." schede";} else {$caption="Il database contiene ".$row." schede relative a fonti di tipo <b>".$legenda."</b>";}
  ?> 
  <div style="margin:30px 10px 0px 10px;">
   <div style="float:left; line-height:30px;"><legend id="legenda"></legend></div>
   <div style="float:right">
     filtra ricerca:
     <select id="filtroCatalogo" class="filtri">
      <option value="0">tutte le fonti</option>
      <option value="6">archeologica</option>
      <option value="8">architettonica</option>
      <option value="4">archivistica</option>
      <option value="5">bibliografica</option>
      <option value="2">fonte materiale</option>
      <option value="1">fonte orale</option>
      <option value="7">fotografica</option>
      <option value="9">storico artistica</option>
     </select>
     <select id="filtroCatalogoLiv" class="filtri" style="margin:0px 5px;">
      <option value="0">tutti i livelli</option>
      <option value="1">primo</option>
      <option value="2">secondo</option>
      <option value="3">terzo</option>
     </select>
     <div id="slider" style="display:inline-block;"></div>
     <button id="attivaFiltro">filtra</button>
   </div>
  </div>
  <div style="clear:both;"></div>
  
  <!-- the input fields that will hold the variables we will use -->  
<input type='hidden' id='current_page' />  
<input type='hidden' id='show_per_page' /> 
<div class='page_navigation'></div> 
  <table id="catalogoTable">
   <caption></caption>
   <thead>
    <tr>
     <th style="width:90px;">NUM.SCH.</th>
     <th style="width:100px;">LIV.IND.</th>
     <th style="width:470px;">OGGETTO</th>
     <th>CRONOLOGIA SPECIFICA</th>
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
       $livello = pg_result($exec, $x,"livello");
       $cro_iniz = pg_result($exec, $x,"cro_iniz");
       $cro_fin = pg_result($exec, $x,"cro_fin");
       $cro_spec = pg_result($exec, $x,"cro_spec");
       if($fine==1) {$statoSch='aperta';}else {$statoSch='chiusa';}
       echo "<tr class='filtro$tpsch$livello link' title='Clicca per aprire la scheda $numsch' ref='$id' liv='$livello' ci='$cro_iniz' cf='$cro_fin'><td>$numsch</td><td>$livind</td><td>$dgn_note</td><td>$cro_spec</td></tr>";
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
   var legenda, legendaTipo, legendaLiv, tipo, liv;
   var pre = 'Il database contiene ';
   var post = ' schede relative a fonti di tipo '; 
   var righe = $('#catalogoTable tbody tr:visible').length;
   $('#legenda').html(pre+'<b>'+righe+'</b> schede');

   $('#ftsadv').hide();
   $('#togglesearch').click(function(){
    $('#ftsadv').slideToggle('fast');
    $(this).val() == "RICERCA AVANZATA" ? $(this).val("RICERCA SEMPLICE") : $(this).val("RICERCA AVANZATA");
    $('#sub').toggle();   
   });

   $('#sub').click(function(event){
     event.preventDefault();
     var fts1 = $('#fts1').val();
     if(!fts1){
       $('#fts1').addClass('errore');
       msg = 'Devi inserire almeno un termine di ricerca';
       $('#msg1').text(msg);
     }else{
       $('#fts1').removeClass('errore');$('#msg1').text('');
       fts1=fts1.slice(0, -1);
       fts1=fts1+':*';
       q=fts1;
       $.ajax({
        type: "POST",
        url: "inc/ftsSearch.php",
        data: {q:q},
        cache: false,
        success: function(html){$("#catalogoTable tbody").html(html);} 
       });//ajax1
       var righe = $('#catalogoTable tbody tr:visible').length;
       $('#legenda').html(pre+'<b>'+righe+'</b> schede');
     }
   });

   $('#sub2').click(function(event){
     event.preventDefault();
     var fts1 = $('#fts1').val();
     var fts2 = $('#fts2').val();
     var fts3 = $('#fts3').val();
     var op1 = $('#op1').val();
     var op2 = $('#op2').val();
     
     //controllo compilazione campi obbligatori
     if(!fts1 && !fts2 && !fts3){
       $('#fts1, #fts2, #fts3').addClass('errore');
       msg = 'Devi inserire almeno 2 termini di ricerca';
       $('#msg1').text(msg);
     } 
     else if(!fts1){
        $('#fts2').removeClass('errore');
        $('#fts1').addClass('errore');
        msg = 'Devi inserire almeno 2 termini di ricerca';
        $('#msg1').text(msg);
     } 
     else if(!fts2 || !fts3){
        $('#fts1').removeClass('errore');
        $('#fts2').addClass('errore');
        msg = 'Devi inserire almeno 2 termini di ricerca';
        $('#msg1').text(msg);
     } 
     else {
       $('#fts1, #fts2, #fts3').removeClass('errore');
       $('#msg1').text('');
       //controllo campi uguali
       if((fts1==fts2)&&(fts1==fts3)){
         $('#fts1, #fts2,#fts3').removeClass('highlight');$('#msg1').text('');
         $('#fts1, #fts2,#fts3').addClass('highlight');
         msg = 'Non puoi inserire 3 termini uguali!';
         $('#msg1').text(msg);
       }
       else if((fts1==fts2)||(fts1==fts3)||(fts2==fts3)){
         $('#fts1, #fts2,#fts3').removeClass('errore');$('#msg1').text('');
         $('#fts1, #fts2,#fts3').addClass('highlight');
         msg = 'Non puoi inserire 2 termini uguali!';
         $('#msg1').text(msg);
       }
       else{
         $('#fts1, #fts2,#fts3').removeClass('highlight');
         $('#msg1').text('');         
       }
     }     
   });

   //var tipo;
	

$(function() {
            var tooltip = function(sliderObj, ui){
                val1            = '<span class="sliderTip">'+ sliderObj.slider("values", 0) +'</span>';
                val2            = '<span class="sliderTip">'+ sliderObj.slider("values", 1) +'</span>';
                sliderObj.children('.ui-slider-handle').first().html(val1);
                sliderObj.children('.ui-slider-handle').last().html(val2);                  
            };

            $( "#slider" ).slider({
              range: true,
              min: 0,
              max: 2000,
              values: [ 0, 2000 ],
              slide: function( e, ui ) {
                tooltip($(this),ui);                    
              },              
              create:function(e,ui){
                tooltip($(this),ui);                    
              }
            });
        });


  $("#attivaFiltro").click(function(){
    tipo = $("#filtroCatalogo").val();
    liv = $("#filtroCatalogoLiv").val();
    switch (tipo) {
        case '1': legendaTipo = "<b>orale</b>"; break;
        case '2': legendaTipo = "<b>materiale</b>"; break;
        case '4': legendaTipo = "<b>archivistica</b>"; break;
        case '5': legendaTipo = "<b>bibliografica</b>"; break;
        case '6': legendaTipo = "<b>archeologica</b>"; break;
        case '7': legendaTipo = "<b>fotografica</b>"; break;
        case '8': legendaTipo = "<b>architettonica</b>"; break;
        case '9': legendaTipo = "<b>storico-artistica</b>"; break;	
      }	
    switch (liv) {
        case '1': legendaLiv = "<b>primo livello</b>"; break;
        case '2': legendaLiv = "<b>secondo livello</b>"; break;
        case '3': legendaLiv = "<b>terzo livello</b>"; break;	
      }
      legenda = legendaTipo+' '+legendaLiv;
      if( tipo != 0 && liv == 0){
	$("#catalogoTable tbody>tr").hide();
	//$("#catalogoTable tr.filtro"+tipo+"0").show();
        $("#catalogoTable tr[class^='filtro"+tipo+"']").show();
	var righe = $('#catalogoTable tbody tr:visible').length;
	$('#legenda').html(pre+'<b>'+righe+'</b>'+post+' '+legendaTipo);
      }else if(tipo == 0 && liv != 0){
	$("#catalogoTable tbody>tr").hide();
	$("#catalogoTable tr[class$='"+liv+" link']").show();
	var righe = $('#catalogoTable tbody tr:visible').length;
	$('#legenda').html(pre+'<b>'+righe+'</b>'+post+' '+legendaLiv);
      }else if(tipo != 0 && liv != 0){
	$("#catalogoTable tbody>tr").hide();
	$("#catalogoTable tr.filtro"+tipo+liv).show();
	var righe = $('#catalogoTable tbody tr:visible').length;
	$('#legenda').html(pre+'<b>'+righe+'</b>'+post+' '+legendaTipo+' '+legendaLiv);
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
});


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
