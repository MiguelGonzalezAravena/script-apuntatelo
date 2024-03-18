<?php
session_start();
// Comprobamos si existe sesión
if(isset($_SESSION['user'])) 
{
	$user=$_SESSION['user'];
	$query = mysql_query("SELECT id_extreme, ban FROM usuarios WHERE nick='$user'") or die(mysql_error());
	$data = mysql_fetch_array($query);
	if($data['ban']!=0 or $data['id_extreme'] != $_SESSION['id2'] )
	{
		$_SESSION['user'] = null;
		$_SESSION['id'] = null;
		$_SESSION['id2'] = null;
		unset($_SESSION);
		session_destroy();
	}
}
//Comprobamos si hay cookie, si está bien y le asignamos una sesión
if(isset($_COOKIE['id_extreme'])) 
{
   	$cookie = mysql_real_escape_string($_COOKIE['id_extreme']);
  	$cookie = explode("%",$cookie);
	$user = $cookie[0];
	$id = $cookie[1];
	$ip = $cookie[2];
	if ($HTTP_X_FORWARDED_FOR == "")
	{
		$ip2 = getenv(REMOTE_ADDR);
	}
	else
	{
		$ip2 = getenv(HTTP_X_FORWARDED_FOR);
	}
	if($ip == $ip2)
	{
		$query = mysql_query("SELECT * FROM usuarios WHERE id_extreme='".$id."' and id='".$user."'") or die(mysql_error());
   		$data = mysql_fetch_array($query);
   		if(isset($data['nick']) and $data['ban'] == 0 ) 
		{
      		$_SESSION['user'] = $data['nick'];
			$_SESSION['id'] = $data['id'];
			$_SESSION['id2'] = $data['id_extreme'];
			return true;
   		}
	}
}
?>