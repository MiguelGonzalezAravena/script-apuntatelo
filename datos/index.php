<?php
//DATOS
require_once(dirname(dirname(__FILE__)) . '/header.php');
$var2 = 0;
$action = isset($_GET['action']) ? no_injection($_GET['action']) : '';
?>

<html>
<head>
<title>Apuntatelo - Tu link-sharing de apuntes</title>
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
			alert('Apuntatelo es un sitio para mayores de edad.');
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
</head>
<body>

<?php
if ($action != 'recuperar') {
	if (isset($_SESSION['user'])) {
		$user = $_SESSION['user'];
		$sql = "
			SELECT nick, nombre, mail, avatar, pais, ciudad, sexo, dia, mes, ano, mensajero, mensaje 
			FROM usuarios
			WHERE nick = '" . $user . "'";
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
		<br>
		<div align="center">MIS DATOS</div>
		<br>
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
			<INPUT TYPE="text" NAME="nombre" SIZE="28" MAXLENGTH="35" value="<?php echo $nombrebis; ?>">	
		    </td>
		   </tr> 
		   <td width="50%" align="right">
			  <font size="2"><b>Contrase&ntilde;a:</b></font> 
		   	 </td>
		   	<td>
			<a href="password.php" onClick="return popup(this, 'widthheight')"><font size="2" color="gray"><b>Cambiar</b></font></a>
		    </td>
		   </tr>   
		 	
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
					<input TYPE="text" NAME="avatar" SIZE="36" MAXLENGTH="150" value="<?php echo $avatarbis; ?>" />
		    </td>
		   </tr>
		      
			 <tr>
		     <td width="50%" align="right">
		
		<?php
			$s[$sexobis] = 'selected="true"';
		?> 
			  <font size="2"><b>Pa&iacute;s:</b></font>
			</td>
		   	<td> 
	   		<select id="pais" name="pais">
					<option value="ar" <?php echo ($paisbis == 'ar' ? 'selected="selected"' : ''); ?>>Argentina</option>
					<option value="bo" <?php echo ($paisbis == 'bo' ? 'selected="selected"' : ''); ?>>Bolivia</option>
					<option value="br" <?php echo ($paisbis == 'br' ? 'selected="selected"' : ''); ?>>Brasil</option>
					<option value="cl" <?php echo ($paisbis == 'cl' ? 'selected="selected"' : ''); ?>>Chile</option>

					<option value="co" <?php echo ($paisbis == 'co' ? 'selected="selected"' : ''); ?>>Colombia</option>
					<option value="cr" <?php echo ($paisbis == 'cr' ? 'selected="selected"' : ''); ?>>Costa Rica</option>
					<option value="cu" <?php echo ($paisbis == 'cu' ? 'selected="selected"' : ''); ?>>Cuba</option>
					<option value="ec" <?php echo ($paisbis == 'ec' ? 'selected="selected"' : ''); ?>>Ecuador</option>
					<option value="es" <?php echo ($paisbis == 'es' ? 'selected="selected"' : ''); ?>>Espa&ntilde;a</option>
					<option value="gt" <?php echo ($paisbis == 'gt' ? 'selected="selected"' : ''); ?>>Guatemala</option>

					<option value="it" <?php echo ($paisbis == 'it' ? 'selected="selected"' : ''); ?>>Italia</option>
					<option value="mx" <?php echo ($paisbis == 'mx' ? 'selected="selected"' : ''); ?>>Mexico</option>
					<option value="py" <?php echo ($paisbis == 'py' ? 'selected="selected"' : ''); ?>>Paraguay</option>
					<option value="pe" <?php echo ($paisbis == 'pe' ? 'selected="selected"' : ''); ?>>Per&uacute;</option>
					<option value="pt" <?php echo ($paisbis == 'pt' ? 'selected="selected"' : ''); ?>>Portugal</option>
					<option value="pr" <?php echo ($paisbis == 'pr' ? 'selected="selected"' : ''); ?>>Puerto Rico</option>

					<option value="uy" <?php echo ($paisbis == 'uy' ? 'selected="selected"' : ''); ?>>Uruguay</option>
					<option value="ve" <?php echo ($paisbis == 've' ? 'selected="selected"' : ''); ?>>Venezuela</option>
					<option value="ot" <?php echo ($paisbis == 'ot' ? 'selected="selected"' : ''); ?>>Otro</option>
				</select>
			</td>
		</tr>
		   
		    <tr>
		     <td width="50%" align="right">
			  <font size="2"><b>Ciudad:</b></font> 
		   	 </td>
		   	<td>
			<INPUT TYPE="text" NAME="Ciudad" SIZE="20" MAXLENGTH="50" value="<?php echo $ciudadbis; ?>">	
		    </td>
		   </tr>
		  
		    <tr>
		     <td width="50%" align="right">
			  <font size="2"><b>Sexo:</b></font> 
		   	 </td>
		   	<td>
					<input type="radio" name="sexo" value="m" <?php echo ($sexobis == 'm' ? 'checked="checked"' : ''); ?> /><font size="2"><b>Masculino</b></font> 
					<input type="radio" name="sexo" value="f" <?php echo ($sexobis == 'f' ? 'checked="checked"' : ''); ?> /><font size="2"><b>Femenino</b></font> 
			
		    </td>
		   </tr>
		       
			   <tr>
		     <td width="50%" align="right">
			  <font size="2"><b>Fecha de Nacimiento:</b></font> 
		   	 </td>
		   	<td>
			<INPUT TYPE="text" NAME="dia" SIZE="1" MAXLENGTH="2" value="<?php echo $diabis; ?>">	
		    <INPUT TYPE="text" NAME="mes" SIZE="1" MAXLENGTH="2" value="<?php echo $mesbis; ?>">
			<INPUT TYPE="text" NAME="ano" SIZE="4" MAXLENGTH="4" value="<?php echo $anobis; ?>">
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
			  <td width="50%" align="center">
			  </td>
			  <td>	
			 <font size="2">Al modificar mis datos acepto los t&eacute;rminos de <?php echo $name; ?>
			  </td>
		   	 </tr>
			 <tr>
			  <td width="50%" align="center">
			  </td>
			  <td>
			  <input type="hidden" name="var" value= "1" />
			  <br>
			  <input type="submit" class="submit_button" value="Guardar cambios" />
		  	  </td>
		   </tr>  
			</form>
		</font>
		</table>
		<br>
		<br>
		<?php
		require_once(dirname(dirname(__FILE__)) . '/footer.php');
		?>
		</body>
		</html>
		<?php
		$var2 = isset($_POST['var']) ? (int) $_POST['var'] : 0;
		$pnombre = isset($_POST['nombre']) ? no_injection($_POST['nombre']) : '';
		
		$nombre = isset($_POST['nombre']) ? no_injection($_POST['nombre']) : '';
		$avatar = isset($_POST['avatar']) ? no_injection($_POST['avatar']) : '';
		$pais = isset($_POST['pais']) ? no_injection($_POST['pais']) : '';
		$ciudad = isset($_POST['ciudad']) ? no_injection($_POST['ciudad']) : ''; 
		$sexo = isset($_POST['sexo']) ? no_injection($_POST['sexo']) : '';
		$dia = isset($_POST['dia']) ? no_injection($_POST['dia']) : '';
		$mes = isset($_POST['mes']) ? no_injection($_POST['mes']) : '';
		$ano = isset($_POST['ano']) ? (int) $_POST['ano'] : 0;
		$mensajero = isset($_POST['mensajero']) ? no_injection($_POST['mensajero']) : '';
		$mensaje = isset($_POST['mensaje']) ? no_injection($_POST['mensaje']) : '';
		
		if ($var2 == 1) {
			if (isset($nombre) && isset($pais) && isset($ciudad) && isset($sexo) && isset($dia) && isset($mes) && isset($ano)) {
				$sql = "
					UPDATE usuarios 
					SET nombre = '$nombre', avatar = '$avatar', pais = '$pais', ciudad = '$ciudad', sexo = '$sexo', dia = '$dia', mes = '$mes', ano = '$ano', mensajero = '$mensajero', mensaje='$mensaje'
					WHERE nick = '$user'";

				$request = mysqli_query($con, $sql);
?>
					 <script type="text/javascript">
		      			location.href = "../../cambioex.php";
		     			</script>
<?php
				mysqli_free_result($request);
				mysqli_close($con);
			} else {
				echo '<script>alert("Existen campos vac&iacute;os");</script>';
			}
		}
	} else {
?>
			 <script type="text/javascript">
		   	location.href = "..";
		 	</script>
<?php
	}
} else {
?>
		<div class="bordes">
		<br><br><br><br><br>
		<form name="recuperar" method="post" action="enviar.php">
		  
		  <table align="center">
<?php
	$mensaje = $_GET['mensaje'];
	if ($mensaje=="error") {
?>
	<tr>
	<td colspan="2" align="center">
	<font size="2" color="red">E-mail Incorrecto</font>
	</td>
	</tr>
<?php
	}

	if ($mensaje=="error2") {
?>
		  <tr>
		  <td colspan="2" align="center">
		  <font size="2" color="red">C�digo Incorrecto</font>
		  </td>
		  </tr>
		  <?php
	  }
?>
	  <tr>
	      <td width="50%" align="right">
		  <font size="2"><b>Ingres� tu mail:</b></font> 
	   	  </td>	
	   	  	<td>
		<input type="text" name="mail">
	    </td>
	   </tr> 
	 <tr>
		 <td width="50%" align="right">
		  <font size="2"><b>* C&oacute;digo de im&aacute;gen:</b></font> 
	   	 </td>
		 <td>
	<?php
	require_once('../recaptcha/recaptchalib.php');
	$publickey = "6Ldb2AAAAAAAAP90qGpEqecjl9MEkLe6-S_l4rM8";
	echo recaptcha_get_html($publickey);
	?>
		 </td>
		 </tr>
		 <tr>
		  <td width="50%" align="center">
		  </td>
		  <td>
		  <INPUT TYPE="submit" NAME="botonregistrar" class="submit_button" VALUE="Recuperar">
	  	  <br>
		  </td>
	   	</tr>  
		</table>
	</form>
	<br><br><br><br><br><br>
	<?php
	include ('../footer.html');
}
?>
</div> 
</div>		
		
