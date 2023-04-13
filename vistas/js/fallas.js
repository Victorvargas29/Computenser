

var tablfa;

const cant= document.getElementById("cantidad");
const precio= document.getElementById("precio");

const descripcion= document.getElementById("descripcion");
const cuerpotabla =document.getElementById("cuerpotabla");

//funcion q se ejecuta al inicio
function init(){
	
	$(document).ready(function(){
		$.post("../ajax/falla.php?op=selectVehiculo", function(r){
			$("#idVehiculo").html(r);
			$('#idVehiculo').selectpicker();
		  //  $('#idMarcas').selectpicker("refresh");
		});

		$("#idVehiculo").change(function(){
	
			cargarVehiculo($("#idVehiculo").val());
		
		
		});
	});
}


function cargarVehiculo(placa){


		
	$.post("../ajax/falla.php?op=mostrarVehiculo",{placa : placa}, function(data, status)
	{			
		data = JSON.parse(data);			
		$("#modelo").val(data.modelo_nom);
		$("#color").val(data.color_nom);  
		$("#cliente").val(data.nombreCli);
	});	
}




init();
