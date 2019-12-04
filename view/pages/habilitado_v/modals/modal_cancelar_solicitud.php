<form action="#" method="post" id="frm_cancelar_solicitud">
	<input type="hidden" name="option" value="48">
	<input type="hidden" name="solicitud_id" value="">
	<div class="modal fade" id="modal_cancelar_solicitud">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<h4 class="modal-title">Requisitos para cancelar solicitud.</h4>
				</div>
				<div class="modal-body">
			      	<div  class="row">
			      		<div class="col-md-12">
			      			<div id="alert_cancelar" class="alert alert-dismissible hidden">
				                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				                <h4><i class="icon fa fa-check"></i> <label id="estado_cancelar"></label> </h4>
				            	<p id="message_cancelar"></p>
				            </div>
			      		</div>
			      	</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Fecha</label>
								<input type="date" name="fecha" value="<?=date('Y-m-d');?>" requierd class="form-control">
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group">
								<label>Subir archivo</label>
								<input type="file" name="archivo" value="" class="form-control" required accept=".pdf">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Observaciones</label>
								<textarea name="observaciones" class="form-control" style="resize: vertical; max-height: 250px;"></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger btn-flat pull-left" data-dismiss="modal">Cerrar</button>
					<button type="submit" class="btn btn-success pull-right btn-flat"> 
						<i class="fa fa-floppy-o"></i> 
						Guardar cancelación
					</button>
				</div>
			</div>
		</div>
	</div>
</form>