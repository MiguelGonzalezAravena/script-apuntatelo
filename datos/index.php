<?php
//DATOS
include($_SERVER['DOCUMENT_ROOT']."/header.php");
$var2=0;
$action = $_GET['action'];
?>

<html>
<head>
<title>Apuntatelo - Tu link-sharing de apuntes</title>
<script language="javascript" type="text/javascript">
	
	function validate_data()
	{
		var f=document.forms.reg;

		//Chequeo por empty
		var fit='nombre,ciudad,dia,mes,ano'.split(',');
		for(var i=0; i<fit.length; i++)
		{
			if(f[fit[i]].value=='')
			{
				alert('El campo ' + fit[i] + ' es obligatorio.');
				f[fit[i]].focus();
				return false;
			}
		}

		//Chequeo la edad
		var y=((new Date()).getYear()<200? (new Date()).getYear()+1900 : (new Date()).getYear());
		if(parseInt(f.ano.value)+18>y)
		{
			alert('Apuntatelo es un sitio para mayores de edad.');
			return false;
		}	
	}

	<!--
	function popup(mylink, windowname)
	{
	if (! window.focus)return true;
	var href;
	if (typeof(mylink) == 'string')
   		href=mylink;
	else
   		href=mylink.href;
	window.open(href, windowname, 'width=350,height=265,scrollbars=yes');
	return false;
	}
	//-->
</SCRIPT>
</head>
<body>

