<?
include('../includes/configuracion.php');
include('../login.php');
include('../includes/funciones.php');
$id_user = $_SESSION['id'];
$id_post = no_injection($_POST['post']);
if ($id_user!="")
{
	$sql = "select id from favoritos where id_post=".$id_post." and id_usuario=".$id_user;
	$rs = mysql_query($sql);
	if (mysql_num_rows($rs)<=0)
	{
		$sql = "insert into favoritos (id_post, id_usuario, fecha) values (".$id_post.",".$id_user.",NOW())";
		mysql_query($sql);
	}
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
