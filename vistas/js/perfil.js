
var tabla;
//funcion q se ejecuta al inicio
function init(){

	$("#perfil_form").on("submit", function(e){
		editar_perfil(e);

	});

	//cambia el titulo de la ventana modal cuando se da click al boton
	/*$("#add_button").click(function(){
		$(".modal-title").text("Agregar Usuario");	
	});*/


	$("#myprofile").click(function(){
		$(".modal-title").text("Perfil de Usuario");	
	});
}//fin init

function limpiar_perfil(){

	
	$("#nombre_perfil").val("");
	$("#apellido_perfil").val("");
	$("#tipo_usuario_perfil").val("");
	$('#email_perfil').val("");
	$("#estado_perfil").val("");
	$("#idUsuario_perfil").val("");
}

function habilitar_campos(){
	$("#nombre_perfil").prop('disabled', false);
	$("#apellido_perfil").prop('disabled', false);
	//$("#tipo_usuario_perfil").prop('disabled', false);
	//$("#email_perfil").prop('disabled', false);
	//$("#estado_perfil").prop('disabled', false);

	$("#perfilGuardar").show();
	$("#perfil_editar").prop('disabled',true);
}

function mostrar_perfil(idUsuario_perfil){
	
	$("#perfilGuardar").hide();
	$("#perfil_editar").prop('disabled',false);
	$.post("../ajax/perfil.php?opcion=mostrar_perfil",{idUsuario_perfil : idUsuario_perfil}, function(data, status)
	{
		data = JSON.parse(data);

		$("#perfilModal").modal("show");
	
		$("#nombre_perfil").val(data.nombre);
		$("#apellido_perfil").val(data.apellido);
		$("#tipo_usuario_perfil").val(data.tipo_usuario);

		$("#email_perfil").val(data.email);
		$("#producto_uploaded_perfil").html(data.avatar);
		$("#estado_perfil").val(data.estado);
		$("#idUsuario_perfil").val(data.idUsuario);

		$("#nombre_perfil").prop('disabled', true);
		$("#apellido_perfil").prop('disabled', true);
		$("#tipo_usuario_perfil").prop('disabled', true);
		$("#email_perfil").prop('disabled', true);
		$("#estado_perfil").prop('disabled', true);
	});
}//fin funcion mostrar

//la funcion guardaryeditar(e); se llama cuando se da click al boton submit
function editar_perfil(e){


	e.preventDefault(); //No se activará la acción predeterminada del evento
	var formData = new FormData($("#perfil_form")[0]);

		$.ajax({
			url: "../ajax/perfil.php?opcion=editar",
			type: "POST",
			data: formData,
		//	cache:false,
			contentType: false,
			processData: false,

			success: function(datos){

				console.log(datos); //muestre los valores en la consola

				//$('#perfil_form')[0].reset();
				$('#perfilModal').modal('hide');

			//	limpiar_perfil();
				
			/*	toastr.options = {"positionClass":"toast-top-right",
				"preventDuplicates":true
				};
				toastr["success"]("Usuario se registro correctamente","¡Exito!");*/
			}
		});

}//fin guardar y editar


init();
