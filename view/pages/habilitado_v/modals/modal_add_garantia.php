<form id="frm_add_garantia" method="post" action="#">
	<input type="hidden" name="option" value="52">	
	<input type="hidden" id="solicitud_id" name="solicitud_id" value="">
	<div class="modal fade" id="modal_add_garantia">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">×</span>
	        </button>
	        <h4 class="modal-title">Generar devolución por garantía</h4>
	      </div>
	      <div class="modal-body">
	      	<div  class="row">
	      		<div class="col-md-12">
	      			<div id="alert_garantia" class="alert alert-dismissible hidden">
		                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		                <h4><i class="icon fa fa-check"></i> <label id="estado_garantia"></label> </h4>
		            	<p id="message_garantia"></p>
		            </div>
	      		</div>
	      	</div>
	      	<div class="row">
	      		<div class="col-md-6">
	      			<div class="form-group">
	      				<label>Fecha de entrada a taller</label>
	      				<input type="date" name="f_entrada" class="form-control" required>
	      			</div>
	      		</div>
	      		<div class="col-md-6">
	      			<div class="form-group">
	      				<label>Observaciones</label>
	      				<textarea name="observaciones" class="form-control" required style="max-height: 300px;"></textarea>
	      			</div>
	      		</div>
	      	</div>
	      	
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
	        <button type="submit" class="btn btn-success pull-right" > 
	        	<i class="fa fa-floppy-o"></i> 
	        	Guardar garantía
	    	</button>
	      </div>
	    </div>
	  </div>
	</div>
</form>