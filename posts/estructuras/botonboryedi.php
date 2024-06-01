<?php
$id_user = isset($_SESSION['id']) ? $_SESSION['id'] : '';
$user = isset($_SESSION['user']) ? $_SESSION['user'] : '';
$rango = rango_propio($user);
?>
<table>
  <tr>
<?php
if ($id_user != $id_autor && ($rango == 'Administrador' || $rango == 'Moderador')) {
?>
    <td>
      <form name="borrar" action="<?php echo $url; ?>/posts_acciones/borrarpostmod.php" method="post">
        <input type="hidden" name="id_autor" value="<?php echo $id_autor; ?>" />
        <input type="hidden" name="nom" value="<?php echo $titulo; ?>" />
        <input type="hidden" name="num" value="<?php echo $id; ?>" />
        <input type="hidden" name="pagina" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />
        <font size="2"><b>Causa:</b></font>
        <input type="text" name="causa" size="30" maxlength="200" value="" />
        <input type="button" class="submit_button" onclick="if(confirm('&iquest;Seguro que deseas borrar el post?'))this.form.submit();" name="botonborrar" value="Borrar post del usuario">
      </form>
    </td>
<?php
}

if ($id_user == $id_autor) {
?>
    <td>
      <form name="borrar" action="<?php echo $url; ?>/posts_acciones/borrarpost.php" method="post" onsubmit="if(confirm('&iquest;Seguro que deseas borrar el post?'))">
        <input type="hidden" name="id_autor" value="<?php echo $id_autor; ?>" />
        <input type="hidden" name="nom" value="<?php echo $titulo; ?>" />
        <input type="hidden" name="num" value="<?php echo $id; ?>" />
        <td>
          <input type="hidden" name="pagina" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />
          <input type="button" class="submit_button" onclick="if(confirm('&iquest;Seguro que deseas borrar el post?'))this.form.submit();" name="botonborrar" value="Borrar post" />
        </td>
        <td>
          <input type="button" class="submit_button" value="Editar post" title="Editar post" onclick="location.href='<?php echo $url; ?>/editar_post/?id=<?php echo $id; ?>'" />
        </td>
      </form>
    </td>
<?php
}
?>
  </tr>
</table>