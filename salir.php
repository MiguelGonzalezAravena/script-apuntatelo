<?php
require_once(dirname(__FILE__) . '/includes/configuracion.php');

session_start();

// Borrar cookie
setcookie('id_extreme', 'x', time() - 3600, '/');

// Borrar sesión
$_SESSION['user'] = null;
$_SESSION['pass'] = null;
$_SESSION['id'] = null;

unset($_SESSION);
session_destroy();
redirect($url);

?>