<?php

class MVarieties extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	public function getVarieties($start, $length, $search, $order, $by)
	{
		$retornar = array();
		if ($search) {
			$busca = $this->getSearchVarieties($search, $start, $length, $order, $by);
			$retornar['numDataFilter'] = $this->getCountSearch($search, $start, $length, $order, $by);
			$retornar['data'] = $busca['datos'];
		}
		else {
			$todo = $this->getAllVarieties($start, $length, $order, $by);
			$retornar['numDataFilter'] = $this->getCount();
			$retornar['data'] = $todo['datos'];
		}

		$retornar['numDataTotal'] = $this->getCount();

		return $retornar;
	}

	public function getVariety($id)
	{
		$this->db->select('id, variety, DATE_FORMAT(created, "%d-%m-%Y %H:%i:%s") as created, DATE_FORMAT(modified, "%d-%m-%Y %H:%i:%s") as modified');
		$this->db->from('varieties');
		$this->db->where('id', $id);
		$this->db->limit(1);

		return $this->db->get()->result_array();
	}

	// Funciones auxiliares datatable
	public function getAllVarieties($start, $length, $order, $by)
	{
		$this->db->select('id, variety, DATE_FORMAT(created, "%d-%m-%Y %H:%i:%s") as created, DATE_FORMAT(modified, "%d-%m-%Y %H:%i:%s") as modified');

		if ($by == 0) 
			$this->db->order_by('id', $order);
		else
			$this->db->order_by('variety', $order);

		$this->db->limit($length, $start);
		$query = $this->db->get('varieties');
		$retornar = array(
			'datos' => $query->result()
		);
		return $retornar;
	}

	public function getSearchVarieties($search, $start, $length, $order, $by)
	{
		$this->db->select('id, variety, DATE_FORMAT(created, "%d-%m-%Y %H:%i:%s") as created, DATE_FORMAT(modified, "%d-%m-%Y %H:%i:%s") as modified');
		$this->db->like('id', $search);
		$this->db->or_like('variety', $search);

		if ($by == 0) 
			$this->db->order_by('id', $order);
		else
			$this->db->order_by('variety', $order);

		$this->db->limit($length, $start);
		$query = $this->db->get('varieties');
		$retornar = array(
			'datos' => $query->result()
		);
		return $retornar;
	}

	public function getCount()
	{
		return $this->db->count_all('varieties');
	}

	public function getCountSearch($search, $start, $length, $order, $by)
	{
		$this->db->select('id');
		$this->db->or_like('variety', $search);
		$query = $this->db->get('varieties')->num_rows();
		return $query;
	}
	// fin funciones auxiliares

	//Crud
	public function addVariety($data)
	{
		if($this->db->insert('varieties', $data))
			return true;
		else
			return false;
	}

	public function editVariety($data, $id)
	{
		$this->db->where('id', $id);
		if($this->db->update('varieties', $data))
			return true;
		else
			return false;
	}

	public function deleteVariety($id)
	{
		$this->db->where('id', $id);
		if($this->db->delete('varieties'))
			return true;
		else
			return false;
	}
}

?>