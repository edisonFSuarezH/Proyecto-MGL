<?php
		session_start();
		include_once('php_conexion.php'); 
		include_once('class/funciones.php');
		include_once('class/class.php');
		
		if(!empty($_POST['usuario']) and !empty($_POST['contra'])){
			$usuario=limpiar($_POST['usuario']);
			$objNit=new Consultar_Profesor($usuario);
			$nit=$objNit->consultar('nit');
			$contra=limpiar($_POST['contra']);
			$can=mysql_query("SELECT * FROM profesor WHERE usu='".$usuario."' and con='".$contra."'");
			echo "SELECT * FROM profesor WHERE usu='".$usuario."' and con='".$contra."'";
			if($dato=mysql_fetch_array($can)){
				$_SESSION['username']=$dato['usu'];
				$_SESSION['tipo_usu']=$dato['tipo'];
				$_SESSION['cod_usu']=$dato['nit'];
 				
				
				if($dato['estado']=='s'){
					if($_SESSION['tipo_usu']=='a'){
						echo '<meta http-equiv="refresh" content="0;url=administrador.php">';
						#header('location:administrador.php');
					}
				}
			}
		}
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Login-Instituto Mario Gutiérrez López de Orcotuna</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
	padding-top: 150px;
	padding-bottom: 40px;
	background-color: #f5f5f5;
	background-image: url(img/bg5.jpg);
      }

      .form-signin {
        max-width: 400px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #D6EAF8;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }

    </style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
    <link rel="shortcut icon" href="img/log0.jpg">
  </head>

  <body>

    <div class="container">
    	
      <form name="form1" method="post" action="" class="form-signin">
        <center><h2 class="form-signin-heading">Bienvenid@</h2></center>
        <input type="text" name="usuario" class="input-block-level" placeholder="Usuario" autocomplete="off">
        <input type="password" name="contra" class="input-block-level" placeholder="Contraseña" autocomplete="off">
      <center><button class="btn btn-large btn-primary" type="submit">Iniciar Sesión</button></center> 
        <p>&nbsp;</p>
<?php
		$act="1";
		if(!empty($_POST['usuario']) and !empty($_POST['contra'])){
			$usuario=limpiar($_POST['usuario']);
			$objNit=new Consultar_Profesor($usuario);
			$nit=$objNit->consultar('nit');
			$contra=limpiar($_POST['contra']);
			$can=mysql_query("SELECT * FROM profesor WHERE usu='".$usuario."' and con='".$contra."'");
        echo mensajes('Bienvenido Usuario Ingresando...','verde');
			if(!$dato=mysql_fetch_array($can)){
				if($act=="1"){
					echo '<div class="alert alert-error" align="center"><strong>Usuario y Contraseña Incorrecta</strong></div>';
				}else{
					$act="0";
				}
			}else{
				if($dato['estado']=='n'){
					echo '<div class="alert alert-error" align="center"><strong>Consulte con el Administrador</strong></div>';
				}
			}
		}else{
			
		}
	?>
      </form>
    </div> <!-- /container -->

  </body>
</html>
