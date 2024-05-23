<?php
require_once(dirname(dirname(__FILE__)) . '/includes/configuracion.php');

$recaptcha_response = isset($_POST['g-recaptcha-response']) ? no_injection($_POST['g-recaptcha-response']) : '';
$challenge = recaptcha_validation($recaptcha_response);
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
$dia = isset($_REQUEST['dia']) ? (int) $_REQUEST['dia'] : 1;
$mes = isset($_REQUEST['mes']) ? (int) $_REQUEST['mes'] : 1;
$ano = isset($_REQUEST['ano']) ? (int) $_REQUEST['ano'] : 1970;
$mensajero = isset($_REQUEST['mensajero']) ? no_injection($_REQUEST['mensajero']) : '';
$mensaje = isset($_REQUEST['mensaje']) ? no_injection($_REQUEST['mensaje']) : '';
// TO-DO: Cambiar id_extreme a id_secret
$id_secret = md5(uniqid(rand(), true));
$register_url = $url . '/registro/?nombre=' . $nombre . '&nick=' . $nick . '&mail1=' . $mail1 . '&mail2=' . $mail2 . '&avatar=' . $avatar . '&pais=' . $pais . '&ciudad=' . $ciudad . '&sexo=' . $sexo . '&dia= ' . $dia . '&mes=' . $mes . '&ano=' . $ano . '&mensajero=' . $mensajero . '&mensaje=' . $mensaje;

// TO-DO: Cambiar id_extreme a id_secret
if ($challenge) {
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
        // TO-DO: Cambiar id_extreme a id_secret
        $sql = "
          INSERT INTO usuarios (id_extreme, activacion, ban, rango, nombre, nick, password, puntos, puntosdar, mail, avatar, pais,  ciudad, sexo, dia, mes, ano, mensajero, mensaje, fecha)
          VALUES ('$id_secret', $activacion, $ban, '$rango', '$nombre', '$nick', '$password1', $puntos, $puntosdar, '$mail1', '$avatar', '$pais', '$ciudad', '$sexo', '$dia', '$mes', $ano, '$mensajero', '$mensaje', NOW())";

        mysqli_query($con, $sql);
        $ult_id = mysqli_insert_id($con);
        $activacion_url = $url . '/registro/confirmacionmail.php?id=' . $ult_id . '?' . $id_secret;
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