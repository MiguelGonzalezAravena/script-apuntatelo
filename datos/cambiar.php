<?php
include('../includes/configuracion.php');
include('../login.php');
include('../includes/funciones.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>APUNTATELO - Tu link-sharing de apuntes</title>
	<link href='../imagenes/logo/icono.bmp' rel='shortcut icon'/>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<link rel="stylesheet" type="text/css" href="../estilos/index.css" />
</head>
<body>
<table align="center"><tr><td>
<div class="logo"></div></td></tr></table>
<br>
<br>
<?
$user=$_SESSION['user'];
$passwordant = no_injection($_POST['passwordant']);
$password1 = no_injection($_POST['password1']);
$password2 = no_injection($_POST['password2']);

if ($user!=null)
{
	if (trim($passwordant)!="" and trim($password1)!="" and trim($password1)==trim($password2) and strlen($password1)>5)
	{
		$sql="Select password from usuarios where nick='$user' ";
		$rs = mysql_query($sql, $con);
		while($row = mysql_fetch_array($rs))
		{
			$passwordbase = $row['password'];
		}
		$passwordant = md5($passwordant);
		$password = md5($password1);
		if ($passwordant == $passwordbase)
		{
			$id_apuntatelo = md5(uniqid(rand(), true));
			$sql2 = "Update usuarios Set id_apuntatelo='$id_apuntatelo', password='$password' where nick='$user'";
			$rs2 = mysql_query($sql2,$con);
			echo "El cambio fue realizado. Por favor loguearse nuevamente con la nueva clave.";
		}
		else
		{
			echo "<div align='center'>La password anterior es incorrecta.</div>";
			echo "<br>";
			echo "<br>";
			echo "<div align='center'>Para intentar nuevamente presione <a href=\"password.php\"><font color=\"gray\">aqu&iacute;</font></a></div>";
		}
		mysql_close($con);
	}
	else
	{
		echo "<div align='center'>Datos incorrectos. Acordate que la contrase�a tiene que tener m�s de 6 caract�res.</div>";
		echo "<br>";
		echo "<br>";
		echo "<div align='center'>Para intentar nuevamente presione <a href=\"password.php\"><font color=\"gray\">aqu&iacute;</font></a></div>";
	}
}
else
{
	echo "<div align='center'>Ocurrio un error</div>";
}
?>
</body>
</html>