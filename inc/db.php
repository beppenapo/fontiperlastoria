<?php
$dbhost = getenv('HOST');
$dbusername = getenv('FONTIUSR');
$password=getenv('FONTIPWD');
$database_name = getenv('FONTIDB');
$port = getenv('PORT');
$connection = pg_connect("host=$dbhost port=$port user=$dbusername password=$password dbname=$database_name") or die ("Impossibile connettersi al server");
?>
