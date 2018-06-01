<?php
include_once('funciones.php');
class Consultar_Alumno{
	
	private $consulta;
	private $fetch;
	
	function __construct($codigo){
		$this->consulta = mysql_query("SELECT * FROM alumnos WHERE nit='$codigo' or nombre='$codigo' or apellido='$codigo'");
		$this->fetch = mysql_fetch_array($this->consulta);
	}
	
	function consultar($campo){
		return $this->fetch[$campo];
	}
}
class Consultar_tCarrera{
	
	private $consulta;
	private $fetch;
	
	function __construct($codigo){
		$this->consulta = mysql_query("SELECT * FROM tcarrera WHERE id='$codigo' or nombre='$codigo'");
		$this->fetch = mysql_fetch_array($this->consulta);
	}
	
	function consultar($campo){
		return $this->fetch[$campo];
	}
}
class Consultar_Carrera{
	
	private $consulta;
	private $fetch;
	
	function __construct($codigo){
		$this->consulta = mysql_query("SELECT * FROM carreras WHERE id='$codigo' or nombre='$codigo' or tipo='$codigo'");
		$this->fetch = mysql_fetch_array($this->consulta);
	}
	
	function consultar($campo){
		return $this->fetch[$campo];
	}
}
class Consultar_Profesor{
	
	private $consulta;
	private $fetch;
	
	function __construct($codigo){
		$this->consulta = mysql_query("SELECT * FROM profesor WHERE nit='$codigo' or nombre='$codigo' or usu='$codigo'");
		$this->fetch = mysql_fetch_array($this->consulta);
	}
	
	function consultar($campo){
		return $this->fetch[$campo];
	}
}
class Consultar_Cursos{
	
	private $consulta;
	private $fetch;
	
	function __construct($codigo){
		$this->consulta = mysql_query("SELECT * FROM cursos WHERE id='$codigo' or nombre='$codigo'");
		$this->fetch = mysql_fetch_array($this->consulta);
	}
	
	function consultar($campo){
		return $this->fetch[$campo];
	}
}

class Consultar_Materias{
	
	private $consulta;
	private $fetch;
	
	function __construct($codigo){
		$this->consulta = mysql_query("SELECT * FROM materias WHERE id='$codigo' or director='$codigo' or nombre='$codigo'");
		$this->fetch = mysql_fetch_array($this->consulta);
	}
	
	function consultar($campo){
		return $this->fetch[$campo];
	}
}
############################################################################################################################################
class Proceso_Alumno{
	var $id;		var $nit;		var $nombre;	var $apellido;		var $ciudad;
	var $correo;	var $con;		var $carrera;	var $direccion;
	
	function __construct($id, $nit, $nombre, $apellido, $ciudad, $correo, $con, $carrera,$direccion){
		$this->id=$id;				$this->nit=$nit; 			$this->nombre=$nombre;		$this->apellido=$apellido;
		$this->ciudad=$ciudad;		$this->correo=$correo;		$this->con=$con;			$this->carrera=$carrera;
		$this->direccion=$direccion;
	}
	
