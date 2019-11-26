<div class="modal fade" id="modal_generate_bitacora">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
				<h4 class="modal-title"> <center>Generar bitacora de mantenimiento</center> </h4>
			</div>
			<div class="modal-body">
				<form action="controller/puente.php" action="#" method="post" target="_blank">
					<input type="hidden" name="option" value="46">
					<div class="row">
						<div class="col-md-6">
							<input type="text" id="placa" name="placa" class="form-control" required>
							<input type="hidden" id="placa_h" name="placa_h" value="">
						</div>
						<div class="col-md-3"></div>
						<div class="col-md-3">
							<button type="submit" class="btn btn-success btn-block btn-flat">
								<i class="fa fa-edit"></i> Generar
							</button>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>
