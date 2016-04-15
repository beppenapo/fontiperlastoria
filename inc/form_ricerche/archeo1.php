   <div class="inner">
      <h2 class="h2aperto">DESCRIZIONE INDAGINE</h2>
      
      <table class="mainData" style="width:98% !important;">
       <tr>
        <td width="50%;">
         <div class="arrow_box archeo1descrinddata">Inserire descrizione campo</div>
         <label><i class="fa fa-info-circle" data-class="archeo1descrinddata"></i> DATA</label>
         <textarea id="archeo1_descrind_data" class="form"></textarea>
        </td>
        <td>
         <div class="arrow_box archeo1rifperm">Inserire descrizione campo</div>
         <label><i class="fa fa-info-circle" data-class="archeo1rifperm"></i> RIFERIMENTO PERMESSO</label>
         <textarea id="archeo1_rifperm" class="form"></textarea>
        </td>
       </tr>
       <tr>
        <td>
         <div class="arrow_box archeo1metodo">Inserire descrizione campo</div>
         <label><i class="fa fa-info-circle" data-class="archeo1metodo"></i> METODO</label>
         <select id="archeo1_metodo" name="archeo1_metodo" class="form">
          <option value="0">--seleziona metodo--</option>
          <?php
           $query =  ("SELECT * FROM lista_ind_met order by definizione asc; ");
           $result = pg_query($connection, $query);
           $righe = pg_num_rows($result);
           for ($i = 0; $i < $righe; $i++){
            $idMetodo = pg_result($result, $i, "id");
            $def = pg_result($result, $i, "definizione");
            echo "<option value=\"$idMetodo\">$def</option>";
           }
          ?>
         </select>
        </td>
        <td>
         <div class="arrow_box archeo1rifsito">Inserire descrizione campo</div>
         <label><i class="fa fa-info-circle" data-class="archeo1rifsito"></i> RIFERIMENTO SITO</label>
         <textarea id="archeo1_rifsito" class="form"></textarea>
        </td>
       </tr>
       <tr>
        <td>
         <div class="arrow_box archeo1descr">Inserire descrizione campo</div>
         <label><i class="fa fa-info-circle" data-class="archeo1descr"></i> DESCRIZIONE</label>
         <textarea id="archeo1_descr" class="form"></textarea>
        </td>
        <td>
         <div class="arrow_box archeo1codscavo">Inserire descrizione campo</div>
         <label><i class="fa fa-info-circle" data-class="archeo1codscavo"></i> CODICE SCAVO</label>
         <textarea id="archeo1_codscavo" class="form"></textarea>
         <br/>
         <div class="arrow_box archeo1note">Inserire descrizione campo</div>
         <label><i class="fa fa-info-circle" data-class="archeo1note"></i> NOTE</label>
         <textarea id="archeo1_note" class="form note"></textarea>
        </td>
       </tr>
      </table>
          
      <div class="toggle">
        <div class="sezioni"><h2>ALTRE INDAGINI</h2></div>
        <div class="slide">
           <table class="mainData" style="width:98% !important;">
            <tr>
             <td width="50%;">
               <div class="arrow_box archeo1tipoind">Inserire descrizione campo</div>
               <label><i class="fa fa-info-circle" data-class="archeo1tipoind"></i> TIPO INDAGINE</label>
               <select id="archeo1_tipoind" name="archeo1_tipoind" class="form">
                <option value="">--seleziona un valore dalla lista--</option>
                <?php
                 $query =  ("SELECT * FROM lista_ain_tipo order by definizione asc; ");
                 $result = pg_query($connection, $query);
                 $righe = pg_num_rows($result);
                 for ($i = 0; $i < $righe; $i++){
                  $idTipo = pg_result($result, $i, "id");
                  $def = pg_result($result, $i, "definizione");
                  echo "<option value=\"$idTipo\">$def</option>";
                 }
                ?>
               </select>
               <br/>
               <div class="arrow_box archeo1altrinddata">Inserire descrizione campo</div>
               <label><i class="fa fa-info-circle" data-class="archeo1altrinddata"></i> DATA</label>
               <textarea id="archeo1_altrind_data" class="form"></textarea>
               <br/>
               <div class="arrow_box archeo1enresp">Inserire descrizione campo</div>
               <label><i class="fa fa-info-circle" data-class="archeo1enresp"></i> ENTE RESPONSABILE</label>
               <select id="archeo1_enresp" name="archeo1_enresp" class="form">
                <option value="">--seleziona n valore dalla lista--</option>
                <?php
                 $query =  ("SELECT id, nome FROM anagrafica order by nome asc; ");
                 $result = pg_query($connection, $query);
                 $righe = pg_num_rows($result);
                 for ($i = 0; $i < $righe; $i++){
                  $idEnresp = pg_result($result, $i, "id");
                  $nome = pg_result($result, $i, "nome");
                  echo "<option value=\"$idEnresp\">$nome</option>";
                 }
                ?>
               </select>
               <br/>
               <div class="arrow_box archeo1altrinddescr">Inserire descrizione campo</div> 
               <label><i class="fa fa-info-circle" data-class="archeo1altrinddescr"></i> DESCRIZIONE</label>
               <textarea id="archeo1_altrind_descr" class="form"></textarea>
             </td>
             <td>
              <div class="arrow_box archeo1altrindnote">Inserire descrizione campo</div>
              <label><i class="fa fa-info-circle" data-class="archeo1altrindnote"></i> NOTE</label>
              <textarea id="archeo1_altrind_note" class="form"></textarea>
             </td>
           </tr>
          </table>
        </div>
      </div>
   </div>
