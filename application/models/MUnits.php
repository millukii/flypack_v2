<?php

class MUnits extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	public function getUnits($start, $length, $search, $order, $by)
	{
		$retornar = array();
		if ($search) {
			$busca = $this->getSearchUnits($search, $start, $length, $order, $by);
			$retornar['numDataFilter'] = $this->getCountSearch($search, $start, $length, $order, $by);
			$retornar['data'] = $busca['datos'];
		}
		else {
			$todo = $this->getAllUnits($start, $length, $order, $by);
			$retornar['numDataFilter'] = $this->getCount();
			$retornar['data'] = $todo['datos'];
		}

		$retornar['numDataTotal'] = $this->getCount();

		return $retornar;
	}

	public function getUnit($id)
	{
		$this->db->select('id, unit, acronym, DATE_FORMAT(created, "%d-%m-%Y %H:%i:%s") as created, DATE_FORMAT(modified, "%d-%m-%Y %H:%i:%s") as modified');
		$this->db->from('units');
		$this->db->where('id', $id);
		$this->db->limit(1);

		return $this->db->get()->result_array();
	}

	// Funciones auxiliares datatable
	public function getAllUnits($start, $length, $order, $by)
	{
		$this->db->select('id, unit, acronym, DATE_FORMAT(created, "%d-%m-%Y %H:%i:%s") as created, DATE_FORMAT(modified, "%d-%m-%Y %H:%i:%s") as modified');
		if ($by == 0) {
			$this->db->order_by('id', $order);
		}
		else {
			$this->db->order_by('unit', $order);
		}
		$this->db->limit($length, $start);
		$query = $this->db->get('units');
		$retornar = array(
			'datos' => $query->result()
		);
		return $retornar;
	}

	public function getSearchUnits($search, $start, $length, $order, $by)
	{
		$this->db->select('id, unit, acronym, DATE_FORMAT(created, "%d-%m-%Y %H:%i:%s") as created, DATE_FORMAT(modified, "%d-%m-%Y %H:%i:%s") as modified');
		$this->db->like('id', $search);
		$this->db->or_like('unit', $search);
		if ($by == 0) {
			$this->db->order_by('id', $order);
		}
		else {
			$this->db->order_by('unit', $order);
		}
		$this->db->limit($length, $start);
		$query = $this->db->get('units');
		$retornar = array(
			'datos' => $query->result()
		);
		return $retornar;
	}

	public function getCount()
	{
		return $this->db->count_all('units');
	}

	public function getCountSearch($search, $start, $length, $order, $by)
	{
		$this->db->select('id');
		$this->db->or_like('unit', $search);
		$query = $this->db->get('units')->num_rows();
		return $query;
	}
	// fin funciones auxiliares

	//Crud
	public function addUnit($data)
	{
		if($this->db->insert('units', $data))
			return true;
		else
			return false;
	}

	public function editUnit($data, $id)
	{
		$this->db->where('id', $id);
		if($this->db->update('units', $data))
			return true;
		else
			return false;
	}

	public function deleteUnit($id)
	{
		$this->db->where('id', $id);
		if($this->db->delete('units'))
			return true;
		else
			return false;
	}
}

?>