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

$sql = "INSERT INTO usuario (Nombre, Apellidos, Pass, Telefono, Email, Foto, Especialidad, Tecnologias)
VALUES ('{$_POST['nombre']}','{$_POST['apellido']}', '{$_POST['pass']}', '{$_POST['telefono']}', '{$_POST['email']}', null, null, null)";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

<a href="verDatos.php">Ver todos los datos de la tabla</a>