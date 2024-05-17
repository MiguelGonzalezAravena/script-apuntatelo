<br>
<table width=420 border='0' align='center' cellpadding='0' cellspacing='0'>
	<tr>
		<td style="background-color: #D2D3D4; font-size: 10px;">
			<div class="box_txt" style="width: 420px; text-align: left;">
				<div class="esq1" style="float: left;"></div>
				<div style="float: left; padding-top: 4px;">Informaci&oacute;n del post</div>
				<div class="esq2" style="float: right;"></div>
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
			<table>
				<tr>
					<td style="width: 100px">
						<font size="1">
							<b>Puntos:</b>
						</font>
					</td>
					<td>
						<font size="1">
							<?php echo $row['puntos']; ?>
						</font>
					</td>
				</tr>
				<tr>
					<td>
						<font size="1">
							<b>Comentarios:</b>
						</font>
					</td>
					<td>
						<font size="1">
							<?php echo $row['comentarios']; ?>
						</font>
					</td>
				</tr>
				<tr>
					<td>
						<font size="1">
							<b>Visitas:</b>
						</font>
					</td>
					<td>
						<font size="1">
							<?php echo $row['visitas']; ?>
						</font>
					</td>
				</tr>
				<tr>
					<td>
						<font size="1">
							<b>Creado el d&iacute;a:</b>
						</font>
					</td>
					<td>
						<font size="1">
							<?php echo $row['fecha']; ?>
						</font>
					</td>
				</tr>
				<tr>
					<td>
						<font size="1">
							<b>Categor&iacute;a:</b>
						</font>
					</td>
					<td>
						<font size="1">
							<?php echo $row['nom_categoria']; ?>
						</font>
					</td>
				</tr>
				<tr>
					<td>
						<font size="1">
							<b>Tags:</b>
						</font>
					</td>
					<td>
						<font size="1">
							<?php echo $row['tags']; ?>
						</font>
					</td>
				</tr>
			</table>
		</td>	
	</tr>
</table>