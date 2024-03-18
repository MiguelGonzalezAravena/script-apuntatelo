<?php
	//HEADER
	include($_SERVER['DOCUMENT_ROOT'].'/includes/configuracion.php');
	include($_SERVER['DOCUMENT_ROOT'].'/includes/funciones.php');
	include($_SERVER['DOCUMENT_ROOT'].'/login.php');
	if ($_SERVER['REQUEST_URI']!="/" and $_SERVER['REQUEST_URI']!="index.php")
	include($_SERVER['DOCUMENT_ROOT'].'/online2.php');
?> 
<!--APUNTATELO v 2.0 - TODOS LOS DERECHOS RESERVADOS-->
<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01//EN\" \"http://www.w3.org/TR/html4/strict.dtd\">
<html>
<head>
<link href='/imagenes/logo/icono.bmp' rel='shortcut icon'/>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="/estilos/index.css" />
<link href="/ultimos_posts/" title="eXtreme Zone - Ultimos Posts" type="application/rss+xml" rel="alternate">
</head>
<body bgcolor="white" text="#FFFFFF" link="#FFFFFF" topmargin="8">

<div class="fondologo">
<div class="esquina_sup_izq" style="font-size:0px;"></div>
<div style="height: 8px; width: 958px; float:left; font-size:0px;">&nbsp;</div>
<div class="esquina_sup_der" style="font-size:0px;"></div>
<a href="/"><div class="logo"></div></a><div align="right"><br>

<div style="padding-right: 20px;">

</div>
</div>
</div>
<div class="bordes">
<div class="menu">
<div class="menu1"></div>
<div class="menu2">
 
   <font color="black">

   <?   
	  if($_SESSION['user']!=null)
	  {
	  	  if($_SERVER['PHP_SELF'] == "/mensajes/mensajes_recibidos.php")
		  include("mensajes/marcar_leido.php");
		  ?>
   		  <div class="user">
		  <div class="size11">
		  <a href='/perfil/?id=<?echo $_SESSION['user']?>' title="Perfil"><font color="black"><?echo $_SESSION['user']?></a>
		  [<a href="/salir.php"><font color="black">x</a>] &nbsp;
		  </font>
		  </div>
		  </div>
		  <div class="user">
		  &nbsp;<a href="/datos/" title="Datos"><font color="black"><img src="/imagenes/iconos/datos.png" alt="Datos"></font></a>
		  </div>
		  <div class="user">
		  &nbsp;&nbsp;<a href="/mensajes/" title="MP"><font color="black"><img src="/imagenes/iconos/mensajes.png" alt="Mensajes Privado"></font></a>
		  </div>
		  <?
		  	$sql_men = "select id_mensaje from mensajes where id_receptor='".$_SESSION['id']."' and leido_receptor='0'";
			$rs_men = mysql_query($sql_men);
			if (mysql_num_rows($rs_men)>0)
		  	{
			?>
			<div class="ini size10" style="padding-top:1px;">
		 	&nbsp;<a href="/mensajes/" style="font-weight: normal;" title="Nuevo Mensaje Privado"><font color="white">(<?echo mysql_num_rows($rs_men);?>)</font></a>
		  	</div>
		  	<?
			}
		  ?>
		  		  <div class="user">
		  &nbsp;&nbsp;<a href="/favoritos/" title="Favoritos"><font color="black"><img src="/imagenes/iconos/favoritos.png" alt="Favoritos"></font></a>
		  </div>

		  <?
		  }
		  else
		  {
		  ?>
   		  <div class="user" style="margin-top:<?$iexp = $_SERVER[HTTP_USER_AGENT];if(strstr($iexp,"MSIE")){echo "0px;";}else{echo "1px";}?>">
		  <table width="20" height="10" border="0" cellspacing="0" cellpadding="0">
		  <FORM ACTION="/ingresar.php" METHOD="post">
	      <tr>
	      <td align="right">
		  <div class="size11 negro">&nbsp;Usuario:&nbsp;</div>
		  </td>
		  <td>
		  <INPUT TYPE="text" NAME="nick" SIZE="12" MAXLENGTH="20" style="font-size:9px"> 
	      </td>

		  <td>
		  </td>
		  <td>
		  <div class="size11 negro">&nbsp;Contraseña:&nbsp;</div>
		  </td>
		  <td>
		  <INPUT TYPE="password" NAME="password" SIZE="12" MAXLENGTH="20" style="font-size:9px">
	      <input type="hidden" name="pagina" value="<?=$_SERVER['REQUEST_URI']?>">
		  </td>
		  <td>
		  </td>
		  <td>
		  &nbsp;
		  </td>
		  <td>
		  <INPUT TYPE="submit" class="submit_button" style="font-size:9px; font-weight: normal;" VALUE="Ingresar">
	      </td>

		  </tr>
		  </FORM> 
		  </table>
		  </div>

	<?	
	}	
?>
		
<?
	if($_SESSION['user']!=null)
    {
	?>
	<div class="ini" style="padding-top: 0px; margin-top: 0px;">

		<div class="size11">
			<table valign="top" border="0" style="color: #000000;">
				<tr>
					<td class="size11" valign="middle">|</td>
					<td class="size11" valign="middle"><a href="/" style="color: #000000;" title="Inicio"><img src="/imagenes/inicio.png" alt="Inicio"></a></td>
					<td class="size11" valign="middle">|</td>
					<td class="size11" valign="middle"><a href="/busqueda/" style="color: #000000;" title="B&uacute;squeda"><img src="/imagenes/busqueda.png" alt="Busqueda"></a></td>
					<td class="size11" valign="middle">|</td>
					<td class="size11" valign="middle"><a href="/protocolo.php" style="color: #000000;">Protocolo</a></td>
					<td class="size11" valign="middle">|</td>
					<td class="size11" valign="middle"><a href="/agregar_post/" style="color: #000000;">Agregar</a></td>
					<td class="size11" valign="middle">|</td>
				</tr>
			</table>
		</div>

	</div>
	  

	<?
	}
	else
	{
	?>
	<div class="ini" style="padding-top: 0px; margin-top: 0px;">
		<div class="size11">
			<table valign="top" border="0" style="color: #000000;">
				<tr>
					<td class="size11" valign="middle">|</td>

					<td class="size11" valign="middle"><a href="/" style="color: #000000;" title="Inicio"><img src="/imagenes/inicio.png" alt="Inicio"></a></td>
					<td class="size11" valign="middle">|</td>
					<td class="size11" valign="middle"><a href="/busqueda/" style="color: #000000;" title="B&uacute;squeda"><img src="/imagenes/busqueda.png" alt="Busqueda"></a></td>
					<td class="size11" valign="middle">|</td>
					<td class="size11" valign="middle"><a href="/protocolo.php" style="color: #000000;">Protocolo</a></td>
					<td class="size11" valign="middle">|</td>
					<td class="size11" valign="middle"><a href="/registro/" style="color: #000000;">Registrarse</a></td>
					<td class="size11" valign="middle">|</td>
				</tr>
			</table>
		</div>
	</div>
	  

	<?
	}	
?>  
	 	</font>
		</b>
</div>
<div class="menu3"></div>
</div>
</div>
</div>
</div>
