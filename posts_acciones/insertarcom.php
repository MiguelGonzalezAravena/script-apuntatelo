<?php
include('../includes/configuracion.php');
include('../includes/funciones.php');
include('../login.php');
$num = no_injection($_POST["num"]);
$pag = htmlentities($_POST["pagina"]);
$autor = no_injection($_POST["variable"]);
$id_autor = no_injection($_POST["variable2"]);
$user = $_SESSION['user'];
$id_user = $_SESSION['id'];
$coment = no_injection(htmlentities($_POST["cuerpo"]));

$sql = "SELECT coments FROM posts where id='".$num."' ";
$rs = mysql_query($sql, $con);
while($row = mysql_fetch_array($rs))
{
	$coments=$row['coments'];
}

$coment=quitar($coment);
// Grabamos el mensaje en la base.

if($num=="" or $autor=="" or $id_autor!=$id_user or $autor!=$user or $coments!=0)
{
	?>
	<SCRIPT LANGUAGE="javascript">
	       location.href = "..";
	       </SCRIPT>
	<?
}
else
{
	$sql = "Update posts Set comentarios=comentarios+'1' Where id='".$num."'"; 	
	mysql_query($sql);
	$sql = "Update usuarios Set numcomentarios=numcomentarios+'1' Where id='".$id_user."'"; 	
	mysql_query($sql);
	$sql = "Update cantidad Set cant=cant+'1' where id='2'";
	mysql_query($sql);
	
	$sql = "INSERT INTO comentarios (id_post, id_autor, autor, comentario, fecha) VALUES ('".$num."','".$id_autor."','".$autor."','".$coment."',NOW())";
	$rs = mysql_query($sql, $con) or die("Error al grabar un mensaje: ".mysql_error);
	$ult_id = mysql_insert_id($con);
	?>
	<SCRIPT LANGUAGE="javascript">
	       location.href = "..<?echo$pag;?>";
	       </SCRIPT>
	<?
}
?>


