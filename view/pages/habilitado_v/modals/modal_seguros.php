<form id="frm_seguros" method="post" action="#" enctype="multipart/form-data">
	<input type="hidden" name="option" value="56">	
	<input type="hidden" id="vehiculo_id" name="vehiculo_id" value="">
	<div class="modal fade" id="modal_seguros">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<h4 class="modal-title">Datos del seguro del vehículo.</h4>
				</div>
				<div class="modal-body">  
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Afianzadora</label>
								<select id="afianzador" name="afianzador" class="form-control" required>
									<option value="">...</option>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Monto</label>
								<input type="text" name="monto" class="form-control" onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" value="" >
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Cobertura</label>
								<select id="cobertura" name="cobertura" class="form-control" required>
									<option value="">...</option>
									<option value="1">Amplia</option>
									<option value="2">Parcial</option>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Adjuntar documento</label>
								<input type="file" id="archivo" name="archivo" accept=".pdf" required class="form-control">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger btn-flat pull-left" data-dismiss="modal">Cerrar</button>
					<button type="submit" class="btn btn-success pull-right btn-flat" > 
						<i class="fa fa-floppy-o"></i> 
						Guardar garantía
					</button>
				</div>
			</div>
		</div>
	</div>
</form>