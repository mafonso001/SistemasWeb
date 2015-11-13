<?php
//incluimos la clase nusoap.php
require_once("nusoap/lib/nusoap.php");
require_once("nusoap/lib/class.wsdlcache.php");
//require_once("recursoContraseña.php");
//creamos el objeto de tipo soapclient.
//donde se encuentra el servicio SOAP que vamos a utilizar.
$soapclient = new nusoap_client("http://localhost/ProyectoSW/recursoPass.php?wsdl",false);
//Llamamos la función que habíamos implementado en el Web Service
//e imprimimos lo que nos devuelve
$pass = $_GET['pass'];

$result = $soapclient->call("validar", array("x"=>$pass));

//echo '<h2>Request</h2><pre>' . htmlspecialchars($soapclient->request, ENT_QUOTES) . '</pre>';
//echo '<h2>Response</h2><pre>' . htmlspecialchars($soapclient->response, ENT_QUOTES) . '</pre>';
//echo '<h2>Debug</h2>';
//echo '<pre>' . htmlspecialchars($soapclient->debug_str, ENT_QUOTES) . '</pre>';
echo $result;
?>