$(document).ready(function() {
	getURL();getUser();
	
});
function getURL() {
	var url = window.location.search;
	if ( url == '?menu=general' ) {
		$('#r_salida').addClass('active');
		autocompletado('vigilante','vigilante_id');
		autocompletado('chofer','chofer_id');
		autocompletado_placas('placa','placa_id');
		medidor_gas();
		frm_salida();
	}else if ( url == '?menu=listado' ) {
		$('#l_salida').addClass('active');
		all_es();
		datepicker();
		frm_entrada_vehicular();
		medidor_gas();
	}
}
function getUser() {
	$.post('controller/puente.php', {option: '13'}, function(data, textStatus, xhr) {
		$('.profile_name').text(data.full_name);
	},'json');
	return false;
}
/*Autocompletado de personal de la unidad de asuntos internos */
function autocompletado(input,hidden) {
	if ( input == 'vigilante' ) {
		$('#'+input).autocomplete({
			source: "controller/puente.php?option=9&vigilantes=true",
			minLength: 2,
			select: function( event, ui ) {
	        	$('#'+hidden).val(ui.item.id);
	      	},
		});
	}else{
		$('#'+input).autocomplete({
			source: "controller/puente.php?option=9",
			minLength: 2,
			select: function( event, ui ) {
	        	$('#'+hidden).val(ui.item.id);
	      	},
		});
	}
	
	return false;
}
/*Autocompletado de placas */
function autocompletado_placas(input,hidden) {
	$('#'+input).autocomplete({
		source: "controller/puente.php?option=11",
		minLength: 2,
		select: function( event, ui ) {
        	$('#'+hidden).val(ui.item.id);
      	},
	});
	return false;
}
/**/
function medidor_gas() {
	$(".knob").knob({
    	change : function (value) {
      		$('#nivel_gas').val(value.toFixed(0));
    	},
      	draw: function () {
	        if (this.$.data('skin') == 'tron') {

	          var a = this.angle(this.cv)  // Angle
	              , sa = this.startAngle          // Previous start angle
	              , sat = this.startAngle         // Start angle
	              , ea                            // Previous end angle
	              , eat = sat + a                 // End angle
	              , r = true;

	          this.g.lineWidth = this.lineWidth;

	          this.o.cursor
	          && (sat = eat - 0.3)
	          && (eat = eat + 0.3);

	          if (this.o.displayPrevious) {
	            ea = this.startAngle + this.angle(this.value);
	            this.o.cursor
	            && (sa = ea - 0.3)
	            && (ea = ea + 0.3);
	            this.g.beginPath();
	            this.g.strokeStyle = this.previousColor;
	            this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false);
	            this.g.stroke();
	          }

	          this.g.beginPath();
	          this.g.strokeStyle = r ? this.o.fgColor : this.fgColor;
	          this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
	          this.g.stroke();

	          this.g.lineWidth = 2;
	          this.g.beginPath();
	          this.g.strokeStyle = this.o.fgColor;
	          this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
	          this.g.stroke();

	          return false;
	        }
      }
    });
}
/**/
function frm_salida() {
	$('#frm_salida').submit(function(e) {
		e.preventDefault();
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
			alerta(response.status,response.message);
		})
		.fail(function(jqXHR,textStatus,errorThrow) {
			alerta('error',jqXHR.responseText);
		});
		
	});
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
	document.location.href = "#alerta";
	setTimeout(function(){
		$('#alerta').addClass('hidden');
		$('#alerta').removeClass(clase);
		$('#estado').text('');
		$('#message').text('');
		location.reload();
	},5000);
}

function all_es() {
	var es = {
	    class: 'table-striped table-bordered',
	    columnas: [
	        { leyenda: 'ID', class:'text-center', style: 'width:50px;', columna: 'id',ordenable:true },
	        { leyenda: 'Vehículo', style: 'width:200px;', ordenable:false,filtro:false },
	        { leyenda: 'Datos salida', style:'width:200px;',ordenable:false },
	        { leyenda: 'Datos de entrada', style:'width:200px;' },
	        { leyenda: 'Observaciones', style:'width:200px;',ordenable:false, filtro:false },
	        { leyenda: 'Entrada', style:'width:10px;',ordenable:false, filtro:false },
	    ],
	    modelo: [
	        { propiedad: 'id'},
	        {  formato:function (tr,obj,celda) {
	        	return  '<ul>'+
	        			'<li> <b>PLACAS:</b> '+obj.placa+'</li>'+
	        			'<li> <b>MARCA:</b> '+obj.marca+'<l/i>'+
	        			'<li> <b>TIPO:</b> '+obj.t_vehiculo+'</li>'+
	        			'<li> <b>¿QUIEN REGISTRO?:</b> '+obj.registro+'</li>'+
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
		       				'<li> <b>RECORRIDO:</b> '+(obj.km_entrada - obj.km_salida)+'</li>'+
		       			'</ul>';
		       	}else{
		       		return  '<ul>'+
	        			'<li> <b>FECHA Y HORA:</b> SIN REGISTRAR</li>'+
	        			'<li> <b>NIVEL DE GAS:</b> SIN REGISTRAR <l/i>'+
	        			'<li> <b>KILOMETRAJE:</b> SIN REGISTRAR </li>'+
	        		'</ul>';
		       	}
	        	
	        }},
	       { propiedad: 'observaciones',class:'text-justify'},
	       { class:'text-justify', formato:function(tr,obj,celda){

	       		if( obj.km_entrada == null || obj.km_entrada == '' ){
	       			return anexGrid_boton({
	       				type: 'button',
	       				class: 'bun btn-success btn-flat',
	       				contenido:'<i class="fa fa-car"></i> ',
	       				attr:[
	       					'tittle="Entrada de vehículo"',
	       					'data-toggle="modal" data-target="#modal_entrada_vehicular"',
	       					'onclick="add_value('+obj.id+')"'
	       				]
	       			});
	       		}
	       }}
	    ],
	    url: 'controller/puente.php?option=12',
	    type:'POST',
	    limite: [25,50,100],
	    columna: 'id',
	    columna_orden: 'DESC',
	    paginable:true,
	    filtrable: false,

	};
	$("#es_today").anexGrid(es);
}
function logout() 
{
	location.href= 'login.php';
	return false;
}
function datepicker() {
	//Timepicker
    $('.timepicker').timepicker({
      	showInputs: false,
      	showMeridian: false,
    });
}
//Formulario de entrada vehicular
function frm_entrada_vehicular()
{
	$('#frm_entrada_vehicular').submit(function(e) {
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
			alerta(response.status,response.message);
		})
		.fail(function() {
			console.log("error");
		});
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
	document.location.href = "#alerta";
	setTimeout(function(){
		$('#alerta').addClass('hidden');
		$('#alerta').removeClass(clase);
		$('#estado').text('');
		$('#message').text('');
		location.reload();
	},5000);
}

function add_value(id) {
	$('#registro').val( id );
	return false;
}