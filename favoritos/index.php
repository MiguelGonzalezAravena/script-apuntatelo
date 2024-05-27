<?php
// FAVORITOS
require_once(dirname(dirname(__FILE__)) . '/header.php');

$var2 = 0;
$orden = isset($_GET['orden']) ? (int) $_GET['orden'] : '';
$categoria = isset($_GET['categoria']) ? (int) $_GET['categoria'] : '-1';
// $action = isset($_GET['action']) ? $_GET['action'] : '';
$id_user = isset($_SESSION['id']) ? $_SESSION['id'] : '';
$user = isset($_SESSION['user']) ? $_SESSION['user'] : '';


$cadena_categoria = '';
if ($categoria >= 0 && $categoria <= 6 && is_numeric($categoria)) {
  $cadena_categoria = "AND p.categoria = $categoria";
}


$cadena_orden = "ORDER BY f.fecha DESC";

if ($orden >= 1 && $orden <= 3 && is_numeric($categoria)) {
  switch($orden) {
    case 1:
      $cadena_orden = " ORDER BY f.fecha DESC";
      break;
    case 2:
      $cadena_orden = " ORDER BY p.fecha DESC";
      break;
    case 3:
      $cadena_orden = " ORDER BY p.puntos DESC";
      break;
  }
}

if ($id_user != '') {
  $_pagi_sql = "
    SELECT f.id, f.id_post, f.fecha AS fecha_guardado, p.titulo, p.privado, p.fecha AS fecha_creado, p.puntos, c.imagen, c.link_categoria, u.nick
    FROM favoritos AS f
    INNER JOIN posts AS p ON p.id = f.id_post
    INNER JOIN categorias AS c ON p.categoria = c.id_categoria
    INNER JOIN usuarios AS u ON u.id = p.id_autor
    WHERE p.elim = 0
    AND f.id_usuario = $id_user
    $cadena_categoria
    $cadena_orden";

  $_pagi_cuantos = 20;
  $_pagi_nav_num_enlaces = 3;
  require_once(dirname(dirname(__FILE__)) . '/includes/paginator.inc.php');
?>
<div class="bordes">
  <br />
  <div align="center"></div>
  <br />
  <div  style="min-height: 300px;">
    <table width="900" align="center" border="0" cellspacing="0" cellpadding="0" style="font-size: 11px;">
      <tr>
        <td colspan="5">
          <div class="esq1" style="float: left;"></div>
          <div class="franja" style="float: left; width: 884px;"><div style="padding-top: 2px;">Filtro</div></div>
          <div class="esq2" style="float: left;"></div>
        </td>
      </tr>
      <tr class="fondo_cuadro" align="right">
        <form name="filtrar" method="GET" action="">
          <td  width="350" style="padding: 3px; padding-left: 5px;">
            Ordenar por:
            <select name="orden" style="font-size: 12px;">
              <option value="1"<?php echo ($orden == 1 ? ' selected="selected"' : ''); ?>>Fecha guardado</option>
              <option value="2"<?php echo ($orden == 2 ? ' selected="selected"' : ''); ?>>Fecha creado</option>
              <option value="3"<?php echo ($orden == 3 ? ' selected="selected"' : ''); ?>>Puntos</option>
            </select>
          </td>
          <td width="220" align="left">
            |
            Categor&iacute;a:
            <select id="categoria" name="categoria" style="font-size: 12px;">
              <option value="-1"><div class="size11" style="font-weight: bold;">Todas...</div></option>
<?php
  $sql = "
    SELECT id_categoria, nom_categoria
    FROM categorias
    ORDER BY nom_categoria ASC";

  $request = mysqli_query($con, $sql);
  while ($row = mysqli_fetch_array($request)) {
?>
              <option value="<?php echo $row['id_categoria']; ?>"<?php echo ($categoria == $row['id_categoria'] ? 'selected="selected"' : ''); ?>><?php echo $row['nom_categoria']; ?></option>
<?php
  }
?>
            </select>
          </td>
          <td align="left">
            <input type="submit" class="submit_button" value="Filtrar" />
          </td>
        </form>
      </tr>
    </table>
    <br />
    <form name="favoritos" method="POST" action="<?php echo $url; ?>/favoritos/eliminar.php">
      <input type="hidden" name="pag" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />
      <table width="900" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td colspan="5">
            <div class="esq1" style="float: left;"></div>
            <div class="franja" style="float: left; width: 884px;"><div style="padding-top: 2px;">Mis favoritos</div></div>
            <div class="esq2" style="float: left;"></div>
          </td>
        </tr>
<?php
  $i = 0;
  if ($_pagi_totalReg > 0) {
    while ($row = mysqli_fetch_array($_pagi_result)) {
      $id_favorito = $row['id'];
      $fecha_guardado = $row['fecha_guardado'];
      $fecha_creado = $row['fecha_creado'];
      $id_post = $row['id_post'];
      $titulo = $row['titulo'];
      $imagen = $row['imagen'];
      $link_categoria = $row['link_categoria'];
      $nick = $row['nick'];
      $puntos = $row['puntos'];
      $privado = $row['privado'];
      $cant = strlen($titulo);
      $titulo2 = $cant > 30 ? substr(stripslashes($titulo), 0, 30) : $titulo;
      $tit = $cant > 30 ? 1 : 0;
      $url_post = generatePostLink($id_post, $link_categoria, $titulo);
?>
        <tr class="fondo_cuadro" style="font-size: 11px;">
          <td width="300">
            <img src="<?php echo $images; ?>/iconos/<?php echo $imagen; ?>" border="0" width="15" />
            <?php echo ($privado == 1 ? '<img src="' . $images . '/iconos/candado.gif" border="0" width="15" />' : ''); ?>
            <a href="<?php echo $url_post; ?>" title="<?php echo $titulo; ?>" class="post_url">
              <font size="2"><?php echo $titulo2 . ($tit == 1 ? '...' : ''); ?></font>
            </a>
          </td>
          <td align="left" width="280">
            Posteado por
            <?php echo $nick; ?>
            el
            <?php echo date("d-m-Y", strtotime($fecha_creado)); ?>
          </td>
          <td align="left" width="60">
            <?php echo $puntos; ?>
            pts
          </td>
          <td align="right" width="200">
            Guardado:
            <?php echo date("d-m-Y H:m:s", strtotime($fecha_guardado)); ?>
          </td>
          <td width="30" align="right">
            <input type="checkbox" name="i_<?php echo $i; ?>" value="<?php echo $id_favorito; ?>" />
          </td>
        </tr>
<?php
      $i++;
    }
  } else {
?>
        <tr class="fondo_cuadro" style="font-size: 11px;">
          <td width="300" align="center" style="height: 20px;">
            No tienes favoritos
          </td>
        </tr>
<?php
  }
?> 
        <tr>
          <td align="right" colspan="5">
            <p><font size="1"><?php echo $_pagi_navegacion; ?></font></p>
          </td>
        </tr>
        <tr>
          <td align="right" colspan="5">
            <br />
            <input type="hidden" name="cant_check" value="<?php echo $i; ?>" />
            <input type="submit" value="Eliminar seleccionados" class="submit_button" />
          </td>
        </tr>
      </table>
    </form>
  </div>
</div>
<?php
} else {
  redirect($url);
}

require_once(dirname(dirname(__FILE__)) . '/footer.php');

?>