
$(document).ready(function() {
    /*Seccion de variables globales*/
    var selected ;
    /***********************************************/
    var URL = window.location.search; //?menu=general
    if (URL == '?menu=general') {
        bienesAnexGrid();
    }else{
        searchName();
        /*Carga el listado principal*/
        bienes();
        $('.select2').select2();
        $('[data-toggle="tooltip"]').tooltip(); 
        /*llamada a los catalogos*/
        load_catalogos();
        /*Metodos para guardar informacion*/
        save_bien();
        save_marca();
        save_modelo();
        save_color();
        save_proveedor();
        /*Carga de formularios*/
        report_equipo();
        report_user();
        load_data_edit();
        frm_asignar();
    }
    apply_classActive(URL);
    
});
/*Funcion para salir*/
function logout() 
{
    location.href= 'login.php';
    return false;
}
/**/
function bienesAnexGrid()
{
    $('#list').anexGrid({
    class: 'table-striped table-bordered',
    columnas: [
        { leyenda: 'Id', style: 'width:200px;', columna: 'id', ordenable: true },
        { leyenda: 'Serie', columna: 'serie', ordenable: true },
        { leyenda: 'Descripción', columna: 'descripcion', ordenable: true },

    ],
    modelo: [
       {propiedad:'id'},
       {propiedad:'serie'},
       {propiedad:'descripcion'}
    ],
    url: 'controller/puente.php?option=6',
    limite: [20, 40, 60,100],
    paginable: true,
    columna: 'id',
    columna_orden: 'DESC'
});
    return false;
}
/**/
function apply_classActive(location) 
{
    switch ( location )
    {
        case '?menu=general':
            $('#option_aside_2').addClass('active');
        break;
        case '?menu=add':
            $('#option_aside_1').addClass('active');
        break;
        case '?menu=r_equipo':
            $('#submenu_reportes').addClass('active');
            $('#submenu2_equipo').addClass('active');
        break;
        case '?menu=r_user':
            $('#submenu_reportes').addClass('active');
            $('#submenu2_user').addClass('active');
        break;
        default:
            window.location.href = 'index.php?menu=general';
        break;
    }
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

/*Buscar el nombre de usuario*/
function searchName() 
{
    //$('#profile_name').text('Este es mi nombre');
    $.ajax({
        url: 'controller/puente.php',
        type: 'POST',
        dataType: 'json',
        data: {option: '5'},
    })
    .done(function(data) {
        $('.profile_name').text(data.short_name);
    })
    .fail(function() {
        $('.profile_name').text('Error. Usuario no encontrado');
    });
    
    return false;   
}
/*Abrir o cerrar el modal de la marca */
function modal_marca() 
{
    $('#modal_add_marca').modal('toggle');
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
    colores_load();//Colores para editar
    load_grupos_edit();//Grupos del modal editar
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
    $( "#servidor,.servidor" ).autocomplete({
        autoFocus:true,
        source: 'controller/puente.php?option=1',
        select: function( event, ui ){
            $('#servidor_id').val(ui.item.id);
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
/*Otro catalogo de colores*/
function colores_load() 
{
    var color = $('#colores');
    $.ajax({
        url: 'controller/puente.php',
        type: 'POST',
        dataType: 'json',
        data: {option: 12},
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
    })
    .done(function(data) {
        areas.empty();
        areas.append('<option value="">...</option>');
        $.each(data, function(i, val) {
            areas.append('<option value="'+val.id+'">'+val.nombre.toUpperCase()+'</option>');
        });
    })
    .fail(function() {
        alert("Error durante la petición al servidor");
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
        })
        .done(function(data) {
            if (data.message == 'success') {
                $('#alert_success').removeClass('hidden');
                setTimeout(function (argument) {
                    $('#alert_success').addClass('hidden');
                },5000);
            }else{
                $('#alert_error').removeClass('hidden');
                setTimeout(function (argument) {
                    $('#alert_error').addClass('hidden');
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
        })
        .done(function(data) {
            if (data.estado == 'success') {
                $('#alert_success4').removeClass('hidden');
                $('#alert_success4').addClass('alert-success');
                $('#message_error').text(data.message);
                setTimeout(function () {
                    $('#alert_success4').addClass('hidden');
                    $('#alert_success4').removeClass('alert-success');
                    $('#message_error').text('');
                },5000);
            }else{
                $('#alert_success4').removeClass('hidden');
                $('#alert_success4').addClass('alert-danger');
                $('#message_error').text(data.message);
                setTimeout(function () {
                    $('#alert_success4').addClass('hidden');
                    $('#alert_success4').removeClass('alert-danger');
                    $('#message_error').text('');
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
function modal_proveedor() 
{
    $('#modal_add_proveedor').modal('toggle');
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
    })
    .done(function(data) {
        t.clear().draw();
        $.each(data, function(i, val) {
            var asignacion = ( val.asignadoa == null ) ? 'NO ASIGNADO':val.asignadoa;
            var accion;
            if ( asignacion == 'NO ASIGNADO' ) {
                accion = '<button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#asignar_modal" onclick="getElementAsignar('+val.id+')"><i class="fa  fa-share-square-o"></i> Asignar</button>';
            }else{
                accion = '<button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#editar_bien_modal" onclick="getElementEdit('+val.id+')"><i class="fa fa-pencil"></i> Editar</button>';
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
/*Metodo de generacion de listado de reportes por equipo*/
function report_equipo() 
{
    /*Recuperar los valores del formulario*/
    var tabla = $('#tbl_r_equipo');
    var form  = $('#frm_reporte_equipo');
    var data_form ;
    form.submit(function(e) {
        e.preventDefault();
        data_form = $(this).serialize();
        $.ajax({
            url: 'controller/puente.php',
            type: 'POST',
            dataType: 'json',
            data: data_form,
        })
        .done(function(data) {
            if ( $.fn.dataTable.isDataTable( '#tbl_r_equipo' ) ) {
                $('#tbl_r_equipo').DataTable().destroy();
            }
            var array=[];
            $.each(data, function(i, val) {
                var type_status = val.tipo+' <br> ('+val.status+')';
                var asignado = ( val.asignadoa != null ) ? val.asignadoa : 'DISPONIBLE';
                array.push([val.id,type_status,val.grupo,val.inventario,val.serie,val.marca,val.modelo,asignado,val.descripcion,val.desc_ub]);
            });
            $('#tbl_r_equipo').DataTable({
                'language':
                {
                    'url':'//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
                },
                'lengthMenu': [[10, 25, 50,100, -1], [10, 25, 50, 100, 'Todos']],
                
                dom: '<<"col-md-3"B><"#buscar.col-sm-4"f><"pull-right"l><t>pr>',
                buttons:{
                    buttons: [
                        //{ extend: 'pdf', className: 'btn btn-flat btn-warning',text:' <i class="fa  fa-file-pdf-o"></i> Exportar a PDF' },
                        { extend: 'excel', className: 'btn btn-success btn-flat',text:' <i class="fa fa-file-excel-o"></i> Exportar a Excel' }
                    ]
                } ,
                data:array,
                columns:[
                    {title:'ID',className:'text-center'},
                    {title:'TIPO (ESTATUS)',className:'text-center'},
                    {title:'GRUPO',className:'text-center'},
                    {title:'INVENTARIO',className:'text-center'},
                    {title:'SERIE',className:'text-center'},
                    {title:'MARCA',className:'text-center'},
                    {title:'MODELO',className:'text-center'},
                    {title:'ASIGNADO A',className:'text-center'},
                    {title:'DESCRIPCIÓN',className:'text-center'},
                    {title:'UBICACIÓN',className:'text-center'},
                ]
            });
        })
        .fail(function() {
            console.log("error");
        });
    });
    
    return false;
}
/*Metodo de consulta de bienes por usuario o area*/
function report_user() 
{
    var tabla = $('#tbl_r_user');
    var form  = $('#frm_reporte_user');
    var data_form ;
    form.submit(function(e) {
        e.preventDefault();
        data_form = $(this).serialize();
        if ( $('#servidor').val() == '' && $('#area').val() == '' ) {
            alert('Complete alguno de los campos');
            location.reload();
        }else{
           $.ajax({
               url: 'controller/puente.php',
               type: 'POST',
               dataType: 'json',
               data: data_form,
           })
           .done(function(data) {
               //alert(data);
               if ( $.fn.dataTable.isDataTable( '#tbl_r_user' ) ) {
                   $('#tbl_r_user').DataTable().destroy();
               }
               var array=[];
               $.each(data, function(i, val) {
                   var type_status = val.tipo+' <br> ('+val.status+')';
                   var asignado = ( val.asignadoa != null ) ? val.asignadoa : 'DISPONIBLE';
                   array.push(
                       [
                           val.id,
                           type_status,
                           val.grupo,
                           val.inventario,
                           val.serie,
                           val.marca,
                           val.modelo,
                           asignado,
                           val.descripcion,
                           val.desc_ub
                       ]
                   );
               });
               $('#tbl_r_user').DataTable({
                   'language':
                   {
                       'url':'//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
                   },
                   'lengthMenu': [[10, 25, 50,100, -1], [10, 25, 50, 100, 'Todos']],
                   
                   dom: '<<"col-md-3"B><"#buscar.col-sm-4"f><"pull-right"l><t>pr>',
                   buttons:{
                       buttons: [
                           //{ extend: 'pdf', className: 'btn btn-flat btn-warning',text:' <i class="fa  fa-file-pdf-o"></i> Exportar a PDF' },
                           { extend: 'excel', className: 'btn btn-success btn-flat',text:' <i class="fa fa-file-excel-o"></i> Exportar a Excel' }
                       ]
                   } ,
                   data:array,
                   columns:[
                       {title:'ID',className:'text-center'},
                       {title:'TIPO (ESTATUS)',className:'text-center'},
                       {title:'GRUPO',className:'text-center'},
                       {title:'INVENTARIO',className:'text-center'},
                       {title:'SERIE',className:'text-center'},
                       {title:'MARCA',className:'text-center'},
                       {title:'MODELO',className:'text-center'},
                       {title:'ASIGNADO A',className:'text-center'},
                       {title:'DESCRIPCIÓN',className:'text-center'},
                       {title:'UBICACIÓN',className:'text-center'},
                   ]
               });            
           })
           .fail(function() {
               console.log("error");
           }); 
        }
        
    });
    
    return false;
}
/*Función de limpiar formulario*/
function limpiar_form() 
{
    $('#servidor_id').val('');
    document.getElementById('frm_reporte_user').reset();
    return false;
}

/*Abrir el modal de asignación*/
function asignar() 
{
    alert('Pronto asignaras un bien ');
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
        })
        .fail(function() { alert("Error durante la petición al servidor"); });

        
    })
    .fail(function() {
        console.log("Error para recuperar el bien a editar");
    });
    /*Buscar la info del bien seleccionado*/
    
    
    return false;
}   
function getElementAsigna(id)
{
    $('#bien_id_asigna').val(id);
    return false;
}       
/*Cargar de informacion para editar*/
function load_data_edit() 
{
    
    /*Buscar la info del bien seleccionado*/
    $('#frm_editar_bien').submit(function(e) {
        e.preventDefault();
        /*Recuperar la información del form*/
        var data_form = $(this).serialize();
        $.ajax({
            url: 'controller/puente.php',
            type: 'POST',
            dataType: 'json',
            data: data_form,
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
            setTimeout(function () {
                location.reload();
            },5000);
            //$('#editar_bien_modal').modal('toggle');
            /*Recargar la pagina*/

        })
        .fail(function() {
            console.log("Error al actualizar los datos -> load_data_edit");
        });
        
    });
    
    return false;
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

function load_grupos_edit()
{
    
    /*Preparar el evento Onchange*/
    $('#grupo_edit').change(function(e) {
        e.preventDefault();
        search_tipo_bien( $(this).val(),$('#tipo_edit'),'' );
    });
    return false;
}
/*Recuperar el bien a asignar*/
function getElementAsignar(bien_id) 
{
    $('#bien_id_asigna').val(bien_id);
    return false;
}
/*Asignar un bien*/
function frm_asignar() 
{
    $('#frm_asignar').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: 'controller/puente.php',
            type: 'POST',
            dataType: 'json',
            data: $(this).serialize(),
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
