<?php

class MUsers extends CI_Model 
{

	function __construct() 
	{
		parent::__construct();
	}

	//INIT FUNCTION DATA TABLE
	public function getUsers($start, $length, $search, $order, $by) 
	{
		$retornar = array();
		if ($search) {
			$busca = $this->getSearchUsers($search, $start, $length, $order, $by);
			$retornar['numDataFilter'] = $this->getCountSearch($search, $start, $length, $order, $by);
			$retornar['data'] = $busca['datos'];
		}
		else {
			$todo = $this->getAllUsers($start, $length, $order, $by);
			$retornar['numDataFilter'] = $this->getCount();
			$retornar['data'] = $todo['datos'];
		}

		$retornar['numDataTotal'] = $this->getCount();

		return $retornar;
	}

	public function getAllUsers($start, $length, $order, $by) 
	{
		$this->db->select('users.id as id, users.user as user, people.rut as rut, people.dv as dv, people.name as name, people.lastname as lastname, roles.rol as rol, user_state.state');
		$this->db->join('people', 'people.id = users.people_id');
		$this->db->join('roles', 'roles.id = users.rol_id');
		$this->db->join('user_state', 'user_state.id = users.user_state_id');

		if ($by == 0) 
		{
			$this->db->order_by('users.id', $order);
		}
		elseif($by == 1) 
		{
			$this->db->order_by('users.user', $order);
		}
		elseif($by == 2) 
		{
			$this->db->order_by('roles.rol', $order);
		}
		else
		{
			$this->db->order_by('people.rut', $order);
		}

		$this->db->limit($length, $start);
		$query = $this->db->get('users');

		$retornar = array(
			'datos' => $query->result()
		);
		return $retornar;
	}

	public function getSearchUsers($search, $start, $length, $order, $by) 
	{
		$this->db->select('users.id as id, users.user as user, people.rut as rut, people.dv as dv, people.name as name, people.lastname as lastname, roles.rol as rol, user_state.state');
		$this->db->join('people', 'people.id = users.people_id');
		$this->db->join('roles', 'roles.id = users.rol_id');
		$this->db->join('user_state', 'user_state.id = users.user_state_id');

		$this->db->like('users.id', $search);
		$this->db->or_like('users.user', $search);
		$this->db->or_like('roles.rol', $search);
		$this->db->or_like('people.rut', $search);

		if ($by == 0) 
		{
			$this->db->order_by('users.id', $order);
		}
		elseif($by == 1) 
		{
			$this->db->order_by('users.user', $order);
		}
		elseif($by == 2) 
		{
			$this->db->order_by('roles.rol', $order);
		}
		else
		{
			$this->db->order_by('people.rut', $order);
		}

		$this->db->limit($length, $start);

		$query = $this->db->get('users');

		$retornar = array(
			'datos' => $query->result()
		);
		return $retornar;
	}

	public function getCount() 
	{
		return $this->db->count_all('users');
	}

	public function getCountSearch($search, $start, $length, $order, $by) 
	{
		$this->db->select('users.id as id, users.user as user, people.rut as rut, people.dv as dv, people.name as name, people.lastname as lastname, roles.rol as rol, user_state.state');
		$this->db->join('people', 'people.id = users.people_id');
		$this->db->join('roles', 'roles.id = users.rol_id');
		$this->db->join('user_state', 'user_state.id = users.user_state_id');

		$this->db->like('users.id', $search);
		$this->db->or_like('users.user', $search);
		$this->db->or_like('roles.rol', $search);
		$this->db->or_like('people.rut', $search);

		$query = $this->db->get('users')->num_rows();
		return $query;
	}
	//END FUNCTIONS DATA TABLE
	//INIT CRUD
	public function addUser($data) 
	{
		if($this->db->insert('users', $data))
			return true;
		else
			return false;
	}

	public function editUser($data, $id) 
	{
		$this->db->where('id', $id);
		if($this->db->update('users', $data))
			return true;
		else
			return false;
	}

	public function getAllPeople() 
	{
		$this->db->select('id, name, rut, dv, lastname');
		$this->db->from('people');
		$this->db->order_by('rut');

		return $this->db->get()->result();
	}

	public function getAllUser_states() 
	{
		$this->db->select('id, state');
		$this->db->from('user_state');
		$this->db->order_by('state');

		return $this->db->get()->result();
	}

	public function getAllRoles() 
	{
		$this->db->select('id, rol');
		$this->db->from('roles');
		$this->db->order_by('rol');

		return $this->db->get()->result();
	}

	public function getUser($id)
	{
		$this->db->select('users.id as id, users.user as user, people.rut as rut, people.dv as dv, people.name as name, people.lastname as lastname, roles.rol as rol, user_state.state');
		$this->db->join('people', 'people.id = users.people_id');
		$this->db->join('roles', 'roles.id = users.rol_id');
		$this->db->join('user_state', 'user_state.id = users.user_state_id');
		$this->db->from('users');
		$this->db->where('users.id', $id);
		$this->db->limit(1);

		return $this->db->get()->result_array();
	}
	//END CRUD
}

?>