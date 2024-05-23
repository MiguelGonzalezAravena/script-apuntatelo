<?php
require_once(dirname(dirname(__FILE__)) . '/header.php');
require_once(dirname(dirname(__FILE__)) . '/includes/configuracion.php');

$user = isset($_SESSION['user']) ? $_SESSION['user'] : '';
$rango = rango_color($user);
?>
<div class="bordes">
  <br />
<?php
if ($rango == 'Administrador') {
?>
  <table align="center" width="700" cellspacing="0" cellpadding="0">
    <tr>
      <td>
        <div class="esq1" style="float: left;"></div>
        <div class="franja" style="float: left; width: 684px;"><div style="padding-top:2px;">Panel stickies</div></div>
        <div class="esq2" style="float: left;"></div>
      </td>
    </tr>
    <tr>
      <td class="fondo_cuadro" valign="top" style="padding: 3px;">
        <br />
        <table border="1">
          <tr>
            <td>
              <font size="1">Orden</font>
            </td>
            <td>
              <font size="1">ID</font>
            </td>
            <td>
              <font size="1">T&iacute;tulo</font>
            </td>
            <td>
              <font size="1">Sticky por</font>
            </td>
          </tr>
<?php
  $sql = "
      SELECT s.id, s.orden, s.id_post, s.elim, s.creador, p.titulo
      FROM stickies AS s
      INNER JOIN posts AS p ON p.id = s.id_post
      WHERE s.elim = 0
      ORDER BY orden DESC";

  $request = mysqli_query($con, $sql);

  while ($row = mysqli_fetch_array($request)) {
    $id = $row['id'];
    $id_post = $row['id_post'];
    $creador = $row['creador'];
    $orden = $row['orden'];
    $titulo = $row['titulo'];
?>
          <tr>
            <td width="57">
              <a href="<?php echo $url; ?>/admin/up.php?id_sticky=<?php echo $id; ?>">
                <img src="<?php echo $images; ?>/iconos/up.gif" alt="Subir" title="Subir" />
              </a>
              <a href="<?php echo $url; ?>/admin/down.php?id_sticky=<?php echo $id; ?>">
                <img src="<?php echo $images; ?>/iconos/down.gif" alt="Bajar" title="Bajar" />
              </a>
            </td>
            <td width="50">
              <a href="<?php echo $url; ?>/posts/<?php echo $id_post; ?>/"><font size="1" color="black"><b><?php echo $id_post; ?></b></a></font>
            </td>
            <td width="500">
              <font size="1" color="black">
                <b><?php echo $titulo; ?></b>
              </font>
            </td>
            <td width="150">
              <font size="1" color="black">
                <b><?php echo $creador; ?></b>
              </font>
            </td>
            <td>
              <a href="javascript:if(confirm('&iquest;Est&aacute;s seguro que deseas eliminar este sticky?')) document.location='<?php echo $url; ?>/admin/eliminar.php?id=<?php echo $id; ?>';" >
                <img src="<?php echo $images; ?>/iconos/delete.gif" alt="Eliminar" title="Eliminar" />
              </a>
            </td>
          </tr>
<?php
  }

  mysqli_close($con);
?>
        </table>
      </td>
    </tr>
  </table>
  <br />
  <table align="center" width="275" cellspacing="0" cellpadding="0">
    <tr>
      <td>
        <div class="esq1" style="float: left;"></div>
        <div class="franja" style="float: left; width: 259px;"><div style="padding-top: 2px;">Agregar nuevo sticky</div></div>
        <div class="esq2" style="float: left;"></div>
      </td>
    </tr>
    <tr>
      <td class="fondo_cuadro" valign="top" style="padding: 3px;">
        <br/>
        <form name="sticky" method="post" action="<?php echo $url; ?>/admin/agregar.php">
          <table width="100%">
            <tr>
              <td align="center">
                <font size="2">ID Post:</font>
                <input type="text" name="id" size="10" />
              </td>
              <td align="center">
                <input type="submit" class="submit_button" name="Agregar" value="Agregar" />
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
  redirect($url . '/admin/');
}
?>
</div>
<?php
require_once(dirname(dirname(__FILE__)) . '/footer.php');
?>