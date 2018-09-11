<?php
//connession string
$dbhost = 'localhost';
$dbusername = 'fonti';
$password='f0Nt1aDmIn';
$database_name = 'fonti';
$port = 5432;
$connection = pg_connect("host=$dbhost port=$port user=$dbusername password=$password dbname=$database_name") or die ("Impossibile connettersi al server");
?>
