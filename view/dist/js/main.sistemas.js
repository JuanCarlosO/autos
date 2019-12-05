$(document).ready(function() {
	autocompletado('sp','sp_id');
	frm_create_cuenta();
	frm_insert_account();
});

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
function frm_create_cuenta() {
	$('#frm_create_cuenta').submit(function(e) {
		e.preventDefault();
		var dataForm = $(this).serialize();
		$.ajax({
			url: 'controller/puente.php',
			type: 'POST',
			dataType: 'html',
			data: dataForm,
			async:false
		})
		.done(function(response) {
			$('#frm_insert_account').html(response);
		})
		.fail(function() {
			alert('Error');
		});
		
	});
}
function frm_insert_account() {
	$('#frm_insert_account').submit(function(e) {
		e.preventDefault();
		var dataForm = $(this).serialize();
		$.ajax({
			url: 'controller/puente.php',
			type: 'POST',
			dataType: 'html',
			data: dataForm,
			async:false
		})
		.done(function(response) {
			console.log(response);
			alert(response.message);
			document.getElementById("frm_insert_account").reset();
		})
		.fail(function() {
			alert('Error');
		});
		
	});
	return false;
}