<?
header('Content-Type: text/xml'); //Indicamos al navegador que es un documento en XML
//Versi�n y juego de car�cteres de nuestro documento
echo '<?xml version="1.0" encoding="iso-8859-1"?>';
include('../../includes/configuracion.php');
include('../../includes/funciones.php');
//Hacemos la consulta y la ordenamos por post para mostrar siempre el �ltimo
$resultado = mysql_query("select * from posts where elim=0s order by id DESC limit 10",$con);
	//"Cortaremos" el art�culo en 300 caracteres para nuestra descripci�n
	// Y generamos nuestro documento
echo '
<rss version="2.0">
	<channel>
    	<title>Apuntatelo - Tu link-sharing de apuntes</title>
    	<link>http://extremezone.sytes.net/rss/</link>
    	<language>es-CL</language>
    	<description>�ltimos Posts</description>
    	<generator>Miguelithox</generator>
';
	while ($row = mysql_fetch_array($resultado))
	{	
		$descripcion = substr(amp(BBparse($row['contenido'])),0,800)."...";
		echo'
			<item>
				<title>'.amp($row['titulo']).'</title>
				<link>http://extremezone.sytes.net/posts/'.$row[id].'/</link>
				<pubDate>'.$row[fecha].'</pubDate>
				<category>'.$row[categoria].'</category>
				<description><![CDATA['.$descripcion.']]></description>
				<![CDATA['.amp($row[contenido]).']]>
			</item>
		';
	}
echo '
	</channel>
</rss>';
?> 
