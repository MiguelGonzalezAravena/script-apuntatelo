<?php
//INDEX
require('header.php');
$contcom=0;
?>
<html>
<head>
<title>eXtreme Zone - La comunidad de Linksharing que estabas esperando!</title>
<link rel="stylesheet" type="text/css" href="ajaxtabs/ajaxtabs.css" />
<script type="text/javascript" src="indexs/todos/ajax.js"></script>

<script type="text/javascript" src="indexs/Apuntes/ajaxapuntes.js"></script>
<script type="text/javascript" src="indexs/Ebooks/ajaxebooks.js"></script>
<script type="text/javascript" src="indexs/Examenes/ajaxexamenes.js"></script>
<script type="text/javascript" src="indexs/Info-Universidades/ajaxinfo.js"></script>
<script type="text/javascript" src="indexs/Softs-Estudiantiles/ajaxsoft.js"></script>
<script type="text/javascript" src="indexs/Videos/ajaxvideos.js"></script>
<script type="text/javascript" src="indexs/Biografias/ajaxbiografias.js"></script>
<script type="text/javascript" src="indexs/Tutoriales/ajaxtutoriales.js"></script>
<style>
a{
 cursor:pointer;
}
</style>
</head>
<body>
<div class="bordes" style="height:1050px; width:980px;">
<table width="980" align="center" cellspacing="0" cellpadding="0">
<tr>
<td>

<div style="width: 970px; top: 115px; margin-left: 15px; position: absolute; text-align: left;" align="center">
<ul id="countrytabs" style="" class="modernbricksmenu2" style="margin-top:17px; margin-left:0px;">
<li><a href="indexs/Todos/" rel="countrycontainer" style="color: #000000;">Todos</a></li>
<?
$sql = "select id_categoria, nom_categoria, link_categoria, imagen from categorias";
$rs = mysql_query($sql,$con);while ($row = mysql_fetch_array($rs))
{
?>
<li><a href="indexs/<?=$row['link_categoria']?>/" rel="countrycontainer" title="<?=$row['nom_categoria']?>"><img src="imagenes/iconos/<?=$row['imagen']?>" alt="<?=$row['nom_categoria']?>"></a></li>
<?
}
?>
</ul>

	<div id="countrydivcontainer" style="border: 0px solid gray; padding: 0px; position: absolute; width: 360px; top: 41px;">
<table>
			<?
			 $Resultado=mysql_query("SELECT p.*, c.* FROM posts as p inner join categorias as c on p.categoria=c.id_categoria where p.elim='0' ORDER BY id desc");
			 
			 while($row=mysql_fetch_array($Resultado)){
					$privado=$row['privado'];
					$cant = strlen($row['titulo']);
					if($cant > 41)
					{
						$titulo2=substr(stripslashes($row['titulo']), 0, 38);
						$tit=1;
					}
					else
					{
						$titulo2=$row['titulo'];
						$tit=0;
					}
					$img = $row['imagen'];
					$cat= $row['link_categoria'];
			?>
				<tr>
				<td>
				&nbsp;<img src="imagenes/iconos/<?echo $img?>" border="0"><?if ($privado=="1"){?>&nbsp;<img src="imagenes/iconos/candado.gif" border="0"><?}?>&nbsp;<a href="posts/<?echo$row['id'];?>/<?echo$cat?>/<?echo correcciones(corregir($row['titulo'])).".html"?>" title="<?=$row['titulo']?>"><font size="2" color="black"><?echo correcciones($titulo2); if ($tit==1) echo"...";?></font></a>
			    </td>
				</tr>         
			<?	
			}
			?>	
			</table>
	 	<div id="contenido">
 		</div>
	</div>
</div>
<script type="text/javascript">

var countries=new ddajaxtabs("countrytabs", "countrydivcontainer")
countries.setpersist(true)
countries.setselectedClassTarget("link") //"link" or "linkparent"
countries.init()

</script>


</td>
</tr>

