<div class="modal fade" id="modal_add_evidencia">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
				<h4 class="modal-title"> <center>Acciones a realizar</center> </h4>
			</div>
			<div class="modal-body">
				<input type="hidden" id="evento_id" name="" value="evento_id">	
				<div class="row">
					<div class="col-md-6">
						<button type="button" class="btn btn-success btn-lg btn-flat btn-block"  onclick="view_evidencia();">
							<i class="fa fa-eye" style=" font-size: 25px;"></i>
							Ver evidencia
						</button>
					</div>
					<div class="col-md-6">
						<button type="button" class="btn btn-success btn-lg btn-flat btn-block" onclick="add_evidencia();">
							<i class="fa fa-plus" style=" font-size: 25px;"></i>
							Agregar evidencia
						</button>
					</div>
				</div>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>
