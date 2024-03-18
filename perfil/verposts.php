<?php
include('../header.php');
$id = no_injection($_GET["id"]); 
?>
	<html>
	<head>
	<title>Apuntatelo - Tu link-sharing de apuntes</title>
	</head>
	<body>
	
	<div class="bordes">
	<br>
	<table width="900" align="center" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td colspan="2">  
				<div class="esq1" style="float:left;"></div>
				<div class="franja" style="float:left; width: 884px;"><div style="padding-top:2px;">Posts de <?echo $id?>:</div></div>
				<div class="esq2" style="float:left;"></div>
				
			</td>
		</tr>

	<?
	$sql = "select id from usuarios where nick='$id'";
	$rs = mysql_query($sql,$con);
	$row = mysql_fetch_array($rs);
	$id_autor = $row['id']; 
	$_pagi_sql = "SELECT id, id_autor, titulo, fecha, privado, categoria, puntos, c.imagen, c.link_categoria
		  		  FROM posts as p  
		  		  inner join categorias as c
		  		  on p.categoria=c.id_categoria
		  		  where id_autor='$id_autor' and elim='0'
		  		  ORDER BY id desc";
	$_pagi_cuantos = 20; 
	$sql = "SELECT id ";
	$sql.= "FROM posts where id_autor='$id_autor' and elim='0' ORDER BY id DESC ";
	$rs = mysql_query($sql, $con);
	include("../includes/paginator.inc.php"); 
	if (mysql_num_rows($rs) >0)
	{
	while($row = mysql_fetch_array($_pagi_result))
	{
	   $privado=$row['privado'];
	   $cant = strlen($row['titulo']);
		
		if($cant > 30)
   		{
   		$titulo2=substr(stripslashes($row['titulo']), 0, 30);
	   	$tit=1;
	    }
 		else
   		{
   		$titulo2=$row['titulo'];
   		$tit=0;
		}
?>	 
				<tr >
				<td width="440" class="fondo_cuadro" style="padding: 2px;">
				&nbsp;<img src="../imagenes/iconos/<?echo $row['imagen'];?>" border="0"><?if ($privado=="1"){?>&nbsp;<img src="../imagenes/iconos/candado.gif" border="0"><?}?>&nbsp;<a href="/posts/<?echo$row['id'];?>/<?echo $row['link_categoria'];?>/<?echo corregir($row['titulo']).".html"?>" title="<?=$row['titulo']?>"><font size="2" color="black"><?echo $titulo2; if ($tit==1) echo"...";?></font></a>
				</td>
				<td class="fondo_cuadro" align="right" style="padding: 2px;">
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
mysql_close($con);
?>	
	<tr>
	<td>
	</td>
	<td align="right">
	<?echo"<p><font size='1'>".$_pagi_navegacion."</font></p>";?> 
	</td>
	</tr>
	</table>
<br>
<?
include ('../footer.html');
}
else
{
?>
Password incorrecto
			<SCRIPT LANGUAGE="javascript">
       		location.href = "..";
       		</SCRIPT> 
<?
}
?>
</body>
</html>