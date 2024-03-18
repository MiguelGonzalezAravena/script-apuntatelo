<?php
$bd_host = "localhost";
$bd_usuario = "usuario";
$bd_password = "contraseña";
$bd_base = "nombre";

$con = mysql_connect($bd_host, $bd_usuario, $bd_password);
mysql_select_db($bd_base, $con);
?>