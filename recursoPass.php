<?php
//incluimos la clase nusoap.php
require_once('nusoap/lib/nusoap.php');
require_once('nusoap/lib/class.wsdlcache.php');
//creamos el objeto de tipo soap_server
//echo "fase1";
$ns="http://localhost/ProyectoSW/nusoap/samples";
$server = new soap_server;
$server->configureWSDL("validar",$ns);
$server->wsdl->schemaTargetNamespace=$ns;
//registramos la función que vamos a implementar
$server->register("validar",array("x"=>"xsd:string"),array("z"=>'xsd:string'),$ns);
//implementamos la función
function validar ($x){

	$file = fopen("toppasswords.txt", "r") or exit("Unable to open file!");

	//Output a line of the file until the end is reached

	while(($buffer = fgets($file)) !== false) {
		$buffer = trim($buffer);
		if (($var1 = strcmp($buffer, $x)) == 0){
			return "NO";
		}
	}
	fclose($file);
	return "SI";
}
//llamamos al método service de la clase nusoap
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);
?>
