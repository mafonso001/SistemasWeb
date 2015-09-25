campoNuevo = 0;
//Funcion de agregar campos
function AgregarCampos() {
	campoNuevo = campoNuevo + 1;
	campo = '<li><label>Campo ' + campoNuevo + ':</label><input type="text" size="20" name="campo' + campoNuevo + '"  /></li>';
	$("#campos").append(campo);
}

