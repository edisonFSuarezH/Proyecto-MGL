<?php
 		session_start();
		include_once('php_conexion.php'); 
		include_once('class/funciones.php');
		include_once('class/class.php');
		if($_SESSION['tipo_usu']=='a'){
		}else{
			header('location:error.php');
		}
		$bus='';#inicializar la variable
		if(!empty($_GET['estado'])){
			$nit=limpiar($_GET['estado']);
			$cans=mysql_query("SELECT * FROM alumnos WHERE id='$nit'");
			if($dat=mysql_fetch_array($cans)){
				if($dat['estado']=='s'){					
					$xSQL="Update alumnos Set estado='n' Where id='$nit'";
					mysql_query($xSQL);
					header('location:alumno.php');
				}else{
					$xSQL="Update alumnos Set estado='s' Where id='$nit'";
					mysql_query($xSQL);
					header('location:alumno.php');
				}
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
		
		$cans=mysql_query("SELECT COUNT(nombre)as total FROM alumnos");
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
    <!--<link rel="shortcut icon" href="assets/ico/favicon.png">-->

</head>
<body data-spy="scroll" data-target=".bs-docs-sidebar">
	<table class="table table-bordered">
      <tr class="info">
        <td>
        	<div class="row-fluid">
	  			<div class="span6">
        			<center><h3 class="text-info"><img src="img/mm.png" class="img-circle" width="100" height="100"> 
                    Matricula-Registro y Control de Alumnos</h3> </center>       
                </div>
    			<div class="span6" align="right">
                	<form name="form1" method="post" action="" class="form-inline">
                    <!-- INGRESAR NUEVA alumno -->
                        <a href="#nuevo" role="button" class="btn" data-toggle="modal">
                            <i class="icon-book"></i> <strong>Ingresar Nuevo Alumno</strong>
                        </a> |
                    	<div class="input-prepend">
                        	<span class="add-on"><i class="icon-search"></i></span>
                            <input name="bus" type="text" placeholder="Buscar Alumno por Nombre" class="input-xlarge" autocomplete="off" autofocus>
                        </div>
                    </form>
                </div>
    		</div>
        </td>
      </tr>
    </table>
    <?php
		if(!empty($_POST['nombre'])){
			$nit=limpiar($_POST['nit']);			$nombre=limpiar($_POST['nombre']);
			$apellido=limpiar($_POST['apellido']);	$ciudad=limpiar($_POST['ciudad']);
			$correo=limpiar($_POST['correo']);		$carrera=limpiar($_POST['carrera']);				
            $direccion=limpiar($_POST['direccion']);      
            $con=$nit;
			if(empty($_POST['id'])){
				#guardar
				$can=mysql_query("SELECT * FROM alumnos WHERE nit='$nit'");
				if(!$dato=mysql_fetch_array($can)){
					$objGuardar=new Proceso_Alumno('',$nit,$nombre,$apellido,$ciudad,$correo,$con,$carrera,$direccion);
					$objGuardar->crear();
					echo '	<div class="alert alert-success" align="center">
							  <button type="button" class="close" data-dismiss="alert">×</button>
							  <strong>El alumno "'.$apellido.' '.$nombre.'" Guardado con Exito</strong>
							</div>';
				}
				
			}else{
				#actualizar
				$id=limpiar($_POST['id']);
				$objActualizar=new Proceso_Alumno($id,$nit,$nombre,$apellido,$ciudad,$correo,$con,$carrera,$direccion);
				$objActualizar->actualizar();
				echo '	<div class="alert alert-success" align="center">
							  <button type="button" class="close" data-dismiss="alert">×</button>
							  <strong>El alumno "'.$apellido.' '.$nombre.'" Actualizado con Exito</strong>
							</div>';
			}
		}else{
		
		}
	?>
    <table class="table table-bordered table table-hover">
      <tr class="info"><!--tabla de informacion alumno "titulos -->
        <td><strong>Documento</strong></td>
        <td><strong>Apellido y Nombre</strong></td>
        <td><strong>Carrera</strong></td>
        <td><strong>Correo</strong></td>
        <td><strong><center>Estado</center></strong></td>
        <td>&nbsp;</td>
      </tr>
      <?php
		if(empty($_POST['bus'])){
			$sql="SELECT * FROM alumnos ORDER BY apellido LIMIT $inicio, $maximo";
		}else{
			$bus=limpiar($_POST['bus']);
			$sql="SELECT * FROM alumnos WHERE nombre LIKE '%$bus%' or apellido LIKE '%$bus%' or nit='$bus' ORDER BY apellido LIMIT $inicio, $maximo";
		}
		$n=1;
		$can=mysql_query($sql);
		while($dato=mysql_fetch_array($can)){
			
			$objCarrera=new Consultar_Carrera($dato['carrera']);
			if($objCarrera->consultar('nombre')==NULL){
				$ncarrera='Sin Asignar';
			}else{
				$ncarrera=$objCarrera->consultar('nombre');
			}
	  ?>
      <tr> <!-- los datos  de donde va llamry mostrar en tablas informacion alumno-->
        <td><?php echo $n++.' |'.$dato['nit']; ?></td>
        <td><?php echo $dato['apellido'].' '.$dato['nombre']; ?></td>
        <td><?php echo $ncarrera; ?></td>
        <td><?php echo $dato['correo']; ?></td>
        <td>
            <center>
	            <a href="alumno.php?estado=<?php echo $dato['id']; ?>" title="Cambiar Estado">
    	    	    <?php echo estado($dato['estado']); 	?>
        	    </a>
            </center>
        </td>
        <td>
        	<center>
        	<a href="#act<?php echo $dato['id']; ?>" role="button" class="btn btn-mini" data-toggle="modal" title="Actualizar Informacion">
            	<i class="icon-edit"></i>
            </a>
            <?php 
				$url=$dato['nit'];
			?>
            <a href="asig_curso.php?codigo=<?php echo $url; ?>" role="button" class="btn btn-mini" data-toggle="modal" title="Asignar Materias">
            	<i class="icon-briefcase"></i>
            </a>
            </center>
        </td>
      </tr><!-- los datos  de donde va llamr y mostrar en tablas informacion alumno-->
        
    <div id="act<?php echo $dato['id']; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"><!--para actualizar informacion de alumno-->
    	<form name="form1" method="post" action="" class="form-inline">
        <input type="hidden" name="id" value="<?php echo $dato['id']; ?>">
    	<div class="modal-header">
    		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    		<h3 id="myModalLabel">Actualizar Alumno</h3>
    	</div>
    	<div class="modal-body">
   		    <div class="row-fluid">
	            <div class="span6">
                	<strong>Dni</strong><br>
                    <input type="text" name="nit" autocomplete="off" readonly value="<?php echo $dato['nit']; ?>"><br>
                	<strong>Apellido</strong><br>
                    <input type="text" name="apellido" autocomplete="off" required value="<?php echo $dato['apellido']; ?>"><br>
                    <strong>Nombre</strong><br>
                    <input type="text" name="nombre" autocomplete="off" required value="<?php echo $dato['nombre']; ?>"><br>
                    <strong>Direccion</strong><br>
                    <input type="text" name="direccion" autocomplete="off" required value="<?php echo $dato['direccion']; ?>"><br>
                </div>
    	        <div class="span6">
                	<strong>Ciudad</strong><br>
                    <input type="text" name="ciudad" autocomplete="off" required value="<?php echo $dato['ciudad']; ?>"><br>
                    <strong>Correo</strong><br>
                    <input type="email" name="correo" autocomplete="off" requerid value="<?php echo $dato['correo']; ?>"><br>
                    <strong>Carrera</strong><br>
                    <select name="carrera">
                    	<?php
							$cn=mysql_query("SELECT * FROM carreras WHERE estado='s'");
							while($do=mysql_fetch_array($cn)){
								if($dato['carrera']==$do['id']){
									echo '<option value="'.$do['id'].'" selected>'.$do['nombre'].'</option>';		
								}else{
									echo '<option value="'.$do['id'].'">'.$do['nombre'].'</option>';
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
    </div>  <!--para actualizar informacion de alumno-->
      <?php } ?>
    </table>
    
	<div class="pagination" align="center"><!--cuantos datos se mostrara en una pagina-->
        <ul>
        	<?php
			if(empty($_POST['bus'])){
				$tp = ceil($total/$maximo);#funcion que devuelve entero redondeado
         		for	($n=1; $n<=$tp ; $n++){
					if($pag==$n){
						echo '<li class="active"><a href="alumno.php?pag='.$n.'"><strong>'.$n.'</strong></a></li>';	
					}else{
						echo '<li><a href="alumno.php?pag='.$n.'"><strong>'.$n.'</strong></a></li>';	
					}
				}
			}
			?>
        </ul>
    </div><!--cuantos datos se mostrara en una pagina-->
    
    <div id="nuevo" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> <!--formulario para agregar nuevo alumno en pagina 1,2,3.. -->
    	 <form name="form1" method="post" action="" class="form-inline">
    	<div class="modal-header">
    		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    		<h3 id="myModalLabel">Guardar Nuevo Alumno</h3>
    	</div>
    	<div class="modal-body">
        
   		    <div class="row-fluid">
	            <div class="span6">
                	<strong>Dni</strong><br>
                    <input type="text" name="nit" autocomplete="off" required><br>
                	<strong>Apellido</strong><br>
                    <input type="text" name="apellido" autocomplete="off" required><br>
                    <strong>Nombre</strong><br>
                    <input type="text" name="nombre" autocomplete="off" required><br>
                    <strong>Direccion</strong><br>
                    <input type="text" name="direccion" autocomplete="off" ><br>
                </div>
    	        <div class="span6">
                	<strong>Ciudad</strong><br>
                    <input type="text" name="ciudad" autocomplete="off" required><br>
                    <strong>Correo</strong><br>
                    <input type="email" name="correo" autocomplete="off" requerid><br>
                    <strong>Carrera</strong><br>
                    <select name="carrera">
                    	<?php
							$cn=mysql_query("SELECT * FROM carreras WHERE estado='s'");
							while($do=mysql_fetch_array($cn)){
								echo '<option value="'.$do['id'].'">'.$do['nombre'].'</option>';							
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
    </div><!--formulario para agregar nuevo alumno en pagina 1,2,3.. -->
</body>
</html>