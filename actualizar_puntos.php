<?
	include('includes/configuracion.php');
	$sql = "Update usuarios Set puntosdar='30' where rango='Administrador'";
	mysql_query($sql);
	$sql = "Update usuarios Set puntosdar='25' where rango='Moderador'";
	mysql_query($sql);
	$sql = "Update usuarios Set puntosdar='18' where rango='Usuario Destacado'";
	mysql_query($sql);
	$sql = "Update usuarios Set puntosdar='12' where rango='Usuario Full'";
	mysql_query($sql);
	$sql = "delete from visitas";
	mysql_query($sql);
	mysql_close($con); 
?>