<tr>
<td>
<div style="width: 980px; top: 0px; position: absolute; text-align: left;" align="center">

	<!-- Comienzo Cuadro Novedades-->
	<div class="esq1 novedad2"></div>
	<div class="franja novedad"><div class="size11 negro" style="margin-top:3px; text-align: center;">Destacados</div></div>
	<div class="esq2 novedad3"></div>	
	<div class="destacados">

		<table cellspacing="0" cellpadding="0" width="300" height="180"><font size="-2"> 
	      <tr>
			  <td valign="top" align="right" style="padding-top: 6px; padding-right: 5px;">
			  </td>
		  </tr>
		  <tr>
		  </tr>
		</table>
	</div>
	<div class="esq5 novedad5"></div>

	<div class="novedad4">&nbsp;</div>
	<div class="esq6 novedad6"></div>
	<!-- Fin Cuadro Novedades-->
	
	<!-- Comienzo Cuadro B�squeda-->
	<div class="esq1 busqueda2"></div>
	<div class="franja busqueda"><div class="size11 negro" style="margin-top:3px; text-align: center;">B&uacute;squeda</div></div>
	<div class="esq2 busqueda3"></div>
	<form name="buscar" action="/busqueda/" method="get" >

	<div class="busq">
		<table cellspacing="0" cellpadding="0" width="271" height="30"> 
		    <tr>
			  	<td align="center" style="padding-top: 8px;">
				  	<input type="text" name="q" size="20" MAXLENGTH="200">
				  	<input type="hidden" name="cx" value="partner-pub-7409854997589224:1bwxhu5zofg" />
       				<input type="hidden" name="cof" value="FORID:10" />
        			<input type="hidden" name="ie" value="ISO-8859-1" />
					<input type="submit" name="Submit" class="submit_button" value="Buscar">

			  	</td>
		  	</tr>
			<tr>
				<td>
					<table style="margin-top:5px; font-size: 11px; text-align:center;" align="center" cellspacing="0" cellpadding="0">
						<tr>
							<td>Buscar con:&nbsp;&nbsp;</td>
							<td><input type="radio" name="tipo_busqueda" value="1" checked='checked'; onclick="javascript: activar();"></td>

							<td>eXtreme Zone&nbsp;&nbsp;</td>
							<td><input type="radio" name="tipo_busqueda" value="2"  onclick="javascript: desactivar();"></td>
							<td><img src="http://www.google.com/images/poweredby_transparent/poweredby_FFFFFF.gif" alt="Google" /></td>
						</tr>
					</table> 
				</td>
			</tr>			
	  	</table> 
	</div>
	</form>

	<div class="esq5 busqueda5"></div>
	<div class="busqueda4">&nbsp;</div>
	<div class="esq6 busqueda6"></div>
    <!-- Fin Cuadro B�squeda-->
	
	<!-- Comienzo Cuadro Enlaces a otras webs-->
	<div class="esq1 webamigas2"></div>
	<div class="franja webamigas"><div class="size11 negro" style="margin-top:3px; text-align: center;">Enlace a otras Webs</div></div>
	<div class="esq2 webamigas3"></div>

	<div class="web">
		<table width="271" height="120"><font size="-2"> 
		    <tr align="center">
				<td>
					<div class="size12">
						<a href="/" target="_blank">Af&iacute;liate a Nosotros!</a><br>

					</div>
				</td>
			</tr>
		</table> 
	</div>

	<div class="esq5 webamigas5"></div>
	<div class="webamigas4">&nbsp;</div>
	<div class="esq6 webamigas6"></div> 
	<!-- Fin Cuadro Enlaces a otras webs-->
	
	<!-- Comienzo Cuadro Foro-->
	<div class="esq1 foro2"></div>
	<div class="franja foro"><div class="size11 negro" style="margin-top:3px; text-align: center;">Foro Apuntatelo</div></div>
	<div class="esq2 foro3"></div>
	<div class="for" align="center">

		<div style="margin-top:3px;"><img src="imagenes/foro.png"></div>
	</div>
	<div class="esq5 foro5"></div>
	<div class="foro4">&nbsp;</div>
	<div class="esq6 foro6"></div>
	<!-- Fin Cuadro Foro-->
	
	<!-- Comienzo Cuadro Publicidad-->
	<div class="esq1 publicidad2"></div>
	<div class="franja publicidad"><div class="size11 negro" style="margin-top:3px; text-align: center;">Publicidad</div></div>

	<div class="esq2 publicidad3"></div>
	<div class="pub">
		<table width="271" height="300"> 
	      <tr align="center">
		  	<td valign="top">
		  	<br>
