<?php
include("db.php");

$id_scheda = $_POST['id'];
$livello = $_POST['livello'];

$select = ("
SELECT DISTINCT
  scheda.dgn_numsch, 
  scheda.id
FROM 
  public.scheda
WHERE 
  scheda.livello = $livello AND
  scheda.dgn_tpsch = 4 AND
  scheda.id != $id_scheda
ORDER BY dgn_numsch ASC;");
$result = pg_query($connection, $select);
$righe = pg_num_rows($result);
$i=0;
echo "<option value=\"0\">--seleziona scheda--</option>";
for ($i = 0; $i < $righe; $i++){
 $idScheda = pg_result($result, $i, "id");
 $dgn_numsch = pg_result($result, $i, "dgn_numsch");
 echo "<option value=\"$idScheda\">$dgn_numsch</option>";
}
?>