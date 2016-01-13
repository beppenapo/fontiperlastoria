$(document).ready(function () {

 $('#dati_principali_update').click(function(){
 	var num_sch_update = $('#num_sch_update').val();
   var tpsch_update   = $('#tpsch_update').val();
   var def_ogg_update = $('#def_ogg_update').val();
   var crospec_update= $('#cro_spec_update').val();
   var livind_update  = $('#livind_update').val();
   var schnote_update = $('#schnote_update').val();
   //var check = id+'\n'+ num_sch_update+'\n'+tpsch_update+'\n'+def_ogg_update+'\n'+crospec_update+'\n'+livind_update+'\n'+schnote_update;
   //alert(check);return false;
   $.ajax({
    url: 'inc/update_datiPrinc_script.php',
    type: 'POST',
    data: {id:id, num_sch_update:num_sch_update, tpsch_update:tpsch_update, def_ogg_update:def_ogg_update, crospec_update:crospec_update, livind_update:livind_update, schnote_update:schnote_update},
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(2500)
      .fadeOut(function(){ $(this).dialog("close");window.location.href = 'scheda_archeo.php?id='+id; })
      ;
    }//success
   });//ajax
 });

  $('#dettagli_crono_update').click(function(){
 	var crospec_update   = $('#crospec_update').val();
   var cro_iniz         = $('#cro_iniz').val();
   var cro_fine         = $('#cro_fine').val();
   var cro_motiv_update = $('#cro_motiv_update').val();
   var cronote_update   = $('#cronote_update').val();
   //var check = id+'\n'+ crospec_update+'\n'+cro_iniz+'\n'+cro_fine+'\n'+cro_motiv_update+'\n'+cronote_update;
   //alert(check);return false;
   $.ajax({
    url: 'inc/update_dettagliCrono_script.php',
    type: 'POST',
    data: {id:id,crospec_update:crospec_update,  cro_iniz:cro_iniz,cro_fine:cro_fine,cro_motiv_update:cro_motiv_update,cronote_update:cronote_update},
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(2500)
      .fadeOut(function(){ $(this).dialog("close");window.location.href = 'scheda_archeo.php?id='+id; })
      ;
    }//success
   });//ajax
 });


 $('#compilazione_update').click(function(){
 	var denric_update      = $('#denric_update').val();
 	//var compilatore_update = $('#compilatore_update').val();
   //var datacmp_update     = $('#datacmp_update').val();
   //var enresp_update      = $('#enteresp_update').val();
   //var respric_update     = $('#respric_update').val();
   var notecmp_update     = $('#notecmp_update').val();

   //var check = id+'\n'+ denric_update+'\n'+compilatore_update+'\n'+datacmp_update+'\n'+enresp_update+'\n'+respric_update+'\n'+notecmp_update;
   //alert(check);return false;

   $.ajax({
    url: 'inc/update_compilazione_script.php',
    type: 'POST',
    data: {id:id, denric_update:denric_update,notecmp_update:notecmp_update},
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(2500)
      .fadeOut(function(){ $(this).dialog("close");window.location.href = 'scheda_archeo.php?id='+id; })
      ;
    }//success
   });//ajax
 });

$('#provenienza_update').click(function(){
 	var denricprv_update      = $('#denricprv_update').val();
 	var compilatoreprv_update = $('#compilatoreprv_update').val();
   var dataprv_update     = $('#dataprv_update').val();
   var enrespprv_update      = $('#enrespprv_update').val();
   var respricprv_update     = $('#respricprv_update').val();
   var noteprv_update     = $('#noteprv_update').val();

   //var check = id+'\n'+ denricprv_update+'\n'+compilatoreprv_update+'\n'+dataprv_update+'\n'+enrespprv_update+'\n'+respricprv_update+'\n'+noteprv_update;
   //alert(check);return false;

   $.ajax({
    url: 'inc/update_provenienza_script.php',
    type: 'POST',
    data: {id:id, denricprv_update:denricprv_update, compilatoreprv_update: compilatoreprv_update, dataprv_update:dataprv_update, enrespprv_update:enrespprv_update, respricprv_update:respricprv_update, noteprv_update:noteprv_update},
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(2500)
      .fadeOut(function(){ $(this).dialog("close");window.location.href = 'scheda_archeo.php?id='+id; })
      ;
    }//success
   });//ajax
 });

 $('#area_add').click(function(){
   var areeList = '';
   $("div.areeList").each(function(){areeList += $(this).attr('val') + '|';});
   //alert(id+' '+areeList); return false;
   $.ajax({
    url: 'inc/area_ins_script.php',
    type: 'POST',
    data: {id:id,areeList:areeList},
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(2500)
      .fadeOut(function(){ $(this).dialog("close");window.location.href = 'scheda_archeo.php?id='+id; })
      ;
    }//success
   });//ajax
 });


 $('#area_interesse_update').click(function(){
 	var id_area = $('#id_area').val();
 	var comune_update      = $('#comune_update').val();
 	var localita_update = $('#localita_update').val();
   var indirizzo_update     = $('#indirizzo_update').val();
   var motiv_update      = $('#motiv_update').val();

   //var check = id+'\n'+ comune_update+'\n'+localita_update+'\n'+indirizzo_update+'\n'+motiv_update;
   //alert(check);return false;

   $.ajax({
    url: 'inc/update_areaInt_script.php',
    type: 'POST',
    data: {id:id,id_area:id_area, comune_update:comune_update, localita_update: localita_update, indirizzo_update:indirizzo_update, motiv_update:motiv_update},
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(2500)
      .fadeOut(function(){ $(this).dialog("close");window.location.href = 'scheda_archeo.php?id='+id; })
      ;
    }//success
   });//ajax
 });

 $('#noteai_update_click').click(function(){
   var noteaiupdate = $('#noteai_update').val();
   $.ajax({
    url: 'inc/update_noteai_script.php',
    type: 'POST',
    data: {id:id,noteaiupdate:noteaiupdate},
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(2500)
      .fadeOut(function(){ $(this).dialog("close");window.location.href = 'scheda_archeo.php?id='+id; })
      ;
    }//success
   });//ajax
 });

 $('#ubicazione_update').click(function(){
   var old_ubi = $('#id_area_old').val();
   var area_update = $('#areaubi_update').val();
   var motiv_update = $('#motivubi_update').val();
   var noteUbiUpdate = $('#noteUbiUpdate').val();
   //console.log(old_ubi+" - "+area_update+" - "+motiv_update+" - "+noteUbiUpdate);return false;
   //var check = id+'\n'+old_ubi+'\n'+localita_update+'\n'+motiv_update;
   //alert(check);return false;
   if (area_update!=672 && motiv_update == 16) {
     alert("Se scegli un'ubicazione devi compilare anche il campo motivazione!"); 
     return false;
   }else {
     $.ajax({
       url: 'inc/update_areaUbi_script.php',
       type: 'POST',
       data: {
          id:id,
          old_ubi:old_ubi,
          area_update:area_update,
          motiv_update:motiv_update,
          noteUbiUpdate:noteUbiUpdate
       },
       success: function(data){
        $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
        .delay(2500)
        .fadeOut(function(){ $(this).dialog("close");window.location.href = 'scheda_archeo.php?id='+id; })
        ;
       }//success
     });//ajax
   }  
 });

 $('#anagrafica_update').click(function(){
 	var id_ana = $('#id_ana').val();
   var note_ana_update = $('#note_ana_update').val();
        /*
 	var nome_ana_update = $('#nome_ana_update').val();
 	var comune_ana_update = $('#comune_ana_update').val();
   var localita_ana_update = $('#localita_ana_update').val();
   var indirizzo_ana_update = $('#indirizzo_ana_update').val();
   var tel_ana_update = $('#tel_ana_update').val();
   var mail_ana_update = $('#mail_ana_update').val();
   var web_ana_update = $('#web_ana_update').val();
*/
   //var check = id+'\n'+ comune_update+'\n'+localita_update+'\n'+indirizzo_update+'\n'+motiv_update;
   //alert(check);return false;

   $.ajax({
    url: 'inc/update_anagrafica_script.php',
    type: 'POST',
    // data: {id:id,id_ana:id_ana,nome_ana_update:nome_ana_update, comune_ana_update:comune_ana_update, localita_ana_update:localita_ana_update, indirizzo_ana_update:indirizzo_ana_update, tel_ana_update:tel_ana_update, mail_ana_update:mail_ana_update, web_ana_update:web_ana_update, note_ana_update:note_ana_update},
    data: {id:id,id_ana:id_ana, note_ana_update:note_ana_update},
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(2500)
      .fadeOut(function(){ $(this).dialog("close");window.location.href = 'scheda_archeo.php?id='+id; })
      ;
    }//success
   });//ajax
 });



