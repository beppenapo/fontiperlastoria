<div id="consultabilita_form">
  <label>CONSULTABILITA'</label>
  <textarea id="consultabilita_update" class="form noteform"><?php echo($consultabilita); ?></textarea>

  <label>ORARIO</label>
  <textarea id="orario_update" class="form"><?php echo($orario); ?></textarea>
  
  <label>SERVIZI</label>
  <input type="hidden" value="<?php echo($servizi);?>" id="array"/>
  <div id="arrServ"></div>
  <?php

    $query =  ("SELECT * FROM lista_cre_servizi order by definizione asc; ");
    $result = pg_query($connection, $query);
    $righe = pg_num_rows($result);
    $i=0;
    for ($i = 0; $i < $righe; $i++){
      $idServ = pg_result($result, $i, "id");
      $serv = pg_result($result, $i, "definizione");
      echo "<label for='servizio$serv' style='display:block;cursor:pointer;margin-bottom:3px; padding-right:3px;'><input type='checkbox' name='servizi' id='servizio$serv' value='$serv' />$serv</label>";
    }

  ?>
  <div class="login2" style="margin-top:20px;" id="consultabilitaButton_update">Salva modifiche</div>
  <div class="chiudiForm login2">Annulla modifiche</div>

</div>
<script type="text/javascript" >
//$(document).ready(function(){
/*---------- servizi ---------*/
/*var a=$('#array').val();
var esplodi = a.split(', ');
for(var i=0;i<esplodi.length;i++){
   $('#servizio'+esplodi[i]).attr('checked', 'checked');
}*/
/*---------------------------------------*/
//});
</script>