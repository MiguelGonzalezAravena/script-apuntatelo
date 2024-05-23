<?php
function no_injection($string) {
  return htmlentities(stripslashes(trim($string)), ENT_QUOTES, 'UTF-8');
}

function rss_string($string) {
  // return htmlentities(stripslashes(trim($string)), ENT_QUOTES, 'ISO-8859-1');
  return html_entity_decode($string, ENT_QUOTES, 'UTF-8');
}

function contarVisita($post, $ip) {
  global $con;

  $sql = "
    SELECT id_post
    FROM visitas
    WHERE id_post = $post
    AND ip = '" . $ip . "'";

  $request = mysqli_query($con, $sql);

  if (mysqli_num_rows($request) == 0) {
    mysqli_query($con, "UPDATE posts SET visitas = visitas + 1 WHERE id = $post");
    mysqli_query($con, "INSERT INTO visitas (id_post, ip, fecha) VALUES ($post, '$ip', NOW())");
  }
}

function BBparse($texto) {
  global $images;

  $texto = nl2br($texto);
  $a = array(
    "/\[i\](.*?)\[\/i\]/is",
    "/\[b\](.*?)\[\/b\]/is",
    "/\[u\](.*?)\[\/u\]/is",
    "/\[img\](.*?)\[\/img\]/is",
    "/\[align=(.*?)\](.*?)\[\/align\]/is",
    "/\[url=(.*?)\](.*?)\[\/url\]/is",
    "/\[url\](.*?)\[\/url\]/is",
    "/\[quote=(.*?)\](.*?)\[\/quote\]/is",
    "/\[quote\](.*?)\[\/quote\]/is",
    "/\[size=(.*?)\](.*?)\[\/size\]/is",
    "/\[color=(.*?)\](.*?)\[\/color\]/is",
    "/\[font=(.*?)\](.*?)\[\/font\]/is",
    "/\[swf=http:\/\/www.youtube.com\/v\/(.*?)\]/is"
  );

  $b = array(
    "<i>$1</i>",
    "<b>$1</b>",
    "<u>$1</u>",
    "<img src=\"$1\" onload=\"if(this.width > 750) {this.width=750}\" />",
    "<div align=\"$1\">$2</div>",
    "<a href=\"$1\" target=\"_blank\">$2</a>",
    "<a href=\"$1\" target=\"_blank\">$1</a>",
    "<div align=\"center\"><table width=\"600\"><tr><td background=\"" . $images . "/franja.JPG\" height=\"15\"><font size=\"1\" color=\"white\"><b>Cita($1):</b></font></td></tr><tr><td bgcolor=\"gray\"><font size=\"1\" color=\"white\">$2</font></td></tr></table></font></div>",
    "<div align=\"center\"><table width=\"600\"><tr><td background=\"" . $images . "/franja.JPG\" height=\"15\"><font size=\"1\" color=\"white\"><b>Cita:</b></font></td></tr><tr><td bgcolor=\"gray\"><font size=\"1\" color=\"white\">$1</font></td></tr></table></font></div>",
    "<div class=\"size$1\">$2</div>",
    "<font color=\"$1\">$2</font>",
    "<font face=\"$1\">$2</font>",
    "<div align=\"center\"><embed src=\"http://www.youtube.com/v/$1\" quality=\"high\" width=\"425\" height=\"350\" type=\"application/x-shockwave-flash\" AllowScriptAccess=\"never\"></embed></div>"
  );

  $texto = preg_replace($a, $b, $texto);

  $bbcode = array();
  $html = array();

  $bbcode[] = ":))"; $html[] = '<img src="' . $images . '/smileys/icon_cheesygrin.gif" />';
  $bbcode[] = "8|"; $html[] = '<img src="' . $images . '/smileys/icon_eek.gif" />';
  $bbcode[] = ":ok:"; $html[] = '<img src="' . $images . '/smileys/thumbup.gif" />';
  $bbcode[] = ":cool:"; $html[] = '<img src="' . $images . '/smileys/afro.gif" />';
  $bbcode[] = ":banana:"; $html[] = '<img src="' . $images . '/smileys/banana.gif" />';
  $bbcode[] = ":bye:"; $html[] = '<img src="' . $images . '/smileys/bye.gif" />';
  $bbcode[] = ":twisted:"; $html[] = '<img src="' . $images . '/smileys/twisted.gif" />';
  $bbcode[] = ":aplauso:"; $html[] = '<img src="' . $images . '/smileys/clapping.gif" />';
  $bbcode[] = ":angel:"; $html[] = '<img src="' . $images . '/smileys/icon_angel_not.gif" />';
  $bbcode[] = ":angry:"; $html[] = '<img src="' . $images . '/smileys/angry.gif" />';
  $bbcode[] = ":welcome:"; $html[] = '<img src="' . $images . '/smileys/welcome.gif" />';
  $bbcode[] = ":no-comment:"; $html[] = '<img src="' . $images . '/smileys/nocomment8so.gif" />';
  $bbcode[] = ":banned:"; $html[] = '<img src="' . $images . '/smileys/banned.gif" />';
  $bbcode[] = ":spam:"; $html[] = '<img src="' . $images . '/smileys/spam.gif" />';
  $bbcode[] = ":idiot:"; $html[] = '<img src="' . $images . '/smileys/muro.gif" />';
  $bbcode[] = ":stupid:"; $html[] = '<img src="' . $images . '/smileys/chair.gif" />';
  $bbcode[] = ":sorry:"; $html[] = '<img src="' . $images . '/smileys/icon_sorry.gif" />';
  $bbcode[] = ":embarrass:"; $html[] = '<img src="' . $images . '/smileys/icon_redface.gif" />';
  $bbcode[] = ":win:"; $html[] = '<img src="' . $images . '/smileys/coppa.gif" />';
  $bbcode[] = ":download:"; $html[] = '<img src="' . $images . '/smileys/dload.gif" />';
  $bbcode[] = ":ziped:"; $html[] = '<img src="' . $images . '/smileys/ziped.gif" />';
  $bbcode[] = ":off-topic:"; $html[] = '<img src="' . $images . '/smileys/icon_offtopic.gif" />';
  $bbcode[] = ":blink:"; $html[] = '<img src="' . $images . '/smileys/blink.gif" />';
  $bbcode[] = ":book:"; $html[] = '<img src="' . $images . '/smileys/book.gif" />';

  $texto = str_replace($bbcode, $html, $texto);

  return $texto;
}

