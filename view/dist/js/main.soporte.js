$(document).ready(function() {
	console.log('Bienvenido a ST ingeniero');
	/*Cargar los tooltip*/
	$('[data-toggle="tooltip"]').tooltip(); 
	/*Aplicar DataTables*/
	searchName();
	load_catalogos();

	/*Cargar el numero de notificacione nuevas*/
	numberNotifyNews();
	/*Carga de formularios*/
	atender_solicitud();
	frm_get_history();
	frm_create_sol();
	frm_reporte();
	
	/*Nombre del personal*/
	

});
function load_catalogos()
{
	load_solicitudesNvas();
	load_printers();
	load_personal_soporte();
	$('.select2').select2();
	load_personal();
	load_rubros();
	load_fallas();
	
	return false;
}
function load_personal_soporte()
{
	$.ajax({
		url: 'controller/puente.php',
		type: 'POST',
		dataType: 'json',
		data: {option:36},
		async:false,
		cache:false
	})
	.done(function(data) {
		if (data.estado == 'error') {
			console.log(data.message);
		}else if( data.estado == 'vacio' ){
			console.log(data.message);
		}else{
			$.each(data, function(i, val) {
				$('#soporte').append('<option value="'+val.id+'">'+val.full_name+'</option>');
			});
		}
	})
	.fail(function() {
		alert("No se puede consultar personal de ST");
	});
	
	return false;
}
/*Carga de catalog de rubros */
function load_rubros() 
{
	$.ajax({
		url: 'controller/puente.php',
		type: 'POST',
		dataType: 'json',
		data: {option:40},
	})
	.done(function(rubros) {
		var selector = $('#rubro');
		selector.empty();
		selector.append('<option value="">...</option>')
		$.each(rubros, function(i, rubro) {
			selector.append('<option value="'+rubro.id+'">'+rubro.nombre+'</option>');
		});
	})
	.fail(function() {
		alert("No se pudo cargar el catálogo de rubros");
	});
	
	return false;
}
/*Aplicar datatables*/
function apply_dataTables(t = $('#solicitudes')) 
{
	var tabla = t;
	tabla.DataTable({
		'language':{
			url:"//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
		},
		 "lengthMenu": [[ 10, 15, 25, 50, 75, 100 ,-1],[  10, 15, 25, 50, 75, 100 ,'TODOS']],
		 'order': [0,'desc']
	});
	
	return false; 
}
/*Buscar el nombre de usuario*/
function searchName() 
{
    //$('#profile_name').text('Este es mi nombre');
    $.ajax({
        url: 'controller/puente.php',
        type: 'POST',
        dataType: 'json',
        data: {option: '5'},
    })
    .done(function(data) {
        $('.profile_name').text(data.short_name);
    })
    .fail(function() {
        $('.profile_name').text('Error. Usuario no encontrado');
    });
    
    return false;   
}
/*Función para eliminar una solicitud*/
function DeleteSol(reg) 
{
	var razon = prompt('¿Porque desea eliminar este registro?\n (Escriba al menos 3 palabras)');
	if (razon != '' && razon != null) 
	{
		/*Hacer la oracion un array*/
		razon = razon.trim();
		razon_array = razon.split(" ");
		if (razon_array.length >= 3) 
		{
			$.ajax({
				url: 'controller/puente.php',
				type: 'POST',
				dataType: 'json',
				data: {option: '29',id:reg,motivo : razon},
			})
			.done(function(data) {
				if ( data.message =='success' ) {
					/*Mostrar la alerta */
					$('#success').removeClass('hidden');
					/*Colocar el contenido*/
					$('#mensaje_exitoso').text('SOLICITUD CANCELADA');
					/*Moverse hasta el mensaje de exito*/
					window.location.href = '#success';
					/*Desaparecer el mensaje*/
					setTimeout(function(){
						$('#success').addClass('hidden');
						$('#mensaje_exitoso').text('');
					},9000);
					load_solicitudesNvas();
				}else{
					/*Mostrar la alerta */
					$('#error').removeClass('hidden');
					/*Colocar el contenido*/
					$('#mensaje_erroneo').text('Ocurrio un error al borrar la solicitud'+data.message);
					/*Moverse hasta el mensaje de exito*/
					window.location.href = '#error';
					/*Desaparecer el mensaje*/
					setTimeout(function(){
						$('#error').addClass('hidden');
						$('#mensaje_erroneo').text('');
					},9000);
				}
			})
			.fail(function() {
				console.log("error");
			});
			return false;
		}
		else
		{
			alert('No es una razón suficiente para eliminar registro.\nIntente nuevamente.');
			DeleteSol(reg);
		}
	}
	else
	{
		alert('Necesita una justificación para eliminar un registro de la BD\nIntente eliminar nuevamente.');
	}
	
}
/*Funció que modifica el estado de una solicitud (Visto)*/
function ViewSol(reg) 
{
	
	$.ajax({
		url: 'controller/puente.php',
		type: 'POST',
		dataType: 'json',
		data: {option: '28',id:reg},
	})
	.done(function(data) {
		if ( data.message =='success' ) {
			/*Mostrar la alerta */
			$('#success').removeClass('hidden');
			/*Colocar el contenido*/
			$('#mensaje_exitoso').text('El usuario ya puede consultar que has visto su solicitud');
			/*Moverse hasta el mensaje de exito*/
			window.location.href = '#success';
			/*Desaparecer el mensaje*/
			setTimeout(function(){
				$('#success').addClass('hidden');
				$('#mensaje_exitoso').text('');
			},9000);
			load_solicitudesNvas();
		}else{
			/*Mostrar la alerta */
			$('#error').removeClass('hidden');
			/*Colocar el contenido*/
			$('#mensaje_erroneo').text('El usuario ya puede consultar que has visto su solicitud');
			/*Moverse hasta el mensaje de exito*/
			window.location.href = '#error';
			/*Desaparecer el mensaje*/
			setTimeout(function(){
				$('#error').addClass('hidden');
				$('#mensaje_erroneo').text('');
			},9000);
		}
	})
	.fail(function() {
		console.log("error");
	});
	return false;
}
/*Funcion para salir*/
function logout() 
{
	location.href= 'login.php';
	return false;
}
/*Funcion que permite cargar el listado de solicitudes nuevas*/
function load_solicitudesNvas() 
{
	if ( $.fn.dataTable.isDataTable( '#solicitudes' ) ) {
        $('#solicitudes').DataTable().destroy();
    }
	var tabla = $('#solicitudes').DataTable({
		'language':{
			url:"//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
		},
		 "lengthMenu": [[ 10, 15, 25, 50, 75, 100 ,-1],[  10, 15, 25, 50, 75, 100 ,'TODOS']],
		 'order': [0,'desc']
	});
	tabla.clear().draw();
	$.ajax({
		url: 'controller/puente.php',
		type: 'POST',
		dataType: 'json',
		data: {option: 26},
	})
	.done(function(data) {
		//console.log(data);
		$('.campanita').text(0);
		$.each(data, function(i, val) {
			if (val.estatus == 'Visto') {
				tabla.row.add( [
		            val.id,
		            val.falla,
		            val.afectado,
		            val.fecha,
		            '<div class="btn-group">'+
					'	<button type="button" class="btn btn-default btn-flat btn-sm" onclick="load_devices('+val.id+','+val.afectado_id+');"  data-toggle="modal" data-target="#modal-default"><i data-toggle="tooltip" title="Atender solicitud" class="fa fa-pencil"></i></button>'+
					'	<button type="button" class="btn btn-default btn-flat btn-sm" onclick="DeleteSol('+val.id+')" data-toggle="tooltip" data-placement="bottom"  title="Eliminar solicitud"><i class="fa fa-trash"></i></button>'+
					'</div>'
		        ] ).draw( false );
			}else{
				tabla.row.add( [
	            val.id,
	            val.falla,
	            val.afectado,
	            val.fecha,
	            '<div class="btn-group">'+
				'	<button type="button" class="btn btn-default btn-flat btn-sm" onclick="ViewSol('+val.id+');" data-toggle="tooltip" title="Marcar como visto"><i class="fa fa-eye"></i></button>'+
				'	<button type="button" class="btn btn-default btn-flat btn-sm" onclick="load_devices('+val.id+','+val.afectado_id+');"  data-toggle="modal" data-target="#modal-default"><i data-toggle="tooltip" title="Atender solicitud" class="fa fa-pencil"></i></button>'+
				'	<button type="button" class="btn btn-default btn-flat btn-sm" onclick="DeleteSol('+val.id+')" data-toggle="tooltip" data-placement="bottom"  title="Eliminar solicitud"><i class="fa fa-trash"></i></button>'+
				'</div>'
	        ] ).draw( false );
			}
		});
		/*Agregar clase para centrar  contenido*/
		$('tbody tr td').addClass('text-center');
	})
	.fail(function() {
		alert("Error al buscar las solicitudes nuevas ( load_solicitudesNvas() )");
	});
	

	return false;
}
function playNotify() {
	var audio = document.createElement("audio");
	audio.src = "view/dist/mp3/xperia.mp3";
	audio.play();
}
/*Crear notificacion*/
function createNotify (titulo,body,imagen)
{
	playNotify();
	Push.create(titulo, { 
		body: body, 
		icon: 'view/dist/img/'+imagen,
		timeout: 6000,
		onClick: function () {
			this.close(); //Cierra la notificación
		}
	});
	return false;
}

