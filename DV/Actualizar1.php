<?php
	
	$enlace =  mysql_connect('localhost', 'tecweb', '123web');
		if (!$enlace) {
		    die('No pudo conectarse: ' . mysql_error());
		}
		echo 'Conectado satisfactoriamente';
	    mysql_select_db('login', $enlace) or die('Could not select database.');
			
		 $con=mysql_query("SELECT * FROM postres");
          $reg=mysql_fetch_array($con);

	?>

	<html>
	<head>
	<meta charset = "UTF-8">
	
		<title>Actualizar Prueba </title>
	</head>
	<body>

<form action=""   method="POST">

	<select name="actualizar" id="actializar">
		<option value="">SKU </option>
		 <?php  do{
                  $sku=$reg['SKU'];
         ?>
         
         <option value="<?php echo $sku ?>"><?php echo $sku ?></option>
         <?php

         	$row--;
            }while ( $reg=mysql_fetch_array($con) );
         ?>




	</select>
	

</form>





	
	</body>
	</html>