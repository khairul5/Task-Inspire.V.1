<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_user');
	}	

	//index function executes by default when OMT loads
	//auto load url helper in auto load
	//configure base_url in config so that index.php may be removed from url
	//database note : 
	/*

CREATE TRIGGER `on_insert_update_project_list` AFTER INSERT ON `task_details`
 FOR EACH ROW UPDATE project_list SET project_progress = (SELECT COUNT(project_name) AS 'project_name' FROM task_details WHERE project_name = NEW.project_name AND status='finished')*100/(SELECT COUNT(project_name) AS 'project_name' FROM task_details WHERE project_name = NEW.project_name) WHERE id=NEW.project_name

CREATE TRIGGER `on_update_update_project_list` AFTER UPDATE ON `task_details`
 FOR EACH ROW UPDATE project_list SET project_progress = (SELECT COUNT(project_name) AS 'project_name' FROM task_details WHERE project_name = NEW.project_name AND status='finished')*100/(SELECT COUNT(project_name) AS 'project_name' FROM task_details WHERE project_name = NEW.project_name) WHERE id=NEW.project_name

 CREATE TRIGGER `on_update_update_project_list` AFTER UPDATE ON `task_details`
 FOR EACH ROW UPDATE project_list SET project_progress = (SELECT COUNT(project_name) AS 'project_name' FROM task_details WHERE project_name = NEW.project_name AND status='finished')*100/(SELECT COUNT(project_name) AS 'project_name' FROM task_details WHERE project_name = NEW.project_name) WHERE id=NEW.project_name

	*/
	public function index()
	{	
		if($this->session->is_logged_in==1)
		{
			redirect('main/projects');
		}
		else
		{
			//$this->load->view('Header');
			
			$this->load->view('Home');
		}
	}

	//function to load the sign-up page
	public function signup()
	{
		
		if($this->session->is_logged_in==1)
		{
			redirect('main/projects');
		}
		else
		{
			$data['message'] = "";
			$this->load->view('Header');	
			$this->load->view('Signup', $data);
		}
	}

	//function to load the log in page
	public function login()
	{
		if($this->session->is_logged_in==1)
		{
			redirect('main/projects');
		}
		else
		{
			$data['message'] = $this->session->flashdata('message');
			$this->load->view('Header');
			$this->load->view('Login', $data);
		}
	}
	
	//to validate signup process, to check the values given to sign up
	public function signup_validation()
	{
		//loading form validation library so that the function validation_errors() may work.
		$this->load->library('form_validation');

		//xss clean was generating problem, but it is necessary for security
		/*	$this->form_validation->set_rules('first_name', 'First Name', 'trim|required|min_length[5]|max_length[12]');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required|max_length[14]');
		//the rule is_unique has an issue with it. so, using own function instead.
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[12]');
		$this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|min_length[5]|max_length[12]|matches[password]');
		*/
		$config = array(

			array(
					'field' => 'first_name',
					'label' => 'First Name',
					'rules' => 'trim|required|min_length[3]|max_length[12]'
				),
			array(
					'field' => 'last_name',
					'label' => 'Last Name',
					'rules' => 'required|max_length[14]'
				),
			array(
					'field' => 'email',
					'label' => 'Email',
					'rules' => 'trim|required|valid_email'
				),
			array(
					'field' => 'password',
					'label' => 'Password',
					'rules' => 'trim|required|min_length[5]|max_length[16]'
				),
			array(
					'field' => 'cpassword',
					'label' => 'Confirm Password',
					'rules' => 'trim|required|min_length[5]|max_length[16]|matches[password]'
				)

			);

		$this->form_validation->set_rules($config);

		//check existing email
		//$this->load->model('model_user');
		$email = $this->input->post('email');
		$table_name = "user";
		$email_found_in_user = $this->model_user->email_exists($email, $table_name);
		$table_name = "temp_user";
		$email_found_in_temp = $this->model_user->email_exists($email, $table_name);

		if ($email_found_in_user|| $email_found_in_temp)
		{
			//redirect('main/signup');
			//$data['message'] = "This email is already registered to the system";
			$this->session->set_flashdata('message', 'This email is already registered to the system');

			$this->load->view('Header');
			$this->load->view('Signup');
		}
		
		elseif ($this->form_validation->run())
		{  
			//generate a random key,
			//bind it to the users credentials,
			//send to temp_table first, if successful, then
			//mail the key for confirmation.
			
			//a more secure key may be generated
			$key = md5(uniqid());

			//add to temp table now, load the model first(not necessary anymore, loading in construct?)
			//$this->load->model('model_user');

			if ($this->model_user->add_temp_user($key))
			{
				//now send email
				$this->load->library('email');
				//mail server must be configured in CodeIgniter
				$this->load->library('email');
				
				//sender already configured in Email helper?
				$this->email->from('taskinspire@dtmweb.co', 'DTM WEB');
				$this->email->to($this->input->post('email'));
				
				$this->email->subject('Confirm your TaskInspire account.');
				//change email library option send mail as html from text
				$message = "<p>Thank you for signing up.</p>";
				$message .= "<p><a href ='".base_url()."main/register_user/".$key."'>Click here</a> to confirm your account.</p>";
				$this->email->message($message);
				
				if ($this->email->send())
				{
					
				$this->session->set_flashdata('message', 'Please check your email for confirmation message.');
				redirect('main/login');
				}
				else
				{
					$this->session->set_flashdata('message', 'There was an error sending your confirmation mail. Please contact administrator.');
					redirect('main/signup');
				}
				//what does it do?
				echo $this->email->print_debugger();
			}
			else
			{
				$this->session->set_flashdata('message', 'Could not register user in database.');
				redirect('main/login');
			}
		}
		else
		{
			$this->session->set_flashdata('message', 'Please check your form again.');
			redirect('main/signup');
		} 

	}

	//register user
	public function register_user($key)
	{
		//user registration function here... from a temp table to user table
		//$this->load->model('model_user');
		$table_name = 'temp_user';
		if ($newmail = $this->model_user->is_key_valid($key, $table_name))
		{
			$user_email = $this->model_user->add_user($key);
			$array = $this->model_user->fetch_user_info($user_email);
			if ($user_email)
			{
				/*$data = array(
					'email' => $user_email,
					'name' => $array[0]['first_name'],
					'is_logged_in' => true,
					'is_admin' => false
					);
				//should session encryption be set in some config file?
				$this->session->set_userdata($data);*/
				
				$this->session->set_flashdata('message', 'Registration successful! Please login.');
				redirect('main/login');

			}
			else
			{
				$this->session->set_flashdata('message', 'Something went wrong while finishing your registration.');
				redirect('main/signup');
			}
		}
		else
		{
			$this->session->set_flashdata('message', 'Invalid key.');
			redirect('main/signup');
		}
	}

	//login
	public function login_validation()
	{
		$this->load->library('form_validation');
		//auto load session library in config

		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[12]');
	
		if($this->form_validation->run())
		{
			$this->load->model('model_user');
			//check user by email and password to log them in
			
			if ($this->model_user->can_log_in())
			{
				$email = $this->input->post('email');
				$array = $this->model_user->fetch_user_info($email);
				//check admin by email and set $is_admin flag
				if($this->model_user->admin_check())
				{
					//set session data with email, name, admin etc
					//redirect to admin homepage, check by $this->input->post('email')
					//echo "you are admin";
					$data = array(
						'email' => $this->input->post('email'),
						'name' => $array[0]['first_name'],
						'is_logged_in' => true,
						'is_admin' => true
						);
					//should session encryption be set in some config file?
					$this->session->set_userdata($data);

					redirect('main/projects');
				}
				else
				{
					//set session data with email, name, admin etc
					//redirect to normal user homepage, check by $this->input->post('email')
					//echo "you are logged in, but not admin";
					$array = $this->model_user->fetch_user_info($email);
					$data = array(
						'email' => $this->input->post('email'),
						'name' => $array[0]['first_name'],
						'is_logged_in' => true,
						'is_admin' => false
						);
					$this->session->set_userdata($data);
					redirect('main/projects');
				}
			}
			else
			{
			$data['message'] = "email-password do not match.";
			$this->load->view('Header');
			$this->load->view('Login', $data);				
			}
			

		}
		else
		{
			$data['message'] = "form validation failed";
			$this->load->view('Header');		
			$this->load->view('Login', $data);
		}
	}

	public function password_recovery()
	{
		$data['message'] = $this->session->flashdata('message');
		$this->load->view('Header');
		$this->load->view('Password_recovery', $data);
	}

	public function recover_password()
	{
		$this->load->library('form_validation');
		//auto load session library in config

		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		if($this->form_validation->run())
		{
			$email = $this->input->post('email');
			$table_name = "user";
			$email_found_in_user = $this->model_user->email_exists($email, $table_name);

			if($email_found_in_user)
			{
				//generate a random key,
				//bind it to the users credentials,
				//send to temp_table first, if successful, then
				//mail the key for confirmation.
				
				//a more secure key may be generated
				$key = md5(uniqid());

				//add to temp table now, load the model first(not necessary anymore, loading in construct?)
				//$this->load->model('model_user');

				if ($this->model_user->bind_key_to_email($key))
				{
					//now send email
					$this->load->library('email');
					//mail server must be configured in CodeIgniter
					$this->load->library('email');
					
					//sender already configured in Email helper?
					$this->email->from('taskinspire@dtmweb.co', 'DTM WEB');
					$this->email->to($this->input->post('email'));
					
					$this->email->subject('Change your TaskInspire password');
					//change email library option send mail as html from text
					$message = "<p>You requested to recover your password. If it was not you, simply discard this email.</p>";
					$message .= "<p><a href ='".base_url()."main/change_password/".$key."'>Click here</a> to change your password.</p>";
					$this->email->message($message);
					
					if ($this->email->send())
					{
						
					$this->session->set_flashdata('message', 'Please check your email for password recovery email.');
					redirect('main/login');
					}
					else
					{
						$this->session->set_flashdata('message', 'There was an error sending you password recovery email. Please contact administrator.');
						redirect('main/password_recovery');
					}
					//what does it do?
					echo $this->email->print_debugger();
				}
				else
				{
					$this->session->set_flashdata('message', 'An error occurred. Please try again.');
					redirect('main/password_recovery');
				}

			}
			else
			{
				$this->session->set_flashdata('message', 'You are not a registered user. Sign up!');
				redirect('main/signup');
			}
		}
		else
		{
			$this->session->set_flashdata('message', 'Not a valid email!');
			redirect('main/password_recovery');
		}
	}

	public function change_password($key)
	{
		$table_name = 'password';
		if($key_in_table = $this->model_user->is_key_valid($key, $table_name))
		{
			$email = $this->model_user->return_email_by_key($key);
			$data['email'] = $email[0]['email'];
			$data['message'] = $this->session->flashdata('message');
			$data['key'] = $key;
			$this->load->view('Header');
			$this->load->view('Change_password', $data);
		}
		else
		{
			$this->session->set_flashdata('message', 'Invalid key.');
			redirect('main/index');
		}
	}

	public function record_password()
	{
		if($password_changed = $this->model_user->record_password())
		{
			$this->session->set_flashdata('message', 'Password changed successfully. Log in.');
			redirect('main/login');
		}
		else
		{
			$this->session->set_flashdata('message', 'Could no change password.');
			redirect('main/password_recovery');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('main/login');
	}


	public function projects($sort_by='created_on')
	{
		if ($this->session->is_logged_in == 1)
		{
			/*if ($this->session->is_admin == 1)
			{
				//trigger in db table needed. check comment at the top
				$data['projects_administered'] = $this->model_user->show_projects_administered();
				$data['projects_assigned'] = $this->model_user->show_projects_assigned();
				$data['message'] = $this->session->flashdata('message');
				$this->load->view('Header');
				$this->load->view('Projects', $data);				
			}
			else
			{
				$data['projects_assigned'] = $this->model_user->show_projects_assigned();
				$data['message'] = $this->session->flashdata('message');
				$this->load->view('Header');
				$this->load->view('Projects', $data);				
			}*/
			$data['list_of_projects'] = $this->model_user->show_projects($sort_by);
			$data['message'] = $this->session->flashdata('message');
			$this->load->view('Header');
			$this->load->view('Projects', $data);
		}
		else
		{
			$this->session->set_flashdata('message', 'Please log in.');
			redirect('main/login');
		}

	}

	public function sort_projects()
	{
		if($_POST['action'] == "Title")
		{
			$action = "title";
			//$this->sort_by_type($action);
			redirect('main/projects/'.$action);
		}
		else if($_POST['action'] == "Admin")
		{
			$action = "admin";
			//$this->sort_by_type($action);
			redirect('main/projects/'.$action);
		}
		else if($_POST['action'] == "Created On")
		{
			$action = "created_on";
			//$this->sort_by_type($action);
			redirect('main/projects/'.$action);
		}
		else if($_POST['action'] == "Progress")
		{
			$action = "progress";
			//$this->sort_by_type($action);
			redirect('main/projects/'.$action);
		}
		else
		{
			return false;
		}

	}

	//project progress
	/*public function project_progress($project_id)
	{
		//check login, permission etc first
		$project_progress = $this->model_user->project_progress($project_id);
		return $project_progress;
	}	*/

	//returns all the tasks
	public function tasks($project_id, $status)
	{
		$data['tasks'] = $this->model_user->show_tasks($project_id);
		return $data;
	}

	//takes to a project's dedicated page
	public function project($project_id, $sort_by='deadline')
	{
		if ($this->session->is_logged_in == 1)
		{
			if($project_permission = $this->model_user->project_permission($project_id))
			{
				$data['user_list'] = $this->model_user->show_users();
				$temp = $this->model_user->get_project_name($project_id);
				$data['project_name'] = $temp[0]['project_name'];
				//$temp = $this->model_user->show_number_of_comments($project_id, $task_id);
				//$data['number_of_comments'] = $temp[0]['number_of_comments'];
				$data['project_id'] = $project_id;
				$data['tasks'] = $this->model_user->show_tasks($project_id, $sort_by);		
				$data['message'] = $this->session->flashdata('message');
				$this->load->view('Header');
				$this->load->view('Project', $data);				
			}
			else
			{
				$this->session->set_flashdata('message', 'You are not permitted to view this project.');
				redirect('main/projects');
			}
		}
		else
		{
			$this->session->set_flashdata('message', 'Log in to view this page.');
			redirect('main/login');
		}

	}

	//Takes to a task's individual page
	public function task()
	{
		if ($this->session->is_logged_in == 1)
		{
			//check project permission by email
			$task_id = $this->uri->segment(4,0);
			$project_id = $this->uri->segment(3, 0);
			if ($this->model_user->check_valid_project($project_id))
			{
				if($project_permission = $this->model_user->project_permission($project_id))
				{
					if ($this->model_user->check_valid_task($project_id, $task_id))
					{
						$data['task_id'] = $task_id;
						$data['project_id'] = $project_id;
						$temp = $this->model_user->get_project_name($project_id);
						$data['project_name'] = $temp[0]['project_name'];	
						$temp = $this->model_user->get_task_name($task_id);
						$data['task_name'] = $temp[0]['task_name'];				
						$data['comments'] = $this->model_user->show_comments($project_id, $task_id);
						$this->load->view('Header');
						$this->load->view('Task', $data);
					}
					else
					{
						echo "Invalid task id.";
					}				
				}
				else
				{
					$this->session->set_flashdata('message', 'You are not permitted to view this project.');
					redirect('main/projects');
				}					
			}
			else
			{
				echo "Invalid project id.";
			}
		}
		else
		{
			$this->session->set_flashdata('message', 'Session expired. Log in again.');
			redirect('main/login');			
		}
	}

	public function create_task()
	{
		if($this->session->is_admin == 1)
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('task_title', 'Project title', 'trim|required|min_length[5]|max_length[255]');

			if ($this->form_validation->run())
			{
				if($this->model_user->create_task())
				{
					
					$this->session->set_flashdata('message', 'Task created');
					$to = $this->input->post('assigned_to');
					$subject = "You have been assigned a task.";
					$message = "You have been assigned a new task.<br>Project: <b>".$this->input->post('project_name')."</b><br>Task: <b>".$this->input->post('task_title')."</b><br>Assigned by: <i>".$this->session->name."</i>";
					if ($this->send_notification($to, $subject, $message))
					{
						$this->session->set_flashdata('message', 'Task created. Assignee notified by mail.');
					}
					$project_id = $this->input->post('project_id');
					$link = "main/project/".$project_id;
					redirect($link);
				}
				else
				{
					$this->session->set_flashdata('message', 'Duplicate task name, maybe?');
					redirect('main/projects');
				}

			}
			else
			{
				$this->session->set_flashdata('message', 'Try another task name.');
				redirect('main/projects');
			}

		}
		else
		{
			$this->session->set_flashdata('message', 'You are not priviledged to create tasks.');
			redirect('main/projects');
		}
	}

	public function submit_task()
	{
		if ($this->session->is_logged_in == 1)
		{
			if ($this->model_user->submit_task())
			{
				$project_id = $this->input->post('project_id');
				$link = "main/project/".$project_id;
				redirect($link);
			}
			else
			{
				$project_id = $this->input->post('project_id');
				$link = "main/project/".$project_id;
				redirect($link);
			}			
		}
		else
		{
			echo "Oops, wrong landing page!";
		}

	}


	public function unsubmit_task()
	{
		if ($this->session->is_logged_in == 1)
		{
			if ($this->model_user->unsubmit_task())
			{
				$project_id = $this->input->post('project_id');
					$link = "main/project/".$project_id;
				redirect($link);
			}
			else
			{
				$project_id = $this->input->post('project_id');
				$link = "main/project/".$project_id;
				redirect($link);
			}			
		}
		else
		{
			echo "Oops, wrong landing page!";
		}

	}

		function action_by_type($action)
		{
			$data = $this->input->post('task_checkbox');
			$project_id = $this->input->post('project_id');
			$empty_form = 1;
			
			if($data)
			{
				foreach ($data as $key => $value)
				{				
					if(isset($data[$key]))
					{
						$task_id = $_POST['task_id'][$key];
						//$project_id = $_POST['project_id'];
						$action_performed = $this->model_user->task_action($action, $task_id, $project_id);

						if ($action_performed)
						{
							$this->session->set_flashdata('message', 'Action successful!');
							$to = $this->input->post('assigned_by');
							$subject = "TaskInspire: Task status changed.";
							$message = "The following task status has been changed.
							Project: <b>".$this->input->post('project_name')."</b><br>
							Task: <b>".$this->input->post('task_name')."</b><br>
							Status: <b>".$action."</b></br>
							<i>Status changed by: ".$this->session->name."</i>";


							if ($this->send_notification($to, $subject, $message))
							{
								$this->session->set_flashdata('message', 'Action successful! Admin notified by mail.');
							}
							//redirect('main/project/'.$project_id);
						}
						else
						{
							$this->session->set_flashdata('message', 'Could not perform the operation.');
							redirect('main/project/'.$project_id);

						}
					$empty_form = 0;	
					}
					else
					{
						continue;
					}
				}				
			}
			
			if($empty_form)
			{
				redirect('main/project/'.$project_id."/".$action);
			}
			else
			{
				redirect('main/project/'.$project_id);
			}
			
		}

	
	public function task_action()
	{

		if($_POST['action'] == "Delete")
		{
			$action = "delete";
			$this->action_by_type($action);
		}
		else if($_POST['action'] == "Done")
		{
			$action = "finished";
			$this->action_by_type($action);
		}
		else if($_POST['action'] == "Ongoing")
		{
			$action = "ongoing";
			$this->action_by_type($action);
		}
		else if($_POST['action'] == "Held")
		{
			$action = "held";
			$this->action_by_type($action);
		}
		else
		{
			return false;
		}
	}

	public function create_project()
	{
		//loading form validation library so that the function validation_errors() may work.
		
		if($this->session->is_admin == 1)
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('project_title', 'Project title', 'trim|required|min_length[5]|max_length[255]');

			if ($this->form_validation->run())
			{
				if($data = $this->model_user->create_project())
				{
					$project_name = $data['project_name'];
					//echo $project_name;
					//echo "project created. you should be redirected to projects own page.";
					$array = $this->model_user->return_id_by_name($project_name);
					$project_id =  $array[0]['id'];
					redirect('main/project/'.$project_id);
				}
				else
				{
					redirect('main/projects');
				}

			}
			else
			{
				$this->session->set_flashdata('message', 'Try changing your project name.');
				//echo "Form validation failed : try changing your project name.";
				redirect('main/projects');
			}

		}
		else
		{
			echo "You are not priviledged to create a project.";
		}
	}

	public function create_comment()
	{
		if ($this->session->is_logged_in)
		{
			//check task and project permission by email first
			$this->load->library('form_validation');
			$this->form_validation->set_rules('task_comment', 'Task Comment', 'trim|required|min_length[2]');

			if($this->form_validation->run())
			{
				if($this->model_user->create_comment())
				{
					$project_id = $this->input->post('project_id');
					$task_id = $this->input->post('task_id');
					$this->session->set_flashdata('message', 'Comment posted.');
					redirect('main/project/'.$project_id."/".$task_id);
				}
				else
				{
					echo "Could not post comment?";
				}
			}
			else
			{
				echo "Was that a comment?";
			}
		}
		else
		{
			$this->session->set_flashdata('message', 'Session expired. Log in again.');
			redirect('main/login');			
		}
	}

	public function delete_task()
	{
		$project_id = $this->uri->segment(3,0);
		$task_id = $this->uri->segment(4,0);
		$delete_successful = $this->model_user->delete_task($task_id);
		if ($delete_successful)
		{
			$this->session->set_flashdata('message', 'Task deleted.');
			redirect('main/project/'.$project_id);
			return true;
		}
		else
		{
			return false;
		}
	}

	public function delete_comment($project_id, $task_id, $comment_id)
	{

		$project_id = $this->uri->segment(3,0);
		$task_id = $this->uri->segment(4,0);
		$delete_successful = $this->model_user->delete_comment($comment_id);

		if($delete_successful)
		{
			$this->session->set_flashdata('message', 'Comment deleted.');
			redirect('main/project/'.$project_id.'/'.$task_id);
		}
		else
		{
			return false;
		}		
	}

	public function admin()
	{
		if ($this->session->is_logged_in == 1)
		{
			if($this->session->is_admin == 1)
			{
				$data['message'] = $this->session->flashdata('message');
				$data['user_list'] = $this->model_user->show_users();
				$this->load->view('Header');
				$this->load->view('Admin', $data);
			}
			else
			{
				$this->session->set_flashdata('message', 'You are not admin!');
				redirect('main/projects');
			}			
		}
		else
		{
			$this->session->set_flashdata('message', 'Login first.');
			redirect('main/login');
		}

	}

	public function grant_or_revoke_admin()
	{
		$user = $this->input->post('user');
		$action = $this->input->post('action');
		$admin_granted = $this->model_user->grant_or_revoke_admin($action, $user);
		if ($admin_granted)
		{
			$this->session->set_flashdata('message', 'Action successful!');
			redirect('main/admin');
		}
		else
		{
			$this->session->set_flashdata('message', 'Something went wrong.');
			redirect('main/admin');			
		}
	}

	public function send_notification($to, $subject, $message)
	{

		$this->load->library('email');
		//mail server must be configured in CodeIgniter
		$this->load->library('email');
		
		//sender already configured in Email helper?
		$this->email->from('taskinspire@dtmweb.co', 'DTM WEB');
		$this->email->to($to);
		
		$this->email->subject($subject);
		//change email library option send mail as html from text
		$this->email->message($message);
		
		if ($this->email->send())
		{
			return true;
		}
		else
		{
			return false;
		}
		//what does it do?
		echo $this->email->print_debugger();
	}

	public function profile()
	{
		if($this->session->is_logged_in==1)
		{
			$this->load->view('Header');
			$data['message'] = $this->session->flashdata('message');
			$this->load->view('Profile', $data);
		}
		else
		{
			//$this->load->view('Header');
			
			$this->load->view('Home');
		}		
	}

	public function new_password()
	{
		$this->load->library('form_validation');
		
		$config = array(


			array(
					'field' => 'old_password',
					'label' => 'Old Password',
					'rules' => 'trim|required|min_length[5]|max_length[16]'
				),
			array(
					'field' => 'new_password',
					'label' => 'New Password',
					'rules' => 'trim|required|min_length[5]|max_length[16]'
				),
			array(
					'field' => 'c_new_password',
					'label' => 'Confirm Password',
					'rules' => 'trim|required|min_length[5]|max_length[16]|matches[new_password]'
				)

			);

		$this->form_validation->set_rules($config);

		if ($this->form_validation->run())
		{
			$password = md5($this->input->post('old_password'));
			$email = $this->session->email;
			$password_match = $this->model_user->check_existing_password($email, $password);

			if($password_match)
			{
				$password_changed = $this->model_user->change_password();
				if($password_changed)
				{
					$this->session->set_flashdata('message', 'Password changed.');
					redirect('main/profile');
				}
			}
			else
			{
				$this->session->set_flashdata('message', 'Old password does not match.');
				redirect('main/profile');
			}
		}
		else
		{
			$this->session->set_flashdata('message', 'Form validation failed. Try again.');
			redirect('main/profile');
		}
	}

	public function remove_user()
	{
		$user_removed = $this->model_user->remove_user();
		if($user_removed)
		{
			$this->session->set_flashdata('message', 'User removed.');
			redirect('main/admin');
		}
		else
		{
			$this->session->set_flashdata('message', 'Failed to remove user.');
			redirect('main/admin');
		}
	}

}
