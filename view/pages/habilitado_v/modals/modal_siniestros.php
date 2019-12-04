<form id="frm_add_siniestro" action="#" method="POST">
	<input type="hidden" id="option" name="option" value="17">
	<input type="hidden" name="solicitud_id" value="">	
	<div class="modal fade modal-warning" id="modal_siniestro">
	  <div class="modal-dialog modal-lg">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">×</span>
	        </button>
	        <h4 class="modal-title">Captura de siniestros</h4>
	      </div>
	      <div class="modal-body">
	      	<div  class="row ">
	      		<div class="col-md-12">
	      			<div id="alert_modal" class="alert alert-dismissible hidden">
		                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		                <h4><i class="icon fa fa-check"></i> <label id="a_mod_sin_estado"></label> </h4>
		            	<p id="a_mod_sin_message"></p>
		            </div>
	      		</div>
	      	</div>
	        <div class="row">
	        	<div class="col-md-4">
	        		<div class="form-group">
	        			<label>Fecha de los hechos</label>
	        			<input type="date" id="f_hechos" name="f_hechos" value="" class="form-control" required>
	        		</div>
	        	</div>
	        	<div class="col-md-4">
	        		<div class="form-group">
	        			<label>Entrada al taller</label>
	        			<input type="date" id="f_entrada" name="f_entrada" value="" class="form-control" required>
	        		</div>
	        	</div>
	        	<div class="col-md-4">
	        		<div class="form-group">
	        			<label>Salida del taller</label>
	        			<input type="date" id="f_salida" name="f_salida" value="" class="form-control" required>
	        		</div>
	        	</div>
	        </div>
	        <div class="row">
	        	<div class="col-md-12">
	        		<div class="form-group">
	        			<label>Nombre de la aseguradora.</label>
	        			<input type="text" id="name_aseguradora" name="name_aseguradora" value="" class="form-control" placeholder="Ej: Mapfre México, S.A. " required autocomplete="off">
	        		</div>
	        	</div>
	        </div>
	        <div id="names_tecnicos">
	        	<div class="row">
	        		<div class="col-md-12">
	        			<div class="form-group">
	        				<label>Nombre del técnico.</label>
	        				<div class="input-group">
	        					<input type="text" class="form-control" name="tecnico[]" placeholder="Ej: Emmanuel" required autocomplete="off">
	        					<div class="input-group-btn">
	        						<button type="button" class="btn btn-info" onclick="add_tecnico();"> <i class="fa fa-plus"></i> </button>
	        					</div>
	        				</div>
	        			</div>
	        		</div>
	        	</div>
	        </div>
	        <div class="row">
	        	<div class="col-md-12">
	        		<div class="form-group">
	        			<label>Subir documento</label>
	        			<input type="file" name="archivo" value="" class="form-control" required accept=".pdf">
	        		</div>
	        	</div>
	        </div>	
	        <div class="row">
	        	<div class="col-md-12">
	        		<div class="form-group">
	        			<label>Observaciones</label>
	        			<textarea class="form-control" id="" name="observaciones" style="resize: vertical;" placeholder="Agregar observaciones"></textarea>
	        		</div>
	        	</div>
	        </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
	        <button type="submit" class="btn btn-success"> <i class="fa fa-floppy-o"></i> Guardar siniestro</button>
	      </div>
	    </div>
	  </div>
	</div>
</form>