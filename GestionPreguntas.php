<!DOCTYPE html>
<html>
  <head>
    <script language = "javascript">

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


    /*function viewQuestions(){
      if (window.XMLHttpRequest){
        // Objeto para IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
      }else{
        // Objeto para IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
      }

      xmlhttp.onreadystatechange=function(){
        if(xmlhttp.readyState==4 && xmlhttp.status==200){
          // Obtenemos un objeto XMLDocument con el contenido del archivo xml del servidor
          xmlDoc=xmlhttp.responseXML;
          // Obtenemos todos los nodos denominados foro del archivo xml
          var assessmentItem=xmlDoc.getElementsByTagName("assessmentItem");

          tabla="<table border=1>";
          // Hacemos un bucle por todos los elementos foro
          for(var i=0;i<assessmentItem.length;i++)
          {
            // Del elemento foro, obtenemos del primer elemento denominado "titulo"
            // el valor del primer elemento interno
            pregunta=assessmentItem[i].getElementsByTagName("p")[0].childNodes[0].nodeValue
           
            respuesta=assessmentItem[i].getElementsByTagName("value")[0].childNodes[0].nodeValue
           
            
            tabla+="<tr><td>"+pregunta+" 1</td></tr>";
            //tabla+="<tr><td>"+respuesta+" 2</td></tr>";
            
          }
          tabla+="</table>";
          document.getElementById("respuesta2").innerHTML = tabla;
        }
      }
       
      // Abrimos el archivo que esta alojado en el servidor cd_catalog.xml

      xmlhttp.open("GET","xml/preguntas.xml",false);
      xmlhttp.send();
    }*/

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
  <?php include("funciones.php") ?>
  <body>
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

  <div id="footer">
    <a href="index.html">Inicio</a>
  </div>
</body>
</html>