<?php
	
	$conexion = mysql_connect("localhost","root","");
	mysql_select_db("sistema",$conexion);
	date_default_timezone_set("America/Lima");
    mysql_query("SET NAMES utf8");
	mysql_query("SET CHARACTER_SET utf");
	$s='Bs';
	
	function limpiar($tags){
		$tags = strip_tags($tags);
		$tags = stripslashes($tags);
		$tags = htmlentities($tags);
		return $tags;
	}

	
?>