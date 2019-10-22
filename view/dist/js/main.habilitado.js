$(document).ready(function() {
	console.log('Bienvenido al Habilitado Vehícular');
	/*Cargar los tooltip*/
	$('[data-toggle="tooltip"]').tooltip(); 
	getURL();
});

/*Recuperar la pagina en la que se encuemntra*/
function getURL() {
	var URLsearch = window.location.search;
	if ( URLsearch == '?menu=list_sol'  ) {
		$('#list_sol').addClass('active');
		/*Carga el listado completo de vehiculos*/
		all_sol();
	}else if ( URLsearch == '?menu=list_car' || URLsearch == '?menu=general' ) {
		$('#list_car').addClass('active');
		/*Carga el listado completo de vehiculos*/
		all_cars();
	}else if ( URLsearch == '?menu=add_car' ) {
		$('#add_car').addClass('active');
		frm_add_car();//Agregar vehiculos
		getMarcas();
		getTipos();
	}

	return false;
}
/*Listado completo de solicitudes*/
function all_sol() {
	var sol = {
	    class: 'table-striped table-bordered',
	    columnas: [
	        { leyenda: 'ID', class:'text-center', style: 'width:50px;', columna: 'id',ordenable:true },
	        { leyenda: 'Folio', style: 'width:100px;', columna: 'id',ordenable:true },
	        { leyenda: 'Solicitante', columna: 'n_short', style:'width:100px;' },
	        { leyenda: 'Vehículo', columna: 'n_short', style:'width:200px;' },
	        { leyenda: 'Descripcion', columna: 'n_short', style:'width:200px;' },
	        { leyenda: 'Editar', style: 'width:50px;'},
	        { leyenda: 'Eliminar', style: 'width:50px;'},
	        
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
	        	if ( obj.estado == 'Creada' ) {
		        	return anexGrid_boton({
		        		class: 'btn btn-danger btn-flat',
		        		contenido: '<i class="fa fa-trash"></i>',
		        		attr: [
	                    	'onclick="eliminar_sol('+obj.id+');"'
	                	]
		        	});
	        	}
	        	
	        } },
	    ],
	    url: 'controller/puente.php?option=1',
	    limite: [20,50,100],
	    columna: 'id',
	    columna_orden: 'DESC',
	    paginable:true,
	    //filtrable:true,
	};
	$("#all_cars").anexGrid(sol);
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
	        { leyenda: 'NIV / No. Motor', columna: 'n_short', style:'width:200px;' },
	        { leyenda: 'Observaciones', columna: 'n_short', style:'width:200px;' },
	        { leyenda: 'Editar', style: 'width:50px;'},
	        { leyenda: 'Eliminar', style: 'width:50px;'},
	        
	    ],
	    modelo: [
	        { propiedad: 'id',class:'text-center' },
	        { formato: function(tr,obj,celda){
	        	return '<ul>'+
	        				'<li>'+'<label>Tipo:</label> '+obj.tipo+'</li>'+
	        				'<li>'+'<label>Marca:</label> '+obj.marca+'</li>'+
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
	        	if ( obj.estado == 'Creada' ) {
		        	return anexGrid_boton({
		        		class: 'btn btn-danger btn-flat',
		        		contenido: '<i class="fa fa-trash"></i>',
		        		attr: [
	                    	'onclick="eliminar_sol('+obj.id+');"'
	                	]
		        	});
	        	}
	        	
	        } },
	    ],
	    url: 'controller/puente.php',
	    limite: [20,50,100],
	    columna: 'id',
	    columna_orden: 'DESC',
	    paginable:true,
	    parametros:{option:'Ahi te va la option'}
	};
	$("#all_vehiculos").anexGrid(sol);
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
		.fail(function() {
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
		$.each(data, function(index, val) {
			$('#m_veh').append('<option value="'+val.id+'">'+val.nom+'</option>');
		});
	},'json');
	return false;
}
//Recuperar el listado de tipos de vehiculos 
function getTipos() {
	$.post('controller/puente.php', {option: '3'}, function(data, textStatus, xhr) {
		$.each(data, function(index, val) {
			$('#t_veh').append('<option value="'+val.id+'">'+val.nom+'</option>');
		});
	},'json');
	return false;
}