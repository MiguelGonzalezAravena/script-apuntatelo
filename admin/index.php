<?php
require_once(dirname(dirname(__FILE__)) . '/header.php');
require_once(dirname(dirname(__FILE__)) . '/includes/configuracion.php');

$user = isset($_SESSION['user']) ? $_SESSION['user'] : '';
$rango = rango_propio($user);
?>
<div class="bordes">
  <br />
<?php
if ($rango == 'Moderador' || $rango == 'Administrador') {
?>
  <table align="center" width="400" height="300" cellspacing="0" cellpadding="0">
    <tr>
      <td>
        <div class="esq1" style="float: left;"></div>
        <div class="franja" style="float: left; width: 384px;"><div style="padding-top: 2px;">Panel de moderadores</div></div>
        <div class="esq2" style="float: left;"></div>
      </td>
    </tr>
    <tr>
      <td class="fondo_cuadro" valign="top" style="padding: 3px;">
        <br />
        <font size="2">
          <div align="center">Bienvenido <b><?php echo $_SESSION['user']; ?></b></div>
          <br /><br /><br />
          Ir a panel <a href="<?php echo $url; ?>/admin/usuarios.php">Usuarios</a> - (S&oacute;lo admins)<br /><br />
          Ir a panel <a href="#">Informaci&oacute;n moderadores</a> - (En construcci&oacute;n)<br /><br />
          Ir a panel <a href="<?php echo $url; ?>/admin/stickies.php">Stickies</a> - (S&oacute;lo admins)<br /><br />
          Ir a panel <a href="<?php echo $url; ?>/admin/users_suspendidos.php">Usuarios suspendidos</a><br /><br />
          Ir a panel <a href="#">Denuncias</a> - (En construcci&oacute;n)
          <br /><br />
        </font>
      </td>
    </tr>
  </table>
  <br /><br />
<?php
} else {
  header('Location: ' . $url . '/admin/');
}
?>
</div>
<?php
require_once(dirname(dirname(__FILE__)) . '/footer.php');
?>
