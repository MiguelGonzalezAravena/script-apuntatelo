<?php
require_once(dirname(dirname(__FILE__)) . '/header.php');

$id = $_GET['id'];
$titulo = $_GET['t'];
$categoria = $_GET['c'];

switch ($categoria) {
	case "0": 
		$cat = "Apuntes";
		break;
	case "1":
		$cat = "Examenes";
		break;
	case "2":
		$cat = "Info-Universidades";
		break;
	case "3":
		$cat = "Softs-Estudiantiles";
		break;
}
?>
<html>
<head>
<title>Apuntatelo - Tu link-sharing de apuntes</title>
</head>
<body>
<div class="bordes">
<table width="100%" height="365" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="25%" height"120" align="center" valign="top">
</td>
<td>
</td>
<td>
</td>
</tr>

<tr>
<td width="35%" height="30%" align="center">
</td>
<td width="30%" height="35%" align="left" valign="top" class="fondo_cuadro">
	<table cellpadding="0" cellspacing="0" width="387" align="center" border="0">
		<tr>
			<td></td>
			<td> 
				<div class="esq1" style="float: left;"></div>
				<div class="franja" style="float: left; width: 371px;"><div style="padding-top: 2px;">Listo!</div></div>
				<div class="esq2" style="float: left;"></div>
			</td>
		</tr>
	</table>
	<br>
	<div align="center" style="font-size:12px;">Tu post ha sido agregado<br><br>
	<a href="<?php echo $url; ?>"><font color="blue">Ir a Inicio</font></a> - 
	<a href="<?php echo $url; ?>/posts/<?php echo $id; ?>/<?php echo $cat; ?>/<?php echo corregir($titulo) . ".html"; ?>"><font color="blue">Ir al Post</font></a>
	<H3></div> 
	<br>
</td>
<td width="35%" height="30%" align="center">
</td>
</tr>

<tr>
<td width="25%" height="30%" align="center">
</td>
<td>
</td>
<td>
</td>
</tr>
</table>
<?php
require_once(dirname(dirname(__FILE__)) . '/footer.php');
?>
</div>
</body>
</html>