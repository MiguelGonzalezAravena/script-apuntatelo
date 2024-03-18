<?
include('../header.php');
$user = $_SESSION['user'];
$id_user = $_SESSION['id'];
$id_mensaje = $_GET['mensaje'];
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
$sql = "select m.asunto, m.contenido, m.fecha, m.id_receptor, s.nick 
		from mensajes as m
		inner join usuarios as s
		on m.id_emisor = s.id
		where m.id_mensaje = '".$id_mensaje."' and m.id_receptor = '".$id_user."'
		order by id_mensaje desc
		";
$rs = mysql_query($sql, $con);
$row = mysql_fetch_array($rs);
mysql_close();
?>
<br>
<table align="center" width="90%" height="300" valign="top" border="0">
	<tr>
		<td width="200" valign="top">
			<br>
			<?include('menu.php');?>
		</td>
		<td valign="top">
			<br>
			<table style="padding:15px;" border="0">
				<tr>
					<td style="font-size:12px; font-weight:bold;">
						De:
					</td>
					<td style="font-size:12px;">
						<?=$row['nick']?>
					</td>
				</tr>
				<tr>
					<td style="font-size:12px; font-weight:bold;">
						Fecha:
					</td>
					<td align="left" style="font-size:12px;">
						<?=$row['fecha']?>
					</td>
				</tr>
				<tr>
					<td style="font-size:12px; font-weight:bold;">
						Asunto:
					</td>
					<td align="left" style="font-size:12px;">
						<?=htmlentities($row['asunto']);?>
					</td>
				</tr>
				<tr>
					<td width="30" style="font-size:12px; font-weight:bold;">
						<br>
						Mensaje:
					</td>
					<td>
					</td>
				</tr>
				<tr>
					<td valign="top" colspan="2" style="padding:3px; font-size:12px; width:600px; height:200px; border-width:1px; border-style:solid; background-color: #d3d3d3;">
						<?=bbparse($row['contenido'])?>
					</td>
				</tr>
				<tr>
					<td colspan="2" style="font-size:12px; font-weight:bold;">
						<table>
							<tr>
								<td valign="top">
									<form name="responder" method="POST" action="redactar.php">
									<input type="hidden" name="para" value="<?=$row['nick']?>">
									<input type="hidden" name="asunto" value="<?="RE: ".$row['asunto']?>">
									<input type="button" value="Responder" style="border-width:0px; font-size:12px; font-weight:bold; padding:4px;" onclick="submit();">
									</form>
								</td>
								<td valign="top">
									<input type="button" value="Eliminar" style="border-width:0px; font-size:12px; font-weight:bold; padding:4px;">
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<br><br>
<?
//Marco como leído en el header asi se actualiza el numero del menu.
//$sql = "Update mensajes Set leido_receptor='1' where id_mensaje='".$id_mensaje."' and id_receptor = '".$id_user."'"; 	
//mysql_query($sql,$con);
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
