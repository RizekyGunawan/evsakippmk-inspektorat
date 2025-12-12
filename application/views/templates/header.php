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
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="shortcut icon" href="<?php echo base_url() ?>assets/dist/img/s.png">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/summernote/summernote-bs4.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/toastr/toastr.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
  
  <style>
        body {
            background-color: white;
            color: black;
            transition: background-color 0.3s, color 0.3s;
        }

        body.dark-mode {
            background-color: #121212;
            color: white;
        }

        .toggle-switch {
            width: 60px;
            height: 34px;
            position: relative;
            display: inline-block;
        }

        .toggle-checkbox {
            display: none;
        }

        .toggle-label {
            display: block;
            width: 100%;
            height: 100%;
            background-color: #ccc;
            border-radius: 34px;
            position: relative;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .toggle-label::before {
            content: '☀︎';
            position: absolute;
            top: 50%;
            left: 2px;
            width: 30px;
            height: 30px;
            background-color: white;
            border-radius: 50%;
            text-align: center;
            line-height: 30px;
            font-size: 16px;
            color: black;
            transform: translateY(-50%);
            transition: transform 0.3s, background-color 0.3s, color 0.3s, content 0.3s;
        }

        .toggle-checkbox:checked + .toggle-label {
            background-color: #6c757d;
        }

        .toggle-checkbox:checked + .toggle-label::before {
            content: '🌙';
            background-color: black;
            color: white;
            transform: translate(26px, -50%)rotate(90deg);
        }
    </style>

</head>
<body class="hold-transition sidebar-mini sidebar-collapse layout-fixed layout-navbar-fixed">
<div class="wrapper">

<style type="text/css">
  .truncate {
    display: inline-block;
    max-width: 800px; /* Atur lebar maksimal sesuai kebutuhan */
    white-space: wrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

</style>
  <!-- Preloader -->
  <!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?php echo base_url() ?>assets/dist/img/s.png" alt="AdminLTELogo" height="60" width="60">
  </div> -->

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-black navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      
      <li class="nav-item d-none d-sm-inline-block">
        <a class="nav-link truncate" href="#"><?php echo $this->session->userdata('nm_user'); ?></a>
      </li>

      
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->

      <?php $this->load->view('templates/notifications_dropdown'); ?>
     
       <li class="nav-item d-none d-sm-inline-block">
       
        <?php foreach ($unit4 as $unt4) : ?>
        <a data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button" class="nav-link truncate"><?php echo $unt4['nm_unit']; ?></a>
          <?php endforeach; ?>
          
      </li>
      
      
      <li class="nav-item d-none d-sm-inline-block">
        <a data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button" class="nav-link"><?php echo $this->session->userdata('tahun'); ?></a>
      </li>


      <li class="nav-item dropdown">

        <a data-toggle="dropdown" href="#" aria-expanded="false" class="nav-link truncate"><i class="fas fa-user" ></i> <?php echo $this->session->userdata('username'); ?></a>
         
          <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right" style="left: inherit; right: 0px;">
          <!-- <a href="<?php echo base_url('profil/index'); ?>" class="dropdown-item"> -->
            <!-- Message Start -->
            <!-- <div class="media">
              
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Profil
                </h3>
              </div>
            </div> -->
            <!-- Message End -->
          <!-- </a> -->
          <!-- <div class="dropdown-divider"></div> -->
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <div class="media-body" data-toggle="modal" data-target="#EditPass<?php echo $this->session->userdata('id_user'); ?>">
                <h3 class="dropdown-item-title">
                  Ganti Password
                </h3>
              </div>
            </div>
            <!-- Message End -->
          </a>
          
      </li>


       <li class="nav-item d-none d-sm-inline-block">
        <a class="nav-link" href="<?php echo base_url('auth2/logout'); ?>"  role="button">
           <i class="fas fa-sign-out-alt" title="Sign Out" ></i>
           </a>
      </li>
   
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
      <li class="nav-item">
        <body>
    <div class="toggle-switch">
        <input type="checkbox" id="toggle-dark-mode" class="toggle-checkbox">
        <label for="toggle-dark-mode" class="toggle-label"></label>
    </div>
        </body>
      </li>


    </ul>
  </nav>
  <!-- /.navbar -->


 <!-- Modal Edit -->
<?php
foreach ($user as $usr) : ?>
<div class="modal fade" id="EditPass<?php echo $this->session->userdata('id_user'); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ganti Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">

        <?php echo form_open_multipart('home/update_pass'); ?>
       
           
          <input type="hidden" name="id_user" value="<?php echo $this->session->userdata('id_user'); ?>">

          <div class="row">

            <div class="form-group col-md-12">
            <h5><?php echo $this->session->userdata('username'); ?></h5></div>
          <div class="form-group col-md-12">
            <label>Password</label>
            <input required="required" type="password" name="password" class="form-control" value="" >
                </div>
      
           </div>
           
          

        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
          
      <?php echo form_close(); ?>
      </div>

      
    </div>
  </div>
</div>
<?php endforeach; ?>


<script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleCheckbox = document.getElementById('toggle-dark-mode');

            if (localStorage.getItem('dark-mode') === 'true') {
                document.body.classList.add('dark-mode');
                toggleCheckbox.checked = true;
            }

            toggleCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    document.body.classList.add('dark-mode');
                    localStorage.setItem('dark-mode', 'true');
                } else {
                    document.body.classList.remove('dark-mode');
                    localStorage.setItem('dark-mode', 'false');
                }
            });
        });
    </script>




 