<?php
require_once(dirname(dirname(__FILE__)) . '/includes/configuracion.php');
require_once(dirname(dirname(__FILE__)) . '/login.php');
require_once(dirname(dirname(__FILE__)) . '/includes/funciones.php');

$id_user = isset($_SESSION['id']) ? $_SESSION['id'] : '';
$id_post = isset($_POST['post']) ? (int) $_POST['post'] : '';
$pag = isset($_POST['pag']) ? no_injection($_POST['pag']) : '';

if ($id_user != '') {
  $sql = "
    SELECT id
    FROM favoritos
    WHERE id_post = " . $id_post . "
    AND id_usuario = " . $id_user;
  $rs = mysqli_query($con, $sql);

  if (mysqli_num_rows($rs) == 0) {
    $sql = "
      INSERT INTO favoritos (id_post, id_usuario, fecha)
      VALUES (" . $id_post . ", " . $id_user . ", NOW())";

    mysqli_query($con, $sql);
  }

  redirect($pag);
}

redirect($url);

?>