<form id="frm_ingreso_fin" method="post" action="#">
	<input type="hidden" name="option" value="26">
	<input type="hidden" id="ingreso_id" name="ingreso_id" value="">	
	<input type="hidden" id="solicitud_id" name="solicitud_id" value="">	
	<div class="modal fade" id="modal_ingreso_fin">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">×</span>
	        </button>
	        <h4 class="modal-title text-center">SALIDA DEL TALLER</h4>
	      </div>
	      <div class="modal-body">
	      	<div  class="row">
	      		<div class="col-md-12">
	      			<div id="alert_modal_ingreso_fin" class="alert alert-dismissible hidden">
		                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		                <h4><i class="icon fa fa-check"></i> <label id="a_mod_ingreso_fin_estado"></label> </h4>
		            	<p id="a_mod_ingreso_fin_message"></p>
		            </div>
	      		</div>
	      	</div>
	      	
	      	<div class="row">
	      		<div class="col-md-6">
	      			<div class="form-group">
	      				<label>Fecha de salida</label>
	      				<input type="date" id="f_salida" name="f_salida" class="form-control" required>
	      			</div>
	      		</div>
	      		<div class="col-md-6">
	      			<div class="form-group">
	      				<label>Hora de salida </label>
	      				<div class="bootstrap-timepicker">
	      					<div class="form-group">
	      						<div class="input-group">
	      							<input type="text" class="form-control timepicker" id="h_salida" name="h_salida" required>
	      							<div class="input-group-addon">
	      								<i class="fa fa-clock-o"></i>
	      							</div>
	      						</div>
	      					</div>
	      				</div>
	      			</div>
	      		</div>
	      	</div>
	      	<div class="row">
	      		<div class="col-md-12">
	      			<div class="form-group">
	      				<label>Persona que entrega la unidad</label>
	      				<input type="text" id="p_entrega" name="p_entrega" class="form-control" placeholder="Persona que entrega la unidad " required>
	      			</div>
	      		</div>
	      	</div>
	      	<div class="row">
	      		<div class="col-md-12">
	      			<div class="form-group">
	      				<label>Observaciones</label>
	      				<textarea id="observaciones" name="observaciones" style="resize: vertical; max-height: 200px;" class="form-control"></textarea>
	      			</div>
	      		</div>
	      	</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-danger btn-flat pull-left" data-dismiss="modal">Cerrar</button>
	        <button type="submit" class="btn btn-success btn-flat pull-right" > 
	        	<i class="fa fa-floppy-o"></i> 
	        	Guardar salida
	    	</button>
	      </div>
	    </div>
	  </div>
	</div>
</form>