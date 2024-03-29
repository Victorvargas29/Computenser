var tabla;
//funcion q se ejecuta al inicio
function init(){

	listar();

	//cuando se da click al boton submit entonces se ejecuta la funcion guardaryeditar(e);
	$("#producto_form").on("submit", function(e){
		guardaryeditar(e);
	
		
	});

	//cambia el titulo de la ventana modal cuando se da click al boton
	$("#btnNuevo").click(function(){
        $(".modal-title").text("Agregar Producto");
        $('.modal-header').css("background-color", "#007bff");
        $('.modal-header').css("color", "white");
        $("#idDepartamento").val('0');
        $("#idPresentacionP").val('0');
		//document.getElementById("cedula").disabled = false;
	});
	$(document).ready(function(){
	//	$('.js-example-basic-single').select2();
	
	
		
        $("#idModelo").change(function(){
         
         //   $('#iddistrito').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');
            $("#idModelo option:selected").each(function(){
                idModelo= $(this).val();
                $.post("../ajax/producto.php?op=selectGen", {idModelo:idModelo},function(data){
                    $("#idGeneracion").html(data);
                });
            });
        });
    });
}

//funcion q limpia los campos del formulario
function limpiar(){

	$("#idproducto").val("");
    $("#nombre").val("");
	$("#cantidadP").val("");
    
    $("#idDepartamento").val('0');
	$("#idPresentacionP").val('0');	
    	

}

//funcion listar
function listar(){

	tabla=$('#producto_data').dataTable({  //#usuario_data este es el id de la tabla
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
			url:'../ajax/producto.php?op=listar',
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

function mostrar(idProducto,idModelo){
	l
	$.post("../ajax/producto.php?op=mostrar",{idProducto : idProducto}, function(data, status)
	{
		data = JSON.parse(data);

		$("#productoModal").modal("show");
	
		$("#nombre").val(data.nombre);
		   
        $("#idLinea").val(data.idLinea);
        $("#cantidad").val(data.cantidad);
        $("#precio").val(data.precio);
    
   
	    $("#idGeneracion").val(data.idGeneracion);
	    $("#idModelo").val(idModelo);
		$("#idProducto").val(idProducto);
	

		$('.modal-title').text("Editar producto");

		
	//	$("#id_empleada").val(id_empleada);
		$("#action").val("Edit");

	});
}//fin funcion mostrar categoria

//la funcion guardaryeditar(e); se llama cuando se da click al boton submit
function guardaryeditar(e){

	e.preventDefault(); //No se activará la acción predeterminada del evento
	var formData = new FormData($("#producto_form")[0]);
	//var s=formData;
	//console.log(formData);
		$.ajax({
			url: "../ajax/producto.php?op=guardaryeditar",
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,

			success: function(datos){
				
				console.log(datos); //muestre los valores en la consola

				$('#producto_form')[0].reset();
				$('#productoModal').modal('hide');
				
				//$('#resultados_ajax').html(datos);
				$('#producto_data').DataTable().ajax.reload();
				limpiar();
			}
		});

}//fin guardar y editar
function addProveedor(idProducto){
	console.log(idProducto);
	
	$.post("../ajax/producto.php?op=mostrarP",{idProducto : idProducto}, function(data, status)
	{
		data = JSON.parse(data);

		$("#prodProvModal").modal("show");
	//	document.getElementById("cedula").disabled = true;
		//$("#cedula")
		$("#nombreP").val(data.nombreP);  // $("#cedula") esto es el id del campo del formulario
		   //data.nombre el nombre que se coloca en el lado derecho es
		 //el que se coloco en el ajax en $output["nombre"
	

		//$('.modal-title').text("Editar producto");

		
	//	$("#id_empleada").val(id_empleada);
		//$("#action").val("Edit");

	});


		

}

function eliminar_producto(idProducto){
		bootbox.confirm("¿Esta seguro de eliminar?", function(result){
			if(result){
				$.ajax({
					url:"../ajax/producto.php?op=eliminar_producto",
					method:"POST",
					data:{idProducto:idProducto},

					success:function(data){
					//	$("#resultados_ajax").html(data);
						$("#producto_data").DataTable().ajax.reload();
					}
				});
			}//condicion
		}); //bootbox

	}//fin eliminar	producto


init();
