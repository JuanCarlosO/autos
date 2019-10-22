$(document).ready(function() {
    //Recuperar el URL 
    if ( window.location.search == '?menu=general'  ) {
        change_grupo();
        bienes();
    }

	load_catalogos();
	/*Condicional para poner la clase active*/
	var url = window.location.search;
	apply_active(url);
    
    personal();
    bienes_c_refaccion();
	/*Prevenir a la pagina para agregar marcas */
	add_marca();
	/*Cargar el grafico*/
	example_char(url);
	/*Aplicar el Select 2 */
	apply_select2();
    load_proveedores_garantias();
	/*Aplicar los tooltips */
	$('[data-toggle="tooltip"]').tooltip();
	searchName();
    select_personal();
    select_areas();
	requieren_repa_externa();
    bien_bajas();
    select_bienes();
    tbl_reparaciones_activas();
    autocomplete_series();
    autocomplete_inventario();
	/*Metodos para guardar informacion*/
    save_bien();
    save_marca();
    save_modelo();
    save_color();
    save_proveedor();

    /*Metodos de formularios*/
    frm_bajas();
    load_data_edit();
    frm_add_persona();
    frm_add_puesto();
    frm_buscar_bienes();
    frm_alta_ticket();
    formulario_bajas();
    frm_add_garantia();
    frm_asignar_refacciones();
    frm_repara_ext();
    frm_adjuntar();
    frm_baja_definitiva();
    frm_r_equipo();
    frm_r_user();
    frm_xlsx_asignacion();
    frm_asignar();
    frm_r_falla();
});

/*Funcion para salir*/
function logout() 
{
	location.href= 'login.php';
	return false;
}
/*Abrir o cerrar el modal de la marca */
function modal_marca() 
{
    $('#modal_add_marca').modal('toggle');
    return false;
}
/*Abrir o cerrar el modal de la marca */
function modal_puesto(persona) 
{
    $('#modal_add_puesto').modal('toggle');
    $('#persona').val(persona);
    $('#campo_aux').empty();
    document.getElementById('frm_add_puesto').reset();
    return false;
}
/*Abrir o cerrar el modal del color */
function modal_color() 
{
    $('#modal_add_color').modal('toggle');
    return false;
}
/*Abrir o cerrar el modal del modelo */
function modal_modelo() 
{
    $('#modal_add_modelo').modal('toggle');
    return false;
}
function modal_proveedor() 
{
    $('#modal_add_proveedor').modal('toggle');
    return false;
}
/*Abrir o cerrar el modal de reasignacion*/
function modal_reasignar(bien_id) 
{
    $('#modal_reasignar').modal('toggle');
    /*Llamar */
    return false;
}
/*Abrir o cerrar el modal de adjuntar documento */
function modal_adjuntar(bien_id,id_re) 
{
	/*Recuperar el id de la garantia que se desea actualizar*/
	
    $('#modal_adjuntar').modal('toggle');
    /*Al abrir el modal colocar el identificador de la garantia*/
    $('#bien_id').val(bien_id);
    $('#repa_ext').val(id_re);
    return false;
}

/*Abrir o cerrar el modal de ver el detalle de la garantia */
function modal_detalle(garantia) 
{
    /*Recuperar el id de la garantia que se desea actualizar*/
    var garantia_id = garantia;
    $('#modal_detalle').modal('toggle');
    
    return false;
}
/*Abrir o cerrar el modal actualizacion de informacion de la garantia */
function modal_modifica(garantia) 
{
    /*Recuperar el id de la garantia que se desea actualizar*/
    var garantia_id = garantia;
    $('#modal_actualiza').modal('toggle');
    
    return false;
}
/*Abrir o cerrar el modal actualizacion de informacion de la garantia */
function modal_edit_refaccion(refaccion) 
{
    /*Recuperar el id de la garantia que se desea actualizar*/
    var refaccion_id = refaccion;
    $('#modal_edit_refaccion').modal('toggle');
    search_refaccion(refaccion);//Buscar las refacciones

    return false;
}
/*Abrir o cerrar el modal actualizacion de informacion de la garantia */
function modal_edit_user(person) 
{
    /*Recuperar el id de la garantia que se desea actualizar*/
    $('#modal_edit_user').modal('toggle');
    $('#edit_persona').val(person);
    return false;
}
/*Abrir o cerrar el modal de prestamos */
function modal_prestamo() 
{
    $('#modal_prestamo').modal('toggle');
    /*Reiniciar formulario*/
    document.getElementById('frm_add_prestamo').reset();
    return false;
}
/*Abrir o cerrar el modal de puestos */
function modal_del_puestos(persona) 
{
    $('#modal_del_puestos').modal('toggle');
    search_puestos(persona);
    return false;
}
/*Carga de catalogos para la vista*/
function load_catalogos() 
{
    load_grupos();
    load_materiales();
    load_marcas();
    load_modelos();
    load_colores();
    load_proveedores();
    load_areas();
    load_personal();
    load_bienes();
    load_fallas();

    return false;
}
/*Consultar el catalog de grupos*/
function load_grupos()
{
    $.ajax({
        url: 'controller/puente.php',
        type: 'POST',
        dataType: 'json',
        data: {option: 7},
        async: false ,
        cache: false,
    })
    .done(function(data) {
        $('#grupo').empty();
        $('#grupo').append('<option value="" disabled selected>...</option>');
        $.each(data, function(i, val) {
            $('#grupo').append('<option value="'+val.id+'">'+val.nombre+'</option>');
        });
    })
    .fail(function() {
        alert("Error durante la petición al servidor");
    });
    /*Preparar el evento Onchange*/
    $('#grupo').change(function(e) {
        e.preventDefault();
        load_tipo_bienes( $(this).val() );
    });
    return false;
}
/*Cuando se selecciona un grupo se cargaran los tipos de bienes pertenecientes a ese grupo*/
function load_tipo_bienes(id) 
{
    $.ajax({
        url: 'controller/puente.php',
        type: 'POST',
        dataType: 'json',
        data: {option: 8,grupo:id},
        async: false ,
        cache: false,
    })
    .done(function(data) {
        $('#tipo').empty();
        $('#tipo').append('<option value="" >...</option>');
        $.each(data, function(i, val) {
            $('#tipo').append('<option value="'+val.id+'">'+val.nombre+'</option>');
        });
    })
    .fail(function() {
        alert("Error durante la petición al servidor");
    });
    return false;
}
/*Carga el listado del personal*/
function load_personal() 
{
    $( "#servidor, [name='servidor'], [name='servidor_edit']" ).autocomplete({
        autoFocus:true,
        source: 'controller/puente.php?option=1',
        select: function( event, ui ){
            $('#servidor_id, [name="servidor_id"], [name="servidor_id_edit"]').val(ui.item.id);
        },
        delay:0
    });
    return false;
}
/*Carga el listado del bienes*/
function load_bienes() 
{
    $( "#inventarios" ).autocomplete({
        autoFocus:true,
        source: 'controller/puente.php?option=2',
        select: function( event, ui ){
            console.log( ui );
            $('[name="inventario_id"]').val(ui.item.id);
        },
        delay:0
    });
    return false;
}
/*Carga del listado de materiales*/
function load_materiales() 
{
    var mat = $('#material');
    $.ajax({
        url: 'controller/puente.php',
        type: 'POST',
        dataType: 'json',
        data: {option: 9},
        async: false ,
        cache: false,
    })
    .done(function(data) {
        mat.empty();
        mat.append('<option value="" disabled selected>...</option>');
        $.each(data, function(i, val) {
            mat.append('<option value="'+val.id+'">'+val.nombre+'</option>');
        });
    })
    .fail(function() {
        alert("Error durante la petición al servidor");
    });
    return false;
}
/*Carga del listado de marcas*/
function load_marcas() 
{
    var marca = $('#marca');
    $.ajax({
        url: 'controller/puente.php',
        type: 'POST',
        dataType: 'json',
        data: {option: 10},
        async: false ,
        cache: false,
    })
    .done(function(data) {
        marca.empty();
        marca.append('<option value="" disabled selected>...</option>');
        $.each(data, function(i, val) {
            marca.append('<option value="'+val.id+'">'+val.nombre+'</option>');
        });
    })
    .fail(function() {
        alert("Error durante la petición al servidor");
    });
    return false;
}
/*Carga del listado de marcas*/
function load_modelos() 
{
    var modelo = $('#modelo');
    $.ajax({
        url: 'controller/puente.php',
        type: 'POST',
        dataType: 'json',
        data: {option: 11},
        async: false ,
        cache: false,
    })
    .done(function(data) {
        modelo.empty();
        modelo.append('<option value="" disabled selected>...</option>');
        $.each(data, function(i, val) {
            modelo.append('<option value="'+val.id+'">'+val.nombre+'</option>');
        });
    })
    .fail(function() {
        alert("Error durante la petición al servidor");
    });
    return false;
}
/*Carga del listado de colores*/
function load_colores() 
{
    var color = $('#color');
    $.ajax({
        url: 'controller/puente.php',
        type: 'POST',
        dataType: 'json',
        data: {option: 12},
        async: false ,
        cache: false,
    })
    .done(function(data) {
        color.empty();
        color.append('<option value="" disabled selected>...</option>');
        $.each(data, function(i, val) {
            color.append('<option value="'+val.id+'">'+val.nombre.toUpperCase()+'</option>');
        });
    })
    .fail(function() {
        alert("Error durante la petición al servidor");
    });
    return false;
}
/*Carga el listado de las areas administrativas*/
function load_areas() 
{
    var areas = $('#area');
    $.ajax({
        url: 'controller/puente.php',
        type: 'POST',
        dataType: 'json',
        data: {option: 22},
        async: false ,
        cache: false,
    })
    .done(function(data) {
        areas.empty();
        areas.append('<option value="">BUSCAR Y SELECCIONAR UN ÁREA</option>');
        $.each(data, function(i, val) {
            areas.append('<option value="'+val.id+'">'+val.nombre.toUpperCase()+'</option>');
        });

    })
    .fail(function() {
        alert("Error durante la petición al servidor");
    });
    return false;
} 
/*Carga de catalogo de proveedores*/
function load_proveedores() 
{
    var pro = $('#proveedor');
    $.ajax({
        url: 'controller/puente.php',
        type: 'POST',
        dataType: 'json',
        data: {option: 18},
        async: false ,
        cache: false,
    })
    .done(function(data) {
        pro.empty();
        pro.append('<option value="" disabled selected>...</option>');
        $.each(data, function(i, val) {
            pro.append('<option value="'+val.id+'">'+val.nombre.toUpperCase()+'</option>');
        });
    })
    .fail(function() {
        alert("Error durante la petición al servidor");
    });
    return false;
}
/*Aplicar la case Active*/
function apply_active(url)
{
	//dividir el string paso #1
	url = url.split('=');
	url = url[1];
	//Colocar active a la zona de Bienes
	if (url == 'general') 
	{
		$('#menu_bienes').addClass('active');
		$('#submenu_listado').addClass('active');
	}else if (url == 'new_bien')
	{
		$('#menu_bienes').addClass('active');
		$('#submenu_alta').addClass('active');
	}
	else if (url == 'generate_esta')
	{
		$('#menu_bienes').addClass('active');
		$('#submenu_estadistica').addClass('active');
	}
	else if (url == 'presta')
	{
		$('#menu_bienes').addClass('active');
		$('#submenu_presta').addClass('active');
	}
	else if (url == 'reasigna')
	{
		$('#menu_bienes').addClass('active');
		$('#submenu_reasigna').addClass('active');
	}
	else if (url == 'trash')
	{
		$('#menu_bienes').addClass('active');
		$('#submenu_bajas').addClass('active');
	}
	//Colocar active a zona de personal
	else if (url == 'list_person')
	{
		$('#menu_personal').addClass('active');
		$('#submenu_listadoper').addClass('active');
	}
	else if (url == 'new_person')
	{
		$('#menu_personal').addClass('active');
		$('#submenu_altaper').addClass('active');
	}
	//Colocar active a la zona de Soporte Técnico
	else if (url == 'new_sol')
	{
		$('#menu_st').addClass('active');
		$('#submenu_new_sol').addClass('active');
	}
	else if (url == 'r_equipo')
	{
		$('#menu_st').addClass('active');
		$('#submenu_reportes').addClass('active');
		$('#submenu2_equipo').addClass('active');
	}
	else if (url == 'r_user')
	{
		$('#menu_st').addClass('active');
		$('#submenu_reportes').addClass('active');
		$('#submenu2_user').addClass('active');
	}
	else if (url == 'r_fail')
	{
		$('#menu_st').addClass('active');
		$('#submenu_reportes').addClass('active');
		$('#submenu2_fail').addClass('active');
	}
	else if (url == 'r_history')
	{
		$('#menu_st').addClass('active');
		$('#submenu_reportes').addClass('active');
		$('#submenu2_historial').addClass('active');
	}
	else if (url == 'r_repain')
	{
		$('#menu_st').addClass('active');
		$('#submenu_reportes').addClass('active');
		$('#submenu2_repara').addClass('active');
	}
	else if (url == 'r_refaccion')
	{
		$('#menu_st').addClass('active');
		$('#submenu_reportes').addClass('active');
		$('#submenu2_refa').addClass('active');
	}
	else if (url == 'reparacion_ext')
	{
		$('#menu_reparacion').addClass('active');
		$('#submenu_r_ext').addClass('active');
	}
	else if (url == 'reparacion_int')
	{
		$('#menu_reparacion').addClass('active');
		$('#submenu_r_int').addClass('active');
	}
	return false;
}

