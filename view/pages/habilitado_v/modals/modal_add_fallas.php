<form id="frm_add_fallas" method="post" action="#">
	<input type="hidden" name="option" value="24">	
	<div class="modal fade" id="modal_add_fallas">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">×</span>
	        </button>
	        <h4 class="modal-title">Agregar elementos al catálogo de fallas</h4>
	      </div>
	      <div class="modal-body">
	      	<div  class="row">
	      		<div class="col-md-12">
	      			<div id="alert_modal_add_fallas" class="alert alert-dismissible hidden">
		                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		                <h4><i class="icon fa fa-check"></i> <label id="a_mod_add_fallas_estado"></label> </h4>
		            	<p id="a_mod_add_fallas_message"></p>
		            </div>
	      		</div>
	      	</div>
	      	<div class="row">
	      		<div class="col-md-12">
	      			<div class="form-group">
	      				<label>Categoria de la falla</label>
	      				<input type="text" name="tipo_falla" class="form-control">
	      			</div>
	      		</div>
	      	</div>
	      	<div id="div_fallas">
	      		<div class="row">
	      			<div class="col-md-12">
	      				<div class="form-group">
	      					<label>Falla</label>
	      					<div class="input-group">
	      						<input type="text" name="fallas[]" class="form-control">
	      						<span class="input-group-btn">
	      							<button type="button" class="btn btn-success btn-flat" onclick="add_campo_falla();">  
	      								<i class="fa fa-plus"></i>
	      							</button>
	      						</span>
	      					</div>
	      				</div>
	      			</div>
	      		</div>
	      	</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
	        <button type="submit" class="btn btn-success pull-right" > 
	        	<i class="fa fa-floppy-o"></i> 
	        	Guardar falla(s)
	    	</button>
	      </div>
	    </div>
	  </div>
	</div>
</form>