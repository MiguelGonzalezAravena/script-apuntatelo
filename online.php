<html>
<body class="fondo_cuadro">
<?php 
// Copyright Cgixp Team
// Do not modify anything in this script as you don't need to do so
require_once(dirname(__FILE__) . '/includes/configuracion.php');

$log_file = dirname(__FILE__) . '/online.txt';
$min_online = '1';
$ip = !isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? getenv('REMOTE_ADDR') : getenv('HTTP_X_FORWARDED_FOR');

$day = date('d');
$month = date('m');
$year = date('Y');
$date = "$day-$month-$year";
$ora = date('H');
$minuti = date('i');
$secondi = date('s');
$time = "$ora:$minuti:$secondi";
$users_read = fopen($log_file, 'r');
$users = fread($users_read, filesize($log_file));
fclose($users_read);

$to_write = "$ip|$time|$date";

if ($users == 0) {
  $user_write = fopen($log_file, 'w');
  fputs($user_write, $to_write);
  fclose($user_write);
} else {
  $users = explode("\n", $users);
  $user_da_tenere = array();

  while (list($key, $val) = each($users)) {
    $user_sing = explode("|", $val);

    if ($date==$user_sing[2]) {
      $h = explode(":", $user_sing[1]);

      if ($ip!=$user_sing[0]) {
        if (($h[0]==$ora)and(($minuti-$h[1])<=$min_online)) {
          $user_da_tenere[]=$val;
        }

        if (($h[0]==($ora-1))and((($minuti+2)-$h[1])<=$min_online)) {
          $user_da_tenere[]=$val;
        }
      }
    }
  }

  $user_da_tenere[] = $to_write;
  $user_write = fopen($log_file, 'w');
  fputs($user_write, '');
  fclose($user_write);

  while (list($k, $v) = each($user_da_tenere)) {
    $new_file_log = fopen($log_file, 'a');
    fwrite($new_file_log, "$v\n");
    fclose($new_file_log);
  }
}

$users_online_read = fopen($log_file, 'r');
$users_online = fread($users_online_read, filesize($log_file));
fclose($users_online_read);

$users_online = explode("\n", $users_online);
$n_u_online = count($users_online) - 1;

echo '
  <div align="right">
    <font face="verdana" color="green" size="1">' . $n_u_online . '</font>
  </div>';

require_once(dirname(__FILE__) . '/chat/src/pfcinfo.class.php');
$info  = new pfcInfo(md5('APUNTATELO'));
// NULL is used to get all the connected users, but you can specify
// a channel name to get only the connected user on a specific channel
$users = $info->getOnlineNick(NULL);
$info = '';
$nb_users = count($users);

echo '<meta http-equiv="Refresh" content="30; URL=' . $url . '/online.php" />';
?>
</body>
</html>
