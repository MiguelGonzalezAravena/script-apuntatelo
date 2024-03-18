<?
include('../includes/configuracion.php');
include('../includes/funciones.php');
$id = no_injection($_POST['id']);
$id_extreme = no_injection($_POST['id_extreme']);
$action = no_injection($_GET['action']);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>APUNTATELO - Tu link-sharing de apuntes</title>
	<link href='../imagenes/logo/icono.bmp' rel='shortcut icon'/>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<link rel="stylesheet" type="text/css" href="../index.css" />
</head>
<body>
<table align="center"><tr><td>
<div class="logo"></div></td></tr></table>
<br>
<br>
<?
$password1 = $_POST['password1'];
$password2 = $_POST['password2'];

if (trim($password1)!="" and trim($password1)==trim($password2) and strlen($password1)>5)
	{
		$password = md5($password1);
		$sql="select nick from usuarios where id='".$id."' and id_extreme='".$id_extreme."'";
		$rs=mysql_query($sql,$con);
		if (mysql_num_rows($rs)>0)
		{
			$id_apuntatelo = md5(uniqid(rand(), true));
			$sql2 = "Update usuarios Set id_extreme='".$id_extreme."', password='".$password."' where id='".$id."'";
			$rs2 = mysql_query($sql2,$con);
		?>	
			<SCRIPT LANGUAGE="javascript">
 			location.href = "../notificaciones/re-password-correcto.php";
 			</SCRIPT>
		<?
		}
		else
		{
		?>	
			<SCRIPT LANGUAGE="javascript">
 			location.href = "../notificaciones/re-password-error.php";
 			</SCRIPT>
		<?
		}
	mysql_close($con);
	}
	else
	{
		?>	
			<SCRIPT LANGUAGE="javascript">
 			location.href = "re-password.php?id=<?echo $id?>?<?echo $id_extreme?>&action=error";
 			</SCRIPT>
		<?
	}

?>
</body>
</html>