function correcciones($texto) {
  $bbcode[] = 'á'; $html[] = "&aacute;";
  $bbcode[] = 'é'; $html[] = "&eacute;";
  $bbcode[] = 'í'; $html[] = "&iacute;";
  $bbcode[] = 'ó'; $html[] = "&oacute;";
  $bbcode[] = 'ú'; $html[] = "&uacute;";
  $bbcode[] = 'Á'; $html[] = "&Aacute;";
  $bbcode[] = 'É'; $html[] = "&Eacute;";
  $bbcode[] = 'Í'; $html[] = "&Iacute;";
  $bbcode[] = 'Ó'; $html[] = "&Oacute;";
  $bbcode[] = 'Ú'; $html[] = "&Uacute;";
  $bbcode[] = ''; $html[] = "&aacute;";
  $bbcode[] = ''; $html[] = "&eacute;";
  $bbcode[] = ''; $html[] = "&iacute;";
  $bbcode[] = ''; $html[] = "&oacute;";
  $bbcode[] = ''; $html[] = "&uacute;";
  $bbcode[] = ''; $html[] = "&Aacute;";
  $bbcode[] = ''; $html[] = "&Eacute;";
  $bbcode[] = ''; $html[] = "&Iacute;";
  $bbcode[] = ''; $html[] = "&Oacute;";
  $bbcode[] = ''; $html[] = "&Uacute;";
  $bbcode[] = 'ñ'; $html[] = "&ntilde;";
  $bbcode[] = 'Ñ'; $html[] = "&Ntilde;";
  $bbcode[] = ''; $html[] = "&uml;";
  $bbcode[] = ''; $html[] = "&Uml;";
  $bbcode[] = '¿'; $html[] = "&iquest;";
  $bbcode[] = "%"; $html[] = "&divide;";
  $bbcode[] = ''; $html[] = "&deg;";
  $bbcode[] = ''; $html[] = "&deg;";

  $texto = str_replace($bbcode, $html, $texto);

  return $texto;
}

// Cambiar nombre a función
function correcciones2($texto) {
  /*
  $bbcode[] = "&quot;"; $html[] = '"';
  $bbcode[] = "&#039;"; $html[] = '"';
  $bbcode[] = "&iquest;"; $html[] = '¿';
  //&amp;iquest;
  $bbcode[] = "&amp;iquest;"; $html[] = '¿';
  $bbcode[] = "&iexcl;"; $html[] = '¡';
  $bbcode[] = "&lt;"; $html[] = '<';
  $bbcode[] = "&gt;"; $html[] = '>';
  $bbcode[] = "&aacute;"; $html[] = 'á';
  $bbcode[] = "&amp;aacute;"; $html[] = 'á';
  $bbcode[] = "&eacute;"; $html[] = 'é';
  $bbcode[] = "&amp;eacute;"; $html[] = 'é';
  $bbcode[] = "&iacute;"; $html[] = 'í';
  $bbcode[] = "&amp;iacute;"; $html[] = 'í';
  $bbcode[] = "&oacute;"; $html[] = 'ó';
  $bbcode[] = "&amp;oacute;"; $html[] = 'ó';
  $bbcode[] = "&uacute;"; $html[] = 'ú';
  $bbcode[] = "&amp;uacute;"; $html[] = 'ú';
  $bbcode[] = "&ntilde;"; $html[] = 'ñ';
  $bbcode[] = "&Uacute;"; $html[] = 'Ú';
  // &amp;uacute
  $texto = str_replace($bbcode, $html, $texto);

  return $texto;
  */

  return html_entity_decode($texto, ENT_QUOTES, 'UTF-8');
}

