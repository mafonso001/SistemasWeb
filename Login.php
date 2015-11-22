<?php
	include("funciones.php");
	// Create connection
	$conn = connect();
	//$_POST['email'];
//Este es llamado desde el login.html que ya lo tengo creado antes llamaba a cargarfotos
//falta la conexion con la base de datos
//y la comprobacion con el usu y contraseña.

	$sql = "SELECT Tipo FROM usuario WHERE Email='{$_POST['email']}' AND Pass='{$_POST['pass']}'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0){

		session_start();
		$_SESSION["user"]=$_POST['email'];

		$obj = $result->fetch_object();

		$_SESSION["tipo"]=$obj->Tipo;
			//el usu exite con esa contraseña
		$conn->close();
		//echo "el usuario si existe";
		if ($_SESSION["tipo"] == 'A'){
			header("Location: GestionPreguntas.php");
		} else{
			header("Location: modificarPreguntas.php");
		}
	    
			//cambio la localizacion de este archivo== lo redirije
			//la base de datos sigue abierta
	} else {
		$conn->close();
			//el servidor llama a su anterior referencia
		header("Location: login.html");
		//echo "el usuairo no existe";
	}
?>
