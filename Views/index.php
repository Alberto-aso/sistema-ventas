<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistema de Ventas</title>

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url ?>Assets/css/bootstrap/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Hoja de Estilos css-->
  <link rel="stylesheet" href="<?php echo base_url ?>Assets/css/style/style.min.css">
  <!--Font Awsome-->
  <script src="<?php echo base_url ?>Assets/js/fontawesome/all.min.js" crossorigin="anonymous"></script>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b style="color: blue;">Telcel</b>OYM</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Login para Sistema de Ventas</p>

      <form id="frmLogin" method="POST">
        <div class="input-group mb-3">
          <input type="number" id="usuario" name="usuario" class="form-control" placeholder="No.Empleado">
          <div class="input-group-append">
            <div class="input-group-text">
            <span class="fa-solid fa-user" style="color: blue;"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="clave" id="clave" name="clave">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock" style="color: blue;"></span>
            </div>
          </div>
        </div>
        <div class="alert text-center text-danger text-danger d-none" id="alertaLogin">
        </div>
        <button type="submit" class="btn btn-primary btn-block" onclick="frmLogin(event);">Ingresar</button>
      </form>
    </div>
  </div>
</div>

<!-- jQuery -->
<script src="<?php echo base_url ?>Assets/js/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url ?>Assets/js/bootstrap/bootstrap.bundle.min.js"></script>
<!-- jquery-validation -->
<script src="Assets/js/jquery/jquery-validate/jquery.validate.min.js"></script>
<script src="Assets/js/jquery/jquery-validate/additional-methods.min.js"></script>
<!-- Login JS -->
<script>
    const base_url = "<?php echo base_url //Constante URL para hacer uso de ella en las peticiones?>"
</script>
<script src="<?php echo base_url ?>Assets/js/funciones/login.js"></script>
</body>
</html>
