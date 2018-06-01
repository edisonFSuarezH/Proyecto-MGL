<?php
 		session_start();
		include_once('php_conexion.php'); 
		include_once('class/funciones.php');
		include_once('class/class.php');
		if($_SESSION['tipo_usu']=='a' or $_SESSION['tipo_usu']=='p'){
			$xini=date('Y-m-d');	$xfin=date('Y-m-d');	$titulo='';	$id_actividad='';	$boton='Registrar';
			if(!empty($_GET['id'])){
				$url_act=limpiar($_GET['id']);
				$id_materia=limpiar($_GET['id']);
				$id_materia=substr($id_materia,10);
				$id_materia=decrypt($id_materia,'URLCODIGO');
				
				if(!empty($_GET['cod'])){
					$id_actividad=limpiar($_GET['cod']);
					$id_actividad=substr($id_actividad,10);
					$id_actividad=decrypt($id_actividad,'URLCODIGO');
					
					$sql=mysql_query("SELECT * FROM actividad WHERE id='$id_actividad'");
					if($row=mysql_fetch_array($sql)){
						$titulo=$row['titulo'];
						$ini=$row['apertura'];
						$fin=$row['cierre'];
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

	    <div class="row-fluid">
    		<div class="span8">
            	<strong>
                	<a href="miscursos.php">Mis Cursos</a> >> 
                    <a href="actividad.php?id=<?php echo $url_act; ?>">Actividades "<?php echo $nombre_materia; ?>"</a>
                </strong>
                <?php
					if(!empty($_POST['titulo'])){
						$r_titulo=limpiar($_POST['titulo']);
						$r_ini=limpiar($_POST['ini']);	$xini=limpiar($_POST['ini']);
						$r_fin=limpiar($_POST['fin']);	$xfin=limpiar($_POST['fin']);
						
						if(!empty($_POST['id_actividad'])){
							$idd=limpiar($_POST['id_actividad']);
							mysql_query("UPDATE actividad SET titulo='$r_titulo', apertura='$r_ini', cierre='$r_fin' WHERE id='$idd'");
							
							//subir la imagen del articulo
							$nameimagen = $_FILES['imagen']['name'];
							$tmpimagen = $_FILES['imagen']['tmp_name'];
							$extimagen = pathinfo($nameimagen);
							$urlnueva = "actividad/".$idd.".PDF";			
							if(is_uploaded_file($tmpimagen)){
								if($extimagen['extension']=='pdf'){
									copy($tmpimagen,$urlnueva);	
								}else{
									echo mensajes("Error al Cargar El Archivo en PDF","rojo");
								}
							}
							
							echo mensajes('Se ha Actualizado la Actividad con Exito','verde');
						}else{
							mysql_query("INSERT INTO actividad (titulo,materia,apertura,cierre) VALUES ('$r_titulo','$id_materia','$r_ini','$r_fin')");
							
							$sql=mysql_query("SELECT MAX(id) as maximo FROM actividad");
							if($row=mysql_fetch_array($sql)){
								$maximo=$row['maximo'];
							}
							
							//subir la imagen del articulo
							$nameimagen = $_FILES['imagen']['name'];
							$tmpimagen = $_FILES['imagen']['tmp_name'];
							$extimagen = pathinfo($nameimagen);
							$urlnueva = "actividad/".$maximo.".PDF";			
							if(is_uploaded_file($tmpimagen)){
								if($extimagen['extension']=='pdf'){
									copy($tmpimagen,$urlnueva);	
								}else{
									echo mensajes("Error al Cargar El Archivo en PDF","rojo");
								}
							}
							
							echo mensajes('Se ha Registrado la Actividad con Exito','verde');
						}
					}
				?>
            	<table class="table table-bordered">
                	<tr class="info">
                    	<td><strong>Descripcion</strong></td>
                        <td><strong><center>Fecha de Apertura</center></strong></td>
                        <td><strong><center>Fecha de Cierre</center></strong></td>
                        <td><strong><center>Estado</center></strong></td>
                        <td><strong><center>Descargar PDF</center></strong></td>
                        <td></td>
					</tr>
                    <?php 
						$sql=mysql_query("SELECT * FROM actividad WHERE materia='$id_materia'"); 
						while($row=mysql_fetch_array($sql)){
							$url_cod=cadenas().encrypt($row['id'],'URLCODIGO').'&id='.$url_act;
							$url_actividad=cadenas().encrypt($row['id'],'URLCODIGO');
					?>
                    <tr>
                    	<td><?php echo $row['titulo']; ?></td>
                        <td><center><?php echo fecha($row['apertura']); ?></center></td>
                        <td><center><?php echo fecha($row['cierre']); ?></center></td>
                        <td><center><?php echo estado(estado_actividad($row['id'])); ?></center></td>
                        <td>
                        	<center>
                            	<?php
									if (file_exists("actividad/".$row['id'].".pdf")){
										echo '<a href="actividad/vista.php?codigo='.$url_actividad.'" target="_blank">Descargar</a>';
									}else{
										echo 'Sin Actividad PDF';
									}
								?>
                            </center>
                        </td>
                        <td>
                        	<center>
                                <a href="actividad.php?cod=<?php echo $url_cod; ?>" class="btn btn-mini">
                                    <i class="icon-edit"></i>
                                </a>
                            </center>
                        </td>
					</tr>
                    <?php } ?>
                </table>
            </div>
       	 	<div class="span4"><br>
            	<table class="table table-bordered">
                	<tr>
	                    <td>
                        	<center>
                                <div class="btn-group">
                                    <a class="btn" href="material.php?id=<?php echo $url_act; ?>"><strong>Material de Estudio</strong></a>
                                    <a class="btn btn-info" href="actividad.php?id=<?php echo $url_act; ?>"><strong>Actividades</strong></a>
                                </div>
                            </center>
                        </td>
                    </tr>
                    <tr>
	                    <td>
                        	<div align="center">
                        	<form name="form1" enctype="multipart/form-data" method="post" action="">
	                            <input type="hidden" value="<?php echo $id_actividad; ?>" name="id_actividad">
                            	<strong>Descripcion de la Actividad</strong><br>
                                <input type="text" name="titulo" value="<?php echo $titulo; ?>" class="input-xlarge" autocomplete="off" required><br>
                                <strong>Fecha de Apertura</strong><br>
                                <input type="date" name="ini" value="<?php echo $ini; ?>" class="input-xlarge" autocomplete="off" required><br>
                                <strong>Fecha de Cierre</strong><br>
                                <input type="date" name="fin" value="<?php echo $fin; ?>" class="input-xlarge" autocomplete="off" required><br>
                                <strong>Documento en PDF</strong><br>
                                <input type="file" name="imagen"><br><br>
                                <button type="submit" class="btn btn-info"><strong><?php echo $boton; ?></strong></button>
                                <a href="actividad.php?id=<?php echo $url_act; ?>" class="btn"><strong>Cancelar</strong></a>
                            </form>
                            </div>                        
                        </td>
                    </tr>
    			</table>                
            </div>
        </div>
</body>
</html>