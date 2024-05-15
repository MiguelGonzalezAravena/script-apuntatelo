<?php
$bd_host = 'localhost';
$bd_usuario = 'root';
$bd_password = '';
$bd_base = 'apuntatelo';
$url = 'http://localhost/apuntatelo';
$images = $url . '/imagenes';

session_start();

$con = mysqli_connect($bd_host, $bd_usuario, $bd_password);
mysqli_select_db($con, $bd_base);
?>