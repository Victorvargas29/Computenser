
var tabla;
//funcion q se ejecuta al inicio
function init(){

	listar();

	//cuando se da click al boton submit entonces se ejecuta la funcion guardaryeditar(e);
	$("#empleada_form").on("submit", function(e){
		guardaryeditar(e);
	});

	//cambia el titulo de la ventana modal cuando se da click al boton
	$("#add_button").click(function(){
		$(".modal-title").text("Agregar Empleada");
		$("#cedula").prop('disabled', false);
		$("#idDepartamento").prop('disabled', false);
		$("#idDepartamento").val('0');

	});

}

//funcion q limpia los campos del formulario
function limpiar(){

//	$("#idEmpleada").val("");
	$("#cedula").val("");

	$("#nombre").val("");
	$("#apellido").val("");
	$("#telefono").val("");
//	$('#email').val("");
	$("#direccion").val("");
	$("#idDepartamento").val('0');
	$("#idDepartamento").prop('disabled', false);
	//$("#id_empleada").val("");
}

//funcion listar
function listar(){

	tabla=$('#empleada_data').dataTable({  //#usuario_data este es el id de la tabla
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
       
       // text: '<button class="btn btn-danger"> PDF <i class="far fa-file-pdf"></i></button>'
      }
				],
		"ajax":
		{
			url:'../ajax/empleada.php?op=listar',
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

	$.post("../ajax/empleada.php?op=mostrar",{cedula : cedula}, function(data, status)
	{
		data = JSON.parse(data);

		$("#empleadaModal").modal("show");
	//	$("#idEmpleada").val(data.cedula);
		//$("#cedula").
		$("#cedula").val(cedula);  // $("#cedula") esto es el id del campo del formulario
	//	$("#cedula").prop('disabled', false);
		
		
		$("#nombre").val(data.nombre);   //data.nombre el nombre que se coloca en el lado derecho es
		$("#apellido").val(data.apellido); //el que se coloco en el ajax en $output["nombre"]
		$("#telefono").val(data.telefono);
		$("#direccion").val(data.direccion);
		//$("#email").val(data.email);
		$("#idDepartamento").val(data.idDepartamento);

		$("#idDepartamento").prop('disabled', 'disabled');
		$('.modal-title').text("Editar Usuario");
	//	$("#id_empleada").val(id_empleada);
		$("#action").val("Edit");

	});
}//fin funcion mostrar

//la funcion guardaryeditar(e); se llama cuando se da click al boton submit
function guardaryeditar(e){

	e.preventDefault(); //No se activará la acción predeterminada del evento
	var formData = new FormData($("#empleada_form")[0]);

		$.ajax({
			url: "../ajax/empleada.php?op=guardaryeditar",
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,

			success: function(datos){

				console.log(datos); //muestre los valores en la consola

				$('#empleada_form')[0].reset();
				$('#empleadaModal').modal('hide');
				
				$('#resultados_ajax').html(datos);
				$('#empleada_data').DataTable().ajax.reload();
				limpiar();
			}
		});

}//fin guardar y editar

function eliminar_empleada (cedula){
		bootbox.confirm("¿Esta seguro de eliminar?", function(result){
			if(result){
				$.ajax({
					url:"../ajax/empleada.php?op=eliminar_empleada",
					method:"POST",
					data:{cedula:cedula},

					success:function(data){
						$("#resultados_ajax").html(data);
						$("#empleada_data").DataTable().ajax.reload();
					}
				});
			}//condicion
		}); //bootbox

	}//fin eliminar	


init();
