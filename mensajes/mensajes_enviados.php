<?php
require_once(dirname(dirname(__FILE__)) . '/header.php');

$user = isset($_SESSION['user']) ? $_SESSION['user'] : '';
$id_user = isset($_SESSION['id']) ? $_SESSION['id'] : '';
$id_mensaje = isset($_GET['mensaje']) ? (int) $_GET['mensaje'] : 0;
?>
<div class="bordes">
<?php
// TO-DO: Verificar si el mensaje existre o si está vacío.
// id_mensaje == 0 || mysqli_num_rows($rqeust) == 0 o null
if ($user != '') {
  $sql = "
    SELECT m.asunto, m.contenido, m.fecha, m.id_receptor, s.nick 
    FROM mensajes AS m
    INNER JOIN usuarios AS s ON m.id_emisor = s.id
    WHERE m.id_mensaje = $id_mensaje
    AND m.id_emisor = $id_user
    ORDER BY id_mensaje DESC";

  $request = mysqli_query($con, $sql);
  $row = mysqli_fetch_array($request);
?>
  <br />
  <table align="center" width="90%" height="300" valign="top" border="0">
    <tr>
      <td width="200" valign="top">
        <br />
        <?php require_once(dirname(__FILE__) . '/menu.php'); ?>
      </td>
      <td valign="top">
        <br />
        <table style="padding: 15px;" border="0">
          <tr>
            <td style="font-size: 12px; font-weight: bold;">
              De:
            </td>
            <td style="font-size: 12px;">
              <?php echo $row['nick']; ?>
            </td>
          </tr>
          <tr>
            <td style="font-size: 12px; font-weight: bold;">
              Fecha:
            </td>
            <td align="left" style="font-size: 12px;">
              <?php echo $row['fecha']; ?>
            </td>
          </tr>
          <tr>
            <td style="font-size: 12px; font-weight: bold;">
              Asunto:
            </td>
            <td align="left" style="font-size: 12px;">
              <?php echo no_injection($row['asunto']); ?>
            </td>
          </tr>
          <tr>
            <td width="30" style="font-size: 12px; font-weight: bold;">
              <br />
              Mensaje:
            </td>
            <td></td>
          </tr>
          <tr>
            <td valign="top" colspan="2" style="padding: 3px; font-size: 12px; width: 600px; height: 200px; border-width: 1px; border-style: solid; background-color: #D3D3D3;">
              <?php echo bbparse($row['contenido']); ?>
            </td>
          </tr>
          <tr>
            <td colspan="2" style="font-size: 12px; font-weight: bold;">
              <table>
                <tr>
                  <td valign="top">
                    <form name="responder" method="POST" action="<?php echo $url; ?>/mensajes/redactar.php">
                      <input type="hidden" name="para" value="<?php echo $row['nick']; ?>" />
                      <input type="hidden" name="asunto" value="<?php echo "RE: ".$row['asunto']; ?>" />
                      <input type="button" value="Responder" style="border-width: 0px; font-size: 12px; font-weight: bold; padding: 4px;" onclick="submit();" />
                    </form>
                  </td>
                  <td valign="top">
                    <input type="button" value="Eliminar" style="border-width: 0px; font-size: 12px; font-weight: bold; padding: 4px;" />
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
  <br><br />
<?php
  $sql = "
    UPDATE mensajes
    SET leido_emisor = 1
    WHERE id_mensaje = $id_mensaje
    AND id_emisor = $id_user";

  mysqli_query($con, $sql);
} else {
  redirect($url);
}

require_once(dirname(dirname(__FILE__)) . '/footer.php');
?>
</div>