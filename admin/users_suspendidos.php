<?include('../header.php');
include('../includes/configuracion.php');
$id = $_SESSION['id'];
$sql = "SELECT nick, rango FROM usuarios where id='".$id."'";
$rs = mysql_query($sql, $con);
$a = no_injection($_POST['palabra']);
$b = no_injection($_GET['user']);
$action = no_injection($_GET['action']);
$tipo = no_injection($_POST['tipo']);
$row = mysql_fetch_array($rs);
$rango = $row['rango'];
$user = $row['user'];
if ($a=="" and $b!="")
{
	$a=$b;
	$tipo = "usuario";
}
if ($a=="" and $b=="")
{
	$tipo = "ultimos";
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Apuntatelo - Tu link-sharing de apuntes</title>
</head>
<body>
<div class="bordes">
<br>
<font size="2" color="green">
<?
if ($action=="correcto")
echo "El usuario ha sido suspendido.";
if ($action=="correcto2")
echo "El usuario ha sido restaurado.";
?>
<font size="2" color="red">
<?
if ($action=="error")
echo "El usuario se encuentra suspendido. Revise el historial del mismo.";
if ($action=="error2")
echo "No existe el usuario.";
if ($action=="error3")
echo "El usuario NO se encuentra suspendido.";
if ($action=="error4")
echo "Operaci&oacute;n no válida. Revisá no haber dejado alguno de los campos vacíos.";
?>
</font>
<?
if ($rango=="Moderador" or $rango=="Administrador")
{
?>
<table width="325" align="center" cellspacing="0" cellpadding="0">
	<tr>
	<td> 
		<div class="esq1" style="float:left;"></div>
		<div class="franja" style="float:left; width: 309px;"><div style="padding-top:2px;">Buscar suspensiones del usuario:</div></div>
		<div class="esq2" style="float:left;"></div>
	</td>
	</tr>
	<tr>
	<td class="fondo_cuadro" valign="top" style="padding:3px;">
	<form name="buscar" action="../panel/users_suspendidos.php" method="post">
	<table width="300" height="50"><font size="-2"> 
    <tr>
	<td align="center" valign="middle">
	<font size="2" color="black">
	Nick: <input type="text" name="palabra" size="20" MAXLENGTH="200" value="<?echo $a?>"><br><br>
	<input type="radio" name="tipo" value="ultimos" <?if ($tipo!="usuario" and $tipo!="moderador") echo "checked"?>>&Uacute;ltimos
	<input type="radio" name="tipo" value="usuario" <?if ($tipo=="usuario") echo "checked"?>>Usuario 
	<input type="radio" name="tipo" value="moderador" <?if ($tipo=="moderador") echo "checked"?>>Moderador
	<br><br>
	<input type="hidden" name="var" value="1">
	<input type="submit" name="Submit" value="Ver/Buscar">
	</font>
	</td>
	</tr>
	</table> 
	</div>
	</form> 
	</td>
	</tr>
</table>
<br>
<table align="center" width="900" cellspacing="0" cellpadding="0">
<tr>
<td>
	<div class="esq1" style="float:left;"></div>
	<div class="franja" style="float:left; width: 884px;"><div style="padding-top:2px;">Historial de suspensión <?if ($tipo=="usuario") echo "de ".$a; if($tipo=="moderador") echo "realizado por ".$a;?></div></div>
	<div class="esq2" style="float:left;"></div>
</td>
</tr>
<tr>
<td class="fondo_cuadro" valign="top" style="padding:0px;">
<table border="0"  width="900" cellspacing="0" cellpadding="0">
<tr>
<td width="10">
<font size="2" color="black"><b>&nbsp;A</font>
</td>
<td width="125">
&nbsp;<font size="2" color="black"><b>User</b></font>
</td>
<td width="245">
<font size="2" color="black"><b>Especificaciones</b></font>
</td>
<td width="125">
<font size="2" color="black"><b>Moderador</b></font>
</td>
<td width="160">
<font size="2" color="black"><b>Fecha supensión:</b></font>
</td>
<td width="125">
<font size="2" color="black"><b>Moderador</b></font>
</td>
<td width="160">
<font size="2" color="black"><b>Fecha reactivación</b></font>
</td>
</tr>
<?
if ($tipo=="ultimos")
{
	$sql = "SELECT * ";
	$sql.= "FROM suspendidos order by id desc ";
	$rs = mysql_query($sql, $con);
	while($row = mysql_fetch_array($rs))
	{
		$activo = $row['activo'];
		$id = $row['id'];
		$nick = $row['nick'];
		$causa = $row['causa']; 
		$moderador = $row['modera'];
		$fecha1 = $row['fecha1'];
		$activa = $row['activa'];
		$fecha2 = $row['fecha2'];
		?>
		<tr>
		<td>
		<font size="1" color="black">&nbsp;<?echo $activo?></font>
		</td>
		<td>
		&nbsp;<font size="1" color="black"><?echo $nick?></font>
		</td>
		<td>
		<font size="1" color="black"><?echo $causa?></font>
		</td>
		<td>
		<font size="1 color="black"><?echo $moderador?></font>
		</td>
		<td>
		<font size="1" color="black"><?echo $fecha1?></font>
		</td>
		<td>
		<font size="1" color="black"><?echo $activa?></font>
		</td>
		<td>
		<font size="1" color="black"><?echo $fecha2?></font>
		</td>
		</tr>
		<?	
	}
	mysql_close();
}
else if ($tipo=="usuario" or $tipo=="moderador")
{
	$sql2 = "SELECT * ";
	$sql2.= "FROM usuarios where nick='$a' ";
	$rs2 = mysql_query($sql2, $con);
	if (mysql_num_rows($rs2)>0)
	{
		$sql = "SELECT * ";
		if ($tipo=="usuario")
		$sql.= "FROM suspendidos where nick='$a'order by id desc ";
		if ($tipo=="moderador")
		$sql.= "FROM suspendidos where modera='$a' or activa='$a' order by id desc ";
		$rs = mysql_query($sql, $con);
		while($row = mysql_fetch_array($rs))
		{
			$activo = $row['activo'];
			$id = $row['id'];
			$nick = $row['nick'];
			$causa = $row['causa']; 
			$moderador = $row['modera'];
			$fecha1 = $row['fecha1'];
			$activa = $row['activa'];
			$fecha2 = $row['fecha2'];
				
		?>	
			<tr>
			<td>
			<font size="1" color="black">&nbsp;<?echo $activo?></font>
			</td>
			<td>
			&nbsp;<font size="1" color="black"><?echo $nick?></font>
			</td>
			<td>	
			<font size="1" color="black"><?echo $causa?></font>
			</td>
			<td>
			<font size="1" color="black"><?echo $moderador?></font>
			</td>
			<td>
			<font size="1" color="black"><?echo $fecha1?></font>
			</td>
			<td>
			<font size="1" color="black"><?echo $activa?></font>
			</td>
			<td>
			<font size="1" color="black"><?echo $fecha2?></font>
			</td>
			</tr>
		<?
		}
	}
	else
	{
	?><script>alert("El usuario <?echo $a?> no existe!");</script><?
	}
	mysql_close();
}
?>
</table>
</td>
</tr>
</table>
<br>
<table align="center" width="400" cellspacing="0" cellpadding="0">
<tr>
<td>
	<div class="esq1" style="float:left;"></div>
	<div class="franja" style="float:left; width: 384px;"><div style="padding-top:2px;">Suspender a usuario</div></div>
	<div class="esq2" style="float:left;"></div>
</td>
</tr>
<tr>
<td class="fondo_cuadro" valign="top" style="padding:3px;">
<form name="sticky" method="post" action="suspender.php">
&nbsp;<font size="2">Nick: </font><br><input type="text" name="nick" maxlength="20" size="22"><br><br>
&nbsp;<font size="2">Especificaciones: </font><br><textarea name="razon" rows="10" cols="40"></textarea><br><br>
<INPUT input type="button" style="font-size:11px" onclick="if(confirm('&iquest;Seguro queres suspender al usuario?'))this.form.submit();" class="button" NAME='botonsuspender' VALUE='Suspender'>
</form>
</td>
</tr>
<tr>
<td>
</td>
</tr>
</table>
<br>
<table align="center" width="400" cellspacing="0" cellpadding="0">
<tr>
<td>
	<div class="esq1" style="float:left;"></div>
	<div class="franja" style="float:left; width: 384px;"><div style="padding-top:2px;">Restaurar usuario</div></div>
	<div class="esq2" style="float:left;"></div>
</td>
</tr>
<tr>
<td class="fondo_cuadro" valign="top" style="padding:3px;">
<form name="sticky" method="post" action="desuspender.php">
&nbsp;<font size="2">Nick: </font><br><input type="text" name="nick" maxlength="20" size="22"><br><br>
<INPUT input type="button" style="font-size:11px" onclick="if(confirm('&iquest;Seguro queres restaurar al usuario?'))this.form.submit();" class="button" NAME='botonsuspender' VALUE='Restaurar'>
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
?>
</div>
<?
include ('../footer.html');
?>
</body>
</html>
