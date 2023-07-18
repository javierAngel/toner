$(document).ready(function() {
	$('.btn-filter').on('click', function () {
      var $target = $(this).data('target');
      if ($target != 'all') {
        $('.table tr').css('display', 'none');
        $('.table tr[data-status="' + $target + '"]').fadeIn('slow');
      } else {
        $('.table tr').css('display', 'none').fadeIn('slow');
      }
    });
});

function logout(){
	$.ajax({
		url: '../controller/logout.php',
		type: 'POST',
		data: {
			accion: '1'
		},
	})
	.done(function() {
		recargar();
	})
	.fail(function() {
		Swal.fire(
			      'Error!',
			      'Intente de nuevo',
			      'error'
			    );
	});
}

function ValidaSoloNumeros() {

  if ((event.keyCode < 48) || (event.keyCode > 57)){ 

    event.returnValue = false;

  }
}

function txNombres() {

 if ((event.keyCode != 32) && (event.keyCode < 65) || (event.keyCode > 90) && (event.keyCode < 97) || (event.keyCode > 122))

  event.returnValue = false;
}

function ajax_global(documento,espacio){

	$('#'+espacio).html('<div class="progress progress-xs active"><div class="progress-bar progress-bar-primary progress-bar-striped" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 10%" id="progress-num"><span class="sr-only">10% Complete</span></div></div>');

  setTimeout(function(){

    $('#progress-num').css({'width':'100%'});

  },100);

  $.ajax({

    url: documento,

    type: 'GET',

  })

  .done(function(data) {
    $('#'+espacio).html(data);

  })

  .fail(function() {

    Swal.fire(
			      'Error!',
			      'Intente de nuevo',
			      'error'
			    );

  });
}

function recargar(){

	location.reload();
}

function limpiarModal(name){

	if (name=='user') {
		$('#nombreInputUser').val("");
		$('#apellidoPaternoInputUser').val("");
		$('#apellidoMaternoInputUser').val("");
		$('#edadInputUser').val("");
		$('#curpInputUser').val("");
		$('#telCelInputUser').val("");
		$('#correoUser').val("");
		$('#passUserConfi').val("");
		$('#passUser').val("");
		$('input:radio[name=inlineRadioOptioUser]:checked').prop('checked', false).change();
		$('#cliente').empty();
		$('#cliente').append("<option value='0'>Seleccionar</option>");
	}else if(name=='permiso'){
		$('#clave').val('');
		$('#descripcion').val('');
		$('#btnPermiso').text('Agregar Permiso');
		$('#btnPermiso').attr('onClick', 'addPermiso()');
	}else if(name=='almacen'){
		$('#nombre').val("");
		$('#localizacion').val("");
		$('#btnAlmacen').text('Agregar Almacen');
		$('#btnPermiso').attr('onClick', 'addAlmacen()');
		$('#btnAlmacen').removeAttr('disabled');
		listImpresoras(0);
	}else if(name=='toner'){
		$('#nombre').val("");
		$('#modelo').val("");
		$('#descripcion').val("");
		$('#btnToner').text("Agregar Toner");
		$('#btnPermiso').attr('onClick', 'addToner()');
		$('#btnToner').removeAttr('disabled');
	}else if(name=='impresora'){
		$('#nombre').val("");
		$('#modelo').val("");
		$('#btnImpresora').text('Agregar Impresora');
		$('#btnImpresora').attr('onClick', 'addImpresora()');
		$('#btnImpresora').removeAttr('disabled');
		$('input:radio[name=inlineRadioOptionImp]:checked').prop('checked', false).change();
		$("#multicolor").val("");
		$('#iconAgregar').attr("hidden","true");
		$("#contenToners").empty();
		listToners(0);
	}else if(name=='reporte'){
		$('#fechaInicio').val('');
		$('#fechaFin').val('');
		$('#almacenes').val('');
		$('#toners').val('');
		listSurtAlm();
		listSurtTon();
	}else if(name=="factura"){
		$("#factura").val("");
		$("#cantidad").val("");
		$("#fechaFac").val("");
		$('#subtotalFactura').val("");
		$('#ivaFactura').val("");
		$('#totalFactura').val("");
		$("#conten").empty();
		$("#toner option[value='0']").attr("selected",true);
	}else if(name=="salida"){
		$("#descripcionSalida").val("");
		$("#cantidadSalida").val("");
	}
}

function addUser(tipoUser){
	$('#buttonAddUser').text('Procesando...');
	$('#buttonAddUser').attr('disabled','disabled');
	if ($('#nombreInputUser').val()=="") {
		Swal.fire({

		  icon: 'error',

		  title: 'Falta un dato',

		  text: 'El Nombre es necesario!'

		});

		$('#buttonAddUser').text('Guardar Usuario');
		$('#buttonAddUser').removeAttr('disabled');
	}else if ($('#apellidoPaternoInputUser').val()==""||$('#apellidoMaternoInputUser').val()=="") {
		Swal.fire({

		  icon: 'error',

		  title: 'Falta un dato',

		  text: 'Los Apellidos son necesarios!'

		});

		$('#buttonAddUser').text('Guardar Usuario');
		$('#buttonAddUser').removeAttr('disabled');
	} else if ($('#correoUser').val()=="") {
		Swal.fire({

		  icon: 'error',

		  title: 'Falta un dato',

		  text: 'El Correo es necesario!'

		});

		$('#buttonAddUser').text('Guardar Usuario');
		$('#buttonAddUser').removeAttr('disabled');
	} else if ($('#passUser').val()=="") {

		Swal.fire({

		  icon: 'error',

		  title: 'Falta un dato',

		  text: 'Escriba Su Contraseña'

		});
		$('#buttonAddUser').text('Guardar Usuario');
		$('#buttonAddUser').removeAttr('disabled');
	}else if ($('#passUserConfi').val()==""||$('#passUser').val()!=$('#passUserConfi').val()) {

		Swal.fire({

		  icon: 'error',

		  title: 'Falta un dato',

		  text: 'Las Contraseñas no coinciden'

		});
		$('#buttonAddUser').text('Guardar Usuario');
		$('#buttonAddUser').removeAttr('disabled');
	}else if (!($('input:radio[name=inlineRadioOptioUser]:checked').val()!=null)) {
		Swal.fire({

		  icon: 'error',

		  title: 'Falta un dato',

		  text: 'El Genero es necesario!'

		});

		$('#buttonAddUser').text('Guardar Usuario');
		$('#buttonAddUser').removeAttr('disabled');
	} else {
		$.ajax({
			url: '../controller/usuarios.php',
			type: 'POST',
			dataType: 'JSON',
			data: {
				accion: 'save',
				nombre:$('#nombreInputUser').val(),
				apellidoMat:$('#apellidoMaternoInputUser').val(),
				apellidoPat:$('#apellidoPaternoInputUser').val(),
				correo:$('#correoUser').val(),
				genero:$('input:radio[name=inlineRadioOptioUser]:checked').val(),
				pass:$('#passUser').val()
			},
		})
		.done(function(data) {
			console.log(data);
			if (data.status) {
				Swal.fire({

    					title: 'Usuario Guardado!',

    					text: 'El usuario se Creo',

    					icon: 'success'

    				}).then((result) => {

    					  if (result.value) {

    					  	$('.modal-backdrop').hide();
							$('#body').removeClass('modal-open');
    					    ajax_global('../view/usuarios.php','contenido');

    					  }

    					});
			} else {
				Swal.fire({

    				title: 'Error!',

    				text: 'Ocurrio un error, intente de nuevo',

    				icon: 'error'

    			});
    			$('#buttonAddUser').text('Guardar Usuario');
				$('#buttonAddUser').removeAttr('disabled');
			}
		})
		.fail(function(error) {
			console.log(error);
			Swal.fire(
			      'Error!',
			      'Intente de nuevo',
			      'error'
			    );
			$('#buttonAddUser').text('Guardar Usuario');
			$('#buttonAddUser').removeAttr('disabled');
		});
	}
}

