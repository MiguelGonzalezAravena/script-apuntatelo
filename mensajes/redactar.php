<?
include('../includes/configuracion.php');
include('../header.php');
$user = $_SESSION['user'];
$id_user = $_SESSION['id'];
$sql = "SELECT rango ";
$sql.= "FROM usuarios where nick='$user' ";
$rs = mysql_query($sql, $con);
mysql_close();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Apuntatelo - Tu link-sharing de apuntes</title>
</head>
<body>
<div class="bordes">
<?
if ($_SESSION['user']!="")
{
?>
<br>
<table align="center" width="900" height="300" valign="top" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="167" valign="top">
			<br>
			<?include('menu.php');?>
		</td>
		<td valign="top">
			<form name="redactar" method="POST" action="enviar.php">
			<table style="padding:15px;" cellspacing="0" cellpadding="0">
				<tr>
					<td colspan="2"> 
						<div class="esq1" style="float:left;"></div>
						<div class="franja" style="float:left; width: 600px;"><div style="padding-top:2px;">Redactar</div></div>
						<div class="esq2" style="float:left;"></div>
					</td>
				</tr>
				<tr class="fondo_cuadro">
					<td style="font-size:11px; padding:8px;">
						Para:
					</td>
					<td>
						<input type="text" name="para" style="width:190px; height: 20px; font-size:10px;" value="<?=$_REQUEST['para']?>" maxlenght="35">
					</td>
				</tr>
				<tr class="fondo_cuadro">
					<td style="font-size:11px; padding:8px;">
						Asunto:
					</td>
					<td>
						<input type="text" name="asunto" style="width:300px; height: 20px; font-size:10px;" value="<?=$_POST['asunto']?>" maxlenght="200">
					</td>
				</tr>
				<tr class="fondo_cuadro">
					<td style="font-size:11px; padding:8px;">
						Mensaje:&nbsp;
					</td>
					<td>
						<textarea name="contenido" style="width:500px; height: 200px; font-size:12px;"></textarea>
					</td>
				</tr>
				<tr class="fondo_cuadro">
					<td colspan="2" align="right" style="padding:8px;">
						<input type="submit" value="Enviar"  class="submit_button">
					</td>
				</tr>
			</table>
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
		<SCRIPT LANGUAGE="javascript">
       				location.href = "..";
       				</SCRIPT>
<?
}
include ('../footer.html');
?>
</div>
</body>
</html>
