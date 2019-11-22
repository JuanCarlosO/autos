$(document).ready(function() {
	console.log('Bienvenido al Habilitado Vehícular');
	/*Cargar los tooltip*/
	$('[data-toggle="tooltip"]').tooltip(); 
	//Timepicker
    $('.timepicker').timepicker({
    	minuteStep: 1,
    	showInputs: false,
    	showMeridian: false
    });
	getURL();
	eventos_programados();
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

		/*Carga de eventos*/
		$('#btn_siniestros').click(function(event) {
			event.preventDefault();
			$('#modal_siniestro').modal('toggle');
		});
		$('#s_aceptacion').change(function(e){
			e.preventDefault();
			if ( $(this).val() == '2' ) {
				$('#motivo').removeClass('hidden');
				$('#txt_motivo').attr('required', '');
			}else{
				$('#motivo').addClass('hidden');
				$('#txt_motivo').removeAttr('required');
			}
		});
		//getTipoFalla('t_falla_h','falla_h');
		//Recuperar los talleres
		getTalleres('ingreso_taller');
		/*Carga de formularios*/
		frm_add_siniestro();
		frm_atender_sol();
		frm_add_reparacion();
		frm_add_fallas();
		frm_ingreso();
		frm_ingreso_fin();
		frm_cotizar();
		frm_entrega();
		frm_solicitud_historica();
		/*Autocomplete*/
		autocompletado('sp_entrega','spe_id');
		autocompletado('sp_recibe','spr_id');
		//Agregar los ttpos de documentos
		var docs = getTiposDoc();
		var options = "<option value=''>...</option>";
		$.each(docs, function(i, doc) {
			options += "<option value='"+doc.id+"'>"+doc.nom+"</option>";
		});
		$('#t_doc').html(options);
	}else if ( URLsearch == '?menu=list_car' || URLsearch == '?menu=general' ) {
		$('#tree_list').addClass('active');
		$('#list_car').addClass('active');

		/*Carga el listado completo de vehiculos*/
		all_cars();
		/*Carga de formularios*/
		frm_baja_v();
	}else if ( URLsearch == '?menu=add_car' ) {
		$('#tree_add').addClass('active');
		$('#add_car').addClass('active');
		/*autocompletado de nombre*/
		autocompletado( 'personal','personal_id' );

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
		autocompletado('sp','sp_id');
		frm_add_chofer();
	}else if ( URLsearch == '?menu=list_chofer' ){
		$('#tree_list').addClass('active');
		$('#list_chofer').addClass('active');
		all_choferes();
	}
	else if ( URLsearch == '?menu=eventos' )
	{
		$('li#eventos').addClass('active');
		//Carga de fomularios 
		frm_eventos();
	}
	else if ( URLsearch == '?menu=es' )
	{
		$('li#registro_es').addClass('active');
		//Carga de listados
		all_es();
		//Carga de fomularios 
		frm_historico_es();
	}
	else{

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
	        	}else if (obj.estado =='Historica') {
	        		tr.addClass('bg-gray-active');
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
	        	 if (obj.estado =='Historica') {
	        		return '<b>Solicitud historica.</b>'; 
	        	}else{
	        		return anexGrid_boton({
		        		contenido:'<i class="fa fa-archive"></i>',
		        		class: 'btn btn-success btn-flat detalle',
		        		attr:[
						'data-toggle="tooltip" title="Mostrar el detalle de la solicitud"', 
						],
		        		type:'button',
		        		value:obj.id
	        		});
	        	}
	        	
	        	
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
	        { leyenda: 'Resguardatario', style: 'width:100px;', columna: 'id',ordenable:true },
	        { leyenda: 'Tipo / Marca / Placa', columna: 'n_short', style:'width:100px;' },
	        { leyenda: 'Color / Modelo / Cilindros', columna: 'n_short', style:'width:200px;' },
	        { leyenda: 'NIV / No. Motor / Estado', columna: 'n_short', style:'width:200px;' },
	        { leyenda: 'Observaciones', columna: 'n_short', style:'width:200px;' },
	        
	        { leyenda: 'Baja', style: 'width:50px;'},
	        
	    ],
	    modelo: [
	        { propiedad: 'id',class:'text-center' },
	        { formato: function(tr,obj,celda){
	        	if ( obj.estado == 'BAJA' ) {
	        		tr.css('background','red');
	        	}
	        	return '<ul>'+
	        				'<li> <b>Nombre:</b>'+obj.responsable+'</li>'+
	        				'<li> <b>Número de resguardo:</b>'+obj.n_resguardo+'</li>'+
	        				
	        		   '<ul>';
	        }},
	        { propiedad: 'placas'},
	        { formato: function(tr,obj,celda){
	        	return '<ul>'+
	        				'<li>'+'<label>Tipo:</label> '+obj.tip+'</li>'+
	        				'<li>'+'<label>Marca:</label> '+obj.mar+'</li>'+
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
	        	if ( obj.estado != 'BAJA' ) {
		        	return anexGrid_boton({
		        		class: 'btn btn-warning btn-flat',
		        		contenido: '<i class="fa fa-arrow-down"></i>',
		        		attr: [
	                    	'onclick="modal_baja_v('+obj.id+');"',
	                    	'title=" DAR DE BAJA EL VEHÍCULO"'
	                	]
		        	});
	        	}
	        	
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
	        	if ( obj.estado == 'Baja' ) {
	        		tr.addClass('bg-red-active');
	        		return anexGrid_dropdown({
	        			id:'opciones',
	        			class: 'btn btn-warning btn-flat',
	        			contenido: '<i class="fa fa-gears"></i>',
	        			data:[{
	        				href:'index.php?menu=add_taller&taller='+id,contenido:'Editar'
	        			}]
	        		});
	        	}else{
	        		return anexGrid_dropdown({
	        			id:'opciones',
	        			class: 'btn btn-warning btn-flat',
	        			contenido: '<i class="fa fa-gears"></i>',
	        			data:[{
	        				href:'javascript:deleteTaller('+id+');',contenido:'Dar de baja'
	        			},{
	        				href:'index.php?menu=add_taller&taller='+id,contenido:'Editar'
	        			}]
	        		});
	        	}
	        	
	        	
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
/*Listado completo de choferes*/
function all_choferes(){
	var choferes = {
	    class: 'table-striped table-bordered table-hover',
	    columnas: [
	        { leyenda: 'ID', class:'text-center', style: 'width:50px;', columna: 'id',ordenable:true },
	        { leyenda: 'Nombre completo', style: 'width:200px;' },
	        { leyenda: 'Área', columna: 'n_short', style:'width:200px;' },
	        { leyenda: 'Datos de la licencia', columna: 'n_short', style:'width:200px;' },
	        { leyenda: 'Actualizar licencia', columna: 'n_short', style:'width:10px;' },
	        { leyenda: 'Descargar licencia', columna: 'n_short', style:'width:10px;' },
	        { leyenda: 'Eliminar', style: 'width:10px;'},
	        
	    ],
	    modelo: [
	        { propiedad: 'id',class:'text-center' },
	        { propiedad: 'chofer' },
	        { propiedad: 'area'},
	        { formato: function(tr,obj,celda){
	        	return '<ul>'+
	        				'<li>'+'<label>Fecha de expedición:</label> '+obj.f_expedicion+'</li>'+
	        				'<li>'+'<label>Fecha de vencimiento:</label> '+obj.f_vencimiento+'</li>'+
	        				'<li>'+'<label>Estado de licencia:</label> '+obj.estado+'</li>'+
	        				'<li>'+'<label>Tipo:</label> '+obj.tipo+'</li>'+
	        				'<li>'+'<label>Número:</label> '+obj.numero+'</li>'+
	        		   '<ul>';
	        }},
	        {class:'text-center', formato: function(tr,obj,celda){
	        	return anexGrid_boton({
	        		class: 'btn btn-primary btn-flat',
	        		contenido: '<i class="fa fa-refresh"></i>',
	        		attr: [
	        			'data-toggle="modal"', 'data-target="#modal_update_licencia"'
                	]
	        	});
	        }},
	        
	        { class:'text-center', formato:function(tr,obj,celda){
	        	return anexGrid_boton({
	        		class: 'btn btn-warning btn-flat',
	        		contenido: '<i class="fa fa-arrow-down"></i>',
	        		
	        	});
	        } },
	        { class:'text-center', formato:function(tr,obj,celda){
	        	return anexGrid_boton({
	        		class: 'btn btn-danger btn-flat',
	        		contenido: '<i class="fa fa-trash"></i>',
	        	});
	        } },
	    ],
	    url: 'controller/puente.php?option=18',
	    type:'POST',
	    limite: [10,20,50,100],
	    columna: 'id',
	    columna_orden: 'DESC',
	    paginable:true

	};
	$("#all_choferes").anexGrid(choferes);
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
function frm_baja_v() {
	$('#frm_baja_v').submit(function(e) {
		e.preventDefault();
		var archivos = document.getElementsByName("archivo[]"); 
		var dataForm = new FormData(document.getElementById("frm_baja_v"));
		//var size = document.getElementById("archivo").files[0].size;
		var validate_size = false;

		for (var i = 0; i < archivos.length; i++) {
			var size = archivos[i].files[0].size;
			if ( size > 10485760) {
				validate_size = true;
			}
		}
		//alert( validate_size );
		if (validate_size == true) {
			$('#alert_baja_v').removeClass('hidden');
			$('#alert_baja_v').addClass('alert-danger');
			$('#a_baja_v_estado').text('ERROR!');
			$('#a_baja_v_message').text('ALGUNO DE LOS ARCHIVO(S) SELECCIONADO(S) EXCEDE EL TAMAÑO ADMITIDO (10MB).');
			setTimeout(function(){
				$('#alert_baja_v').addClass('hidden');
				$('#alert_baja_v').removeClass('alert-danger');
				$('#a_baja_v_estado').text('');
				$('#a_baja_v_message').text('');

			},5000);
		}else{
			//
			$.ajax({
				url: 'controller/puente.php',
				type: 'POST',
				dataType: 'json',
				data: dataForm,
				async:false,
				cache:false,
				processData: false,
				contentType: false,
			})
			.done(function(response) {
				var clase, mensaje,estado;
				if (response.status == 'error') {
					clase = 'alert-danger';
					mensaje = response.message;
					estado = 'ERROR!';
				}else{
					clase = 'alert-success';
					mensaje = response.message;
					estado = 'ÉXITO!';
				}
				$('#alert_baja_v').removeClass('hidden');
				$('#alert_baja_v').addClass(clase);
				$('#a_baja_v_estado').text(estado);
				$('#a_baja_v_message').text( mensaje );
				setTimeout(function(){
					$('#alert_baja_v').addClass('hidden');
					$('#alert_baja_v').removeClass(clase);
					$('#a_baja_v_estado').text('');
					$('#a_baja_v_message').text('');
					$('#modal_baja_v').modal('toggle');
					all_cars();
				},5000);
			})
			.fail(function(jqXHR,textStatus,errorThrown) {
				alert(jqXHR.responseText);
			});
		}
	});
}
function baja_veh(){
	$.ajax({
		url: 'controller/puente.php',
		type: 'POST',
		dataType: 'json',
		data: {option: '12',v:vehiculo},
		cache:false,
		async:false,
	})
	.done(function( response ) {
		alerta(response.status,response.message);
	})
	.fail(function() {
		console.log("error");
	});
	
	return false;
}
/*Abrir modal de baja vehicular*/
function modal_baja_v(v) {
	$('#vehiculo_id').val( v );
	$('#modal_baja_v').modal('toggle');
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
	var respuesta = confirm('¿Seguro que quieres dar de baja el taller con ID '+taller+'?');
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
		async:false,
		cache:false,
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
			/*AGREGAR LAS REPARACIONES*/
			$('#reparaciones').html('');
			$.each(response.reparaciones, function(i, val) {
				$('#reparaciones').append('<li><b>Falla: </b>'+val.falla+ ' <b>reparado por</b> '+val.taller+'.</li>');
			});
			$('#resguardatario').val(response.vehiculo.name_reguardatario);
			$('#area_sol').val(response.solicitud.area);
			$('#name_sol').val(response.solicitud.name_sol);
			$('#placas').val(response.vehiculo.placas);
			//Agregar la info de la solicitud atendida
			if ( response.atendida.estado == 'empty' ) {
				$('#btn_atender').removeClass('hidden');
				$('#btn_ingreso').removeClass('hidden');
			}else{

				if (response.atendida.estado == "Reparado" || response.atendida.estado == "Entregado") {$('#btn_final').addClass('hidden');}
				if (response.atendida.estado == "Entregado") {$('#btn_entrega').addClass('hidden');}
				$('#ingreso_id').val(response.atendida.id);
				$('#f_auto').val(response.atendida.f_ingreso);
				$('#f_salida').val(response.atendida.f_salida);
				$('#h_salida').val(response.atendida.h_salida);
				$('#h_entrada').val(response.atendida.h_ingreso);
				$('#desc_hv').val(response.atendida.observaciones);
			}
			//Agregar los siniestros
			$('#list_siniestros').html('');
			if (response.siniestro.estado == 'empty') {
				$('#list_siniestros').html('');
			}else{
				$.each(response.siniestro, function(i, val) {
					$('#list_siniestros').append(
						'<li>  '+val.aseguradora+
						'<ol type="a">'+
							
							'<li> <label> Fecha de hechos: </label> '+val.f_hechos+'</li>'+
							'<li> <label> Entró al taller el:  </label> '+val.f_entrada+'</li>'+
							'<li> <label> Salió del taller el:  </label> '+val.f_salida+'</li>'+
							'<li> <label> Observaciones: </label> '+val.observaciones+'</li>'+
						'</ol></li>'
					);
				});
			}
			
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
	$('#modal_atender_solicitud').modal('toggle');
}
function getTipoFalla(id,fallas) { //Obtener t_fallas (BD)
	$('#'+id).html('');
	$.post('controller/puente.php', {option: '21'}, function(data, textStatus, xhr) {
		$('#'+id).append('<option value="">...</option>');
		$.each(data, function(i, val) {
			$('#'+id).append('<option value="'+val.id+'">'+val.nombre+'</option>');
		});
	},'json');
	$('#'+id).change( function(e){
		e.preventDefault();
		getFallas( fallas,$(this).val() );
	} );
	return false;
}
function getFallas( id,tipo ){// Obtener catalogo_fallas (BD)
	$('#'+id).html('');
	$.post('controller/puente.php', {option: '20',t:tipo}, function(data, textStatus, xhr) {
		$('#'+id).append('<option value="">...</option>');
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
/*Obtener la lista de talleres*/
function getTalleres(select) {
	$('#'+select).html('');
	$('#'+select).append('<option value="">...</option>');
	$.post('controller/puente.php', {option: '22'}, function(data, textStatus, xhr) {
		$.each(data, function(i, val) {
			$('#'+select).append('<option value="'+val.id+'">'+val.nombre+'</option>');
		});
	},'json');
	return false;
}
function add_reparacion() {
	//Recuperar la solicitud 
	$('#modal_add_reparacion').modal('toggle');
	getTipoFalla('t_falla','falla');
	getTalleres('taller');
}
/*Guardar la reparacion de la solicitud*/
function frm_add_reparacion() {
	$('#frm_add_reparacion').submit(function(event) {
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
			$('#alert_modal_add_rep').removeClass('hidden');
			$('#alert_modal_add_rep').addClass(clase_estado);
			$('#a_mod_add_rep_estado').text(label_estado);
			$('#a_mod_add_rep_message').text(response.message);
			setTimeout(function(){
				$('#alert_modal_add_rep').addClass('hidden');
				$('#alert_modal_add_rep').removeClass(clase_estado);
				$('#a_mod_add_rep_estado').text('');
				$('#a_mod_add_rep_message').text('');
				document.getElementById('frm_add_reparacion').reset();
				$('#modal_add_reparacion').modal('toggle');
				
			},5000);
		})
		.fail(function(jqXHR,textStatus,errorThrown) {
			label_estado = 'ERROR!';
			clase_estado = 'alert-danger';

			$('#alert_modal_add_rep').removeClass('hidden');
			$('#alert_modal_add_rep').addClass(clase_estado);
			$('#a_mod_add_rep_estado').text(label_estado);
			$('#a_mod_add_rep_message').text(jqXHR.responseText);
			setTimeout(function(){
				$('#alert_modal_add_rep').addClass('hidden');
				$('#alert_modal_add_rep').removeClass(clase_estado);
				$('#a_mod_add_rep_estado').text('');
				$('#a_mod_add_rep_message').text('');
				document.getElementById('frm_add_reparacion').reset();
				$('#modal_add_reparacion').modal('toggle');
			},5000);
		});
		
	});
	return false;
}
//Crear un campo  de tipo de falla
function add_campo_falla() {
	var campo = 
	'<div class="row">'+
		'<div class="col-md-12">'+
			'<div class="form-group">'+
				'<label>Falla</label>'+
				'<input type="text" name="fallas[]" class="form-control">'+
			'</div>'+
		'</div>'+
	'</div>';
	$('#div_fallas').append(campo);
	return false;
}

//Mostrar modal de Agregar falla
function modal_add_falla() {
	$('#modal_add_fallas').modal('toggle');
	return false;
}

function frm_add_fallas() {
	$('#frm_add_fallas').submit(function(e) {
		e.preventDefault();
		var dataForm = $(this).serialize();
		$.ajax({
			url: 'controller/puente.php',
			type: 'POST',
			dataType: 'json',
			data: dataForm,
			async:false,
			cache:false,
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
			$('#alert_modal_add_fallas').removeClass('hidden');
			$('#alert_modal_add_fallas').addClass(clase_estado);
			$('#a_mod_add_fallas_estado').text(label_estado);
			$('#a_mod_add_fallas_message').text(response.message);
			setTimeout(function(){
				$('#alert_modal_add_fallas').addClass('hidden');
				$('#alert_modal_add_fallas').removeClass(clase_estado);
				$('#a_mod_add_fallas_estado').text('');
				$('#a_mod_add_fallas_message').text('');
				document.getElementById('frm_add_fallas').reset();
				$('#modal_add_fallas').modal('toggle');
				
			},5000);
		})
		.fail(function(jqXHR,textStatus,errorThrown) {
			alert("Error encontrado: "+ jqXHR.responseText);
		});
		
	});
	return false;
}
//Guardar el ingreso al taller 
function frm_ingreso() {
	$('#frm_ingreso').submit(function(e) {
		e.preventDefault();
		var dataForm = $(this).serialize();
		$.ajax({
			url: 'controller/puente.php',
			type: 'POST',
			dataType: 'json',
			data: dataForm,
			async:false,
			cache:false
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
			$('#alert_modal_add_ingreso').removeClass('hidden');
			$('#alert_modal_add_ingreso').addClass(clase_estado);
			$('#a_mod_ingreso_estado').text(label_estado);
			$('#a_mod_ingreso_message').text(response.message);
			setTimeout(function(){
				$('#alert_modal_add_ingreso').addClass('hidden');
				$('#alert_modal_add_ingreso').removeClass(clase_estado);
				$('#a_mod_ingreso_estado').text('');
				$('#a_mod_ingreso_message').text('');
				document.getElementById('frm_add_fallas').reset();
				$('#modal_ingreso').modal('toggle');
				document.getElementById('frm_ingreso').reset();
			},5000);
		})
		.fail(function(jqXHR,textStatus,errorThrown) {
			alert("Error: "+jqXHR.responseText);
		});
		
	});
}

/**/
function frm_ingreso_fin() {
	$('#frm_ingreso_fin').submit(function(e) {
		e.preventDefault();
		var dataForm = $(this).serialize();
		$.ajax({
			url: 'controller/puente.php',
			type: 'POST',
			dataType: 'json',
			data: dataForm,
			async:false,
			cache:false
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
			$('#alert_modal_ingreso_fin').removeClass('hidden');
			$('#alert_modal_ingreso_fin').addClass(clase_estado);
			$('#a_mod_ingreso_fin_estado').text(label_estado);
			$('#a_mod_ingreso_fin_message').text(response.message);
			setTimeout(function(){
				$('#alert_modal_ingreso_fin').addClass('hidden');
				$('#alert_modal_ingreso_fin').removeClass(clase_estado);
				$('#a_mod_ingreso_fin_estado').text('');
				$('#a_mod_ingreso_fin_message').text('');
				$('#modal_ingreso_fin').modal('toggle');
				document.getElementById('frm_ingreso_fin').reset();
				getDetalleSol( $('#solicitud_id').val() );
			},5000);
		})
		.fail(function(jqXHR,textStatus,errorThrown) {
			alert("Error: "+jqXHR.responseText);
		});
	});
	return false;
}
function eventos_programados() {
	init_events($('#external-events div.external-event'))
	var date = new Date()
	//Date for the calendar events (dummy data)
	var d    = date.getDate(),
	    m    = date.getMonth(),
	    y    = date.getFullYear();

	$('#calendar').fullCalendar({
		lang: 'es',
    	header    : {
    		left  : 'prevYear,prev,next,nextYear today',
    		center: 'title',
    		right : 'addEventButton'
    		//right : 'month,agendaWeek,agendaDay'
    	},
    	buttonText: {
    		today: 'Hoy',
    		month: 'Mes',
    	},
    	buttonIcons:{
    		prev: 'left-single-arrow',
			next: 'right-single-arrow',
			prevYear: 'left-double-arrow',
			nextYear: 'right-double-arrow'
    	},
    	themeButtonIcons:{
			prev: 'circle-triangle-w',
			next: 'circle-triangle-e',
			prevYear: 'seek-prev',
			nextYear: 'seek-next'
		},
		dayClick:function(date, jsEvent, view){
			console.log(jsEvent);
		},
    	eventSources: [
			{
			  /*events: [
			    {
			    	title  : 'event1',
			    	start  : '2019-11-01',
			    	className:'bg-green',
			    }
			  ]*/
			}
		],
	    editable  : true,
		droppable : true, // this allows things to be dropped onto the calendar !!!
		drop      : function (date, allDay) { // this function is called when something is dropped
			console.log( $(this).data('eventObject') );
			// retrieve the dropped element's stored Event Object
			var originalEventObject = $(this).data('eventObject');
			// we need to copy it, so that multiple events don't have a reference to the same object
			var copiedEventObject = $.extend({}, originalEventObject);
			// assign it the date that was reported
			copiedEventObject.start           = date;
			copiedEventObject.allDay          = allDay;
			copiedEventObject.backgroundColor = $(this).css('background-color');
			copiedEventObject.borderColor     = $(this).css('border-color');
			// render the event on the calendar
			$('#calendar').fullCalendar('renderEvent', copiedEventObject, true);		
		},
		eventClick: function(calEvent, jsEvent, view) {
    		alert('Título: ' + calEvent.title);
    		// change the border color just for fun
    		$(this).css('border-color', 'red');
  		},
  		customButtons: {
      		addEventButton: {
	        	text: 'Agendar evento',
		        click: function() {
		        	$('#modal_eventos').modal('toggle');
			    },
     		},
     		next: {
		        click: function() {
		        	$('#calendar').fullCalendar('next');
		        	getEventos();
			    },
     		},
     		prev: {
		        click: function() {
		        	$('#calendar').fullCalendar('prev');
		        	getEventos();
			    },
     		},


    	},

	});
	getEventos();
}
/* initialize the external events*/
function init_events(ele) {
	ele.each(function () {
	    // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
	    // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
      	}
	    // store the Event Object in the DOM element so we can get to it later
	    $(this).data('eventObject', eventObject);

	    // make the event draggable using jQuery UI
	    $(this).draggable({
	        zIndex        : 1070,
	        revert        : true, // will cause the event to go back to its
	        revertDuration: 0  //  original position after the drag
	    });

	});
}
/*Formulario de eventos del calendario*/
function frm_eventos() {
	$('#frm_eventos').submit(function(e) {
		e.preventDefault();
		var dataForm = $(this).serialize();
		$.ajax({
			url: 'controller/puente.php',
			type: 'POST',
			dataType: 'json',
			data: dataForm,
			async: false,
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
			$('#alert_eventos').removeClass('hidden');
			$('#alert_eventos').addClass(clase_estado);
			$('#a_mod_eventos_estado').text(label_estado);
			$('#a_mod_eventos_message').text(response.message);
			setTimeout(function(){
				$('#alert_eventos').addClass('hidden');
				$('#alert_eventos').removeClass(clase_estado);
				$('#a_mod_eventos_estado').text('');
				$('#a_mod_eventos_message').text('');
				$('#modal_eventos').modal('toggle');
				document.getElementById('frm_eventos').reset();
				//Actualizar la lista de eventos
				document.location.reload();
				
			},5000);
		})
		.fail(function(jqXHR,textStatus,errorThrown) {
			alert(jqXHR.responseText);
		});
	});
}
/*Recuperar la lista de eventos*/
function getEventos() {
	$.ajax({
		url: 'controller/puente.php',
		type: 'POST',
		dataType: 'json',
		data: {option: '28'},
		async:false,
		cache:false,
	})
	.done(function(response) {
		//Poner los eventos en el calendario.
		$.each(response, function(i, val) {
			if ( val.tipo_evento == 'Verificación' ) {
				clase = 'bg-green';
			}else{
				clase = 'bg-red';
			}
			$('#calendar').fullCalendar('renderEvent', {
				title: val.titulo,
				start: val.fecha,
				allDay: true,
				className:clase,
			});
		});
	})
	.fail(function(jqXHR,textStatus,errorThrown) {
		alert( jqXHR.responseText );
	});
}
/*Evento para entregar vehiculo*/
function entregarVehiculo() {
	var s = $('#solicitud_id').val();
	$.post('controller/puente.php', {option: '29',s:s}, function(data, textStatus, xhr) {
		alert(data.message);
	},'json');
	return false;
}
/*Formulario de cotizar*/
function frm_cotizar() {
	$('#frm_cotizar').submit(function(e) {
		e.preventDefault();
		var dataForm = new FormData(document.getElementById("frm_cotizar"));
		var size = document.getElementById("archivo").files[0].size;
		if (size > 10485760 ) {
			$('#alert_cotizar').removeClass('hidden');
			$('#alert_cotizar').addClass('alert-danger');
			$('#a_mod_cotizar_estado').text('ERROR!');
			$('#a_mod_cotizar_message').text('EL ARCHIVO SELECCIONADO EXCEDE EL TAMAÑO ADMITIDO (10MB).');
			setTimeout(function(){
				$('#alert_cotizar').addClass('hidden');
				$('#alert_cotizar').removeClass('alert-danger');
				$('#a_mod_cotizar_estado').text('');
				$('#a_mod_cotizar_message').text('');
				$('#modal_cotizar').modal('toggle');
			},5000);
		}else{
			$.ajax({
				url: 'controller/puente.php',
				type: 'POST',
				dataType: 'json',
				data: dataForm,
				async:false,
				cache:false,
				processData: false,
				contentType: false,
			})
			.done(function(response) {
				var clase, mensaje,estado;
				if (response.status == 'error') {
					clase = 'alert-danger';
					mensaje = response.message;
					estado = 'ERROR!';
				}else{
					clase = 'alert-success';
					mensaje = response.message;
					estado = 'ÉXITO!';
				}
				$('#alert_cotizar').removeClass('hidden');
				$('#alert_cotizar').addClass(clase);
				$('#a_mod_cotizar_estado').text(estado);
				$('#a_mod_cotizar_message').text( mensaje );
				setTimeout(function(){
					$('#alert_cotizar').addClass('hidden');
					$('#alert_cotizar').removeClass(clase);
					$('#a_mod_cotizar_estado').text('');
					$('#a_mod_cotizar_message').text('');
					$('#modal_cotizar').modal('toggle');
				},5000);
			})
			.fail(function(jqXHR,textStatus,errorThrown) {
				alert(jqXHR.responseText);
			});
		}
		
		
	});
}
/*fORMULARIO DE ENTREGA DE VEHICULO*/
function frm_entrega() {
	$('#frm_entrega').submit(function(e) {
		e.preventDefault();
		var dataForm = $(this).serialize();
		$.ajax({
			url: 'controller/puente.php',
			type: 'POST',
			dataType: 'json',
			data: dataForm,
			async: false,
			cache: false,
		})
		.done(function(response) {
			var clase, mensaje,estado;
			if (response.status == 'error') {
				clase = 'alert-danger';
				mensaje = response.message;
				estado = 'ERROR!';
			}else{
				clase = 'alert-success';
				mensaje = response.message;
				estado = 'ÉXITO!';
			}
			$('#alert_entrega').removeClass('hidden');
			$('#alert_entrega').addClass(clase);
			$('#a_mod_entrega_estado').text(estado);
			$('#a_mod_entrega_message').text( mensaje );
			setTimeout(function(){
				$('#alert_entrega').addClass('hidden');
				$('#alert_entrega').removeClass(clase);
				$('#a_mod_entrega_estado').text('');
				$('#a_mod_entrega_message').text('');
				$('#modal_entrega').modal('toggle');
			},5000);
		})
		.fail(function(jqXHR,textStatus,errorThrown) {
			alert("Error: "+jqXHR.responseText);
		});
		
	});
	return false;
}

/*Autocompletao de personal de la unidad de asuntos internos */
function autocompletado(input,hidden) {
	$('#'+input).autocomplete({
		source: "controller/puente.php?option=9",
		minLength: 2,
		select: function( event, ui ) {
        	$('#'+hidden).val(ui.item.id);
      	},
	});
	return false;
}
/**/
function add_field_baja()
{
	if ( $('.file').length < 5 ) {
		$('#documentos').append(
			'<div class="row">'+
				'<div class="col-md-4">'+
					'<div class="form-group">'+
						'<label>Tipo de documento</label>'+
						'<select name="t_doc[]"  class="form-control">'+
							'<option value=""></option>'+
							'<option value="1">Acta de baja</option>'+
							'<option value="2">Documento de Siniestro</option>'+
							'<option value="3"> Dictamen taller </option>'+
						'</select>'+
					'</div>'+
				'</div>'+
				'<div class="col-md-8">'+
					'<div class="form-group">'+
						'<label>Buscar documento</label>'+
						'<input type="file" id="archivo" name="archivo[]" value="" class="form-control file" accept="application/pdf" required>'+
					'</div>'+
				'</div>'+
			'</div>'
		);
	}else{
		$('#alert_baja_v').removeClass('hidden');
		$('#alert_baja_v').addClass('alert-danger');
		$('#a_baja_v_estado').text('ERROR!');
		$('#a_baja_v_message').text('EL LIMITE DE ARCHIVOS ES DE 5!');
		location.href = '#alert_baja_v'; 
		setTimeout(function(){
			$('#alert_baja_v').addClass('hidden');
			$('#alert_baja_v').removeClass('alert-danger');
			$('#a_baja_v_estado').text('');
			$('#a_baja_v_message').text('');
		},5000);	
	}
	
	return false;
}
function frm_historico_es() {
	$('#frm_historico_es').submit(function(e) {
		e.preventDefault();
		var inicio, fin ;
		inicio 	= $('#f_inicio').val();
		fin 	= $('#f_fin').val();
		var es = {
		    class: 'table-striped table-bordered',
		    columnas: [
		        { leyenda: 'ID', class:'text-center', style: 'width:50px;', columna: 'id',ordenable:true },
		        { leyenda: 'Vehículo', style: 'width:100px;', ordenable:false,filtro:false },
		        { leyenda: 'Datos salida', style:'width:100px;',ordenable:false },
		        { leyenda: 'Datos de entrada', style:'width:200px;' },
		        { leyenda: 'Observaciones', style:'width:200px;',ordenable:false, filtro:false },
		    ],
		    modelo: [
		        { propiedad: 'id'},
		        {  formato:function (tr,obj,celda) {
		        	return  '<ul>'+
		        			'<li> <b>PLACAS:</b> '+obj.placa+'</li>'+
		        			'<li> <b>MARCA:</b> '+obj.marca+'<l/i>'+
		        			'<li> <b>TIPO:</b> '+obj.t_vehiculo+'</li>'+
		        			'<li> <b>¿QUIEN CONDUCE?:</b> '+obj.chofer+'</li>'+
		        		'</ul>';
		        	} 
		        },
		       {  formato:function (tr,obj,celda) {
		        	return  '<ul>'+
		        			'<li> <b>FECHA Y HORA:</b> '+obj.salida+'</li>'+
		        			'<li> <b>NIVEL DE GAS:</b> '+obj.gas_salida+' % <l/i>'+
		        			'<li> <b>KILOMETRAJE:</b> '+obj.km_salida+'</li>'+
		        		'</ul>';
		        	} 
		        },
		       {formato:function (tr,obj,celda) {
			       	if ( obj.entrada != null ) {
			       		return  '<ul>'+
			       				'<li> <b>FECHA Y HORA:</b> '+obj.entrada+'</li>'+
			       				'<li> <b>NIVEL DE GAS:</b> '+obj.gas_entrada+' % <l/i>'+
			       				'<li> <b>KILOMETRAJE:</b> '+obj.km_entrada+'</li>'+
			       			'</ul>';
			       	}else{
			       		return  '<ul>'+
		        			'<li> <b>FECHA Y HORA:</b> SIN REGISTRAR</li>'+
		        			'<li> <b>NIVEL DE GAS:</b> SIN REGISTRAR <l/i>'+
		        			'<li> <b>KILOMETRAJE:</b> SIN REGISTRAR </li>'+
		        		'</ul>';
			       	}
		        	
		        }},
		       { propiedad: 'observaciones'}
		    ],
		    url: 'controller/puente.php?option=10',
		    type:'POST',
		    limite: [25,50,100],
		    columna: 'id',
		    columna_orden: 'DESC',
		    paginable:true,
		    filtrable: false,
		    parametros: {desde:inicio,hasta:fin}

		};
		$("#historico").anexGrid(es);	
	});
}
/*Recuperar las entradas y salidas de los vehiculos*/
function all_es() {
	var es = {
	    class: 'table-striped table-bordered',
	    columnas: [
	        { leyenda: 'ID', class:'text-center', style: 'width:50px;', columna: 'id',ordenable:true },
	        { leyenda: 'Vehículo', style: 'width:100px;', ordenable:false,filtro:false },
	        { leyenda: 'Datos salida', style:'width:100px;',ordenable:false },
	        { leyenda: 'Datos de entrada', style:'width:200px;' },
	        { leyenda: 'Observaciones', style:'width:200px;',ordenable:false, filtro:false },
	    ],
	    modelo: [
	        { propiedad: 'id'},
	        {  formato:function (tr,obj,celda) {
	        	return  '<ul>'+
	        			'<li> <b>PLACAS:</b> '+obj.placa+'</li>'+
	        			'<li> <b>MARCA:</b> '+obj.marca+'<l/i>'+
	        			'<li> <b>TIPO:</b> '+obj.t_vehiculo+'</li>'+
	        			'<li> <b>¿QUIEN CONDUCE?:</b> '+obj.chofer+'</li>'+
	        		'</ul>';
	        	} 
	        },
	       {  formato:function (tr,obj,celda) {
	        	return  '<ul>'+
	        			'<li> <b>FECHA Y HORA:</b> '+obj.salida+'</li>'+
	        			'<li> <b>NIVEL DE GAS:</b> '+obj.gas_salida+' % <l/i>'+
	        			'<li> <b>KILOMETRAJE:</b> '+obj.km_salida+'</li>'+
	        		'</ul>';
	        	} 
	        },
	       {formato:function (tr,obj,celda) {
		       	if ( obj.entrada != null ) {
		       		return  '<ul>'+
		       				'<li> <b>FECHA Y HORA:</b> '+obj.entrada+'</li>'+
		       				'<li> <b>NIVEL DE GAS:</b> '+obj.gas_entrada+' % <l/i>'+
		       				'<li> <b>KILOMETRAJE:</b> '+obj.km_entrada+'</li>'+
		       			'</ul>';
		       	}else{
		       		return  '<ul>'+
	        			'<li> <b>FECHA Y HORA:</b> SIN REGISTRAR</li>'+
	        			'<li> <b>NIVEL DE GAS:</b> SIN REGISTRAR <l/i>'+
	        			'<li> <b>KILOMETRAJE:</b> SIN REGISTRAR </li>'+
	        		'</ul>';
		       	}
	        	
	        }},
	       { propiedad: 'observaciones'}
	    ],
	    url: 'controller/puente.php?option=10',
	    type:'POST',
	    limite: [25,50,100],
	    columna: 'id',
	    columna_orden: 'DESC',
	    paginable:true,
	    filtrable: false,

	};
	$("#es_today").anexGrid(es);
}
//Recuperar los tipos de documentos

function getTiposDoc() {
	var documentos;
	$.ajax({
		url: 'controller/puente.php',
		type: 'POST',
		dataType: 'json',
		data: {option: '34'},
		async:false,
	})
	.done(function(data) {
		documentos = data;
	})
	.fail(function() {
		console.log("error");
	});
	return documentos;
}
//Agregar campos de adjuntar documentos
function add_field_document(div_id) {
	if ( $('#'+div_id+'.file').length < 5 ) {
		var documentos = getTiposDoc();
		var options = "<option value=''>...</option>";
		$.each(documentos, function(i, doc) {
			options += "<option value='"+doc.id+"'>"+doc.nom+"</option>";
		});
		$('#'+div_id).append(
			'<div class="row">'+
				'<div class="col-md-6">'+
					'<div class="form-group">'+
						'<label>Tipo de documento</label>'+
						'<select name="tipo_doc[]"  class="form-control">'+
							options+
						'</select>'+
					'</div>'+
				'</div>'+
				'<div class="col-md-6">'+
					'<div class="form-group">'+
						'<label>Buscar documento</label>'+
						'<input type="file" id="archivo" name="archivo[]" value="" class="form-control file" accept="application/pdf" required>'+
					'</div>'+
				'</div>'+
			'</div>'
		);
	}else{
		$('#alert_baja_v').removeClass('hidden');
		$('#alert_baja_v').addClass('alert-danger');
		$('#a_baja_v_estado').text('ERROR!');
		$('#a_baja_v_message').text('EL LIMITE DE ARCHIVOS ES DE 5!');
		location.href = '#alert_baja_v'; 
		setTimeout(function(){
			$('#alert_baja_v').addClass('hidden');
			$('#alert_baja_v').removeClass('alert-danger');
			$('#a_baja_v_estado').text('');
			$('#a_baja_v_message').text('');
		},5000);	
	}
}
function frm_solicitud_historica() {
	$('#frm_solicitud_historica').submit(function(e) {
		e.preventDefault();
		var dataForm = new FormData(document.getElementById("frm_solicitud_historica"));
		$.ajax({
			url: 'controller/puente.php',
			type: 'POST',
			dataType: 'json',
			data: dataForm,
			async:false,
			cache: false,
			processData: false,
			contentType: false,
		})
		.done(function(response) {
			var clase, mensaje,estado;
			if (response.status == 'error') {
				clase = 'alert-danger';
				mensaje = response.message;
				estado = 'ERROR!';
			}else{
				clase = 'alert-success';
				mensaje = response.message;
				estado = 'ÉXITO!';
			}
			$('#alert_modal_solicitud_historica').removeClass('hidden');
			$('#alert_modal_solicitud_historica').addClass(clase);
			$('#a_mod_solicitud_historica_estado').text(estado);
			$('#a_mod_solicitud_historica_message').text( mensaje );
			setTimeout(function(){
				$('#alert_modal_solicitud_historica').addClass('hidden');
				$('#alert_modal_solicitud_historica').removeClass(clase);
				$('#a_mod_solicitud_historica_estado').text('');
				$('#a_mod_solicitud_historica_message').text('');
				//$('#modal_solicitud_historica').modal('toggle');
				//document.getElementById('frm_solicitud_historica').reset();
			},5000);

		})
		.fail(function(jqXHR,textStatus,errorThrown) {
			console.log("Error: "+jqXHR.responseText);
		});
		
	});
	return false;
}
function frm_add_chofer() {
	$('#frm_add_chofer').submit(function(e) {
		e.preventDefault();
		var dataForm = new FormData(document.getElementById("frm_add_chofer"));
		$.ajax({
			url: 'controller/puente.php',
			type: 'POST',
			dataType: 'json',
			data: dataForm,
			async:false,
			cache: false,
			processData: false,
			contentType: false,
		})
		.done(function(response) {
			alerta(response.status,response.message);
		})
		.fail(function(jqXHR,textStatus,errorThrown) {
			alert("Error: "+jqXHR.responseText);
		});
		
	});
	return false;
}