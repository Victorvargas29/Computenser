
var tabla;
//funcion q se ejecuta al inicio
function init(){

	listar();

	//cuando se da click al boton submit entonces se ejecuta la funcion guardaryeditar(e);
	$("#modelo_form").on("submit", function(e){
		guardaryeditar(e);
	});

	$("#generacion_form").on("submit", function(e){
		reg_generacion(e);
	});

	//cambia el titulo de la ventana modal cuando se da click al boton
	$("#btnNuevo").click(function(){
		$(".modal-title").text("Agregar Modelo");
		limpiar();
	});

    $.post("../ajax/modelo.php?op=selectMarca", function(r){
        $("#idMarca").html(r);
      //  $('#idMarcas').selectpicker("refresh");
    });
	$.post("../ajax/modelo.php?op=selectIniGen", function(t){
        $("#idInicio").html(t);
    
    });

	$(document).ready(function(){
        $("#idInicio").change(function(){
         
         //   $('#iddistrito').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');
            $("#idInicio option:selected").each(function(){
                idInicio= $(this).val();
                $.post("../ajax/modelo.php?op=selectFinGen", {idInicio:idInicio},function(data){
                    $("#idFin").html(data);
                });
            });
        });
    });

}
//funcion q limpia los campos del formulario
function limpiar(){

	$("#idModelo").val("");
	$("#nombre").val("");
	$("#idMarca").val('0');
	$("#idInicio").val('0');
	$("#idFin").val('0');

}

//funcion listar
function listar(){

	tabla=$('#modelo_data').dataTable({  
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
			url:'../ajax/modelo.php?op=listar',
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

function generacion(idModelo){

console.log(idModelo);
/* 				$.post("../ajax/modelo.php?op=generacion",{idModelo : idModelo}, function(data, status)
			{
				data = JSON.parse(data);
	
				$("#generacionModal").modal("show");
				$("#name_modelo").val(nombre);
				$('.modal-title').text("Registrar Generacion de ");


				$("#action").val("Edit");
	
			}); */
/* 		setTimeout(function(){
		}, 100);	 */
	} //fin funcion mostrar
	

function mostrar(idModelo){
/* 	$.post("../ajax/modelo.php?op=selectFinGen", {iniannos:iniannos},function(data){
		$("#idFin").html(data);
	}); */

		$.post("../ajax/modelo.php?op=mostrar",{idModelo : idModelo}, function(data, status)
		{
			data = JSON.parse(data);

			$("#modeloModal").modal("show");
			$("#nombre").val(data.nombre);
			$("#idMarca").val(data.idMarca);
			$("#idModelo").val(idModelo);

			$('.modal-title').text("Editar modelo");

			$("#action").val("Edit");

		});
	
}//fin funcion mostrar

//la funcion guardaryeditar(e); se llama cuando se da click al boton submit
function guardaryeditar(e){

	e.preventDefault(); 
	var formData = new FormData($("#modelo_form")[0]);

		$.ajax({
			url: "../ajax/modelo.php?op=guardaryeditar",
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,

			success: function(datos){
				$('#modelo_form')[0].reset();
				$('#modeloModal').modal('hide');
				$('#modelo_data').DataTable().ajax.reload();
				limpiar();
			}
		});

}//fin guardar y editar

function reg_generacion(e){

	e.preventDefault(); 
	var formData = new FormData($("#generacion_form")[0]);

		$.ajax({
			url: "../ajax/modelo.php?op=reg_generacion",
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,

			success: function(datos){
				$('#generacion_form')[0].reset();
				$('#generacionModal').modal('hide');
				$('#modelo_data').DataTable().ajax.reload();
				limpiar();
			}
		});

}//fin guardar y editar

function eliminar_modelo(idModelo){
		bootbox.confirm("¿Esta seguro de eliminar?", function(result){
			if(result){
				$.ajax({
					url:"../ajax/modelo.php?op=eliminar_modelo",
					method:"POST",
					data:{idModelo:idModelo},

					success:function(data){
						$("#modelo_data").DataTable().ajax.reload();
					}
				});
			}//condicion
		}); //bootbox

	}//fin eliminar	


init();
