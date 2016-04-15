<div class="inner">
 <h2 class="h2aperto">DESCRIZIONE RACCOLTA/INDAGINE</h2>
 <table class="mainData" style="width:98% !important;">
  <tr>
   <td width="50%;">
    <div class="arrow_box mater1tipo">Inserire descrizione campo</div>
    <label><i class="fa fa-info-circle" data-class="mater1tipo"></i> TIPOLOGIA RACCOLTA/INDAGINE</label>
    <select id="mater1_dsc_tipo_raccolta" class="form">
     <option value="">--tute le tipologie--</option>
     <?php 
      $q1 = ("SELECT * from lista_tipo_raccolta ORDER BY definizione ASC;");
      $r1 = pg_query($connection, $q1);
      $row1 = pg_num_rows($r1);
      for ($i = 0; $i < $row1; $i++){
       $id1 = pg_result($r1, $i, "id");
       $def = pg_result($r1, $i, "definizione");
       echo "<option value='$id1'>$def</option>";
      }
     ?>
    </select>
   </td>
   <td></td>
  </tr>
  <tr>
   <td>
    <div class="arrow_box mater1consist">Inserire descrizione campo</div>
    <label><i class="fa fa-info-circle" data-class="mater1consist"></i> CONSISTENZA</label>
    <textarea id="" class="form"></textarea>
    <br/>
    <div class="arrow_box mater1caratt">Inserire descrizione campo</div>
    <label><i class="fa fa-info-circle" data-class="mater1caratt"></i> CARATTERISTICHE RACCOLTA/INDAGINE</label>
    <textarea id="" class="form"></textarea>
    <br/>
    <div class="arrow_box mater1catman">Inserire descrizione campo</div>
    <label><i class="fa fa-info-circle" data-class="mater1catman"></i> CATEGORIE MANUFATTI</label>
    <select id="categorie" class="form">
     <option value="">--tute le categorie--</option>
     <?php 
      $q3 =  ("SELECT * FROM lista_dsc_catman order by definizione asc; ");
      $r3 = pg_query($connection, $q3);
      $row3 = pg_num_rows($r3);
      for ($i3 = 0; $i3 < $row3; $i3++){
       $id3 = pg_result($r3, $i3, "id");
       $def3 = pg_result($r3, $i3, "definizione");
       echo "<option value='$id3'>$def3</option>";
      }
     ?>
    </select>
   </td>
   <td>
    <div class="arrow_box mater1contcons">Inserire descrizione campo</div>
    <label><i class="fa fa-info-circle" data-class="mater1contcons"></i> CONTESTO CONSERVATIVO</label> 
    <textarea id="" class="form"></textarea>
    <br/>
    <div class="arrow_box mater1grado">Inserire descrizione campo</div>
    <label><i class="fa fa-info-circle" data-class="mater1grado"></i> GRADO UTILIZZO</label>
    <textarea id="" class="form"></textarea>
    <br/>
    <div class="arrow_box mater1elemint">Inserire descrizione campo</div>
    <label><i class="fa fa-info-circle" data-class="mater1elemint"></i> SPECIFICI ELEMENTI DI INTERESSE</label>
    <textarea id="" class="form"></textarea>
    <br/>
    <div class="arrow_box mater1note">Inserire descrizione campo</div>
    <label><i class="fa fa-info-circle" data-class="mater1note"></i> NOTE</label>
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
     <div class="arrow_box mater1ord">Inserire descrizione campo</div>
     <label><i class="fa fa-info-circle" data-class="mater1ord"></i> CRITERI DI ORDINAMENTO</label>
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
     <div class="arrow_box mater1notsto">Inserire descrizione campo</div>
     <label><i class="fa fa-info-circle" data-class="mater1notsto"></i> NOTIZIE STORICHE</label>     
     <textarea id="" class="form"></textarea>
    </td>
    <td>
     <div class="arrow_box mater1note2">Inserire descrizione campo</div>
     <label><i class="fa fa-info-circle" data-class="mater1note2"></i> NOTE</label>
     <textarea id="" class="form"></textarea>
    </td>
   </tr>
  </table>
 </div>
</div>
</div>
