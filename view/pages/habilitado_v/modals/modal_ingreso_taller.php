<form id="frm_ingreso" method="post" action="#">
	<input type="hidden" name="option" value="25">
	<input type="hidden" id="solicitud_id" name="solicitud_id" value="">	
	<div class="modal fade" id="modal_ingreso">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">×</span>
	        </button>
	        <h4 class="modal-title text-center">INGRESO DE LA UNIDAD AL TALLER</h4>
	      </div>
	      <div class="modal-body">
	      	<div  class="row">
	      		<div class="col-md-12">
	      			<div id="alert_modal_add_ingreso" class="alert alert-dismissible hidden">
		                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		                <h4><i class="icon fa fa-check"></i> <label id="a_mod_ingreso_estado"></label> </h4>
		            	<p id="a_mod_ingreso_message"></p>
		            </div>
	      		</div>
	      	</div>
	      	<div class="row">
	      		<div class="col-md-12">
	      			<div class="form-group">
	      				<label>Seleccione el taller</label>
	      				<select id="ingreso_taller" name="ingreso_taller" class="form-control" required>
	      					<option value="">...</option>
	      				</select>
	      			</div>
	      		</div>
	      	</div>
	      	<div class="row">
	      		<div class="col-md-6">
	      			<div class="form-group">
	      				<label>Fecha de ingreso </label>
	      				<input type="date" id="f_ingreso" name="f_ingreso" class="form-control" >
	      			</div>
	      		</div>
	      		<div class="col-md-6">
	      			<div class="form-group">
	      				<label>Hora de ingreso </label>
	      				<div class="bootstrap-timepicker">
	      					<div class="form-group">
	      						<div class="input-group">
	      							<input type="text" class="form-control timepicker" id="h_ingreso" name="h_ingreso">
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
	      				<label>Persona que recibe la unidad</label>
	      				<input type="text" id="p_recibe" name="p_recibe" class="form-control" placeholder="Persona que recibe la unidad ">
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
	        	Guardar ingreso
	    	</button>
	      </div>
	    </div>
	  </div>
	</div>
</form>