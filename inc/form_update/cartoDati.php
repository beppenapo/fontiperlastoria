<div id="cartoDati_form">
 <label>SUPPORTO</label>
 <textarea id="cartoSupporto" class="form" style=""><?php echo stripslashes($cartoArr['supporto']); ?></textarea>
 
 <label>BN/COLORE</label>
 <select id="cartoColore" name="cartoColore" class="form">
 <option value="<?php echo $cartoArr['id_colore'];?>"><?php echo $cartoArr['colore'];?></option>
  <?php
    $whereCol = (!$cartoArr['id_colore']) ? '': 'where id != '.$cartoArr["id_colore"];
    $query =  ("SELECT * from lista_dtc_icol $whereCol order by definizione asc");
    $result = pg_query($connection, $query);
    $righe = pg_num_rows($result);
    $i=0;
    for ($i = 0; $i < $righe; $i++){
     $idcolore = pg_result($result, $i, "id");
     $defcolore = pg_result($result, $i, "definizione");
     echo "<option value='$idcolore'>$defcolore</option>";
    }
   ?>
 </select>
 
 <label>MISURA STAMPA</label>
 <textarea id="cartoMisura" class="form" style=""><?php echo stripslashes($cartoArr['misura']); ?></textarea>
 
 <label>RAPPORTO DI SCALA</label>
 <textarea id="cartoScala" class="form" style=""><?php echo stripslashes($cartoArr['scala']); ?></textarea>
 
 <div class="login2" style="margin-top:20px;" id="cartoDatiSalva">Salva modifiche</div>
 <div class="chiudiForm login2">Annulla modifiche</div>
</div>
