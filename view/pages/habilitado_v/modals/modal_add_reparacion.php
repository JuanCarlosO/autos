<form id="frm_add_reparacion" method="post" action="#">
	<input type="hidden" name="solicitud_id" value="">	
	<input type="hidden" name="option" value="23">	
	<div class="modal fade" id="modal_add_reparacion">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">×</span>
	        </button>
	        <h4 class="modal-title">Agregar una reparación a la solicitud seleccionada.</h4>
	      </div>
	      <div class="modal-body">
	      	<div  class="row">
	      		<div class="col-md-12">
	      			<div id="alert_modal_add_rep" class="alert alert-dismissible hidden">
		                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		                <h4><i class="icon fa fa-check"></i> <label id="a_mod_add_rep_estado"></label> </h4>
		            	<p id="a_mod_add_rep_message"></p>
		            </div>
	      		</div>
	      	</div>
	      	<div class="row">
	      		<div class="col-md-12">
	      			<div class="form-group">
	      				<label>Selecciona un tipo de falla</label>
	      				<div class="input-group">
	                		<select id="t_falla" name="t_falla" class="form-control" required></select>
	                    	<span class="input-group-btn">
	                      		<button type="button" class="btn btn-success btn-flat" data-toggle="tooltip" title="Agregar una categoria y tipos de fallas" onclick="modal_add_falla();"> <i class="fa fa-plus"></i> </button>
	                    	</span>
	              		</div>
	      			</div>
	      		</div>
	      	</div>
	      	<div class="row">
	      		<div class="col-md-12">
	      			<div class="form-group">
	      				<label>Selecciona la falla</label>
	      				<div class="input-group">
	                		<select id="falla" name="falla" class="form-control" style="width: 100%;" required>
	                			<option value="">...</option>
	                		</select>
	              		</div>
	      			</div>
	      		</div>
	      	</div>
	      	<div class="row">
	      		<div class="col-md-12">
	      			<div class="form-group">
	      				<label>Taller asignado</label>
	      				<select id="taller" name="taller" class="form-control" required></select>
	      			</div>
	      		</div>
	      	</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
	        <button type="submit" class="btn btn-success pull-right" > <i class="fa fa-floppy-o"></i> Guardar reparación </button>
	      </div>
	    </div>
	  </div>
	</div>
</form>