<?php session_start();
include("validaciones.php");
$errores=array();
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Portada y Login</title>
	<h1>Voluntarios en acción</h1> 
</head>
<body>


	<?php
	
		if($_SERVER['REQUEST_METHOD']=='POST'){
			$usuario=isset($_REQUEST['usuario']) ? $_REQUEST['usuario'] : null;
			
			$password=isset($_REQUEST['password']) ? $_REQUEST['password'] : null;

			$mysqli=mysqli_connect("localhost","root","","practica") or die("problemas con la conexion");
			$sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' ";
			$resultado= mysqli_query($mysqli,$sql);	
			$datos_sesion=mysqli_fetch_array($resultado);
			
			if (!validaRequerido($registros['usuario'])) {
				$errores[]='El campo Usuario no debe estar vacio';
				# code...
			}
			if (!validaRequerido($password)) {
				$errores[]='El campo Password no debe estar vacio';
				# code...
			}
			
			

			
			
			//variables del formulario
			
			//comprobamos si los datos son correctos
			if($datos_sesion['usuario']==$usuario && $datos_sesion['password']==$password){
				
				//SI SIN CORRECTOS CREAMOS LA SESION
				$_SESSION['usuario']=$_REQUEST['usuario'];
				//redireccinamos a la pagina segura
				header('location:superusuario.php');
				die();
			}else{
				//si n son correctos, le informamos al usuario 
				echo '<p style="color: red">El usuario o clave no existe. </p>';
			}
		}
	?>



	<a href="registro.php">Registrate GRATIS</a>
	<form  method="post">
		<p>
			Usuario : <input type="text" name="usuario" placebolder="usuario" value="<?php if(isset($registros['usuario'])){echo $registros['usuario'];}?>">
		</p>
		<p>
			Contraseña: <input type="password" name="password" placebolder="Contraseña" value="<?php if(isset($registros['password'])){echo $registros['password'];}?>">
		</p>
		<input type="submit" value="Iniciar Sesion">
	</form>

</body>
</html>