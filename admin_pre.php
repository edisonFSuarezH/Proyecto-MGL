<?php
 		session_start();
		include_once('php_conexion.php'); 
		include_once('class/funciones.php');
		include_once('class/class.php');
		if($_SESSION['tipo_usu']=='a'){
		}else{
			header('location:error.php');
		}
		
		$usuario=limpiar($_SESSION['username']);
		$objUsuario=new Consultar_Profesor($usuario);
		$nombre=$objUsuario->consultar('nombre');
		$nombre=ucwords(strtolower($nombre));
		
		$can=mysql_query("SELECT COUNT(nombre)as numero FROM profesor");
		if($dato=mysql_fetch_array($can)){
			$n_profesor=$dato['numero'];
		}
		$can=mysql_query("SELECT COUNT(nombre)as numero FROM materias");
		if($dato=mysql_fetch_array($can)){
			$n_materias=$dato['numero'];
		}
		$can=mysql_query("SELECT COUNT(nombre)as numero FROM alumnos");
		if($dato=mysql_fetch_array($can)){
			$n_alumno=$dato['numero'];
		}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Blanco</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
    <link href="css/docs.css" rel="stylesheet">
    <link href="js/google-code-prettify/prettify.css" rel="stylesheet">
    <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
	<script src="js/jquery.js"></script>
    <script src="js/bootstrap-transition.js"></script>
    <script src="js/bootstrap-alert.js"></script>
    <script src="js/bootstrap-modal.js"></script>
    <script src="js/bootstrap-dropdown.js"></script>
    <script src="js/bootstrap-scrollspy.js"></script>
    <script src="js/bootstrap-tab.js"></script>
    <script src="js/bootstrap-tooltip.js"></script>
    <script src="js/bootstrap-popover.js"></script>
    <script src="js/bootstrap-button.js"></script>
    <script src="js/bootstrap-collapse.js"></script>
    <script src="js/bootstrap-carousel.js"></script>
    <script src="js/bootstrap-typeahead.js"></script>
    <script src="js/bootstrap-affix.js"></script>
    <script src="js/holder/holder.js"></script>
    <script src="js/google-code-prettify/prettify.js"></script>
    <script src="js/application.js"></script>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="assets/ico/favicon.png">

</head>
<body data-spy="scroll" data-target=".bs-docs-sidebar">
<table class="table table-bordered">
  <tr class="info">
    <td>
    	<center><h3 class="text-info"><img src="img/mm.png" class="img-circle" width="80" height="80"> 
        Bienvenido Administrador/a "<?php echo $nombre; ?>"</h3></center>
    </td>
  </tr>
</table>
    <div class="row-fluid" align="center">
        <div class="span4">
        	<h3 align="center">Profesores</h3>
            <img src="img/log0.jpg" style="width: 200px; height: 200px;" title="Profesores"><br>
            <h3>Registrados: <?php echo $n_profesor; ?></h3><br>
            <a href="profesores.php" class="btn btn-large btn-block btn-primary" type="button"><strong>Ver Mas Informacion</strong></a>
        </div>
        <div class="span4">
        	<h3 align="center">Materias</h3>
            <img src="img/log0.jpg" style="width: 200px; height: 200px;" title="Materias"><br>
            <h3>Registradas: <?php echo $n_materias; ?></h3><br>
            <a href="materias.php" class="btn btn-large btn-block btn-primary" type="button"><strong>Ver Mas Informacion</strong></a>
        </div>
        <div class="span4">
        	<h3 align="center">Alumnos</h3>
            <img src="img/log0.jpg" style="width: 200px; height: 200px;" title="Alumnos"><br>
            <h3>Registrados: <?php echo $n_alumno; ?></h3><br>
            <a href="alumno.php" class="btn btn-large btn-block btn-primary" type="button"><strong>Ver Mas Informacion</strong></a>
        </div>
    </div>
</body>
</html>