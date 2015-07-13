<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to Organize My Tasks</title>

	<!-- stylesheets -->

 	<link href='http://fonts.googleapis.com/css?family=Open+Sans:600' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css"href="<?php echo base_url('/files/css/bootstrap.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('/files/css/font-awesome.css'); ?> ">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('/files/css/bootstrap-theme.css'); ?> ">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('/files/css/custom.css'); ?>">


		<!-- javascript -->
	<script src="<?php echo base_url('bootstrap/js/bootstrap.js'); ?>"></script>

</head>
<body>
	<meta charset='utf-8'>
	<title>Password Recovery</title>
	<div class="container">
	<div id="containter" align="center">
	<!-- <img src="../files/images/logo.png"> -->
	<h2>Password Recovery</h2>





		<?php
		echo "<h3>";
		$message = $this->session->flashdata('message');
		echo $message;
		echo "</h3>";
		echo form_open('main/recover_password');

		echo '<div class="row">';

		echo '<div class="col-md-4">';
		echo "</div>";

		echo '<div class="col-md-4">';

		echo "<p class='input_button'>";

		$data = array(
				'name' => 'email',
				'placeholder' => 'Enter the email you used to log in with...',
				'class' => 'input-text',
				'type' => 'text'
			);

		echo form_input($data);
		echo "</p>";

		echo "</div>";

		echo '<div class="col-md-4">';
		echo "</div>";

		echo "</div>";



	
		echo '<div class="row">';

		echo '<div class="col-md-4">';
		echo "</div>";

		echo '<div class="col-md-4">';

		echo form_submit('recovery_submit', ' submit ');

		echo "</div>";

		echo '<div class="col-md-4">';
		echo "</div>";

		echo "</div>";


		echo form_close();
	?>



	<div class ="forgo_sig">
	<a href="<?php echo base_url().'main/login'?>" class="for_sig"><strong>Click here to log in</strong></a>
	|
	<a href="<?php echo base_url().'main/signup'?>"class="for_sig"><strong>Click here to sign up</strong></a>
		
	</div> 










    

	





	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	</div>
</body>
</html>