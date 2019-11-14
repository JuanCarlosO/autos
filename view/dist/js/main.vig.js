$(document).ready(function() {
	getURL();getUser();
	
});
function getURL() {
	var url = window.location.search;
	if ( url == '?menu=general' ) {
		autocompletado('vigilante','vigilante_id');
		autocompletado('chofer','chofer_id');
		autocompletado_placas('placa','placa_id');
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
	$('#'+input).autocomplete({
		source: "controller/puente.php?option=9",
		minLength: 2,
		select: function( event, ui ) {
        	$('#'+hidden).val(ui.item.id);
      	},
	});
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