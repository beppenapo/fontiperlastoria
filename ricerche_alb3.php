<?php
session_start();
if (!isset($_SESSION['username'])){$_SESSION['username']='guest';}
$tipoUsr = $_SESSION['tipo'];
ini_set( "display_errors", 0);
require_once("inc/db.php");
$query = ("
 SELECT scheda.id, scheda.dgn_numsch, scheda.dgn_tpsch, scheda.dgn_livind, lista_dgn_livind.definizione as livind, scheda.dgn_dnogg, scheda.dgn_note, scheda.fine, scheda.livello, c.cro_iniz, c.cro_fin, c.cro_spec
 FROM public.scheda, public.lista_dgn_livind, cronologia c 
 WHERE scheda.dgn_livind = lista_dgn_livind.id and c.id_scheda = scheda.id and scheda.fine = 2 ORDER BY dgn_numsch ASC;");
 $exec = pg_query($connection, $query);
 $row = pg_num_rows($exec);
 if($tipo == 0) {$caption = " ".$row." schede trovate";} else {$caption=" ".$row." schede trovate <b>".$legenda."</b>";}
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
  <link href="css/ricerche.css" type="text/css" rel="stylesheet" media="screen" />
  <link rel="shortcut icon" href="img/icone/favicon.ico" />
  <script type="text/javascript" src="lib/jquery-core/jquery-1.4.4.min.js"></script>
  <script type="text/javascript" src="lib/jquery_friuli/js/jquery-ui-1.8.10.custom.min.js"></script>
  <style type="text/css">
   #catalogoTable{width:100% !important;table-layout: fixed;}
	
 </style>

</head>
<body>
 <div id="container">
  <div id="wrap">
   <?php if ($_SESSION['username']!='guest'){require("inc/sessione.php"); }?>
   <div id="header"><?php require_once ("inc/header.php"); ?></div>
   <div id="content">
     <div id="logoSchedaSx"></div> 
     <div id="livelloScheda"><ul><li id="catalogoTitle" class="livAttivo">CATALOGO DATI</li></ul></div>
     <div id="skArcheoContent">
      <div class="inner primo">
	<div style="float:left; width:45%;">
	 <div id="fts"> 
	  <div style="font-weight:normal; font-size: 20px; color: #F77D2F"><h1>RICERCA PAROLA CHIAVE</h1></div>
          <div class="wrapRicerche">
           <form id="ftsform" action="ricerche3.php" method='get'>
	    <div><input id="sub" name='sub' type="submit" value="" /></div>	    
            <textarea id="fts1" class="form" placeholder="Inserisci il termine da ricercare"></textarea> 	    
	    <div id="ftsadv">
             <select id='op1' class="form">
	      <option value="&">and</option>
	      <option value="|">or</option>
              <option value="& !">not</option>
	     </select>
	     <textarea id="fts2" class="form" placeholder="Secondo termine da ricercare"></textarea>
	     <select id='op2' class="form">
	      <option value="&">and</option>
	      <option value="|">or</option>
              <option value="& !">not</option>
	     </select>
	     <input id="sub2" type="submit" value="" /> 
             <textarea id="fts3" class="form" placeholder="Terzo termine da ricercare"></textarea>
            </div>
           </form>
           <span id='msg1'></span>
	   <input type="button" id="togglesearch" style="color:#7E7E7E" value="AGGIUNGI PAROLA" />
           </div><!-- wrapRicerche -->
          </div><!--div fts -->
        </div><!--div float left -->
	<div style="float:right; width:45%;">
	 <div id="campo"> 
	  <div style="font-weight:normal; font-size: 20px; color: #F77D2F"><h1>RICERCA IN UN CAMPO</h1></div>
          <div class="wrapRicerche">
	   <form id="ricerca_campo" action="" method='get'>
	    <div><input id="bot" name='bot' type="submit" value="" /></div>
	    <div class="livello">
	     <select style="-webkit-appearance: none; background-color: #F8F8F6; color:#7E7E7E" id="cercaScheda">
           	<option value="">SELEZIONA TIPO SCHEDA</option>
              	<option value="6">ARCHEOLOGICA</option>
      		<option value="8">ARCHITETTONICA</option>
      		<option value="4">ARCHIVISTICA</option>
    		<option value="5">BIBLIOGRAFICA</option>
    		<option value="2">FONTE MATERIALE</option>
      		<option value="1">FONTE ORALE</option>
      		<option value="7">FOTOGRAFICA</option>
      		<option value="9">STORICO ARTISTICA</option>
             </select>
            </div><!-- livello -->   
    	    <div class="livello">
	      <select style="-webkit-appearance: none; background-color: #F8F8F6; color:#7E7E7E" id="cercaLivello">
              	<option value="">SELEZIONA LIVELLO</option>
              	<option value="1">1</option>
              	<option value="2">2</option>
              	<option value="3">3</option>
              </select>
            </div><!--div livello-->
           </form>
           </div>
           </div><!--div campo -->
	  </div><!-- div float right -->
	  <div style="clear:both"></div>	 
      </div><!--div inner primo -->
      <div class="inner primo" style="height:220px; background-color:rgba(255,255,255,0.4) !important">
        <div id="wrapCheckTipo">
          <div class="checkbox_archeo">
	    <input type="checkbox" value="6" id="checkbox_archeo" name="checkTipo" class="filtri" />
	    <label for="checkbox_archeo" title="ARCHEOLOGICA" ></label>
	   </div>
	   <div class="checkbox_archit">
	    <input type="checkbox" value="8" id="checkbox_archit" name="checkTipo" class="filtri"/>
	    <label for="checkbox_archit" title="ARCHITETTONICA"></label>
	   </div>
	   <div class="checkbox_archiv">
	    <input type="checkbox" value="4" id="checkbox_archiv" name="checkTipo" class="filtri"/>
	    <label for="checkbox_archiv" title="ARCHIVISTICA"></label>
	   </div>
	   <div class="checkbox_biblio">
	    <input type="checkbox" value="5" id="checkbox_biblio" name="checkTipo" class="filtri"/>
	    <label for="checkbox_biblio" title="BIBLIOGRAFICA"></label>
	   </div>
	   <div class="checkbox_mater">
	    <input type="checkbox" value="2" id="checkbox_mater" name="checkTipo" class="filtri"/>
	    <label for="checkbox_mater" title="FONTE MATERIALE"></label>
	   </div>
	   <div class="checkbox_oral">
	    <input type="checkbox" value="1" id="checkbox_oral" name="checkTipo" class="filtri"/>
	    <label for="checkbox_oral" title="FONTE ORALE"></label>
           </div>
	   <div class="checkbox_foto">
	    <input type="checkbox" value="7" id="checkbox_foto" name="checkTipo" class="filtri"/>
	    <label for="checkbox_foto" title="FOTOGRAFICA"></label>
	   </div>
	   <div class="checkbox_stoart">
	    <input type="checkbox" value="9" id="checkbox_stoart" name="checkTipo" class="filtri"/>
	    <label for="checkbox_stoart" title="STORICO ARTISTICA"></label>
	   </div>
        </div>
        <div id="wrapCheckLivello">
           <div class="checkbox_1" >
	    <input type="checkbox" value="1" id="checkbox_1" name="checkLiv" class="filtri"/>
	    <label for="checkbox_1" title="PRIMO LIVELLO"></label>
	   </div>
	   <div class="checkbox_2">
	    <input type="checkbox" value="2" id="checkbox_2" name="checkLiv" class="filtri"/>
            <label for="checkbox_2" title="SECONDO LIVELLO"></label>
	   </div>
	   <div class="checkbox_3">
	    <input type="checkbox" value="3" id="checkbox_3" name="checkLiv" class="filtri"/>
            <label for="checkbox_3" title="TERZO LIVELLO"></label>
	   </div>
        </div>
        <div id="wrapSlider">
          <div id="sliderLegend"><span style="margin-right:10px;">CRONOLOGIA INIZIALE</span> | <span style="margin-left:10px;">CRONOLOGIA FINALE</span> </div>
          <div id="slider" style="display:inline-block;"></div>
          <input type="hidden" id="ci" value="">
          <input type="hidden" id="cf" value="">
        </div>
        <div id="wrapFiltra">
         <div style="float:left; width:30%;"><button id="attivaFiltro"></button></div>
	 <div style="float:right; width:70%; margin-top:14px;"><legend id="legenda" style="font-size: 30px; font-weight: bold; color:#907F73;"></legend></div>
	</div>
      </div>
      <div class="inner primo">
       <table id="catalogoTable" style="margin:0px !important">
        <caption></caption>
        <thead>
         <tr>
          <th style="width:90px;">NUMERO SCHEDA</th>
          <th style="width:100px;">LIVELLO INDIVIDUAZIONE</th>
          <th style="width:280px;">DENOMINAZIONE OGGETTO</th>
          <th style="width:255px;">NOTE</th>
          <th style="padding-left:20px;">CRONOLOGIA SPECIFICA</th>
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
             $note = pg_result($exec, $x,"dgn_note");
             $note = stripslashes($note);
             $fine = pg_result($exec, $x,"fine");
             $livello = pg_result($exec, $x,"livello");
             $cro_iniz = pg_result($exec, $x,"cro_iniz");
             $cro_fin = pg_result($exec, $x,"cro_fin");
             $cro_spec = pg_result($exec, $x,"cro_spec");
             if($fine==1) {$statoSch='aperta';}else {$statoSch='chiusa';}
              echo "<tr class='filtro$tpsch$livello link' title='Clicca per aprire la scheda $numsch' ref='$id' liv='$livello' ci='$cro_iniz' cf='$cro_fin'><td>$numsch</td><td>$livind</td><td>$dgn_note</td><td>$note</td><td style='padding-left:20px;'>$cro_spec</td></tr>";
           }
          }
         ?>
        </tbody>
       </table>
      </div><!-- inner primo -->
     </div>
    </div>
   </div><!--content-->
   <div id="footer"><?php require_once ("inc/footer.inc"); ?></div><!--footer-->
  </div><!-- wrap-->
 </div><!--container-->
 
 <!--div invisibili -->
