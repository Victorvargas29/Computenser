var tabla;
//funcion q se ejecuta al inicio
function init(){

	listar();

	//cuando se da click al boton submit entonces se ejecuta la funcion guardaryeditar(e);
	$("#inventario_form").on("submit", function(e){
		guardaryeditar(e);
	});

	//cambia el titulo de la ventana modal cuando se da click al boton
	$("#btnNuevo").click(function(){
		$(".modal-title").text("Agregar Servicio");
		$("#idProducto").val('0');
	//	$("#la").attr('class','invisible');
//	$("#cantidadN").attr('type','hidden');
		//document.getElementById("cedula").disabled = false;
	});
/*
	$("#btnGuardar").click(function(){

	});
*/
}

//funcion q limpia los campos del formulario
function limpiar(){

	$("#idInventario").val("");
	$("#cantidad").val("");
	
	$("#idProducto").val('0');	

}

//funcion listar
function listar(){

	tabla=$('#inventario_data').dataTable({  //#usuario_data este es el id de la tabla
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
			url:'../ajax/inventario.php?op=listar',
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

function mostrar(idInventario){
//	$("#la").attr('class','visible');
	$("#cantidadN").attr('type','text');
	

	$.post("../ajax/inventario.php?op=mostrar",{idInventario : idInventario}, function(data, status)
	{
		/*$("<div>").load('<label class="col-form-label">CantidadN</label> <input type="text" class="form-control" name="cantidadN" id="cantidadN">', function() {
		$("#formu").append($(this).html());
});	*/
		
		data =JSON.parse(data);

		$("#inventarioModal").modal("show");
	//	document.getElementById("cedula").disabled = true;
		//$("#cedula").

		$("#cantidad").val(data.cantidad);  // $("#cedula") esto es el id del campo del formulario
		   //data.nombre el nombre que se coloca en el lado derecho es
		 //el que se coloco en el ajax en $output["nombre"]
		
		 $("#idProducto").val(data.idProducto);
		/* var x= document.getElementById('id_div_contenedor');
			x.innerHTML= '<input type="text" value="com_xxx" name="nuevo" id="nuevo" />';
 */


//padre.appendChild(input);


		 $('.modal-title').text("Editar Inventario");
		 $("#idInventario").val(idInventario);
	

		
		$("#action").val("Edit");

	});
}//fin funcion mostrar

//la funcion guardaryeditar(e); se llama cuando se da click al boton submit
function guardaryeditar(e){

	e.preventDefault(); //No se activará la acción predeterminada del evento
	var formData = new FormData($("#inventario_form")[0]);

		$.ajax({
			url: "../ajax/inventario.php?op=guardaryeditar",
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,

			success: function(datos){

				console.log(datos); //muestre los valores en la consola

				$('#inventario_form')[0].reset();
				$('#inventarioModal').modal('hide');
				
				//$('#resultados_ajax').html(datos);
				$('#inventario_data').DataTable().ajax.reload();
				limpiar();
			}
		});

}//fin guardar y editar


function eliminar_inventario(idInventario){
		bootbox.confirm("¿Esta seguro de eliminar?", function(result){
			if(result){
				$.ajax({
					url:"../ajax/inventario.php?op=eliminar_inventario",
					method:"POST",
					data:{idInventario:idInventario},

					success:function(data){
					//	$("#resultados_ajax").html(data);
						$("#inventario_data").DataTable().ajax.reload();
					}
				});
			}//condicion
		}); //bootbox

    }//


 	 $(document).on('click', '.detalle', function(){
	 	//toma el valor del id
		var invent = $(this).attr("id");

		$.ajax({
			url:"../ajax/inventario.php?op=ver_datos_inventario",
			method:"POST",
			data:{invent:invent},
			cache:false,
			dataType:"json",
			success:function(data)
			{
				console.log(data);
				
				$("#invent").html(invent);
				$("#nombreP").html(data.nombreP);
				$("#cantidad2").html(data.cantidad2);
			//	
               
                 //puse el alert para ver el error, sin necesidad de hacer echo en la consulta ni nada
				//alert(data);
				
			}
		})
	});


	  //VER DETALLE COMPRA
	 $(document).on('click', '.detalle', function(){
	 	//toma el valor del id
		var invent = $(this).attr("id");

		$.ajax({
			url:"../ajax/inventario.php?op=ver_detalle",
			method:"POST",
			data:{invent:invent},
			cache:false,
			//dataType:"json",
			success:function(data)
			{
				console.log(data);
				$("#detalles").html(data);
                 //puse el alert para ver el error, sin necesidad de hacer echo en la consulta ni nada
				//alert(data);
				
			}
		})
	});

    


init();