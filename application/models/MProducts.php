<?php

class MProducts extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	public function getProducts($start, $length, $search, $order, $by)
	{
		$retornar = array();
		if ($search) {
			$busca = $this->getSearchProducts($search, $start, $length, $order, $by);
			$retornar['numDataFilter'] = $this->getCountSearch($search, $start, $length, $order, $by);
			$retornar['data'] = $busca['datos'];
		}
		else {
			$todo = $this->getAllProducts($start, $length, $order, $by);
			$retornar['numDataFilter'] = $this->getCount();
			$retornar['data'] = $todo['datos'];
		}

		$retornar['numDataTotal'] = $this->getCount();

		return $retornar;
	}

	public function getProduct($id)
	{
		$this->db->select('products.id as id, products.product as product, products.description as description, products.varieties_id as varieties_id, varieties.variety as variety, DATE_FORMAT(products.created, "%d-%m-%Y %H:%i:%s") as created, DATE_FORMAT(products.modified, "%d-%m-%Y %H:%i:%s") as modified');

		$this->db->join('varieties', 'varieties.id = products.varieties_id');

		$this->db->from('products');
		$this->db->where('products.id', $id);
		$this->db->limit(1);

		return $this->db->get()->result_array();
	}

	// Funciones auxiliares datatable
	public function getAllProducts($start, $length, $order, $by)
	{
		$this->db->select('products.id as id, products.product as product, products.description as description, products.varieties_id as varieties_id, varieties.variety as variety, DATE_FORMAT(products.created, "%d-%m-%Y %H:%i:%s") as created, DATE_FORMAT(products.modified, "%d-%m-%Y %H:%i:%s") as modified');

		$this->db->join('varieties', 'varieties.id = products.varieties_id');

		if ($by == 0)
			$this->db->order_by('products.id', $order);
		else if($by == 1)
			$this->db->order_by('products.product', $order);
		else
			$this->db->order_by('varieties.variety', $order);
		
		$this->db->limit($length, $start);
		$query = $this->db->get('products');
		$retornar = array(
			'datos' => $query->result()
		);
		return $retornar;
	}

	public function getSearchProducts($search, $start, $length, $order, $by)
	{
		$this->db->select('products.id as id, products.product as product, products.description as description, products.varieties_id as varieties_id, varieties.variety as variety, DATE_FORMAT(products.created, "%d-%m-%Y %H:%i:%s") as created, DATE_FORMAT(products.modified, "%d-%m-%Y %H:%i:%s") as modified');

		$this->db->join('varieties', 'varieties.id = products.varieties_id');

		$this->db->like('products.id', $search);
		$this->db->or_like('products.product', $search);
		$this->db->or_like('varieties.variety', $search);

		if ($by == 0)
			$this->db->order_by('products.id', $order);
		else if($by == 1)
			$this->db->order_by('products.product', $order);
		else
			$this->db->order_by('varieties.variety', $order);

		$this->db->limit($length, $start);
		$query = $this->db->get('products');

		$retornar = array(
			'datos' => $query->result()
		);
		return $retornar;
	}

	public function getCount()
	{
		return $this->db->count_all('products');
	}

	public function getCountSearch($search, $start, $length, $order, $by)
	{
		$this->db->select('products.id');
		$this->db->join('varieties', 'varieties.id = products.varieties_id');

		$this->db->like('products.id', $search);
		$this->db->or_like('products.product', $search);
		$this->db->or_like('varieties.variety', $search);

		$query = $this->db->get('products')->num_rows();
		return $query;
	}
	// fin funciones auxiliares

	//Crud
	public function addProduct($data)
	{
		if($this->db->insert('products', $data))
			return true;
		else
			return false;
	}

	public function editProduct($data, $id)
	{
		$this->db->where('id', $id);
		if($this->db->update('products', $data))
			return true;
		else
			return false;
	}

	public function deleteProduct($id)
	{
		$this->db->where('id', $id);
		if($this->db->delete('products'))
			return true;
		else
			return false;
	}

	public function getVarieties()
	{
		$this->db->select('id, variety');
		$this->db->from('varieties');
		$this->db->order_by('variety', 'asc');

		return $this->db->get()->result();
	}
}

?>