<?php
require_once(dirname(dirname(__FILE__)) . '/header.php');
$id = isset($_GET['id']) ? no_injection($_GET['id']) : '';
?>
<div class="bordes">
  <br />
  <table width="900" align="center" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td colspan="2">
        <div class="esq1" style="float: left;"></div>
        <div class="franja" style="float: left; width: 884px;"><div style="padding-top: 2px;">Posts de <strong><?php echo $id; ?></strong>:</div></div>
        <div class="esq2" style="float: left;"></div>
      </td>
    </tr>
<?php
$sql = "
  SELECT id
  FROM usuarios
  WHERE nick = '$id'";

$rs = mysqli_query($con, $sql);
$row = mysqli_fetch_array($rs);
$id_autor = $row['id']; 
$_pagi_sql = "
  SELECT id, id_autor, titulo, fecha, privado, categoria, puntos, c.imagen, c.link_categoria
  FROM posts AS p
  INNER JOIN categorias AS c ON p.categoria = c.id_categoria
  WHERE id_autor = '$id_autor'
  AND elim = '0'
  ORDER BY id DESC";

$_pagi_cuantos = 20;
$_pagi_nav_num_enlaces = 3;
$sql = "
  SELECT id
  FROM posts
  WHERE id_autor = '$id_autor'
  AND elim = '0'
  ORDER BY id DESC";

$rs = mysqli_query($con, $sql);
require_once(dirname(dirname(__FILE__)) . '/includes/paginator.inc.php');

if (mysqli_num_rows($rs) > 0) {
  while ($row = mysqli_fetch_array($_pagi_result)) {
    $privado = $row['privado'];
    $cant = strlen($row['titulo']);
    
    if ($cant > 30) {
      $titulo2 = substr(stripslashes($row['titulo']), 0, 30);
      $tit = 1;
    } else {
      $titulo2 = $row['titulo'];
      $tit = 0;
    }
?>
    <tr>
      <td width="440" class="fondo_cuadro" style="padding: 2px;">
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
          <?php echo date("d-m-Y H:m:s", strtotime($row['fecha'])); ?>
        </font>
      </td>
    </tr>
<?php
  }

  mysqli_close($con);
?>
    <tr>
      <td>
      </td>
      <td align="right">
        <p><font size="1"><?php echo $_pagi_navegacion; ?></font></p>
      </td>
    </tr>
  </table>
  <br />
</div>
<?php
  require_once(dirname(dirname(__FILE__)) . '/footer.php');
} else {
  redirect($url);
}

?>