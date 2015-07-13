
	<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	?>
	<meta charset='utf-8'>
	<title>Project</title>




<div class="container">
    <div class="row">
	<!--	<a href=""><img src="<?php echo base_url(); ?>/files/images/logo.png"></a> -->

		<?php
			if ($this->session->is_admin == 1)
			{
				echo "<div id="."'create_task'".">";
					echo "<h2>".$project_name."</h2>";
					//echo "<h1>Create a new task.</h1>";
					echo "<h3>".$message."</h3>";
					echo form_open('main/create_task');
					echo validation_errors();
					
					echo "<select name='project_id' hidden>";
					echo "<option value=".$project_id." selected></option>";
					echo "</select>";

					echo "<select name='project_name' hidden>";
					echo "<option value='".$project_name."' selected></option>";
					echo "</select>";

					echo '<div class="row">';

					echo '<div class="col-md-3">';
					echo "</div>";

					/* task name: */

					echo '<div class="col-md-6">';
					echo "<p>  ";
					$data = array(
							'name' => 'task_title',
							'placeholder' => 'New task title...'
						);
					echo form_input($data);
					echo "</p>";
					echo "</div>";

					echo '<div class="col-md-3">';
					echo "</div>";

					echo '</div>';



					echo '<div class="row">';

					echo '<div class="col-md-3">';
					echo "</div>";

					/* Dead line */

					/*echo "<p>Deadline: ";
					echo "<input type='date' name='deadline'>";
					echo "</p>"; */

					echo '<div class="col-md-3  id="to-do" id="example" padding_left" >';
					echo "<p>Deadline: ";
                    echo '<input id="datetimepicker" type="text" name="deadline"/>';
                    echo "</p>";

					echo "</div>";

					/*Assign to */

					echo '<div class="col-md-3 padding_right">';
					echo "<p>Assign to: ";
					echo "<select  name='assigned_to'>";
					foreach ($user_list as $row)
					{
						echo "<option value='".$row['email']."'>".$row['first_name']." ".$row['last_name']."</option>";
					}
					echo "</select>";
					echo "</p>";

					echo "</div>";

					echo '<div class="col-md-3">';
					echo "</div>";


					echo '</div>';


					echo '<div class="row">';

					echo '<div class="col-md-3">';
					echo "</div>";

					echo '<div class="col-md-6">';

					echo form_submit('task_submit', ' Create Task! ');

					echo '</div>';
					echo '<div class="col-md-3">';
					echo "</div>";

					echo "</div>";

					echo form_close();
					echo "</div>";

			}

			?>

			

