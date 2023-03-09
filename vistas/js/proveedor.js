
var tabla;
//funcion q se ejecuta al inicio
function init(){

	listar();

	
	$("#proveedor_form").on("submit", function(e){
		guardaryeditar(e);
	});

	//cambia el titulo de la ventana modal cuando se da click al boton
	$("#btnNuevo").click(function(){
		$(".modal-title").text("Agregar proveedor");
		$(".modal-header").css("background-color", "#0e9670");
	});
	

}

$("#rifS").keyup(function(){
	procesar($("#rifS").val(),$("#comboRif").val());
});

function procesar(rif,comboRif){
	campo1=comboRif;
	campo2=rif;
	//fi=campo2;
	fi=campo1+campo2;
	document.getElementById('rif').value=fi;

}

//funcion q limpia los campos del formulario
function limpiar(){

	$("#rif").val("");
	$("#nombre").val("");
	$("#direccion").val("");
}


//funcion listar
function listar(){

	tabla=$('#proveedor_data').dataTable({  
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
			url:'../ajax/proveedor.php?op=listar',
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

function mostrar(rif){
	$.post("../ajax/proveedor.php?op=mostrar",{rif : rif}, function(data, status)
	{
		data = JSON.parse(data);

		$("#proveedorModal").modal("show");
		
		$("#nombre").val(data.nombre);
		$("#direccion").val(data.direccion);
		$("#rif").val(data.rif);

		$('.modal-title').text("Editar Proveedor");
		$("#action").val("Edit");

	});
}//fin funcion mostrar

//la funcion guardaryeditar(e); se llama cuando se da click al boton submit
function guardaryeditar(e){

	e.preventDefault(); //No se activará la acción predeterminada del evento
	var formData = new FormData($("#proveedor_form")[0]);

		$.ajax({
			url: "../ajax/proveedor.php?op=guardaryeditar",
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,

			success: function(datos){

				console.log(datos); //muestre los valores en la consola

				$('#proveedor_form')[0].reset();
				$('#proveedorModal').modal('hide');
				$('#proveedor_data').DataTable().ajax.reload();
				limpiar();
			}
		});

}//fin guardar y editar


function eliminar_proveedor (rif){
	console.log("rif", rif);
		bootbox.confirm("¿Esta seguro de eliminar?", function(result){
			if(result){
				$.ajax({
					url:"../ajax/proveedor.php?op=eliminar_proveedor",
					method:"POST",
					data:{rif:rif},

					success:function(data){
						$("#proveedor_data").DataTable().ajax.reload();
					}
					
				});
			}//condicion
		}); //bootbox

	}//fin eliminar	

init();
