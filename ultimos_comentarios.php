<table width="255" height="190">
  <font size="-2"> 
    <tr>
      <td valign="top">
<?php
  $sql = "
    SELECT c.id, id_post, autor, p.categoria, p.titulo, cat.imagen, cat.link_categoria
    FROM comentarios AS c
    INNER JOIN posts AS p ON p.id = c.id_post
    INNER JOIN categorias AS cat ON p.categoria = cat.id_categoria
    WHERE c.elim = '0'
    AND p.elim = 0
    ORDER BY c.id DESC
    LIMIT 0, 15";

  $request = mysqli_query($con, $sql);

  if (mysqli_num_rows($request) > 0) {
    while ($row = mysqli_fetch_array($request)) {
      $id_comment = $row['id'];
      $id_post = $row['id_post'];
      $category = $row['link_categoria'];
      $title = $row['titulo'];
      $cant = strlen($title);
      $titulo2 = $cant > 24 ? substr(stripslashes($title), 0, 24) : $title;
      $tit = $cant > 24 ? 1 : 0;
      $url_comment = generatePostLink($id_post, $category, $title) . '#comentario_' . $id_comment;
?>
          <font size="1">
            <a href="<?php echo $url; ?>/perfil/<?php echo $row['autor']; ?>/" class="user_profile"><?php echo $row['autor']; ?></a>
            <a href="<?php echo $url_comment; ?>" class="post_url"><?php echo $titulo2 . ($tit == 1 ? '...' : ''); ?></a>
          </font>
          <br />
<?php
    }
  }
?>
      </td>
    </tr>
  </font>
</table>