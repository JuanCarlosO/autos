<form action="#" id="frm_save_evidencia" method="post">
	<input type="hidden" name="option" value="42">
	<input type="hidden" id="evento" name="evento" value="">
	<div class="modal fade " id="modal_save_evidencia">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<h4 class="modal-title"> <center>Formulario de alta de evidencia</center> </h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div id="alert_evidencia" class="alert  alert-dismissible hidden">
				                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				                <h4><i class="icon fa fa-info"></i> <label id="estado_evidencia"> </label> </h4>
				                <p id="mensaje_evidencia"></p>
				            </div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-1 pull-right">
							<i id="loader" class="fa fa-spinner fa-spin hidden" style="font-size: 35px;"></i>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Buscar archivo</label>
								<div class="input-group">
					                <input type="file" id="archivo" name="archivo[]" value="" class="form-control" accept="image/*,.pdf">
				                    <span class="input-group-btn">
				                      <button type="button" class="btn btn-success btn-flat" onclick="add_field_evidencia();">
				                      	<i class="fa fa-plus "></i>
				                      </button>
				                    </span>
					            </div>
							</div>
						</div>
					</div>
					<div id="evidencia_extra"></div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger btn-flat pull-left" data-dismiss="modal">Cerrar</button>
					<button type="submit" class="btn btn-success btn-flat pull-right" >
						<i class="fa fa-floppy-o"></i>
						Guardar
					</button>
				</div>
			</div>
		</div>
	</div>

</form>