$(document).ready(function () {
 var optionNull='<option value="">--valori non selezionabili--</option>';

 $("#stato_update").change(function() {
  var id = $(this).val();
  $("#comune_update, #localita_update, #indirizzo_update")
   .attr('disabled', 'disabled')
   .html(optionNull)
   .addClass('disabilitata');
  $.ajax({
   type: "POST",
   url: "inc/dinSelProvincia.php",
   data: {id:id},
   cache: false,
   success: function(html){$("#provincia_update").html(html);} 
  });//ajax1
 });
 
 $("#statoubi_update").change(function() {
  var id = $(this).val();
  $("#comuneubi_update, #localitaubi_update, #indirizzoubi_update")
    .attr('disabled', 'disabled')
    .html(optionNull)
    .addClass('disabilitata');
  $.ajax({
   type: "POST",
   url: "inc/dinSelProvincia.php",
   data: {id:id},
   cache: false,
   success: function(html){$("#provinciaubi_update").html(html);} 
  });//ajax1
 });
 
 $("#provincia_update").change(function() {
  var id = $(this).val();
  $("#comune_update").removeAttr('disabled', 'disabled').removeClass('disabilitata');
  $.ajax({
   type: "POST",
   url: "inc/dinSelComune.php",
   data: {id:id},
   cache: false,
   success: function(html){
   	$("#comune_update").html(html);
   } 
  });//ajax2
 });
 
 $("#provinciaubi_update").change(function() {
  var id = $(this).val();
  $("#comuneubi_update").removeAttr('disabled', 'disabled').removeClass('disabilitata');
  $.ajax({
   type: "POST",
   url: "inc/dinSelComune.php",
   data: {id:id},
   cache: false,
   success: function(html){
   	$("#comuneubi_update").html(html);
   } 
  });//ajax2
 });

 $("#comune_update").change(function() {
  $("#localita_update, #indirizzo_update").removeAttr('disabled', 'disabled').removeClass('disabilitata');
  var id = $(this).val();
  $.ajax({
   type: "POST",
   url: "inc/dinSelLocalita.php",
   data: {id:id},
   cache: false,
   success: function(html){$("#localita_update").html(html);} 
  });//ajax1
  $.ajax({
   type: "POST",
   url: "inc/dinSelIndirizzo.php",
   data: {id:id},
   cache: false,
   success: function(html){$("#indirizzo_update").html(html);} 
  });//ajax2
 });
  
 $("#comuneubi_update").change(function() {
  $("#localitaubi_update, #indirizzoubi_update").removeAttr('disabled', 'disabled').removeClass('disabilitata');
  var id = $(this).val();
  $.ajax({
   type: "POST",
   url: "inc/dinSelLocalita.php",
   data: {id:id},
   cache: false,
   success: function(html){$("#localitaubi_update").html(html);} 
  });//ajax1
  $.ajax({
   type: "POST",
   url: "inc/dinSelIndirizzo.php",
   data: {id:id},
   cache: false,
   success: function(html){$("#indirizzoubi_update").html(html);} 
  });//ajax2
 });
/* 
 $("#indirizzoubi_update").change(function() {
  var id = $(this).val();
  $.ajax({
   type: "POST",
   url: "inc/dinSelAnaUbi.php",
   data: {id:id},
   cache: false,
   success: function(html){$("#ana_ubi").html(html);} 
  });//ajax2
 });
*/ 
 $("#comune_ana_update").change(function() {
  $("#localita_ana_update, #indirizzo_ana_update").removeAttr('disabled', 'disabled').removeClass('disabilitata');
  var id = $(this).val();
  $.ajax({
   type: "POST",
   url: "inc/dinSelLocalita.php",
   data: {id:id},
   cache: false,
   success: function(html){$("#localita_ana_update").html(html);} 
  });//ajax1
  $.ajax({
   type: "POST",
   url: "inc/dinSelIndirizzo.php",
   data: {id:id},
   cache: false,
   success: function(html){$("#indirizzo_ana_update").html(html);} 
  });//ajax2
 }); 
 
 $("#cmp_id").change(function() {
  var id = $(this).val();
  $.ajax({
   type: "POST",
   url: "inc/dinSelRicerca2.php",
   data: {id:id},
   cache: false,
   success: function(html){$("#dati_ricerca_cmp").html(html);} 
  });//ajax1
 });
 
  $("#prv_id").change(function() {
  var id = $(this).val();
  $.ajax({
   type: "POST",
   url: "inc/dinSelRicerca2.php",
   data: {id:id},
   cache: false,
   success: function(html){$("#dati_ricerca_prv").html(html);} 
  });//ajax1
 });
 
 $("#ana_id").change(function() {
  var id = $(this).val();
  $.ajax({
   type: "POST",
   url: "inc/dinSelAnagrafica.php",
   data: {id:id},
   cache: false,
   success: function(html){$("#ana_info").html(html);} 
  });//ajax1
 });
 $("#denric_update").change(function() {
  var id = $(this).val();
  $.ajax({
   type: "POST",
   url: "inc/dinSelRicerca.php",
   data: {id:id},
   cache: false,
   success: function(html){$("#tabellaRicerca").html(html);} 
  });//ajax1
 });
 
  $("#denricprv_update").change(function() {
  var id = $(this).val();
  $.ajax({
   type: "POST",
   url: "inc/dinSelRicercaPrv.php",
   data: {id:id},
   cache: false,
   success: function(html){$("#tabellaRicercaPrv").html(html);} 
  });//ajax1
 });
 
  $("#ana_ubi").change(function() {
  var id = $(this).val();
  //alert(id); return false;
  $.ajax({
   type: "POST",
   url: "inc/dinSelAnagrafica.php",
   data: {id:id},
   cache: false,
   success: function(html){$("#ubi_info").html(html);} 
  });//ajax1
 });
});