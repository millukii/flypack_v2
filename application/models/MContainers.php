<?php

class MContainers extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	public function getContainers($start, $length, $search, $order, $by)
	{
		$retornar = array();
		if ($search) {
			$busca = $this->getSearchContainers($search, $start, $length, $order, $by);
			$retornar['numDataFilter'] = $this->getCountSearch($search, $start, $length, $order, $by);
			$retornar['data'] = $busca['datos'];
		}
		else {
			$todo = $this->getAllContainers($start, $length, $order, $by);
			$retornar['numDataFilter'] = $this->getCount();
			$retornar['data'] = $todo['datos'];
		}

		$retornar['numDataTotal'] = $this->getCount();

		return $retornar;
	}

	public function getContainer($id) {
		$this->db->select('containers.id as id, containers.container as container, containers.products_id as products_id, containers.weight as weight, containers.units_id as units_id, containers.value_payment as value_payment, containers.value_sale as value_sale, products.product as product, varieties.variety as variety, units.unit as unit, units.acronym as acronym, DATE_FORMAT(containers.created, "%d-%m-%Y %H:%i:%s") as created, DATE_FORMAT(containers.modified, "%d-%m-%Y %H:%i:%s") as modified');

		$this->db->join('units','units.id = containers.units_id');
		$this->db->join('products','products.id = containers.products_id');
		$this->db->join('varieties','varieties.id = products.varieties_id');

		$this->db->from('containers');
		$this->db->where('containers.id', $id);
		$this->db->limit(1);

		return $this->db->get()->result_array();
	}

	// Funciones auxiliares datatable
	public function getAllContainers($start, $length, $order, $by) {
		$this->db->select('containers.id as id, containers.container as container, containers.products_id as products_id, containers.weight as weight, containers.units_id as units_id, containers.value_payment as value_payment, containers.value_sale as value_sale, products.product as product, varieties.variety as variety, units.unit as unit, units.acronym as acronym, DATE_FORMAT(containers.created, "%d-%m-%Y %H:%i:%s") as created, DATE_FORMAT(containers.modified, "%d-%m-%Y %H:%i:%s") as modified');

		$this->db->join('units','units.id = containers.units_id');
		$this->db->join('products','products.id = containers.products_id');
		$this->db->join('varieties','varieties.id = products.varieties_id');

		switch ($by)
		{
			case 0:
				$this->db->order_by('containers.id', $order);
				break;
			case 1:
				$this->db->order_by('containers.container', $order);
				break;
			case 2:
				$this->db->order_by('products.product', $order);
				break;
		}

		$this->db->limit($length, $start);
		$query = $this->db->get('containers');

		$retornar = array(
			'datos' => $query->result()
		);
		return $retornar;
	}

	public function getSearchContainers($search, $start, $length, $order, $by) {
		$this->db->select('containers.id as id, containers.container as container, containers.products_id as products_id, containers.weight as weight, containers.units_id as units_id, containers.value_payment as value_payment, containers.value_sale as value_sale, products.product as product, varieties.variety as variety, units.unit as unit, units.acronym as acronym, DATE_FORMAT(containers.created, "%d-%m-%Y %H:%i:%s") as created, DATE_FORMAT(containers.modified, "%d-%m-%Y %H:%i:%s") as modified');

		$this->db->join('units','units.id = containers.units_id');
		$this->db->join('products','products.id = containers.products_id');
		$this->db->join('varieties','varieties.id = products.varieties_id');

		$this->db->like('containers.id', $search);
		$this->db->or_like('containers.container', $search);
		$this->db->or_like('products.product', $search);

		switch ($by)
		{
			case 0:
				$this->db->order_by('containers.id', $order);
				break;
			case 1:
				$this->db->order_by('containers.container', $order);
				break;
			case 2:
				$this->db->order_by('products.product', $order);
				break;
		}

		$this->db->limit($length, $start);
		$query = $this->db->get('containers');

		$retornar = array(
			'datos' => $query->result()
		);
		return $retornar;
	}

	public function getCount() {
		return $this->db->count_all('containers');
	}

	public function getCountSearch($search, $start, $length, $order, $by) {
		$this->db->select('containers.id');

		$this->db->join('units','units.id = containers.units_id');
		$this->db->join('products','products.id = containers.products_id');
		$this->db->join('varieties','varieties.id = products.varieties_id');

		$this->db->like('containers.id', $search);
		$this->db->or_like('containers.container', $search);
		$this->db->or_like('products.product', $search);

		$query = $this->db->get('containers')->num_rows();
		return $query;
	}
	//
	//Crud
	public function addContainer($data)
	{
		if($this->db->insert('containers', $data))
			return true;
		else
			return false;
	}

	public function editContainer($data, $id)
	{
		$this->db->where('id', $id);
		if($this->db->update('containers', $data))
			return true;
		else
			return false;
	}

	public function deleteContainer($id)
	{
		$this->db->where('id', $id);
		if($this->db->delete('containers'))
			return true;
		else
			return false;
	}
	//FUNCTION AUXILIARES
	public function getProducts()
	{
		$this->db->select('products.id as id, products.product as product, varieties.variety as variety');
		$this->db->join('varieties','varieties.id = products.varieties_id');
		$this->db->from('products');
		$this->db->order_by('products.product');

		return $this->db->get()->result();
	}

	public function getUnits()
	{
		$this->db->select('id, unit, acronym');
		$this->db->from('units');
		$this->db->order_by('unit');

		return $this->db->get()->result();
	}

}

?>