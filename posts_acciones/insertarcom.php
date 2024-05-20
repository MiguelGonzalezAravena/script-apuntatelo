<?php
require_once(dirname(dirname(__FILE__)) . '/includes/configuracion.php');
require_once(dirname(dirname(__FILE__)) . '/includes/funciones.php');
require_once(dirname(dirname(__FILE__)) . '/login.php');

$num = isset($_POST['num']) ? (int) $_POST['num'] : 0;
$pag = isset($_POST['pagina']) ? no_injection($_POST['pagina']) : '/';
$autor = isset($_POST['variable']) ? no_injection($_POST['variable']) : '';
$id_autor = isset($_POST['variable2']) ? (int) $_POST['variable2'] : 0;
$user = isset($_SESSION['user']) ? $_SESSION['user'] : '';
$id_user = isset($_SESSION['id']) ? $_SESSION['id'] : '';
$comment = isset($_POST['cuerpo']) ? no_injection($_POST['cuerpo']) : '';

$sql = "
  SELECT coments
  FROM posts
  WHERE id = " . $num;

$request = mysqli_query($con, $sql);

while ($row = mysqli_fetch_array($request)) {
  $coments = $row['coments'];
}

// Guardar el mensaje
if ($num == '' || $autor == '' || $id_autor != $id_user || $autor != $user || $coments != 0) {
  redirect($url);
} else {
  mysqli_query($con, "UPDATE posts SET comentarios = comentarios + 1 WHERE id = " . $num);
  mysqli_query($con, "UPDATE usuarios SET numcomentarios = numcomentarios + 1 WHERE id = " . $id_user);
  mysqli_query($con, "UPDATE cantidad SET cant = cant + 1 WHERE id = 2");

  // TO-DO: Agregar registro a tabla "cantidad" donde el id 2 es para comentarios
  
  $sql = "
    INSERT INTO comentarios (id_post, id_autor, autor, comentario, fecha)
    VALUES ($num, $id_autor, '" . $autor . "', '" . $comment . "', NOW())";

  mysqli_query($con, $sql);
  $ult_id = mysqli_insert_id($con);

  redirect($pag);
}
?>