function amp($texto) {
  $texto = str_replace('&', '&amp;', $texto);

  return $texto;
}

function corregir($arreglo) {
  $arreglo = str_replace("<", "&lt;", $arreglo);
  $arreglo = str_replace(">", "&gt;", $arreglo);
  $arreglo = str_replace("\'", "'", $arreglo);
  $arreglo = str_replace('\"', "&quot;", $arreglo);
  $arreglo = str_replace("\\\\", "\\", $arreglo);
  $arreglo = str_replace(" ", "-", $arreglo);

  return $arreglo;
}

function quitar($mensaje) {
  $mensaje = str_replace("<", "&lt;", $mensaje);
  $mensaje = str_replace(">", "&gt;", $mensaje);
  $mensaje = str_replace("\'", "'", $mensaje);
  $mensaje = str_replace('\"', "&quot;", $mensaje);
  $mensaje = str_replace("\\\\", "\\", $mensaje);

  return $mensaje;
}

function sexo($valor) {
  $valor = str_replace('m', 'Hombre', $valor);
  $valor = str_replace('f', 'Mujer', $valor);

  return $valor;
}

function pais($valor) {
  $valor = str_replace('ar', 'Argentina', $valor);
  $valor = str_replace('bo', 'Bolivia', $valor);
  $valor = str_replace('br', 'Brasil', $valor);
  $valor = str_replace('cl', 'Chile', $valor);
  $valor = str_replace('co', 'Colombia', $valor);
  $valor = str_replace('cr', 'Costa Rica', $valor);
  $valor = str_replace('cu', 'Cuba', $valor);
  $valor = str_replace('ec', 'Ecuador', $valor);
  $valor = str_replace('es', 'Espa&ntilde;a', $valor);
  $valor = str_replace('gt', 'Guatemala', $valor);
  $valor = str_replace('it', 'Italia', $valor);
  $valor = str_replace('mx', 'M&eacute;xico', $valor);
  $valor = str_replace('py', 'Paraguay', $valor);
  $valor = str_replace('pe', 'Per&uacute;', $valor);
  $valor = str_replace('pt', 'Portugal', $valor);
  $valor = str_replace('pr', 'Puerto Rico', $valor);
  $valor = str_replace('uy', 'Uruguay', $valor);
  $valor = str_replace('ve', 'Venezuela', $valor);
  $valor = str_replace('ot', 'Otro', $valor);

  return $valor;
}

function rango($valor) {
  global $images;

  $template = '
    <br clear="left" />
    <img src="' . $images . '/rangos/administrador.png" alt="Administrador" title="Administrador" />';

  $valor = str_replace('Administrador', $template, $valor);

  return $valor;
}

function rango_color($valor) {
  switch($valor) {
    case 'Administrador':
      return 'red';
    case 'Moderador':
      return 'blue';
    case 'Usuario Destacado':
      return 'green';
    default:
      return 'black';
  }
}

function rango_propio($user) {
  global $con;

  if ($user == '') {
    return '';
  } else {
    // Obtener rango del usuario
    $sql = "
    SELECT rango
    FROM usuarios
    WHERE nick = '$user'";

    $request = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($request);
    return $row['rango'];
  }
}

function redirect($url) {
  if (!headers_sent()) {
    header("Location: $url");
    exit;
  } else {
    echo '
      <script type="text/javascript">
        window.location.href = \'' . $url . '\';
      </script>';
  }
}

function alert($text) {
  echo '<script type="text/javascript">alert(\'' . $text . '\');</script>';
}

function recaptcha_validation($response) {
  global $recaptcha_private;

  $ip = !isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? getenv('REMOTE_ADDR') : getenv('HTTP_X_FORWARDED_FOR');
  $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
  $data = [
    'secret' => $recaptcha_private,
    'response' => $response,
    'remoteip' => $ip
  ];

  // use key 'http' even if you send the request to https://...
  $options = [
    'http' => [
      'header' => "Content-type: application/x-www-form-urlencoded\r\n",
      'method' => 'POST',
      'content' => http_build_query($data)
    ]
  ];

  $context = stream_context_create($options);
  $result = file_get_contents($recaptcha_url, false, $context);
  $decode = json_decode($result);

  return $decode->success;
}

?>