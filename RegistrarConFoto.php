<!DOCTYPE html>
<html>
  <head>
  	 <link rel="stylesheet" type="text/css" href="estilos/style.css" media="screen" />
  </head>
  <body>
		<?php
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "quiz";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 

		$target_path = "uploads/";
		$target_path = $target_path . basename( $_FILES['uploadedfile']['name']); 
		if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) { echo "El archivo ". basename( $_FILES['uploadedfile']['name']). " ha sido subido";
		} else{
		echo "El perfil ha sido creado sin foto.";
		}

		//echo "<br/>"

		$sql = "INSERT INTO usuario (Nombre, Apellidos, Pass, Telefono, Email, Foto, Especialidad, Tecnologias)
		VALUES ('{$_POST['nombre']}','{$_POST['apellido']}', '{$_POST['pass']}', '{$_POST['telefono']}', '{$_POST['email']}', '".$target_path."', null, null)";

		if ($conn->query($sql) === TRUE) {
		    echo "New record created successfully";
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}

		$conn->close();
		?>

		<a href="VerUsuariosConFoto.php">Ver todos los datos de la tabla</a>
	</body>
</html>
