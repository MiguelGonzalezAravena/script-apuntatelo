<?php

include($_SERVER['DOCUMENT_ROOT'].'/includes/configuracion.php');
include($_SERVER['DOCUMENT_ROOT'].'/includes/funciones.php');
$tipo = $_POST["tipo"];
$id = $_POST["id"];
$cuerpo=$_POST["cuerpo"];
$cuerpo = stripslashes($cuerpo);
$titulo=trim($_POST["titulo"]);
$titulo = str_replace('\"','"',$titulo);
$titulo = str_replace("\'","'",$titulo);
$id_autor=no_injection($_POST["variable"]);
$categoria=$_POST["categoria"];
$tags=trim($_POST["tags"]);


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

$coments = $_POST["coments"];
if($coments!=0 and $coments!=1)
$coments=0;

$privado=$_POST['privado'];
if($privado!=0 and $privado!=1)
$privado=0;

?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="posts.css" />
</head>
<body>

<div id="maincontainer">	
<div id="cuerpocontainer">
	<div id="post-izquierda" style="_margin-left:<?$iexp = $_SERVER[HTTP_USER_AGENT];if(strstr($iexp,"MSIE 6")){echo "10px;";}else{echo "20px";}?>;">
	<?
	$sql = "SELECT id, rango, nick, puntos, avatar ";
	$sql.= "FROM usuarios where id='$id_autor'";
	$rs = mysql_query($sql, $con);
	while($row = mysql_fetch_array($rs))
	{	
			$nick=$row['nick'];
			if ($row['rango']=="Administrador")
			$color="red";
			elseif ($row['rango']=="Moderador")
			$color="blue";
			elseif ($row['rango']=="Usuario Destacado")
			$color="green";
			else
			$color="black";
	?>
	<?php
	function rango($valor)
{
			
$valor = str_replace("Administrador", "<br clear=\"left\" />Administrador<br clear=\"left\" />
<span style=\"position:relative;\"></span><span style=\"position:relative;\"><img src=\"/imagenes/rangos/administrador.png\" alt=\"Administrador\" title=\"Administrador\" /></span>", $valor);

return $valor;
}
?>
	<body>
	<div class="box_title" style="height:21px; width:160px; background-color: #000000;">
	<div class="box_txt" style="width:160px; text-align:left;">
		<div class="esq1" style="float:left;"></div>
		<div style="float:left; padding-top: 4px; color: #ffffff;">Posteado por:</div>
		<div class="esq2" style="float:right;"></div>
	</div>
	</div>
	<div class="box_perfil">
	<img src="<?echo $row['avatar']?>" width="120" weight="120" style="display:block; margin: auto;" border="0" alt="" title="">
	<b class="txt"><?echo "<a href='../perfil.php?id=$nick'><font size='2' color='$color'><b>$nick</b></font></a>";?></b>
	<font size="1">
	<br clear="left"><?echo rango($row['rango']);?>
	<br clear="left">User Nro: <?echo $row['id'];?><br clear="left">
	</b>
	<hr>
	Posts: <?echo $row['posts']?><br clear="left">
	Comentarios: <?echo $row['comentarios']?><br clear="left">
	Puntos: <?echo $row['puntos']?><br clear="left">
	<hr>
	</font>
	</div>			
						
	<?
	}

mysql_close($con);
?>
		<br clear="left">
	</div>

	<div id="post-centro">
		<div class="fondo_cuadro">
			<div style="width:781px;float:left;text-align:center;font-size:13px;">
				<div class="esq1" style="float:left;"></div>
				<div  class="franja" style="float:left; width:765px; text-align:center;"><div style="padding-top:2px;">&nbsp;&nbsp;&nbsp;&nbsp;<?echo $titulo2; if ($tit==1) echo"...";?>&nbsp;&nbsp;&nbsp;&nbsp;</div></div>
				<div class="esq2" style="float:right;"></div>
			</div>
			<div style="width:781px;font-size:13px;text-align:left;">
				<div style="padding:5px;"><? echo BBparse($cuerpo) ?></div>
			</div>
		</div>
	</div>

<?
$cuerpo = str_replace('"','&#34;',$cuerpo);
$cuerpo = str_replace("'","&#39;",$cuerpo);
$titulo = str_replace('"','&#34;',$titulo);
$titulo = str_replace("'","&#39;",$titulo);
if ($tipo == 0 and $id="-1")
{
?>
<form name="reg" action="/agregar_post/agregar.php" method="post">
<input type="hidden" name="variable" value="<?=$id_autor?>">
<input type="hidden" name="titulo" value="<?=$titulo?>">
<input type="hidden" name="cuerpo" value="<?=$cuerpo?>">
<input type="hidden" name="categoria" value="<?=$categoria?>">
<input type="hidden" name="tags" value="<?=$tags?>">
<input type="hidden" name="privado" value="<?=$privado?>">
<input type="hidden" name="coments" value="<?=$coments?>">
<input type="button" onclick="kill_preview()" class="submit_button" name="Submit2" value="Cerrar">
<input type="button" onclick="submit();" class="submit_button" NAME='botoncrear' VALUE='Crear Post'>
</form>
<?
}
elseif ($tipo == 1 and $id !="-1")
{
?>
<form name="reg" action="/editar_post/editar.php" method="post">
<input type="hidden" name="variable" value="<?=$id_autor?>">
<input type="hidden" name="id" value="<?=$id?>">
<input type="hidden" name="titulo" value="<?=$titulo?>">
<input type="hidden" name="cuerpo" value="<?=$cuerpo?>">
<input type="hidden" name="categoria" value="<?=$categoria?>">
<input type="hidden" name="tags" value="<?=$tags?>">
<input type="hidden" name="privado" value="<?=$privado?>">
<input type="hidden" name="coments" value="<?=$coments?>">
<input type="button"  onclick="kill_preview()" class="submit_button" name="Submit2" value="Cerrar">
<input type="button"  onclick="if(confirm('Seguro queres editar el post?'))this.form.submit();" class="submit_button" NAME='botoneditar' VALUE='Editar Post'>
</form>
<?
}
else
{
?>
<SCRIPT LANGUAGE="javascript">
       location.href = "..";
       </SCRIPT>
<?
}
?>
</body>
</html>
</div>
</div>
