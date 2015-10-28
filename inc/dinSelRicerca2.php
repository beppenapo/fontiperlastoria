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
			$data=$row['data'];
         $redattore=$row['redattore'];
			echo '
			 <table class="tableInfo"><tr>
			  <td><label>ENTE RESPONSABILE</label><br/><label><b>'.$enresp.'</b></label></td>
           <td><label>RESPONSABILE RICERCA</label><br/><label><b>'.$respric.'</b></label></td>
           <td><label>REDATTORE</label><br/><label><b>'.$redattore.'</b></label></td>
           <td><label>DATA</label><br/><label><b>'.$data.'</b></label></td>
          </tr></table>
          ';
		}
	}
}
?>