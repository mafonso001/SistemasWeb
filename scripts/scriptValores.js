function validarFormulario() {
    if (document.getElementById('nombre').value=="" || document.getElementById('apellido').value=="" || document.getElementById('telefono').value=="" || document.getElementById('pass').value=="" || document.getElementById('email').value=="") {
    	alert("Error: debes rellenar todos los campos");
      	return false;
    }
    return true;
}


