<?php
$sql = "SELECT * ";
$sql .= "FROM usuarios where id='$id_autor'";
$rs = mysqli_query($con, $sql);

$row = mysqli_fetch_array($rs);
$nick = $row['nick'];

if ($row['rango'] == "Administrador") {
	$color = "red";
} elseif ($row['rango'] == "Moderador") {
	$color = "blue";
} elseif ($row['rango'] == "Usuario Destacado") {
	$color = "green";
} else {
	$color = "black";
}

$cant = strlen($nick);

if($cant > 18) {
	$nick2 = substr(stripslashes($nick), 0, 15);
	$nick2 = $nick2 . "...";
} else {
	$nick2 = $nick;
}

function rango($valor) {
	global $images;
		
	$valor = str_replace("Administrador", "<br clear=\"left\" /><img src=\"" . $images . "/rangos/administrador.png\" alt=\"Administrador\" title=\"Administrador\" />", $valor);

	return $valor;
}

function pais($valor)
{
					
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

function sexo($valor)
{
					
$valor = str_replace("m", "Hombre", $valor);
$valor = str_replace("f", "Mujer", $valor);


return $valor;
}
?>
<div class="box_title" style="height:21px; width:160px;">
	<div class="box_txt" style="width:160px; text-align:left;">
		<div class="esq1" style="float:left;"></div>
		<div style="float:left; padding-top: 4px;">Posteado por:</div>
		<div class="esq2" style="float:right;"></div>
	</div>
</div>
<div align="left">
<div class="box_perfil" <?php $iexp = $_SERVER['HTTP_USER_AGENT']; if (strstr($iexp, "MSIE")) { echo 'style="width:160px;"'; } ?>>
	<img src="<?php echo $row['avatar']; ?>" style="display:block; margin: auto;" border="0" alt="" title="">
	<b class="txt"><?php echo "<a href='" . $url . "/perfil/" . $nick . "/'><font color='" . $color . "'><b>" . $nick2 . "</b></font></a>"; ?></b>
	<font size="1"><?php echo $row['rango']; ?><br />
	<?php echo rango($row['rango']); ?> <img title="<?php echo sexo($row['sexo']); ?>" src="<?php echo $images; ?>/<?php echo sexo($row['sexo']);?>.png" /> <img title="<?php echo pais($row['pais']); ?>" src="<?php echo $images; ?>/banderas/<?php echo $row['pais']; ?>.png" /><hr />
	<?php echo $row['numposts']; ?> Posts<br />
	<?php echo $row['numcomentarios']; ?> Comentarios<br />
	<?php echo $row['puntos']; ?> Puntos<br />
	<?php if (isset($_SESSION['id'])) { ?>
	
	<hr>
	<a href='/mensajes/redactar.php?para=<?php echo $nick; ?>'><img src='<?php echo $images; ?>/mp.png'> Enviar mensaje</a>
	<?php } ?>
	</font>
</div>						
</div>
