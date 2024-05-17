<?
include('../includes/configentrada.php');
$user = $_SESSION['user'];
$id_user = $_SESSION['id'];
$id = $_GET['id'];
$sql = "SELECT rango ";
$sql.= "FROM usuarios where id='$id_user' ";
$rs = mysql_query($sql, $con);
while($row = mysql_fetch_array($rs))
{
	$rango = $row['rango'];
}
if ($rango=="Moderador" or $rango=="Administrador")
{
	$sql = "Update stickies Set elim='1', modera='$user' Where id='$id'"; 	
	mysql_query($sql);
	mysql_close();
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

