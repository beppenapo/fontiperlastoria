<?php
 $tipo = $_POST['tipo'];
 if($tipo == 1) {$campo = 'aggregato';}
 if($tipo == 2) {$campo = 'aggregante';}
?>
<div id="archiv1_aggrega_form">
<input type="hidden" id="id_scheda" name="id_scheda" value="<?php echo($id_scheda); ?>" />
<input type="hidden" id="tipo" name="tipo" value="<?php echo($campo); ?>" />

 <label>LIVELLO</label>
  <select id="archiv1_livello_aggrega" name="archiv1_livello_aggrega" class="form">
       <option value="0">--filtra livello--</option>
       <option value="1">livello 1</option>
       <option value="2">livello 2</option>
       <option value="3">livello 3</option>
  </select>

  <label>SCHEDA</label>
  <select id="archiv1_aggrega_update" name="archiv1_aggrega_update" class="form disabilitata" disabled="true">
       
  </select>
  <br/>
 <div class="login2" style="margin-top:20px;" id="archiv1_aggrega_salva">Salva</div>
 <div class="chiudiForm login2">Annulla modifiche</div>
</div>