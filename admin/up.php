<?
include('../configuracion.php');
include('../login.php');
$id_sticky = $_GET['id_sticky'];
$user = $_SESSION['user'];
$sql = "SELECT rango ";
$sql.= "FROM usuarios where nick='$user' ";
$rs = mysql_query($sql, $con);
while($row = mysql_fetch_array($rs))
	{
	$rango = $row['rango'];
	}
if ($rango=="Moderador" or $rango=="Administrador")
{
$sql = "SELECT orden ";
$sql.= "FROM stickies where id='$id_sticky' ";
$rs = mysql_query($sql, $con);
$row = mysql_fetch_array($rs);
$orden = $row['orden'];

$sql = "SELECT id, orden ";
$sql.= "FROM stickies where elim='0' order by orden desc limit 0,1 ";
$rs = mysql_query($sql, $con);
while($row = mysql_fetch_array($rs))
{
		$nuevo_orden = $row['orden'];
		$nuevo_id = $row['id'];
}

$sql = "SELECT id, orden ";
$sql.= "FROM stickies where elim='0' order by orden desc ";
$rs = mysql_query($sql, $con);
while($row = mysql_fetch_array($rs))
{
	if ($row['orden']>$orden and $row['orden']<$nuevo_orden)
	{
		$nuevo_orden = $row['orden'];
		$nuevo_id = $row['id'];
	}
}

$sql = "Update stickies Set orden='$orden' Where id='$nuevo_id'"; 	
mysql_query($sql);
$sql = "Update stickies Set orden='$nuevo_orden' Where id='$id_sticky'"; 	
mysql_query($sql);


mysql_close();

}
?>	
		<SCRIPT LANGUAGE="javascript">
       				location.href = "stickies.php";
       				</SCRIPT>