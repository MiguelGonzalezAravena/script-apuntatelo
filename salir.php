<?
session_start();
// Borramos cookie
setcookie("id_extreme","x",time()-3600,"/");
// Borramos sesi�n
$_SESSION['user'] = null;
$_SESSION['pass'] = null;
$_SESSION['id'] = null;
unset($_SESSION);
session_destroy();
header("Location: /");
?>
