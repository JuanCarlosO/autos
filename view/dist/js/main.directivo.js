$(document).ready(function() {
	getURL();getUser();
	
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
		graficos();
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
	//Generar el Ajax Necesarion para recuperar la informacion.
	var etiquetas = [], datos = [];
	$.ajax({
		url: 'controller/puente.php',
		type: 'POST',
		dataType: 'json',
		data: {option: '36'},
		async:false,
		cache:false,
	})
	.done(function(response) {
		if ( response.status == 'error' ) {
			alert(response.message);
		}else{
			$.each(response, function(i, val) {
				etiquetas.push(val.placas);
				datos.push(val.sumatoria);
			});
		}
	})
	.fail(function(jqXHR,textStatus, errorThrow) {
		console.log("Error: "+jqXHR.responseText);
	});
	
	var ctx = document.getElementById('myChart').getContext('2d');
	var myChart = new Chart(ctx, {
	    type: 'bar',
	    data: {
	        labels: etiquetas,
	        datasets: [{
	            label: 'Suma de cotizaciones',
	            data: datos,
	            backgroundColor: [
	                'rgba(255, 99, 132, 0.7)',
	                'rgba(54, 162, 235, 0.7)',
	                'rgba(255, 206, 86, 0.7)',
	                'rgba(0, 166, 90, 0.7)',
	                'rgba(153, 102, 255, 0.7)',
	                'rgba(255, 159, 64, 0.7)'
	            ],
	            borderColor: [
	                'rgba(255, 99, 132, 1)',
	                'rgba(54, 162, 235, 1)',
	                'rgba(255, 206, 86, 1)',
	                'rgba(75, 192, 192, 1)',
	                'rgba(153, 102, 255, 1)',
	                'rgba(255, 159, 64, 1)'
	            ],
	            borderWidth: 1
	        }]
	    
	    }
	});
}