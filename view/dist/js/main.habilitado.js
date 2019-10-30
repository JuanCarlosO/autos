$(document).ready(function() {
	console.log('Bienvenido al Habilitado Vehícular');
	/*Cargar los tooltip*/
	$('[data-toggle="tooltip"]').tooltip(); 
	getURL();
});

/*Recuperar la pagina en la que se encuemntra*/
function getURL() {
	var URLsearch = window.location.search;
	getUser(); $('[data-mask]').inputmask();
	if ( URLsearch == '?menu=list_sol'  ) {
		$('#tree_list').addClass('active');
		$('#list_sol').addClass('active');
		$('.select2').select2();
		/*Carga el listado completo de vehiculos*/
		all_sol();
		/*Carga de evento de botones*/
		$('#btn_siniestros').click(function(event) {
			event.preventDefault();
			$('#modal_siniestro').modal('toggle');
		});
		/*Carga de formularios*/
		frm_add_siniestro();
		frm_atender_sol();
	}else if ( URLsearch == '?menu=list_car' || URLsearch == '?menu=general' ) {
		$('#tree_list').addClass('active');
		$('#list_car').addClass('active');
		/*Carga el listado completo de vehiculos*/
		all_cars();
	}else if ( URLsearch == '?menu=add_car' ) {
		$('#tree_add').addClass('active');
		$('#add_car').addClass('active');
		
		frm_add_car();//Agregar vehiculos
		getMarcas();
		getTipos();
		frm_add_marcav();
		frm_add_tipov();
	}else if ( URLsearch == '?menu=add_taller' ){
		$('#tree_add').addClass('active');
		$('#add_taller').addClass('active');

		frm_add_taller();
	}else if ( URLsearch == '?menu=list_taller' ){
		$('#tree_list').addClass('active');
		$('#list_taller').addClass('active');
		
		all_talleres();
	}else if ( URLsearch == '?menu=add_chofer' ){
		$('#tree_add').addClass('active');
		$('#add_chofer').addClass('active');
	}else{

		frm_add_taller();
	}

	return false;
}
/*Listado completo de solicitudes*/
function all_sol() {
	var sol = {
	    class: 'table-striped table-bordered table-hover',
	    columnas: [
	        { leyenda: 'ID', class:'text-center', style: 'width:50px;', columna: 'id',ordenable:true },
	        { leyenda: 'Folio', style: 'width:100px;', columna: 'folio',ordenable:true, filtro:true },
	        { leyenda: 'Solicitante', columna: 'n_short', style:'width:100px;' },
	        { leyenda: 'Vehículo', columna: 'n_short', style:'width:200px;' },
	        { leyenda: 'Descripcion', columna: 'n_short', style:'width:250px;' },
	        { leyenda: 'Detalle', style: 'width:15px;'},
	        
	    ],
	    modelo: [
	        { propiedad: 'id',class:'text-center',formato:function(tr,obj,celda) {
	        	if (obj.estado =='Creada') {
	        		tr.addClass('bg-yellow');
	        	}else{
	        		tr.addClass('bg-aqua');
	        	}
	        	return obj.id;
	        } },
	        { propiedad: 'folio' },
	        { propiedad: 'full_name'},
	        { formato: function(tr,obj,celda){
	        	return '<ul>'+
	        				'<li>'+'<label>Marca:</label> '+obj.marca+'</li>'+
	        				'<li>'+'<label>Tipo:</label> '+obj.tipo+'</li>'+
	        				'<li>'+'<label>Placas:</label> '+obj.placas+'</li>'+
	        				'<li>'+'<label>Modelo:</label> '+obj.modelo+'</li>'+
	        				'<li>'+'<label>NIV:</label> '+obj.niv+'</li>'
	        		   '<ul>';
	        }},
	        { propiedad: 'descripcion',class:'text-justify'},
	      
	        { class:'text-center', formato:function(tr,obj,celda){
	        	return anexGrid_boton({
	        		contenido:'<i class="fa fa-archive"></i>',
	        		class: 'btn btn-success btn-flat detalle',
	        		attr:[
					'data-toggle="tooltip" title="Mostrar el detalle de la solicitud"', 
					],
	        		type:'button',
	        		value:obj.id
	        	});
	        	
	        } },
	        
	    ],
	    url: 'controller/puente.php?option=8',
	    limite: [20,50,100],
	    columna: 'id',
	    columna_orden: 'DESC',
	    paginable:true,
	    filtrable:true,
	};
	var table = $("#all_cars").anexGrid(sol);
	table.tabla().on('click', '.detalle', function(event) {
		event.preventDefault();
		$('#modal_detalle_solicitud').modal('toggle');
		$('[name="solicitud_id"]').val( $(this).val() );
		/*Colocar la informacion en el formlario*/
		getDetalleSol( $(this).val() );
	});
	
	//return false;
}

