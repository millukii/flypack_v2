<?php

class MPrices extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	public function getPrices($start, $length, $search, $order, $by)
	{
		$retornar = array();
		if ($search) {
			$busca = $this->getSearchPrices($search, $start, $length, $order, $by);
			$retornar['numDataFilter'] = $this->getCountSearch($search, $start, $length, $order, $by);
			$retornar['data'] = $busca['datos'];
		}
		else {
			$todo = $this->getAllPrices($start, $length, $order, $by);
			$retornar['numDataFilter'] = $this->getCount();
			$retornar['data'] = $todo['datos'];
		}

		$retornar['numDataTotal'] = $this->getCount();

		return $retornar;
	}

	public function getPrice($id)
	{
		$this->db->select('id, value, from, to');
		$this->db->from('rates');
		$this->db->where('id', $id);
		$this->db->limit(1);

		return $this->db->get()->result_array();
	}

	// Funciones auxiliares datatable
	public function getAllPrices($start, $length, $order, $by)
	{
		$this->db->select('id, value, from, to');
		if ($by == 0) {
			$this->db->order_by('id', $order);
		}
		else {
			$this->db->order_by('value', $order);
		}
		$this->db->limit($length, $start);
		$query = $this->db->get('rates');
		$retornar = array(
			'datos' => $query->result()
		);
		return $retornar;
	}

	public function getSearchPrices($search, $start, $length, $order, $by)
	{
		$this->db->select('id, value, from, to');
		$this->db->like('id', $search);
		$this->db->or_like('value', $search);
		if ($by == 0) {
			$this->db->order_by('id', $order);
		}
		else {
			$this->db->order_by('value', $order);
		}
		$this->db->limit($length, $start);
		$query = $this->db->get('rates');
		$retornar = array(
			'datos' => $query->result()
		);
		return $retornar;
	}

	public function getCount()
	{
		return $this->db->count_all('rates');
	}

	public function getCountSearch($search, $start, $length, $order, $by)
	{
		$this->db->select('id');
		$this->db->or_like('value', $search);
		$quer = $this->db->get('rates')->num_rows();
		return $quer;
	}
	// fin funciones auxiliares

	//Crud
	public function addPrice($data)
	{
		if($this->db->insert('rates', $data))
			return true;
		else
			return false;
	}

	public function editPrice($data, $id)
	{
		$this->db->where('id', $id);
		if($this->db->update('rates', $data))
			return true;
		else
			return false;
	}

	public function deletePrice($id)
	{
		$this->db->where('id', $id);
		if($this->db->delete('rates'))
			return true;
		else
			return false;
	}
}

?>