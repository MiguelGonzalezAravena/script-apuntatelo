<?
include('../includes/configuracion.php');
include('../login.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>APUNTATELO - Tu link-sharing de apuntes</title>
	<link href='../imagenes/logo/icono.bmp' rel='shortcut icon'/>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<link rel="stylesheet" type="text/css" href="../estilos/index.css" />
</head>
<table align="center"><tr><td>
<div class="logo"></div></td></tr></table>
<br>
<body>
<?
if ($user!=null)
{
?>
<form name="password" method="post" action="cambiar.php">
<table align="top">
<tr>
<td>
<font size="2"><b>Usuario:</b></font> 
</td>
<td>
<font size="2"><?echo $_SESSION['user']?></font> 
</td>
</tr>
<tr>
<td>
<font size="2"><b>Password Anterior:</b></font> 
</td>
<td>
<input type="password" name="passwordant">
</td>
</tr>
<tr>
<td>
<font size="2"><b>Nueva Password:</b></font>  
</td>
<td>
<input type="password" name="password1">
</td>
</tr>
<tr>
<td>
<font size="2"><b>Confirmar Nueva Password:</b></font> 
</td>
<td>
<input type="password" name="password2">
</td>
</tr>
<tr>
<td>
</td>
<td>
<input type="submit" name="cambiar" value="Cambiar">
</td>
</tr>
</table>
</form>
<?
}
else
{
echo "<div align='center'>Ocurrio un error</div>";
}
?>
</body>
</html>
