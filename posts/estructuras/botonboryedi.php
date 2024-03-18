<?
$id_user=$_SESSION['id'];
$sql = "SELECT rango ";
$sql.= "FROM usuarios where id='$id_user'";
$rs = mysql_query($sql, $con);
	while($row = mysql_fetch_array($rs))
	{	
		$rango = $row['rango'];
	}
?>
<table>
	<tr>
		<?
		if ($id_user!=$id_autor and ($rango=="Administrador" or $rango=="Moderador"))
		{
		?>
			<td>
				<FORM name='borrar' action='/posts_acciones/borrarpostmod.php' method='post'>
				<input type="hidden" name="id_autor" value="<?=$id_autor?>">
				<input type='hidden' name='nom' value="<?=$titulo?>">
				<input type='hidden' name='num' value="<?=$id?>">
				<input type='hidden' name='pagina' value="<?=$_SERVER['REQUEST_URI']?>">
				<font size="2"><b>Causa:</b></font> <input type='text' name='causa' size="30" maxlength="200" value="">
				<INPUT type="button" class="submit_button" onclick="if(confirm('&iquest;Seguro queres borrar el post?'))this.form.submit();" NAME='botonborrar' VALUE='Borrar Post del Usuario'>
				</FORM>
			</td>
		<?
		}
		if ($id_user==$id_autor)
		{
			?>
				<FORM name='borrar' action='/posts_acciones/borrarpost.php' method='post' onsubmit="if(confirm('&iquest;Seguro queres borrar el post?'))">
				<input type="hidden" name="id_autor" value="<?=$id_autor?>">
				<input type='hidden' name='nom' value="<?=$titulo?>">
				<input type='hidden' name='num' value="<?=$id?>">
			<td>
				<input type='hidden' name='pagina' value="<?=$_SERVER['REQUEST_URI']?>">
				<INPUT type="button" class="submit_button" onclick="if(confirm('&iquest;Seguro queres borrar el post?'))this.form.submit();" NAME='botonborrar' VALUE='Borrar Post'>
			</td>
			<td>
				<input type="button" class="submit_button" value="Editar Post" title="Editar Post" onclick="location.href='/editar_post/?id=<?echo $id?>'">
			</td>
		<?
		}
		?>
		</FORM>
	</tr>
</table>
