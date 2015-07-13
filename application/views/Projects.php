<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>


	<meta charset='utf-8'>
	<title>Projects</title>

	<div class="container">

	<div class = "container" id="containter" >

		<!-- <a href=""><img src="../files/images/logo.png"></a> -->

		<?php
		//why the same block of code copied three times to display list of projects?
		//$welcome = "<br>Hi, ".$this->session->name."!";
		/*if ($this->session->is_admin == 1)
		{
		echo $welcome." You are admin. Perform admin actions <a href='".base_url()."main/admin'>here.</a>";			
		}
		else
		{
			echo $welcome;
		}*/
		//echo $welcome;


		echo $message;
		function show_projects($projects)
		{  
			echo form_open('main/sort_projects');

				echo "<div id='projects'>";
					//echo "<h2>".$heading."</h2>";
					echo '<div class="row  ">';
						
						echo "<h3>List of projects</h3>";
						echo "<br>";
						echo '<div class="col-xs-12 col-sm-6 padding_right">';
							echo "<input type='submit' class='green' name = 'action' value='Title' />";
						echo "</div>";

						echo '<div class="col-xs-12 col-sm-2 padding_right">';
							echo "<input type='submit' class='yellow' name = 'action' value='Admin' />";
						echo "</div>";

						echo '<div class="col-xs-12 col-sm-2 padding_right">';
							echo "<input type='submit' class='orange' name = 'action' value='Created On' />";
						echo "</div>";

						echo '<div class="col-xs-12 col-sm-2 padding_right">';
							echo "<input type='submit' class='red' name = 'action' value='Progress' />";
						echo "</div>";

					echo "</div>";

					$number_of_projects = count($projects);
					foreach ($projects as $row)
							{
							$project_id = $row['id'];

					echo '<div class="row my_featureRow">';
						echo '<div class="col-md-col-xs-12 col-sm-6 my_feature">';
						    echo "# ".$number_of_projects."  ";
						    $number_of_projects--;
						    echo '<i class="fa fa-circle"></i>  ';
							echo "<a class='project' href='".base_url()."main/project/".$project_id."'>".$row['title']."</a>";
						echo "</div>";
						echo '<div class="col-xs-12 col-sm-2  my_planFeature my_plan1">';
							echo '<i class="fa fa-user user_icon"></i>';
							
							echo "<a class ='icon_txt'>".$row['admin'].'</a>';
						echo "</div>";
						echo '<div class="col-xs-12 col-sm-2  my_planFeature my_plan2">';
							echo '<i class="fa fa-calendar"></i>';
							//$date = new DateTime($row['created_on']);
							//echo "<a class ='icon_txt'>".$date->format('d M').'</a>';
							echo "<a class ='icon_txt'>".$row['created_on']."</a>";
						echo "</div>";
						echo '<div class="col-xs-12 col-sm-2  my_planFeature my_plan2">';
							
							echo '<div class="bs-component">';
				                echo '<div class="progress bottom_margin">';
				                    echo '<a class="progress-bar" style="width: '.$row['progress'].'%">';
				                    echo '</a>';
				                echo '</div>';
			            	echo '</div>';
						echo "</div>";
				echo "</div>";	

			echo form_close();
		}


		}		

		if ($this->session->is_admin == 1)
		{	

			echo '<div class="row">';
				echo '<div class="col-md-3">';
				echo "</div>";

				echo '<div class="col-md-6">';
			
					echo "<div id="."'create_project'".">";

						echo "<h2>Create a new project</h2>";
						echo form_open('main/create_project');
						echo validation_errors();
						
						echo '<div class="col-md-8">';

							$data = array(
								'name' => 'project_title',
								'placeholder' => 'Give your project a title...'
								);
							echo form_input($data);

						
						echo "</div>";

						echo '<div class="col-md-4">';
							echo form_submit('project_submit', ' Create Project! ');
						echo "</div>";

						echo form_close();
					echo "</div>";
				echo "</div>";

				echo '<div class="col-md-3">';
				echo "</div>";


			echo "</div>";


			//display list of projets that the user administers, by calling show_projects function

			//displays a list of projects that the user is assigned to, by calling show_projects function
			if ($list_of_projects)
			{
				$projects = $list_of_projects;
				show_projects($projects);										
			}
			else
			{
				echo "<p align='center'>";
				echo "<h3>Create a project... <br>Start assigning tasks...<br>Start a conversation and more...</h3>";
				echo "</p>";
			}

		}

		else
		{
			if ($list_of_projects)
			{
				$projects = $list_of_projects;
				show_projects($projects);										
			}
			else
			{
				echo "<p align='center'>";
				echo "<h3>Task Inspire is a great place to get things organized.<br>Wait for an admin to assign you tasks...</h3>";
				echo "</p>";				
			}
		}


		?>

	</div>
	</div>
</body>
</html>