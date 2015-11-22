<?php
function connect(){

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "quiz";

	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}else{
		return $conn;
	}
}

function insertQuestion(){

		$conn = connect();

		session_start();
		$user = $_SESSION["user"];

		if($user == ""){
			echo "usted no esta conectado";
			//echo "</br>";
			//echo "<a href="."Login.html".">Login</a>";
			$conn->close();
		}else{
			if($_POST['pregunta']=="" || $_POST['respuesta'] =="" || $_POST['comple']==""){

			echo "debe rellenar todos los campos";
			//echo "<a href="."insertarPregunta.html".">Volver</a>";

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
}

function updateQuestions(){

		$conn = connect();

		session_start();
		$user = $_SESSION["user"];

		if($user == ""){
			echo "usted no esta conectado";
			//echo "</br>";
			//echo "<a href="."Login.html".">Login</a>";
			$conn->close();
		}else{
			if($_POST['Pregunta']=="" || $_POST['Respuesta'] =="" || $_POST['Complejidad']==""){

			echo "debe rellenar todos los campos";
			//echo "<a href="."insertarPregunta.html".">Volver</a>";

			}else{

				//Aqui insertamos la pregunta en la base de datos
				$sql = "UPDATE preguntas SET Pregunta='{$_POST['Pregunta']}', Respuesta='{$_POST['Respuesta']}', Complejidad='{$_POST['Complejidad']}'
						WHERE Id='{$_POST['Id']}'";

				if ($conn->query($sql) === TRUE) {
					echo "New record created successfully";
					echo "</br>";
					echo "<a href=".'"modificarPreguntas.php"'.">Volver</a>";
				} else {
					echo "Error: " . $sql . "<br>" . $conn->error;
				}
					$conn->close();
			}
		}
}

function viewAllQuestions(){
	//Configuracion de la conexion a base de datos
	$conn = connect();
	//consulta todos los empleados

	session_start();
	$user = $_SESSION["user"];

	$result = mysqli_query($conn, "SELECT * FROM preguntas");
	$row_cnt = $result->num_rows;

	echo "<h3>logueado como =".$user."</h3>";
	echo "<h3>Numero de preguntas =".$row_cnt."</h3>";

	echo "<table border="."1"." width="."900px".">";
	echo "<caption>Preguntas</caption>";
		echo "<tbody>";
    		echo "<tr>";
    		  echo "<td>Id</td>";
    		  echo "<td>Email</td>";
		      echo "<td>Pregunta</td>";
		      echo "<th>Respuesta</th>";
		      echo "<th>Complejidad</th>";
		      echo "<th>Opciones</th>";
    		echo "</tr>";
		echo "</tbody>";
	echo "</table> ";

	for ($i=0;$i<$row_cnt;$i++) {
		mysqli_data_seek ($result, $i);
		$extraido= mysqli_fetch_array($result);

		$tam = 40;
		echo "<form method=".'"POST"'."action=".'"updateQuestion.php"'.'>';
	
		echo "<table border="."1"." width="."900px".">";
			echo "<tbody>";
				echo "<tr>";
			        echo "<td><input type=".'"text"'."id=".'"Id"'."name=".'"Id"'."value='".$extraido['Id']."'/></td>"; 
			        echo "<td>".$extraido['Email']."</td>";
					echo "<td><input type=".'"text"'."id=".'"Pregunta"'."name=".'"Pregunta"'."value='".$extraido['Pregunta']."'/></td>"; 
					echo "<td><input type=".'"text"'."id=".'"Respuesta"'."name=".'"Respuesta"'."value='".$extraido['Respuesta']."'/></td>"; 
					echo "<td><input type=".'"text"'."id=".'"Complejidad"'."name=".'"Complejidad"'."value='".$extraido['Complejidad']."'/></td>"; 
					echo "<td><input type=".'"submit"'."value=".'"modificar"'."/></td>";
				echo "</tr>";
			echo "</tbody>";
		echo "</table> ";

		echo "</form>";
	}

mysqli_free_result($result);
mysqli_close($conn);
}

function viewQuestions(){

	//Configuracion de la conexion a base de datos
	$conn = connect();
	//consulta todos los empleados

	session_start();
	$user = $_SESSION["user"];

	$result = mysqli_query($conn, "SELECT * FROM preguntas WHERE Email='$user'");
	$row_cnt = $result->num_rows;

	echo "<h3>logueado como =".$user."</h3>";
	echo "<h3>Numero de preguntas =".$row_cnt."</h3>";

	echo "<table border="."1".">";
	echo "<caption>Preguntas</caption>";
  		echo "<tbody>";
    		echo "<tr>";
		      echo "<td>Enunciado</td>";
		      echo "<th>Respuesta</th>";
    		echo "</tr>";
    		echo "<tr>";

	for ($i=0;$i<$row_cnt;$i++) {
		mysqli_data_seek ($result, $i);
		$extraido= mysqli_fetch_array($result);

		$tam = 40;

		echo "<td>".$extraido['Pregunta']."</td>";
		echo "<td>".$extraido['Respuesta']."</td>";
		echo "</tr>";
	}

	echo "</tbody>";
echo "</table> ";
mysqli_free_result($result);
mysqli_close($conn);
}

	//muestra los datos consultados

?>