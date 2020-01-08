<form id="frm_upload_sol" method="post" action="#">
	<input type="hidden" name="option" value="49">	
	<input type="hidden" id="solicitud_id" name="solicitud_id" value="">
	<div class="modal fade" id="UploadFileSol">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">×</span>
	        </button>
	        <h4 class="modal-title">Subir formato firmado del solicitante (Solor PDF) </h4>
	      </div>
	      <div class="modal-body">
	      	<div  class="row">
	      		<div class="col-md-12">
	      			<div id="alert_modal_upload" class="alert alert-dismissible hidden">
		                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		                <h4><i class="icon fa fa-check"></i> <label id="a_mod_uoload_estado"></label> </h4>
		            	<p id="a_mod_upload_message"></p>
		            </div>
	      		</div>
	      	</div>
	      	<div class="row">

	      	</div>
	      	<div class="row">
	      		<div class="col-md-5">
	      			<div class="form-group">
	      				<label>Tipo de solicitud</label>
	      				<select name="t_sol" class="form-control" required>
	      					<option value="">...</option>
	      					<option value="7">Solicitud Solicitante</option>
	      					<option value="8">Solicitud Habilitado Vehicular</option>
	      				</select>
	      			</div>
	      		</div>
	      		<div class="col-md-6">
		      		<div class="form-group">
		      			<label for="doc">Buscar el documento</label>
		      			<input type="file" id="doc" name="archivo" value="" class="form-control" accept=".pdf" required>
		      		</div>
	      		</div>
	      	</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-danger btn-flat pull-left" data-dismiss="modal">Cerrar</button>
	        <button type="submit" class="btn btn-success btn-flat pull-right" > 
	        	<i class="fa fa-floppy-o" style="font-size: 16px;"></i> 
	        	Guardar documento
	    	</button>
	      </div>
	    </div>
	  </div>
	</div>
</form>