	function crear(){
		$nit=$this->nit;			$nombre=$this->nombre;		$apellido=$this->apellido;		$correo=$this->correo;
		$ciudad=$this->ciudad;		$con=$this->con;			$estado='s';					$tipo='alumno';			
		$carrera=$this->carrera;	$direccion=$this->direccion;
		mysql_query("INSERT INTO alumnos (nit, nombre, apellido, ciudad, correo, con, tipo, estado, carrera, direccion) 
		VALUES ('$nit','$nombre','$apellido','$ciudad','$correo','$con','$tipo','$estado','$carrera','$direccion')");
	}
	function actualizar(){
		$nit=$this->nit;			$nombre=$this->nombre;		$apellido=$this->apellido;		$correo=$this->correo;
		$ciudad=$this->ciudad;		$con=$this->con;			$id=$this->id;					$carrera=$this->carrera;
		$direccion=$this->direccion;
		mysql_query("UPDATE alumnos SET nombre='$nombre',
										apellido='$apellido',
										correo='$correo',
										ciudad='$ciudad',
										carrera='$carrera',
										direccion='$direccion'
									WHERE id=$id");
	}
	
}

class Proceso_Profesor{
	var $id;		var $nit;		var $nombre;	var $localidad;		var $correo;
	var $celular;	var $usu;		var $con;		var $tipo;
	
	function __construct($id, $nit, $nombre, $localidad, $correo, $celular, $usu, $con, $tipo){
		$this->id=$id;				$this->nit=$nit; 			$this->nombre=$nombre;		$this->localidad=$localidad;
		$this->celular=$celular;	$this->usu=$usu;			$this->con=$con;			$this->correo=$correo;
		$this->tipo=$tipo;
	}
	
	function crear(){
		$nit=$this->nit;			$nombre=$this->nombre;		$localidad=$this->localidad;	$correo=$this->correo;
		$celular=$this->celular;	$usu=$this->usu;			$con=$this->con;				$tipo=$this->tipo;			
		$estado='s';	$tipo=$tipo;
		mysql_query("INSERT INTO profesor (nit, nombre, localidad, correo, celular, estado, tipo, usu, con)
		VALUES ('$nit','$nombre','$localidad','$correo','$celular','$estado','$tipo','$usu','$con')");
	}
	function actualizar(){
		$nit=$this->nit;			$nombre=$this->nombre;		$localidad=$this->localidad;	$correo=$this->correo;	
		$celular=$this->celular;	$id=$this->id;					$tipo=$this->tipo;
		$tipo=$tipo;
		mysql_query("UPDATE profesor    SET	nombre='$nombre',
											localidad='$localidad',
											correo='$correo',
											celular='$celular',
											tipo='$tipo'
									 	WHERE id=$id");
	}
	
}

class Proceso_Cursos{
	var $nombre;	var $encargado;	var $materia;	var $id;
	
	function __construct($nombre, $materia, $encargado, $id){
		$this->nombre = $nombre; 		$this->encargado = $encargado;	$this->materia=$materia;	$this->id = $id;
	}
	
	function crear(){
		$nombre=$this->nombre;		$encargado=$this->encargado;	$materia=$this->materia;	
		mysql_query("INSERT INTO cursos (nombre, materia, encargado, estado) VALUES ('$nombre','$materia','$encargado','s')");
	}
	
	function actualizar(){
		$nombre=$this->nombre;	$encargado=$this->encargado;	$materia=$this->materia;	$id=$this->id;
		mysql_query("Update cursos Set nombre='$nombre', materia='$materia', encargado='$encargado' Where id=$id");
	}	
}

class Proceso_Carrera{
	var $nombre;	var $tipo;	var $id;
	
	function __construct($nombre, $tipo, $id){
		$this->nombre = $nombre; 		$this->tipo = $tipo;	$this->id = $id;
	}
	
	function crear(){
		$nombre=$this->nombre;		$tipo=$this->tipo;
		mysql_query("INSERT INTO carreras (nombre, tipo, estado) VALUES ('$nombre','$tipo','s')");
	}
	
	function actualizar(){
		$nombre=$this->nombre;	$tipo=$this->tipo;	$id=$this->id;
		mysql_query("Update carreras Set nombre='$nombre', tipo='$tipo' Where id=$id");
	}	
}

class Proceso_Materias{
	var $nombre;	var $director;	var $id; var $credito;	var $valor;
	
	function __construct($nombre, $director, $credito, $id, $valor){
		$this->nombre = $nombre; 		$this->director = $director;	$this->credito = $credito;		$this->id = $id;
		$this->valor = $valor;
	}
	
	function crear(){
		$nombre=$this->nombre;	$director=$this->director;	$credito=$this->credito;	$valor=$this->valor;
		mysql_query("INSERT INTO materias (nombre, director, creditos, valor, estado) VALUES ('$nombre','$director','$credito','$valor','s')");
	}
	
	function actualizar(){
		$nombre=$this->nombre;	$director=$this->director;	$credito=$this->credito;	$id=$this->id;	$valor=$this->valor;
		mysql_query("Update materias Set nombre='$nombre', director='$director', creditos='$credito', valor='$valor' Where id=$id");
	}	
}

?>

