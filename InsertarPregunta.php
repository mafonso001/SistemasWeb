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

		session_start();
		$user = $_SESSION["user"];

		if($user == ""){
			echo "usted no esta conectado";
			echo "</br>";
			echo "<a href="."Login.html".">Login</a>";
			$conn->close();
		}else{
			if($_POST['pregunta']=="" || $_POST['respuesta'] =="" || $_POST['comple']==""){

			echo "debe rellenar todos los campos";
			echo "<a href="."insertarPregunta.html".">Volver</a>";

			}else{

				//Aqui la insertamos en el XML de preguntas
				$doc = new DOMDocument();
				$doc->load( 'xml/preguntas.xml', LIBXML_NOBLANKS);
				$doc->formatOutput = true;

				// Obtener la raiz de elemento "assessmentItems"
				$root = $doc->documentElement;

				// Creamos los elementos del arbol
				$assessmentItem = $doc->createElement("assessmentItem");
				$itemBody = $doc->createElement("itemBody");
				$p = $doc->createElement("p","{$_POST['pregunta']}");
				$correctResponse = $doc->createElement("correctResponse");
				$value = $doc->createElement("value","{$_POST['respuesta']}");


				// Crear y añadir un assessmentItem al nuevo elemento
				$assessmentItem->appendChild($itemBody);

				//Aqui añadimos los atributos de assessmenItem
				$assessmentItem->setAttribute('complexity', $_POST['comple']);
				$assessmentItem->setAttribute('subject', $_POST['tema']);

				$itemBody->appendChild($p);
				$assessmentItem->appendChild($correctResponse);
				$correctResponse->appendChild($value);

				//lasentamos los nodos creados en la raiz
				$root->appendChild($assessmentItem);

				//lo guardamos todo
				$doc->save('xml/preguntas.xml');

				//Aqui insertamos la pregunta en la base de datos
				$sql = "INSERT INTO preguntas (Email, Pregunta, Respuesta, Complejidad)
						VALUES ('$user','{$_POST['pregunta']}', '{$_POST['respuesta']}', '{$_POST['comple']}')";

				if ($conn->query($sql) === TRUE) {
					echo "New record created successfully";
				} else {
					echo "Error: " . $sql . "<br>" . $conn->error;
				}
					$conn->close();
			}
		}

		
		
		?>
	</body>
</html>