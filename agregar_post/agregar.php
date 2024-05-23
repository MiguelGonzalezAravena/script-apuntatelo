<?php
require_once(dirname(dirname(__FILE__)) . '/includes/configuracion.php');
require_once(dirname(dirname(__FILE__)) . '/includes/funciones.php');
require_once(dirname(dirname(__FILE__)) . '/login.php');

$id_autor = isset($_POST['variable']) ? (int) $_POST['variable'] : 0;
$id_autor2 = isset($_SESSION['id']) ? $_SESSION['id'] : '';
$titulo = isset($_POST['titulo']) ? no_injection($_POST['titulo']) : '';
$mensaje = isset($_POST['cuerpo']) ? no_injection($_POST['cuerpo']) : '';
$categoria = isset($_POST['categoria']) ? (int) $_POST['categoria'] : 0;
$privado = isset($_POST['privado']) ? (int) $_POST['privado'] : 0;
$coments = isset($_POST['coments']) ? (int) $_POST['coments'] : 0;
$tags = isset($_POST['tags']) ? no_injection($_POST['tags']) : '';

if ($id_autor == $id_autor2) {
  if ($titulo == '') {
    alert('El t&iacute;tulo es obligatorio');
    redirect($url . '/agregar_post/');
  } else if ($mensaje == '') {
    alert('El contenido es obligatorio');
    redirect($url . '/agregar_post/');
  } else if ($categoria == '-1') {
    alert('La categor&iacute;a es obligatoria');
    redirect($url . '/agregar_post/');
  } else {
    $elim = 0;
    $comentarios = 0;

    // Guardar el post
    $sql = "
      INSERT INTO posts (elim, id_autor, titulo, contenido, fecha, privado, coments, comentarios, categoria, tags) 
      VALUES ($elim, $id_autor, '$titulo', '$mensaje', NOW(), $privado, $coments, $comentarios, $categoria, '$tags')";
    mysqli_query($con, $sql);

    // Obtener el último id insertado
    $ult_id = mysqli_insert_id($con);

    // Actualizar contadores
    mysqli_query($con, "UPDATE usuarios SET numposts = numposts + 1 WHERE id = " . $id_autor);
    mysqli_query($con, "UPDATE cantidad SET cant = cant + 1 WHERE id = 1");

    redirect($url . '/notificaciones/c5.php?id=' . $ult_id . '&c=' . $categoria . '&t=' . $titulo);
  }
} else {
  redirect($url . '/agregar_post/');
}

?>