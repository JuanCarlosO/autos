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
            <button class="btn btn-success btn-block btn-flat">
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
              <input type="text" class="form-control" id="" name="" readonly>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>No. Solicitud</label>
              <input type="text" class="form-control" id="" name="" readonly>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Fecha solicitud</label>
              <input type="text" class="form-control" id="" name="" readonly>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Placas</label>
              <input type="text" class="form-control" id="" name="" readonly>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Resguardatario</label>
              <input type="text" class="form-control" id="" name="" readonly>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Área solicitante</label>
              <input type="text" class="form-control" id="" name="" readonly>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label>Kilometraje</label>
              <input type="text" class="form-control" id="" name="" readonly>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Fecha de autorización</label>
              <input type="text" class="form-control" id="" name="" readonly>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Fecha de salida a taller</label>
              <input type="text" class="form-control" id="" name="" readonly>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Fecha de entrada a UAI</label>
              <input type="text" class="form-control" id="" name="" readonly>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Tipo reparacion (Hab. vehicular)</label>
              <textarea id="" name="" class="form-control" readonly></textarea>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Tipo de reparación (Solicitante)</label>
              <textarea id="" name="" class="form-control" readonly></textarea>
            </div>
          </div>
          
        </div>
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label>Valor factura</label>
              <input type="text" class="form-control" id="" name="" readonly>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Fecha de factura</label>
              <input type="text" class="form-control" id="" name="" readonly>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>No. de verificación</label>
              <input type="text" class="form-control" id="" name="" readonly>
            </div>
          </div>
          
        </div>
        <div class="row">
          <div class="col-md-3">
            <label>Reparaciones realizadas</label>
            <ol type="1" start="1">
              <li></li>
              <li></li>
              <li></li>
              <li></li>
              <li></li>
            </ol>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Observaciones</label>
              <textarea id="" name="" readonly class="form-control" style="resize: vertical;"></textarea>
            </div>
          </div>
        </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-success"> <i class="fa fa-floppy-o"></i> </button>
      </div>
    </div>
  </div>
</div>