<?php
	require('conexion.php');
	
	session_start();
	if(isset($_SESSION["id_usuario"])){
		header("Location: index.php");
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
		
			function mostrar(id) {
    if (id == "user1"||id=="user2") {
        $("#user").show();
        $("#notuser").hide();
        
    }

    if (id == "notuser") {
        $("#user").hide();
        $("#notuser").show();
        
    }

}
</script>
</head>
<body background="fondo.jpg ">

<section class="formulario">
	<center>
			<div class="logo" href="index.html"><img src="imges_DV/NewLogo.png" width="200px" height="200px" /></div>
  
			<div class = "login"  >
			<form action = "<?php $_SERVER['PHP_SELF']; ?>" method = "POST">

			<fieldset>
				<legend>Crear Cuenta Nueva</legend>
				

				

				





			</fieldset>
			</form>

			</div>
			<div style = "font-size:16px; color:#cc0000;"><?php echo isset($error) ? utf8_decode($error) : '' ; ?></div>


	</center>
</section>
</body>
</html>