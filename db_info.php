<?php 
    $titulo = "Primera Clase de PHP";

//local version
$servername = 'localhost';
$dbname = 'esthonordb';
$username = 'root';
$password = '';


//server version
//$servername = '136.145.29.193';
//$dbname = 'javquiga_db';
//$username = 'javquiga';
//$password = '';



$dbc = new mysqli($servername , $username , $password, $dbname);
if ($dbc->connect_error) {
    die("La conexión al servidor falló. Error: " . $dbc->connect_error)."</p>";
}
$dbc->query("SET NAMES 'utf8'");


?>
