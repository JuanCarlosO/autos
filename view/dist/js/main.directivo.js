$(document).ready(function() {
	getURL();getUser();
	graficos();
});
/*Recuperar la pagina en la que se encuemntra*/
function getURL() {
	var url = window.location.search;
	if ( url == '?menu=general'  ) {
		$('#listado_sol').addClass('active');
		all_sol();
	}else if ( url == '?menu=historic' ){
		$('#tree_reports').addClass('active');
		$('#historic').addClass('active');
		autocompletado_placas('placa','placa_id');
		frm_historic();
	}else if ( url == '?menu=estadistic' ){
		$('#tree_reports').addClass('active');
		$('#estadistic').addClass('active');
	}
	return false;
}
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
function all_sol() {
	var sol = {
	    class: 'table-striped table-bordered table-hover',
	    columnas: [
	        { leyenda: 'ID', class:'text-center', style: 'width:10%;',ordenable:true, columna:'id' },
	        { leyenda: 'Descripcion del solicitante', style: 'width:45%;',class:'text-center' },
	        { leyenda: 'Opinion del Habilitado Vehicular',  style:'width:45%;' ,class:'text-center' }, 	        
	    ],
	    modelo: [
	    	{propiedad:'id',class:'text-center'},
	    	{propiedad:'solicitante',class:'text-center'},
	    	{propiedad:'habilitado',class:'text-center'},
	        
	    ],
	    url: 'controller/puente.php?option=14',
	    limite: [20,50,100],
	    columna: 'id',
	    columna_orden: 'DESC',
	    paginable:true,
	};
	var table = $("#all_sol").anexGrid(sol);
	
}
function autocompletado_placas(input,hidden) {
	$('#'+input).autocomplete({
		source: "controller/puente.php?option=15",
		minLength: 2,
		select: function( event, ui ) {
        	$('#'+hidden).val(ui.item.id);
      	},
	});
	return false;
}

function frm_historic() {
	$('#frm_historic').submit(function(e) {
		e.preventDefault();
		var f_ini,f_fin,placa;
		f_ini = $('#f_ini').val();
		f_fin = $('#f_fin').val();
		placa = $('#placa_id').val();
		sol_by_cost(f_ini,f_fin,placa);
		
	});
	return false;
}

function sol_by_cost( f_ini,f_fin,placa ) {
	var monto = 0;
	var sol = {
	    class: 'table-striped table-bordered table-hover',
	    columnas: [
	        { leyenda: 'ID', class:'text-center', style: 'width:10%;',ordenable:true, columna:'id' },
	        { leyenda: 'Datos de la salud', style: 'width:80%;',class:'text-center' },
	        { leyenda: 'Monto de cotización',  style:'width:10%;' ,class:'text-center' }, 	        
	    ],
	    modelo: [
	    	{propiedad:'id'},
	    	{formato:function(tr,obj,celda){
	    		return '<ul>'+
	    			'<li> <label>Folio:</label> '+obj.folio+' </li>'+
	    			'<li> <label>Fecha de solicitud:</label> '+obj.f_sol+' </li>'+
	    			'<li> <label>Kilometraje</label> '+obj.km+' </li>'+
	    			'<li> <label>Estado:</label> '+obj.estado+' </li>'+
	    			'<li> <label>Descripción:</label> '+obj.descripcion+' </li>'+
	    		'</ul>';

	    	}},
	    	{formato:function(tr,obj,celda){
	    		monto = parseInt(monto) + parseInt(obj.monto);
	    		$('#monto').text(monto);
	    		return obj.monto;
	    	}},
	        
	    ],
	    url: 'controller/puente.php',
	    limite: [10,20,50,100],
	    columna: 'id',
	    columna_orden: 'DESC',
	    paginable:true,
	    type:'POST',
	    parametros:{f_ini:f_ini,option:16,f_fin: f_fin,placa:placa}
	};
	var table = $("#historic_data").anexGrid(sol);
}

function graficos() {
	var line = new Morris.Line({
		element: 'line-chart',
		resize: true,
		data: [
			{y: '2011 R1', item1: 2666},
			{y: '2011 Q2', item1: 2778},
			{y: '2011 Q3', item1: 4912},
			{y: '2011 Q4', item1: 3767},
			{y: '2012 Q1', item1: 6810},
			{y: '2012 Q2', item1: 5670},
			{y: '2012 Q3', item1: 4820},
			{y: '2012 Q4', item1: 15073},
			{y: '2013 Q1', item1: 10687},
			{y: '2013 Q2', item1: 8432}
		],
		xkey: 'y',
		ykeys: ['item1'],
		labels: ['Item 1'],
		lineColors: ['#3c8dbc'],
		hideHover: 'auto'
	});
}