/*Registrar nueva marca */
function add_marca ()
{
	$('#marca').change(function (event) {
		event.preventDefault();
		var value = $(this).val();
		if ( value == 1) 
		{
			var nueva = prompt('Escriba el nombre de la nueva Marca: ');
			/*Petición AJAX PARA GUARDAR LA MARCA*/
			$(this).append('<option>'+nueva+'</option>');
			/*Petición AJAX para actualizar el select*/
		}
		
	});
	
	return false;
}

/*Formulario para guardar el registro de un bien*/
function save_bien() 
{
    var form = $('#frm_add_bien');
    var data_form ;

    form.submit(function(event) {
        event.preventDefault();
        data_form = $(this).serialize();
        $.ajax({
            url: 'controller/puente.php',
            type: 'POST',
            dataType: 'json',
            data: data_form,
            async: false ,
            cache: false,
        })
        .done(function(data) {
            if (data.message == 'success') {
                $('#alert_success4').removeClass('hidden');
                setTimeout(function () {
                    $('#alert_success4').addClass('hidden');
                },5000);
            }else{
                $('#alert_error4').removeClass('hidden');
                setTimeout(function () {
                    $('#alert_error4').addClass('hidden');
                },5000);
            }
            /*Resetear el formulario*/
            document.getElementById('frm_add_bien').reset();
        })
        .fail(function() {
             alert("Error en el metodo save_bien() de main.bienes.js");
        });      
    });
}

/*Funcion reutilizada para mostrar y ocultar alertas*/
function hide_show_alerts( id )
{
	/*Mostar alerta de éxito*/
		$('#'+id).removeClass('hidden');
		/*Ocultar la alerta automaticamente */
		setTimeout(function () {
			$('#'+id).addClass('hidden');
		},5000);
	return false;
}

/*Funcion ejemplo de grafico*/
function example_char( url )
{
	//dividir el string paso #1
	url = url.split('=');
	url = url[1];
	if ( url == 'generate_esta' ) 
	{
			var line = new Morris.Line({
		      element: 'line-chart',
		      resize: true,
		      data: [
		        {y: '2011 Q1', item1: 2666},
		        {y: '2011 Q2', item1: 2778},
		        {y: '2011 Q3', item1: 4912},
		        {y: '2011 Q4', item1: 3767},
		        {y: '2012 Q1', item1: 6810},
		        {y: '2012 Q2', item1: 5670},
		        {y: '2012 Q3', item1: 4820},
		        {y: '2012 Q4', item1: 15073},
		        {y: '2013 Q1', item1: 10687},
		        {y: '2013 Q2', item1: 843}
		      ],
		      xkey: 'y',
		      ykeys: ['item1'],
		      labels: ['Item 1'],
		      lineColors: ['#00a65a'],
		      /**hoverCallback: function (index, options, content, row) {
		        return "Esto es lo que se cargo"+row.item1;
		      }*/
		      hideHover: 'true'

		    });
	}
		
	return false;
}

/* Aplicar el css para select 2 */
function apply_select2()
{
	$('.select2').select2();
}

function searchName() 
{
    //$('#profile_name').text('Este es mi nombre');
    $.ajax({
        url: 'controller/puente.php',
        type: 'POST',
        dataType: 'json',
        data: {option: '5'},
        async: false ,
        cache: false,
    })
    .done(function(data) {
        $('.profile_name').text(data.short_name);
    })
    .fail(function() {
        $('.profile_name').text('Error. Usuario no encontrado');
    });
    
    return false;   
}

/*Función de AnexGrid que recupera todos lo bienes*/
function apply_dataTables(table)
{
    table.DataTable({
        'language':
        {
            'url':'//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
        },
        'lengthMenu': [[10, 25, 50,100, -1], [10, 25, 50, 100, 'Todos']],
        dom: 'Bfrtip',
        buttons:{
            buttons: [
                { extend: 'pdf', className: 'btn btn-flat btn-warning',text:' <i class="fa  fa-file-pdf-o"></i> Exportar a PDF' },
                { extend: 'excel', className: 'btn btn-success btn-flat',text:' <i class="fa fa-file-excel-o"></i> Exportar a Excel' }
            ]
        } 
    });
    /*Aplicar clases de adminlte a Datatables*/
    return false;
}

