<?php
require_once(dirname(dirname(__FILE__)) . '/header.php');
require_once(dirname(dirname(__FILE__)) . '/includes/configuracion.php');

$user = isset($_SESSION['user']) ? $_SESSION['user'] : '';
$nick = isset($_POST['nick']) ? no_injection($_POST['nick']) : '';
$razon = isset($_POST['razon']) ? no_injection($_POST['razon']) : '';
$rango = rango_propio($user);

if ($rango == 'Moderador' || $rango == 'Administrador') {
  if ($nick != '' && $razon != '' && $nick != 'Miguelithox') {
    $sql = "
      SELECT *
      FROM usuarios
      WHERE nick = '$nick'";

    $request = mysqli_query($con, $sql);

    if (mysqli_num_rows($request) > 0) {
      $sql = "
        SELECT * 
        FROM suspendidos 
        WHERE nick = '$nick'
        AND activo = 1";

      $request = mysqli_query($con, $sql);

      if (!mysqli_num_rows($request) > 0) {
        mysqli_query($con, "INSERT INTO suspendidos (nick, modera, causa, fecha1, activo) VALUES ('$nick', '$user', '$razon', NOW(), 1)");
        mysqli_query($con, "UPDATE usuarios SET ban = 1 WHERE nick = '$nick'");

        $action = 'correcto';
      } else {
        $action = 'error';
      }

      mysqli_close($con);
    } else {
      $action = 'error2';
    }
  } else {
    $action = 'error4';
  }

  redirect($url . '/admin/users_suspendidos.php?user=' . $nick . '&action=' . $action);
} else {
  redirect($url . '/admin/users_suspendidos.php');
}

?>