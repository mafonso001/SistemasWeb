<!DOCTYPE html>
<html>
  <head>
  	 <link rel="stylesheet" type="text/css" href="estilos/master.css" media="screen" />
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
		session_start();
		$user = $_SESSION["user"];

		if($_POST['pregunta']=="" || $_POST['respuesta'] =="" || $_POST['comple']==""){

			echo "debe rellenar todos los campos";
			echo "<a href="."insertarPregunta.html".">Volver</a>";

		}else{

			$sql = "INSERT INTO preguntas (Email, Pregunta, Respuesta, Complejidad)
					VALUES ('$user','{$_POST['pregunta']}', '{$_POST['respuesta']}', '{$_POST['comple']}')";

			if ($conn->query($sql) === TRUE) {
				echo "New record created successfully";
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
				$conn->close();
		}
		
		?>
	</body>
</html>