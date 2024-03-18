<?
include('../includes/configuracion.php');
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
			if(inputs.item(i).type=='checkbox' && inputs.item(i).name.substring(0,2)=='i_')
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
$sql = "update mensajes set eliminado_receptor='1' where id_receptor='".$id_user."' and papelera_receptor='1' and (UNIX_TIMESTAMP(NOW())-UNIX_TIMESTAMP(fecha_papelera))>864000";
mysql_query($sql);
$_pagi_sql = "select m.id_mensaje, m.asunto, m.fecha, m.id_receptor, m.leido_receptor, s.nick
		from mensajes as m
		inner join usuarios as s
		on m.id_emisor = s.id
		where m.id_receptor = '".$id_user."' and m.papelera_receptor='1' and m.eliminado_receptor='0'
		order by id_mensaje desc
		";
$_pagi_cuantos = 10; 
include('paginator.inc.php');
?>
<br>
<form name="entrada" method="POST" action="acciones.php">
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
						<div class="franja" style="float:left; width: 634px;"><div style="padding-top:2px;">Papelera *</div></div>
						<div class="esq2" style="float:left;"></div>
					</td>
				</tr>
				<tr style="font-size:11px; background-color: #ababab;">
					<td width="50">
					<input type="checkbox" alt="Seleccionar todos" onclick="mensajes_check_all(this.checked)">
					</td>
					<td width="250" >
					Asunto
					</td>
					<td width="200"> 
					Remitente
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
					<tr style="font-size:11px; background-color: <?if($row['leido_receptor']==0) echo "#fff3bf;"; else echo "#d3d3d3;";?>">
					<td width="50">
					<input type="checkbox" name="i_<?=$i?>" value="<?=$row['id_mensaje']?>">
					</td>
					<td width="250" >
					<a href="mensajes_recibidos.php?mensaje=<?=$row['id_mensaje']?>" alt="Ver mensaje"><?=htmlentities($row['asunto'])?></a>
					</td>
					<td width="200"> 
					<a href="../perfil/?id=<?=$row['nick']?>" alt="Ver Perfil"><?=$row['nick']?></a>
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
					<td valign="top" colspan="2" align="right">
					<br>
					<select name="accion">
					<option value="rest">Restaurar</option>
					<option value="elim_def">Eliminar Definitivamente</option>
					</select>&nbsp;&nbsp;
					</td>
					<td valign="top">
					<br>
					<input type="hidden" name="cant_check" value="<?=$i?>">
					<input type="submit" value="ok"  class="submit_button">
					</td>
				</tr>
				<tr>
					<td colspan="3" style="font-size:10px;">
					<br>
					* Los mensajes se auto-eliminaran después de 10 días en la papelera.
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</form>
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
