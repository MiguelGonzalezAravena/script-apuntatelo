<?php
//PERFIL
require_once(dirname(dirname(__FILE__)) . '/header.php');
?>
<html>
<head>
<title>Apuntatelo - Tu link-sharing de apuntes</title>
</head>
<body>
<div class="bordes">
<?php
$id = no_injection($_GET["id"]); 
$sql = "SELECT id, nick, rango, puntos, avatar, pais, ciudad, sexo, mensajero, mensaje, fecha, numposts, numcomentarios ";
$sql.= "FROM usuarios where nick='$id'";
$rs = mysqli_query($con, $sql);

if (mysqli_num_rows($rs) >0)
{
while($row = mysqli_fetch_array($rs))
{
	$id_autor = $row['id'];
	?>
	<div align="center">
	<br>
	PERFIL DE <?php echo $row['nick']; ?>
	<br /><br />
	<img src="<?php echo $row['avatar']; ?>">
	<br>
	<br>
	<table>
	<tr>
	<td align="right"><div class="size12"><b>Rango:</b> </div></td><td align="left"><div class="size12"><?php echo $row['rango']; ?></div></td>
	</tr>
	<tr>
	<td align="right"><div class="size12"><b>Usuario N°:</b> </div></td><td align="left"><div class="size12"><?php echo $row['id']; ?></div></td>
	</tr>
<?php
function sexo($valor) {
	$valor = str_replace("m", "Hombre", $valor);
	$valor = str_replace("f", "Mujer", $valor);

	return $valor;
}
?>
	<tr>
	<td align="right"><div class="size12"><b>Sexo:</b></div> </td><td align="left"><div class="size12"><img title="<?php echo sexo($row['sexo']); ?>" src="<?php echo $images; ?>/<?php echo sexo($row['sexo']); ?>.png"></div></td>
	</tr>
	</tr>
<?php
function pais($valor) {
	$valor = str_replace("ar", "Argentina", $valor);
	$valor = str_replace("bo", "Bolivia", $valor);
	$valor = str_replace("br", "Brasil", $valor);
	$valor = str_replace("cl", "Chile", $valor);
	$valor = str_replace("co", "Colombia", $valor);
	$valor = str_replace("cr", "Costa Rica", $valor);
	$valor = str_replace("cu", "Cuba", $valor);
	$valor = str_replace("ec", "Ecuador", $valor);
	$valor = str_replace("es", "Espa&ntilde;a", $valor);
	$valor = str_replace("gt", "Guatemala", $valor);
	$valor = str_replace("it", "Italia", $valor);
	$valor = str_replace("mx", "M&eacute;xico", $valor);
	$valor = str_replace("py", "Paraguay", $valor);
	$valor = str_replace("pe", "Per&uacute;", $valor);
	$valor = str_replace("pt", "Portugal", $valor);
	$valor = str_replace("pr", "Puerto Rico", $valor);
	$valor = str_replace("uy", "Uruguay", $valor);
	$valor = str_replace("ve", "Venezuela", $valor);
	$valor = str_replace("ot", "Otro", $valor);

	return $valor;
}
?>
	<tr>
	<td align="right"><div class="size12"><b>Pa&iacute;s:</b></div> </td><td align="left"><div class="size12"><img title="<?php echo pais($row['pais']); ?>" src="<?php echo $images; ?>/banderas/<?php echo $row['pais']; ?>.png"></div></td>
	</tr>
	</tr>
	<tr>
	<td align="right"><div class="size12"><b>Ciudad:</b> </div></td><td align="left"><div class="size12"><?php echo $row['ciudad']; ?></div></td>
	</tr>
	</tr>
	<tr>
	<td align="right"><div class="size12"><b>Mensajero:</b></div> </td><td align="left"><div class="size12"><?php echo $row['mensajero']; ?></div></td>
	</tr>
	<tr>
	<td align="right"><div class="size12"><b>Mensaje:</b></div> </td><td align="left"><div class="size12"><?php echo $row['mensaje']; ?></div></td>
	</tr>
	<tr>
	<td align="right"><div class="size12"><b>Es usuario desde:</b></div> </td><td align="left"><div class="size12"><?php echo date("d-m-Y H:m:s", strtotime($row['fecha'])); ?></div></td>
	</tr>
	<tr>
	<td align="right"><div class="size12"><b>Puntos:</b></div> </td><td align="left"><div class="size12"><?php echo $row['puntos']; ?></div></td>
	</tr>
	<tr>
	<td align="right"><div class="size12"><b>Posts:</b></div> </td><td align="left"><div class="size12"><?php echo $row['numposts']; ?></div></td>
	</tr>
	<tr>
	<td align="right"><div class="size12"><b>Comentarios:</b></div> </td><td align="left"><div class="size12"><?php echo $row['numcomentarios'];?></div></td>
	</tr>
	</table>
	<br>
	<table width="900" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td colspan="2"> 
				<div class="esq1" style="float:left;"></div>
				<div class="franja" style="float:left; width: 884px;"><div style="padding-top:2px;">&Uacute;ltimos posts</div></div>
				<div class="esq2" style="float:left;"></div>
			</td>
		</tr>

	<?php
	$sql="SELECT id, id_autor, titulo, fecha, privado, categoria, puntos, c.imagen, c.link_categoria
		  FROM posts as p  
		  inner join categorias as c
		  on p.categoria=c.id_categoria
		  where id_autor='$id_autor' and elim='0'
		  ORDER BY id desc
			LIMIT 10";
	$rs = mysqli_query($con, $sql);
	
	while ($row = mysqli_fetch_array($rs)) {
		$privado = $row['privado'];

		$cant = strlen($row['titulo']);
	
		if ($cant > 38) {
			$titulo2=substr(stripslashes($row['titulo']), 0, 38);
			$tit=1;
		} else {
			$titulo2=$row['titulo'];
			$tit=0;
		}
	?>	 
		<tr>
			<td width="420" class="fondo_cuadro" style="padding: 2px;">
				&nbsp;<img src="<?php echo $images; ?>/iconos/<?php echo $row['imagen']; ?>" border="0"><?php if ($privado=="1") { ?>&nbsp;<img src="<?php echo $images; ?>/iconos/candado.gif" border="0"><?php } ?>&nbsp;<a href="<?php echo $url; ?>/posts/<?php echo$row['id']; ?>/<?php echo $row['link_categoria']; ?>/<?php echo corregir($row['titulo']) . ".html"; ?>" title="<?php echo $row['titulo']; ?>"><font size="2" color="black"><?php echo $titulo2; if ($tit==1) { echo "..."; } ?></font></a>
			</td>
			<td class="fondo_cuadro" align="right" style="padding: 2px;">
				<font size="1">
				Puntos:
				<?php echo $row['puntos']; ?>
				|
				Fecha: 
				<?php echo date("d-m-Y H:m:s", strtotime($row['fecha'])); ?>&nbsp;				
				</font>
			</td>
		</tr>
<?php
	}
?>
	<tr>
	<td>
	<a href="<?php echo $url; ?>/perfil/verposts.php?id=<?php echo $id; ?>"><font size="2" color="black">Ver todos!</font></a>
	</td>
	</tr>
	</table>
	</div>
	<br>
	<br>
<?php
}

require_once(dirname(dirname(__FILE__)) . '/footer.php');
} else {
?>
Password incorrecto
			<SCRIPT LANGUAGE="javascript">
       		location.href = "..";
       		</SCRIPT> 
<?php
}
?>
</div>
</body>
</html>