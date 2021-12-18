<?php

class MControl extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	public function getOrchards()
	{
		$this->db->select('id, orchard');
		$this->db->from('orchards');
		$this->db->order_by('orchard', 'asc');

		return $this->db->get()->result_array();
	}

	public function getQuarters($orchards_id)
	{
		$this->db->select('id, quarter');
		$this->db->from('quarters');
		$this->db->where('orchards_id', $orchards_id);
		$this->db->order_by('quarter', 'asc');

		return $this->db->get()->result_array();
	}

	public function getProduct($id)
	{
		$this->db->select('products.id as id, products.product as product, varieties.variety as variety');
		$this->db->from('products');
		$this->db->join('varieties', 'varieties.id = products.varieties_id');
		$this->db->where('products.id' ,$id);
		$this->db->limit(1);

		return $this->db->get()->result_array();
	}

	public function getContainer($products_id)
	{
		$this->db->select('containers.id as id, containers.container as container, containers.weight as weight, containers.value_payment as value_payment, containers.value_sale as value_sale, units.unit as unit, units.acronym as acronym');
		$this->db->from('containers');
		$this->db->join('units', 'units.id = containers.units_id');
		$this->db->where('products_id', $products_id);
		$this->db->limit(1);

		return $this->db->get()->result_array();
	}

	public function getPeople($rut)
	{
		$this->db->select('id, rut, dv, name, lastname');
		$this->db->from('people');
		$this->db->where('rut', $rut);
		$this->db->limit(1);

		return $this->db->get()->result_array();
	}

	public function getPeople_($id)
	{
		$this->db->select('id, rut, dv, name, lastname, people_states_id');
		$this->db->from('people');
		$this->db->where('id', $id);
		$this->db->limit(1);

		return $this->db->get()->result_array();
	}

	public function getProcess()
	{
		$this->db->select('id, process');
		$this->db->from('process');
		$this->db->order_by('process', 'asc');

		return $this->db->get()->result_array();
	}

	public function addProduction($data)
	{
		if($this->db->insert('production', $data))
			return $this->db->insert_id();
		else
			return false;
	}

	public function getProductionDayPeople($people_id, $date)
	{
		$this->db->select_sum('quantity');
		$this->db->from('production');
		$this->db->where('people_id', $people_id);
		$this->db->where('DATE(date)', $date);
		$this->db->limit(1);

		return $this->db->get()->result_array();
	} 

}

?>