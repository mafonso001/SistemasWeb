function vervalores(){
 var sAux="";
 var frm = document.getElementById("registro");
 for (i=1;i<frm.elements.length;i++)
 {
 sAux += "NOMBRE: " + frm.elements[i].name + " ";
 sAux += "VALOR: " + frm.elements[i].value + "\n" ;
 }
 alert(sAux);
}