var tab, tabella,id,def;
$(document).ready(function() {
 $('.link').each(function(){
   $(this).click(function(){
     var cliccata = $(this);
     $('.link').not(cliccata).removeClass('cliccata');
     cliccata.addClass('cliccata');
     
     tab = cliccata.attr('ref');
     $('#intestaz').html('Stai modificando i valori della tabella <b>'+tab+'</b>');
     $.ajax({
       url: 'inc/update_liste.php',
       type: 'POST', 
       data: {tab:tab},	
       success: function(data){$('#vocabolariTable tbody').html(data);}//success
     });//ajax
     
     var button = '<input id="addDefinizione" name="addDefinizione" type="text" /><input type="button" id="add" name="add" value="Aggiungi definizione" />';
     $('#pulsanti').html(button);
     
   });//.link click
 });//.link each

$("#confirm").dialog({
          autoOpen:false,
          title: "Conferma eliminazione record",
          modal: true,
          width:'auto',
          height:'auto',
          resizable:false,
          buttons: {
             'Annulla eliminazione': function() {$(this).dialog('close');},
             'Elimina record': function() {
             	//alert(tabella + id + def); return false;
               $.ajax({
                 url: 'inc/deleteRecordListaScript.php',
                 type: 'POST', 
                 data: {tabella:tabella,id:id}, 
                 success: function(data){$('#vocabolariTable tbody').html(data);}//success
               });//ajax
               $(this).dialog('close');
             }    
          } 
         });//dialog	
	
	
	$('#add').click(function(){
      var newDef = $('#addDefinizione').val();
      if(!newDef){
      	alert('Attenzione!\nDevi inserire un valore prima di cliccare sul tasto "Aggiungi definizione"'); 
      	return false;
      }else{
      //alert(tab + ' ' +newDef);return false;
        $.ajax({
           url: 'inc/insertRecordListaScript.php',
           type: 'POST', 
           data: {tab:tab,newDef:newDef}, 
           success: function(data){$('#vocabolariTable tbody').html(data);}//success
        });//ajax
      }
     });
     
     $('.del').each(function(){
       $(this).click(function(){
       	tabella = $(this).parent('tr').attr('tab');
         id = $(this).parent('tr').attr('id');
         def = $(this).parent('tr').attr('def');
         $('#record').text(def);
         //alert(tab+': '+id); return false;
         $("#confirm").dialog('open');
       });//click
     });//each
});