function cambiarEstadoUser(ID,estado){
	Swal.fire({
	  title: 'Cambiar de estado?',
	  text: "El usuario cambiara de estado!",
	  icon: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'YES!'
	}).then((result) => {
	  if (result.value) {
	  	$.ajax({
	  		url: '../controller/usuarios.php',
	  		type: 'POST',
	  		dataType: 'JSON',
	  		data: {
	  			accion: 'estado',
	  			cambio: estado,
	  			id_usuario: ID
	  		},
	  	})
	  	.done(function(data) {
	  		//console.log(data.status);
	  		if (data.status) {
	  			Swal.fire(
			      'El estado Cambio',
			      'El Estado del usuario cambio exitosamente!',
			      'success'
			    ).then((result) => {
			    	 if (result.value) {
			    	 	$('.modal-backdrop').hide();
						$('#body').removeClass('modal-open');
			    	 	ajax_global('../view/usuarios.php','contenido');
			    	 }
			    });
	  		} else {
	  			Swal.fire(
			      'Error!',
			      'Intente de Nuevo!',
			      'error'
			    );
	  		}
	  	})
	  	.fail(function() {
	  		Swal.fire(
			      'Error!',
			      'Intente de nuevo',
			      'error'
			    );
	  	});
	  }
	});
}

function modificarPass(id){
	$('#btnCambioPass').attr('onClick', 'cambiarContra('+id+');');
	$('#cambioPass').modal('show');
}

function cambiarContra(id){
	$('#btnCambioPass').text('Procesando...');
	$('#btnCambioPass').attr('disabled','disabled');
	if ($('#passUserCambio').val()=="") {
		Swal.fire({

		  icon: 'error',

		  title: 'Falta un dato',

		  text: 'Escriba una contraseña!'

		});

		$('#btnCambioPass').text('Cambiar Contraseña');
		$('#btnCambioPass').removeAttr('disabled');

	}else if ($('#passUserCambio').val()!=$('#passUserConfiCambio').val()) {
		Swal.fire({

		  icon: 'error',

		  title: 'Contraseñas diferentes',

		  text: 'La contraseña no coincide!'

		});

		$('#btnCambioPass').text('Cambiar Contraseña');
		$('#btnCambioPass').removeAttr('disabled');
	} else {
		$.ajax({
			url: '../controller/usuarios.php',
			type: 'POST',
			dataType: 'JSON',
			data: {
				accion: 'pass',
				id_usuario: id,
				pass: $('#passUserCambio').val(),
			},
		})
		.done(function(data) {
			console.log(data.status);
			if (data.status) {
				Swal.fire({

				  icon: 'success',

				  title: 'Contraseña Cambiada',

				  text: 'La contraseña se cambio correctamente!'

				}).then((result) =>{
					if (result.value) {
						$('.modal-backdrop').hide();
						$('#body').removeClass('modal-open');
						ajax_global('../view/usuarios.php','contenido');
					}
				});
			} else {
				Swal.fire({

				  icon: 'error',

				  title: 'Intente de Nuevo',

				  text: 'Ocurrio un error, intente nuevamente!'

				});
				$('#btnCambioPass').text('Cambiar Contraseña');
				$('#btnCambioPass').removeAttr('disabled');
			}
		})
		.fail(function() {
			Swal.fire(
			      'Error!',
			      'Intente de nuevo',
			      'error'
			    );		});
		
	}
}

function modificarUser(id){
	$.ajax({
		url: '../controller/usuarios.php',
		type: 'POST',
		dataType: 'JSON',
		data: {
			accion: 'consultUser',
			id_usuario: id,
		},
	})
	.done(function(data) {
		//console.log(data.nombre);
		$('#nombreInputUserEdit').val(data.nombre);
		$('#apellidoPaternoInputUserEdit').val(data.apellidoPat);
		$('#apellidoMaternoInputUserEdit').val(data.apellidoMat);
		$('#correoUserEdit').val(data.correo);
		if ($('#inlineRaUserEdit').val()==data.genero) {

			$('#inlineRaUserEdit').prop("checked", true);

		} else {

			$('#inlineRUserEdit').prop("checked", true);

		}
		
		$('#btnEditUser').attr('onclick', 'modificarUserEdit('+data.id_persona+')');
		$('#editUserModal').modal('show');
	})
	.fail(function() {
		Swal.fire(
			      'Error!',
			      'Intente de nuevo',
			      'error'
			    );
	});
}

function modificarUserEdit(id_persona){
	$('#btnEditUser').text('Procesando...');
	$('#btnEditUser').attr('disabled','disabled');
	if ($('#nombreInputUserEdit').val()=="") {
		Swal.fire({

		  icon: 'error',

		  title: 'Falta un dato',

		  text: 'El Nombre es necesario!'

		});

		$('#btnEditUser').text('Editar Usuario');
		$('#btnEditUser').removeAttr('disabled');
	}else if ($('#apellidoPaternoInputUserEdit').val()==""||$('#apellidoMaternoInputUserEdit').val()=="") {
		Swal.fire({

		  icon: 'error',

		  title: 'Falta un dato',

		  text: 'Los Apellidos son necesarios!'

		});

		$('#btnEditUser').text('Editar Usuario');
		$('#btnEditUser').removeAttr('disabled');
	} else if ($('#edadInputUserEdit').val()=="") {
		Swal.fire({

		  icon: 'error',

		  title: 'Falta un dato',

		  text: 'La edad es necesaria!'

		});

		$('#btnEditUser').text('Editar Usuario');
		$('#btnEditUser').removeAttr('disabled');
	} else if ($('#telCelInputUserEdit').val()=="") {
		Swal.fire({

		  icon: 'error',

		  title: 'Falta un dato',

		  text: 'El telefono es necesario!'

		});

		$('#btnEditUser').text('Editar Usuario');
		$('#btnEditUser').removeAttr('disabled');
	} else if ($('#correoUserEdit').val()=="") {
		Swal.fire({

		  icon: 'error',

		  title: 'Falta un dato',

		  text: 'El Correo es necesario!'

		});

		$('#btnEditUser').text('Editar Usuario');
		$('#btnEditUser').removeAttr('disabled');
	} else if (!($('input:radio[name=inlineRadioOptioUserEdit]:checked').val()!=null)) {
		Swal.fire({

		  icon: 'error',

		  title: 'Falta un dato',

		  text: 'El Genero es necesario!'

		});

		$('#btnEditUser').text('Editar Usuario');
		$('#btnEditUser').removeAttr('disabled');
	} else if ($('#tipoEdit option:selected').val()==0) {

		Swal.fire({

		  icon: 'error',

		  title: 'Falta un dato',

		  text: 'Debe seleccionar una opción de Tipo Usuario!'

		});
		$('#btnEditUser').text('Editar Usuario');
		$('#btnEditUser').removeAttr('disabled');
	}else {
		
		$.ajax({
			url: '../controller/usuarios.php',
			type: 'POST',
			dataType: 'JSON',
			data: {
				accion: 'edit',
				id: id_persona,
				nombre: $('#nombreInputUserEdit').val(),
				apellidoPat: $('#apellidoPaternoInputUserEdit').val(),
				apellidoMat: $('#apellidoMaternoInputUserEdit').val(),
				edad: $('#edadInputUserEdit').val(),
				fechaNac: $('#fechaNacI').val(),
				curp: $('#curpInputUserEdit').val().toUpperCase(),
				celular: $('#telCelInputUserEdit').val(),
				correo: $('#correoUserEdit').val(),
				genero: $('input:radio[name=inlineRadioOptioUserEdit]:checked').val(),
				tipo: $('#tipoEdit option:selected').val()
			},
		})
		.done(function(data) {
			console.log(data);
			if (data.status==true) {
				Swal.fire(
			      'Modificación Exitosamente',
			      'El Usuario se modifico correctamente!',
			      'success'
			    ).then((result) => {
			    	 if (result.value) {
			    	 	$('.modal-backdrop').hide();
						$('#body').removeClass('modal-open');
			    	 	ajax_global('../view/usuarios.php','contenido');
			    	 }
			    });
			}else{
				Swal.fire({

				  icon: 'error',

				  title: 'Algo Ocurrio!',

				  text: 'Intentelo de nuevo!'

				});
			$('#btnEditUser').text('Editar Usuario');
			$('#btnEditUser').removeAttr('disabled');
			}
		})
		.fail(function() {
			Swal.fire(
			      'Error!',
			      'Intente de nuevo',
			      'error'
			    );
		});
		
	}
}