function numberNotifyNews()
{
	var anteriores = 0;
	/*Buscar cada 30 segundos notificaciones nuevas*/
	setInterval(function(){
		$.ajax({
			url: 'controller/puente.php',
			type: 'POST',
			dataType: 'json',
			data: {option: 27 },
		})
		.done(function(data) {
			if (data.message == 'success') 
			{
				if ( parseInt(data.count) > parseInt(anteriores) ) 
				{
					anteriores = data.count;
					//colocar las nuevas cantidades y lanzar la noficacion de escritorio
					createNotify('Aviso!','Cantidad de solicitudes pendientes: '+data.count,'edomex.jpg' );
					$('.campanita').text(data.count);
				}else{
					console.log( 'Todo sigue igual'+ data.count+ '=='+ anteriores );
				}
			}
			else
			{
				alert('Error');
			}
		})
		.fail(function() {
			console.log("error");
		});
		
	},5000);
	return false;
}
/*Carga el listado del personal*/
function load_personal() 
{
    $( "#servidor" ).autocomplete({
        autoFocus:true,
        source: 'controller/puente.php?option=1',
        select: function( event, ui ){
            $('#servidor_id').val(ui.item.id);
        },
        delay:0,
        search: function( event, ui ) {
        	$('#servidor_id').val('');
        },
        change: function( event, ui ) {
        	
        	if ( $('#device').length == 1) {
        		$('#device').empty();
        		$('#device').append('<option value="">...</option>');
        		buscarBienes();
        	}
        }
    });
    return false;
}

