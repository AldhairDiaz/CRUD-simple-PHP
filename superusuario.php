<!DOCTYPE html>
<html>
<head>
	<title>Administracion de Usuarios</title>
	<h1>SuperUsuario</h1><br>
	<h2> Agregue, Borre o Edite un usuario</h2>
</head>
<body >
	<a href="registro.php">Agregar Usuario</a>
	<?php
	$conexion=mysqli_connect("localhost","root","","practica") or die("problemas con la conexion");
	$registros=mysqli_query($conexion, "SELECT * FROM usuarios") or die("Problemas con el SELECT".mysql_error($conexion));
	?>
	<table border="1">
		<h3>Listado de Usuarios</h3>
		
		 
				<tr>
					<th>id</th>
					<th>usuario</th>					
					<th>password</th>
					<th>e-mail</th>	

				</tr>
				<?php 
				while ($reg=mysqli_fetch_array($registros)) {
					
				?>

				<tr >
					<td><?php echo $reg['id'];?></td>
					<td><?php echo $reg['usuario'];?></td>
					<td><?php echo $reg['password'];?></td>
					<td><?php echo $reg['correo'];?></td>
					<td><a class="button" href="modificarUsuario.php?usuario=<?php echo $reg['usuario'];?>">Modificar</a></td>
					<td><a class="button" href="borrarUsuario.php?usuario=<?php echo $reg['usuario'];?>">Borrar</a></td>
				</tr>
				<?php
				}

				?>
		
		
		
	</table>

</body>
</html>