function modificarPermisos(id){
	$.ajax({
		url: '../controller/usuarios.php',
		type: 'POST',
		dataType: 'json',
		data: {
			accion: 'consultPermiso',
			id_usuario: id
		},
	})
	.done(function(data) {
		//console.log(data);
		for (var permiso = 0; permiso < 69; permiso++) {
			if (data[permiso]) {

				$('#checkPermiso'+permiso).prop("checked", true);

			}
		}
		$('#btnAddPermisoUser').attr('onClick', 'addPermisosUsuario('+id+');');
		$('#modalPermisos').modal('show');
	})
	.fail(function() {
		Swal.fire(
			      'Error!',
			      'Intente de nuevo',
			      'error'
			    );
	});
}

function addPermisosUsuario(id){
	let valoresCheck = [];



	$("input[type=checkbox]:checked").each(function(){

	    valoresCheck.push(this.value);

	});

	//console.log(valoresCheck);
	$.ajax({
		url: '../controller/usuarios.php',
		type: 'POST',
		dataType: 'json',
		data: {
			accion: 'addPermisoUsuario',
			checks: valoresCheck,
			id_usuario: id
		},
	})
	.done(function(data) {
		//console.log(data);
		Swal.fire(
			      'Permisos Asignados',
			      'Los permisos se agregaron correctamente!',
			      'success'
			    ).then((result) => {
			    	 if (result.value) {
			    	 	recargar();
			    	 }
			    });
	})
	.fail(function() {
		Swal.fire(
			      'Error!',
			      'Intente de nuevo',
			      'error'
			    );
	});
}

function addPermiso(){
	$('#btnPermiso').text('Procesando...');
	$('#btnPermiso').attr('disabled','disabled');
	if ($('#clave').val()=="") {
		Swal.fire({

		  icon: 'error',

		  title: 'Falta un dato',

		  text: 'Coloque una clave del permiso!'

		}).then((result) => {
			if (result.value) {
			    $('#btnPermiso').text('Agregar Permiso');
				$('#btnPermiso').removeAttr('disabled');
			}
		});
	} else if ($('#descripcion').val()=="") {
		Swal.fire({

		  icon: 'error',

		  title: 'Falta un dato',

		  text: 'Coloque una descripcion del permiso!'

		}).then((result) => {
			if (result.value) {
			    $('#btnPermiso').text('Agregar Permiso');
				$('#btnPermiso').removeAttr('disabled');
			}
		});
	} else {
		$.ajax({
			url: '../controller/permisos.php',
			type: 'POST',
			dataType: 'JSON',
			data: {
				accion: 'permiso',
				clave: $('#clave').val(),
				descripcion: $('#descripcion').val(),
			},
		})
		.done(function(data) {
			//console.log(data);
			if (data) {
				Swal.fire({

				  icon: 'success',

				  title: 'Permiso Agregado',

				  text: 'El permiso se agrego correctamente!'

				}).then((result) =>{
					if (result.value) {
						$('.modal-backdrop').hide();
						$('#body').removeClass('modal-open');
						ajax_global('../view/permisos.php','contenido');
					}
				});
			} else {
				Swal.fire({

				  icon: 'error',

				  title: 'Algo Salio mal',

				  text: 'Intentelo de nuevo!'

				}).then((result) =>{
					if (result.value) {
						$('#btnPermiso').text('Agregar Permiso');
						$('#btnPermiso').removeAttr('disabled');
					}
				});
			}
		})
		.fail(function() {
			Swal.fire(
			      'Error!',
			      'Intente de nuevo',
			      'error'
			    );
		});
		
	}
}

function editPermiso(id){
	$.ajax({
		url: '../controller/permisos.php',
		type: 'POST',
		dataType: 'JSON',
		data: {
			accion: 'consult',
			id_permiso: id
		},
	})
	.done(function(data) {
		//console.log(data);
		$('#clave').val(data.CLAVE);
		$('#descripcion').val(data.DESCRIPCION);
		$('#btnPermiso').text('Editar Permiso');
		$('#btnPermiso').attr('onClick', 'editarPermiso('+id+');');
		$('#addPermisoModal').modal('show');
	})
	.fail(function() {
		Swal.fire(
			      'Error!',
			      'Intente de nuevo',
			      'error'
			    );
	});
}

function editarPermiso(id){
	$('#btnPermiso').text('Procesando...');
	$('#btnPermiso').attr('disabled','disabled');
	if ($('#clave').val()=="") {
		Swal.fire({

		  icon: 'error',

		  title: 'Falta un dato',

		  text: 'Coloque una clave del permiso!'

		}).then((result) => {
			if (result.value) {
			    $('#btnPermiso').text('Editar Permiso');
				$('#btnPermiso').removeAttr('disabled');
			}
		});
	} else if ($('#descripcion').val()=="") {
		Swal.fire({

		  icon: 'error',

		  title: 'Falta un dato',

		  text: 'Coloque una descripcion del permiso!'

		}).then((result) => {
			if (result.value) {
			    $('#btnPermiso').text('Editar Permiso');
				$('#btnPermiso').removeAttr('disabled');
			}
		});
	} else {
		$.ajax({
			url: '../controller/permisos.php',
			type: 'POST',
			dataType: 'JSON',
			data: {
				accion: 'edit',
				id_permiso: id,
				clave: $('#clave').val(),
				descripcion:$('#descripcion').val()
			},
		})
		.done(function(data) {
			//console.log(data);
			if (data) {
				Swal.fire({

				  icon: 'success',

				  title: 'Permiso Modificado',

				  text: 'El permiso se modifico correctamente!'

				}).then((result) =>{
					if (result.value) {
						$('.modal-backdrop').hide();
						$('#body').removeClass('modal-open');
						ajax_global('../view/permisos.php','contenido');
					}
				});
			} else {
				Swal.fire({

				  icon: 'error',

				  title: 'Algo Ocurrio',

				  text: 'Intetelo de nuevo!'

				}).then((result) =>{
					if (result.value) {
						$('#btnPermiso').text('Editar Permiso');
						$('#btnPermiso').removeAttr('disabled');
					}
				});
			}
		})
		.fail(function() {
			Swal.fire(
			      'Error!',
			      'Intente de nuevo',
			      'error'
			    );
		});
	}
}

