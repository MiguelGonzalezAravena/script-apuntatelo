<?php
$var = 0;
$user = isset($_SESSION['user']) ? $_SESSION['user'] : '';
$sql = "
	SELECT rango 
	FROM usuarios
	WHERE nick = '$user'";
$request = mysqli_query($con, $sql);
$rango = '';
while($row = mysqli_fetch_array($request)) {	
	$rango = $row['rango'];
}

if ($rango == 'Administrador' || $rango == 'Moderador') {
	$var = 1;
}

$cont = 0;
$sql = "
	SELECT id, autor, comentario, elim, modera, causa, fecha
	FROM comentarios
	WHERE id_post = $id
	ORDER BY id ASC";

$request = mysqli_query($con, $sql);

while ($row = mysqli_fetch_array($request)) {	
	$cont = $cont + 1;
	echo '<font size="1" color="black">';

	if ($row['elim'] == 0) {
		$nick = $row['autor'];
		echo '#' . $cont . '&nbsp;-&nbsp;';
		echo '<a name="comentario_' . $row['id'] . '"';
		echo '<a href="' . $url . '/perfil/' . $nick . '/"><font color="black"><b>' . $nick . '</b></font></a>';

		if (isset($_SESSION['id'])) {
			echo '&nbsp;-&nbsp;<a href="' . $url . '/mensajes/redactar.php?para=' . $nick . '"><img src="' . $images . '/mail2.gif"></a>';
		}

		echo ' - ' . $row['fecha'] . ' dijo:
			<br /><br />
			<div class="size11">' . BBparse(correcciones2($row['comentario'])) . '</div>
			<br /><br />';

		if ($var == 1) {
			echo '
				<form name="borrar" action="' . $url . '/posts_acciones/borrarcoment.php" method="post">
					<input type="hidden" name="idcoment" value="' . $row['id'] . '" />
					<input type="hidden" name="idpost" value="' . $id . '" />
					<input type="hidden" name="mod" value="' . $_SESSION['user'] . '" />
					<input type="hidden" name="id_mod" value="' . $_SESSION['id'] . '" />
					<input type="hidden" name="pagina" value="' . $_SERVER['REQUEST_URI'] . '" />
					<input type="text" style="height: 20px;" name="causa" size="20" maxlength="30" value="" />
					<input type="button" class="submit_button" style="font-size: 11px" onclick="if(confirm(\'&iquest;Seguro que deseas borrar este comentario?\'))this.form.submit();" class="button" name="botoncomentborrar" value="Eliminar" />
				</form>';
		}
	} else {
		echo '
			<br />
			<b>Comentario de ' . $row['autor'] . ' eliminado por ' . $row['modera'] . ' (' . $row['causa'] . ')</b>';
	}

	echo '<hr />';
}

if ($cont == 0) {
	echo '<font size="2"><b>Sin comentarios...</b></font>';
}

echo '</font>';

?>