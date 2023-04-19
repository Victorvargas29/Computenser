
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
	
	$.post("../ajax/vehiculo.php?op=selectMarca", function(r){
        $("#idMarca").html(r);
    });

	$.post("../ajax/vehiculo.php?op=selectColor", function(t){
        $("#idColor").html(t);
    });
	
	$(document).ready(function(){
        $("#idMarca").change(function(){
            $("#idMarca option:selected").each(function(){
                idMarca= $(this).val();
                $.post("../ajax/vehiculo.php?op=selectModelo", {idMarca:idMarca},function(data){
                    $("#idModelo").html(data);
                });
            });
        });
    });
	$(document).ready(function(){
        $("#idModelo").change(function(){
            $("#idModelo option:selected").each(function(){
                idModelo= $(this).val();
                $.post("../ajax/vehiculo.php?op=selectGen", {idModelo:idModelo},function(data){
                    $("#generacion").html(data);
                });
            });
        });
    });

//cambiar a mayuscula lo que se va escribiendo en el text
	$(document).ready(function(){
		$("#placa").on("keyup",function(){
			$input=$(this);
			setTimeout(function(){
				$input.val($input.val().toUpperCase());
		 	},20);
		});
	});

$.post("../ajax/vehiculo.php?op=selectCliente",function(re){
	$("#cedula").html(re);
	$("#cedula").selectpicker();
});

} //fin init()


//funcion q limpia los campos del formulario
function limpiar(){
	$("#placa").val("");
	$("#cedula").val(0);
	$("#idMarca").val("");
	$("#idModelo").val("");
	$("#idColor").val("");
	$("#año").val("");
	$("#comboCedula").val("V-");
	$("#generacion").val("");

	$("#placa").removeAttr("readonly");
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

function mostrar(placa,idMarca,idModelo){
	$.post("../ajax/vehiculo.php?op=selectGen", {idModelo:idModelo},function(data2){
		$("#generacion").html(data2);
	});
	
	$.post("../ajax/vehiculo.php?op=selectModelo", {idMarca:idMarca},function(data1){
		$("#idModelo").html(data1);
		
	});
	$.post("../ajax/vehiculo.php?op=mostrar",{placa : placa}, function(data, status)
	{
		data = JSON.parse(data);
		idMarca=data.idMarca;
		
		$("#vehiculoModal").modal("show");
		
		$("#cedula").val(data.cedula);
	
		$("#placa").val(placa); 
	 
		$("#idMarca").val(data.idMarca);
		$("#idModelo").val(data.idModelo);
		$("#generacion").val(data.idGeneracion);
		$("#año").val(data.anno);	
		$("#idColor").val(data.idColor);

		//$("#nombre").prop('disabled', true);
		//$("#placa").attr("readonly","readonly");

		$('.modal-title').text("Editar vehiculo");
		$("#action").val("Edit");
	});
}//fin funcion mostrar

function guardaryeditar(e){

	e.preventDefault();
	var formData = new FormData($("#vehiculo_form")[0]);

		$.ajax({
			url: "../ajax/vehiculo.php?op=guardaryeditar",
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,

			success: function(datos){
				$('#vehiculo_form')[0].reset();
				$('#vehiculoModal').modal('hide');
				$('#vehiculo_data').DataTable().ajax.reload();
				limpiar();
			}
		});

}//fin guardar y editar


function eliminar_vehiculo (placa){
	console.log("placa", placa);
		bootbox.confirm("¿Esta seguro de eliminar?", function(result){
			if(result){
				$.ajax({
					url:"../ajax/vehiculo.php?op=eliminar_vehiculo",
					method:"POST",
					data:{placa:placa},

					success:function(data){
						$("#vehiculo_data").DataTable().ajax.reload();
					}
					
				});
			}//condicion
		}); //bootbox

	}//fin eliminar	

init();
