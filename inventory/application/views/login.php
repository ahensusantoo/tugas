
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $title ?></title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/back-end/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/back-end/bower_components/font-awesome/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/back-end/bower_components/Ionicons/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/back-end/dist/css/AdminLTE.min.css">
	<!-- iCheck -->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/back-end/plugins/iCheck/square/blue.css">

	<!-- Google Font -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
	<div class="login-logo">
		<a><b>My</b>POS</a>
	</div>
	<!-- /.login-logo -->
	<div class="login-box-body">
		<p class="login-box-msg">silahkan melakukan login</p>

		 <?php
			//notifikasi error
			echo validation_errors('<div class="alert alert-success">','</div>');

			//notifikasi saat gagal login
			if($this->session->flashdata('warning')){
			  echo '<div class="alert alert-warning">';
			  echo $this->session->flashdata('warning');
			  echo '</div>';
			}

			 //notifikasi logout
			if($this->session->flashdata('sukses')){
			  echo '<div class="alert alert-success">';
			  echo $this->session->flashdata('sukses');
			  echo '</div>';
			}
		?>

		<form action="<?php echo site_url('auth/process') ?>" method="post">
			<div class="form-group has-feedback">
				<input type="text" name="username" class="form-control" placeholder="Username" required>
				<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
			</div>
			<div class="form-group has-feedback">
				<input type="password" name="password" class="form-control" placeholder="Password" required>
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			</div>
			<div class="row">
				<div class="col-xs-8">
				</div>
				<!-- /.col -->
				<div class="col-xs-4">
					<button type="submit" name="login" class="btn btn-primary btn-block btn-flat">Sign In</button>
				</div>
				<!-- /.col -->
			</div>

		</form>
		<!-- /.social-auth-links -->
	</div>
	<!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?php echo base_url() ?>assets/back-end/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url() ?>assets/back-end/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url() ?>assets/back-end/plugins/iCheck/icheck.min.js"></script>
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
