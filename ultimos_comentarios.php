<table width="255" height="190">
	<font size="-2"> 
		<tr>
			<td valign="top">
<?php
	$sql = "
		SELECT c.id, id_post, autor, p.categoria, p.titulo, cat.imagen, cat.link_categoria
		FROM comentarios AS c
		INNER JOIN posts AS p ON p.id = c.id_post
		INNER JOIN categorias AS cat ON p.categoria = cat.id_categoria
		WHERE c.elim = '0'
		AND p.elim = 0
		ORDER BY c.id DESC
		LIMIT 0, 15";

	$rs = mysqli_query($con, $sql);

	if (mysqli_num_rows($rs) > 0) {
		while ($row = mysqli_fetch_array($rs)) {
			$id_post = $row['id_post'];
			$titu = $row['titulo'];
?>
					<font size="1">
						<b><?php echo "&nbsp;" . $row['autor']; ?></b>
<?php
			$cant = strlen($titu);

			if ($cant > 24) {
				$titulo2 = substr(stripslashes($titu), 0, 24);
				$tit = 1;
			} else {
				$titulo2 = $titu;
				$tit = 0;
			}
?>
							<a href="<?php echo $url; ?>/posts/<?php echo $id_post; ?>/<?php echo $row['link_categoria']; ?>/<?php echo corregir($titu) . ".html#comentario_" . $row['id']; ?>">
								<font color="black"><?php echo $titulo2 . ($tit == 1 ? '...' : ''); ?></font>
							</a>
						</font>
						<br />
<?php
		}
	}
?>
			</td>
		</tr>
	</font>
</table>