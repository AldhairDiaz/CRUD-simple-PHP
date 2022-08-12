<?php
include("validaciones.php");
$errores=array();

	$usuario=isset($_REQUEST['usuario'])? $_REQUEST['usuario']:null;
	$password=isset($_REQUEST['pass'])? $_REQUEST['pass']:null;
	$correo=isset($_REQUEST['correo'])? $_REQUEST['correo']:null;

	if ($_SERVER['REQUEST_METHOD']=='POST') {

		if (!validaRequerido($usuario)) {
			$errores[]='El campo Usuario no debe estar vacio';
			# code...
		}
		if (!validaRequerido($password)) {
			$errores[]='El campo Password no debe estar vacio';
			# code...
		}
		if (!validaEmail($correo)) {
			$errores[]='El campo Correo no debe estar vacio o no es el formato correcto (...@...)';
			# code...
		}



		$conexion=mysqli_connect("localhost","root","","practica") or die("problemas con la conexion");
		$query="INSERT INTO usuarios (usuario,password,correo) values('$_REQUEST[usuario]','$_REQUEST[pass]','$_REQUEST[correo]')";

		if (!$errores) {
			if ($resultados=mysqli_query($conexion,$query)) {
				header('Location:superusuario.php');
			}else{
				echo"hubo un error";
			}
		}
		
		
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Registro de usuarios</title>
	<h1>Registrate Gratis</h1>


</head>
<body>

	<?php if ($errores):  ?>
		<u style="color: #f00;">
			<?php foreach($errores as $error):  ?>
				<li><?php echo $error  ?></li>
			<?php endforeach;  ?>	
		</u>
	<?php endif;  ?>


	<form action="" method="post">
		<p>
			<label for="usuario">usuario</label>
			<input id="usuario"type="text" name="usuario" value="<?php if(isset($usuario)){echo $usuario;}?>">
		</p>
		<p>
			<label for="pass">Password</label>
			<input id="pass"type="password" name="pass" value="<?php if(isset($password)){echo $password;}?>">
		</p>
		<p>
			<label for="correo">correo</label>
			<input id="correo"type="text" name="correo" value="<?php if(isset($correo)){echo $correo;}?>">
		</p>
		<p>
			<input type="submit" value="Registrar"> <a href="index.php">Regresar</a>
			<a href="superusuario.php">TablaBD</a>
		</p>
	</form>

</body>
</html>