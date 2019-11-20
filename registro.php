<!DOCTYPE html>
<html>
<?php
include 'view/pages/head.php';
?>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="#"> SOPORTE TÉCNICO <b>ST</b></a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg"> <label>Formulario de registro</label> </p>
    <div class="row">
      <div class="col-md-12">
        <div id="alert_registro" class="alert alert-dismissible hidden">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4><i class="icon fa fa-info"></i> Aviso!</h4>
          <p id="message"></p>
        </div>
      </div>
    </div>  
    <form id="frm_alta_usuario" action="#" method="post">
      <input type="hidden" name="option" value="75" >
      <div class="form-group has-feedback">
        <label> Nombre personal: </label>
        <input type="text" class="form-control" placeholder=" . . . " name="servidor" id="servidor">
        <input type="hidden" name="servidor_id" id="servidor_id" value=""  >
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <!-- <div class="form-group has-feedback">
        <label> Área: </label>
        <input type="text" class="form-control" placeholder="Área en la que se encuentra..." name="area" id="area">
        <input type="hidden" id="area_id" name="area_id" value="">
        <span class=" glyphicon glyphicon-briefcase form-control-feedback"></span>
      </div> -->
      <div class="form-group has-feedback">
         <label>Clave de servidor público: </label>
        <input type="text" class="form-control" placeholder="Clave de servidor público" name="clave" pattern="[0-9]*" maxlength="12" autocomplete="off">  
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
         <label>Genero: </label>
        <select class="form-control" name="genero" id="genero" required>
          <option value="">...</option>
          <option value="1">Hombre</option>
          <option value="2">Mujer</option>
        </select>
        
      </div>
      <div class="form-group has-feedback">
        <label> Nombre de usuario: </label>
        <input type="text" name="user_name" class="form-control" placeholder="Nombre de usuario..." autocomplete="off" value="">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
         <label> Contraseña: </label>
        <input type="password" class="form-control" placeholder="Contraseña" value="" name="pass">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
         <label> Repita la contraseña: </label>
        <input type="password" class="form-control" placeholder="Repita contraseña" name="reply_pass">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

      <div class="row">
      	<div class="col-xs-3"></div>
        <div class="col-xs-6">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Registrarme</button>
        </div>
        <div class="col-xs-3"></div>
      </div>
    </form>
    <div class="row">
    	<div class="col-xs-12 text-center">
    		<a href="login.php" class="text-center">Ya estoy registrado.</a>
    	</div>
    </div>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<?php include_once 'view/pages/scripts.php'; ?>
<script src="view/dist/js/main.other.js" type="text/javascript"></script>