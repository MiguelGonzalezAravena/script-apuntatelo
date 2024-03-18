<?
$sql2 = "select id_carpeta, nom_carpeta from carpetas where id_usuario='".$id_user."'";
$rs2 = mysql_query($sql2,$con);
?>
<table cellpadding="0" cellspacing="0" width="167" align="center" border="0" style="font-size: 13px;">
	<tr>
		<td> 
			<div class="esq1" style="float:left;"></div>
			<div class="franja" style="float:left; width: 151px;"><div style="padding-top:2px;">Men&uacute;</div></div>
			<div class="esq2" style="float:left;"></div>
		</td>
	</tr>
	<tr class="fondo_cuadro">
		<td style="padding-left:5px;">
		<br>
		<a href="redactar.php" style="color:#000000;">Redactar</a>
		</td>
	</tr>
	<tr class="fondo_cuadro">
		<td style="padding-left:5px;">
		<a href="../mensajes/" style="color:#000000;">Recibidos</a>
		</td>
	</tr>
	<tr class="fondo_cuadro">
		<td style="padding-left:5px;">
		<a href="enviados.php" style="color:#000000;">Enviados</a>
		</td>
	</tr>
	<tr class="fondo_cuadro">
		<td style="padding-left:5px;">
		<a href="papelera.php" style="color:#000000;">Papelera</a>
		</td>
	</tr>
	<tr class="fondo_cuadro">
		<td style="padding-left:5px;">
			<br><br>
		</td>
	</tr>
</table>