/*Listado completo de vehiculos*/
function all_cars(){
	var sol = {
	    class: 'table-striped table-bordered',
	    columnas: [
	        { leyenda: 'ID', class:'text-center', style: 'width:50px;', columna: 'id',ordenable:true },
	        { leyenda: 'Tipo / Marca', style: 'width:100px;', columna: 'id',ordenable:true },
	        { leyenda: 'Placa', columna: 'n_short', style:'width:100px;' },
	        { leyenda: 'Color / Modelo / Cilindros', columna: 'n_short', style:'width:200px;' },
	        { leyenda: 'NIV / No. Motor / Estado', columna: 'n_short', style:'width:200px;' },
	        { leyenda: 'Observaciones', columna: 'n_short', style:'width:200px;' },
	        
	        { leyenda: 'Baja', style: 'width:50px;'},
	        
	    ],
	    modelo: [
	        { propiedad: 'id',class:'text-center' },
	        { formato: function(tr,obj,celda){
	        	return '<ul>'+
	        				'<li>'+'<label>Tipo:</label> '+obj.tip+'</li>'+
	        				'<li>'+'<label>Marca:</label> '+obj.mar+'</li>'+
	        		   '<ul>';
	        }},
	        { propiedad: 'placas'},
	        { formato: function(tr,obj,celda){
	        	return '<ul>'+
	        				'<li>'+'<label>Color:</label> '+obj.color+'</li>'+
	        				'<li>'+'<label>Modelo:</label> '+obj.modelo+'</li>'+
	        				'<li>'+'<label>Cilindros:</label> '+obj.cil+'</li>'+
	        		   '<ul>';
	        }},
	        { formato: function(tr,obj,celda){
	        	return '<ul>'+
	        				'<li>'+'<label>NIV:</label> '+obj.niv+'</li>'+
	        				'<li>'+'<label>No. Motor:</label> '+obj.n_motor+'</li>'+
	        				'<li>'+'<label>Estado: </label> '+obj.estado+'</li>'+
	        		   '<ul>';
	        }},
	        { propiedad: 'observaciones',class:'text-justify'},
	        
	        { class:'text-center', formato:function(tr,obj,celda){
	        	return anexGrid_boton({
	        		class: 'btn btn-warning btn-flat',
	        		contenido: '<i class="fa fa-arrow-down"></i>',
	        		attr: [
                    	'onclick="baja_veh('+obj.id+');"'
                	]
	        	});
	        	
	        } },
	    ],
	    url: 'controller/puente.php?option=6',
	    type:'POST',
	    limite: [20,50,100],
	    columna: 'id',
	    columna_orden: 'DESC',
	    paginable:true

	};
	$("#all_vehiculos").anexGrid(sol);
}
/*Listado completo de talleres*/
function all_talleres() {
	var sol = {
	    class: 'table-striped table-bordered',
	    columnas: [
	        { leyenda: 'ID', class:'text-center', style: 'width:50px;', columna: 'id',ordenable:true },
	        { leyenda: 'Razón social', style: 'width:100px;', columna: 'r_social',ordenable:false,filtro:true },
	        { leyenda: 'Contacto', columna: 'contacto', style:'width:100px;',ordenable:true },
	        { leyenda: 'Teléfono', columna: 'telefono', style:'width:200px;' },
	        { leyenda: 'Correo', columna: 'correo', style:'width:200px;',ordenable:true, filtro:true },
	        { leyenda: 'Domicilio', columna: 'domicilio', style:'width:200px;' },
	        { leyenda: 'Acciones', columna: '', style:'width:100px;' },
	    ],
	    modelo: [
	        { propiedad: 'id',class:'text-center' },
	        { propiedad:'r_social' },
	        { propiedad: 'contacto'},
	        { propiedad:'telefono' },
	        { propiedad:'correo' },
	        { propiedad: 'domicilio',class:'text-justify'},
	        
	        { class:'text-center', formato:function(tr,obj,celda){
	        	var id = obj.id;
	        	return anexGrid_dropdown({
	        		id:'opciones',
	        		class: 'btn btn-warning btn-flat',
	        		contenido: '<i class="fa fa-gears"></i>',
	        		data:[{
	        			href:'javascript:deleteTaller('+id+');',contenido:'Eliminar'
	        		},{
	        			href:'index.php?menu=add_taller&taller='+id,contenido:'Editar'
	        		}]
	        	});
	        	
	        } },
	    ],
	    url: 'controller/puente.php?option=7',
	    type:'POST',
	    limite: [25,50,100],
	    columna: 'id',
	    columna_orden: 'DESC',
	    paginable:true,
	    filtrable: true,

	};
	$("#all_talleres").anexGrid(sol);
}

