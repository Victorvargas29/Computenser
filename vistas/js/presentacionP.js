var tabla;
//funcion q se ejecuta al inicio
function init(){

	listar();

	//cuando se da click al boton submit entonces se ejecuta la funcion guardaryeditar(e);
	$("#presentacionP_form").on("submit", function(e){
		guardaryeditar(e);
	});

	//cambia el titulo de la ventana modal cuando se da click al boton
	$("#btnNuevo").click(function(){
        $('.modal-header').css("background-color", "#007bff");
        $('.modal-header').css("color", "white");
        
        $(".modal-title").text("Agregar nueva Presentacion")
		//document.getElementById("cedula").disabled = false;
	});
/*
	$("#btnGuardar").click(function(){

	});
*/
}

//funcion q limpia los campos del formulario
function limpiar(){

	$("#idPresentacionP").val("");
	$("#nombre").val("");

}

//funcion listar
function listar(){

	tabla=$('#presentacionP_data').dataTable({  //#usuario_data este es el id de la tabla
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
			url:'../ajax/presentacionP.php?op=listar',
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

function mostrar(idPresentacionP){

	$.post("../ajax/presentacionP.php?op=mostrar",{idPresentacionP : idPresentacionP}, function(data, status)
	{
		data = JSON.parse(data);

		$("#presentacionPModal").modal("show");
	//	document.getElementById("cedula").disabled = true;
		//$("#cedula").

		$("#nombre").val(data.nombre);  // $("#cedula") esto es el id del campo del formulario
		   //data.nombre el nombre que se coloca en el lado derecho es
		 //el que se coloco en el ajax en $output["nombre"]
         $(".modal-header").css("background-color", "#28a745");
         $(".modal-header").css("color", "white");
		$('.modal-title').text("Editar Presentacion");

		$("#idPresentacionP").val(idPresentacionP);
	//	$("#id_empleada").val(id_empleada);
		$("#action").val("Edit");

	});
}//fin funcion mostrar

//la funcion guardaryeditar(e); se llama cuando se da click al boton submit
function guardaryeditar(e){

	e.preventDefault(); //No se activará la acción predeterminada del evento
	var formData = new FormData($("#presentacionP_form")[0]);

		$.ajax({
			url: "../ajax/presentacionP.php?op=guardaryeditar",
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,

			success: function(datos){

				//console.log(datos); //muestre los valores en la consola

				$('#presentacionP_form')[0].reset();
				$('#presentacionPModal').modal('hide');
				
				//$('#resultados_ajax').html(datos);
				$('#presentacionP_data').DataTable().ajax.reload();
				limpiar();
			}
		});

}//fin guardar y editar


function eliminar_presentacionP (idPresentacionP){
		bootbox.confirm("¿Esta seguro de eliminar?", function(result){
			if(result){
                
                $.ajax({
					url:"../ajax/presentacionP.php?op=eliminar_presentacionP",
					method:"POST",
					data:{idPresentacionP:idPresentacionP},

					success:function(data){
					//	$("#resultados_ajax").html(data);
						$("#presentacionP_data").DataTable().ajax.reload();
					}
				});
			}//condicion
		}); //bootbox

	}//fin eliminar	


init();