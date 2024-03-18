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
	<SCRIPT LANGUAGE="javascript">
	location.href = "../notificaciones/registroexi.php";
	</SCRIPT>
	<?
}
else
{
	?>				
	<SCRIPT LANGUAGE="javascript">
	location.href = "../notificaciones/registrofa.php";
	</SCRIPT>
	<?
}
?>