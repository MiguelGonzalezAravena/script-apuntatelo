<?
include('../includes/configentrada.php');
$user = $_SESSION['user'];
$id_user = $_SESSION['id'];
$id = $_POST['id'];
$sql = "SELECT rango ";
$sql.= "FROM usuarios where id='$id_user' ";
$rs = mysql_query($sql, $con);
while($row = mysql_fetch_array($rs))
	{
	$rango = $row['rango'];
	}
if ($rango=="Administrador")
{
	if (trim($id)!="")
	{
		$sql2 = "SELECT id ";
		$sql2.= "FROM stickies where id_post='$id' and elim='0'";
		$rs2 = mysql_query($sql2,$con);
		if (!mysql_num_rows($rs2)>0)
		{
			$sql = "SELECT orden ";
			$sql.= "FROM stickies order by orden desc limit 0,1 ";
			$rs = mysql_query($sql, $con);
			while($row = mysql_fetch_array($rs))
			{
				$ult_orden = $row['orden'];
			}
			
			$orden = $ult_orden + 1;
			$sql = "INSERT INTO stickies (id_post,orden,elim,creador,fecha)";
			$sql.= "VALUES ('$id','$orden','0','$user',NOW())";
			mysql_query($sql);
			mysql_close();
		}
	}
	?>
			 <script type="text/javascript">
	   				location.href = "stickies.php";
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

