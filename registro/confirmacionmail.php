<?php
require_once(dirname(dirname(__FILE__)) . '/includes/configuracion.php');
require_once(dirname(dirname(__FILE__)) . '/includes/funciones.php');

$cadena = isset($_GET['id']) ? no_injection($_GET['id']) : '';

$cad = explode('?', $cadena);
$id = $cad[0];
$id_secret = $cad[1];

// TO-DO: Cambiar id_extreme a id_secret
$sql = "
  UPDATE usuarios
  SET activacion = 1
  WHERE id = '" . $id . "'
  AND id_extreme = '" . $id_secret . "'";

$request = mysqli_query($con, $sql);

if ($request) {
  redirect($url . '/notificaciones/registroexi.php');
} else {
  redirect($url . '/notificaciones/registrofa.php');
}

?>