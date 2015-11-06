<?php
	include(f"unciones.php");
	//Configuracion de la conexion a base de datos
	$conn = connect();
	//consulta todos los empleados

	session_start();
	$user = $_SESSION["user"];

	$result = mysqli_query($conn, "SELECT * FROM preguntas WHERE Email=$user");
	$row_cnt = $result->num_rows;

	for ($i=0;$i<$row_cnt;$i++) {
		mysqli_data_seek ($result, $i);
		$extraido= mysqli_fetch_array($result);

		$tam = 40;

		echo "<td>".$extraido['Pregunta']."</td>";
		echo "<td>".$extraido['Complejidad']."</td>";
		echo "</tr>";
	}

	mysqli_free_result($result);
	mysqli_close($conn);

	//muestra los datos consultados

}
?>