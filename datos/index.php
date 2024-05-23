<?php
// DATOS
require_once(dirname(dirname(__FILE__)) . '/header.php');

$var2 = 0;
$action = isset($_GET['action']) ? no_injection($_GET['action']) : '';
$user = isset($_SESSION['user']) ? $_SESSION['user'] : '';

if ($action != 'recuperar') {
  if ($user != '') {
    $sql = "
      SELECT nick, nombre, mail, avatar, pais, ciudad, sexo, dia, mes, ano, mensajero, mensaje 
      FROM usuarios
      WHERE nick = '$user'";

    $request = mysqli_query($con, $sql);

    while ($row = mysqli_fetch_array($request)) {
      $nombrebis = $row['nombre'];
      $mailbis = $row['mail'];
      $avatarbis = $row['avatar'];
      $paisbis = $row['pais'];
      $ciudadbis = $row['ciudad'];
      $sexobis = $row['sexo'];
      $diabis = $row['dia'];
      $mesbis = $row['mes'];
      $anobis = $row['ano'];
      $mensajerobis = $row['mensajero'];
      $mensajebis = $row['mensaje'];
    }
?>
<div class="bordes">
  <br />
  <div align="center">
    <h3>Mis datos</h3>
  </div>
  <table width="90%" border="0" cellspacing="2" cellpadding="2">
    <form name="reg" method="post" onsubmit="return validate_data();">
      <tr>
        <td width="50%" align="right">
          <font size="2"><b>Usuario:</b></font> 
        </td>
        <td>
          <font size="2"><?php echo $_SESSION['user']; ?>
        </td>
      </tr> 
      <tr>
        <td width="50%" align="right">
          <font size="2"><b>Nombre y Apellido:</b></font> 
        </td>
        <td>
          <input type="text" name="nombre" size="28" maxlength="35" value="<?php echo $nombrebis; ?>" />
        </td>
      </tr>
      <tr>
        <td width="50%" align="right">
          <font size="2"><b>Contrase&ntilde;a:</b></font> 
        </td>
        <td>
          <a href="<?php echo $url; ?>/datos/password.php" onClick="return popup(this, 'widthheight')"><font size="2" color="gray"><b>Cambiar</b></font></a>
        </td>
      </tr>
      <tr>
        <td width="50%" align="right">
          <font size="2"><b>Correo:</b></font> 
        </td>
      <td>
          <a href="mailto:<?php echo $mailbis; ?>"><font size="2" color="blue"><?php echo $mailbis; ?></font></a>
        </td>
      </tr> 
      <tr>
        <td width="50%" align="right">
          <font size="2"><b>Avatar:</b></font> 
        </td>
        <td>
          <input type="text" name="avatar" size="36" maxlength="150" value="<?php echo $avatarbis; ?>" />
        </td>
      </tr>
      <tr>
        <td width="50%" align="right">
          <font size="2"><b>Pa&iacute;s:</b></font>
        </td>
        <td> 
          <select id="pais" name="pais">
          <?php
            $countries = getCountries();
            foreach($countries as $key => $value) {
          ?>
            <option value="<?php echo $key; ?>"<?php echo ($paisbis == $key ? ' selected="selected"' : ''); ?>><?php echo $value; ?></option>
          <?php
            }
          ?>
          </select>
        </td>
      </tr>
      <tr>
        <td width="50%" align="right">
          <font size="2"><b>Ciudad:</b></font>
        </td>
        <td>
          <input type="text" name="ciudad" size="20" maxlength="50" value="<?php echo $ciudadbis; ?>" />
        </td>
      </tr>
      <tr>
        <td width="50%" align="right">
          <font size="2"><b>Sexo:</b></font>
        </td>
        <td>
          <input type="radio" name="sexo" value="m" <?php echo ($sexobis == 'm' ? 'checked="checked"' : ''); ?> />
          <font size="2">Masculino</font>
          <input type="radio" name="sexo" value="f" <?php echo ($sexobis == 'f' ? 'checked="checked"' : ''); ?> />
          <font size="2">Femenino</font>
        </td>
      </tr>
      <tr>
        <td width="50%" align="right">
          <font size="2"><b>Fecha de Nacimiento:</b></font> 
        </td>
        <td>
          <!-- Día -->
          <select name="dia" size="1">
            <option value="-1">D&iacute;a</option>
            <?php for($i = 1; $i < 32; $i++) { ?>
              <option value="<?php echo $i; ?>"<?php echo ($diabis == $i ? ' selected="selected"' : ''); ?>><?php echo substr(('0' . $i), -2); ?></option>
            <?php } ?>
          </select>

          <!-- Mes -->
          <select name="mes" size="1">
            <option value="-1">Mes</option>
            <?php
              $months = getMonths();
              foreach ($months as $key => $value) {
            ?>
            <option value="<?php echo $key; ?>"<?php echo ($mesbis == $key ? ' selected="selected"' : ''); ?>><?php echo ucfirst($value); ?></option>
            <?php } ?>
          </select>

          <!-- Año -->
          <select name="ano" size="1">
            <option value="-1">A&ntilde;o</option>
            <?php
              $actualYear = date("Y");
              for($i = $actualYear - 18; $i > 1899; $i--) {
            ?>
              <option value="<?php echo $i; ?>"<?php echo ($anobis == $i ? ' selected="selected"' : ''); ?>><?php echo $i; ?></option>
            <?php } ?>
          </select>
        </td>
      </tr>
      <tr>
        <td width="50%" align="right">
          <font size="2"><b>Mensajero:</b></font> 
        </td>
        <td>
          <input type="text" name="mensajero" size="20" maxlength="42" value="<?php echo $mensajerobis; ?>" />
        </td>
      </tr>
      <tr>
        <td width="50%" align="right">
          <font size="2"><b>Mensaje Personal:</b></font> 
        </td>
        <td>
          <input type="text" name="mensaje" size="20" maxlength="105" value="<?php echo $mensajebis; ?>" />
        </td>
      </tr>
      <tr>
        <td width="50%" align="center"></td>
        <td>
          <font size="2">Al modificar mis datos acepto los t&eacute;rminos de <?php echo $name; ?>.
        </td>
      </tr>
      <tr>
        <td width="50%" align="center"></td>
        <td>
          <input type="hidden" name="var" value= "1" />
          <br />
          <input type="submit" class="submit_button" value="Guardar cambios" />
        </td>
      </tr>
    </form>
  </table>
  <br /><br />
</div>
<?php
    require_once(dirname(dirname(__FILE__)) . '/footer.php');
?>
<script type="text/javascript">
  function validate_data() {
    var f = document.forms.reg;
    var fit = ('nombre, ciudad, dia, mes, ano').split(', ');

    for (var i = 0; i < fit.length; i++) {
      if (f[fit[i]].value == '') {
        alert('El campo ' + fit[i] + ' es obligatorio.');
        f[fit[i]].focus();
        return false;
      }
    }

    var y = ((new Date()).getYear() < 200 ? (new Date()).getYear() + 1900 : (new Date()).getYear());
    if (parseInt(f.ano.value) + 18 > y) {
      alert('<?php echo $name; ?> es un sitio para mayores de edad.');
      return false;
    }
  }

  <!--
  function popup(mylink, windowname) {
    if (!window.focus) {
      return true;
    }

    var href;
    if (typeof(mylink) == 'string') {
      href = mylink;
    } else {
      href = mylink.href;
    }

    window.open(href, windowname, 'width=350,height=265,scrollbars=yes');
    return false;
  }
  //-->
</script>
<?php
    $var2 = isset($_POST['var']) ? (int) $_POST['var'] : 0;
    $pnombre = isset($_POST['nombre']) ? no_injection($_POST['nombre']) : '';
    $nombre = isset($_POST['nombre']) ? no_injection($_POST['nombre']) : '';
    $avatar = isset($_POST['avatar']) ? no_injection($_POST['avatar']) : '';
    $pais = isset($_POST['pais']) ? no_injection($_POST['pais']) : '';
    $ciudad = isset($_POST['ciudad']) ? no_injection($_POST['ciudad']) : ''; 
    $sexo = isset($_POST['sexo']) ? no_injection($_POST['sexo']) : '';
    $dia = isset($_POST['dia']) ? (int) $_POST['dia'] : 1;
    $mes = isset($_POST['mes']) ? (int) $_POST['mes'] : 1;
    $ano = isset($_POST['ano']) ? (int) $_POST['ano'] : 1970;
    $mensajero = isset($_POST['mensajero']) ? no_injection($_POST['mensajero']) : '';
    $mensaje = isset($_POST['mensaje']) ? no_injection($_POST['mensaje']) : '';
    
    if ($var2 == 1) {
      if ($nombre != '' && $pais != '' && $ciudad != '' && $sexo != '' && $dia != 1 && $mes != 1 && $ano != 1970) {
        $sql = "
          UPDATE usuarios 
          SET nombre = '$nombre', avatar = '$avatar', pais = '$pais', ciudad = '$ciudad', sexo = '$sexo', dia = $dia, mes = $mes, ano = $ano, mensajero = '$mensajero', mensaje = '$mensaje'
          WHERE nick = '$user'";

        $request = mysqli_query($con, $sql);

        mysqli_free_result($request);
        mysqli_close($con);

        redirect($url . '/notificaciones/cambioex.php');
      } else {
        alert('Existen campos vac&iacute;os: ' . $nombre . $pais . $ciudad . $sexo . $dia . $mes . $ano);
      }
    }
  } else {
    redirect($url);
  }
} else {
  $mensaje = isset($_GET['mensaje']) ? no_injection($_GET['mensaje']) : '';
?>
    <div class="bordes">
      <br /><br /><br /><br /><br />
      <form name="recuperar" method="post" action="<?php echo $url; ?>/datos/enviar.php">
        <table align="center">
<?php
  if ($mensaje == 'error') {
?>
          <tr>
            <td colspan="2" align="center">
              <font size="2" color="red">Correo incorrecto</font>
            </td>
          </tr>
<?php
  }

  if ($mensaje == 'error2') {
?>
          <tr>
            <td colspan="2" align="center">
              <font size="2" color="red">C&oacute;digo incorrecto</font>
            </td>
          </tr>
<?php
  }
?>
          <tr>
            <td width="50%" align="right">
              <font size="2"><b>Ingresa tu correo:</b></font> 
            </td>
            <td>
              <input type="text" name="mail" />
            </td>
          </tr> 
          <tr>
            <td width="50%" align="right">
              <font size="2"><b>* C&oacute;digo de imagen:</b></font> 
            </td>
            <td>
              <div class="g-recaptcha" data-sitekey="<?php echo $recaptcha_public; ?>"></div>
            </td>
          </tr>
          <tr>
            <td width="50%" align="center"></td>
            <td>
              <input type="submit" name="botonregistrar" class="submit_button" value="Recuperar" />
              <br />
            </td>
          </tr>
        </table>
      </form>
      <br /><br /><br /><br /><br /><br />
    </div>
<?php
  require_once(dirname(dirname(__FILE__)) . '/footer.php');
}
?>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  </body>
</html> 
