<?php
require_once(dirname(dirname(__FILE__)) . '/includes/configuracion.php');
require_once(dirname(dirname(__FILE__)) . '/login.php');

$user = isset($_SESSION['user']) ? $_SESSION['user'] : '';
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
<?php
// TO-DO: Definir $user
if ($user != '') {
?>
    <form name="password" method="post" action="<?php echo $url; ?>/datos/cambiar.php">
      <table align="top">
        <tr>
          <td>
            <font size="2"><b>Usuario:</b></font> 
          </td>
          <td>
            <font size="2"><?php echo $_SESSION['user']; ?></font> 
          </td>
        </tr>
        <tr>
          <td>
            <font size="2"><b>Contrase&ntilde;a actual:</b></font> 
          </td>
          <td>
            <input type="password" name="passwordant" />
          </td>
        </tr>
        <tr>
          <td>
            <font size="2"><b>Nueva contrase&ntilde;a:</b></font>
          </td>
          <td>
            <input type="password" name="password1" />
          </td>
        </tr>
        <tr>
          <td>
            <font size="2"><b>Confirmar nueva contrase&ntilde;a:</b></font> 
          </td>
          <td>
            <input type="password" name="password2" />
          </td>
        </tr>
        <tr>
          <td></td>
          <td>
            <input type="submit" class="submit_button" name="cambiar" value="Cambiar" />
          </td>
        </tr>
      </table>
    </form>
<?php
} else {
  echo '<div align="center">Ocurri&oacute; un error...</div>';
}
?>
  </body>
</html>