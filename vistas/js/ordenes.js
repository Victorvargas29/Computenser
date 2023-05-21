

var tablfa;
var jsomdetalle;

var idServicio= document.getElementById("idServicio");
var nombreServi= document.getElementById("nombreServi");
var precio= document.getElementById("precio");
var descripcion= document.getElementById("descripcion");
var nombreE;
var cuerpotabla =document.getElementById("cuerpotabla");
//funcion q se ejecuta al inicio
var tablaO;
function init(){
	listarordenes();
	$("#form_orden").on("submit", function(e){
		
		registrar(e);


	});
	
	$("#idVehiculo").selectpicker();
	
	$.post("../ajax/Orden.php?op=selectCliente",function(re){
		$("#cedula").html(re);
		$("#cedula").selectpicker();
	});
	$.post("../ajax/Servicio.php?op=selectServicio",function(re){
		$("#idServicio").html(re);
		$("#idServicio").selectpicker();
		
	});
	$.post("../ajax/empleada.php?op=selectEmpleada",function(re){
		$("#idEmpleada").html(re);
		$("#idEmpleada").selectpicker();
		
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
        $("#idEmpleada").change(function(){
            $("#idEmpleada option:selected").each(function(){
				
                cedula= $(this).val();
				$.post("../ajax/empleada.php?op=mostrar",{cedula : cedula}, function(data, status)
				{
					console.log(data);			
					data =JSON.parse(data);	  
					
					 $("#idEmpleada").val(cedula);
					 nombreE=data.nombre;
					 console.log("esto es el id Empleada",idEmpleada.value);
					 
				});
            });
        });
    });
	$(document).ready(function(){
        $("#idServicio").change(function(){
            $("#idServicio option:selected").each(function(){
				
                idServicio1= $(this).val();
				$.post("../ajax/servicio.php?op=mostrar",{idServicio : idServicio1}, function(data, status)
				{
					//.log(data);			
					data =JSON.parse(data);	  
					 $("#precio").val(data.precio);
					$("#idServicio").val(idServicio1);
					 $("#nombreServi").val(data.nombre);
					 console.log("esto es el id servicio",idServicio.value);
					
				});
            });
        });
    });

	$(document).ready(function(){
        $("#idVehiculo ").change(function(){
            $("#idVehiculo option:selected").each(function(){
                idVehiculo1= $(this).val();
				$("#idVehiculo").val(idVehiculo1);	 
					 console.log(idVehiculo1);
			});
        });
    });
	$.post("../ajax/Orden.php?op=max",function(data){
		var num='000'+data;
		num=num.replace(" ", "");
		$("#numDoc").val(num);
		$("#ordenH3").text("N° Orden: "+num);
		
	});
}

function registrar(e){
	e.preventDefault();
	if (arregloDetalle.length===0) {
		alert("No puede registrar una orden si servicios");
	} else {
		var existeE;
		arregloDetalle.forEach(deta => {
		
			var result=arregloEmpleada.find((empleada)=>{	
		
				if((deta.idServicio === empleada.idServicio)){
					return result;
				}
			});
		
			existeE=result;
		});
		var formData = new FormData($("#form_orden")[0]);
		console.log("registrarrrrrr", arregloDetalle);
		$.ajax({
			url: "../ajax/Orden.php?op=guardarOrden",
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,

			success: function(datos){
				console.log(datos);
				$('#form_orden')[0].reset();
				guardar_detalles(datos);
			}
		});
		
	}
	
	
}




function guardar_detalles(datos) {
	for (const deta of arregloDetalle) {
		deta.idOrden=datos;
		ordenSer=deta.idServicio+""+deta.idOrden;
		ordenSer=ordenSer.replace(" ", "");
		let todoMenus;
		$.ajax({
			url:"../ajax/Orden.php?op=detallesDetalles",
			method:"POST",
			data:{"arregloDetalle":deta},
			async:false,

			success:function(data){
				
			
				console.log(" viendo el orden servicios ",data);
			}
		});
		setTimeout(servicioEmpleada(ordenSer,deta.idServicio), 2000);
		//setTimeout(function(){
			
			
		//}, 100);
	}
	
	 
}
function servicioEmpleada(data,servicio) {
	
		arregloEmpleada.forEach(empleada => {	
			
			if (+servicio===+empleada.idServicio) {
				console.log(" viendo las empleadas ",empleada.nombreE, "con el servicio", servicio);
				empleada.ordenServicio=String(data);
				$.post("../ajax/Orden.php?op=detallesEmpleada",{"arregloEmpleada":empleada},function(data){
		
					//alert(data);
				});
			} 			
		});
	
	
}


