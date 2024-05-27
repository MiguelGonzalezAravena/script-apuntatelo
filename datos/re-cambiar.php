<?php
require_once(dirname(dirname(__FILE__)) . '/includes/configuracion.php');
require_once(dirname(dirname(__FILE__)) . '/includes/funciones.php');

$id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
$id_secret = isset($_POST['id_secret']) ? no_injection($_POST['id_secret']) : '';
$action = isset($_GET['action']) ? no_injection($_GET['action']) : '';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  <title><?php echo $name; ?> - Tu link-sharing de apuntes</title>
  <link href="<?php echo $images; ?>/logo/icono.bmp" rel="shortcut icon"/>
  <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
  <link rel="stylesheet" type="text/css" href="<?php echo $url; ?>/estilos/index.css" />
</head>
<body>
  <table align="center">
    <tr>
      <td>
        <div class="logo"></div>
      </td>
    </tr>
  </table>
  <br />
  <br />
</body>
<?php
$password1 = isset($_POST['password1']) ? no_injection($_POST['password1']) : '';
$password2 = isset($_POST['password2']) ? no_injection($_POST['password2']) : '';

if ($password1 != '' && $password1 == $password2 && strlen($password1) > 5) {
  $password = md5($password1);
  $sql = "
    SELECT nick
    FROM usuarios
    WHERE id = $id
    AND id_secret = '$id_secret'";

  $request = mysqli_query($con, $sql);

  if (mysqli_num_rows($request) > 0) {
    $id_secret = md5(uniqid(rand(), true));

    $sql = "
      UPDATE usuarios
      SET id_secret = '$id_secret', password = '$password'
      WHERE id = $id'";

    mysqli_query($con, $sql);
    mysqli_close($con);

    redirect($url . '/notificaciones/re-password-correcto.php');
  } else {
    redirect($url . '/notificaciones/re-password-error.php');
  }
} else {
  redirect($url . "/datos/re-password.php?id=$id?$id_secret&action=error");
}

?>