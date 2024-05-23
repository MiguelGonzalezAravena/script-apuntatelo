<?php
require_once(dirname(dirname(__FILE__)) . '/includes/configuracion.php');
require_once(dirname(dirname(__FILE__)) . '/includes/funciones.php');
require_once(dirname(dirname(__FILE__)) . '/login.php');

$id_user = isset($_SESSION['id']) ? $_SESSION['id'] : '';
$check = isset($_POST['cant_check']) ? (int) $_POST['cant_check'] : 0;
$carpeta = isset($_POST['carpeta']) ? (int) $_POST['carpeta'] : 0;
$pag = isset($_POST['pag']) ? no_injection($_POST['pag']) : '';

if ($id_user != '') {
  $cant_check = $check - 1;
  $mensajes = '(';
  $bandera = 0;

  for ($i = 0; $i <= $cant_check; $i++) {
    if ($_POST['i_' . $i] != '') {
      if ($bandera == 0) {
        $bandera = 1;
      } else if ($bandera == 1) {
        $mensajes .= ',';
      }

      $mensajes .= no_injection($_POST['i_' . $i]);
    }
  }

  $mensajes .= ')';

  $accion = isset($_POST['accion']) ? no_injection($_POST['accion']) : '';

  if ($accion != 'elim' && $accion != 'rest' && $accion != 'elim_def') {
    $sql = "
      UPDATE mensajes
      SET id_carpeta = '$accion'
      WHERE id_mensaje IN $mensajes
      AND id_receptor = $id_user";

    mysqli_query($con, $sql);
  }

  if ($accion == 'rest') {
    $sql = "
      UPDATE mensajes
      SET papelera_receptor = 0
      WHERE id_mensaje IN $mensajes
      AND id_receptor = $id_user";

    mysqli_query($con, $sql);
  }

  if ($accion == 'elim') {
    $sql = "
      UPDATE mensajes
      SET papelera_receptor = 1, fecha_papelera = NOW()
      WHERE id_mensaje IN $mensajes
      AND id_receptor = $id_user";

    mysqli_query($con, $sql);
  }

  if ($accion == 'elim_def') {
    $sql = "
      UPDATE mensajes
      SET eliminado_receptor = 1
      WHERE id_mensaje IN $mensajes
      AND id_receptor = $id_user
      AND papelera_receptor = 1";

    mysqli_query($con, $sql);
  }

  if ($accion == 'elim_env') {
    $sql = "
      UPDATE mensajes
      SET eliminado_emisor = 1
      WHERE id_mensaje IN $mensajes
      AND id_emisor = $id_user";

    mysqli_query($con, $sql);
  }

  if ($accion == 'elim_carpeta') {
    $sql = "
      UPDATE mensajes
      SET papelera_receptor = 1, id_carpeta = 0, fecha_papelera = NOW()
      WHERE id_carpeta = $carpeta
      AND id_receptor = $id_user";

    mysqli_query($con, $sql);

    $sql = "
      DELETE FROM carpetas
      WHERE id_carpeta = $carpeta
      AND id_usuario = $id_user";

    mysqli_query($con, $sql);
  }

  redirect($pag);
} else {
  redirect($url);
}

?>