function mostrarOrden(numDoc){
	$.ajax({
		

		success:function(data){
			console.log(numDoc);
			//window.open("http://demos.computenser.com/report/facturaPdf.php?idFactura="+idFactura);

			
			window.open("http://teg.test/report/ordenPdf.php?numDoc="+numDoc);
		//	window.open("http://merilara.computenser.com/report/facturaPdf.php?idFactura="+idFactura);
		}
	});

	$.post("../report/facturaPdf.php",{numDoc : numDoc});
}//fin funcion mostrar
function dibujartabla(arregloDetalle){
	cuerpotabla.innerHTML="";
	arregloDetalle.forEach((deta)=>{
		let fila = document.createElement("tr");
		fila.innerHTML=`
						<td>${deta.descripcion}</td>
						<td>${deta.nombreServi}</td>
						<td>${+deta.precio}</td>`;
		let tdEmpleada =document.createElement("td");
		let botonEmpleada = document.createElement("button");
		botonEmpleada.classList.add("btn","btn-primary");
		botonEmpleada.title="Empleado";
		botonEmpleada.type="button";

		botonEmpleada.className="fas fa-address-card btn btn-primary btn-md";
		tdEmpleada.appendChild(botonEmpleada);
		fila.appendChild(tdEmpleada);
		botonEmpleada.onclick=()=>{
			abrirModal(deta.idServicio,deta.nombreServi);
		};
		let tdEliminar =document.createElement("td");
		let botonEliminar = document.createElement("button");
		botonEliminar.classList.add("btn","btn-danger");
		botonEliminar.title="Eliminar";
		botonEliminar.type="button";
		botonEliminar.className="fas fa-trash-alt btn btn-danger btn-md";
		tdEliminar.appendChild(botonEliminar);
		fila.appendChild(tdEliminar);
		botonEliminar.onclick=()=>{
			eliminarIten(deta.idServicio,deta.nombreServi);
		};
		
		cuerpotabla.appendChild(fila);
	});

}
function dibujartablaE(arregloEmpleada){
	cuerpotablaE.innerHTML="";
	arregloEmpleada.forEach((data)=>{
		console.log("1234",data.idServicio);
		console.log("123",$("#idser").val());
		if (data.idServicio===$("#idser").val()) {
			let fila = document.createElement("tr");
			fila.innerHTML=`
							<td>${data.empleada}</td>
							<td>${data.nombreE}</td>`;
			let tdEliminar =document.createElement("td");
			let botonEliminarE = document.createElement("button");
			botonEliminarE.classList.add("btn","btn-danger");
			botonEliminarE.title="Eliminar";
			botonEliminarE.type="button";
			botonEliminarE.className="fas fa-trash-alt btn btn-danger btn-md";
			tdEliminar.appendChild(botonEliminarE);
			fila.appendChild(tdEliminar);
			botonEliminarE.onclick=()=>{
				eliminarItenE(data.empleada);
			};
			
			cuerpotablaE.appendChild(fila);
		}
		
	});

}

function agregar_detalles(){
	if ($("#idServicio").val()!==null) {
		console.log("descripcion", $("#descripcion").val());
		if ($("#descripcion").val()!='') {
			const objDetalles={
				precio: precio.value,
				idServicio:idServicio.value,
				descripcion:descripcion.value,
				nombreServi:nombreServi.value,
			}
			$("#descripcion").val('');
			$("#idServicio").val('default').selectpicker("refresh");
			LlenarDetalles(objDetalles);
			dibujartabla(arregloDetalle);
			console.log(arregloDetalle);
			document.getElementById("descripcion").style.border = 0;
		} else {
			document.getElementById("descripcion").style.borderColor = "red";
			swal.fire(
				"¡Ingrese Descripcion!",
				"No se puede agreagar un servicio sin descripcion",
				"error"
				);
		
		}
		
	} else {
		swal.fire(
			"¡Seleccione un servicio!",
			"No se puede agreagar un servicio sin datos",
			"error"
			);
	
	}
}//fin guardar y editar

