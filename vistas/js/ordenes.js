

var tablfa;
var jsomdetalle;

var idServicio= document.getElementById("idServicio");
var nombreServi= document.getElementById("nombreServi");
var precio= document.getElementById("precio");
var descripcion= document.getElementById("descripcion");
var nombreE;
var cuerpotabla =document.getElementById("cuerpotabla");
//funcion q se ejecuta al inicio
function init(){

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
					console.log(data);			
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
    

	

}





function registrar(e){
	e.preventDefault(); //No se activará la acción predeterminada del evento
	var formData = new FormData($("#form_orden")[0]);
	//console.log("registrarrrrrr");
		$.ajax({
			url: "../ajax/Orden.php?op=guardarOrden",
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,

			success: function(datos){

				console.log(datos); //muestre los valores en la consola

				$('#form_orden')[0].reset();
				//$('#servicioModal').modal('hide');
				guardar_detalles(datos);
				
				
				
				//$('#resultados_ajax').html(datos);
				//$('#servicio_data').DataTable().ajax.reload();
				//limpiar();
			}
		});
	
}
function guardar_detalles(datos) {
	arregloDetalle.forEach(deta => {
		deta.idOrden=datos;
		ordenSer=deta.idServicio+""+deta.idOrden;
		ordenSer=ordenSer.replace(" ", "");
		/*$.ajax({
			url: "../ajax/Orden.php?op=detallesDetalles",
			type: "POST",
			data: deta,
			contentType: false,
			processData: false,

			success: function(datos){

				console.log(datos); 

				
				servicioEmpleada(datos,deta.idServicio);
				
				
				
				
			}
		});*/
		$.post("../ajax/Orden.php?op=detallesDetalles",{"arregloDetalle":deta},function(datas){

		});
		setTimeout(function(){
			servicioEmpleada(ordenSer,deta.idServicio);
			console.log(" viendo el orden servicios ",ordenSer);
		}, 2000);
		
	
	});
	 
}
function servicioEmpleada(data,servicio) {
	
		arregloEmpleada.forEach(empleada => {	
			var formData = new FormData($("#form_compra")[0]);
			if (+servicio===+empleada.idServicio) {
				empleada.ordenServicio=String(data);
				$.post("../ajax/Orden.php?op=detallesEmpleada",{"arregloEmpleada":empleada},function(data){
		
					alert(data);
				});
			} 			
		});
	
	
}


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
			eliminarIten(deta.idServicio);
		};
		
		cuerpotabla.appendChild(fila);
	});

}
function dibujartablaE(arregloEmpleada){
	cuerpotablaE.innerHTML="";
	arregloEmpleada.forEach((data)=>{
		console.log("srevi",data.idServicio);
		console.log("imput",$("#idser").val());
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
	

	
		const objDetalles={
			
			precio: precio.value,
			idServicio:idServicio.value,
			descripcion:descripcion.value,
			nombreServi:nombreServi.value,
			
			
		}
		LlenarDetalles(objDetalles);
		
		dibujartabla(arregloDetalle);
	
	
	

		console.log(arregloDetalle);

}//fin guardar y editar

function agregar_empleadas(){
	

	
	const objEmpleada={
		idServicio:idServicio.value,
		empleada:idEmpleada.value,
		nombreE:nombreE,
		
	}
	LlenarEmpleada(objEmpleada);
	
	dibujartablaE(arregloEmpleada);




	console.log(arregloEmpleada);

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
		alert("Emplado ya registrado para este servicio");
	}
	
	
}
function eliminarIten(id){
	arregloDetalle= arregloDetalle.filter((detalle)=>{
		if (+id !== +detalle.idServicio) {
			return detalle;
			
		}else{
			eliminarEmpleadaS(id);
		}
	});
	dibujartabla(arregloDetalle);
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




init();
