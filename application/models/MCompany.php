<?php

class MCompany extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	public function getCompany($start, $length, $search, $order, $by)
	{
		$retornar = array();
		if ($search) {
			$busca = $this->getSearchCompany($search, $start, $length, $order, $by);
			$retornar['numDataFilter'] = $this->getCountSearch($search, $start, $length, $order, $by);
			$retornar['data'] = $busca['datos'];
		}
		else {
			$todo = $this->getAllCompanies($start, $length, $order, $by);
			$retornar['numDataFilter'] = $this->getCount();
			$retornar['data'] = $todo['datos'];
		}

		$retornar['numDataTotal'] = $this->getCount();

		return $retornar;
	}

	public function getCompany_($id)
	{
		$this->db->select('*');
		$this->db->from('companies');
		$this->db->where('companies.id', $id);
		$this->db->limit(1);

		return $this->db->get()->result_array();
	}

	// Funciones auxiliares datatable
	public function getAllCompanies($start, $length, $order, $by)
	{
		$this->db->select('companies.id as id, companies.rut as rut, companies.dv as dv, companies.razon as razon, companies.fantasy as fantasy, companies.address as address, companies.city as city, companies.commune as commune');

		switch ($by)
		{
			case 0:
				$this->db->order_by('companies.id', $order);
				break;
			case 1:
				$this->db->order_by('companies.rut', $order);
				break;
			case 2:
				$this->db->order_by('companies.razon', $order);
				break;
			case 3:
				$this->db->order_by('fantasy', $order);
				break;
			case 4:
				$this->db->order_by('people.id', $order);
				break;
		}

		$this->db->limit($length, $start);
		$query = $this->db->get('companies');

		$retornar = array(
			'datos' => $query->result()
		);
		return $retornar;
	}

	public function getSearchCompany($search, $start, $length, $order, $by)
	{
		$this->db->select('companies.id as id, companies.rut as rut, companies.dv as dv, companies.razon as razon, companies.fantasy as fantasy, companies.address as address, companies.contact_name as name, companies.city as city, companies.commune as commune');

		$this->db->like('companies.id', $search);
		$this->db->or_like('companies.rut', $search);
		$this->db->or_like('companies.razon', $search);
		$this->db->or_like('companies.fantasy', $search);

		switch ($by)
		{
			case 0:
				$this->db->order_by('companies.id', $order);
				break;
			case 1:
				$this->db->order_by('companies.rut', $order);
				break;
			case 2:
				$this->db->order_by('name', $order);
				break;
			case 3:
				$this->db->order_by('fantasy', $order);
				break;
		}

		$this->db->limit($length, $start);
		$query = $this->db->get('companies');

		$retornar = array(
			'datos' => $query->result()
		);
		return $retornar;
	}

	public function getCount()
	{
		return $this->db->count_all('companies');
	}

	public function getCountSearch($search, $start, $length, $order, $by)
	{
		$this->db->select('companies.id');

		$this->db->join('people','people.id = companies.people_id');

		$this->db->like('companies.id', $search);
		$this->db->or_like('companies.rut', $search);
		$this->db->or_like('companies.razon', $search);
		$this->db->or_like('companies.fantasy', $search);

		$query = $this->db->get('companies')->num_rows();
		return $query;
	}
	//
	//Crud
	public function addCompany($data)
	{
		if($this->db->insert('companies', $data))
			return $this->db->insert_id();
		else
			return false;
	}

	public function editCompany($data, $id)
	{
		$this->db->where('id', $id);
		if($this->db->update('companies', $data))
			return true;
		else
			return false;
	}


	public function getAllPeople()
	{
		$this->db->select('id, rut, dv, name, lastname');
		$this->db->from('people');
		$this->db->order_by('rut');

		return $this->db->get()->result();
	}

	public function addUser($data) 
	{
		if($this->db->insert('users', $data))
			return true;
		else
			return false;
	}

	public function getUsersByCompany($id)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->join('companies','companies.id = users.companies_id');
		$this->db->where('companies.id', $id);
		$this->db->order_by('users.user', 'asc');

		return $this->db->get()->result();
	}

}

?>