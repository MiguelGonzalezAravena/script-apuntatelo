<?php
require_once(dirname(dirname(dirname(__FILE__))) . '/includes/configuracion.php');
require_once(dirname(dirname(dirname(__FILE__))) . '/includes/funciones.php');

echo '
  <style>
    a {
      cursor: pointer;
    }
  </style>
  <div id="contenido">
    <div class="Post">
      <table align="right" border="0" cellpadding="2" cellspacing="0" width="360">
        <tbody>';

$sql = "
  SELECT p.*, c.*
  FROM posts AS p
  INNER JOIN categorias AS c ON p.categoria = c.id_categoria
  WHERE p.elim = 0
  ORDER BY id DESC";

$request = mysqli_query($con, $sql);

while ($row = mysqli_fetch_array($request)) {
  $privado = $row['privado'];
  $img = $row['imagen'];
  $cat = $row['link_categoria'];
  $cant = strlen($row['titulo']);
  $titulo2 = $cant > 41 ? substr(stripslashes($row['titulo']), 0, 38) : $row['titulo'];
  $tit = $cant > 41 ? 1 : 0;
  $url_post = $url . '/posts/' . $row['id'] . '/' . $cat . '/' . correcciones(corregir($row['titulo'])) . '.html';
  $url_image = $images . '/iconos/' . $img;

  echo '
    <tr>
      <td>
        <img src="' . $url_image . '" border="0" />
        ' . ($privado == 1 ? '<img src="' . $images . '/iconos/candado.gif" border="0" />' : '') . '
        <a href="' . $url_post . '" title="' . $row['titulo'] . '">
          <font size="2" color="black">' . correcciones($titulo2) . ($tit == 1 ? '...' : '') . '</font>
        </a>
      </td>
    </tr>';
}
?>