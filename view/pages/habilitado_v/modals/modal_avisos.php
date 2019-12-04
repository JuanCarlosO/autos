<form id="frm_add_avisos" method="post" action="#">
	<input type="hidden" name="option" value="61">
	<input type="hidden" id="sp_id" name="sp_id" value="">	
	<div class="modal fade" id="modal_avisos">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<h4 class="modal-title">Adjuntar aviso de renovación</h4>
				</div>
				<div class="modal-body">
					<div  class="row">
						<div class="col-md-12">
							<div id="alert_avisos" class="alert alert-dismissible hidden">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<h4><i class="icon fa fa-check"></i> <label id="estado_avisos"></label> </h4>
								<p id="message_avisos"></p>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<button type="button" class="btn btn-info btn-flat" onclick="lista_avisos();" >
								<i class="fa fa-eye"></i> Mostrar avisos
							</button>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Tipo de aviso</label>
								<select id="t_aviso" name="t_aviso" class="form-control" required>
									<option value="">...</option>
									<option value="1">Aviso anticipado </option>
									<option value="2">Aviso licencia vencida </option>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Seleccionar archivo</label>
								<input type="file" name="archivo" value="" class="form-control" required accept=".pdf">
							</div>
						</div>
					</div>
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger pull-left btn-flat" data-dismiss="modal">Cerrar</button>
					<button type="submit" class="btn btn-success btn-flat pull-right" > 
						<i class="fa fa-floppy-o"></i> 
						Guardar aviso
					</button>
				</div>
			</div>
		</div>
	</div>
</form>