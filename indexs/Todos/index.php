<title>Paginar Resultados</title>
<style>
a{
 cursor:pointer;
}
</style>

 <div id="contenido">
  <div class="Post">
<table align="right" border="0" cellpadding="2" cellspacing="0" width="360">
	<tbody>
			<?php
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
        
<?php
}
?>