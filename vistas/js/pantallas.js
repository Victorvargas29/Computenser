$(document).ready(function(){

	$.ajax({
		url:'../vistas/home2.php',
		method: "POST",
		success: function(res){ $("#seccion1").html(res); },
		error: function(err){ $("#seccion1").html(err);}
	});

	$("#home").click(function(){
		$.ajax({
		url:'../vistas/home2.php',
		method: "POST",
		success: function(res){ $("#seccion1").html(res); },
		error: function(err){ $("#seccion1").html("pagina vista/cursos.php no found");}
		});
	});

	$("#usuarios_p").click(function(){
		$.ajax({
		url:'../vistas/usuario.php',
		method: "POST",
		success: function(res){ $("#seccion1").html(res); },
		error: function(err){ $("#seccion1").html(err);}
		});
	});

	$("#depa").click(function(){
		$.ajax({
		url:'../vistas/tablas/departamento.php',
		method: "POST",
		success: function(res){ $("#seccion1").html(res); },
		error: function(err){ $("#seccion1").html(err);}
		});
	});

	$("#vehiculo").click(function(){
		$.ajax({
		url:'../vistas/vehiculo.php',
		method: "POST",
		success: function(res){ $("#seccion1").html(res); },
		error: function(err){ $("#seccion1").html("pagina vista/cursos.php no found");}
		});
	});

	$("#empleadas_p").click(function(){
		$.ajax({
		url:'../vistas/empleada.php',
		method: "POST",
		success: function(res){ $("#seccion1").html(res); },
		error: function(err){ $("#seccion1").html("pagina vista/cursos.php no found");}
		});
	});

	$("#categoria-form").click(function(){
		$.ajax({
		url:'../vistas/categoria.php',
		method: "POST",
		success: function(res){ $("#seccion1").html(res); },
		error: function(err){ $("#seccion1").html("pagina vista/cursos.php no found");}
		});
	});
	$("#presentacionP").click(function(){
		$.ajax({
		url:'../vistas/presentacionP.php',
		method: "POST",
		success: function(res){ $("#seccion1").html(res); },
		error: function(err){ $("#seccion1").html("pagina vista/cursos.php no found");}
		});
	});

	$("#producto").click(function(){
		$.ajax({
		url:'../vistas/producto.php',
		method: "POST",
		success: function(res){ $("#seccion1").html(res); },
		error: function(err){ $("#seccion1").html("pagina vista/cursos.php no found");}
		});
	});

	$("#servi").click(function(){
		$.ajax({
		url:'../vistas/servicio.php',
		method: "POST",
		success: function(res){ $("#seccion1").html(res); },
		error: function(err){ $("#seccion1").html("pagina vista/cursos.php no found");}
		});
	});
	$("#servi_prestado").click(function(){
		$.ajax({
		url:'../vistas/crear-venta.html.php',
		method: "POST",
		success: function(res){ $("#seccion1").html(res); },
		error: function(err){ $("#seccion1").html("pagina vista/servicioprestado.php no found");}
		});
	});

	$("#compra").click(function(){
		$.ajax({
		url:'../vistas/ordenes.php',
		method: "POST",
		success: function(res){ $("#seccion1").html(res); },
		error: function(err){ $("#seccion1").html("pagina vista/ordenes.php no found");}
		});
	});
	
	$("#servi_prestado2").click(function(){
		$.ajax({
		url:'../vistas/ventas2.php',
		method: "POST",
		success: function(res){ $("#seccion1").html(res); },
		error: function(err){ $("#seccion1").html("pagina vista/servicioprestado.php no found");}
		});
	});

	$("#presupuesto_p").click(function(){
		$.ajax({
		url:'../vistas/presupuestos.php',
		method: "POST",
		success: function(res){ $("#seccion1").html(res); },
		error: function(err){ $("#seccion1").html("pagina vista/servicioprestado.php no found");}
		});
	});
	$("#marca").click(function(){
		$.ajax({
		url:'../vistas/marca.php',
		method: "POST",
		success: function(res){ $("#seccion1").html(res); },
		error: function(err){ $("#seccion1").html("pagina vista/servicioprestado.php no found");}
		});
	});
	$("#color").click(function(){
		$.ajax({
		url:'../vistas/color.php',
		method: "POST",
		success: function(res){ $("#seccion1").html(res); },
		error: function(err){ $("#seccion1").html("pagina vista/servicioprestado.php no found");}
		});
	});
	$("#modelo").click(function(){
		$.ajax({
		url:'../vistas/modelo.php',
		method: "POST",
		success: function(res){ $("#seccion1").html(res); },
		error: function(err){ $("#seccion1").html("pagina vista/servicioprestado.php no found");}
		});
	});

		$("#clientess").click(function(){
		$.ajax({
		url:'../vistas/cliente.php',
		method: "POST",
		success: function(res){ $("#seccion1").html(res); },
		error: function(err){ $("#seccion1").html("pagina vista/cursos.php no found");}
		});
	});
	$("#proveedor").click(function(){
		$.ajax({
		url:'../vistas/proveedor.php',
		method: "POST",
		success: function(res){ $("#seccion1").html(res); },
		error: function(err){ $("#seccion1").html("pagina vista/cursos.php no found");}
		});
	});

	$("#icon-font").click(function(){
		$.ajax({
		url:'../vistas/icon-fontawesome.php',
		method: "POST",
		success: function(res){ $("#seccion1").html(res); },
		error: function(err){ $("#seccion1").html("pagina vista/cursos.php no found");}
		});
	});

	$("#icon-material").click(function(){
		$.ajax({
		url:'../vistas/icon-material.php',
		method: "POST",
		success: function(res){ $("#seccion1").html(res); },
		error: function(err){ $("#seccion1").html("pagina vista/cursos.php no found");}
		});
	});

	$("#logo-home").click(function(){
		$.ajax({
		url:'../vistas/home.php',
		method: "POST",
		success: function(res){ $("#seccion1").html(res); },
		error: function(err){ $("#seccion1").html("pagina vista/cursos.php no found");}
		});
	});
	$("#Iinventario").click(function(){
		$.ajax({
		url:'../vistas/inventario.php',
		method: "POST",
		success: function(res){ $("#seccion1").html(res); },
		error: function(err){ $("#seccion1").html("pagina vista/cursos.php no found");}
		});
	});
	$("#reportes_p").click(function(){
		$.ajax({
		url:'../vistas/lista_facturas.php',
		method: "POST",
		success: function(res){ $("#seccion1").html(res); },
		error: function(err){ $("#seccion1").html("pagina vista/cursos.php no found");}
		});
	});
	$("#reportes_servicio").click(function(){
		$.ajax({
		url:'../vistas/lista_servicio_prestado.php',
		method: "POST",
		success: function(res){ $("#seccion1").html(res); },
		error: function(err){ $("#seccion1").html("pagina vista/cursos.php no found");}
		});
	});
	$("#fallas").click(function(){
		$.ajax({
		url:'../vistas/fallas.php',
		method: "POST",
		success: function(res){ $("#seccion1").html(res); },
		error: function(err){ $("#seccion1").html("pagina vista/cursos.php no found");}
		});
	});
	$("#reportes_ordenes").click(function(){
		$.ajax({
		url:'../vistas/lista_ordenes.php',
		method: "POST",
		success: function(res){ $("#seccion1").html(res); },
		error: function(err){ $("#seccion1").html("pagina vista/cursos.php no found");}
		});
	});
	$("#bitacora").click(function(){
		$.ajax({
		url:'../vistas/lista_bitacora.php',
		method: "POST",
		success: function(res){ $("#seccion1").html(res); },
		error: function(err){ $("#seccion1").html("pagina vista/cursos.php no found");}
		});
	});

});
