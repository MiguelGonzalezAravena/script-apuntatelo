<?php
// PERFIL
require_once(dirname(dirname(__FILE__)) . '/header.php');
?>
<div class="bordes">
<?php
$id = isset($_GET['id']) ? no_injection($_GET['id']) : '';
$sql = "
  SELECT id, nick, rango, puntos, avatar, pais, ciudad, sexo, mensajero, mensaje, fecha, numposts, numcomentarios
  FROM usuarios
  WHERE nick = '" . $id . "'";

$rs = mysqli_query($con, $sql);

if (mysqli_num_rows($rs) > 0) {
  while ($row = mysqli_fetch_array($rs)) {
    $id_autor = $row['id'];
?>
  <div align="center">
    <br />
    <h3>Perfil de <?php echo $row['nick']; ?></h3>
    <img src="<?php echo $row['avatar']; ?>" style="display: block; margin: auto; border-radius: 5px; width: 150px" border="0" alt="Avatar de <?php echo $row['nick']; ?>" title="Avatar de <?php echo $row['nick']; ?>" />
    <br />
    <table>
      <tr>
        <td align="right">
          <div class="size12">
            <b>Rango:</b>
          </div>
        </td>
        <td align="left">
          <div class="size12"><?php echo $row['rango']; ?></div>
        </td>
      </tr>
      <tr>
        <td align="right">
          <div class="size12"><b>Usuario N°:</b></div>
        </td>
        <td align="left">
          <div class="size12"><?php echo $row['id']; ?></div>
        </td>
      </tr>
      <tr>
        <td align="right">
          <div class="size12"><b>Sexo:</b></div>
        </td>
        <td align="left">
          <div class="size12">
            <img title="<?php echo sexo($row['sexo']); ?>" src="<?php echo $images; ?>/<?php echo sexo($row['sexo']); ?>.png" />
          </div>
        </td>
      </tr>
      <tr>
        <td align="right">
          <div class="size12"><b>Pa&iacute;s:</b></div>
        </td>
        <td align="left">
          <div class="size12">
            <img title="<?php echo pais($row['pais']); ?>" src="<?php echo $images; ?>/banderas/<?php echo $row['pais']; ?>.png" />
          </div>
        </td>
      </tr>
      <tr>
        <td align="right">
          <div class="size12"><b>Ciudad:</b></div>
        </td>
        <td align="left">
          <div class="size12"><?php echo $row['ciudad']; ?></div>
        </td>
      </tr>
      <tr>
        <td align="right">
          <div class="size12"><b>Mensajero:</b></div>
        </td>
        <td align="left">
          <div class="size12"><?php echo $row['mensajero']; ?></div>
        </td>
      </tr>
      <tr>
        <td align="right">
          <div class="size12"><b>Mensaje:</b></div>
        </td>
        <td align="left">
          <div class="size12"><?php echo $row['mensaje']; ?></div>
        </td>
      </tr>
      <tr>
        <td align="right">
          <div class="size12"><b>Es usuario desde:</b></div>
        </td>
        <td align="left">
          <div class="size12"><?php echo date("d-m-Y H:m:s", strtotime($row['fecha'])); ?></div>
        </td>
      </tr>
      <tr>
        <td align="right">
          <div class="size12"><b>Puntos:</b></div>
        </td>
        <td align="left">
          <div class="size12"><?php echo $row['puntos']; ?></div>
        </td>
      </tr>
      <tr>
        <td align="right">
          <div class="size12"><b>Posts:</b></div>
        </td>
        <td align="left">
          <div class="size12"><?php echo $row['numposts']; ?></div>
        </td>
      </tr>
      <tr>
        <td align="right">
          <div class="size12"><b>Comentarios:</b></div>
        </td>
        <td align="left">
          <div class="size12"><?php echo $row['numcomentarios']; ?></div>
        </td>
      </tr>
    </table>
    <br />
    <table width="900" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="2"> 
          <div class="esq1" style="float: left;"></div>
          <div class="franja" style="float: left; width: 884px;"><div style="padding-top: 2px;">&Uacute;ltimos posts</div></div>
          <div class="esq2" style="float: left;"></div>
        </td>
      </tr>
<?php
    $sql = "
      SELECT id, id_autor, titulo, fecha, privado, categoria, puntos, c.imagen, c.link_categoria
      FROM posts AS p  
      INNER JOIN categorias AS c ON p.categoria = c.id_categoria
      WHERE id_autor = $id_autor
      AND elim = 0
      ORDER BY id DESC
      LIMIT 10";

    $request = mysqli_query($con, $sql);
    
    while ($row = mysqli_fetch_array($request)) {
      $privado = $row['privado'];
      $cant = strlen($row['titulo']);
      $titulo2 = $cant > 38 ? substr(stripslashes($row['titulo']), 0, 38) : $row['titulo'];
      $tit = $cant > 38 ? 1 : 0;
?>
      <tr>
        <td width="420" class="fondo_cuadro" style="padding: 2px;">
          <img src="<?php echo $images; ?>/iconos/<?php echo $row['imagen']; ?>" border="0" />
          <?php echo ($privado == 1 ? '<img src="' . $images . '/iconos/candado.gif" border="0" />' : ''); ?>
          <a href="<?php echo $url; ?>/posts/<?php echo $row['id']; ?>/<?php echo $row['link_categoria']; ?>/<?php echo corregir($row['titulo']) . '.html'; ?>" title="<?php echo $row['titulo']; ?>">
            <font size="2" color="black"><?php echo $titulo2 . ($tit == 1 ? '...' : ''); ?></font>
          </a>
        </td>
        <td class="fondo_cuadro" align="right" style="padding: 2px;">
          <font size="1">
            Puntos:
            <?php echo $row['puntos']; ?>
            |
            Fecha: 
            <?php echo date("d-m-Y H:m:s", strtotime($row['fecha'])); ?>&nbsp;
          </font>
        </td>
      </tr>
<?php
    }
?>
      <tr>
        <td style="padding-top: 10px">
          <input type="button" class="submit_button" value="Ver todos" onclick="location.href='<?php echo $url; ?>/perfil/verposts.php?id=<?php echo $id; ?>'" />
        </td>
      </tr>
    </table>
  </div>
  <br />
  <br />
<?php
  }

  require_once(dirname(dirname(__FILE__)) . '/footer.php');
} else {
  echo $_GET['id'];
?>
Contrase&ntilde;a incorrecta
<!--script type="text/javascript">
  location.href = '..';
</script-->
<?php
}
?>
</div>