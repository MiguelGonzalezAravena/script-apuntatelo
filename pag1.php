<?php
$bd_host = "localhost"; 
$bd_usuario = "root"; 
$bd_password = "Gonzalez1993"; 
$bd_base = "apuntatelo"; 
$con = mysql_connect($bd_host, $bd_usuario, $bd_password); 
mysql_select_db($bd_base, $con);

 $RegistrosAMostrar=50;
 if(isset($_GET['pag'])){
  $RegistrosAEmpezar=($_GET['pag']-1)*$RegistrosAMostrar;
  $PagAct=$_GET['pag'];
 }else{
  $RegistrosAEmpezar=0;
  $PagAct=1;
 }
$id=$_GET['id'];

echo'<div class="box_posts">';

if($id == ''){
$request = mysql_query("
SELECT t.ID_TOPIC, m.subject, t.isSticky, m.ID_BOARD, b.name, m.hiddenOption
FROM (topics AS t, boards AS b)
INNER JOIN messages AS m
ON t.ID_TOPIC = m.ID_TOPIC
WHERE t.isSticky = 1
AND b.ID_BOARD = m.ID_BOARD
ORDER BY m.ID_TOPIC DESC
",$con);}
else
{
$request = mysql_query("
SELECT t.ID_TOPIC, m.subject, t.isSticky, m.ID_BOARD, b.name, m.hiddenOption
FROM (topics AS t, boards AS b)
INNER JOIN messages AS m
ON t.ID_TOPIC = m.ID_TOPIC
WHERE t.isSticky = 1
AND b.ID_BOARD = m.ID_BOARD AND m.ID_BOARD = $id
ORDER BY m.ID_TOPIC DESC
",$con);	
}

while($Stick1=mysql_fetch_array($request)){
echo '<table width="100%"><tr><td width="100%"><div class="box_icono4"><img title="'.$Stick1['name'].'" src="http://www.extreme-zone.cl/Themes/default/images/post/icono_'.$Stick1['ID_BOARD'].'.gif" ></div>';
echo'<img title="Sticky" src="http://www.extreme-zone.cl/Themes/default/images/icons/show_sticky.gif" width="10" height="10">&nbsp;<span title="' .$Stick1['subject'] . '"><a href="http://www.extreme-zone.cl/post/', $Stick1['ID_TOPIC'], '" >' . $Stick1['subject'] . '</a></span></td></tr></table>';}

if($id == ''){
$Resultado=mysql_query("SELECT * 
                         FROM (smf_messages as m, smf_boards as c) 
						 WHERE m.ID_BOARD=c.ID_BOARD
						 ORDER BY m.ID_TOPIC DESC 
						 LIMIT $RegistrosAEmpezar, $RegistrosAMostrar",$con);
						 while($MostrarFila=mysql_fetch_array($Resultado)){
echo"<table width='100%'><tr><td width='100%'><div class='box_icono4'><img title='".$MostrarFila['name']."' src='http://www.extreme-zone.cl/Themes/default/images/post/icono_".$MostrarFila['ID_BOARD'].".gif'></div>";
echo"<span title='", $MostrarFila['subject'], "'><a href='http://www.extreme-zone.cl/post/".$MostrarFila['ID_TOPIC']."'>",$MostrarFila['subject'], "</a></span></td></tr></table>";}}
else
{$Resultado2=mysql_query("SELECT * 
                         FROM (smf_messages as m, smf_boards as c) 
						 WHERE c.ID_BOARD=m.ID_BOARD AND m.ID_BOARD=$id
						 ORDER BY m.ID_TOPIC DESC 
						 LIMIT $RegistrosAEmpezar, $RegistrosAMostrar",$con);
						 while($MostrarFila2=mysql_fetch_array($Resultado2)){
echo"<table width='100%'><tr><td width='100%'><div class='box_icono4'><img title='".$MostrarFila2['name']."' src='http://www.extreme-zone.cl/Themes/default/images/post/icono_".$MostrarFila2['ID_BOARD'].".gif'></div>";
echo"<span title='", $MostrarFila2['subject'], "'><a href='http://www.extreme-zone.cl/post/".$MostrarFila2['ID_TOPIC']."'>",$MostrarFila2['subject'], "</a></span></td></tr></table>";}}

 
 //******--------determinar las p�ginas---------******//
 if($id == ''){
 $NroRegistros=mysql_num_rows(mysql_query("SELECT * FROM smf_messages",$con));}
 else
 {$NroRegistros=mysql_num_rows(mysql_query("SELECT * FROM smf_messages WHERE ID_BOARD = $id",$con));}


 $PagAnt=$PagAct-1;
 $PagSig=$PagAct+1;
 $PagUlt=$NroRegistros/$RegistrosAMostrar;
 $Res=$NroRegistros%$RegistrosAMostrar;
 // si hay residuo usamos funcion floor para que me
 // devuelva la parte entera, SIN REDONDEAR, y le sumamos
 // una unidad para obtener la ultima pagina
 if($Res>0) $PagUlt=floor($PagUlt)+1;
echo'</div><div class="box_posts"><center><font color="grey" size="2">';
if($id == ''){
 if($PagAct>1) echo "<a style='cursor: pointer; cursor: hand;' onclick='Paginas($PagAnt)'>< anterior</a>";
 if($PagAct>1) echo " || ";
 if($PagAct<$PagUlt)  echo "<a style='cursor: pointer; cursor: hand;' onclick='Paginas($PagSig)'>siguiente ></a>";
}else
{
 if($PagAct>1) echo "<a style='cursor: pointer; cursor: hand;' onclick='Pagina($PagAnt,$id)'>< anterior</a>";
 if($PagAct>1) echo " || ";
 if($PagAct<$PagUlt)  echo "<a style='cursor: pointer; cursor: hand;' onclick='Pagina($PagSig,$id)'>siguiente ></a>";
}
echo'</font></center></div>';
?>