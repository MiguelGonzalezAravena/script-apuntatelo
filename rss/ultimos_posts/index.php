<?php
header('Content-Type: text/xml');
echo '<?xml version="1.0" encoding="ISO-8859-1" ?>';

require_once(dirname(dirname(dirname(__FILE__))) . '/includes/configuracion.php');
require_once(dirname(dirname(dirname(__FILE__))) . '/includes/funciones.php');

// Mostrar los últimos 10 posts
$sql = "
  SELECT * FROM posts
  WHERE elim = 0
  ORDER BY id DESC
  LIMIT 10";

$resultado = mysqli_query($con, $sql);
$description = rss_string('&Uacute;ltimos posts');

echo '
  <rss version="2.0">
    <channel>
      <title>' . rss_string($name) . ' - Tu link-sharing de apuntes</title>
      <link>' . $url . '/rss/</link>
      <language>es-CL</language>
      <description>' . $description . '</description>
      <generator>Miguelithox</generator>';

while ($row = mysqli_fetch_array($resultado)) {	
  $descripcion = substr(rss_string(BBparse($row['contenido'])), 0, 800) . '...';

  echo '
      <item>
        <title>' . rss_string($row['titulo']) . '</title>
        <link>' . $url . '/posts/' . $row['id'] . '/</link>
        <pubDate>' . $row['fecha'] . '</pubDate>
        <category>' . $row['categoria'] . '</category>
        <description><![CDATA[' . rss_string($descripcion) . ']]></description>
        <![CDATA[' . rss_string($row['contenido']) . ']]>
      </item>';
}

echo '
    </channel>
  </rss>';

?>