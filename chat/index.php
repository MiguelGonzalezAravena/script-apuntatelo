<?php
$pfc_ajax = isset($_GET['pfc_ajax']) ? $_GET['pfc_ajax'] : '';
$f = isset($_GET['f']) ? $_GET['f'] : '';

if ($pfc_ajax != 1) {
  require_once(dirname(dirname(__FILE__)) . '/header.php');
}

require_once(dirname(dirname(__FILE__)) . '/includes/configuracion.php');
require_once(dirname(__FILE__) . '/src/phpfreechat.class.php');
$params = array();
$params['title'] = 'Chat de ' . $name;
$params['nick'] = isset($_SESSION['user']) ? $_SESSION['user'] . 'Test' : 'Invitado_'  . rand(1, 1000);
$params['firstisadmin'] = true;
$params['serverid'] = md5($name); // calculate a unique id for this chat
$params['debug'] = false;
$chat = new phpFreeChat($params);
?>
<div class="bordes">
  <br /><br /><br /><br /><br /><br /><br /><br /><br />
  <?php $chat->printChat(); ?>
  <br /><br /><br /><br /><br /><br /><br /><br /><br />
<?php
if ($pfc_ajax != 1) {
  require_once(dirname(dirname(__FILE__)) . '/footer.php');
}
?>
</div>