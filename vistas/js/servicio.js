
var tabla;
var tablaS;
var tablaSo;
//funcion q se ejecuta al inicio
function init(){

	listar();
	listarServi();
	grafica();
	grafica2();
	grafica3();
	//cuando se da click al boton submit entonces se ejecuta la funcion guardaryeditar(e);
	$("#servicio_form").on("submit", function(e){
		guardaryeditar(e);
	});

	//cambia el titulo de la ventana modal cuando se da click al boton
	$("#btnNuevo").click(function(){
		limpiar();
		$(".modal-title").text("Agregar Servicio");
		$("#idCategoria").val('0');
	
		//document.getElementById("cedula").disabled = false;
	});

	$(document).ready(function(){
        $("#idOpcion").change(function(){
            $("#idOpcion option:selected").each(function(){
                idOpcion= $(this).val();
				text=$(this).text();
				grafica();
				
			});
        });
    });

   
   

}
function getMesData(table) {
    var MesData = {};
    var servi = {};
 
    // Get the row indexes for the rows displayed under the current search
    var indexes = table.rows({ search: 'applied' }).indexes().toArray();
 
    // For each row, extract the office and add the salary to the array
    for (var i = 0; i < indexes.length; i++) {
        var mes = table.cell(indexes[i], 2).data();
            

			if (servi[mes] === undefined) {
				servi[mes] = [
					+table
						.cell(indexes[i], 0)
						.data()
						
				];
			} else {
				servi[mes].push(
					+table
						.cell(indexes[i], 0)
						.data()
						
				);
			}
       
    
	}
    // Extract the office names that are present in the table
    var keys = Object.keys(servi);
	console.log(keys);
    // For each office work out the average salary
    for (var i = 0; i < keys.length; i++) {
        var length = servi[keys[i]].length;
        var total = servi[keys[i]].reduce((a, b) => a + b, 0);
        MesData[keys[i]] =length;
    }
 
    return MesData;
}



function grafica() {

	$(document).ready(function(){

		var MesData = getMesData(tablaS);
 
    // Declare axis for the column graph
    var axis = {
        id: 'Mes',
        min: 0,
        title: {
            text: 'Servicios',
        },
    };
 
    // Declare inital series with the values from the getSalaries function
    var series = {
        name: 'Meses',
        data: Object.values(MesData),
    };
 
    var myChart = Highcharts.chart('content_grafic', {
        chart: {
            type: 'column',
        },
        title: {
            text: 'Servicios facturados por mes',
        },
        xAxis: {
            categories: Object.keys(MesData),
        },
        yAxis: axis,
        series: [series],
    });
 
    // On draw, get updated salaries and refresh axis and series
    tablaS.on('draw', function () {
        MesData = getMesData(tablaS);
        myChart.axes[0].categories = Object.keys(MesData);
        myChart.series[0].setData(Object.values(MesData));
    });
});
}
function grafica3() {

	$(document).ready(function(){

		var MesData = getMesData(tablaSo);
 
    // Declare axis for the column graph
    var axis = {
        id: 'Mes',
        min: 0,
        title: {
            text: 'Servicios',
        },
    };
 
    // Declare inital series with the values from the getSalaries function
    var series = {
        name: 'Meses',
        data: Object.values(MesData),
    };
 
    var myChart = Highcharts.chart('content_grafic3', {
        chart: {
            type: 'column',
        },
        title: {
            text: 'Servicios en ordenes por mes',
        },
        xAxis: {
            categories: Object.keys(MesData),
        },
        yAxis: axis,
        series: [series],
    });
 
    // On draw, get updated salaries and refresh axis and series
    tablaSo.on('draw', function () {
        MesData = getMesData(tablaSo);
        myChart.axes[0].categories = Object.keys(MesData);
        myChart.series[0].setData(Object.values(MesData));
    });
});
}


function getEmpleadoData(table) {
    var empleadoData = {};
    var servi = {};
 
    // Get the row indexes for the rows displayed under the current search
    var indexes = table.rows({ search: 'applied' }).indexes().toArray();
 
    // For each row, extract the office and add the salary to the array
    for (var i = 0; i < indexes.length; i++) {
        var emple = table.cell(indexes[i], 3).data();
            

			if (servi[emple] === undefined) {
				servi[emple] = [
					+table
						.cell(indexes[i], 0)
						.data()
						
				];
			} else {
				servi[emple].push(
					+table
						.cell(indexes[i], 0)
						.data()
						
				);
			}
       
    
	}
    // Extract the office names that are present in the table
    var keys = Object.keys(servi);
	console.log(keys);
    // For each office work out the average salary
    for (var i = 0; i < keys.length; i++) {
        var length = servi[keys[i]].length;
        var total = servi[keys[i]].reduce((a, b) => a + b, 0);
        empleadoData[keys[i]] =length;
    }
 
    return empleadoData;
}



