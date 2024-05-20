<?php
require_once(dirname(dirname(__FILE__)) . '/includes/configuracion.php');
require_once(dirname(dirname(__FILE__)) . '/login.php');

$user = isset($_SESSION['user']) ? $_SESSION['user'] : '';
$id_user = isset($_SESSION['id']) ? $_SESSION['id'] : '';
$id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
$rango = rango_propio($user);

if ($rango == 'Administrador' && isset($id)) {
  $sql = "
    SELECT id 
    FROM stickies
    WHERE id_post = $id
    AND elim = 0";

  $request = mysqli_query($con, $sql);

  if (!mysqli_num_rows($request) > 0) {
    $sql = "
      SELECT orden 
      FROM stickies
      ORDER BY orden DESC
      LIMIT 0, 1";

    $request = mysqli_query($con, $sql);

    while ($row = mysqli_fetch_array($request)) {
      $ult_orden = $row['orden'];
    }

    $orden = $ult_orden + 1;

    $sql = "
      INSERT INTO stickies (id_post, orden, elim, creador, fecha)
      VALUES ($id, $orden, 0, '$user', NOW())";

    mysqli_query($con, $sql);
    mysqli_close($con);
  }

  redirect($url . '/admin/stickies.php');
} else {
  redirect($url . '/admin/');
}

?>