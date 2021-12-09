<?php

class MOrchards extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	public function getOrchards($start, $length, $search, $order, $by)
	{
		$retornar = array();
		if ($search) {
			$busca = $this->getSearchOrchards($search, $start, $length, $order, $by);
			$retornar['numDataFilter'] = $this->getCountSearch($search, $start, $length, $order, $by);
			$retornar['data'] = $busca['datos'];
		}
		else {
			$todo = $this->getAllOrchards($start, $length, $order, $by);
			$retornar['numDataFilter'] = $this->getCount();
			$retornar['data'] = $todo['datos'];
		}

		$retornar['numDataTotal'] = $this->getCount();

		return $retornar;
	}

	public function getOrchard($id)
	{
		$this->db->select('id, orchard, DATE_FORMAT(created, "%d-%m-%Y %H:%i:%s") as created, DATE_FORMAT(modified, "%d-%m-%Y %H:%i:%s") as modified');
		$this->db->from('orchards');
		$this->db->where('id', $id);
		$this->db->limit(1);

		return $this->db->get()->result_array();
	}

	// Funciones auxiliares datatable
	public function getAllOrchards($start, $length, $order, $by)
	{
		$this->db->select('id, orchard, DATE_FORMAT(created, "%d-%m-%Y %H:%i:%s") as created, DATE_FORMAT(modified, "%d-%m-%Y %H:%i:%s") as modified');
		if ($by == 0) {
			$this->db->order_by('id', $order);
		}
		else {
			$this->db->order_by('orchard', $order);
		}
		$this->db->limit($length, $start);
		$query = $this->db->get('orchards');
		$retornar = array(
			'datos' => $query->result()
		);
		return $retornar;
	}

	public function getSearchOrchards($search, $start, $length, $order, $by)
	{
		$this->db->select('id, orchard, DATE_FORMAT(created, "%d-%m-%Y %H:%i:%s") as created, DATE_FORMAT(modified, "%d-%m-%Y %H:%i:%s") as modified');
		$this->db->like('id', $search);
		$this->db->or_like('orchard', $search);

		if ($by == 0)
			$this->db->order_by('id', $order);
		else
			$this->db->order_by('orchard', $order);

		$this->db->limit($length, $start);
		$query = $this->db->get('orchards');
		$retornar = array(
			'datos' => $query->result()
		);
		return $retornar;
	}

	public function getCount()
	{
		return $this->db->count_all('orchards');
	}

	public function getCountSearch($search, $start, $length, $order, $by)
	{
		$this->db->select('id');
		$this->db->or_like('orchard', $search);
		$query = $this->db->get('orchards')->num_rows();
		return $query;
	}
	// fin funciones auxiliares

	//Crud
	public function addOrchard($data)
	{
		if($this->db->insert('orchards', $data))
			return true;
		else
			return false;
	}

	public function editOrchard($data, $id)
	{
		$this->db->where('id', $id);
		if($this->db->update('orchards', $data))
			return true;
		else
			return false;
	}

	public function deleteOrchard($id)
	{
		$this->db->where('id', $id);
		if($this->db->delete('orchards'))
			return true;
		else
			return false;
	}
}

?>