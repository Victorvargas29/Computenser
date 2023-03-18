
var tabla;
//funcion q se ejecuta al inicio
function init(){

	listar();

	
	$("#vehiculo_form").on("submit", function(e){
		guardaryeditar(e);
	});

	//cambia el titulo de la ventana modal cuando se da click al boton
	$("#btnNuevo").click(function(){
		$(".modal-title").text("Agregar vehiculo");
		$(".modal-header").css("background-color", "#0e9670");
	});
	

} //fin init()

$("#cedulaS").keyup(function(){
	cargarlista($("#cedulaS").val(),$("#comboCedula").val());

	if ($("#cedulaS").val()=" ") {
		$("#cedula").val(cedula1);  	
		$("#nombre").val(" ");
		
	}
	
});

$("#comboCedula").change(function(){
	
	cargarlista($("#cedulaS").val(),$("#comboCedula").val());

//console.log($("#idServicio").val($("#idServicio").val()));
});



//funcion q limpia los campos del formulario
function limpiar(){

	$("#cedula").val("");
	$("#nombre").val("");
	$("#apellido").val("");
	$("#direccion").val("");
	$("#telefono").val("");
	$("#correo").val("");
}


//funcion listar
function listar(){

	tabla=$('#vehiculo_data').dataTable({  //#usuario_data este es el id de la tabla
		"aProcessing":true,//Activamos el procesamiento del datatables
		"aServerSide":true,//Paginacion y filtrado realizados por el servidor
		
		dom:'Bfrtilp',//Definimos los elementos del control de tabla
		buttons:[
	    	//Botón para PDF
	    	{
	        extend: 'pdfHtml5',
	        //footer: true,
	       	text:'<i class="fas fa-file-pdf"></i>',
	        titleAttr: 'Exportar a PDF',
	        //filename: 'Export_File_pdf',
	        className: 'btn btn-danger'
	      	}
		],
		"ajax":
		{
			url:'../ajax/vehiculo.php?op=listar',
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
}//fin funcion listar

function mostrar(cedula){
console.log("SDF",cedula);
	$.post("../ajax/vehiculo.php?op=mostrar",{cedula : cedula}, function(data, status)
	{
		data = JSON.parse(data);

		$("#vehiculoModal").modal("show");
		
		$("#nombre").val(data.nombre);  // $("#cedula") esto es el id del campo del formulario
		   
		$("#apellido").val(data.apellido);
		$("#direccion").val(data.direccion);
		$("#telefono").val(data.telefono);
		$("#correo").val(data.correo);	
		$("#cedula").val(data.cedula);
		//console.log($("#telefono").val(data.telefono));
		$('.modal-title').text("Editar vehiculo");
		$("#action").val("Edit");
		//console.log("#telefono");
	});
}//fin funcion mostrar

//la funcion guardaryeditar(e); se llama cuando se da click al boton submit
function guardaryeditar(e){

	e.preventDefault(); //No se activará la acción predeterminada del evento
	var formData = new FormData($("#vehiculo_form")[0]);

		$.ajax({
			url: "../ajax/vehiculo.php?op=guardaryeditar",
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,

			success: function(datos){

				console.log(datos); //muestre los valores en la consola

				$('#vehiculo_form')[0].reset();
				$('#vehiculoModal').modal('hide');
				$('#vehiculo_data').DataTable().ajax.reload();
				limpiar();
			}
		});

}//fin guardar y editar


function eliminar_vehiculo (cedula){
	console.log("cedula", cedula);
		bootbox.confirm("¿Esta seguro de eliminar?", function(result){
			if(result){
				$.ajax({
					url:"../ajax/vehiculo.php?op=eliminar_vehiculo",
					method:"POST",
					data:{cedula:cedula},

					success:function(data){
						$("#vehiculo_data").DataTable().ajax.reload();
					}
					
				});
			}//condicion
		}); //bootbox

	}//fin eliminar	


	function cargarlista(cedula1,letra){

		var cedula=letra+cedula1;
		if (cedula=='V-' || cedula=='J-' || cedula=='C-' || cedula=='G-') {
			$("#cedula").val(cedula1);

		}
		$.post("../ajax/vehiculo.php?op=comboCliente",{cedula : cedula}, function(data, status)
		{			
			data = JSON.parse(data);			
			$("#cedulaS").val(cedula1);
			$("#nombre").val(data.nombre+" "+data.apellido);   
			$("#nombre").prop('disabled', true);

		});	
	}

init();