function formulario_bajas ()
{
    $('#div_resultados').addClass('hidden');
    var t = $('#tbl_resultado_baja');
	$('#formulario_bajas').submit(function(e) {
		e.preventDefault();
        
		$.ajax({
            url: 'controller/puente.php',
            type: 'POST',
            dataType: 'json',
            data: {option: '63',criterio:$('#criterio').val()},
        })
        .done(function(resultado) {
            $('#tbl_resultado_baja tbody').empty();
            if (resultado.length >0 ) {
                $('#div_resultados').removeClass('hidden');
                $.each(resultado, function(i, val) {
                    var acciones ;
                    if (val.status == 'Baja') {
                        acciones = '';
                    }else{
                        acciones = 
                            '<div class="btn-group">'+
        '                     <button type="button" class="btn btn-success btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false">'+
        '                         <span class="caret"></span>'+
        '                         <span class="sr-only">Toggle Dropdown</span>'+
        '                     </button>'+
        '                     <ul class="dropdown-menu" role="menu">'+
        '                         <li><a href="#" onclick="bajaTemporal('+val.id+');">Baja temportal</a></li>'+
        '                         <li><a href="#" onclick="bajaDefinitiva('+val.id+');">Baja definitiva</a></li>'+
        '                     </ul>'+
        '                    </div>';
                    }
                    var asignadoa;
                    if( val.asignadoa == null ){
                        asignadoa = 'SIN ASIGNAR';
                    }else{
                        asignadoa = val.asignadoa;
                    }
                    t.append(
                    '<tr>'+
                        '<td>'+acciones+'</td>'+
                        '<td>'+val.id+'</td>'+
                        '<td>'+val.tipo+'</td>'+
                        '<td><label>Serie: </label>'+val.serie+'<br><label>Inventario: </label>'+val.inventario+'</td>'+
                        '<td>'+val.status+'</td>'+
                        '<td>'+asignadoa+'</td>'+
                    '</tr>'
                    );
                });
            }else{
                $('#div_resultados').removeClass('hidden');
                t.append(
                    '<tr>'+
                        '<td colspan="6">SIN RESULTADOS ENCONTRADOS</td>'+
                    '</tr>'
                );
            }
        })
        .fail(function() {
            console.log("error");
        });
        
	});
	return false;
}
var limit = 0;
/*Agregar campos de adjuntar archivos*/
function add_field_file() 
{
	if ( limit <= 4) 
	{
			var field = '<div class="row">'+
		'	          		<div class="col-md-3">'+
		'	          			<div class="form-group">'+
		'	          				<label for="">Calsificación del documento</label>'+
		'	          				<select name="clasificacion_doc" id="clasificacion_doc" class="form-control" required>'+
		'	          					<option value="">...</option>'+
                                        '<option value="1">Lista de equipos retirados</option>'+
		'	          				</select>'+
		'	          			</div>'+
		'	          		</div>'+
		'	          		<div class="col-md-9">'+
		'	          			<div class="form-group">'+
		'	          				<label for="">Buscar el documento</label>'+
		'	          				<input type="file" name="archivo[]" value="" class="form-control">'+
		'	          			</div>'+
		'	          		</div>'+
		'	          	</div>';
			$('#archivos').append(field);
			window.location.href= '#archivos';
			limit++;
	}
	else
	{
		alert('El limite de cargar de documentos a llegado a su limite');
	}
	return false;
}
/*Eliminar la asignacion de la refaccion*/
function del_refaccion(bien) 
{
    $.ajax({
        url: 'controller/puente.php',
        type: 'POST',
        dataType: 'json',
        data: {option: 62,refaccion:bien},
    })
    .done(function(data) {
        if ( data.estado == 'success' ) 
        {
            $('#'+bien).hide(3000);
        }
        else
        {
            $('#refaciones_alert').addClass('alert-danger');
            $('#refaciones_alert').removeClass('hidden');
            $('#refacciones_message').text('Error'+data.message);
            setTimeout(function(){
                $('#refaciones_alert').removeClass('alert-danger');
                $('#refaciones_alert').addClass('hidden');
                $('#refacciones_message').text('');
                bienes_c_refaccion();
            },5000);
        }
        personal();
    })
    .fail(function() {
        console.log("error");
    });
    
    return false;
}
/*Carga el fomulario de prestamos*/
function frm_add_prestamo()
{
    $('#frm_add_prestamo').submit(function (e) {
        e.preventDefault();
        alert($(this).serialize());
    });
    return false;
}
/*Retirar el bien*/
function retirar() 
{
    alert('El bien ahora esta disponible para asignación');
    return false;
}
/*Listado de bienes General*/
function bienes() 
{
    var t = $('#listadoBienes').DataTable(
        {
            'language':
            {
                'url':'//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
            },
            'lengthMenu': [[10, 25, 50,100, -1], [10, 25, 50, 100, 'Todos']],
            
            dom: '<<"col-md-3"B><"#buscar.col-sm-4"f><"pull-right"l><t>pr>',
            buttons:{
                buttons: [
                    { extend: 'pdf', className: 'btn btn-flat btn-warning',text:' <i class="fa  fa-file-pdf-o"></i> Exportar a PDF' },
                    { extend: 'excel', className: 'btn btn-success btn-flat',text:' <i class="fa fa-file-excel-o"></i> Exportar a Excel' }
                ]
            } 
        }
    );
    
    $.ajax({
        url: 'controller/puente.php',
        type: 'POST',
        dataType: 'json',
        data: {option: '19'},
        async: false ,
        cache: false,
    })
    .done(function(data) {
        console.log(data);
        t.clear().draw();
        $.each(data, function(i, val) {
            var asignacion = ( val.asignadoa == null ) ? 'NO ASIGNADO':val.asignadoa;
            var accion;
            if (val.status == 'Baja') {
                accion = "<label>SIN ACCIONES</label>"
            }else{
                if ( asignacion == 'NO ASIGNADO' ) {
                    accion = '<button type="button" class="btn btn-info btn-xs btn-flat" data-toggle="modal" data-target="#asignar_modal" onclick="getElementAsignar('+val.id+')"><i class="fa  fa-share-square-o"></i> Asignar</button>';
                    accion += '<button type="button" onclick="modal_baja('+val.id+')" class="btn btn-danger btn-xs btn-flat"> <i class="fa fa-trash"> Baja</i> </button>';
                }else{
                    accion = '<button type="button" class="btn btn-success btn-xs btn-flat" data-toggle="modal" data-target="#editar_bien_modal" onclick="getElementEdit('+val.id+')"><i class="fa fa-pencil"></i> Editar</button>';
                    accion += '<button type="button" onclick="modal_baja('+val.id+')" class="btn btn-danger btn-xs btn-flat"> <i class="fa fa-trash"> Baja</i> </button>';
                }
            }
            
            t.row.add([
                val.id,
                val.tipo +' <br> '+'('+val.status+')',
                val.grupo,
                val.inventario,
                val.serie,
                val.marca,
                val.modelo,
                asignacion,
                accion
            ]).draw(false);
        });
    })
    .fail(function() {
        console.log("error");
    });
    
    return false;
}
/*Recuperar el bien a asignar*/
function getElementAsignar(bien_id) 
{
    $('#bien_id_asigna').val(bien_id);
    return false;
}
function getElementEdit  (id)
{
    $('#bien_id_edit').val(id);
    //Inicializar las variables del formulario
    var grupo,tipo,material,estado,descripcion,marca,modelo,ubicacion;
    var color,serie,inventario,factura,importe,f_adquisicion,proveedor;
    /* Variables de ID*/
    var grupo_id,tipo_id;
    //alert(id);
    $.ajax({
        url: 'controller/puente.php',
        type: 'POST',
        dataType: 'json',
        data: {option:23,bien_id_edit: id},
        async: false ,
        cache: false,
    })
    .done(function(data) {
        grupo   = data[0].grupo;
        tipo    = data[0].tipo;
        material  = data[0].material;
        estado  = data[0].status;
        descripcion = data[0].descripcion;
        marca   = data[0].marca;
        modelo  = data[0].modelo;
        color   = data[0].color;
        serie   = data[0].serie;
        inventario  = data[0].inventario;
        factura     = data[0].factura;
        importe     = data[0].importe;
        f_adquisicion     = data[0].adquisicion;
        proveedor     = data[0].proveedor;
        ubicacion   = data[0].desc_ub;
        //cargar grupos
        $.ajax({
            url: 'controller/puente.php',
            type: 'POST',
            dataType: 'json',
            data: {option: 7},
        })
        .done(function(data2) {
            /*Buscar y seleccionar el grupo*/
            grupo_id = search_grupo(data2,grupo);
            /*Cargar los tipos de bienes del grupo*/
            tipo_id = search_tipo_bien(grupo_id,$('#tipo_edit'),tipo);
            /*Cargar los materiales y seleccionar el guardado*/
            search_material(material,$('#material_edit'));
            /*Buscar el estado del bien*/
            search_estado(estado,$('#estado_edit'));
            /*Agregar la descripcion*/
            $('#descripcion_edit').text(descripcion);
            /*Buscar y seleccioanr la marca*/
            search_marca(marca,$('#marca_edit'));
            /*Buscar y seleccionar el modelo*/
            search_modelo(modelo,$('#modelo_edit'));
            /*Buscar y seleccionar el color*/
            search_color(color,$('#color_edit'));
            /*Agregar el inventario*/
            $('#inventario_edit').val(inventario);
            /*Agregar la serie*/
            $('#serie_edit').val(serie);
            /*Buscar y seleccionar el proveedor*/
            search_proveedor(proveedor,$('#proveedor_edit'));
            /*Agregar el numero de factura*/
            $('#factura_edit').val(factura);
            /*Agregar el importe*/
            $('#importe_edit').val(importe);
            /*Agregar fecha de adquisicion*/
            $('#adquisicion_edit').val(f_adquisicion);
            $('#desc_ub_edit').text(ubicacion);
            /*Buscar y seleccionar el nombre del servidor publico */
            
        })
        .fail(function() { 
            alert("Error durante la petición al servidor"); 
        });  
    })
    .fail(function() {
        console.log("Error para recuperar el bien a editar");
    });   
    /*Buscar los datos de la asignación*/
    search_asignacion(id);
    return false;
}
/*Buscar y seleccionar el grupo*/
function search_grupo(data,grupo) 
{
    $('#grupo_edit').empty();
    $('#grupo_edit').append('<option value="" disabled>...</option>');
    $.each(data, function(i, val) {
        if (val.nombre == grupo) 
        {
            grupo_id = val.id;
            $('#grupo_edit').append('<option value="'+val.id+'" selected>'+val.nombre+'</option>');
        }
        else
        {
            $('#grupo_edit').append('<option value="'+val.id+'">'+val.nombre+'</option>');
        }
    });
    selected = grupo_id;
    return selected;
}
/*Buscar el tipo de bien por el grupo seleccionado*/
function search_tipo_bien(id, contenedor,tipo_ant)
{

    var id;
    $.ajax({
        url: 'controller/puente.php',
        type: 'POST',
        dataType: 'json',
        data: {option: 8,grupo:id},
        async: false ,
        cache: false,
    })
    .done(function(data) {
        contenedor.empty();
        contenedor.append('<option value="" >...</option>');
        $.each(data, function(i, val) {
            if (val.nombre == tipo_ant) 
            {
                id =  val.id;
                contenedor.append('<option value="'+val.id+'" selected>'+val.nombre+'</option>');
            }
            else
            {
                contenedor.append('<option value="'+val.id+'">'+val.nombre+'</option>');
            }
            
        });
        
    })
    .fail(function() {
        alert("Error en -> search_tipo_bien() ");
    });
    selected = id;
    return selected;
}
/*Buscar el material seleccionado*/
function search_material(mat_ant, contenedor)
{
    var id;
    $.ajax({
        url: 'controller/puente.php',
        type: 'POST',
        dataType: 'json',
        data: {option: 9},
        async: false ,
        cache: false,
    })
    .done(function(data) {
        contenedor.empty();
        contenedor.append('<option value="" disabled >...</option>');
        $.each(data, function(i, val) {
            if ( val.nombre == mat_ant ) 
            {
                id= val.id;
                contenedor.append('<option value="'+val.id+'" selected>'+val.nombre+'</option>');
            }
            else
            {
                contenedor.append('<option value="'+val.id+'">'+val.nombre+'</option>');
            }
        });
    })
    .fail(function() {
        alert("Error en -> search_tipo_material()");
    });
    selected = id;
    return selected;
}
/*Buscar y seleccionar el estado del bien*/
function search_estado(estado, contenedor) 
{
    contenedor.append('<option value ="">...</option>');
    if (estado == 'Nuevo') {
        contenedor.append('<option value ="1" selected>NUEVO</option>');
    }
    else
    {
        contenedor.append('<option value ="1" >NUEVO</option>');
    }
    if (estado == 'Bueno') {
        contenedor.append('<option value ="2" selected>BUENO</option>');
    }
    else
    {
        contenedor.append('<option value ="2" >BUENO</option>');
    }
    if (estado == 'Regular') {
        contenedor.append('<option value ="3" selected>REGULAR</option>');
    }
    else
    {
        contenedor.append('<option value ="3" >REGULAR</option>');
    }
    if (estado == 'Malo') {
        contenedor.append('<option value ="4" selected>MALO</option>');
    }
    else
    {
        contenedor.append('<option value ="4" >MALO</option>');
    }
    return false;
}
/*Buscar y seleccionar la marca del bien*/
function search_marca (marca, contenedor)
{
    $.ajax({
        url: 'controller/puente.php',
        type: 'POST',
        dataType: 'json',
        data: {option: 10},
        async: false ,
        cache: false,
    })
    .done(function(data) {
        contenedor.empty();
        contenedor.append('<option value="" disabled selected>...</option>');
        $.each(data, function(i, val) {
            if (marca == val.nombre) 
            {
                contenedor.append('<option value="'+val.id+'" selected>'+val.nombre+'</option>');
            }
            else
            {
                contenedor.append('<option value="'+val.id+'">'+val.nombre+'</option>');
            }
        });
    })
    .fail(function() {
        alert("Error durante la petición al servidor");
    });
    return false;
}
/*Buscar y seleccionar el modelo del bien*/
function search_modelo (modelo, contenedor)
{
    $.ajax({
        url: 'controller/puente.php',
        type: 'POST',
        dataType: 'json',
        data: {option: 11},
        async: false ,
        cache: false,
    })
    .done(function(data) {
        contenedor.empty();
        contenedor.append('<option value="" disabled selected>...</option>');
        $.each(data, function(i, val) {
            if (modelo == val.nombre) 
            {
                contenedor.append('<option value="'+val.id+'" selected>'+val.nombre+'</option>');
            }
            else
            {
                contenedor.append('<option value="'+val.id+'">'+val.nombre+'</option>');
            }
        });
    })
    .fail(function() {
        alert("Error durante la petición al servidor");
    });
    return false;
}
/*Buscar y seleccionar el modelo del bien*/
function search_color (color, contenedor)
{
    $.ajax({
        url: 'controller/puente.php',
        type: 'POST',
        dataType: 'json',
        data: {option: 12},
        async: false ,
        cache: false,
    })
    .done(function(data) {
        contenedor.empty();
        contenedor.append('<option value="" disabled >...</option>');
        $.each(data, function(i, val) {
            if (color == val.nombre.toUpperCase()) 
            {
                contenedor.append('<option value="'+val.id+'" selected>'+val.nombre.toUpperCase()+'</option>');
            }
            else
            {
                contenedor.append('<option value="'+val.id+'">'+val.nombre.toUpperCase()+'</option>');
            }
        });
    })
    .fail(function() {
        alert("Error durante la petición al servidor");
    });
    return false;
}
 /*Buscar y seleccionar el proveedor*/
