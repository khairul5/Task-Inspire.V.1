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
	<title>Sign Up</title>

	<div id="containter" align="center">
	<img src="../files/images/logo.png">
	<h1>Sign up form</h1>
	<?php
	//auto load form helper in autoload for this to work
	echo form_open('main/signup_validation');
	echo validation_errors();
	$message = $this->session->flashdata('message');
	echo $message;
	/*echo "<p>First Name: ";
	echo form_input('first_name', $this->input->post('first_name'));
	echo "</p>"; */
	?>

	<div class="row">
		<div class="col-md-4">
		</div>

		<div class="col-md-4">
			<div class="input text required">
			<?php
			$data = array(
				'name' => "first_name",
				'class' => "input-text",
				'placeholder' => "First Name",
				//'maxlength' => "50",
				'type' => "text",
				//'required' => "required"
				);
			 echo form_input($data); 

			 ?>
	<!--		<input name="first_name" class="input-text" placeholder="First Name" maxlength="50" 
			type="text" id="first_name" required="required"> -->
			</div>
		</div>

		<div class="col-md-4">
		</div>
	</div>

		<!-- Last Name -->

	<div class="row">

		<div class="col-md-4">
		</div>

		<div class="col-md-4">
			<div class="input text required">

			<?php
			$data = array(
				'name' => "last_name",
				'class' => "input-text",
				'placeholder' => "Last Name",
				//'maxlength' => "50",
				'type' => "text",
				//'required' => "required"
				);
			 echo form_input($data); 

			 ?>			
  				<!--<input name="last_name" class="input-text" 
  				placeholder="Last Name" maxlength="50" type="text" id="UserLastName" required="required">-->
			</div>
		</div>

		<div class="col-md-4">
		</div>
	</div>



	<!-- Email -->
	<div class="row">

		<div class="col-md-4">
		</div>

		<div class="col-md-4">
			<div class="input email required">

			<?php
			$data = array(
				'name' => "email",
				'class' => "input-text",
				'placeholder' => "Email (this is what you will use for sign in)",
				//'maxlength' => "50",
				'type' => "text",
				//'required' => "required"
				);
			 echo form_input($data); 

			 ?>

			 <!-- <input name="email" class="input-text" placeholder="Email (this is what you will use for sign in)" 
			  maxlength="255" type="email" id="UserEmail" required="required">-->
			</div>
		</div>

		<div class="col-md-4">
		</div>
	</div>


	<!-- Password -->

	<div class="row">

		<div class="col-md-4">
		</div>

		<div class="col-md-4">
			<div class="input password required">

			<?php
			$data = array(
				'name' => "password",
				'class' => "input-text",
				'placeholder' => "Password",
				//'maxlength' => "50",
				'type' => "password",
				//'required' => "required"
				);
			 echo form_input($data); 

			 ?>

		<!--	<input name="password" class="input-text" placeholder="Password" 
			type="password" id="UserRegisterPassword" required="required"> -->
			</div>
		</div>

		<div class="col-md-4">
		</div>
	</div>


	<!-- Confirm Password -->

	<div class="row">

		<div class="col-md-4">
		</div>

		<div class="col-md-4">

			<?php
			$data = array(
				'name' => "cpassword",
				'class' => "input-text",
				'placeholder' => "Enter your password again",
				//'maxlength' => "50",
				'type' => "password",
				//'required' => "required"
				);
			 echo form_input($data); 

			 ?>		
		<!--	<div class="input password required"><input name="cpassword" class="input-text" 
			placeholder="Enter your password again" type="password" id="UserRegisterPasswordConfirm" required="required">
			</div> -->
		</div>

		<div class="col-md-4">
		</div>
	</div>



	<!-- Submit -->

	<div class="row">

		<div class="col-md-4">
		</div>

		<div class="col-md-4">
			<!--<div class="submit"><input class="button" type="submit" name="signup_submit" value=" Sign up! ">-->
			<?php 
	echo form_submit('signup_submit', ' Sign Up! '); 

			?>
			</div>

		<div class="col-md-4">
		</div>
	</div>


	<?php

	/*echo "<p>Last Name: ";
	echo form_input('last_name', $this->input->post('last_name'));
	echo "</p>";

	echo "<p>Email: ";
	// the default value for the field email will be "$this->input->post('email'" so that
	//when a user reloads the registration form upon failure of validation, the email is already there.
	echo form_input('email', $this->input->post('email'));
	echo "</p>";

	echo "<p>Password: ";
	echo form_password('password');
	echo "</p>";

	echo "<p>Confirm Password: ";
	echo form_password('cpassword');
	echo "</p>";

	echo form_submit('signup_submit', ' Sign Up! '); */

	echo form_close();
	?>
	<br/>
	<p>
	Already have an account?
	</p>
	<a href="<?php echo base_url().'main/login'?>">Click here to log in.</a>
		
	</div>
</body>
</html>