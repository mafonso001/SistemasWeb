<!DOCTYPE html>
<html>
  <head>
    <script language = "javascript">


    function contador(){
      divResultado = document.getElementById('contador');
      ajax=objetoAjax();

      ajax.onreadystatechange=function() {
        if (ajax.readyState==4) {
          divResultado.innerHTML = ajax.responseText;
        }
      }

      ajax.open("GET", "cont_user.php");
      ajax.send(null)
    }

    function insertQuestion() { //Asíncrono
        if (typeof window.ActiveXObject != 'undefined' ) {
          req = new ActiveXObject("Microsoft.XMLHTTP");
          req.onreadystatechange = xres ;
        } else {
          req = new XMLHttpRequest();
          req.onload = xres ;
          //document.getElementsById("respuesta").innerHTML = req.responseText;
        }

        var pre = document.getElementById("pregunta").value;
        var res = document.getElementById("respuesta").value;
        var com = document.getElementById("comple").value;
        var tem = document.getElementById("tema").value;

        var params = "pregunta="+pre+"&respuesta="+res+"&tema="+tem+"&comple="+com;

        req.open("POST", "InsertarPregunta.php", true);

        req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        req.setRequestHeader("Content-length", params.length);
        req.setRequestHeader("Connection", "close");

        req.send(params);
        //req.send("pregunta=ddd&respuesta=aaaa&comple=1");
    }

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

    function MostrarConsulta(){

      divResultado = document.getElementById('respuesta2');
      ajax=objetoAjax();

      ajax.onreadystatechange=function() {
        if (ajax.readyState==4) {
          divResultado.innerHTML = ajax.responseText;
        }
      }

      ajax.open("GET", "funcionVerPreguntas.php");
      ajax.send(null)
    }

    function xres() {
        if (req.readyState != 4) return ;
        //alert(req.responseText);
        document.getElementById("respuesta2").innerHTML = req.responseText;
    }
    </script> 

    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
    <link rel="stylesheet" type="text/css" href="estilos/register.css" media="screen" />
  <script type="text/javascript" src="scripts/scriptValores.js"></script>
  <script type="text/javascript" src="scripts/scriptValidadores.js"></script>
  <script type="text/javascript" src="scripts/scriptAñadirCampos.js"></script>
  </head>
  <?php 
  include("funciones.php") ?>
  <body onLoad="setInterval('contador()',1000);">

  <?php
  session_start();
  if ($_SESSION["tipo"]=="P"){
  ?>
  
  <div id="contador"></div>
  <h5>REALIZA LA PREGUNTA</h5>

  <div>
        <form>
          Pregunta:<br/>
          <input type="text" id="pregunta" name="pregunta" /><br/>     <!--onblur="validarEmail()"-->
          Respuesta:<br/>
          <input type="text" id="respuesta" name="respuesta"/> <br/>
          <br/>
          Tema:<br/>
          <input type="text" id="tema" name="tema"/> <br/>
          <br/>
          Complejidad:<br/>
          <input type="text" id="comple" name="comple"/> <br/>
          <br/>
          <input type="button" name="Enviar" value="Insertar pregunta" onclick="insertQuestion()"/>
      </form>
  </div>

  <input type="button" name"verPreguntas" value="ver preguntas" onclick="MostrarConsulta()"/>

  <div id="respuesta2"><b>Aqui se mostrara el resultado de insertar pregunta...</b></div>

  <?php
  }else{
    echo "no tienes permisos para acceder a esta seccion";
  }
  ?>
  <div id="footer">
    <a href="index.php">Inicio</a>
  </div>
</body>
</html>