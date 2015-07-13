<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>


	<meta charset='utf-8'>
	<title>Login</title>
	<div class="container">
	<div id="containter" align="center">
	<!-- <img src="../files/images/logo.png"> -->
	<h2>Log in</h2>





		<?php
		echo "<h3>";
		echo $message;
		echo "</h3>";
		echo form_open('main/login_validation');




		echo '<div class="row">';

		echo '<div class="col-md-4">';
		echo "</div>";

		echo '<div class="col-md-4">';

		echo "<p class='input_button'>";
		// the default value for the field email will be "$this->input->post('email'" so that
		//when a user reloads the login form upon failure of login, the email is already there.

		//echo form_input('email', $this->input->post('email'));
		$data = array(
				'name' => 'email',
				'placeholder' => 'Email',
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

		echo "<p class='input_button'>";
		//echo form_password('password');
		$data = array(
			'name' => "password",
			'class' => "input-text",
			'placeholder' => "Password",
			//'maxlength' => "50",
			'type' => "password",
			//'required' => "required"
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

		echo form_submit('login_submit', ' Log me in ');

		echo "</div>";

		echo '<div class="col-md-4">';
		echo "</div>";

		echo "</div>";







		

		

		echo form_close();
	?>



	<div class ="forgo_sig">
	<a href="<?php echo base_url().'main/password_recovery'?>" class="for_sig"><small>Forgot password?</small></a>
	|
	<a href="<?php echo base_url().'main/signup'?>"class="for_sig"><strong>Click here to sign up</strong></a>
		
	</div> 










    

	





	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	</div>
</body>
</html>