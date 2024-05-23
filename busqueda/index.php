<?php
// Búsqueda
require_once(dirname(dirname(__FILE__)) . '/header.php');

$bandera = 'no';
$palabra = isset($_GET['palabra']) ? no_injection($_GET['palabra']) : '';
$usuario = isset($_GET['usuario']) ? no_injection($_GET['usuario']) : '';
$categoria = isset($_GET['categoria']) ? (int) $_GET['categoria'] : '-1';
$subcategoria = isset($_GET['subcategoria']) ? (int) $_GET['subcategoria'] : '-1';
$universidad = isset($_GET['universidad']) ? (int) $_GET['universidad'] : '-1';
$orden = isset($_GET['orden']) ? (int) $_GET['orden'] : 1;
$_pagi_navegacion = '';
?>
<div class="bordes">
  <br />
  <table cellpadding="0" cellspacing="0" width="487" align="center" border="0">
    <tr>
      <td> 
        <div class="esq1" style="float: left;"></div>
        <div class="franja" style="float: left; width: 471px;"><div style="padding-top: 2px;">Buscar</div></div>
        <div class="esq2" style="float: left;"></div>
      </td>
    </tr>
    <tr>
      <td class="fondo_cuadro">
        <form name="buscar" action="<?php echo $url; ?>/busqueda/" method="get">
          <table width="300" height="50"><font size="-2"> 
            <tr>
              <td align="center" valign="middle">
                <table>
                  <tr>
                    <td valign="top">
                      <div class="size11">Buscar:</div>
                      <input type="text" name="palabra" size="30" maxlength="200" value="<?php echo $palabra; ?>" />
                    </td>
                    <td valign="top">
                      <div class="size11">Usuario:</div>
                      <input type="text" name="usuario" size="20" maxlength="200" value="<?php echo $usuario; ?>" />
                      <br /><br />
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="size11">Categor&iacute;a:</div> 
                      <select id="categoria" name="categoria" style="font-size: 12px;">
                        <option value="-1">
                          <div class="size11" style="font-weight: bold;">Todas...</div>
                        </option>
<?php
$sql = "
  SELECT id_categoria, nom_categoria
  FROM categorias
  ORDER BY nom_categoria ASC";

$request = mysqli_query($con, $sql);

while ($row = mysqli_fetch_array($request)) {
?>
                      <option value="<?php echo $row['id_categoria']; ?>"<?php echo ($categoria == $row['id_categoria'] ? ' selected="selected"' : ''); ?>><?php echo $row['nom_categoria']; ?></option>
<?php
}
?>
                      </select>
                      <br />
                      <div class="size11">Orden:</div> 
                      <select id="orden" name="orden" style="font-size: 12px;">
                        <option value="1"<?php echo ($orden == 1 ? ' selected="selected"' : ''); ?>>Fecha</option>
                        <option value="2"<?php echo ($orden == 2 ? ' selected="selected"' : ''); ?>>Puntos</option>
                        <option value="3"<?php echo ($orden == 3 ? ' selected="selected"' : ''); ?>>Visitas</option>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2" align="center">
                      <br />
                      <input type="submit" name="Submit" class="submit_button" value="Buscar" />
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table> 
        </form> 
      </td>
    </tr>
  </table>
  <br /><br />
  <table width="900" align="center" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td colspan="2"> 
        <div class="esq1" style="float: left;"></div>
        <div class="franja" style="float: left; width: 884px;"><div style="padding-top: 2px;">Posts</div></div>
        <div class="esq2" style="float: left;"></div>
      </td>
    </tr>
