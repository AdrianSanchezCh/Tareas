<?php
	
	session_start();
	require 'conexion.php';
	
	if(!isset($_SESSION["id_usuario"])){
		header("Location: index.php");
	}
	
	$idUsuario = $_SESSION['id_usuario'];
	
	$sql = "SELECT u.id, p.nombre FROM usuarios AS u INNER JOIN personal AS p ON u.id_personal=p.id WHERE u.id = '$idUsuario'";
	$result=$mysqli->query($sql);
	
	$row = $result->fetch_assoc();
?>

<html>
	<head>
	
		<meta charset = "UTF-8">
		<title>Administracion</title>
		<link href = "css/login.css" rel = "stylesheet" type = "text/css">
		<script type="text/javascript" src="js/jquery.js"></script>
	</head>
	
	<body background="fondo.jpg ">
	
			<h1 align="center"><?php echo 'Bienvenid@ '.utf8_decode($row['nombre']); ?></h1>
	
			


			<section class="Opciones">
			<center>
				<div class="logo" ><img src="imges_DV/NewLogo.png" width="200px" height="200px" /></div>
				<div class = "menuadmin"  >
					
						<fieldset > <legend>Opciones</legend>
						     <?php if($_SESSION['tipo_usuario']==1) { ?>
								<a href="registro.php"> <input type="button" name="Reguser" value="Registrar Usuarios">
								<br><br>	
								<a href="altaproductos.php"> <input type="button" name="Reguser" value="Alta de Productos">
								<br><br>
								<a href="bajaproductos.php"> <input type="button" name="Reguser" value="Baja de Productos">
								<br><br>
								<a href="modificaproductos.php"> <input type="button" name="Reguser" value="Modifica un Producto">
								<br><br>
								<a href="reporteventas.php"> <input type="button" name="Reguser" value="Reporte de Ventas">
								<br><br>
								<a href="reporteproductos.php"> <input type="button" name="Reguser" value="Reporte de Existencias">
								<br><br>

								<?php } ?>




						</fieldset>
						<a href="logout.php">Cerrar Sesi&oacute;n</a>
					
				</div>
			</center>
			</section>







	
	
	</body>
</html>