

var tablfa;

const cant= document.getElementById("cantidad");
const precio= document.getElementById("precio");

const descripcion= document.getElementById("descripcion");
const cuerpotabla =document.getElementById("cuerpotabla");

//funcion q se ejecuta al inicio
function init(){
	
	//listar();	
	
/*	$("#form_compra").on("button", function(e){
		cargarlistaS(e);
	});

	//cambia el titulo de la ventana modal cuando se da click al boton
	
	

	$("#btnGuardar").click(function(){

	});



$("form_compra").on("submit", function(){
	cargarlistaS();

});
*/


}

$(document).ready(function(){
	$.post("../ajax/falla.php?op=selectVehiculo", function(r){
		$("#idVehiculo").html(r);
		$('#idVehiculo').selectpicker();
	  //  $('#idMarcas').selectpicker("refresh");
	});
});


init();
