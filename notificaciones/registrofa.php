<?php
require_once(dirname(dirname(__FILE__)) . '/header.php');
?>
<div class="bordes">
  <table width="100%" height="365" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="25%" height"120" align="center"></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td width="35%" height="30%" align="center"></td>
      <td width="30%" height="35%" align="left" valign="top" class="fondo_cuadro">
        <table cellpadding="0" cellspacing="0" width="387" align="center" border="0">
          <tr>
            <td></td>
            <td>
              <div class="esq1" style="float: left;"></div>
              <div class="franja" style="float: left; width: 371px;"><div style="padding-top: 2px;">Error en el registro</div></div>
              <div class="esq2" style="float: left;"></div>
            </td>
          </tr>
        </table>
        <br />
        <div align="center"><font size="2">Ha ocurrido un error al activar el usuario. Revisa tu correo nuevamente y vuelve a confirmarlo. Si no funciona, favor de comunicarse con los administradores del sitio a <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></font></div> 
      </td>
      <td width="35%" height="30%" align="center"></td>
    </tr>
    <tr>
      <td width="25%" height="30%" align="center"></td>
      <td></td>
      <td></td>
    </tr>
  </table>
<?php
require_once(dirname(dirname(__FILE__)) . '/footer.php');
?>
</div>