function subirImagen(idProducto) {
	Swal.fire({
	  title: 'Seleccionar Foto',
	  input: 'file',
	  inputAttributes: {
	    'accept': 'image/*',
	    'aria-label': 'Subir Foto del Producto'
	  }
	}).then((result) => {
	//console.log(result.value);
	  if (result.value) {
	    //console.log(result.value);
	    var formData = new FormData();
		formData.append("accion", "subirImg");
		formData.append("idProducto", idProducto);
		formData.append("file", result.value);
		Swal.fire({
		  icon: 'info',
		  title: 'Subiendo Imagen Espere',
		  showConfirmButton: false,
		  timer: 2000
		});
	    $.ajax({
		    url: "../controller/inventarioProductos.php",
		    type: "POST",
		    dataType: "JSON",
		    data: formData,
		    cache: false,
		    contentType: false,
		    processData: false
		})
	    .done(function(info) {
	    	console.log(info);
	    	if (info) {
	    		Swal.fire({
				  icon: 'success',
				  title: 'Archivo Subido!',
				  showConfirmButton: false,
				  timer: 1500
				});
				$('.modal-backdrop').hide();
                $('#body').removeClass('modal-open');
                ajax_global('../view/inventarioProductos.php','contenido');
	    	} else {
	    		Swal.fire({
				  icon: 'error',
				  title: 'Oops...',
				  text: 'Error al Subir el archivo, Intente de nuevo',
				});
	    	}
	    })
	    .fail(function() {
	    	Swal.fire(
		      'Error!',
		      'Intente de nuevo',
		      'error'
		    );
	    });
	    
	  }else{
	  	Swal.fire({
		  icon: 'error',
		  title: 'Oops...',
		  text: 'Error al Subir el archivo, Intente de nuevo',
		});
	  }
	});
}

function addAlmacen() {
	$('#btnAlmacen').text('Procesando...');
	$('#btnAlmacen').attr('disabled','disabled');
	if ($('#nombre').val()=="") {
		Swal.fire({

		  icon: 'error',

		  title: 'Falta un dato',

		  text: 'Coloque un nombre para el Almacen'

		}).then((result) => {
			if (result.value) {
			 	$('#btnAlmacen').text('Agregar Almacen');
				$('#btnAlmacen').removeAttr('disabled');
			}
		});
	}else if($('#localizacion').val()==""){
		Swal.fire({

		  icon: 'error',

		  title: 'Falta un dato',

		  text: 'Coloque una localización para el Almacen'

		}).then((result) => {
			if (result.value) {
			 	$('#btnAlmacen').text('Agregar Almacen');
				$('#btnAlmacen').removeAttr('disabled');
			}
		});
	}else{
		$.ajax({
			url: '../controller/almacen.php',
			type: 'POST',
			dataType: 'JSON',
			data: {
				accion: 'almacen',
				nombre: $('#nombre').val(),
				localizacion: $('#localizacion').val(),
				idImp: $('#impresora').val()
			},
		})
		.done(function(data) {
			// console.log(data);
			if (data==true) {
				Swal.fire({

				  icon: 'success',

				  title: 'Almacen Agregado',

				  text: 'El Almacen se agrego correctamente!'

				}).then((result) =>{
					if (result.value) {
						$('.modal-backdrop').hide();
						$('#body').removeClass('modal-open');
						ajax_global('../view/almacen.php','contenido');
					}
				});
			}else{
				Swal.fire({

				  icon: 'error',

				  title: 'Algo Salio mal',

				  text: 'Intentelo de nuevo!'

				}).then((result) =>{
					if (result.value) {
						$('#btnAlmacen').text('Agregar Almacen');
						$('#btnAlmacen').removeAttr('disabled');
					}
				});
			}
		})
		.fail(function() {
			Swal.fire({

				  icon: 'error',

				  title: 'Algo Salio mal',

				  text: 'Intentelo de nuevo!'

				}).then((result) =>{
					if (result.value) {
						$('#btnAlmacen').text('Agregar Almacen');
						$('#btnAlmacen').removeAttr('disabled');
					}
				});
			console.log("error");
		});
		
	}
}

function editAlmacen(id) {
	$.ajax({
		url: '../controller/almacen.php',
		type: 'POST',
		dataType: 'JSON',
		data: {
			accion: 'consultarAlm',
			idAlm: id
		},
	})
	.done(function(data) {
		// console.log(data);
		$('#nombre').val(data['NOMBRE']);
		$('#localizacion').val(data['LOCALIZACION']);
		$('#btnAlmacen').text('Modificar Almacen');
		$('#btnAlmacen').attr('onClick', 'editAlm('+id+')');
		listImpresoras(data['ID_IMPRESORA']);
		$('#addAlmacenModal').modal('show');
	})
	.fail(function() {
		Swal.fire({

				  icon: 'error',

				  title: 'Algo Salio mal',

				  text: 'Intentelo de nuevo!'

				});
		console.log("error");
	});	
}

function listImpresoras(id) {
      $.ajax({
        url: '../controller/impresoras.php',
        type: 'POST',
        dataType: 'JSON',
        data: {
          accion: 'llenarlistTon'
        },
      })
      .done(function(data) {
        // console.log(data);
        $('#impresora').empty();
        $('#impresora').append("<option value='0'>Seleccionar</option>");

        $.each(data, function( index, value ) {
              $('#impresora').append("<option value='" + index + "'" + ">" + value +"</option>");
        });
        $("#impresora option[value="+id+"]").attr("selected",true);
      })
      .fail(function() {
        $('#impresora').empty();
        $('#impresora').append("<option value='0'>Sin datos/Error</option>");
      });
      
    }

