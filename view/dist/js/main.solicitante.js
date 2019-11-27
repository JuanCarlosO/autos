$(document).ready(function() {
	$('[data-toggle="tooltip"]').tooltip();
	getURL();
	getUser();
	
});
/*RECUPERAR EL NOMBRE Y PERFIL DEL USUARIO*/
function getUser() {
	$.post('controller/puente.php', {option: '13'}, function(data, textStatus, xhr) {
		$('.profile_name').text(data.full_name);
	},'json');
	return false;
}
/*Funcion para salir*/
function logout() 
{
	location.href= 'login.php';
	return false;
}
/*Recuperar la pagina en la que se encuemntra*/
function getURL() {
	var URLsearch = window.location.search;
	if ( URLsearch == '?menu=general' || URLsearch == '?menu=list_sol' ) {
		$('#list_sol').addClass('active');
		/*Carga el listado completo de vehiculos*/
		all_cars();
	}
	else if ( URLsearch == '?menu=add_sol')
	{
		$('#add_sol').addClass('active');
		getMarcas();
		getTipos();
		autocomplete_personal();
		autocomplete_placas();
		save_solicitud();
		generateFolio();		
	}
	return false;
}
/*Listado completo de vehículos*/
function all_cars() {
	var cars = {
	    class: 'table-striped table-bordered',
	    columnas: [
	        { leyenda: 'ID', class:'text-center', style: 'width:50px;', columna: 'id',ordenable:true },
	        { leyenda: 'Folio', style: 'width:100px;', columna: 'id',ordenable:true },
	        { leyenda: 'Solicitante', columna: 'n_short', style:'width:100px;' },
	        { leyenda: 'Vehículo', columna: 'n_short', style:'width:200px;' },
	        { leyenda: 'Descripcion', columna: 'n_short', style:'width:200px;' },
	        { leyenda: 'Editar', style: 'width:50px;'},
	        
	        { leyenda: 'PDF', style: 'width:50px;'},
	        
	    ],
	    modelo: [
	        { propiedad: 'id',class:'text-center' },
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
	        { propiedad: 'descripcion'},
	        { class:'text-center', formato:function(tr,obj,celda){
	        	if ( obj.estado == 'Creada' ) {
	        		return anexGrid_boton({
		        		class: 'btn btn-success btn-flat',
		        		contenido: '<i class="fa fa-pencil"></i>',
		        		attr: [
	                    	'onclick="editar_sol('+obj.id+');"'
	                	]
	        		});
	        	}
	        } },
	        
	        { class:'text-center', formato:function(tr,obj,celda){
	        	return anexGrid_link({
	        		class: 'btn btn-default  btn-flat',
	        		contenido: '<i class="fa fa-file-pdf-o text-red" style="font-size:20px;"></i>',
	        		
                	href: 'controller/puente.php?option=17&sol='+obj.id,
                	target: '_blank'
		        });
	        	
	        } },
	    ],
	    url: 'controller/puente.php?option=1',
	    limite: [20,50,100],
	    columna: 'id',
	    columna_orden: 'DESC',
	    paginable:true,
	    //filtrable:true,
	};
	$("#all_cars").anexGrid(cars);
	//return false;
}
function getMarcas() {
	$.post('controller/puente.php', {option: '2'}, function(data, textStatus, xhr) {
		var obj = JSON.parse(data);
		$('#m_veh').append('<option value="">...</option>');
		$.each(obj, function(i, val) {
			$('#m_veh').append('<option value="'+val.id+'">'+val.nom+'</option>');
		});
	});
}
function getTipos(){
	$.post('controller/puente.php', {option: '3'}, function(data, textStatus, xhr) {
		var obj = JSON.parse(data);
		$('#t_veh').append('<option value="">...</option>');
		$.each(obj, function(i, val) {
			$('#t_veh').append('<option value="'+val.id+'">'+val.nom+'</option>');
		});
	});
}
function editar_sol(sol) {
	document.location.href = "index.php?menu=add_sol&solicitud="+sol;
	return false;
}
function eliminar_sol(sol) {
	var respuesta = confirm('¿Desea eliminar la solicitud # '+sol+'?');
	return false;
}

function getPDF(solicitud) {
	$.ajax({
		url: 'controller/puente.php',
		type: 'POST',
		//dataType: 'xml, json, script, or html',
		data: {option: '37'},
		async:false,
		cache:false
	})
	.done(function(response) {
		console.log(response);
		$('#pdf').load(response);
	})
	.fail(function() {
		console.log("error");
	});
	
}

function error_solicitud() 
{
	alert('No es posible cargar la edicion de esta solicitud');
}
//Autocomplete lista del personal 
function autocomplete_personal() {
	$('#solicitante_name').autocomplete({
        autoFocus:true,
        source: 'controller/puente.php?option=3',
        select: function( event, ui ){

            if ( ui.item.id == 0 ) {
            	$('#solicitante_h').val("");
            	$(this).val('');
            }else{
            	$('#solicitante_h').val(ui.item.id);
            }
        },
        delay:300,
        search:function(event , ui){
        	$('#solicitante_h').val("");
        }
    });
	return false;
}
// Autocomplete lista de vehiculos 
function autocomplete_placas() {
	$('#placa').autocomplete({
        autoFocus:true,
        source: 'controller/puente.php?option=4',
        select: function( event, ui ){
            $('#placa_h').val(ui.item.id);
            detalle_v(ui.item.id);
        },
        delay:300
    });
	return false;
}
// Recuperar el detalle de un vehiculo 
function detalle_v( vehiculo ) {
	var data_vehiculo ;
	$.ajax({
		url: 'controller/puente.php',
		type: 'POST',
		dataType: 'json',
		data: {option: '5',v:vehiculo},
		cache:false,
		async:false,
	})
	.done(function(request) {
		if ( request.estado == 'error' ) {
			$('#message').text(request.message);
			$('#alerta').addClass('alert-danger');
			setTimeout(function(){
				$('#message').text('');
				$('#alerta').removeClass('alert-danger');
			},5000);
		}else{
			$('#number_placa').text( request.placas );
			$('#name_color').text( request.color );
			$('#cve_serie').text( request.n_motor );
			$('#num_cil').text( request.cil );
			$('#resguardatario').val(request.resguardatario);
			$('#resguardatario_h').val(request.resguardatario_id);
		}
	})
	.fail(function() {
		console.log("error");
	});
	
	return false;
}

function save_solicitud(){
	$('#frm_add_sol').submit(function(e){
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
		.done(function(request) {
			alerta( request.status,request.message );
		})
		.fail(function(jqXHR, textStatus,errorThrow) {
			alerta('error',jqXHR.responseText );
		});
		
		
	});
	return false;
}

//Generador de folio
function generateFolio () {
	var logger = $('#logger').val();
	$.post('controller/puente.php', {option: '7',p:logger}, function(data, textStatus, xhr) {
		if (textStatus == 'success') {
			var fecha = new Date();
			var folio;
			if ( data.length == 1 ) {
				folio = '000'+data;
			}else if (data.length == 2){
				folio = '00'+data;
			}else if (data.length > 2){
				folio = '0'+data;
			}
			folio += '-'+fecha.getFullYear();
			$('#folio').val(folio);
		}
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