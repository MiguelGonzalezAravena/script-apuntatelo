<?
include('../includes/configuracion.php');
include('../login.php');
$para = trim(htmlentities($_POST['para']));
$asunto = htmlentities($_POST['asunto']);
if (trim($asunto)=="")
	$asunto = "Sin Título";
$contenido = htmlentities($_POST['contenido']);
$id_user = $_SESSION['id'];
if ($id_user!="")
{
	$sql = "select id from usuarios where nick='".$para."'";
	$rs = mysql_query($sql,$con);
	if (mysql_num_rows($rs)>0)
	{
		$row = mysql_fetch_array($rs);
		$para_id = $row['id'];
		$sql = "INSERT INTO mensajes (id_emisor, id_receptor, asunto, contenido, fecha) ";
		$sql.= "VALUES ('$id_user', '$para_id', '$asunto', '$contenido', NOW())";
		$rs = mysql_query($sql, $con) or die("Error al enviar el mensaje");
		echo '<SCRIPT LANGUAGE="javascript">
        location.href = "correcto.php?t=1";
        </SCRIPT>';
	}
	else
	{
		echo "<script>alert('El usuario es inexistente.')</script>";
		echo '<SCRIPT LANGUAGE="javascript">
        		location.href = "redactar.php";
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