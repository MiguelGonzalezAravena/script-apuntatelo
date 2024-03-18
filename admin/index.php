<?
include('../header.php');
include('../includes/configuracion.php');
$id = $_SESSION['id'];
$sql = "SELECT nick, rango FROM usuarios where id='".$id."' ";
$rs = mysql_query($sql, $con);
$row = mysql_fetch_array($rs);
$rango = $row['rango'];
$user = $row['user'];
mysql_close();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Apuntatelo - Tu link-sharing de apuntes</title>
</head>
<body>
<div class="bordes">
<br>
<?
if ($rango=="Moderador" or $rango=="Administrador")
{
	?>
	<table align="center" width="400" height="300" cellspacing="0" cellpadding="0">
	<tr>
	<td>
		<div class="esq1" style="float:left;"></div>
		<div class="franja" style="float:left; width: 384px;"><div style="padding-top:2px;">Panel Moderadores</div></div>
		<div class="esq2" style="float:left;"></div>
	</td>
	</tr>
	<tr>
	<td class="fondo_cuadro" valign="top" style="padding:3px;"><br>
	<font size="2">
	<div align="center">Bienvenido <b><?echo$_SESSION['user']?></b></div>
	<br><br><br>
	&nbsp;Ir a panel <a href="usuarios.php">Usuarios</a> - (Sólo admins)<br><br><br>
	&nbsp;Ir a panel <a href="">Información Moderadores</a><br><br><br>
	&nbsp;Ir a panel <a href="stickies.php">Stickies</a> - (Sólo admins)<br><br><br>
	&nbsp;Ir a panel <a href="users_suspendidos.php">Usuarios Suspendidos</a><br><br><br>
	&nbsp;Ir a panel <a href="">Denuncias</a>
	<br><br>
	</font>
	</td>
	</tr>
	</table>
	<br><br>
	<?
}
else
{
?>
		<SCRIPT LANGUAGE="javascript">
       				location.href = "..";
       				</SCRIPT>
<?
}
?>
</div>
<?
include ('../footer.html');
?>
</body>
</html>
