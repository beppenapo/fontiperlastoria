<?php
include('db.php');
if($_POST['id']){
	$id=$_POST['id'];
	$query = ("select * from indirizzo where comune=$id order by indirizzo asc");
	$result = pg_query($connection, $query);
	$righe = pg_num_rows($result);
echo '<option value="42">--seleziona un valore--</option>';
	if($righe > 0){
		while($row = pg_fetch_array($result)){
			$id=$row['id'];
			$indirizzo=$row['indirizzo'];
			echo '<option value="'.$id.'">'.$indirizzo.'</option>';
		}
	}
}
?>