<br />
<table width="300" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td style="background-color: #d2d3d4; font-size: 10px;">
      <div class="box_txt" style="width: 300px; text-align: left;">
        <div class="esq1" style="float: left;"></div>
        <div style="float: left; padding-top: 4px;">Puntos</div>
        <div class="esq2" style="float: right;"></div>
      </div>
    </td>
  </tr>
  <tr> 
    <td class="fondo_cuadro" style="padding-left: 20px;">
      <br />
<?php
$user = isset($_SESSION['user']) ? $_SESSION['user'] : '';
$id_user = isset($_SESSION['id']) ? $_SESSION['id'] : '';

if ($id_user != '' && $id_user != $id_autor) {
  $sql = "
    SELECT puntosdar 
    FROM usuarios}
    WHERE id = $id_user
    LIMIT 10";

  $request = mysqli_query($con, $sql);
  $row = mysqli_fetch_array($request);
  ?>
      <font size="1">
        Puntos:
        <form name="puntos" action="<?php echo $url; ?>/posts_acciones/darpuntos.php" method="post">
          <input type="hidden" name="dador" value=<?php echo $id_user; ?> />
          <input type="hidden" name="id_post" value=<?php echo $id; ?> />
          <input type="hidden" name="titu" value=<?php echo $titulo; ?> />
          <input type="hidden" name="pagina" value=<?php echo $_SERVER['REQUEST_URI']; ?> />
          <select id="cantpuntos" name="cantpuntos">
<?php
  $cont = 1;
  while ($cont <= $row['puntosdar']) {
?>
              <option value="<?php echo $cont; ?>"><?php echo $cont; ?></option>
<?php
    $cont = $cont+1;
  }
?>
          </select>
          de <?php echo $row['puntosdar']; ?> disponibles.
          <input type="submit" class="submit_button" value="Dar" />
        </form>
      </font>
<?php
} else {
  if ($id_user == $id_autor) {
    echo '<br /><div align="center"><font size="1">No puedes dar puntos a un post propio<br /><br /><br /></font></div>';
  } else {
    echo '<br /><div align="center"><font size="1">Los usuarios no registrados no pueden dar puntos<br /><br /><br /></font></div>';
  }
}
?>
    </td>
  </tr>
</table>