<form id="frm_add_factura" method="post" action="#">
	<input type="hidden" name="option" value="64">
	<input type="hidden" name="solicitud_id" value="">	
	<div class="modal fade" id="modal_add_factura">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">×</span>
	        </button>
	        <h4 class="modal-title">Agregar factura a esta solicitud.</h4>
	      </div>
	      <div class="modal-body">
	      	<div  class="row">
	      		<div class="col-md-12">
	      			<div id="alert_factura" class="alert alert-dismissible hidden">
		                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		                <h4><i class="icon fa fa-check"></i> <label id="estado_factura"></label> </h4>
		            	<p id="message_factura"></p>
		            </div>
	      		</div>
	      	</div>
	      	<div class="row">
	      		<div class="col-md-4">
	      			<div class="form-group">
	      				<label>Nombre del documento</label>
	      				<input type="text" id="name_doc" name="name_doc" value="" placeholder="Ej: Factura_2019" class="form-control" required>
	      			</div>
	      		</div>
	      		<div class="col-md-4">
	      			<div class="form-group">
	      				<label>Costo total</label>
	      				<input type="text" id="costo" name="costo" value="" onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" class="form-control" required>
	      			</div>
	      		</div>
	      		<div class="col-md-4">
	      			<div class="form-group">
	      				<label>Subir documento</label>
	      				<input type="file" id="archivo" name="archivo" value="" accept=".pdf" class="form-control" required>
	      			</div>
	      		</div>
	      	</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
	        <button type="submit" class="btn btn-success pull-right btn-flat"> 
	        	<i class="fa fa-floppy-o"></i> 
	        	Guardar factura
	    	</button>
	      </div>
	    </div>
	  </div>
	</div>
</form>