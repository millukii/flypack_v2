<?php

class MPeople extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	public function getPeople($start, $length, $search, $order, $by)
	{
		$retornar = array();
		if ($search) {
			$busca = $this->getSearchPeople($search, $start, $length, $order, $by);
			$retornar['numDataFilter'] = $this->getCountSearch($search, $start, $length, $order, $by);
			$retornar['data'] = $busca['datos'];
		}
		else {
			$todo = $this->getAllPeople($start, $length, $order, $by);
			$retornar['numDataFilter'] = $this->getCount();
			$retornar['data'] = $todo['datos'];
		}

		$retornar['numDataTotal'] = $this->getCount();

		return $retornar;
	}

	public function getPeople_($id)
	{
		$this->db->select('people.id as id, people.rut as rut, people.dv as dv, people.name as name, people.lastname as lastname, people.address as address, people.phone as phone, people.email as email, people.profile_id as profile_id, people.people_states_id as people_states_id, profiles.profile as profile, people_states.state as state,  DATE_FORMAT(people.created, "%d-%m-%Y %H:%i:%s") as created, DATE_FORMAT(people.modified, "%d-%m-%Y %H:%i:%s") as modified');

		$this->db->join('people_states','people_states.id = people.people_states_id');
		$this->db->join('profiles','profiles.id = people.profile_id');

		$this->db->from('people');
		$this->db->where('people.id', $id);
		$this->db->limit(1);

		return $this->db->get()->result_array();
	}

	// Funciones auxiliares datatable
	public function getAllPeople($start, $length, $order, $by)
	{
		$this->db->select('people.id as id, people.rut as rut, people.dv as dv, people.name as name, people.lastname as lastname, people.address as address, people.phone as phone, people.email as email, profiles.profile as profile, people_states.state');

		$this->db->join('people_states','people_states.id = people.people_states_id');
		$this->db->join('profiles','profiles.id = people.profile_id');

		switch ($by)
		{
			case 0:
				$this->db->order_by('people.id', $order);
				break;
			case 1:
				$this->db->order_by('people.rut', $order);
				break;
			case 2:
				$this->db->order_by('name', $order);
				break;
			case 3:
				$this->db->order_by('lastname', $order);
				break;
			case 4:
				$this->db->order_by('people.phone', $order);
				break;
			case 5:
				$this->db->order_by('profiles.profile', $order);
				break;
		}

		$this->db->limit($length, $start);
		$query = $this->db->get('people');

		$retornar = array(
			'datos' => $query->result()
		);
		return $retornar;
	}

	public function getSearchPeople($search, $start, $length, $order, $by)
	{
		$this->db->select('people.id as id, people.rut as rut, people.dv as dv, people.name as name, people.lastname as lastname, people.address as address, people.phone as phone, people.email as email, profiles.profile as profile, people_states.state');

		$this->db->join('people_states','people_states.id = people.people_states_id');
		$this->db->join('profiles','profiles.id = people.profile_id');

		$this->db->like('people.id', $search);
		$this->db->or_like('people.rut', $search);
		$this->db->or_like('people.name', $search);
		$this->db->or_like('people.lastname', $search);
		$this->db->or_like('people.phone', $search);
		$this->db->or_like('profiles.profile', $search);

		switch ($by)
		{
			case 0:
				$this->db->order_by('people.id', $order);
				break;
			case 1:
				$this->db->order_by('people.rut', $order);
				break;
			case 2:
				$this->db->order_by('name', $order);
				break;
			case 3:
				$this->db->order_by('lastname', $order);
				break;
			case 4:
				$this->db->order_by('people.phone', $order);
				break;
			case 5:
				$this->db->order_by('profiles.profile', $order);
				break;
		}

		$this->db->limit($length, $start);
		$query = $this->db->get('people');

		$retornar = array(
			'datos' => $query->result()
		);
		return $retornar;
	}

	public function getCount()
	{
		return $this->db->count_all('people');
	}

	public function getCountSearch($search, $start, $length, $order, $by)
	{
		$this->db->select('people.id');

		$this->db->join('people_states','people_states.id = people.people_states_id');
		$this->db->join('profiles','profiles.id = people.profile_id');

		$this->db->like('people.id', $search);
		$this->db->or_like('people.rut', $search);
		$this->db->or_like('people.name', $search);
		$this->db->or_like('people.lastname', $search);
		$this->db->or_like('people.phone', $search);
		$this->db->or_like('profiles.profile', $search);

		$query = $this->db->get('people')->num_rows();
		return $query;
	}
	//
	//Crud
	public function addPeople($data)
	{
		if($this->db->insert('people', $data))
			return true;
		else
			return false;
	}

	public function editPeople($data, $id)
	{
		$this->db->where('id', $id);
		if($this->db->update('people', $data))
			return true;
		else
			return false;
	}
	//FUNCTION AUXILIARES
	public function getAllProfiles()
	{
		$this->db->select('id, profile');
		$this->db->from('profiles');
		$this->db->order_by('profile');

		return $this->db->get()->result();
	}

	public function getAllPeople_States()
	{
		$this->db->select('id, state');
		$this->db->from('people_states');
		$this->db->order_by('state');

		return $this->db->get()->result();
	}

}

?>