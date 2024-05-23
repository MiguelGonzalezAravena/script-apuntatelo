<?php
require_once(dirname(dirname(__FILE__)) . '/header.php');


$user = isset($_SESSION['user']) ? $_SESSION['user'] : '';
$id_user = isset($_SESSION['id']) ? $_SESSION['id'] : '';
$para = isset($_REQUEST['para']) ? no_injection($_REQUEST['para']) : '';
$asunto = isset($_REQUEST['asunto']) ? no_injection($_REQUEST['asunto']) : '';
?>
<div class="bordes">
<?php
if ($user != '') {
?>
  <br />
  <table align="center" width="900" height="300" valign="top" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="167" valign="top">
        <br />
        <?php require_once(dirname(__FILE__) . '/menu.php'); ?>
      </td>
      <td valign="top">
        <form name="redactar" method="POST" action="<?php echo $url; ?>/mensajes/enviar.php">
          <input type="hidden" name="pag" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />
          <table style="padding: 15px;" cellspacing="0" cellpadding="0">
            <tr>
              <td colspan="2"> 
                <div class="esq1" style="float: left;"></div>
                <div class="franja" style="float: left; width: 600px;"><div style="padding-top: 2px;">Redactar</div></div>
                <div class="esq2" style="float: left;"></div>
              </td>
            </tr>
            <tr class="fondo_cuadro">
              <td style="font-size: 11px; padding: 8px;">
                Para:
              </td>
              <td>
                <input type="text" name="para" style="width: 190px; height: 20px; font-size: 10px;" value="<?php echo $para; ?>" maxlenght="35" placeholder="Usuario"  />
              </td>
            </tr>
            <tr class="fondo_cuadro">
              <td style="font-size: 11px; padding: 8px;">
                Asunto:
              </td>
              <td>
                <input type="text" name="asunto" style="width: 300px; height: 20px; font-size: 10px;" value="<?php echo $asunto; ?>" maxlenght="200" placeholder="Sin t&iacute;tulo" />
              </td>
            </tr>
            <tr class="fondo_cuadro">
              <td style="font-size: 11px; padding: 8px;">
                Mensaje:&nbsp;
              </td>
              <td>
                <textarea name="contenido" style="width: 500px; height: 200px; font-size: 12px;" placeholder="Cuerpo del mensaje"></textarea>
              </td>
            </tr>
            <tr class="fondo_cuadro">
              <td colspan="2" align="right" style="padding: 8px;">
                <input type="submit" value="Enviar" class="submit_button" />
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