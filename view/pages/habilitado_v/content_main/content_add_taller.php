<?php 
require_once 'model/HabilitadoModel.php';
if (isset($_GET['taller'])) {
    $taller = new HabilitadoModel;
    $t = $taller->getTaller($_GET['taller']);
    $rs = (isset($t[0]->r_social)) ? $t[0]->r_social : NULL;
    $con = (isset($t[0]->contacto)) ? $t[0]->contacto : NULL;
    $tel = (isset($t[0]->telefono)) ? $t[0]->telefono : NULL;
    $email = (isset($t[0]->correo)) ? $t[0]->correo : NULL;
    $dir = (isset($t[0]->domicilio)) ? $t[0]->domicilio : NULL;
}
else
{
    $t      = NULL;
    $rs     = NULL;
    $con    = NULL;
    $tel    = NULL;
    $email  = NULL;
    $dir    = NULL;
}
?>
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Formulario de alta de talleres.</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <form action="#" method="post" id="frm_add_taller">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="alerta" class="alert hidden alert-dismissible ">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h4><i class="icon fa fa-info"></i> <label id="estado"> AVISO! </label> </h4>
                                    <p id="message"></p>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="option" value="14">
                        <?php if (isset($_GET['taller'])): ?>
                        <input type="hidden" name="id" value="<?=$_GET['taller']?>">
                        <?php endif ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Razón social</label>
                                    <input type="text" id="r_social" name="r_social" value="<?=$rs?>" placeholder="Ej: Coca Cola S.A de C.V." required class="form-control" maxlength="255" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Contacto</label>
                                <input type="text" id="contacto" name="contacto" value="<?=$con?>" placeholder="Ej: Juan Peréz" required class="form-control" maxlength="255">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Teléfono</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                    <input type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask id="tel" name="tel" maxlength="20" value="<?=$tel?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                              <label>Correo electrónico</label>
                              <input type="email" id="email" name="email" class="form-control" placeholder="micarreo@gmail.com" value="<?=$email?>" maxlength="255">
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                            <label>Escriba la dirección.</label>
                            <textarea class="form-control" id="direccion" name="direccion" value="" required="" style="resize: vertical;"><?=$dir?></textarea>
                        </div>
                      </div>
                  </div> 
                  <div class="row">
                      <div class="col-md-4"></div>
                      <div class="col-md-4">
                          <button type="submit" class="btn btn-success btn-block btn-flat"> <i class="fa fa-floppy-o"></i> Guardar taller </button>
                      </div>
                      <div class="col-md-4"></div>
                  </div> 
              </form>
          </div>
      </div>
  </div>
</div>
</section>