/******************************* CONSULTABILITA ****************************/

 $('#consultabilitaButton_update').click(function(){
 	var consultabilita_update = $('#consultabilita_update').val();
   var orario_update         = $('#orario_update').val();
   var servizi_update        = $('#servizi_update').val();
   var servizi='';
   $("input[name=servizi]:checked").each(function () {
    var s = $(this).val();
    servizi+=s+', ';
   });
   //alert(s);return false;
   //var check = id+'\n'+ consultabilita_update+'\n'+orario_update+'\n'+servizi_update;
   //alert(check);return false;

   $.ajax({
    url: 'inc/update_consultabilita_script.php',
    type: 'POST',
    data: {id:id, consultabilita_update:consultabilita_update, orario_update: orario_update, servizi:servizi},
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(2500)
      .fadeOut(function(){ $(this).dialog("close");window.location.href = 'scheda_archeo.php?id='+id; })
      ;
    }//success
   });//ajax
 });


 $('#newschedacorr_update').click(function(){
   var schAssoc ='';
   $("div.schAssoc").each(function(){
      var id = $(this).attr('id');
      var tpsch = $(this).attr('tpsch');
      var livello = $(this).attr('livello');
      schAssoc += id + ','+tpsch+','+livello+'|';
   });
   //console.log(id+' '+schAssoc); return false;

   $.ajax({
    url: 'inc/add_schede_correlate_script.php',
    type: 'POST',
    data: {id:id, schAssoc:schAssoc},
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(2500)
      .fadeOut(function(){ $(this).dialog("close");window.location.href = 'scheda_archeo.php?id='+id; })
      ;
    }//success
   });//ajax
 });


 $('#newParenteUpdate').click(function(){
   var schPar ='';
   $("div.schAssoc2").each(function(){
      //var id = $(this).attr('id_scheda');
      var par = $(this).attr('id_parente');
      schPar += par+',';
   });
   //console.log(id+' '+schPar); return false;
   $.ajax({
    url: 'inc/add_schede_parente_script.php',
    type: 'POST',
    data: {id:id, schPar:schPar},
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(2500)
      .fadeOut(function(){ $(this).dialog("close");window.location.href = 'scheda_archeo.php?id='+id; })
      ;
    }//success
   });//ajax
 });
 
 $('#conservazione_update').click(function(){
 	var scn_update = $('#scn_update').val();
   var scn_note_update = $('#scn_note_update').val();

   //var check = id+'\n'+ scn_update+'\n'+scn_note_update;
   //alert(check);return false;

   $.ajax({
    url: 'inc/update_conservazione_script.php',
    type: 'POST',
    data: {id:id, scn_update:scn_update, scn_note_update: scn_note_update},
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(2500)
      .fadeOut(function(){ $(this).dialog("close");window.location.href = 'scheda_archeo.php?id='+id; })
      ;
    }//success
   });//ajax
 });

  $('#note_generali_update').click(function(){
 	var note_gen = $('#note_gen_update').val();
   //var check = id+'\n'+ scn_update+'\n'+scn_note_update;
   //alert(check);return false;

   $.ajax({
    url: 'inc/update_note_script.php',
    type: 'POST',
    data: {id:id, note_gen:note_gen},
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(2500)
      .fadeOut(function(){ $(this).dialog("close");window.location.href = 'scheda_archeo.php?id='+id; })
      ;
    }//success
   });//ajax
 });


 ////////////// ARCHEO 01 //////////////////////
   $('#descr_ind_update').click(function(){
 	var id_archeo = $('#id_archeo').val();
 	var data_update = $('#data_update').val();
 	var rifper_update = $('#rifper_update').val();
 	var metodo_update = $('#metodo_update').val();
 	var rifsito_update = $('#rifsito_update').val();
 	var descr_update = $('#descr_update').val();
 	var codsca_update = $('#codsca_update').val();
 	var note_update = $('#note_update').val();

   $.ajax({
    url: 'inc/update_descrInd_script.php',
    type: 'POST',
    data: {id:id, id_archeo:id_archeo, data_update:data_update, rifper_update:rifper_update, metodo_update:metodo_update, rifsito_update:rifsito_update, descr_update:descr_update, codsca_update:codsca_update, note_update:note_update},
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(2500)
      .fadeOut(function(){ $(this).dialog("close");window.location.href = 'scheda_archeo.php?id='+id; })
      ;
    }//success
   });//ajax
 });

 $('#altre_indagini_update').click(function(){
  var id_archeo = $('#id_archeo').val();
  var tipo_ind_update = $('#tipo_ind_update').val();
  var ain_data_update = $('#ain_data_update').val();
  var enresp_update = $('#enresp_update').val();
  var descr2_update = $('#descr2_update').val();
  var note1_update = $('#note1_update').val();
  $.ajax({
   url: 'inc/update_altreInd_script.php',
   type: 'POST',
   data: {id:id, id_archeo:id_archeo, tipo_ind_update:tipo_ind_update, ain_data_update:ain_data_update, enresp_update:enresp_update, descr2_update:descr2_update, note1_update:note1_update },
   success: function(data){
    $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
    .delay(2500)
    .fadeOut(function(){ $(this).dialog("close");window.location.href = 'scheda_archeo.php?id='+id; })
    ;
   }//success
  });//ajax
 });

////////////// ARCHEO 02 /////////////////
 $('#descr_ind2_update').click(function(){
 	var id_archeo = $('#id_archeo').val();
 	var data_update = $('#data_update').val();
 	var rifper_update = $('#rifper_update').val();
 	var rifsito_update = $('#rifsito_update').val();
 	var codsca_update = $('#codsca_update').val();
 	var note_update = $('#note_update').val();

 	//var check = id+'\n'+ id_archeo; alert(check);return false;

   $.ajax({
    url: 'inc/update_descrInd2_script.php',
    type: 'POST',
    data: {id:id, id_archeo:id_archeo, data_update:data_update, rifper_update:rifper_update, rifsito_update:rifsito_update, codsca_update:codsca_update, note_update:note_update},
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(2500)
      .fadeOut(function(){ $(this).dialog("close");window.location.href = 'scheda_archeo.php?id='+id; })
      ;
    }//success
   });//ajax
 });

  $('#descr_sito2_update').click(function(){
 	var id_archeo = $('#id_archeo').val();
 	var tipo_sito_update = $('#tipo_sito_update').val();
 	var descr_sito2 = $('#descr_sito2').val();
 	var ind_rif_sito2 = $('#ind_rif_sito2').val();
 	var ind_note_sito2 = $('#ind_note_sito2').val();

 	//var check = id+'\n'+ id_archeo +'\n' + tipo_sito_update;
 	//alert(check); return false;

   $.ajax({
    url: 'inc/update_descrSito2_script.php',
    type: 'POST',
    data: {id:id, id_archeo:id_archeo, tipo_sito_update:tipo_sito_update, descr_sito2:descr_sito2, ind_rif_sito2:ind_rif_sito2, ind_note_sito2:ind_note_sito2},
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(2500)
      .fadeOut(function(){ $(this).dialog("close");window.location.href = 'scheda_archeo.php?id='+id; })
      ;
    }//success
   });//ajax
 });

$('#dati_tecnici_update').click(function(){
 var id_archeo = $('#id_archeo').val();
 var archeo2_mis_update = $('#archeo2_mis_update').val();
 var archeo2_notemis_update = $('#archeo2_notemis_update').val();
 $.ajax({
  url: 'inc/update_datiTecnici_script.php',
  type: 'POST',
  data: {id:id, id_archeo:id_archeo, archeo2_mis_update:archeo2_mis_update, archeo2_notemis_update:archeo2_notemis_update},
  success: function(data){
   $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
   .delay(2500)
   .fadeOut(function(){ $(this).dialog("close");window.location.href = 'scheda_archeo.php?id='+id; })
   ;
  }//success
 });//ajax
});

 ///////////// BIBLIO 01 /////////////////////
 $('#descr_biblioteca_update').click(function(){
 	var id_biblio1 = $('#id_biblio1').val();
 	var tipo_biblio1_update = $('#tipo_biblio1_update').val();
 	var tipo_biblio1_descriz_update = $('#tipo_biblio1_descriz_update').val();

 	//var check = id_biblio1+'\n'+ tipo_biblio1_update +'\n' + tipo_biblio1_descriz_update;
 	//alert(check); return false;

   $.ajax({
    url: 'inc/update_descrBiblioteca_script.php',
    type: 'POST',
    data: {id_biblio1:id_biblio1, tipo_biblio1_update:tipo_biblio1_update, tipo_biblio1_descriz_update:tipo_biblio1_descriz_update},
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(2500)
      .fadeOut(function(){ $(this).dialog("close");window.location.href = 'scheda_archeo.php?id='+id; })
      ;
    }//success
   });//ajax
 });

  $('#biblio1_notestoriche_update').click(function(){
 	var id_biblio1 = $('#id_biblio1').val();
 	var biblio1_notsto_update = $('#biblio1_notsto_update').val();
 	var biblio1_ossbiblio_update = $('#biblio1_ossbiblio_update').val();

 	//var check = id_biblio1+'\n'+ biblio1_notsto_update +'\n' + biblio1_ossbiblio_update;
 	//alert(check); return false;

   $.ajax({
    url: 'inc/update_biblio1Notestoriche_script.php',
    type: 'POST',
    data: {id_biblio1:id_biblio1, biblio1_notsto_update:biblio1_notsto_update, biblio1_ossbiblio_update:biblio1_ossbiblio_update},
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(2500)
      .fadeOut(function(){ $(this).dialog("close");window.location.href = 'scheda_archeo.php?id='+id; })
      ;
    }//success
   });//ajax
 });

  ///////////// BIBLIO 02 /////////////////////
 $('#biblio2_dsc_fonte_update').click(function(){
 	var id_biblio2 = $('#id_biblio2').val();
   var bib_titolo = $('#biblio2_titolo_update').val();
   var bib_sogg = $('#biblio2_soggetto_update').val();
   var bib_nome = $('#biblio2_autore_update').val();
   var bib_notenome = $('#biblio2_notenome_update').val();
   var bib_contenuto = $('#biblio2_contenuto_update').val();
   var bib_livbib = $('#biblio2_livello_update').val();
   var bib_tipodoc = $('#biblio2_tipodoc_update').val();
   var bib_ediz = $('#biblio2_edizione_update').val();
   var bib_period = $('#biblio2_periodi_update').val();
   var bib_descfis = $('#biblio2_descrizione_update').val();
   //var bib_lingua = $('#biblio2_lingua_update').val();
   var bib_notestor = $('#biblio2_note_update').val();
   
   var bib_lingua ='';
   $("input[name=biblio2_lingua_update]:checked").each(function () {
    var linguaB2 = $(this).val();
    bib_lingua+=linguaB2+', ';
   });

   $.ajax({
    url: 'inc/update_biblio2DescFonte_script.php',
    type: 'POST',
    data: {id_biblio2:id_biblio2, bib_titolo:bib_titolo, bib_sogg :bib_sogg, bib_nome:bib_nome, bib_notenome:bib_notenome, bib_contenuto:bib_contenuto, bib_livbib:bib_livbib, bib_tipodoc:bib_tipodoc, bib_ediz:bib_ediz, bib_period:bib_period, bib_descfis:bib_descfis, bib_lingua:bib_lingua, bib_notestor:bib_notestor},
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(2500)
      .fadeOut(function(){ $(this).dialog("close");window.location.href = 'scheda_archeo.php?id='+id; })
      ;
    }//success
   });//ajax
 });

