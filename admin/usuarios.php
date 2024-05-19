<?php
require_once(dirname(dirname(__FILE__)) . '/header.php');
require_once(dirname(dirname(__FILE__)) . '/includes/configuracion.php');

$user = isset($_SESSION['user']) ? $_SESSION['user'] : '';
$rango = rango_propio($user);
?>
<div class="bordes">
  <br />
<?php
if ($rango == 'Administrador') {
  $id_buscar = isset($_POST['id_buscar']) ? (int) $_POST['id_buscar'] : '';
  $cadena = $id_buscar != '' ? "WHERE id = $id_buscar" : '';
?>
  <table align="center" width="275" cellspacing="0" cellpadding="0">
    <tr>
      <td>
        <div class="esq1" style="float: left;"></div>
        <div class="franja" style="float: left; width: 259px;"><div style="padding-top: 2px;">Filtrado</div></div>
        <div class="esq2" style="float: left;"></div>
      </td>
    </tr>
    <tr>
      <td class="fondo_cuadro" valign="top" style="padding: 3px;"><br>
        <form name="buscar_user" method="post" action="">
          <font size="2">Id Usuario: </font>
          <input type="text" name="id_buscar" size="15" value="<?php echo $id_buscar; ?>" />
          <input type="submit" class="submit_button" name="Filtrar" value="Filtrar" />
        </form>
      </td>
    </tr>
  </table>
  <br />
  <table align="center" width="700" cellspacing="0" cellpadding="0">
    <tr>
      <td>
        <div class="esq1" style="float: left;"></div>
        <div class="franja" style="float: left; width: 684px;"><div style="padding-top: 2px;">Panel usuarios</div></div>
        <div class="esq2" style="float: left;"></div>
      </td>
    </tr>
    <tr>
      <td class="fondo_cuadro" valign="top" style="padding: 3px;">
        <br />
        <font size="2">
          <table border="1">
<?php
  $_pagi_sql = "
    SELECT activacion, id, nick, nombre, mail, sexo 
    FROM usuarios
    $cadena
    ORDER BY id ASC";

  $request = mysqli_query($con, $_pagi_sql);

  if (mysqli_num_rows($request) > 0) {
?>
            <tr>
              <td>
                <font size="1">ID</font>
              </td>
              <td>
                <font size="1">Activo</font>
              </td>
              <td>
                <font size="1">Nick</font>
              </td>
              <td>
                <font size="1">Nombre</font>
              </td>
              <td>
                <font size="1">Correo</font>
              </td>
              <td>
                <font size="1">Sexo</font>
              </td>
            </tr>
<?php
    $_pagi_cuantos = 30;
    $_pagi_nav_num_enlaces = 3;
    require_once(dirname(dirname(__FILE__)) . '/includes/paginator.inc.php');

    while ($row = mysqli_fetch_array($_pagi_result)) {
      $activacion = $row['activacion'];
      $id_usuario = $row['id'];
      $nick = $row['nick'];
      $nombre = $row['nombre'];
      $mail = $row['mail'];
      $sexo = $row['sexo'];
?>	
            <tr>
              <td width="25">
                <font size="1" color="black"><b><?php echo $id_usuario; ?></b>
              </td>
              <td width="200">
                <font size="1" color="black"><b><?php echo $activacion; ?></b>
              </td>
              <td width="200">
                <font size="1" color="black"><b><a href="<?php echo $url; ?>/perfil/<?php echo $nick; ?>/"><?php echo $nick; ?></a></b>
              </td>
              <td width="500">
                <font size="1" color="black"><b><?php echo $nombre; ?></b>
              </td>
              <td width="500">
                <font size="1" color="black"><b><?php echo $mail; ?></b></font>
              </td>
              <td width="60">
                <font size="1" color="black"><b><?php echo sexo($sexo); ?></b>
              </td>
            </tr>
<?php
    }
  } else {
    echo 'No existe el usuario.';
  }

  mysqli_close($con);
?>
          </table>
        </font>
      </td>
    </tr>
    <tr>
      <td colspan="6" align="right">
        <table>
          <tr>
            <td></td>
            <td align="right">
              <?php echo '<p><font size="1">' . $_pagi_navegacion . '</font></p>'; ?> 
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
<?php
} else {
  header('Location: ' . $url . '/admin/');
}
?>
</div>
<?php
require_once(dirname(dirname(__FILE__)) . '/footer.php');
?>