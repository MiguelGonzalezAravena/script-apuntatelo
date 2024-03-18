<br>
<table width=300 border='0' align='center' cellpadding='0' cellspacing='0'>
	<tr>
		<td style="background-color:#d2d3d4; font-size: 10px;">
			<div class="box_txt" style="width:300px; text-align:left;">
				<div class="esq1" style="float:left;"></div>
				<div style="float:left; padding-top: 4px;">Puntos</div>
				<div class="esq2" style="float:right;"></div>
			</div>
		</td>
	</tr>
	<tr> 
    	<td class="fondo_cuadro" style="padding-left: 20px;">
			<br>
			<?
			$user=$_SESSION['user'];
			$id_user=$_SESSION['id'];
			if ($id_user!="" and $id_user!=$id_autor)
			{
				$sql = "SELECT puntosdar ";
				$sql.= "FROM usuarios where id='$id_user'";
				$rs = mysql_query($sql, $con);
				$row = mysql_fetch_array($rs);
				?>
				<font size="1">
				Puntos:			
				<FORM name="puntos" action="/posts_acciones/darpuntos.php" method="post">
				<input type="hidden" name="dador" value=<?=$id_user?>>
				<input type="hidden" name="id_post" value=<?=$id?>>
				<input type="hidden" name="titu" value=<?=$titulo?>>
				<input type="hidden" name="pagina" value=<?=$_SERVER['REQUEST_URI']?>>
				<select id="cantpuntos" name="cantpuntos">
				<?
				$cont=1;
				while ($cont<=$row['puntosdar'] and $cont<=10)
				{
					?>
					<option value="<?echo $cont?>"><?echo $cont?></option>
					<?
					$cont=$cont+1;
				}
				?>
				</select>
				de <?echo $row['puntosdar']?> disponibles.
				</font>
				<INPUT TYPE="submit" CLASS="submit_button" VALUE="Dar">
				</FORM>
				<?
			}
			else
			{	
				if ($id_user==$id_autor)
				echo "<br><div align='center'><font size='1'>No podés dar puntos a un post propio<br><br><br></font></div>";
				else
				echo "<br><div align='center'><font size='1'>Los usuarios no registrados no pueden dar puntos<br><br><br></font></div>";
			}
			?>
		</td>	
	</tr>
</table>