function editAlm(id) {
	
	$('#btnAlmacen').text('Procesando...');
	$('#btnAlmacen').attr('disabled','disabled');
	if ($('#nombre').val()=="") {
		Swal.fire({

		  icon: 'error',

		  title: 'Falta un dato',

		  text: 'Coloque un nombre para el Almacen'

		}).then((result) => {
			if (result.value) {
			 	$('#btnAlmacen').text('Agregar Almacen');
				$('#btnAlmacen').removeAttr('disabled');
			}
		});
	}else if($('#localizacion').val()==""){
		Swal.fire({

		  icon: 'error',

		  title: 'Falta un dato',

		  text: 'Coloque una localización para el Almacen'

		}).then((result) => {
			if (result.value) {
			 	$('#btnAlmacen').text('Agregar Almacen');
				$('#btnAlmacen').removeAttr('disabled');
			}
		});
	}else{
		$.ajax({
			url: '../controller/almacen.php',
			type: 'POST',
			dataType: 'JSON',
			data: {
				accion: 'editAlmacen',
				idAlm: id,
				nombre: $('#nombre').val(),
				localizacion: $('#localizacion').val(),
				idImp: $('#impresora').val(),
			},
		})
		.done(function(data) {
			// console.log(data);
			if (data==true) {
				Swal.fire({

				  icon: 'success',

				  title: 'Almacen Modificado',

				  text: 'El Almacen se modifico correctamente!'

				}).then((result) =>{
					if (result.value) {
						$('.modal-backdrop').hide();
						$('#body').removeClass('modal-open');
						ajax_global('../view/almacen.php','contenido');
					}
				});
			}else{
				Swal.fire({

				  icon: 'error',

				  title: 'Algo Salio mal',

				  text: 'Intentelo de nuevo!'

				}).then((result) =>{
					if (result.value) {
						$('#btnAlmacen').text('Modificar Almacen');
						$('#btnAlmacen').removeAttr('disabled');
					}
				});
			}
		})
		.fail(function() {
			Swal.fire({

				  icon: 'error',

				  title: 'Algo Salio mal',

				  text: 'Intentelo de nuevo!'

				}).then((result) =>{
					if (result.value) {
						$('#btnAlmacen').text('Modificar Almacen');
						$('#btnAlmacen').removeAttr('disabled');
					}
				});
			console.log("error");
		});
		
	}
}

function addToner() {
	$('#btnToner').text('Procesando...');
	$('#btnToner').attr('disabled','true');

	if ($('#nombre').val()=='') {
		Swal.fire({

		  icon: 'error',

		  title: 'Falta un dato',

		  text: 'Coloque un Nombre'

		}).then((result) => {
			if (result.value) {
			 	$('#btnToner').text('Agregar Toner');
				$('#btnToner').removeAttr('disabled');
			}
		});
	}else if($('#modelo').val()==''){
		Swal.fire({

		  icon: 'error',

		  title: 'Falta un dato',

		  text: 'Coloque un Modelo'

		}).then((result) => {
			if (result.value) {
			 	$('#btnToner').text('Agregar Toner');
				$('#btnToner').removeAttr('disabled');
			}
		});
	}else if($('#descripcion')==''){
		Swal.fire({

		  icon: 'error',

		  title: 'Falta un dato',

		  text: 'Coloque una Descripción'

		}).then((result) => {
			if (result.value) {
			 	$('#btnToner').text('Agregar Toner');
				$('#btnToner').removeAttr('disabled');
			}
		});
	}else{
		$.ajax({
			url: '../controller/toner.php',
			type: 'POST',
			dataType: 'JSON',
			data: {
				accion: 'addToner',
				nombre: $('#nombre').val(),
				modelo: $('#modelo').val(),
				descripcion: $('#descripcion').val()
			},
		})
		.done(function(data) {
			if (data==true) {
				Swal.fire({

				  icon: 'success',

				  title: 'Toner Agregado',

				  text: 'El Toner se agrego correctamente!'

				}).then((result) =>{
					if (result.value) {
						$('.modal-backdrop').hide();
						$('#body').removeClass('modal-open');
						ajax_global('../view/toner.php','contenido');
					}
				});
			}else{
				Swal.fire({

				  icon: 'error',

				  title: 'Algo Salio mal',

				  text: 'Intentelo de nuevo!'

				}).then((result) =>{
					if (result.value) {
						$('#btnToner').text('Agregar Toner');
						$('#btnToner').removeAttr('disabled');
					}
				});
			}
		})
		.fail(function() {
			Swal.fire({

				  icon: 'error',

				  title: 'Algo Salio mal',

				  text: 'Intentelo de nuevo!'

				}).then((result) =>{
					if (result.value) {
						$('#btnToner').text('Agregar Toner');
						$('#btnToner').removeAttr('disabled');
					}
				});
			console.log("error");
		});
	}
}

function agregarExistencia(id) {
	Swal.fire({
  title: '¿Agregar Existencia o Dar Salida de Existencia?',
  showDenyButton: true,
  showCancelButton: true,
  confirmButtonText: `Agregar Existencia`,
  denyButtonText: `Salida de Existencia`,
}).then((result) => {
  /* Read more about isConfirmed, isDenied below */
  if (result.isConfirmed) {
    Swal.fire({
	    title: 'Agregar Existencia',
	    showCancelButton: true,
	    input: 'text',
	    inputAttributes: {
	      'aria-label': 'Agregar Existencia'
	    }
	  }).then((result) => {
	    if (result.value>0) {
	      $.ajax({
	        url: '../controller/toner.php',
	        type: 'POST',
	        dataType: 'JSON',
	        data: {
	          accion: 'agregarExistencia',
	          existencia: result.value,
	          idToner: id
	        },
	      })
	      .done(function(data) {
	      	// console.log(data);
	        if (data==true) {
	          Swal.fire({

	            title: '¡Existencia Guardada!',

	            text: 'La existencia se agrego correctamente',

	            icon: 'success'

	          }).then((result) => {

	            if (result.value) {

	              $('.modal-backdrop').hide();
	              $('#body').removeClass('modal-open');
	              ajax_global('../view/toner.php','contenido');

	            }
	          });
	        }else{
	          Swal.fire({

	            icon: 'info',

	            title: 'Oops...',

	            text: '¡Algo Sucedio Mal, intente recargando la pagina e intente de nuevo!'

	          });
	        }
	      })
	      .fail(function() {
	      	console.log("error");
	        Swal.fire({

	          icon: 'info',

	          title: 'Oops...',

	          text: '¡Algo Sucedio Mal, intente recargando la pagina e intente de nuevo!'

	        });
	      });
	      
	    }else{
	      Swal.fire({

	        icon: 'info',

	        title: 'Oops...',

	        text: '¡Debe de colocar un valor correcto en la existencia del toner o mayor a 0!'

	      });
	    }
	  });
  } else if (result.isDenied) {
	$("#tonerHiden").val(id);
  	$("#btnSalida").attr("onClick","addSalida("+id+")");
    $("#addSalidaModal").modal("show");
  }
})
}

function editarToner(id) {
	$.ajax({
		url: '../controller/toner.php',
		type: 'POST',
		dataType: 'JSON',
		data: {
			accion: 'consultarToner',
			idToner: id
		},
	})
	.done(function(data) {
		// console.log(data);
		$('#nombre').val(data.NOMBRE);
		$('#modelo').val(data.MODELO);
		$('#descripcion').val(data.DESCRIPCION);

		$('#btnToner').text('Modificar Toner');
		$('#btnToner').attr('onClick', 'editToner('+data.ID_TONER+')');

		$('#addTonerModal').modal('show');
	})
	.fail(function() {
		Swal.fire({

        icon: 'info',

        title: 'Oops...',

        text: '¡Algo Sucedio Mal, intente recargando la pagina e intente de nuevo!'

      });
		console.log("error");
	});
}

