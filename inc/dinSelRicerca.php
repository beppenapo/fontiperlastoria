<?php
include('db.php');
if($_POST['id']){
	$id=$_POST['id'];
	$query = ("select * from ricerca where id=$id");
	$result = pg_query($connection, $query);
	$righe = pg_num_rows($result);
	if($righe > 0){
		while($row = pg_fetch_array($result)){
			$enresp=$row['enresp'];
			$respric=$row['respric'];
			echo '
			 <label>ENTE RESPONSABILE</label>
          <textarea disabled="disabled" id="enteresp_update" class="form">'.$enresp.'</textarea>
          <label>RESPONSABILE RICERCA</label>
          <textarea disabled="disabled" id="respric_update" class="form">'.$respric.'</textarea>';
		}
	}
}
?>
