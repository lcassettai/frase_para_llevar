<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo assets_url('bower_components');?>bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo assets_url('bower_components');?>font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo assets_url('bower_components');?>Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
<link rel="stylesheet" href="<?php echo assets_url('assets');?>css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo assets_url('plugins');?>iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
<?php if(isset($errores)):?>
<div class="alert alert-danger">
  <strong>Parece que algo salio mal!</strong> <br>
  <p><?php echo $errores;?></p>
</div>
<?php endif;?>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <div class="login-logo">
      Frase para <b>Llevar</b> <span id="version" style="font-size: 10px;"><?php echo obtener_version();?></span>
	  </div>	
  	<?php echo form_open('login/verificar_credenciales'); ?>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Usuario" name="usuario"
        <?php if (isset($_COOKIE['usuario'])){
          echo "value='".$_COOKIE['usuario']."'";
        }?>
        >
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password" 
        <?php if (isset($_COOKIE['pass'])){
          echo "value='".$_COOKIE['pass']."'";
        }?>>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="recordarme" 
                <?php if (isset($_COOKIE['recordarme'])){
                   echo "checked='".$_COOKIE['recordarme']."'";
                }?>
              > Recordarme
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-danger btn-block btn-flat">Ingresar</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?php echo assets_url('bower_components');?>jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo assets_url('bower_components');?>bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo assets_url('plugins');?>iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
