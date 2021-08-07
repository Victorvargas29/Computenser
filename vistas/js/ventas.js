

var tablfa;

//funcion q se ejecuta al inicio
function init(){
	tasa_dia();
	listar();
	idfactura();
	listarSubTortales();
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



function tasa_dia(){
$.getJSON("https://s3.amazonaws.com/dolartoday/data.json",function(data){
	$('#tasa').val(data.USD.transferencia);
 // $('#texto').html('Transferencia: '+data.USD.transferencia+ '<br> Sicad: ' + data.USD.sicad2);
 // $('#al').html('DolarToday al: '+data._timestamp.fecha);
    });   

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

//console.log($("#idServicio").val($("#idServicio").val()));
});

function listar(){
	tabla=$('#detalles_ventas').dataTable({ 
		"aProcessing":true,//Activamos el procesamiento del datatables
		"aServerSide":true,//Paginacion y filtrado realizados por el servidor
		
		dom:'frtilp',//Definimos los elementos del control de tabla
		
		"ajax":
		{
			url:'../ajax/ventas.php?op=listar',
			type: "get",
			datatype: "json",
			error: function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy":true,
		"responsive":true,
		"bInfo":true,
		"iDisplayLength":10,//por cada 10 reg hace una paginacion
		"order":[[0,"desc"]],//Ordenar(Columna, Orden)

		"language":{
			"sProcessing": "Procesando...",
			"sLengthMenu": "Mostrar _MENU_ registro",
			"sZeroRecords": "No se encontraron resultados",
			"sEmptyTable": "Ningun dato disponible en esta tabla",
			"sInfo": "Mostrando un total de _TOTAL_ registros",
			"sInfoEmpty": "Mostrando un total de 0 registros",
			"sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix": "",
			"sSearch": "Buscar",
			"sUrl": "",
			"sInfoThousands": "",
			"sLoadingRecords": "Cargando...",
			"oPaginate":{
				"sFirst": "Primero",
				"sLast": "Ultimo",
				"sNext": "Siguiente",
				"sPrevious": "Anterior"
			},
			"oAria":{
				"sSortAscending": ": Activar para ordenar la columna",
				"sSortDescending": ": Activar para ordenar la columna"
			}
		}//cierra language

	}).DataTable();

}function listarSubTortales(){
	tabla=$('#sub').dataTable({ 
		"aProcessing":true,//Activamos el procesamiento del datatables
		"aServerSide":true,//Paginacion y filtrado realizados por el servidor
		
		//dom:'Bfrtilp',//Definimos los elementos del control de tabla
		
		"ajax":
		{
			url:'../ajax/ventas.php?op=listarSubtotales',
			type: "get",
			datatype: "json",
			error: function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy":true,
		"responsive":true,
		"bInfo":true,
		"iDisplayLength":10,//por cada 10 reg hace una paginacion
		"order":[[0,"desc"]],//Ordenar(Columna, Orden)

		"language":{
			"sProcessing": "Procesando...",
			"sLengthMenu": "Mostrar _MENU_ registro",
			"sZeroRecords": "No se encontraron resultados",
			"sEmptyTable": "Ningun dato disponible en esta tabla",
			"sInfo": "Mostrando un total de _TOTAL_ registros",
			"sInfoEmpty": "Mostrando un total de 0 registros",
			"sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix": "",
			"sSearch": "Buscar",
			"sUrl": "",
			"sInfoThousands": "",
			"sLoadingRecords": "Cargando...",
			"oPaginate":{
				"sFirst": "Primero",
				"sLast": "Ultimo",
				"sNext": "Siguiente",
				"sPrevious": "Anterior"
			},
			"oAria":{
				"sSortAscending": ": Activar para ordenar la columna",
				"sSortDescending": ": Activar para ordenar la columna"
			}
		}//cierra language

	}).DataTable();

}
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
				$('#detalles_ventas').DataTable().ajax.reload();
				$("#sub").DataTable().ajax.reload();
				listarSubTortales();
			//	$('#form_compra')[0].reset();
				
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

			$("#cedula").val(cedula);  // $("#cedula") esto es el id del campo del formulario	
			$("#nombre").val(data.nombre+" "+data.apellido);   //data.nombre el nombre que se coloca en el lado derecho es
			$("#nombre").prop('disabled', true);

			$("#apellido").val(data.apellido); //el que se coloco en el ajax en $output["nombre"]
			$("#direccion").val(data.direccion);
			$("#telefono").val(data.telefono);
			$("#correo").val(data.correo);

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
			 $("#nombre_ser").val(data.nombre);
			 
		});
		//var sel =document.getElementById("idServicio");
	////var seltex= sel.options[getElementIndex("idServicio").text]
	///$("nombre_ser").val($seltex);
}
function idfactura(){
	var idFf=1;
	$.post("../ajax/ventas.php?op=mostrar", function(data, status)
	{	idFf=1;
		console.log(data);			
		data =JSON.parse(data);	 
		idF =data.idFactura;
		$('#idFacturas').html(idF);
		 $("#idFactura").val(idF);
	//	 $("#idFacturas").val(idF);
		// console.log(idF); 
		//// $("#nombre_ser").val(data.nombre);
	});
	///$("#idFactura").val($("#idFactura").val()+1);
	//var sel =document.getElementById("idServicio");
////var seltex= sel.options[getElementIndex("idServicio").text]
///$("nombre_ser").val($seltex);
}

function eliminar_item(iddetallesFT){
	
	$.ajax({
		url:"../ajax/ventas.php?op=eliminar_item",
		method:"POST",
		data:{iddetallesFT:iddetallesFT},

		success:function(data){
			$("#detalles_ventas").DataTable().ajax.reload();
			$("#sub").DataTable().ajax.reload();
		}
	});
}

function registrar(){
	//e.preventDefault(); //No se activará la acción predeterminada del evento
	var formData = new FormData($("#form_compra")[0]);

		$.ajax({
			url: "../ajax/ventas.php?op=guardarVenta",
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,

			success: function(datos){

				console.log(datos); //muestre los valores en la consola

				$('#form_compra')[0].reset();
				//$('#servicioModal').modal('hide');
				$("#detalles_ventas").DataTable().ajax.reload();
				$("#sub").DataTable().ajax.reload();
				idfactura();
				tasa_dia();
				
				//$('#resultados_ajax').html(datos);
				//$('#servicio_data').DataTable().ajax.reload();
				//limpiar();
			}
		});
	
}

function borrar_temporal(){
	var formData = new FormData($("#form_compra")[0]);
	$.ajax({
		url: "../ajax/ventas.php?op=borrar_temp",
		type: "POST",
		data: formData,
		contentType: false,
		processData: false,

		success: function(datos){

			console.log(datos); //muestre los valores en la consola
			$('#form_compra')[0].reset();
			$("#detalles_ventas").DataTable().ajax.reload();
			$("#sub").DataTable().ajax.reload();
			idfactura();
			tasa_dia();
		}
	});
}
function reportePdf(idFactura){

}

init();
