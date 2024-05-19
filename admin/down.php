<?php
require_once(dirname(dirname(__FILE__)) . '/includes/configuracion.php');
require_once(dirname(dirname(__FILE__)) . '/login.php');

$id_sticky = isset($_GET['id_sticky']) ? (int) $_GET['id_sticky'] : 0;
$user = isset($_SESSION['user']) ? $_SESSION['user'] : '';
$rango = rango_propio($user);

if ($rango == 'Moderador' || $rango == 'Administrador') {
	$sql = "
		SELECT orden 
		FROM stickies
		WHERE id = " . $id_sticky;

	$request = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($request);
	$orden = $row['orden'];

	$sql = "
		SELECT id, orden 
		FROM stickies
		WHERE elim = 0
		ORDER BY orden ASC
		LIMIT 0, 1";

	$request = mysqli_query($con, $sql);

	while ($row = mysqli_fetch_array($request)) {
		$nuevo_orden = $row['orden'];
		$nuevo_id = $row['id'];
	}

	$sql = "
		SELECT id, orden 
		FROM stickies
		WHERE elim = 0
		ORDER BY orden DESC";

	$request = mysqli_query($con, $sql);

	while ($row = mysqli_fetch_array($request)) {
		if ($row['orden'] < $orden && $row['orden'] > $nuevo_orden) {
			$nuevo_orden = $row['orden'];
			$nuevo_id = $row['id'];
		}
	}

	mysqli_query($con, "UPDATE stickies SET orden = $orden WHERE id = $nuevo_id");
	mysqli_query($con, "UPDATE stickies SET orden = $nuevo_orden WHERE id = $id_sticky");
	mysqli_close($con);
}

redirect($url . '/admin/stickies.php');

?>