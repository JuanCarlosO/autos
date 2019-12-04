$(document).ready(function() {
	getURL();getUser();
});
/*Recuperar la pagina en la que se encuemntra*/
function getURL() {
	var url = window.location.search;
	$('[data-mask]').inputmask();
	if ( url == '?menu=general'  ) {
		$('#listado_sol').addClass('active');
		all_sol();
	}else if ( url == '?menu=listado_es' ){
		$('#listado_es').addClass('active');
		all_es();
		frm_historico_es();
	}

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
var personal,fallas,talleres;
/*Listado completo de solicitudes*/
function all_sol() {
	var jsonPerson = json_personal();
	var jsonFallas = json_fallas();
	var jsonTalleres = json_talleres();
	var sol = {
	    class: 'table-striped table-bordered table-hover',
	    columnas: [
	        { leyenda: 'ID', class:'text-center', style: 'width:50px;',ordenable:true, columna:'id' },
	        { leyenda: 'Folio',class:'text-center', style: 'width:150px;',filtro:true,columna:'s.folio' },
	        { leyenda: 'Fecha solicitud',class:'text-center', style: 'width:100px;' },
	        { leyenda: 'Placa',class:'text-center',columna:'placas', style: 'width:150px;',filtro:function(){
	        	return '<input type="text" id="placa" name="placa" required class="form-control" autocomplete="off">'+
	        	'<input type="hidden" id="placa_h" name="placa_h" required class="form-control">';
	        	
	        }},
	        { leyenda: 'Resguardatario', columna:'resguardatario', class:'text-center',filtro:function(){
	        	return anexGrid_select({
    	            data: jsonPerson
    	        });
	        }},
	        { leyenda: 'Kilometraje',class:'text-center', style: 'width:150px;',columna:'km',filtro:true },
        	{ leyenda: 'Tipo reparación',class:'text-center',columna:'r.falla',filtro:function(){
	        	return anexGrid_select({
    	            data: jsonFallas
    	        });
	        }},
	        { leyenda: 'Fecha salida',class:'text-center' },
	        { leyenda: 'Fecha entrada',class:'text-center' },
	        { leyenda: 'Taller', class:'text-center' ,columna:'r.taller', style: 'width:150px;',class:'text-center',filtro:function(){
	        	return anexGrid_select({
    	            data: jsonTalleres
    	        });
	        }},
	        { leyenda: 'Cotización',class:'text-center' },
	        { leyenda: 'Costo factura',class:'text-center' },
	        { leyenda: 'Fecha de pago',class:'text-center' },
	        { leyenda: 'Estatus',class:'text-center',columna:'estado',filtro:function(){
	        	return anexGrid_select({
    	            data: [{valor:'',contenido:''},{valor:1,contenido:'Pagado'},{valor:2,contenido:'Sin pagar'}],
    	        });
	        }},
	        { leyenda: 'Pagar' , class:'text-center'},
	        { leyenda: 'Documentos' , class:'text-center'},
	    ],
	    modelo: [
	    	{propiedad:'solicitudes.id'		, class:'text-center'},
	    	{propiedad:'solicitudes.folio'	, class:'text-center'},
	    	{propiedad:'solicitudes.f_sol'	, class:'text-center'},
	    	{ class:'text-center', formato: function(tr,obj,celda){
	    		return obj.data_vehiculo[0].placas;
	    	}},
	    	{ formato: function(tr,obj,celda){
	    		return obj.data_vehiculo[0].res_name;
	    	}},
	    	{ class:'text-center', formato: function(tr,obj,celda){
	    		return obj.data_vehiculo[0].km;
	    	}},
	    	{ class:'text-center', formato: function(tr,obj,celda){
	    		if( obj.fallas.estado == 'vacio' ){
	    			return obj.fallas.message;
	    		}else{
	    			return obj.fallas.nombre;
	    		}	    		
	    	}},
	    	{ class:'text-center', formato: function(tr,obj,celda){
	    		if( obj.ingreso_taller.estado == 'vacio' ){
	    			return obj.ingreso_taller.message;
	    		}else{
	    			return obj.ingreso_taller.f_salida;
	    		}
	    		
	    	}},
	    	{ class:'text-center', formato: function(tr,obj,celda){
	    		if( obj.ingreso_taller.estado == 'vacio' ){
	    			return obj.ingreso_taller.message;
	    		}else{
	    			return obj.ingreso_taller.f_salida;
	    		}
	    		
	    	}},
	    	{ class:'text-center', formato: function(tr,obj,celda){
	    		if( obj.fallas.estado == 'vacio' ){
	    			return obj.fallas.message;
	    		}else{
	    			return obj.fallas.r_social;
	    		}	    		
	    	}},
	    	{ class:'text-center', formato: function(tr,obj,celda){
	    		if( obj.cotizacion.estado == 'vacio' ){
	    			return obj.cotizacion.message;
	    		}else{
	    			return obj.cotizacion.monto;
	    		}	    		
	    	}},
	    	{ class:'text-center', formato: function(tr,obj,celda){
	    		if( obj.factura.estado == 'vacio' ){
	    			return obj.factura.message;
	    		}else{
	    			return obj.factura.total;
	    		}	    		
	    	}},
	    	{ class:'text-center', formato: function(tr,obj,celda){
	    		if( obj.factura.estado == 'vacio' ){
	    			return obj.factura.message;
	    		}else{
	    			return obj.factura.created_at;
	    		}	    		
	    	}},
	    	{ class:'text-center', formato: function(tr,obj,celda){
	    		if( obj.factura.estado == 'vacio' ){
	    			return obj.factura.message;
	    		}else{
	    			return obj.factura.estado;
	    		}	    		
	    	}},
	    	{ class:'text-center', formato: function(tr,obj,celda){
	    		if (obj.factura.estado != 'Pagado') {
	    			return '<button class="btn btn-success btn-flat" onclick="pagar_solicitud('+obj.solicitudes.id+');">'+
	    				'<i class="fa fa-dollar"></i>'+
	    				'<i class="fa fa-dollar"></i>'+
	    				'<i class="fa fa-dollar"></i>'+
	    			'</button>';
	    		}
	    	}},
	    	{ class:'text-center', formato: function(tr,obj,celda){
	    		return '<button class="btn btn-info btn-flat" onclick="modal_docs('+obj.solicitudes.id+');">'+
	    			'<i class="fa fa-eye"></i>'+
	    		'</button>';
	    	}},
	    	
	    ],
	    url: 'controller/puente.php?option=13',
	    limite: [20,50,100],
	    columna: 'id',
	    columna_orden: 'DESC',
	    paginable:true,
	    filtrable:true
	    
	};
	var table = $("#solicitudes").anexGrid(sol);
	autocomplete_placas();
	return table;
}

function json_personal() {
	$.ajax({
		url: 'controller/puente.php',
		type: 'POST',
		dataType: 'json',
		data: {option: '67'},
		async:false,
	})
	.done(function(response) {
		personal = response;
	})
	.fail(function() {
		console.log("error");
	});
	return personal;	
}
function json_fallas() {
	$.ajax({
		url: 'controller/puente.php',
		type: 'POST',
		dataType: 'json',
		data: {option: '68'},
		async:false,
	})
	.done(function(response) {
		fallas = response;
	})
	.fail(function() {
		console.log("error");
	});
	return fallas;	
}
function json_talleres() {
	$.ajax({
		url: 'controller/puente.php',
		type: 'POST',
		dataType: 'json',
		data: {option: '69'},
		async:false,
	})
	.done(function(response) {
		talleres = response;
	})
	.fail(function() {
		console.log("error");
	});
	return talleres;	
}

//Listado completo de entradas y salidas de vehculos 
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
function modal_docs(id) {
	$('[name="solicitud"]').val(id);
	$('#modal_docs').modal('toggle');
	return false;
}

function view_cotizacion (){
	var sol = $('[name="solicitud"]').val();
	$.ajax({
		url: 'controller/puente.php',
		type: 'POST',
		dataType: 'html',
		data: {option: '44', s:sol},
		async:false,
		cache:false,
	})
	.done(function(response) {
		$('#carga_doc').html(response);
	})
	.fail(function() {
		console.log("error");
	});
	
	$('#modal_view_doc').modal('toggle');
	return false;
}
function view_factura (){
	var sol = $('[name="solicitud"]').val();
	$.ajax({
		url: 'controller/puente.php',
		type: 'POST',
		dataType: 'html',
		data: {option: '45', s:sol},
		async:false,
		cache:false,
	})
	.done(function(response) {
		$('#carga_doc').html(response);
	})
	.fail(function() {
		console.log("error");
	});
	$('#modal_view_doc').modal('toggle');
	return false;
}
// Autocomplete lista de vehiculos 
function autocomplete_placas() {
	$('#placa').autocomplete({
        autoFocus:true,
        source: 'controller/puente.php?option=4',
        select: function( event, ui ){
            $('#placa_h').val(ui.item.id);
        },
        delay:300
    });
	return false;
}
function pagar_solicitud(solicitud) {
	$.ajax({
		url: 'controller/puente.php',
		type: 'POST',
		dataType: 'json',
		data: {option: '74',sol:solicitud},
		async:false
	})
	.done(function(response) {
		alerta(response.status,response.message);
		all_sol().refrescar();
	})
	.fail(function(jqXHR,textStatus,errorThrown) {
		alerta('error',jqXHR.responseText );
	});
	
	return false;
}

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
	//document.location.href = "#alerta";
	setTimeout(function(){
		$('#alerta').addClass('hidden');
		$('#alerta').removeClass(clase);
		$('#estado').text('');
		$('#message').text('');
		//location.reload();
	},5000);
}