<?php
$mensaje = isset($_POST['mensaje']) ? $_POST['mensaje'] : '';

if (isset($_SESSION['user'])) {
?>
<div class="box_title" style="height: 21px; width: 780px;">
  <div class="box_txt" style="width: 780px; text-align: left;">
    <div class="esq1" style="float: left;"></div>
    <div style="float: left; padding-top: 4px;">Agregar un nuevo comentario</div>
    <div class="esq2" style="float: right;"></div>
  </div>
</div>
<?php
  if ($coments == 0) {
?>
<div class="box_cuerpo" style="width: auto; height: 260px">
  <table width="90%" border="0" cellspacing="2" cellpadding="2">
    <form name="reg" action="<?php echo $url; ?>/posts_acciones/insertarcom.php" method="post">
      <input type="hidden" name="num" value="<?php echo $id; ?>" />
      <input type="hidden" name="pagina" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />
      <input type="hidden" name="variable" value="<?php echo $_SESSION['user']; ?>" />
      <input type="hidden" name="variable2" value="<?php echo $_SESSION['id']; ?>" />
      <tr> 
        <td width="30%" align="left"></td>
        <td></td>
      </tr>
      <tr> 
        <td width="30%" align="left"></td>
        <td>
          <a href="javascript:void(0)" onclick="texto('align=left','align')">
            <img src="<?php echo $images; ?>/iconos/izquierda.PNG" hspace="2" vspace="4" align="absmiddle" width="15" height="16" border="0" />
          </a>
          <a href="javascript:void(0)" onclick="texto('align=center','align')">
            <img src="<?php echo $images; ?>/iconos/centro.PNG" hspace="2" vspace="4" align="absmiddle" width="15" height="16" border="0" />
          </a>
          <a href="javascript:void(0)" onClick="texto('align=right','align')">
            <img src="<?php echo $images; ?>/iconos/derecha.PNG" hspace="2" vspace="4" align="absmiddle" width="15" height="16" border="0" />
          </a>
          <a href="javascript:void(0)" onClick="instag('b')">
            <img src="<?php echo $images; ?>/iconos/negrita.PNG" hspace="2" vspace="4" align="absmiddle" border="0" />
          </a>
          <a href="javascript:void(0)" onclick="instag('i')">
            <img src="<?php echo $images; ?>/iconos/cursiva.PNG" hspace="2" vspace="4" align="absmiddle" border="0" />
          </a>
          <a href="javascript:void(0)" onclick="instag('u')">
            <img src="<?php echo $images; ?>/iconos/subrayado.PNG" hspace="2" vspace="4" align="absmiddle" border="0" />
          </a>
          <select name="colordefont" style="color: black; background-color: #FAFAFA; font-size: 10px" onChange="texto('color=' + this.form.colordefont.options[this.form.colordefont.selectedIndex].value, 'color'); this.selectedIndex = 0;">
            <option style="color: black; background-color: #FAFAFA" value="#black">Predeterminado</option>
            <option style="color: darkred; background-color: #FAFAFA" value="darkred">Rojo oscuro</option>
            <option style="color: red; background-color: #FAFAFA" value="red">Rojo</option>
            <option style="color: orange; background-color: #FAFAFA" value="orange">Naranja</option>
            <option style="color: brown; background-color: #FAFAFA" value="brown">Marr&oacute;n</option>
            <option style="color: yellow; background-color: #FAFAFA" value="yellow">Amarillo</option>
            <option style="color: green; background-color: #FAFAFA" value="green">Verde</option>
            <option style="color: olive; background-color: #FAFAFA" value="olive">Oliva</option>
            <option style="color: cyan; background-color: #FAFAFA" value="cyan">Cyan</option>
            <option style="color: blue; background-color: #FAFAFA" value="blue">Azul</option>
            <option style="color: darkblue; background-color: #FAFAFA" value="darkblue">Azul Oscuro</option>
            <option style="color: indigo; background-color: #FAFAFA" value="indigo">Indigo</option>
            <option style="color: violet; background-color: #FAFAFA" value="violet">Violeta</option>
            <option style="color: black; background-color: #FAFAFA" value="black">Negro</option>
          </select>
          <select name="sizedefont" style="color: black; background-color: #FAFAFA; font-size: 10px" onChange="texto('size=' + this.form.sizedefont.options[this.form.sizedefont.selectedIndex].value, 'size'); this.selectedIndex = 0;">
            <option value="7">Miniatura</option>
            <option value="9">Peque&ntilde;a</option>
            <option value="12" selected="selected">Normal</option>
            <option value="18">Grande</option>
            <option value="24">Enorme</option>
          </select>
          <a href="javascript:void(0)" onclick="insimg()">
            <img src="<?php echo $images; ?>/iconos/imagen.PNG" hspace="2" vspace="4" align="absmiddle"  alt="Insertar imagen" title="Insertar imagen" border="0" />
          </a>
          <a href="javascript:void(0)" onclick="inslink()">
            <img src="<?php echo $images; ?>/iconos/url.PNG" hspace="2" vspace="4" align="absmiddle"  alt="Insertar enlace" title="Insertar enlace" border="0" />
          </a>
          <br />
        </td>
      </tr>
      <tr>
        <td valign="top">
          <a href="javascript:void(0)" onclick="smile(':))')"><img src="<?php echo $images; ?>/smileys/icon_cheesygrin.gif" hspace="2" vspace="4" align="absmiddle" border="0" /></a>
          <a href="javascript:void(0)" onclick="smile('8|')"><img src="<?php echo $images; ?>/smileys/icon_eek.gif" hspace="2" vspace="4" align="absmiddle" border="0" /></a>
          <a href="javascript:void(0)" onclick="smile(':ok:')"><img src="<?php echo $images; ?>/smileys/thumbup.gif" hspace="2" vspace="4" align="absmiddle" border="0" /></a>
          <a href="javascript:void(0)" onclick="smile(':twisted:')"><img src="<?php echo $images; ?>/smileys/twisted.gif" hspace="2" vspace="4" align="absmiddle" border="0" /></a>
          <a href="javascript:void(0)" onclick="smile(':aplauso:')"><img src="<?php echo $images; ?>/smileys/clapping.gif" hspace="2" vspace="4" align="absmiddle" border="0" /></a>
          <a href="javascript:void(0)" onclick="smile(':angel:')"><img src="<?php echo $images; ?>/smileys/icon_angel_not.gif" hspace="2" vspace="4" align="absmiddle" border="0" /></a>
          <a href="javascript:void(0)" onclick="smile(':angry:')"><img src="<?php echo $images; ?>/smileys/angry.gif" hspace="2" vspace="4" align="absmiddle" border="0" /></a>
          <a href="javascript:void(0)" onclick="smile(':idiot:')"><img src="<?php echo $images; ?>/smileys/muro.gif" hspace="2" vspace="4" align="absmiddle" border="0" /></a>
          <a href="javascript:void(0)" onclick="smile(':ziped:')"><img src="<?php echo $images; ?>/smileys/ziped.gif" hspace="2" vspace="4" align="absmiddle" border="0" /></a>
          <a href="javascript:void(0)" onclick="smile(':blink:')"><img src="<?php echo $images; ?>/smileys/blink.gif" hspace="2" vspace="4" align="absmiddle" border="0" /></a>
          <a href="javascript:void(0)" onclick="smile(':win:')"><img src="<?php echo $images; ?>/smileys/coppa.gif" hspace="2" vspace="4" align="absmiddle" border="0" /></a>
          <a href="javascript:void(0)" onclick="smile(':download:')"><img src="<?php echo $images; ?>/smileys/dload.gif" hspace="2" vspace="4" align="absmiddle" border="0" /></a>
          <a href="javascript:void(0)" onclick="smile(':embarrass:')"><img src="<?php echo $images; ?>/smileys/icon_redface.gif" hspace="2" vspace="4" align="absmiddle" border="0" /></a>
          <a href="javascript:void(0)" onclick="smile(':book:')"><img src="<?php echo $images; ?>/smileys/book.gif" hspace="2" vspace="4" align="absmiddle" border="0" /></a>
          <a href="javascript:void(0)" onclick="smile(':sorry:')"><img src="<?php echo $images; ?>/smileys/icon_sorry.gif" hspace="2" vspace="4" align="absmiddle" border="0" /></a>
          <a href="javascript:void(0)" onclick="smile(':welcome:')"><img src="<?php echo $images; ?>/smileys/welcome.gif" hspace="2" vspace="4" align="absmiddle" border="0" /></a>
          <a href="javascript:void(0)" onclick="smile(':bye:')"><img src="<?php echo $images; ?>/smileys/bye.gif" hspace="2" vspace="4" align="absmiddle" border="0" /></a>
          <br />
          <a href="" onclick="window.open('<?php echo $url; ?>/smileys.php','window','width=200,height=600,scrollbars=yes');return false">
            <font color="gray">M&aacute;s</font>
          </a>
        </td>
        <td>
          <textarea name="cuerpo" cols="59" rows="8"><?php echo $mensaje; ?></textarea>
        </td>
      </tr>
      <tr> 
        <td colspan="2" align="center">
          <input type="button" class="submit_button" onclick="submit();" name="botoncomentario" value="Enviar comentario" />
        </td>
      </tr>
    </form> 
  </table>
</div>
<?php
  } else {
    echo '<div class="box_cuerpo" style="width: 764px; float: left; height: 20px">';
    echo '<font size="2"><b>Los comentarios se encuentran cerrados para este post.</b><hr /></font>';
  }
}
?>
<script src="<?php echo $url; ?>/includes/funciones.js" type="text/javascript"></script>