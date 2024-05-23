<?php
if (isset($_SESSION['user'])) {
  $sql = "
    SELECT id
    FROM favoritos
    WHERE id_post = $id
    AND id_usuario = " . $_SESSION['id'];

  $request = mysqli_query($con, $sql);

  if (mysqli_num_rows($request) <= 0) {
?>
    <form name="favoritos" method="POST" action="<?php echo $url; ?>/favoritos/insertar.php">
      <input type="hidden" name="pag" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />
      <input type="hidden" name="post" value="<?php echo $id; ?>" />
      <div style="font-size: 11px; text-align: center;">
        <img src="<?php echo $images; ?>/iconos/favoritos_a.png" />
        <a href="#" onclick="javascript:document.favoritos.submit();" style="color:#000000;">Agregar a favoritos</a>
      </div>
    </form>
<?php
  } else {
    echo '<div style="font-size: 11px; text-align: center;">El post ya se encuentra en favoritos</div>';
  }
}

?>