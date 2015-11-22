<!DOCTYPE html>
<html>
  <head>
    <script language = "javascript">

     function objetoAjax(){
      var xmlhttp=false;
      try {
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
      } catch (e) {
        try {
           xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (E) {
          xmlhttp = false;
          }
      }

      if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
        xmlhttp = new XMLHttpRequest();
      }
      return xmlhttp;
    }

    function mostrarPreguntas(){

      divResultado = document.getElementById('respuesta2');
      ajax=objetoAjax();

      ajax.onreadystatechange=function() {
        if (ajax.readyState==4) {
          divResultado.innerHTML = ajax.responseText;
        }
      }

      ajax.open("GET", "VerTodasLasPreguntas.php");
      ajax.send(null)
    }

    </script> 

    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
    <link rel="stylesheet" type="text/css" href="estilos/register.css" media="screen" />
  <script type="text/javascript" src="scripts/scriptValores.js"></script>
  <script type="text/javascript" src="scripts/scriptValidadores.js"></script>
  <script type="text/javascript" src="scripts/scriptAñadirCampos.js"></script>
  </head>
  <?php include("funciones.php") ?>
  <body>

  <?php
  session_start();
  if ($_SESSION["tipo"]=="P"){
  ?>
  <h5>TODAS LAS PREGUNTAS</h5>

  <input type="button" name="verPreguntas" value="ver preguntas" onclick="mostrarPreguntas()"/>

  <div id="respuesta2"><b>Aqui se mostrara el resultado de insertar pregunta...</b></div>
  <?php
  }else{
  	echo "No tienes permisos para acceder a este contenido";
  }
  ?>
  <div id="footer">
    <a href="index.php">Inicio</a>
  </div>
</body>
</html>