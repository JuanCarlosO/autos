<!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Generar una solicitud de reparación / mantenimiento de vehículo.</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                             
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                    	<form id="frm_add_sol" method="post" action="#">
                    		<input type="hidden" id="option" name="option" value="41">
                            <input type="hidden" id="logger" name="logger" value="<?=$_SESSION['person_id']?>">
                    		<div class="row">
                    			<div class="col-md-12">
                    				<div id="alerta" class="alert hidden alert-dismissible ">
                    				    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    				    <h4><i class="icon fa fa-info"></i> <label id="estado"> AVISO! </label> </h4>
                    				    <p id="message"></p>
                    				</div>
                    			</div>
                    		</div>
                    		<div class="row">
                    			<div class="col-md-4">
                    				<div class="form-group">
                    					<label>Folio</label>
                    					<input type="text" id="folio" name="folio" class="form-control" placeholder="Ej: 0001-2019" required autofocus="on" readonly="on" value="">
                    				</div>
                    			</div>
                    			<div class="col-md-4">
                    				<div class="form-group">
                    					<label>Fecha de solicitud</label>
                    					<input type="date" id="f_sol" name="f_sol" required="" class="form-control" value="<?=date('Y-m-d')?>">
                    				</div>
                    			</div>
                    			<div class="col-md-4">
                                    <div class="form-group">
                                        <label> Kilometraje </label>
                                        <input type="text" id="km" name="km" placeholder="Ej: 230123" onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" class="form-control">
                                    </div>
                                </div>
                    		</div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Nombre del solicitante</label>
                                        <input type="hidden" id="solicitante_h" name="solicitante_h">
                                        <input type="text" id="solicitante_name" name="solicitante_name" class="form-control" autocomplete="off" value="" required="">
                                    </div>
                                </div>
                                
                                
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Resguardatario</label>
                                        <input type="hidden" id="resguardatario_h" name="resguardatario_h">
                                        <input type="text" id="resguardatario" name="resguardatario" class="form-control" autocomplete="off" readonly="" placeholder="Se carga automaticamente al buscar el vehiculo.">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>DATOS DEL VEHICULO</h4>
                                    <hr>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Número de placa</label>
                                        <input type="hidden" id="placa_h" name="placa_h" >
                                        <input type="text" id="placa" name="placa" class="form-control" placeholder="Ej: LXP9680" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <fieldset>
                                        <legend>Caracteristicas del vehículo</legend>
                                        <label for="number_placa">Placa:</label> <i id="number_placa"></i> <br>
                                        <label for="name_color">Color:</label> <i id="name_color"></i> <br>
                                        <label for="cve_serie">Serie:</label> <i id="cve_serie"></i> <br>
                                        <label for="num_cil">Cilindros:</label> <i id="num_cil"></i> <br>
                                    </fieldset>
                                </div>
                            </div>
                    		<div class="row">
                    			<div class="col-md-12">
                    				<div class="form-group">
                    					<label for="">Descripción del servicio</label>
                    					<textarea style="resize: vertical;" placeholder="Escriba aqui..." class="form-control" rows="5" value="" id="desc" name="desc"></textarea>
                    				</div>
                    			</div>
                    		</div>
                    		
                    		<div class="row">
                    			<div class="col-md-4"></div>
                    			<div class="col-md-4">
                    				<button type="submit" class="btn btn-block btn-success btn-flat"> <i class="fa fa-floppy-o"></i> Guardar</button>
                    			</div>
                    			<div class="col-md-4"></div>
                    		</div>
                    	</form>

                    </div>
                    <!-- ./box-body -->
                    
                    <!-- /.box-footer -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
    <!-- /.content -->
