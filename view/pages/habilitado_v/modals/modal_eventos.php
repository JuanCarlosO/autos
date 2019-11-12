
<form id="frm_eventos" action="#" method="POST">
	<input type="hidden" id="option" name="option" value="27">
	<div class="modal fade " id="modal_eventos">
	  <div class="modal-dialog">
	    <div class="modal-content">
	    	<div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">×</span>
		        </button>
	        	<h4 class="modal-title">Agregar un evento</h4>
	      	</div>
	      	<div class="modal-body">
		      	<div  class="row">
		      		<div class="col-md-12">
		      			<div id="alert_eventos" class="alert alert-dismissible hidden">
			                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			                <h4><i class="icon fa fa-check"></i> <label id="a_mod_eventos_estado"></label> </h4>
			            	<p id="a_mod_eventos_message"></p>
			            </div>
		      		</div>
		      	</div>
		      	<div class="row">
		      		<div class="col-md-4">
		      			<div class="form-group">
		      				<label>Tipo de evento</label>
		      				<select class="form-control" name="t_evento" id="t_evento" required>
		      					<option value="">...</option>
		      					<option value="1">VERIFICACIÓN</option>
		      					<option value="2">INVENTARIO</option>
		      				</select>
		      			</div>
		      		</div>
		      		<div class="col-md-4">
		      			<div class="form-group">
		      				<label>Fecha del evento</label>
		      				<input type="date" id="fecha" name="fecha" value="" class="form-control" required>
		      			</div>
		      		</div>
		      		<div class="col-md-4">
		      			<div class="form-group">
		      				<label>Título</label>
		      				<input type="text" id="title" name="title" value="" placeholder="Verificar a LXP8690" class="form-control" required="">
		      			</div>
		      		</div>
		      	</div>
		      	<div class="row">
		      		<div class="col-md-12">
		      			<div class="form-group">
		      				<label> Comentario del evento </label>
		      				<textarea id="comentario" name="comentario" class="form-control" required></textarea>
		      			</div>
		      		</div>
		      	</div>
	      	</div>
	      	
	      	<div class="modal-footer">
	      		<button type="button" class="btn btn-flat btn-danger pull-left" data-dismiss="modal">Cerrar</button>
	      		<button type="submit" class="btn btn-success btn-flat"><i class="fa fa-floppy-o"></i> Guardar evento</button>
	      	</div>
	    </div>
	  </div>
	</div>
</form>