function search_proveedor(proveedor,contenedor)
{
    $.ajax({
        url: 'controller/puente.php',
        type: 'POST',
        dataType: 'json',
        data: {option: 18},
        async: false ,
        cache: false,
    })
    .done(function(data) {
        contenedor.empty();
        contenedor.append('<option value="" disabled >...</option>');
        $.each(data, function(i, val) {
            if (proveedor == val.nombre) 
            {
                contenedor.append('<option value="'+val.id+'" selected>'+val.nombre.toUpperCase()+'</option>');
            }
            else
            {
                contenedor.append('<option value="'+val.id+'">'+val.nombre.toUpperCase()+'</option>');
            }
        });
    })
    .fail(function() {
        alert("Error durante la petición al servidor");
    });
    return false;
}
/*Buscar y seleccionar el grupo*/
function search_grupo(data,grupo) 
{
    $('#grupo_edit').empty();
    $('#grupo_edit').append('<option value="" disabled>...</option>');
    $.each(data, function(i, val) {
        if (val.nombre == grupo) 
        {
            grupo_id = val.id;
            $('#grupo_edit').append('<option value="'+val.id+'" selected>'+val.nombre+'</option>');
        }
        else
        {
            $('#grupo_edit').append('<option value="'+val.id+'">'+val.nombre+'</option>');
        }
    });
    selected = grupo_id;
    return selected;
}
/*Buscar y seleccionar al servidor publico*/
function search_asignacion(id)
{
    $.ajax({
        url: 'controller/puente.php',
        type: 'POST',
        dataType: 'json',
        data: {option: 47,bien:id},
        async: false ,
        cache: false,
    })
    .done(function(data) {
        
        $('#asignacion_id').val(data.asignacion_id);
        $('#servidor_edit').val(data.full_name);
        $('#servidor_id_edit').val(data.personal_id);
        /*Agregar el tipo de asignacion  guardado*/
        $('#t_asigna').empty('');
        $('#t_asigna').append('<option value="">...</option>');
        if (data.vigencia == 'Permanente') 
        {
            $('#t_asigna').append('<option value="1" selected>Permanente</option>');
            $('#t_asigna').append('<option value="2" >Temporal</option>');
        }
        else if(data.vigencia == 'Temporal')
        {
            $('#t_asigna').append('<option value="1" selected>Permanente</option>');
            $('#t_asigna').append('<option value="2" selected>Temporal</option>');
        }
        else
        {
            $('#t_asigna').append('<option value="1">Permanente</option>');
            $('#t_asigna').append('<option value="2">Temporal</option>');
        }
    })
    .fail(function() {
        console.log("error");
    });
    
    return false;
}
/*Preparar el formulario*/
/*Cargar de informacion para editar*/
function load_data_edit() 
{
    /*Buscar la info del bien seleccionado*/
    $('#frm_editar_bien').submit(function(e) {
        e.preventDefault();
        /*Recuperar la información del form*/
        var data_form = $(this).serialize();
        //alert(data_form);
        $.ajax({
            url: 'controller/puente.php',
            type: 'POST',
            dataType: 'json',
            data: data_form,
            async: false ,
            cache: false,
        })
        .done(function(data) {
            //console.log(data);
            if (data.message == 'success') 
            {
                $('#alert_success_edit').removeClass('hidden');
                $('#alert_error_edit').addClass('hidden');
                setTimeout(function () {
                    $('#alert_success_edit').addClass('hidden');
                },10000);
            }else{
               $('#alert_error_edit').removeClass('hidden');
               $('#alert_success_edit').addClass('hidden');
               setTimeout(function () {
                   $('#alert_error_edit').addClass('hidden');
               },10000); 
            }
            
            //$('#editar_bien_modal').modal('toggle');
            /*Recargar la pagina
            setTimeout(function () {
                location.reload();
            },5000);*/

        })
        .fail(function() {
            console.log("Error al actualizar los datos -> load_data_edit");
        });
        
    });
    
    return false;
}
/*Funcion para guardar marca*/
function save_marca() 
{
    $('#frm_add_marca').submit(function(e) {
        e.preventDefault();
        var data_form = $(this).serialize();
        $.ajax({
            url: 'controller/puente.php',
            type: 'POST',
            dataType: 'json',
            data: data_form,
            async: false ,
        cache: false,
        })
        .done(function(data) {
            if (data.message == 'success') {
                $('#marca_alert_success').removeClass('hidden');
                setTimeout(function (argument) {
                    $('#marca_alert_success').addClass('hidden');
                },5000);
            }else{
                $('#marca_alert_error').removeClass('hidden');
                setTimeout(function (argument) {
                    $('#marca_alert_error').addClass('hidden');
                },5000);
            }
        })
        .fail(function() {
            console.log("error");
        }).always(function(){
            document.getElementById("frm_add_marca").reset();
            load_marcas();
        });
        
    });
    return false;
}
/*Funcion para guardar modelo*/
function save_modelo() 
{
    $('#frm_add_modelo').submit(function(e) {
        e.preventDefault();
        var data_form = $(this).serialize();
        $.ajax({
            url: 'controller/puente.php',
            type: 'POST',
            dataType: 'json',
            data: data_form,
            async: false ,
        cache: false,
        })
        .done(function(data) {
            if (data.message == 'success') {
                $('#alert_success2').removeClass('hidden');
                setTimeout(function () {
                    $('#alert_success2').addClass('hidden');
                },5000);
            }else{
                $('#alert_error2').removeClass('hidden');
                setTimeout(function () {
                    $('#alert_error2').addClass('hidden');
                },5000);
            }
        })
        .fail(function() {
            console.log("error");
        }).always(function(){
            document.getElementById("frm_add_modelo").reset();
            load_modelos();
        });
        
    });
    return false;
}
/*Funcion para guardar color*/
function save_color() 
{
    $('#frm_add_color').submit(function(e) {
        e.preventDefault();
        var data_form = $(this).serialize();
        $.ajax({
            url: 'controller/puente.php',
            type: 'POST',
            dataType: 'json',
            data: data_form,
            async: false ,
        cache: false,
        })
        .done(function(data) {
            if (data.message == 'success') {
                $('#alert_success3').removeClass('hidden');
                setTimeout(function () {
                    $('#alert_success3').addClass('hidden');
                },5000);
            }else{
                $('#alert_error3').removeClass('hidden');
                setTimeout(function () {
                    $('#alert_error3').addClass('hidden');
                },5000);
            }
        })
        .fail(function() {
            console.log("error");
        }).always(function(){
            document.getElementById("frm_add_color").reset();
            load_colores();
        });
        
    });
    return false;
}

/*Formulario para guardar el registro de un proveedor*/
function save_proveedor() 
{
    var form = $('#frm_add_proveedor');
    var data_form ;

    form.submit(function(event) {
        event.preventDefault();
        data_form = $(this).serialize();
        $.ajax({
            url: 'controller/puente.php',
            type: 'POST',
            dataType: 'json',
            data: data_form,
            async: false ,
        cache: false,
        })
        .done(function(data) {
            if (data.message == 'success') {
                $('#alert_success5').removeClass('hidden');
                setTimeout(function () {
                    $('#alert_success5').addClass('hidden');
                },5000);
            }else{
                $('#alert_error5').removeClass('hidden');
                setTimeout(function () {
                    $('#alert_error5').addClass('hidden');
                },5000);
            }
            /*Resetear el formulario*/
            document.getElementById("frm_add_proveedor").reset();
            load_proveedores();
        })
        .fail(function() {
             alert("Error en el metodo save_bien() de main.bienes.js");
        });      
    });
}
/*Carga de lista de areas administrativas */
function select_areas() 
{
    $.ajax({
        url: 'controller/puente.php',
        type: 'POST',
        dataType: 'json',
        data: {option: 46},
        async: false ,
        cache: false,
    })
    .done(function(data) {
        $('#select_area').empty();
        $('#select_area').append('<option value="">BUSCAR Y/O SELECCIONAR UN ÁREA  </option>')
        $.each(data, function(i, area) {
            $('#select_area').append('<option value="'+area.id+'">'+area.nombre+'</option>')
        });
    })
    .fail(function() {
        console.log("error");
    });
    
    return false;
}
/*Carga de lista de personal en selects */
function select_personal() 
{
    $.ajax({
        url: 'controller/puente.php',
        type: 'POST',
        dataType: 'json',
        data: {option: 49},
        async: false ,
        cache: false,
    })
    .done(function(data) {
        $('#select_personal').empty();
        $('#select_personal').append('<option value="">...</option>')
        $.each(data, function(i, person) {
            $('#select_personal').append('<option value="'+person.id+'">'+person.full_name+'</option>')
        });
    })
    .fail(function() {
        console.log("error");
    });
    
    return false;
}
//Formulario de alta de personal
function frm_add_persona()
{
    $('#frm_add_persona').submit(function(e){
        e.preventDefault();
        var data_form = $(this).serialize();
        $.ajax({
            url: 'controller/puente.php',
            type: 'POST',
            dataType: 'json',
            data: data_form,
            async: false ,
        cache: false,
        })
        .done(function(data) {
            
            if (data.estado == 'error') 
            {
                $('#alert').addClass('alert-danger');
                $('i.icon').addClass('fa-ban');
                $('#alert').removeClass('hidden');
                $('#message').text(data.message);
                setTimeout(function(){
                    $('#alert').removeClass('alert-danger');
                    $('#alert').addClass('hidden');
                    $('#message').text('');
                    $('i.icon').removeClass('fa-ban');
                },5000);
            }else{
                $('#alert').addClass('alert-success');
                $('i.icon').addClass('fa-check');
                $('#alert').removeClass('hidden');
                $('#message').text(data.message);
                setTimeout(function(){
                    $('#alert').removeClass('alert-danger');
                    $('#alert').addClass('hidden');
                    $('#message').text('');
                    $('i.icon').removeClass('fa-ban');
                },5000);
            }
        })
        .fail(function() {
            console.log("error");
        }).always(function(){
            document.getElementById('frm_add_persona').reset();
        });
        
    });
    return false;
}
function changeCampo(val)
{
    try{
        if (val>0) {
            if (val == 1) {
                $('#campo_aux').empty();
                $('#campo_aux').append('<label>¿De que área?</label>');
                $('#campo_aux').append('<select id="encargado" name="encargado" class="form-control"></select>')
                var areas = call_areas();
                $.each(areas, function(index, area) {
                    $('#encargado').append('<option value="'+area.nombre+'">'+area.nombre+'</option>');
                });
            }else{
                $('#campo_aux').empty();
                $('#campo_aux').append('<label>¿Cuál es le nombre del puesto?</label>');
                $('#campo_aux').append('<input type="text" name="name_puesto" id="name_puesto" required onkeyup="mayus(this)" class="form-control">');
            }
        }else{
            throw 'Verificar tu opción del tipo de puesto';
        }
    }catch(err){
        alert('Error: ' +err);
    }
    return false;
}

