<?
include("../header.php");
$id = $_GET['id'];
$titulo = $_GET['t'];
$categoria = $_GET['c'];
switch($categoria){
case "0": 
$cat="Apuntes";
break;
case "1":
$cat="Examenes";
break;
case "2":
$cat="Info-Universidades";
break;
case "3":
$cat="Softs-Estudiantiles";
break;
case "4":
$cat="Ebooks";
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
				<div class="esq1" style="float:left;"></div>
				<div class="franja" style="float:left; width: 371px;"><div style="padding-top:2px;">Listo!</div></div>
				<div class="esq2" style="float:left;"></div>
			</td>
		</tr>
	</table>
	<br>
	<div align="center" style="font-size:12px;"><font size="2">Tu post ha sido editado</font><br><br>
	<a href=".."><font color="blue">Ir a Inicio</font></a> - 
	<a href="/posts/<?echo $id;?>/<?echo $cat?>/<?echo corregir($titulo).".html"?>"><font color="blue">Ir al Post</font></a>
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

<?
include ('../footer.html');
?>
</div>

</body>
</html>