function editToner(id) {
	
	$('#btnToner').text('Procesando...');
	$('#btnToner').attr('disabled','true');

	if ($('#nombre').val()=='') {
		Swal.fire({

		  icon: 'error',

		  title: 'Falta un dato',

		  text: 'Coloque un Nombre'

		}).then((result) => {
			if (result.value) {
			 	$('#btnToner').text('Modificar Toner');
				$('#btnToner').removeAttr('disabled');
			}
		});
	}else if($('#modelo').val()==''){
		Swal.fire({

		  icon: 'error',

		  title: 'Falta un dato',

		  text: 'Coloque un Modelo'

		}).then((result) => {
			if (result.value) {
			 	$('#btnToner').text('Modificar Toner');
				$('#btnToner').removeAttr('disabled');
			}
		});
	}else if($('#descripcion')==''){
		Swal.fire({

		  icon: 'error',

		  title: 'Falta un dato',

		  text: 'Coloque una Descripción'

		}).then((result) => {
			if (result.value) {
			 	$('#btnToner').text('Modificar Toner');
				$('#btnToner').removeAttr('disabled');
			}
		});
	}else{
		$.ajax({
			url: '../controller/toner.php',
			type: 'POST',
			dataType: 'JSON',
			data: {
				accion: 'editToner',
				idToner: id,
				nombre: $('#nombre').val(),
				modelo: $('#modelo').val(),
				descripcion: $('#descripcion').val()
			},
		})
		.done(function(data) {
			if (data==true) {
				Swal.fire({

				  icon: 'success',

				  title: 'Toner Modificado',

				  text: 'El Toner se modifico correctamente!'

				}).then((result) =>{
					if (result.value) {
						$('.modal-backdrop').hide();
						$('#body').removeClass('modal-open');
						ajax_global('../view/toner.php','contenido');
					}
				});
			}else{
				Swal.fire({

				  icon: 'error',

				  title: 'Algo Salio mal',

				  text: 'Intentelo de nuevo!'

				}).then((result) =>{
					if (result.value) {
						$('#btnToner').text('Modificar Toner');
						$('#btnToner').removeAttr('disabled');
					}
				});
			}
		})
		.fail(function() {
			Swal.fire({

				  icon: 'error',

				  title: 'Algo Salio mal',

				  text: 'Intentelo de nuevo!'

				}).then((result) =>{
					if (result.value) {
						$('#btnToner').text('Modificar Toner');
						$('#btnToner').removeAttr('disabled');
					}
				});
			console.log("error");
		});
	}
}

function cancelarExistencia(id) {
	Swal.fire({
	  title: '¿Cancelar Surtimiento?',
	  text: "¡Esta acción no se puede deshacer!",
	  icon: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'Sí, Cancelar'
	}).then((result) => {
	  if (result.isConfirmed) {
	  	$.ajax({
	  		url: '../controller/toner.php',
	  		type: 'POST',
	  		dataType: 'JSON',
	  		data: {
	  			accion: 'cancelarSurtimiento',
	  			idDetSurt: id
	  		},
	  	})
	  	.done(function(data) {
	  		// console.log(data);
	  		Swal.fire({

					  icon: 'success',

					  title: 'Detalle Existencia Cancelado',

					  text: 'La existencia se modifico correctamente!'

					}).then((result) =>{
						if (result.value) {
							$('.modal-backdrop').hide();
							$('#body').removeClass('modal-open');
							ajax_global('../view/toner.php','contenido');
						}
					});
	  	})
	  	.fail(function() {
	  		Swal.fire({

					  icon: 'error',

					  title: 'Algo Salio mal',

					  text: 'Intentelo de nuevo!'

					});
	  		console.log("error");
	  	});
	  	
	    Swal.fire(
	      'Deleted!',
	      'Your file has been deleted.',
	      'success'
	    )
	  }
	})
}

function guardarSurtimiento() {
	$('#btnGuardar').text('Procesando...');
	$('#btnGuardar').attr('disabled', 'true');
	var comprobacion=false;
	if ($('#tonerColorHidden').val()==0) {
		if ($('#toner').val()==0) {
			comprobacion=true;
		}
	}else if($('#tonerColorHidden').val()==1){
		if ($('#tonerColorSelect').val()==0) {
			comprobacion=true;
		}
	}else{
		if ($('#accesorioImpresoraSelect').val()==0) {
			comprobacion=true;
		}
	}
	if ($('#almacen').val()==0) {
		Swal.fire({

		  icon: 'error',

		  title: 'Falta un dato',

		  text: 'Seleccione un almacen'

		}).then((result) => {
			if (result.value) {
			 	$('#btnGuardar').text('Guardar');
				$('#btnGuardar').removeAttr('disabled');
			}
		});
	}else if(comprobacion){
		Swal.fire({

		  icon: 'error',

		  title: 'Falta un dato',

		  text: 'Seleccione un Toner'

		}).then((result) => {
			if (result.value) {
			 	$('#btnGuardar').text('Guardar');
				$('#btnGuardar').removeAttr('disabled');
			}
		});
	}else if($('#cantidad').val()==0){
		Swal.fire({

		  icon: 'error',

		  title: 'Falta un dato',

		  text: 'Coloque una cantidad de toner'

		}).then((result) => {
			if (result.value) {
			 	$('#btnGuardar').text('Guardar');
				$('#btnGuardar').removeAttr('disabled');
			}
		});
	}else{
		var fecha="";
		if ($('#fechaSurt').val()!="") {
			fecha=$('#fechaSurt').val()+' 09:00:00';
		}
		// console.log(fecha);
		var toner;
		if($('#tonerColorHidden').val()==0){
			toner=$('#tonerHidden').val();
		}else if($('#tonerColorHidden').val()==1){
			toner=$('#tonerColorSelect').val();
		}else{
			toner=$('#accesorioImpresoraSelect').val();
		}
		// console.log($('#almacen').val());
		$.ajax({
			url: '../controller/surtimiento.php',
			type: 'POST',
			dataType: 'JSON',
			data: {
				accion: 'guardar',
				idToner: toner,
				idAlmacen: $('#almacen').val(),
		   		fechaSurt: fecha,
				cantidad: 1,
			},
		})
		.done(function(data) {
			console.log(data);
			if (data[1]==true) {
				window.open("../controller/surtimientoPDF.php?id="+data[2]);
				Swal.fire({

					  icon: 'success',

					  title: 'Surtimiento Exitoso',

					  text: 'El surtimiento se hizo correctamente!'

					}).then((result) =>{
						if (result.value) {
							$('.modal-backdrop').hide();
							$('#body').removeClass('modal-open');
							ajax_global('../view/principal.php','contenido');
						}
					});
			}else{
				$('#btnGuardar').text('Guardar');
				$('#btnGuardar').removeAttr('disabled');
				Swal.fire({

					  icon: 'info',

					  title: 'Verifique la Existencia del Toner',

					  text: 'Intentelo de nuevo!'

					});
			}
		})
		.fail(function() {
			console.log("error");
			Swal.fire({

					  icon: 'error',

					  title: 'Algo Salio mal',

					  text: 'Intentelo de nuevo!'

					});
		});
		
	}
}

function abrirPDF(id) {
	window.open("../controller/surtimientoPDF.php?id="+id);
}

