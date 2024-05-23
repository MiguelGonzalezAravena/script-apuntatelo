<?php
// REGISTRO
require_once(dirname(dirname(__FILE__)) . '/header.php');

$error = isset($_GET['error']) ? $_GET['error'] : '';
$nombre = isset($_GET['nombre']) ? $_GET['nombre'] : '';
$nick = isset($_GET['nick']) ? $_GET['nick'] : '';
$mail1 = isset($_GET['mail1']) ? $_GET['mail1'] : '';
$avatar = isset($_GET['avatar']) ? $_GET['avatar'] : $images . '/avatar.jpg';
$pais = isset($_GET['pais']) ? $_GET['pais'] : '';
$ciudad = isset($_GET['ciudad']) ? $_GET['ciudad'] : '';
$sexo = isset($_GET['sexo']) ? $_GET['sexo'] : '';
$dia = isset($_GET['dia']) ? $_GET['dia'] : '';
$mes = isset($_GET['mes']) ? $_GET['mes'] : '';
$ano = isset($_GET['ano']) ? $_GET['ano'] : '';
$mensajero = isset($_GET['mensajero']) ? $_GET['mensajero'] : '';
$mensaje = isset($_GET['mensaje']) ? $_GET['mensaje'] : '';

?>
<div class="bordes">
  <table width="900" align="center">
    <tr>
      <td>
        <br />
        <form name="reg" method="post" action="<?php echo $url; ?>/registro/registrar.php" onsubmit="return validate_data();">
          <table width="900" align="right" border="0" cellspacing="2" cellpadding="2"> 
            <tr>
              <td width="50%" align="right">
                <font size="2"><b>* Nombre y Apellido:</b></font> 
              </td>
              <td>
                <input type="text" name="nombre" size="28" maxlength="35" value="<?php echo $nombre; ?>" />
              </td>
            </tr>
            <tr>
              <td width="50%" align="right">
                <font size="2"><b>* (M&iacute;n 3 caracteres) Usuario:</b></font> 
              </td>
              <td>
                <input type="text" name="nick" id="verificacion" size="20" maxlength="20" value="<?php echo $nick; ?>" />
              </td>
            </tr>
            <tr>
              <td width="50%" align="right">
                <font size="2"><b>* Contrase&ntilde;a:</b></font>
              </td>
              <td>
                <input type="password" name="password1" size="20" maxlength="15" />
              </td>
            </tr>
            <tr>
              <td width="50%" align="right">
                <font size="2"><b>* Confirmar contrase&ntilde;a:</b></font> 
              </td>
              <td>
                <input type="password" name="password2" size="20" maxlength="15" />
              </td>
            </tr>
            <tr>
              <td width="50%" align="right">
                <font size="2"><b>* Correo:</b></font> 
              </td>
              <td>
                <input type="text" name="mail1" size="25" maxlength="40" value="<?php echo $mail1; ?>" />
              </td>
            </tr>
            <tr>
              <td width="50%" align="right">
                <font size="2"><b>* Confirmar correo:</b></font> 
              </td>
              <td>
                <input type="text" name="mail2" size="25" maxlength="40" value="<?php echo $mail1; ?>" />
              </td>
            </tr>
            <tr>
              <td width="50%" align="right">
                <font size="2"><b>Avatar:</b></font> 
              </td>
              <td>
                <input type="text" name="avatar" size="36" maxlength="150" value="<?php echo $avatar; ?>">
              </td>
            </tr>
            <tr>
              <td width="50%" align="right">
                <font size="2"><b>* Pa&iacute;s:</b></font>
              </td>
              <td> 
                <select id="pais" name="pais">
                  <option value="-1">Seleccionar pa&iacute;s</option>
                  <?php
                    $countries = getCountries();
                    foreach($countries as $key => $value) {
                  ?>
                    <option value="<?php echo $key; ?>"<?php echo ($pais == $key ? ' selected="selected"' : ''); ?>><?php echo $value; ?></option>
                  <?php
                    }
                  ?>
                </select>
              </td>
            </tr>
            <tr>
              <td width="50%" align="right">
                <font size="2"><b>* Ciudad:</b></font> 
              </td>
              <td>
                <input type="text" name="ciudad" size="20" maxlength="50" value="<?php echo $ciudad; ?>" />
              </td>
            </tr>
            <tr>
              <td width="50%" align="right">
                <font size="2"><b>* Sexo:</b></font> 
              </td>
              <td>
                <input type="radio" name="sexo" value="m"<?php echo ($sexo == 'm' ? ' checked="checked"' : ''); ?> /><font size="2">Masculino</font> 
                <input type="radio" name="sexo" value="f"<?php echo ($sexo == 'f' ? ' checked="checked"' : ''); ?> /><font size="2">Femenino</font> 
              </td>
            </tr>
            <tr>
              <td width="50%" align="right">
                <font size="2"><b>* Fecha de nacimiento:</b></font> 
              </td>
              <td>
                <!-- Día -->
                <select name="dia" size="1">
                  <option value="-1">D&iacute;a</option>
                  <?php for($i = 1; $i < 32; $i++) { ?>
                    <option value="<?php echo $i; ?>"<?php echo ($dia == $i ? ' selected="selected"' : ''); ?>><?php echo substr(('0' . $i), -2); ?></option>
                  <?php } ?>
                </select>

                <!-- Mes -->
                <select name="mes" size="1">
                  <option value="-1">Mes</option>
                  <?php
                    $months = getMonths();
                    foreach ($months as $key => $value) {
                  ?>
                  <option value="<?php echo $key; ?>"<?php echo ($mes == $key ? ' selected="selected"' : ''); ?>><?php echo ucfirst($value); ?></option>
                  <?php } ?>
                </select>

                <!-- Año -->
                <select name="ano" size="1">
                  <option value="-1">A&ntilde;o</option>
                  <?php
                    $actualYear = date("Y");
                    for($i = $actualYear - 18; $i > 1899; $i--) {
                  ?>
                    <option value="<?php echo $i; ?>"<?php echo ($ano == $i ? ' selected="selected"' : ''); ?>><?php echo $i; ?></option>
                  <?php } ?>
                </select>
              </td>
            </tr>
            <tr>
              <td width="50%" align="right">
                <font size="2"><b>Mensajero:</b></font> 
              </td>
              <td>
                <input type="text" name="mensajero" size="20" maxlength="42" value="<?php echo $mensajero; ?>" />
              </td>
            </tr>
            <tr>
              <td width="50%" align="right">
                <font size="2"><b>Mensaje personal:</b></font> 
              </td>
              <td>
                <input type="text" name="mensaje" size="20" maxlength="105" value="<?php echo $mensaje; ?>" />
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
              <td></td>
              <td>
                <input type="checkbox" name="terminos" value="checkbox" checked="checked" />
                <font size="1">Acepto haber le&iacute;do y estar de acuerdo con el <a href="<?php echo $url; ?>/protocolo/" target="_blank">protocolo</a> de <?php echo $name; ?>.
              </td>
            </tr>
            <tr>
              <td width="50%" align="center">
                <br />
                <font size="1" color="red"><b>* Campos obligatorios</b></font>
              </td>
              <td>
                <input type="submit" name="botonregistrar" class="submit_button" value="Registrar" />
                <br />
              </td>
            </tr>
          </table>
        </form>
      </td>
    </tr>
  </table>
