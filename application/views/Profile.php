<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>


	<meta charset='utf-8'>
	<title>TaskInspire-Settings</title>

	<div class="container" id="containter" align="center">        
	<h2>Change Password</h2>

		<?php
		echo "<h3>";
		echo $message;
		echo "</h3>";
		echo form_open('main/new_password');

		echo '<div class="row">';

		echo '<div class="col-md-4">';
		echo "</div>";

		echo '<div class="col-md-4">';

		echo "<p class='input_button'>";

		$data = array(
				'name' => 'old_password',
				'placeholder' => 'Provide your current password',
				'class' => 'input-text',
				'type' => 'password'
			);

		echo form_input($data);
		echo "</p>";

		echo "<p class='input_button'>";

		$data = array(
				'name' => 'new_password',
				'placeholder' => 'Type your new password',
				'class' => 'input-text',
				'type' => 'password'
			);

		echo form_input($data);
		echo "</p>";

		echo "<p class='input_button'>";

		$data = array(
				'name' => 'c_new_password',
				'placeholder' => 'Retype your new password',
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

		echo form_submit('recovery_submit', ' submit ');

		echo "</div>";

		echo '<div class="col-md-4">';
		echo "</div>";

		echo "</div>";


		echo form_close();
	?>


</body>
</html>