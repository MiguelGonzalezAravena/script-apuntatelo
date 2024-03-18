<?
if($_SESSION['user']!="")
{
	$sql = "select id from favoritos where id_post=".$id." and id_usuario=".$_SESSION['id'];
	$rs = mysql_query($sql);
	if(mysql_num_rows($rs)<=0)
	{
		?>
		<form name="favoritos" method="POST" action="/favoritos/insertar.php">
		<input type="hidden" name="pag" value="<?=$_SERVER['REQUEST_URI']?>">
		<input type="hidden" name="post" value="<?=$id?>">
		<div style="font-size: 11px; text-align: center;"><img src="/imagenes/iconos/favoritos_a.png"> <a href="#" onclick="javascript: document.favoritos.submit();" style="color:#000000;">Agregar a favoritos</a></div>
		</form>
		<?
	}
	else
		echo "<div style=\"font-size: 11px; text-align: center;\">El Post ya se encuentra en favoritos</div>";
}
?>