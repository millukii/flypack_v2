<?php

class MQuarters extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	public function getQuarters($start, $length, $search, $order, $by)
	{
		$retornar = array();
		if ($search) {
			$busca = $this->getSearchQuarters($search, $start, $length, $order, $by);
			$retornar['numDataFilter'] = $this->getCountSearch($search, $start, $length, $order, $by);
			$retornar['data'] = $busca['datos'];
		}
		else {
			$todo = $this->getAllQuarters($start, $length, $order, $by);
			$retornar['numDataFilter'] = $this->getCount();
			$retornar['data'] = $todo['datos'];
		}

		$retornar['numDataTotal'] = $this->getCount();

		return $retornar;
	}

	public function getQuarter($id)
	{
		$this->db->select('quarters.id as id, quarters.number as number, quarters.quarter as quarter, quarters.orchards_id as orchards_id, orchards.orchard as orchard, DATE_FORMAT(quarters.created, "%d-%m-%Y %H:%i:%s") as created, DATE_FORMAT(quarters.modified, "%d-%m-%Y %H:%i:%s") as modified');

		$this->db->join('orchards','orchards.id = quarters.orchards_id');

		$this->db->from('quarters');
		$this->db->where('quarters.id', $id);
		$this->db->limit(1);

		return $this->db->get()->result_array();
	}

	// Funciones auxiliares datatable
	public function getAllQuarters($start, $length, $order, $by)
	{
		$this->db->select('quarters.id as id, quarters.number as number, quarters.quarter as quarter, quarters.orchards_id as orchards_id, orchards.orchard as orchard, DATE_FORMAT(quarters.created, "%d-%m-%Y %H:%i:%s") as created, DATE_FORMAT(quarters.modified, "%d-%m-%Y %H:%i:%s") as modified');

		$this->db->join('orchards','orchards.id = quarters.orchards_id');

		if ($by == 0)
			$this->db->order_by('quarters.id', $order);
		else if($by == 1)
			$this->db->order_by('quarters.number', $order);
		else if($by == 2)
			$this->db->order_by('quarters.quarter', $order);
		else
			$this->db->order_by('orchards.orchard', $order);

		$this->db->limit($length, $start);
		$query = $this->db->get('quarters');
		$retornar = array(
			'datos' => $query->result()
		);
		return $retornar;
	}

	public function getSearchQuarters($search, $start, $length, $order, $by)
	{
		$this->db->select('quarters.id as id, quarters.number as number, quarters.quarter as quarter, quarters.orchards_id as orchards_id, orchards.orchard as orchard, DATE_FORMAT(quarters.created, "%d-%m-%Y %H:%i:%s") as created, DATE_FORMAT(quarters.modified, "%d-%m-%Y %H:%i:%s") as modified');

		$this->db->join('orchards','orchards.id = quarters.orchards_id');

		$this->db->like('quarters.id', $search);
		$this->db->or_like('quarters.number', $search);
		$this->db->or_like('quarters.quarter', $search);
		$this->db->or_like('orchards.orchard', $search);

		if ($by == 0)
			$this->db->order_by('quarters.id', $order);
		else if($by == 1)
			$this->db->order_by('quarters.number', $order);
		else if($by == 2)
			$this->db->order_by('quarters.quarter', $order);
		else
			$this->db->order_by('orchards.orchard', $order);

		$this->db->limit($length, $start);
		$query = $this->db->get('quarters');

		$retornar = array(
			'datos' => $query->result()
		);

		return $retornar;
	}

	public function getCount()
	{
		return $this->db->count_all('quarters');
	}

	public function getCountSearch($search, $start, $length, $order, $by)
	{
		$this->db->select('quarters.id');

		$this->db->join('orchards','orchards.id = quarters.orchards_id');

		$this->db->like('quarters.id', $search);
		$this->db->or_like('quarters.number', $search);
		$this->db->or_like('quarters.quarter', $search);
		$this->db->or_like('orchards.orchard', $search);

		$query = $this->db->get('quarters')->num_rows();
		return $query;
	}
	//Crud
	public function addQuarter($data)
	{
		if($this->db->insert('quarters', $data))
			return $this->db->insert_id();
		else
			return false;
	}

	public function editQuarter($data, $id)
	{
		$this->db->where('id', $id);
		if($this->db->update('quarters', $data))
			return true;
		else
			return false;
	}

	public function deleteQuarter($id)
	{
		$this->db->where('id', $id);
		if($this->db->delete('quarters'))
		{
			$this->db->where('quarters_id', $id);
			if($this->db->delete('quarter_product'))
				return true;
			else
				return false;
		}
		else
			return false;
	}

	//aux
	public function getOrchards()
	{
		$this->db->select('id, orchard');
		$this->db->from('orchards');
		$this->db->order_by('orchard','asc');
		return $this->db->get()->result();
	}

	public function getProducts()
	{
		$this->db->select('products.id as id, products.product as product, varieties.variety as variety');
		$this->db->from('products');
		$this->db->join('varieties','varieties.id = products.varieties_id');
		$this->db->order_by('products.product','asc');
		return $this->db->get()->result();
	}
	//------------- corrección 1 CUARTEL ... N PRODUCTOS---------------------
	public function getProducts_Quarter($quarters_id)
	{
		$this->db->select('products.id as id, products.product as product, varieties.variety as variety');
		$this->db->from('products');

		$this->db->join('varieties','varieties.id = products.varieties_id');
		$this->db->join('quarter_product','quarter_product.products_id = products.id');
		$this->db->where('quarter_product.quarters_id', $quarters_id);

		$this->db->order_by('products.product','asc');
		return $this->db->get()->result_array();
	}

	public function addQuarter_Product($data)
	{
		if($this->db->insert('quarter_product', $data))
			return true;
		else
			return false;
	}

	public function deleteQuarters_Product($id)
	{
		$this->db->where('quarters_id', $id);
		if($this->db->delete('quarter_product'))
			return true;
		else
			return false;
	}
}

?>