function call_areas()
{
    var a ;
    $.ajax({
        url: 'controller/puente.php',
        type: 'POST',
        dataType: 'json',
        data: {option: 46},
        async: false ,
        cache: false,
    })
    .done(function(areas) {
       a = areas;
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        throw JSON.stringify(jqXHR);
    });
    return a;
}
/*Listado de personal*/
function personal() 
{
    if ( $.fn.dataTable.isDataTable( '#listadoPersonal' ) ) {
        $('#listadoPersonal').DataTable().destroy();
    }
    var t = $('#listadoPersonal').DataTable(
        {
            'language':
            {
                'url':'//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
            },
            'lengthMenu': [[10, 25, 50,100, -1], [10, 25, 50, 100, 'Todos']],
            
            dom: '<<"col-md-3"B><"#buscar.col-sm-4"f><"pull-right"l><t>pr>',
            buttons:{
                buttons: [
                    { extend: 'pdf', className: 'btn btn-flat btn-warning',text:' <i class="fa  fa-file-pdf-o"></i> Exportar a PDF' },
                    { extend: 'excel', className: 'btn btn-success btn-flat',text:' <i class="fa fa-file-excel-o"></i> Exportar a Excel' }
                ]
            } 
        }
    );
    
    $.ajax({
        url: 'controller/puente.php',
        type: 'POST',
        dataType: 'json',
        data: {option: '51'},
        async: false ,
        cache: false,
    })
    .done(function(data) {
        t.clear().draw();
        $.each(data, function(i, val) {
            puestos = getPuesto(val.id);
            if(puestos.length > 0 ){
                var puesto = ''; 
                $.each( puestos , function(index, p) {
                    puesto += ''+p.nombre+' <b>/</b> ';
                });
                
            }else{
                puesto = '<label>Sin puesto</label>';
            }
            /*******DEFINIENDO LOS BOTONES DE ACCIÓN****************************************/
            var acciones = 
            '<div class="btn-group">'+
              
              '<button type="button" class="btn btn-success btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false">'+
                '<span class="caret"></span>'+
                '<span class="sr-only">Toggle Dropdown</span>'+
              '</button>'+
              '<ul class="dropdown-menu" role="menu">'+
                '<li><a href="#" onclick="modal_edit_user('+val.id+');">Editar</a></li>'+
                '<li><a href="#" onclick="modal_puesto('+val.id+');">Asignar puesto</a></li>'+
                '<li class="divider"></li>'+
                '<li ><a href="#"><label class="text-red">Dar de baja</label></a></li>'+
                '<li ><a href="#" onclick="modal_del_puestos('+val.id+')"><label class="text-red">Eliminar puestos</label></a></li>'+
              '</ul>'+
            '</div>'
            ;
            /***********************************************/
            t.row.add([
                acciones,
                val.id,
                val.full_name,
                val.area,
                puesto
                   
            ]).draw(false);
            $('tbody>tr').addClass('text-center');
        });
        
    })
    .fail(function() {
        console.log("error");
    });
    
    return false;
}
/*Recuperar la lista de puestos de la persona*/
function getPuesto(p)
{
    var result;
    $.ajax({
        url: 'controller/puente.php',
        type: 'POST',
        dataType: 'json',
        data: {option: 52,persona:p},
        async: false ,
        cache: false,
    })
    .done(function(data) {
        result = data;
    })
    .fail(function() {
        console.log("error");
    });
    return result;
}
/*Metodo para salvar el  puesto de una persona*/
function savePuesto(p) 
{
    $.ajax({
        url: 'controller/puente.php',
        type: 'POST',
        dataType: 'json',
        data: {option: 53,persona:p},
    })
    .done(function(data) {
        if (data.estado == 'success') 
        {
            alert('El puesto a sigo guardado exitosamente');
        }else{
            alert(data.message);
        }
    })
    .fail(function() {
        console.log("error");
    })
    .always(function() {
        console.log("complete");
    });
    
    return false;
}
/*formulario de alta de puesto */
function frm_add_puesto ()
{
    $('#frm_add_puesto').submit(function(e) {
        e.preventDefault();
        var data_form = $(this).serialize();
        //alert(data_form);
        $.ajax({
            url: 'controller/puente.php',
            type: 'POST',
            dataType: 'json',
            data: data_form,
        })
        .done(function(data) {
            if (data.estado == "success") 
            {
                $('#alert').addClass('alert-success');
                $('#alert').removeClass('hidden');
                $('#message').text(data.message);
                setTimeout(function(){
                    $('#alert').removeClass('alert-success');
                    $('#alert').addClass('hidden');
                    $('#message').text('');
                    
                },5000);
            }
            else
            {
                $('#alert').addClass('alert-danger');
                $('#alert').removeClass('hidden');
                $('#message').text(data.message);
                setTimeout(function(){
                    $('#alert').removeClass('alert-danger');
                    $('#alert').addClass('hidden');
                    $('#message').text('');

                },5000);
            }
            $('#campo_aux').empty();
            document.getElementById('frm_add_puesto').reset();
            personal();
        })
        .fail(function() {
            console.log("error");
        });
        
    });
    return false;
}

function mayus(e) {
    e.value = e.value.toUpperCase();    
}
/*Funcion para eleminar un puesto de una persona */
function del_puesto(puesto)
{
    
    $.ajax({
        url: 'controller/puente.php',
        type: 'POST',
        dataType: 'json',
        data: {option: 55,puesto:puesto},
    })
    .done(function(data) {
        if ( data.estado == 'success' ) 
        {
            $('#'+puesto).hide(3000);
        }
        else
        {
            $('#alert_puestos').addClass('alert-danger');
            $('#alert_puestos').removeClass('hidden');
            $('#message').text('Error'+data.message);
            setTimeout(function(){
                $('#alert_puestos').removeClass('alert-danger');
                $('#alert_puestos').addClass('hidden');
                $('#message').text('');
            },5000);
        }
        personal();
    })
    .fail(function() {
        console.log("error");
    });
    
    return false;
}

function search_puestos(person) 
{
    var t = $('#list_puestos');
    $.ajax({
        url: 'controller/puente.php',
        type: 'POST',
        dataType: 'json',
        data: {option: 54,persona:person},
        async:false,
    })
    .done(function(data) {
        $('#list_puestos tbody').empty();
        if (data.length >0) 
        {
            $.each(data, function(index, val) {
                t.append(
                '<tr id="'+val.id+'">'+
                    '<td>'+val.nombre +'</td>'+
                    '<td class="text-center">'+
                        '<div class="btn-group">'+
                            '<button type="button" class="btn btn-danger btn-flat" onclick="del_puesto('+val.id+')"><i class="fa fa-times"></i></button>'+
                        '</div>'+
                    '</td>'+
                '</tr>'
                );
            });
        }
        else
        {
            t.append(
            '<tr class="text-center">'+
                '<td colspan="2"><b>SIN RESULTADOS</b></td>'+
            '</tr>'
            );
        }
    })
    .fail(function() {
        alert("Error al buscar los puestos.");
    });
    
    return false;
}
//buscar los bienes de un servidor publico
function frm_buscar_bienes()
{
    var frm = $('#frm_buscar_bienes');
    var data_form ;
    frm.submit(function(e){
        e.preventDefault();
        data_form = $(this).serialize();
        $.ajax({
            url: 'controller/puente.php',
            type: 'POST',
            dataType: 'json',
            data: data_form,
        })
        .done(function(data) {
            console.log(data);
        })
        .fail(function() {
            console.log("error");
        });
        
    });
    return false;
}
//Alta de solicitudes
function frm_alta_ticket() 
{
    $('#alta_ticket').submit(function(e) {
        e.preventDefault();
        var data_form = $(this).serialize();
        //alert( "Data del formulario:"+$(this).serialize() );
        $.ajax({
            url: 'controller/puente.php',
            type: 'POST',
            dataType: 'json',
            data: data_form,
        })
        .done(function(data) {
            //alert(data);
            if (data['status'] == 200) {
                $('#alert_ok').removeClass('hidden');
                /*ocultar nuevamente la alerta*/
                setTimeout(function(){
                    $('#alert_ok').addClass('hidden');
                    document.getElementById("alta_ticket").reset(); 
                },6000);
            }
            if (data['status'] == 500) {
                $('#alert_error').removeClass('hidden');
                $('#desc_error').text( data['mensaje'] );
                /*ocultar nuevamente la alerta*/
                setTimeout(function(){
                    $('#alert_error').addClass('hidden');
                    document.getElementById("alta_ticket").reset(); 
                },6000);
            }

        })
        .fail(function() {
            alert( 'Hubo un problema con el controlador, actualice la página y si el problema persiste, contacte a Desarrollo de sistemas' );
        })
        ;
        
    });
}

//DAR DE BAJA UN BIEN 
function modal_baja(bien) 
{
    //Abrir el modal de bajas
    $('#modal_bajas').modal('toggle');
    $('#bien_id').val(bien);
    return false;
}

function frm_bajas()
{
    var form = $('#frm_bajas');
    form.submit(function(e){
        e.preventDefault();
        $.ajax({
            url: 'controller/puente.php',
            type: 'POST',
            dataType: 'json',
            data: $(this).serialize(),
            async: false,
        })
        .done(function(data) {
            if (data.estado == "success") 
            {
                $('#modal_alert').addClass('alert-success');
                $('#modal_alert').removeClass('hidden');
                $('#modal_alert>p#message').text(data.message);
                setTimeout(function(){
                    $('#modal_alert').removeClass('alert-success');
                    $('#modal_alert').addClass('hidden');
                    $('#modal_alert>p#message').text('');
                }, 5000);
            }else{
                $('#modal_alert').addClass('alert-danger');
                $('#modal_alert').removeClass('hidden');
                $('#modal_alert>p#message').text(data.message);
                setTimeout(function(){
                    $('#modal_alert').removeClass('alert-danger');
                    $('#modal_alert').addClass('hidden');
                    $('#modal_alert>p#message').text('');
                }, 5000);
            }
            //Reiniciar el formulario 
            document.getElementById('frm_bajas').reset();
        })
        .fail(function() {
            console.log("Error al dar de baja ");
        });
    });
    return false;
}
//Formulario de alta de garantias
function frm_add_garantia()
{
    var form = $('#frm_add_garantia');
    form.submit(function(e){
        e.preventDefault();
        $.ajax({
            url: 'controller/puente.php',
            type: 'POST',
            dataType: 'json',
            data: form.serialize(),
        })
        .done(function(data) {
            if (data.estado == 'success') 
            {
                $('#modal_alert').addClass('alert-success');
                $('#modal_alert').removeClass('hidden');
                $('#modal_alert > p#message').text(data.message);
                setTimeout(function(){
                    $('#modal_alert').removeClass('alert-success');
                    $('#modal_alert').addClass('hidden');
                    $('#modal_alert > p#message').text('');
                },5000);
            }
            else
            {
                $('#modal_alert').addClass('alert-danger');
                $('#modal_alert').removeClass('hidden');
                $('#modal_alert > p#message').text('Error '+data.message);
                setTimeout(function(){
                    $('#modal_alert').removeClass('alert-danger');
                    $('#modal_alert').addClass('hidden');
                    $('#modal_alert > p#message').text('');
                },5000);
            }
        })
        .fail(function() {
            console.log("error");
        });
        
    });
    return false;
}

//Listado de equipos que requieren de reparacion externa
function requieren_repa_externa()
{
    
    if ( $.fn.dataTable.isDataTable( '#tbl_sin_reparar' ) ) {
        $('#tbl_sin_reparar').DataTable().destroy();
    }
    var t = $('#tbl_sin_reparar').DataTable(
        {
            'language':
            {
                'url':'//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
            },
            'lengthMenu': [[10, 25, 50,100, -1], [10, 25, 50, 100, 'Todos']],
            
            dom: '<<"col-md-3"B><"#buscar.col-sm-4"f><"pull-right"l><t>pr>',
            buttons:{
                buttons: [
                    { extend: 'pdf', className: 'btn btn-flat btn-warning',text:' <i class="fa  fa-file-pdf-o"></i> Exportar a PDF' },
                    { extend: 'excel', className: 'btn btn-success btn-flat',text:' <i class="fa fa-file-excel-o"></i> Exportar a Excel' }
                ]
            } 
        }
    );
    $.ajax({
        url: 'controller/puente.php',
        type: 'POST',
        dataType: 'json',
        data: {option: '59'},
        async:false,
    })
    .done(function(bienes) {
        //$('#tbl_sin_reparar tbody').empty();
        $.each(bienes, function(i, bien) {
            var acciones ='<div class="btn-group ">'+
                '<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">'+
                    '<span class="caret"></span>'+
                    '<span class="sr-only">Toggle Dropdown</span>'+
                '</button>'+
                '<ul class="dropdown-menu" role="menu">'+
                    '<li><a href="#" onclick="modal_reparar('+bien.id+');">Mandar a reparar</a></li>'+
                    
                '</ul>'+
            '</div>';
            var detalle = 
                    '<ul>'+
                        '<li><label>Marca:      </label>  '+bien.marca+' </li>'+
                        '<li><label>Modelo:     </label> ' +bien.modelo+'  </li>'+
                        '<li><label>Serie:      </label>  '+bien.serie+' </li>'+
                        '<li><label>Inventario: </label>  '+bien.inventario+' </li>'+
                    '</ul>';
            /*Agregar la info a la tabla*/
            t.row.add( [
                    acciones,
                    bien.id,
                    detalle,
                    bien.asignadoa
            ] ).draw( false );
            
        });
    })
    .fail(function() {
        console.log("error");
    });
    
    return false;
}

