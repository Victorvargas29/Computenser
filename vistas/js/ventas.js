

var tablfa;


//funcion q se ejecuta al inicio
function init(){
	tasa_dia();
		
	idfactura();
	listarSubTortales();
	listarfacturas();
	$("#idVehiculo").selectpicker();
	$("#form_compra").on("submit", function(e){
		registrar(e);
	});
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
					$("#idOrden").selectpicker();
					$("#idOrden").val('default').selectpicker("refresh");

                });
            });
        });
    });

	$(document).ready(function(){
        $("#idVehiculo ").change(function(){
            $("#idVehiculo option:selected").each(function(){
                idVehiculo= $(this).val();
				$.post("../ajax/Orden.php?op=selectOrden", {idVehiculo:idVehiculo},function(datas){
                    
					$("#idOrden").html(datas);
					$("#idOrden").selectpicker();
					$("#idOrden").val('default').selectpicker("refresh");

					
					

                });
			});
        });
    });
	$(document).ready(function(){
        $("#idOrden ").change(function(){
            $("#idOrden option:selected").each(function(){
                idOrden= $(this).val();
				$.post("../ajax/Orden.php?op=mostrarDetalles", {idOrden:idOrden},function(datas){
					//dibujartabla(datas);
					for (const iterator of datas) {
						console.log(iterator.numDoc);
					}
					//console.log(datas[0].codeServicio);
                });
			});
        });
    });

}


function tasa_dia(){
$.getJSON("https://s3.amazonaws.com/dolartoday/data.json",function(data){
	$('#tasa').val(data.USD.transferencia);
 // $('#texto').html('Transferencia: '+data.USD.transferencia+ '<br> Sicad: ' + data.USD.sicad2);
 // $('#al').html('DolarToday al: '+data._timestamp.fecha);
    });   

}

/*=============================================
AGREGANDO PRODUCTOS A LA VENTA DESDE LA TABLA
=============================================*/
$("#listaC").keyup(function(){
	cargarlista($("#listaC").val(),$("#comboCedula").val());

	if ($("#listaC").val()=" ") {
		$("#cedula").val(cedula1);  // $("#cedula") esto es el id del campo del formulario	
		$("#nombre").val(" ");   //data.nombre el nombre que se coloca en el lado derecho es
	//	$("#nombre").prop('disabled', true);

		$("#apellido").val(""); //el que se coloco en el ajax en $output["nombre"]
		$("#direccion").val("");
		$("#telefono").val("");
		$("#correo").val("");
		
	}
	
});
$("#listaE").keyup(function(){
	cargarlistaE($("#listaE").val());
	

});
$("#idServicio").change(function(){
	
	cargarServicio($("#idServicio").val());

//console.log($("#idServicio").val($("#idServicio").val()));
});
$("#comboCedula").change(function(){
	
	cargarlista($("#listaC").val(),$("#comboCedula").val());

//console.log($("#idServicio").val($("#idServicio").val()));
});

