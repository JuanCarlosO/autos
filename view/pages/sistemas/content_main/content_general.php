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
                    <form role="form" id="frm_create_cuenta" action="#" method="post">
                        <input type="hidden" name="option" value="75">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Servidor público</label>
                                    <input type="text" id="sp" name="sp" value="" required="" class="form-control">
                                    <input type="hidden" id="sp_id" name="sp_id" value="">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Perfil</label>
                                    <select id="perfil" name="perfil" class="form-control">
                                        <option value=""></option>
                                        <option value="1">Solicitante</option>
                                        <option value="2">Habilitado</option>
                                        <option value="3">Vigilancia</option>
                                        <option value="4">Recursos Materiales</option>
                                        <option value="5">Directivo</option>
                                        <option value="6">Sistemas</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Tipo trabajador</label>
                                    <select id="trabajador" name="trabajador" class="form-control">
                                        <option value=""></option>
                                        <option value="1" selected>Servidor publico</option>
                                        <option value="2">Vigilante</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-success btn-flat">
                                    <i class="fa fa-floppy-o"></i> Generar cuenta
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div  class="col-md-12">
                            <form action="#" id="frm_insert_account" method="post"></form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

