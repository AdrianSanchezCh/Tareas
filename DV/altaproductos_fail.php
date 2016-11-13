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
		<title>Registro de Productos</title>
		<link href = "css/login.css" rel = "stylesheet" type = "text/css">
		<script>
			
		function validarTipoProducto()
			{
				indice = document.getElementById("tipo_producto").selectedIndex;
				if( indice == null || indice==0 ) {
					alert('Seleccione tipo de Producto');
					return false;
				} else { return true;}
			}


			function validarNombre()
			{
				valor = document.getElementById("nombre").value;
				if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ) {
					alert('Falta Llenar Nombre');
					return false;
				} else { return true;}
			}
			
			function validarCosto()
			{
				valor = document.getElementById("costo").value;
				if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ) {
					alert('Falta Llenar Usuario');
					return false;
				} else { return true;}
			}

			function validarPiezas()
			{
				valor = document.getElementById("piezas").value;
				if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ) {
					alert('Falta Llenar Email');
					return false;
				} else { return true;}
			}
			
			function validarDescrip()
			{
				valor = document.getElementById("descrip").value;
				if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ) {
					alert('Falta Llenar la Descripcion');
					return false;
					} else { return true; }
					
				}
			}
			
			
			
			function validar()
			{
				if(validarNombre() && validarCosto() && validarPiezas() && validarTipoProducto() && validarDescrip())
				{
					document.productos.submit();
				}
			}
			
		</script>
		
	</head>
	
	<body background="fondo.jpg " >
		
		
	<center>
		<div class="menuadmin"><img src="imges_DV/NewLogo.png" width="200px" height="200px" />
		<form class="productos" id="productosp" name="productosp" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" > 
	
				<fieldset > <legend>Nuevo Producto</legend>
					<br>
					<div><label>Tipo Usuario:</label>
						<select id="tipo_producto" name="tipo_producto">
							<option value="Cupcake" required>Cupcake</option>
							<option value="Pastel" required>Pastel</option>
							<option value="Flan" required>Flan</option>
							<option value="Chessecake" required>Chessecake</option>
							<option value="Otro" required>Otro</option>
						</select>
					</div>
					<br/>
			
			
			<div><label>Nombre:</label><input id="nombre" name="nombre" type="text"></div>
			<br />
			<div><label>Costo:</label><input id="costo" name="costo" type="text"></div>
			<br />
			<div><label>Piezas:</label><input id="piezas" name="piezas" type="text"></div>
			<br />
			<div><label>Descripcion:</label><input  id="descrip" name="descrip" type="text"></div>
			<br />
			<br />
			
			<div><input id="registrop" name="registrarp" type="button" value="Registrar" onClick="validar();">

			<a href="admin.php" target="_self"> <input type = "button" id="invited" name = "invited" value="Regresar"></div> 
			</fieldset>
			</div>
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