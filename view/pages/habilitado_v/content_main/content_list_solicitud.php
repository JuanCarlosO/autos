<section class="content container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Listado de solicitudes.</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse">
							<i class="fa fa-minus"></i>
						</button>
						<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
					</div>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-md-3 pull-right">
							<button type="submit" class="btn btn-success btn-flat btn-block" data-toggle="modal" data-target="#modal_solicitud_historica">
								<i class="fa fa-plus"></i> Agregar solicitud historica
							</button>
						</div>
					</div>
					<div class="row">
					    <div class="col-md-12">
					        <div id="alerta" class="alert hidden alert-dismissible ">
					            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					            <h4><i class="icon fa fa-info"></i> <label id="estado"> AVISO! </label> </h4>
					            <p id="message"></p>
					        </div>
					    </div>
					</div>
					<div class="table-responsive">
						<div id="all_cars"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

