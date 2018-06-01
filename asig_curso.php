<?php
 		session_start();
		include_once('php_conexion.php'); 
		include_once('class/funciones.php');
		include_once('class/class.php');
		if($_SESSION['tipo_usu']=='a'){
		}else{
			header('location:error.php');
		}
		function existe_mate($materia,$nit){#verifica si existe en tabla temporal
			$tmpa=mysql_query("SELECT * FROM tmp_asig WHERE mate='$materia' and alumno='$nit'");
			if($date=mysql_fetch_array($tmpa)){	return 1;	}else{	return 0;	}
		}
		
		function existe_yamatri($materia,$nit){#verifica si esta matriculada
			$tmpa=mysql_query("SELECT * FROM ya_matri WHERE mate='$materia' and alumno='$nit'");
			if($date=mysql_fetch_array($tmpa)){	return 1;	}else{	return 0;	}
		}
		
		function mate_matri($materia,$nit){
			$tmpa=mysql_query("SELECT * FROM ya_matri WHERE mate='$materia' and alumno='$nit'");
			if($date=mysql_fetch_array($tmpa)){
				if($date['estado']=='E'){#ESTUDIANDO
					return '<center><abbr title="Estudiando"><i class="icon-ok"></i></abbr></center>';
				}elseif($date['estado']=='C'){#CANCELADO
					return '<center><abbr title="Materia Cancelada"><i class="icon-remove"></i></abbr></center>';
				}elseif($date['estado']=='F'){
					return '<center><abbr title="Nota Final"><strong>'.$date['notaf'].'</strong></abbr></center>';
				}
			}
		}
		if(!empty($_GET['codigo'])){
			$nit=$_GET['codigo'];
			$objAlumno=new Consultar_Alumno($nit);
			$objCarrera=new Consultar_Carrera($objAlumno->consultar('carrera'));
		}
		if(!empty($_GET['xyz'])){
			$id_mate=$_GET['xyz'];			
			if(existe_mate($id_mate,$nit)==0){
				mysql_query("INSERT INTO tmp_asig (alumno, mate) VALUES ('$nit','$id_mate')");
			}
			header('location:asig_curso.php?codigo='.$nit);
		}
		if(!empty($_GET['eli'])){
			$id_borra=$_GET['eli'];
			mysql_query("DELETE FROM tmp_asig WHERE id=$id_borra");
			header('location:asig_curso.php?codigo='.$nit);
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
	<strong>
        <a href="alumno.php" title="Regresar al Listado de Alumnos">Alumno</a> >> 
        <a href="asig_curso.php?codigo=<?php echo $nit; ?>">Asignffdar Cursos</a>
    </strong>
    <table class="table table-bordered">
      <tr class="info">
        <td>
        	<h3 class="text-info"><img src="img/log0.jpg" class="img-circle" width="100" height="100"> 
            <?php echo $objAlumno->consultar('nombre').' '.$objAlumno->consultar('apellido'); ?> | 
            <?php echo $objCarrera->consultar('nombre'); ?></h3>
        </td>
      </tr>
    </table>
    
    <div class="row-fluid">
	    <div class="span6">
        	<div id="" style="overflow:scroll; height:400px;">
           	<table class="table table-bordered table table-hover">
              <tr class="info">
                <td colspan="4"><center><strong class="text-info">Materias Disponibles</strong></center></td>
              </tr>
              <tr>
				<td><strong>Nombre Materia</strong></td>
				<td><center><strong>Creditos</strong></center></td>
				<td><center><strong>Valor</strong></center></td>
				<td>&nbsp;</td>
			  </tr>
              <?php	
				$carrera=$objAlumno->consultar('carrera');
				$sqls=mysql_query("SELECT * FROM detalle_carrera WHERE carrera=$carrera");
				if($info=mysql_fetch_array($sqls)){
					echo '';
					$n=mysql_query("SELECT MAX(semestre) AS ms FROM detalle_carrera WHERE carrera=$carrera");
					if($ns=mysql_fetch_array($n)){
						$max_seme=$ns['ms'];
					}
					for($x=1;$x<=$max_seme;$x=$x+1){
						echo '<tr><td colspan="4"><strong>Semestre '.$x.'</strong></td></tr>';
						$a=mysql_query("SELECT * FROM detalle_carrera WHERE carrera=$carrera and semestre=$x");
						while($date=mysql_fetch_array($a)){
							$objMateria=new Consultar_Materias($date['materia']);
							echo '<tr>
									<td><i class="icon-chevron-right"></i> '.$objMateria->consultar('nombre').'</td>
									<td><center>'.$objMateria->consultar('creditos').'</center></td>
									<td><div align="right">$ '.formato($objMateria->consultar('valor')).'</div></td>
									<td>';
									if(existe_yamatri($date['materia'],$nit)==0){									
										if(existe_mate($date['materia'],$nit)==0){
											echo '<div align="right">
											<a href="asig_curso.php?codigo='.$nit.'&xyz='.$date['materia'].'" 
											class="btn btn-mini" title="Ingresar Materia">
												<i class="icon-fast-forward"></i>
											</a>
											</div>';
										}else{
											echo '<center><i class="icon-ok"></i></center>';		
										}
									}else{
										echo mate_matri($date['materia'],$nit);
									}
							echo '
									</td>
								  </tr>';
						}
					}
				}else{
					echo '	<div class="alert alert-error" align="center">
								<strong>No hay Materias Asignadas para esta Carrera</strong>
							</div>';
				}
				
					?>
              
            </table>
            </div>
    	</div>
        <div class="span6">
           <table class="table table-bordered table table-hover">
             <tr class="info">
                <td colspan="4"><center><strong class="text-info">Materias Asignadas</strong></center></td>
              </tr>
              <tr>
				<td colspan="4">
                	 <?php
					 	$tcredito=0;$tvalor=0;
						$tmpa=mysql_query("SELECT * FROM tmp_asig WHERE alumno='$nit'");
						while($date=mysql_fetch_array($tmpa)){
							$objMa=new Consultar_Materias($date['mate']);
							$tcredito=$tcredito+$objMa->consultar('creditos');
							$tvalor=$tvalor+$objMa->consultar('valor');
						}
					  ?>
               	    <div class="row-fluid">
	                    <div class="span4" align="center">
                        	Total Creditos: <span class="badge badge-success"><?php echo $tcredito; ?></span>
                        </div>
    	                <div class="span4" align="center">
                        	Valor Total: $ <?php echo formato($tvalor); ?>
                        </div>
                        <div class="span4" align="center">
                        	<?php
								if($tvalor==0 and $tcredito==0){
								}else{
									echo '	<a href="#guardar" role="button" class="btn btn-info" data-toggle="modal">
												<strong><i class="icon-ok"></i> Finalizar y Guardar</strong>
											</a>';
								}
							?>
                        </div>
                    </div>
                    <!--MODAL PARA FINALIZAR-->
                    <div id="guardar" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    	<form name="form3" method="post" action="asig_salon.php" class="form-inline">
                        <input type="hidden" name="nit" value="<?php echo $nit; ?>">
                        <input type="hidden" name="tcredito" value="<?php echo $tcredito; ?>">
                        <input type="hidden" name="tvalor" value="<?php echo $tvalor; ?>">
                   	 	<div class="modal-header">
                    		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        	<h3 id="myModalLabel">Finalizar Asignaciones</h3>
                        </div>
                        <div class="modal-body">
                    	    <div class="row-fluid">
                                <div class="span6">
                                	<strong>Total Creditos:</strong> <span class="badge badge-success"><?php echo $tcredito; ?></span><br><br>
                                	<strong>Semestre</strong><br>
                            		<input type="number" name="semestre" value="1" min="1" max="<?php echo $max_seme; ?>" required autocomplete="off">
                                </div>
                                <div class="span6">
                                	<strong>Valor Total:</strong> $ <?php echo formato($tvalor); ?><br><br>
                                	<strong>Tipo Semestre</strong><br>
                                    <select name="tipo">
                                    	<option value="S1">Primer Semestre del Año</option>
                                        <option value="S2">Segundo Semestre del Año</option>
                                        <option value="I1">Primer Intersemestral</option>
                                        <option value="I2">Segundo Intersemestral</option>
                                        <option value="AE">Año Escolar</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">
                            	<i class="icon-remove"></i><strong>Cerrar sin Guardar</strong>
                            </button>
                            <button type="submit" class="btn btn-primary">
                            	<strong><i class="icon-ok"></i> Finalizar y Guardar</strong>
                            </button>
                        </div>
                        </form>
                    </div>
                </td>
			  </tr>
              <tr>
				<td><strong>Nombre Materia</strong></td>
				<td><center><strong>Creditos</strong></center></td>
				<td><center><strong>Valor</strong></center></td>
				<td>&nbsp;</td>
			  </tr>
              <?php
			  	$tmpa=mysql_query("SELECT * FROM tmp_asig WHERE alumno='$nit'");
				while($date=mysql_fetch_array($tmpa)){
					$objMate=new Consultar_Materias($date['mate']);
			  ?>
              <tr>
				<td><?php echo $objMate->consultar('nombre'); ?></td>
				<td><center><?php echo $objMate->consultar('creditos'); ?></center></td>
				<td><center>$ <?php echo formato($objMate->consultar('valor')); ?></center></td>
				<td>
                	<center>
                	<a href="asig_curso.php?eli=<?php echo $date['id'].'&codigo='.$nit; ?>" title="Quitar de la Lista" class="btn btn-mini">
                    	<i class="icon-remove"></i>
                    </a>
                    </center>
                </td>
			  </tr>
              <?php } ?>
          </table>     
        </div>
	</div>
</body>
</html>