function grafica2() {

	$(document).ready(function(){

		var EmpleadoData = getEmpleadoData(tablaS);
 
    // Declare axis for the column graph
    var axis = {
        id: 'Mes',
        min: 0,
        title: {
            text: 'Servicios',
        },
    };
 
    // Declare inital series with the values from the getSalaries function
    var series = {
        name: 'Empleados',
        data: Object.values(EmpleadoData),
    };
 
    var myChart = Highcharts.chart('content_grafic2', {
        chart: {
            type: 'column',
        },
        title: {
            text: 'Servicios realizdos por empleados',
        },
        xAxis: {
            categories: Object.keys(EmpleadoData),
        },
        yAxis: axis,
        series: [series],
    });
 
    // On draw, get updated salaries and refresh axis and series
    tablaS.on('draw', function () {
        EmpleadoData = getEmpleadoData(tablaS);
        myChart.axes[0].categories = Object.keys(EmpleadoData);
        myChart.series[0].setData(Object.values(EmpleadoData));
    });
});
}




//funcion q limpia los campos del formulario
function limpiar(){

	$("#idServicio").val("");
	$("#nombre").val("");
	$("#precio").val("");
	$("#idCategoria").val('0');	
	
	$('#idCategoria').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');
}

//funcion listar
function listar(){

	tabla=$('#servicio_data').dataTable({  //#usuario_data este es el id de la tabla
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
			url:'../ajax/servicio.php?op=listar',
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
		"order":[[0,"desc"]],//servi(Columna, servi)

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

function mostrar(idServicio){

	$.post("../ajax/servicio.php?op=mostrar",{idServicio : idServicio}, function(data, status)
	{
		
		
		data =JSON.parse(data);

		$("#servicioModal").modal("show");
	//	document.getElementById("cedula").disabled = true;
		//$("#cedula").

		$("#nombre").val(data.nombre);  // $("#cedula") esto es el id del campo del formulario
		   //data.nombre el nombre que se coloca en el lado derecho es
		 //el que se coloco en el ajax en $output["nombre"]
		 $("#precio").val(data.precio);
		 
		 $('.modal-title').text("Editar Servicio");
		 $("#idServicio").val(idServicio);
	

		
		$("#action").val("Edit");

	});
}//fin funcion mostrar

//la funcion guardaryeditar(e); se llama cuando se da click al boton submit
function guardaryeditar(e){

	e.preventDefault(); //No se activará la acción predeterminada del evento
	var formData = new FormData($("#servicio_form")[0]);

		$.ajax({
			url: "../ajax/servicio.php?op=guardaryeditar",
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,

			success: function(datos){

				//console.log(datos); //muestre los valores en la consola

				$('#servicio_form')[0].reset();
				$('#servicioModal').modal('hide');
				
				//$('#resultados_ajax').html(datos);
				$('#servicio_data').DataTable().ajax.reload();
				limpiar();
			}
		});

}//fin guardar y editar


function eliminar_servicio(idServicio){
		bootbox.confirm("¿Esta seguro de eliminar?", function(result){
			if(result){
				$.ajax({
					url:"../ajax/servicio.php?op=eliminar_servicio",
					method:"POST",
					data:{idServicio:idServicio},

					success:function(data){
					//	$("#resultados_ajax").html(data);
						$("#servicio_data").DataTable().ajax.reload();
					}
				});
			}//condicion
		}); //bootbox

	}//fin eliminar	

	function listarServi(){

		tablaS=$('#servi_data').dataTable({  
			
			
			dom:'Bfrtilp',//Definimos los elementos del control de tabla
			columns: [
				{
					target: 0,
					visible: true,
					searchable: true,
					width: "40px"
				},
				{
					target: 1,
					visible: true,
					width: "40px"
				},
				{
					target: 1,
					visible: true,
					width: "40px"
				},
				{
					target: 1,
					visible: true,
					width: "40px"
				},
	
			],
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
				
				url:'../ajax/servicio.php?op=listarservicios',
				type: "get",
				datatype: "json",
				error: function(e){
					console.log(e.responseText);
				}
			},
			
	
		}).DataTable();
	}//finser


	function listarServi(){

		tablaSo=$('#serviO_data').dataTable({  
			
			
			dom:'Bfrtilp',//Definimos los elementos del control de tabla
			columns: [
				{
					target: 0,
					visible: true,
					searchable: true,
					width: "40px"
				},
				{
					target: 1,
					visible: true,
					width: "40px"
				},
				{
					target: 1,
					visible: true,
					width: "40px"
				},
				{
					target: 1,
					visible: true,
					width: "40px"
				},
	
			],
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
				
				url:'../ajax/servicio.php?op=listarserviciosO',
				type: "get",
				datatype: "json",
				error: function(e){
					console.log(e.responseText);
				}
			},
			
	
		}).DataTable();
	}//finser


init();
