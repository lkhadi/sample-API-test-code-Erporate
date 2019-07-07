<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title;?></title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css');?>">
</head>
<body>
	<div class="container-fluid">
		<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
		  <ul class="navbar-nav">
		    <li class="nav-item">
		      <a class="nav-link" href="<?php echo base_url();?>">Home</a>
		    </li>
		    <li class="nav-item">
		      <a class="nav-link" href="<?php echo base_url('daftar_menu');?>">Menu</a>
		    </li>
		    <li class="nav-item">
		      <a class="nav-link" href="<?php echo base_url('pesanan');?>">Pesanan</a>
		    </li>
		    <li class="nav-item">
		      <a class="nav-link" href="<?php echo base_url('logout');?>">Logout</a>
		    </li>
		  </ul>
		</nav>
	</div>