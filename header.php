<?php
// HEADER
require_once(dirname(__FILE__) . '/includes/configuracion.php');
require_once(dirname(__FILE__) . '/includes/funciones.php');
require_once(dirname(__FILE__) . '/login.php');

if ($_SERVER['REQUEST_URI'] != '/' && $_SERVER['REQUEST_URI'] != 'index.php') {
  echo '<div style="display: none;">';
  require_once(dirname(__FILE__) . '/online.php');
  echo '</div>';
}

$iexp = $_SERVER['HTTP_USER_AGENT'];
$margin_top = strstr($iexp, 'MSIE') ? '0px;' : '1px;';
$user = isset($_SESSION['user']) ? $_SESSION['user'] : '';
$rango = rango_propio($user);
?> 
<!-- Apuntátelo v3.0 - Todos los derechos reservados -->
<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01//EN\" \"http://www.w3.org/TR/html4/strict.dtd\">
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <link href="<?php echo $images; ?>/logo/icono.bmp" rel="shortcut icon"/>
    <link rel="stylesheet" type="text/css" href="<?php echo $url; ?>/estilos/index.css" />
    <link href="<?php echo $url; ?>/ultimos_posts/" title="<?php echo $name; ?> - &Uacute;ltimos posts" type="application/rss+xml" rel="alternate" />
  </head>
  <body bgcolor="white" text="#FFFFFF" link="#FFFFFF" topmargin="8">
    <div class="fondologo">
      <div class="esquina_sup_izq" style="font-size: 0px;"></div>
      <div style="height: 8px; width: 958px; float: left; font-size: 0px;">&nbsp;</div>
      <div class="esquina_sup_der" style="font-size: 0px;"></div>
      <a href="<?php echo $url; ?>/">
        <div class="logo"></div>
      </a>
      <div align="right">
        <br />
        <div style="padding-right: 20px;"></div>
      </div>
    </div>
    <div class="bordes">
      <div class="menu">
        <div class="menu1"></div>
        <div class="menu2">
          <font color="black">
<?php
if (isset($_SESSION['user'])) {
  if ($_SERVER['PHP_SELF'] == '/mensajes/mensajes_recibidos.php') {
    require_once(dirname(__FILE__) . '/mensajes/marcar_leido.php');
  }
?>
            <div class="user">
              <div class="size11">
                <a href="<?php echo $url; ?>/perfil/<?php echo $_SESSION['user']; ?>/" title="Perfil" class="user_profile"><?php echo $_SESSION['user']; ?></a>
                [
                <a href="<?php echo $url; ?>/salir.php"><font color="black">x</font></a>
                ]
              </div>
            </div>
          </font>
          <div class="user">
            &nbsp;
            <a href="<?php echo $url; ?>/datos/" title="Datos">
              <font color="black">
                <img src="<?php echo $images; ?>/iconos/datos.png" alt="Datos" />
              </font>
            </a>
          </div>
          <div class="user">
            &nbsp;
            <a href="<?php echo $url; ?>/mensajes/" title="MP">
              <font color="black">
                <img src="<?php echo $images; ?>/iconos/mensajes.png" alt="Mensaje Privado" />
              </font>
            </a>
          </div>
<?php
  $sql = "
    SELECT id_mensaje
    FROM mensajes
    WHERE id_receptor = {$_SESSION['id']}
    AND leido_receptor = 0";

  $request = mysqli_query($con, $sql);
  if (mysqli_num_rows($request) > 0) {
?>
          <div class="ini size10" style="padding-top: 1px;">
            <a href="<?php echo $url; ?>/mensajes/" style="font-weight: normal;" title="Nuevo Mensaje Privado">
              <font color="red" style="font-weight: bold;">(<?php echo mysqli_num_rows($request); ?>)</font>
            </a>
          </div>
<?php
  }
?>
          <div class="user">
            &nbsp;
            <a href="<?php echo $url; ?>/favoritos/" title="Favoritos">
              <font color="black">
                <img src="<?php echo $images; ?>/iconos/favoritos.png" alt="Favoritos">
              </font>
            </a>
          </div>
<?php
} else {
?>
          <div class="user" style="margin-top: <?php echo $margin_top; ?>">
            <form action="<?php echo $url; ?>/ingresar.php" method="post">
              <table width="20" height="10" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="right">
                    <div class="size11 negro">&nbsp;Usuario:&nbsp;</div>
                  </td>
                  <td>
                    <input type="text" name="nick" size="12" maxlength="20" style="font-size: 9px" /> 
                  </td>
                  <td></td>
                  <td>
                    <div class="size11 negro">&nbsp;Contrase&ntilde;a:&nbsp;</div>
                  </td>
                  <td>
                    <input type="password" name="password" size="12" maxlength="20" style="font-size: 9px" />
                    <input type="hidden" name="pagina" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />
                  </td>
                  <td></td>
                  <td>&nbsp;</td>
                  <td>
                    <input type="submit" class="submit_button" style="font-size: 9px; font-weight: normal;" value="Ingresar" />
                  </td>
                </tr>
              </table>
            </form> 
          </div>
<?php
}

