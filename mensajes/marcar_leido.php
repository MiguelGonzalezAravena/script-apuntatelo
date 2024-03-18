<?
$id_mensaje = $_GET['mensaje'];
$id_user = $_SESSION['id'];
$sql = "Update mensajes Set leido_receptor='1' where id_mensaje='".$id_mensaje."' and id_receptor = '".$id_user."'"; 	
mysql_query($sql,$con);
?>