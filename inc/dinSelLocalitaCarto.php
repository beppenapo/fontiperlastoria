<?php
require('db.php');
if($_POST['id']){
    $id=$_POST['id'];
    $query = ("select * from localita where comune=$id order by localita asc");
    $result = pg_query($connection, $query);
    $righe = pg_num_rows($result);
    if($righe > 0){
        echo '<label class="labelInput" for="lcAll" style="font-weight:bold;"><input type="checkbox" id="lcAll" name="lcAll" />Seleziona/deseleziona tutto</label>';
        while($row = pg_fetch_array($result)){
            echo '<label class="labelInput" for="lc'.$row['id'].'"><input type="checkbox" id="lc'.$row['id'].'" data-loc="'.stripslashes($row['localita']).'" name="localitaCartoCheck" value="'.$row['id'].'" /> '.stripslashes($row['localita']).'</label>';
        }
    }
}
?>