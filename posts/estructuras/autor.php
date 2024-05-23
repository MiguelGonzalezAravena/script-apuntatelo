<?php
$sql = "
  SELECT * 
  FROM usuarios
  WHERE id = " . $id_autor;
$request = mysqli_query($con, $sql);
$row = mysqli_fetch_array($request);
$nick = $row['nick'];
$color = rango_color($row['rango']);
$cant = strlen($nick);
$nick2 = $cant > 18 ? (substr(stripslashes($nick), 0, 15) . '...') : $nick;
$iexp = $_SERVER['HTTP_USER_AGENT'];
$style = strstr($iexp, 'MSIE') ? ' style="width: 160px;"' : '';

echo '
  <div class="box_title" style="height: 21px; width: 160px;">
    <div class="box_txt" style="width: 160px; text-align: left;">
      <div class="esq1" style="float: left;"></div>
      <div style="float: left; padding-top: 4px;">Posteado por:</div>
      <div class="esq2" style="float: right;"></div>
    </div>
  </div>
  <div align="left">
  <div class="box_perfil"' . $style . '>
    <img src="' . $row['avatar'] . '" style="display: block; margin: auto;" border="0" alt="" title="" />
    <b class="txt">
      <a href="' . $url . '/perfil/' . $nick . '/">
        <font color="' . $color . '">
          <b>' . $nick2 . '</b>
        </font>
      </a>
    </b>
    <font size="1">
      ' . $row['rango'] . '<br />
      ' . rango($row['rango']) . '
      <img title="' . sexo($row['sexo']) . '" src="' . $images . '/' . sexo($row['sexo']) . '.png" />
      <img title="' . pais($row['pais']) . '" src="' . $images . '/banderas/' . $row['pais'] . '.png" />
      <hr />
      <table>
        <tr>
          <td align="right" valign="middle">
            <font size="1">
              ' . $row['numposts'] . '
            </font>
          </td>
          <td>
            <font size="1">
              Posts
            </font>
          </td>
        </tr>
        <tr>
          <td align="right" valign="middle">
            <font size="1">
              ' . $row['numcomentarios'] . '
            </font>
          </td>
          <td>
            <font size="1">
              Comentarios
            </font>
          </td>
        </tr>
        <tr>
          <td align="right" valign="middle">
            <font size="1">
              ' . $row['puntos'] . '
            </font>
          </td>
          <td>
            <font size="1">
              Puntos
            </font>
          </td>
        </tr>
      </table>
      ' . (isset($_SESSION['id']) ? '<hr /><a href="' . $url . '/mensajes/redactar.php?para=' . $nick . '"><img style="margin-right: 5px" src="' . $images . '/mp.png" />Enviar mensaje</a>' : '') . '
    </font>
  </div>
</div>';
?>