</div>
<?php
require_once(dirname(dirname(__FILE__)) . '/footer.php');
?>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script type="text/javascript">
  function validate_data() {
    var f = document.forms.reg;
    var fit = 'nombre, nick, password1, password2, mail1, mail2, ciudad, dia, mes, ano' . split(', ');

    for (var i = 0; i < fit.length; i++) {
      if (f[fit[i]].value == '') {
        alert('El campo ' + fit[i] + ' es obligatorio.');
        f[fit[i]].focus();
        return false;
      }
    }

    if (f.password1.value != f.password2.value) {
      alert('Las claves no son iguales. Por favor, completar nuevamente.');
      f.password1.value = f.password2.value = '';
      f.password1.focus();
      return false;
    }
  }
</script>
<?php
switch ($error) {
  case "1":
    echo "<script>alert('Usuario existente');</script>";
    break;
  case "2":
    echo "<script>alert('Correo ya existente en nuestra base de datos');</script>";
    break;
  case "3":
    echo "<script>alert('El nick debe tener por lo menos 3 caracteres');</script>";
    break;
  case "4":
    echo "<script>alert('Existen campos vacíos o los campos de contraseña y/o correos no son iguales');</script>";
    break;
  case "5":
    echo "<script>alert('Código incorrecto');</script>";
    break;
}

?>