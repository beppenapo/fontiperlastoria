<?php
include('db.php');
if($_POST['id']){
	$id=$_POST['id'];
	$query = ("select * from provincia where stato=$id order by provincia ASC");
	$result = pg_query($connection, $query);
	$righe = pg_num_rows($result);
echo '<option value="">--seleziona una Provincia--</option>';
	if($righe > 0){
		while($row = pg_fetch_array($result)){
			$id=$row['id'];
			$provincia=$row['provincia'];
			echo '<option value="'.$id.'">'.$provincia.'</option>';
		}
	}else {echo ($query);}
}
?>