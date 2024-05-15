<table width="255" height="190"><font size="-2"> 
	    	<tr>
				<td valign="top">

				  	<?php
				  	$sql = "SELECT c.id, id_post, autor, p.categoria, p.titulo, cat.imagen, cat.link_categoria
							FROM comentarios as c
							INNER JOIN posts as p
							ON p.id = c.id_post
							inner join categorias as cat
							on p.categoria=cat.id_categoria
							where c.elim='0' and p.elim=0
							ORDER BY c.id DESC limit 0,15 ";
					$rs = mysqli_query($con, $sql);
				  	if(mysqli_num_rows($rs)>0)
					{
						while($row = mysqli_fetch_array($rs))
						{
							$id_post = $row['id_post'];
							$titu = $row['titulo'];
							?>
				  				  				<font size="1"><b>

							<?php
							echo "&nbsp;";
							echo $row['autor'];
							?>
</b>

							<?php
							$cant = strlen($titu);
							if($cant > 24)
			  					{
			  					$titulo2=substr(stripslashes($titu), 0, 24);
			   				$tit=1;
			   				}
								else
			  					{
			  					$titulo2=$titu;
			  					$tit=0;
							}
							?>
														<a href="<?php echo $url; ?>/posts/<?php echo $id_post; ?>/<?php echo $row['link_categoria']; ?>/<?php echo corregir($titu) . ".html#comentario_" . $row['id']; ?>"><font color="black"><?php echo $titulo2; if ($tit==1)  { echo "..."; } ?></font></a>
							</font>
							<br>
							<?php
						}
					}
				  	?>
									  		</td>
		  	</tr>
		</table> 
