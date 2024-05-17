<?php
require_once(dirname(dirname(__FILE__)) . '/includes/configuracion.php');
require_once(dirname(dirname(__FILE__)) . '/includes/funciones.php');
require_once(dirname(dirname(__FILE__)) . '/login.php');

$id_autor = isset($_POST['variable']) ? (int) $_POST['variable'] : 0;
$id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
$id_user = $_SESSION['id'];
$titulo = isset($_POST['titulo']) ? no_injection($_POST['titulo']) : '';
$mensaje = isset($_POST['cuerpo']) ? no_injection($_POST['cuerpo']) : '';
// $ident = no_injection(htmlentities($_POST['identificador']));
$categoria = isset($_POST['categoria']) ? (int) $_POST['categoria'] : 0;
$privado = isset($_POST['privado']) ? (int) $_POST['privado'] : 0;
$coments = isset($_POST['coments']) ? (int) $_POST['coments'] : 0;
$tags = isset($_POST['tags']) ? no_injection($_POST['tags']) : '';

$sql = "
	SELECT elim, id_autor
	FROM posts
	WHERE id = " . $id;

$request = mysqli_query($con, $sql);

while ($row = mysqli_fetch_array($request)) {	
	$id_autor2 = $row['id_autor'];
	$elim = $row['elim'];
}

// TO-DO: Redireccionar con header()
if ($id_user == $id_autor && $id_user == $id_autor2 && $elim == 0) {
	if ($titulo == '') {
		echo '<script>alert("El t&iacute;tulo es obligatorio");</script>';
?>
<script type="text/javascript">
  location.href = "<?php echo $url; ?>/editar_post/<?php echo $id; ?>/";
</script>
<?php
	} else {
		if ($mensaje == '') {
			echo '<script>alert("El contenido es obligatorio");</script>';
?>
<script type="text/javascript">
	location.href = "<?php echo $url; ?>/editar_post/<?php echo $id; ?>/";
</script>
<?php
		} else {
			if ($categoria == '-1') {
				echo '<script>alert("La categor&iacute;a es obligatoria");</script>';
?>
<script type="text/javascript">
	location.href = "<?php echo $url; ?>/editar_post/<?php echo $id; ?>/";
</script>
<?php
			} else {
				// Grabamos el post en la base de datos
				$sql = "
					UPDATE posts
					SET titulo = '$titulo', contenido = '$mensaje', privado = $privado, coments = $coments, categoria = $categoria, tags = '$tags'
					WHERE id = " . $id;

				mysqli_query($con, $sql);

				header("Location: $url/notificaciones/c6.php?id=$id&c=$categoria&t=$titulo");
			}
		}
	}
} else {
?>	
<script type="text/javascript">
	location.href = "<?php echo $url; ?>/editar_post/<?php echo $id; ?>/";
</script>
<?php
}
?>