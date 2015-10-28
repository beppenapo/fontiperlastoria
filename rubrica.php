<?php
session_start();
if (!isset($_SESSION['username'])){$_SESSION['username']='guest';}
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
    div.slide{margin:0px 10px 0px 10px; border:1px solid #CFC4B1;padding:10px;}
    textarea{height: 20px !important;}
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
   <li id="catalogoTitle" class="livAttivo">RUBRICA</li>
  </ul>
 </div>
 
 <div id="skArcheoContent">
  <div class="inner primo">
  <div style="">
  <?php
     $query = ("
SELECT 
  anagrafica.id, 
  anagrafica.nome, 
  anagrafica.comune AS id_comune, 
  comune.comune, 
  anagrafica.indirizzo as id_indirizzo,
  indirizzo.indirizzo, 
  anagrafica.localita AS id_localita, 
  localita.localita, 
  indirizzo.cap, 
  anagrafica.tel, 
  anagrafica.cell, 
  anagrafica.fax, 
  anagrafica.mail, 
  anagrafica.web, 
  anagrafica.tipo_soggetto as tipo_id, 
  lista_tipo_soggetto.definizione as tipo,
  anagrafica.note
FROM 
  public.anagrafica, 
  public.comune, 
  public.indirizzo, 
  public.localita, 
  public.lista_tipo_soggetto
WHERE 
  anagrafica.comune = comune.id AND
  anagrafica.indirizzo = indirizzo.id AND
  anagrafica.localita = localita.id AND
  anagrafica.tipo_soggetto = lista_tipo_soggetto.id AND
  anagrafica.id != 7
ORDER BY nome ASC;
");
   $exec = pg_query($connection, $query);
   $row = pg_num_rows($exec);
   if($tipo == 0) {$caption = "Il database contiene ".$row." schede";} else {$caption="Il database contiene ".$row." schede relative a fonti di tipo <b>".$legenda."</b>";}
  ?> 

<div class="toggle" style="margin:30px 0px 10px;">
 <div class="sezioni sezAperta" style="margin:10px 10px 0px 10px; border:none;">
   <h2>Inserisci un nuovo soggetto nella rubrica</h2>
 </div>
 <div class="slide">
  <label style="text-align:center;display:block;font-weight:bold;">* CAMPI OBBLIGATORI.</label>
  <table class="mainData" style="width:98% !important;">
   <tr>
    <td colspan="2">
     <label>* NOME</label>
     <textarea id="nome_ins" class="form"></textarea>
    </td>
    <td>
     <label>TIPOLOGIA DEL SOGGETTO</label>
     <select id="tipo_ins" name="tipo_ins" class="form">
      <option value="5">--Seleziona una tipologia dalla lista --</option>
       <?php
         $query =  ("SELECT * FROM lista_tipo_soggetto order by definizione asc;");
         $result = pg_query($connection, $query);
         $righe = pg_num_rows($result);
         $i=0;
         for ($i = 0; $i < $righe; $i++){
           $idTipo = pg_result($result, $i, "id");
           $defTipo = pg_result($result, $i, "definizione");
           echo "<option value=\"$idTipo\">$defTipo</option>";
         }
       ?>
     </select>
    </td>
   </tr>
   <tr>
    <td>
     <label>COMUNE</label>
     <select id="comune_ana_update" name="comune_ana_update" class="form">
       <option value="15">--Seleziona un Comune dalla lista--</option>
       <?php
         $query =  ("SELECT * FROM public.comune order by comune asc; ");
         $result = pg_query($connection, $query);
         $righe = pg_num_rows($result);
         $i=0;
         for ($i = 0; $i < $righe; $i++){
           $idComAna = pg_result($result, $i, "id");
           $defComAna = pg_result($result, $i, "comune");
           echo "<option value=\"$idComAna\">$defComAna</option>";
         }
       ?>
  </select>
 </td>
 <td>
  <label>LOCALITA'</label>
  <select id="localita_ana_update" name="localita_ana_update" class="form disabilitata" disabled>
   <option value="42"></option>

  </select>
 </td>
 <td>
 <label>INDIRIZZO</label>
  <select id="indirizzo_ana_update" name="indirizzo_ana_update" class="form disabilitata" disabled>
   <option value="6"></option>
       <?php
         $query =  ("SELECT indirizzo.id AS id_indirizzo, indirizzo.comune as id_comune, comune.comune, indirizzo.indirizzo FROM comune,indirizzo WHERE indirizzo.comune = comune.id order by indirizzo asc;");
         $result = pg_query($connection, $query);
         $righe = pg_num_rows($result);
         $i=0;
         for ($i = 0; $i < $righe; $i++){
           $idIndAna = pg_result($result, $i, "id_indirizzo");
           $indAna = pg_result($result, $i, "indirizzo");
           echo "<option value=\"$idIndAna\">$indAna</option>";
         }
       ?>
  </select>
 </td>
</tr>
<tr> 
 <td>
  <label>TELEFONO</label>
  <textarea id="tel_ins" class="form"></textarea>
 </td>
  <td>
  <label>CELLULARE</label>
  <textarea id="cell_ins" class="form"></textarea>
 </td>
  <td>
  <label>FAX</label>
  <textarea id="fax_ins" class="form"></textarea>
 </td>
 </tr>
</table>
<table class="mainData" style="width:98% !important;">
 <tr>
 <td>
  <label>INDIRIZZO E-MAIL</label>
  <textarea id="mail_ins" class="form"></textarea>
 </td>
 <td> 
  <label>SITO WEB</label>
  <textarea id="web_ins" class="form"></textarea>
 </td>
 </tr>
 <tr>
 <td colspan="2">
  <label>NOTE</label>
  <textarea id="note_ins" class="form" style="height:100px !important"></textarea>
 </td>
</tr>
</table> 
  
   <br/>
   <label class="update" id="new_rubrica">Salva record </label>
  </div>
</div>
        

 <div style="margin-left:10px;"><legend id="legenda"></legend></div>
  <table id="catalogoTable" style="width:98%;">
   <caption></caption>
   <thead>
    <tr>
     <th>NOME</th> 
     <th>COMUNE</th> 
     <th>TEL</th> 
     <th>CELL</th> 
     <th>FAX</th> 
     <th>MAIL</th>
    </tr>
   </thead>
   <tbody>
  <?php
   if($row != 0) {
     for ($x = 0; $x < $row; $x++){
     	 $id = pg_result($exec, $x,"id"); 	 
       $nome = pg_result($exec, $x,"nome"); 	 
     	 $id_comune = pg_result($exec, $x,"id_comune"); 	 
     	 $comune = pg_result($exec, $x,"comune"); 	 
     	 $id_indirizzo = pg_result($exec, $x,"id_indirizzo"); 	
     	 $indirizzo = pg_result($exec, $x,"indirizzo"); 	 
     	 $id_localita = pg_result($exec, $x,"id_localita"); 	 
     	 $localita = pg_result($exec, $x,"localita"); 	 
     	 $cap = pg_result($exec, $x,"cap"); 	 
     	 $tel = pg_result($exec, $x,"tel"); 	 
     	 $cell = pg_result($exec, $x,"cell"); 	 
     	 $fax = pg_result($exec, $x,"fax"); 	 
     	 $mail = pg_result($exec, $x,"mail"); 	 
     	 $web = pg_result($exec, $x,"web"); 	 
     	 $tipo_id = pg_result($exec, $x,"tipo_id"); 	 
     	 $tipo = pg_result($exec, $x,"tipo"); 	
     	 $note = pg_result($exec, $x,"note"); 		
       echo "<tr class=\"link\" id=\"$id\" nome=\"$nome\" id_comune=\"$id_comune\" comune=\"$comune\" id_indirizzo=\"$id_indirizzo\" indirizzo=\"$indirizzo\" id_localita=\"$id_localita\" localita=\"$localita\" tel=\"$tel\" cell=\"$cell\" fax=\"$fax\" mail=\"$mail\" web=\"$web\" id_tipo=\"$tipo_id\" tipo=\"$tipo\" note=\"$note\" title=\"clicca per visualizzare la scheda completa, per modificare o eliminare il record\"> 
<td>$nome</td><td>$comune</td><td>$tel</td><td>$cell</td><td>$fax</td><td>$mail</td></tr>";
     }
   }
  ?>
  </tbody>
  </table>
  
  <input type='hidden' id='current_page' />  
  <input type='hidden' id='show_per_page' /> 
  <div class='page_navigation'></div> 
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

<script type="text/javascript" src="lib/select.js"></script>
<script type="text/javascript" >
function pager(){
//how much items per page to show  
    var show_per_page = 20;  
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
   
   $('#new_rubrica').click(function(){
    var nome_ins = $('#nome_ins').val();
    var comune_ins = $('#comune_ana_update').val();
    var localita_ins = $('#localita_ana_update').val();
    var indirizzo_ins = $('#indirizzo_ana_update').val();
    var tel_ins = $('#tel_ins').val();
    var cell_ins = $('#cell_ins').val();
    var fax_ins = $('#fax_ins').val();
    var mail_ins = $('#mail_ins').val();
    var web_ins = $('#web_ins').val();
    var note_ins = $('#note_ins').val();
    var tipo_ins = $('#tipo_ins').val();
    var errori='';
    
    if (!nome_ins) {errori += 'Il campo NOME non può essere vuoto<br/>';$('#nome_ins').addClass('errore');}
    else{$('#nome_ins').removeClass('errore');}
    

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
   	//alert('nome_ins:' +nome_ins+'\ncomune_ins: '+comune_ins+'\nlocalita_ins: '+localita_ins+'\nindirizzo_ins: '+indirizzo_ins+'\n tel: '+tel_ins+'\ncell: '+cell_ins+'\nfax: '+fax_ins+'\nmai: '+mail_ins+'\nweb: '+web_ins+'\nnote: '+note_ins); return false;
   	$.ajax({
          url: 'inc/rubrica_ins_script.php',
          type: 'POST', 
          data: {nome_ins:nome_ins, tipo_ins:tipo_ins, comune_ins:comune_ins, localita_ins:localita_ins, indirizzo_ins:indirizzo_ins, tel_ins:tel_ins, cell_ins:cell_ins, fax_ins:fax_ins, mail_ins:mail_ins, web_ins:web_ins, note_ins:note_ins},
          success: function(data){
             $(data)
               .dialog({position:['middle', 10]})
               .delay(2500)
               .fadeOut(function(){ $(this).dialog("close");window.location.href = 'rubrica.php'; });
          }//success
     });//ajax
   }
 });
  
   
   //var tipo;
	var legenda;
	var pre = 'Il database contiene ';
	var post = ' schede relative a fonti di tipo '; 
	var righe = $('#catalogoTable tbody tr:visible').length;
	$('#legenda').html(pre+'<b>'+righe+'</b> schede');

	$('.link').each(function(){
	  $(this).click(function(){
	    var id = $(this).attr('id');
	    var nome = $(this).attr('nome');
	    var id_comune = $(this).attr('id_comune');
       var comune = $(this).attr('comune');
       var id_localita = $(this).attr('id_localita');
       var localita = $(this).attr('localita');
       var id_indirizzo = $(this).attr('id_indirizzo');
       var indirizzo = $(this).attr('indirizzo');
       var tel = $(this).attr('tel');
       var cell = $(this).attr('cell');
       var fax = $(this).attr('fax');
       var mail = $(this).attr('mail');
       var web = $(this).attr('web');
       var note = $(this).attr('note');
       var id_tipo = $(this).attr('id_tipo');
       var tipo = $(this).attr('tipo');
       //alert(id+' '+nome +' '+id_comune +' '+comune +' '+ id_localita+' '+localita +' '+id_indirizzo +' '+indirizzo +' '+tel +' '+cell +' '+fax +' '+ mail +' '+web+' '+note+' '+id_tipo+' '+tipo); return false;
       $.ajax({
          url: 'inc/form_update/rubrica_update.php',
          type: 'POST', 
          data: {id:id, nome:nome, id_comune:id_comune, comune:comune, id_localita:id_localita, localita:localita, id_indirizzo:id_indirizzo, indirizzo:indirizzo, tel:tel, cell:cell, fax:fax, mail:mail, web:web, note:note, id_tipo:id_tipo, tipo:tipo},
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
   
   pager();
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
