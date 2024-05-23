<?php
require_once(dirname(dirname(__FILE__)) . '/includes/configuracion.php');
require_once(dirname(dirname(__FILE__)) . '/includes/funciones.php');

$recaptcha_response = isset($_POST['g-recaptcha-response']) ? no_injection($_POST['g-recaptcha-response']) : '';
$challenge = recaptcha_validation($recaptcha_response);

if ($challenge) {
  $mail = isset($_POST['mail']) ? no_injection($_POST['mail']) : '';

  $sql = "
    SELECT id, id_extreme
    FROM usuarios
    WHERE mail = '$mail'";

  $request = mysqli_query($con, $sql);

  if (mysqli_num_rows($request) > 0) {
    while ($row = mysqli_fetch_array($request)) {
      $id = $row['id'];
      $id_extreme = $row['id_extreme'];
      $cadena = $id . '?' . $id_extreme;
      $url_repassword = $url . '/datos/re-password.php?id=' . $cadena;
      $asunto = "[$name] Recuperaci&oacute;n de contrase&ntilde;a";
      $mensaje = "<a href=\"$url_repassword\">$url_repassword</a>";
      $encabezados = "From: $email\nReply-To: $email\nContent-Type: text/html; charset=ISO-8859-1"; 

      mail($mail, $asunto, $mensaje, $encabezados);

      redirect($url . '/notificaciones/c7.php');
    }
  } else {
    redirect($url . '/datos/index.php?action=recuperar&mensaje=error');
  }
} else {
  redirect($url . '/datos/index.php?action=recuperar&mensaje=error2');
}

?>