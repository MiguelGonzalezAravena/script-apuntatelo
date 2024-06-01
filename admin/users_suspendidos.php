<?php
require_once(dirname(dirname(__FILE__)) . '/header.php');
require_once(dirname(dirname(__FILE__)) . '/includes/configuracion.php');

$user = isset($_SESSION['user']) ? $_SESSION['user'] : '';
$a = isset($_POST['palabra']) ? no_injection($_POST['palabra']) : '';
$b = isset($_GET['user']) ? no_injection($_GET['user']) : '';
$action = isset($_GET['action']) ? no_injection($_GET['action']) : '';
$tipo = isset($_POST['tipo']) ? no_injection($_POST['tipo']) : '';
$rango = rango_propio($user);

if ($a == '' && $b != '') {
  $a = $b;
  $tipo = 'usuario';
}

if ($a == '' && $b == '') {
  $tipo = 'ultimos';
}
?>
<div class="bordes">
  <br />
<?php
switch($action) {
  case 'correcto':
    echo '<font size="2" color="green">El usuario ha sido suspendido.</font>';
    break;
  case 'correcto2':
    echo '<font size="2" color="green">El usuario ha sido restaurado.</font>';
    break;
  case 'error':
    echo '<font size="2" color="red">El usuario se encuentra suspendido. Revise el historial del mismo.</font>';
    break;
  case 'error2':
    echo '<font size="2" color="red">No existe el usuario.</font>';
    break;
  case 'error3':
    echo '<font size="2" color="red">El usuario NO se encuentra suspendido.</font>';
    break;
  case 'error4':
    echo '<font size="2" color="red">Operaci&oacute;n no v&aacute;lida. Revisa no haber dejado alguno de los campos vac&iacute;os.</font>';
    break;
}

