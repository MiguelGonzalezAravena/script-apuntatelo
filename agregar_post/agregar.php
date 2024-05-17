<?php
require_once(dirname(dirname(__FILE__)) . '/includes/configuracion.php');
require_once(dirname(dirname(__FILE__)) . '/includes/funciones.php');
require_once(dirname(dirname(__FILE__)) . '/login.php');

$id_autor = isset($_POST['variable']) ? (int) $_POST['variable'] : 0;
$id_autor2 = $_SESSION['id'];
$titulo = isset($_POST['titulo']) ? no_injection($_POST['titulo']) : '';
$mensaje = isset($_POST['cuerpo']) ? no_injection($_POST['cuerpo']) : '';
// $ident = no_injection(htmlentities($_POST['identificador']));
$categoria = isset($_POST['categoria']) ? (int) $_POST['categoria'] : 0;
$privado = isset($_POST['privado']) ? (int) $_POST['privado'] : 0;
$coments = isset($_POST['coments']) ? (int) $_POST['coments'] : 0;
$tags = isset($_POST['tags']) ? no_injection($_POST['tags']) : '';

// print_r($_POST);
// die();
if ($id_autor == $id_autor2) {
	if ($titulo == '') {
		echo "<script>alert('El t&iacute;tulo es obligatorio');</script>";
?>
<script type="text/javascript">
	location.href = "<?php echo $url; ?>/agregar_post/";
</script>
<?php
	} else {
		if ($mensaje == '') {
			echo '<script>alert("El contenido es obligatorio");</script>';
?>
<script type="text/javascript">
	location.href = "<?php echo $url; ?>/agregar_post/";
</script>
<?php
		} else {
			if ($categoria == '-1') {
				echo '<script>alert("La categor&iacute;a es obligatoria");</script>';
?>
<script type="text/javascript">
	location.href = "<?php echo $url; ?>/agregar_post/";
</script>
<?php
			} else {
				$elim = 0;
				$comentarios = 0;

				// Grabamos el post en la base.
				$sql = "
					INSERT INTO posts (elim, id_autor, titulo, contenido, fecha, privado, coments, comentarios, categoria, tags) 
					VALUES ($elim, $id_autor, '$titulo', '$mensaje', NOW(), $privado, $coments, $comentarios, $categoria, '$tags')";
				mysqli_query($con, $sql) or die('Error al publicar el post: ' . mysqli_error($con));

				$ult_id = mysqli_insert_id($con);

				mysqli_query($con, "UPDATE usuarios SET numposts = numposts + 1 WHERE id = " . $id_autor);
				mysqli_query($con, "UPDATE cantidad SET cant = cant + 1 WHERE id = 1");

				header('Location: ' . $url . '/notificaciones/c5.php?id=' . $ult_id . '&c=' . $categoria . '&t=' . $titulo);	
			}
		}
	}
} else {
?>	
<script type="text/javascript">
	location.href = "<?php echo $url; ?>/agregar_post/";
</script>
<?php
}
?>