///////////// ARCHIVIO 01 /////////////////////
$('#archiv1_descr_update').click(function(){
 var id_archivi_update  = $('#id_archivi_update').val();
 var id_archivi1_update  = $('#id_archivi1_update').val();
 var archiv1_tipo_arch_update  = $('#archiv1_tipo_arch_update').val();
 var archiv1_consist_update    = $('#archiv1_consist_update').val();
 //var archiv1_tipoDoc_update    = $('#archiv1_tipoDoc_update').val();
 var archiv1FondiSegn_update   = $('#archiv1FondiSegn_update').val();
 var archiv1_fondi_update      = $('#archiv1_fondi_update').val();
 var archiv1_note_update       = $('#archiv1_note_update').val();
 
 var archiv1_tipoDoc_update='';
 $("input[name=archiv1_tipoDoc_update]:checked").each(function () {
    var archtipoA1 = $(this).val();
    archiv1_tipoDoc_update+=archtipoA1+', ';
 });

 	var check = id_archivi_update+'\n'+ id_archivi1_update+'\n'+ archiv1_tipo_arch_update +'\n'+archiv1_consist_update+'\n'+ archiv1_tipoDoc_update+'\n'+ archiv1FondiSegn_update+'\n'+ archiv1_fondi_update+'\n'+ archiv1_note_update;;
 	//var check = id_biblio2+'\n'+  bib_titolo+'\n'+ bib_sogg +'\n'+ bib_nome+'\n'+ bib_notenome+'\n'+ bib_contenuto+'\n'+ bib_livbib+'\n'+ bib_tipodoc+'\n'+ bib_ediz+'\n'+ bib_period+'\n'+ bib_descfis+'\n'+ bib_lingua+'\n'+ bib_notestor;
 	//alert(check);
 	//$('<div style="text-align:center;"><h2>Risultato query</h2><p>'+check+'</p></div>').dialog();
 	//return false;

   $.ajax({
    url: 'inc/update_archivi1Descr_script.php',
    type: 'POST',
    data: {id_archivi_update:id_archivi_update, id_archivi1_update:id_archivi1_update, archiv1_tipo_arch_update:archiv1_tipo_arch_update, archiv1_consist_update:archiv1_consist_update, archiv1_tipoDoc_update:archiv1_tipoDoc_update, archiv1FondiSegn_update:archiv1FondiSegn_update, archiv1_fondi_update:archiv1_fondi_update , archiv1_note_update:archiv1_note_update},
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(2500)
      .fadeOut(function(){ $(this).dialog("close");window.location.href = 'scheda_archeo.php?id='+id; })
      ;
    }//success
   });//ajax
 });
 //----------------------------------------------------------------//
 $("#archiv1_aggregati_salva").hide();
 $('#archiv1_livello').change(function () {
   var livello = $(this).val();
   //alert(id +'\n'+form); return false;

   $.ajax({
    url: 'inc/archiv1_aggregati_select.php',
    type: 'POST',
    data: {id:id, livello:livello},
    success: function(data){
      $('#archiv1_aggregato_update')
       .removeClass('disabilitata')
       .removeAttr("disabled", "disabled")
       .html(data);
    }//success
   });//ajax
 });
 $("#archiv1_aggregato_update").change(function () {
    var a = $(this).val();
    if(a != 0){$("#archiv1_aggregati_salva").fadeIn("fast");}else{$("#archiv1_aggregati_salva").fadeOut("fast");}
 })
 $("#archiv1_aggregati_salva").click(function () {
   var aggregato = $('#archiv1_aggregato_update').val();
   $.ajax({
    url: 'inc/update_archivi_aggregati_script.php',
    type: 'POST',
    data: {id:id, aggregato:aggregato},
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(2500)
      .fadeOut(function(){ $(this).dialog("close"); window.location = window.location; })
      ;
    }//success
   });//ajax
 });
  //----------------------------------------------------------------//
 $("#archiv1_aggrega_salva").hide();
 $('#archiv1_livello_aggrega').change(function () {
   var livello = $(this).val();
   $.ajax({
    url: 'inc/archiv1_aggregati_select.php',
    type: 'POST',
    data: {id:id, livello:livello},
    success: function(data){
      $('#archiv1_aggrega_update')
       .removeClass('disabilitata')
       .removeAttr("disabled", "disabled")
       .html(data);
    }//success
   });//ajax
 });
 $("#archiv1_aggrega_update").change(function () {
    var a = $(this).val();
    if(a != 0){$("#archiv1_aggrega_salva").fadeIn("fast");}else{$("#archiv1_aggrega_salva").fadeOut("fast");}
 })
 $("#archiv1_aggrega_salva").click(function () {
   var aggrega = $('#archiv1_aggrega_update').val();
   $.ajax({
    url: 'inc/update_archivi_aggrega_script.php',
    type: 'POST',
    data: {id:id, aggrega:aggrega},
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(2500)
      .fadeOut(function(){ $(this).dialog("close"); window.location = window.location; })
      ;
    }//success
   });//ajax
 });
//------------------------------------------------------------------------//
 $("#archiv1_aggregati_elimina").hide();
 var countChecked = function() {
  var n = $( "input[name=aggregato_del]:checked" ).length;
  $( "div.test" ).text( n + (n === 1 ? " archivio selezionato" : " archivi selezionati"));
  if (n > 0) {$("#archiv1_aggregati_elimina").fadeIn("fast");}else{$("#archiv1_aggregati_elimina").fadeOut("fast");}
 };
 countChecked();
 $( "input[name=aggregato_del]" ).click(countChecked);

 $("#archiv1_aggregati_elimina").click(function () {
  var v = '';
  var vCheck = $('input[name=aggregato_del]:checked');
  $(vCheck).each(function(){v += $(this).val() + '|';});
  //console.log(v+' '+id);return false;
  $.ajax({
    url: 'inc/deleteAggregatiScript.php',
    type: 'POST',
    data: {id:id, v:v},
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(2500)
      .fadeOut(function(){ $(this).dialog("close"); window.location = window.location; })
      ;
    }//success
   });//ajax
 });
//------------------------------------------------------------------------//
 $("#archiv1_aggregante_elimina").hide();
 var countChecked2 = function() {
  var n = $( "input[name=aggregante_del]:checked" ).length;
  $( "div.test" ).text( n + (n === 1 ? " archivio selezionato" : " archivi selezionati"));
  if (n > 0) {$("#archiv1_aggregante_elimina").fadeIn("fast");}else{$("#archiv1_aggregante_elimina").fadeOut("fast");}
 };
 countChecked2();
 $( "input[name=aggregante_del]" ).click(countChecked2);

 $("#archiv1_aggregante_elimina").click(function () {
  var v = '';
  var vCheck = $('input[name=aggregante_del]:checked');
  $(vCheck).each(function(){v += $(this).val() + '|';});
  $.ajax({
    url: 'inc/deleteAggreganteScript.php',
    type: 'POST',
    data: {id:id, v:v},
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(2500)
      .fadeOut(function(){ $(this).dialog("close"); window.location = window.location; })
      ;
    }//success
   });//ajax
 });
 //-------------------------------------------------------------------//
 $("#archiv1_crord_update").click(function () {
   var aou = $("#archiv1_ordinamento_update").val();
   var id_archivi1 = $("#id_archivi1_update").val();
   $.ajax({
    url: 'inc/update_archiv1_ordinamento_script.php',
    type: 'POST',
    data: {id_archivi1:id_archivi1, aou:aou},
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(2500)
      .fadeOut(function(){ $(this).dialog("close"); window.location = window.location; })
      ;
    }//success
   });//ajax
 });
 //-------------------------------------------------------------------//
  $("#archiv1_notsto_update").click(function () {
   var archiv1_vicarch_update = $("#archiv1_vicarch_update").val();
   var archiv1_notstonote_update = $("#archiv1_notstonote_update").val();
   var id_archivi1 = $("#id_archivi1_update").val();
   $.ajax({
    url: 'inc/update_archiv1_notsto_script.php',
    type: 'POST',
    data: {id_archivi1:id_archivi1, archiv1_vicarch_update:archiv1_vicarch_update, archiv1_notstonote_update:archiv1_notstonote_update},
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(2500)
      .fadeOut(function(){ $(this).dialog("close"); window.location = window.location; })
      ;
    }//success
   });//ajax
 });
///////////////////////////////////////////////
///////////// ARCHIVIO 02 /////////////////////
  $("#archiv2_segnatura_salva").click(function () {
   var idArchiv2 = $("#idArchiv2").val();
   var archiv2_segnatura_update = $("#archiv2_segnatura_update").val();
   $.ajax({
    url: 'inc/update_archiv2_segnatura_script.php',
    type: 'POST',
    data: {idArchiv2:idArchiv2, archiv2_segnatura_update:archiv2_segnatura_update},
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(2500)
      .fadeOut(function(){ $(this).dialog("close"); window.location = window.location; })
      ;
    }//success
   });//ajax
 });
 //------------------------------------------------//
 $("#archiv2_fondo_salva").click(function () {
   var idArchiv2 = $("#idArchiv2").val();
   var archiv2_dscfondo_update = $("#archiv2_dscfondo_update").val();
   var archiv2_consist_update = $("#archiv2_consist_update").val();   
   var archiv2_tipodoc_update='';
   $("input[name=archiv2_tipodoc_update]:checked").each(function () {
    var archtipoA2 = $(this).val();
    archiv2_tipodoc_update+=archtipoA2+', ';
   });
   var archiv2_lingua_update = '';
   $("input[name=archiv2_lingua_update]:checked").each(function () {
    var archLinguaA2 = $(this).val();
    archiv2_lingua_update+=archLinguaA2+', ';
   });
 
   var archiv2_fondonote_update = $("#archiv2_fondonote_update").val();
   $.ajax({
    url: 'inc/update_archiv2_fondo_script.php',
    type: 'POST',
    data: {idArchiv2:idArchiv2, archiv2_dscfondo_update:archiv2_dscfondo_update, archiv2_consist_update:archiv2_consist_update, archiv2_tipodoc_update:archiv2_tipodoc_update, archiv2_lingua_update:archiv2_lingua_update, archiv2_fondonote_update:archiv2_fondonote_update},
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(2500)
      .fadeOut(function(){ $(this).dialog("close"); window.location = window.location; })
      ;
    }//success
   });//ajax
 });
  //------------------------------------------------//
 $("#archiv2_notsto_salva").click(function () {
   var idArchiv2 = $("#idArchiv2").val();
   var archiv2_nstfondo_update = $("#archiv2_nstfondo_update").val();
   var archiv2_ossfondo_update = $("#archiv2_ossfondo_update").val();
   $.ajax({
    url: 'inc/update_archiv2_notsto_script.php',
    type: 'POST',
    data: {idArchiv2:idArchiv2, archiv2_nstfondo_update:archiv2_nstfondo_update, archiv2_ossfondo_update:archiv2_ossfondo_update},
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(2500)
      .fadeOut(function(){ $(this).dialog("close"); window.location = window.location; })
      ;
    }//success
   });//ajax
 });
