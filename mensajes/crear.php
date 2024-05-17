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
		echo ' <script type="text/javascript">
        location.href = "../mensajes";
        </script>';
	}
}
else
{
?>
		 <script type="text/javascript">
       				location.href = "..";
       				</script>
<?
}
?>