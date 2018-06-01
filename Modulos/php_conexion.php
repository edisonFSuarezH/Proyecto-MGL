<?php
	error_reporting(E_ALL ^ E_DEPRECATED);
	$conexion = mysql_connect("localhost","root","");
	mysql_select_db("2013curso",$conexion);
	date_default_timezone_set("America/Lima");
    mysql_query("SET NAMES utf8");
	mysql_query("SET CHARACTER_SET utf");
	$s='Bs';
	
	$paa=mysql_query("SELECT * FROM empresa WHERE id=1");					
	if($dato=mysql_fetch_array($paa)){
		$maxima_nota=$dato['maxima'];
		$minima_nota=$dato['minima'];
	}
	
	
	function limpiar($tags){
		

		return $tags;
	}

	
?>