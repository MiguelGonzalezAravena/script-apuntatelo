<?php
require_once(dirname(dirname(__FILE__)) . '/header.php');
$nick = isset($_SESSION['user']) ? $_SESSION['user'] : 'Invitado';
?>
<div class="bordes">
  <br /><br /><br /><br /><br /><br /><br /><br /><br />
  <form name="ingreso" method="post" action="<?php echo $url; ?>/chat/">
    <input type="hidden" name="nick" value="<?php echo $nick; ?>" />
    <input type="hidden" name="miembro" value="0" />
    <table align="center">
      <tr>
        <td align="center">
          <div class="size12">
            Est&aacute;s por ingresar al chat. <br /><br />
            No te olvides que queda totalmente prohibido insultar, generar desorden y/o introducir spam dentro del mismo.<br /><br />
            Si quieres entrar con un nick propio, tienes que registrarte al sitio. Lo puedes hacer desde <a href="<?php echo $url; ?>/registro/">ac&aacute;</a>.
          </div>
        </td>
      </tr>
      <tr>
        <td align="center">
          <br />
          <input type="button" name="boton" class="submit_button" style="font-size:15px" value="Ingresar" onclick="submit();" />
        </td>
      </tr>
    </table>
  </form>
  <br /><br /><br /><br /><br /><br /><br /><br /><br />
<?php
require_once(dirname(dirname(__FILE__)) . '/footer.php');
?>
</div>