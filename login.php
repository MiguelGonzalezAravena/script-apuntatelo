<?php
session_start();

// Comprobar si existe sesión
if (isset($_SESSION['user'])) {
  $user = $_SESSION['user'];
  $sql = "
    SELECT id_extreme, ban
    FROM usuarios
    WHERE nick = '$user'";

  $query = mysqli_query($con, $sql);
  $data = mysqli_fetch_array($query);

  if ($data['ban'] != 0 || $data['id_extreme'] != $_SESSION['id2'] ) {
    $_SESSION['user'] = null;
    $_SESSION['id'] = null;
    $_SESSION['id2'] = null;
    unset($_SESSION);
    session_destroy();
  }
}

// Comprobar si hay cookie. Si está bien, se le asigna una sesión
if (isset($_COOKIE['id_extreme'])) {
  $cookie = mysqli_real_escape_string($con, $_COOKIE['id_extreme']);
  $cookie = explode('%', $cookie);
  $user = $cookie[0];
  $id = $cookie[1];
  $ip = $cookie[2];
  $ip2 = !isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? getenv('REMOTE_ADDR') : getenv('HTTP_X_FORWARDED_FOR');

  if ($ip == $ip2) {
    // TO-DO: Cambiar id_extreme a id_secret
    $sql = "
      SELECT *
      FROM usuarios
      WHERE id_extreme = '$id'
      AND id = $user";

    $query = mysqli_query($con, $sql);
    $data = mysqli_fetch_array($query);

    if (isset($data['nick']) && $data['ban'] == 0) {
      $_SESSION['user'] = $data['nick'];
      $_SESSION['id'] = $data['id'];
      $_SESSION['id2'] = $data['id_extreme'];

      return true;
    }
  }
}

?>