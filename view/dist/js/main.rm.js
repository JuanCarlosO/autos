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

/*Listado completo de solicitudes*/
function all_sol() {
	var sol = {
	    class: 'table-striped table-bordered table-hover',
	    columnas: [
	        { leyenda: 'ID', class:'text-center', style: 'width:50px;',ordenable:true, columna:'id' },
	        { leyenda: 'Detalle de solicitud', style: 'width:300px;',class:'text-center' },
	        { leyenda: 'Detalle de vehículo',  style:'width:300px;' ,class:'text-center' },
	        { leyenda: 'Detalle de reparación', style:'width:300px;',class:'text-center' },
	        { leyenda: 'Reparaciones', style:'width:300px;' }	        
	    ],
	    modelo: [
	    	{propiedad:'solicitudes.id'},
	        {formato: function(tr,obj,celda){

	        	return '<ul>'+
	        				'<li>'+'<label># de solicitud:</label> '+obj.solicitudes.id+'</li>'+
	        				'<li>'+'<label>Fecha:</label> '+obj.solicitudes.f_sol+'</li>'+
	        				'<li>'+'<label>Solicitante:</label> '+obj.solicitudes.solicitante_name+'</li>'+
	        				'<li>'+'<label>Área:</label> '+obj.solicitudes.area_sol+'</li>'+
	        		   '<ul>';
	        }},
	        {propiedad:'vehiculo',formato: function(tr,obj,celda){
	        	
	        	var x = obj.data_vehiculo;
	        	var pos = parseInt(obj.solicitudes.id);
	        	console.log(x[0].id);
	        	return '<ul>'+
	        				'<li>'+'<label>Marca:</label> '+x[0].marca_name+'</li>'+
	        				'<li>'+'<label>Tipo:</label> '+x[0].tipo_name+'</li>'+
	        				'<li>'+'<label>Placas:</label> '+x[0].placas+'</li>'+
	        				'<li>'+'<label>Modelo:</label> '+x[0].modelo+'</li>'+
	        				'<li>'+'<label>KM:</label> '+x[0].niv+'</li>'+
	        				'<li>'+'<label>NIV:</label> '+x[0].niv+'</li>'+
	        				'<li>'+'<label>Resguardatario:</label> '+x[0].resguardatario+'</li>'+
	        				'<li>'+'<label># de verificación:</label> '+x[0].niv+'</li>'+
	        				'<li>'+'<label>Valor factura:</label> '+x[0].niv+'</li>'+
	        		   '<ul>';
	        }},
	        { formato: function(tr,obj,celda){
	        	return '<ul>'+
	        				'<li>'+'<label>Desc. Solicitante:</label> '+obj.solicitudes.descripcion+'</li>'+
	        				
	        		   '<ul>';
	        }},
	        { formato: function(tr,obj,celda){
	        	
	        	var lista = '<ul>';
	        	for( i=0; i<obj.data_reparaciones.length; i++ ){
	        		lista += '<li><label>Falla:</label>'+obj.data_reparaciones[i].falla+'<br> <label>Taller:</label>'+obj.data_reparaciones[i].r_social+'</li>';
	        	}
	        	lista += '</ul>';
	        	return lista;
	        }}
	    ],
	    url: 'controller/puente.php?option=13',
	    limite: [20,50,100],
	    columna: 'id',
	    columna_orden: 'DESC',
	    paginable:true,
	};
	var table = $("#solicitudes").anexGrid(sol);
	
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