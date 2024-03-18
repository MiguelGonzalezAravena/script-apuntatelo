<?php
$bd_host = "localhost";
$bd_usuario = "usuario";
$bd_password = "Contraseña";
$bd_base = "nombre";
session_start();
$con = mysql_connect($bd_host, $bd_usuario, $bd_password);
mysql_select_db($bd_base, $con);
?>