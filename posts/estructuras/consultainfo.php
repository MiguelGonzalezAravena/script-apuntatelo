<br>
<table width=420 border='0' align='center' cellpadding='0' cellspacing='0'>
	<tr>
		<td style="background-color:#d2d3d4; font-size: 10px;">
			<div class="box_txt" style="width:420px; text-align:left;">
				<div class="esq1" style="float:left;"></div>
				<div style="float:left; padding-top: 4px;">Informaci&oacute;n del Post</div>
				<div class="esq2" style="float:right;"></div>
			</div>
		</td>
	</tr>
	<tr> 
    	<td class="fondo_cuadro">
			<?php
			$sql = "
					SELECT p.fecha, p.puntos, p.comentarios, p.visitas, p.tags, c.nom_categoria FROM posts as p
					inner join categorias as c
					on c.id_categoria = p.categoria
			 		where id='$id'";
			$rs = mysqli_query($con, $sql);
			$row = mysqli_fetch_array($rs);
			
			$tags = $row['tags'];
			
			$tags2 = explode(',', $tags);
			$cant_tags = count($tags2);
			
			?>
			<font size="1">
			&nbsp;<b>Puntos:</b>
			<?php echo $row['puntos']; ?>
			<br>
			&nbsp;<b>Comentarios:</b>
			<?php echo $row['comentarios']; ?>
			<br>
			&nbsp;<b>Visitas:</b>
			<?php echo $row['visitas']; ?>
			<br>
			&nbsp;<b>Creado el d&iacute;a:</b>
			<?php echo $row['fecha']; ?>
			<br><br>
			&nbsp;<b>Categor&iacute;a:</b>
			<?php  echo $row['nom_categoria']; ?>
			<br>
			&nbsp;<b>Tags:</b>
			<?php  echo $row['tags']; ?>
			<br><br>
			</font>
		</td>	
	</tr>
</table>