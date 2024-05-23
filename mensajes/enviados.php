<?php
require_once(dirname(dirname(__FILE__)) . '/header.php');
$id_user = isset($_SESSION['id']) ? $_SESSION['id'] : '';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <script type="text/javascript">
      function mensajes_check_all(f) {
        var inputs = document.getElementsByTagName('input');
        
        for (var i = 1; i < inputs.length; i++) {
          if (inputs.item(i).type == 'checkbox' && inputs.item(i).name.substring(0, 2) == 'o_') {
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
    SELECT m.id_mensaje, m.asunto, m.fecha, m.id_receptor, m.leido_emisor, s.nick
    FROM mensajes AS m
    INNER JOIN usuarios AS s ON m.id_receptor = s.id
    WHERE m.id_emisor = $id_user
    AND eliminado_emisor = 0
    ORDER BY id_mensaje DESC";

  $_pagi_cuantos = 10;
  $_pagi_nav_num_enlaces = 3;
  require_once(dirname(dirname(__FILE__)) . '/includes/paginator.inc.php');
?>
      <br />
      <form name="salida" method="POST" action="<?php echo $url; ?>/mensajes/acciones.php">
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
                    <div class="franja" style="float: left; width: 634px;"><div style="padding-top: 2px;">Mensajes enviados</div></div>
                    <div class="esq2" style="float: left;"></div>
                  </td>
                </tr>
                <tr style="font-size:11px; background-color: #ababab;">
                  <td width="50">
                    <input type="checkbox" onclick="mensajes_check_all(this.checked)" />
                  </td>
                  <td width="250">
                    Asunto
                  </td>
                  <td width="200"> 
                    Destinatario
                  </td>
                  <td width="150">
                    Fecha
                  </td>
                </tr>
<?php
  $i = 0;
  while ($row = mysqli_fetch_array($_pagi_result)) {
?>
                <tr style="font-size: 11px; background-color: #D3D3D3;">
                  <td width="50">
                    <input type="checkbox" name="i_<?php echo $i; ?>" value="<?php echo $row['id_mensaje']; ?>" />
                  </td>
                  <td width="250">
                    <a href="<?php echo $url; ?>/mensajes/mensajes_enviados.php?mensaje=<?php echo $row['id_mensaje']; ?>"><?php echo no_injection($row['asunto']); ?></a>
                  </td>
                  <td width="200"> 
                    <?php echo $row['nick']; ?>
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
                  <td colspan="4" style="font-size: 11px;">
                    <br />
                    <input type="hidden" name="cant_check" value="<?php echo $i; ?>" />
                    <input type="hidden" name="accion" value="elim_env" />
                    <input type="submit" value="Eliminar" class="submit_button" />
                    (Los mensajes seleccionados no ir&aacute;n a la papelera, se eliminar&aacute;n autom&aacute;ticamente) 
                  </td>
                </tr>
              </table>
            </form>
          </td>
        </tr>
      </table>
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