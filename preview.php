<?php
require_once(dirname(__FILE__) . '/includes/configuracion.php');
require_once(dirname(__FILE__) . '/includes/funciones.php');

function rango($valor) {
	global $images;

	$valor = str_replace("Administrador", "
		<br clear=\"left\" />Administrador
		<br clear=\"left\" />
		<span style=\"position:relative;\"></span>
		<span style=\"position:relative;\">
			<img src=\"" . $images . "/rangos/administrador.png\" alt=\"Administrador\" title=\"Administrador\" />
		</span>", $valor);

	return $valor;
}

$tipo = $_POST['tipo'];
$id = $_POST['id'];
$cuerpo = $_POST['cuerpo'];
$cuerpo = stripslashes($cuerpo);
$titulo = trim($_POST['titulo']);
$titulo = str_replace('\"','"',$titulo);
$titulo = str_replace("\'","'",$titulo);
$id_autor = isset($_POST['variable']) ? (int) $_POST['variable'] : 0;
$categoria = $_POST['categoria'];
$tags = trim($_POST['tags']);

$cant = strlen($titulo);

if ($cant > 50) {
	$titulo2 = substr(stripslashes($titulo), 0, 50);
	$tit = 1;
} else {
	$titulo2 = $titulo;
	$tit = 0;
}

$coments = $_POST['coments'];

if (isset($coments) && $coments != 0 && $coments!=1) {
	$coments = 0;
}

$privado = $_POST['privado'];

if (isset($privado) && $privado!=0 && $privado!=1) {
	$privado = 0;
}

?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="<?php echo $url; ?>/estilos/posts.css" />
	</head>
	<body>
		<div id="maincontainer">	
			<div id="cuerpocontainer">
				<div id="post-izquierda" style="_margin-left: <?php $iexp = $_SERVER['HTTP_USER_AGENT']; if(strstr($iexp,"MSIE 6")){echo "10px;";}else{echo "20px";}?>;">
<?php
$sql = "
	SELECT id, rango, nick, puntos, avatar, numposts AS posts, numcomentarios AS comentarios
	FROM usuarios
	WHERE id = " . $id_autor;

$request = mysqli_query($con, $sql);

while ($row = mysqli_fetch_array($request)) {
	$nick = $row['nick'];

	switch($row['rango']) {
		case 'Administrador':
			$color = 'red';
			break;
		case 'Moderador':
			$color = 'blue';
			break;
		case 'Usuario Destacado':
			$color = 'green';
			break;
		default:
			$color = 'black';
	}
?>
					<div class="box_title" style="height: 21px; width: 160px; background-color: #000000;">
						<div class="box_txt" style="width: 160px; text-align: left;">
							<div class="esq1" style="float: left;"></div>
							<div style="float: left; padding-top: 4px; color: #ffffff;">Posteado por:</div>
							<div class="esq2" style="float: right;"></div>
						</div>
					</div>
					<div class="box_perfil">
						<img src="<?php echo $row['avatar']; ?>" width="120" weight="120" style="display: block; margin: auto;" border="0" alt="" title="" />
						<b class="txt">
							<?php echo '<a href="' . $url . '/perfil.php?id=' . $nick . '"><font size="2" color="' . $color . '"><b>' . $nick . '</b></font></a>'; ?>
						</b>
						<font size="1">
							<br clear="left"><?php echo rango($row['rango']); ?>
							<br clear="left">User Nro: <?php echo $row['id']; ?>
							<br clear="left">
							<hr />
							Posts: <?php echo $row['posts']; ?><br clear="left" />
							Comentarios: <?php echo $row['comentarios']; ?><br clear="left" />
							Puntos: <?php echo $row['puntos']; ?><br clear="left" />
							<hr />
						</font>
					</div>
<?php
}

mysqli_close($con);
?>
					<br clear="left" />
				</div>
				<div id="post-centro">
					<div class="fondo_cuadro">
						<div style="width: 781px; float: left; text-align: center; font-size: 13px;">
							<div class="esq1" style="float: left;"></div>
							<div  class="franja" style="float: left; width: 765px; text-align: center;">
								<div style="padding-top:2px;">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $titulo2; if ($tit==1) echo"..."; ?>&nbsp;&nbsp;&nbsp;&nbsp;</div>
							</div>
							<div class="esq2" style="float:right;"></div>
						</div>
						<div style="width: 781px; font-size: 13px; text-align: left;">
							<div style="padding: 5px;"><?php echo BBparse($cuerpo); ?></div>
						</div>
					</div>
				</div>
<?php
$cuerpo = str_replace('"','&#34;', $cuerpo);
$cuerpo = str_replace("'","&#39;", $cuerpo);
$titulo = str_replace('"','&#34;', $titulo);
$titulo = str_replace("'","&#39;", $titulo);

if ($tipo == 0 && $id = '-1') {
?>
				<form name="reg" action="<?php echo $url; ?>/agregar_post/agregar.php" method="post">
					<input type="hidden" name="variable" value="<?php echo $id_autor; ?>" />
					<input type="hidden" name="titulo" value="<?php echo $titulo; ?>" />
					<input type="hidden" name="cuerpo" value="<?php echo $cuerpo; ?>" />
					<input type="hidden" name="categoria" value="<?php echo $categoria; ?>" />
					<input type="hidden" name="tags" value="<?php echo $tags; ?>" />
					<input type="hidden" name="privado" value="<?php echo $privado; ?>" />
					<input type="hidden" name="coments" value="<?php echo $coments; ?>" />
					<input type="button" onclick="kill_preview()" class="submit_button" name="Submit2" value="Cerrar" />
					<input type="button" onclick="submit();" class="submit_button" name="botoncrear" value="Crear post" />
				</form>
<?php
} else if ($tipo == 1 && $id != '-1') {
?>
				<form name="reg" action="<?php echo $url; ?>/editar_post/editar.php" method="post">
					<input type="hidden" name="variable" value="<?php echo $id_autor; ?>" />
					<input type="hidden" name="id" value="<?php echo $id; ?>" />
					<input type="hidden" name="titulo" value="<?php echo $titulo; ?>" />
					<input type="hidden" name="cuerpo" value="<?php echo $cuerpo; ?>" />
					<input type="hidden" name="categoria" value="<?php echo $categoria; ?>" />
					<input type="hidden" name="tags" value="<?php echo $tags; ?>" />
					<input type="hidden" name="privado" value="<?php echo $privado; ?>" />
					<input type="hidden" name="coments" value="<?php echo $coments; ?>" />
					<input type="button"  onclick="kill_preview()" class="submit_button" name="Submit2" value="Cerrar" />
					<input type="button"  onclick="if(confirm('&iquest;Seguro que deseas editar el post?'))this.form.submit();" class="submit_button" name="botoneditar" value="Editar post" />
				</form>
<?php
} else {
?>
<script type="text/javascript">
	location.href = "..";
</script>
<?php
}
?>
			</div>
		</div>
	</body>
</html>