
var tabla;
//funcion q se ejecuta al inicio
function init(){

	listar();

	//cuando se da click al boton submit entonces se ejecuta la funcion guardaryeditar(e);
	$("#servicio_form").on("submit", function(e){
		guardaryeditar(e);
	});

	//cambia el titulo de la ventana modal cuando se da click al boton
	$("#btnNuevo").click(function(){
		limpiar();
		$(".modal-title").text("Agregar Servicio");
		$("#idCategoria").val('0');
		//$("#idDepartamentos").val('0');
		//document.getElementById("cedula").disabled = false;
	});

    $.post("../ajax/servicio.php?op=selectDepartamento", function(r){
        $("#idDepartamentos").html(r);
      //  $('#idDepartamentos').selectpicker("refresh");
    });

    $(document).ready(function(){
        $("#idDepartamentos").change(function(){
         
         //   $('#iddistrito').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');
            $("#idDepartamentos option:selected").each(function(){
                iddepartamento= $(this).val();
                $.post("../ajax/servicio.php?op=selectCategoria", { iddepartamento:iddepartamento},function(data){
                    $("#idCategoria").html(data);
                });
            });
        });
    });

}

//funcion q limpia los campos del formulario
function limpiar(){

	$("#idServicio").val("");
	$("#nombre").val("");
	$("#precio").val("");
	$("#idCategoria").val('0');	
	$("#idDepartamentos").val('0');
//	$('#idDepartamentos').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');
	$('#idCategoria').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');
}

//funcion listar
function listar(){

	tabla=$('#servicio_data').dataTable({  //#usuario_data este es el id de la tabla
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
			url:'../ajax/servicio.php?op=listar',
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

function mostrar(idServicio){

	$.post("../ajax/servicio.php?op=mostrar",{idServicio : idServicio}, function(data, status)
	{
		
		
		data =JSON.parse(data);

		$("#servicioModal").modal("show");
	//	document.getElementById("cedula").disabled = true;
		//$("#cedula").

		$("#nombre").val(data.nombre);  // $("#cedula") esto es el id del campo del formulario
		   //data.nombre el nombre que se coloca en el lado derecho es
		 //el que se coloco en el ajax en $output["nombre"]
		 $("#precio").val(data.precio);
		 $("#idDepartamento").val(data.idDepartamento);
		 
		 $('.modal-title').text("Editar Servicio");
		 $("#idServicio").val(idServicio);
	

		
		$("#action").val("Edit");

	});
}//fin funcion mostrar

//la funcion guardaryeditar(e); se llama cuando se da click al boton submit
function guardaryeditar(e){

	e.preventDefault(); //No se activará la acción predeterminada del evento
	var formData = new FormData($("#servicio_form")[0]);

		$.ajax({
			url: "../ajax/servicio.php?op=guardaryeditar",
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,

			success: function(datos){

				//console.log(datos); //muestre los valores en la consola

				$('#servicio_form')[0].reset();
				$('#servicioModal').modal('hide');
				
				//$('#resultados_ajax').html(datos);
				$('#servicio_data').DataTable().ajax.reload();
				limpiar();
			}
		});

}//fin guardar y editar


function eliminar_servicio(idServicio){
		bootbox.confirm("¿Esta seguro de eliminar?", function(result){
			if(result){
				$.ajax({
					url:"../ajax/servicio.php?op=eliminar_servicio",
					method:"POST",
					data:{idServicio:idServicio},

					success:function(data){
					//	$("#resultados_ajax").html(data);
						$("#servicio_data").DataTable().ajax.reload();
					}
				});
			}//condicion
		}); //bootbox

	}//fin eliminar	


init();
