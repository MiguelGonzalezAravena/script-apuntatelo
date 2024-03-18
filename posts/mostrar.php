<?php
include($_SERVER['DOCUMENT_ROOT'].'/header.php');
$id = no_injection($_GET["id"]);
 $aux = substr( $_SERVER['REQUEST_URI'], strlen('/posts/'));

if( substr( $aux, -1) == '/')
{
	$aux = substr( $aux, 0, -1);
}

$variables = explode( '/', $aux);
$id = no_injection($variables[0]);

$user = $_SESSION['user'];
$sql = "SELECT id, elim, id_autor, titulo, contenido, privado, coments, tags FROM posts where id='$id'";
$rs = mysql_query($sql, $con);
$row = mysql_fetch_array($rs);

$contenido = $row['contenido'];
$id_autor = $row['id_autor'];
$titulo = $row['titulo'];
$elim = $row['elim'];
$privado = $row['privado'];
$coments = $row['coments'];
$visitas = $row['visitas'];
$tags = $row['tags'];

if ($id_autor!="")
	$esta=1;

$cant = strlen($titulo);
if($cant > 50)
{
	$titulo2=substr(stripslashes($titulo), 0, 50);
	$tit=1;
}
else
{
	$titulo2=$titulo;
	$tit=0;
}
?>
<html>
<head>
<title>eXtreme Zone - <?echo $titulo2; if ($tit==1) echo"...";?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="/estilos/posts.css" />
</head>
<body>

<?
if ($elim==0 and $esta==1)
{
	if($user!="" or $privado==0)
	{
		?>
		<div class="bordes" style="height:auto;">
		<br>
		<?
		if ($HTTP_X_FORWARDED_FOR == "")
		{
			$ip = getenv(REMOTE_ADDR);
		}
		else
		{
			$ip = getenv(HTTP_X_FORWARDED_FOR);
		}
		
		contarVisita($id, $ip);
		
		if(!strstr($_SERVER[HTTP_USER_AGENT],"MSIE"))
		{
			echo"<table width='980'>
			<tr>
			<td>";
		}
		?>
		<div id="maincontainer">	
			<div id="cuerpocontainer">
		<!-- inicio cuerpocontainer -->
			<a name="arriba"/></a>
				<div id="post-izquierda" style="_margin-left:<?$iexp = $_SERVER[HTTP_USER_AGENT];if(strstr($iexp,"MSIE 6")){echo "7px;";}else{echo "15px";}?>;">
				<?include('estructuras/autor.php');?>
				<br clear="left">
				</div>
		
				<div id="post-centro">
					<div class="fondo_cuadro">
						<div style="width:781px;float:left;text-align:center;font-size:13px;">
							<div class="esq1" style="float:left;"></div>
							<div  class="franja" style="float:left; width:765px; text-align:center;"><div style="padding-top:2px;"><a href="/posts/<?echo $id-1?>/"><img src="/imagenes/izq.png"></a>&nbsp;&nbsp;&nbsp;&nbsp;<?echo $titulo2; if ($tit==1) echo"...";?>&nbsp;&nbsp;&nbsp;&nbsp;<a href="/posts/<?echo $id+1?>/"><img src="/imagenes/der.png"></a></div></div>
							<div class="esq2" style="float:right;"></div>
						</div>
						<div style="width:781px;font-size:13px;text-align:left;">
							<div style="padding:5px;"><? echo BBparse($contenido) ?></div>
						</div>
					</div>
					<br class="space">
					<div style="width:780px;float:left;">
						<table align="center">
						<tr>
						<td valign="top">
							<?include('estructuras/consultainfo.php');?>
						</td>
						<td valign="top">
							<?include('estructuras/puntos.php');?>
							<br>
							<?include('estructuras/favoritos.php');?>
						</td>
						</tr>
						</table>
						<br>
						<?
						include('estructuras/botonboryedi.php');
						?>
						<br class="space">
							<div style="width:100%;float:left;margin-top:11px;">
							
								<div class="box_title" style="height:21px; width:780px;">
									<div class="box_txt" style="width:780px; text-align:left;">
										<div class="esq1" style="float:left;"></div>
										<div style="float:left; padding-top: 4px;">Comentarios</div>
										<div class="esq2" style="float:right;"></div>
									</div>
								</div>
								<div class="box_cuerpo" style="font-size:12px; text-align:left">
									<?
									include ('estructuras/consulta.php');
									?>
								</div>
							</div>
							<div style="width:100%;float:left;margin-top:11px;">
							<br>
							<?
							include ('estructuras/comentario.php');
							?>
							</div>
						</div>
				</div>
			</div>
		</div>
		<?
		if(!strstr($_SERVER[HTTP_USER_AGENT],"MSIE"))
		{
		echo"</td>
		</tr>
		</table>";
		}
		?>
		</div>
		<div class="bordes" style="height:55px">
		<?
		include ('../footer.html');
		?>
		</div>
		<?
	}
	else
	{
		?>
		<div class="bordes">
		<table width="100%" height="365" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="25%" height"120" align="center">
				</td>
				<td>
				</td>
				<td>
				</td>
			</tr>
			<tr>
			<td width="35%" height="30%" align="center">
			</td>
				<td width="30%" height="35%" align="left" valign="top" class="fondo_cuadro">
					<table cellpadding="0" cellspacing="0" width="387" align="center" border="0">
						<tr>
							<td></td>
							<td> 
								<div class="esq1" style="float:left;"></div>
								<div class="franja" style="float:left; width: 371px;"><div style="padding-top:2px;">Error</div></div>
								<div class="esq2" style="float:left;"></div>
							</td>
						</tr>
					</table>
					<br>
					<div align="center"><font size="2">El post es privado. Debés ser un usuario registrado para poder acceder.</font></div> 
				
				</td>
				<td width="35%" height="30%" align="center">
				</td>
			</tr>
			<tr>
				<td width="25%" height="30%" align="center">
				</td>
				<td>
				</td>
				<td>
				</td>
			</tr>
		</table>
		<?
		include ('../footer.html');
		?>
		</div>
		<?
	}
}
else
{
	?>
	<div class="bordes">
	<br>
	<table width="100%" height="365" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td width="25%" height"120" align="center">
			</td>
			<td>
			</td>
			<td>
			</td>
		</tr>
		<tr>
		<td width="35%" height="30%" align="center">
		</td>
			<td width="30%" height="35%" align="left" valign="top" class="fondo_cuadro">
				<table cellpadding="0" cellspacing="0" width="387" align="center" border="0">
					<tr>
						<td></td>
						<td> 
							<div class="esq1" style="float:left;"></div>
							<div class="franja" style="float:left; width: 371px;"><div style="padding-top:2px;">Error</div></div>
							<div class="esq2" style="float:left;"></div>
						</td>
					</tr>
				</table>
				<br>
				<div align="center"><font size="2"><?if ($esta==1){ echo "Post Eliminado"; } else { echo "No existe el Post"; }?></font></div> 
			
			</td>
			<td width="35%" height="30%" align="center">
			</td>
		</tr>
		<tr>
			<td width="25%" height="30%" align="center">
			</td>
			<td>
			</td>
			<td>
			</td>
		</tr>
	</table>
	<?
	include ('../footer.html');
	?>
	</div>
	<?
}
?>
</div>
</div>
</td>
</tr>
</table>


</body>
</html>