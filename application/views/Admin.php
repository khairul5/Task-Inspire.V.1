<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>


	<meta charset='utf-8'>
	<title>Project</title>
	
	<!--@Khairul Islam : Why two container divs?-->
	<div class="container">
	<div id="containter" >

	<!--	<a href=""><img src="<?php echo base_url(); ?>/files/images/logo.png"></a> -->

		<?php
			/*Make admin */

			
			$message = $this->session->flashdata('message');
			echo "<h3>".$message."</h3>";
			echo form_open('main/grant_or_revoke_admin');
			echo validation_errors();
			echo '<div class="row">';
				echo '<div class="col-md-4" align="right">';
				echo "<p class='permission'>Select user: ";
				echo "</p>";

				echo "<select name='action' hidden>";
				echo "<option value=1 selected></option>";
				echo "</select>";

				echo '</div>';
				echo '<div class="col-md-4">';
					
					echo "<select name='user'>";
					foreach ($user_list as $row)
					{
						echo "<option value='".$row['email']."'>".$row['first_name']." ".$row['last_name']."</option>";
					}
					echo "</select>";
					

				echo "</div>";
				
				echo '<div class="col-md-4">';
					echo form_submit('admin_submit', ' Make admin! ');
				echo '</div>';			
			echo '</div>';


			echo form_close();



			/*Revoke admin */

			
			echo form_open('main/grant_or_revoke_admin');
			echo validation_errors();
			echo '<div class="row">';
			
				echo '<div class="col-md-4" align="right">';
				echo "<p class='permission'>Select user: ";
				echo "</p>";
				echo "<select name='action' hidden>";
				echo "<option value=0 selected></option>";
				echo "</select>";
				echo '</div>';
				echo '<div class="col-md-4">';
					
					echo "<select name='user'>";
					foreach ($user_list as $row)
					{
						echo "<option value='".$row['email']."'>".$row['first_name']." ".$row['last_name']."</option>";
					}
					echo "</select>";
					

				echo "</div>";
				
				echo '<div class="col-md-4">';
					echo form_submit('admin_submit', ' Revoke admin ');
				echo '</div>';			
			echo '</div>';


			echo form_close();

			/*Remove admin */

			
			echo form_open('main/remove_user');
			echo validation_errors();
			echo '<div class="row">';
				echo '<div class="col-md-4" align="right">';
				echo "<p class='permission'>Select user: ";
				echo "</p>";
				echo "<select name='action' hidden>";
				echo "<option value='delete' selected></option>";
				echo "</select>";
				echo '</div>';
				echo '<div class="col-md-4">';
					
					echo "<select name='user'>";
					foreach ($user_list as $row)
					{
						echo "<option value='".$row['email']."'>".$row['first_name']." ".$row['last_name']."</option>";
					}
					echo "</select>";
					

				echo "</div>";
				
				echo '<div class="col-md-4">';
					echo form_submit('admin_submit', ' Remove user ');
				echo '</div>';			
			echo '</div>';


			echo form_close();




		?>
	</div>
	</div>
</body>
</html>