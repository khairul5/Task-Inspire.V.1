<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to Organize My Tasks</title>

	<!-- stylesheets -->

 	<link href='http://fonts.googleapis.com/css?family=Open+Sans:600italic,400,300,600,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css"href="<?php echo base_url('/files/css/bootstrap.css'); ?>">
    <link href="<?php echo base_url('material'); ?>/dist/css/roboto.min.css" rel="stylesheet">
    <link href="<?php echo base_url('material'); ?>/dist/css/material-fullpalette.min.css" rel="stylesheet">
    <link href="<?php echo base_url('material'); ?>/dist/css/ripples.min.css" rel="stylesheet">
    <link href="//fezvrasta.github.io/snackbarjs/dist/snackbar.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css"href="https://cdnjs.com/libraries/bootstrap-material-design">

	<link rel="stylesheet" type="text/css" href="<?php echo base_url('/files/css/custom.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('/files/css/bootstrap-datetimepicker.min.css'); ?>">





		<!-- javascript -->
	<script src="<?php echo base_url('bootstrap/js/bootstrap.js'); ?>"></script>
	<script src="<?php echo base_url('/files/js/bootstrap-datetimepicker.min.js'); ?>"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

</head>
<body>

	<div class="container" id="container" align="center">
		<img class="head_img" src="./files/images/logo1.png">
		<h4>Get everyone of your team on the same page, discuss stuff, set due dates, organize everything.</h4>
		<br>
		<br>


		<div class="row">	
			<div class="col-md-3">
			</div>
			<div class="col-md-3">
			<a href="<?php echo base_url().'main/login' ?>"><button class="button">Click here to log in</button></a>
			</div>
			<div class="col-md-3">
			<a  href="<?php echo base_url().'main/signup' ?>"><button class="button">Click here to sign up</button></a>
			</div>	
			<div class="col-md-3">
			</div>	
		</div>
	


	</div>

</body>
</html>