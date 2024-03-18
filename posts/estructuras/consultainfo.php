<br>
<table width=420 border='0' align='center' cellpadding='0' cellspacing='0'>
	<tr>
		<td style="background-color:#d2d3d4; font-size: 10px;">
			<div class="box_txt" style="width:420px; text-align:left;">
				<div class="esq1" style="float:left;"></div>
				<div style="float:left; padding-top: 4px;">Información del Post</div>
				<div class="esq2" style="float:right;"></div>
			</div>
		</td>
	</tr>
	<tr> 
    	<td class="fondo_cuadro">
			<?
			$sql = "SELECT p.fecha, p.puntos, p.comentarios, p.visitas, p.tags, c.nom_categoria FROM posts as p
					inner join categorias as c
					on c.id_categoria = p.categoria
			 		where id='$id'";
			$rs = mysql_query($sql, $con);
			$row = mysql_fetch_array($rs);
			
			$tags = $row['tags'];
			
			$tags2 = explode(',', $tags);
			$cant_tags = count($tags2);
			
			?>
			<font size="1">
			&nbsp;<b>Puntos:</b>
			<?
			echo $row['puntos'];
			?>
			<br>
			&nbsp;<b>Comentarios:</b>
			<?
			echo $row['comentarios'];
			?>
			<br>
			&nbsp;<b>Visitas:</b>
			<?
			echo $row['visitas'];
			?>
			<br>
			&nbsp;<b>Creado el día:</b>
			<?
			echo $row['fecha'];
			?>
			<br><br>
			&nbsp;<b>Categor&iacute;a:</b>
			<?
			echo $row['nom_categoria'];
			?>
			<br>
			&nbsp;<b>Tags:</b>
			<?
			echo $row['tags'];
			?>
			<br><br>
			</font>
		</td>	
	</tr>
</table>