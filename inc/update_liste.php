<?php
include("db.php");
$tab = $_POST['tab'];

$select = ("select * FROM $tab ORDER BY definizione ASC;");

$result = pg_query($connection, $select);
$righe = pg_num_rows($result);

if($righe != 0) {
     for ($y = 0; $y < $righe; $y++){
       $id = pg_result($result, $y,"id"); 	
       $def = pg_result($result, $y,"definizione");
       echo "<tr class='trListe' id='$tab$id' tab='$tab' def='$def' rec='$id'><td>$def</td><td class='modLista update'>modifica</td><td class='modLista del'>elimina</td></tr>";
     }
}else{echo "<tr class='' ref=''><td colspan='3'>Nessuna definizione disponibile</td></tr>";}
?>

<script type="text/javascript" >
//var tabella,id,def;
$(document).ready(function() {
     	
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
           success: function(data){
           	$('#vocabolariTable tbody').html(data);
           	$('<div style="text-align:center;"><h2>Inserimento avvenuto correttamente</h2><p>Per modificare o eliminare un record appena inserito devi prima ricaricare la pagina!</p></div>')
           	.dialog()
           	.delay(2500)
           	.fadeOut(function(){ $(this).dialog("close");});
           }//success
        });//ajax
      }
     });
     
    $('td.del').each(function(){ 
     var tabella = $(this).parent('tr').attr('tab');
     var def = $(this).parent('tr').attr('def');
     var id = $(this).parent('tr').attr('rec');
     var idTipDelete = 'delete-'+tabella+id;
     //$(this).click(function(){alert(tabella+' - '+def+' - '+id);return false;});
     $(this).qtip({
     	 id: idTipDelete,
    	 content: { 
    	    text: 'Loading...',
    	    title: {
              text: 'Elimina il record "'+def+'"',
              button: 'Close'
          },
    	    ajax: {
    	       url: 'inc/deleteRecordListaConfirm.php',
             data: {tabella:tabella, def:def, id:id},
             type: 'POST'
    	    }
       },
       overwrite: false,
    	 style: {classes: 'qtip-shadow qtip-youtube ui-tooltip-rounded'},
    	 //style:{widget:true, def:false},
    	 position: {my: 'right center', at: 'left center'},
    	 show: {event: 'click'},
       hide: {event: false}
	 });
	}); 
	
	$('td.update').each(function(){ 
     var tabella = $(this).parent('tr').attr('tab');
     var def = $(this).parent('tr').attr('def');
     var id = $(this).parent('tr').attr('rec');
     var idTipUpdate = 'update-'+tabella+id;
     $(this).qtip({
    	 id: idTipUpdate,
    	 content: { 
    	    text: 'Loading...',
    	    title: {
              text: 'Aggiorna il record il record "'+def+'"',
              button: 'Close'
          },
    	    ajax: {
    	       url: 'inc/updateRecordListaConfirm.php',
             data: {tabella:tabella, def:def, id:id},
             type: 'POST'
    	    }
       },
       overwrite: false,
    	 style: {classes: 'qtip-shadow qtip-bootstrap ui-tooltip-rounded'},
    	 position: {my: 'right center', at: 'left center'},
    	 show: {event: 'click'},
       hide: {event: false}
	 });
	}); 
	
});
</script>