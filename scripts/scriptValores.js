function vervalores(){
	if (document.getElementById('nombre').value=="" || document.getElementById('apellido').value=="" || document.getElementById('telefono').value=="" || document.getElementById('contraseña').value=="" || document.getElementById('email').value=="") 
        alert("Error: debes rellenar todos los campos");
    else{
    	 var sAux="";
 		var frm = document.getElementById("registro");
 		for (i=1;i<frm.elements.length;i++)
 		{
 			sAux += "NOMBRE: " + frm.elements[i].name + " ";
 			sAux += "VALOR: " + frm.elements[i].value + "\n" ;
 		}
 		alert(sAux);
    }
}

