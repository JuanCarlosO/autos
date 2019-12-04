<div class="modal fade" id="modal_detalle_solicitud" style="overflow-y: scroll;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title"> 
          <button type="" class="btn btn-danger btn-flat" onclick="cancelaSol();"> 
            <i class="fa fa-times"></i> Cancelar solicitud </button>  
          <center>DETALLE DE LA SOLICITUD</center> 
        </h4>
      </div>
      <div class="modal-body">
        <input type="hidden" id="solicitud_id" name="solicitud_id" value="">
        <div class="row " id="gtn_group_acciones">
          <div class="col-md-3">
            <button id="btn_ingreso" value="" class="btn btn-primary btn-block btn-flat hidden" data-toggle="modal" data-target="#modal_ingreso">
              <i class="fa fa-gears"></i>
              Ingresar al taller (1)
            </button>
          </div>
          <div class="col-md-3">
            <button id="btn_cotizar" value="" class="btn btn-warning btn-block btn-flat " data-toggle="modal" data-target="#modal_cotizar" >
              <i class="fa fa-dollar"></i>
              Cotizar reparación (2)
            </button>
          </div>
          <div class="col-md-3">
            <button id="btn_final" value=""  class="btn btn-info btn-block btn-flat" data-toggle="modal" data-target="#modal_ingreso_fin">
              <i class="fa fa-check-square-o"></i>
              Entrega taller (3)
            </button>
          </div>
          <div class="col-md-3">
            <button id="btn_entrega" value="" class="btn btn-success btn-block btn-flat " data-toggle="modal" data-target="#modal_entrega">
              <i class="fa fa-car"></i>
              Entrega a resguardatario (4)
            </button>
          </div>
        </div>
        <hr>
        
        <div class="row">
          <div class="col-md-2">
            <div class="form-group">
              <label>ID</label>
              <input type="text" class="form-control" id="id" name="id" readonly>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Folio solicitud</label>
              <input type="text" class="form-control" id="folio" name="folio" readonly>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Fecha solicitud</label>
              <input type="text" class="form-control" id="f_sol" name="f_sol" readonly>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Placas</label>
              <input type="text" class="form-control" id="placas" name="placas" readonly>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Resguardatario del vehículo</label>
              <input type="text" class="form-control" id="resguardatario" name="resguardatario" readonly>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-5">
            <div class="form-group">
              <label>Solicitante</label>
              <input type="text" class="form-control" id="name_sol" name="name_sol" readonly>
            </div>
          </div>
          <div class="col-md-5">
            <div class="form-group">
              <label>Área solicitante</label>
              <input type="text" class="form-control" id="area_sol" name="area_sol" readonly>
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label>Kilometraje</label>
              <input type="text" class="form-control" id="km" name="km" readonly>
            </div>
          </div>
        </div>
        <div class="row">
          
          <div class="col-md-3">
            <div class="form-group">
              <label>Fecha de entradad al taller</label>
              <input type="text" class="form-control" id="f_auto" name="f_auto" readonly>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Hora de entrada al taller</label>
              <input type="text" class="form-control" id="h_entrada" name="f_entrada" readonly>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Fecha de salida del taller</label>
              <input type="text" class="form-control" id="f_salida" name="f_salida" readonly>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Hora de salida del taller</label>
              <input type="text" class="form-control" id="h_salida" name="h_salida" readonly>
            </div>
          </div>
          <!-- <div class="col-md-3">
            <div class="form-group">
              <label>Fecha de entrada a UAI</label>
              <input type="text" class="form-control" id="f_entrada" name="f_entrada" readonly>
            </div>
          </div> -->
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Tipo reparacion (Habilitado. vehicular)</label>
              <textarea id="desc_hv" name="desc_hv" class="form-control" readonly style="resize: vertical;"></textarea>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Tipo de reparación (Solicitante)</label>
              <textarea id="desc_sol" name="desc_sol" class="form-control" readonly style="resize: vertical;"></textarea>
            </div>
          </div>
          
        </div>
        <!-- <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label>Valor factura</label>
              <input type="text" class="form-control" id="precio" name="precio" readonly>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Fecha de factura</label>
              <input type="text" class="form-control" id="f_factura" name="f_factura" readonly>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>No. de verificación</label>
              <input type="text" class="form-control" id="no_verifica" name="no_verifica" readonly>
            </div>
          </div>
          
        </div> -->
        <div class="row">
          <div class="col-md-9">
            <center><label>REPARACIONES REALIZADAS</label></center>
            <ol id="reparaciones" type="1" start="1">
              <li></li>
            </ol>
          </div>
          <div class="col-md-3">
            <button class="btn bg-orange btn-flat btn-block" onclick="add_reparacion();" data-toggle="tooltip" title="Agregar una reparación"><i class="fa fa-plus"></i>
              Agregar Reparación
            </button>
          </div>
        </div>
        <div class="row">
          <div class="col-md-9">
            <center><label>SINIESTROS PRESENTADOS</label></center>
            <ol id="list_siniestros" type="1" start="1">
              <li></li>
            </ol>
          </div>
          <div class="col-md-3">
            <button id="btn_siniestros" class="btn bg-orange btn-block btn-flat" data-toggle="tooltip" title="Agregar a la lista un siniestro.">
              <i class="fa fa-plus"></i>
              Agregar Siniestro
            </button>
          </div>
        </div>
        <div class="row">
          <div class="col-md-9">
            <center><label>GARANTIAS APLICADAS</label></center>
            <ol id="list_garantias" type="1" start="1">
              <li></li>
            </ol>
          </div>
          <div class="col-md-3">
            <button id="btn_garantia" class="btn bg-orange btn-block btn-flat" data-toggle="tooltip" title="Agregar una devolución por garantia">
              <i class="fa fa-plus"></i>
              Aplicar garantia
            </button>
          </div>
        </div>
        <div class="row">
          <div class="col-md-9">
            <center><label>AGREGAR FACTURA DE LA REPARACIÓN</label></center>
            <ol id="list_facturas" type="1" start="1">
              <li></li>
            </ol>
          </div>
          <div class="col-md-3">
            <button id="btn_factura" class="btn bg-orange btn-block btn-flat" data-toggle="tooltip" title="Agregar PDF de la factura pagada">
              <i class="fa fa-plus"></i>
              Cargar factura
            </button>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-flat pull-left" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>