 $(document).ready(function() {
   var id = '<?php echo($id); ?>';
   var livello = '<?php echo($livello); ?>';
   $('#liv'+livello).addClass('livAttivo');
   
   $('.slide').hide();
   $('.sezioni').click(function(){$(this).next('.slide').slideToggle();});
   
///////// FORM UPDATE /////////////////
   $("#updateContent").dialog({
      autoOpen: false,
      resizable:false,
      modal:true,
      height: 'auto',
      width: 500,
      title: "Modifica sezione",
      buttons: {'Chiudi form': function() {$(this).dialog('close');}}//buttons
   });//dialog
     
   $('.update').each(function(){
    $(this).click(function(){
     var form = $(this).attr('id');
     alert(form);return false;
     $('#updateContent').load('../inc/form_update/'+form+'.php?id='+id);
     $('#updateContent').dialog('open');
     return false;
    });//click
   });//each
   $("#updateContent").dialog("option", "position", ['center','center']);
});
