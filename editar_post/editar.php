<?php
require_once(dirname(dirname(__FILE__)) . '/includes/configuracion.php');
require_once(dirname(dirname(__FILE__)) . '/includes/funciones.php');
require_once(dirname(dirname(__FILE__)) . '/login.php');

$id_autor = isset($_POST['variable']) ? (int) $_POST['variable'] : 0;
$id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
$id_user = $_SESSION['id'];
$titulo = isset($_POST['titulo']) ? no_injection($_POST['titulo']) : '';
$mensaje = isset($_POST['cuerpo']) ? no_injection($_POST['cuerpo']) : '';
$categoria = isset($_POST['categoria']) ? (int) $_POST['categoria'] : 0;
$privado = isset($_POST['privado']) ? (int) $_POST['privado'] : 0;
$coments = isset($_POST['coments']) ? (int) $_POST['coments'] : 0;
$tags = isset($_POST['tags']) ? no_injection($_POST['tags']) : '';
$url_editar = $url . '/editar_post/' . $id . '/';

$sql = "
  SELECT elim, id_autor
  FROM posts
  WHERE id = " . $id;

$request = mysqli_query($con, $sql);

while ($row = mysqli_fetch_array($request)) {
  $id_autor2 = $row['id_autor'];
  $elim = $row['elim'];
}

if ($id_user == $id_autor && $id_user == $id_autor2 && $elim == 0) {
  if ($titulo == '') {
    alert('El t&iacute;tulo es obligatorio');
    redirect($url_editar);
  } else if ($mensaje == '') {
    alert('El contenido es obligatorio');
    redirect($url_editar);
  } else if ($categoria == '-1') {
    alert('La categor&iacute;a es obligatoria');
    redirect($url_editar);
  } else {
    // Guardar post
    $sql = "
      UPDATE posts
      SET titulo = '$titulo', contenido = '$mensaje', privado = $privado, coments = $coments, categoria = $categoria, tags = '$tags'
      WHERE id = " . $id;

    mysqli_query($con, $sql);

    redirect($url . '/notificaciones/c6.php?id= ' . $id . '&c=' . $categoria . '&t=' . $titulo);
  }
} else {
  redirect($url_editar);
}

?>