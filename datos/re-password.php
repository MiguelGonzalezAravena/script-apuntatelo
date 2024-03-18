<?
include('../header.php');
include('../includes/configuracion.php');

$id = no_injection($_GET['id']);
$action = no_injection($_GET['action']);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>Apuntatelo - Tu link-sharing de apuntes</title>
</head>

<body>
<div class="bordes">
<?
$id2 = explode('?',$id);
$id = $id2[0];
$id_apuntatelo = $id2[1];

$sql= "Select nick from usuarios where id='".$id."' and id_extreme='".$id_extreme."' ";
$rs = mysql_query($sql, $con);
if (mysql_num_rows($rs)>0)
{
	$row=mysql_fetch_array($rs);
	?>
	<br><br><br><br><br>
	<form name="password" method="post" action="re-cambiar.php">
	<input type="hidden" name="id" value="<?=$id?>">
	<input type="hidden" name="id_extreme" value="<?=$id_extreme?>">
	<table align="center" cellspacing="0" cellpadding="0">
	<?
	if ($action=="error")
	{
	?>
	<tr>
	<td colspan="2" align="center">
	<font size="2" color="red"><b>Las contraseñas no coinciden y/o tienen menos de 6 caracteres.</b></font>  
	<br><br>
	</td>
	</tr>
	<?
	}
	?>
	<tr>
	<td colspan="2" align="center">
		<div class="esq1" style="float:left;"></div>
		<div class="franja" style="float:left; width: 471px;"><div style="padding-top:2px;"><?echo $row['nick']?></div></div>
		<div class="esq2" style="float:left;"></div>
	</td>
	</tr>
	<tr>
	<tr>
	<td class="fondo_cuadro" style="padding:5px;">
	<font size="2"><b>Nueva Password:</b></font>  
	</td>
	<td class="fondo_cuadro" style="padding:5px;">
	<input type="password" name="password1">
	</td>
	</tr>
	<tr>
	<td class="fondo_cuadro" style="padding:5px;">
	<font size="2"><b>Confirmar Nueva Password:</b></font> 
	</td>
	<td class="fondo_cuadro" style="padding:5px;">
	<input type="password" name="password2">
	</td>
	</tr>
	<tr>
	<td class="fondo_cuadro">
	</td>
	<td class="fondo_cuadro" style="padding:5px;">
	<input type="submit" class="submit_button" name="cambiar" value="Cambiar">
	</td>
	</tr>
	</table>
	</form>
	<br><br><br><br><br><br><br><br><br><br><br><br>
	<?
}
else
{
?>

<?
}
include('../footer.html');
?>
</div>
</body>
</html>