if ($rango == 'Moderador' || $rango == 'Administrador') {
?>
  <table width="325" align="center" cellspacing="0" cellpadding="0">
    <tr>
      <td>
        <div class="esq1" style="float: left;"></div>
        <div class="franja" style="float: left; width: 309px;"><div style="padding-top: 2px;">Buscar suspensiones del usuario:</div></div>
        <div class="esq2" style="float: left;"></div>
      </td>
    </tr>
    <tr>
      <td class="fondo_cuadro" valign="top" style="padding: 3px;">
        <form name="buscar" action="<?php echo $url; ?>/admin/users_suspendidos.php" method="post">
          <table width="300" height="50"><font size="-2">
            <tr>
              <td align="center" valign="middle">
                <font size="2" color="black">
                  Nick:
                  <input type="text" name="palabra" size="20" maxlength="200" value="<?php echo $a; ?>" /><br /><br />
                  <input type="radio" name="tipo" value="ultimos"<?php echo ($tipo != 'usuario' && $tipo != 'moderador' ? ' checked="checked"' : ''); ?> />&Uacute;ltimos
                  <input type="radio" name="tipo" value="usuario"<?php echo ($tipo == 'usuario' ? ' checked="checked"' : ''); ?> />Usuario 
                  <input type="radio" name="tipo" value="moderador"<?php echo ($tipo == 'moderador' ? ' checked="checked"' : ''); ?> />Moderador
                  <br /><br />
                  <input type="hidden" name="var" value="1" />
                  <input type="submit" name="Submit" class="submit_button" value="Ver/Buscar" />
                </font>
              </td>
            </tr>
          </table>
        </form> 
      </td>
    </tr>
  </table>
  <br />
  <table align="center" width="900" cellspacing="0" cellpadding="0">
    <tr>
      <td>
        <div class="esq1" style="float: left;"></div>
        <div class="franja" style="float: left; width: 884px;">
          <div style="padding-top: 2px;">Historial de suspensi&oacute;n<?php echo ($tipo == 'usuario' ? ' de ' . $a : ''); ?><?php echo ($tipo == 'moderador' ? ' realizado por ' . $a : ''); ?></div>
        </div>
        <div class="esq2" style="float: left;"></div>
      </td>
    </tr>
    <tr>
      <td class="fondo_cuadro" valign="top" style="padding: 0px;">
        <table border="0"  width="900" cellspacing="0" cellpadding="0">
          <tr>
            <td width="10">
              <font size="2" color="black"><b>&nbsp;A</font>
            </td>
            <td width="125">
              &nbsp;<font size="2" color="black"><b>Usuario</b></font>
            </td>
            <td width="245">
              <font size="2" color="black"><b>Especificaciones</b></font>
            </td>
            <td width="125">
              <font size="2" color="black"><b>Moderador</b></font>
            </td>
            <td width="160">
              <font size="2" color="black"><b>Fecha supensi&oacute;n:</b></font>
            </td>
            <td width="125">
              <font size="2" color="black"><b>Moderador</b></font>
            </td>
            <td width="160">
              <font size="2" color="black"><b>Fecha reactivaci&oacute;n</b></font>
            </td>
          </tr>
<?php
if ($tipo == 'ultimos') {
  $sql = "
    SELECT * 
    FROM suspendidos
    ORDER BY id DESC";

  $request = mysqli_query($con, $sql);

  while ($row = mysqli_fetch_array($request)) {
    $activo = $row['activo'];
    $id = $row['id'];
    $nick = $row['nick'];
    $causa = $row['causa']; 
    $moderador = $row['modera'];
    $fecha1 = $row['fecha1'];
    $activa = $row['activa'];
    $fecha2 = $row['fecha2'];
?>
          <tr>
            <td>
              <font size="1" color="black">&nbsp;<?php echo $activo; ?></font>
            </td>
            <td>
              &nbsp;<font size="1" color="black"><?php echo $nick; ?></font>
            </td>
            <td>
              <font size="1" color="black"><?php echo $causa; ?></font>
            </td>
            <td>
              <font size="1 color="black"><?php echo $moderador; ?></font>
            </td>
            <td>
              <font size="1" color="black"><?php echo $fecha1; ?></font>
            </td>
            <td>
              <font size="1" color="black"><?php echo $activa; ?></font>
            </td>
            <td>
              <font size="1" color="black"><?php echo $fecha2; ?></font>
            </td>
          </tr>
<?php
  }

  mysqli_close($con);
} else if ($tipo == 'usuario' || $tipo == 'moderador') {
  $sql2 = "
    SELECT *
    FROM usuarios
    WHERE nick = '$a'";

  $request = mysqli_query($con, $sql2);

  if (mysqli_num_rows($request) > 0) {
    $sql = "SELECT * ";

    if ($tipo == 'usuario') {
      $sql .= "
        FROM suspendidos
        WHERE nick = '$a'
        ORDER BY id DESC";
    } else if ($tipo == 'moderador') {
      $sql .= "
        FROM suspendidos
        WHERE modera = '$a'
        OR activa = '$a'
        ORDER BY id DESC";
    }

    $request = mysqli_query($con, $sql);

    while ($row = mysqli_fetch_array($request)) {
      $activo = $row['activo'];
      $id = $row['id'];
      $nick = $row['nick'];
      $causa = $row['causa']; 
      $moderador = $row['modera'];
      $fecha1 = $row['fecha1'];
      $activa = $row['activa'];
      $fecha2 = $row['fecha2'];
?>
          <tr>
            <td>
              <font size="1" color="black"><?php echo $activo; ?></font>
            </td>
            <td>
              <font size="1" color="black"><?php echo $nick; ?></font>
            </td>
            <td>
              <font size="1" color="black"><?php echo $causa; ?></font>
            </td>
            <td>
              <font size="1" color="black"><?php echo $moderador; ?></font>
            </td>
            <td>
              <font size="1" color="black"><?php echo $fecha1; ?></font>
            </td>
            <td>
              <font size="1" color="black"><?php echo $activa; ?></font>
            </td>
            <td>
              <font size="1" color="black"><?php echo $fecha2; ?></font>
            </td>
          </tr>
<?php
    }
  } else {
    alert('&iexcl;El usuario ' . $a . ' no existe!');
  }

  mysqli_close($con);
}
?>
        </table>
      </td>
    </tr>
  </table>
  <br />
  <table align="center" width="400" cellspacing="0" cellpadding="0">
    <tr>
      <td>
        <div class="esq1" style="float: left;"></div>
        <div class="franja" style="float: left; width: 384px;"><div style="padding-top:2px;">Suspender a usuario</div></div>
        <div class="esq2" style="float: left;"></div>
      </td>
    </tr>
    <tr>
      <td class="fondo_cuadro" valign="top" style="padding: 3px;">
        <form name="sticky" method="post" action="<?php echo $url; ?>/admin/suspender.php">
          <font size="2">Nick: </font><br />
          <input type="text" name="nick" maxlength="20" size="22" />
          <br /><br />
          <font size="2">Especificaciones: </font><br />
          <textarea name="razon" rows="10" cols="40"></textarea>
          <br /><br />
          <input class="submit_button" type="button" style="font-size: 11px" onclick="if(confirm('&iquest;Seguro que deseas suspender al usuario?')) this.form.submit();" class="button" name="botonsuspender" value="Suspender" />
        </form>
      </td>
    </tr>
    <tr>
      <td></td>
    </tr>
  </table>
  <br />
  <table align="center" width="400" cellspacing="0" cellpadding="0">
    <tr>
      <td>
        <div class="esq1" style="float: left;"></div>
        <div class="franja" style="float: left; width: 384px;"><div style="padding-top: 2px;">Restaurar usuario</div></div>
        <div class="esq2" style="float: left;"></div>
      </td>
    </tr>
    <tr>
      <td class="fondo_cuadro" valign="top" style="padding: 3px;">
        <form name="sticky" method="post" action="<?php echo $url; ?>/admin/desuspender.php">
          <font size="2">Nick: </font><br/>
          <input type="text" name="nick" maxlength="20" size="22" />
          <br /><br />
          <input class="submit_button" type="button" style="font-size: 11px" onclick="if(confirm('&iquest;Seguro que deseas restaurar al usuario?')) this.form.submit();" class="button" name="botonsuspender" value="Restaurar" />
        </form>
      </td>
    </tr>
  </table>
  <br /><br />
<?php
} else {
  redirect($url);
}
?>
</div>
<?php
require_once(dirname(dirname(__FILE__)) . '/footer.php');
?>