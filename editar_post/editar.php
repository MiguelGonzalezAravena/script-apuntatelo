<?php
include($_SERVER['DOCUMENT_ROOT'].'/includes/configuracion.php');
include($_SERVER['DOCUMENT_ROOT'].'/includes/funciones.php');
include('../login.php');
$id_autor = no_injection(htmlentities($_POST["variable"]));
$id = no_injection(htmlentities($_POST["id"]));
$id_user = $_SESSION['id'];
$titulo = no_injection(htmlentities($_POST["titulo"]));
$mensaje = no_injection(htmlentities($_POST["cuerpo"]));
$ident = no_injection(htmlentities($_POST["identificador"]));
$categoria = no_injection(htmlentities($_POST["categoria"]));
$privado = no_injection(htmlentities($_POST["privado"]));
$coments = no_injection(htmlentities($_POST["coments"]));
$tags = no_injection(htmlentities($_POST["tags"]));

$sql = "SELECT elim, id_autor ";
$sql.= "FROM posts where id='$id'";
$rs = mysql_query($sql, $con);
while($row = mysql_fetch_array($rs))
{	
	$id_autor2=$row['id_autor'];
	$elim=$row['elim'];
}

if($id_user==$id_autor and $id_user==$id_autor2 and $elim==0)
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
// Grabamos el post en la base.
$sql = "Update posts Set titulo='$titulo', contenido='$mensaje', privado='$privado', coments='$coments', categoria='$categoria', tags='$tags' Where id='$id'"; 	
mysql_query($sql);
Header("Location: ../notificaciones/c6.php?id=$id&c=$categoria&t=$titulo");
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
