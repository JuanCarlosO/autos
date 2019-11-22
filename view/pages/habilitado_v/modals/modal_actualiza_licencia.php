<form id="frm_update_licencia" method="post" action="#">
	<input type="hidden" name="option" value="">	
	<input type="hidden" name="l_id" value="">	
	<div class="modal fade" id="modal_update_licencia">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">×</span>
	        </button>
	        <h4 class="modal-title text-center">Actualizar la licencia del usuario</h4>
	      </div>
	      <div class="modal-body">
	      	<div  class="row">
	      		<div class="col-md-12">
	      			<div id="" class="alert alert-dismissible hidden">
		                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		                <h4><i class="icon fa fa-check"></i> <label id=""></label> </h4>
		            	<p id=""></p>
		            </div>
	      		</div>
	      	</div>
	      	<div class="row">
	      		<div class="col-md-4">
	      			<div class="form-group">
	      				<label>Fecha de expedición</label>
	      				<input type="date" id="f_exp" name="f_exp" value="<?=date('Y-m-d')?>" required class="form-control">
	      			</div>
	      		</div>
	      		<div class="col-md-4">
	      			<div class="form-group">
	      				<label>Fecha de vencimiento</label>
	      				<input type="date" id="f_ven" name="f_ven" value="<?=date('Y-m-d')?>" required class="form-control">
	      			</div>
	      		</div>
	      		<div class="col-md-4">
	      			<div class="form-group">
	      				<label>Tipo</label>
	      				<select id="tipo" name="tipo" class="form-control" required>
	      					<option value="">...</option>
	      					<option value="1" selected>A - Automovilista</option>
	      					<option value="2">C - Motociclista</option>
	      					<option value="3">E - Chofer</option>
	      				</select>
	      			</div>
	      		</div>
	      	</div>
	      	<div class="row">
	      		<div class="col-md-12">
	      			<div class="form-group">
	      				<label>Subir escaneo de licencia</label>
	      				<input type="file" name="archivo" class="form-control" accept="application/pdf" required >
	      			</div>
	      		</div>
	      	</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-danger pull-left btn-flat" data-dismiss="modal">Cerrar</button>
	        <button type="submit" class="btn btn-success pull-right btn-flat" > 
	        	<i class="fa fa-floppy-o"></i> 
	        	Actualizar licencia
	    	</button>
	      </div>
	    </div>
	  </div>
	</div>
</form>