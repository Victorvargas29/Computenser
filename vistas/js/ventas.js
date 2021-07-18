

var tabla;
//funcion q se ejecuta al inicio
function init(){

	//listar();

	//cuando se da click al boton submit entonces se ejecuta la funcion guardaryeditar(e);
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

/*=============================================
AGREGANDO PRODUCTOS A LA VENTA DESDE LA TABLA
=============================================*/
$("#listaC").keyup(function(){
	cargarlista($("#listaC").val());
	


});
$("#listaE").keyup(function(){
	cargarlistaE($("#listaE").val());
	

});
$("#idServicio").change(function(){
	cargarServicio($("#idServicio").val());
	
console.log($("#idServicio").val());
});
function cargarlistaS(){

	// e.preventDefault();//No se activará la acción predeterminada del evento
	var formData = new FormData($("#form_compra")[0]);

		$.ajax({
			url: "../ajax/ventas.php?op=guardar",
			type: "POST",
			data: formData,
			cache:false,
			contentType: false,
			processData: false,

			success: function(datos){

			///	console.log(formData); //muestre los valores en la consola
				console.log(datos); //muestre los valores en la consola
				//$('#detalles').DataTable().ajax.reload();

				$('#form_compra')[0].reset();
				
			//	limpiar();
				///console.log(datos); 
				  
			}
		});
		//console.log("formData");

}//fin guardar y editar
function cargarlista(cedula){

	
		
		$.post("../ajax/cliente.php?op=mostrar",{cedula : cedula}, function(data, status)
		{
			
			data = JSON.parse(data);
	
			
		//	$("#idEmpleada").val(data.cedula);
			//$("#cedula").
			$("#cedula").val(cedula);  // $("#cedula") esto es el id del campo del formulario
		//	$("#cedula").prop('disabled', false);
			
			
			$("#nombre").val(data.nombre);   //data.nombre el nombre que se coloca en el lado derecho es
			$("#apellido").val(data.apellido); //el que se coloco en el ajax en $output["nombre"]
			
			$("#direccion").val(data.direccion);

			$("#telefono").val(data.telefono);
			$("#correo").val(data.correo);
			console.log($("#telefono").val(data.telefono));
			//$("#email").val(data.email);
			
			
			
	
		});
	
}
function cargarlistaE(cedula){

	
		
	$.post("../ajax/empleada.php?op=mostrar",{cedula : cedula}, function(data, status)
	{
		console.log(data);
		data = JSON.parse(data);

		
	//	$("#idEmpleada").val(data.cedula);
		//$("#cedula").
		$("#cedula").val(cedula);  // $("#cedula") esto es el id del campo del formulario
	//	$("#cedula").prop('disabled', false);
		
		
		$("#nombres").val(data.nombre);   //data.nombre el nombre que se coloca en el lado derecho es
		$("#apellidos").val(data.apellido); //el que se coloco en el ajax en $output["nombre"]
		$("#telefono").val(data.telefono);
		$("#Departamento").val(data.nom);
		//$("#email").val(data.email);
		

		

	});

}
function cargarServicio(idServicio){

	

		$.post("../ajax/servicio.php?op=mostrar",{idServicio : idServicio}, function(data, status)
		{
			console.log(data);
			
			data =JSON.parse(data);	  
			 $("#precio").val(data.precio);
			 
	
			
		
	
		});
	

}
function listar(){




}




