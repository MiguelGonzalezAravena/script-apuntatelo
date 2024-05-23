<?php
require_once(dirname(dirname(__FILE__)) . '/header.php');
$id_user = isset($_SESSION['id']) ? $_SESSION['id'] : '';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <script type="text/javascript">
      function mensajes_check_all(f) {
        var inputs=document.getElementsByTagName('input');

        for (var i = 1; i < inputs.length; i++) {
          if (inputs.item(i).type == 'checkbox' && inputs.item(i).name.substring(0, 2) == 'i_') {
            inputs.item(i).checked = f;
          }
        }
      }
    </script>
  </head>
  <body>
    <div class="bordes">
<?php
if ($id_user != '') {
  $_pagi_sql = "
    SELECT m.id_mensaje, m.asunto, m.fecha, m.id_receptor, m.leido_receptor, s.nick
    FROM mensajes AS m
    INNER JOIN usuarios AS s ON m.id_emisor = s.id
    WHERE m.id_receptor = $id_user
    AND m.id_carpeta = 0
    AND m.papelera_receptor = 0
    AND m.eliminado_receptor = 0
    ORDER BY id_mensaje DESC";

  $_pagi_cuantos = 10;
  $_pagi_nav_num_enlaces = 3;
  require_once(dirname(dirname(__FILE__)) . '/includes/paginator.inc.php');
?>
      <br />
      <form name="entrada" method="POST" action="<?php echo $url; ?>/mensajes/acciones.php">
        <input type="hidden" name="pag" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />
        <table align="center" width="900" height="300" valign="top" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="167" valign="top">
              <br />
              <?php require_once(dirname(__FILE__) . '/menu.php'); ?>
            </td>
            <td valign="top">
              <br />
              <table style="padding-left: 20px;" cellspacing="0" cellpadding="0">
                <tr>
                  <td colspan="4"> 
                    <div class="esq1" style="float: left;"></div>
                    <div class="franja" style="float: left; width: 634px;"><div style="padding-top: 2px;">Bandeja de entrada</div></div>
                    <div class="esq2" style="float: left;"></div>
                  </td>
                </tr>
                <tr style="font-size: 11px; background-color: #ABABAB;">
                  <td width="50">
                    <input type="checkbox" alt="Seleccionar todos" onclick="mensajes_check_all(this.checked)" />
                  </td>
                  <td width="250">
                    Asunto
                  </td>
                  <td width="200"> 
                    Remitente
                  </td>
                  <td width="150">
                    Fecha
                  </td>
                </tr>
<?php
  $i = 0;
  while ($row = mysqli_fetch_array($_pagi_result)) {
?>
                <tr style="font-size: 11px; background-color: <?php echo ($row['leido_receptor'] == 0 ? '#FFF3BF;' : '#D3D3D3;'); ?>">
                  <td width="50">
                    <input type="checkbox" name="i_<?php echo $i; ?>" value="<?php echo $row['id_mensaje']; ?>" />
                  </td>
                  <td width="250">
                    <a href="<?php echo $url; ?>/mensajes/mensajes_recibidos.php?mensaje=<?php echo $row['id_mensaje']; ?>" alt="Ver mensaje">
                      <?php echo no_injection($row['asunto']); ?>
                    </a>
                  </td>
                  <td width="200"> 
                    <a href="<?php echo $url; ?>/perfil/<?php echo $row['nick']; ?>/" alt="Ver Perfil">
                      <?php echo $row['nick']; ?>
                    </a>
                  </td>
                  <td width="150">
                    <?php echo $row['fecha']; ?>
                  </td>
                </tr>
<?php
    $i++;
  }
?>
                <tr>
                  <td colspan="4" align="right">
                    <p><font size="1"><?php echo $_pagi_navegacion; ?></font></p>
                  </td>
                </tr>
                <tr>
                  <td valign="top" colspan="2" align="right">
                    <br />
                    <select name="accion">
                      <option value="elim">Eliminar</option>
<?php
  $sql = "
    SELECT *
    FROM carpetas
    WHERE id_usuario = $id_user";

  $request = mysqli_query($con, $sql) or die(mysqli_error($con));
  $rows = mysqli_num_rows($request);

  if ($rows > 0) {
    while ($row = mysqli_fetch_array($request)) {
?>
                      <option value="<?php echo $row['id_carpeta']; ?>">Mover a <?php echo $row['nom_carpeta']; ?></option>
<?php
    }
  }
?>
                    </select>
                    &nbsp;
                  </td>
                  <td valign="top">
                    <br />
                    <input type="hidden" name="cant_check" value="<?php echo $i; ?>" />
                    <input type="submit" value="Ejecutar" class="submit_button" />
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </form>
      <br /><br />
<?php
} else {
  redirect($url);
}

require_once(dirname(dirname(__FILE__)) . '/footer.php');
?>
    </div>
  </body>
</html>