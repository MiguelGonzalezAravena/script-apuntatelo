<?
//FAVORITOS
include($_SERVER['DOCUMENT_ROOT']."/header.php");
$var2=0;
$action = $_GET['action'];
$categoria = $_GET['categoria'];
if($categoria=="") $categoria = "-1";
$cadena_categoria = "";
if ($categoria>=0 and $categoria<=6 and is_numeric($categoria))
{
	$cadena_categoria = " and p.categoria='".$categoria."'";
}


$orden = $_GET['orden'];
$cadena_orden = "order by f.fecha desc";

if($orden >=1 and $orden <= 3 and is_numeric($categoria))
{
	switch($orden)
	{
		case 1:
		$cadena_orden = " order by f.fecha desc";
		break;
		case 2:
		$cadena_orden = " order by p.fecha desc";
		break;
		case 3:
		$cadena_orden = " order by p.puntos desc";
		break;
	}
}
?>

<html>
<head>
<title>Apuntatelo - Tu link-sharing de apuntes</title>
</head>
<body>

<?
if($_SESSION['user']!=null)
{
	$_pagi_sql = "SELECT f.id, f.id_post, f.fecha as fecha_guardado, p.titulo, p.privado, p.fecha as fecha_creado, p.puntos, c.imagen, c.link_categoria, u.nick
			from favoritos as f
			inner join posts as p
			on p.id = f.id_post
			inner join categorias as c
			on p.categoria = c.id_categoria
			inner join usuarios as u
			on u.id = p.id_autor
			where p.elim = 0 and f.id_usuario=".$_SESSION['id'].$cadena_categoria." ".$cadena_orden;
	$_pagi_cuantos = 20;
	include('../includes/paginator.inc.php');
	?>
	<div class="bordes">
	<br>
	<div align="center"></div>
	<br>
	<div  style="min-height: 300px;">
		<table width="900" align="center" border="0" cellspacing="0" cellpadding="0" style="font-size:11px;">
			<tr>
				<td colspan="5">  
					<div class="esq1" style="float:left;"></div>
					<div class="franja" style="float:left; width: 884px;"><div style="padding-top:2px;">Filtro</div></div>
					<div class="esq2" style="float:left;"></div>
				</td>
			</tr>
			<tr class="fondo_cuadro" align="right">
				<form name="filtrar" method="GET" action="">
				<td  width="350" style="padding:3px; padding-left:5px;">
					Ordenar por:
					<select name="orden" style="font-size:12px;">
						<option value="1" <?if ($orden==1) echo "selected='true'"?>>Fecha guardado</option>
						<option value="2" <?if ($orden==2) echo "selected='true'"?>>Fecha creado</option>
						<option value="3" <?if ($orden==3) echo "selected='true'"?>>Puntos</option>
					</select>
				</td>
				<td width="220" align="left">
					&nbsp;&nbsp;&nbsp;Categor&iacute;a:
					<select id="categoria" name="categoria" style="font-size:12px;">
						<option value="-1"><div class="size11" style="font-weight:bold;">Todas...</div></option>
						<?
						$sql = "select id_categoria, nom_categoria from categorias order by nom_categoria asc";
						$rs = mysql_query($sql,$con);
						while ($row = mysql_fetch_array($rs))
						{
						?>
						<option value="<?=$row['id_categoria']?>" <?if ($categoria==$row['id_categoria']) echo "selected='true'"?>><?=$row['nom_categoria']?></option>
				 		<?
						}
						?>
					</select>
				</td>
				<td align="left">
					<input type="submit" class="submit_button" value="Filtrar">
				</td>
				</form>
			</tr>
		</table>
		<br>
		<form name="favoritos" method="POST" action="eliminar.php">
		<input type="hidden" name="pag" value="<?=$_SERVER['REQUEST_URI']?>">
		<table width="900" align="center" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td colspan="5">  
					<div class="esq1" style="float:left;"></div>
					<div class="franja" style="float:left; width: 884px;"><div style="padding-top:2px;">Mis favoritos</div></div>
					<div class="esq2" style="float:left;"></div>
				</td>
			</tr>
		<?
		$i = 0;
		if($_pagi_totalReg>0)
		{
			while($row = mysql_fetch_array($_pagi_result))
			{
				$id_favorito = $row['id'];
				$fecha_guardado = $row['fecha_guardado'];
				$fecha_creado = $row['fecha_creado'];
				$id_post = $row['id_post'];
				$titulo = $row['titulo'];
				$categoria = $row['categoria'];
				$imagen = $row['imagen'];
				$link_categoria = $row['link_categoria'];
				$nick = $row['nick'];
				$puntos = $row['puntos'];
				
				$cant = strlen($titulo);
				
				if($cant > 30)
		   		{
		   		$titulo2=substr(stripslashes($titulo, 0, 30));
			   	$tit=1;
			    }
		 		else
		   		{
		   		$titulo2=$titulo;
		   		$tit=0;
				}
				?>
				<tr class="fondo_cuadro" style="font-size: 11px;">
					<td width="300">
						&nbsp;<img src="../imagenes/iconos/<?echo $imagen;?>" border="0" width="15"><?if ($privado=="1"){?>&nbsp;<img src="../imagenes/iconos/candado.gif" border="0" width="15"><?}?>&nbsp;<a href="/posts/<?echo $id_post;?>/<?echo $link_categoria;?>/<?echo corregir($titulo).".html"?>" title="<?=$titulo?>"><font size="2" color="black"><?echo $titulo2; if ($tit==1) echo"...";?></font></a>
					</td>
					<td align="left" width="280">
						Posteado por <?echo $nick?> el <?echo date("d-m-Y",strtotime($fecha_creado))?>
					</td>
					<td align="left" width="60">
						<?echo $puntos?> pts
					</td>
					<td align="right" width="200">
						Guardado: <?echo date("d-m-Y H-m-s",strtotime($fecha_guardado))?>&nbsp;						
					</td>
					<td width="30" align="right">
						<input type="checkbox" name="i_<?=$i?>" value="<?=$id_favorito?>">
					</td>
				</tr>
				<?
				$i++;
			}
		}
		else
		{
		?>
			<tr class="fondo_cuadro" style="font-size: 11px;">
				<td width="300" align="center" style="height:20px;">
					No ten&eacute;s favoritos
				</td>
			</tr>
		<?
		}
		?> 
			<tr>
				<td align="right" colspan="5">
					<?echo"<p><font size='1'>".$_pagi_navegacion."</font></p>";?> 
				</td>
			</tr>
			<tr>
				<td align="right" colspan="5">
					<br>
					<input type="hidden" name="cant_check" value="<?=$i?>">
					<input type="submit" value="Eliminar Seleccionados" class="submit_button">
				</td>
			</tr>
		</table>
		</form>
	</div>
<?
}
else
	echo '<SCRIPT LANGUAGE="javascript">
			location.href = "/";
		</SCRIPT>';
include ('../footer.html');
?>
</div> 
</div>		
		
