<?include('../header.php');
include('../configuracion.php');
$user = $_SESSION['user'];
$nick = $_POST['nick'];
$sql = "SELECT rango ";
$sql.= "FROM usuarios where nick='$user' ";
$rs = mysql_query($sql, $con);
while($row = mysql_fetch_array($rs))
	{
	$rango = $row['rango'];
	}
if ($rango=="Moderador" or $rango=="Administrador")
{
if (trim($nick)!="")
{
$sql3 = "select * from usuarios where nick='$nick' ";
$rs3 = mysql_query($sql3,$con);
	if (mysql_num_rows($rs3)>0)
	{
		$sql2 = "select * from suspendidos where nick='$nick' and activo='1' ";
		$rs2 = mysql_query($sql2,$con);
		if (mysql_num_rows($rs2)>0)
		{
			$sql = "Update suspendidos set activo='0', activa='$user', fecha2=NOW() where nick='$nick'and activo='1' ";
			mysql_query($sql);

			$sql = "Update usuarios set ban='0' where nick='$nick'";
			mysql_query($sql);
			$action="correcto2";
		}
		else
		{
		$action="error3";
		}
	mysql_close();
	}
	else
	{
	$action="error2";
	}
}	
?>
		<SCRIPT LANGUAGE="javascript">
       				location.href = "users_suspendidos.php?user=<?echo $nick?>&action=<?echo $action?>";
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
