<?php
//REGISTRO
include("../header.php");
$error=$_GET['error'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Apuntatelo - Tu link-sharing de apuntes</title>
<script language="javascript" type="text/javascript">
	
	function validate_data()
	{
		var f=document.forms.reg;

		
		//Chequeo por empty
		var fit='nombre,nick,password1,password2,mail1,mail2,ciudad,dia,mes,ano'.split(',');
		for(var i=0; i<fit.length; i++)
		{
			if(f[fit[i]].value=='')
			{
				alert('El campo ' + fit[i] + ' es obligatorio.');
				f[fit[i]].focus();
				return false;
			}
		}

		//Chequeo passwords
		if(f.password1.value != f.password2.value)
		{
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
<FORM name="reg" method="post" action="registrar.php" onsubmit="return validate_data();">
<table  width="900" align="right" border="0" cellspacing="2" cellpadding="2">      	  
   <tr>
     <td width="50%" align="right">
	  <font size="2"><b>* Nombre y Apellido:</b></font> 
   	 </td>
   	<td>
	<INPUT TYPE="text" NAME="nombre" SIZE="28" MAXLENGTH="35" value="<?php if (isset($_GET['nombre'])) echo $_GET['nombre']; ?>">	
    </td>
   </tr>
      
   <tr>
      <td width="50%" align="right">
	  <font size="2"><b>* (Mín 3 caracteres) Usuario:</b></font> 
   	  </td>	
   	  	<td>
	<INPUT TYPE="text" NAME="nick" id="verificacion" SIZE="20" MAXLENGTH="20" value="<?php if (isset($_GET['nick'])) echo $_GET['nick']; ?>">	
	</td>
   </tr>
      
   <tr>
      <td width="50%" align="right">
	  <font size="2"><b>* Contraseña:</b></font>
   	  </td>
   	  <td>
	  <INPUT TYPE="password" NAME="password1" SIZE="20" MAXLENGTH="15">
   	  </td>
   </tr>
      
   <tr>
      <td width="50%" align="right">
	  <font size="2"><b>* Confirmar Contraseña:</b></font> 
  	  </td>
  	  <td>
	  <INPUT TYPE="password" NAME="password2" SIZE="20" MAXLENGTH="15">
  	  </td>
  </tr>
      
 	
     <td width="50%" align="right">
	  <font size="2"><b>* E-mail:</b></font> 
   	 </td>
   	<td>
	<INPUT TYPE="text" NAME="mail1" SIZE="25" MAXLENGTH="40" value="<?php if (isset($_GET['mail1'])) echo $_GET['mail1']; ?>">	
    </td>
   </tr>
      
    <tr>
     <td width="50%" align="right">
	  <font size="2"><b>* Confirmar E-mail:</b></font> 
   	 </td>
   	<td>
	<INPUT TYPE="text" NAME="mail2" SIZE="25" MAXLENGTH="40" value="<?php if (isset($_GET['mail1'])) echo $_GET['mail1']; ?>">	
    </td>
   </tr>
         
	 <tr>
     <td width="50%" align="right">
	  <font size="2"><b>Avatar:</b></font> 
   	 </td>
   	<td>
	<INPUT TYPE="text" NAME="avatar" SIZE="36" MAXLENGTH="150" value="<?php if (isset($_GET['avatar'])) echo $_GET['avatar']; else echo "http://www.extreme-zone.cl/imagenes/avatar.jpg"; ?>">	
    </td>
   </tr>
      
	 <tr>
     <td width="50%" align="right">
	  <font size="2"><b>* Pa&iacute;s:</b></font>
	</td>
   	<td> 
   		<select id="pais" name="pais">
			<option value="-1">Seleccionar Pa&iacute;s</option>
			<option value="ar" <?if ($_GET['pais']=="ar") echo"selected='true'"?>>Argentina</option>
			<option value="bo" <?if ($_GET['pais']=="bo") echo"selected='true'"?>>Bolivia</option>
			<option value="br" <?if ($_GET['pais']=="br") echo"selected='true'"?>>Brasil</option>
			<option value="cl" <?if ($_GET['pais']=="cl") echo"selected='true'"?>>Chile</option>

			<option value="co" <?if ($_GET['pais']=="co") echo"selected='true'"?>>Colombia</option>
			<option value="cr" <?if ($_GET['pais']=="cr") echo"selected='true'"?>>Costa Rica</option>
			<option value="cu" <?if ($_GET['pais']=="cu") echo"selected='true'"?>>Cuba</option>
			<option value="ec" <?if ($_GET['pais']=="ec") echo"selected='true'"?>>Ecuador</option>
			<option value="es" <?if ($_GET['pais']=="es") echo"selected='true'"?>>Espa&ntilde;a</option>
			<option value="gt" <?if ($_GET['pais']=="gt") echo"selected='true'"?>>Guatemala</option>

			<option value="it" <?if ($_GET['pais']=="it") echo"selected='true'"?>>Italia</option>
			<option value="mx" <?if ($_GET['pais']=="mx") echo"selected='true'"?>>Mexico</option>
			<option value="py" <?if ($_GET['pais']=="py") echo"selected='true'"?>>Paraguay</option>
			<option value="pe" <?if ($_GET['pais']=="pe") echo"selected='true'"?>>Peru</option>
			<option value="pt" <?if ($_GET['pais']=="pt") echo"selected='true'"?>>Portugal</option>
			<option value="pr" <?if ($_GET['pais']=="pr") echo"selected='true'"?>>Puerto Rico</option>

			<option value="uy" <?if ($_GET['pais']=="uy") echo"selected='true'"?>>Uruguay</option>
			<option value="ve" <?if ($_GET['pais']=="ve") echo"selected='true'"?>>Venezuela</option>
			<option value="ot" <?if ($_GET['pais']=="ot") echo"selected='true'"?>>Otro</option>
		</select>
	</td>
   </tr>
   
    <tr>
     <td width="50%" align="right">
	  <font size="2"><b>* Ciudad:</b></font> 
   	 </td>
   	<td>
	<INPUT TYPE="text" NAME="ciudad" SIZE="20" MAXLENGTH="50" value="<?php if (isset($_GET['ciudad'])) echo $_GET['ciudad']; ?>">	
    </td>
   </tr>
  
    <tr>
     <td width="50%" align="right">
	  <font size="2"><b>* Sexo:</b></font> 
   	 </td>
   	<td>
<input type="radio" name="sexo" value="m" <?if ($_GET['sexo']=="m") echo"checked"?>><font size="2"><b>Masculino</b></font> 
<input type="radio" name="sexo" value="f" <?if ($_GET['sexo']=="f") echo"checked"?>><font size="2"><b>Femenino</b></font> 
	
    </td>
   </tr>
       
	   <tr>
     <td width="50%" align="right">
	  <font size="2"><b>* Fecha de Nacimiento:</b></font> 
   	 </td>
   	<td>
	<INPUT TYPE="text" NAME="dia" SIZE="1" MAXLENGTH="2" value="<?php if (isset($_GET['dia'])) echo $_GET['dia']; ?>">	
    <INPUT TYPE="text" NAME="mes" SIZE="1" MAXLENGTH="2" value="<?php if (isset($_GET['mes'])) echo $_GET['mes']; ?>">
	<INPUT TYPE="text" NAME="ano" SIZE="4" MAXLENGTH="4" value="<?php if (isset($_GET['ano'])) echo $_GET['ano']; ?>">
	</td>
   </tr>       
	   <tr>
     <td width="50%" align="right">
	  <font size="2"><b>Mensajero:</b></font> 
   	 </td>
   	<td>
	<INPUT TYPE="text" NAME="mensajero" SIZE="20" MAXLENGTH="42" value="<?php if (isset($_GET['mensajero'])) echo $_GET['mensajero']; ?>">	
    </td>
   </tr>
       
	   <tr>
     <td width="50%" align="right">
	  <font size="2"><b>Mensaje Personal:</b></font> 
   	 </td>
   	<td>
	<INPUT TYPE="text" NAME="mensaje" SIZE="20" MAXLENGTH="105" value="<?php if (isset($_GET['mensaje'])) echo $_GET['mensaje']; ?>">	
    </td>
    </tr>
	 <tr>
	 <td width="50%" align="right">
	  <font size="2"><b>* C&oacute;digo de im&aacute;gen:</b></font> 
   	 </td>
	 <td>
<?php
require_once('../recaptcha/recaptchalib.php');
$publickey = "6LeshgQAAAAAALjtDUihVkRn9jxIyi-ND7_2dOew";
echo recaptcha_get_html($publickey);
?>
	 </td>
	 </tr>
	 <tr> 
	 <td>
	 </td>
	 <td>	
	 <input type="checkbox" name="terminos" CHECKED value="checkbox"><font size="2">Acepto haber leído y estar de acuerdo con los términos de Extreme-Zone.
	  </td>
	  </tr>
	 <tr>
	  <td width="50%" align="center">
	  <br><font size="2"><b>* Campos obligatorios</b></font>
	  </td>
	  <td>
	  <INPUT TYPE="submit" NAME="botonregistrar" class="submit_button" VALUE="Registrar">
  	  <br>
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
<?
include('../footer.html');
?>

</div>
</div>
</td>
</tr>
</table>
</div>
</body>
</html>

<?
switch ($error){
case "1":
echo '<script>alert("Usuario Existente");</script>';
break;
case "2":
echo '<script>alert("Mail ya existente en nuestra base de datos");</script>';
break;
case "3":
echo '<script>alert("El nick debe tener por lo menos 3 caracteres");</script>';
break;
case "4":
echo '<script>alert("Existen campos vacíos o los campos de contraseña y/o mail no son iguales");</script>';
break;
case "5":
echo '<script>alert("Código Incorrecto");</script>';
break;
}
?>		