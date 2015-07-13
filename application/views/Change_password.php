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
	<h3>Type your new password</h3>





		<?php
		echo "<h3>";
		echo $message;
		echo "</h3>";
		echo form_open('main/record_password');



		echo "<select name='email' hidden>";
		echo "<option value=".$email." selected></option>";
		echo "</select>";

		echo "<select name='key' hidden>";
		echo "<option value=".$key." selected></option>";
		echo "</select>";		

		echo '<div class="row">';

		echo '<div class="col-md-4">';
		echo "</div>";

		echo '<div class="col-md-4">';

		echo "<p class='input_button'>";

		$data = array(
				'name' => 'password',
				'placeholder' => 'Type your new password...',
				'class' => 'input-text',
				'type' => 'password'
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

		echo form_submit('record_new_password_submit', ' Change Password ');

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