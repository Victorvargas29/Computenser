

var tabla;
var subTotales =document.getElementById("subTotales");

//funcion q se ejecuta al inicio
function init(){
	tasa_dia();	
	
	$("#idVehiculo").selectpicker();
	$("#form_ventas").on("submit", function(e){
		registrar(e);
	});
	$.post("../ajax/Orden.php?op=selectCliente",function(re){
		$("#cedula").html(re);
		$("#cedula").selectpicker();
	});
	$.post("../ajax/ventas.php?op=max",function(data){
		
		var idFac='000'+data;
		idFac=idFac.replace(" ", "");
		$("#idFactura").val(idFac);
		
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
				listar(idOrden);
				$.post("../ajax/Orden.php?op=sumarTotal", {idOrden:idOrden},function(datas){
					dibujartabla(datas)
                });
			});
        });
    });

}


function dibujartabla(sub){
	var tasa=$('#tasa').val();
	var precio=tasa*sub;
	var iva=precio*0.16;
	var total=precio*1.16;
	var totalDolar=(sub*1.16);
	subTotales.innerHTML="";
		let fila = document.createElement("tr");
		fila.innerHTML=`
						<td>${sub}</td>
						<td>${totalDolar.toFixed(2)}</td>
						<td>${precio.toFixed(2)}</td>
						<td>${iva.toFixed(2)}</td>
						<td>${total.toFixed(2)}</td>`;
		subTotales.appendChild(fila);
	

}

function tasa_dia(){
$.getJSON("https://s3.amazonaws.com/dolartoday/data.json",function(data){
	$('#tasa').val(data.USD.promedio_real);
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

function listar(idOrden){
	var tasa=$("#tasa").val();
	tabla=$('#detalles_ventas').dataTable({ 
		"aProcessing":true,//Activamos el procesamiento del datatables
		"aServerSide":true,//Paginacion y filtrado realizados por el servidor
		
		dom:'frtilp',//Definimos los elementos del control de tabla
		
		"ajax" : {
            'url' : '../ajax/Orden.php?op=mostrarDetalles',
            data : { 'idOrden' : idOrden, 'tasa': tasa},
            type : "post",
			datatype: "json",
			error: function(e){
				console.log(e.responseText);
			}
        },
		/*"ajax":
		{
			url:'../ajax/Orden.php?op=mostrarDetalles',
			type: "get",
			datatype: "json",
			error: function(e){
				console.log(e.responseText);
			}
		},*/
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








function registrar(e){
	e.preventDefault();
	//e.preventDefault(); //No se activará la acción predeterminada del evento
	var formData = new FormData($("#form_ventas")[0]);
	//console.log("registrarrrrrr",formData);
		$.ajax({
			url: "../ajax/ventas.php?op=guardarFactura",
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,

			success: function(datos){

				console.log("repuesta",datos); //muestre los valores en la consola

				$('#form_ventas')[0].reset();
				//$('#servicioModal').modal('hide');
				$("#detalles_ventas").DataTable().ajax.reload();
				$("#sub").DataTable().ajax.reload();
				actualizarOrden(datos);
				tasa_dia();
				
			}
		});
	
}
function actualizarOrden(idOrden){
	console.log("idORDEN",idOrden);

	$.ajax({
		url:"../ajax/Orden.php?op=cambiarEstado",
		method:"POST",
		data:{idOrden:idOrden},
		success:function(data){
			console.log("datps",data);
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
