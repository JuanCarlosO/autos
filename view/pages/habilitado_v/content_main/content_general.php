<!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Vehículos disponibles en la UAI</h3>
                        
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div  class="row">
                            <div class="col-md-12">
                                <div id="alerta" class="alert alert-dismissible hidden">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h4><i class="icon fa fa-check"></i> <label id="estado"></label> </h4>
                                    <p id="message"></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 pull-right">
                                <button type="button" class="btn btn-success btn-flat btn-block" data-toggle="modal" data-target="#modal_generate_bitacora">
                                    <i class="fa fa-file-pdf-o"></i>
                                    Bitacora
                                </button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <div id="all_vehiculos"></div>
                        </div>
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