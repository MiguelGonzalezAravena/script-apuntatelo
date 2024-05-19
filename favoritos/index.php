<?php
// FAVORITOS
require_once(dirname(dirname(__FILE__)) . '/header.php');

$var2 = 0;
$action = isset($_GET['action']) ? $_GET['action'] : '';
$categoria = isset($_GET['categoria']) ? $_GET['categoria'] : '';

if ($categoria == "") {
	$categoria = "-1";
}

$cadena_categoria = "";
if ($categoria >= 0 && $categoria <= 6 && is_numeric($categoria)) {
	$cadena_categoria = " AND p.categoria = '".$categoria."'";
}


$orden = isset($_GET['orden']) ? $_GET['orden'] : '';
$cadena_orden = "ORDER BY f.fecha DESC";

if ($orden >= 1 && $orden <= 3 && is_numeric($categoria)) {
	switch($orden) {
		case 1:
			$cadena_orden = " ORDER BY f.fecha DESC";
			break;
		case 2:
			$cadena_orden = " ORDER BY p.fecha DESC";
			break;
		case 3:
			$cadena_orden = " ORDER BY p.puntos DESC";
			break;
	}
}
?>

<html>
<head>
<title>Apuntatelo - Tu link-sharing de apuntes</title>
</head>
<body>

<?php
if (isset($_SESSION['user'])) {
	$_pagi_sql = "
		SELECT f.id, f.id_post, f.fecha AS fecha_guardado, p.titulo, p.privado, p.fecha AS fecha_creado, p.puntos, c.imagen, c.link_categoria, u.nick
		FROM favoritos AS f
		INNER JOIN posts AS p
		ON p.id = f.id_post
		INNER JOIN categorias AS c
		ON p.categoria = c.id_categoria
		INNER JOIN usuarios AS u
		ON u.id = p.id_autor
		WHERE p.elim = 0
		AND f.id_usuario = " . $_SESSION['id'] . $cadena_categoria . " " . $cadena_orden;

	$_pagi_cuantos = 20;
	$_pagi_nav_num_enlaces = 3;
	require_once(dirname(dirname(__FILE__)) . '/includes/paginator.inc.php');
	?>
	<div class="bordes">
	<br>
	<div align="center"></div>
	<br>
	<div  style="min-height: 300px;">
		<table width="900" align="center" border="0" cellspacing="0" cellpadding="0" style="font-size:11px;">
			<tr>
				<td colspan="5">  
					<div class="esq1" style="float: left;"></div>
					<div class="franja" style="float: left; width: 884px;"><div style="padding-top: 2px;">Filtro</div></div>
					<div class="esq2" style="float: left;"></div>
				</td>
			</tr>
			<tr class="fondo_cuadro" align="right">
				<form name="filtrar" method="GET" action="">
					<td  width="350" style="padding: 3px; padding-left: 5px;">
						Ordenar por:
						<select name="orden" style="font-size: 12px;">
							<option value="1" <?php if ($orden==1) { echo "selected='true'"; } ?>>Fecha guardado</option>
							<option value="2" <?php if ($orden==2) { echo "selected='true'"; } ?>>Fecha creado</option>
							<option value="3" <?php if ($orden==3) { echo "selected='true'"; } ?>>Puntos</option>
						</select>
					</td>
					<td width="220" align="left">
						|
						Categor&iacute;a:
						<select id="categoria" name="categoria" style="font-size:12px;">
							<option value="-1"><div class="size11" style="font-weight:bold;">Todas...</div></option>
							<?php
								$request = mysqli_query($con, "SELECT id_categoria, nom_categoria FROM categorias ORDER BY nom_categoria ASC");
								while ($row = mysqli_fetch_array($request)) {
							?>
							<option value="<?php echo $row['id_categoria']; ?>" <?php if ($categoria == $row['id_categoria']) { echo "selected='selected'"; } ?>><?php echo $row['nom_categoria']; ?></option>
							<?php
								}
							?>
						</select>
					</td>
					<td align="left">
						<input type="submit" class="submit_button" value="Filtrar" />
					</td>
				</form>
			</tr>
		</table>
		<br />
		<form name="favoritos" method="POST" action="<?php echo $url; ?>/favoritos/eliminar.php">
		<input type="hidden" name="pag" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
		<table width="900" align="center" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td colspan="5">  
					<div class="esq1" style="float: left;"></div>
					<div class="franja" style="float: left; width: 884px;"><div style="padding-top: 2px;">Mis favoritos</div></div>
					<div class="esq2" style="float: left;"></div>
				</td>
			</tr>
<?php
$i = 0;
if ($_pagi_totalReg > 0) {
	while ($row = mysqli_fetch_array($_pagi_result)) {
		$id_favorito = $row['id'];
		$fecha_guardado = $row['fecha_guardado'];
		$fecha_creado = $row['fecha_creado'];
		$id_post = $row['id_post'];
		$titulo = $row['titulo'];
		// $categoria = $row['categoria'];
		$imagen = $row['imagen'];
		$link_categoria = $row['link_categoria'];
		$nick = $row['nick'];
		$puntos = $row['puntos'];
		$privado = $row['privado'];
		$cant = strlen($titulo);
		
		if ($cant > 30) {
			$titulo2 = substr(stripslashes($titulo), 0, 30);
			$tit = 1;
		} else {
			$titulo2 = $titulo;
			$tit = 0;
		}
		?>
			<tr class="fondo_cuadro" style="font-size: 11px;">
				<td width="300">
					&nbsp;<img src="<?php echo $images; ?>/iconos/<?php echo $imagen; ?>" border="0" width="15"><?php if ($privado == "1") { ?>&nbsp;<img src="<?php echo $images; ?>/iconos/candado.gif" border="0" width="15"><?php } ?>
					&nbsp;<a href="<?php echo $url; ?>/posts/<?php echo $id_post; ?>/<?php echo $link_categoria; ?>/<?php echo corregir($titulo) . ".html"; ?>" title="<?php echo $titulo; ?>"><font size="2" color="black"><?php echo $titulo2; if ($tit==1) echo"..."; ?></font></a>
				</td>
				<td align="left" width="280">
					Posteado por <?php echo $nick; ?> el <?php echo date("d-m-Y", strtotime($fecha_creado)); ?>
				</td>
				<td align="left" width="60">
					<?php echo $puntos; ?> pts
				</td>
				<td align="right" width="200">
					Guardado: <?php echo date("d-m-Y H:m:s", strtotime($fecha_guardado)); ?>&nbsp;						
				</td>
				<td width="30" align="right">
					<input type="checkbox" name="i_<?php echo $i; ?>" value="<?php echo $id_favorito; ?>">
				</td>
			</tr>
<?php
				$i++;
	}
} else {
?>
			<tr class="fondo_cuadro" style="font-size: 11px;">
				<td width="300" align="center" style="height:20px;">
					No tienes favoritos
				</td>
			</tr>
<?php
}
?> 
			<tr>
				<td align="right" colspan="5">
					<?php echo "<p><font size='1'>" . $_pagi_navegacion . "</font></p>"; ?> 
				</td>
			</tr>
			<tr>
				<td align="right" colspan="5">
					<br>
					<input type="hidden" name="cant_check" value="<?php echo $i; ?>" />
					<input type="submit" value="Eliminar seleccionados" class="submit_button" />
				</td>
			</tr>
		</table>
	</form>
	</div>
<?php
} else {
	echo ' <script type="text/javascript">
			location.href = "/";
		</script>';
	require_once(dirname(dirname(__FILE__)) . '/footer.php');
}
?>
</div> 
</div>		
		
