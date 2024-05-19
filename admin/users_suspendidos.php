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
    <font size="2" color="green">
<?php
switch($action) {
  case 'correcto':
    echo 'El usuario ha sido suspendido.';
    break;
  case 'correcto2':
    echo 'El usuario ha sido restaurado.';
    break;
}
?>
    </font>
    <font size="2" color="red">
<?php
switch($action) {
  case 'error':
    echo 'El usuario se encuentra suspendido. Revise el historial del mismo.';
    break;
  case 'error2':
    echo 'No existe el usuario.';
    break;
  case 'error3':
    echo 'El usuario NO se encuentra suspendido.';
    break;
  case 'error4':
    echo 'Operaci&oacute;n no v&aacute;lida. Revisa no haber dejado alguno de los campos vac&iacute;os.';
    break;
}
?>
    </font>
<?php
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
                Nick: <input type="text" name="palabra" size="20" MAXLENGTH="200" value="<?php echo $a?>"><br><br>
                <input type="radio" name="tipo" value="ultimos" <?php if ($tipo!="usuario" && $tipo!="moderador") echo "checked"?>>&Uacute;ltimos
                <input type="radio" name="tipo" value="usuario" <?php if ($tipo=="usuario") echo "checked"?>>Usuario 
                <input type="radio" name="tipo" value="moderador" <?php if ($tipo=="moderador") echo "checked"?>>Moderador
                <br><br>
                <input type="hidden" name="var" value="1">
                <input type="submit" name="Submit" class="submit_button" value="Ver/Buscar" />
                </font>
              </td>
            </tr>
      </table> 
      </div>
      </form> 
      </td>
      </tr>
    </table>
    <br />
<table align="center" width="900" cellspacing="0" cellpadding="0">
  <tr>
    <td>
      <div class="esq1" style="float: left;"></div>
      <div class="franja" style="float: left; width: 884px;"><div style="padding-top: 2px;">Historial de suspensi&oacute;n <?php if ($tipo=="usuario") echo "de ".$a; if($tipo=="moderador") echo "realizado por ".$a; ?></div></div>
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
          &nbsp;<font size="2" color="black"><b>User</b></font>
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
      <font size="1" color="black">&nbsp;<?php echo $activo; ?></font>
      </td>
      <td>
      &nbsp;<font size="1" color="black"><?php echo $nick; ?></font>
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
?>
<script>alert("El usuario <?php echo $a; ?> no existe!");</script>
<?php
  }
  mysqli_close($con);
}
?>
</table>
</td>
</tr>
</table>
<br>
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
&nbsp;<font size="2">Nick: </font><br><input type="text" name="nick" maxlength="20" size="22"><br><br>
&nbsp;<font size="2">Especificaciones: </font><br><textarea name="razon" rows="10" cols="40"></textarea><br><br>
<INPUT class="submit_button" type="button" style="font-size: 11px" onclick="if(confirm('&iquest;Seguro queres suspender al usuario?'))this.form.submit();" class="button" NAME='botonsuspender' VALUE='Suspender'>
</form>
</td>
</tr>
<tr>
<td>
</td>
</tr>
</table>
<br>
<table align="center" width="400" cellspacing="0" cellpadding="0">
<tr>
<td>
  <div class="esq1" style="float: left;"></div>
  <div class="franja" style="float: left; width: 384px;"><div style="padding-top:2px;">Restaurar usuario</div></div>
  <div class="esq2" style="float: left;"></div>
</td>
</tr>
<tr>
<td class="fondo_cuadro" valign="top" style="padding: 3px;">
<form name="sticky" method="post" action="<?php echo $url; ?>/admin/desuspender.php">
&nbsp;<font size="2">Nick: </font><br><input type="text" name="nick" maxlength="20" size="22"><br><br>
<INPUT class="submit_button" type="button" style="font-size: 11px" onclick="if(confirm('&iquest;Seguro queres restaurar al usuario?'))this.form.submit();" class="button" NAME='botonsuspender' VALUE='Restaurar'>
</form>
</td>
</tr>
</table>
<br><br>
<?php
} else {
?>
<script type="text/javascript">
  location.href = '..';
</script>
<?php
}
?>
</div>
<?php
require_once(dirname(dirname(__FILE__)) . '/footer.php');
?>
</body>
</html>
