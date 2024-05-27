<?php
require_once(dirname(dirname(__FILE__)) . '/header.php');
$user = isset($_SESSION['user']) ? $_SESSION['user'] : '';
$passwordant = isset($_POST['passwordant']) ? no_injection($_POST['passwordant']) : '';
$password1 = isset($_POST['password1']) ? no_injection($_POST['password1']) : '';
$password2 = isset($_POST['password2']) ? no_injection($_POST['password2']) : '';
?>
<table align="center">
  <tr>
    <td>
      <div class="logo"></div>
    </td>
  </tr>
</table>
<br />
<br />
<?php
if ($user != null) {
  if ($passwordant != '' && $password1 != '' && $password1 == $password2 && strlen($password1) > 5) {
    $sql = "
      SELECT password
      FROM usuarios
      WHERE nick = '$user'";

    $request = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($request)) {
      $passwordbase = $row['password'];
    }

    $passwordant = md5($passwordant);
    $password = md5($password1);

    if ($passwordant == $passwordbase) {
      $id_secret = md5(uniqid(rand(), true));
      $sql = "
        UPDATE usuarios
        SET id_secret = '$id_secret', password = '$password'
        WHERE nick = '$user'";

      mysqli_query($con, $sql);

      echo "El cambio fue realizado. Por favor loguearse nuevamente con la nueva clave.";
    } else {
      echo '<div align="center">La contrase&ntilde;a anterior es incorrecta.</div>';
      echo '<br />';
      echo '<br />' ;
      echo '<div align="center">Para intentar nuevamente presione <a href="' . $url . '/datos/password.php"><font color="gray">aqu&iacute;</font></a></div>';
    }

    mysqli_close($con);
  } else {
    echo '<div align="center">Datos incorrectos. Recuerda que la contrase&ntilde;a tiene que tener m&aacute;s de 6 caracteres.</div>';
    echo '<br />';
    echo '<br />';
    echo '<div align="center">Para intentar nuevamente presione <a href="' . $url . '/datos/password.php"><font color="gray">aqu&iacute;</font></a></div>';
  }
} else {
  echo '<div align="center">Ocurri&oacute; un error</div>';
}

?>