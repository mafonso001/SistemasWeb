<?php 

$host = "localhost"; 
$user = "root"; 
$pass = ""; 
$dbname = "quiz";           

$sesion = "200";

$singular1 = "Hay";
$singular2 = "Invitado Online.";

$plural1 = "Hay";
$plural2 = "Invitados Online.";

$remoteAdd = $_SERVER['REMOTE_ADDR'];
$phpSelf = $_SERVER['PHP_SELF'];

$tiempo=time();                                                                                   
$timeout=$tiempo-$sesion; 

mysql_connect($host,$user,$pass) or die('No se puede conectar al servidor.' );     
                                                    
mysql_db_query($dbname, "INSERT INTO useronline VALUES ('$tiempo','$remoteAdd','$phpSelf')") or die("ERROR DEL INSERT");

mysql_db_query($dbname, "DELETE FROM useronline WHERE tiempo<$timeout") or die("ERROR AL BORRAR");

session_start();
$user=$_SESSION["user"];

$resultado=mysql_db_query($dbname, "SELECT DISTINCT ip FROM useronline WHERE file='$phpSelf'") or die("ERROR EN SELECT");

$resultado2=mysql_db_query($dbname, "SELECT * FROM preguntas") or die("ERROR EN SELECT");

$resultado3=mysql_db_query($dbname, "SELECT * FROM preguntas WHERE Email='$user'") or die("ERROR EN SELECT");

$usuario  =mysql_num_rows($resultado); 
$numpreguntastot =  mysql_num_rows($resultado2);         
$numpreguntasusr =  mysql_num_rows($resultado3);         
                               
mysql_close();                                                                                                
if ($usuario==1){
	echo "<font size=5>".$singular1.$usuario.$singular2."</font></br>";
	echo "Preguntas en la base de datos:  ";
	echo "<font size=5>".$numpreguntastot."</font>";
	echo "/";
	echo "<font size=5>".$numpreguntasusr."</font>";
} else { 
	echo "<font size=5>".$plural1.$usuario.$plural2."</font></br>";
	echo "Preguntas en la base de datos:  ";
	echo "<font size=5>".$numpreguntastot."</font>";
	echo "/";
	echo "<font size=5>".$numpreguntasusr."</font>"; 
}
?>