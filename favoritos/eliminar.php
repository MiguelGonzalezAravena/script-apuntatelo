<?
include('../includes/configuracion.php');
include('../login.php');
include('../includes/funciones.php');
$id_user = $_SESSION['id'];
if ($id_user!="")
{
	$cant_check = $_POST['cant_check'] -1;
	$favoritos = "(";
	for ($i=0; $i<=$cant_check; $i++){
		if ($_POST['i_'.$i]!="")
		{
			$favoritos .= no_injection($_POST['i_'.$i]).",";
		}
	}
	$favoritos = substr($favoritos,0,strlen($favoritos)-1);
	
	$favoritos .= ")";

	$sql = "delete from favoritos where id in ".$favoritos." and id_usuario=".$id_user;

	mysql_query($sql);
	?>
	<SCRIPT LANGUAGE="javascript">
       				location.href = "<?=$_POST['pag']?>";
       				</SCRIPT>
	<?
}
?>
<SCRIPT LANGUAGE="javascript">
	location.href = "..";
</SCRIPT>
