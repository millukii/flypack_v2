<?php

class MRoles extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	public function getRoles($start, $length, $search, $order, $by)
	{
		$retornar = array();
		if ($search) {
			$busca = $this->getSearchRoles($search, $start, $length, $order, $by);
			$retornar['numDataFilter'] = $this->getCountSearch($search, $start, $length, $order, $by);
			$retornar['data'] = $busca['datos'];
		}
		else {
			$todo = $this->getAllRoles($start, $length, $order, $by);
			$retornar['numDataFilter'] = $this->getCount();
			$retornar['data'] = $todo['datos'];
		}

		$retornar['numDataTotal'] = $this->getCount();

		return $retornar;
	}

	public function getRol($id)
	{
		$this->db->select('id, rol');
		$this->db->from('roles');
		$this->db->where('id', $id);
		$this->db->limit(1);

		return $this->db->get()->result_array();
	}

	// Funciones auxiliares datatable
	public function getAllRoles($start, $length, $order, $by)
	{
		$this->db->select('id, rol');
		if ($by == 0) {
			$this->db->order_by('id', $order);
		}
		else {
			$this->db->order_by('rol', $order);
		}
		$this->db->limit($length, $start);
		$query = $this->db->get('roles');
		$retornar = array(
			'datos' => $query->result()
		);
		return $retornar;
	}

	public function getSearchRoles($search, $start, $length, $order, $by)
	{
		$this->db->select('id, rol');
		$this->db->like('id', $search);
		$this->db->or_like('rol', $search);
		if ($by == 0) {
			$this->db->order_by('id', $order);
		}
		else {
			$this->db->order_by('rol', $order);
		}
		$this->db->limit($length, $start);
		$query = $this->db->get('roles');
		$retornar = array(
			'datos' => $query->result()
		);
		return $retornar;
	}

	public function getCount()
	{
		return $this->db->count_all('roles');
	}

	public function getCountSearch($search, $start, $length, $order, $by)
	{
		$this->db->select('id');
		$this->db->or_like('rol', $search);
		$quer = $this->db->get('roles')->num_rows();
		return $quer;
	}
	// fin funciones auxiliares

	//Crud
	public function addRol($data)
	{
		if($this->db->insert('roles', $data))
			return true;
		else
			return false;
	}

	public function editRol($data, $id)
	{
		$this->db->where('id', $id);
		if($this->db->update('roles', $data))
			return true;
		else
			return false;
	}

	public function deleteRol($id)
	{
		$this->db->where('id', $id);
		if($this->db->delete('roles'))
			return true;
		else
			return false;
	}
}

?>