///////////////////////////////////////////////
///////////// ARCHIVIO 03 /////////////////////
   //------------------------------------------------//
 $("#archiv3_descr_salva").click(function () {
   var idArchiv3= $("#idArchiv3").val();
   var archiv3_nstfondo_update = $("#archiv3_nstfondo_update").val();
   var archiv3_ossfondo_update = $("#archiv3_ossfondo_update").val();
   $.ajax({
    url: 'inc/update_archiv2_notsto_script.php',
    type: 'POST',
    data: {idArchiv2:idArchiv2, archiv2_nstfondo_update:archiv2_nstfondo_update, archiv2_ossfondo_update:archiv2_ossfondo_update},
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(2500)
      .fadeOut(function(){ $(this).dialog("close"); window.location = window.location; })
      ;
    }//success
   });//ajax
 });


  //------------------------------------------------//
 $("#archiv3_segnatura_salva").click(function () {
   var idArchiv3= $("#idArchiv3").val();
   var archiv3_segnatura_update = $("#archiv3_segnatura_update").val();
   //alert(idArchiv3+' '+ archiv3_segnatura_update); return false;
   $.ajax({
    url: 'inc/update_archiv3_segnatura_script.php',
    type: 'POST',
    data: {idArchiv3:idArchiv3, archiv3_segnatura_update:archiv3_segnatura_update},
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(2500)
      .fadeOut(function(){ $(this).dialog("close"); window.location = window.location; })
      ;
    }//success
   });//ajax
 });
    //------------------------------------------------//
 $("#archiv3_descrizione_salva").click(function () {
   var idArchiv3= $("#idArchiv3").val();
   var archiv3_data_update= $("#archiv3_data_update").val();
   /*var archiv3_tipo_update= $("#archiv3_tipo_update").val();*/
   var archiv3_luogo_update= $("#archiv3_luogo_update").val();
   var archiv3_supporto_update= $("#archiv3_supporto_update").val();
   var archiv3_contenuto_update= $("#archiv3_contenuto_update").val();
   var archiv3_descrizione_update= $("#archiv3_descrizione_update").val();
   var archiv3_tipo_update='';
   var archiv3_lingua_update='';
   
   $("input[name=archiv3_tipo_update]:checked").each(function () {
    var archtipoA3 = $(this).val();
    archiv3_tipo_update+=archtipoA3+', ';
   });
   
   $("input[name=archiv3_lingua_update]:checked").each(function () {
    var linguaA3 = $(this).val();
    archiv3_lingua_update+=linguaA3+', ';
   });
   
   var archiv3_note_update= $("#archiv3_note_update").val();
   //alert(archiv3_tipo_update); return false;
   $.ajax({
    url: 'inc/update_archiv3_descrizione_script.php',
    type: 'POST',
    data: {idArchiv3:idArchiv3,archiv3_data_update:archiv3_data_update, archiv3_tipo_update:archiv3_tipo_update, archiv3_luogo_update:archiv3_luogo_update, archiv3_supporto_update:archiv3_supporto_update, archiv3_contenuto_update:archiv3_contenuto_update, archiv3_descrizione_update:archiv3_descrizione_update, archiv3_lingua_update:archiv3_lingua_update, archiv3_note_update:archiv3_note_update},
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(2500)
      .fadeOut(function(){ $(this).dialog("close"); window.location = window.location; })
      ;
    }//success
   });//ajax
 });

///////////////////////////////////////////////
///////////// ARCHITETTONICA 01 /////////////////////
  $("#archtt1_descriz_bene_salva").click(function () {
    var idArchtt1= $("#idArchtt1").val();
    var archtt1_dsc_tipol1= $("#archtt1_dsc_tipol1").val();
    var archtt1_dsc_tcost1_update= $("#archtt1_dsc_tcost1_update").val();
    var archtt1_dsc_pianta1_update= $("#archtt1_dsc_pianta1_update").val();
    var archtt1_dsc_npiani1_update= $("#archtt1_dsc_npiani1_update").val();
    var archtt1_dsc_fond1_update= $("#archtt1_dsc_fond1_update").val();
    var archtt1_dsc_mur1_update= $("#archtt1_dsc_mur1_update").val();
    var archtt1_dsc_vsol1_update= $("#archtt1_dsc_vsol1_update").val();
    var archtt1_dsc_ambsott1_update= $("#archtt1_dsc_ambsott1_update").val();
    var archtt1_dsc_pavim1_update= $("#archtt1_dsc_pavim1_update").val();
    var archtt1_dsc_scale1_update= $("#archtt1_dsc_scale1_update").val();
    var archtt1_dsc_coper1_update= $("#archtt1_dsc_coper1_update").val();
    var archtt1_dsc_bene1_update= $("#archtt1_dsc_bene1_update").val();
    var archtt1_dsc_note1_update= $("#archtt1_dsc_note1_update").val();
   $.ajax({
    url: 'inc/update_archtt1_descriz_bene_script.php',
    type: 'POST',
    data: {idArchtt1:idArchtt1, archtt1_dsc_tipol1:archtt1_dsc_tipol1, archtt1_dsc_tcost1_update:archtt1_dsc_tcost1_update, archtt1_dsc_pianta1_update:archtt1_dsc_pianta1_update, archtt1_dsc_npiani1_update:archtt1_dsc_npiani1_update, archtt1_dsc_fond1_update:archtt1_dsc_fond1_update, archtt1_dsc_mur1_update:archtt1_dsc_mur1_update, archtt1_dsc_vsol1_update:archtt1_dsc_vsol1_update, archtt1_dsc_ambsott1_update:archtt1_dsc_ambsott1_update, archtt1_dsc_pavim1_update:archtt1_dsc_pavim1_update,  archtt1_dsc_scale1_update:archtt1_dsc_scale1_update, archtt1_dsc_coper1_update:archtt1_dsc_coper1_update, archtt1_dsc_bene1_update:archtt1_dsc_bene1_update, archtt1_dsc_note1_update:archtt1_dsc_note1_update},
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(2500)
      .fadeOut(function(){ $(this).dialog("close"); window.location = window.location; })
      ;
    }//success
   });//ajax
 });

 //----------------dati tecnici---------------------------//
   $("#archtt1_dati_tecnici_salva").click(function () {
    var idArchtt1= $("#idArchtt1").val();
    var archtt1_dtc_mis_update= $("#archtt1_dtc_mis_update").val();
    var archtt1_dtc_notemis_update= $("#archtt1_dtc_notemis_update").val();

   $.ajax({
    url: 'inc/update_archtt1_dati_tecnici_script.php',
    type: 'POST',
    data: {idArchtt1:idArchtt1, archtt1_dtc_mis_update:archtt1_dtc_mis_update, archtt1_dtc_notemis_update:archtt1_dtc_notemis_update},
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(2500)
      .fadeOut(function(){ $(this).dialog("close"); window.location = window.location; })
      ;
    }//success
   });//ajax
 });
 //----------------restauri---------------------------//
   $("#archtt1_restauri_salva").click(function () {
    var idArchtt1= $("#idArchtt1").val();
    var archtt1_rst_tpint_update= $("#archtt1_rst_tpint_update").val();
    var archtt1_rst_rifar_update= $("#archtt1_rst_rifar_update").val();
    var archtt1_rst_note_update= $("#archtt1_rst_note_update").val();

   $.ajax({
    url: 'inc/update_archtt1_restauri_script.php',
    type: 'POST',
    data: {idArchtt1:idArchtt1, archtt1_rst_tpint_update:archtt1_rst_tpint_update, archtt1_rst_rifar_update:archtt1_rst_rifar_update, archtt1_rst_note_update:archtt1_rst_note_update},
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(2500)
      .fadeOut(function(){ $(this).dialog("close"); window.location = window.location; })
      ;
    }//success
   });//ajax
 });
  //----------------catasti storici---------------------------//
   $("#archtt1_catsto_salva").click(function () {
    var idArchtt1= $("#idArchtt1").val();
    var archtt1_cat_stornap_update= $("#archtt1_cat_stornap_update").val();
    var archtt1_cat_storasb_update= $("#archtt1_cat_storasb_update").val();
    //alert(idArchtt1+' '+archtt1_cat_stornap_update+' ' +archtt1_cat_storasb_update); return false;
   $.ajax({
    url: 'inc/update_archtt1_catsto_script.php',
    type: 'POST',
    data: {idArchtt1:idArchtt1, archtt1_cat_stornap_update:archtt1_cat_stornap_update, archtt1_cat_storasb_update:archtt1_cat_storasb_update},
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(2500)
      .fadeOut(function(){ $(this).dialog("close"); window.location = window.location; })
      ;
    }//success
   });//ajax
 });

///////////////////////////////////////////////
///////////// ARCHITETTONICA 02 /////////////////////
  $("#archtt2_descriz_bene_salva").click(function () {
    var idArchtt2= $("#idArchtt2").val();
    var archtt2_dsc_tipol2= $("#archtt2_dsc_tipol2").val();
    var archtt2_dsc_tcost2_update= $("#archtt2_dsc_tcost2_update").val();
    var archtt2_dsc_pianta2_update= $("#archtt2_dsc_pianta2_update").val();
    var archtt2_dsc_npiani2_update= $("#archtt2_dsc_npiani2_update").val();
    var archtt2_dsc_fond2_update= $("#archtt2_dsc_fond2_update").val();
    var archtt2_dsc_mur2_update= $("#archtt2_dsc_mur2_update").val();
    var archtt2_dsc_vsol2_update= $("#archtt2_dsc_vsol2_update").val();
    var archtt2_dsc_ambsott2_update= $("#archtt2_dsc_ambsott2_update").val();
    var archtt2_dsc_pavim2_update= $("#archtt2_dsc_pavim2_update").val();
    var archtt2_dsc_scale2_update= $("#archtt2_dsc_scale2_update").val();
    var archtt2_dsc_coper2_update= $("#archtt2_dsc_coper2_update").val();
    var archtt2_dsc_bene2_update= $("#archtt2_dsc_bene2_update").val();
    var archtt2_dsc_note2_update= $("#archtt2_dsc_note2_update").val();
    var archtt2_dsc_matdata_update= $("#archtt2_dsc_matdata_update").val();
    //alert('idArchtt2 '+idArchtt2+'\narchtt2_dsc_tipol2 '+archtt2_dsc_tipol2+'\narchtt2_dsc_tcost2_update '+archtt2_dsc_tcost2_update+'\narchtt2_dsc_pianta2_update '+archtt2_dsc_pianta2_update+'\narchtt2_dsc_npiani2_update '+archtt2_dsc_npiani2_update+'\narchtt2_dsc_fond2_update '+archtt2_dsc_fond2_update+'\narchtt2_dsc_mur2_update '+archtt2_dsc_mur2_update+'\narchtt2_dsc_vsol2_update '+archtt2_dsc_vsol2_update+'\narchtt2_dsc_ambsott2_update '+archtt2_dsc_ambsott2_update+'\narchtt2_dsc_pavim2_update '+archtt2_dsc_pavim2_update+'\n archtt2_dsc_scale2_update '+archtt2_dsc_scale2_update+'\narchtt2_dsc_coper2_update '+archtt2_dsc_coper2_update+'\narchtt2_dsc_bene2_update '+archtt2_dsc_bene2_update+'\narchtt2_dsc_note2_update '+archtt2_dsc_note2_update); return false;
   $.ajax({
    url: 'inc/update_archtt2_descriz_bene_script.php',
    type: 'POST',
    data: {idArchtt2:idArchtt2, archtt2_dsc_tipol2:archtt2_dsc_tipol2, archtt2_dsc_tcost2_update:archtt2_dsc_tcost2_update, archtt2_dsc_pianta2_update:archtt2_dsc_pianta2_update, archtt2_dsc_npiani2_update:archtt2_dsc_npiani2_update, archtt2_dsc_fond2_update:archtt2_dsc_fond2_update, archtt2_dsc_mur2_update:archtt2_dsc_mur2_update, archtt2_dsc_vsol2_update:archtt2_dsc_vsol2_update, archtt2_dsc_ambsott2_update:archtt2_dsc_ambsott2_update, archtt2_dsc_pavim2_update:archtt2_dsc_pavim2_update,  archtt2_dsc_scale2_update:archtt2_dsc_scale2_update, archtt2_dsc_coper2_update:archtt2_dsc_coper2_update, archtt2_dsc_bene2_update:archtt2_dsc_bene2_update, archtt2_dsc_note2_update:archtt2_dsc_note2_update, archtt2_dsc_matdata_update:archtt2_dsc_matdata_update},
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(2500)
      .fadeOut(function(){ $(this).dialog("close"); window.location = window.location; })
      ;
    }//success
   });//ajax
 });
