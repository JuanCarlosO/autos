$(document).ready(function() {
	personal();
	areas();
	frm_alta_usuario();
});

function personal(){
	$( "#servidor" ).autocomplete({
        autoFocus:true,
        source: 'controller/puente.php?option=1',
        select: function( event, ui ){
            $('#servidor_id').val(ui.item.id);
        },
        delay:0,
        search:function () {
        	$('#servidor_id').val('');	
        }
    });
    return false;
}

function areas(){
	$( "#area" ).autocomplete({
        autoFocus:true,
        source: 'controller/puente.php?option=3',
        select: function( event, ui ){
            $('#area_id').val(ui.item.id);
        },
        delay:0,
        search:function () {
        	$('#area_id').val('');	
        }
    });
    return false;
}

function frm_alta_usuario() 
{
	$('#frm_alta_usuario').submit(function(e) {
		e.preventDefault();

		var p,rp;
		p 	= $('[name="pass"]').val();
		rp 	= $('[name="reply_pass"]').val();

		if ( p === rp ) 
		{
			$.ajax({
				url: 'controller/puente.php',
				type: 'POST',
				dataType: 'json',
				data: $(this).serialize(),
			})
			.done(function(info) {
				alert('Usuario registrado');
				if (info.estado == 'success') 
				{
					$('#alert_registro').addClass('alert-success');
					$('#alert_registro').removeClass('hidden');
					$('#message').text(info.message);
					setTimeout(function(){
						$('#alert_registro').removeClass('alert-success');
						$('#alert_registro').addClass('hidden');
						$('#message').text(info.message);
					},5000);
				}else{
					$('#alert_registro').addClass('alert-danger');
					$('#alert_registro').removeClass('hidden');
					$('#message').text(info.mensaje);
					setTimeout(function(){
						$('#alert_registro').removeClass('alert-danger');
						$('#alert_registro').addClass('hidden');
						$('#message').text('');
					},5000);
				}
				document.getElementById('frm_alta_usuario').reset();
			})
			.fail(function() {
				console.log("error");
			});
		}else
		{
			alert('LAS CONTRASEÑAS NO COINCIDEN');
		}

		
		
	});
	return false;
}