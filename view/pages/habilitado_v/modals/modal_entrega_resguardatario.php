
<form id="frm_entrega" action="#" method="POST">
	<input type="hidden" id="option" name="option" value="31">
	<div class="modal fade " id="modal_entrega">
	  <div class="modal-dialog">
	    <div class="modal-content">
	    	<div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">×</span>
		        </button>
	        	<h4 class="modal-title">Entregar vehiculo al resguardatario</h4>
	      	</div>
	      	<div class="modal-body">
		      	<div  class="row">
		      		<div class="col-md-12">
		      			<div id="alert_entrega" class="alert alert-dismissible hidden">
			                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			                <h4><i class="icon fa fa-check"></i> <label id="a_mod_entrega_estado"></label> </h4>
			            	<p id="a_mod_entrega_message"></p>
			            </div>
		      		</div>
		      	</div>
		      	<div class="row">
		      		<div class="col-md-5">
		      			<div class="form-group">
		      				<label>Fecha de entrega</label>
		      				<div class="input-group">
	      						<input type="date" class="form-control" id="fecha" name="fecha">
	      						<div class="input-group-addon">
	      							<i class="fa fa-calendar"></i>
	      						</div>
	      					</div>
		      			</div>
		      		</div>
		      		<div class="col-md-4">
		      			<div class="form-group">
		      				<label>Hora de entrega</label>
		      				<div class="input-group">
	      						<input type="text" class="form-control timepicker" id="hora" name="hora">
	      						<div class="input-group-addon">
	      							<i class="fa fa-clock-o"></i>
	      						</div>
	      					</div>
		      			</div>
		      		</div>
		      		<div class="col-md-3">
		      			<div class="form-group">
		      				<label>¿Con prueba de reparación?</label>
		      				<select id="test" name="test" required class="form-control">
		      					<option value="">...</option>
		      					<option value="1">SI</option>
		      					<option value="2">NO</option>
		      				</select>
		      			</div>
		      		</div>
		      	</div>
		      	<div class="row">
		      		<div class="col-md-6">
		      			<div class="form-group">
		      				<label>Servidor público que entrega</label>
		      				<input type="text" id="sp_entrega" name="sp_entrega" class="form-control" value="">
		      				<input type="hidden" id="spe_id" name="spe_id" value="">
		      			</div>
		      		</div>
		      		<div class="col-md-6">
		      			<div class="form-group">
		      				<label>Servidor público que recibe</label>
		      				<input type="text" id="sp_recibe" name="sp_recibe" class="form-control" value="">
		      				<input type="hidden" id="spr_id" name="spr_id" value="">
		      			</div>
		      		</div>
		      	</div>
		      	<div id="aceptacion">
		      		<div class="row">
		      			<div class="col-md-4">
		      				<div class="form-group">
		      					<label>¿El servidor público acepto su vehículo?</label>
		      					<select id="s_aceptacion" name="s_aceptacion" class="form-control">
		      						<option value="">...</option>
		      						<option value="1">SI</option>
		      						<option value="2">NO</option>
		      					</select>
		      				</div>
		      			</div>
		      		</div>
		      		<div id="motivo" class="row hidden">
		      			<div class="col-md-12">
		      				<div class="form-group">
		      					<label> Motivo por el cual no se acepto el vehículo </label>
		      					<textarea id="txt_motivo" name="txt_motivo" class="form-control " style="resize: vertical;max-height: 300px;"></textarea>
		      				</div>
		      			</div>
		      		</div>
		      	</div>
		      	
		      	
	      	</div>
	      	
	      	<div class="modal-footer">
	      		<button type="button" class="btn btn-flat btn-danger pull-left" data-dismiss="modal">Cerrar</button>
	      		<button type="submit" class="btn btn-success btn-flat"><i class="fa fa-floppy-o"></i> Guardar evento</button>
	      	</div>
	    </div>
	  </div>
	</div>
</form>