//----------------dati tecnici2---------------------------//
   $("#archtt2_dati_tecnici_salva").click(function () {
    var idArchtt2= $("#idArchtt2").val();
    var archtt2_dtc_mis_update= $("#archtt2_dtc_mis_update").val();
    var archtt2_dtc_notemis_update= $("#archtt2_dtc_notemis_update").val();

   $.ajax({
    url: 'inc/update_archtt2_dati_tecnici_script.php',
    type: 'POST',
    data: {idArchtt2:idArchtt2, archtt2_dtc_mis_update:archtt2_dtc_mis_update, archtt2_dtc_notemis_update:archtt2_dtc_notemis_update},
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(2500)
      .fadeOut(function(){ $(this).dialog("close"); window.location = window.location; })
      ;
    }//success
   });//ajax
 });
//----------------catasti storici2---------------------------//
   $("#archtt2_catsto_salva").click(function () {
    var idArchtt2= $("#idArchtt2").val();
    var archtt2_cat_stornap_update= $("#archtt2_cat_stornap_update").val();
    var archtt2_cat_storasb_update= $("#archtt2_cat_storasb_update").val();
    //alert(idArchtt2+' '+archtt2_cat_stornap_update+' ' +archtt2_cat_storasb_update); return false;
   $.ajax({
    url: 'inc/update_archtt2_catsto_script.php',
    type: 'POST',
    data: {idArchtt2:idArchtt2, archtt2_cat_stornap_update:archtt2_cat_stornap_update, archtt2_cat_storasb_update:archtt2_cat_storasb_update},
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(2500)
      .fadeOut(function(){ $(this).dialog("close"); window.location = window.location; })
      ;
    }//success
   });//ajax
 });
 ///////////////////////////////////////////////
///////////// MATERIALE 01 /////////////////////
  $("#mater1_descr_salva").click(function () {
    var idMater1=$("#idMater1").val();
    var mater1_dsc_tpfonte=$("#mater1_dsc_tipo_raccolta").val();
    var mater1_dsc_nummanuf=$("#mater1_dsc_nummanuf").val();
    var mater1_dsc_ogg=$("#mater1_dsc_ogg").val();
    //var mater1_dsc_catman=$("#mater1_dsc_catman").val();
    var mater1_dsc_contaa=$("#mater1_dsc_contaa").val();
    var mater1_dsc_gradutil=$("#mater1_dsc_gradutil").val();
    var mater1_dsc_oggpreg=$("#mater1_dsc_oggpreg").val();
    var mater1_dsc_oss=$("#mater1_dsc_oss").val();
    
    var mater1_dsc_catman='';
    $("input[name=mater1CatMan]:checked").each(function () {
     var catman = $(this).val();
     mater1_dsc_catman+=catman+', ';
    });
    //alert('idMater1:'+idMater1+'\nmater1_dsc_tpfonte: '+mater1_dsc_tpfonte+'\nmater1_dsc_nummanuf: '+mater1_dsc_nummanuf+'\nmater1_dsc_ogg: '+mater1_dsc_ogg+'\nmater1_dsc_catman: '+mater1_dsc_catman+'\nmater1_dsc_contaa: '+mater1_dsc_contaa+'\nmater1_dsc_gradutil: '+mater1_dsc_gradutil+'\nmater1_dsc_oggpreg: '+mater1_dsc_oggpreg+'\nmater1_dsc_oss: '+mater1_dsc_oss); return false;
   $.ajax({
    url: 'inc/update_mater1_descriz_script.php',
    type: 'POST',
    data: {idMater1:idMater1, mater1_dsc_tpfonte:mater1_dsc_tpfonte, mater1_dsc_nummanuf:mater1_dsc_nummanuf, mater1_dsc_ogg:mater1_dsc_ogg, mater1_dsc_catman:mater1_dsc_catman, mater1_dsc_contaa:mater1_dsc_contaa, mater1_dsc_gradutil:mater1_dsc_gradutil, mater1_dsc_oggpreg:mater1_dsc_oggpreg, mater1_dsc_oss:mater1_dsc_oss},
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(2500)
      .fadeOut(function(){ $(this).dialog("close"); window.location = window.location; })
      ;
    }//success
   });//ajax
 });


//----------------criteri di ordinamento -----------------------//
  $("#mater1_criteri_salva").click(function () {
    var idMater1=$("#idMater1").val();
    var mater1_dsc_critord=$("#mater1_dsc_critord").val();

   $.ajax({
    url: 'inc/update_mater1_criteri_script.php',
    type: 'POST',
    data: {idMater1:idMater1, mater1_dsc_critord:mater1_dsc_critord},
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(2500)
      .fadeOut(function(){ $(this).dialog("close"); window.location = window.location; })
      ;
    }//success
   });//ajax
 });
 //----------------note storiche -----------------------//
  $("#mater1_notsto_salva").click(function () {
    var idMater1=$("#idMater1").val();
    var mater1_dsc_notesto=$("#mater1_dsc_notesto").val();
    var mater1_dsc_notstooss=$("#mater1_dsc_notstooss").val();

   $.ajax({
    url: 'inc/update_mater1_notsto_script.php',
    type: 'POST',
    data: {idMater1:idMater1, mater1_dsc_notesto:mater1_dsc_notesto, mater1_dsc_notstooss:mater1_dsc_notstooss},
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(2500)
      .fadeOut(function(){ $(this).dialog("close"); window.location = window.location; })
      ;
    }//success
   });//ajax
 });
 ///////////////////////////////////////////////
///////////// MATERIALE 02 /////////////////////
  $("#mater2_descr_salva").click(function () {
    var idMater2=$("#idMater2").val();
    var mater2_dog_catgen=$("#mater2_dog_catgen").val();
    var mater2_dtp_morf=$("#mater2_dtp_morf").val();
    var mater2_dtp_morfnote=$("#mater2_dtp_morfnote").val();
    var mater2_dtp_uso=$("#mater2_dtp_uso").val();
    var mater2_dtp_usonote=$("#mater2_dtp_usonote").val();
    var mater2_dog_catspec=$("#mater2_dtp_catspec").val();
    var mater2_dtp_cta=$("#mater2_dtp_cta").val();
    var mater2_dtp_ctanote=$("#mater2_dtp_ctanote").val();
    var mater2_dtp_crntipo=$("#mater2_dtp_crntipo").val();
    var mater2_dtp_num=$("#mater2_dtp_num").val();
    var mater2_dtp_note=$("#mater2_dtp_note").val();
    //alert('idMater1:'+idMater1+'\nmater1_dsc_tpfonte: '+mater1_dsc_tpfonte+'\nmater1_dsc_nummanuf: '+mater1_dsc_nummanuf+'\nmater1_dsc_ogg: '+mater1_dsc_ogg+'\nmater1_dsc_catman: '+mater1_dsc_catman+'\nmater1_dsc_contaa: '+mater1_dsc_contaa+'\nmater1_dsc_gradutil: '+mater1_dsc_gradutil+'\nmater1_dsc_oggpreg: '+mater1_dsc_oggpreg+'\nmater1_dsc_oss: '+mater1_dsc_oss); return false;
   $.ajax({
    url: 'inc/update_mater2_descriz_script.php',
    type: 'POST',
    data: {idMater2:idMater2, mater2_dog_catgen:mater2_dog_catgen, mater2_dtp_morf:mater2_dtp_morf, mater2_dtp_morfnote:mater2_dtp_morfnote, mater2_dtp_uso:mater2_dtp_uso, mater2_dtp_usonote:mater2_dtp_usonote, mater2_dog_catspec:mater2_dog_catspec, mater2_dtp_cta:mater2_dtp_cta, mater2_dtp_ctanote:mater2_dtp_ctanote, mater2_dtp_crntipo:mater2_dtp_crntipo, mater2_dtp_num:mater2_dtp_num, mater2_dtp_note:mater2_dtp_note},
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(2500)
      .fadeOut(function(){ $(this).dialog("close"); window.location = window.location; })
      ;
    }//success
   });//ajax
 });

 ///////////////////////////////////////////////
///////////// MATERIALE 03 /////////////////////
var catspecclass = $("#catspecclass").val();
if (catspecclass == 2) {$("#sottocategorie").show();}else {$("#sottocategorie").hide();}
//---------------segnatura---------------------/
  $("#mater3_segnatura_salva").click(function () {
    var idMater3=$("#idMater3").val();
    var mater3_segn=$("#mater3_segn").val();
    //alert('idMater3:'+idMater3+'\nsegnatura: '+mater3_segn); return false;
   $.ajax({
    url: 'inc/update_mater3_segnatura_script.php',
    type: 'POST',
    data: {idMater3:idMater3, mater3_segn:mater3_segn},
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(2500)
      .fadeOut(function(){ $(this).dialog("close"); window.location = window.location; })
      ;
    }//success
   });//ajax
 });
//---------------denominazione comune---------------------/
  $("#mater3_denominazione_salva").click(function () {
    var idMater3=$("#idMater3").val();
    var mater3_denom=$("#mater3_denom").val();
    var mater3_denomnote=$("#mater3_denomnote").val();
    //alert('idMater3:'+idMater3+'\nsegnatura: '+mater3_segn); return false;
   $.ajax({
    url: 'inc/update_mater3_denominazione_script.php',
    type: 'POST',
    data: {idMater3:idMater3, mater3_denom:mater3_denom, mater3_denomnote:mater3_denomnote},
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(2500)
      .fadeOut(function(){ $(this).dialog("close"); window.location = window.location; })
      ;
    }//success
   });//ajax
 });

