<?php
require_once(dirname(dirname(__FILE__)) . '/header.php');

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$action = isset($_GET['action']) ? no_injection($_GET['action']) : '';
$id2 = explode('?', $id);
$id = $id2[0];
$id_secret = $id2[1];
?>
<div class="bordes">
<?php
$sql = "
  SELECT nick
  FROM usuarios
  WHERE id = $id
  AND id_extreme = '$id_secret'";

$request = mysqli_query($con, $sql);

if (mysqli_num_rows($request) > 0) {
  $row = mysqli_fetch_array($request);
?>
  <br /><br /><br /><br /><br />
  <form name="password" method="post" action="<?php echo $url; ?>/datos/re-cambiar.php">
    <input type="hidden" name="id" value="<?php echo $id; ?>" />
    <input type="hidden" name="id_extreme" value="<?php echo $id_secret; ?>" />
    <table align="center" cellspacing="0" cellpadding="0">
<?php
  if ($action == 'error') {
?>
      <tr>
        <td colspan="2" align="center">
          <font size="2" color="red"><b>Las contrase&ntilde;as no coinciden y/o tienen menos de 6 caracteres.</b></font>  
          <br /><br />
        </td>
      </tr>
<?php
  }
?>
      <tr>
        <td colspan="2" align="center">
          <div class="esq1" style="float: left;"></div>
          <div class="franja" style="float: left; width: 471px;"><div style="padding-top: 2px;"><?php echo $row['nick']; ?></div></div>
          <div class="esq2" style="float: left;"></div>
        </td>
      </tr>
      <tr>
        <td class="fondo_cuadro" style="padding: 5px;">
          <font size="2"><b>Nueva contrase&ntilde;a:</b></font>  
        </td>
        <td class="fondo_cuadro" style="padding: 5px;">
          <input type="password" name="password1" />
        </td>
      </tr>
      <tr>
        <td class="fondo_cuadro" style="padding: 5px;">
          <font size="2"><b>Confirmar nueva contrase&ntilde;a:</b></font> 
        </td>
        <td class="fondo_cuadro" style="padding: 5px;">
          <input type="password" name="password2" />
        </td>
      </tr>
      <tr>
        <td class="fondo_cuadro"></td>
        <td class="fondo_cuadro" style="padding: 5px;">
          <input type="submit" class="submit_button" name="cambiar" value="Cambiar" />
        </td>
      </tr>
    </table>
  </form>
  <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<?php
} else {
  // ¿Qué hace?
}
?>
</div>
<?php
require_once(dirname(dirname(__FILE__)) . '/footer.php');
?>