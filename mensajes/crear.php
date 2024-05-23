<?php
require_once(dirname(dirname(__FILE__)) . '/includes/configuracion.php');
require_once(dirname(dirname(__FILE__)) . '/includes/funciones.php');
require_once(dirname(dirname(__FILE__)) . '/login.php');

$nom_carpeta = isset($_POST['nom_carpeta']) ? no_injection($_POST['nom_carpeta']) : '';
$id_user = isset($_SESSION['id']) ? $_SESSION['id'] : '';

if ($id_user != '') {
  if ($nom_carpeta != '') {
    $sql = "
      INSERT INTO carpetas (id_usuario, nom_carpeta) 
      VALUES ($id_user, '$nom_carpeta')";

    $rs = mysqli_query($con, $sql);

    redirect($url . '/mensajes');
  }
} else {
  redirect($url);
}

?>