<?php
require_once(dirname(dirname(__FILE__)) . '/includes/configuracion.php');
require_once(dirname(dirname(__FILE__)) . '/login.php');

$id_mensaje = isset($_GET['mensaje']) ? (int) $_GET['mensaje'] : 0;
$id_user = isset($_SESSION['id']) ? $_SESSION['id'] : '';

$sql = "
  UPDATE mensajes
  SET leido_receptor = 1
  WHERE id_mensaje = $id_mensaje
  AND id_receptor = $id_user";

mysqli_query($con, $sql);

?>