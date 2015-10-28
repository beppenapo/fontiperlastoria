<div id="archiv2_fondo_form">
<input type="hidden" id="idArchiv2" name="idArchiv2" value="<?php echo($idArchiv2); ?>" />
 
 <label>DESCRIZIONE</label>
 <textarea id="archiv2_dscfondo_update" class="form noteform"><?php echo($fondo); ?></textarea>
 
 <label>CONSISTENZA</label>
 <textarea id="archiv2_consist_update" class="form noteform"><?php echo($consist); ?> </textarea>
 
 <label>TIPOLOGIA DOCUMENTI</label>
 <div class="checkboxDiv">
 <?php 
  $trim = str_replace(', ',',',$tipo);
  $trim = ltrim($trim);
  $arr = explode(",", $trim);
  $i = count($arr);
  $newArr ='';
  foreach($arr as $element){
   $query =  ("SELECT id FROM lista_archivi_dsc_tipo where definizione = '$element'; ");
   $result = pg_query($connection, $query);
   $righe = pg_num_rows($result);
   if($righe>0) {
    for ($i = 0; $i < $righe; $i++){
      $checkArchTipo = pg_result($result, $i, "id");
      $newArr.=$checkArchTipo.',';
    }
   }
  }
  echo "<input type='hidden' value='$newArr' id='arrArchiv2tipodoc'/>";

  $query2 =  ("SELECT * FROM lista_archivi_dsc_tipo order by definizione asc; ");
  $result2 = pg_query($connection, $query2);
  $righe2 = pg_num_rows($result2);
  $i2=0;
  for ($i2 = 0; $i2 < $righe2; $i2++){
    $idArchTipo2 = pg_result($result2, $i2, "id");
    $defArchTipo2 = pg_result($result2, $i2, "definizione");
    echo "<label for='archtipo$idArchTipo2' style='display:block;cursor:pointer;margin-bottom:3px; padding-right:3px;'><input type='checkbox' name='archiv2_tipodoc_update' id='archtipo$idArchTipo2' value='$defArchTipo2' />$defArchTipo2</label>";
  }
?>
</div>   
 
 <label>LINGUA</label>
   <input type="hidden" value="<?php echo($lingua);?>" id="arrArchiv2Lingua"/>
   <div class="checkboxDiv">   
   <?php
    $query =  ("SELECT * FROM lista_lingua order by definizione asc; ");
    $result = pg_query($connection, $query);
    $righe = pg_num_rows($result);
    $i=0;
    for ($i = 0; $i < $righe; $i++){
      $idLingua = pg_result($result, $i, "id");
      $defLingua = pg_result($result, $i, "definizione");
      echo "<label for='lingua$defLingua' style='display:block;cursor:pointer;margin-bottom:3px; padding-right:3px;'><input type='checkbox' name='archiv2_lingua_update' id='lingua$defLingua' value='$defLingua' />$defLingua</label>";
    }

  ?> 
  </div>
 <label>NOTE</label>
 <textarea id="archiv2_fondonote_update" class="form noteform"><?php echo($note); ?> </textarea>

 <div class="login2" style="margin-top:20px;" id="archiv2_fondo_salva">Salva modifiche</div>
 <div class="chiudiForm login2">Annulla modifiche</div>
</div>
<script type="text/javascript" >
$(document).ready(function(){
/*---------- tipo archivio ---------*/
var aat=$('#arrArchiv2tipodoc').val();
var eat = aat.split(',');
for(var i=0;i<eat.length;i++){
   $('#archtipo'+eat[i]).attr('checked', 'checked');
}
/*---------------------------------------*/
/*---------- lingua ---------*/
var al=$('#arrArchiv2Lingua').val();
var el = al.split(', ');
for(var i=0;i<el.length;i++){
   $('#lingua'+el[i]).attr('checked', 'checked');
}
/*---------------------------------------*/
});
</script>