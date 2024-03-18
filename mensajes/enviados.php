<?
include('../header.php');
$id_user = $_SESSION['id'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Apuntatelo - Tu link-sharing de apuntes</title>
	<script>
	function mensajes_check_all(f)
	{
		var inputs=document.getElementsByTagName('input');
		for(var i=1;i<inputs.length; i++)
		{
			if(inputs.item(i).type=='checkbox' && inputs.item(i).name.substring(0,2)=='o_')
				inputs.item(i).checked=f;
		}
	}
	</script>
</head>
<body>
<div class="bordes">
<?
if ($id_user!="")
{
$_pagi_sql = "select m.id_mensaje, m.asunto, m.fecha, m.id_receptor, m.leido_emisor, s.nick
		from mensajes as m
		inner join usuarios as s
		on m.id_receptor = s.id
		where m.id_emisor = '".$id_user."' and eliminado_emisor='0'
		order by id_mensaje desc
		";
$_pagi_cuantos = 10; 
include('paginator.inc.php');
?>
<br>
<form name="salida" method="POST" action="acciones.php">
<input type="hidden" name="pag" value="<?=$_SERVER['REQUEST_URI']?>">
<table align="center" width="900" height="300" valign="top" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="167" valign="top">
			<br>
			<?include('menu.php');?>
		</td>
		<td valign="top">
			<br>
			<table style="padding-left:20px;" cellspacing="0" cellpadding="0">
				<tr>
					<td colspan="4"> 
						<div class="esq1" style="float:left;"></div>
						<div class="franja" style="float:left; width: 634px;"><div style="padding-top:2px;">Mensajes Enviados</div></div>
						<div class="esq2" style="float:left;"></div>
					</td>
				</tr>
				<tr style="font-size:11px; background-color: #ababab;">
					<td width="50">
					<input type="checkbox" onclick="mensajes_check_all(this.checked)">
					</td>
					<td width="250" >
					Asunto
					</td>
					<td width="200"> 
					Destinatario
					</td>
					<td width="150">
					Fecha
					</td>
				</tr>
				<?
				$i = 0;
				while ($row = mysql_fetch_array($_pagi_result))
				{
					?>
					<tr style="font-size:11px; background-color: #d3d3d3;">
					<td width="50">
					<input type="checkbox" name="i_<?=$i?>" value="<?=$row['id_mensaje']?>">
					</td>
					<td width="250" >
					<a href="mensajes_enviados.php?mensaje=<?=$row['id_mensaje']?>"><?=htmlentities($row['asunto'])?></a>
					</td>
					<td width="200"> 
					<?=$row['nick']?>
					</td>
					<td width="150">
					<?=$row['fecha']?>
					</td>
				</tr>
					<?
					$i++;
				}
				?>
				<tr>
					<td colspan="4" align="right">
					<?
					echo"<p><font size='1'>".$_pagi_navegacion."</p>"; 
					?>
					</td>
				</tr>
				<tr>
					<td colspan="4" style="font-size:11px;">
						<br>
						<input type="hidden" name="cant_check" value="<?=$i?>">
						<input type="hidden" name="accion" value="elim_env">
						<input type="submit" value="Eliminar" class="submit_button"> (Los mensajes seleccionados no irán a la papelera, se eliminaran automáticamente) 
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
