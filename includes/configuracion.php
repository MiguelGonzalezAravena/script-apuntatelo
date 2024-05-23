<?php
$bd_host = 'localhost';
$bd_usuario = 'root';
$bd_password = '';
$bd_base = 'apuntatelo';
$url = 'http://localhost/apuntatelo';
$images = $url . '/imagenes';
$name = 'Apunt&aacute;telo';
$email = 'miguel.gonzalez.93@gmail.com';
$recaptcha_private = base64_decode('NkxjbFZ1UXBBQUFBQUlObEtxLWpaN2FTenFMUXJoTUJGRjRsaXdfZw==');
$recaptcha_public = base64_decode('NkxjbFZ1UXBBQUFBQUIyTUs1cU1RRkpPUnlhcXdGLUNMTWxBSENQag==');

// TO-DO: Agregar llave md5 a encriptar para passwords en BD
$con = mysqli_connect($bd_host, $bd_usuario, $bd_password);
mysqli_select_db($con, $bd_base);

?>