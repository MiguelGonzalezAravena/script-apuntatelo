<?php
// AGREGAR POST
require_once(dirname(dirname(__FILE__)) . '/header.php');

$iexp = $_SERVER['HTTP_USER_AGENT'];
$msie = strstr($iexp, 'MSIE 6');
$margin_left = strstr($iexp, 'MSIE 6') ? '70px;' : '130px;';
$width = strstr($iexp, 'MSIE') ? '716px;' : '700px;';
$titulo = isset($_POST['titulo']) ? no_injection($_POST['titulo']) : '';
$tags = isset($_POST['tags']) ? no_injection($_POST['tags']) : '';
?>
<html>
<head>
	<title>eXtreme Zone - La comunidad de linksharing qye estabas esperando</title>
	<link rel="stylesheet" type="text/css" href="<?php echo $url; ?>/estilos/posts.css" />
	<script src="<?php echo $url; ?>/includes/funciones.js" type="text/javascript"></script>
</head>
<body>
<?php
if (isset($_SESSION['user'])) {
?>
	<div class="bordes">
		<br />
<?php
if (!strstr($_SERVER['HTTP_USER_AGENT'], 'MSIE')) {
	echo '
		<table width="980">
			<tr>
				<td>';
}
?>
		<div id="preview" style="display: none"></div>
		<div class="box_title" style="width: 716px; float: left; margin-left: <?php echo $margin_left; ?>;">
			<div class="box_txt">
				<div class="esq1" style="float: left;"></div>
				<div class="franja" style="float: left; width: 700px;">
					<div style="padding-top: 2px; text-align: center;">Agregar nuevo post</div>
				</div>
				<div class="esq2" style="float: left;"></div>
			</div>		
		</div>			
		<div class="box_cuerpo" style='width: <?php echo $width; ?>; float: left; margin-left: <?php echo $margin_left; ?>;'>
			<table width="90%" border="0" cellspacing="2" cellpadding="2">
				<form name="reg" action="" method="post">
					<input type="hidden" name="variable" value="<?php echo $_SESSION['id']; ?>" />
					<tr> 
						<br />
					</tr>
					<tr> 
						<td width="30%" align="right">
							<div class="size11" style="font-weight:bold;">T&iacute;tulo</div>
						</td>
						<td>
							<input type="text" name="titulo" size="50" MAXLENGTH="150" value="<?php echo $titulo; ?>" />
						</td>
					</tr>
					<tr> 
						<td width="30%" align="right"><?php /*echo "$nom";*/ ?></td>
						<td>
							<a href="javascript:void(0)" onclick="texto('align=left', 'align')">
								<img src="<?php echo $images; ?>/iconos/izquierda.PNG" hspace="2" vspace="4" align="absmiddle" width="15" height="16" border="0" />
							</a>
							<a href="javascript:void(0)" onclick="texto('align=center','align')">
								<img src="<?php echo $images; ?>/iconos/centro.PNG" hspace="2" vspace="4" align="absmiddle" width="15" height="16" border="0" />
							</a>
							<a href="javascript:void(0)" onClick="texto('align=right','align')">
								<img src="<?php echo $images; ?>/iconos/derecha.PNG" hspace="2" vspace="4" align="absmiddle" width="15" height="16" border="0" />
							</a>
							<a href="javascript:void(0)" onClick="instag('b')">
								<img src="<?php echo $images; ?>/iconos/negrita.PNG" hspace="2" vspace="4" align="absmiddle" border="0" />
							</a>
							<a href="javascript:void(0)" onclick="instag('i')">
								<img src="<?php echo $images; ?>/iconos/cursiva.PNG" hspace="2" vspace="4" align="absmiddle" border="0" />
							</a>
							<a href="javascript:void(0)" onclick="instag('u')">
								<img src="<?php echo $images; ?>/iconos/subrayado.PNG" hspace="2" vspace="4" align="absmiddle" border="0" />
							</a>
							<select name="colordefont" style="color: black; background-color: #FAFAFA; font-size: 10px" onChange="texto('color=' + this.form.colordefont.options[this.form.colordefont.selectedIndex].value, 'color'); this.selectedIndex=0;">
								<option style="color:black; background-color: #FAFAFA" value="#black" >Predeterminado</option>
								<option style="color:darkred; background-color: #FAFAFA" value="darkred" >Rojo oscuro</option>
								<option style="color:red; background-color: #FAFAFA" value="red" >Rojo</option>
								<option style="color:orange; background-color: #FAFAFA" value="orange" >Naranja</option>
								<option style="color:brown; background-color: #FAFAFA" value="brown" >Marr&oacute;n</option>
								<option style="color:yellow; background-color: #FAFAFA" value="yellow" >Amarillo</option>
								<option style="color:green; background-color: #FAFAFA" value="green" >Verde</option>
								<option style="color:olive; background-color: #FAFAFA" value="olive" >Oliva</option>
								<option style="color:cyan; background-color: #FAFAFA" value="cyan" >Cyan</option>
								<option style="color:blue; background-color: #FAFAFA" value="blue" >Azul</option>
								<option style="color:darkblue; background-color: #FAFAFA" value="darkblue" >Azul Oscuro</option>
								<option style="color:indigo; background-color: #FAFAFA" value="indigo" >Indigo</option>
								<option style="color:violet; background-color: #FAFAFA" value="violet" >Violeta</option>
								<option style="color:black; background-color: #FAFAFA" value="black" >Negro</option>
							</select>
							<select name="sizedefont" style="color:black; background-color: #FAFAFA; font-size:10px" onChange="texto('size=' + this.form.sizedefont.options[this.form.sizedefont.selectedIndex].value, 'size'); this.selectedIndex=0;">
								<option value="7" >Miniatura</option>
								<option value="9" >Peque&ntilde;a</option>
								<option value="12" selected >Normal</option>
								<option value="18" >Grande</option>
								<option value="24" >Enorme</option>
							</select>
							<a href="javascript:void(0)" onclick="youtube()">
								<img src="<?php echo $images; ?>/iconos/youtube.PNG" hspace="2" vspace="4" align="absmiddle"  alt="Youtube" title="Youtube" border="0" />
							</a>	
							<!--<a href="javascript:void(0)" onclick="insimg()"><img src="<?php echo $images; ?>/iconos/gvideo.PNG" hspace="2" vspace="4" align="absmiddle"  alt="Google" title="Google" border="0"></a>-->	
							<a href="javascript:void(0)" onclick="insimg()">
								<img src="<?php echo $images; ?>/iconos/imagen.PNG" hspace="2" vspace="4" align="absmiddle"  alt="Insertar Imagen" title="Insertar Imagen" border="0" />
							</a>	
							<a href="javascript:void(0)" onclick="inslink()">
								<img src="<?php echo $images; ?>/iconos/url.PNG" hspace="2" vspace="4" align="absmiddle"  alt="Insertar link" title="Insertar link" border="0" />
							</a>
							<br />
							<textarea name="cuerpo" id="cuerpo" cols="70" rows="20"></textarea>
							<a href="javascript:void(0)" onclick="smile(':))')">
								<img src="<?php echo $images; ?>/smileys/icon_cheesygrin.gif" hspace="2" vspace="4" align="absmiddle" border="0" />
							</a>
							<a href="javascript:void(0)" onclick="smile('8|')">
								<img src="<?php echo $images; ?>/smileys/icon_eek.gif" hspace="2" vspace="4" align="absmiddle" border="0" />
							</a>
							<a href="javascript:void(0)" onclick="smile(':ok:')">
								<img src="<?php echo $images; ?>/smileys/thumbup.gif" hspace="2" vspace="4" align="absmiddle" border="0" />
							</a>
							<a href="javascript:void(0)" onclick="smile(':twisted:')">
								<img src="<?php echo $images; ?>/smileys/twisted.gif" hspace="2" vspace="4" align="absmiddle" border="0" />
							</a>
							<a href="javascript:void(0)" onclick="smile(':aplauso:')">
								<img src="<?php echo $images; ?>/smileys/clapping.gif" hspace="2" vspace="4" align="absmiddle" border="0" />
							</a>
							<a href="javascript:void(0)" onclick="smile(':angel:')">
								<img src="<?php echo $images; ?>/smileys/icon_angel_not.gif" hspace="2" vspace="4" align="absmiddle" border="0" />
							</a>
							<a href="javascript:void(0)" onclick="smile(':angry:')">
								<img src="<?php echo $images; ?>/smileys/angry.gif" hspace="2" vspace="4" align="absmiddle" border="0" />
							</a>
							<a href="javascript:void(0)" onclick="smile(':idiot:')">
								<img src="<?php echo $images; ?>/smileys/muro.gif" hspace="2" vspace="4" align="absmiddle" border="0" />
							</a>
							<a href="javascript:void(0)" onclick="smile(':ziped:')">
								<img src="<?php echo $images; ?>/smileys/ziped.gif" hspace="2" vspace="4" align="absmiddle" border="0" />
							</a>
							<a href="javascript:void(0)" onclick="smile(':blink:')">
								<img src="<?php echo $images; ?>/smileys/blink.gif" hspace="2" vspace="4" align="absmiddle" border="0" />
							</a>
							<a href="javascript:void(0)" onclick="smile(':win:')">
								<img src="<?php echo $images; ?>/smileys/coppa.gif" hspace="2" vspace="4" align="absmiddle" border="0" />
							</a>
							<a href="javascript:void(0)" onclick="smile(':download:')">
								<img src="<?php echo $images; ?>/smileys/dload.gif" hspace="2" vspace="4" align="absmiddle" border="0" />
							</a>
							<a href="javascript:void(0)" onclick="smile(':embarrass:')">
								<img src="<?php echo $images; ?>/smileys/icon_redface.gif" hspace="2" vspace="4" align="absmiddle" border="0" />
							</a>
							<a href="javascript:void(0)" onclick="smile(':book:')">
								<img src="<?php echo $images; ?>/smileys/book.gif" hspace="2" vspace="4" align="absmiddle" border="0" />
							</a>
							<a href="javascript:void(0)" onclick="smile(':sorry:')">
								<img src="<?php echo $images; ?>/smileys/icon_sorry.gif" hspace="2" vspace="4" align="absmiddle" border="0" />
							</a>
							<a href="javascript:void(0)" onclick="smile(':bye:')">
								<img src="<?php echo $images; ?>/smileys/bye.gif" hspace="2" vspace="4" align="absmiddle" border="0" />
							</a>
							<a href="" onclick="window.open('<?php echo $url; ?>/smileys.php','window','width=200,height=600,scrollbars=yes'); return false;">
								<font color="gray">M&aacute;s</font>
							</a>
							<br /><br />
						</td>
					</tr>
					<input type="hidden" name="tipo" value="0" />
					<input type="hidden" name="id" value="-1" />
					<tr> 
      		<td width="30%" align="right"><div class="size11" style="font-weight: bold;">Categor&iacute;a</div></td>
	  			<td>
						<select id="categoria" name="categoria" style="font-size: 12px;">
							<option value="-1">
								<div class="size11" style="font-weight: bold;">Elige una categor&iacute;a...</div>
							</option>
<?php
	$rs = mysqli_query($con, "SELECT id_categoria, nom_categoria FROM categorias ORDER BY nom_categoria ASC");
	while ($row = mysqli_fetch_array($rs)) {
?>
			<option value="<?php echo $row['id_categoria']; ?>"><?php echo $row['nom_categoria']; ?></option>
<?php
}
?>
							</select>
						</td>
					</tr>
					<tr>
						<td width="30%" align="right"><div class="size11" style="font-weight: bold;">Tags</div></td>
						<td>
							<input type="text" name="tags" size="50" MAXLENGTH="150" value="<?php echo $tags; ?>" />
						</td>
					</tr>
					<tr>
						<td width="30%" align="right"></td>
						<td>
							<div class="size11" style="font-weight: bold;">
								<input type="checkbox" name="privado" />
								Privado
							</div>
						</td>
					</tr>
					<tr>
						<td width="30%" align="right"></td>
						<td>
							<div class="size11" style="font-weight: bold;">
								<input type="checkbox" name="coments" value="coments" />
								Cerrar los comentarios
							</div>
						</td>
					</tr>
					<tr> 
						<td colspan="2" align="center">
							<input type="button" onclick="show_preview(this.form.titulo.value, this.form.cuerpo.value, this.form.tipo.value, this.form.id.value, this.form.variable.value, this.form.categoria.value, this.form.tags.value, this.form.privado.value, this.form.coments.value, this.form)" class="submit_button" value="   Vista previa   " title="Preview" tabindex="8" />
						</td>
					</tr>
				</form> 
			</table>
<?php
} else {
?>
			 <script type="text/javascript">
				location.href = '..';
			</script>
<?php
}
?>
			<br />
		</div>
<?php
if (!strstr($_SERVER['HTTP_USER_AGENT'], 'MSIE')) {
	echo "
				</td>
			</tr>
		</table>";
}
?>
	</div>
	<div class="bordes" style="height: 30px">
<?php
require_once(dirname(dirname(__FILE__)) . '/footer.php');
?>
	</div>
</div>
</body>
</html>