<?php
require_once(dirname(dirname(__FILE__)) . '/includes/configuracion.php');

# the response from reCAPTCHA
$resp = null;
# the error code from reCAPTCHA, if any
$error = null;

require_once(dirname(dirname(__FILE__)) . '/recaptcha/recaptchalib.php');
$privatekey = '6LeshgQAAAAAAImScU7FGs7BPvBNz6Fq8s7HEmhL';

$resp = recaptcha_check_answer(
		$privatekey,
		$_SERVER['REMOTE_ADDR'],
		$_REQUEST['recaptcha_challenge_field'],
		$_REQUEST['recaptcha_response_field']
	);

$var = $resp->is_valid ? 1 : 0;
$activacion = 0;
$ban = 0;
$puntos = 0;
$puntosdar = 0;
$rango = 'Usuario Full';
$nombre = isset($_REQUEST['nombre']) ? no_injection($_REQUEST['nombre']) : '';
$nick = isset($_REQUEST['nick']) ? no_injection($_REQUEST['nick']) : '';
$password1 = isset($_REQUEST['password1']) ? md5(no_injection($_REQUEST['password1'])) : '';
$password2 = isset($_REQUEST['password2']) ? md5(no_injection($_REQUEST['password2'])) : '';
$mail1 = isset($_REQUEST['mail1']) ? no_injection($_REQUEST['mail1']) : '';
$mail2 = isset($_REQUEST['mail2']) ? no_injection($_REQUEST['mail2']) : '';
$avatar = isset($_REQUEST['avatar']) ? no_injection($_REQUEST['avatar']) : '';
$pais = isset($_REQUEST['pais']) ? no_injection($_REQUEST['pais']) : '';
$ciudad = isset($_REQUEST['ciudad']) ? no_injection($_REQUEST['ciudad']) : '';
$sexo = isset($_REQUEST['sexo']) ? no_injection($_REQUEST['sexo']) : '';
$dia = isset($_REQUEST['dia']) ? no_injection($_REQUEST['dia']) : '';
$mes = isset($_REQUEST['mes']) ? no_injection($_REQUEST['mes']) : '';
$ano = isset($_REQUEST['ano']) ? (int) $_REQUEST['ano'] : '';
$mensajero = isset($_REQUEST['mensajero']) ? no_injection($_REQUEST['mensajero']) : '';
$mensaje = isset($_REQUEST['mensaje']) ? no_injection($_REQUEST['mensaje']) : '';
$id_extreme = md5(uniqid(rand(), true));
$register_url = $url . '/registro/?nombre=' . $nombre . '&nick=' . $nick . '&mail1=' . $mail1 . '&mail2=' . $mail2 . '&avatar=' . $avatar . '&pais=' . $pais . '&ciudad=' . $ciudad . '&sexo=' . $sexo . '&dia= ' . $dia . '&mes=' . $mes . '&ano=' . $ano . '&mensajero=' . $mensajero . '&mensaje=' . $mensaje;

// TO-DO: Cambiar id_extreme a id_secret
if ($var == 1) {
	$sql = "
		SELECT id
		FROM usuarios
		WHERE nick = '" . $_REQUEST['nick'] . "'";

	$request = mysqli_query($con, $sql);

	if ($row = mysqli_fetch_array($request)) {
		header('Location: ' . $register_url . '&error=1');
	} else {
		$sql = "
			SELECT id
			FROM usuarios
			WHERE mail = '" . $_REQUEST["mail1"] . "'";

		$result = mysqli_query($con, $sql);

		if ($row = mysqli_fetch_array($result)) {
			header('Location: ' . $register_url . '&error=2');
		} else {
			if (strlen(trim($nick)) < 3) {
				header('Location: ' . $register_url . '&error=3');
			} else {
				$sql = "
					INSERT INTO usuarios (id_extreme, activacion, ban, rango, nombre, nick, password, puntos, puntosdar, mail, avatar, pais,  ciudad, sexo, dia, mes, ano, mensajero, mensaje, fecha)
					VALUES ('$id_extreme', $activacion, $ban, '$rango', '$nombre', '$nick', '$password1', $puntos, $puntosdar, '$mail1', '$avatar', '$pais', '$ciudad', '$sexo', '$dia', '$mes', $ano, '$mensajero', '$mensaje', NOW())";

				mysqli_query($con, $sql);
				$ult_id = mysqli_insert_id($con);
				$activacion_url = $url . '/registro/confirmacionmail.php?id=' . $ult_id . '?' . $id_extreme;
				$email = 'soporte@extreme-zone.cl';
				$asunto = 'Confirmaci&oacute;n de ' . $name;
				$mensaje = '<a href="' . $activacion_url . '">' . $activacion_url . '</a><br /><br />';
				$encabezados = "From: $email\nReply-To: $email\nContent-Type: text/html; charset=ISO-8859-1";
				mail($mail1, $asunto, $mensaje, $encabezados);
				redirect($url . '/notificaciones/registrocon.php');
			}	
		}

		mysqli_free_result($result);
		mysqli_close($con);
	}
} else {
	header('Location: ' . $register_url . '&error=5');
}

?>