<?
include('../includes/configuracion.php');
include('../includes/funciones.php');
include('../login.php');
$id_user = $_SESSION['id'];
$id_autor = no_injection($_POST["id_autor"]); 
$pag = $_POST["pagina"]; 
if ($id_user==$id_autor)
{
	$nom = no_injection($_POST["nom"]); 
	$num = no_injection($_POST["num"]); 
	$sql = "Update posts Set elim='1' Where id='".$num."'";
	mysql_query($sql);
	$sql = "Update usuarios Set numposts=numposts-'1' where id='".$id_autor."'";
	mysql_query($sql);
	$sql = "Update cantidad Set cant=cant-'1' where id='1'";
	mysql_query($sql);
	mysql_close();
}
?>

	<SCRIPT LANGUAGE="javascript">
       location.href = "<?echo $pag?>";
       </SCRIPT>