<script type="text/javascript" >
$(document).ready(function() {
 var where;
 $('#findRecord').click(function(){
  //$('input, textarea, select').each(function(){var id=$(this).attr('id');var val = $(this).val();console.log(id+': '+val+'\n');});
  var select = 'select distinct s.id, s.dgn_numsch, s.dgn_dnogg, c.cro_iniz, c.cro_fin ';
  var from = 'from scheda s, cronologia c, ricerca compilazione, compilazione cmp, ricerca provenienza,stato, provincia, comune, localita, indirizzo, aree, aree_scheda, stato statoubi, provincia provinciaubi, comune comuneubi, indirizzo indirizzoubi, localita localitaubi, aree ubi, aree_scheda ubi_scheda, anagrafica ';
  //var where = 'where c.id_scheda = s.id	and s.cmp_id = compilazione.id and cmp.id_scheda = s.id and cmp.cmp_prv = 1 and s.prv_id = provenienza.id and provincia.stato = stato.id AND comune.provincia = provincia.id AND localita.comune = comune.id AND indirizzo.comune = comune.id AND aree.id_comune = comune.id AND aree_scheda.id_area = aree.id AND aree_scheda.id_scheda = s.id and provinciaubi.stato = statoubi.id AND comuneubi.provincia = provinciaubi.id AND indirizzoubi.comune = comuneubi.id AND localitaubi.comune = comuneubi.id AND ubi.id_comune = comuneubi.id AND ubi.id_rubrica = anagrafica.id AND ubi_scheda.id_area = ubi.id AND ubi_scheda.id_scheda = s.id and ';
  
  //tab scheda
  var tpsch = $('#tpsch').val(); where = 's.dgn_tpsch = '+tpsch+' and ';
  var livello = $('#livello').val(); where += 's.livello = '+livello+' and ';
  var dgn_numsch = $('#dgn_numsch').val(); dgn_numsch ? where += "s.dgn_numsch ilike '%"+dgn_numsch+"%' and ":"";  
  var dgn_livind = $('#dgn_livind').val(); dgn_livind ? where += dgn_livind ? 's.dgn_livind = '+dgn_livind+' and ' : 's.dgn_livind >0 and ':"";
  var dgn_dnogg = $('#dgn_dnogg').val(); dgn_dnogg ? where += "s.dgn_dnogg ilike '"+dgn_dnogg+"%' and ":"";  
  var dgn_note = $('#dgn_note').val(); dgn_note ? where += "s.dgn_note ilike '"+dgn_note+"%' and ":"";  
  var denric = $('#denric').val(); denric ? where += denric ? 's.cmp_id = '+denric+' and ' : 's.cmp_id >0 and ':"";
  var noteric = $('#noteric').val(); noteric ? where += "s.cmp_note ilike '"+noteric+"%' and ":"";
  var denricprov = $('#denricprov').val(); denricprov ? where += denricprov ? 's.prv_id = '+denricprov+' and ' : 's.prv_id >0 and ':"";
  var noteprov = $('#noteprov').val(); noteprov ? where += "s.prv_note ilike '"+noteprov+"%' and ":"";
  var scn_id = $('#scn_id').val(); scn_id ? where += scn_id ? 's.scn_id = '+scn_id+' and ' : 's.scn_id >0 and ':"";
  var scn_note = $('#scn_note').val(); scn_note ? where += "s.scn_note ilike '"+scn_note+"%' and ":"";
  var note_gen = $('#note_gen').val(); note_gen ? where += "s.note ilike '"+note_gen+"%' and ":"";
  var compilatore = $('#compilatore').val(); compilatore ? where += compilatore ? 's.compilatore = '+compilatore+' and ' : 's.compilatore > 0 and ':""; 

  //tab cronologia
  var cro_iniz = $('#cro_iniz').val();
  var cro_fin = $('#cro_fin').val();
  if(cro_iniz){
   if(!cro_fin){
    where+="c.cro_iniz >= "+cro_iniz+" and ";
   }else{
    where+="((c.cro_iniz >= "+cro_iniz+" AND c.cro_fin <= "+cro_fin+") OR (c.cro_fin >= "+cro_iniz+" AND c.cro_fin <= "+cro_fin+") OR (c.cro_iniz <= "+cro_iniz+" AND c.cro_fin >= "+cro_fin+")) and ";
   }
  }else{
   where+="";
  }
  var cro_spec = $('#cro_spec').val(); cro_spec ? where += "c.cro_spec ilike '"+cro_spec+"%' and ":""; 
  var cro_motiv = $('#cro_motiv').val(); cro_motiv ? where += cro_motiv ? 'c.cro_motiv = '+cro_motiv+' and ' : 'c.cro_motiv >0 and ':"";
  var cro_note = $('#cro_note').val(); cro_note ? where += "c.cro_note ilike '"+cro_note+"%' and ":"";
 
  //tab ricerca as compilazione
  var enresp = $('#enresp').val(); enresp ? where += "compilazione.enresp ilike '%"+enresp+"%' and ":"";
  var respric = $('#respric').val(); respric ? where += "compilazione.respric ilike '%"+respric+"%' and ":"";
  var dataric = $('#dataric').val(); dataric ? where += "compilazione.data ilike '%"+dataric+"%' and ":"";

  //tab ricerca as provenienza
  var enrespprov = $('#enrespprov').val(); enrespprov ? where += "provenienza.enresp ilike '%"+enresp+"%' and ":"";
  var redattore = $('#redattore').val(); redattore ? where += "provenienza.redattore ilike '%"+redattore+"%' and ":"";
  var respricprov = $('#respricprov').val(); respricprov ? where += "provenienza.respric ilike '%"+respricprov+"%' and ":"";
  var dataprov = $('#dataprov').val(); dataprov ? where += "provenienza.data ilike '%"+dataprov+"%' and ":"";

  //aree interesse
  var statoai = $('#stato_update').val(); statoai ? where += 'comune.stato = '+statoai+' and ' :"";
  var provinciaai = $('#provincia_update').val(); provinciaai ? where += 'comune.provincia='+provinciaai+' and ': "";
  var comuneai = $('#comune_update').val(); comuneai ? where +=  'aree.id_comune = '+comuneai+' and ' : "";
  var localitaai = $('#localita_update').val(); if(localitaai && localitaai !=6){where +=  'aree.id_localita = '+localitaai+' and ';}else{where+="";} 
  //localitaai!= 6 ? where +=  'aree.id_localita = '+localitaai+' and ' : "";
  var indirizzoai = $('#indirizzo_update').val(); if(indirizzoai && indirizzoai!=42){where += 'aree.id_indirizzo = '+indirizzoai+' and ';}else{where+="";} 
  //indirizzoai != 42 ? where += 'aree.id_indirizzo = '+indirizzoai+' and ': "";
  var motivai = $('#motiv_update').val(); motivai ? where += 'aree_scheda.id_motivazione='+motivai+' and ': "";

  //ubicazione
  var statoubi = $('#statoubi_update').val();statoubi ? where += 'comubi.stato = '+statoubi+' and ' :"";
  var provinciaubi = $('#provinciaubi_update').val();provinciaubi ? where += 'comubi.provincia='+provinciaubi+' and ': "";
  var comuneubi = $('#comuneubi_update').val(); comuneubi ? where +=  'ubi.id_comune = '+comuneubi+' and ' : "";
  var localitaubi = $('#localitaubi_update').val(); if(localitaubi && localitaubi !=6){where +=  'ubi.id_localita = '+localitaubi+' and ';}else{where+="";}
  var indirizzoubi = $('#indirizzoubi_update').val(); if(indirizzoubi && indirizzoubi!=42){where += 'ubi.id_indirizzo = '+indirizzoubi+' and ';}else{where+="";}   
  var motivubi = $('#motivubi_update').val(); motivubi ? where += 'ubi_scheda.id_motivazione='+motivubi+' and ': "";  
  var ubi_tel = $('#ubi_tel').val(); ubi_tel ? where += "anagrafica.tel ilike '%"+ubi_tel+"%' and " : '';
  var ubi_mail = $('#ubi_mail').val(); ubi_mail ? where += "anagrafica.mail ilike '%"+ubi_mail+"%' and " : '';
  var ubi_web = $('#ubi_web').val(); ubi_web ? where += "anagrafica.web ilike '%"+ubi_web+"%' and " : '';
  var ubi_note = $('#ubi_note').val(); ubi_note ? where += "anagrafica.note ilike '%"+ubi_note+"%' and " : '';

  //anagrafica
  var ana_id = $('#ana_id').val(); ana_id ? where += 'anagrafica.id='+ana_id+' and ': "";
  var ana_note = $('#ana_note').val(); ana_note ? where += "anagrafica.note ilike '%"+ana_note+"%' and " : '';
  
  //consutabilita
  var consultabilita = $('#consultabilita').val(); consultabilita ? where += "consultabilita.consultabilita ilike '%"+consultabilita+"%' and " : "";
  var orario = $('#orario').val(); orario ? where += "consultabilita.orario ilike '%"+orario+"%' and " : "";
  var servizi = $('#servizi').val(); servizi ? where += "consultabilita.servizi ilike '%"+servizi+"%' and " : "";

  //altre indagini
  var archeo1_tipoind = $('#archeo1_tipoind').val(); archeo1_tipoind ? where += 'archeo.ain_tipo='+archeo1_tipoind+' and ':'';
  var archeo1_altrind_data = $('#archeo1_altrind_data').val(); archeo1_altrind_data ? where += "archeo.ain_data ilike '%"+archeo1_altrind_data+"%' and ":'';
  var archeo1_enresp = $('#archeo1_enresp').val(); archeo1_enresp ? where += 'archeo.ain_enresp='+archeo1_enresp+' and ':'';
  var archeo1_altrind_descr = $('#archeo1_altrind_descr').val(); archeo1_altrind_descr ? where += "archeo.ain_descr ilike '%"+archeo1_altrind_descr+"%' and ":'';
  var archeo1_altrind_note = $('#archeo1_altrind_note').val();  archeo1_altrind_note ? where += "archeo.ain_note ilike '%"+archeo1_altrind_note+"%' and ":'';
  
  where = where.slice(0,-5);
  var q = select+' '+from+' '+where;
  console.log(where);
  //return false;
  
  $.ajax({
     type: "POST",
     url: "inc/cercaScheda.php",
     data: {q:where},
     cache: false,
     success: function(html){$("#contentConfirm").html(html);$('#confirm').fadeIn('slow');}
     , error: function(xhr, textStatus, errorThrown) {$('#confirm').html(xhr +" "+ textStatus+" "+errorThrown);}
    });//ajax1

 });
});
</script>
