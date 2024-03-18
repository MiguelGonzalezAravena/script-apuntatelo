<?
$sql = "SELECT * ";
$sql.= "FROM usuarios where id='$id_autor'";
$rs = mysql_query($sql, $con);

$row = mysql_fetch_array($rs);
$nick=$row['nick'];
if ($row['rango']=="Administrador")
$color="red";
elseif ($row['rango']=="Moderador")
$color="blue";
elseif ($row['rango']=="Usuario Destacado")
$color="green";
else
$color="black";

$cant = strlen($nick);
if($cant > 18)
	{
		$nick2=substr(stripslashes($nick), 0, 15);
			$nick2=$nick2."...";
}
else
	{
		$nick2=$nick;
}
?>
<?php
function rango($valor)
{
			
$valor = str_replace("Administrador", "<br clear=\"left\" /><img src=\"/imagenes/rangos/administrador.png\" alt=\"Administrador\" title=\"Administrador\" />", $valor);

return $valor;
}

function pais($valor)
{
					
$valor = str_replace("ar", "Argentina", $valor);
$valor = str_replace("bo", "Bolivia", $valor);
$valor = str_replace("br", "Brasil", $valor);
$valor = str_replace("cl", "Chile", $valor);
$valor = str_replace("co", "Colombia", $valor);
$valor = str_replace("cr", "Costa Rica", $valor);
$valor = str_replace("cu", "Cuba", $valor);
$valor = str_replace("ec", "Ecuador", $valor);
$valor = str_replace("es", "Espa&ntilde;a", $valor);
$valor = str_replace("gt", "Guatemala", $valor);
$valor = str_replace("it", "Italia", $valor);
$valor = str_replace("mx", "M&eacute;xico", $valor);
$valor = str_replace("py", "Paraguay", $valor);
$valor = str_replace("pe", "Per&uacute;", $valor);
$valor = str_replace("pt", "Portugal", $valor);
$valor = str_replace("pr", "Puerto Rico", $valor);
$valor = str_replace("uy", "Uruguay", $valor);
$valor = str_replace("ve", "Venezuela", $valor);
$valor = str_replace("ot", "Otro", $valor);

return $valor;
}

function sexo($valor)
{
					
$valor = str_replace("m", "Hombre", $valor);
$valor = str_replace("f", "Mujer", $valor);


return $valor;
}
?>
<div class="box_title" style="height:21px; width:160px;">
	<div class="box_txt" style="width:160px; text-align:left;">
		<div class="esq1" style="float:left;"></div>
		<div style="float:left; padding-top: 4px;">Posteado por:</div>
		<div class="esq2" style="float:right;"></div>
	</div>
</div>
<div align="left">
<div class="box_perfil" <?$iexp = $_SERVER[HTTP_USER_AGENT];if(strstr($iexp,"MSIE")){echo 'style="width:160px;"';}?>>
	<img src="<?echo $row['avatar']?>" style="display:block; margin: auto;" border="0" alt="" title="">
	<b class="txt"><?echo "<a href='/perfil/?id=$nick'><font color='$color'><b>".$nick2."</b></font></a>";?></b>
	<font size="1"><?echo $row['rango'];?><br />
	<?echo rango($row['rango']);?> <img title="<?echo sexo($row['sexo']);?>" src="/imagenes/<?echo sexo($row['sexo']);?>.png" /> <img title="<?echo pais($row['pais']);?>" src="/imagenes/banderas/<?echo $row['pais'];?>.png" /><hr>
	<?echo $row['numposts']?> Posts<br />
	<?echo $row['numcomentarios']?> Comentarios<br />
	<?echo $row['puntos']?> Puntos<br />
	<?if ($_SESSION['id']!="") {?>
	
	<hr>
	<a href='/mensajes/redactar.php?para=<?=$nick?>'><img src='/imagenes/mp.png'> Enviar mensaje</a>
	<?}?>
	</font>
</div>						
</div>
