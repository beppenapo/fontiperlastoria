<?php
include('db.php');
if($_POST['id']){
	$id=$_POST['id'];
	$query = ("select * from localita where comune=$id order by localita asc");
	$result = pg_query($connection, $query);
	$righe = pg_num_rows($result);
echo '<option value="6">--seleziona un valore--</option>';
	if($righe > 0){
		while($row = pg_fetch_array($result)){
			$id=$row['id'];
			$localita=stripslashes($row['localita']);
			echo '<option value="'.$id.'">'.$localita.'</option>';
		}
	}
}
?>