function frm_add_car(){
	$('#frm_add_car').submit(function(e){
		e.preventDefault();
		var dataForm = $(this).serialize();
		$.ajax({
			url: 'controller/puente.php',
			type: 'POST',
			dataType: 'json',
			data: dataForm,
			cache:false,
			async:false,
		})
		.done(function(response) {
			alerta(response.status,response.message );
		})
		.fail(function(jqXHR,textStatus,errorThrown) {
			alerta('error',jqXHR.responseText );
		});
	});
	return false;
}
//Funcion para la alerta
function alerta( estado , mensaje ) {
	var clase ;
	var status;
	if ( estado == 'success' ) {
		clase 	= 'alert-success';
		status 	= 'CORRECTO! ';
	}else{
		status 	= 'OCURRIO UN ERROR! ';
		clase = 'alert-danger';
	}
	$('#alerta').removeClass('hidden');
	$('#alerta').addClass(clase);
	$('#estado').text(status);
	$('#message').text(mensaje);
	document.location.href = "#alerta";
	setTimeout(function(){
		$('#alerta').addClass('hidden');
		$('#alerta').removeClass(clase);
		$('#estado').text('');
		$('#message').text('');
		location.reload();
	},5000);
}
//Recuperar el listado de las marcas 
function getMarcas() {
	$.post('controller/puente.php', {option: '2'}, function(data, textStatus, xhr) {
		$('#m_veh').html('');
		$('#m_veh').append('<option value="">...</option>');
		$.each(data, function(index, val) {
			$('#m_veh').append('<option value="'+val.id+'">'+val.nom+'</option>');
		});
	},'json');
	return false;
}
//Recuperar el listado de tipos de vehiculos 
function getTipos() {
	$.post('controller/puente.php', {option: '3'}, function(data, textStatus, xhr) {
		$('#t_veh').html('');
		$('#t_veh').append('<option value="">...</option>');
		$.each(data, function(index, val) {
			$('#t_veh').append('<option value="'+val.id+'">'+val.nom+'</option>');
		});
	},'json');
	return false;
}
//Formulario de alta de marca de vehiculo
function frm_add_marcav() {
	$('#frm_add_marcav').submit(function(e) {
		e.preventDefault();
		var dataForm = $(this).serialize();
		$.ajax({
			url: 'controller/puente.php',
			type: 'POST',
			dataType: 'json',
			data: dataForm,
			cache:false,async:false,
		})
		.done(function(response) {
			alert(response.message );
			document.getElementById("frm_add_marcav").reset();
			$('#modal-add-marcav').modal('toggle');
			getMarcas();
		})
		.fail(function(jqXHR,textStatus,errorThrown) {
			alert(jqXHR.responseText );
		});
		
	});
 	return false;
 } 
