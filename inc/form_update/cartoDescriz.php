<div id="cartoDescriz_form">
 <label>TITOLO</label>
 <textarea id="cartoTitolo" class="form" style=""><?php echo stripslashes($cartoArr['titolo']); ?></textarea>
 
 <label>ISTITUTO/UFFICIO PRODUTTORE</label>
 <textarea id="cartoIstituto" class="form" style=""><?php echo stripslashes($cartoArr['istituto']); ?></textarea>
 
 <label>SOGGETTO</label>
 <textarea id="cartoSoggetto" class="form" style=""><?php echo stripslashes($cartoArr['soggetto']); ?></textarea>
 
 <label>AUTORE</label>
 <textarea id="cartoAutore" class="form" style=""><?php echo stripslashes($cartoArr['autore']); ?></textarea>
 
 <label>SPECIFICI ELEMENTI DI INTERESSE</label>
 <textarea id="cartoElemInt" class="form" style="height:100px;"><?php echo stripslashes($cartoArr['elem_interesse']); ?></textarea>
 
 <label>NOTE</label>
 <textarea id="cartoNote" class="form" style="height:150px;"><?php echo stripslashes($cartoArr['note']); ?></textarea>
 
 <div class="login2" style="margin-top:20px;" id="cartoDescrizSalva">Salva modifiche</div>
 <div class="chiudiForm login2">Annulla modifiche</div>
</div>
