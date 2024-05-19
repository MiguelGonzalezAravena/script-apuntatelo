<?php
require_once(dirname(dirname(__FILE__)) . '/includes/configuracion.php');
require_once(dirname(dirname(__FILE__)) . '/login.php');

$user = isset($_SESSION['user']) ? $_SESSION['user'] : '';
$id_user = isset($_SESSION['id']) ? $_SESSION['id'] : '';
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$rango = rango_propio($user);

if ($rango == 'Moderador' || $rango == 'Administrador') {
	mysqli_query($con, "UPDATE stickies SET elim = 1, modera = '$user' WHERE id = $id");
	mysqli_close($con);
	redirect($url . '/admin/stickies.php');
} else {
	redirect($url . '/admin/');
}

?>