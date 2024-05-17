<?php
require_once(dirname(dirname(__FILE__)) . '/includes/configuracion.php');
require_once(dirname(dirname(__FILE__)) . '/includes/funciones.php');
require_once(dirname(dirname(__FILE__)) . '/login.php');
$num = (int) $_POST['num'];
$pag = isset($_POST['pagina']) ? no_injection($_POST['pagina']) : '/';
$autor = no_injection($_POST['variable']);
$id_autor = (int) $_POST['variable2'];
$user = $_SESSION['user'];
$id_user = $_SESSION['id'];
$comment = isset($_POST['cuerpo']) ? no_injection($_POST['cuerpo']) : '';

$sql = "
	SELECT coments
	FROM posts
	WHERE id = " . $num;
$rs = mysqli_query($con, $sql);
while ($row = mysqli_fetch_array($rs)) {
	$coments = $row['coments'];
}

// $comment = quitar($coment);

// Guardar el mensaje
if ($num == "" || $autor == "" || $id_autor != $id_user || $autor != $user || $coments != 0) {
?>
<script type="text/javascript">
	location.href = "..";
</script>
<?php
} else {
	mysqli_query($con, "UPDATE posts SET comentarios = comentarios + 1 WHERE id = " . $num);
	mysqli_query($con, "UPDATE usuarios SET numcomentarios = numcomentarios + 1 WHERE id = " . $id_user);
	mysqli_query($con, "UPDATE cantidad SET cant = cant + 1 WHERE id = 2");

	// TO-DO: Agregar registro a tabla "cantidad" donde el id 2 es para comentarios
	
	$sql = "
		INSERT INTO comentarios (id_post, id_autor, autor, comentario, fecha)
		VALUES ($num, $id_autor, '" . $autor . "', '" . $comment . "', NOW())";

	mysqli_query($con, $sql) or die("Error al guardar el comentario: " . mysqli_error($con));
	$ult_id = mysqli_insert_id($con);
?>
<script type="text/javascript">
	location.href = "<?php echo $pag; ?>";
</script>
<?php
}
?>


