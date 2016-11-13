<?php
	
	session_start();
	require 'conexion.php';
	
	if(!isset($_SESSION["id_usuario"])){
		header("Location: index.php");
	}
	
	$sql = "SELECT id, tipo FROM tipo_usuario";
	$result=$mysqli->query($sql);
	
	$bandera = false;
	
	if(!empty($_POST))
	{
		$nombre = mysqli_real_escape_string($mysqli,$_POST['nombre']);
		$usuario = mysqli_real_escape_string($mysqli,$_POST['usuario']);
		$email = mysqli_real_escape_string($mysqli,$_POST['email']);
		$password = mysqli_real_escape_string($mysqli,$_POST['password']);
		$tipo_usuario = $_POST['tipo_usuario'];
		$sha1_pass = sha1($password);
		
		$error = '';
		
		$sqlUser = "SELECT id FROM usuarios WHERE usuario = '$usuario'";
		$resultUser=$mysqli->query($sqlUser);
		$rows = $resultUser->num_rows;
		
		if($rows > 0) {
			$error = "El usuario ya existe";
			} else {
			
			$sqlPerson = "INSERT INTO personal (nombre, Email) VALUES('$nombre','$email')";
			$resultPerson=$mysqli->query($sqlPerson);
			$idPersona = $mysqli->insert_id;
			
			$sqlUsuario = "INSERT INTO usuarios (usuario, password, id_personal, id_tipo) VALUES('$usuario','$sha1_pass','$idPersona','$tipo_usuario')";
			$resultUsuario = $mysqli->query($sqlUsuario);
			
			if($resultUsuario>0)
			$bandera = true;
			else
			$error = "Error al Registrar";
			
		}
	}
	
?>

<html>
	<head>
		<title>Registro</title>
		<link href = "css/login.css" rel = "stylesheet" type = "text/css">
		<script>
			function validarNombre()
			{
				valor = document.getElementById("nombre").value;
				if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ) {
					alert('Falta Llenar Nombre');
					return false;
				} else { return true;}
			}
			
			function validarUsuario()
			{
				valor = document.getElementById("usuario").value;
				if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ) {
					alert('Falta Llenar Usuario');
					return false;
				} else { return true;}
			}

			function validarEmail()
			{
				valor = document.getElementById("email").value;
				if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ) {
					alert('Falta Llenar Email');
					return false;
				} else { return true;}
			}
			
			function validarPassword()
			{
				valor = document.getElementById("password").value;
				if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ) {
					alert('Falta Llenar Password');
					return false;
					} else { 
					valor2 = document.getElementById("con_password").value;
					
					if(valor == valor2) { return true; }
					else { alert('Las contraseña no coinciden'); return false;}
				}
			}
			
			function validarTipoUsuario()
			{
				indice = document.getElementById("tipo_usuario").selectedIndex;
				if( indice == null || indice==0 ) {
					alert('Seleccione tipo de usuario');
					return false;
				} else { return true;}
			}
			
			function validar()
			{
				if(validarNombre() && validarUsuario() && validarPassword() && validarTipoUsuario() && validarEmail())
				{
					document.registro.submit();
				}
			}
			
		</script>
		
	</head>
	
	<body background="fondo.jpg " >
		
		
		<center>
		<div class="menuadmin" ><img src="imges_DV/NewLogo.png" width="200px" height="200px" />
		<form class="registro" id="registro" name="registro" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" > 
		<fieldset > <legend>Nuevo Usuario</legend>
			<br>
			<div><label>Nombre:</label><input id="nombre" name="nombre" type="text" ></div>
			<br />
			
			
			<div><label>Usuario:</label><input id="usuario" name="usuario" type="text"></div>
			<br />

			<div><label>Email:</label><input id="email" name="email" type="Email"></div>
			<br />
			
			<div><label>Password:</label><input id="password" name="password" type="password"></div>
			<br />
			
			<div><label>Confirmar Password:</label><input id="con_password" name="con_password" type="password"></div>
			<br />
			
			<div><label>Tipo Usuario:</label>
				<select id="tipo_usuario" name="tipo_usuario">
					<option value="0">Seleccione tipo de usuario...</option>
					<?php while($row = $result->fetch_assoc()){ ?>
						<option value="<?php echo $row['id']; ?>"><?php echo $row['tipo']; ?></option>
					<?php }?>
				</select>
			</div>
			<br />
			
			<div><input id="reg" name="registar" type="button" value="Registrar" onClick="validar();">
			<a href="admin.php" target="_self"> <input type = "button" id="invited" name = "invited" value="Regresar"></div> 
			</fieldset>
		</form>
		
		</div>
		</center>

		
		<?php if($bandera) { ?>
			<h1>Registro exitoso</h1>
			
			
			<?php }else{ ?>
			<br />
			<div style = "font-size:16px; color:#cc0000;"><?php echo isset($error) ? utf8_decode($error) : '' ; ?></div>
			
		<?php } ?>
		
	</body>
	
</html>