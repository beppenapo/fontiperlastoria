<?php
include('db.php');
if($_POST['id']){
	$id=$_POST['id'];
	$query = ("select * from ricerca where id=$id");
	$result = pg_query($connection, $query);
	$righe = pg_num_rows($result);
	if($righe > 0){
		while($row = pg_fetch_array($result)){
			$enrespPrv=$row['enresp'];
			$respricPrv=$row['respric'];
			echo '
			 <label>ENTE RESPONSABILE</label>
          <textarea disabled="disabled" id="enrespprv_update" class="form">'.$enrespPrv.'</textarea>
          <label>RESPONSABILE RICERCA</label>
          <textarea disabled="disabled" id="respricprv_update" class="form">'.$respricPrv.'</textarea>';
		}
	}
}
?>
