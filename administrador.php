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
		$palabra=explode(" ", $nombre);
		$nomb=$palabra[0];
		
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Instituto Mario Gutiérrez López de Orcotuna</title>

    <style type="text/css">
      body {
    background-image: url(img/f1.png);
      }
    </style>
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
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="img/log0.jpg">

</head>
<body data-spy="scroll" data-target=".bs-docs-sidebar">

	<!-- Navbar
    ================================================== -->
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active">
                <a href="admin_pre.php" target="admin"><strong>Principal</strong></a>
              </li>
              <li class="active">
                <a href="alumno.php" target="admin"><strong>Alumnos</strong></a>
              </li>
              <li class="active">
                <a href="Profesores.<?php  ?>" target="admin"><strong>Profesores</strong></a> <!--cambiado-->
              </li>
              <li class="active">
                <a href="materias.php" target="admin"><strong>Materias/Carreras</strong></a>
              </li>
              <li class="active">
                <a href="cursos.php" target="admin"><strong>Cursos</strong></a>
              </li>
               <li class="active">
                <a href="miscursos.php" target="admin"><strong>Mis Cursos</strong></a>
              </li>
            </ul>
          <!-- lado derecho --->
            <ul class="nav pull-right">
            <li id="fat-menu" class="dropdown active">
              <a href="#" id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown"><strong>Hola! <?php echo $nomb; ?></strong> <b class="caret"></b></a>
              <ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
                <li role="presentation"><a role="menuitem" tabindex="-1" href="cambiar_clave.php" target="admin">Cambiar Contraseña</a></li>
                <li role="presentation" class="divider"></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="php_cerrar.php"><i class="icon-off"></i> Salir</a></li>
              </ul>
            </li>
          </ul>
          <!--========================================================-->
          </div>
        </div>
      </div>
    </div>
	<!-- Navbar ================================================== -->
    <div align="center">
        <table width="95%" border="0">
          <tr>
            <td>
            	<iframe src="admin_pre.php" name="admin" frameborder="0" scrolling="auto" width="100%" height="900"></iframe>
            </td>
          </tr>
        </table>
	</div>
</body>
</html>