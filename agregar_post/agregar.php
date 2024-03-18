<?php
include('../includes/configuracion.php');
include('../includes/funciones.php');
include('../login.php');
$id_autor = no_injection(htmlentities($_POST["variable"]));
$id_autor2 = $_SESSION['id'];
$titulo = no_injection(htmlentities($_POST["titulo"]));
$mensaje = no_injection(htmlentities($_POST["cuerpo"]));
$ident = no_injection(htmlentities($_POST["identificador"]));
$categoria = no_injection(htmlentities($_POST["categoria"]));
$privado = no_injection(htmlentities($_POST["privado"]));
$coments = no_injection(htmlentities($_POST["coments"]));
$tags = no_injection(htmlentities($_POST["tags"]));

if($id_autor==$id_autor2)
{

if ($titulo=="")
{
echo '<script>alert("El título es obligatorio");</script>';
?>
<SCRIPT LANGUAGE="javascript">
       location.href = "../agregar_post/";
       </SCRIPT>
<?
}
else
{
	if (trim($mensaje)=="")
	{
	echo '<script>alert("El contenido es obligatorio");</script>';
	?>
	<SCRIPT LANGUAGE="javascript">
       location.href = "../agregar_post/";
       </SCRIPT>
	<?
		}
		else
		{
			if ($categoria=="-1")
			{
			echo '<script>alert("La categoría es obligatoria");</script>';
			?>
			<SCRIPT LANGUAGE="javascript">
      		location.href = "../agregar_post/";
       		</SCRIPT>
			<?
			}
			else
			{

$elim = 0;
$comentarios = 0;
// Grabamos el post en la base.
$sql = "INSERT INTO posts (elim, id_autor, titulo, contenido, fecha, privado, coments, comentarios, categoria, tags) ";
$sql.= "VALUES ('$elim', '$id_autor','$titulo','$mensaje',NOW(),'$privado','$coments','$comentarios','$categoria','$tags')";
$rs = mysql_query($sql, $con) or die("Error al grabar un mensaje: ".mysql_error);
$ult_id = mysql_insert_id($con);
$num = $ult_id;

$sql = "Update usuarios Set numposts=numposts+'1' where id='$id_autor'"; 	
mysql_query($sql);

$sql = "Update cantidad Set cant=cant+'1' where id='1'"; 	
mysql_query($sql);

Header("Location: ../notificaciones/c5.php?id=$num&c=$categoria&t=$titulo");
				
			}
		}
}
}
else
{
?>	
		<SCRIPT LANGUAGE="javascript">
      		location.href = "../agregar_post/";
       		</SCRIPT>
<?
}
?>