function modal_reparar(bien)
{
    $('#modal_repara_externo').modal('toggle');
    $('#externo_bien_id').val(bien);
    return false;
}

//Mostrar listado de bienes con refacciones
function bienes_c_refaccion()
{
    
    if ( $.fn.dataTable.isDataTable( '#tbl_bienes_c_refa' ) ) {
        $('#tbl_bienes_c_refa').DataTable().destroy();
    }
    var t = $('#tbl_bienes_c_refa').DataTable(
        {
            'language':
            {
                'url':'//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
            },
            'lengthMenu': [[10, 25, 50,100, -1], [10, 25, 50, 100, 'Todos']],
            
            dom: '<<"col-md-3"B><"#buscar.col-sm-4"f><"pull-right"l><t>pr>',
            buttons:{
                buttons: [
                    { extend: 'pdf', className: 'btn btn-flat btn-warning',text:' <i class="fa  fa-file-pdf-o"></i> Exportar a PDF' },
                    { extend: 'excel', className: 'btn btn-success btn-flat',text:' <i class="fa fa-file-excel-o"></i> Exportar a Excel' }
                ]
            } 
        }
    );

    $.ajax({
        url: 'controller/puente.php',
        type: 'POST',
        dataType: 'json',
        data: {option: '60'},
        async:false,
    })
    .done(function(bienes) {
        //LImpiar tabla
        t.clear().draw();
        if (bienes.estado == 'error') {
            
            console.log(bienes.message);
        }
        else
        {        
            $.each(bienes, function(i, bien) {
                var acciones =
                '<div class="btn-group ">'+
    '              <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">'+
    '                <span class="caret"></span>'+
    '                <span class="sr-only">Toggle Dropdown</span>'+
    '              </button>'+
    '              <ul class="dropdown-menu" role="menu">'+
    '                <li><a href="#" onclick="modal_edit_refaccion('+bien.id+');">Ver y Editar refacciones</a></li>'+
    '              </ul>'+
    '            </div>' ;
    var asignado;
    if (bien.asignadoa == null) {
        asignado = 'SIN ASIGNAR';
    }
    else
    {
        asignado = bien.asignadoa;
    }
                var detalle = 
                        '<ul>'+
                            '<li><label>Marca:      </label>  '+bien.marca+' </li>'+
                            '<li><label>Modelo:     </label> '+bien.modelo+'  </li>'+
                            '<li><label>Serie:      </label>  '+bien.serie+' </li>'+
                            '<li><label>Inventario: </label>  '+bien.inventario+' </li>'+
                            '<li><label>Asignado a: </label>  '+asignado+' </li>'+
                        '</ul>';
                t.row.add( [
                    acciones,
                    bien.id,
                    detalle
                ] ).draw( false );
            });
        }

        
    })
    .fail(function() {
        console.log("error");
    });
    return false;
}

function search_refaccion(bien)
{
    var t = $('#tbl_refacciones');

    $.ajax({
        url: 'controller/puente.php',
        type: 'POST',
        dataType: 'json',
        data: {option: '61',bien:bien},
        async:false,
    })
    .done(function(refacciones) {

        $('#tbl_refacciones tbody').empty();
        $.each(refacciones, function(i, refaccion) {
            
            var detalle = 
                    '<ul>'+
                        '<li><label>Marca:      </label>  '+refaccion.marca+' </li>'+
                        '<li><label>Modelo:     </label> '+ refaccion.modelo+'  </li>'+
                        '<li><label>Serie:      </label>  '+refaccion.serie+' </li>'+
                        '<li><label>Inventario: </label>  '+refaccion.inventario+' </li>'+
                        '<li><label>Tipo: </label>  '+refaccion.tipo+' </li>'+
                    '</ul>';
            var del =
            '<button type="button" class="btn btn-flat btn-danger" data-toggle="tooltip" title="Eliminar esta asignacion de refacción" onclick="del_refaccion('+refaccion.ref+');">'+
                '<i class="fa fa-times"></i>'+
            '</button>'
            ;
            t.append(
                '<tr id="'+refaccion.ref+'">'+
                    '<td>'+(i+1)+'</td>'+
                    '<td>'+detalle+'</td>'+
                    '<td>'+del+'</td>'+
                '</tr>'
            );
        });
    })
    .fail(function() {
        console.log("error");
    });
    return false;
}

function bajaTemporal   (bien)
{
    //pedir el comentario 
    var comentario = prompt('¿Porque quiere dar de baja este Bien?');
    if (comentario == null) {
        bajaTemporal(bien);
    }else{
        $.ajax({
            url: 'controller/puente.php',
            type: 'POST',
            dataType: 'json',
            data: {option: '64',bien_id:bien,comment:comentario},
            async:false,
        })
        .done(function(data) {
            if(data.estado == 'success'){
                $('#alert').addClass('alert-success');
                $('#alert').removeClass('hidden');
                $('#message').text(data.message);
                setTimeout(function(){
                    $('#alert').removeClass('alert-success');
                    $('#alert').addClass('hidden');
                    $('#message').text('');
                },5000);
            }else{
                $('#alert').addClass('alert-danger');
                $('#alert').removeClass('hidden');
                $('#message').text(data.message);
                setTimeout(function(){
                    $('#alert').removeClass('alert-danger');
                    $('#alert').addClass('hidden');
                    $('#message').text('');
                },5000);
            }
            bien_bajas();
        })
        .fail(function() {
            console.log("error");
        });
        
    }
    return false;
}
function bajaDefinitiva (bien)
{
    //pedir el comentario 
    var comentario = prompt('¿Porque quiere dar de baja este Bien?');
    if (comentario == null) {
        bajaDefinitiva(bien);
    }else{
        $.ajax({
            url: 'controller/puente.php',
            type: 'POST',
            dataType: 'json',
            data: {option: '65',bien_id:bien,comment:comentario},
            async:false,
        })
        .done(function(data) {
            if(data.estado == 'success'){
                $('#alert').addClass('alert-success');
                $('#alert').removeClass('hidden');
                $('#message').text(data.message);
                setTimeout(function(){
                    $('#alert').removeClass('alert-success');
                    $('#alert').addClass('hidden');
                    $('#message').text('');
                },5000);
            }else{
                $('#alert').addClass('alert-danger');
                $('#alert').removeClass('hidden');
                $('#message').text(data.message);
                setTimeout(function(){
                    $('#alert').removeClass('alert-danger');
                    $('#alert').addClass('hidden');
                    $('#message').text('');
                },5000);
            }
            bien_bajas();
        })
        .fail(function() {
            console.log("error");
        });
    }
    return false;
}
//cargar la llista de bienes de baja

function bien_bajas() 
{
    var t = $('#tbl_bajas');
    if ( $.fn.dataTable.isDataTable( '#tbl_bajas' ) ) {
        $('#tbl_bajas').DataTable().destroy();
    }
    
    $.ajax({
        url: 'controller/puente.php',
        type: 'POST',
        dataType: 'json',
        data: {option: '67'},
        async:false,
    })
    .done(function(bajas) {
        $('#tbl_bajas tbody').empty();
        //console.log(bajas);
        if (bajas.length > 0 ) 
        {
            $.each(bajas, function(i, baja) {
                var accion,detalle ,clase_row;
                //saber el tipo de baja
                if (baja.t_baja == 'Temporal') 
                {
                    accion = 
                    '<div class="btn-group">'+
                        '<button type="button" class="btn btn-success btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false">'+
                        '<span class="caret"></span>'+
                        '<span class="sr-only">Toggle Dropdown</span>'+
                        '</button>'+
                        '<ul class="dropdown-menu" role="menu">'+
                            '<li><a href="#" onclick="UpdateBajaDefinitiva('+baja.baja_id+');">Baja definitiva</a></li>'+
                        '</ul>'+
                    '</div>' ;
                    clase_row = 'class="bg-yellow "';
                }
                else
                {
                    accion = '';
                    clase_row= 'class="bg-red-active "';
                }
                //Formar la lista de caracteristicas del bien
                detalle = 
                '<ul>'+
                    '<li><label>Serie: </label> '+baja.serie+'</li>'+
                    '<li><label>Inventario: </label> '+baja.inventario+'</li>'+
                    '<li><label>Marca: </label> '+baja.marca+'</li>'+
                    '<li><label>Grupo: </label> '+baja.grupo+'</li>'+
                    '<li><label>Modelo: </label> '+baja.modelo+'</li>'+
                    '<li><label>Color: </label> '+baja.color+'</li>'+
                    '<li><label>Material: </label> '+baja.material+'</li>'+
                    '<li><label>Comentario: </label> '+baja.comentario+'</li>'+
                    '<li><label>Estatus: </label> '+baja.status+'</li>'+
                '</ul>'    ;
                t.append(
                    '<tr '+clase_row+'>'+
                        '<td>'+accion+'</td>'+
                        '<td>'+baja.id+'</td>'+
                        '<td>'+detalle+'</td>'+
                        '<td>'+baja.t_baja+'</td>'+
                    '</tr>'
                );

            });

        }else{
            t.append('<tr> <td colspan="4"> <center>NO HAY BIENES DADOS DE BAJA</center> </td> </tr>');
        }
    })
    .fail(function() {
        console.log("error");
    })
    .always(function() {
        $('#tbl_bajas').DataTable(
            {
                'language':
                {
                    'url':'//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
                },
                'lengthMenu': [[10, 25, 50,100, -1], [10, 25, 50, 100, 'Todos']],
                
                dom: '<<"col-md-3"B><"#buscar.col-sm-4"f><"pull-right"l><t>pr>',
                buttons:{
                    buttons: [
                        { extend: 'pdf', className: 'btn btn-flat btn-warning',text:' <i class="fa  fa-file-pdf-o"></i> Exportar a PDF' },
                        { extend: 'excel', className: 'btn btn-success btn-flat',text:' <i class="fa fa-file-excel-o"></i> Exportar a Excel' }
                    ]
                } 
            }
        );
    });
    
    return false;
}

function UpdateBajaDefinitiva(baja_id)
{
    $('#modal_baja_definitiva').modal('toggle');  
    $('#baja_id').val(baja_id);
    return false;
}