<?php
if ($palabra == '' && $usuario == '') {
?>
    <tr>
      <td class="fondo_cuadro" width="500" style="padding: 2px;">
        <div class="size12">Debes especificar la b&uacute;squeda</div>
      </td>
      <td class="fondo_cuadro"></td>
    </tr>
<?php
} else {
  $trozos = explode(' ', $palabra);
  $numero = count($trozos); 
  
  $sql = "
    SELECT id
    FROM usuarios
    WHERE nick = '$usuario'";

  $request = mysqli_query($con, $sql);

  if (mysqli_num_rows($request) > 0) {
    $row = mysqli_fetch_array($request);
    $id_usuario = $row['id'];
  } else {
    $id_usuario = 0;
  }
  
  if ($categoria >= 1 && $categoria <= 7 && is_numeric($categoria)) {
    $cadena_categoria = " AND categoria = '$categoria'";
  } else {
    $cadena_categoria = ' ';
  }

  if ($subcategoria >= 0 && $subcategoria <= 31 && is_numeric($subcategoria)) {
    $cadena_subcategoria = " AND subcategoria = '$subcategoria'";
  } else {
    $cadena_subcategoria = ' ';
  }

  if ($universidad >= 0 && $universidad <= 18 && is_numeric($universidad)) {
    $cadena_universidad = " AND universidad = '$universidad'";
  } else {
    $cadena_universidad = ' ';
  }

  if ($usuario != '') {
    $cadena_usuario = " AND id_autor = '$id_usuario' ";
  } else {
    $cadena_usuario = ' ';
  }
  
  switch ($orden) {
    case 1:
      $orden = 'fecha DESC,';
      break;
    case 2:
      $orden = 'puntos DESC,';
      break;
    case 3:
      $orden = 'visitas DESC,';
      break;
    default:
      $orden = '';
      break;
  }
  
  if ($numero == 1) { 
    $_pagi_sql = "
      SELECT id, id_autor, titulo, privado, fecha, puntos, categoria, c.imagen, c.link_categoria
      FROM posts AS p
      INNER JOIN categorias AS c ON p.categoria = c.id_categoria
      WHERE (titulo LIKE '%$palabra%' OR contenido LIKE '%$palabra%')
      $cadena_usuario
      AND elim = 0
      $cadena_categoria
      $cadena_subcategoria
      $cadena_universidad
      ORDER BY $orden id DESC";
  } else if ($numero > 1) {
    $longi = strlen($palabra); // Cogemos la longitud de la cadena
    // echo $longi."<br>";
    $palabra[$longi] = "$"; // Finalizamos la cadena
    $cont = 0; // Cuenta los caracteres que llevamos leidos
    $cont2 = 0; // Nos sirve para indicar en que posicion numerica empezara la siguiente cadena
    $cad = " "; // Hay que inicializarlas en blanco, sino sale la palabra "array"
    $cadena[] = " "; // Inicializamos el que va a ser el array de cadenas
    $ncadenas = 0; // Cuenta el n° de cadenas, condicionado por el espacio en blanco

    for ($x = 0; $x <= $longi; $x++) {
      if ($palabra[$x] == ' ' || $palabra[$x] == '$') { // Si encuentra espacio en blanco o fin de cadena
        $ncadenas++; // Aumentamos el n° de cadenas que vamos creando

        for ($y = 0; $y < $cont; $y++) {
          $cad[$y] = $palabra[$y + $cont2]; // Pasamos a una cadena nueva cada carater
        }

        $cad = ltrim($cad); // Eliminamos los posibles espacios en blanco al principio
        $cadena[$ncadenas] = $cad; // Pasamos cada cadena creada al final de un array de cadenas
        // echo "cadena buscada: ".$cad."<br>";
        $cont2 += $cont;
        $cont = 0; // Ponemos el contador a 0
        $cad = " "; // Hay que ponerla en blanco otra vez porque sino quedan caracteres de la ultima cadena que tuvo esta variable
      }

       // echo $cadena[$ncadenas];
       $cont++; // Aumentamos el contador
    }

    // Creamos la "super consulta"
    $_pagi_sql = "
      SELECT id, id_autor, titulo, privado, categoria, c.imagen, c.link_categoria
      FROM posts AS p
      INNER JOIN categorias AS c ON p.categoria = c.id_categoria
      WHERE";

    for ($x = 1; $x <= $ncadenas; $x++) {
       // echo $cadena[$x]; 
       $_pagi_sql .= "
        (titulo LIKE '%$cadena[$x]%' OR contenido LIKE '%$cadena[$x]%')
        AND";
      // Estos son los campos que yo use, puedes poner los que quieras 
    }

    $longiconsulta = strlen($_pagi_sql);
    $_pagi_sql = substr($_pagi_sql, 0, ($longiconsulta - 3));// Esto es para quitarle el ultimo OR
    $_pagi_sql .= $cadena_usuario . " AND elim = 0" . $cadena_categoria . " " . $cadena_subcategoria . " " . $cadena_universidad . " ORDER BY " . $orden . " id DESC"; // Para que haga la ordenacion
    $palabra = substr($palabra, 0, $longi); // Para corregir un defecto al finalizar la cadena con $
  }

  $_pagi_cuantos = 25;
  $_pagi_nav_num_enlaces = 3;
  require_once(dirname(dirname(__FILE__)) . '/includes/paginator.inc.php');

  if (mysqli_num_rows($_pagi_result) > 0) {
    while ($row = mysqli_fetch_array($_pagi_result)) {
      $privado = $row['privado'];
      $cant = strlen($row['titulo']);
      $titulo2 = $cant > 40 ? substr(stripslashes($row['titulo']), 0, 40) : $row['titulo'];
      $tit = $cant > 40 ? 1 : 0;
?>
    <tr>
      <td background="<?php echo $images; ?>/cuadro.JPG" width="440" style="padding: 2px;">
        <img src="<?php echo $images; ?>/iconos/<?php echo $row['imagen']; ?>" border="0" />
        <?php echo ($privado == 1 ? '<img src="' . $images . '/iconos/candado.gif" border="0" />' : ''); ?>
        <a href="<?php echo $url; ?>/posts/<?php echo$row['id']; ?>/<?php echo $row['link_categoria']; ?>/<?php echo corregir($row['titulo']) . '.html'; ?>">
          <font size="2" color="black"><?php echo $titulo2 . ($tit == 1 ? '...' : ''); ?></font>
        </a>
      </td>
      <td background="<?php echo $images; ?>/cuadro.JPG" align="right" style="padding: 2px;">
        <font size="1">
          Puntos:
          <?php echo $row['puntos']; ?>
          |
          Fecha:
          <?php echo date("d-m-Y H:m:s", strtotime($row['fecha']))?>&nbsp;
        </font>
      </td>
    </tr>
<?php
    }

    $bandera = 'si';
  }

  if ($bandera == 'no') {
?>
    <tr class="fondo_cuadro">
      <td width="500" style="padding: 2px;">
        <div class="size12">&iexcl;No se ha encontrado ning&uacute;n registro!</div>
      </td>
      <td></td>
    </tr>
<?php
  }
}
?>
    <tr>
      <td></td>
      <td>
        <div align="right">
<?php
echo '<p><font size="1">' . $_pagi_navegacion . '</p>'; 
?>
        </div>
      </td>
    </tr>
  </table>
  <br /><br /><br />
</div>
<?php
require_once(dirname(dirname(__FILE__)) . '/footer.php');
?>