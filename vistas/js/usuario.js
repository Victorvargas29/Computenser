
var tabla;
//funcion q se ejecuta al inicio
function init(){

	listar();


	//cuando se da click al boton submit entonces se ejecuta la funcion guardaryeditar(e);
	$("#usuario_form").on("submit", function(e){
		guardaryeditar(e);

	});


	//cambia el titulo de la ventana modal cuando se da click al boton
	$("#add_button").click(function(){
		$(".modal-title").text("Agregar Usuario");	
	});

/*	$('#usuario_data').DataTable({
		responsive: true
	});*/

}//fin init

//funcion q limpia los campos del formulario
function limpiar(){


	$("#nombre").val("");
	$("#apellido").val("");
	$("#tipo_usuario").val("");

	$("#password1").val("");
	$("#password2").val("");

	$('#email').val("");

	$("#estado").val("");
	$("#idUsuario").val("");
}

//funcion listar
function listar(){

	tabla=$('#usuario_data').dataTable({
		"aProcessing":true,//Activamos el procesamiento del datatables
		"aServerSide":true,//Paginacion y filtrado realizados por el servidor
		responsive:"true",
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
       
       // text: '<button class="btn btn-danger"> PDF <i class="far fa-file-pdf"></i></button>'
      }
				],
		"ajax":
		{
			url:'../ajax/usuario.php?op=listar',
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
			"sInfo": "_TOTAL_ registros",
			"sInfoEmpty": "0 registros",
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

function mostrar(idUsuario){

	$.post("../ajax/usuario.php?op=mostrar",{idUsuario : idUsuario}, function(data, status)
	{
		data = JSON.parse(data);

		$("#usuarioModal").modal("show");
	
		$("#nombre").val(data.nombre);
		$("#apellido").val(data.apellido);
		$("#tipo_usuario").val(data.tipo_usuario);
	
		$("#password1").val(data.password1);
		$("#password2").val(data.password1);

		$("#email").val(data.email);
		$("#producto_uploaded_image").html(data.avatar);
		$("#estado").val(data.estado);
		$('.modal-title').text("Editar Usuario");
		$("#idUsuario").val(idUsuario);
		$("#action").val("Edit");

	});
}//fin funcion mostrar

//la funcion guardaryeditar(e); se llama cuando se da click al boton submit
function guardaryeditar(e){


	e.preventDefault(); //No se activará la acción predeterminada del evento
	var formData = new FormData($("#usuario_form")[0]);

	var password1 = $("#password1").val();
	var password2 = $("#password2").val();



	//si el password coincide entonces se envia el formulario
	if(password1 == password2){

		$.ajax({
			url: "../ajax/usuario.php?op=guardaryeditar",
			type: "POST",
			data: formData,
			cache:false,
			contentType: false,
			processData: false,

			success: function(datos){

				console.log(datos); //muestre los valores en la consola

				$('#usuario_form')[0].reset();
				$('#usuarioModal').modal('hide');
				
				//$('#resultados_ajax').html(datos);
				$('#usuario_data').DataTable().ajax.reload();
				limpiar();
				
				toastr.options = {"positionClass":"toast-top-right",
				"preventDuplicates":true
				};
				toastr["success"]("Usuario se registro correctamente","¡Exito!");
			}
		});

	}//cierre de la validacion
	else{
		//swal("Error!", "No coincide el password!", "success");
		toastr.options = {"positionClass":"toast-top-center",
		"preventDuplicates":true
		};
		toastr["error"]("No coincide el password","¡Error!");

		//bootbox.alert("No coincide el password");
	}
}//fin guardar y editar

	//Editar estado de usuario
	//importante:id_usuario, est se envia por post via ajax
	function cambiarEstado(idUsuario, est){

		swal.fire({
	    	title: "¿Esta seguro de cambiar el estado? ",
	    	type: "warning",
	    	showCancelButton: true,
	    	confirmButtonText: "Cambiar",
	    	confirmButtonColor: "#3085d6",
	    	cancelButtonColor: "#ca5939"
        })
        .then(result => {
         	if (result.value) {
           		$.ajax({
					url:"../ajax/usuario.php?op=activarydesactivar",
					method:"POST",
					data:{idUsuario:idUsuario, est:est},

					success:function(data){
				//		$("#resultados_ajax").html(data);
						$("#usuario_data").DataTable().ajax.reload();
					}
				});
				if(est==0){
              		est="Activo"
              	}else{
              		est="Inactivo"
              	}
            swal.fire(
              "Se cambio el estado a: "+est,

              "¡Aviso!",
              "success"
            );
          }
        });

	//	toastr["warning"]("mensaje","titulo del mensaje");
	}//fin cambiar estado

	function eliminar_usuario (idUsuario){

		swal.fire({
          title: "Está seguro de borrar el registro: ",
          type: "warning",
          showCancelButton: true,
          confirmButtonText: "Borrar",
          confirmButtonColor: "#d33",
          cancelButtonColor: "#3085d6"
        })
        .then(result => {
          if (result.value) {
           				$.ajax({
					url:"../ajax/usuario.php?op=eliminar_usuario",
					method:"POST",
					data:{idUsuario:idUsuario},

					success:function(data){
						$("#resultados_ajax").html(data);
						$("#usuario_data").DataTable().ajax.reload();
					}
				});
            swal.fire(
              "¡Eliminado!",
              "El registro ha sido eliminado",
              "success"
            );
          }
        });
	}//fin eliminar	

init();