//Asignar refacciones a un bien 
function frm_asignar_refacciones()
{
    var form = $('#frm_asignar_refacciones');
    form.submit(function(e){
        e.preventDefault();
        $.ajax({
            url: 'controller/puente.php',
            type: 'POST',
            dataType: 'json',
            data: new FormData(this),
            cache:false,
            async:false,
            processData: false,
            contentType: false,
        })
        .done(function(info) {
            if (info.estado == 'success') 
            {
                $('#refaccion_alert').removeClass('hidden');
                $('#refaccion_alert').addClass('alert-success');
                $('#refaccion_message').text(info.message);
                setTimeout(function(){
                    $('#refaccion_alert').addClass('hidden');
                    $('#refaccion_alert').removeClass('alert-success');
                    $('#refaccion_message').text('');
                },5000);
            }else{
                $('#refaccion_alert').removeClass('hidden');
                $('#refaccion_alert').addClass('alert-danger');
                $('#refaccion_message').text(info.message);
                setTimeout(function(){
                    $('#refaccion_alert').addClass('hidden');
                    $('#refaccion_alert').removeClass('alert-danger');
                    $('#refaccion_message').text('');
                },5000);
            }
            document.getElementById('frm_asignar_refacciones').reset();
        })
        .fail(function( jqXHR, textStatus, errorThrown) {
            alert(errorThrown);
        });
        
    });
    return false;
}
//Agregar los  bienes a las listas 
function select_bienes() 
{
    $.ajax({
        url: 'controller/puente.php',
        type: 'POST',
        dataType: 'json',
        data: {option: '69'},
    })
    .done(function(data) {
        $('select.bienes').empty();
        $('select.bienes').append(
            '<option value="">...</option>'
        );
        $.each(data, function(index, val) {
            $('#bien,#refaccion').append(
                '<option value="'+val.id+'">'+val.claves+'</option>'
            );
        });
    })
    .fail(function() {
        console.log("error");
    });
    
    return false;
}
/**/
function toggle_div_documento(option) 
{
    if (option == 2) 
    {
        $('#div_documento').addClass('hidden');
        $('[name="tipo_formato"] , [name="formato"]').removeAttr('required');
    }
    else if( option == 1)
    {
        $('#div_documento').removeClass('hidden');
        $('[name="tipo_formato"] , [name="formato"]').attr('required', '');
    }
    else
    {
        $('#div_documento').addClass('hidden');
    }
    return false;
}

/**/
function frm_repara_ext() 
{
    var form = $('#frm_repara_ext');
    form.submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: 'controller/puente.php',
            type: 'POST',
            dataType: 'json',
            data: new FormData(this),
            async:false,
            cache:false,
            processData: false,
            contentType: false,
        })
        .done(function(data) {
            if (data.estado == 'success') 
            {
                $('#modal_re_alert').addClass('alert-success');
                $('#modal_re_alert').removeClass('hidden');
                $('#message_re').text(data.message);
                setTimeout(function(){
                    $('#modal_re_alert').removeClass('alert-success');
                    $('#modal_re_alert').addClass('hidden');
                    $('#message_re').text('');
                },5000);
            }else{
                $('#modal_re_alert').addClass('alert-danger');
                $('#modal_re_alert').removeClass('hidden');
                $('#message_re').text(data.message);
                setTimeout(function(){
                    $('#modal_re_alert').removeClass('alert-danger');
                    $('#modal_re_alert').addClass('hidden');
                    $('#message_re').text('');
                },5000);
            }
            window.location.href = '#message_re';
            document.getElementById('frm_repara_ext').reset();
            $('#modal_repara_externo').modal('toggle');
            requieren_repa_externa();
        })
        .fail(function() {
            alert("Ocurrio un error al guardar la reparacion externa");
        });
        
    });
}
function load_proveedores_garantias() 
{
    var pro = $('[name="proveedor_garantia"]');
    $.ajax({
        url: 'controller/puente.php',
        type: 'POST',
        dataType: 'json',
        data: {option: 72},
        async: false ,
        cache: false,
    })
    .done(function(data) {
        pro.empty();
        pro.append('<option value="" disabled selected>...</option>');
        $.each(data, function(i, val) {
            pro.append('<option value="'+val.id+'">'+val.nombre.toUpperCase()+'</option>');
        });
    })
    .fail(function() {
        alert("Error durante la petición al servidor");
    });
    return false;
}

function tbl_reparaciones_activas()
{
    if ( $.fn.dataTable.isDataTable( '#tbl_reparaciones_activas' ) ) {
        $('#tbl_reparaciones_activas').DataTable().destroy();
    }
    

    $.ajax({
        url: 'controller/puente.php',
        type: 'POST',
        dataType: 'json',
        data: {option: '73'},
        async:false,
    })
    .done(function(activas) {

        $('#tbl_reparaciones_activas tbody').empty();
        //console.log(bajas);
        if (activas.length > 0 ) 
        {
            $.each(activas, function(i, activa) {
                var accion,detalle ,clase_row;
                //saber el tipo de baja
                if (activa.estatus == 'En proceso') 
                {
                    accion = 
                    '<div class="btn-group">'+
                        '<button type="button" class="btn btn-success btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false">'+
                        '<span class="caret"></span>'+
                        '<span class="sr-only">Toggle Dropdown</span>'+
                        '</button>'+
                        '<ul class="dropdown-menu" role="menu">'+
                            '<li><a href="#" onclick="modal_adjuntar('+activa.id+','+activa.id_re+');">Adjuntar un documento</a></li>'+
                            '<li><a href="#" onclick="equipo_reparado('+activa.id_re+');">Equipo reparado</a></li>'+
                        '</ul>'+
                    '</div>' ;
                    //clase_row = 'class="bg-yellow "';
                }
                else
                {
                    accion = '';
                    //clase_row= 'class="bg-red-success "';
                }
                //Formar la lista de caracteristicas del bien
                detalle = 
                '<ul>'+
                    '<li><label>Serie: </label> '+activa.serie+'</li>'+
                    '<li><label>Inventario: </label> '+activa.inventario+'</li>'+
                    '<li><label>Marca: </label> '+activa.marca+'</li>'+
                    '<li><label>Grupo: </label> '+activa.grupo+'</li>'+
                    '<li><label>Modelo: </label> '+activa.modelo+'</li>'+
                    '<li><label>Color: </label> '+activa.color+'</li>'+
                    '<li><label>Material: </label> '+activa.material+'</li>'+
                    
                    '<li><label>Estatus: </label> '+activa.estatus+'</li>'+
                '</ul>'    ;
                var deta_repa = 
                '<ul>'+
                    '<li><label>Fecha de solicitud: </label> '+activa.f_solicitud+'</li>'+
                    '<li><label>Fecha de reparación: </label> '+activa.f_reparacion+'</li>'+
                    '<li><label>Número de reporte: </label> '+activa.reporte+'</li>'+
                    '<li><label>Estado: </label> '+activa.estatus+'</li>'+
                    '<li><label>Observaciones: </label> '+activa.observaciones+'</li>'+
                    '<li><label>Tipo : </label> '+activa.tipo+'</li>'+
                '</ul>'    ;
                $('#tbl_reparaciones_activas').append(
                    '<tr >'+
                        '<td>'+accion+'</td>'+
                        '<td>'+activa.id+'</td>'+
                        '<td>'+detalle+'</td>'+
                        '<td>'+deta_repa+'</td>'+
                    '</tr>'
                );
            });
        }
    })
    .fail(function() {
        console.log("error");
    })
    .always(function() {
        var t = $('#tbl_reparaciones_activas').DataTable(
                {
                    'language':
                    {
                        'url':'//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
                    },
                    'lengthMenu': [[10, 25, 50,100, -1], [10, 25, 50, 100, 'Todos']],
                    
                    dom: '<<"col-md-3"B><"#buscar.col-sm-4"f><"pull-right"l><t>pr>',
                    buttons:{
                        buttons: [
                            { extend: 'pdf', className: 'btn btn-flat btn-warning',text:' <i class="fa  fa-file-pdf-o"></i> Exportar a PDF' },
                            { extend: 'excel', className: 'btn btn-success btn-flat',text:' <i class="fa fa-file-excel-o"></i> Exportar a Excel' }
                        ]
                    } 
                }
            );
    });
    return false;
}

function frm_adjuntar() 
{
    $('#frm_adjuntar').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: 'controller/puente.php',
            type: 'POST',
            dataType: 'json',
            data: new FormData(this),
            async:false,
            cache:false,
            processData: false,
            contentType: false,
        })
        .done(function(data) {
            if (data.estado == 'success') 
            {
                $('#adjuntar_alert').addClass('alert-success');
                $('#adjuntar_alert').removeClass('hidden');
                $('#adjuntar_message').text(data.message);
                setTimeout(function(){
                    $('#adjuntar_alert').removeClass('alert-success');
                    $('#adjuntar_alert').addClass('hidden');
                    $('#adjuntar_message').text('');
                    $('#modal_adjuntar').modal('toggle');
                },5000);
            }else{
                $('#adjuntar_alert').addClass('alert-danger');
                $('#adjuntar_alert').removeClass('hidden');
                $('#adjuntar_message').text(data.message);
                setTimeout(function(){
                    $('#adjuntar_alert').removeClass('alert-danger');
                    $('#adjuntar_alert').addClass('hidden');
                    $('#adjuntar_message').text('');
                    $('#modal_adjuntar').modal('toggle');
                },5000);
            }
            window.location.href = '#adjuntar_message';
            document.getElementById('frm_repara_ext').reset();
            
            requieren_repa_externa();
        })
        .fail(function() {
            alert("Ocurrio un error al guardar la reparacion externa");
        });
    });
    return false;
}

function frm_baja_definitiva()
{
    $('#frm_baja_definitiva').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: 'controller/puente.php',
            type: 'POST',
            dataType: 'json',
            data: new FormData(this),
            cache:false,
            async:false,
            processData: false,
            contentType: false,
        })
        .done(function(data) {
            if (data.estado == 'success') {
                $('#alert_baja_definitiva').addClass('alert-success');
                $('#alert_baja_definitiva').removeClass('hidden');
                $('#message_baja_definitiva').text(data.message);
                setTimeout(function(){
                    $('#alert_baja_definitiva').removeClass('alert-success');
                    $('#alert_baja_definitiva').addClass('hidden');
                    $('#message_baja_definitiva').text('');
                },5000);
                document.getElementById('frm_baja_definitiva').reset(); 
                bien_bajas();
            }
        })
        .fail(function() {
            console.log("error");
        });
    });
    return false;
}

function autocomplete_series()
{
    $( "#serie" ).autocomplete({
        autoFocus:true,
        source: 'controller/puente.php?option=4',
        select: function( event, ui ){
            $('#serie_id').val(ui.item.id);
        },
        search: function (event, ui) { 
             $('#serie_id').val('');
        },
        delay:0
    });
    return false;
}
function autocomplete_inventario()
{
    $( "#inventario" ).autocomplete({
        autoFocus:true,
        source: 'controller/puente.php?option=5',
        select: function( event, ui ){
            $('#inventario_id').val(ui.item.id);
        },
        search: function (event, ui) { 
             $('#inventario_id').val('');
        },
        delay:0
    });
    return false;
}

