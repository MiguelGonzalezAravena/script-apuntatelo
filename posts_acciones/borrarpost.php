<?php
require_once(dirname(dirname(__FILE__)) . '/includes/configuracion.php');
require_once(dirname(dirname(__FILE__)) . '/includes/funciones.php');
require_once(dirname(dirname(__FILE__)) . '/login.php');

$id_user = $_SESSION['id'];
$id_autor = (int) $_POST['id_autor'];
$num = (int) $_POST['num']; 
$pag = isset($_POST['pagina']) ? no_injection($_POST['pagina']) : '';

if ($id_user == $id_autor) {
	// TO-DO: Agregar registro a tabla "cantidad" donde el id 1 es para posts
	mysqli_query($con, "UPDATE posts SET elim = '1' WHERE id = " . $num);
	mysqli_query($con, "UPDATE usuarios SET numposts = numposts - 1 WHERE id = " . $id_autor);
	mysqli_query($con, "UPDATE cantidad SET cant=cant-'1' WHERE id = 1");
	mysqli_close($con);
}
?>
<script type="text/javascript">
	location.href = "<?php echo $pag; ?>";
</script>