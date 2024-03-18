<?
include('../includes/configuracion.php');
include('../includes/funciones.php');
$idcoment = no_injection($_POST["idcoment"]);
$idpost = no_injection($_POST["idpost"]);
$causa = no_injection($_POST["causa"]);
$mod = no_injection($_POST["mod"]);
$id_mod = no_injection($_POST["id_mod"]);
$elim=1;
$pag = $_POST["pagina"];
$sql = "Update comentarios Set elim='".$elim."', id_modera='".$id_mod."', modera='".$mod."', causa='".$causa."' Where id='".$idcoment."'"; 	
mysql_query($sql);
$sql = "Update cantidad Set cant=cant-'1' where id='2'";
mysql_query($sql);
mysql_close($con);
?>

<SCRIPT LANGUAGE="javascript">
       location.href = "..<?echo$pag?>";
       </SCRIPT>