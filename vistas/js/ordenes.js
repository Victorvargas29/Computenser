

var tablfa;
var jsomdetalle;
var idFalla= document.getElementById("idFalla");
var idServicio= document.getElementById("idServicio");
var nombreServi= document.getElementById("nombreServi");
var precio= document.getElementById("precio");
var descripcion= document.getElementById("descripcion");
var nombreFalla= document.getElementById("nombreFalla");
var cuerpotabla =document.getElementById("cuerpotabla");
//funcion q se ejecuta al inicio
function init(){
	///tasa_dia();
	//listar();	
	$("#idFalla").selectpicker();
	$("#idVehiculo").selectpicker();
	
	$.post("../ajax/Orden.php?op=selectCliente",function(re){
		$("#cedula").html(re);
		$("#cedula").selectpicker();
	});
	$.post("../ajax/Servicio.php?op=selectServicio",function(re){
		$("#idServicio").html(re);
		$("#idServicio").selectpicker();
		
	});
	$(document).ready(function(){
        $("#cedula").change(function(){
            $("#cedula option:selected").each(function(){
				
                cedula= $(this).val();
                $.post("../ajax/Orden.php?op=selectVehiculo", {cedula:cedula},function(datas){
                    
					$("#idVehiculo").html(datas);
					
					$("#idVehiculo").selectpicker();
					$("#idVehiculo").val('default').selectpicker("refresh");

                });
            });
        });
    });


	$(document).ready(function(){
        $("#idVehiculo").change(function(){
            $("#idVehiculo option:selected").each(function(){
				
                idVehiculo= $(this).val();
                $.post("../ajax/Orden.php?op=selectFalla", {idVehiculo:idVehiculo},function(datas){
                    
					$("#idFalla").html(datas);
					
					$("#idFalla").selectpicker();
					$("#idFalla").val('default').selectpicker("refresh");

                });
            });
        });
    });
	$(document).ready(function(){
        $("#idFalla").change(function(){
            idFalla= $(this).val();
			console.log(idFalla);
                $.post("../ajax/falla.php?op=get_falla_por_id", {idFalla:idFalla},function(data){
					idFalla= $(this).val();				
					$("#nombreFalla").val(data.descripcion);
                });
        });
    });
$("#form_orden").on("submit", function(){
	registrar();
	

});

}
function listarSubTortales(){
	tabla=$('#sub').dataTable({ 
		"aProcessing":true,//Activamos el procesamiento del datatables
		"aServerSide":true,//Paginacion y filtrado realizados por el servidor
		
		dom:'r',//Definimos los elementos del control de tabla  Bfrtilp' t=mostra reg.
		
		"ajax":
		{
			url:'../ajax/ordenes.php?op=listarSubtotales',
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

}

function cargarServicio(idServicio){
	
		$.post("../ajax/servicio.php?op=mostrar",{idServicio : idServicio}, function(data, status)
		{
			console.log(data);			
			data =JSON.parse(data);	  
			 $("#precio").val(data.precio);
			 $("#nombreServi").val(data.nombre);
			 
		});
		//var sel =document.getElementById("idServicio");
	////var seltex= sel.options[getElementIndex("idServicio").text]
	///$("nombre_ser").val($seltex);
}

function eliminar_item(iddetallesFT){
	
	$.ajax({
		url:"../ajax/ordenes.php?op=eliminar_item",
		method:"POST",
		data:{iddetallesFT:iddetallesFT},

		success:function(data){
			$("#detalles_ordenes").DataTable().ajax.reload();
			$("#sub").DataTable().ajax.reload();
		}
	});
}

function registrar(){
	//e.preventDefault(); //No se activará la acción predeterminada del evento
	var formData = new FormData($("#form_orden")[0]);
	//console.log("registrarrrrrr");
		$.ajax({
			url: "../ajax/ordenes.php?op=guardarCompra",
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,

			success: function(datos){

				console.log(datos); //muestre los valores en la consola

				$('#form_orden')[0].reset();
				//$('#servicioModal').modal('hide');
				$("#detalles_ordenes").DataTable().ajax.reload();
				$("#sub").DataTable().ajax.reload();
				idfactura();
				tasa_dia();
				
				//$('#resultados_ajax').html(datos);
				//$('#servicio_data').DataTable().ajax.reload();
				//limpiar();
			}
		});
	
}


function listarfacturas(){

	tabla=$('#factura_data').dataTable({  //#usuario_data este es el id de la tabla
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
			url:'../ajax/ordenes.php?op=listarfacturas',
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


function mostrarFactura(idFactura){
	$.ajax({
		

		success:function(data){
			console.log(idFactura);
			//window.open("http://demos.computenser.com/report/facturaPdf.php?idFactura="+idFactura);

			
			window.open("http://computenser.test/computenser/report/facturaPdf.php?idFactura="+idFactura);
		//	window.open("http://merilara.computenser.com/report/facturaPdf.php?idFactura="+idFactura);
		}
	});

	$.post("../report/facturaPdf.php",{idFactura : idFactura});
}//fin funcion mostrar
function dibujartabla(arregloDetalle){
	cuerpotabla.innerHTML="";
	arregloDetalle.forEach((deta)=>{
		let fila = document.createElement("tr");
		fila.innerHTML=`
						<td>${deta.descripcion}</td>
						<td>${deta.nombreFalla}</td>
						<td>${deta.nombreServi}</td>
						<td>${+deta.precio}</td>
						<td>${+deta.precio}</td>`;
		let tdEliminar =document.createElement("td");
		let botonEliminar = document.createElement("button");
		botonEliminar.classList.add("btn","btn-danger");
		botonEliminar.innerText="Eliminar";
		tdEliminar.appendChild(botonEliminar);
		fila.appendChild(tdEliminar);
		botonEliminar.onclick=()=>{
			eliminarIten(deta.idServicio);
		};
		cuerpotabla.appendChild(fila);
	});

}
function agregar_detalles(){
	

	
		const objDetalles={
			idFalla:idFalla.value,
			precio: precio.value,
			idServicio:idServicio.value,
			descripcion:descripcion.value,
			nombreServi:nombreServi.value,
			nombreFalla:nombreFalla.value,


		}
		LlenarDetalles(objDetalles);
		
		dibujartabla(arregloDetalle);
	
	
	

		console.log(arregloDetalle);

}//fin guardar y editar

var arregloDetalle=[];
function LlenarDetalles(objDetalles){
	
	const result=arregloDetalle.find((detalle)=>{
		
		
		if((+objDetalles.idServicio === +detalle.idServicio) && (+objDetalles.idFalla === +detalle.idFalla)){
			return detalle;
		}
	});

	if (result) {
		/*arregloDetalle = arregloDetalle.map((detalle)=>{
			console.log(" idservicio ", +detalle.cantidad + +objDetalles.cantidad);
			
			if (+detalle.idServicio === +objDetalles.idServicio) {
				var cant=+detalle.cantidad + +objDetalles.cantidad;
				return {
					cantidad: cant,
					precio: detalle.precio,
					idServicio:detalle.idServicio,
					tasa:detalle.tasa,
					descripcion:detalle.descripcion,
				};
			}
			return detalle;
		
		});*/
	} else {
		arregloDetalle.push(objDetalles);
	}
	
	
}




init();
