<?php
require_once(dirname(dirname(__FILE__)) . '/includes/configuracion.php');
require_once(dirname(dirname(__FILE__)) . '/includes/funciones.php');
require_once(dirname(dirname(__FILE__)) . '/login.php');

$id_user = isset($_SESSION['id']) ? $_SESSION['id'] : '';
$user = isset($_SESSION['user']) ? $_SESSION['user'] : '';
$id_autor = isset($_POST['id_autor']) ? (int) $_POST['id_autor'] : 0;
$num = isset($_POST['num']) ? (int) $_POST['num'] : 0;
$pag = isset($_POST['pagina']) ? no_injection($_POST['pagina']) : '';
$causa = isset($_POST['causa']) ? no_injection($_POST['causa']) : '';
$rango = rango_propio($user);

if ($rango == 'Administrador' || $rango == 'Moderador') {
  mysqli_query($con, "INSERT INTO posts_eliminados (id_modera, id_post, causa, fecha) VALUES ($id_user, $num, '" . $causa . "', NOW())") or die("Error al borrar el post como moderador o administrador: " . mysqli_error($con));
  mysqli_query($con, "UPDATE posts SET elim = 1 WHERE id = " . $num);
  mysqli_query($con, "UPDATE usuarios SET numposts = numposts - 1 WHERE id = " . $id_autor);
  mysqli_query($con, "UPDATE cantidad SET cant = cant - 1 WHERE id = 1");
  mysqli_close($con);
}

redirect($pag);

?>