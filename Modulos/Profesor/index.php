<?php 
	session_start();
	include_once "../php_conexion.php";
	include_once "class/class.php"; 
	include_once "../funciones.php";
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>.: Profesores :.</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="../../css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 50px;
        padding-bottom: 40px;
      }
    </style>
    <link href="../../css/bootstrap-responsive.css" rel="stylesheet">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../../ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../../ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../../ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../../ico/apple-touch-icon-57-precomposed.png">
	<link rel="shortcut icon" href="../../ico/favicon.png">
  </head>
  
  <body>

    <div align="center">
    	<table width="80%">
          <tr>
            <td>
            	<table class="table table-bordered">
                  <tr class="info">
                    <td>
                    	<div class="row-fluid">
                            <div class="span6">
                            	<h2 class="text-info">
                                    <!--<img src="img/profesor.png" width="80" height="80"> logo de registrar-->
                                    Registrar Profesores
                                </h2>
                            </div>
                            <div class="span6">
                            	<form name="form1" method="post" action="">
                                	<div class="input-append">
                                	<input type="text" name="buscar" class="input-xlarge" autocomplete="off" autofocus placeholder="Buscar Profesores">
                                    <button type="submit" class="btn"><strong><i class="icon-search"></i> Buscar</strong></button>
                                    </div>
                          	    </form>
                                <a href="#nuevo" role="button" class="btn" data-toggle="modal">
                                	<strong><i class="icon-plus"></i> Ingresar Nuevo Profesor</strong>
                                </a>
                                
                        		<div id="nuevo" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	                                <form name="form2" method="post" action="">
                                    <div class="modal-header">
                    	                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                	                    <h3 id="myModalLabel">Registrar Nuevo Profesor</h3>
                                    </div>
                                    <div class="modal-body">
                						<div class="row-fluid">
                                        	<div class="span6">
                                            	<strong>Dni</strong><br>
                                                <input type="text" name="doc" autocomplete="off" required value=""><br>
                                                <strong>Nombre del Profesor</strong><br>
                                                <input type="text" name="nombre" autocomplete="off" required value=""><br>
                                                <strong>Apellidos del Profesor</strong><br>
                                                <input type="text" name="ape" autocomplete="off" required value=""><br>
                                                <strong>Especialidades</strong><br>
                                                <input type="text" name="especialidad" autocomplete="off" required value=""><br>
                                                <strong>Correo</strong><br>
                                                <input type="email" name="correo" autocomplete="off" required value=""><br>
                                                <strong>Tipo de Usuario</strong><br>
                                                <select name="tipo">
                                                	<option value="p">Profesor</option>
                                                    <option value="a">Administrador</option>
                                                </select>
                                            </div>
                                        	<div class="span6">
                                            	<strong>Direccion</strong><br>
                                                <input type="text" name="dir" autocomplete="off" required value=""><br>
                                                <strong>Telefonos</strong><br>
                                                <input type="text" name="tel" autocomplete="off" value=""><br>
                                                <strong>Celulares</strong><br>
                                                <input type="text" name="cel" autocomplete="off" required value=""><br>
                                                <strong>Fecha de Nacimiento</strong><br>
                                                <input type="date" name="fecha" autocomplete="off" required value=""><br>
												<strong>Estado</strong><br>
                                                <select name="estado">
                                                	<option value="s">Activo</option>
                                                    <option value="n">No Activo</option>
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
                                
                            </div>
                        </div>
                    </td>
                  </tr>
                </table>
            </td>
          </tr>
        </table>
        
        <table width="90%">
          <tr>
            <td>
            	 <?php
					if(!empty($_POST['doc']) and !empty($_POST['Nombre'])){
						$nombre=limpiar($_POST['nombre']);		$ape=limpiar($_POST['ape']);
						$doc=limpiar($_POST['doc']);		$fecha=limpiar($_POST['fecha']);
						$dir=limpiar($_POST['dir']);		$tel=limpiar($_POST['tel']);
						$cel=limpiar($_POST['cel']);		$correo=limpiar($_POST['correo']);
						$especialidad=limpiar($_POST['especialidad']);	$estado=limpiar($_POST['estado']);
						$tipo=limpiar($_POST['tipo']);		$con=$doc;
						if(empty($_POST['id'])){
							$oProfesor=new Proceso_Profesor('', $nombre, $ape, $doc, $fecha, $dir, $tel, $cel, $correo, $especialidad, $estado, $tipo, $con);
							$oProfesor->guardar();
							echo mensajes('El Profesor "'.$nombre.' '.$ape.'" Ha sido Guardado con Exito','verde');
						}else{
							$id=limpiar($_POST['id']);
							$oProfesor=new Proceso_Profesor($id,$nombre, $ape, $doc, $fecha, $dir, $tel, $cel, $correo, $especialidad, $estado, $tipo, $con);
							$oProfesor->actualizar();
							echo mensajes('El Profesor "'.$nombre.' '.$ape.'" Ha sido Actualizado con Exito','verde');
							
						}
					}
				?>
            	<table class="table table-bordered table table-hover">
                  <tr class="info">
                    <td><strong class="text-info">Documento</strong></td>
                    <td><strong class="text-info">Nombre y Apellido</strong></td>
                    <td><strong class="text-info">Correo</strong></td>
                    <td><strong class="text-info">Celulares</strong></td>
                    <td><center><strong class="text-info">Tipo de Usuario</strong></center></td>
                    <td><center><strong class="text-info">Estado</strong></center></td>
                    <td>&nbsp;</td>
                  </tr>
                  <?php
						if(!empty($_POST['buscar'])){
							$buscar=limpiar($_POST['buscar']);
							$pa=mysql_query("SELECT * FROM profesor WHERE nombre LIKE '%$buscar%' or ape LIKE '%$buscar%' or doc='$buscar'");					
						}else{
							$pa=mysql_query("SELECT * FROM profesor");				
						}
						while($row=mysql_fetch_array($pa)){
							if($row['tipo']=='a'){
								$tipo='Administrador';
							}else{
								$tipo='Profesor';
							}
				  ?>
                  <tr>
                    <td><?php echo $row['doc']; ?></td>
                    <td><?php echo $row['nombre'].' '.$row['ape']; ?></td>
                    <td><?php echo $row['correo']; ?></td>
                    <td><?php echo $row['cel']; ?></td>
                    <td><center><?php echo $tipo; ?></center></td>
                    <td><center><?php echo estado($row['estado']); ?></center></td>
                    <td>
                    	<center>
                        	<a href="#a<?php echo $row['id']; ?>" title="Editar Profesor" role="button" class="btn btn-mini" data-toggle="modal">
                            	<i class="icon-edit"></i>
                            </a>
                        </center>
                        
                        <div id="a<?php echo $row['id']; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <form name="form2" method="post" action="">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h3 id="myModalLabel">Actualizar Profesor</h3>
                            </div>
                            <div class="modal-body">
                                <div class="row-fluid">
                                    <div class="span6">
                                        <strong>Documento</strong><br>
                                        <input type="text" name="doc" autocomplete="off" readonly value="<?php echo $row['doc']; ?>"><br>
                                        <strong>Nombre del Profesor</strong><br>
                                        <input type="text" name="nombre" autocomplete="off" required value="<?php echo $row['nombre']; ?>"><br>
                                        <strong>Apellidos del Profesor</strong><br>
                                        <input type="text" name="ape" autocomplete="off" required value="<?php echo $row['ape']; ?>"><br>
                                        <strong>Especialidades</strong><br>
                                        <input type="text" name="especialidad" autocomplete="off" required value="<?php echo $row['especialidad'];?>"><br>
                                        <strong>Correo</strong><br>
                                        <input type="email" name="correo" autocomplete="off" required value="<?php echo $row['correo']; ?>"><br>
                                        <strong>Tipo de Usuario</strong><br>
                                        <select name="tipo">
                                        	<option value="p" <?php if($row['tipo']=='p'){ echo 'selected'; } ?>>Profesor</option>
                                            <option value="a" <?php if($row['tipo']=='a'){ echo 'selected'; } ?>>Administrador</option>
                                        </select>
                                    </div>
                                    <div class="span6">
                                        <strong>Direccion</strong><br>
                                        <input type="text" name="dir" autocomplete="off" required value="<?php echo $row['dir']; ?>"><br>
                                        <strong>Telefonos</strong><br>
                                        <input type="text" name="tel" autocomplete="off" value="<?php echo $row['tel']; ?>"><br>
                                        <strong>Celulares</strong><br>
                                        <input type="text" name="cel" autocomplete="off" required value="<?php echo $row['cel']; ?>"><br>
                                        <strong>Fecha de Nacimiento</strong><br>
                                        <input type="date" name="fecha" autocomplete="off" required value="<?php echo $row['fecha']; ?>"><br>
                                        <strong>Estado</strong><br>
                                        <select name="estado">
                                            <option value="s" <?php if($row['estado']=='s'){ echo 'selected'; } ?>>Activo</option>
                                            <option value="n" <?php if($row['estado']=='n'){ echo 'selected'; } ?>>No Activo</option>
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
                        
                    </td>
                  </tr>
                  <?php } ?>
                </table>
            </td>
          </tr>
        </table>
		
    </div>

    <!-- Le javascript ../../js/jquery.js
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../../js/jquery.js"></script>
    <script src="../../js/bootstrap-transition.js"></script>
    <script src="../../js/bootstrap-alert.js"></script>
    <script src="../../js/bootstrap-modal.js"></script>
    <script src="../../js/bootstrap-dropdown.js"></script>
    <script src="../../js/bootstrap-scrollspy.js"></script>
    <script src="../../js/bootstrap-tab.js"></script>
    <script src="../../js/bootstrap-tooltip.js"></script>
    <script src="../../js/bootstrap-popover.js"></script>
    <script src="../../js/bootstrap-button.js"></script>
    <script src="../../js/bootstrap-collapse.js"></script>
    <script src="../../js/bootstrap-carousel.js"></script>
    <script src="../../js/bootstrap-typeahead.js"></script>

  </body>
</html>
