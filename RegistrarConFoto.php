<!DOCTYPE html>
<html>
  <head>
  	 <link rel="stylesheet" type="text/css" href="estilos/master.css" media="screen" />
  </head>
  <body>
		<?php
		include("funciones.php");
		// Create connection
		$conn = connect();

		$valor = $_POST['email'];
		$pass = $_POST['pass'];
		$telefono = $_POST['telefono'];

		if(filter_var($valor, FILTER_VALIDATE_EMAIL) == FALSE){

				echo "el correo no tiene un formato correcto";
				return false;

		}else{
			$sql = "SELECT * FROM usuario WHERE Email='{$_POST['email']}'";
			$result = $conn->query($sql);
			if ($result->num_rows > 0){

				echo "el usuario ya existe en la base de datos.";

			}else{

				if ((!preg_match("/^([a-zA-Z0-9_\.\-])+\@ikasle.ehu.es|\@ikasle.ehu.eus+$/",$valor)) || (!preg_match("/^([a-zA-Z0-9]{6,})$/",$pass)) || (!preg_match("/^\d{9}$/",$telefono))) {

						echo "error al validar en el servidor, no se ha podido registrar";

						return false;

				}else{

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
					
				}
			}
		}
			?>
			<a href="VerUsuariosConFoto.php">Ver todos los datos de la tabla</a>
	</body>
</html>