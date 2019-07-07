<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css');?>">
</head>
<body>
	<div class="container">
		<div class="jumbotron">
			<h3 class="text-center">Web System Kasir</h3>
			<?php echo $this->session->flashdata('alert');?>
			<form method="POST">
				<div class="form-group">
					<label>Username</label>
					<input type="text" name="username" required="" class="form-control">
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="password" name="password" required="" class="form-control">
				</div>
				<input type="submit" value="Log in" class="btn btn-primary">
			</form>
		</div>
	</div>
	<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-3.4.1.min.js');?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>
</body>
</html>