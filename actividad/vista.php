<?php
	session_start();
	include_once('../php_conexion.php'); 
	include_once('../class/funciones.php');
	include_once('../class/class.php');
	if($_SESSION['tipo_usu']=='a' or $_SESSION['tipo_usu']=='p' or $_SESSION['tipo_usu']=='alumno'){
		if(!empty($_GET['codigo'])){
			$codigo=limpiar($_GET['codigo']);
			$codigo=substr($codigo,10);
			$codigo=decrypt($codigo,'URLCODIGO');
			
			$sql=mysql_query("SELECT * FROM actividad WHERE id='$codigo'");
			if($row=mysql_fetch_array($sql)){
				if($_SESSION['tipo_usu']=='a' or $_SESSION['tipo_usu']=='p'){
					
				}else{
					if(estado_actividad($row['id'])=='s'){
					}else{
						header('location:miscursos.php');			
					}
				}
			}else{
				header('location:miscursos.php');	
			}
		}else{
			header('location:miscursos.php');		
		}
	}else{
		header('location:miscursos.php');	
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Vista Material</title>
</head>

<body>
<iframe src="<?php echo $codigo.'.pdf'; ?>" width="100%" height="700"></iframe>

</body>
</html>