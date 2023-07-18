<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Login</title>
	<link rel="shortcut icon" href="https://www.sumimsa.com.mx/img/favicon.ico">
	
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

	<link rel="stylesheet" href="../layout/css/bootstrap.css">  
	<link rel="stylesheet" href="../layout/css/AdminLTE.css">
	<link rel="stylesheet" href="../layout/css/skin-blue.css">
	<link rel="stylesheet" href="../layout/css/teme-footer.css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

	<link rel="icon" type="image/png" href="../layout/img/icon.png" />
</head>

<style>
	.login-box-body {
		box-shadow:1px 1px 5px #9C9C9C;
		padding: 0px;
	}
	.widget-user-header {
		background-color: #FFFF;
		color: white;
	}
	.widget-user-2 .widget-user-image > img {
		float: none;
		width: 250px;
		margin-left: 35px;
	}

	footer {
		margin-top: 100px;
	}

	.login-page {
		background-color: #6A95E7;
	}
</style>

<body class="hold-transition login-page">
	<!-- Full Width Column -->
	
	<div class="login-box">
	  <!-- /.login-logo -->
	  <br>
	  <div class="login-box-body">
			<!-- Widget: user widget style 1 -->
			<div class="box box-widget widget-user-2">
				<!-- Add the bg color to the header using any of the bg-* classes -->
				<div class="widget-user-header">
					<div class="widget-user-image">
						<img src="../img/logo.png" alt="Store Avatar">
					</div>
					<!-- /.widget-user-image -->
				</div>
				<div class="box-footer no-padding">
				<form action="../controller/login.php" method="POST">
					<ul class="nav nav-stacked">
						<li><a >Ingrese usuario y contraseña</a></li>
						<li><a>
							<div class="group-form has-feedback">
                     	<!-- input email -->
                     	<input type="text" class="form-control" placeholder="Email" id="email" name="email">
                     	<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
						</a></li>
						<li><a>
							<div class="form-group has-feedback">
								<!-- input pass -->
								<input type="password" class="form-control" placeholder="Password" id="pass" name="pass">
								<span class="glyphicon glyphicon-lock form-control-feedback"></span>
							</div>
						</a></li>
						<li><a>
							<input type="submit" name="login" value="Entrar" class="btn btn-primary btn-block btn-flat" style="background-color: #6AB5E7; border-color: #6AB5E7;">
						</a></li>
						<li><a>
							<div id="session-error"><?php echo $_SESSION['error'] ?></div>
						</a></li>
					</ul>
				</form>
				</div>
			</div>
			<!-- /.widget-user -->
	  </div>
	  <!-- /.login-box-body -->
	</div>


	<script src="../layout/js/jquery.js"></script>
	<script src="../layout/js/bootstrap.js"></script>
	<script src="../layout/js/app.min.js"></script>
	<script src="../layout/js/sweetalert.min.js"></script>	
</body>
</html>