function agregar_empleadas(){

	if ($("#idEmpleada").val()!==null) {
		const objEmpleada={
			idServicio:$("#idser").val(),
			empleada:idEmpleada.value,
			nombreE:nombreE,	
		}
		$("#idEmpleada").val('default').selectpicker("refresh");
		LlenarEmpleada(objEmpleada);

		dibujartablaE(arregloEmpleada);
		console.log("0000000000",arregloEmpleada);
	} else {
		swal.fire(
			"¡Seleccione un empleado!",
			"No se puede agreagar un empleado sin datos",
			"error"
		);
	}
	
}
function abrirModal(idServicio,nombreServi) {
	
	$("#idser").val(idServicio);
	$("#empleadaModal").modal("show");
	$('.modal-title').text("Agregar empleado al servicio");
	dibujartablaE(arregloEmpleada);
}

var arregloDetalle=[];
function LlenarDetalles(objDetalles){
	
	const result=arregloDetalle.find((detalle)=>{
		
		
		if((+objDetalles.idServicio === +detalle.idServicio)){
			return detalle;
		}
	});

	if (!result) {
		arregloDetalle.push(objDetalles);
	} else {
		swal.fire(
			"¡Registro duplicado!",
			"El servicio ya esta registrado para esta orden",
			"error"
		  );
	}
	
	
}
var arregloEmpleada=[];
function LlenarEmpleada(objEmpleada){
	
	const result=arregloEmpleada.find((detalle)=>{
		
		console.log("objempleada",objEmpleada.empleada);
		console.log("detalle",detalle.empleada);


		if((objEmpleada.empleada === detalle.empleada && objEmpleada.idServicio === detalle.idServicio)){
			return detalle;
		}
	});

	if (!result) {
		arregloEmpleada.push(objEmpleada);
	} else{
		//bootbox.alert("Emplado ya registrado para este servicio");
		swal.fire(
			"¡Registro duplicado!",
			"Emplado ya registrado para este servicio",
			"error"
		  );
	}
	
	
}
function eliminarIten(id,nombre){
	swal.fire({
		title: "¿Esta seguro(a) de eliminar este servicio: "+nombre+", de esta orden?",
		type: "question",
		showCancelButton: true,
		confirmButtonText: "Eliminar",
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#ca5939"
	})
	.then(result => {
		
		 if (result.value) {
			arregloDetalle= arregloDetalle.filter((detalle)=>{
				if (+id !== +detalle.idServicio) {
					return detalle;
					
				}else{
					
					eliminarEmpleadaS(id);
				}
			});
			dibujartabla(arregloDetalle);

		swal.fire(
		  "Se eliminino el servicio: "+nombre,

		  "¡Aviso!",
		  "success"
		);
	  }
	});


	//
	
}
function eliminarItenE(id){
	arregloEmpleada= arregloEmpleada.filter((detalle)=>{
		if (+id !== +detalle.empleada) {
			return detalle;
			
		}
	});
	dibujartablaE(arregloEmpleada);
}
function eliminarEmpleadaS(id){
	arregloEmpleada= arregloEmpleada.filter((detalle)=>{
		if (+id !== +detalle.idServicio) {
			return detalle;
			
		}
	});
	//dibujartabla(arregloEmpleada);
}
function cancelarOrden() {
	$.ajax({
		url:'../vistas/ordenes.php',
		method: "POST",
		success: function(res){ $("#seccion1").html(res); },
		error: function(err){ $("#seccion1").html("pagina vista/ordenes.php no found");}
		});
	
}

function listarordenes(){

	tablaO=$('#orden_data').dataTable({  
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
			url:'../ajax/Orden.php?op=listarordenes',
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




init();
