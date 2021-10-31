
var tabla;
//funcion q se ejecuta al inicio
function init(){

	listar();

	
	$("#cliente_form").on("submit", function(e){
		guardaryeditar(e);
	});

	//cambia el titulo de la ventana modal cuando se da click al boton
	$("#btnNuevo").click(function(){
		$(".modal-title").text("Agregar cliente");
		$(".modal-header").css("background-color", "#0e9670");
	});
	

}
$("#cedulaS").keyup(function(){
	procesar($("#cedulaS").val(),$("#comboCedula").val());
	
});
function procesar(cedula,comboCedula){
	campo1=comboCedula;
	campo2=cedula;
	fi=campo1+campo2;
	document.getElementById('cedula').value=fi;

}
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

	tabla=$('#cliente_data').dataTable({  //#usuario_data este es el id de la tabla
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
			url:'../ajax/cliente.php?op=listar',
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
	$.post("../ajax/cliente.php?op=mostrar",{cedula : cedula}, function(data, status)
	{
		data = JSON.parse(data);

		$("#clienteModal").modal("show");
		
		$("#nombre").val(data.nombre);  // $("#cedula") esto es el id del campo del formulario
		   
		$("#apellido").val(data.apellido);
		$("#direccion").val(data.direccion);
		$("#telefono").val(data.telefono);
		$("#correo").val(data.correo);	
		$("#cedula").val(data.cedula);
		//console.log($("#telefono").val(data.telefono));
		$('.modal-title').text("Editar Cliente");
		$("#action").val("Edit");
		//console.log("#telefono");
	});
}//fin funcion mostrar

//la funcion guardaryeditar(e); se llama cuando se da click al boton submit
function guardaryeditar(e){

	e.preventDefault(); //No se activará la acción predeterminada del evento
	var formData = new FormData($("#cliente_form")[0]);

		$.ajax({
			url: "../ajax/cliente.php?op=guardaryeditar",
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,

			success: function(datos){

				console.log(datos); //muestre los valores en la consola

				$('#cliente_form')[0].reset();
				$('#clienteModal').modal('hide');
				$('#cliente_data').DataTable().ajax.reload();
				limpiar();
			}
		});

}//fin guardar y editar


function eliminar_cliente (cedula){
	console.log("cedula", cedula);
		bootbox.confirm("¿Esta seguro de eliminar?", function(result){
			if(result){
				$.ajax({
					url:"../ajax/cliente.php?op=eliminar_cliente",
					method:"POST",
					data:{cedula:cedula},

					success:function(data){
						$("#cliente_data").DataTable().ajax.reload();
					}
					
				});
			}//condicion
		}); //bootbox

	}//fin eliminar	

init();
