<?php

class CUsers extends CI_Controller 
{

	function __construct() 
	{
		parent::__construct();
		$this->load->model('MUsers', 'modelo');
	}

	public function index() 
	{
		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('users/index');
	}

	public function datatable()
	{
		$start = $this->input->post('start');
		$length = $this->input->post('length');
		$search = $this->input->post('search')['value'];
		$by = $this->input->post('order')['0']['column'];
		$order = $this->input->post('order')['0']['dir'];

		$result = $this->modelo->getUsers($start, $length, $search, $order, $by);

		$json_data = array(
			"draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($result['numDataTotal']),
            "recordsFiltered" => intval($result['numDataFilter']),
            "data"            => $result['data']
            );

        echo json_encode($json_data);
	}
	//INIT LINKS
	public function add()
	{
		
		$roles = $this->modelo->getAllRoles();
		$people = $this->modelo->getAllPeople();
		$users_state = $this->modelo->getAllUser_States();

		$data = array(
			'roles' => $roles,
			'people' => $people,
			'user_states' => $users_state
		);

		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('users/add', $data);
	}

	public function edit() 
	{
		$id = trim($this->input->get('id', TRUE));

		$user = $this->modelo->getUser($id);
		$roles = $this->modelo->getAllRoles();
		$people = $this->modelo->getAllPeople();
		$user_states = $this->modelo->getAllUser_States();

		$data = array(
			'user' => $user,
			'roles' => $roles,
			'people' => $people,
			'user_states' => $user_states
		);

		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('users/edit', $data);
	}

	public function view()
	{
		$id = trim($this->input->get('id', TRUE));

		$user = $this->modelo->getUser($id);

		$data = array(
			'user' => $user
		);

		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('users/view', $data);
	}
	//END LINKS
	//INIT CRUD
	public function addUser()
	{
		$user 			= 	trim($this->input->post('user', TRUE));
		$password 		= 	trim($this->input->post('password', TRUE));
		$roles_id 		= 	trim($this->input->post('roles_id', TRUE));
		$people_id 		= 	trim($this->input->post('people_id', TRUE));
		$user_states_id	= 	trim($this->input->post('user_states_id', TRUE));
		$users_save		= 	trim($this->input->post('users_save', TRUE));
		$users_edit		= 	trim($this->input->post('users_edit', TRUE));
		$users_delete	= 	trim($this->input->post('users_delete', TRUE));

		$date_time = date('Y-m-d H:i:s');

		$data = array(
			'user' 				=> $user,
			'password' 			=> md5($password),
			'roles_id' 			=> $roles_id,
			'people_id' 		=> $people_id,
			'user_states_id' 	=> $user_states_id,
			'save' 				=> $users_save,
			'edit' 				=> $users_edit,
			'delete' 			=> $users_delete,
			'created'			=> $date_time
		);

		if($this->modelo->addUser($data))
			echo '1';
		else
			echo '0';
	}

	public function editUser()
	{
		$id 			= 	trim($this->input->post('id', TRUE));
		$user 			= 	trim($this->input->post('user', TRUE));
		$password 		= 	trim($this->input->post('password', TRUE));
		$roles_id 		= 	trim($this->input->post('roles_id', TRUE));
		$people_id 		= 	trim($this->input->post('people_id', TRUE));
		$user_states_id	= 	trim($this->input->post('user_states_id', TRUE));
		$users_save		= 	trim($this->input->post('users_save', TRUE));
		$users_edit		= 	trim($this->input->post('users_edit', TRUE));
		$users_delete	= 	trim($this->input->post('users_delete', TRUE));

		//validar recifrado password
		$this->db->select('password');
		$this->db->from('users');
		$this->db->where('id', $id);
		$this->db->limit(1);

		$res = $this->db->get()->result_array();

		if(!empty($res[0]['password']))
			$res = $res[0]['password'];
		else
			$res = 0;

		//si password es igual a res, no ha cambiado su password
		$data = array();
		if($password == $res)
		{
			$data = array(
				'user' 				=> $user,
				'roles_id' 			=> $roles_id,
				'people_id' 		=> $people_id,
				'user_states_id' 	=> $user_states_id,
				'save' 				=> $users_save,
				'edit' 				=> $users_edit,
				'delete' 			=> $users_delete
			);
		}
		else
		{
			$data = array(
				'user' 				=> $user,
				'password' 			=> md5($password),
				'roles_id' 			=> $roles_id,
				'people_id' 		=> $people_id,
				'user_states_id' 	=> $user_states_id,
				'save' 				=> $users_save,
				'edit' 				=> $users_edit,
				'delete' 			=> $users_delete
			);
		}

		if($this->modelo->editUser($data, $id))
			echo '1';
		else
			echo '0';
	}

	public function deleteUser()
	{
		$id 			= 	trim($this->input->post('id', TRUE));

		$data = array(
			'user_states_id'	=>	'2'
		);

		if($this->modelo->editUser($data, $id))
			echo '1';
		else
			echo '0';
	}
	//END CRUD

}

?>