function listToners(id) {
      $.ajax({
        url: '../controller/impresoras.php',
        type: 'POST',
        dataType: 'JSON',
        data: {
          accion: 'llenarlistT'
        },
      })
      .done(function(data) {
        // console.log(data);
        $('#toner').empty();
        $('#toner').append("<option value='0'>Seleccionar</option>");

        $.each(data, function( index, value ) {
              $('#toner').append("<option value='" + index + "'" + ">" + value +"</option>");
        });
        $("#toner option[value="+id+"]").attr("selected",true);
      })
      .fail(function() {
        $('#toner').empty();
        $('#toner').append("<option value='0'>Sin datos/Error</option>");
      });
      
    }

function editImpresora(id) {
	$.ajax({
		url: '../controller/impresoras.php',
		type: 'POST',
		dataType: 'JSON',
		data: {
			accion: 'consultarImp',
			idImp: id
		},
	})
	.done(function(data) {
		// console.log(data);
		$('#nombre').val(data['NOMBRE']);
		$('#modelo').val(data['MODELO']);
		$('#btnImpresora').text('Modificar Impresora');
		$('#btnImpresora').attr('onClick', 'editImpt('+id+')');
		if(data['MULTICOLOR']==1){
			$("#multicolor").val(data['MULTICOLOR']);
			$('#iconAgregar').removeAttr("hidden");
			$("#inlineRaUserEdit").prop("checked", true);
			listToners(0);
		}else{
			$("#inlineRUserEdit").prop("checked", true);
			listToners(data['ID_TONER']);
		}
		$('#addImpresoraModal').modal('show');
	})
	.fail(function() {
		Swal.fire({

				  icon: 'error',

				  title: 'Algo Salio mal',

				  text: 'Intentelo de nuevo!'

				});
		console.log("error");
	});	
}

function editImpt(id,impTon) {
	var detalleTon = new Array();
	if($('#multicolor').val()==1){
			$("#contenToners span").each(function() {
			detalleTon.push(this.getAttribute("id"));
		});
	}else{
		detalleTon[0]=$('#toner').val();
	}
	// console.log(detalleTon);
	$.ajax({
		url: '../controller/impresoras.php',
		type: 'POST',
		dataType: 'JSON',
		data: {
			accion: 'editarImpresora',
			idImp: id,
			nombre: $('#nombre').val(),
			modelo: $('#modelo').val(),
			toner: detalleTon,
			multicolor: $('#multicolor').val(),
			idImpTon: impTon
		},
	})
	.done(function(data) {
		// console.log(data);
		if (data==true) {
			Swal.fire({

			  icon: 'success',

			  title: 'Impresora Modificada',

			  text: 'La impresora de modifico correctamente!'

			}).then((result) =>{
				if (result.value) {
					$('.modal-backdrop').hide();
					$('#body').removeClass('modal-open');
					ajax_global('../view/impresoras.php','contenido');
				}
			});
		}else{
			Swal.fire({

			  icon: 'error',

			  title: 'Algo Salio mal',

			  text: 'Intentelo de nuevo!'

			});
		}
	})
	.fail(function() {
		Swal.fire({

				  icon: 'error',

				  title: 'Algo Salio mal',

				  text: 'Intentelo de nuevo!'

				});
		console.log("error");
	});	
}

function addImpresora() {
	$('#btnImpresora').text('Procesando...');
	$('#btnImpresora').attr('disabled', 'true');
	if ($('#nombre').val()=="") {
		Swal.fire({

		  icon: 'error',

		  title: 'Falta un dato',

		  text: 'Coloque un nombre de la impresora'

		}).then((result) => {
			if (result.value) {
			 	$('#btnImpresora').text('Guardar');
				$('#btnImpresora').removeAttr('disabled');
			}
		});
	}else if($('#modelo').val()==0){
		Swal.fire({

		  icon: 'error',

		  title: 'Falta un dato',

		  text: 'Escriba el modelo'

		}).then((result) => {
			if (result.value) {
			 	$('#btnImpresora').text('Guardar');
				$('#btnImpresora').removeAttr('disabled');
			}
		});
	}else if(!($('input:radio[name=inlineRadioOptionImp]:checked').val()!=null)){
		Swal.fire({

		  icon: 'error',

		  title: 'Falta un dato',

		  text: 'Seleccione el tipo para la impresora'

		}).then((result) => {
			if (result.value) {
			 	$('#btnImpresora').text('Guardar');
				$('#btnImpresora').removeAttr('disabled');
			}
		});
	}else{
		$.ajax({
			url: '../controller/impresoras.php',
			type: 'POST',
			dataType: 'JSON',
			data: {
				accion: 'guardar',
				idToner: $('#toner').val(),
				modelo: $('#modelo').val(),
				nombre: $('#nombre').val(),
				multicolor: $('input:radio[name=inlineRadioOptionImp]:checked').val(),
			},
		})
		.done(function(data) {
			// console.log(data);
			if (data==true) {
				Swal.fire({

				  icon: 'success',

				  title: 'Guardado correctamente',

				  text: '¡La impresora se guardo correctamente!'

				}).then((result) =>{
					if (result.value) {
						$('.modal-backdrop').hide();
						$('#body').removeClass('modal-open');
						ajax_global('../view/impresoras.php','contenido');
					}
				});
			}else{
				Swal.fire({

				  icon: 'error',

				  title: 'Algo Salio mal',

				  text: 'Intentelo de nuevo!'

				});
			}
		})
		.fail(function() {
			console.log("error");
			Swal.fire({

					  icon: 'error',

					  title: 'Algo Salio mal',

					  text: 'Intentelo de nuevo!'

					});
		});
		
	}
}

function reporteToners() {
	var inicio="",fin="",almacen=0,toner=0;

	inicio = $('#fechaInicio').val()
	fin = $('#fechaFin').val()
	almacen = $('#almacenes').val()
	toner  = $('#toners').val()

	var ventana = window.open("../controller/reporteTonersPDF.php?FI="+inicio+"&FF="+fin+"&almacen="+almacen+"&toner="+toner);

	ventana.print();
}

function agregarTon() {
	if ($('select[id="toner"] option:selected').val()==0) {
		Swal.fire({

		  icon: 'info',

		  title: 'Falta un dato',

		  text: 'Debe seleccionar un Toner'

		});
	}else if($('#cantidad').val()==""){
		Swal.fire({

		  icon: 'info',

		  title: 'Falta un dato',

		  text: 'Debe Colocar una cantidad valida'

		});
	}else{
		$('#conten').append('<span class="badge badge-pill badge-secondary" style="cursor: pointer;" onClick="eliminarTon(this)" name="'+$('select[id="toner"] option:selected').text()+'" id="'+$('select[id="toner"] option:selected').val()+'" value="'+$('#cantidad').val()+'">'+$('select[id="toner"] option:selected').text()+' - '+$('#cantidad').val()+'</span>');
		$('select[id="toner"] option:selected').remove();
		$("#cantidad").val("");
	}
}

function eliminarTon(elemet) {
	// console.log(elemet);
	$('select[id="toner"]').append("<option value='" + elemet.getAttribute("id") + "'" + ">" + elemet.getAttribute("name") +"</option>");
	$("span[id='"+elemet.getAttribute("id")+"']").remove();
	$("#cantidad").val("");
	$("#toner option[value='0']").attr("selected",true);
}

