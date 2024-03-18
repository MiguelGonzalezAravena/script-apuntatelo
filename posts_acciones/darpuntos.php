<?
include('../includes/configuracion.php');
include('../includes/funciones.php');
include('../login.php');
$id_user = $_SESSION['id'];
$dar = no_injection($_POST["cantpuntos"]);
$dador = no_injection($_POST["dador"]);
$id_post = no_injection($_POST["id_post"]);
$titu = no_injection($_POST["titu"]);
$pag = no_injection($_POST["pagina"]);
$aux = 1;

if ($dador==$id_user)
{
	
	//VERIFICAR QUE NO HAYA PUNTEADO YA EL POST
	$sql = "SELECT num FROM puntos where id_punteador='".$id_user."' and num='".$id_post."' ";
	$rs = mysql_query($sql, $con);
	if(!mysql_num_rows($rs)>0)
	$aux = 0;
	
	//VERIFICAR QUE EL DADOR TENGA LA CANTIDAD DE PUNTOS
	
	$sql = "SELECT puntosdar FROM usuarios where id='".$id_user."' ";
	$rs = mysql_query($sql, $con);
	$row = mysql_fetch_array($rs);
	$puntosdar = $row['puntosdar']; 
	
	if($dar<=10 and $dar<=$puntosdar and $dar>0 and $dar!="")
	{
		if ($aux==0)
		{
			//BUSCAR RECEPTOR
			$sql = "select id_autor from posts where id='".$id_post."'";
			$rs = mysql_query($sql,$con);
			$row = mysql_fetch_array($rs);
			$receptor = $row['id_autor'];
			//ACTUALIZAR PUNTOS DEL RECEPTOR
			$sql = "Update usuarios Set puntos=puntos+'".$dar."' where id='".$receptor."'"; 	
			mysql_query($sql);
			//ACTUALIZAR PUNTOS DEL DADOR
			$sql = "Update usuarios Set puntosdar=puntosdar-'".$dar."' where id='".$id_user."'"; 	
			mysql_query($sql);
			//ACTUALIZAR PUNTOS DEL POST
			$sql = "Update posts Set puntos=puntos+'".$dar."' where id='".$id_post."'"; 	
			mysql_query($sql);
			//INSERTAR REGISTRO QUE VINCULA LA PUNTACION DEL DADOR CON EL POST DEL RECEPTOR
			$sql = "INSERT INTO puntos (num,id_punteador,puntos,fecha) VALUES ('".$id_post."','".$id_user."','".$dar."',NOW())";
			mysql_query($sql);
		}
		else
			echo '<script>alert("Sólo podés dar puntos una vez por cada post");</script>';
	}
if ($dar=="" or $dar==0)
echo '<script>alert("No tenés más puntos!");</script>';
}
mysql_close($con);
	?>
	
	   <SCRIPT LANGUAGE="javascript">
       location.href = "..<?echo$pag?>";
       </SCRIPT>
