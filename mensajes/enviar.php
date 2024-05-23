<?php
require_once(dirname(dirname(__FILE__)) . '/includes/configuracion.php');
require_once(dirname(dirname(__FILE__)) . '/includes/funciones.php');
require_once(dirname(dirname(__FILE__)) . '/login.php');

$id_user = isset($_SESSION['id']) ? $_SESSION['id'] : '';
$para = isset($_POST['para']) ? no_injection($_POST['para']) : '';
$asunto = isset($_POST['asunto']) && $_POST['asunto'] != '' ? no_injection($_POST['asunto']) : 'Sin título';
$contenido = isset($_POST['contenido']) ? no_injection($_POST['contenido']) : '';
$pag = isset($_POST['pag']) ? no_injection($_POST['pag']) : '';

if ($contenido == '') {
  alert('El mensaje privado debe tener un contenido');
  redirect("$url/mensajes/redactar.php?para=$para&asunto=$asunto");
} else if ($id_user != '') {
  $sql = "
    SELECT id
    FROM usuarios
    WHERE nick = '$para'";

  $request = mysqli_query($con, $sql);

  if (mysqli_num_rows($request) > 0) {
    $row = mysqli_fetch_array($request);
    $para_id = $row['id'];
    $sql = "
      INSERT INTO mensajes (id_emisor, id_receptor, asunto, contenido, fecha)
      VALUES ($id_user, $para_id, '$asunto', '$contenido', NOW())";

    mysqli_query($con, $sql);

    redirect($url . '/mensajes/correcto.php?t=1');
  } else {
    alert('El usuario no existe');
    redirect($url . '/mensajes/redactar.php');
  }
} else {
  redirect($url);
}

?>