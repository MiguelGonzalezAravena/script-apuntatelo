<?php
require_once(dirname(dirname(__FILE__)) . '/includes/configuracion.php');
require_once(dirname(dirname(__FILE__)) . '/includes/funciones.php');
require_once(dirname(dirname(__FILE__)) . '/login.php');

$id_user = isset($_SESSION['id']) ? $_SESSION['id'] : '';
$dar = isset($_POST['cantpuntos']) ? (int) $_POST['cantpuntos'] : 0;
$dador = isset($_POST['dador']) ? (int) $_POST['dador'] : 0;
$id_post = isset($_POST['id_post']) ? (int) $_POST['id_post'] : 0;
$titu = isset($_POST['titu']) ? no_injection($_POST['titu']) : '';
$pag = isset($_POST['pagina']) ? no_injection($_POST['pagina']) : '';
$aux = 1;

if ($dador == $id_user) {
  // Verificar que no haya punteado ya el post
  $sql = "
    SELECT num
    FROM puntos
    WHERE id_punteador = $id_user
    AND num = " . $id_post;

  $request = mysqli_query($con, $sql);
  $rows = mysqli_num_rows($request);

  if (!$rows > 0) {
    $aux = 0;
  }
  
  // Verificar que el dador tenga la cantidad de puntos
  $sql = "
    SELECT puntosdar
    FROM usuarios
    WHERE id = " . $id_user;
  $request = mysqli_query($con, $sql);
  $row = mysqli_fetch_array($request);
  $puntosdar = $row['puntosdar']; 
  
  if (isset($dar) && $dar <= 10 && $dar <= $puntosdar && $dar > 0) {
    if ($aux == 0) {
      // Buscar receptor
      $sql = "
        SELECT id_autor
        FROM posts
        WHERE id = " . $id_post;

      $request = mysqli_query($con, $sql);
      $row = mysqli_fetch_array($request);
      $receptor = $row['id_autor'];

      // Actualizar puntos del receptor
      mysqli_query($con, "UPDATE usuarios SET puntos = puntos + $dar WHERE id = " . $receptor);

      // Actualizar puntos del dador
      mysqli_query($con, "UPDATE usuarios SET puntosdar = puntosdar - $dar WHERE id = " . $id_user);

      // Actualizar puntos del post
      mysqli_query($con, "UPDATE posts SET puntos = puntos + $dar WHERE id = " . $id_post);

      // Insertar registro que vincula la puntuación del dador con el post del receptor
      mysqli_query($con, "INSERT INTO puntos (num, id_punteador, puntos, fecha) VALUES ($id_post, $id_user, $dar, NOW())");
    } else {
      alert('S&oacute;lo puedes dar puntos una vez por cada post');
    }
  }

  if ($dar == '' || $dar == 0) {
    alert('&iexcl;No tienes m&aacute;s puntos!');
  }
}

mysqli_close($con);

redirect($pag);

?>