<?php 
session_start(); 

$_SESSION = array(); 

session_destroy(); 

if(empty($_SESSION['user']) and empty($_SESSION['tipo'])) 
{ 
echo "Te has deslogueado satisfactoriamente<br>"; 
echo "<a href="."index.php".">Volver a la página principal</a>"; 
} 
else 
{ 
echo "Ha habido un error, trata de desloguearte nuevamente<br>"; 
echo "<a href="."index.php".">Volver a la página principal</a>";
} 

?>
<html>
<head>
<title>Has salido!!</title>

</head>
<body>
Gracias por tu acceso
<br>
<br>
<a href="index.php">Inicio</a>
</body>
</html> 