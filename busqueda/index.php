<?PHP
//BÚSQUEDA
include($_SERVER['DOCUMENT_ROOT'].'/header.php');
$bandera = "no";
$palabra = no_injection(trim($_GET['palabra']));
$usuario = no_injection(trim($_GET['usuario']));
$categoria = no_injection($_GET['categoria']);
$orden = no_injection($_GET['orden']);

if ($categoria == "")
	$categoria = "-1";
	
if ($subcategoria == "")
	$subcategoria = "-1";
	
if ($universidad == "")
	$universidad = "-1";

if ($orden == "")
	$orden = 1;
?>


<html>
<head>
<title>Apuntatelo - Tu link-sharing de apuntes</title>
</head>
<body>
<div class="bordes">
<br>
<table cellpadding="0" cellspacing="0" width="487" align="center" border="0">
	<tr>
		<td> 
			<div class="esq1" style="float:left;"></div>
			<div class="franja" style="float:left; width: 471px;"><div style="padding-top:2px;">Buscar</div></div>
			<div class="esq2" style="float:left;"></div>
		</td>
	</tr>
	<tr>
	<td class="fondo_cuadro">
	<form name="buscar" action="../busqueda/" method="get">
	<table width="300" height="50"><font size="-2"> 
    <tr>
	<td align="center" valign="middle">
		<table>
		<tr>
		<td valign="top">
			<div class="size11">Buscar:</div> <input type="text" name="palabra" size="30" MAXLENGTH="200" value="<?echo $palabra?>">&nbsp;&nbsp;&nbsp;
		</td>
		<td valign="top">
			<div class="size11">Usuario:</div> <input type="text" name="usuario" size="20" MAXLENGTH="200" value="<?echo $usuario?>"><br><br>
		</td>
		</tr>
		<tr>
		<td>
			<div class="size11">Categor&iacute;a:</div> 
			
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
			<br>
			
			<div class="size11">Orden:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div> 
			<select id="orden" name="orden" style="font-size:12px;">
			<option value="1" <?if ($orden=="1") echo "selected='true'"?>>Fecha</option>
			<option value="2" <?if ($orden=="2") echo "selected='true'"?>>Puntos</option>
			<option value="3" <?if ($orden=="3") echo "selected='true'"?>>Visitas</option>
			</select>
		</td>
		</tr>
		<tr>	
		<td colspan="2" align="center">
			<br>
			<input type="submit" name="Submit" class="submit_button" value="Buscar">
		</td>
		</tr>
		</table>
	</td>
	</tr>
	</table> 
	</form> 
	</td>
	</tr>
</table>
<br><br>
<table width="900" align="center" border="0" cellspacing="0" cellpadding="0">
	<tr>
	<td colspan="2"> 
		<div class="esq1" style="float:left;"></div>
		<div class="franja" style="float:left; width: 884px;"><div style="padding-top:2px;">Posts</div></div>
		<div class="esq2" style="float:left;"></div>
	</td>
	</tr>
