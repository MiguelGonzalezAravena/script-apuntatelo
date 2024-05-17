<?include('../header.php');
include('../configuracion.php');
$user = $_SESSION['user'];
$nick = $_POST['nick'];
$razon = $_POST['razon'];
$sql = "SELECT rango ";
$sql.= "FROM usuarios where nick='$user' ";
$rs = mysql_query($sql, $con);
while($row = mysql_fetch_array($rs))
	{
	$rango = $row['rango'];
	}
if ($rango=="Moderador" or $rango=="Administrador")
{
if (trim($nick)!="" and trim($razon)!="" and trim($nick)!= "gonza1988" and trim($nick)!= "nisiquieraunaparte" and trim($nick)!= "cha")
{
$sql3 = "select * from usuarios where nick='$nick' ";
$rs3 = mysql_query($sql3,$con);
	if (mysql_num_rows($rs3)>0)
	{
		$sql2 = "select * from suspendidos where nick='$nick' and activo='1' ";
		$rs2 = mysql_query($sql2,$con);
		if (!mysql_num_rows($rs2)>0)
		{
			$sql = "INSERT INTO suspendidos (nick,modera,causa,fecha1,activo)";
			$sql.= "VALUES ('$nick','$user','$razon',NOW(),'1')";
			mysql_query($sql);
			$sql = "Update usuarios set ban='1' where nick='$nick'";
			mysql_query($sql);
			$action="correcto";
		}
		else
		{
		$action="error";
		}
	mysql_close();
	}
	else
	{
	$action="error2";
	}
}
else
{
	$action="error4";
}
?>
		 <script type="text/javascript">
       				location.href = "users_suspendidos.php?user=<?echo $nick?>&action=<?echo $action?>";
       				</script>
<?
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