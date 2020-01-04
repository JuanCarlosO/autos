<!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Agregar vehículos a la Unidad de Asuntos Internos</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                    	<form id="frm_add_car" method="post" action="#">
                    		<input type="hidden" id="option" name="option" value="4">
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
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label> Asignado a: </label>
                                        <input type="text" id="personal" name="personal" value="" placeholder="Ej: Juan ..." required="" class="form-control">
                                        <input type="hidden" id="personal_id" name="personal_id" value="">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label> Estado del Vehículo </label>
                                        <select class="form-control" name="estado" required>
                                            <option value="">...</option>
                                            <option value="1">Activo</option>
                                            <option value="2">Descompuesto</option>
                                            <option value="3">Baja</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                    		<div class="row">
                    			<div class="col-md-6">
                    				<div class="form-group">
                    					<label>Marca del vehículo</label>
                    					<div class="input-group input-group-md">
                                            <select id="m_veh" name="m_veh" class="form-control" required>
                                                <option value="">...</option>           
                                            </select>
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-success btn-flat" data-toggle="modal" data-target="#modal-add-marcav"> <i class="fa fa-plus"></i> </button>
                                            </span>
                                        </div>
                    				</div>
                    			</div>
                    			<div class="col-md-6">
                    				<div class="form-group">
                    					<label>Tipo de vehículo</label>
                                        <div class="input-group input-group-md">
                                            <select id="t_veh" name="t_veh" class="form-control" required>
                                                <option value="">...</option>           
                                            </select>
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-success btn-flat" data-toggle="modal" data-target="#modal-add-tipov"> <i class="fa fa-plus"></i> </button>
                                            </span>
                                        </div>
                    					
                    				</div>
                    			</div>
                    			
                    		</div>
                    		<div class="row">
                    			<div class="col-md-3">
                    				<div class="form-group">
                    					<label for="">Serie de placas</label>
                    					<input type="text" class="form-control" placeholder="Escriba sin guiones" id="placas" name="placas" required>
                    				</div>
                    			</div>
                    			<div class="col-md-4">
                    				<div class="form-group">
                    					<label for="">Número de resguardo</label>
                    					<input type="text" class="form-control" maxlength="10" placeholder="Ej: 1234567890" id="resguardo" name="resguardo" required>
                    				</div>
                    			</div>
                    			<div class="col-md-5">
                    				<div class="form-group">
                    					<label for="">NIV o Serie</label>
                    					<input type="text" class="form-control" maxlength="20" id="niv" name="niv" required>
                    				</div>
                    			</div>
                    			
                    		</div>
                    		<div class="row">
                    			<div class="col-md-4">
                    				<div class="form-group">
                    					<label for="">Número de motor</label>
                    					<input type="text" class="form-control" id="n_motor" name="n_motor" required>
                    				</div>
                    			</div>
                    			<div class="col-md-2">
                    				<div class="form-group">
                    					<label>Cilindros</label>
                    					<input type="number" class="form-control" maxlength="2" max="10" min="4" step="2" onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"  id="cilindros" name="cilindros" value="4" required>
                    				</div>
                    			</div>
                    			<div class="col-md-3">
                    				<div class="form-group">
                    					<label>Modelo</label>
                    					<input type="text" class="form-control" maxlength="4" onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" placeholder="Ej: 2010"  id="modelo" name="modelo" required>
                    				</div>
                    			</div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Color</label>
                                        <select id="color" name="color" class="form-control" required>
                                            <option value="">...</option>
                                            <option value="ROJO">ROJO</option>
                                            <option value="AZUL">AZUL</option>
                                            <option value="NEGRO">NEGRO</option>
                                            <option value="GRIS">GRIS</option>
                                            <option value="BLANCO">BLANCO</option>
                                            <option value="VINO">VINO</option>
                                            <option value="MORADO">MORADO</option>
                                            <option value="NARANJA">NARANJA</option>
                                            <option value="VERDE">VERDE</option>
                                            <option value="CAFE">CAFE</option>
                                            <option value="AMARILLO">AMARILLO</option>
                                            <option value="DORADO">DORADO</option>
                                        </select>
                                    </div>
                                </div>
                    		</div>
                            <fieldset>
                                <legend>Carpeta digital de documentos del vehículo</legend>
                                <div class="row">
                                    <div class="col-md-2 text-right">
                                        <label>Tipo de documento</label>
                                    </div>
                                    <div class="col-md-3">
                                        <select id="tipo_doc" name="tipo_doc[]" class="form-control tipos_doc" required>
                                            <option value="">...</option>
                                        </select>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="file" name="archivo[]" class="form-control" required="" accept=".pdf">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-success btn-block btn-flat" onclick="add_file_auto();">
                                            <i class="fa fa-plus"></i> Adjuntar otro docuemnto
                                        </button>
                                    </div>
                                </div>
                                <br>
                                <div id="field_files"></div>
                            </fieldset>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Observaciones</label>
                                        <textarea name="obs" id="obs" placeholder="...." class="form-control" style="resize: vertical;" rows="7"></textarea>
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
      <!--------------------------
        | Your Page Content Here |
        -------------------------->
    </section>
    <!-- /.content -->
    <form id="frm_add_tipov" method="post" action="#">
        <input type="hidden" id="option" name="option" value="10">
        <div class="modal fade" id="modal-add-tipov">
          <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Agregar un nuevo tipo de vehículo</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Escriba un tipo de vehículo nuevo</label>
                            <input type="text" id="tipo_nvo" name="tipo_nvo" value="" placeholder="Stratus Sedan" class="form-control" autocomplete="off">
                        </div>  
                    </div>
                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <form id="frm_add_marcav" action="#" method="post">
        <input type="hidden" id="option" name="option" value="11">
        <div class="modal fade" id="modal-add-marcav">
          <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Agregar una nueva marca</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Nombre de la marca nueva </label>
                            <input type="text" id="marca_nvo" name="marca_nvo" value="" placeholder="Chrysler..." class="form-control" autocomplete="off">
                        </div>
                    </div>
                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>