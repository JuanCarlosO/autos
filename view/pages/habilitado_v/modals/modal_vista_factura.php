<div class="modal fade" id="modal_ver_factura">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
				<h4 class="modal-title">Vista y descarga de la factura.</h4>
			</div>
			<div class="modal-body">
				<input type="hidden" name="factura_id" id="factura_id" value="">
				<div class="alert hidden" id="alerta_factura">
	                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                <h4><i class="icon fa fa-info"></i> <label id="est_factura"></label> </h4>
	                <p id="mess_factura"></p>
              	</div>
				<div id="vista_factura"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-flat pull-left" onclick="DelFactura();">Eliminar factura</button>
				<button type="submit" class="btn btn-success pull-right btn-flat"> 
					<i class="fa fa-floppy-o"></i> 
					Guardar factura
				</button>
			</div>
		</div>
	</div>
</div>