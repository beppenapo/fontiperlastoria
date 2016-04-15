<div id="archiv1_aggregati_del_form">
<input type="hidden" id="id_scheda" name="id_scheda" value="<?php echo($id_scheda); ?>" />

<div style="margin-bottom:20px;">
 <h1>Seleziona gli archivi da eliminare</h1>
 <label>Selezionando gli archivi non verrà eliminata tutta la scheda ma solo lo stato di "aggregato".</label>
</div>

<?php
for ($x = 0; $x < $rowaggregato; $x++){
   $id_aggregato = pg_result($raggregato, $x,"id_aggregato"); 
   $aggregato = pg_result($raggregato, $x,"aggregato"); 
   echo "<label for='$aggregato' style='display:block;' class='input'><input type='checkbox' name='aggregato_del' value='$id_aggregato' id='$aggregato' />  $aggregato</label>";
}
?>
  <div class="test"></div>
  <br/> 
 <label class="alert avviso">Prima di cliccare sul tasto elimina assicurati di aver selezionato le schede giuste!</label>
 <div class="login2 alert" style="margin-top:20px;" id="archiv1_aggregati_elimina">Elimina</div>
 <div class="chiudiForm login2">Annulla modifiche</div>
</div>