<div class="loader"></div>
<script type="text/javascript" >
$(document).ready(function() {
 var legenda, legendaTipo, legendaLiv, tipo, liv,ci,cf,filtro,tutto;
 var pre = ' ';
 var post = ' schede trovate '; 
 var righe = $('#catalogoTable tbody tr:visible').not('.notFound').length;
 //if($('#catalogoTable tbody tr:visible').hasClass('notFound')){righe=0;}
 $('#legenda').html(pre+'<b>'+righe+'</b> schede trovate');
 
   $('#ftsadv').hide();
   $('#togglesearch').click(function(){
    $('#ftsadv').slideToggle('fast');
    $(this).val() == "AGGIUNGI PAROLA" ? $(this).val("RICERCA SEMPLICE") : $(this).val("AGGIUNGI PAROLA");
    $('#sub').toggle();   
   });

   $('#sub').click(function(event){
     event.preventDefault();
     var fts1 = $('#fts1').val();
     if(!fts1){
       $('#fts1').addClass('errore');
       $('#msg1').text('Devi inserire almeno un termine di ricerca');
     }else if(fts1.match(/\s/g)){
       $('#fts1').addClass('errore');
       $('#msg1').text('Il campo può contenere una sola parola!');
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
        success: function(html){
         $("#catalogoTable tbody").html(html);
         var righe = $('#catalogoTable tbody tr:visible').not('.notFound').length;
         $('#legenda').html(pre+'<b>'+righe+'</b> schede');
        } 
       });
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
       $('#msg1').text('Devi inserire almeno 2 termini di ricerca');
       return false;
     }else if(!fts1){
        $('#fts2, #fts3').removeClass('errore');
        $('#fts1').addClass('errore');
        $('#msg1').text('Il primo campo è obbligatorio');
        return false;
     }  
     else if(!fts1 && (!fts2 || !fts3)){
        $('#fts2').removeClass('errore');
        $('#fts1').addClass('errore');
        $('#msg1').text('Devi inserire almeno 2 termini di ricerca');
        return false;
     } 
     else if(fts1.match(/\s/g)){
      $('#fts1').addClass('highlight');
      $('#msg1').text('Il campo può contenere una sola parola!');
      return false;
     }else if(fts2.match(/\s/g)){
      $('#fts2').addClass('highlight');
      $('#msg1').text('Il campo può contenere una sola parola!');
      return false;
     }else if(fts3.match(/\s/g)){
      $('#fts3').addClass('highlight');
      $('#msg1').text('Il campo può contenere una sola parola!');
      return false;
     }else if((fts1==fts2)&&(fts1==fts3)){
      $('#fts1, #fts2,#fts3').removeClass('highlight');$('#msg1').text('');
      $('#fts1, #fts2,#fts3').addClass('highlight');
      $('#msg1').text('Non puoi inserire 3 termini uguali!');
     }
     else if((fts1==fts2)||(fts1==fts3)||(fts2==fts3)){
      $('#fts1, #fts2,#fts3').removeClass('errore');$('#msg1').text('');
      $('#fts1, #fts2,#fts3').addClass('highlight');
      $('#msg1').text('Non puoi inserire 2 termini uguali!');
     }
     else {
      $('#fts1, #fts2, #fts3').removeClass('errore');
      $('#fts1, #fts2, #fts3').removeClass('highlight');
      $('#msg1').text('');
      fts1=fts1.slice(0, -1);fts1=fts1+':*';
      fts2=fts2.slice(0, -1);fts2=fts2+':*';
      fts3=fts3.slice(0, -1);fts3=fts3+':*';

      if(fts3 == ':*'){q=fts1+' '+op1+' '+fts2;}
      else if(fts2 == ':*'){q=fts1+' '+op2+' '+fts3;}
      else{q=fts1+' '+op1+' '+fts2+' '+op2+' '+fts3;}
       $.ajax({
        type: "POST",
        url: "inc/ftsSearch.php",
        data: {q:q},
        cache: false,
        success: function(html){
         $("#catalogoTable tbody").html(html);
         var righe = $('#catalogoTable tbody tr:visible').not('.notFound').length;
         $('#legenda').html(pre+'<b>'+righe+'</b>  schede trovate');
        } 
       });           
     }     
   });

