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
		$cans=mysql_query("SELECT * FROM profesor WHERE id='$nit'");
		if($dat=mysql_fetch_array($cans)){
			if($dat['estado']=='s'){
				$xSQL="Update profesor Set estado='n' Where id='$nit'";
				mysql_query($xSQL);
				header('location:profesores.php');
			}else{
				$xSQL="Update profesor Set estado='s' Where id='$nit'";
				mysql_query($xSQL);
				header('location:profesores.php');
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
		
		$cans=mysql_query("SELECT COUNT(nombre)as total FROM profesor");
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
        			<h3 class="text-info"><img src="img/intro.png" class="img-circle" width="100" height="100"> 
                    Registro y Control de Profesores</h3>
                </div>
    	        <div class="span6" align="right">
                	<form name="form1" method="post" action="" class="form-inline">
                    <!-- INGRESAR NUEVA ASIGNATURA --->
                        <a href="#nuevo" role="button" class="btn" data-toggle="modal">
                            <i class="icon-book"></i> <strong>Ingresar Nueva Materia</strong>
                        </a> |
                    	<div class="input-prepend">
                        	<span class="add-on"><i class="icon-search"></i></span>
                            <input name="bus" type="text" placeholder="Buscar Profesores por Nombre" class="input-xlarge" autocomplete="off" autofocus>
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
			$nit=limpiar($_POST['nit']);
			$localidad=limpiar($_POST['localidad']);
			$correo=limpiar($_POST['correo']);
			$celular=limpiar($_POST['celular']);
			$usu=limpiar($_POST['usu']);
			$tipo=limpiar($_POST['tipo']);
			if(empty($_POST['id'])){
				if (preg_match("/\\s/", $usu)){ 
					echo '	<div class="alert alert-error" align="center">
              					<button type="button" class="close" data-dismiss="alert">X</button>
              					<strong>Error! No se permiten espacios en la cuenta de usuario.</strong>
            				</div>';
							$usu='';
				}else{
					if(is_numeric($nit)){
						$can=mysql_query("SELECT * FROM profesor WHERE nit='$nit' or usu='$usu'"); 						
						if(!$dato=mysql_fetch_array($can)){ 
							$con=$usu;
							$objGuardar=new Proceso_Profesor('',$nit, $nombre, $localidad, $correo, $celular, $usu, $con, $tipo);
							$objGuardar->crear();
							echo '	<div class="alert alert-success" align="center">
										<button type="button" class="close" data-dismiss="alert">X</button>
										<strong>
											El Profesor "'.$nombre.'" Guardado Con Exito en la base de datos
										</strong>
									</div>';
						}else{
							echo '	<div class="alert alert-error" align="center">
										<button type="button" class="close" data-dismiss="alert">X</button>
										<strong>
											El Nombre de Usuairo "'.$usu.'" o Documento de identidad "'.$nit.'" ya existen en la base de datos
										</strong>
									</div>';
						}
					}else{
						echo '<div class="alert alert-error" align="center">
              					<button type="button" class="close" data-dismiss="alert">X</button>
              					<strong>Error! El documento de identidad debe ser solo numeros</strong>
            				</div>';
					}
				}
			}else{
				#actualizar
				$id=limpiar($_POST['id']);
				$objActualizar = new Proceso_Profesor($id, $nit, $nombre, $localidad, $correo, $celular, $usu, $tipo);
				$objActualizar->actualizar();
				echo '	<div class="alert alert-success" align="center">
							<button type="button" class="close" data-dismiss="alert">X</button>
							<strong>El Profesor "'.$nombre.'" Actualizado Con Exito en la base de datos</strong>
						</div>';
			}
			
		}
	?>
	<table class="table table-bordered table table-hover">
      <tr class="info">
      	<td width="15%"><strong class="text-info">Documento</strong></td>
      	<td width="28%"><strong class="text-info">Nombre y Apellido</strong></td>
      	<td width="21%"><strong class="text-info">Correo</strong></td>
      	<td><strong class="text-info">Celular</strong><strong class="text-info"><center></center></strong></td>
      	<td width="11%"><center><strong class="text-info">Estado</strong></center></td>
      	<td width="4%">&nbsp;</td>
   	  </tr>
      <?php
		if(empty($_POST['bus'])){
			$sql="SELECT * FROM profesor ORDER BY nombre LIMIT $inicio, $maximo";
		}else{
			$bus=limpiar($_POST['bus']);
			$sql="SELECT * FROM profesor WHERE nombre LIKE '%$bus%' or nit='$bus' ORDER BY nombre LIMIT $inicio, $maximo";
		}
		 	
		$can=mysql_query($sql);
		while($dato=mysql_fetch_array($can)){
			$ttipo=$dato['tipo'];
	  ?>
      <tr>
        <td><?php echo $dato['nit']; ?></td>
        <td><?php echo $dato['nombre']; ?></td>
        <td><?php echo $dato['correo']; ?></td>
        <td><?php echo $dato['celular']; ?>        </td>
        <td>
        	<center>
            	<a href="profesores.php?estado=<?php echo $dato['id']; ?>" title="Cambiar Estado">
				<?php echo estado($dato['estado']); 	?>
                </a>
            </center>
        </td>
        <td>
        	<center>
        	<a href="#act<?php echo $dato['id']; ?>" role="button" class="btn btn-mini" data-toggle="modal" title="Actualizar Informacion">
            	<i class="icon-edit"></i>
            </a>
            </center>
        </td>
      </tr>
      
    <!-- actualizar nuevos -->
    <div id="act<?php echo $dato['id']; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form name="form1" method="post" action="" class="form-inline">
    	<input type="hidden" name="id" value="<?php echo $dato['id']; ?>">
        <div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
       	 	<h3 id="myModalLabel">Actualizar Profesor</h3>
        </div>
        <div class="modal-body">
       	    <div class="row-fluid">
	            <div class="span6">
                	<strong>Documento</strong><br>
                	<input type="number" name="nit" autocomplete="off" readonly value="<?php echo $dato['nit']; ?>"><br>
                    <strong>Nombre y Apellido</strong><br>
                    <input type="text" name="nombre" autocomplete="off" required value="<?php echo $dato['nombre']; ?>"><br>
                    <strong>Ciudad o Localidad</strong><br>
                    <input type="text" name="localidad" autocomplete="off" required value="<?php echo $dato['localidad']; ?>"><br> 
                    <strong>Tipo de Usuario</strong> <br>
                    <select name="tipo">
                    	<option value="p" <?php if($ttipo=='p'){ echo 'selected'; } ?>>Profesor</option>
                        <option value="a" <?php if($ttipo=='a'){ echo 'selected'; } ?>>Administrador</option>
                    </select> 
                </div>
    	        <div class="span6">
                	<strong>Correo Electronico</strong><br>
                    <input type="email" name="correo" autocomplete="off" required value="<?php echo $dato['correo']; ?>"><br>
                    <strong>Celular</strong><br>
                    <input type="text" name="celular" autocomplete="off" required value="<?php echo $dato['celular']; ?>"><br>
                    <strong>Cuenta de Usuario</strong><br>
                    <input type="text" name="usu" autocomplete="off" readonly value="<?php echo $dato['usu']; ?>"><br>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i> <strong>Cerrar</strong></button>
            <button type="submit" class="btn btn-primary"><i class="icon-ok"></i> <strong>Actualizar</strong></button>
        </div>
        </form>
    </div>
      <?php } ?>
    </table>
    <?php
		$can=mysql_query($sql);
		if(!$dato=mysql_fetch_array($can)){
			echo '	<div class="alert alert-error" align="center">
						<strong>No hay resultados con la busqueda "'.$bus.'"</strong>
					</div>';
		}
	?>
    <div class="pagination" align="center">
        <ul>
        	<?php
			if(empty($_POST['bus'])){
				$tp = ceil($total/$maximo);#funcion que devuelve entero redondeado
         		for	($n=1; $n<=$tp ; $n++){
					if($pag==$n){
						echo '<li class="active"><a href="profesores.php?pag='.$n.'"><strong>'.$n.'</strong></a></li>';	
					}else{
						echo '<li><a href="profesores.php?pag='.$n.'"><strong>'.$n.'</strong></a></li>';	
					}
				}
			}
			?>
        </ul>
    </div>
    <!-- guardar nuevos -->
    <div id="nuevo" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form name="form1" method="post" action="" class="form-inline">
        <div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
       	 	<h3 id="myModalLabel">Ingresar Nuevo Profesor</h3>
        </div>
        <div class="modal-body">
       	    <div class="row-fluid">
	            <div class="span6">
                	<strong>Documento</strong><br>
                	<input type="number" name="nit" autocomplete="off" required><br>
                    <strong>Nombre y Apellido</strong><br>
                    <input type="text" name="nombre" autocomplete="off" required><br>
                    <strong>Ciudad o Localidad</strong><br>
                    <input type="text" name="localidad" autocomplete="off" required><br> 
                    <strong>Tipo de Usuario</strong> <br>
                    <select name="tipo">
                    	<option value="p" selected>Profesor</option>
                        <option value="a">Administrador</option>
                    </select>
                </div>
    	        <div class="span6">
                	<strong>Correo Electronico</strong><br>
                    <input type="email" name="correo" autocomplete="off" required><br>
                    <strong>Celular</strong><br>
                    <input type="text" name="celular" autocomplete="off" required><br>
                    <strong>Cuenta de Usuario</strong><br>
                    <input type="text" name="usu" autocomplete="off" required><br>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i> <strong>Cerrar</strong></button>
            <button type="submit" class="btn btn-primary"><i class="icon-ok"></i> <strong>Guardar</strong></button>
        </div>
        </form>
    </div>
</body>
</html>