<?
if ($action!="recuperar")
{
	if($_SESSION['user']!=null)
	{
		$user=$_SESSION['user'];
		$sql = "SELECT nick, nombre, mail, avatar, pais, ciudad, sexo, dia, mes, ano, mensajero, mensaje ";
		$sql.= "FROM usuarios where nick='$user' ";
		$rs = mysql_query($sql, $con);
		while($row = mysql_fetch_array($rs))
		{
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
		<table width="90%"  border="0" cellspacing="2" cellpadding="2">   
		      
			<FORM name="reg" method="post" onsubmit="return validate_data();">
		     <tr>
		      <td width="50%" align="right">
			  <font size="2"><b>Usuario:</b></font> 
		   	  </td>	
		   	  	<td>
			<font size="2"><?echo $_SESSION['user']?>
		    </td>
		   </tr> 
		   <tr>
		     <td width="50%" align="right">
			  <font size="2"><b>Nombre y Apellido:</b></font> 
		   	 </td>
		   	<td>
			<INPUT TYPE="text" NAME="nombre" SIZE="28" MAXLENGTH="35" value="<?php echo $nombrebis ?>">	
		    </td>
		   </tr> 
		   <td width="50%" align="right">
			  <font size="2"><b>Contraseña:</b></font> 
		   	 </td>
		   	<td>
			<a href="password.php" onClick="return popup(this, 'widthheight')"><font size="2" color="gray"><b>Cambiar</b></font></a>
		    </td>
		   </tr>   
		 	
		     <td width="50%" align="right">
			  <font size="2"><b>E-mail:</b></font> 
		   	 </td>
		   	<td>
			<a href="mailto:<?echo $mailbis?>"><font size="2" color="blue"><?php echo $mailbis ?></font></a>
		    </td>
		   </tr> 
		           
			 <tr>
		     <td width="50%" align="right">
			  <font size="2"><b>Avatar:</b></font> 
		   	 </td>
		   	<td>
			<INPUT TYPE="text" NAME="avatar" SIZE="36" MAXLENGTH="150" value="<?php echo $avatarbis ?>">	
		    </td>
		   </tr>
		      
			 <tr>
		     <td width="50%" align="right">
		
		<?
			$s[$sexobis] = 'selected="true"';
		?> 
			  <font size="2"><b>Pa&iacute;s:</b></font>
			</td>
		   	<td> 
	   		<select id="pais" name="pais"><?echo $s[0]?>
			<option value="ar" <?echo $s[ar]?>>Argentina</option>
			<option value="bo" <?echo $s[bo]?>>Bolivia</option>
			<option value="br" <?echo $s[br]?>>Brasil</option>
			<option value="cl">Chile</option>

			<option value="co" <?echo $s[co]?>>Colombia</option>
			<option value="cr" <?echo $s[cr]?>>Costa Rica</option>
			<option value="cu" <?echo $s[cu]?>>Cuba</option>
			<option value="ec" <?echo $s[ec]?>>Ecuador</option>
			<option value="es" <?echo $s[es]?>>Espa&ntilde;a</option>
			<option value="gt" <?echo $s[gt]?>>Guatemala</option>

			<option value="it" <?echo $s[it]?>>Italia</option>
			<option value="mx" <?echo $s[mx]?>>Mexico</option>
			<option value="py" <?echo $s[py]?>>Paraguay</option>
			<option value="pe" <?echo $s[pe]?>>Per&uacute;</option>
			<option value="pt" <?echo $s[pt]?>>Portugal</option>
			<option value="pr" <?echo $s[pr]?>>Puerto Rico</option>

			<option value="uy" <?echo $s[uy]?>>Uruguay</option>
			<option value="ve" <?echo $s[ve]?>>Venezuela</option>
			<option value="ot" <?echo $s[ot]?>>Otro</option>
		</select>				

			</td>
		   </tr>
		   
		    <tr>
		     <td width="50%" align="right">
			  <font size="2"><b>Ciudad:</b></font> 
		   	 </td>
		   	<td>
			<INPUT TYPE="text" NAME="Ciudad" SIZE="20" MAXLENGTH="50" value="<?echo $ciudadbis ?>">	
		    </td>
		   </tr>
		  
		    <tr>
		     <td width="50%" align="right">
			  <font size="2"><b>Sexo:</b></font> 
		   	 </td>
		   	<td>
		<?
		if ($sexobis=="Hombre")
			$s1="checked";
		else
			$s2="checked";
		?>
		
		<input type="radio" name="sexo" value="m" <?echo $s1?>><font size="2"><b>Masculino</b></font> 
		
		<input type="radio" name="sexo" value="f"<?echo $s2?>><font size="2"><b>Femenino</b></font> 
			
		    </td>
		   </tr>
		       
			   <tr>
		     <td width="50%" align="right">
			  <font size="2"><b>Fecha de Nacimiento:</b></font> 
		   	 </td>
		   	<td>
			<INPUT TYPE="text" NAME="dia" SIZE="1" MAXLENGTH="2" value="<?echo $diabis ?>">	
		    <INPUT TYPE="text" NAME="mes" SIZE="1" MAXLENGTH="2" value="<?echo $mesbis ?>">
			<INPUT TYPE="text" NAME="ano" SIZE="4" MAXLENGTH="4" value="<?echo $anobis ?>">
			</td>
		   </tr>
		       
		        
			   <tr>
		     <td width="50%" align="right">
			  <font size="2"><b>Mensajero:</b></font> 
		   	 </td>
		   	<td>
			<INPUT TYPE="text" NAME="mensajero" SIZE="20" MAXLENGTH="42" value="<?echo $mensajerobis ?>">	
		    </td>
		   </tr>
		       
			   <tr>
		     <td width="50%" align="right">
			  <font size="2"><b>Mensaje Personal:</b></font> 
		   	 </td>
		   	<td>
			<INPUT TYPE="text" NAME="mensaje" SIZE="20" MAXLENGTH="105" value="<?echo $mensajebis ?>">	
		    </td>
		   </tr>
			 <tr>
			  <td width="50%" align="center">
			  </td>
			  <td>	
			 <font size="2">Al modificar mis datos acepto los t&eacute;rminos de Extreme-Zone
			  </td>
		   	 </tr>
			 <tr>
			  <td width="50%" align="center">
			  </td>
			  <td>
			  <input type="hidden" name="var" value= "1" >
			  <br>
			  <INPUT TYPE="submit" class="submit_button" VALUE="Guardar Cambios">
		  	  </td>
		   </tr>  
		  </FORM>
		</font>
		</table>
		<br>
		<br>
		<?
		include ('../footer.html');
		?>
		</body>
		</html>
		<?
		$var2 = $_POST["var"];
		$pnombre = $_POST["nombre"];
		
		$nombre = trim(htmlentities($_POST["nombre"]));
		$avatar = trim(htmlentities($_POST["avatar"]));
		$pais = trim(htmlentities($_POST["pais"]));
		$ciudad = htmlentities($_POST["ciudad"]); 
		$sexo = htmlentities($_POST["sexo"]);
		$dia = htmlentities($_POST["dia"]);
		$mes = htmlentities($_POST["mes"]);
		$ano = htmlentities($_POST["ano"]);
		$mensajero = trim(htmlentities($_POST["mensajero"]));
		$mensaje = trim(htmlentities($_POST["mensaje"]));
		
		if($var2==1)
			{
		   		if($nombre!="" and $pais!="" and $ciudad!="" and $sexo!="" and $dia!="" and $mes!="" and $ano!="")
				{
					$sql = "Update usuarios Set nombre='$nombre', avatar='$avatar', pais='$pais', ciudad='$ciudad', sexo='$sexo', dia='$dia', mes='$mes', ano='$ano', mensajero='$mensajero', mensaje='$mensaje' Where nick='$user'";
					mysql_query($sql);
					?>
					<SCRIPT LANGUAGE="javascript">
		      			location.href = "../../cambioex.php";
		     			</SCRIPT>
					<?
					mysql_free_result($result);
			       	mysql_close();
		  		}
				else
				{
					echo '<script>alert("Existen campos vacíos");</script>';
				}
			}
		}
		else
		{
		?>
			<SCRIPT LANGUAGE="javascript">
		   	location.href = "..";
		 	</SCRIPT>
		<?
		}
		}
		else
		{
		?>
		<div class="bordes">
		<br><br><br><br><br>
		<form name="recuperar" method="post" action="enviar.php">
		  
		  <table align="center">
		  <?
		  $mensaje = $_GET['mensaje'];
		  if ($mensaje=="error")
		  {
		  ?>
		  <tr>
		  <td colspan="2" align="center">
		  <font size="2" color="red">E-mail Incorrecto</font>
		  </td>
		  </tr>
		  <?
		  }
		  if ($mensaje=="error2")
		  {
		  ?>
		  <tr>
		  <td colspan="2" align="center">
		  <font size="2" color="red">Código Incorrecto</font>
		  </td>
		  </tr>
		  <?
	  }
	  ?>
	  <tr>
	      <td width="50%" align="right">
		  <font size="2"><b>Ingresá tu mail:</b></font> 
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
	<?
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
	<?
	include ('../footer.html');
}
?>
</div> 
</div>		
		