$(function() {
  var tooltip = function(sliderObj, ui){
    val1 = '<span class="sliderTip1">'+ sliderObj.slider("values", 0) +'</span>';
    val2 = '<span class="sliderTip2">'+ sliderObj.slider("values", 1) +'</span>';
    ci=sliderObj.slider("values", 0);
    cf=sliderObj.slider("values", 1);
    sliderObj.children('.ui-slider-handle').first().html(val1);
    sliderObj.children('.ui-slider-handle').last().html(val2);
    $('#ci').val(ci);  
    $('#cf').val(cf);                
  };
  $( "#slider" ).slider({
   range: true,
   min: 0,
   max: 2014,
   values: [ 0, 2014 ],
   slide: function( e, ui ){tooltip($(this),ui);},              
   create:function(e,ui){tooltip($(this),ui);}
  });
});

$('.ui-slider-handle').each(function(){
  $('.ui-slider-handle').first().removeClass('ui-state-default').addClass('ui-state-default1');
  $('.ui-slider-handle').last().removeClass('ui-state-default').addClass('ui-state-default2');     
});
$("#attivaFiltro").click(function(event){
   event.preventDefault();
   tipo=[];
   liv=[];
   var vect;
   ci = $('#ci').val();
   cf = $('#cf').val();
   
   if($("input[name=checkTipo]:checked").length < 1){tipo.push(1,2,4,5,6,7,8,9);}
   else{
     $("input[name=checkTipo]:checked").each(function () {
      var t = $(this).val();
      tipo.push(t);
     });
   }
   if($("input[name=checkLiv]:checked").length < 1){liv.push(1,2,3);}
   else{
     $("input[name=checkLiv]:checked").each(function () {
      var l = $(this).val();
      liv.push(l);
     });
   }

   var fts1 = $('#fts1').val();
   var fts2 = $('#fts2').val();
   var fts3 = $('#fts3').val();
   var op1 = $('#op1').val();
   var op2 = $('#op2').val();
   fts1=fts1.slice(0, -1);fts1=fts1+':*';
   fts2=fts2.slice(0, -1);fts2=fts2+':*';
   fts3=fts3.slice(0, -1);fts3=fts3+':*';
   if(fts1 == ':*' && fts2 == ':*' && fts3 == ':*'){vect = 'no';}
   else if(fts2 == ':*' && fts3 == ':*'){vect=fts1;}
   else if(fts3 == ':*'){vect=fts1+" "+op1+" "+fts2;}
   else if(fts2 == ':*'){vect=fts1+" "+op2+" "+fts3;}
   else{vect=fts1+" "+op1+" "+fts2+" "+op2+" "+fts3;}

   console.log(ci+'\n'+cf+'\n'+tipo+'\n'+liv+'\n'+vect);

   $.ajax({
     type: "POST",
     url: "inc/ftsSearch.php",
     data: {ci:ci,cf:cf,tipo:tipo,liv:liv,vect:vect, filtro:1},
     cache: false,
     success: function(html){
       $("#catalogoTable tbody").html(html);
       var righe = $('#catalogoTable tbody tr:visible').not('.notFound').length;
       $('#legenda').html(pre+'<b>'+righe+'</b>  schede trovate');
     } 
   });
  });

 $('.link').click(function(){var id = $(this).attr('ref');var link = 'scheda_archeo.php?id='+id;window.open(link, '_blank');});

/********* loader ************/
 $(document).ajaxStart(function(){$("body").addClass("loading");});
 $(document).ajaxComplete(function(){$("body").removeClass("loading");});
});//funzione principale


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
