<?php
	error_reporting(E_ALL ^ E_DEPRECATED); 
	$conexion = mysql_connect("localhost","root","");
	mysql_select_db("2018",$conexion);

	
	date_default_timezone_set("America/Lima");
	$s='$';
	
	function limpiar($tags){
		$tags = strip_tags($tags);
		return $tags;
	}

	
?>