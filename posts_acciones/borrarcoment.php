<?php
require_once(dirname(dirname(__FILE__)) . '/includes/configuracion.php');
require_once(dirname(dirname(__FILE__)) . '/includes/funciones.php');

$idcoment = (int) $_POST['idcoment'];
$idpost = (int) $_POST['idpost'];
$causa = isset($_POST['causa']) ? no_injection($_POST['causa']) : '';
$mod = isset($_POST['mod']) ? no_injection($_POST['mod']) : '';
$id_mod = (int) $_POST['id_mod'];
$elim = 1;
$pag = isset($_POST['pagina']) ? no_injection($_POST['pagina']) : '';

mysqli_query($con, "UPDATE comentarios SET elim = $elim, id_modera = $id_mod, modera = '" . $mod . "', causa = '" . $causa . "' WHERE id = " . $idcoment);
mysqli_query($con, "UPDATE cantidad SET cant = cant - 1 WHERE id = 2");
mysqli_close($con);
?>
<script type="text/javascript">
  location.href = "<?php echo $pag; ?>";
</script>