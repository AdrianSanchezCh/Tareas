<?php
	require('conexion.php');
	
	session_start();
	
	if(isset($_SESSION["id_usuario"])){
		header("Location: admin.php");
	}
	
	if(!empty($_POST))
	{
		$usuario = mysqli_real_escape_string($mysqli,$_POST['usuario']);
		$password = mysqli_real_escape_string($mysqli,$_POST['password']);
		$error = '';
		
		$sha1_pass = sha1($password);
		
		$sql = "SELECT id, id_tipo FROM usuarios WHERE usuario = '$usuario' AND password = '$sha1_pass'";
		$result=$mysqli->query($sql);
		$rows = $result->num_rows;
		
		if($rows > 0) {
			$row = $result->fetch_assoc();
			$_SESSION['id_usuario'] = $row['id'];
			$_SESSION['tipo_usuario'] = $row['id_tipo'];
			
			
			if($_SESSION['tipo_usuario']==1){	
					header("location: admin.php");
			} 
			if($_SESSION['tipo_usuario']==2){	
					header("location: index.html");
			} 
		}
		else {
			$error = "El nombre o contraseña son incorrectos";
		}
	}
?>

<html>
<head>
	<meta charset = "UTF-8">
	<title>Inicio</title>
	<link href = "css/login.css" rel = "stylesheet" type = "text/css">
	<script type="text/javascript" src="js/jquery.js">
		
			
</script>

</head>
<body background="fondo.jpg ">

<section class="formulario">
	<center>
			<div class="logo" href="index.html"><img src="imges_DV/NewLogo.png" width="200px" height="200px" /></div>
  
			<div class = "login"  >
			<form action = "<?php $_SERVER['PHP_SELF']; ?>" method = "POST">

			<fieldset>
				<legend>Inicio Sesión</legend>
								

				<div id="users" >	
							<p>
									<input type = "text" id="usuario" name = "usuario" placeholder = "Usuario" title = "Se nesecita un usuario" required>
							</p>

							<p>
									<input type = "password" id="password" name = "password" placeholder = "Contraseña" title = "Se nesecita una contraseña" required>
							</p>
							<p>
									<input name="login" type = "submit" value = "Entrar">
									<input type = "reset" value ="Limpiar">
							</p>
				</div>
				<div id="notuser"  >	
							<p>
									<a href="index.html" target="_self"> <input type = "button" id="invited" name = "invited" value="Invitado">
							</p>

							
							
				</div>
				</fieldset>

				<div>
						<p>
						<a href = "crearcuenta.php"> <input type = "button" id="crearCt" name = "crearCt" value="Crear Cuenta">
						</a>
						</p>
				</div>				




			
			</form>

			</div>
			<div style = "font-size:16px; color:#cc0000;"><?php echo isset($error) ? utf8_decode($error) : '' ; ?></div>


	</center>
</section>
</body>
</html>