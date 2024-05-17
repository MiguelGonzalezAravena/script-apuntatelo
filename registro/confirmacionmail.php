<?
include('../includes/configuracion.php');
include('../includes/funciones.php');
$cadena = no_injection($_GET["id"]);

$cad = explode("?", $cadena);
$id = $cad[0];
$id_apuntatelo = $cad[1];

$sql = "Update usuarios Set activacion='1' Where id='".$id."' and id_apuntatelo = '".$id_apuntatelo."'";
if(mysql_query($sql))
{
	?>	
	 <script type="text/javascript">
	location.href = "../notificaciones/registroexi.php";
	</script>
	<?
}
else
{
	?>				
	 <script type="text/javascript">
	location.href = "../notificaciones/registrofa.php";
	</script>
	<?
}
?>