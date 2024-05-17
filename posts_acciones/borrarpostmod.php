<?php
require_once(dirname(dirname(__FILE__)) . '/includes/configuracion.php');
require_once(dirname(dirname(__FILE__)) . '/includes/funciones.php');
require_once(dirname(dirname(__FILE__)) . '/login.php');

$id_user = $_SESSION['id'];
$id_autor = (int) $_POST['id_autor'];
$num = (int) $_POST['num']; 
$pag = isset($_POST['pagina']) ? no_injection($_POST['pagina']) : '';
$causa = isset($_POST['causa']) ? no_injection($_POST['causa']) : '';

$sql = "
	SELECT rango
	FROM usuarios
	WHERE id = " . $id_user;

$request = mysqli_query($con, $sql);
while ($row = mysqli_fetch_array($request)) {	
	$rango = $row['rango'];
}

if ($rango == 'Administrador' || $rango == 'Moderador') {
	mysqli_query($con, "INSERT INTO posts_eliminados (id_modera, id_post, causa, fecha) VALUES ($id_user, $num, '" . $causa . "', NOW())") or die("Error al borrar el post como moderador o administrador: " . mysqli_error($con));
	mysqli_query($con, "UPDATE posts SET elim = 1 WHERE id = " . $num);
	mysqli_query($con, "UPDATE usuarios SET numposts = numposts - 1 WHERE id = " . $id_autor);
	mysqli_query($con, "UPDATE cantidad SET cant = cant - 1 WHERE id = 1");
	mysqli_close($con);
}
?>
<script type="text/javascript">
	location.href = "<?php echo $pag; ?>";
</script>