function frm_r_equipo()
{
    $('#frm_r_equipo').submit(function(e) {
        e.preventDefault();
        if ( $.fn.dataTable.isDataTable( '#tbl_reporte_equipo' ) ) {
            $('#tbl_reporte_equipo').DataTable().destroy();
        }
        
        var data_form = $(this).serialize();
        $.ajax({
            url: 'controller/puente.php',
            type: 'POST',
            dataType: 'json',
            data: data_form,
            cache:false,
            async:false,
        })
        .done(function(info) {
            if (info.error == 'error') 
            {
                $('#tbl_reporte_equipo body').append('<tr> <td colspan="7">NO SE ENCONTRARON REGISTROS</td> </tr>')
            }
            else
            {
                $('#tbl_reporte_equipo tbody').empty();
                var estado; 
                var asignado;
                
                $.each(info, function(i, inf) {
                    if(inf.status == 'Baja')
                    {
                        estado = '<span class="label label-danger">BAJA</span>';
                    }else if(inf.status == 'Nuevo'){
                        estado = '<span class="label label-info">NUEVO</span>';
                    }else if(inf.status == 'Bueno'){
                        estado = '<span class="label label-success">BUENO</span>';
                    }else if(inf.status == 'Malo'){
                        estado = '<span class="label label-danger">MALO</span>';
                    }else if(inf.status == 'Regular'){
                        estado = '<span class="label label-warning">REGULAR</span>';
                    }

                    if (inf.asignadoa == null ) {
                        asignado = 'SIN ASIGNAR'
                    }else{
                        asignado = inf.asignadoa;
                    }
                    $('#tbl_reporte_equipo tbody').append(
                        '<tr>'+
                            '<td>'+inf.id+'</td>'+
                            '<td>'+inf.tipo+'</td>'+
                            '<td>'+inf.marca +''+(inf.modelo)+'</td>'+
                            '<td>Inventario: '+inf.inventario+'<br> Serie:'+inf.serie+'</td>'+
                            '<td>'+estado+'</td>'+
                            '<td>'+inf.desc_ub+'</td>'+
                            '<td>'+asignado+'</td>'+
                        '</tr>'
                    );
                });
            }
        })
        .fail(function() {
            console.log("No sirve el fomulario de reporte por equipo.");
        }).always(function(){
            $('#tbl_reporte_equipo').DataTable(
                {
                    'language':
                    {
                        'url':'//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
                    },
                    'lengthMenu': [[10, 25, 50,100, -1], [10, 25, 50, 100, 'Todos']],
                    
                    dom: '<<"col-md-3"B><"#buscar.col-sm-4"f><"pull-right"l><t>pr>',
                    buttons:{
                        buttons: [
                            { extend: 'pdf', className: 'btn btn-flat btn-warning',text:' <i class="fa  fa-file-pdf-o"></i> Exportar a PDF' },
                            { extend: 'excel', className: 'btn btn-success btn-flat',text:' <i class="fa fa-file-excel-o"></i> Exportar a Excel' }
                        ]
                    } 
                }
            );
        });
    });
    return false;
}

function frm_r_user()
{
    $('#frm_r_user').submit(function(e) {
        e.preventDefault();
        if ( $.fn.dataTable.isDataTable( '#tbl_r_user' ) ) {
            $('#tbl_r_user').DataTable().destroy();
        }
        
        var data_form = $(this).serialize();
        $.ajax({
            url: 'controller/puente.php',
            type: 'POST',
            dataType: 'json',
            data: data_form,
            cache:false,
            async:false,
        })
        .done(function(info) {
            if (info.error == 'error') 
            {
                $('#tbl_r_user body').append('<tr> <td colspan="7">NO SE ENCONTRARON REGISTROS</td> </tr>')
            }
            else
            {
                $('#tbl_r_user tbody').empty();
                var estado; 
                var asignado;
                
                $.each(info, function(i, inf) {
                    if(inf.status == 'Baja')
                    {
                        estado = '<span class="label label-danger">BAJA</span>';
                    }else if(inf.status == 'Nuevo'){
                        estado = '<span class="label label-info">NUEVO</span>';
                    }else if(inf.status == 'Bueno'){
                        estado = '<span class="label label-success">BUENO</span>';
                    }else if(inf.status == 'Malo'){
                        estado = '<span class="label label-danger">MALO</span>';
                    }else if(inf.status == 'Regular'){
                        estado = '<span class="label label-warning">REGULAR</span>';
                    }

                    if (inf.asignadoa == null ) {
                        asignado = 'SIN ASIGNAR'
                    }else{
                        asignado = inf.asignadoa;
                    }
                    $('#tbl_r_user tbody').append(
                        '<tr>'+
                            '<td>'+inf.id+'</td>'+
                            '<td>'+inf.tipo+'</td>'+
                            '<td>'+inf.marca +''+(inf.modelo)+'</td>'+
                            '<td>Inventario: '+inf.inventario+'<br> Serie:'+inf.serie+'</td>'+
                            '<td>'+estado+'</td>'+
                            '<td>'+inf.desc_ub+'</td>'+
                            '<td>'+asignado+'</td>'+
                        '</tr>'
                    );
                });
            }
        })
        .fail(function() {
            console.log("No sirve el fomulario de reporte por equipo.");
        }).always(function(){
            $('#tbl_r_user').DataTable(
                {
                    'language':
                    {
                        'url':'//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
                    },
                    'lengthMenu': [[10, 25, 50,100, -1], [10, 25, 50, 100, 'Todos']],
                    
                    dom: '<<"col-md-3"B><"#buscar.col-sm-4"f><"pull-right"l><t>pr>',
                    buttons:{
                        buttons: [
                            { extend: 'pdf', className: 'btn btn-flat btn-warning',text:' <i class="fa  fa-file-pdf-o"></i> Exportar a PDF' },
                            { extend: 'excel', className: 'btn btn-success btn-flat',text:' <i class="fa fa-file-excel-o"></i> Exportar a Excel' }
                        ]
                    } 
                }
            );
        });
    });
    return false;
}

function load_fallas() 
{
    $.ajax({
        url: 'controller/puente.php',
        type: 'POST',
        dataType: 'json',
        data: {option: 79},
        cache:false,
        async:false,
    })
    .done(function(data) {
        $('#fallas').empty();
        $('#fallas').append('<option value="">BUSCAR Y SELECCIONAR FALLA</option>')
        if (data.estado == 'error') 
        {
            alert(data.message);
        }else{
            $.each(data, function(i, falla) {
                $('#fallas').append('<option value="'+falla.id+'">'+falla.nombre+'</option>')
            });
        }
    })
    .fail(function() {
        console.log("error");
    });
    return false;
}

function frm_r_falla()
{
    $('#frm_r_falla').submit(function(e) {
        e.preventDefault();
        if ( $.fn.dataTable.isDataTable( '#tbl_r_fallas' ) ) {
            $('#tbl_r_fallas').DataTable().destroy();
        }
        
        var data_form = $(this).serialize();
        $.ajax({
            url: 'controller/puente.php',
            type: 'POST',
            dataType: 'json',
            data: data_form,
            cache:false,
            async:false,
        })
        .done(function(info) {
            if (info.error == 'error') 
            {
                $('#tbl_r_fallas body').append('<tr> <td colspan="7">NO SE ENCONTRARON REGISTROS</td> </tr>')
            }
            else
            {
                $('#tbl_r_fallas tbody').empty();
                var estado; 
                var asignado;
                
                $.each(info, function(i, inf) {
                    if(inf.status == 'Baja')
                    {
                        estado = '<span class="label label-danger">BAJA</span>';
                    }else if(inf.status == 'Nuevo'){
                        estado = '<span class="label label-info">NUEVO</span>';
                    }else if(inf.status == 'Bueno'){
                        estado = '<span class="label label-success">BUENO</span>';
                    }else if(inf.status == 'Malo'){
                        estado = '<span class="label label-danger">MALO</span>';
                    }else if(inf.status == 'Regular'){
                        estado = '<span class="label label-warning">REGULAR</span>';
                    }

                    if (inf.asignadoa == null ) {
                        asignado = 'SIN ASIGNAR'
                    }else{
                        asignado = inf.asignadoa;
                    }
                    $('#tbl_r_fallas tbody').append(
                        '<tr>'+
                            '<td>'+inf.id+'</td>'+
                            '<td>'+inf.tipo+'</td>'+
                            '<td>'+inf.marca +''+(inf.modelo)+'</td>'+
                            '<td>Inventario: '+inf.inventario+'<br> Serie:'+inf.serie+'</td>'+
                            '<td>'+estado+'</td>'+
                            '<td>'+inf.desc_ub+'</td>'+
                            '<td>'+asignado+'</td>'+
                        '</tr>'
                    );
                });
            }
        })
        .fail(function() {
            console.log("No sirve el fomulario de reporte por equipo.");
        }).always(function(){
            $('#tbl_r_fallas').DataTable(
                {
                    'language':
                    {
                        'url':'//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
                    },
                    'lengthMenu': [[10, 25, 50,100, -1], [10, 25, 50, 100, 'Todos']],
                    
                    dom: '<<"col-md-3"B><"#buscar.col-sm-4"f><"pull-right"l><t>pr>',
                    buttons:{
                        buttons: [
                            { extend: 'pdf', className: 'btn btn-flat btn-warning',text:' <i class="fa  fa-file-pdf-o"></i> Exportar a PDF' },
                            { extend: 'excel', className: 'btn btn-success btn-flat',text:' <i class="fa fa-file-excel-o"></i> Exportar a Excel' }
                        ]
                    } 
                }
            );
        });
    });
    return false;
}

function frm_xlsx_asignacion() 
{
    $('#frm_xlsx_asignacion').submit(function (e) {
        e.preventDefault();
        var data_form = $(this).serialize();
        $.ajax({
            url: 'controller/puente.php',
            type: 'POST',
            
            data: data_form,
            cache:false,
            async:true,
            dataType:"html",//html
            contentType:"application/x-www-form-urlencoded",

        })
        .done(function(data) {
            $('#enlace').removeClass('hidden');         
            var opResult = JSON.parse(data);
            $('#enlace').attr('href',opResult.file);
            $('#enlace').attr('download','hola.xlsx');
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
        
    });
    return false;
}
function frm_asignar() 
{
    $('#frm_asignar').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: 'controller/puente.php',
            type: 'POST',
            dataType: 'json',
            data: $(this).serialize(),
            cache:false,
            async:false
        })
        .done(function(data) {
            if (data.message == 'success') 
            {
                $('#alert_success_asignar').removeClass('hidden');
                setTimeout(function() {
                    $('#alert_success_asignar').addClass('hidden');
                },8000);
                setTimeout(function() {
                    location.reload();
                },5000);
                
            }else{
                $('#alert_error_asignar').removeClass('hidden');
                setTimeout(function() {
                    $('#alert_error_asignar').addClass('hidden');
                },5000);
            }
        })
        .fail(function() {
            alert("Error al asignar el bien al usuario");
        });
        
    });
    return false;
}



function equipo_reparado(re_id) 
{
    $.ajax({
        url: 'controller/puente.php',
        type: 'POST',
        dataType: 'json',
        data: {option: '83', re:re_id },
    })
    .done(function(info) {
        if (info.estado == 'success') 
        {
            $('#alert').addClass('alert-success');
            $('#alert').removeClass('hidden');
            $('#message').text(info.message);
            setTimeout(function () {
                $('#alert').removeClass('alert-success');
                $('#alert').addClass('hidden');
                $('#message').text('');
            },5000);

        }else{
            $('#alert').addClass('alert-danger');
            $('#alert').removeClass('hidden');
            $('#message').text(info.message);
            setTimeout(function () {
                $('#alert').removeClass('alert-danger');
                $('#alert').addClass('hidden');
                $('#message').text('');
            },5000);
        }
        tbl_reparaciones_activas();
    })
    .fail(function() {
        console.log("Error al intentar reparar el equipo");
    });
    
    return false;
}

//Cuando cambian los grupos
function change_grupo() 
{
    $('#grupo_edit').change(function(e){
        e.preventDefault();
        load_tipo_bienes_edit( $(this).val() );
    });
}
function load_tipo_bienes_edit(id) 
{
    $.ajax({
        url: 'controller/puente.php',
        type: 'POST',
        dataType: 'json',
        data: {option: 8,grupo:id},
        async: false ,
        cache: false,
    })
    .done(function(data) {
        $('#tipo_edit').empty();
        $('#tipo_edit').append('<option value="" >...</option>');
        $.each(data, function(i, val) {
            $('#tipo_edit').append('<option value="'+val.id+'">'+val.nombre+'</option>');
        });
    })
    .fail(function() {
        alert("Error durante la petición al servidor");
    });
    return false;
}