if (isset($_SESSION['user'])) {
?>
          <div class="ini" style="padding-top: 0px; margin-top: 0px;">
            <div class="size11">
              <table valign="top" border="0" style="color: #000000;">
                <tr>
                  <td class="size11" valign="middle">|</td>
                  <td class="size11" valign="middle"><a href="<?php echo $url; ?>/" style="color: #000000;" title="Inicio"><img src="<?php echo $images; ?>/inicio.png" alt="Inicio"></a></td>
                  <td class="size11" valign="middle">|</td>
                  <td class="size11" valign="middle"><a href="<?php echo $url; ?>/busqueda/" style="color: #000000;" title="B&uacute;squeda"><img src="<?php echo $images; ?>/busqueda.png" alt="Busqueda"></a></td>
                  <td class="size11" valign="middle">|</td>
                  <td class="size11" valign="middle"><a href="<?php echo $url; ?>/protocolo/" style="color: #000000;">Protocolo</a></td>
                  <td class="size11" valign="middle">|</td>
                  <td class="size11" valign="middle"><a href="<?php echo $url; ?>/faq/" style="color: #000000;">F.A.Q.</a></td>
                  <td class="size11" valign="middle">|</td>
                  <td class="size11" valign="middle"><a href="<?php echo $url; ?>/agregar_post/" style="color: #000000;">Agregar</a></td>
                  <td class="size11" valign="middle">|</td>
                  <?php if ($rango == 'Moderador' || $rango == 'Administrador') { ?>
                  <td class="size11" valign="middle"><a href="<?php echo $url; ?>/admin/" style="color: #000000;">Administraci&oacute;n</a></td>
                  <td class="size11" valign="middle">|</td>
                  <?php } ?>
                  <td class="size11" valign="middle"><a href="<?php echo $url; ?>/contacto/" style="color: #000000;">Contacto</a></td>
                  <td class="size11" valign="middle">|</td>
                </tr>
              </table>
            </div>
          </div>
<?php
} else {
?>
          <div class="ini" style="padding-top: 0px; margin-top: 0px;">
            <div class="size11">
              <table valign="top" border="0" style="color: #000000;">
                <tr>
                  <td class="size11" valign="middle">|</td>
                  <td class="size11" valign="middle"><a href="<?php echo $url; ?>/" style="color: #000000;" title="Inicio"><img src="<?php echo $images; ?>/inicio.png" alt="Inicio"></a></td>
                  <td class="size11" valign="middle">|</td>
                  <td class="size11" valign="middle"><a href="<?php echo $url; ?>/busqueda/" style="color: #000000;" title="B&uacute;squeda"><img src="<?php echo $images; ?>/busqueda.png" alt="B&uacute;squeda"></a></td>
                  <td class="size11" valign="middle">|</td>
                  <td class="size11" valign="middle"><a href="<?php echo $url; ?>/protocolo/" style="color: #000000;">Protocolo</a></td>
                  <td class="size11" valign="middle">|</td>
                  <td class="size11" valign="middle"><a href="<?php echo $url; ?>/faq/" style="color: #000000;">F.A.Q.</a></td>
                  <td class="size11" valign="middle">|</td>
                  <td class="size11" valign="middle"><a href="<?php echo $url; ?>/contacto/" style="color: #000000;">Contacto</a></td>
                  <td class="size11" valign="middle">|</td>
                  <td class="size11" valign="middle"><a href="<?php echo $url; ?>/registro/" style="color: #000000;">Registrarse</a></td>
                  <td class="size11" valign="middle">|</td>
                </tr>
              </table>
            </div>
          </div>
<?php
}
?>
        </div>
        <div class="menu3"></div>
      </div>
    </div>
  </div>
</div>