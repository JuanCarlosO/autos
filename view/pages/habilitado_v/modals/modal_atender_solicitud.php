<!--
Se quito este modal porque las necesidades del sistemas 
son diferentes a las que este apartado presenta
-->
<form id="frm_atender_sol" action="#" method="POST">
	<input type="hidden" id="option" name="option" value="19">
	<input type="hidden" name="solicitud_id" value="">	
	<div class="modal fade modal-success" id="modal_atender_solicitud">
	  <div class="modal-dialog modal-lg">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">×</span>
	        </button>
	        <h4 class="modal-title">Atender a la solicitud</h4>
	      </div>
	      <div class="modal-body">
	      	<div  class="row">
	      		<div class="col-md-12">
	      			<div id="alert_modal_atender" class="alert alert-dismissible hidden">
		                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		                <h4><i class="icon fa fa-check"></i> <label id="a_mod_atender_estado"></label> </h4>
		            	<p id="a_mod_atender_message"></p>
		            </div>
	      		</div>
	      	</div>
	      	<div class="row">
	      		<div class="col-md-4">
	      			<div class="form-group">
	      				<label>Fecha de entrada al taller</label>
	      				<input type="date" id="f_entrada" name="f_entrada" data-toggle="tooltip" title="Fecha de entrada al taller" class="form-control">
	      			</div>
	      		</div>
	      		<div class="col-md-4">
	      			<div class="form-group">
	      				<label>Fecha de salida del taller</label>
	      				<input type="date" id="f_entrada" name="f_salida" data-toggle="tooltip" title="Fecha de salida al taller" class="form-control">
	      			</div>
	      		</div>
	      		<div class="col-md-4">
	      			<div class="form-group">
	      				<label>Fecha de entrada a la UAI</label>
	      				<input type="date" id="entrada_uai" name="entrada_uai" data-toggle="tooltip" title="Fecha de entrada a la Unidad de Asuntos Internos." class="form-control">
	      			</div>
	      		</div>
	      	</div>
	      	<div class="row">
	      		<div class="col-md-12">
	      			<div class="form-group">
	      				<label>Observaciones</label>
	      				<textarea class="form-control" style="resize: vertical;" placeholder="Ej: El mecánico entrego el auto limpio y funcionando." id="observaciones" name="observaciones"></textarea>
	      			</div>
	      		</div>
	      	</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
	        <button type="submit" class="btn btn-info btn-flat"> <i class="fa fa-floppy-o"></i> Atender solicitud</button>
	      </div>
	    </div>
	  </div>
	</div>
</form>