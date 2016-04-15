<?php
ob_start();
$id = $_POST['schedaFoto'];
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/x-png")
|| ($_FILES["file"]["type"] == "image/png"))
&& ($_FILES["file"]["size"] < 2000000000)
&& in_array($extension, $allowedExts))
  {
  if ($_FILES["file"]["error"] > 0){echo "Errore nel caricamento: " . $_FILES["file"]["error"] . "<br>";
  }else{
    if (file_exists("../foto/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " esiste già un file con questo nome. ";
      }
    else
      {
       $file = $_FILES["file"]["name"];
       require("db.php");
       $up=("insert into file(id_scheda, path, tipo)values($id, '$file',1);");
       $exec = pg_query($connection, $up);
       if($exec) {move_uploaded_file($_FILES["file"]["tmp_name"], "../foto/" . $_FILES["file"]["name"]);        }
       echo "Immagina caricata!<br/>";
       echo "Entro 5 secondi verrai reindirizzato nella pagina della fonte...<br/>";
       echo "Se la pagina impiega troppo tempo <a href='../scheda_archeo.php?id=".$id."'>clicca qui</a> per tornare alla pagina della fonte";
      }
    }
  }
else
  {
  echo "File non valido o non selezionato!";
  }
header("Refresh: 3; URL=../scheda_archeo.php?id=".$id);
?>
