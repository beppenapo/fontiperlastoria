<div id="archiv1_aggregante_del_form">
<div style="margin-bottom:20px;">
 <h1>Seleziona gli archivi da eliminare</h1>
 <label>Selezionando gli archivi non verrà eliminata tutta la scheda ma solo lo stato di "aggregante".</label>
</div>

<?php
for ($x = 0; $x < $rowaggregante; $x++){
   $id_aggregante = pg_result($raggregante, $x,"id_aggregante"); 
   $aggregante = pg_result($raggregante, $x,"aggregante"); 
   echo "<label for='$aggregante' style='display:block;' class='input'><input type='checkbox' name='aggregante_del' value='$id_aggregante' id='$aggregante' />  $aggregante</label>";
}
?>
  <div class="test"></div>
  <br/> 
 <label class="alert avviso">Prima di cliccare sul tasto elimina assicurati di aver selezionato le schede giuste!</label>
 <div class="login2 alert" style="margin-top:20px;" id="archiv1_aggregante_elimina">Elimina</div>
 <div class="chiudiForm login2">Annulla modifiche</div>
</div>