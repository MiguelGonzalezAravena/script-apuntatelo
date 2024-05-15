<?php
$id_user = isset($_SESSION['id']) ? $_SESSION['id'] : '';
$sql = "SELECT rango ";
$sql.= "FROM usuarios where id = '$id_user'";
$rs = mysqli_query($con, $sql);
$rango = '';
while($row = mysqli_fetch_array($rs)) {	
	$rango = $row['rango'];
}
?>
<table>
	<tr>
		<?php
		if ($id_user != $id_autor && ($rango == "Administrador" || $rango == "Moderador")) {
		?>
			<td>
				<FORM name='borrar' action='<?php echo $url; ?>/posts_acciones/borrarpostmod.php' method='post'>
				<input type="hidden" name="id_autor" value="<?php echo $id_autor; ?>">
				<input type='hidden' name='nom' value="<?php echo $titulo; ?>">
				<input type='hidden' name='num' value="<?php echo $id; ?>">
				<input type='hidden' name='pagina' value="<?php echo $_SERVER['REQUEST_URI']; ?>">
				<font size="2"><b>Causa:</b></font> <input type='text' name='causa' size="30" maxlength="200" value="">
				<INPUT type="button" class="submit_button" onclick="if(confirm('&iquest;Seguro queres borrar el post?'))this.form.submit();" NAME='botonborrar' VALUE='Borrar Post del Usuario'>
				</FORM>
			</td>
		<?php
		}

		if ($id_user == $id_autor) {
			?>
				<FORM name='borrar' action='<?php echo $url; ?>/posts_acciones/borrarpost.php' method='post' onsubmit="if(confirm('&iquest;Seguro queres borrar el post?'))">
				<input type="hidden" name="id_autor" value="<?php echo $id_autor; ?>">
				<input type='hidden' name='nom' value="<?php echo $titulo; ?>">
				<input type='hidden' name='num' value="<?php echo $id; ?>">
			<td>
				<input type='hidden' name='pagina' value="<?php echo $_SERVER['REQUEST_URI']; ?>">
				<INPUT type="button" class="submit_button" onclick="if(confirm('&iquest;Seguro queres borrar el post?'))this.form.submit();" NAME='botonborrar' VALUE='Borrar Post'>
			</td>
			<td>
				<input type="button" class="submit_button" value="Editar Post" title="Editar Post" onclick="location.href='<?php echo $url; ?>/editar_post/?id=<?php echo $id; ?>'">
			</td>
		<?php
		}
		?>
		</FORM>
	</tr>
</table>
