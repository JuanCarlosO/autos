<!-- Main content -->
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">LISTADO</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <form action="#" method="post" id="frm_historic">
                        <input type="hidden" name="option" value="16">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="date" id="f_ini" name="f_ini" value="" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <input type="date" id="f_fin" name="f_fin" value="" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <input type="text" id="placa" name="placa" value="" class="form-control" placeholder="Ej: LXP8690" autocomplete="off">
                                <input type="hidden" id="placa_id" name="placa_id">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-success btn-flat btn-block">
                                    <i class="fa fa-search"></i> Buscar coincidencias
                                </button>
                            </div>
                            <div class="col-md-4"></div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-lg-3 col-xs-6 pull-right">
                            <div class="small-box bg-green">
                            <div class="inner">
                              <h3> <sup style="font-size: 20px">$</sup> <label id="monto"></label></h3>
                              <p>Suma total del resultado</p>
                            </div>
                            <div class="icon">
                              <i class="ion ion-stats-bars"></i>
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="historic_data"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    <!-- /.content -->