//---------------morfologia---------------------/
  $("#mater3_morfologia_salva").click(function () {
    var idMater3=$("#idMater3").val();
    var mater3_catgen=$("#mater3_catgen").val();
    var mater3_catspec=$("#mater3_catspec").val();
    var mater3_mrf_descr3=$("#mater3_mrf_descr3").val();
    var mater3_mrf_note3=$("#mater3_mrf_note3").val();
    
    var mater3_mrf_matcost3='';
    $("input[name=matcos]:checked").each(function () {
     var matcos = $(this).val();
     mater3_mrf_matcost3+=matcos+', ';
    });
    
    var mater3_mrf_modcostr3='';
    $("input[name=modcos]:checked").each(function () {
     var modcos = $(this).val();
     mater3_mrf_modcostr3+=modcos+', ';
    });

    //alert('idMater3: '+idMater3+'\nmater3_catgen:'+mater3_catgen+'\nmater3_catspec:'+mater3_catspec+' \nmater3_mrf_descr3:'+mater3_mrf_descr3+'\nmater3_mrf_modcostr3:'+mater3_mrf_modcostr3+'\nmater3_mrf_matcost3:'+mater3_mrf_matcost3+'\nmater3_mrf_note3:'+mater3_mrf_note3); return false;
   $.ajax({
    url: 'inc/update_mater3_morfologia_script.php',
    type: 'POST',
    data: {idMater3:idMater3, mater3_catgen:mater3_catgen,mater3_catspec:mater3_catspec, mater3_mrf_descr3:mater3_mrf_descr3, mater3_mrf_modcostr3:mater3_mrf_modcostr3, mater3_mrf_matcost3:mater3_mrf_matcost3, mater3_mrf_note3:mater3_mrf_note3},
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(2500)
      .fadeOut(function(){ $(this).dialog("close"); window.location = window.location; })
      ;
    }//success
   });//ajax
 });

//---------------descrizione funzioni---------------------/
  $("#mater3_funzioni_salva").click(function () {
    var idMater3=$("#idMater3").val();
    var mater3_uso_descrfunz=$("#mater3_uso_descrfunz").val();
    var mater3_uso_note=$("#mater3_uso_note").val();

    //alert('idMater3: '+idMater3+'\nmater3_catgen:'+mater3_catgen+'\nmater3_catspec:'+mater3_catspec+' \nmater3_mrf_descr3:'+mater3_mrf_descr3+'\nmater3_mrf_modcostr3:'+mater3_mrf_modcostr3+'\nmater3_mrf_matcost3:'+mater3_mrf_matcost3+'\nmater3_mrf_note3:'+mater3_mrf_note3); return false;
   $.ajax({
    url: 'inc/update_mater3_funzioni_script.php',
    type: 'POST',
    data: {idMater3:idMater3, mater3_uso_descrfunz:mater3_uso_descrfunz, mater3_uso_note:mater3_uso_note },
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(2500)
      .fadeOut(function(){ $(this).dialog("close"); window.location = window.location; })
      ;
    }//success
   });//ajax
 });

//---------------dati tecnici---------------------/
  $("#mater3_datitecnici_salva").click(function () {
    var idMater3=$("#idMater3").val();
    var mater3_dtc_dim=$("#mater3_dtc_dim").val();
    var mater3_dtc_quote=$("#mater3_dtc_quote").val();
    var mater3_dtc_note=$("#mater3_dtc_note").val();

    //alert('idMater3: '+idMater3+'\nmater3_catgen:'+mater3_catgen+'\nmater3_catspec:'+mater3_catspec+' \nmater3_mrf_descr3:'+mater3_mrf_descr3+'\nmater3_mrf_modcostr3:'+mater3_mrf_modcostr3+'\nmater3_mrf_matcost3:'+mater3_mrf_matcost3+'\nmater3_mrf_note3:'+mater3_mrf_note3); return false;
   $.ajax({
    url: 'inc/update_mater3_datitecnici_script.php',
    type: 'POST',
    data: {idMater3:idMater3, mater3_dtc_dim:mater3_dtc_dim, mater3_dtc_quote:mater3_dtc_quote, mater3_dtc_note:mater3_dtc_note },
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(2500)
      .fadeOut(function(){ $(this).dialog("close"); window.location = window.location; })
      ;
    }//success
   });//ajax
 });

 //---------------costruzioni---------------------/
  $("#mater3_costruzioni_salva").click(function () {
    var idMater3=$("#idMater3").val();
    var mater3_cst_commnome=$("#mater3_cst_commnome").val();
    var mater3_cst_esecnome=$("#mater3_cst_esecnome").val();
    var mater3_cst_commfnt=$("#mater3_cst_commfnt").val();
    var mater3_cst_commdat=$("#mater3_cst_commdat").val();
    var mater3_cst_note=$("#mater3_cst_note").val();

    //alert('idMater3: '+idMater3+'\nmater3_catgen:'+mater3_catgen+'\nmater3_catspec:'+mater3_catspec+' \nmater3_mrf_descr3:'+mater3_mrf_descr3+'\nmater3_mrf_modcostr3:'+mater3_mrf_modcostr3+'\nmater3_mrf_matcost3:'+mater3_mrf_matcost3+'\nmater3_mrf_note3:'+mater3_mrf_note3); return false;
   $.ajax({
    url: 'inc/update_mater3_costruzioni_script.php',
    type: 'POST',
    data: {idMater3:idMater3, mater3_cst_commnome:mater3_cst_commnome, mater3_cst_esecnome:mater3_cst_esecnome, mater3_cst_commfnt:mater3_cst_commfnt,mater3_cst_commdat:mater3_cst_commdat, mater3_cst_note:mater3_cst_note },
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(2500)
      .fadeOut(function(){ $(this).dialog("close"); window.location = window.location; })
      ;
    }//success
   });//ajax
 });

 //---------------restauri---------------------/
  $("#mater3_restauri_salva").click(function () {
    var idMater3=$("#idMater3").val();
    var mater3_rst_tpint=$("#mater3_rst_tpint").val();
    var mater3_rst_rifar=$("#mater3_rst_rifar").val();
    var mater3_rst_note=$("#mater3_rst_note").val();

    //alert('idMater3: '+idMater3+'\nmater3_catgen:'+mater3_catgen+'\nmater3_catspec:'+mater3_catspec+' \nmater3_mrf_descr3:'+mater3_mrf_descr3+'\nmater3_mrf_modcostr3:'+mater3_mrf_modcostr3+'\nmater3_mrf_matcost3:'+mater3_mrf_matcost3+'\nmater3_mrf_note3:'+mater3_mrf_note3); return false;
   $.ajax({
    url: 'inc/update_mater3_restauri_script.php',
    type: 'POST',
    data: {idMater3:idMater3, mater3_rst_tpint:mater3_rst_tpint, mater3_rst_rifar:mater3_rst_rifar, mater3_rst_note:mater3_rst_note },
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(2500)
      .fadeOut(function(){ $(this).dialog("close"); window.location = window.location; })
      ;
    }//success
   });//ajax
 });

 //---------------contesto ambientale---------------------/
  $("#mater3_contesto_salva").click(function () {
    var idMater3=$("#idMater3").val();
    var mater3_cta_vcoltatt=$("#mater3_cta_vcoltatt").val();
    var mater3_cta_vcoltpass=$("#mater3_cta_vcoltpass").val();
    var mater3_cta_veg=$("#mater3_cta_veg").val();
    var mater3_cta_note=$("#mater3_cta_note").val();

    var mater3_cta_fscalt3='';
    $("input[name=fscalt]:checked").each(function () {
     var fscalt = $(this).val();
     mater3_cta_fscalt3+=fscalt+', ';
    });

    //alert('idMater3: '+idMater3+'\nmater3_catgen:'+mater3_catgen+'\nmater3_catspec:'+mater3_catspec+' \nmater3_mrf_descr3:'+mater3_mrf_descr3+'\nmater3_mrf_modcostr3:'+mater3_mrf_modcostr3+'\nmater3_mrf_matcost3:'+mater3_mrf_matcost3+'\nmater3_mrf_note3:'+mater3_mrf_note3); return false;
   $.ajax({
    url: 'inc/update_mater3_contesto_script.php',
    type: 'POST',
    data: {idMater3:idMater3, mater3_cta_vcoltatt:mater3_cta_vcoltatt, mater3_cta_vcoltpass:mater3_cta_vcoltpass, mater3_cta_fscalt3:mater3_cta_fscalt3, mater3_cta_veg:mater3_cta_veg, mater3_cta_note:mater3_cta_note },
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(2500)
      .fadeOut(function(){ $(this).dialog("close"); window.location = window.location; })
      ;
    }//success
   });//ajax
 });

 //---------------infrastrutture---------------------/
  $("#mater3_infrastrutture_salva").click(function () {
    var idMater3=$("#idMater3").val();
    //var mater3_rpp_lega=$("#mater3_rpp_lega").val();
    //var mater3_rpp_taglia=$("#mater3_rpp_taglia").val();
    //var mater3_rpp_tagliato=$("#mater3_rpp_tagliato").val();
    //var mater3_rpp_conduce=$("#mater3_rpp_conduce").val();
    //var mater3_rpp_servita=$("#mater3_rpp_servita").val();
    
    var newInfr = '';
    var add='';
    var rapp='';
    var datiInfr='';
    var infrastrutture = '';
    $(".newDiv").each(function(){
      $(this).each(function(){
        add = $(this).attr('add');
        rapp = $(this).attr('rapporto');
        datiInfr+= add + ','+rapp+'|';
        infrastrutture= datiInfr;
      });
    });
    
    var mater3_rpp_note=$("#mater3_rpp_note").val();
    //alert('id: '+id+'\ninfrastrutture'+infrastrutture+'\nnote:'+mater3_rpp_note); return false;
   $.ajax({
    url: 'inc/update_mater3_infrastrutture_script.php',
    type: 'POST',
    data: {id:id, idMater3:idMater3, infrastrutture:infrastrutture, mater3_rpp_note:mater3_rpp_note },
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(2500)
      .fadeOut(function(){ $(this).dialog("close"); window.location = window.location; })
      ;
    }//success
   });//ajax

 });

 //---------------collegamenti---------------------/
  $("#mater3_collegamenti_salva").click(function () {
    var idMater3=$("#idMater3").val();
    var mater3_cll_infcompl3=$("#mater3_cll_infcompl3").val();
    var mater3_cll_note=$("#mater3_cll_note").val();
    var mater3_cll_lgattr3='';
     $("input[name=attr]:checked").each(function () {
      var attr = $(this).val();
      mater3_cll_lgattr3+=attr+', ';
    });
    var mater3_cll_lgecon3='';
     $("input[name=lgecon]:checked").each(function () {
      var lgecon = $(this).val();
      mater3_cll_lgecon3+=lgecon+', ';
    });
    var mater3_cll_infcompl3='';
     $("input[name=infcom]:checked").each(function () {
      var infcom = $(this).val();
      mater3_cll_infcompl3+=infcom+', ';
    });
    
    //alert('idMater3: '+idMater3+'\nmater3_catgen:'+mater3_catgen+'\nmater3_catspec:'+mater3_catspec+' \nmater3_mrf_descr3:'+mater3_mrf_descr3+'\nmater3_mrf_modcostr3:'+mater3_mrf_modcostr3+'\nmater3_mrf_matcost3:'+mater3_mrf_matcost3+'\nmater3_mrf_note3:'+mater3_mrf_note3); return false;
   $.ajax({
    url: 'inc/update_mater3_collegamenti_script.php',
    type: 'POST',
    data: {idMater3:idMater3, mater3_cll_lgattr3:mater3_cll_lgattr3, mater3_cll_lgecon3:mater3_cll_lgecon3, mater3_cll_infcompl3:mater3_cll_infcompl3, mater3_cll_note:mater3_cll_note },
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(2500)
      .fadeOut(function(){ $(this).dialog("close"); window.location = window.location; })
      ;
    }//success
   });//ajax
 });

 //---------------iscrizioni---------------------/
  $("#mater3_iscrizioni_salva").click(function () {
    var idMater3=$("#idMater3").val();
    var mater3_isc_descont=$("#mater3_isc_descont").val();
    var mater3_isc_trascr=$("#mater3_isc_trascr").val();
    var mater3_isc_note=$("#mater3_isc_note").val();

    //alert('idMater3: '+idMater3+'\nmater3_catgen:'+mater3_catgen+'\nmater3_catspec:'+mater3_catspec+' \nmater3_mrf_descr3:'+mater3_mrf_descr3+'\nmater3_mrf_modcostr3:'+mater3_mrf_modcostr3+'\nmater3_mrf_matcost3:'+mater3_mrf_matcost3+'\nmater3_mrf_note3:'+mater3_mrf_note3); return false;
   $.ajax({
    url: 'inc/update_mater3_iscrizioni_script.php',
    type: 'POST',
    data: {idMater3:idMater3, mater3_isc_descont:mater3_isc_descont, mater3_isc_trascr:mater3_isc_trascr, mater3_isc_note:mater3_isc_note },
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(2500)
      .fadeOut(function(){ $(this).dialog("close"); window.location = window.location; })
      ;
    }//success
   });//ajax
 });

  //---------------catasto---------------------/
  $("#mater3_catasto_salva").click(function () {
    var idMater3=$("#idMater3").val();
    var mater3_cat_stornap=$("#mater3_cat_stornap").val();
    var mater3_cat_storasb=$("#mater3_cat_storasb").val();

    //alert('idMater3: '+idMater3+'\nmater3_catgen:'+mater3_catgen+'\nmater3_catspec:'+mater3_catspec+' \nmater3_mrf_descr3:'+mater3_mrf_descr3+'\nmater3_mrf_modcostr3:'+mater3_mrf_modcostr3+'\nmater3_mrf_matcost3:'+mater3_mrf_matcost3+'\nmater3_mrf_note3:'+mater3_mrf_note3); return false;
   $.ajax({
    url: 'inc/update_mater3_catasto_script.php',
    type: 'POST',
    data: {idMater3:idMater3, mater3_cat_stornap:mater3_cat_stornap, mater3_cat_storasb:mater3_cat_storasb},
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(2500)
      .fadeOut(function(){ $(this).dialog("close"); window.location = window.location; })
      ;
    }//success
   });//ajax
 });



