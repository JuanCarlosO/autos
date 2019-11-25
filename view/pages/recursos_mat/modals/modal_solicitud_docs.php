<div class="modal fade" id="modal_docs">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
				<h4 class="modal-title"> <center>Acciones a realizar</center> </h4>
			</div>
			<div class="modal-body">
				<input type="hidden" id="solicitud" name="solicitud" value="">	
				<div class="row">
					<div class="col-md-6">
						<button type="button" class="btn btn-success btn-lg btn-flat btn-block"  onclick="view_cotizacion();">
							<i class="fa fa-eye" style=" font-size: 25px;"></i>
							Ver Cotización
						</button>
					</div>
					<div class="col-md-6">
						<button type="button" class="btn btn-success btn-lg btn-flat btn-block" onclick="view_factura();">
							<i class="fa fa-eye" style=" font-size: 25px;"></i>
							Ver Factura
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
