<!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulario de alta. </h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form role="form" id="frm_salida" action="#">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Su nombre</label>
                                            <input type="text" id="vigilante" name="vigilante" value="" placeholder="Ej: Hector" class="form-control">
                                            <input type="hidden" id="vigilante_id" name="vigilante_id" value="" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Placa del vehiculo</label>
                                            <input type="text" id="placa" name="placa" value="" placeholder="Ej: Hector" class="form-control">
                                            <input type="hidden" id="placa_id" name="placa_id" value="" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>¿Quien maneja?</label>
                                            <input type="text" id="chofer" name="chofer" value="" placeholder="Ej: Hector" class="form-control">
                                            <input type="hidden" id="chofer_id" name="chofer_id" value="" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3 text-center">
                                        <input type="text" class="knob" data-thickness="0.2" data-angleArc="250" data-angleOffset="-125" value="30" data-width="120" data-height="120" data-fgColor="#00c0ef">
                                        <input type="hidden" id="nivel_gas" name="nivel_gas" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <div class="row">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-success btn-flat btn-block">
                                            <i class="fa fa-floppy-o"></i>  Guardar
                                        </button>
                                    </div>
                                    <div class="col-md-4"></div>
                                </div>
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