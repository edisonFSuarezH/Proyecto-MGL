<?php
 		session_start();
		include_once('php_conexion.php'); 
		include_once('class/funciones.php');
		include_once('class/class.php');
		if($_SESSION['tipo_usu']=='a' or $_SESSION['tipo_usu']=='p'){
			
			$nombre='';		$estado='s';	$id_material='';	$boton='Registrar';
			
			if(!empty($_GET['id'])){
				$url_act=limpiar($_GET['id']);
				$id_materia=limpiar($_GET['id']);
				$id_materia=substr($id_materia,10);
				$id_materia=decrypt($id_materia,'URLCODIGO');
				if(!empty($_GET['cod'])){
					$id_material=limpiar($_GET['cod']);
					$id_material=substr($id_material,10);
					$id_material=decrypt($id_material,'URLCODIGO');
					
					$sql=mysql_query("SELECT * FROM material WHERE id='$id_material'");
					if($row=mysql_fetch_array($sql)){
						$nombre=$row['nombre'];
						$estado=$row['estado'];
						$boton='Actualizar';
					}else{
						header('location:miscursos.php');
					}
					
				}
				
				$sql=mysql_query("SELECT * FROM materias WHERE id='$id_materia'");
				if($row=mysql_fetch_array($sql)){
					$nombre_materia=$row['nombre'];
					
					if($_SESSION['cod_usu']==$row['director']){
					}else{
						header('location:miscursos.php');			
					}
				}else{
					header('location:miscursos.php');		
				}
			}else{
				header('location:miscursos.php');	
			}
		}else{
			header('location:error.php');
		}
?>
<!DOCTYPE html>
<html lang="es">
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

    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="assets/ico/favicon.png">

</head>
<body data-spy="scroll" data-target=".bs-docs-sidebar">

	<div align="center">
   	    <div class="row-fluid">
	        <div class="span8" align="left">
            	<strong>
                	<a href="miscursos.php">Mis Cursos</a> >> 
                    <a href="material.php?id=<?php echo $url_act; ?>">Material de Estudio "<?php echo $nombre_materia; ?>"</a>
                </strong>
                <?php 
					if(!empty($_POST['nombre'])){
						$nombre=limpiar($_POST['nombre']);
						$estado=limpiar($_POST['estado']);
						$fecha=date('Y-m-d');
						
						if(!empty($_POST['id_material'])){
							$idd=limpiar($_POST['id_material']);
							mysql_query("UPDATE material SET nombre='$nombre',fecha='$fecha',estado='$estado' WHERE id='$idd'");
							
							//subir la imagen del articulo
							$nameimagen = $_FILES['imagen']['name'];
							$tmpimagen = $_FILES['imagen']['tmp_name'];
							$extimagen = pathinfo($nameimagen);
							$urlnueva = "material/".$idd.".PDF";			
							if(is_uploaded_file($tmpimagen)){
								if($extimagen['extension']=='pdf'){
									copy($tmpimagen,$urlnueva);	
								}else{
									echo mensajes("Error al Cargar El Archivo en PDF","rojo");
								}
							}
							echo mensajes('Se ha Actualizado el Material con Exito','verde');
						}else{
							mysql_query("INSERT INTO material (nombre,fecha,materia,estado) VALUES ('$nombre','$fecha','$id_materia','$estado')");
							
							$sql=mysql_query("SELECT MAX(id) as maximo FROM material");
							if($row=mysql_fetch_array($sql)){
								$maximo=$row['maximo'];
							}
							//subir la imagen del articulo
							$nameimagen = $_FILES['imagen']['name'];
							$tmpimagen = $_FILES['imagen']['tmp_name'];
							$extimagen = pathinfo($nameimagen);
							$ext = array("pdf","PDF");
							$urlnueva = "material/".$maximo.".PDF";	
							if(is_uploaded_file($tmpimagen)){
								if($extimagen['extension']=='pdf'){
									copy($tmpimagen,$urlnueva);	
								}else{
									echo mensajes("Error al Cargar El Archivo en PDF","rojo");
								}
							}
							echo mensajes('Se ha Registrado el Material con Exito','verde');
						}
						
						
					}
				?>
        		<table class="table table-bordered">
                 	<tr class="info">
                    	<td><strong>Descripcion de la Actividad</strong></td>
                    	<td><strong><center>Fecha de Registro</center></strong></td>
                    	<td><strong><center>Estado</center></strong></td>
                        <td><strong><center>Descargar PDF</center></strong></td>
                        <td></td>
                  	</tr>
                    <?php
						$sql=mysql_query("SELECT * FROM material WHERE materia='$id_materia'");
						while($row=mysql_fetch_array($sql)){
							$url_cod=cadenas().encrypt($row['id'],'URLCODIGO').'&id='.$url_act;
							$url_material=cadenas().encrypt($row['id'],'URLCODIGO');
					?>
                    <tr>
                    	<td><?php echo $row['nombre']; ?></td>
                    	<td><center><?php echo fecha($row['fecha']); ?></center></td>
                    	<td><center><?php echo estado($row['estado']); ?></center></td>
                        <td>
                        	<center>
                            	<?php
									if (file_exists("material/".$row['id'].".pdf")){
										echo '<a href="material/vista.php?codigo='.$url_material.'" target="_blank">Descargar</a>';
									}else{
										echo 'Sin Material PDF';
									}
								?>
                            </center>
                        </td>
                        <td>
                        	<center>
                                <a href="material.php?cod=<?php echo $url_cod; ?>" class="btn btn-mini">
                                    <i class="icon-edit"></i>
                                </a>
                            </center>
                        </td>
                  	</tr>
                    <?php } ?>
                </table>    
            </div>
    	    <div class="span4">  
            	<br>
            	<table class="table table-bordered">
                	<tr>
                    	<td>
                        	<center>
                                <div class="btn-group">
                                    <a class="btn btn-info" href="material.php?id=<?php echo $url_act; ?>"><strong>Material de Estudio</strong></a>
                                    <a class="btn" href="actividad.php?id=<?php echo $url_act; ?>"><strong>Actividades</strong></a>
                                </div>
                            </center>
                        </td>
                    </tr>
                 	<tr>
                    	<td>
                        	<div align="center">
                        	<form name="form1" enctype="multipart/form-data" method="post" action="">
	                            <input type="hidden" value="<?php echo $id_material; ?>" name="id_material">
                            	<strong>Descripcion de la Actividad</strong><br>
                                <input type="text" name="nombre" value="<?php echo $nombre; ?>" class="input-xlarge" autocomplete="off" required><br>
                                <strong>Estado</strong><br>
                                <select name="estado" class="input-xlarge">
                                	<option value="s" <?php if($estado=='s'){ echo 'selected'; } ?>>Activo</option>
                                    <option value="n" <?php if($estado=='n'){ echo 'selected'; } ?>>No Activo</option>
                                </select><br>
                                <strong>Documento en PDF</strong><br>
                                <input type="file" name="imagen"><br><br>
                                <button type="submit" class="btn btn-info"><strong><?php echo $boton; ?></strong></button>
                                <a href="material.php?id=<?php echo $url_act; ?>" class="btn"><strong>Cancelar</strong></a>
                            </form>
                            </div>
                        </td>
                    </tr>
            	</table>
            </div>
        </div>
    	
    </div>

</body>
</html>