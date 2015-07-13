<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>


	<meta charset='utf-8'>
	<title>Projects</title>

	<div class="container" id="containter" >

		<!-- <a href=""><img src="<?php echo base_url(); ?>/files/images/logo.png"></a> -->
		<?php
			echo "<div id="."'create_comment'".">";
				echo "<h2><a class='projects' href='".base_url()."main/project/".$project_id."'>".$project_name."</a></h2>";
				echo "<h3>".$task_name."</h3></br>";
				//echo "<input type='submit' name='delete' value='delete' />";
				//echo anchor('main/delete_task/'.$project_id.'/'.$task_id, '(DELETE THIS TASK)');
				//echo "<h3>".$message."</h3>";
				echo form_open('main/create_comment');
				echo validation_errors();
				
				echo "<select name='project_id' hidden>";
				echo "<option value=".$project_id." selected></option>";
				echo "</select>";

				echo "<select name='task_id' hidden>";
				echo "<option value=".$task_id." selected></option>";
				echo "</select>";



				echo '<div class="row">';

					echo '<div class="col-md-3">';
					echo "</div>";

					/* Comment */

					echo '<div class="col-md-6">';


				
					echo "<textarea class='textaria_com' rows='3' cols='50' name='task_comment'>";
					echo "</textarea> ";

						echo '<div class="col-md-6">';

						echo '<span class="com_name">'."<strong>Comment as: </strong>".$this->session->name.'</span>';

						echo "</div>";


						echo '<div class="col-md-6 ">';

						echo '<span class="com_submit">'.form_submit('task_submit', ' Comment ').'</span>';

						echo "</div>";


				echo "</div>";

					echo '<div class="col-md-3">';
					echo "</div>";

					echo '</div>';


				echo form_close();
			echo "</div>";

			echo "<h3>Comments</h3>";

			//load the below block of code only when there are comments
			if ($comments)
			{
				echo "<div id='display_comments'>";
					

				foreach ($comments as $row) 
				{

				echo '<div class="row ">';

					echo '<div class="col-md-3">';
					echo "</div>";

					echo '<div class="col-md-6 my_featureRow">';
							echo '<div class="col-xs-12 col-sm-2 ">';
								echo '<i class="fa fa-user user_icon_comment padding_right"></i>';
							echo "</div>";

							echo '<div class="col-xs-12 col-sm-10  my_planFeature my_plan1">';

								echo $row['comment_by']; 

								echo '</br>';

								echo '<div class ="comment_div">';
									echo '<i class="fa fa-clock-o user_icon"></i>';
									echo "<a class ='comment_icon_txt'>".$row['comment_time'].'</a>';
									echo "<a href='".base_url()."main/delete_comment/".$project_id.'/'.$task_id.'/'.$row['id']."'><i class='fa fa-trash-o user_icon'></i></a>";
									echo "<hr>";
								echo "</div>";

								
								echo "<a class ='user_comment'>".$row['comment'].'</a>';
							echo "</div>";
					echo "</div>";

					echo '<div class="col-md-3">';
					echo "</div>";
				echo "</div>";
				}



				echo "</div>";			
			}
			else
			{
			
				echo '<div class="row ">';

					echo '<div class="col-md-3">';
					echo "</div>";

					echo '<div class="col-md-6 my_featureRow">';
							echo '<div class="col-xs-12 col-sm-2 ">';
								echo '<i class="fa fa-user user_icon_comment padding_right"></i>';
							echo "</div>";

							echo '<div class="col-xs-12 col-sm-10  my_planFeature my_plan1">';

								echo '<p class="padding_bottom">User Name</p>'; 

								

								echo '<div class ="comment_div">';
									echo '<i class="fa fa-clock-o user_icon"></i>';
									echo "<a class ='comment_icon_txt'>"."Sat, Jul 4th".'</a>';
									echo "<a ><i class='fa fa-trash-o user_icon'></i></a>";
									echo "<hr>";
								echo "</div>";

								
								echo '<p>Sample comment</p>';
							echo "</div>";
					echo "</div>";

					echo '<div class="col-md-3">';
					echo "</div>";
				echo "</div>";
			}
		?>
	</div>




	 

        <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

       <script src="<?php echo base_url('material'); ?>/dist/css/ripples.min.js" ></script>

       <script src="<?php echo base_url('material'); ?>/dist/css/material.min.js" ></script>


        <script>
            $(document).ready(function() {
                
                $.material.init();
            });
        </script>



        


</body>
</html>