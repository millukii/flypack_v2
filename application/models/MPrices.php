<?php

class MPrices extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	public function getPrices($start, $length, $search, $order, $by, $company)
	{
		$retornar = array();
		if ($search) {
			$busca = $this->getSearchPrices($search, $start, $length, $order, $by, $company);
			$retornar['numDataFilter'] = $this->getCountSearch($search, $start, $length, $order, $by, $company);
			$retornar['data'] = $busca['datos'];
		}
		else {
			$todo = $this->getAllPrices($start, $length, $order, $by, $company);
			$retornar['numDataFilter'] = $this->getCount($company);
			$retornar['data'] = $todo['datos'];
		}

		$retornar['numDataTotal'] = $this->getCount($company);

		return $retornar;
	}

	public function getPrices_($start, $length, $search, $order, $by, $company)
	{
		$retornar = array();
		if ($search) {
			$busca = $this->getSearchPrices_($search, $start, $length, $order, $by, $company);
			$retornar['numDataFilter'] = $this->getCountSearch_($search, $start, $length, $order, $by, $company);
			$retornar['data'] = $busca['datos'];
		}
		else {
			$todo = $this->getAllPrices_($start, $length, $order, $by, $company);
			$retornar['numDataFilter'] = $this->getCount_($company);
			$retornar['data'] = $todo['datos'];
		}

		$retornar['numDataTotal'] = $this->getCount($company);

		return $retornar;
	}

	public function getPrice($companies_id, $id)
	{
		if($this->getType_Rate($companies_id) == 1)
		{
			$this->db->select('id, value, from, to');
			$this->db->from('rates');
			$this->db->where('id', $id);
			$this->db->limit(1);
		}
		else
		{
			$this->db->select('id, size, value');
			$this->db->from('rates_size');
			$this->db->where('id', $id);
			$this->db->limit(1);
		}

		return $this->db->get()->result_array();
	}

	public function getType_Rate($companies_id)
	{
		$this->db->select('type_rate');
		$this->db->from('companies');
		$this->db->where('id', $companies_id);
		$this->db->limit(1);

		$response =  $this->db->get()->result_array();
		if(!empty($response[0]['type_rate']))
			return $response[0]['type_rate'];
		else
			return 1;
	}

	// Funciones auxiliares datatable
	public function getAllPrices($start, $length, $order, $by, $company)
	{
		$this->db->select('id, value, from, to');
		$this->db->where('companies_id', $company);
		$this->db->where('value > 0');
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

	public function getAllPrices_($start, $length, $order, $by, $company)
	{
		$this->db->select('*');
		$this->db->where('companies_id', $company);
		$this->db->where('value > 0');
		if ($by == 0) {
			$this->db->order_by('id', $order);
		}
		else {
			$this->db->order_by('value', $order);
		}
		$this->db->limit($length, $start);
		$query = $this->db->get('rates_size');
		$retornar = array(
			'datos' => $query->result()
		);
		return $retornar;
	}

	public function getSearchPrices($search, $start, $length, $order, $by, $company)
	{
		$this->db->select('id, value, from, to');
		$this->db->where('companies_id', $company);
		$this->db->where('value > 0');
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
	
	public function getSearchPrices_($search, $start, $length, $order, $by, $company)
	{
		$this->db->select('*');
		$this->db->where('companies_id', $company);
		$this->db->where('value > 0');
		$this->db->like('id', $search);
		$this->db->or_like('value', $search);
		if ($by == 0) {
			$this->db->order_by('id', $order);
		}
		else {
			$this->db->order_by('value', $order);
		}
		$this->db->limit($length, $start);
		$query = $this->db->get('rates_size');
		$retornar = array(
			'datos' => $query->result()
		);
		return $retornar;
	}
	public function getCount($company)
	{
		$this->db->where('companies_id', $company);
		$this->db->where('value > 0');
		return $this->db->count_all('rates');
	}

	public function getCount_($company)
	{
		$this->db->where('companies_id', $company);
		$this->db->where('value > 0');
		return $this->db->count_all('rates_size');
	}

	public function getCountSearch($search, $start, $length, $order, $by, $company)
	{
		$this->db->select('id');
		$this->db->where('companies_id', $company);
		$this->db->where('value > 0');
		$this->db->or_like('value', $search);
		$quer = $this->db->get('rates')->num_rows();
		return $quer;
	}

	public function getCountSearch_($search, $start, $length, $order, $by, $company)
	{
		$this->db->select('id');
		$this->db->where('companies_id', $company);
		$this->db->where('value > 0');
		$this->db->or_like('value', $search);
		$quer = $this->db->get('rates_size')->num_rows();
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

	public function editPrice($companies_id, $data, $id)
	{
		if($this->getType_Rate($companies_id) == 1)
		{
			$this->db->where('id', $id);
			if($this->db->update('rates', $data))
				return true;
			else
				return false;
		}
		else
		{
			$this->db->where('id', $id);
			if($this->db->update('rates_size', $data))
				return true;
			else
				return false;
		}
	}

	public function deletePrice($id)
	{
		$this->db->where('id', $id);
		if($this->db->delete('rates'))
			return true;
		else
			return false;
	}

	public function getAllCompanies()
	{
		$this->db->select('id, rut, dv, razon');
		$this->db->from('companies');
		$this->db->where('id <> 1');
		$this->db->order_by('rut', 'asc');

		return $this->db->get()->result();
	}
}

?>