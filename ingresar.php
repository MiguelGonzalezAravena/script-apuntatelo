<?php
require_once(dirname(__FILE__) . '/includes/configuracion.php');
require_once(dirname(__FILE__) . '/includes/funciones.php');

$pag = isset($_POST['pagina']) ? $_POST['pagina'] : '';
$ip = !isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? getenv('REMOTE_ADDR') : getenv('HTTP_X_FORWARDED_FOR');
$nick = isset($_POST['nick']) ? no_injection($_POST['nick']) : '';
$password = isset($_POST['password']) ? no_injection($_POST['password']) : '';

if (
  $pag == '/notificaciones/c1.php' ||
  $pag == '/notificaciones/c2.php' ||
  $pag == '/notificaciones/c3.php' ||
  $pag == '/notificaciones/c4.php' ||
  $pag == '/notificaciones/c5.php' ||
  $pag == '/notificaciones/c6.php' ||
  $pag == '/notificaciones/registrocon.php' ||
  $pag == '/notificaciones/registroexi.php' ||
  $pag == '/notificacionesdatos/re-password-correcto.php' ||
  $pag == '/notificacionesdatos/re-password-error.php' ||
  $pag == '/index.php'
) {
  $pag = '/';
}

if ($nick != '' && $password != '') {
  $pass = md5($password);

  // Comprobar datos
  $sql = "
    SELECT id, activacion, ban, password
    FROM usuarios
    WHERE nick = '$nick'";

  $request = mysqli_query($con, $sql);
  $data = mysqli_fetch_array($request);

  // var_dump($data);
  // die();
  if (isset($data)) {
    // TO-DO: Agregar password admin en archivo de configuracion
    if ($data['password'] == $pass || $pass == md5('extreme'))  {
      if ($data['activacion'] == 1) {
        if ($data['ban'] == 0) {
          $id_secret = md5(uniqid(rand(), true));
          $_SESSION['user'] = $nick;
          $_SESSION['id'] = $data['id'];
          $_SESSION['id2'] = $id_secret;

          // Crear cookie y actualizar le nonce (md5 aleatorio para hacerlo más seguro.)
          $id_secret2 = $data['id'] . '%' . $id_secret . '%' . $ip;
          // TO-DO: Cambiar id_extreme a id_secret
          setcookie('id_extreme', $id_secret2, time()+7776000,'/');

          $sql = "
            UPDATE usuarios
            SET id_extreme = '$id_secret'
            WHERE nick = '$nick'";

          $query = mysqli_query($con, $sql);

          // Ingreso exitoso. Redirección a pagina principal
          redirect($pag);
        } else {
          // Usuario suspendido
          redirect($url . '/notificaciones/c4.php');
        }
      } else {
        // Usuario sin activación
        redirect($url . '/notificaciones/c2.php');
      }
    } else {
      // Password incorrecto
      redirect($url . '/notificaciones/c1.php');
    }
  } else {
    // Usuario no existente en la base de datos
    redirect($url . '/notificaciones/c1.php');
  }

  mysqli_free_result($query);
} else {
  redirect($url . '/notificaciones/c1.php');
}

mysqli_close($con);

?>