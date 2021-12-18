<?php

class MSession extends CI_Model 
{

	function __construct() 
	{
		parent::__construct();
	}

	public function addSession($data) 
	{
		if($this->db->insert('session', $data))
			return true;
		else
			return false;
	}

	public function getSession($start, $length, $search, $order, $by)
	{
		$retornar = array();
		if ($search) {
			$busca = $this->getSearchSession($search, $start, $length, $order, $by);
			$retornar['numDataFilter'] = $this->getCountSearch($search, $start, $length, $order, $by);
			$retornar['data'] = $busca['datos'];
		}
		else {
			$todo = $this->getAllSession($start, $length, $order, $by);
			$retornar['numDataFilter'] = $this->getCount();
			$retornar['data'] = $todo['datos'];
		}

		$retornar['numDataTotal'] = $this->getCount();

		return $retornar;
	}

	public function getSession_($id)
	{
		$this->db->select('session.id as id, users.user as user, DATE_FORMAT(session.created, "%d-%m-%Y %H:%i:%s") as created');
		$this->db->join('users', 'users.id = session.users_id');
		$this->db->from('session');
		$this->db->where('session.id', $id);
		$this->db->limit(1);

		return $this->db->get()->result_array();
	}

	public function getAllSession($start, $length, $order, $by)
	{
		$this->db->select('session.id as id, users.user as user, people.name as name, people.lastname as lastname, people.rut as rut, people.dv as dv, DATE_FORMAT(session.created, "%d-%m-%Y %H:%i:%s") as created');
		$this->db->join('users', 'users.id = session.users_id');
		$this->db->join('people', 'people.id = users.people_id');

		if ($by == 0)
			$this->db->order_by('session.id', $order);
		if ($by == 1)
			$this->db->order_by('users.user', $order);
		else
			$this->db->order_by('people.rut', $order);

		$this->db->limit($length, $start);
		$query = $this->db->get('session');
		$retornar = array(
			'datos' => $query->result()
		);
		return $retornar;
	}

	public function getSearchSession($search, $start, $length, $order, $by)
	{
		$this->db->select('session.id as id, users.user as user, people.name as name, people.lastname as lastname, people.rut as rut, people.dv as dv, DATE_FORMAT(session.created, "%d-%m-%Y %H:%i:%s") as created');
		$this->db->join('users', 'users.id = session.users_id');
		$this->db->join('people', 'people.id = users.people_id');

		$this->db->like('session.id', $search);
		$this->db->or_like('users.user', $search);
		$this->db->or_like('people.rut', $search);

		if ($by == 0)
			$this->db->order_by('session.id', $order);
		if ($by == 1)
			$this->db->order_by('users.user', $order);
		else
			$this->db->order_by('people.rut', $order);

		$this->db->limit($length, $start);
		$query = $this->db->get('session');
		$retornar = array(
			'datos' => $query->result()
		);
		return $retornar;
	}

	public function getCount()
	{
		return $this->db->count_all('session');
	}

	public function getCountSearch($search, $start, $length, $order, $by)
	{
		$this->db->select('session.id as id, users.user as user, people.name as name, people.lastname as lastname, people.rut as rut, people.dv as dv, DATE_FORMAT(session.created, "%d-%m-%Y %H:%i:%s") as created');
		$this->db->join('users', 'users.id = session.users_id');
		$this->db->join('people', 'people.id = users.people_id');

		$this->db->like('session.id', $search);
		$this->db->or_like('users.user', $search);
		$this->db->or_like('people.rut', $search);

		$quer = $this->db->get('session')->num_rows();
		return $quer;
	}
}

?>