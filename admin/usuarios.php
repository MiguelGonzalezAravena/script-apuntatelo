<?
include('../header.php');
include('../includes/configuracion.php');
$id = $_SESSION['id'];
$sql = "SELECT nick, rango FROM usuarios where id='".$id."' ";
$rs = mysql_query($sql, $con);
$row = mysql_fetch_array($rs);
$rango = $row['rango'];
$user = $row['user'];
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
if ($rango=="Administrador")
{
	$id_buscar = $_POST['id_buscar'];
	if ($id_buscar!="")
	$cadena = "where id='$id_buscar'";
	else
	$cadena = "";
	?>
	<table align="center" width="275" cellspacing="0" cellpadding="0">
	<tr>
	<td>
		<div class="esq1" style="float:left;"></div>
		<div class="franja" style="float:left; width: 259px;"><div style="padding-top:2px;">Filtrado</div></div>
		<div class="esq2" style="float:left;"></div>
	</td>
	</tr>
	<tr>
	<td class="fondo_cuadro" valign="top" style="padding:3px;"><br>
	<form name="buscar_user" method="post" action="">
	&nbsp;<font size="2">Id Usuario: </font><input type="text" name="id_buscar" size="15" value="<?echo $id_buscar?>">
	<input type="submit" class="submit_button" name="Filtrar" value="Filtrar">
	</form>
	</td>
	</tr>
	</table>
	<br>
	<table align="center" width="700" cellspacing="0" cellpadding="0">
	<tr>
	<td>
		<div class="esq1" style="float:left;"></div>
		<div class="franja" style="float:left; width: 684px;"><div style="padding-top:2px;">Panel Usuarios</div></div>
		<div class="esq2" style="float:left;"></div>
	</td>
	</tr>
	<tr>
	<td class="fondo_cuadro" valign="top" style="padding:3px;"><br>
	<font size="2">
	<table border="1">
	<?
	$_pagi_sql = "select activacion, id, nick, nombre, mail, sexo from usuarios $cadena order by id asc ";
	$rs = mysql_query($_pagi_sql,$con);
	if (mysql_num_rows($rs)>0)
	{
	?>
		<tr>
		<td>
		<font size="1">A</font>
		</td>
		<td>
		<font size="1">Id</font>
		</td>
		<td>
		<font size="1">Nick</font>
		</td>
		<td>
		<font size="1">Nombre</font>
		</td>
		<td>
		<font size="1">Mail</font>
		</td>
		<td>
		<font size="1">Sexo</font>
		</td>
		</tr>
		<?
		$_pagi_cuantos = 30; 
		include("paginator.inc.php"); 
		while($row = mysql_fetch_array($_pagi_result))
		{
					$activacion = $row['activacion'];
					$id_usuario = $row['id'];
					$nick = $row['nick'];
					$nombre = $row['nombre'];
					$mail = $row['mail'];
					$sexo = $row['sexo'];
			?>	
			<tr>
			<td width="25">
			<font size="1" color="black"><b><?echo $activacion?></b>
			</td>
			<td width="200">
			<font size="1" color="black"><b><?echo $id_usuario?></b>
			</td>
			<td width="200">
			<font size="1" color="black"><b><a href="/perfil/?id=<?echo $nick?>"><?echo $nick?></a></b>
			</td>
			<td width="500">
			<font size="1" color="black"><b><?echo $nombre?></b>
			</td>
			<td width="500">
			<font size="1" color="black"><b><?echo $mail?></b></font>
			</td>
			<td width="60">
			<font size="1" color="black"><b><?echo $sexo?></b>
			</td>
			</tr>
			<?
		}
	}
	else
	echo "No existe el usuario.";
	mysql_close();
	?>
	</table>
	<tr>
	<td colspan="6" align="right">
	<table>
	<tr>
	<td>
	</td>
	<td align="right">
	<?echo"<p><font size='1'>".$_pagi_navegacion."</font></p>";?> 
	</td>
	</tr>
	</table>
	</td>
	</tr>
	
	</table>
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

