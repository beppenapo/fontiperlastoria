  function removeCorrela(id){
       if (confirm("Sei sicuro di voler eliminare questa correlazione?")) {
              $.ajax({
               url: 'inc/remove_schede_correlate_script.php',
               type: 'POST',
               data: {id:id},
               success: function(data){
                 $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
                 .delay(5000)
                 .fadeOut(function(){ $(this).dialog("close"); location.reload(); })
                 ;
               }//success
              });//ajax
       }
  }
  function removeInfrastruttura(id){
       if (confirm("Sei sicuro di voler eliminare questa correlazione?")) {
              $.ajax({
               url: 'inc/remove_mater_infrastruttura.php',
               type: 'POST',
               data: {id:id},
               success: function(data){
                 $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
                 .delay(5000)
                 .fadeOut(function(){ $(this).dialog("close"); location.reload();})
                 ;
               }//success
              });//ajax
       }
  }
  function removeArea(id){
       if (confirm("Sei sicuro di voler eliminare quest'area?")) {
              $.ajax({
               url: 'inc/remove_areaScheda_script.php',
               type: 'POST',
               data: {id:id},
               success: function(data){
                 $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
                 .delay(5000)
                 .fadeOut(function(){ $(this).dialog("close"); location.reload(); })
                 ;
               }//success
              });//ajax
       }
  }
  function removeParente(id){
       if (confirm("Sei sicuro di voler eliminare questa correlazione?")) {
              $.ajax({
               url: 'inc/remove_schede_parenti_script.php',
               type: 'POST',
               data: {id:id},
               success: function(data){
                 $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
                 .delay(5000)
                 .fadeOut(function(){ $(this).dialog("close"); location.reload();})
                 ;
               }//success
              });//ajax
       }
  }

function areeFunc(){
    var areeNum = $('.areeList').length;
    if(areeNum>1){$("#areeListCanc").text("Rimuovi l'ultima area inserita"); }
    else if (areeNum == 0) {$("#areeListCanc").parent().fadeOut('slow');$(".clear").remove();}
    else{$("#areeListCanc").text("Annulla inserimento area"); }
}