/*function listar(){
	tabla=$('#detalles_ventas').dataTable({ 
		"aProcessing":true,//Activamos el procesamiento del datatables
		"aServerSide":true,//Paginacion y filtrado realizados por el servidor
		
		dom:'frtilp',//Definimos los elementos del control de tabla
		
		"ajax":
		{
			url:'arregloDetalle',
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

}*/
function listarSubTortales(){
	tabla=$('#sub').dataTable({ 
		"aProcessing":true,//Activamos el procesamiento del datatables
		"aServerSide":true,//Paginacion y filtrado realizados por el servidor
		
		dom:'r',//Definimos los elementos del control de tabla  Bfrtilp' t=mostra reg.
		
		"ajax":
		{
			url:'../ajax/ventas.php?op=listarSubtotales',
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
var arregloDetalle=[];
function LlenarDetalles(objDetalles){
	
	const result=arregloDetalle.find((detalle)=>{
		
		
		if(+objDetalles.idServicio === +detalle.idServicio){
			return detalle;
		}
	});

	if (result) {
		arregloDetalle = arregloDetalle.map((detalle)=>{
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
		
	});
	} else {
		arregloDetalle.push(objDetalles);
	}
	
	
}

function agregar_detalles(dat){
	//console.log(dat);
	// e.preventDefault();//No se activará la acción predeterminada del evento
	if (dat==0) {
		console.log(dat);
		const objDetalles={
			cantidad:cant.value,
			precio: precio.value,
			idServicio:servicio.value,
			tasa:tasa.value,
			descripcion:descripcion.value,

		}
		LlenarDetalles(objDetalles);
		
		dibujartabla(arregloDetalle);
	} else {
		arregloDetalle.forEach(deta => {
			deta.idFactura=dat;
		

			var formData = new FormData($("#form_compra")[0]);
			$.post("../ajax/ventas.php?op=detallesDetalles",{"arregloDetalle":deta},function(respuesta){
				alert(respuesta);
			});
		
		});
	}
	

		console.log(arregloDetalle);

}//fin guardar y editar
function eliminarIten(id){
	arregloDetalle= arregloDetalle.filter((detalle)=>{
		if (+id !== +detalle.idServicio) {
			return detalle;
			
		}
	});
	dibujartabla(arregloDetalle);
}

function dibujartabla(arregloDetalle){
	cuerpotabla.innerHTML="";
	console.log(arregloDetalle[0]["descripcion"]);
	/*for (let deta in arregloDetalle) {
		
		
	
		let fila = document.createElement("tr");
		fila.innerHTML=`
						<td>${deta.descripcion}</td>
						<td>${deta.precio}</td>
						<td>${deta.numDoc}</td>
						<td>${deta.numDoc}</td>
						<td>${deta.ordenServicio}</td>
						<td>${deta.codeServicio}</td>`;
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
	}*/

}
function cargarlista(cedula1,letra){

	var cedula=letra+cedula1;
	if (cedula=='V-' || cedula=='J-' || cedula=='C-' || cedula=='G-') {
		$("#cedula").val(cedula1);  // $("#cedula") esto es el id del campo del formulario	
		$("#nombre").val(" ");   //data.nombre el nombre que se coloca en el lado derecho es
	//	$("#nombre").prop('disabled', true);

		$("#apellido").val(""); //el que se coloco en el ajax en $output["nombre"]
		$("#direccion").val("");
		$("#telefono").val("");
		$("#correo").val("");
		
	}

	console.log("asdfa",cedula);
		
		$.post("../ajax/cliente.php?op=mostrar",{cedula : cedula}, function(data, status)
		{			
			data = JSON.parse(data);
			console.log("asdfa",data);				
				$("#cedula").val(cedula1);  // $("#cedula") esto es el id del campo del formulario	
				$("#nombre").val(data.nombre+" "+data.apellido);   //data.nombre el nombre que se coloca en el lado derecho es
				$("#nombre").prop('disabled', true);

				$("#apellido").val(data.apellido); //el que se coloco en el ajax en $output["nombre"]
				$("#direccion").val(data.direccion);
				$("#telefono").val(data.telefono);
				$("#correo").val(data.correo);
				
			

		});	
}
function cargarlistaE(cedula){

	
		
	$.post("../ajax/empleada.php?op=mostrar",{cedula : cedula}, function(data, status)
	{
		console.log(data);
		data = JSON.parse(data);

		
	//	$("#idEmpleada").val(data.cedula);
		//$("#cedula").
		$("#cedula").val(cedula);  // $("#cedula") esto es el id del campo del formulario
	//	$("#cedula").prop('disabled', false);
		
		
		$("#nombres").val(data.nombre);   //data.nombre el nombre que se coloca en el lado derecho es
		$("#apellidos").val(data.apellido); //el que se coloco en el ajax en $output["nombre"]
		$("#telefono").val(data.telefono);
		$("#Departamento").val(data.nom);
		//$("#email").val(data.email);
		

		

	});

}
function cargarServicio(idServicio){
	
		$.post("../ajax/servicio.php?op=mostrar",{idServicio : idServicio}, function(data, status)
		{
			console.log(data);			
			data =JSON.parse(data);	  
			 $("#precio").val(data.precio);
			 $("#nombre_ser").val(data.nombre);
			 
		});
		//var sel =document.getElementById("idServicio");
	////var seltex= sel.options[getElementIndex("idServicio").text]
	///$("nombre_ser").val($seltex);
}
function idfactura(){
	var idFf=1;
	$.post("../ajax/ventas.php?op=mostrar", function(data, status)
	{	idFf=1;
		console.log(data);			
		data =JSON.parse(data);	 
		idF =data.idFactura;
		$('#idFacturas').html(idF);
		 $("#idFactura").val(idF);
	//	 $("#idFacturas").val(idF);
		// console.log(idF); 
		//// $("#nombre_ser").val(data.nombre);
	});
	///$("#idFactura").val($("#idFactura").val()+1);
	//var sel =document.getElementById("idServicio");
////var seltex= sel.options[getElementIndex("idServicio").text]
///$("nombre_ser").val($seltex);
}

function eliminar_item(iddetallesFT){
	
	$.ajax({
		url:"../ajax/ventas.php?op=eliminar_item",
		method:"POST",
		data:{iddetallesFT:iddetallesFT},

		success:function(data){
			$("#detalles_ventas").DataTable().ajax.reload();
			$("#sub").DataTable().ajax.reload();
		}
	});
}

function registrar(e){
	e.preventDefault();
	//e.preventDefault(); //No se activará la acción predeterminada del evento
	var formData = new FormData($("#form_compra")[0]);
	//console.log("registrarrrrrr",formData);
		$.ajax({
			url: "../ajax/ventas.php?op=guardarVenta",
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,

			success: function(datos){

				console.log("datps",datos); //muestre los valores en la consola

				$('#form_compra')[0].reset();
				//$('#servicioModal').modal('hide');
				$("#detalles_ventas").DataTable().ajax.reload();
				$("#sub").DataTable().ajax.reload();
				idfactura();
				tasa_dia();
				agregar_detalles(datos);
				
				//$('#resultados_ajax').html(datos);
				//$('#servicio_data').DataTable().ajax.reload();
				//limpiar();
			}
		});
	
}

function borrar_temporal(){
	var formData = new FormData($("#form_compra")[0]);
	$.ajax({
		url: "../ajax/ventas.php?op=borrar_temp",
		type: "POST",
		data: formData,
		contentType: false,
		processData: false,

		success: function(datos){

			console.log(datos); //muestre los valores en la consola
			$('#form_compra')[0].reset();
			$("#detalles_ventas").DataTable().ajax.reload();
			$("#sub").DataTable().ajax.reload();
			idfactura();
			tasa_dia();
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
			url:'../ajax/ventas.php?op=listarfacturas',
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

			
			window.open("http://projecteg.test/report/facturaPdf.php?idFactura="+idFactura);
		//	window.open("http://merilara.computenser.com/report/facturaPdf.php?idFactura="+idFactura);
		}
	});

	$.post("../report/facturaPdf.php",{idFactura : idFactura});
}//fin funcion mostrar


function tipomoneda(idFactura, tipo_moneda){
		var coin = "";
		if(tipo_moneda==1){
			coin="Bolivares"		
			}else{
				coin="Dolares";
			}
	swal.fire({
		
		title: "¿Desea cambiar el tipo de moneda a "+coin+"?",
		type: "question",
		showCancelButton: true,
		confirmButtonText: "Cambiar",
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#ca5939"
	})
	.then(result => {
		 if (result.value) {
			   $.ajax({
				url:"../ajax/ventas.php?op=activarydesactivar",
				method:"POST",
				data:{idFactura:idFactura, tipo_moneda:tipo_moneda},

				success:function(data){
			//		$("#resultados_ajax").html(data);
					$("#factura_data").DataTable().ajax.reload();
				}
			});
			if(tipo_moneda==0){
				  tipo_moneda="Dolares"
			  }else{
				  tipo_moneda="Bolivares"
			  }
		swal.fire(
		  "Se cambio el tipo de moneda a: "+tipo_moneda,

		  "¡Aviso!",
		  "success"
		);
	  }
	});


}//fin tipomoneda

function anulacion(idFactura, anulado){
if(anulado!=1){
	swal.fire({
		title: "¿Esta seguro(a) de anular la factura N°: 00"+idFactura+" ...? ¡esta acción es irreversible!",
		type: "warning",
		showCancelButton: true,
		confirmButtonText: "Anular",
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#ca5939"
	})
	.then(result => {
		 if (result.value) {
			   $.ajax({
				url:"../ajax/ventas.php?op=anular",
				method:"POST",
				data:{idFactura:idFactura,anulado:anulado},

				success:function(data){
			//		$("#resultados_ajax").html(data);
					$("#factura_data").DataTable().ajax.reload();
				}
			});

		swal.fire(
		  "Se ha anulado la factura N°: "+idFactura,

		  "¡Aviso!",
		  "success"
		);
	  }
	});
}else{

}
}//fin cambiar estado


init();
