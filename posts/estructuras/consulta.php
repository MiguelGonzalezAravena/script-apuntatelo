<?php
$var=0;
$user = isset($_SESSION['user']) ? $_SESSION['user'] : '';
$sql = "SELECT rango ";
$sql.= "FROM usuarios where nick = '$user'";
$rs = mysqli_query($con, $sql);
$rango = '';
while($row = mysqli_fetch_array($rs)) {	
	$rango = $row['rango'];
}

if ($rango == "Administrador" || $rango == "Moderador") {
	$var = 1;
}

$cont = 0;
$sql = "SELECT id, autor, comentario, elim, modera, causa, fecha FROM comentarios where id_post = '$id' order by id asc";
$rs = mysqli_query($con, $sql);
while ($row = mysqli_fetch_array($rs)) {	
	$cont = $cont + 1;
?>
	<font size="1" color="black">
<?php
if ($row['elim'] == 0) {
	$nick = $row['autor'];
	echo "#$cont - ";
	echo "<a name='comentario_".$row['id']."'";
	echo "<a href='/perfil/?id=$nick'><font color='black'><b>$nick</b></font></a>";
	if (isset($_SESSION['id'])) {
		echo " - <a href='/mensajes/redactar.php?para=$nick'><img src='/imagenes/mail2.gif'></a>";
	}
	echo " - ";
	echo $row['fecha'];
	echo " dijo:";
	echo "<br>";
	echo "<br>";
	echo "<div class='size11'>";
	echo BBparse(correcciones2($row['comentario']));
	echo "</div>";
	echo "<br>";
	echo "<br>";
	if ($var == 1) {
?>
			<FORM name='borrar' action='<?php echo $url; ?>/posts_acciones/borrarcoment.php' method='post'>
			<input type="hidden" name="idcoment" value=<?php echo $row['id']; ?>>
			<input type="hidden" name="idpost" value=<?php echo $id; ?>>
			<input type="hidden" name="mod" value=<?php echo $_SESSION['user']; ?>>
			<input type="hidden" name="id_mod" value=<?php echo $_SESSION['id']; ?>>
			<input type="hidden" name="pagina" value=<?php echo $_SERVER['REQUEST_URI']; ?>>
			<INPUT TYPE="text" style="height:20px;" NAME="causa" SIZE="20" MAXLENGTH="30" value="">
			<INPUT type="button" style="font-size:11px" onclick="if(confirm('&iquest;Seguro queres borrar este comentario?'))this.form.submit();" class="button" NAME='botoncomentborrar' VALUE='Eliminar'>
			</FORM>
			<?php
	}
	} else {
		echo "<br>";
		echo "<b>Comentario de ";
		echo $row['autor'];
		echo " eliminado por ";
		echo $row['modera'];
		echo " (";
		echo $row['causa'];
		echo ")</b>";
	}
		echo '<hr>';
}

if ($cont==0) {
echo "<font size='2'><b>Sin comentarios...</b></font>";
}
?>
		</font>
