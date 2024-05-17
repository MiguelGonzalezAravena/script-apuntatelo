<?include('../header.php');
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
?>
	<table align="center" width="700" cellspacing="0" cellpadding="0">
	<tr>
	<td>
		<div class="esq1" style="float:left;"></div>
		<div class="franja" style="float:left; width: 684px;"><div style="padding-top:2px;">Panel Stickies</div></div>
		<div class="esq2" style="float:left;"></div>
	</td>
	</tr>
	<tr>
	<td class="fondo_cuadro" valign="top" style="padding:3px;"><br>
	<table border="1">
	<tr>
	<td>
	<font size="1">�rden</font>
	</td>
	<td>
	<font size="1">Id</font>
	</td>
	<td>
	<font size="1">T�tulo</font>
	</td>
	<td>
	<font size="1">Sticky por</font>
	</td>
	</tr>
	<?
	$sql = "SELECT s.id, s.orden, s.id_post, s.elim, s.creador, p.titulo
			FROM stickies as s
			inner join posts as p
			on p.id = s.id_post
			where s.elim='0' order by orden DESC ";
	$rs = mysql_query($sql, $con);
	while($row = mysql_fetch_array($rs))
	{
		$id = $row['id'];
		$id_post = $row['id_post'];
		$creador = $row['creador'];
		$orden = $row['orden'];
		$titulo = $row['titulo'];
		?>	
		<tr>
		<td width="57">
		<a href="up.php?id_sticky=<?echo $id?>"><img src="../imagenes/iconos/up.gif" alt="U"></a>
		<a href="down.php?id_sticky=<?echo $id?>"><img src="../imagenes/iconos/down.gif" alt="D"></a>
		</td>
		<td width="50">
		&nbsp;<a href="../posts/<?echo$id_post;?>/"><font size="1" color="black"><b><?echo $id_post?></b></a></font>
		</td>
		<td width="500">
		<font size="1" color="black"><b><?echo $titulo?></b>
		</td>
		<td width="150">
		<font size="1" color="black"><b><?echo $creador?></b></font>
		</td>
		<td>
		<a href="javascript:if(confirm('&iquest;Est&aacute; seguro que desea eliminar este Sticky?')) document.location='eliminar.php?id=<?echo $id?>';" ><img src="../imagenes/iconos/delete.gif" alt="X"></a>
		</td>
		</tr>
		<?	
	}
	mysql_close();
	?>
	</table>
	
	</td>
	</tr>
	</table>
	<br>
	<table align="center" width="275" cellspacing="0" cellpadding="0">
	<tr>
	<td>
		<div class="esq1" style="float:left;"></div>
		<div class="franja" style="float:left; width: 259px;"><div style="padding-top:2px;">Agregar nuevo Sticky</div></div>
		<div class="esq2" style="float:left;"></div>
	</td>
	</tr>
	<tr>
	<td class="fondo_cuadro" valign="top" style="padding:3px;"><br>
	<form name="sticky" method="post" action="agregar.php">
	&nbsp;<font size="2">Id Post: </font><input type="text" name="id" size="15">
	<input type="submit" class="submit_button" name="Agregar" value="Agregar">
	</form>
	</td>
	</tr>
	</table>
	
	<br><br>
	<?
}
else
{
	?>
		 <script type="text/javascript">
       				location.href = "..";
       				</script>
	<?
}
?>
</div>
<?
include ('../footer.html');
?>
</body>
</html>

