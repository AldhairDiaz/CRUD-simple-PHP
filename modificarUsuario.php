<?php
include("validaciones.php");
$errores=array();

	$usuario=isset($_REQUEST['usuario'])? $_REQUEST['usuario']:null;
	$password=isset($_REQUEST['pass'])? $_REQUEST['pass']:null;
	$correo=isset($_REQUEST['correo'])? $_REQUEST['correo']:null;

	$conexion=mysqli_connect("localhost","root","","practica") or die("problemas con la conexion");

	if ($usuario!="") {
			$resultado=mysqli_query($conexion,"SELECT * FROM usuarios where usuario='$usuario'" ) or die ("Problemas en el select-> ".mysqli_error($conexion));
		$registros=mysqli_fetch_array($resultado);
	}

	if ($_SERVER['REQUEST_METHOD']=='POST') {

		
		if (!validaRequerido($password)) {
			$errores[]='El campo Password no debe estar vacio';
			# code...
		}
		if (!validaEmail($correo)) {
			$errores[]='El campo Correo no debe estar vacio o no es el formato correcto (...@...)';
			# code...
		}



		$query="UPDATE usuarios SET password='$_REQUEST[pass]',correo='$_REQUEST[correo]' where usuario='$_REQUEST[usuario]'  ";

		
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
	<title>Modificar usuarios</title>
	<h1>Puedes modificar un usuario</h1>


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
			<input id="usuario"type="text" name="usuario" value="<?php if(isset($registros['usuario'])){echo $registros['usuario'];}?>">
		</p>
		<p>
			<label for="pass">Password</label>
			<input id="pass"type="text" name="pass" value="<?php if(isset($registros['password'])){echo $registros['password'];}?>">
		</p>
		<p>
			<label for="correo">correos</label>
			<input id="correo"type="text" name="correo" value="<?php if(isset($registros['correo'])){echo $registros['correo'];}?>">
		</p>
		<p>
			<input type="submit" value="Modificar"> <a href="index.php">Regresar</a>
			<a href="superusuario.php">TablaBD</a>
		</p>
	</form>

</body>
</html>