<?php
include('db.php');


if($_POST['id']){
	$id=$_POST['id'];
	$query = ("select * from comune where provincia=$id order by comune asc");
	$result = pg_query($connection, $query);
	$righe = pg_num_rows($result);
echo '<option value="">--seleziona un valore--</option>';
	if($righe > 0){
		while($row = pg_fetch_array($result)){
			$id=$row['id'];
			$comune=$row['comune'];
			echo '<option value="'.$id.'">'.$comune.'</option>';
		}
	}
}
?>