Aqu� tu Publicidad

		 	 </td>
		   </tr>
		  </table>
	</div>
	<div class="esq5 publicidad5"></div>
	<div class="publicidad4">&nbsp;</div>
	<div class="esq6 publicidad6"></div>
	<!-- Fin Cuadro Publicidad-->

	<!-- Comienzo Cuadro Comentarios-->
	<div class="esq1 comentarios2"></div> 	
	<div class="franja comentarios"><div class="size11 negro" style="margin-top:3px; text-align: center;">&Uacute;ltimos comentarios</div></div>
	<div class="esq2 comentarios3"></div>
	<div class="Coment">
	<?php
	include('ultimos_comentarios.php');
	?>
	</div>
	<div class="esq5 comentarios5"></div>
	<div class="comentarios4">&nbsp;</div>
	<div class="esq6 comentarios6"></div>
	<!-- Fin Cuadro Comentarios-->
	<div class="esq1 votados2"></div>  	
	<div class="franja votados"><div class="size11 negro" style="margin-top:3px; text-align: center;">Posts m&aacute;s votados</div></div>
	<div class="esq2 votados3"></div>
	<div class="top">
		<table width="300" height="190"><font size="-2"> 
		    <tr>
				<td valign="top">
				  	<?
				  	$sql = "SELECT id,titulo, puntos, categoria, c.link_categoria
							FROM posts as p
							inner join categorias as c
							on p.categoria=c.id_categoria
							where elim='0'
							ORDER BY puntos DESC, id asc limit 0,15 ";
					$rs = mysql_query($sql, $con);
					while($row = mysql_fetch_array($rs))
					{
						$titu = $row['titulo'];
						$puntos = $row['puntos'];
						$id = $row['id'];
						?>
				  							<font size="1">

						<?
						$contcom=$contcom+1;
						$cant = strlen($titu);
						if($cant > 41)
						{
							$titulo2=substr(stripslashes($titu), 0, 38);
							$tit=1;
				 				}
						else
			 			{
			 				$titulo2=$titu;
			 				$tit=0;
						}
						?>
													<a href="/posts/<?echo $id;?>/<?echo $row['link_categoria']?>/<?echo corregir($row['titulo']).".html"?>"><font color="black"><?echo $titulo2; if ($tit==1) echo"...";?></a><?echo" (".$puntos.")"?></font>
							</font>
							<br>
						<?
					}
				  	?>
										</td>
			</tr>
		</table>
	</div>
	<div class="esq5 votados5"></div>
	<div class="votados4">&nbsp;</div>
	<div class="esq6 votados6"></div>
	<!-- Fin Cuadro Votados-->
	
	<!-- Comienzo Cuadro Usuarios-->
	<div class="esq1 musuarios2"></div>  	
	<div class="franja musuarios"><div class="size11 negro" style="margin-top:3px; text-align: center;">Usuarios m&aacute;s votados</div></div>

	<div class="esq2 musuarios3"></div>
	<div class="m_user">
	<table width="300" height="194"><font size="-2"> 
    	<tr>
		  	<td valign="top" align="center">
			  	<?
			  	$sql = "SELECT nick, puntos ";
				$sql.= "FROM usuarios where ban='0' ORDER BY puntos DESC, id asc limit 0,15 ";
				$rs = mysql_query($sql, $con);
				while($row = mysql_fetch_array($rs))
				{
					$nick = $row['nick'];
					$puntos = $row['puntos'];
					?>
			  							<font size="1">
						<a href="/perfil/?id=<?echo $nick?>"><font color="black"><b><?echo $nick;?></b></a><?echo" (".$puntos.")"?></font>
						</font>
						<br>

					<?
				}
			  	?>
								</td>
		</tr>
	</table>
	</div>

	<div class="esq5 musuarios5"></div>
	<div class="musuarios4">&nbsp;</div>
	<div class="esq6 musuarios6"></div>
	<!-- Fin Cuadro Usuarios-->
	
	<!-- Comienzo Cuadro Estadisticas-->
	<div class="esq1 estadistica2"></div>
	<div class="franja estadistica"><div class="size11 negro" style="margin-top:3px; text-align: center;">Estad&iacute;sticas</div></div>
	<div class="esq2 estadistica3"></div>

	<div class="est">
		<?
		$sql = "SELECT id ";
		$sql.= "FROM usuarios ORDER BY id DESC ";
		$rs = mysql_query($sql, $con);
		$row = mysql_fetch_array($rs);
		$miembros=$row['id'];
		if ($miembros=="")
		$miembros=0;
		?>
				<table width="271" height="70"><font size="-2"> 
			<tr align="center">
				<td width="110" align="right" valign="middle">
					<font size="1">
					<font color="red"><?echo $miembros?>&nbsp;</font><br>
					<iframe src="/online.php" width="70" height="22" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no"></iframe><?$iexp = $_SERVER[HTTP_USER_AGENT];if(strstr($iexp,"MSIE")){echo "&nbsp;";}?>
					<?
					$sql = "select cant from cantidad order by id asc";
					$rs = mysql_query($sql,$con);
					while ($row = mysql_fetch_array($rs))
					{
					echo $row['cant']."&nbsp;<br>";
					}
					?>
					</font>
					</td>
					<td align="left" valign="middle">
					<font size="1">
					<font color="red">miembros</font><br>
					<font color="green">usuarios online</font><br>
					posts<br>
					comentarios<br>
					</font>
				</td>
			</tr>
		</table> 
	</div>
	<div class="esq5 estadistica5"></div>
	<div class="estadistica4">&nbsp;</div>
	<div class="esq6 estadistica6"></div>      
	<!-- Fin Cuadro Estadisticas-->

<br>
<div class="Footer">
<?
include('footer.html');
?>
</div>
</div>		
</td>
</tr>
</table>
</body>
</html>

