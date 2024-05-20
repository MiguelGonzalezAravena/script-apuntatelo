<?php
require_once(dirname(dirname(__FILE__)) . '/includes/configuracion.php');
require_once(dirname(dirname(__FILE__)) . '/includes/funciones.php');

$idcoment = isset($_POST['idcoment']) ? (int) $_POST['idcoment'] : 0;
$idpost = isset($_POST['idpost']) ? (int) $_POST['idpost'] : 0;
$causa = isset($_POST['causa']) ? no_injection($_POST['causa']) : '';
$mod = isset($_POST['mod']) ? no_injection($_POST['mod']) : '';
$id_mod = isset($_POST['id_mod']) ? (int) $_POST['id_mod'] : 0;
$pag = isset($_POST['pagina']) ? no_injection($_POST['pagina']) : '';
$elim = 1;

mysqli_query($con, "UPDATE comentarios SET elim = $elim, id_modera = $id_mod, modera = '" . $mod . "', causa = '" . $causa . "' WHERE id = " . $idcoment);
mysqli_query($con, "UPDATE cantidad SET cant = cant - 1 WHERE id = 2");
mysqli_close($con);

redirect($pag);

?>