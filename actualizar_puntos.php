<?php
	require_once(dirname(__FILE__) . '/includes/configuracion.php');

	// Actualizar puntos según rango de cada usuario
	mysqli_query($con, "UPDATE usuarios SET puntosdar = '30' WHERE rango = 'Administrador'");
	mysqli_query($con, "UPDATE usuarios SET puntosdar = '25' WHERE rango = 'Moderador'");
	mysqli_query($con, "UPDATE usuarios SET puntosdar = '18' WHERE rango = 'Usuario Destacado'");
	mysqli_query($con, "UPDATE usuarios SET puntosdar = '12' WHERE rango = 'Usuario Full'");

	// Eliminar las visitas registradas
	mysqli_query($con, "DELETE FROM visitas");

	mysqli_close($con); 
?>