function addFactura() {
	var toner = new Array(), cantidad = new Array();
	$("#conten span").each(function() {
		toner.push(this.getAttribute("id"));
		cantidad.push(this.getAttribute("value"));
	});
	var sub=0,iv=0,to=0;
if ($('#subtotalFactura').val()!="") {
	sub=$('#subtotalFactura').val();
}
if ($('#ivaFactura').val()!="") {
	iv=$('#ivaFactura').val();
}
if ($('#totalFactura').val()!="") {
	to=$('#totalFactura').val();
}
	$.ajax({
			url: '../controller/facturas.php',
			type: 'POST',
			dataType: 'JSON',
			data: {
				accion: 'guardar',
				factura: $('#folioFactura').val(),
				fechaFac: $('#fechaFac').val(),
				subtotal: sub,
				iva: iv,
				total: to,
				idTon: toner,
				cantidadTon: cantidad
			},
		})
		.done(function(data) {
			// console.log(data);
			if (data==true) {
				Swal.fire({

				  icon: 'success',

				  title: 'Factura Guardada correctamente',

				  text: 'No olvide escanear el documento y subirlo'

				}).then((result) =>{
					if (result.value) {
						$('.modal-backdrop').hide();
						$('#body').removeClass('modal-open');
						ajax_global('../view/toner.php','contenido');
					}
				});
			}else{
				Swal.fire({

				  icon: 'error',

				  title: 'Algo Salio mal',

				  text: 'Intentelo de nuevo!'

				});
			}
		})
		.fail(function() {
			console.log("error");
			Swal.fire({

					  icon: 'error',

					  title: 'Algo Salio mal',

					  text: 'Intentelo de nuevo!'

					});
		});
}

function subirFactura(id) {
	Swal.fire({
	  title: 'Seleccionar Archivo',
	  input: 'file',
	  inputAttributes: {
	    'accept': 'application/PDF',
	    'aria-label': 'Subir Resultado'
	  }
	}).then((result) => {
	//console.log(result.value);
	  if (result.value) {
	    //console.log(result.value);
	    var formData = new FormData();
		formData.append("accion", "subirFile");
		formData.append("id_factura", id);
		formData.append("file", result.value);
		Swal.fire({
			  icon: 'info',
			  title: 'Subiendo Archivo Espere',
			  showConfirmButton: false,
			  timer: 1500
			});
	    $.ajax({
		    url: "../controller/facturas.php",
		    type: "POST",
		    dataType: "JSON",
		    data: formData,
		    cache: false,
		    contentType: false,
		    processData: false
		})
	    .done(function(info) {
	    	if (info==true) {
	    		Swal.fire({
					  icon: 'success',
					  title: 'Archivo Subido!',
					  showConfirmButton: false,
					  timer: 1500
					}).then((result) =>{
						$('.modal-backdrop').hide();
						$('#body').removeClass('modal-open');
  					ajax_global('../view/toner.php','contenido');
					});
	    	} else {
	    		Swal.fire({
					  icon: 'error',
					  title: 'Oops...',
					  text: 'Error al Subir el archivo, Intente de nuevo',
					});
	    	}
	    })
	    .fail(function() {
	    	Swal.fire(
		      'Error!',
		      'Intente de nuevo',
		      'error'
		    );
	    });
	    
	  }else{
	  	Swal.fire({
		  icon: 'error',
		  title: 'Oops...',
		  text: 'Error al Subir el archivo, Intente de nuevo',
		}).then((result) =>{
			$('.modal-backdrop').hide();
			$('#body').removeClass('modal-open');
			ajax_global('../view/toner.php','contenido');
		});
	  }
	});
}

function abrirSurtimientoPDF(id) {
	window.open("../controller/surtimientoFacturaPDF.php?id="+id);
}

function abrirFacturaPDF(file) {
	window.open("../facturas/"+file);
}

function agregarTonImp() {
	if ($('select[id="toner"] option:selected').val()==0) {
		Swal.fire({

		  icon: 'info',

		  title: 'Falta un dato',

		  text: 'Debe seleccionar un Toner'

		});
	}else{
		$('#contenToners').append('<span class="badge badge-pill badge-secondary" style="cursor: pointer;" onClick="eliminarTon(this)" name="'+$('select[id="toner"] option:selected').text()+'" id="'+$('select[id="toner"] option:selected').val()+'">'+$('select[id="toner"] option:selected').text()+ '</span>');
		$('select[id="toner"] option:selected').remove();
	}
}

function calcular() {
	var subtotal = parseFloat($('#subtotalFactura').val());
	var iva = round(subtotal*0.16);
	var total = iva+subtotal;
	$('#ivaFactura').val(iva);
	$('#totalFactura').val(total);
	// console.log(total);
}

function round(num) {
    var m = Number((Math.abs(num) * 100).toPrecision(15));
    return Math.round(m) / 100 * Math.sign(num);
}

function eliminarTonImp(idImp,idTon) {
	Swal.fire({
	  title: 'Eliminar Toner de Impresora?',
	  text: "¿Desea eliminar el toner de la impresora seleccionado?",
	  icon: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'YES!'
	}).then((result) => {
	  if (result.value) {
	  	$.ajax({
	  		url: '../controller/impresoras.php',
	  		type: 'POST',
	  		dataType: 'JSON',
	  		data: {
	  			accion: 'elimTonImp',
	  			idImpresora: idImp,
	  			idToner: idTon
	  		},
	  	})
	  	.done(function(data) {
	  		// console.log(data);
	  		if (data) {
	  			Swal.fire(
			      'Se elimino Correctamente',
			      'No olvide agregar un toner a la impresora de color',
			      'success'
			    ).then((result) => {
			    	 if (result.value) {
			    	 	$('.modal-backdrop').hide();
							$('#body').removeClass('modal-open');
			    	 	ajax_global('../view/impresoras.php','contenido');
			    	 }
			    });
	  		} else {
	  			Swal.fire(
			      'Error!',
			      'Intente de Nuevo!',
			      'error'
			    );
	  		}
	  	})
	  	.fail(function() {
	  		console.log("error");
	  		Swal.fire(
			      'Error!',
			      'Intente de nuevo',
			      'error'
			    );
	  	});
	  }
	});
}

function addSalida(id) {
	$.ajax({
			url: '../controller/toner.php',
			type: 'POST',
			dataType: 'JSON',
			data: {
				accion: 'salidaToner',
				descripcion: $("#descripcionSalida").val(),
				cantidad: $("#cantidadSalida").val(),
				idToner: $("#tonerHiden").val()
			},
		})
		.done(function(data) {
			console.log(data);
			if (data==true) {
				Swal.fire({

				  icon: 'success',

				  title: 'Guardado correctamente',

				  text: '¡La salida se realizo correctamente!'

				}).then((result) =>{
					if (result.value) {
						$('.modal-backdrop').hide();
						$('#body').removeClass('modal-open');
						ajax_global('../view/toner.php','contenido');
					}
				});
			}else{
				Swal.fire({

				  icon: 'error',

				  title: 'Algo Salio mal',

				  text: 'Intentelo de nuevo!'

				});
			}
		})
		.fail(function() {
			console.log("error");
			Swal.fire({

					  icon: 'error',

					  title: 'Algo Salio mal',

					  text: 'Intentelo de nuevo!'

					});
		});
}