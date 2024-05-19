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
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Apuntatelo - Tu link-sharing de apuntes</title>
<script language="javascript" type="text/javascript">
	
	function validate_data() {
		var f = document.forms.reg;
		var fit = 'nombre, nick, password1, password2, mail1, mail2, ciudad, dia, mes, ano' . split(', ');

		for (var i = 0; i < fit.length; i++) {
			if (f[fit[i]].value=='') {
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
</head>
<body>
<div class="bordes">
<table width="900" align="center">
<tr>
<td>
<br>
<FORM name="reg" method="post" action="<?php echo $url; ?>/registro/registrar.php" onsubmit="return validate_data();">
<table  width="900" align="right" border="0" cellspacing="2" cellpadding="2">      	  
  <tr>
    <td width="50%" align="right">
			<font size="2"><b>* Nombre y Apellido:</b></font> 
		</td>
   	<td>
			<INPUT TYPE="text" NAME="nombre" SIZE="28" MAXLENGTH="35" value="<?php echo $nombre; ?>" />	
    </td>
	</tr>
  <tr>
    <td width="50%" align="right">
	  	<font size="2"><b>* (M&iacute;n 3 caracteres) Usuario:</b></font> 
		</td>	
		<td>
			<INPUT TYPE="text" NAME="nick" id="verificacion" SIZE="20" MAXLENGTH="20" value="<?php echo $nick; ?>" />	
		</td>
	</tr>
	<tr>
		<td width="50%" align="right">
			<font size="2"><b>* Contrase&ntilde;a:</b></font>
		</td>
		<td>
	  	<INPUT TYPE="password" NAME="password1" SIZE="20" MAXLENGTH="15" />
		</td>
	</tr>
	<tr>
		<td width="50%" align="right">
	  	<font size="2"><b>* Confirmar contrase&ntilde;a:</b></font> 
		</td>
		<td>
	  	<INPUT TYPE="password" NAME="password2" SIZE="20" MAXLENGTH="15" />
		</td>
  </tr>
	<tr>
  	<td width="50%" align="right">
	  	<font size="2"><b>* Correo:</b></font> 
		</td>
   	<td>
			<INPUT TYPE="text" NAME="mail1" SIZE="25" MAXLENGTH="40" value="<?php echo $mail1; ?>" />
    </td>
	</tr>
	<tr>
  	<td width="50%" align="right">
	  	<font size="2"><b>* Confirmar correo:</b></font> 
		</td>
   	<td>
			<INPUT TYPE="text" NAME="mail2" SIZE="25" MAXLENGTH="40" value="<?php echo $mail1; ?>" />
    </td>
	</tr>
  <tr>
		<td width="50%" align="right">
	  	<font size="2"><b>Avatar:</b></font> 
		</td>
   	<td>
			<INPUT TYPE="text" NAME="avatar" SIZE="36" MAXLENGTH="150" value="<?php echo $avatar; ?>">	
    </td>
	</tr>
  <tr>
		<td width="50%" align="right">
	  	<font size="2"><b>* Pa&iacute;s:</b></font>
		</td>
   	<td> 
   		<select id="pais" name="pais">
				<option value="-1">Seleccionar Pa&iacute;s</option>
				<option value="ar" <?php if ($pais == "ar") { echo 'selected="selected"'; } ?>>Argentina</option>
				<option value="bo" <?php if ($pais == "bo") { echo 'selected="selected"'; } ?>>Bolivia</option>
				<option value="br" <?php if ($pais == "br") { echo 'selected="selected"'; } ?>>Brasil</option>
				<option value="cl" <?php if ($pais == "cl") { echo 'selected="selected"'; } ?>>Chile</option>

				<option value="co" <?php if ($pais == "co") { echo 'selected="selected"'; } ?>>Colombia</option>
				<option value="cr" <?php if ($pais == "cr") { echo 'selected="selected"'; } ?>>Costa Rica</option>
				<option value="cu" <?php if ($pais == "cu") { echo 'selected="selected"'; } ?>>Cuba</option>
				<option value="ec" <?php if ($pais == "ec") { echo 'selected="selected"'; } ?>>Ecuador</option>
				<option value="es" <?php if ($pais == "es") { echo 'selected="selected"'; } ?>>Espa&ntilde;a</option>
				<option value="gt" <?php if ($pais == "gt") { echo 'selected="selected"'; } ?>>Guatemala</option>

				<option value="it" <?php if ($pais == "it") { echo 'selected="selected"'; } ?>>Italia</option>
				<option value="mx" <?php if ($pais == "mx") { echo 'selected="selected"'; } ?>>Mexico</option>
				<option value="py" <?php if ($pais == "py") { echo 'selected="selected"'; } ?>>Paraguay</option>
				<option value="pe" <?php if ($pais == "pe") { echo 'selected="selected"'; } ?>>Peru</option>
				<option value="pt" <?php if ($pais == "pt") { echo 'selected="selected"'; } ?>>Portugal</option>
				<option value="pr" <?php if ($pais == "pr") { echo 'selected="selected"'; } ?>>Puerto Rico</option>

				<option value="uy" <?php if ($pais == "uy") { echo 'selected="selected"'; } ?>>Uruguay</option>
				<option value="ve" <?php if ($pais == "ve") { echo 'selected="selected"'; } ?>>Venezuela</option>
				<option value="ot" <?php if ($pais == "ot") { echo 'selected="selected"'; } ?>>Otro</option>
			</select>
		</td>
	</tr>
	<tr>
		<td width="50%" align="right">
			<font size="2"><b>* Ciudad:</b></font> 
		</td>
		<td>
			<INPUT TYPE="text" NAME="ciudad" SIZE="20" MAXLENGTH="50" value="<?php echo $ciudad; ?>">	
		</td>
	</tr>
	<tr>
		<td width="50%" align="right">
	  	<font size="2"><b>* Sexo:</b></font> 
		</td>
   	<td>
			<input type="radio" name="sexo" value="m" <?php echo ($sexo == 'm' ? 'checked="checked"' : ''); ?>><font size="2"><b>Masculino</b></font> 
			<input type="radio" name="sexo" value="f" <?php echo ($sexo == 'f' ? 'checked="checked"' : ''); ?>><font size="2"><b>Femenino</b></font> 
		</td>
	</tr>
	<tr>
    <td width="50%" align="right">
		  <font size="2"><b>* Fecha de Nacimiento:</b></font> 
   	</td>
   	<td>
			<INPUT TYPE="text" NAME="dia" SIZE="1" MAXLENGTH="2" value="<?php echo $dia; ?>">	
    	<INPUT TYPE="text" NAME="mes" SIZE="1" MAXLENGTH="2" value="<?php echo $mes; ?>">
			<INPUT TYPE="text" NAME="ano" SIZE="4" MAXLENGTH="4" value="<?php echo $ano; ?>">
		</td>
  </tr>       
	<tr>
  	<td width="50%" align="right">
	  	<font size="2"><b>Mensajero:</b></font> 
		</td>
   	<td>
			<INPUT TYPE="text" NAME="mensajero" SIZE="20" MAXLENGTH="42" value="<?php echo $mensajero; ?>" />	
    </td>
	</tr>
  <tr>
    <td width="50%" align="right">
		  <font size="2"><b>Mensaje personal:</b></font> 
   	</td>
   	<td>
			<INPUT TYPE="text" NAME="mensaje" SIZE="20" MAXLENGTH="105" value="<?php echo $mensaje; ?>" />	
		</td>
	</tr>
	<tr>
		<td width="50%" align="right">
	  	<font size="2"><b>* C&oacute;digo de imagen:</b></font> 
		</td>
	 	<td>
<?php
require_once(dirname(dirname(__FILE__)) . '/recaptcha/recaptchalib.php');
$publickey = "6LeshgQAAAAAALjtDUihVkRn9jxIyi-ND7_2dOew";
echo recaptcha_get_html($publickey);
?>
		</td>
	</tr>
	<tr> 
		<td></td>
		<td>
	 		<input type="checkbox" name="terminos" CHECKED value="checkbox"><font size="2">Acepto haber le&iacute;do y estar de acuerdo con los t&eacute;rminos de <?php echo $name; ?>.
		</td>
	</tr>
	<tr>
	  <td width="50%" align="center">
	  	<br />
			<font size="2"><b>* Campos obligatorios</b></font>
	  </td>
	  <td>
	  	<INPUT TYPE="submit" NAME="botonregistrar" class="submit_button" VALUE="Registrar" />
  	  <br />
	  </td>
	</tr>  
</font>
</table>
</FORM>
</div>
</td>
</tr>
</table>
</div>
<?php
require_once(dirname(dirname(__FILE__)) . '/footer.php');
?>
</div>
</div>
</td>
</tr>
</table>
</div>
</body>
</html>
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