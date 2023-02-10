<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url();?>lib/plugin/css/fontawesome/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url();?>lib/plugin/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>lib/plugin/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>lib/plugin/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>lib/plugin/css/plusultra.css">
  <!-- Graph -->
  <script src="<?php echo base_url();?>lib/plugin/js/highcharts.js"></script>
  <script src="<?php echo base_url();?>lib/plugin/js/exporting.js"></script>
  <!-- End -->
  <!-- Alert -->
  <script type="application/javascript" charset=utf-8 src="<?php echo base_url();?>lib/plugin/js/sweetalert2.min.js"></script>
  <script type="application/javascript" charset=utf-8 src="<?php echo base_url();?>lib/plugin/js/toastr.min.js"></script>
  <!-- End -->
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout" role="button">
        <i class="fas fa-sign-out-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="https://nimbusnac.com" class="brand-link">
      <img src="<?php echo base_url();?>lib/plugin/img/nimbus.png" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Nimbus NAC</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="<?php echo base_url(); ?>dashboard" class="nav-link" id="nav_dashboard">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url(); ?>users" class="nav-link" id="nav_users">
              <i class="nav-icon fab fa-hubspot"></i>
              <p>
                Users
              </p>
            </a>
          </li>
          <?php
          foreach($data_page as $row);
          if($row['priority'] == '9'){
          ?>
          <li class="nav-item" id="nav_system_manager">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                System Manager
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
             <li class="nav-item">
                <a href="<?php echo base_url(); ?>admin" class="nav-link" id="nav_administrator">
                <i class="nav-icon fas fa-user-shield ml-md-4"></i>
                  <p>Administrator</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>clients" class="nav-link" id="nav_clients">
                <i class="nav-icon fas fa-users ml-md-4"></i>
                  <p>Clients</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>groups" class="nav-link" id="nav_groups">
                <i class="nav-icon fas fa-users ml-md-4"></i>
                  <p>Groups</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