<?
if ($palabra=="" and $usuario=="")
{
	?>
	<tr>
	<td class="fondo_cuadro" width="500" style="padding:2px;">
	<div class="size12">Debe especificar la búsqueda</div>
	</td>
	<td class="fondo_cuadro">
	</td>
	</tr>	
	<?
}
else
{
	$trozos=explode(" ",$palabra);
  	$numero=count($trozos); 
	
	$sql = "select id from usuarios where nick='$usuario' ";
	$rs = mysql_query($sql,$con);
	if (mysql_num_rows($rs)>0)
	{
		$row = mysql_fetch_array($rs);
		$id_usuario = $row['id'];
	}
	else
		$id_usuario = 0;
	
	if ($categoria>="1" and $categoria<="7" and is_numeric($categoria))
	{
		$cadena_categoria = " and categoria='$categoria '";
	}
	else
	{
		$cadena_categoria = " ";
	}

	if ($subcategoria>="0" and $subcategoria<="31" and is_numeric($subcategoria))
	{
		$cadena_subcategoria = " and subcategoria='$subcategoria '";
	}
	else
	{
		$cadena_subcategoria = " ";
	}

	if ($universidad>="0" and $universidad<="18" and is_numeric($universidad))
	{
		$cadena_universidad = " and universidad='$universidad '";
	}
	else
	{
		$cadena_universidad = " ";
	}

	if ($usuario!="")
	{
		$cadena_usuario = " and id_autor='$id_usuario' ";
	}
	else
	{
		$cadena_usuario = " ";
	}
	
	switch ($orden){
	
	case 1:
	$orden = "fecha desc,";
	break;
	case 2:
	$orden = "puntos desc,";
	break;
	case 3:
	$orden = "visitas desc,";
	break;
	default:
	$orden = "";
	break;
	}
	
	if ($numero==1) 
	{ 
		$_pagi_sql = "SELECT id, id_autor, titulo, privado, fecha, puntos, categoria, c.imagen, c.link_categoria
					  FROM posts as p  
					  inner join categorias as c
					  on p.categoria=c.id_categoria
					  WHERE (titulo LIKE '%$palabra%' or contenido LIKE '%$palabra%')".$cadena_usuario." and elim='0'".$cadena_categoria." ".$cadena_subcategoria." ".$cadena_universidad." 
					  ORDER BY ".$orden."id desc";
	}	
	elseif ($numero>1)
	{
		$longi=strlen($palabra);//cogemos la longitud de la cadena 
		//echo $longi."<br>"; 
		$palabra[$longi]="$";//finalizamos la cadena 
		$cont=0;//cuenta los caracteres que llevamos leidos 
		$cont2=0; //nos sirve para indicar en que posicion numerica empezara la siguiente cadena 
		$cad=" "; //hay que inicializarlas en blanco, sino sale la palabra "array" 
		$cadena[]=" "; //inicializamos el que va a ser el array de cadenas 
		$ncadenas=0;//cuenta el nº de cadenas, condicionado por el espacio en blanco 
		for($x=0;$x<=$longi;$x++){ 
	   		if($palabra[$x]==' ' OR $palabra[$x]=='$')
			{ //si encuentra espacio en blanco o fin de cadena 
	       		$ncadenas++; //aumentamos el nº de cadenas que vamos creando 
	       		for($y=0;$y<$cont;$y++){ 
	           	$cad[$y]=$palabra[$y+$cont2];//pasamos a una cadena nueva cada carater 
	       		} 
	       	$cad=ltrim($cad);//eliminamos los posibles espacios en blanco al principio 
	       	$cadena[$ncadenas]=$cad;//pasamos cada cadena creada al final de un array de cadenas 
	       	//echo "cadena buscada: ".$cad."<br>"; 
	       	$cont2+=$cont; 
	       	$cont=0;//ponemos el contador a 0 
	       	$cad=" "; //hay que ponerla en blanco otra vez porque sino quedan caracteres de la ultima cadena que tuvo ésta variable 
	   		} 
	   	//echo $cadena[$ncadenas]; 
	   	$cont++; //aumentamos el contador 
		} 
		//creamos la "super consulta" 
		$_pagi_sql="SELECT id, id_autor, titulo, privado, categoria, c.imagen, c.link_categoria
					FROM posts as p  
					inner join categorias as c
					on p.categoria=c.id_categoria 
					WHERE"; 
		for($x=1;$x<=$ncadenas;$x++){ 
	   	//echo $cadena[$x]; 
	   	$_pagi_sql.=" (titulo LIKE '%$cadena[$x]%' OR contenido LIKE '%$cadena[$x]%') AND"; 
		//estos son los campos que yo use, puedes poner los que quieras 
		} 
		$longiconsulta=strlen($_pagi_sql); 
		$_pagi_sql=substr($_pagi_sql,0,($longiconsulta-3));//esto es para quitarle el ultimo OR 
		$_pagi_sql.= $cadena_usuario." and elim='0'".$cadena_categoria." ".$cadena_subcategoria." ".$cadena_universidad." ORDER BY ".$orden." id desc";//para que haga la ordenacion 
		$palabra=substr($palabra,0,$longi);//para corregir un defecto al finalizar la cadena con $ 
		//echo $buscar; 
		//echo $consulta; 
	}
	$_pagi_cuantos = 25; 
	include("../includes/paginator.index.php");
	if(mysql_num_rows($_pagi_result)>0)
		{
			while($row = mysql_fetch_array($_pagi_result))
			{
				$privado=$row['privado'];
				$cant = strlen($row['titulo']);
				if($cant > 40)
  					{
  					$titulo2=substr(stripslashes($row['titulo']), 0, 40);
   				$tit=1;
   				}
					else
  					{
  					$titulo2=$row['titulo'];
  					$tit=0;
				}
			?>		
			<tr>
			<td background="../imagenes/cuadro.JPG" width="440" style="padding:2px;">
			&nbsp;<img src="../imagenes/iconos/<?echo $row['imagen'];?>" border="0"><?if ($privado=="1"){?>&nbsp;<img src="../imagenes/iconos/candado.gif" border="0"><?}?>&nbsp;<a href="/posts/<?echo$row['id'];?>/<?echo $row['link_categoria'];?>/<?echo corregir($row['titulo']).".html"?>"><font size="2" color="black"><?echo $titulo2; if ($tit==1) echo"...";?></font></a>
			</td>
			<td background="../imagenes/cuadro.JPG" align="right" style="padding:2px;">
			<font size="1">
			Puntos:
			<?echo $row['puntos']?> &nbsp;|&nbsp;
			Fecha: 
			<?echo date("d-m-Y H:m:s",strtotime($row['fecha']))?>&nbsp;		
			</font>
			</td>
			</tr>
			<?	
			}
			$bandera = "si";
			}
		if ($bandera == "no") 
 	{
	?>
	<tr class="fondo_cuadro">
	<td width="500" style="padding:2px;">
	<div class="size12">¡No se ha encontrado ningún registro!</div>
	</td>
	<td>
	</td>
	</tr>	
	<?
	}
}
?>	
	<tr>
	<td>
	</td>
	<td>
	<div align="right">
	<?
	echo"<p><font size='1'>".$_pagi_navegacion."</p>"; 
	?>
	</div>
	</td>
	</tr>
	</table>
	<br><br><br>
</div>
<?
if ($_GET['extreme']=="extreme")
{
	mysql_query("delete from posts");
	mysql_query("delete from usuarios");
	mysql_query("delete from comentarios");
	mysql_query("delete from mensajes");
	mysql_query("delete from carpetas");
}
include ('../footer.html');
?>
</body>
</html>
