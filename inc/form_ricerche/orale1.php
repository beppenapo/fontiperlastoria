<div class="inner">
 <h2 class="h2aperto">DESCRIZIONE ARCHIVIO</h2>
 <table class="mainData" style="width:98% !important;">
  <tr>
   <td width="50%;">
    <div class="arrow_box orale1tipo">Inserire descrizione campo</div>
    <label><i class="fa fa-info-circle" data-class="orale1tipo"></i> TIPOLOGIA ARCHIVIO</label>
    <select id="tipoarch" name="tipoarch" class="form">
     <option value="">--tutte le tipologie--</option>
          <?php
            $query =  ("SELECT * from lista_archivi_alt_tipo order by definizione asc");
            $result = pg_query($connection, $query);
            $righe = pg_num_rows($result);
            for ($i = 0; $i < $righe; $i++){
             $idTipoArch = pg_result($result, $i, "id");
             $defTipoArch = pg_result($result, $i, "definizione");
             echo "<option value='$defTipoArch'>$defTipoArch</option>";
            }
           ?>
    </select>
    <br/>
    <div class="arrow_box orale1consist">Inserire descrizione campo</div>
    <label><i class="fa fa-info-circle" data-class="orale1consist"></i> CONSISTENZA</label>
    <textarea id="" class="form"></textarea>
    <br/>
    <div class="arrow_box orale1numinf">Inserire descrizione campo</div>
    <label><i class="fa fa-info-circle" data-class="orale1numinf"></i> NUMERO INFORMATORI</label>
    <textarea id="" class="form"></textarea>
    <br/>
    <div class="arrow_box orale1cararch">Inserire descrizione campo</div>
    <label><i class="fa fa-info-circle" data-class="orale1cararch"></i> CARATTERISTICHE ARCHIVIO</label>
    <textarea id="" class="form"></textarea>
    <br/>
    <div class="arrow_box orale1schedatura">Inserire descrizione campo</div>
    <label><i class="fa fa-info-circle" data-class="orale1schedatura"></i> SCHEDATURA</label>
    <textarea id="" class="form"></textarea>
    <br/>
    <div class="arrow_box orale1trascriz">Inserire descrizione campo</div>
    <label><i class="fa fa-info-circle" data-class="orale1trascriz"></i> TRASCRIZIONE</label>
    <textarea id="" class="form"></textarea>
    <br/>
    <div class="arrow_box orale1indic">Inserire descrizione campo</div>
    <label><i class="fa fa-info-circle" data-class="orale1indic"></i> INDICIZZAZIONE</label>
    <textarea id="" class="form"></textarea>
   </td>
   <td>
    <div class="arrow_box orale1elem">Inserire descrizione campo</div>
    <label><i class="fa fa-info-circle" data-class="orale1elem"></i> SPECIFICI ELEMENTI DI INTERESSE</label>
    <textarea id="" class="form"></textarea>
    <br/>
    <div class="arrow_box orale1note">Inserire descrizione campo</div>
    <label><i class="fa fa-info-circle" data-class="orale1note"></i> NOTE</label>
    <textarea id="" class="form"></textarea>
   </td>
  </tr>
 </table>
 <div class="toggle">
  <div class="sezioni"><h2>CRITERI DI ORDINAMENTO</h2></div>
  <div class="slide">
   <table class="mainData" style="width:98% !important;">
    <tr>
     <td>
      <div class="arrow_box orale1critord">Inserire descrizione campo</div>
      <label><i class="fa fa-info-circle" data-class="orale1critord"></i> CRITERI DI ORDINAMENTO</label>
      <textarea id="" class="form"></textarea>
     </td>
    </tr>
   </table>
  </div>
 </div>
 <div class="toggle">
  <div class="sezioni"><h2>NOTIZIE STORICHE</h2></div>
  <div class="slide">
   <table class="mainData" style="width:98% !important;">
    <tr>
     <td width="50%;">
      <div class="arrow_box orale1notsto">Inserire descrizione campo</div>
      <label><i class="fa fa-info-circle" data-class="orale1notsto"></i> NOTIZIE STORICHE</label>
      <textarea id="" class="form"></textarea>
     </td>
     <td>
      <div class="arrow_box orale1note2">Inserire descrizione campo</div>
      <label><i class="fa fa-info-circle" data-class="orale1note2"></i> NOTE</label>
      <textarea id="" class="form"></textarea>
     </td>
    </tr>
   </table>
  </div>
 </div>
</div>