///////////////////////////////////////////////
//////////////// ORALE 01 /////////////////////
////////////// CHALDA HERE ////////////////////
  $("#oral1_descr_salva").click(function () {
    var data = {
       idOral1              : $("#idOral1").val(),
       oral1_dsc_tipoarch   : $("#oral1_dsc_tipoarch").val(),
       oral1_dsc_numint     : $("#oral1_dsc_numint").val(),
       oral1_dsc_numinf     : $("#oral1_dsc_numinf").val(),
       oral1_dsc_cararch    : $("#oral1_dsc_cararch").val(),
       oral1_dsc_sched      : $("#oral1_dsc_sched").val(),
       oral1_dsc_trascr     : $("#oral1_dsc_trascr").val(),
       oral1_dsc_indic      : $("#oral1_dsc_indic").val(),
       oral1_dsc_matint     : $("#oral1_dsc_matint").val(),
       oral1_dsc_oss        : $("#oral1_dsc_oss").val(),
    }
   $.ajax({
    url: 'inc/update_oral1_descriz_script.php',
    type: 'POST',
    data: data,
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(5000)
      .fadeOut(function(){ $(this).dialog("close"); window.location = window.location; })
      ;
    }//success
   });//ajax
 });


//----------------criteri di ordinamento -----------------------//
  $("#oral1_criteri_salva").click(function () {
       var data = {
              idOral1              : $("#idOral1").val(),
              oral1_dsc_critord    : $("#oral1_dsc_critord").val()
       };
   $.ajax({
    url: 'inc/update_oral1_criteri_script.php',
    type: 'POST',
    data: data,
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(5000)
      .fadeOut(function(){ $(this).dialog("close"); window.location = window.location; })
      ;
    }//success
   });//ajax
 });
 //----------------note storiche -----------------------//
  $("#oral1_notsto_salva").click(function () {
       var data = {
              idOral1              : $("#idOral1").val(),
              oral1_nsc_vicarch    : $("#oral1_nsc_vicarch").val(),
              oral1_nsc_oss        : $("#oral1_nsc_oss").val()
       };

   $.ajax({
    url: 'inc/update_oral1_notsto_script.php',
    type: 'POST',
    data: data,
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(5000)
      .fadeOut(function(){ $(this).dialog("close"); window.location = window.location; })
      ;
    }//success
   });//ajax
 });

///////////////////////////////////////////////
//////////////// ORALE 02 /////////////////////
////////////// CHALDA HERE ////////////////////
  $("#oral2_salva").click(function () {
    var data = { idOral2              : $("#idOral2").val()
              , oral2_dsc_segnatura2 : $('#oral2_dsc_segnatura2').val()
              , oral2_dsc_denom      : $('#oral2_dsc_denom'     ).val()
              , oral2_dsc_conten     : $('#oral2_dsc_conten'    ).val()
              , oral2_dsc_categ      : $('#oral2_dsc_categ'     ).val()
              , oral2_dsc_occas      : $('#oral2_dsc_occas'     ).val()
              , oral2_dsc_durata     : $('#oral2_dsc_durata'    ).val()
              , oral2_dan_elstrutt2  : $('#oral2_dan_elstrutt2' ).val()
              , oral2_dan_incverb2   : $('#oral2_dan_incverb2'  ).val()
              , oral2_dan_trascr2    : $('#oral2_dan_trascr2'   ).val()
              , oral2_dan_motiv2     : $('#oral2_dan_motiv2'    ).val()
              , oral2_com_nvoci      : $('#oral2_com_nvoci'     ).val()
              , oral2_com_modesec    : $('#oral2_com_modesec'   ).val()
              , oral2_att_datipers   : $('#oral2_att_datipers'  ).val()
              , oral2_att_ruolo      : $('#oral2_att_ruolo'     ).val()
              , oral2_att_mestiere   : $('#oral2_att_mestiere'  ).val()
              , oral2_att_nascita    : $('#oral2_att_nascita'   ).val()
              , oral2_att_note       : $('#oral2_att_note'      ).val()
              , oral2_att_collden    : $('#oral2_att_collden'   ).val()
              , oral2_att_collnote   : $('#oral2_att_collnote'  ).val()
              , oral2_loc_luogo      : $('#oral2_loc_luogo'     ).val()
              , oral2_loc_contst     : $('#oral2_loc_contst'    ).val()
              , oral2_sup_tipreg     : $('#oral2_sup_tipreg'    ).val()
              , oral2_sup_formato    : $('#oral2_sup_formato'   ).val()
              , oral2_sup_freqvel    : $('#oral2_sup_freqvel'   ).val()
              , oral2_sup_attec      : $('#oral2_sup_attec'     ).val()
              , oral2_sup_oss        : $('#oral2_sup_oss'       ).val()
              , oral2_riv_tpriv      : $('#oral2_riv_tpriv'     ).val()
              , oral2_riv_formato    : $('#oral2_riv_formato'   ).val()
              , oral2_riv_descform   : $('#oral2_riv_descform'  ).val()
    };

   $.ajax({
    url: 'inc/update_oral2_script.php',
    type: 'POST',
    data: data,
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(5000)
      .fadeOut(function(){ $(this).dialog("close"); window.location = window.location; })
      ;
    }//success
   });//ajax
 });



///////////////////////////////////////////////
//////////////// ORALE 03 /////////////////////
////////////// CHALDA HERE ////////////////////
  $("#oral3_salva").click(function () {
    var data = { idOral3              : $("#idOral3").val()
       , dsc_conten3    : $('#oral3_dsc_conten3').val()
       , dsc_catgen3    : $('#oral3_dsc_catgen3').val()
       , dan_elstrutt3  : $('#oral3_dan_elstrutt3').val()
       , dan_incverb3   : $('#oral3_dan_incverb3').val()
       , dan_trascr3    : $('#oral3_dan_trascr3').val()
       , dan_motiv3     : $('#oral3_dan_motiv3').val()
    };

   $.ajax({
    url: 'inc/update_oral3_script.php',
    type: 'POST',
    data: data,
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(5000)
      .fadeOut(function(){ $(this).dialog("close"); window.location = window.location; })
      ;
    }//success
   });//ajax
 });

/////////////////////////////////////////////////
//////////////   ABO HERE   ////////////////////
/////////////    FOTO 01    ///////////////////

//----------------descrizione raccolta -----------------------//

  $("#foto1_descr_salva").click(function () {
    var idFoto1=$("#idFoto1").val();
    var foto1_crc_tipo=$("#foto1_crc_tipo").val();
    var foto1_crc_con=$("#foto1_crc_con").val();
    var foto1_crc_car=$("#foto1_crc_car").val();
    var foto1_crc_elemint=$("#foto1_crc_elemint").val();
    var foto1_crc_note=$("#foto1_crc_note").val();
   $.ajax({
    url: 'inc/update_foto1_descriz_script.php',
    type: 'POST',
    data: {idFoto1:idFoto1, foto1_crc_tipo:foto1_crc_tipo, foto1_crc_con:foto1_crc_con, foto1_crc_car:foto1_crc_car, foto1_crc_elemint:foto1_crc_elemint, foto1_crc_note:foto1_crc_note},
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(2500)
      .fadeOut(function(){ $(this).dialog("close"); window.location = window.location; })
      ;
    }//success
   });//ajax
 });

//----------------criteri di ordinamento -----------------------//
  $("#foto1_criteri_salva").click(function () {
    var idFoto1=$("#idFoto1").val();
    var foto1_dsc_critord=$("#foto1_dsc_critord").val();

   $.ajax({
    url: 'inc/update_foto1_criteri_script.php',
    type: 'POST',
    data: {idFoto1:idFoto1, foto1_dsc_critord:foto1_dsc_critord},
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(2500)
      .fadeOut(function(){ $(this).dialog("close"); window.location = window.location; })
      ;
    }//success
   });//ajax
 });
 //----------------note storiche -----------------------//
  $("#foto1_notsto_salva").click(function () {
    var idFoto1=$("#idFoto1").val();
    var foto1_dsc_notsto=$("#foto1_dsc_notsto").val();
    var foto1_dsc_notstooss=$("#foto1_dsc_notstooss").val();
    //alert('idFoto1: '+idFoto1+'\nfoto1_dsc_notesto: '+foto1_dsc_notesto+'\nfoto1_dsc_notstooss: '+foto1_dsc_notstooss); return false;
   $.ajax({
    url: 'inc/update_foto1_notsto_script.php',
    type: 'POST',
    data: {idFoto1:idFoto1, foto1_dsc_notsto:foto1_dsc_notsto, foto1_dsc_notstooss:foto1_dsc_notstooss},
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(2500)
      .fadeOut(function(){ $(this).dialog("close"); window.location = window.location; })
      ;
    }//success
   });//ajax
 });
  

