<?php
require_once(dirname(dirname(__FILE__)) . '/includes/configuracion.php');
require_once(dirname(dirname(__FILE__)) . '/includes/funciones.php');
require_once(dirname(dirname(__FILE__)) . '/login.php');

$id_user = $_SESSION['id'];
$dar = (int) $_POST['cantpuntos'];
$dador = (int) $_POST['dador'];
$id_post = (int) $_POST['id_post'];
$titu = isset($_POST['titu']) ? no_injection($_POST['titu']) : '';
$pag = isset($_POST['pagina']) ? no_injection($_POST['pagina']) : '';
$aux = 1;

if ($dador == $id_user) {
	// Verificar que no haya punteado ya el post
	$sql = "
		SELECT num
		FROM puntos
		WHERE id_punteador = $id_user
		AND num = " . $id_post;

	$request = mysqli_query($con, $sql);
	$rows = mysqli_num_rows($request);

	if (!$rows > 0) {
		$aux = 0;
	}
	
	// Verificar que el dador tenga la cantidad de puntos
	$sql = "
		SELECT puntosdar
		FROM usuarios
		WHERE id = " . $id_user;
	$request = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($request);
	$puntosdar = $row['puntosdar']; 
	
	if (isset($dar) && $dar <= 10 && $dar <= $puntosdar && $dar > 0) {
		if ($aux == 0) {
			// Buscar receptor
			$request = mysqli_query($con, "SELECT id_autor FROM posts WHERE id = " . $id_post);
			$row = mysqli_fetch_array($request);
			$receptor = $row['id_autor'];

			// Actualizar puntos del receptor
			mysqli_query($con, "UPDATE usuarios SET puntos = puntos + $dar WHERE id = " . $receptor);

			// Actualizar puntos del dador
			mysqli_query($con, "UPDATE usuarios SET puntosdar = puntosdar - $dar WHERE id = " . $id_user);

			// Actualizar puntos del post
			mysqli_query($con, "UPDATE posts SET puntos = puntos + $dar WHERE id = " . $id_post);

			// Insertar registro que vincula la puntuación del dador con el post del receptor
			mysqli_query($con, "INSERT INTO puntos (num, id_punteador, puntos, fecha) VALUES ($id_post, $id_user, $dar, NOW())");
		} else {
			echo "<script>alert('S&oacute;lo puedes dar puntos una vez por cada post');</script>";
		}
	}

	if ($dar == "" || $dar == 0) {
		echo "<script>alert('&iexcl;No tienes m&aacute;s puntos!');</script>";
	}
}

mysqli_close($con);
?>
<script type="text/javascript">
  location.href = "<?php echo $pag; ?>";
</script>
