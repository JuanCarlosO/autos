<!DOCTYPE html>
<html>

<?php
session_start();
session_destroy();
include 'view/pages/head.php';
?>

<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="login.php">CONTROL VEHICULAR -  <b>SCV</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Ingresa datos de tu cuenta para iniciar sesión.</p>
    <?php if ( isset( $_GET['err'] ) ): ?> 
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" onclick="actualizarPag(1);">×</button>
          <h4><i class="icon fa fa-ban"></i> Alerta!</h4>
          <?php if ( $_GET['err'] == 'userempty'): ?>
            Escriba su nombre de usuario.
          <?php endif ?>
          <?php if ( $_GET['err'] == 'passempty'): ?>
            Escriba la contraseña de su cuenta.         
          <?php endif ?>
          <?php if ( $_GET['err'] == 'deny-access'): ?>
            Acceso no permitido. No existe un usuario registrado con los datos anteriores.<br>  
          <?php endif ?>
        </div>
      </div>
    </div>           
    <?php endif ?>
    

    <form action="controller/puente.php" method="post">
      <input type="hidden" name="option" value="1">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Nombre de usuario" value="" autocomplete="off" name="username" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Contraseña" name="userpass" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-3"></div>
        <div class="col-xs-6">
          <button type="submit" class="btn btn-success btn-block btn-flat">Iniciar sesión</button>
        </div>
        <div class="col-xs-3"></div>
      </div>
    </form>
    <hr>
    <div class="row">
      <div class="col-xs-12 text-center">
        <a href="registro.php" class="">No tengo cuenta - <b>Deseo registrarme</b>.</a>
      </div>
    </div>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<?php include_once 'view/pages/scripts.php'; ?>
<script src="view/dist/js/main.login.js"></script>