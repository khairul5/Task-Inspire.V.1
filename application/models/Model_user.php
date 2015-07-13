<?php
defined('BASEPATH') OR exit('No direct script allowed.');

class Model_user extends CI_Model
{
	
	public function __construct()
    {
      parent::__construct();
      $this->load->database();
    }
	public function add_temp_user($key)
	{
		//$this->load->database();
		$data = array(
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),			
			'email' => $this->input->post('email'),
			'password' => md5($this->input->post('password')),
			'key' => $key
		 );

		//insert into temp_user table, database should be loaded
		$query = $this->db->insert('temp_user', $data);

		if ($query)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function email_exists($email, $table_name)
	{
		$myquery = "SELECT email FROM ".$table_name." WHERE email = '".$email."'";
		$result = $this->db->query($myquery);
		/*foreach ($result->result_array() as $row)
		{
			echo $row['email'];
		}*/
		if ($result->num_rows()>0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function is_key_valid($key, $table_name)
	{
		$this->db->where('key', $key);
		$query = $this->db->get($table_name);

		if ($query->num_rows() == 1)
		{
			return true;
			//return email?
		}
		else
		{
			return false;
		}
	}

	public function add_user($key)
	{
		$this->db->where('key', $key);
		//get row of user data by key
		$temp_user_data = $this->db->get('temp_user');

		//if data successfully taken into variable, then record into user table
		if($temp_user_data)
		{
			$row = $temp_user_data->row();
			$data = array(
				'first_name' => $row->first_name,
				'last_name' => $row->last_name,
				'email' => $row->email,
				'password' => $row->password
				);

			//add user, check through a variable
			$user_added = $this->db->insert('user', $data);

			//if user added successfully, delete temp_user entry
			if($user_added)
			{
				$this->db->where('key', $key);
				$this->db->delete('temp_user');
				return $data['email'];
			}
			else
			{
				return false;
			}
		}

	}

	public function can_log_in()
	{
		$this->db->where('email', $this->input->post('email'));
		$this->db->where('password', md5($this->input->post('password')));
		$query = $this->db->get('user');

		if ($query->num_rows() == 1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function admin_check()
	{
		$this->db->where('email', $this->input->post('email'));
		$this->db->where('admin', 1);
		$query = $this->db->get('user');

		if($query->num_rows() == 1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	//this function only shows "projects that you administer"
	public function show_projects_administered()
	{
		$this->db->where('created_by', $this->session->email);
		$query = $this->db->get('project_list');
		/*$query = $this->db->query("
			SELECT DISTINCT s.project_name, s.assigned_to, user.first_name as first_name, user.last_name,
			project_list.id, project_list.project_name, project_list.created_on, project_list.project_progress
			FROM task_details f 
			INNER JOIN task_details s 
			INNER JOIN project_list ON project_list.id = s.project_name
			INNER JOIN user ON s.assigned_to = user.email
			WHERE f.assigned_by ='".$this->session->email."' ORDER BY s.project_name;");
		*/	
		if ($query)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}

	//this function only shows "projects that you are assigned to"
	public function show_projects_assigned()
	{
		//will this query grow expensive over time as the table task_details grow in number of rows?
		$query = $this->db->query("select distinct project_list.id, project_list.project_name, 
			project_list.created_on, project_list.project_progress FROM project_list, task_details 
			WHERE assigned_to='".$this->session->email."' AND task_details.project_name=project_list.id;");
		 //$this->db->where('assigned_to', $this->session->email);
		//$query = $this->db->get('task_details');
		/*$query = $this->db->query("
			SELECT DISTINCT s.project_name, s.assigned_to, user.first_name as first_name, user.last_name,
			project_list.id, project_list.project_name, project_list.created_on, project_list.project_progress
			FROM task_details f 
			INNER JOIN task_details s 
			INNER JOIN project_list ON project_list.id = s.project_name
			INNER JOIN user ON s.assigned_to = user.email
			WHERE f.assigned_to ='".$this->session->email."' ORDER BY s.project_name;");
		*/if ($query)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}

	public function show_projects($sort_by)
	{
		$query = $this->db->query("select distinct project_list.id, project_list.project_name as title, 
			DATE_FORMAT(project_list.created_on, '%M %d, %Y') as created_on, project_list.created_by as created_by, user.first_name as admin,
			 project_list.project_progress as progress FROM project_list left outer join task_details on  task_details.project_name=project_list.id
            inner join user on created_by = user.email
			WHERE (assigned_to='".$this->session->email."') OR (project_list.created_by = '".$this->session->email."')
			ORDER BY ".$sort_by." DESC");		

		if ($query)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}

	public function show_tasks($project_id, $sort_by)
	{
		//$this->db->where('project_name', $project_id);
		//$this->db->where('status', $status);
		//$query = $this->db->get('task_details');
		$query_string = "SELECT (SELECT COUNT(project) FROM task_comments WHERE project=".$project_id." AND task=task_details.id) as number_of_comments,
									task_details.id, task_details.task_name, user.first_name as assigned_to,
									DATE_FORMAT(task_details.deadline, '%M %d') as deadline, task_details.assigned_by as assigned_by, task_details.assigned_on as assigned_on,
									task_details.status as status, task_details.completed_on, task_details.assigned_to as assigned_to_email
									FROM task_details INNER JOIN user
									ON task_details.assigned_to = user.email
									WHERE task_details.project_name=".$project_id;
		if($sort_by=='deadline')
		{
			$query_string .= " ORDER BY deadline DESC";
		}											
		else
		{
			$query_string .= " ORDER BY FIELD(status, '".$sort_by."') DESC, status, assigned_on";
		}				
		$query = $this->db->query($query_string);
		if ($query)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}

	public function create_project()
	{
		$data = array(
			'project_name' => $this->input->post('project_title'),
			'created_by' => $this->session->email
			);
		$project_created = $this->db->insert('project_list', $data);

		if($project_created)
		{
			return $data;
		}
		else
		{
			return false;
		}
	}

	public function create_task()
	{

		//try not to use CI query builder
		$query = $this->db->query("INSERT INTO task_details (project_name, task_name, assigned_by, assigned_to, deadline)
		 VALUES (".$this->input->post('project_id').", '".$this->input->post('task_title')."',
		  '".$this->session->email."', '".$this->input->post('assigned_to')."',
		   STR_TO_DATE('".$this->input->post('deadline')."', '%m/%d/%Y %h:%i %p'));");
	
		if($query)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}

	public function submit_task()
	{
		$task_id = $this->input->post('task_id');
		$query = $this->db->query('UPDATE task_details SET completed_on=NOW(), status="finished" WHERE id = '.$task_id);
		if ($query)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function unsubmit_task()
	{
		$task_id = $this->input->post('task_id');
		$query = $this->db->query('UPDATE task_details SET status=0 WHERE id = '.$task_id);
		if ($query)
		{
			return true;
		}
		else
		{
			return false;
		}
	}	

	public function show_users()
	{
		$query = $this->db->query('SELECT first_name, last_name, email FROM user');
		if ($query)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}

	public function check_valid_project($project_id)
	{
		$query = $this->db->query("SELECT id FROM project_list WHERE id=".$project_id);
		$new = $query->result_array();
		if ($new)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function check_valid_task($project_id, $task_id)
	{
		$query = $this->db->query("SELECT id FROM task_details WHERE id=".$task_id." AND project_name=".$project_id);
		$new = $query->result_array();
		if ($new)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function create_comment()
	{
		$data = array(
			'project' => $this->input->post('project_id'),
			'task' => $this->input->post('task_id'),
			'comment' => $this->input->post('task_comment'),
			'comment_by' => $this->session->email,
			);

		$comment_posted = $this->db->insert('task_comments', $data);

		if ($comment_posted)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function show_comments($project_id, $task_id)
	{
		//$this->db->where('project', $project_id);
		//$this->db->where('task', $task_id);
		//$query = $this->db->get('task_comments');
		$query = $this->db->query("SELECT task_comments.id, task_comments.project, task_comments.task, task_comments.comment,
			task_comments.comment_by, DATE_FORMAT(task_comments.comment_time, '%M %d at %r') as comment_time, user.first_name as comment_by	
			FROM task_comments INNER JOIN user ON task_comments.comment_by = user.email
			WHERE project =".$project_id." AND task =".$task_id." ORDER BY task_comments.comment_time DESC");

		if ($query)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}
	public function show_number_of_commments($project_id, $task_id)
	{
		$query = $this->db->query("SELECT COUNT(project) as number_of_comments FROM task_comments WHERE project=".$project_id." AND task=".$task_id);
		if($query)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}

	/*
	public function project_progress($project_id)
	{
		$query1 = $this->db->query("SELECT COUNT(project_name) AS 'project_name' FROM task_details WHERE project_name = ".$project_id);
		$query2 = $this->db->query("SELECT COUNT(project_name) AS 'project_name' FROM task_details WHERE status = 1 AND project_name = ".$project_id);
		$total_task = $query1->row();
		$completed_task = $query2->row();
		$project_progress = ($completed_task['project_name']/$total_task['project_name'])*100;
		return $project_progress;
	}*/

	public function return_id_by_name($project_name)
	{
		$this->db->where('project_name', $project_name);
		$query = $this->db->get('project_list');
		if ($query->num_rows() == 1)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}

	public function fetch_user_info($email)
	{
		$this->db->where('email', $email);
		$query = $this->db->get('user');

		if ($query->num_rows()==1)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}

	public function get_project_name($project_id)
	{
		$this->db->select('project_name');
		$this->db->where('id', $project_id);
		$query = $this->db->get('project_list');

		if($query->num_rows()==1)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}

	public function delete_task($task_id)
	{
		$query = $this->db->query("DELETE FROM task_details WHERE id=".$task_id);
		if ($query)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function delete_comment($comment_id)
	{
		$query = $this->db->query("DELETE FROM task_comments WHERE id=".$comment_id);
		if ($query)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}

	public function get_task_name($task_id)
	{
		$this->db->select('task_name');
		$this->db->where('id', $task_id);
		$query = $this->db->get('task_details');

		if ($query)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}

	public function grant_or_revoke_admin($action, $user)
	{
		$query = $this->db->query("UPDATE user SET admin=".$action." WHERE email='".$user."'");
		if ($query)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function bind_key_to_email($key)
	{
		//$this->load->database();
		$data = array(
			'email' => $this->input->post('email'),
			'key' => $key
		 );

		//insert into password table, database should be loaded
		$query = $this->db->insert('password', $data);

		if ($query)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}

	public function return_email_by_key($key)
	{
		$this->db->select('email');
		$this->db->where('key', $key);
		$query = $this->db->get('password');

		if($query->num_rows() == 1)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}

	public function record_password()

	{
		$email = $this->input->post('email');
		$password = md5($this->input->post('password'));
		$key = $this->input->post('key');
		$query = $this->db->query("UPDATE user SET password ='".$password."' WHERE email = '".$email."'");

		if($query)
		{
			$this->db->where('key', $key);
			$this->db->delete('password');		
			return true;
		}
		else
		{
			return false;
		}
	}

	public function task_action($action, $task_id, $project_id)
	{
		if ($action == 'delete')
		{
			$query = $this->db->query("DELETE from task_details WHERE id = ".$task_id);
			if($query)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			$status = $action;
			$query = $this->db->query("UPDATE task_details SET status = '".$status."', completed_on=NOW() WHERE id = ".$task_id);
			if($query)
			{
				return true;
			}
			else
			{
				return false;
			}			
		}
	}

	public function check_existing_password($email, $password)
	{
		//$this->db->select('password');
		$this->db->where('password', $password);
		$this->db->where('email', $email);
		$query = $this->db->get('user');

		if($query->num_rows()==1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function change_password()
	{
		$email = $this->session->email;
		$password = md5($this->input->post('new_password'));
		$query = $this->db->query("UPDATE user SET password ='".$password."' WHERE email = '".$email."'");

		if($query)
		{	
			return true;
		}
		else
		{
			return false;
		}		
	}

	public function remove_user()
	{
		$this->db->where('email', $this->input->post('user'));
		if($this->db->delete('user'))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function project_permission($project_id)
	{
		$email = $this->session->email;
		$project_admin = $this->db->query("SELECT * FROM project_list WHERE id=".$project_id." AND created_by='".$email."'");
		$project_worker = $this->db->query("SELECT * FROM task_details WHERE project_name=".$project_id." AND assigned_to='".$email."'");
		if($project_admin->num_rows()!=0)
		{
			return true;
		}
		elseif($project_worker->num_rows()!=0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

}

?>