<?php
session_start();
ob_start();
$id = $_POST['schedaFoto'];
$type = $_FILES["file"]["type"];
$dir = '../foto/';
$file = basename($_FILES['file']['name']);
$up = $dir . $file;
$size = filesize($_FILES['file']['name']);

if ($type == "image/gif" || $type == "image/jpeg" || $type == "image/jpg" || $type == "image/pjpeg" || $type == "image/x-png" || $type == "image/png"){
    if($size > 2000000000){
        echo "Le dimensioni del file superano quelle permesse!<br/>Il file da caricare non può superare i 2GB di dimensioni";
        echo "2000000000 / ".$size;
    }else{
        if ($_FILES["file"]["error"] > 0){
            echo "Errore nel caricamento: " . $_FILES["file"]["error"] . "<br>";
        }else{
            if (file_exists($up)){
                echo $file . ": esiste già un file con questo nome. ";
            }else{
                if (move_uploaded_file($_FILES['file']['tmp_name'], $up)) {
                    require("db.php");
                    $up=("insert into file(id_scheda, path, tipo)values($id, '$file', 1);");
                    $exec = pg_query($connection, $up);
                    if($exec) {
                        echo "File caricato!<br/>";
                        echo "Tra 5 secondi verrai reindirizzato nella pagina della fonte...<br/>";
                        echo "Se la pagina impiega troppo tempo <a href='../scheda_archeo.php?id=".$id."'>clicca qui</a> per tornare alla pagina della fonte";
                    }else{
                        echo "errore nella query di inseriment file: ".pg_last_error($connection);
                    }
                } else {
                    echo "Possible file upload attack!\n";
                }
            }
        }
    }
}else{
    echo "Il tipo di file non è tra quelli permessi!<br/>Puoi caricare solo file con estensione .mp3, .ogg, .wav";
}
header("Refresh: 5; URL=../scheda_archeo.php?id=".$id);
?>






<?php
session_start();
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
