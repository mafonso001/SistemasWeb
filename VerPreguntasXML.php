<html><head><meta charset="utf-8"></head>

  	 <link rel="stylesheet" type="text/css" href="estilos/master.css" media="screen" />

<body>
<?php
	
?>

	<table border="1">
  		<caption>Preguntas</caption>
  		<tbody>
    		<tr>
		      <td>Enunciado</td>
		      <th>Respuesta</th>
		      <td>Complejidad</td>
    		</tr>
    		<tr>
				<?php
					$doc = simplexml_load_file('xml/preguntas.xml');
					foreach ($doc->assessmentItem as $child):
						$itemBody=$child->itemBody;
						$p=$itemBody->p;
						echo "<td>".$p."</td>";
						$correctResponse=$child->correctResponse;
						$value=$correctResponse->value;
						echo "<td>".$value."</td>";	
						$complejidad=$child["complexity"];
						echo "<td>".$complejidad."</td>";
						echo "</tr>";
					endforeach;
				?>
	  </tbody>
	</table> 
</br>
<a href="index.html">Volver al inicio</a>
</body>
</html>