/////////////////////////////////////////////////
//////////////   CARTOGRAFIA ////////////////////

//--------------collocazione--------------------//
$("#cartoCollocazSalva").click(function(){
 var collocazione = $("#cartoCollocazione").val();
 $.ajax({
  url: 'inc/update_carto_collocazione.php',
  type: 'POST',
  data: {idScheda:id, collocazione:collocazione},
  success: function(data){
   $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
    .delay(2500)
    .fadeOut(function(){ $(this).dialog("close"); window.location = window.location; })
   ;
  }//success
 });//ajax
});

//--------------descrizione--------------------//
$("#cartoDescrizSalva").click(function(){
 var titolo = $("#cartoTitolo").val();
 var istituto = $("#cartoIstituto").val();
 var soggetto = $("#cartoSoggetto").val();
 var autore = $("#cartoAutore").val();
 var elementi = $("#cartoElemInt").val();
 var note = $("#cartoNote").val();
 $.ajax({
  url: 'inc/update_carto_descrizione.php',
  type: 'POST',
  data: {idScheda:id, titolo:titolo, istituto:istituto, soggetto:soggetto, autore:autore, elementi:elementi, note:note},
  success: function(data){
   $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
    .delay(2500)
    .fadeOut(function(){ $(this).dialog("close"); window.location = window.location; })
   ;
  }//success
 });//ajax
});

//--------------dati tenici--------------------//
$("#cartoDatiSalva").click(function(){
 var supporto = $("#cartoSupporto").val();
 var colore = $("#cartoColore").val();
 if(!colore){colore = 'NULL';}
 var misura = $("#cartoMisura").val();
 var scala = $("#cartoScala").val();
 //console.log(id+' '+supporto+' '+colore+' '+misura+' '+scala);
 $.ajax({
  url: 'inc/update_carto_dati.php',
  type: 'POST',
  data: {idScheda:id, supporto:supporto, colore:colore, misura:misura, scala:scala},
  success: function(data){
   $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
    .delay(2500)
    .fadeOut(function(){ $(this).dialog("close"); window.location = window.location; })
   ;
  }//success
 });//ajax
});


/////////////////////////////////////////////////
//////////////   ABO HERE   ////////////////////
/////////////    FOTO 02    ///////////////////

//----------------segnatura -----------------------//
  $("#foto2_segn_salva").click(function () {
    var idFoto2=$("#idFoto2").val();
    var foto2_fot_collocazione=$("#foto2_fot_collocazione").val();
    
   $.ajax({
    url: 'inc/update_foto2_segn_script.php',
    type: 'POST',
    data: {idFoto2:idFoto2, foto2_fot_collocazione:foto2_fot_collocazione},
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(2500)
      .fadeOut(function(){ $(this).dialog("close"); window.location = window.location; })
      ;
    }//success
   });//ajax
 });

//----------------descrizione -----------------------//
  $("#foto2_descr_salva").click(function () {
    var idFoto2=$("#idFoto2").val();
    var foto2_sog_titolo=$("#foto2_sog_titolo").val();
    var foto2_sog_autore=$("#foto2_sog_autore").val();
    var foto2_sog_sogg=$("#foto2_sog_sogg").val();
    var foto2_sog_noteaut=$("#foto2_sog_noteaut").val();
    var foto2_sog_note=$("#foto2_sog_note").val();
    
   $.ajax({
    url: 'inc/update_foto2_descr_script.php',
    type: 'POST',
    data: {idFoto2:idFoto2, foto2_sog_titolo:foto2_sog_titolo, foto2_sog_autore:foto2_sog_autore, foto2_sog_sogg:foto2_sog_sogg, foto2_sog_noteaut:foto2_sog_noteaut, foto2_sog_note:foto2_sog_note},
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(2500)
      .fadeOut(function(){ $(this).dialog("close"); window.location = window.location; })
      ;
    }//success
   });//ajax
 });

//----------------notizie storiche -----------------------//
  $("#foto2_notsto_salva").click(function () {
    var idFoto2=$("#idFoto2").val();
    var foto2_sog_notestor=$("#foto2_sog_notestor").val();
    var foto2_sog_notstooss=$("#foto2_sog_notstooss").val();
    //alert('idFoto2: '+idFoto2+'\nfoto2_sog_notestor:'+foto2_sog_notestor+'\nfoto2_sog_notstooss:'+foto2_sog_notstooss); return false;
   $.ajax({
    url: 'inc/update_foto2_notsto_script.php',
    type: 'POST',
    data: {idFoto2:idFoto2, foto2_sog_notestor:foto2_sog_notestor, foto2_sog_notstooss:foto2_sog_notstooss},
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(2500)
      .fadeOut(function(){ $(this).dialog("close"); window.location = window.location; })
      ;
    }//success
   });//ajax
 });

//----------------dati tecnici -----------------------//
  $("#foto2_datitec_salva").click(function () {
    var idFoto2=$("#idFoto2").val();
    var foto2_dtc_mattec=$("#foto2_dtc_mattec").val();
    var foto2_dtc_icol=$("#foto2_dtc_icol").val();
    var foto2_dtc_misst=$("#foto2_dtc_misst").val();
    var foto2_dtc_ffile=$("#foto2_dtc_ffile").val();
    var foto2_dtc_misfd=$("#foto2_dtc_misfd").val();
    var foto2_dtc_note=$("#foto2_dtc_note").val();
    var foto2_dtc_presneg=$("#foto2_dtc_presneg").val();
    var foto2_dtc_tpapp=$("#foto2_dtc_tpapp").val();
    
   $.ajax({
    url: 'inc/update_foto2_datitec_script.php',
    type: 'POST',
    data: {idFoto2:idFoto2, foto2_dtc_mattec:foto2_dtc_mattec, foto2_dtc_icol:foto2_dtc_icol, foto2_dtc_misst:foto2_dtc_misst, foto2_dtc_ffile:foto2_dtc_ffile, foto2_dtc_misfd:foto2_dtc_misfd, foto2_dtc_note:foto2_dtc_note, foto2_dtc_presneg:foto2_dtc_presneg, foto2_dtc_tpapp:foto2_dtc_tpapp},
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(2500)
      .fadeOut(function(){ $(this).dialog("close"); window.location = window.location; })
      ;
    }//success
   });//ajax
 });
  
//----------------altre note -----------------------//
$("#foto2_altrenote_salva").click(function () {
 var idFoto2=$("#idFoto2").val();
 var foto2_alt_note=$("#foto2_alt_note").val();
 $.ajax({
  url: 'inc/update_foto2_altrenote_script.php',
  type: 'POST',
  data: {idFoto2:idFoto2, foto2_alt_note:foto2_alt_note},
  success: function(data){
   $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
   .delay(2500)
   .fadeOut(function(){ $(this).dialog("close"); window.location = window.location; })
   ;
  }//success
 });//ajax
});


///////////////////////////////////////////////
//////////////// STOART 01 /////////////////////
////////////// CHALDA HERE ////////////////////
  $("#stoart1_salva").click(function () {
    var data = { idStoart1              : $("#idStoart1").val()
       ,ins_desc    : $('#stoart1_ins_desc').val()
       ,ins_note    : $('#stoart1_ins_note').val()
    };

   $.ajax({
    url: 'inc/update_stoart1_script.php',
    type: 'POST',
    data: data,
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(5000)
      .fadeOut(function(){ $(this).dialog("close"); window.location = window.location; })
      ;
    }//success
   });//ajax
 });


///////////////////////////////////////////////
//////////////// STOART 02 /////////////////////
////////////// CHALDA HERE ////////////////////
  $("#stoart2_salva").click(function () {
    var data = {
         idStoart2      : $("#idStoart2").val()
       , dtc_mattec     : $('#stoart2_dtc_mattec').val()
       , dsc_indic      : $('#stoart2_dsc_indic').val()
       , dsc_soggicon   : $('#stoart2_dsc_soggicon').val()
       , dsc_colloc     : $('#stoart2_dsc_colloc').val()
       , dsc_prov       : $('#stoart2_dsc_prov').val()
       , dsc_noteprov   : $('#stoart2_dsc_noteprov').val()
       , dsc_oss        : $('#stoart2_dsc_oss').val()
       , def_aut        : $('#stoart2_def_aut').val()
       , def_nomecomm   : $('#stoart2_def_nomecomm').val()
       , def_datacomm   : $('#stoart2_def_datacomm').val()
       , def_circcomm   : $('#stoart2_def_circcomm').val()
       , def_fonticomm  : $('#stoart2_def_fonticomm').val()
       , def_motaut     : $('#stoart2_def_motaut').val()
       , def_ambcult    : $('#stoart2_def_ambcult').val()
       , def_motambcult : $('#stoart2_def_motambcult').val()
       , dtc_mis        : $('#stoart2_dtc_mis').val()
       , dtc_notemis    : $('#stoart2_dtc_notemis').val()
       , isc_descont    : $('#stoart2_isc_descont').val()
       , isc_trascr     : $('#stoart2_isc_trascr').val()
       , isc_note       : $('#stoart2_isc_note').val()
       , doc_elrest     : $('#stoart2_doc_elrest').val()
       , doc_docrest    : $('#stoart2_doc_docrest').val()
       , doc_rifschcei  : $('#stoart2_doc_rifschcei').val()
       , doc_note       : $('#stoart2_doc_note').val()

    };

   $.ajax({
    url: 'inc/update_stoart2_script.php',
    type: 'POST',
    data: data,
    success: function(data){
      $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
      .delay(5000)
      .fadeOut(function(){ $(this).dialog("close"); window.location = window.location; })
      ;
    }//success
   });//ajax
 });




});


  function removeCorrela(id){
       if (confirm("Sei sicuro di voler eliminare questa correlazione?")) {
              $.ajax({
               url: 'inc/remove_schede_correlate_script.php',
               type: 'POST',
               data: {id:id},
               success: function(data){
                 $('<div style="text-align:center;"><h2>Risultato query</h2><p>'+data+'</p></div>').dialog()
                 .delay(5000)
                 .fadeOut(function(){ $(this).dialog("close"); window.location = window.location; })
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
                 .fadeOut(function(){ $(this).dialog("close"); window.location = window.location; })
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
                 .fadeOut(function(){ $(this).dialog("close"); window.location = window.location; })
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
                 .fadeOut(function(){ $(this).dialog("close"); window.location = window.location; })
                 ;
               }//success
              });//ajax
       }
  }
