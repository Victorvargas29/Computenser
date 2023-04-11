

var tablfa;
const servicio= document.getElementById("idServicio");
const cant= document.getElementById("cantidad");
const precio= document.getElementById("precio");
const tasa= document.getElementById("tasa");
const descripcion= document.getElementById("descripcion");
const cuerpotabla =document.getElementById("cuerpotabla");

//funcion q se ejecuta al inicio
function init(){
	tasa_dia();
	//listar();	
	idfactura();
	listarSubTortales();
	listarfacturas();
	//cuando se da click al boton submit entonces se ejecuta la funcion guardaryeditar(e);
/*	$("#form_compra").on("button", function(e){
		cargarlistaS(e);
	});

	//cambia el titulo de la ventana modal cuando se da click al boton
	
	

	$("#btnGuardar").click(function(){

	});



$("form_compra").on("submit", function(){
	cargarlistaS();

});
*/
$("#form_compra").on("submit", function(e){
	registrar(e);
	

});

}

$(document).ready(function(){
	$("#listafact").click(function(){
		$.ajax({
		url:'lista_facturas.php',
		method: "POST",
		success: function(res){ $("#seccion1").html(res); },
		error: function(err){ $("#seccion1").html(err);}
		});
	});
});
$(document).ready(function(){
	$.post("../ajax/vehiculo.php?op=selectVehiculo", function(r){
		$("#idVehiculo").html(r);
		$('#idMarca').selectpicker('render');
	  //  $('#idMarcas').selectpicker("refresh");
	});
});


function tasa_dia(){
$.getJSON("https://s3.amazonaws.com/dolartoday/data.json",function(data){
	$('#tasa').val(data.USD.transferencia);
 // $('#texto').html('Transferencia: '+data.USD.transferencia+ '<br> Sicad: ' + data.USD.sicad2);
 // $('#al').html('DolarToday al: '+data._timestamp.fecha);
    });   

}


$("#listaC").keyup(function(){
	cargarlista($("#listaC").val(),$("#comboCedula").val());

	if ($("#listaC").val()=" ") {
		$("#cedula").val(cedula1);  ;
		$("#apellido").val("");
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


});
$("#comboCedula").change(function(){
	cargarlista($("#listaC").val(),$("#comboCedula").val());
});

let arregloDetalle=[];
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
	arregloDetalle.forEach((deta)=>{
		let fila = document.createElement("tr");
		fila.innerHTML=`
						<td>${deta.descripcion}</td>
						<td>${deta.precio}</td>
						<td>${+deta.precio * +tasa.value}</td>
						<td>${deta.cantidad}</td>
						<td>${(+deta.precio * +tasa.value) * +deta.cantidad}</td>
						<td>${+deta.precio * +deta.cantidad}</td>`;
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
function cargarlista(cedula1,letra){
	var cedula=letra+cedula1;
	if (cedula=='V-' || cedula=='J-' || cedula=='C-' || cedula=='G-') {
		$("#cedula").val(cedula1);  // $("#cedula") esto es el id del campo del formulario	
		$("#nombre").val(" ");   //data.nombre el nombre que se coloca en el lado derecho es
		$("#apellido").val(""); //el que se coloco en el ajax en $output["nombre"]
		$("#direccion").val("");
		$("#telefono").val("");
		$("#correo").val("");
		
	}
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
		$("#cedula").val(cedula);  // $("#cedula") esto es el id del campo del formulario
		$("#nombres").val(data.nombre);   //data.nombre el nombre que se coloca en el lado derecho es
		$("#apellidos").val(data.apellido); //el que se coloco en el ajax en $output["nombre"]
		$("#telefono").val(data.telefono);
		$("#Departamento").val(data.nom);
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
}
function eliminar_item(iddetallesFT){
	$.ajax({
		url:"../ajax/fallas.php?op=eliminar_item",
		method:"POST",
		data:{iddetallesFT:iddetallesFT},

		success:function(data){
			$("#fallas").DataTable().ajax.reload();
			$("#sub").DataTable().ajax.reload();
		}
	});
}
function registrar(e){
	e.preventDefault();
	var formData = new FormData($("#form_compra")[0]);
	$.ajax({
		url: "../ajax/fallas.php?op=guardarVenta",
		type: "POST",
		data: formData,
		contentType: false,
		processData: false,
		success: function(datos){
			console.log("datps",datos); //muestre los valores en la consola
			$('#form_compra')[0].reset();
			//$('#servicioModal').modal('hide');
			$("#fallas").DataTable().ajax.reload();
			$("#sub").DataTable().ajax.reload();
			idfactura();
			tasa_dia();
			agregar_detalles(datos);
		}
	});
}
init();
