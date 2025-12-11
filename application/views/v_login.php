
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ev-SAKIP | Kemenko PMK</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/select2/select2.min.css">
  <link rel="shortcut icon" href="<?php echo base_url() ?>assets/dist/img/s.png">
  <style type="text/css">
      .login-page, .register-page {
          background: url('<?php echo base_url() ?>assets/dist/img/background1.jpg');
          color: #ffffff !important;
          background-repeat: no-repeat;
          background-position: center;
          background-size: cover;
          width: 100%;
      }
      
    </style>
</head>
<body class="hold-transition login-page" >
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b></b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="" class="h1 text-dark"><b>Ev-SAKIP</b></a>
    </div>
    
    <div class="card-body login-card-body">

      <p class="login-box-msg">Masukkan Username dan Password</p>
     
      <form action="<?php echo base_url('auth2/login') ?>" method="post">

        <?php echo form_error('username', '<div class="text-danger small ml-2">','</div>'); ?>
        <div class="input-group mb-3">
          <input type="Text" class="form-control" placeholder="Username" name="username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <?php echo form_error('password', '<div class="text-danger small ml-2">','</div>'); ?>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="form-group has-feedback">
            <label>Tahun</label>
            <select id="tahun" class="form-control select2" name="tahun" style="width:100%">
                  <option value="2022">2022</option>
                  <option value="2023">2023</option>
                  <option selected="selected" value="2024">2024</option>
                  <option value="2025">2025</option>
            </select> 
          </div>
         
          <?php echo $image ?> <a href="#" onclick="parent.window.location.reload(true)"><i class="fas fa-sync-alt"></i></a>
         <br><br>
         <?php echo form_error('captcha', '<div class="text-danger small ml-2">','</div>'); ?>
         <input type="text" placeholder="Captcha" id="captcha" name="captcha" class="form-control" pattern="<?php echo $this->session->userdata('captcha_word'); ?>">
         <div class="g-recaptcha" data-sitekey="6LcgtD4mAAAAANgk1tfLnrGSfXCyfab4ceFcHa7e"></div>
         <br><br>
        <div class="row">
          <div class="col-8">
            
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block form-control">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      

      
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
<h5 class="text-center" style="display: block;margin-top: 30px">Copyright © 2023 Inspektorat BPKP - Kemenko PMK. All rights reserved.</h5>
<!-- jQuery -->
<script src="<?php echo base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url() ?>assets/dist/js/adminlte.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/select2/select2.min.js"></script>

<script type="text/javascript">
  const captcha = document.getElementById("captcha");

captcha.addEventListener("input", (event) => {
  if (captcha.validity.patternMismatch) {
    captcha.setCustomValidity("Captcha tidak sesuai!");
    captcha.reportValidity();
  } else {
    captcha.setCustomValidity("");
  }
});
</script>
</body>
</html>
