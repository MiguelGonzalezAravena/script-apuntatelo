<?
include('../includes/configuracion.php');
include('../includes/funciones.php');
include('../login.php');
$nom_carpeta = no_injection(trim(htmlentities($_POST['nom_carpeta'])));
$id_user = $_SESSION['id'];
if ($id_user!="")
{
	if ($nom_carpeta!="")
	{
		$sql = "INSERT INTO carpetas (id_usuario, nom_carpeta) ";
		$sql.= "VALUES ('$id_user', '$nom_carpeta')";
		$rs = mysql_query($sql, $con) or die("Error al enviar el mensaje");
		echo '<SCRIPT LANGUAGE="javascript">
        location.href = "../mensajes";
        </SCRIPT>';
	}
}
else
{
?>
		<SCRIPT LANGUAGE="javascript">
       				location.href = "..";
       				</SCRIPT>
<?
}
?>