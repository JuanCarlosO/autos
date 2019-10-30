<div class="modal fade" id="modal_detalle_solicitud">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title">Detalle de solicitud</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" id="solicitud_id" name="solicitud_id" value="">
        <div class="row" id="gtn_group_acciones">
          <div class="col-md-3">
            <button class="btn btn-success btn-block btn-flat" onclick="atender_sol();">
              <i class="fa fa-wrench" ></i>
              Atender solicitud
            </button>
          </div>
          <div class="col-md-3">
            <button id="btn_siniestros" value=""  class="btn btn-warning btn-block btn-flat">
              <i class="fa fa-car"></i>
              Siniestros
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
          <div class="col-md-6">
            <div class="form-group">
              <label>Solicitante</label>
              <input type="text" class="form-control" id="name_sol" name="name_sol" readonly>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Área solicitante</label>
              <input type="text" class="form-control" id="area_sol" name="area_sol" readonly>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label>Kilometraje</label>
              <input type="text" class="form-control" id="km" name="km" readonly>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Fecha de autorización</label>
              <input type="text" class="form-control" id="f_auto" name="f_auto" readonly>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Fecha de salida a taller</label>
              <input type="text" class="form-control" id="f_salida" name="f_salida" readonly>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Fecha de entrada a UAI</label>
              <input type="text" class="form-control" id="f_entrada" name="f_entrada" readonly>
            </div>
          </div>
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
        <div class="row">
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
          
        </div>
        <div class="row">
          <div class="col-md-12">
            <label>Reparaciones realizadas</label>
            <ol id="reparaciones" type="1" start="1">
              <li></li>
            </ol>
          </div>
        </div>
        
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
        
      </div>
    </div>
  </div>
</div>