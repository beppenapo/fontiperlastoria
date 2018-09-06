<?php
$dbhost = getenv('FONTIH');
$dbusername = getenv('FONTIU');
$password=getenv('FONTIP');
$database_name = getenv('FONTID');
$port = getenv('PORT');
$connection = pg_connect("host=$dbhost port=$port user=$dbusername password=$password dbname=$database_name") or die ("Impossibile connettersi al server");
?>
