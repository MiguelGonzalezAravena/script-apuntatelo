<?php
require_once(dirname(dirname(__FILE__)) . '/includes/configuracion.php');
require_once(dirname(dirname(__FILE__)) . '/login.php');
require_once(dirname(dirname(__FILE__)) . '/includes/funciones.php');

$id_user = $_SESSION['id'];
$id_post = isset($_POST['post']) ? (int) $_POST['post'] : '';

if (isset($id_user)) {
	$sql = "
		SELECT id
		FROM favoritos
		WHERE id_post = " . $id_post . "
		AND id_usuario = " . $id_user;
	$rs = mysqli_query($con, $sql);

	if (mysqli_num_rows($rs) <= 0) {
		$sql = "
			INSERT INTO favoritos (id_post, id_usuario, fecha)
			VALUES (" . $id_post . ", " . $id_user . ", NOW())";

		mysqli_query($con, $sql);
	}
?>
 <script type="text/javascript">
	location.href = "<?php echo $_POST['pag']; ?>";
</script>
<?php
}
?>
 <script type="text/javascript">
	location.href = "..";
</script>