<?
# the response from reCAPTCHA
$resp = null;
# the error code from reCAPTCHA, if any
$error = null;
require_once('../recaptcha/recaptchalib.php');
$privatekey = "6Ldb2AAAAAAAADuNCKWbsDYHqyPl1D6nbJzUn7QM";
$resp = recaptcha_check_answer ($privatekey,
                              $_SERVER["REMOTE_ADDR"],
                              $_POST["recaptcha_challenge_field"],
                              $_POST["recaptcha_response_field"]);
      if ($resp->is_valid) {
              $var = 1;
      } else {
              $var = 0;
      }
if ($var==1)
{
	include('../includes/configuracion.php');
	include('../includes/funciones.php');
	$mail=no_injection($_POST['mail']);
	
	$sql="select id, id_extreme from usuarios where mail='$mail' ";
	$rs=mysql_query($sql,$con);
	if (mysql_num_rows($rs)>0)
	{
		while($row=mysql_fetch_array($rs))
		{
			$id=$row['id'];
			$id_extreme=$row['id_extreme'];
			
			$cadena=$id."?".$id_extreme;
			$email="";
			$asunto="Recuperaci�n de contrase�a de EXTREME";
			$mensaje="<a href='http://www.extreme-zone.cl/datos/re-password.php?id=$cadena'>http://www.extreme-zone.cl/datos/re-password.php?id=$cadena</a>";
			$encabezados = "From: $email\nReply-To: $email\nContent-Type: text/html; charset=iso-8859-1"; 
			mail($mail, $asunto, $mensaje, $encabezados);
			?>
				 <script type="text/javascript">
    			location.href = "../notificaciones/c7.php";
    			</script> 
			<?
		}
	}
	else
	{
	?>
		 <script type="text/javascript">
    	location.href = "index.php?action=recuperar&mensaje=error";
    	</script> 	
	<?
	}
}
else
{
	?>
		 <script type="text/javascript">
    	location.href = "index.php?action=recuperar&mensaje=error2";
    	</script> 	
	<?
}
?>