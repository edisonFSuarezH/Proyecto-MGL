<?php
 		session_start();
		include_once('php_conexion.php'); 
		include_once('class/funciones.php');
		include_once('class/class.php');
		if($_SESSION['tipo_usu']=='a'){
		}else{
			header('location:error.php');
		}
		function numero_alumnos($salon){
			$total=0;
			$pa=mysql_query("SELECT * FROM salon_alum WHERE salon='$salon'");
			while($dat=mysql_fetch_array($pa)){
				$total=$total+1;
			}
			return $total;
		}
		function existe_alumno($nit,$salon){
			$pa=mysql_query("SELECT * FROM salon_alum WHERE alumno='$nit'");
			if($dat=mysql_fetch_array($pa)){
				return 1;
			}else{
				return 0;
			}
		}
		if(!empty($_POST['nit']) and !empty($_POST['semestre']) and !empty($_POST['tipo'])){
			$semestre=$_POST['semestre'];				$tipo=$_POST['tipo'];
			$nit=$_POST['nit'];							$anno=date('Y');
			$objAlumno=new Consultar_Alumno($nit);
			$objCarrera=new Consultar_Carrera($objAlumno->consultar('carrera'));
		}else{
			header('location:error.php');
		}
		#################### GUARDAR EN TABLA YA_MATRI #########################
		$tmpa=mysql_query("SELECT * FROM tmp_asig WHERE alumno='$nit'");
		while($date=mysql_fetch_array($tmpa)){
			$mate=$date['mate'];
			#E=estudiando,C=cancelado,F=finalizado
			mysql_query("INSERT INTO ya_matri (mate, alumno, semestre, tipo, anno, estado, notaf) 
									VALUES ('$mate','$nit','$semestre','$tipo','$anno','E','0')");
			
		}
		#################### asignar salon #####################################
		$limite=5;
		$tmpa=mysql_query("SELECT * FROM tmp_asig WHERE alumno='$nit'");
		while($date=mysql_fetch_array($tmpa)){
			$id_mate=$date['mate'];
			$pa=mysql_query("SELECT * FROM cursos WHERE materia='$id_mate' and estado='s'");
			while($dat=mysql_fetch_array($pa)){
				$id_curso=$dat['id'];
				if(numero_alumnos($id_curso)<=$limite){
					
					$p=mysql_query("SELECT * FROM salon_alum WHERE salon='$id_curso' and estado='s'");
					if($d=mysql_fetch_array($p)){
						mysql_query("INSERT INTO salon_alum (salon, alumno, semestre, tipo, anno) VALUES ('$id_curso','$nit','$semestre','$tipo','$anno')");		
						break;				
					}
				}
			}
		}
		
		$objAlumno=new Consultar_Alumno($nit);
		$objCarrera=new Consultar_Carrera($objAlumno->consultar('carrera'));
				
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
       	    <div class="row-fluid">
	            <div class="span6">
                	<h3 class="text-info"><img src="img/log0.jpg" class="img-circle" width="100" height="100"> 
					<?php echo $objAlumno->consultar('nombre').' '.$objAlumno->consultar('apellido'); ?> | 
                    <?php echo $objCarrera->consultar('nombre'); ?></h3>
                </div>
    	        <div class="span6">
                	<strong>
						<?php echo tiempo($tipo).' '.$anno; ?> <br>
                        <strong>Semestre Numero</strong> <?php echo $semestre; ?><br>
                        <strong>Total Creditos</strong> <span class="badge badge-success"><?php echo $_POST['tcredito'] ?></span><br>
                        <strong>Valor Semestre</strong> $ <?php echo formato($_POST['tvalor']); ?>
                    </strong>
                </div>
            </div>
        	
        </td>
      </tr>
    </table>
    <table class="table table-bordered table table-hover">
      <tr class="info">
        <td><strong class="text-info">Materia</strong></td>
        <td><strong class="text-info"><center>Creditos</center></strong></td>
        <td><div align="right"><strong class="text-info">Valor</strong></div></td>
        <td><strong class="text-info"><center>Salon</center></strong></td>
        <td><strong class="text-info">Decano</strong></td>
      </tr>
      <?php
	  	$pa=mysql_query("SELECT * FROM salon_alum WHERE alumno='$nit' and semestre='$semestre' and anno='$anno' and tipo='$tipo'");
		while($dat=mysql_fetch_array($pa)){
			$objCurso=new Consultar_Cursos($dat['salon']);
			$objMateria=new Consultar_Materias($objCurso->consultar('materia'));
			$objProfesor=new Consultar_Profesor($objMateria->consultar('director'));
			
	  ?>
      <tr>
        <td><i class="icon-book"></i> <?php echo $objMateria->consultar('nombre'); ?></td>
        <td><center><span class="badge badge-success"><?php echo $objMateria->consultar('creditos'); ?></span></center></td>
        <td><div align="right">$ <?php echo formato($objMateria->consultar('valor')); ?></div></td>
        <td><center><?php echo $objCurso->consultar('nombre'); ?></center></td>
        <td><?php echo $objProfesor->consultar('nombre'); ?></td>
      </tr>
      <?php } ?>
    </table>
    <?php
		mysql_query("DELETE FROM tmp_asig WHERE alumno='$nit'");	
	?>
</body>
</html>