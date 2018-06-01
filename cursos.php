<?php
 		session_start();
		include_once('php_conexion.php'); 
		include_once('class/funciones.php');
		include_once('class/class.php');
		if($_SESSION['tipo_usu']=='a'){
		}else{
			header('location:error.php');
		}
		if(!empty($_GET['estado'])){
			$nit=limpiar($_GET['estado']);
			$cans=mysql_query("SELECT * FROM cursos WHERE estado='s' and id='$nit'");
			if($dat=mysql_fetch_array($cans)){
				$xSQL="Update cursos Set estado='n' Where id='$nit'";
				mysql_query($xSQL);
				header('location:cursos.php');
			}else{
				$xSQL="Update cursos Set estado='s' Where id='$nit'";
				mysql_query($xSQL);
				header('location:cursos.php');
			}
		}
		#paginar
		$maximo=10;
		if(!empty($_GET['pag'])){
			$pag=limpiar($_GET['pag']);
		}else{
			$pag=1;
		}
		$inicio=($pag-1)*$maximo;
		
		$cans=mysql_query("SELECT COUNT(nombre)as total FROM cursos");
		if($dat=mysql_fetch_array($cans)){
			$total=$dat['total']; #inicializo la variable en 0
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
       		<div class="row-fluid">
	  			<div class="span6">
        			<h3 class="text-info"><img src="img/log0.jpg" class="img-circle" width="100" height="100"> 
                    Registro y Control de Cursos</h3>        
                </div>
    			<div class="span6" align="right">
                	<form name="form1" method="post" action="" class="form-inline">
                    <!-- INGRESAR NUEVA curso --->
                        <a href="#nuevo" role="button" class="btn" data-toggle="modal">
                            <i class="icon-book"></i> <strong>Ingresar Nuevo Curso</strong>
                        </a> |
                    	<div class="input-prepend">
                        	<span class="add-on"><i class="icon-search"></i></span>
                            <input name="bus" type="text" placeholder="Buscar Cursos por Nombre" class="input-xlarge" autocomplete="off">
                        </div>
                    </form>
                </div>
    		</div>
        </td>
      </tr>
    </table>	
    <?php 
		if(!empty($_POST['nombre'])){
			$nombre=limpiar($_POST['nombre']);
			$encargado=limpiar($_POST['encargado']);
			$materia=limpiar($_POST['materia']);
			if(empty($_POST['id'])){
				#guardar
				$objConsultar=new Consultar_Cursos($nombre);
				if($objConsultar->consultar('nombre')==NULL){
					$objGuardar=new Proceso_Cursos($nombre,$materia,$encargado,'');
					$objGuardar->crear();
					echo '	<div class="alert alert-success" align="center">
							  <button type="button" class="close" data-dismiss="alert">×</button>
							  <strong>El Curso "'.$nombre.'" Guardado con Exito</strong>
							</div>';
					
				}else{
					#mensaje
					echo '	<div class="alert alert-error" align="center">
								<strong>El nombre del Curso "'.$nombre.'" ya esta registrado en la base de datos</strong>
							</div>';
				}
			}else{
				#actualizar
				$id=limpiar($_POST['id']);		
				$objActualizar=new Proceso_Cursos($nombre,$materia,$encargado,$id);
				$objActualizar->actualizar();
				echo '	<div class="alert alert-success" align="center">
							  <button type="button" class="close" data-dismiss="alert">×</button>
							  <strong>El Curso "'.$nombre.'" Actualizado con Exito</strong>
							</div>';
			}
		}
	?>
    <table class="table table-bordered table table-hover">
      <tr class="info">
        <td width="26%"><strong class="text-info">Nombre del Curso</strong></td>
        <td width="21%"><strong class="text-info">Materia</strong></td>
        <td width="32%"><strong class="text-info">Encargado del Curso</strong></td>
        <td width="12%"><center><strong class="text-info">Estado</strong></center></td>
        <td width="9%">&nbsp;</td>
      </tr>
      <?php
		if(empty($_POST['bus'])){
			$sql="SELECT * FROM cursos ORDER BY nombre LIMIT $inicio, $maximo";
		}else{
			$bus=limpiar($_POST['bus']);
			$sql="SELECT * FROM cursos WHERE nombre LIKE '%$bus%' ORDER BY nombre LIMIT $inicio, $maximo";
		}
		 	
		$can=mysql_query($sql);
		while($dato=mysql_fetch_array($can)){
			$id_curso=$dato['id'];
			$objMateria=new Consultar_Materias($dato['materia']);
			$objEncargado=new Consultar_Profesor($dato['encargado']);
	  ?>
      <tr>
        <td><i class="icon-list-alt"></i> <?php echo $dato['nombre']; ?></td>
        <td><?php echo $objMateria->consultar('nombre'); ?></td>
        <td><?php echo $objEncargado->consultar('nombre'); ?></td>
        <td>
        	<center>
            <a href="cursos.php?estado=<?php echo $dato['id']; ?>" title="Cambiar de Estado">
				<?php echo estado($dato['estado']); ?>
            </a>
            </center>
        </td>
        <td>
        	<center>
        	<a href="#act<?php echo $dato['id']; ?>" role="button" class="btn btn-mini" data-toggle="modal" title="Actualizar Informacion">
            	<i class="icon-edit"></i>
            </a>
            <a href="#lis<?php echo $dato['id']; ?>" role="button" class="btn btn-mini" data-toggle="modal" title="Listado de Alumnos">
            	<i class="icon-list"></i>
            </a>
            </center>
        </td>
      </tr>
    <!-- LISTADO DE SALONES -->
    <div id="lis<?php echo $dato['id']; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    	    <h3 id="myModalLabel" align="center">Listado de Alumnos<br>"<?php echo $dato['nombre']; ?>"</h3>
        </div>
        <div class="modal-body">          
                	<?php	
					
					$n1=mysql_query("SELECT * FROM salon_alum WHERE salon='$id_curso'");
					if($i=mysql_fetch_array($n1)){
						$n=0;
						echo ' <div id="" style="overflow:scroll; height:300px;">';
						$can1=mysql_query("SELECT * FROM salon_alum WHERE salon='$id_curso'");
						while($info=mysql_fetch_array($can1)){
							$n++;
							$objAlumno=new Consultar_Alumno($info['alumno']);
							$objCarrera=new Consultar_Carrera($objAlumno->consultar('carrera'));
							echo '<i class="icon-user"></i> '.$n.'. | '.$objAlumno->consultar('apellido').' '.$objAlumno->consultar('nombre').' ( '.$info['alumno'].' ) '.$objCarrera->consultar('nombre').'<br>';
						}
						echo '</div>';
					}else{
						echo '<div class="alert alert-error" align="center"><strong>No hay Alumnos Registrados en Este Salon</strong></div>';
					}
					?>
        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i> <strong>Cerrar</strong></button>
            <?php 
				$n1=mysql_query("SELECT * FROM salon_alum WHERE salon='$id_curso'");
				if($i=mysql_fetch_array($n1)){
			?>
            <a href="reporte/listado_alumnos_salon.php?id=<?php echo $id_curso; ?>" class="btn btn-primary">
            	<i class="icon-list"></i> <strong>Imprimir Reporte en EXCEL</strong>
            </a>
            <?php } ?>
        </div>
    </div>
    <!-- actualizar salones -->
    <div id="act<?php echo $dato['id']; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    	<form name="form1" method="post" action="" class="form-inline">
        <input type="hidden" name="id" value="<?php echo $dato['id']; ?>">
        <div class="modal-header">
       		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      		<h3 id="myModalLabel">Actualizar Curso</h3>
        </div>
        <div class="modal-body">
            <div class="row-fluid">
        	    <div class="span6">
                	<strong>Nombre del Curso</strong><br>
                    <input type="text" name="nombre" autocomplete="off" required value="<?php echo $dato['nombre']; ?>"><br>
                    <strong>Materia</strong><br>
					<select name="materia">
                    	<?php
							$sql1="SELECT * FROM materias WHERE estado='s' ORDER BY nombre";                                    
							$prosql=mysql_query($sql1);
							while($pro=mysql_fetch_array($prosql)){
								if($pro['id']==$dato['materia']){
									echo '<option value="'.$pro['id'].'" selected>'.$pro['nombre'].'</option>';
								}else{
									echo '<option value="'.$pro['id'].'">'.$pro['nombre'].'</option>';
								}
							}
						?>
                    </select>
                </div>
            	<div class="span6">
                	<strong>Profesor Encargado</strong><br>
                    <select name="encargado">
                    <?php
						$sql1="SELECT * FROM profesor ORDER BY nombre";                                    
						$prosql=mysql_query($sql1);
						while($pro=mysql_fetch_array($prosql)){
							if($pro['nit']==$dato['encargado']){
								echo '<option value="'.$pro['nit'].'" selected>'.$pro['nombre'].'</option>';
							}else{
								echo '<option value="'.$pro['nit'].'">'.$pro['nombre'].'</option>';
							}
						}
					?>
                    </select>
                </div>
            </div>
        </div>
        <div class="modal-footer">
    	    <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i> <strong>Cerrar</strong></button>
	        <button type="submit" class="btn btn-primary"><i class="icon-ok"></i> <strong>Actualizar</strong></button>
        </div>
        </form>
    </div>
    <!--======================================-->
      <?php } ?>
    </table>
    <div class="pagination" align="center">
        <ul>
        	<?php
			if(empty($_POST['bus'])){
				$tp = ceil($total/$maximo);#funcion que devuelve entero redondeado
         		for	($n=1; $n<=$tp ; $n++){
					if($pag==$n){
						echo '<li class="active"><a href="cursos.php?pag='.$n.'"><strong>'.$n.'</strong></a></li>';	
					}else{
						echo '<li><a href="cursos.php?pag='.$n.'"><strong>'.$n.'</strong></a></li>';	
					}
				}
			}
			?>
        </ul>
    </div>
    
	<!-- Guardar salones -->
    <div id="nuevo" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    	<form name="form1" method="post" action="" class="form-inline">
        <div class="modal-header">
       		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      		<h3 id="myModalLabel">Guardar Nuevo Curso</h3>
        </div>
        <div class="modal-body">
            <div class="row-fluid">
        	    <div class="span6">
                	<strong>Nombre del Curso</strong><br>
                    <input type="text" name="nombre" autocomplete="off" required><br>
                    <strong>Materia</strong><br>
					<select name="materia">
                    	<?php
							$sql1="SELECT * FROM materias WHERE estado='s' ORDER BY nombre";                                    
							$prosql=mysql_query($sql1);
							while($pro=mysql_fetch_array($prosql)){
								echo '<option value="'.$pro['id'].'">'.$pro['nombre'].'</option>';
							}
						?>
                    </select>
                </div>
            	<div class="span6">
                	<strong>Profesor Encargado</strong><br>
                    <select name="encargado">
                    <?php
						$sql1="SELECT * FROM profesor ORDER BY nombre";                                    
						$prosql=mysql_query($sql1);
						while($pro=mysql_fetch_array($prosql)){
							echo '<option value="'.$pro['nit'].'">'.$pro['nombre'].'</option>';
						}
					?>
                    </select>
                </div>
            </div>
        </div>
        <div class="modal-footer">
    	    <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i> <strong>Cerrar</strong></button>
	        <button type="submit" class="btn btn-primary"><i class="icon-ok"></i> <strong>Guardar</strong></button>
        </div>
        </form>
    </div>
    <!--======================================-->
</body>
</html>