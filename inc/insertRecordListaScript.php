<?php
include("db.php");
$tab = $_POST['tab'];
$newDef = $_POST['newDef'];
$newDef = pg_escape_string($newDef);
$inserisci = ("INSERT INTO $tab(definizione) VALUES ('$newDef');");
$result = pg_query($connection, $inserisci);

if(!$result){die("Errore nella query: \n" . pg_last_error($connection));}
else{
 $select = ("select * FROM $tab ORDER BY definizione ASC;");
 $res = pg_query($connection, $select);
 $righe = pg_num_rows($res);

 if($righe != 0) {
     for ($y = 0; $y < $righe; $y++){
       $id = pg_result($res, $y,"id"); 	
       $def = pg_result($res, $y,"definizione");
       echo "<tr class='trListe' tab='$tab' id='$id' def='$def'><td>$def</td><td class='modLista update'>modifica</td><td class='modLista del'>elimina</td></tr>";
     }
 }else{
 	echo "<tr class='' ref=''><td colspan='3'>Nessuna definizione disponibile</td></tr>";
 }
}
?>

<script type="text/javascript" >
$(document).ready(function(){
  //prova ad inizializzare qui le tooltip per i nuovi elementi
});
</script>