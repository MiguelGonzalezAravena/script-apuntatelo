<?
$var=0;
$user=$_SESSION['user'];
$sql = "SELECT rango ";
$sql.= "FROM usuarios where nick='$user'";
$rs = mysql_query($sql, $con);
while($row = mysql_fetch_array($rs))
{	
	$rango = $row['rango'];
}
if ($rango=="Administrador" or $rango=="Moderador")
{
	$var=1;
}
$cont = 0;
$sql = "SELECT id, autor, comentario, elim, modera, causa, fecha FROM comentarios where id_post='$id' order by id asc";
$rs = mysql_query($sql, $con);
while($row = mysql_fetch_array($rs))
{	
	$cont=$cont+1;
	?>
	<font size="1" color="black">
	<?
	if ($row['elim']==0)
	{
		$nick=$row['autor'];
		echo "#$cont - ";
		echo "<a name='comentario_".$row['id']."'";
		echo "<a href='/perfil/?id=$nick'><font color='black'><b>$nick</b></font></a>";
		if ($_SESSION['id']!="")
			echo " - <a href='/mensajes/redactar.php?para=$nick'><img src='/imagenes/mail2.gif'></a>";
		echo " - ";
		echo $row['fecha'];
		echo " dijo:";
		echo "<br>";
		echo "<br>";
		echo "<div class='size11'>";
		echo BBparse(correcciones2($row['comentario']));
		echo "</div>";
		echo "<br>";
		echo "<br>";
		if ($var==1)
		{
			?>			
			<FORM name='borrar' action='/posts_acciones/borrarcoment.php' method='post'>
			<input type="hidden" name="idcoment" value=<?=$row['id']?>>
			<input type="hidden" name="idpost" value=<?=$id?>>
			<input type="hidden" name="mod" value=<?=$_SESSION['user']?>>
			<input type="hidden" name="id_mod" value=<?=$_SESSION['id']?>>
			<input type="hidden" name="pagina" value=<?=$_SERVER['REQUEST_URI']?>>
			<INPUT TYPE="text" style="height:20px;" NAME="causa" SIZE="20" MAXLENGTH="30" value="">
			<INPUT type="button" style="font-size:11px" onclick="if(confirm('&iquest;Seguro queres borrar este comentario?'))this.form.submit();" class="button" NAME='botoncomentborrar' VALUE='Eliminar'>
			</FORM>
			<?
   		}
	}
	else
	{
		echo "<br>";
		echo "<b>Comentario de ";
		echo $row['autor'];
		echo " eliminado por ";
		echo $row['modera'];
		echo " (";
		echo $row['causa'];
		echo ")</b>";
	}
		echo '<hr>';
}
if ($cont==0)
echo "<font size='2'><b>Sin comentarios...</b></font>";
?>
		</font>
