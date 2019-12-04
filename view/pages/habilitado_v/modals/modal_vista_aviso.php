<form id="frm_add_aviso" action="#" method="POST" enctype="multipart/form-data">
	<input type="hidden" id="option" name="option" value="30">
	<input type="hidden" id="solicitud_id" name="solicitud_id">
	<div class="modal fade " id="modal_cotizar">
	  <div class="modal-dialog">
	    <div class="modal-content">
	    	<div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">×</span>
		        </button>
	        	<h4 class="modal-title">Generar la cotización de la reparación</h4>
	      	</div>
	      	<div class="modal-body">
		      	<div  class="row">
		      		<div class="col-md-12">
		      			<div id="alert_cotizar" class="alert alert-dismissible hidden">
			                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			                <h4><i class="icon fa fa-check"></i> <label id="a_mod_cotizar_estado"></label> </h4>
			            	<p id="a_mod_cotizar_message"></p>
			            </div>
		      		</div>
		      	</div>
		      	<div class="row">
		      		<div class="col-md-6">
		      			<div class="form-group">
		      				<label>Fecha de la cotizacón</label>
		      				<input type="date" id="fecha" name="fecha" value="" required class="form-control" >
		      			</div>
		      		</div>
		      		<div class="col-md-3">
		      			<div class="form-group">
		      				<label>Costo de la cotización</label>
			      			<div class="input-group">
				            	<span class="input-group-addon">$</span>
				            	<input type="text" class="form-control" id="costo" name="costo" onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
				            	<!-- <span class="input-group-addon">.00</span> -->
				            </div>
		      			</div>
		      		</div>
		      		<div class="col-md-3">
		      			<div class="form-group">
		      				<label>Costo actual del vehículo</label>
			      			<div class="input-group">
				            	<span class="input-group-addon">$</span>
				            	<input type="text" class="form-control" id="costo_veh" name="costo_veh" onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
				            	<!-- <span class="input-group-addon">.00</span> -->
				            </div>
		      			</div>
		      		</div>
		      	</div>
		      	<div class="row">
		      		<div class="col-md-12">
		      			<div class="form-group">
		      				<label>Comentarios</label>
		      				<textarea id="comentario" name="comentario" class="form-control" style="resize: vertical; max-height: 300px;"></textarea>
		      			</div>
		      		</div>
		      	</div>
		      	<div class="row">
		      		<div class="col-md-12">
		      			<div class="form-group">
		      				<label>Subir cotización ( Solo PDF )</label>
		      				<input type="file" id="archivo" name="archivo" value="" class="form-control" required accept="application/pdf">
		      			</div>
		      		</div>
		      	</div>
		      	
	      	</div>
	      	<div class="modal-footer">
	      		<button type="button" class="btn btn-flat btn-danger pull-left" data-dismiss="modal">Cerrar</button>
	      		<button type="submit" class="btn btn-success btn-flat">
	      			<i class="fa fa-floppy-o"></i> Guardar cotización
	      		</button>
	      	</div>
	    </div>
	  </div>
	</div>
</form>