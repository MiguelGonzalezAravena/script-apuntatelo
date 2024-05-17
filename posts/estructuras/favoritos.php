<?php
if (isset($_SESSION['user'])) {
	$sql = "select id from favoritos where id_post=".$id." and id_usuario=".$_SESSION['id'];
	$rs = mysqli_query($con, $sql);
	if (mysqli_num_rows($rs) <= 0) {
		?>
		<form name="favoritos" method="POST" action="<?php echo $url; ?>/favoritos/insertar.php">
		<input type="hidden" name="pag" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
		<input type="hidden" name="post" value="<?php echo $id; ?>">
		<div style="font-size: 11px; text-align: center;"><img src="<?php echo $images; ?>/iconos/favoritos_a.png"> <a href="#" onclick="javascript: document.favoritos.submit();" style="color:#000000;">Agregar a favoritos</a></div>
		</form>
		<?php
	} else {
		echo "<div style=\"font-size: 11px; text-align: center;\">El post ya se encuentra en favoritos</div>";
	}
}
?>