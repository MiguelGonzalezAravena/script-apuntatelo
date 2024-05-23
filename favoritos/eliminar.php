<?php
require_once(dirname(dirname(__FILE__)) . '/includes/configuracion.php');
require_once(dirname(dirname(__FILE__)) . '/login.php');
require_once(dirname(dirname(__FILE__)) . '/includes/funciones.php');

$id_user = isset($_SESSION['id']) ? $_SESSION['id'] : '';
$check = isset($_POST['cant_check']) ? no_injection($_POST['cant_check']) : '';

if ($id_user != '') {
  $cant_check = $check - 1;
  $favoritos = '(';

  for ($i = 0; $i <= $cant_check; $i++) {
    if (isset($_POST['i_' . $i])) {
      $favoritos .= no_injection($_POST['i_' . $i]) . ',';
    }
  }

  $favoritos = substr($favoritos, 0, strlen($favoritos) - 1);
  $favoritos .= ')';

  $sql = "
    DELETE FROM favoritos
    WHERE id IN " . $favoritos . "
    AND id_usuario = " . $id_user;

  echo $sql;
  mysqli_query($con, $sql);

  redirect($pag);
}

redirect($url);

?>