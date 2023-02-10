<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="insight-app-sec-validation" content="31b28e85-3f6d-4d28-9b9e-ce28b2c1dae3">
  <meta http-equiv="Content-Security-Policy" content="policy-definition">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Nimbus NAC | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url();?>lib/plugin/css/fontawesome/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url();?>lib/plugin/css/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>lib/plugin/css/master.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>lib/plugin/css/toastr.min.css">


  <style>
body {
	font-family: 'Varela Round', sans-serif;
}
.modal-confirm {		
	color: #636363;
	width: 325px;
}
.modal-confirm .modal-content {
	padding: 20px;
	border-radius: 5px;
	border: none;
}
.modal-confirm .modal-header {
	border-bottom: none;   
	position: relative;
}
.modal-confirm h4 {
	text-align: center;
	font-size: 26px;
	margin: 30px 0 -15px;
}
.modal-confirm .form-control, .modal-confirm .btn {
	min-height: 40px;
	border-radius: 3px; 
}
.modal-confirm .close {
	position: absolute;
	top: -5px;
	right: -5px;
}	
.modal-confirm .modal-footer {
	border: none;
	text-align: center;
	border-radius: 5px;
	font-size: 13px;
}	
.modal-confirm .icon-box {
	color: #fff;		
	position: absolute;
	margin: 0 auto;
	left: 0;
	right: 0;
	top: -70px;
	width: 95px;
	height: 95px;
	border-radius: 50%;
	z-index: 9;
	background: #ef513a;
	padding: 15px;
	text-align: center;
	box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
}
.modal-confirm .icon-box i {
	font-size: 56px;
	position: relative;
	top: 4px;
}
.modal-confirm.modal-dialog {
	margin-top: 80px;
}
.modal-confirm .btn {
	color: #fff;
	border-radius: 4px;
	background: #ef513a;
	text-decoration: none;
	transition: all 0.4s;
	line-height: normal;
	border: none;
}
.modal-confirm .btn:hover, .modal-confirm .btn:focus {
	background: #da2c12;
	outline: none;
}
.trigger-btn {
	display: inline-block;
	margin: 100px auto;
}
</style>

</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <!-- <a href="../../index2.html"><b>Admin</b>LTE</a> -->
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg"><b>Nimbus Admin Login</b></p>

      <form action="<?php echo base_url('login/aksi_login'); ?>" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Username" name="username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" autocomplete="off" placeholder="Password" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row float-right">
            <button type="submit" class="btn btn-secondary btn-block mr-md-2">Login</button>
        </div>
      </form>
      <!-- <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p> -->
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script type="application/javascript" charset=utf-8 src="<?php echo base_url();?>lib/plugin/js/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script type="application/javascript" charset=utf-8 src="<?php echo base_url();?>lib/plugin/js/bootstrap.bundle.min.js"></script>
<!-- Alert -->
<script type="application/javascript" charset=utf-8 src="<?php echo base_url();?>lib/plugin/js/sweetalert2.min.js"></script>
<script type="application/javascript" charset=utf-8 src="<?php echo base_url();?>lib/plugin/js/toastr.min.js"></script>
<!-- master App -->
<script type="application/javascript" charset=utf-8 src="<?php echo base_url();?>lib/plugin/js/master.min.js"></script>

<script>
'use strict';
document.addEventListener("DOMContentLoaded", function() {
	if (window.location.href.indexOf("#fail") > -1) {
		toastr.error('Invalid username or password');
	}
});
</script>
</body>
</html>
