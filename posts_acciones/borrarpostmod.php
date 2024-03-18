<?
include('../includes/configuracion.php');
include('../includes/funciones.php');
include('../login.php');
$id_user = $_SESSION['id'];
$id_autor = no_injection($_POST["id_autor"]);
$pag = $_POST["pagina"];
$sql = "SELECT rango FROM usuarios where id='".$id_user."'";
$rs = mysql_query($sql, $con);
while($row = mysql_fetch_array($rs))
{	
	$rango = $row['rango'];
}
if ($rango=="Administrador" or $rango=="Moderador")
{
	$nom = no_injection($_POST["nom"]); 
	$num = no_injection($_POST["num"]); 
	$causa = no_injection($_POST["causa"]);
	$sql = "INSERT INTO posts_eliminados (id_modera, id_post, causa, fecha) VALUES ('".$id_user."','".$num."','".$causa."',NOW())";
	$rs = mysql_query($sql, $con) or die("Error al grabar un mensaje: ".mysql_error);
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
