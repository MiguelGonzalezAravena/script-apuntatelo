<?
include('../includes/configuracion.php');
include('../includes/funciones.php');
include('../login.php');
$id_user = $_SESSION['id'];
if ($id_user!="")
{
	$cant_check = no_injection($_POST['cant_check']) -1;
	$mensajes = "(";
	$bandera = 0;
	for ($i=0; $i<=$cant_check; $i++){
		if ($_POST['i_'.$i]!="")
		{
			if ($bandera==0) $bandera = 1;
			elseif ($bandera==1)$mensajes .= ",";
			$mensajes .= no_injection($_POST['i_'.$i]);
		}
	}
	$mensajes .= ")";
	$accion = no_injection($_POST["accion"]);
	if ($accion != "elim" and $accion != "rest" and $accion != "elim_def")
	{
		$sql = "Update mensajes Set id_carpeta='".$accion."' where id_mensaje in ".$mensajes." and id_receptor = '".$id_user."'";
		mysql_query($sql,$con);
	}
	if ($accion == "rest")
	{
		$sql = "Update mensajes Set papelera_receptor='0' where id_mensaje in ".$mensajes." and id_receptor = '".$id_user."'";
		mysql_query($sql,$con);
	}
	if ($accion == "elim")
	{
		$sql = "Update mensajes Set papelera_receptor='1', fecha_papelera=NOW() where id_mensaje in ".$mensajes." and id_receptor = '".$id_user."'";
		mysql_query($sql,$con);
	}
	if ($accion == "elim_def")
	{
		$sql = "Update mensajes Set eliminado_receptor='1' where id_mensaje in ".$mensajes." and id_receptor = '".$id_user."' and papelera_receptor='1'";
		mysql_query($sql,$con);
	}
	if ($accion == "elim_env")
	{
		$sql = "Update mensajes Set eliminado_emisor='1' where id_mensaje in ".$mensajes." and id_emisor = '".$id_user."'";
		mysql_query($sql,$con);
	}
	if ($accion == "elim_carpeta")
	{
		$sql = "Update mensajes Set papelera_receptor='1', id_carpeta='0', fecha_papelera=NOW() where id_carpeta='".$_POST['carpeta']."' and id_receptor = '".$id_user."'";
		mysql_query($sql,$con);
		$sql = "Delete from carpetas where id_carpeta='".$_POST['carpeta']."' and id_usuario = '".$id_user."'";
		mysql_query($sql,$con);
	}
	?>
		<SCRIPT LANGUAGE="javascript">
       				location.href = "<?=$_POST['pag']?>";
       				</SCRIPT>
	<?
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