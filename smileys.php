<?php
require_once(dirname(__FILE__) . '/includes/configuracion.php');

// TO-DO: Pasar smileys a base de datos
$smileys = array(
  array(
    'url' => $images . '/smileys/icon_cheesygrin.gif',
    'code' => ':))'
  ),
  array(
    'url' => $images . '/smileys/icon_eek.gif',
    'code' => '8|'
  ),
  array(
    'url' => $images . '/smileys/thumbup.gif',
    'code' => ':ok:'
  ),
  array(
    'url' => $images . '/smileys/twisted.gif',
    'code' => ':twisted:'
  ),
  array(
    'url' => $images . '/smileys/clapping.gif',
    'code' => ':aplauso:'
  ),
  array(
    'url' => $images . '/smileys/icon_angel_not.gif',
    'code' => ':angel:'
  ),
  array(
    'url' => $images . '/smileys/angry.gif',
    'code' => ':angry:'
  ),
  array(
    'url' => $images . '/smileys/muro.gif',
    'code' => ':idiot:'
  ),
  array(
    'url' => $images . '/smileys/ziped.gif',
    'code' => ':ziped:'
  ),
  array(
    'url' => $images . '/smileys/blink.gif',
    'code' => ':blink:'
  ),
  array(
    'url' => $images . '/smileys/coppa.gif',
    'code' => ':win:'
  ),
  array(
    'url' => $images . '/smileys/dload.gif',
    'code' => ':download:'
  ),
  array(
    'url' => $images . '/smileys/icon_redface.gif',
    'code' => ':embarrass:'
  ),
  array(
    'url' => $images . '/smileys/book.gif',
    'code' => ':book:'
  ),
  array(
    'url' => $images . '/smileys/icon_sorry.gif',
    'code' => ':sorry:'
  ),
  array(
    'url' => $images . '/smileys/bye.gif',
    'code' => ':bye:'
  ),
  array(
    'url' => $images . '/smileys/banana.gif',
    'code' => ':banana:'
  ),
  array(
    'url' => $images . '/smileys/afro.gif',
    'code' => ':cool:'
  ),
  array(
    'url' => $images . '/smileys/chair.gif',
    'code' => ':stupid:'
  ),
  array(
    'url' => $images . '/smileys/welcome.gif',
    'code' => ':welcome:'
  ),
  array(
    'url' => $images . '/smileys/nocomment8so.gif',
    'code' => ':no-comment:'
  ),
  array(
    'url' => $images . '/smileys/banned.gif',
    'code' => ':banned:'
  ),
  array(
    'url' => $images . '/smileys/spam.gif',
    'code' => ':spam:'
  ),
  array(
    'url' => $images . '/smileys/icon_offtopic.gif',
    'code' => ':off-topic:'
  ),
);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <title>APUNTATELO Tu link-sharing de apuntes</title>
  </head>
  <body>
    <table>
<?php
for ($i = 0; $i < count($smileys); $i++) {
?>
      <tr>
        <td width="100">
          <img src="<?php echo $smileys[$i]['url']; ?>" hspace="2" vspace="4" align="absmiddle" border="0" />
          <br />
        </td>
        <td>
          <?php echo $smileys[$i]['code']; ?>
        </td>
      </tr>
<?php
}
?>
    </table>
  </body>
</html>