<?php


			if ($tasks)
			{	
				echo "<h3><a href='".base_url('main/project/'.$project_id."/deadline")."'>List of tasks</a></h3>";

				echo form_open('main/task_action');

				echo '<div class="row">';

				echo '<div class="col-xs-12 col-sm-2 padding_right">';
					echo "<input type='submit' class='green' name = 'action' value='Done' />";
				echo "</div>";

				echo '<div class="col-xs-12 col-sm-2 padding_right">';
					echo "<input type='submit' class='yellow' name = 'action' value='Ongoing' />";
				echo "</div>";

				echo '<div class="col-xs-12 col-sm-2 padding_right">';
					echo "<input type='submit' class='orange' name = 'action' value='Held' />";
				echo "</div>";

				echo '<div class="col-xs-12 col-sm-6 padding_right">';
				echo "<input type='submit' class='red' name = 'action' value='Delete' />";
				echo "</div>";

				echo "</div>";

				$number_of_tasks = count($tasks);
				foreach ($tasks as $key => $row)
					{
   
				   echo '<div class="row my_featureRow">';

				   
				        echo '<div class="col-xs-12 col-sm-6 my_feature">';


						        /*check Box*/

								
								echo '<div class="checkbox checkbox_margin">';
						        echo "#".$number_of_tasks." ";
						        $number_of_tasks--;

					           	echo "<label>";
									echo "<input type='checkbox' name='task_checkbox[".$key."]' class='checkbox' value='".$row['id']."' ><span class='checkbox-material'><span class='check'></span></span>";
						        echo "</label>";
					        
						        
								//echo "<input type='checkbox' name='task_checkbox[".$key."]' class='checkbox' value='".$row['id']."' >";
								echo "<select name='project_id' hidden>";
								echo "<option value=".$project_id." selected></option>";
								echo "</select>";

								echo "<select name = 'task_id[".$key."]' hidden>";
								echo "<option value=".$row['id']." selected></option>";
								echo "</select>";						

								echo "<select name = 'assigned_by' hidden>";
								echo "<option value=".$row['assigned_by']." selected></option>";
								echo "</select>";

								echo "<select name='project_name' hidden>";
								echo "<option value='".$project_name."' selected></option>";
								echo "</select>";							

								echo "<select name='task_name' hidden>";
								echo "<option value='".$row['task_name']."' selected></option>";
								echo "</select>";

								echo "<select name='assigned_by' hidden>";
								echo "<option value=".$row['assigned_by']." selected></option>";
								echo "</select>";								

								/* Task Name */

								echo "<a class='task_name' href='".base_url()."main/project/".$project_id."/".$row['id']."'>".$row['task_name']."</a>";
						
				   				echo "</div>";
				        echo '</div>';

				        		/* Number of comments */
			        		    echo '<div class="col-xs-12 col-sm-1">';


			        		    if($row['number_of_comments'] != 0)
			        		    {	        		    	
				        		    echo '<i class="fa fa-comments-o padding_right"></i>';
							        echo "<i class='num_color'> ".$row['number_of_comments']."</i>";
							        //echo "<i>".$row['number_of_comments']." comments</i>";
			        		    }
						        echo '</div>';

								/* Status Color */
						        //echo $row['status'];
						        $status = $row['status'];
						        if ($status == 'finished')
						        {
						        	//show green mark
							        echo '<div class="col-xs-12 col-sm-1 finished ">';
							        echo "Done";
							        echo '</div>';
						        }
						        else if($status == 'unfinished')
						        {
						        	//show normal background
							        echo '<div class="col-xs-12 col-sm-1  unfinished">';
							        //echo $row['status'];
							        echo '</div>';						        	
						        }
						        else if ($status == 'ongoing')
						        {
						        	//show ongoing mark
							        echo '<div class="col-xs-12 col-sm-1 ongoing ">';
							        echo "Ongoing";
							        echo '</div>';						        	
						        }
						        else if ($status == 'held')
						        {
						        	//show held mark
							        echo '<div class="col-xs-12 col-sm-1 held ">';
							        echo "Held";
							        echo '</div>';						        	
						        }				        
				            
		       
				        echo '<div class="col-xs-12 col-sm-2  my_planFeature my_plan1">';
				            echo '<i class="fa fa-user user_icon"></i>';
				            echo "<a class ='icon_txt'>".$row['assigned_to'].'</a>';
				        echo '</div>';

				        echo '<div class="col-xs-12 col-sm-2  my_planFeature my_plan2">';
				            echo '<i class="fa fa-calendar"></i>';
				            //$date = new DateTime($row['deadline']);
				            //echo "<a class ='icon_txt'>".$date->format('d M').'</a>';
       						echo "<a class ='icon_txt'>".$row['deadline'].'<a>';
				        echo '</div>';
				       
				    
				   echo '</div>';
					}
				echo form_close();	
				

			}
			else
			{
				echo "<p align='center'>No tasks yet. Create one from above.</p>";
			}

		?>

		
	</div>
</div>



	<script>
            $(document).ready(function () {
                // create DateTimePicker from input HTML element
                $("#datetimepicker").kendoDateTimePicker({
                    value:new Date()
                });
            });
        </script>	


					
</body>
</html>