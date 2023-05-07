

var tabla;

var cuerpotabla =document.getElementById("cuerpotabla");

//funcion q se ejecuta al inicio

function limpiar(){

	$("#idVehiculo").val(0);
	$("#modelo1").val("");
	$("#color1").val("");
	$("#cliente").val("");
	$("#descripcion").val("");

}
function init(){
	listar();

	$("#falla_form").on("submit", function(e){
		guardaryeditar(e);
	});

	$(document).ready(function(){
		$.post("../ajax/falla.php?op=selectVehiculo", function(r){
			$("#idVehiculo").html(r);
			$('#idVehiculo').selectpicker();
		  //  $('#idMarcas').selectpicker("refresh");
		});

		$("#idVehiculo").change(function(){
			
			cargarVehiculo($("#idVehiculo").val());
			$('#fallas_data').DataTable().ajax.reload();
			
		});
	});
}
function guardaryeditar(e){

	e.preventDefault(); //No se activará la acción predeterminada del evento
	var formData = new FormData($("#falla_form")[0]);

		$.ajax({
			url: "../ajax/falla.php?op=guardaryeditar",
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,

			success: function(datos){

				//console.log(datos); //muestre los valores en la consola

				$('#falla_form')[0].reset();
				
				$('#fallaModal').modal('hide');
				$("#idVehiculo").val(0);
				//$('#resultados_ajax').html(datos);
				$('#fallas_data').DataTable().ajax.reload();
				limpiar();
			}
		});

}//fin guardar y editar



function cargarVehiculo(placa){

	
		
	$.post("../ajax/falla.php?op=mostrarVehiculo",{placa : placa}, function(data, status)
	{			
		data = JSON.parse(data);			
		$("#modelo1").val(data.modelo_nom);
		$("#color1").val(data.color_nom);  
		$("#cliente").val(data.nombreCli);
		
		
		console.log(data.modelo_nom);
	});	
	//buscarFalla(placa);
}
function listar(){

	tabla=$('#fallas_data').dataTable({  //#usuario_data este es el id de la tabla
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
			url:'../ajax/falla.php/'+1+'?op=listar',
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

function buscarFalla(idVehiculo){
	/*
	$.post("../ajax/falla.php?op=mostrarPorVehiculo",{idVehiculo: idVehiculo}, function(data, status)
	{
		console.log("fdadsasdasdhola");
		data = JSON.parse(data);

		console.log(data);
		cuerpotabla.innerHTML="";
		data.forEach((deta)=>{
			let fila = document.createElement("tr");
			fila.innerHTML=`
							<td>${deta.vehiculo_placa}</td>
							<td>${deta.descripcion}</td>
							<td>${deta.fecha}</td>
							<td>${deta.estatus}</td>`;
			let tdEliminar =document.createElement("td");
			let botonEliminar = document.createElement("button");
			botonEliminar.classList.add("btn","btn-danger");
			botonEliminar.innerText="Eliminar";
			tdEliminar.appendChild(botonEliminar);
			fila.appendChild(tdEliminar);
			botonEliminar.onclick=()=>{
				eliminarIten(deta.id);
			};
		cuerpotabla.appendChild(fila);
	});


	});


*/	

}




init();