function load_devices(falla,afectado)
{
	/*Cargar la lista de dispositivos*/
	$.ajax({
		url: 'controller/puente.php',
		type: 'POST',
		dataType: 'json',
		data: {option: '30',a:afectado},
	})
	.done(function(data) {
		/*Limpiar el Select antes de colocar algo nuevo*/
		$('#device').empty();
		/*Poner la opcion de impresoras*/
		$('#device').append('<option value="">...</option>');
		$('#device').append('<option value="0">IMPRESORAS</option>');
		$('#servidor_id').val(afectado);
		/*Colocar lista de los dispositivos*/
		$.each(data, function(i, val) {
			$('#device').append('<option value="'+val.id+'">'+val.tipo+'</option>');
		});
	})
	.fail(function() {
		console.log("Error en la carga de dispositivos");
	});
	/*Cargar la descripcion de la falla que indico el usuario*/
	$('#reparacion_id').val(falla);
	$.ajax({
		url: 'controller/puente.php',
		type: 'POST',
		dataType: 'json',
		data: {option: '31',r:falla},
	})
	.done(function(data) {
		$('#servidor_id').val(data.afectado_id);
		$('#servidor').val( data.afectado );
		$('#falla').text(data.falla);

	})
	.fail(function() {
		console.log("Error en la carga de fallas");
	});
	
	return false;
}
/*Carga lista de impresoras*/
function load_printers()
{
	$('#device').change(function(e){
		e.preventDefault();
		if ( $(this).val() == 0 ) {
			/*Mostrar el select de impresoras*/
			$('#div_printers').removeClass('hidden');

			/*carga lista de impresoras*/
			$.ajax({
				url: 'controller/puente.php',
				type: 'POST',
				dataType: 'json',
				data: {option: '32'},
			})
			.done(function(data) {
				$('#printers').empty();
				$('#printers').removeAttr('disabled');
				$('#printers').append('<option value="">...</option>');
				$.each(data, function(i, val) {
					$('#printers').append('<option value="'+val.id+'">'+val.impresora+'</option>');
				});
			})
			.fail(function() {
				console.log("Error al obtener las impresoras");
			});
			
		}else{
			$('#printers').empty();
			$('#printers').attr('disabled','');
			$('#printers').append('<option value="">...</option>');
			$('#div_printers').addClass('hidden');
		}
	});
	return false; 
}
/*Cargar el contenido para atender la solicitud*/
function atender_solicitud()
{

	$('#frm_resolver_sol').submit(function(e){
		e.preventDefault();
		var data_form = $(this).serialize();

		$.ajax({
			url: 'controller/puente.php',
			type: 'POST',
			dataType: 'json',
			data: data_form,
		})
		.done(function(data) {
			if (data.estado == 'success') 
			{
				$('#success_modal').removeClass('hidden');
				$('#mensaje_exito').text(data.message);
				setTimeout(function(){
					$('#success_modal').addClass('hidden');
					$('#mensaje_exito').text('');
					$('#modal-default').modal('toggle');
					load_solicitudesNvas();
				},6000);
			}else if( data.estado == 'error' ){
				$('#error_modal').addClass('hidden');
				$('#mensaje_error').text(data.message);
				setTimeout(function(){
					$('#error_modal').addClass('hidden');
					$('#mensaje_error').text('');
					$('#modal-default').modal('toggle');
					load_solicitudesNvas();
				},6000);
			}

		})
		.fail(function() {
			console.log("error");
		});
		
	});
	return false;
}
/*Si se selecciona la opcion de reparaccion externa */
function reparacion_externa() 
{
	/*Recuperar el ID de la reparacion*/
	var reparacion = $('#reparacion_id').val();
	var bien;
	if ( $('#device').val() == 0 ) {
		if ( $('#printers').val()>0 ) {
			bien = $('#printers').val();
		}
	}else if($('#device').val() > 0)
	{
		bien = $('#device').val();
	}
	if ( bien >=1 ) {
		$.ajax({
			url: 'controller/puente.php',
			type: 'POST',
			dataType: 'json',
			data: {option: '33',r:reparacion,b:bien},
		})
		.done(function(data) {
			if ( data.estado == 'success' ) {

				$('#success_modal').removeClass('hidden');
				$('#mensaje_exito').text('La solicitud requiere la intervención de proveedor externo.\n'+
					'No olvide indicar de este cambio a la Subdirección de Tecnologías de la Información.');
				setTimeout( function(){
					$('#success_modal').hide(1000);
					$('#modal-default').modal('toggle');
					window.location.href = 'index.php?menu=general';
				},10000);
			}else{
				$('#error_modal').removeClass('hidden');
				$('#mensaje_error').text('Ocurrio un error durante la actualización de los datos. La página se reiniciara automaticamnete. Por favor espere.... ');
				setTimeout( function(){
					$('#error_modal').hide(1000);
					$('#modal-default').modal('toggle');
					window.location.href = 'index.php?menu=general';
				},10000);
			}
		})
		.fail(function( jqXHR, textStatus, errorThrown) {
			alert("Error: "+errorThrown);
			console.log(jqXHR);
		});
	}else{
		alert('Debes de selecciona un bien');
	}
	
	
	/*Si el bien ya esta seleccionado*/
	
	return false;
}
/*Formulario de busqueda de regstros historico*/
function frm_get_history()
{
	$('#tbl_history tfoot th ').each( function () {
        var title = $(this).text();
        if (title != ' ') {
        	$(this).html( '<input type="text" class="form-control" placeholder="Buscar '+title+'" />' );
        }
        
    } );

	var tabla = $('#tbl_history').DataTable({
		'language':{
			url:"//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
		},
		 "lengthMenu": [[ 10, 15, 25, 50, 75, 100 ,-1],[  10, 15, 25, 50, 75, 100 ,'TODOS']],
		 'order': [0,'desc']
	});

	


	$('#frm_history').submit(function(e){
		e.preventDefault();
		var data_form = $(this).serialize();
		//alert(data_form);
		$.ajax({
			url: 'controller/puente.php',
			type: 'POST',
			dataType: 'json',
			data: data_form,
		})
		.done(function(data) {
			tabla.clear().draw();
			$.each(data, function(i, val) {
				if (val.solucion == null) {
					solucion = 'Aún no se soluciona '
				}else{
					solucion = val.solucion;
				}
				var repara = 
				'<ul>'+
				    '<li>'+
				        '<p> <b>Falla:</b>'+
							val.falla+
				        '</p> '+
				    '</li>'+
				        '<li>'+
				            '<p>'+
				                '<b>Solución: </b>'+
								solucion+
				            '</p>'+
				        '</li>'+
				'</ul>';
				tabla.row.add([
					val.id,
					repara,
					val.afectado,
					val.f_sol,
					val.atendio,
					val.f_atendio
				]).draw();
			});
			tabla.columns().every( function () {
			    var that = this;
			 
			    $( 'input', this.footer() ).on( 'keyup change', function () {
			        if ( that.search() !== this.value ) {
			                that.search( this.value ).draw();
			        }
			    } );
			});

		})
		.fail(function() {
			alert("Ocurrio un error al obtener el historico.");
		});
		
	});
	
	return false;
}
/*Funcion de reseteo de formulario*/
function reset_frm_history ()
{
	document.getElementById('frm_history').reset();
	$('#servidor_id').val('');
	return false;
}
/*Buscar los bienes del servidor publico seleccionado*/
function buscarBienes()
{
	/*Recuperar el id del usuario*/
	var id = $('#servidor_id').val(); 
	if (id == '' || id == null || id == undefined) {
		alert('Debe de buscar primero el nombre del servidor público');
	}else{
		$.ajax({
			url: 'controller/puente.php',
			type: 'POST',
			dataType: 'json',
			data: {option: '37',servidor:id},
		})
		.done(function(data) {
			$('#device').empty();
			$('#device').append('<option value="">...</option>');
			$('#device').append('<option value="0">IMPRESORAS Y COPIADORAS</option>');
			if (data.message == 'success' ) {
				alert('Error: '+data.message);
			}else{
				
				$.each(data, function(i, val) {
					$('#device').append('<option value="'+val.id+'">'+val.bien+'</option>');
				});
			}
		})
		.fail(function() {
			console.log("error");
		});
		
	}
	return false;
}
/*Guarda la información de una solicitud*/
function frm_create_sol ()
{
	$('#frm_create_sol').submit(function(e) {
		e.preventDefault();
		var data_form = $(this).serialize();
		$.ajax({
			url: 'controller/puente.php',
			type: 'POST',
			dataType: 'json',
			data: data_form,
		})
		.done(function(data) {

			if (data.status == 'success') 
			{

				$('#alert').removeClass('hidden');
				$('#alert').addClass('alert-success');
				$('#title_alert').html('<i class="icon fa fa-check"></i> Éxito!');
				$('#message').text('Se almaceno con éxito la solicitud');
				setTimeout(function(){
					$('#alert').addClass('hidden');
					$('#alert').removeClass('alert-success');
					$('#title_alert').html('');
					$('#message').text('');
					/*Limpia el formulario*/
					$('#frm_create_sol').trigger('reset');
				},6000);
			}else{
				$('#alert').removeClass('hidden');
				$('#alert').addClass('alert-danger');
				$('#title_alert').html('<i class="icon fa fa-ban"></i> Algo ocurrio!');
				$('#message').text('Ocurrio un problema al salvar la solicitud');
				setTimeout(function(){
					$('#alert').addClass('hidden');
					$('#alert').removeClass('alert-danger');
					$('#title_alert').html('');
					$('#message').text('');
					document.getElementById('frm_create_sol').reset();
				},6000);
			}
		})
		.fail(function() {
			console.log("error");
		});
		
	});
	return false;
}
/*Carga de formulario de reporte */
function frm_reporte()
{
	var form = $('#frm_reporte');
	form.submit(function(e) {
		e.preventDefault();
		/*recuperar el tipo de reporte*/
		var t_report = $('#t_report').val();
		/*Recuperar los datos*/
		var data_form = $(this).serialize();
		if ( t_report == 1 ) {
			if ($('#fecha_de').val()		== '' && 	
				$('#fecha_hasta').val()		== '' &&	
				$('#person_st').val()		== '' &&	
				$('#rubro').val()			== '' &&
				$('#calificacion').val()	== '' 		
			) {
				var respuesta = confirm('Al no seleccionar un criterio, la solicitud de informacion puede demorar.\n ¿Está conciente?');
				if (respuesta) {
					generaReporte_uno(data_form);	
				}
				
			}else{
				generaReporte_uno(data_form);
			}
		}else if (t_report == 2){
			var f1 = $('#fecha_de').val();
			var f2 = $('#fecha_hasta').val();
			/*Recuperar las fechas solamente*/
			generateMuestreo(f1,f2);
		}else if(t_report == 3){
			alert('No tiene funcionamiento aún');
		}else{
			alert('Selecciona un "Tipo de reporte"');
		}
	});
	return false;
}
/*Genera el reporte de la opcion generar reporte */
function generaReporte_uno (data_form)
{
	var t = $('#tabla_reporte');
	$.ajax({
		url: 'controller/puente.php',
		type: 'POST',
		dataType: 'json',
		data: data_form,
	})
	.done(function(data) {

		if (data.estado == 'error') {
			$('div.alert-danger').empty();
			$('div.alert-danger').removeClass('hidden');
			$('div.alert-danger').append(data.message);
			setTimeout(function(){
				$('div.alert-danger').empty();
				$('div.alert-danger').addClass('hidden');
			},10000);
		}else{
			if ( $.fn.dataTable.isDataTable( '#tabla_reporte' ) ) {
            	$('#tabla_reporte').DataTable().destroy();
        	}

    		/*Dibujar la tabla*/
    		t = t.DataTable({
    	        'language':
    	        {
    	            'url':'//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
    	        },
    	        'lengthMenu': [[10, 25, 50,100, -1], [10, 25, 50, 100, 'Todos']],
    	        dom: '<"row"<"col-md-4"B><"col-md-4"l><"col-md-4"f>rtip>',
    	        buttons:{
    	            buttons: [
    	                { extend: 'pdf', className: 'btn btn-flat btn-warning',text:' <i class="fa  fa-file-pdf-o"></i> Exportar a PDF' },
    	                { extend: 'excel', className: 'btn btn-success btn-flat',text:' <i class="fa fa-file-excel-o"></i> Exportar a Excel' }
    	            ]
    	        } 
    	    });
    	    t.clear().draw();
	        /*Agregar los elementos a la tabla dibujada*/
	        if (data.length > 1) {
	        	$.each(data, function(i, val) {
	        		var fechas = '<label>Fecha de solicitud: </label>'+val.f_falla+'<br>'+'<label>Fecha de atención: </label>'+val.f_sol;
	        		var descripciones = '<label>Falla: </label>'+val.falla+'<br>'+'<label>Solución: </label> '+val.solucion;
	        		var personal  = '<label>Afectado: </label>'+val.afectado+'<br>'+'<label>Atendió: </label> '+val.solucionador;
	        		t.row.add( [
	        			'<input id="'+val.id+'" type="checkbox" name="checkUnique[]" value="'+val.id+'" onchange="verify('+val.id+');">',
	    	            val.id,
	    	            val.bien,
	    	            val.rubro,
	    	            fechas,
	    	            descripciones,
	    	            personal,
	    	            val.calificacion.toUpperCase()
	    	        ] ).draw( false );
	        		
	        	});
	        }
		}
		  
	})
	.fail(function() {
		console.log("error");
	});
	
	return false;
}
/*Selecciona todos los checkbox*/
function selectAll(val) 
{
	if ( $('[name="check_all"]').prop('checked') ) {
		$('input[type="checkbox"]').attr('checked','checked');
		$('.btn-app').removeClass('hidden');
	}else{
		$('input[type="checkbox"]').removeAttr('checked');
		$('.btn-app').addClass('hidden');
	}
}
/*Exportar a excel mi selección*/
function exportMiSelect()
{
	var t = $('#tbl_reportes_entregados');
	var checks = JSON.stringify($('[name="checkUnique[]"]').serializeArray())
	$.ajax({
		url: 'controller/puente.php',
		type: 'POST',
		dataType: 'json',
		data: {option:41,list:checks },
		timeout:10000,
		async:false,
		cache:false,
	})
	.done(function(data) {

		/*Dirigir a otra pestaña*/
		var info = JSON.stringify(data);
		// Run the effect
      	$( "#section_normal" ).toggle( 'drop', 2000 );	
		
		setTimeout(function(){
			var hoy = new Date();
			$('title').text('Reporte Generado');
			$('#section_export').addClass('content container-fluid');
			$('#section_export').removeClass('hidden');
		}, 500);
		/*Agregar contenido a la tabla recien pintada*/

		if ( $.fn.dataTable.isDataTable( '#tbl_reportes_entregados' ) ) {
            $('#tbl_reportes_entregados').DataTable().destroy();
        }
        
		/*Dibujar la tabla*/
		t = t.DataTable({
	        'language':
	        {
	            'url':'//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
	        },
	        'lengthMenu': [[10, 25, 50,100, -1], [10, 25, 50, 100, 'Todos']],
	        dom: '<"row"<"col-md-4"B><"col-md-4"l><"col-md-4"f>rtip>',
	        buttons:{
	            buttons: [
	                { extend: 'pdf', className: 'btn btn-flat btn-warning',text:' <i class="fa  fa-file-pdf-o"></i> Exportar a PDF' },
	                { extend: 'excel', className: 'btn btn-success btn-flat',text:' <i class="fa fa-file-excel-o"></i> Exportar a Excel' }
	            ]
	        } 
	    });
	    /*Agregar los elementos a la tabla dibujada*/
	    $.each(data, function(i, val) {
    		var fechas = '<label>Fecha: </label>'+val.f_falla;
    		var descripciones = '<label>Falla: </label>'+val.falla+'<br>'+'  <label>Solución: </label> '+val.solucion;
    		var personal  = '<label></label>'+val.afectado;
    		var firma = "";
    		t.row.add( [
	            'DIPPE/'+val.folio+'/'+val.year,
	            //val.bien,
	            //val.rubro,
	            fechas,
	            firma,
	            descripciones,
	            personal,
	            //val.calificacion.toUpperCase()
	        ] ).draw( false );
    		
    	});	
	})
	.fail(function() {
		alert('Error al tratar de exportar la selección');
	});
	
	return false;
}
/*Verificar que el checkbox este seleccionado*/
function verify(id) 
{
	if ( $('#'+id).is(':checked') ) 
	{
		if ( $('.btn-app').is('.hidden') ) {
			$('.btn-app').removeClass('hidden');	
		}
	}
	
	return false;
}
function change_t_report()
{
	var value = $('#t_report').val();
	if (value == 2) {
		$('#soporte').attr('disabled','disabled');
		$('#rubro').attr('disabled','disabled');
		$('#calificacion').attr('disabled','disabled');
		$('#tabla_reporte').addClass('hidden');
	}else{
		if ( $('#soporte').is(':disabled') && $('#rubro').is(':disabled') && $('#calificacion').is(':disabled') && $('#tabla_reporte').is('.hidden') )
		{
			$('#soporte').removeAttr('disabled');
			$('#rubro').removeAttr('disabled');
			$('#calificacion').removeAttr('disabled');
			$('#tabla_reporte').removeClass('hidden');
		}
	}
	return false;
}
/*Funcion para generar el muestreo*/
function generateMuestreo(f1,f2)
{
	/*llamado de callbacks y mandar la info*/
	callback_equipo(f1,f2);
	callback_solicitud(f1,f2);
	callback_rubro(f1,f2);
	callback_personal_st(f1,f2);
	return false;
}
function callback_equipo		(f1,f2)
{
	$.ajax({
		url: 'controller/puente.php',
		type: 'POST',
		dataType: 'json',
		data: {option: 42,f1:f1,f2:f2},
	})
	.done(function(data) {
		$('#tbl_m_equipo tbody').empty();
		if (data.estado == 'error') 
		{
			alert(data.message);
		}else{
			$.each(data, function(i, equipo) {
				$('#tbl_m_equipo').append(
					'<tr class="text-center">'+
						'<td>'+equipo.device+'</td>'+
						'<td>'+equipo.cuenta+'</td>'+
					'</tr>'
				);
			});
		}
	})
	.fail(function() {
		console.log("error");
	});
	return false;
}	
function callback_solicitud		(f1,f2)
{
	$.ajax({
		url: 'controller/puente.php',
		type: 'POST',
		dataType: 'json',
		data: {option: 43,f1:f1,f2:f2},
	})
	.done(function(data) {
		$('#tbl_m_solicitud tbody').empty();
		if (data.estado == 'error') 
		{
			alert(data.message);
		}else{
			$.each(data, function(i, equipo) {
				$('#tbl_m_solicitud').append(
					'<tr class="text-center">'+
						'<td>'+equipo.afectado+'</td>'+
						'<td>'+equipo.cuenta+'</td>'+
					'</tr>'
				);
			});
		}
	})
	.fail(function() {
		console.log("error");
	});
	
	return false;
}	
function callback_rubro			(f1,f2)
{
	$.ajax({
		url: 'controller/puente.php',
		type: 'POST',
		dataType: 'json',
		data: {option: 44,f1:f1,f2:f2},
	})
	.done(function(data) {
		$('#tbl_m_rubro tbody').empty();
			if (data.estado == 'error') 
			{
				alert(data.message);
			}else{
				$.each(data, function(i, equipo) {
					$('#tbl_m_rubro').append(
						'<tr class="text-center">'+
							'<td>'+equipo.rubro+'</td>'+
							'<td>'+equipo.cuenta+'</td>'+
						'</tr>'
					);
			});
			}
	})
	.fail(function() {
		console.log("error");
	});
	
	return false;
}
function callback_personal_st	(f1,f2)
{
	$.ajax({
		url: 'controller/puente.php',
		type: 'POST',
		dataType: 'json',
		data: {option: 45,f1:f1,f2:f2},
		cache:false,
		async:false,
	})
	.done(function(data) {
		$('#tbl_m_personalst tbody').empty();
		if (data.estado == 'error') 
		{
			alert(data.message);
		}else{
			$.each(data, function(i, equipo) {
				$('#tbl_m_personalst').append(
					'<tr class="text-center">'+
						'<td>'+equipo.persona+'</td>'+
						'<td>'+equipo.cuenta+'</td>'+
					'</tr>'
				);
		});
		}
	})
	.fail(function() {
		console.log("error");
	});
	
	return false;
}		

function load_fallas() 
{
	$.ajax({
		url: 'controller/puente.php',
		type: 'POST',
		dataType: 'json',
		data: {option: 79},
		cache:false,
		async:false,
	})
	.done(function(data) {
		$('#fallas').empty();
		$('#fallas').append('<option value="">BUSCAR Y SELECCIONAR FALLA</option>')
		if (data.estado == 'error') 
		{
			alert(data.message);
		}else{
			$.each(data, function(i, falla) {
				$('#fallas').append('<option value="'+falla.id+'">'+falla.nombre+'</option>')
			});
		}
	})
	.fail(function() {
		console.log("error");
	});
	return false;
}
