<form id="frm_baja_v" action="#" method="POST" enctype="multipart/form-data">
	<input type="hidden" id="vehiculo_id" name="vehiculo_id" value="">	
	<input type="hidden" name="option" value="32">	
	<div class="modal fade" id="modal_baja_v">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">×</span>
	        </button>
	        <h4 class="modal-title">Baja de vehículo.</h4>
	      </div>
	    <div class="modal-body">
	      	<div  class="row">
	      		<div class="col-md-12">
	      			<div id="alert_baja_v" class="alert alert-dismissible hidden">
		                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		                <h4><i class="icon fa fa-check"></i> <label id="a_baja_v_estado"></label> </h4>
		            	<p id="a_baja_v_message"></p>
		            </div>
	      		</div>
	      	</div>
	      	<div class="row">
	      		<div class="col-md-12">
	      			<div class="form-group">
	      				<label>Causa</label>
	      				<select id="causa" name="causa" class="form-control" >
                			<option value="">...</option>
                			<option value="1">Siniestro</option>
                			<option value="2">Reparación mayor al 35%</option>
                			<option value="3">Otro</option>
                		</select>
	      			</div>
	      		</div>
	      	</div>
	      	<div class="row">
	      		<div class="col-md-12">
	      			<div class="form-group">
	      				<label>Motivo de la baja</label>
	      				<textarea id="motivo" name="motivo" class="form-control" style="resize: vertical; max-height: 300px;" ></textarea>
	      			</div>
	      		</div>
	      	</div>
	      	<div class="row">
	      		<div class="col-md-4">
	      			<div class="form-group">
	      				<button type="button" class="btn btn-success btn-block btn-flat" onclick="add_field_baja();"> <i class="fa fa-plus"></i> Agregar documento(s)</button>
	      			</div>
	      		</div>
	      	</div>
	      	<div id="documentos">
	      		<div class="row">
	      			<div class="col-md-4">
	      				<div class="form-group">
	      					<label>Tipo de documento</label>
	      					<select name="t_doc[]"  class="form-control">
	      						<option value=""></option>
	      						<option value="1">Acta de baja</option>
	      						<option value="2">Documento de Siniestro</option>
	      						<option value="3"> Dictamen taller </option>
	      					</select>
	      				</div>
	      			</div>
	      			<div class="col-md-8">
	      				<div class="form-group">
	      					<label>Buscar documento</label>
	      					<input type="file" id="archivo" name="archivo[]" value="" class="form-control file" accept="application/pdf">
	      				</div>
	      			</div>
	      		</div>
	      	</div>
	      	
	    </div>
		<div class="modal-footer">
			<button type="reset" class="btn btn-danger pull-left">Limpiar formulario</button>
			<button type="submit" class="btn btn-success pull-right" > <i class="fa fa-floppy-o"></i> Dar de baja </button>
		</div>
	    </div>
	  </div>
	</div>
</form>