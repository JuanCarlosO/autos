<form id="frm_solicitud_historica" method="post" action="#" enctype="multipart/form-data">
	<input type="hidden" name="option" value="33">	
	<div class="modal fade" id="modal_solicitud_historica">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">×</span>
	        </button>
	        <h4 class="modal-title">Agregar una solicitud</h4>
	      </div>
	      <div class="modal-body">
	      	<div  class="row">
	      		<div class="col-md-12">
	      			<div id="alert_modal_solicitud_historica" class="alert alert-dismissible hidden">
		                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		                <h4><i class="icon fa fa-check"></i> <label id="a_mod_solicitud_historica_estado"></label> </h4>
		            	<p id="a_mod_solicitud_historica_message"></p>
		            </div>
	      		</div>
	      	</div>
	      	<div class="row">
	      		<div class="col-md-4">
	      			<div class="form-group">
	      				<label>Folio</label>
	      				<input type="text" id="folio" name="folio" value="" placeholder="Ej: 2016-0001" required class="form-control">
	      			</div>
	      		</div>
	      		<div class="col-md-8">
	      			<div class="form-group">
	      				<label>Buscar vehículo</label>
	      				<input type="text" id="auto" name="auto" class="form-control" placeholder="Ej: LXP8690" autocomplete="off">
	      				<input type="hidden" id="auto_h" name="auto_h" value="">
	      			</div>
	      		</div>
	      	</div>
	      	<div class="row">
	      		<div class="col-md-6">
	      			<div class="form-group">
	      				<label>Tipo de falla</label>
	      				<select id="t_falla_h" name="t_falla_h" class="form-control" required></select>
	      			</div>
	      		</div>
	      		<div class="col-md-6">
	      			<div class="form-group">
	      				<label>Falla</label>
	      				<select id="falla_h" name="falla_h" class="form-control" required></select>
	      			</div>
	      		</div>
	      	</div>
	      	<div class="row">
	      		<div class="col-md-6">
	      			<div class="form-group">
	      				<label>Fecha de la reparación</label>
	      				<input type="date" id="fecha" name="fecha" value="" required class="form-control">
	      			</div>
	      		</div>
	      		<div class="col-md-6">
	      			<div class="form-group">
	      				<label>Costo de la reparación</label>
	      				<input type="text" id="costo" name="costo" value="" required class="form-control" onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" >
	      			</div>
	      		</div>
	      	</div>
	      	<!-- <div class="row">
	      		<div class="col-md-3">
	      			<button type="button" class="btn btn-success btn-flat" onclick="add_field_document('documentacion');">
	      				<i class="fa fa-file-o"></i>
	      				Adjuntar otro documento
	      			</button>
	      		</div>
	      	</div> -->
	      	<div id="documentacion">
	      		<div class="row">
	      			<div class="col-md-6">
	      				<div class="form-group">
	      					<label>Tipo de documento</label>
	      					<select id="t_doc" name="tipo_doc[]" class="form-control file" ></select>
	      				</div>
	      			</div>
	      			<div class="col-md-6">
	      				<div class="form-group">
	      					<label>Adjuntar documento</label>
	      					<input type="file" class="form-control file" id="archivo" name="archivo[]" value="" accept="application/pdf" >
	      				</div>
	      			</div>
	      		</div>
	      	</div>
	      	<div class="row">
	      		<div class="col-md-12">
	      			<div class="form-group">
	      				<label>Observaciones</label>
	      				<textarea id="obs" name="obs" class="form-control" style="resize: vertical;max-height: 300px;"></textarea>
	      			</div>
	      		</div>
	      	</div>

	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
	        <button type="submit" class="btn btn-success pull-right btn-flat" > 
	        	<i class="fa fa-floppy-o"></i> 
	        	Guardar en historico
	    	</button>
	      </div>
	    </div>
	  </div>
	</div>
</form>