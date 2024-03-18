		<table width="255" height="190"><font size="-2"> 
	    	<tr>
				<td valign="top">

				  	<?
				  	$sql = "SELECT c.id, id_post, autor, p.categoria, p.titulo, cat.imagen, cat.link_categoria
							FROM comentarios as c
							INNER JOIN posts as p
							ON p.id = c.id_post
							inner join categorias as cat
							on p.categoria=cat.id_categoria
							where c.elim='0' and p.elim=0
							ORDER BY c.id DESC limit 0,15 ";
					$rs = mysql_query($sql, $con);
				  	if(mysql_num_rows($rs)>0)
					{
						while($row = mysql_fetch_array($rs))
						{
							$id_post = $row['id_post'];
							$titu = $row['titulo'];
							?>
				  				  				<font size="1"><b>

							<?
							echo "&nbsp;";
							echo $row['autor'];
							?>
</b>

							<?
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
														<a href="/posts/<?echo $id_post;?>/<?echo$row['link_categoria']?>/<?echo corregir($titu).".html#comentario_".$row['id'];?>"><font color="black"><?echo $titulo2; if ($tit==1) echo"...";?></font></a>
							</font>
							<br>
							<?
						}
					}
				  	?>
									  		</td>
		  	</tr>
		</table> 
