<?php
ob_start();
$id = $_POST['schedaFoto'];
$allowedExts = array(".mp3", ".ogg", ".wav");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);

echo $id;
echo "<br/>";
echo "name: ".$_FILES["file"]["name"];
echo "<br/>";
echo "type: ".$_FILES["file"]["type"];
echo "<br/>";
echo "size: ".$_FILES["file"]["size"];
echo "<br/>";
echo "errore: ".$_FILES["file"]["error"];
echo "<br/>";
echo "tmp_nme: ".$_FILES["file"]["tmp_name"];
echo "<br/>";

if ((($_FILES["file"]["type"] == "audio/mpeg")
|| ($_FILES["file"]["type"] == "audio/mp3")
|| ($_FILES["file"]["type"] == "audio/ogg")
|| ($_FILES["file"]["type"] == "audio/wav"))
&& ($_FILES["file"]["size"] < 2000000000)
&& in_array($extension, $allowedExts)){
    if ($_FILES["file"]["error"] > 0){
        echo "Errore nel caricamento: " . $_FILES["file"]["error"] . "<br>";
    }else{
        if (file_exists("../audio/" . $_FILES["file"]["name"])){
            echo $_FILES["file"]["name"] . " esiste già un file con questo nome. ";
        }else{
            $file = $_FILES["file"]["name"];
            require("db.php");
            $up=("insert into file(id_scheda, path, tipo)values($id, '$file', 2);");
            $exec = pg_query($connection, $up);
            if($exec) {move_uploaded_file($_FILES["file"]["tmp_name"], "../audio/" . $_FILES["file"]["name"]);}
            echo "File caricato!<br/>";
            echo "Entro 5 secondi verrai reindirizzato nella pagina della fonte...<br/>";
            echo "Se la pagina impiega troppo tempo <a href='../scheda_archeo.php?id=".$id."'>clicca qui</a> per tornare alla pagina della fonte";
        }
    }
}else{
    echo "File non valido o non selezionato! ".$_FILES["file"]["type"];
}
//header("Refresh: 3; URL=../scheda_archeo.php?id=".$id);
?>
