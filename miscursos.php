<?php
 		session_start();
		include_once('php_conexion.php'); 
		include_once('class/funciones.php');
		include_once('class/class.php');
		if($_SESSION['tipo_usu']=='a' or $_SESSION['tipo_usu']=='p'){
		}else{
			header('location:error.php');
		}
		$usuario=limpiar($_SESSION['username']);
		$objProfesor=new Consultar_Profesor($usuario);
		$nit=$objProfesor->consultar('nit');
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
<div align="center">
    <table width="80%" border="0">
      <tr>
        <td>
       	  	<div class="row-fluid">
            	<div class="span6">
                    <table class="table table-bordered">
                      <tr class="info">
                        <td colspan="2"><center><strong>Mis Cursos - Tutor</strong></center></td>
                      </tr>
                      <tr class="info">
                        <td width="50%"><center><strong>Materia</strong></center></td>
                        <td width="50%"><center><strong>Salon</strong></center></td>
                      </tr>
                      <?php 
                        $can1=mysql_query("SELECT * FROM cursos WHERE encargado='$nit'");
                        while($info=mysql_fetch_array($can1)){
                            $objMateria=new Consultar_Materias($info['materia']);
                      ?>
                      <tr>
                        <td><center><?php echo $objMateria->consultar('nombre'); ?></center></td>
                        <td><center><?php echo $info['nombre']; ?></center></td>
                      </tr>
                      <?php } ?>
                    </table>
                </div>
            	<div class="span6">
                    <table class="table table-bordered">
                      <tr class="info">
                        <td colspan="2"><center><strong>Mis Cursos - Decano</strong></center></td>
                      </tr>
                      <tr class="info">
                        <td colspan="2"><center><strong>Materia</strong></center></td>
                      </tr>
                      <?php 
                        $can1=mysql_query("SELECT * FROM materias WHERE director='$nit'");
                        while($info=mysql_fetch_array($can1)){
							$url=cadenas().encrypt($info['id'],'URLCODIGO');
                      ?>
                      <tr>
                        <td>
                        	<center>
								<?php echo $info['nombre']; ?>
                            </center>
                        </td>
                        <td>
                        	<center>
                                <a href="material.php?id=<?php echo $url; ?>" class="btn btn-mini"><strong>Materiales</strong></a>
                                <a href="actividad.php?id=<?php echo $url; ?>" class="btn btn-mini"><strong>Actividades</strong></a>
                            </center>
                        </td>
                      </tr>
                      <?php } ?>
                    </table>
                </div>
            </div>
        	
            
            

        </td>
      </tr>
    </table>
</div>
</body>
</html>