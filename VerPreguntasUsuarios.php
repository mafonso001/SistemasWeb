<html><head><meta charset="utf-8"></head>

  	 <link rel="stylesheet" type="text/css" href="estilos/master.css" media="screen" />

<body>
<?php
	include("funciones.php");

	// Create connection
	$conn = connect();

	//$tildes = $link->query("SET NAMES 'utf8'"); //Para que se muestren las tildes

	$result = mysqli_query($conn, "SELECT * FROM preguntas");
	$row_cnt = $result->num_rows;
	?>

	<table border="1">
  		<caption>Preguntas</caption>
  		<tbody>
    		<tr>
		      <td>Enunciado</td>
		      <th>Complejidad</th>
    		</tr>
    		<tr>
				<?php
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
				?>
	  </tbody>
	</table> 
</br>
<a href="index.html">Volver al inicio</a>
</body>
</html>