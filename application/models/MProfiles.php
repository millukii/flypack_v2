<?php

class MProfiles extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	public function getProfiles($start, $length, $search, $order, $by)
	{
		$retornar = array();
		if ($search) {
			$busca = $this->getSearchProfiles($search, $start, $length, $order, $by);
			$retornar['numDataFilter'] = $this->getCountSearch($search, $start, $length, $order, $by);
			$retornar['data'] = $busca['datos'];
		}
		else {
			$todo = $this->getAllProfiles($start, $length, $order, $by);
			$retornar['numDataFilter'] = $this->getCount();
			$retornar['data'] = $todo['datos'];
		}

		$retornar['numDataTotal'] = $this->getCount();

		return $retornar;
	}

	public function getProfile($id)
	{
		$this->db->select('id, profile, DATE_FORMAT(created, "%d-%m-%Y %H:%i:%s") as created, DATE_FORMAT(modified, "%d-%m-%Y %H:%i:%s") as modified');
		$this->db->from('profiles');
		$this->db->where('id', $id);
		$this->db->limit(1);

		return $this->db->get()->result_array();
	}

	// Funciones auxiliares datatable
	public function getAllProfiles($start, $length, $order, $by)
	{
		$this->db->select('id, profile, DATE_FORMAT(created, "%d-%m-%Y %H:%i:%s") as created, DATE_FORMAT(modified, "%d-%m-%Y %H:%i:%s") as modified');

		if ($by == 0)
			$this->db->order_by('id', $order);
		else
			$this->db->order_by('profile', $order);

		$this->db->limit($length, $start);
		$query = $this->db->get('profiles');
		$retornar = array(
			'datos' => $query->result()
		);
		return $retornar;
	}

	public function getSearchProfiles($search, $start, $length, $order, $by)
	{
		$this->db->select('id, profile, DATE_FORMAT(created, "%d-%m-%Y %H:%i:%s") as created, DATE_FORMAT(modified, "%d-%m-%Y %H:%i:%s") as modified');

		$this->db->like('id', $search);
		$this->db->or_like('profile', $search);

		if ($by == 0)
			$this->db->order_by('id', $order);
		else
			$this->db->order_by('profile', $order);

		$this->db->limit($length, $start);
		$query = $this->db->get('profiles');

		$retornar = array(
			'datos' => $query->result()
		);

		return $retornar;
	}

	public function getCount()
	{
		return $this->db->count_all('profiles');
	}

	public function getCountSearch($search, $start, $length, $order, $by)
	{
		$this->db->select('id');
		$this->db->or_like('profile', $search);
		$query = $this->db->get('profiles')->num_rows();
		return $query;
	}
	//Crud
	public function addProfile($data)
	{
		if($this->db->insert('profiles', $data))
			return true;
		else
			return false;
	}

	public function editProfile($data, $id)
	{
		$this->db->where('id', $id);
		if($this->db->update('profiles', $data))
			return true;
		else
			return false;
	}

	public function deleteProfile($id)
	{
		$this->db->where('id', $id);
		if($this->db->delete('profiles'))
			return true;
		else
			return false;
	}
}

?>