//Formulario de alta de tipo de vehiculo 
function frm_add_tipov() {
	$('#frm_add_tipov').submit(function(e) {
		e.preventDefault();
		var dataForm = $(this).serialize();
		$.ajax({
			url: 'controller/puente.php',
			type: 'POST',
			dataType: 'json',
			data: dataForm,
			cache:false,async:false,
		})
		.done(function(response) {
			alert(response.message );
			document.getElementById("frm_add_tipov").reset();
			$('#modal-add-tipov').modal('toggle');
			getTipos();
		})
		.fail(function(jqXHR,textStatus,errorThrown) {
			console.log(jqXHR );
		});
	});
	return false;
}
/*Dar de baja a un vehiculo*/
function baja_veh(vehiculo) {
	$.ajax({
		url: 'controller/puente.php',
		type: 'POST',
		dataType: 'json',
		data: {option: '12',v:vehiculo},
		cache:false,
		async:false,
	})
	.done(function( response ) {
		console.log("success");
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
/*RECUPERAR EL NOMBRE Y PERFIL DEL USUARIO*/
function getUser() {
	$.post('controller/puente.php', {option: '13'}, function(data, textStatus, xhr) {
		$('.profile_name').text(data.full_name);
	},'json');
	return false;
}
/*Formulario de alta de talleres*/
function frm_add_taller() {
	$('#frm_add_taller').submit(function(e) {
		e.preventDefault();
		var dataForm = $(this).serialize();
		$.ajax({
			url: 'controller/puente.php',
			type: 'POST',
			dataType: 'json',
			data: dataForm,
			cache: false,
			async:false,
		})
		.done(function(response) {
			alerta(response.status,response.message);
		})
		.fail(function(jqXHR,textStatus, errorThrown) {
			alerta('error',jqXHR.responseText);
		});
		
	});
}
/*Eliminar el taller seleccionado*/
function deleteTaller(taller) {
	var respuesta = confirm('¿Seguro que quieres eliminar el ID '+taller+'?');
	if (respuesta) {
		$.post('controller/puente.php', {option: '15',t:taller}, function(data, textStatus, xhr) {
			alerta(data.status,data.message);
		},'json');
	}
}
/*Agregarun input para agregar un tecnico nuevo*/
function add_tecnico()
{
	var input = 
		'<div class="row">'+
    		'<div class="col-md-12">'+
    			'<div class="form-group">'+
    				'<label>Nombre del técnico.</label>'+
    				'<input type="text" name="tecnico[]" class="form-control">'+
    			'</div>'+
    		'</div>'+
    	'</div>';
	$('#names_tecnicos').append(input);
	return false;
}

/*Ejecutar formulario de los siniestros */
function frm_add_siniestro() {
	$('#frm_add_siniestro').submit(function(event) {
		event.preventDefault();
		
		var dataForm = $(this).serialize();

		$.ajax({
			url: 'controller/puente.php',
			type: 'POST',
			dataType: 'json',
			data: dataForm,
			cache:false,
			async:false,
			
		})
		.done(function(response) {
			var clase_estado;
			if (response.status == 'success') {
				label_estado = 'ÉXITO!';
				clase_estado = 'alert-success';
			}else{
				label_estado = 'ERROR!';
				clase_estado = 'alert-danger';
			}
			$('#alert_modal').removeClass('hidden');
			$('#alert_modal').addClass(clase_estado);
			$('#a_mod_sin_estado').text(response.status);
			$('#a_mod_sin_message').text(response.message);
			setTimeout(function(){
				$('#alert_modal').addClass('hidden');
				$('#alert_modal').removeClass(clase_estado);
				$('#a_mod_sin_estado').text('');
				$('#a_mod_sin_message').text('');
				document.getElementById('frm_add_siniestro').reset();
				$('#modal_siniestro').modal('toggle');
			},5000);
		})
		.fail(function(jqXHR,textStatus,errorThrown) {
			alert(jqXHR.responseText);
		});
	});
	
	
	return false;
}
/*Recuperar la informacion del detalle */
function getDetalleSol( solicitud ) 
{
	$.ajax({
		url: 'controller/puente.php',
		type: 'POST',
		dataType: 'json',
		data: {option: '18',sol:solicitud},
	})
	.done(function(response) {
		if ( response.status == 'error') {
			alert('Error: '+response.message);
		}else{
			$('#id').val(response.solicitud.id);
			$('#folio').val(response.solicitud.folio);
			$('#f_sol').val(response.solicitud.f_sol);
			$('#km').val(response.solicitud.km);
			$('#desc_sol').val(response.solicitud.descripcion);
			/*aGREGAR LAS REPARACIONES*/
			$('#reparaciones').html('');
			$.each(response.reparaciones, function(i, val) {
				$('#reparaciones').append('<li><b>Falla: </b>'+val.falla+ ' <b>reparado por</b> '+val.taller+'.</li>');
			});
			$('#resguardatario').val(response.vehiculo.name_reguardatario);
			$('#area_sol').val(response.solicitud.area);
			$('#name_sol').val(response.solicitud.name_sol);
			$('#placas').val(response.vehiculo.placas);

		}
	})
	.fail(function(jqXHR,textStatus,errorThrown) {
		alert('Error al recuperar el detalle de la solicitud: '+jqXHR.responseText);
	});
	
	return false;
}
/*Funcion para atender la solicitud*/
function atender_sol() {
	var solicitud = $('#solicitud_id').val();
	getTipoFalla('t_falla');
	$('#modal_atender_solicitud').modal('toggle');
}
function getTipoFalla(id) {
	$.post('controller/puente.php', {option: '21'}, function(data, textStatus, xhr) {
		$.each(data, function(i, val) {
			$('#'+id).append('<option value="'+val.id+'">'+val.nombre+'</option>');
		});
	},'json');
	$('#'+id).change( function(e){
		e.preventDefault();
		getFallas( 'fallas',$(this).val() );
	} );
	return false;
}
function getFallas( id,tipo ){
	$('#'+id).html('');
	$.post('controller/puente.php', {option: '20',t:tipo}, function(data, textStatus, xhr) {
		$.each(data, function(i, val) {
			$('#'+id).append('<option value="'+val.id+'">'+val.nombre+'</option>');
		});
	},'json');
	return false;
}
/*Funcion para atender solicitud*/
function frm_atender_sol() {
	$('#frm_atender_sol').submit(function(event) {
		event.preventDefault();
		var dataForm = $(this).serialize();
		$.ajax({
			url: 'controller/puente.php',
			type: 'POST',
			dataType: 'json',
			data: dataForm,
			async:false,
			cache: false,
		})
		.done(function(response) {
			var clase_estado;
			var label_estado;
			if (response.status == 'success') {
				label_estado = 'ÉXITO!';
				clase_estado = 'alert-success';
			}else{
				label_estado = 'ERROR!';
				clase_estado = 'alert-danger';
			}
			$('#alert_modal_atender').removeClass('hidden');
			$('#alert_modal_atender').addClass(clase_estado);
			$('#a_mod_atender_estado').text(label_estado);
			$('#a_mod_atender_message').text(response.message);
			setTimeout(function(){
				$('#alert_modal_atender').addClass('hidden');
				$('#alert_modal_atender').removeClass(clase_estado);
				$('#a_mod_atender_estado').text('');
				$('#a_mod_atender_message').text('');
				document.getElementById('frm_atender_sol').reset();
				$('#modal_atender_solicitud').modal('toggle');
			},5000);
		})
		.fail(function(jqXHR,textStatus,errorThrown) {
			label_estado = 'ERROR!';
			clase_estado = 'alert-danger';

			$('#alert_modal_atender').removeClass('hidden');
			$('#alert_modal_atender').addClass(clase_estado);
			$('#a_mod_atender_estado').text(label_estado);
			$('#a_mod_atender_message').text(jqXHR.responseText);
			setTimeout(function(){
				$('#alert_modal_atender').addClass('hidden');
				$('#alert_modal_atender').removeClass(clase_estado);
				$('#a_mod_atender_estado').text('');
				$('#a_mod_atender_message').text('');
				document.getElementById('frm_atender_sol').reset();
				$('#modal_atender_solicitud').modal('toggle');
			},5000);
		});
		
	});
	return false;
}
