<?php

class MProduction extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	//DATA TABLE
	public function getProductions($start, $length, $search, $order, $by)
	{
		$retornar = array();
		if ($search) {
			$busca = $this->getSearchProductions($search, $start, $length, $order, $by);
			$retornar['numDataFilter'] = $this->getCountSearch($search, $start, $length, $order, $by);
			$retornar['data'] = $busca['datos'];
		}
		else {
			$todo = $this->getAllProductions($start, $length, $order, $by);
			$retornar['numDataFilter'] = $this->getCount();
			$retornar['data'] = $todo['datos'];
		}

		$retornar['numDataTotal'] = $this->getCount();

		return $retornar;
	}

	public function getAllProductions($start, $length, $order, $by)
	{
		$this->db->select('production.id as id, production.quantity as quantity, production.containers_id as containers_id, production.products_id as products_id, production.people_id as people_id, production.process_id as process_id, production.quarters_id as quarters_id, production.controller_id as controller_id, production.value_payment as value_payment, production.value_sale as value_sale, DATE_FORMAT(production.date, "%d-%m-%Y %H:%i:%s") as date, containers.container as container, containers.weight as weight, units.acronym as acronym, products.product as product, varieties.variety as variety, people.name as name, people.lastname as lastname, people.rut as rut, people.dv as dv, process.process as process, quarters.quarter as quarter, orchards.orchard as orchard');

		$this->db->join('containers','containers.id = production.containers_id');
		$this->db->join('units','units.id = containers.units_id');
		$this->db->join('products','products.id = production.products_id');
		$this->db->join('varieties','varieties.id = products.varieties_id');
		$this->db->join('people','people.id = production.people_id');
		$this->db->join('process','process.id = production.process_id');
		$this->db->join('quarters','quarters.id = production.quarters_id');
		$this->db->join('orchards','orchards.id = quarters.orchards_id');

		switch ($by)
		{
			case 0:
				$this->db->order_by('production.id', $order);
				break;
			case 1:
				$this->db->order_by('production.quantity', $order);
				break;
			case 2:
				$this->db->order_by('containers.container', $order);
				break;
			case 3:
				$this->db->order_by('products.product', $order);
				break;
			case 4:
				$this->db->order_by('people.rut', $order);
				break;
			case 5:
				$this->db->order_by('process.process', $order);
				break;
			case 6:
				$this->db->order_by('orchards.orchard', $order);
				break;
			case 7:
				$this->db->order_by('quarters.quarter', $order);
				break;
		}

		$this->db->limit($length, $start);
		$query = $this->db->get('production');

		$retornar = array(
			'datos' => $query->result()
		);
		return $retornar;
	}

	public function getSearchProductions($search, $start, $length, $order, $by)
	{
		$this->db->select('production.id as id, production.quantity as quantity, production.containers_id as containers_id, production.products_id as products_id, production.people_id as people_id, production.process_id as process_id, production.quarters_id as quarters_id, production.controller_id as controller_id, production.value_payment as value_payment, production.value_sale as value_sale, DATE_FORMAT(production.date, "%d-%m-%Y %H:%i:%s") as date, containers.container as container, containers.weight as weight, units.acronym as acronym, products.product as product, varieties.variety as variety, people.name as name, people.lastname as lastname, people.rut as rut, people.dv as dv, process.process as process, quarters.quarter as quarter, orchards.orchard as orchard');

		$this->db->join('containers','containers.id = production.containers_id');
		$this->db->join('units','units.id = containers.units_id');
		$this->db->join('products','products.id = production.products_id');
		$this->db->join('varieties','varieties.id = products.varieties_id');
		$this->db->join('people','people.id = production.people_id');
		$this->db->join('process','process.id = production.process_id');
		$this->db->join('quarters','quarters.id = production.quarters_id');
		$this->db->join('orchards','orchards.id = quarters.orchards_id');

		$this->db->like('production.id', $search);
		$this->db->or_like('production.quantity', $search);
		$this->db->or_like('containers.container', $search);
		$this->db->or_like('products.product', $search);
		$this->db->or_like('people.rut', $search);
		$this->db->or_like('process.process', $search);
		$this->db->or_like('orchards.orchard', $search);
		$this->db->or_like('quarters.quarter', $search);

		switch ($by)
		{
			case 0:
				$this->db->order_by('production.id', $order);
				break;
			case 1:
				$this->db->order_by('production.quantity', $order);
				break;
			case 2:
				$this->db->order_by('containers.container', $order);
				break;
			case 3:
				$this->db->order_by('products.product', $order);
				break;
			case 4:
				$this->db->order_by('people.rut', $order);
				break;
			case 5:
				$this->db->order_by('process.process', $order);
				break;
			case 6:
				$this->db->order_by('orchards.orchard', $order);
				break;
			case 7:
				$this->db->order_by('quarters.quarter', $order);
				break;
		}

		$this->db->limit($length, $start);
		$query = $this->db->get('production');

		$retornar = array(
			'datos' => $query->result()
		);
		return $retornar;
	}

	public function getCount()
	{
		return $this->db->count_all('production');
	}

	public function getCountSearch($search, $start, $length, $order, $by)
	{
		$this->db->select('production.id');

		$this->db->join('containers','containers.id = production.containers_id');
		$this->db->join('units','units.id = containers.units_id');
		$this->db->join('products','products.id = production.products_id');
		$this->db->join('varieties','varieties.id = products.varieties_id');
		$this->db->join('people','people.id = production.people_id');
		$this->db->join('process','process.id = production.process_id');
		$this->db->join('quarters','quarters.id = production.quarters_id');
		$this->db->join('orchards','orchards.id = quarters.orchards_id');
		
		$this->db->like('production.id', $search);
		$this->db->or_like('production.quantity', $search);
		$this->db->or_like('containers.container', $search);
		$this->db->or_like('products.product', $search);
		$this->db->or_like('people.rut', $search);
		$this->db->or_like('process.process', $search);
		$this->db->or_like('orchards.orchard', $search);
		$this->db->or_like('quarters.quarter', $search);

		$query = $this->db->get('production')->num_rows();
		return $query;
	}

	public function getProduction($id)
	{
		$this->db->select('production.id as id, production.quantity as quantity, production.containers_id as containers_id, production.products_id as products_id, production.people_id as people_id, production.process_id as process_id, production.quarters_id as quarters_id, production.controller_id as controller_id, production.value_payment as value_payment, production.value_sale as value_sale, DATE_FORMAT(production.date, "%d-%m-%Y %H:%i:%s") as date, containers.container as container, containers.weight as weight, units.acronym as acronym, products.product as product, varieties.variety as variety, people.name as name, people.lastname as lastname, people.rut as rut, people.dv as dv, process.process as process, quarters.quarter as quarter, orchards.orchard as orchard');

		$this->db->join('containers','containers.id = production.containers_id');
		$this->db->join('units','units.id = containers.units_id');
		$this->db->join('products','products.id = production.products_id');
		$this->db->join('varieties','varieties.id = products.varieties_id');
		$this->db->join('people','people.id = production.people_id');
		$this->db->join('process','process.id = production.process_id');
		$this->db->join('quarters','quarters.id = production.quarters_id');
		$this->db->join('orchards','orchards.id = quarters.orchards_id');
		$this->db->from('production');
		$this->db->where('production.id', $id);
		$this->db->limit(1);

		return $this->db->get()->result_array();
	}

	public function deleteProduction($id)
	{
		$this->db->where('id', $id);
		if($this->db->delete('production'))
			return true;
		else
			return false;
	}
	//----------------------------------------
	public function getOrchards()
	{
		$this->db->select('id, orchard');
        $this->db->from('orchards');
        $this->db->order_by('orchard');
        return $this->db->get()->result_array();
	}

	public function getQuarters()
	{
		$this->db->select('quarters.id as id, quarters.quarter as quarter, orchards.orchard as orchard');
        $this->db->join('orchards','orchards.id = quarters.orchards_id');
        $this->db->from('quarters');
        $this->db->order_by('quarters.quarter');
        return $this->db->get()->result_array();
	}

	public function getPeople()
	{
		$this->db->select('id, rut, dv, name, lastname');
        $this->db->from('people');
        $this->db->order_by('rut');
        return $this->db->get()->result_array();
	}

	public function getProducts()
	{
		$this->db->select('products.id as id, products.product as product, varieties.variety');
		$this->db->join('varieties','varieties.id = products.varieties_id');
        $this->db->from('products');
        $this->db->order_by('products.product');
        return $this->db->get()->result_array();
	}
	// reports--------------

	public function getReportDate($date, $type, $id)
	{
		
		if($type == 1)
		{
			$this->db->select('people.contractor as contractor, SUM(production.quantity) as quantity, production.value_payment as value_payment,  containers.container as container, containers.weight as weight, units.acronym as acronym, products.product as product, varieties.variety as variety, people.name as name, people.lastname as lastname, people.rut as rut, people.dv as dv, process.process as process, quarters.quarter as quarter, orchards.orchard as orchard, (SUM(production.quantity) * production.value_payment) as payment_');

			$this->db->join('containers','containers.id = production.containers_id');
			$this->db->join('units','units.id = containers.units_id');
			$this->db->join('products','products.id = production.products_id');
			$this->db->join('varieties','varieties.id = products.varieties_id');
			$this->db->join('people','people.id = production.people_id');
			$this->db->join('process','process.id = production.process_id');
			$this->db->join('quarters','quarters.id = production.quarters_id');
			$this->db->join('orchards','orchards.id = quarters.orchards_id');

			$this->db->from('production');

			$this->db->where('orchards.id', $id);
			$this->db->where('DATE(production.date)', $date);

			$this->db->group_by('production.people_id');
			$this->db->group_by('production.products_id');

			$this->db->order_by('people.rut', 'asc');

			return $this->db->get()->result_array();
		}
		else if($type == 2)
		{
			$this->db->select('people.contractor as contractor, SUM(production.quantity) as quantity, production.value_payment as value_payment,  containers.container as container, containers.weight as weight, units.acronym as acronym, products.product as product, varieties.variety as variety, people.name as name, people.lastname as lastname, people.rut as rut, people.dv as dv, process.process as process, quarters.quarter as quarter, orchards.orchard as orchard, (SUM(production.quantity) * production.value_payment) as payment_');

			$this->db->join('containers','containers.id = production.containers_id');
			$this->db->join('units','units.id = containers.units_id');
			$this->db->join('products','products.id = production.products_id');
			$this->db->join('varieties','varieties.id = products.varieties_id');
			$this->db->join('people','people.id = production.people_id');
			$this->db->join('process','process.id = production.process_id');
			$this->db->join('quarters','quarters.id = production.quarters_id');
			$this->db->join('orchards','orchards.id = quarters.orchards_id');

			$this->db->from('production');

			$this->db->where('quarters.id', $id);
			$this->db->where('DATE(production.date)', $date);

			$this->db->group_by('production.people_id');
			$this->db->group_by('production.products_id');

			$this->db->order_by('people.rut', 'asc');

			return $this->db->get()->result_array();
		}
		else if($type == 3)
		{
			$this->db->select('people.contractor as contractor, SUM(production.quantity) as quantity, production.value_payment as value_payment,  containers.container as container, containers.weight as weight, units.acronym as acronym, products.product as product, varieties.variety as variety, people.name as name, people.lastname as lastname, people.rut as rut, people.dv as dv, process.process as process, quarters.quarter as quarter, orchards.orchard as orchard, (SUM(production.quantity) * production.value_payment) as payment_');

			$this->db->join('containers','containers.id = production.containers_id');
			$this->db->join('units','units.id = containers.units_id');
			$this->db->join('products','products.id = production.products_id');
			$this->db->join('varieties','varieties.id = products.varieties_id');
			$this->db->join('people','people.id = production.people_id');
			$this->db->join('process','process.id = production.process_id');
			$this->db->join('quarters','quarters.id = production.quarters_id');
			$this->db->join('orchards','orchards.id = quarters.orchards_id');

			$this->db->from('production');

			$this->db->where('people.id', $id);
			$this->db->where('DATE(production.date)', $date);

			$this->db->group_by('production.people_id');
			$this->db->group_by('production.products_id');

			$this->db->order_by('people.rut', 'asc');

			return $this->db->get()->result_array();
		}
		else if($type == 4)
		{
			$this->db->select('people.contractor as contractor, SUM(production.quantity) as quantity, production.value_payment as value_payment,  containers.container as container, containers.weight as weight, units.acronym as acronym, products.product as product, varieties.variety as variety, people.name as name, people.lastname as lastname, people.rut as rut, people.dv as dv, process.process as process, quarters.quarter as quarter, orchards.orchard as orchard, (SUM(production.quantity) * production.value_payment) as payment_');

			$this->db->join('containers','containers.id = production.containers_id');
			$this->db->join('units','units.id = containers.units_id');
			$this->db->join('products','products.id = production.products_id');
			$this->db->join('varieties','varieties.id = products.varieties_id');
			$this->db->join('people','people.id = production.people_id');
			$this->db->join('process','process.id = production.process_id');
			$this->db->join('quarters','quarters.id = production.quarters_id');
			$this->db->join('orchards','orchards.id = quarters.orchards_id');

			$this->db->from('production');

			$this->db->where('products.id', $id);
			$this->db->where('DATE(production.date)', $date);

			$this->db->group_by('production.people_id');
			$this->db->group_by('production.products_id');

			$this->db->order_by('people.rut', 'asc');

			return $this->db->get()->result_array();
		}
		else if($type == 5)
		{
			$this->db->select('people.contractor as contractor, SUM(production.quantity) as quantity, production.value_payment as value_payment,  containers.container as container, containers.weight as weight, units.acronym as acronym, products.product as product, varieties.variety as variety, people.name as name, people.lastname as lastname, people.rut as rut, people.dv as dv, process.process as process, quarters.quarter as quarter, orchards.orchard as orchard, (SUM(production.quantity) * production.value_payment) as payment_');

			$this->db->join('containers','containers.id = production.containers_id');
			$this->db->join('units','units.id = containers.units_id');
			$this->db->join('products','products.id = production.products_id');
			$this->db->join('varieties','varieties.id = products.varieties_id');
			$this->db->join('people','people.id = production.people_id');
			$this->db->join('process','process.id = production.process_id');
			$this->db->join('quarters','quarters.id = production.quarters_id');
			$this->db->join('orchards','orchards.id = quarters.orchards_id');

			$this->db->from('production');

			$this->db->where('people.contractor', $id);
			$this->db->where('DATE(production.date)', $date);

			$this->db->group_by('production.people_id');
			$this->db->group_by('production.products_id');

			$this->db->order_by('people.rut', 'asc');

			return $this->db->get()->result_array();
		}
	}

	public function getReportInterval($init, $end, $type, $id)
	{
		if($type == 1)
		{
			$this->db->select('people.contractor as contractor, SUM(production.quantity) as quantity, production.value_payment as value_payment,  containers.container as container, containers.weight as weight, units.acronym as acronym, products.product as product, varieties.variety as variety, people.name as name, people.lastname as lastname, people.rut as rut, people.dv as dv, process.process as process, quarters.quarter as quarter, orchards.orchard as orchard, (SUM(production.quantity) * production.value_payment) as payment_');

			$this->db->join('containers','containers.id = production.containers_id');
			$this->db->join('units','units.id = containers.units_id');
			$this->db->join('products','products.id = production.products_id');
			$this->db->join('varieties','varieties.id = products.varieties_id');
			$this->db->join('people','people.id = production.people_id');
			$this->db->join('process','process.id = production.process_id');
			$this->db->join('quarters','quarters.id = production.quarters_id');
			$this->db->join('orchards','orchards.id = quarters.orchards_id');

			$this->db->from('production');

			$this->db->where('orchards.id', $id);

			$this->db->where('DATE(production.date) >= ', $init);
			$this->db->where('DATE(production.date) <= ', $end);

			$this->db->group_by('production.people_id');
			$this->db->group_by('production.products_id');

			$this->db->order_by('people.rut', 'asc');

			return $this->db->get()->result_array();
		}
		else if($type == 2)
		{
			$this->db->select('people.contractor as contractor, SUM(production.quantity) as quantity, production.value_payment as value_payment,  containers.container as container, containers.weight as weight, units.acronym as acronym, products.product as product, varieties.variety as variety, people.name as name, people.lastname as lastname, people.rut as rut, people.dv as dv, process.process as process, quarters.quarter as quarter, orchards.orchard as orchard, (SUM(production.quantity) * production.value_payment) as payment_');

			$this->db->join('containers','containers.id = production.containers_id');
			$this->db->join('units','units.id = containers.units_id');
			$this->db->join('products','products.id = production.products_id');
			$this->db->join('varieties','varieties.id = products.varieties_id');
			$this->db->join('people','people.id = production.people_id');
			$this->db->join('process','process.id = production.process_id');
			$this->db->join('quarters','quarters.id = production.quarters_id');
			$this->db->join('orchards','orchards.id = quarters.orchards_id');

			$this->db->from('production');

			$this->db->where('quarters.id', $id);

			$this->db->where('DATE(production.date) >= ', $init);
			$this->db->where('DATE(production.date) <= ', $end);

			$this->db->group_by('production.people_id');
			$this->db->group_by('production.products_id');

			$this->db->order_by('people.rut', 'asc');

			return $this->db->get()->result_array();
		}
		else if($type == 3)
		{
			$this->db->select('people.contractor as contractor, SUM(production.quantity) as quantity, production.value_payment as value_payment,  containers.container as container, containers.weight as weight, units.acronym as acronym, products.product as product, varieties.variety as variety, people.name as name, people.lastname as lastname, people.rut as rut, people.dv as dv, process.process as process, quarters.quarter as quarter, orchards.orchard as orchard, (SUM(production.quantity) * production.value_payment) as payment_');

			$this->db->join('containers','containers.id = production.containers_id');
			$this->db->join('units','units.id = containers.units_id');
			$this->db->join('products','products.id = production.products_id');
			$this->db->join('varieties','varieties.id = products.varieties_id');
			$this->db->join('people','people.id = production.people_id');
			$this->db->join('process','process.id = production.process_id');
			$this->db->join('quarters','quarters.id = production.quarters_id');
			$this->db->join('orchards','orchards.id = quarters.orchards_id');

			$this->db->from('production');

			$this->db->where('people.id', $id);

			$this->db->where('DATE(production.date) >= ', $init);
			$this->db->where('DATE(production.date) <= ', $end);

			$this->db->group_by('production.people_id');
			$this->db->group_by('production.products_id');

			$this->db->order_by('people.rut', 'asc');

			return $this->db->get()->result_array();
		}
		else if($type == 4)
		{
			$this->db->select('people.contractor as contractor, SUM(production.quantity) as quantity, production.value_payment as value_payment,  containers.container as container, containers.weight as weight, units.acronym as acronym, products.product as product, varieties.variety as variety, people.name as name, people.lastname as lastname, people.rut as rut, people.dv as dv, process.process as process, quarters.quarter as quarter, orchards.orchard as orchard, (SUM(production.quantity) * production.value_payment) as payment_');

			$this->db->join('containers','containers.id = production.containers_id');
			$this->db->join('units','units.id = containers.units_id');
			$this->db->join('products','products.id = production.products_id');
			$this->db->join('varieties','varieties.id = products.varieties_id');
			$this->db->join('people','people.id = production.people_id');
			$this->db->join('process','process.id = production.process_id');
			$this->db->join('quarters','quarters.id = production.quarters_id');
			$this->db->join('orchards','orchards.id = quarters.orchards_id');

			$this->db->from('production');

			$this->db->where('products.id', $id);

			$this->db->where('DATE(production.date) >= ', $init);
			$this->db->where('DATE(production.date) <= ', $end);

			$this->db->group_by('production.people_id');
			$this->db->group_by('production.products_id');

			$this->db->order_by('people.rut', 'asc');

			return $this->db->get()->result_array();
		}
		else if($type == 5)
		{
			$this->db->select('people.contractor as contractor, SUM(production.quantity) as quantity, production.value_payment as value_payment,  containers.container as container, containers.weight as weight, units.acronym as acronym, products.product as product, varieties.variety as variety, people.name as name, people.lastname as lastname, people.rut as rut, people.dv as dv, process.process as process, quarters.quarter as quarter, orchards.orchard as orchard, (SUM(production.quantity) * production.value_payment) as payment_');

			$this->db->join('containers','containers.id = production.containers_id');
			$this->db->join('units','units.id = containers.units_id');
			$this->db->join('products','products.id = production.products_id');
			$this->db->join('varieties','varieties.id = products.varieties_id');
			$this->db->join('people','people.id = production.people_id');
			$this->db->join('process','process.id = production.process_id');
			$this->db->join('quarters','quarters.id = production.quarters_id');
			$this->db->join('orchards','orchards.id = quarters.orchards_id');

			$this->db->from('production');

			$this->db->where('people.contractor', $id);

			$this->db->where('DATE(production.date) >= ', $init);
			$this->db->where('DATE(production.date) <= ', $end);

			$this->db->group_by('production.people_id');
			$this->db->group_by('production.products_id');

			$this->db->order_by('people.rut', 'asc');

			return $this->db->get()->result_array();
		}
	}

	public function getReportYearMonth($year, $month, $type, $id)
	{
		$init = $year.'-'.$month.'-01 00:00:00';
		$end = $year.'-'.$month.'-31 23:59:59';
		
		if($type == 1)
		{
			$this->db->select('people.contractor as contractor, SUM(production.quantity) as quantity, production.value_payment as value_payment,  containers.container as container, containers.weight as weight, units.acronym as acronym, products.product as product, varieties.variety as variety, people.name as name, people.lastname as lastname, people.rut as rut, people.dv as dv, process.process as process, quarters.quarter as quarter, orchards.orchard as orchard, (SUM(production.quantity) * production.value_payment) as payment_');

			$this->db->join('containers','containers.id = production.containers_id');
			$this->db->join('units','units.id = containers.units_id');
			$this->db->join('products','products.id = production.products_id');
			$this->db->join('varieties','varieties.id = products.varieties_id');
			$this->db->join('people','people.id = production.people_id');
			$this->db->join('process','process.id = production.process_id');
			$this->db->join('quarters','quarters.id = production.quarters_id');
			$this->db->join('orchards','orchards.id = quarters.orchards_id');

			$this->db->from('production');

			$this->db->where('orchards.id', $id);

			$this->db->where('DATE(production.date) >= ', $init);
			$this->db->where('DATE(production.date) <= ', $end);

			$this->db->group_by('production.people_id');
			$this->db->group_by('production.products_id');

			$this->db->order_by('people.rut', 'asc');

			return $this->db->get()->result_array();
		}
		else if($type == 2)
		{
			$this->db->select('people.contractor as contractor, SUM(production.quantity) as quantity, production.value_payment as value_payment,  containers.container as container, containers.weight as weight, units.acronym as acronym, products.product as product, varieties.variety as variety, people.name as name, people.lastname as lastname, people.rut as rut, people.dv as dv, process.process as process, quarters.quarter as quarter, orchards.orchard as orchard, (SUM(production.quantity) * production.value_payment) as payment_');

			$this->db->join('containers','containers.id = production.containers_id');
			$this->db->join('units','units.id = containers.units_id');
			$this->db->join('products','products.id = production.products_id');
			$this->db->join('varieties','varieties.id = products.varieties_id');
			$this->db->join('people','people.id = production.people_id');
			$this->db->join('process','process.id = production.process_id');
			$this->db->join('quarters','quarters.id = production.quarters_id');
			$this->db->join('orchards','orchards.id = quarters.orchards_id');

			$this->db->from('production');

			$this->db->where('quarters.id', $id);

			$this->db->where('DATE(production.date) >= ', $init);
			$this->db->where('DATE(production.date) <= ', $end);

			$this->db->group_by('production.people_id');
			$this->db->group_by('production.products_id');

			$this->db->order_by('people.rut', 'asc');

			return $this->db->get()->result_array();
		}
		else if($type == 3)
		{
			$this->db->select('people.contractor as contractor, SUM(production.quantity) as quantity, production.value_payment as value_payment,  containers.container as container, containers.weight as weight, units.acronym as acronym, products.product as product, varieties.variety as variety, people.name as name, people.lastname as lastname, people.rut as rut, people.dv as dv, process.process as process, quarters.quarter as quarter, orchards.orchard as orchard, (SUM(production.quantity) * production.value_payment) as payment_');

			$this->db->join('containers','containers.id = production.containers_id');
			$this->db->join('units','units.id = containers.units_id');
			$this->db->join('products','products.id = production.products_id');
			$this->db->join('varieties','varieties.id = products.varieties_id');
			$this->db->join('people','people.id = production.people_id');
			$this->db->join('process','process.id = production.process_id');
			$this->db->join('quarters','quarters.id = production.quarters_id');
			$this->db->join('orchards','orchards.id = quarters.orchards_id');

			$this->db->from('production');

			$this->db->where('people.id', $id);

			$this->db->where('DATE(production.date) >= ', $init);
			$this->db->where('DATE(production.date) <= ', $end);

			$this->db->group_by('production.people_id');
			$this->db->group_by('production.products_id');

			$this->db->order_by('people.rut', 'asc');

			return $this->db->get()->result_array();
		}
		else if($type == 4)
		{
			$this->db->select('people.contractor as contractor, SUM(production.quantity) as quantity, production.value_payment as value_payment,  containers.container as container, containers.weight as weight, units.acronym as acronym, products.product as product, varieties.variety as variety, people.name as name, people.lastname as lastname, people.rut as rut, people.dv as dv, process.process as process, quarters.quarter as quarter, orchards.orchard as orchard, (SUM(production.quantity) * production.value_payment) as payment_');

			$this->db->join('containers','containers.id = production.containers_id');
			$this->db->join('units','units.id = containers.units_id');
			$this->db->join('products','products.id = production.products_id');
			$this->db->join('varieties','varieties.id = products.varieties_id');
			$this->db->join('people','people.id = production.people_id');
			$this->db->join('process','process.id = production.process_id');
			$this->db->join('quarters','quarters.id = production.quarters_id');
			$this->db->join('orchards','orchards.id = quarters.orchards_id');

			$this->db->from('production');

			$this->db->where('products.id', $id);

			$this->db->where('DATE(production.date) >= ', $init);
			$this->db->where('DATE(production.date) <= ', $end);

			$this->db->group_by('production.people_id');
			$this->db->group_by('production.products_id');

			$this->db->order_by('people.rut', 'asc');

			return $this->db->get()->result_array();
		}
		else if($type == 5)
		{
			$this->db->select('people.contractor as contractor, SUM(production.quantity) as quantity, production.value_payment as value_payment,  containers.container as container, containers.weight as weight, units.acronym as acronym, products.product as product, varieties.variety as variety, people.name as name, people.lastname as lastname, people.rut as rut, people.dv as dv, process.process as process, quarters.quarter as quarter, orchards.orchard as orchard, (SUM(production.quantity) * production.value_payment) as payment_');

			$this->db->join('containers','containers.id = production.containers_id');
			$this->db->join('units','units.id = containers.units_id');
			$this->db->join('products','products.id = production.products_id');
			$this->db->join('varieties','varieties.id = products.varieties_id');
			$this->db->join('people','people.id = production.people_id');
			$this->db->join('process','process.id = production.process_id');
			$this->db->join('quarters','quarters.id = production.quarters_id');
			$this->db->join('orchards','orchards.id = quarters.orchards_id');

			$this->db->from('production');

			$this->db->where('people.contractor', $id);

			$this->db->where('DATE(production.date) >= ', $init);
			$this->db->where('DATE(production.date) <= ', $end);

			$this->db->group_by('production.people_id');
			$this->db->group_by('production.products_id');

			$this->db->order_by('people.rut', 'asc');

			return $this->db->get()->result_array();
		}
	}

	public function getReportYearMonthAsist($year, $month)
	{
		$init = $year.'-'.$month.'-01 00:00:00';
		$end = $year.'-'.$month.'-31 23:59:59';

		$this->db->select('COUNT(people.id) as asist, profiles.profile as profile, people.name as name, people.lastname as lastname, people.rut as rut, people.dv as dv, DATE_FORMAT(production.date, "%d") as day');

		$this->db->from('production');
		$this->db->join('people','people.id = production.people_id');
		$this->db->join('profiles','profiles.id = people.profiles_id');

		$this->db->where('DATE(production.date) >= ', $init);
		$this->db->where('DATE(production.date) <= ', $end);
		//$this->db->where('people.people_states_id', 1);

		$this->db->group_by('people.id');
		$this->db->group_by('DATE(production.date)');

		$this->db->order_by('people.rut', 'asc');
		$this->db->order_by('production.date', 'asc');
		//$this->db->having('quantity_ > 0 ');

		return $this->db->get()->result_array();
	}

	//DATA TABLE RESPONSE
	//DATA TABLE
	public function getResponse($start, $length, $search, $order, $by)
	{
		$retornar = array();
		if ($search) {
			$busca = $this->getSearchResponse($search, $start, $length, $order, $by);
			$retornar['numDataFilter'] = $this->getCountSearch_response($search, $start, $length, $order, $by);
			$retornar['data'] = $busca['datos'];
		}
		else {
			$todo = $this->getAllResponse($start, $length, $order, $by);
			$retornar['numDataFilter'] = $this->getCount_response();
			$retornar['data'] = $todo['datos'];
		}

		$retornar['numDataTotal'] = $this->getCount_response();

		return $retornar;
	}

	public function getAllResponse($start, $length, $order, $by)
	{
		$this->db->select('response.id as id, DATE_FORMAT(response.date, "%d-%m-%Y") as date, products.product as product, varieties.variety as variety, response.weight as weight, response.quantity as quantity, response.w_q as w_q');

		$this->db->join('products','products.id = response.products_id');
		$this->db->join('varieties','varieties.id = products.varieties_id');

		switch ($by)
		{
			case 0:
				$this->db->order_by('response.id', $order);
				break;
			case 1:
				$this->db->order_by('response.date', $order);
				break;
			case 2:
				$this->db->order_by('products.product', $order);
				break;
			case 3:
				$this->db->order_by('response.weight', $order);
				break;
			case 4:
				$this->db->order_by('response.quantity', $order);
				break;
			case 5:
				$this->db->order_by('response.w_q', $order);
				break;
		}

		$this->db->limit($length, $start);
		$query = $this->db->get('response');

		$retornar = array(
			'datos' => $query->result()
		);
		return $retornar;
	}

	public function getSearchResponse($search, $start, $length, $order, $by)
	{
		$this->db->select('response.id as id, DATE_FORMAT(response.date, "%d-%m-%Y") as date, products.product as product, varieties.variety as variety, response.weight as weight, response.quantity as quantity, response.w_q as w_q');

		$this->db->join('products','products.id = response.products_id');
		$this->db->join('varieties','varieties.id = products.varieties_id');

		$this->db->like('response.id', $search);
		$this->db->or_like('response.date', $search);
		$this->db->or_like('products.product', $search);
		$this->db->or_like('response.weight', $search);
		$this->db->or_like('response.quantity', $search);
		$this->db->or_like('response.w_q', $search);

		switch ($by)
		{
			case 0:
				$this->db->order_by('response.id', $order);
				break;
			case 1:
				$this->db->order_by('response.date', $order);
				break;
			case 2:
				$this->db->order_by('products.product', $order);
				break;
			case 3:
				$this->db->order_by('response.weight', $order);
				break;
			case 4:
				$this->db->order_by('response.quantity', $order);
				break;
			case 5:
				$this->db->order_by('response.w_q', $order);
				break;
		}

		$this->db->limit($length, $start);
		$query = $this->db->get('response');

		$retornar = array(
			'datos' => $query->result()
		);
		return $retornar;
	}

	public function getCount_response()
	{
		return $this->db->count_all('response');
	}

	public function getCountSearch_response($search, $start, $length, $order, $by)
	{
		$this->db->select('response.id');

		$this->db->join('products','products.id = response.products_id');
		$this->db->join('varieties','varieties.id = products.varieties_id');

		$this->db->like('response.id', $search);
		$this->db->or_like('response.date', $search);
		$this->db->or_like('products.product', $search);
		$this->db->or_like('response.weight', $search);
		$this->db->or_like('response.quantity', $search);
		$this->db->or_like('response.w_q', $search);


		$query = $this->db->get('response')->num_rows();
		return $query;
	}

	public function getResponse_($id)
	{
		$this->db->select('response.id as id, response.date as date, response.products_id as products_id, response.weight as weight, response.quantity as quantity, response.w_q as w_q');

		$this->db->from('response');

		$this->db->where('response.id', $id);
		$this->db->limit(1);

		return $this->db->get()->result_array();
	}
	//- FIN DATA TABLE RESPONSE

	public function getProductsQuantity($date, $products_id)
	{
		$this->db->select('SUM(production.quantity) as quantity');

		$this->db->from('production');
		
		$this->db->join('products', 'products.id = production.products_id');

		$this->db->where('DATE(production.date)', $date);
		$this->db->where('production.products_id', $products_id);

		$this->db->limit(1);

		$res = $this->db->get()->result_array();

		if(!empty($res[0]['quantity']))
			$res = $res[0]['quantity'];
		else
			$res = 0;

		return $res;
	}

	public function addResponse($data)
	{
		if($this->db->insert('response', $data))
			return true;
		else
			return false;
	}

	public function editResponse($data, $id)
	{
		$this->db->where('id', $id);
		if($this->db->update('response', $data))
			return true;
		else
			return false;
	}

	public function deleteResponse($id)
	{
		$this->db->where('id', $id);
		if($this->db->delete('response'))
			return true;
		else
			return false;
	}

	//----- informe resumen diario por año
	public function generateReportResumenDiario($year, $products_id)
	{
		$this->db->select('response.id as id, DATE_FORMAT(response.date, "%d-%m-%Y") as date, products.product as product, varieties.variety as variety, response.weight as weight, response.quantity as quantity, response.w_q as w_q');

		$this->db->join('products','products.id = response.products_id');
		$this->db->join('varieties','varieties.id = products.varieties_id');

		$this->db->from('response');

		$this->db->where('products.id', $products_id);		
		$this->db->where('response.date >= ', $year.'-01-01');
		$this->db->where('response.date <= ', $year.'-12-31');

		//$this->db->order_by('products.id');

		return $this->db->get()->result_array();

	}

	//27/02/2020

	public function getReportDate_resumen($date, $type, $id)
	{
		
		if($type == 1)
		{
			$this->db->select('people.contractor as contractor, SUM(production.quantity) as quantity, people.name as name, people.lastname as lastname, people.rut as rut, people.dv as dv, SUM((production.quantity * production.value_payment)) as value_payment');

			$this->db->join('containers','containers.id = production.containers_id');
			$this->db->join('units','units.id = containers.units_id');
			$this->db->join('products','products.id = production.products_id');
			$this->db->join('varieties','varieties.id = products.varieties_id');
			$this->db->join('people','people.id = production.people_id');
			$this->db->join('process','process.id = production.process_id');
			$this->db->join('quarters','quarters.id = production.quarters_id');
			$this->db->join('orchards','orchards.id = quarters.orchards_id');

			$this->db->from('production');

			$this->db->where('orchards.id', $id);
			$this->db->where('DATE(production.date)', $date);

			$this->db->group_by('production.people_id');

			$this->db->order_by('people.rut', 'asc');

			return $this->db->get()->result_array();
		}
		else if($type == 2)
		{
			$this->db->select('people.contractor as contractor, SUM(production.quantity) as quantity, people.name as name, people.lastname as lastname, people.rut as rut, people.dv as dv, SUM((production.quantity * production.value_payment)) as value_payment');

			$this->db->join('containers','containers.id = production.containers_id');
			$this->db->join('units','units.id = containers.units_id');
			$this->db->join('products','products.id = production.products_id');
			$this->db->join('varieties','varieties.id = products.varieties_id');
			$this->db->join('people','people.id = production.people_id');
			$this->db->join('process','process.id = production.process_id');
			$this->db->join('quarters','quarters.id = production.quarters_id');
			$this->db->join('orchards','orchards.id = quarters.orchards_id');

			$this->db->from('production');

			$this->db->where('quarters.id', $id);
			$this->db->where('DATE(production.date)', $date);

			$this->db->group_by('production.people_id');

			$this->db->order_by('people.rut', 'asc');

			return $this->db->get()->result_array();
		}
		else if($type == 3)
		{
			$this->db->select('people.contractor as contractor, SUM(production.quantity) as quantity, people.name as name, people.lastname as lastname, people.rut as rut, people.dv as dv, SUM((production.quantity * production.value_payment)) as value_payment');

			$this->db->join('containers','containers.id = production.containers_id');
			$this->db->join('units','units.id = containers.units_id');
			$this->db->join('products','products.id = production.products_id');
			$this->db->join('varieties','varieties.id = products.varieties_id');
			$this->db->join('people','people.id = production.people_id');
			$this->db->join('process','process.id = production.process_id');
			$this->db->join('quarters','quarters.id = production.quarters_id');
			$this->db->join('orchards','orchards.id = quarters.orchards_id');

			$this->db->from('production');

			$this->db->where('people.id', $id);
			$this->db->where('DATE(production.date)', $date);

			$this->db->group_by('production.people_id');

			$this->db->order_by('people.rut', 'asc');

			return $this->db->get()->result_array();
		}
		else if($type == 4)
		{
			$this->db->select('people.contractor as contractor, SUM(production.quantity) as quantity, people.name as name, people.lastname as lastname, people.rut as rut, people.dv as dv, SUM((production.quantity * production.value_payment)) as value_payment');

			$this->db->join('containers','containers.id = production.containers_id');
			$this->db->join('units','units.id = containers.units_id');
			$this->db->join('products','products.id = production.products_id');
			$this->db->join('varieties','varieties.id = products.varieties_id');
			$this->db->join('people','people.id = production.people_id');
			$this->db->join('process','process.id = production.process_id');
			$this->db->join('quarters','quarters.id = production.quarters_id');
			$this->db->join('orchards','orchards.id = quarters.orchards_id');

			$this->db->from('production');

			$this->db->where('products.id', $id);
			$this->db->where('DATE(production.date)', $date);

			$this->db->group_by('production.people_id');

			$this->db->order_by('people.rut', 'asc');

			return $this->db->get()->result_array();
		}
		else if($type == 5)
		{
			$this->db->select('people.contractor as contractor, SUM(production.quantity) as quantity, people.name as name, people.lastname as lastname, people.rut as rut, people.dv as dv, SUM((production.quantity * production.value_payment)) as value_payment');

			$this->db->join('containers','containers.id = production.containers_id');
			$this->db->join('units','units.id = containers.units_id');
			$this->db->join('products','products.id = production.products_id');
			$this->db->join('varieties','varieties.id = products.varieties_id');
			$this->db->join('people','people.id = production.people_id');
			$this->db->join('process','process.id = production.process_id');
			$this->db->join('quarters','quarters.id = production.quarters_id');
			$this->db->join('orchards','orchards.id = quarters.orchards_id');

			$this->db->from('production');

			$this->db->where('people.contractor', $id);
			$this->db->where('DATE(production.date)', $date);

			$this->db->group_by('production.people_id');

			$this->db->order_by('people.rut', 'asc');

			return $this->db->get()->result_array();
		}
	}

	public function getReportInterval_resumen($init, $end, $type, $id)
	{
		if($type == 1)
		{
			$this->db->select('people.contractor as contractor, SUM(production.quantity) as quantity, people.name as name, people.lastname as lastname, people.rut as rut, people.dv as dv, SUM((production.quantity * production.value_payment)) as value_payment');

			$this->db->join('containers','containers.id = production.containers_id');
			$this->db->join('units','units.id = containers.units_id');
			$this->db->join('products','products.id = production.products_id');
			$this->db->join('varieties','varieties.id = products.varieties_id');
			$this->db->join('people','people.id = production.people_id');
			$this->db->join('process','process.id = production.process_id');
			$this->db->join('quarters','quarters.id = production.quarters_id');
			$this->db->join('orchards','orchards.id = quarters.orchards_id');

			$this->db->from('production');

			$this->db->where('orchards.id', $id);

			$this->db->where('DATE(production.date) >= ', $init);
			$this->db->where('DATE(production.date) <= ', $end);

			$this->db->group_by('production.people_id');

			$this->db->order_by('people.rut', 'asc');

			return $this->db->get()->result_array();
		}
		else if($type == 2)
		{
			$this->db->select('people.contractor as contractor, SUM(production.quantity) as quantity, people.name as name, people.lastname as lastname, people.rut as rut, people.dv as dv, SUM((production.quantity * production.value_payment)) as value_payment');

			$this->db->join('containers','containers.id = production.containers_id');
			$this->db->join('units','units.id = containers.units_id');
			$this->db->join('products','products.id = production.products_id');
			$this->db->join('varieties','varieties.id = products.varieties_id');
			$this->db->join('people','people.id = production.people_id');
			$this->db->join('process','process.id = production.process_id');
			$this->db->join('quarters','quarters.id = production.quarters_id');
			$this->db->join('orchards','orchards.id = quarters.orchards_id');

			$this->db->from('production');

			$this->db->where('quarters.id', $id);

			$this->db->where('DATE(production.date) >= ', $init);
			$this->db->where('DATE(production.date) <= ', $end);

			$this->db->group_by('production.people_id');

			$this->db->order_by('people.rut', 'asc');

			return $this->db->get()->result_array();
		}
		else if($type == 3)
		{
			$this->db->select('people.contractor as contractor, SUM(production.quantity) as quantity, people.name as name, people.lastname as lastname, people.rut as rut, people.dv as dv, SUM((production.quantity * production.value_payment)) as value_payment');

			$this->db->join('containers','containers.id = production.containers_id');
			$this->db->join('units','units.id = containers.units_id');
			$this->db->join('products','products.id = production.products_id');
			$this->db->join('varieties','varieties.id = products.varieties_id');
			$this->db->join('people','people.id = production.people_id');
			$this->db->join('process','process.id = production.process_id');
			$this->db->join('quarters','quarters.id = production.quarters_id');
			$this->db->join('orchards','orchards.id = quarters.orchards_id');

			$this->db->from('production');

			$this->db->where('people.id', $id);

			$this->db->where('DATE(production.date) >= ', $init);
			$this->db->where('DATE(production.date) <= ', $end);

			$this->db->group_by('production.people_id');

			$this->db->order_by('people.rut', 'asc');

			return $this->db->get()->result_array();
		}
		else if($type == 4)
		{
			$this->db->select('people.contractor as contractor, SUM(production.quantity) as quantity, people.name as name, people.lastname as lastname, people.rut as rut, people.dv as dv, SUM((production.quantity * production.value_payment)) as value_payment');

			$this->db->join('containers','containers.id = production.containers_id');
			$this->db->join('units','units.id = containers.units_id');
			$this->db->join('products','products.id = production.products_id');
			$this->db->join('varieties','varieties.id = products.varieties_id');
			$this->db->join('people','people.id = production.people_id');
			$this->db->join('process','process.id = production.process_id');
			$this->db->join('quarters','quarters.id = production.quarters_id');
			$this->db->join('orchards','orchards.id = quarters.orchards_id');

			$this->db->from('production');

			$this->db->where('products.id', $id);

			$this->db->where('DATE(production.date) >= ', $init);
			$this->db->where('DATE(production.date) <= ', $end);

			$this->db->group_by('production.people_id');

			$this->db->order_by('people.rut', 'asc');

			return $this->db->get()->result_array();
		}
		else if($type == 5)
		{
			$this->db->select('people.contractor as contractor, SUM(production.quantity) as quantity, people.name as name, people.lastname as lastname, people.rut as rut, people.dv as dv, SUM((production.quantity * production.value_payment)) as value_payment');

			$this->db->join('containers','containers.id = production.containers_id');
			$this->db->join('units','units.id = containers.units_id');
			$this->db->join('products','products.id = production.products_id');
			$this->db->join('varieties','varieties.id = products.varieties_id');
			$this->db->join('people','people.id = production.people_id');
			$this->db->join('process','process.id = production.process_id');
			$this->db->join('quarters','quarters.id = production.quarters_id');
			$this->db->join('orchards','orchards.id = quarters.orchards_id');

			$this->db->from('production');

			$this->db->where('people.contractor', $id);

			$this->db->where('DATE(production.date) >= ', $init);
			$this->db->where('DATE(production.date) <= ', $end);

			$this->db->group_by('production.people_id');

			$this->db->order_by('people.rut', 'asc');

			return $this->db->get()->result_array();
		}
	}

	public function getReportYearMonth_resumen($year, $month, $type, $id)
	{
		$init = $year.'-'.$month.'-01 00:00:00';
		$end = $year.'-'.$month.'-31 23:59:59';
		
		if($type == 1)
		{
			$this->db->select('people.contractor as contractor, SUM(production.quantity) as quantity, people.name as name, people.lastname as lastname, people.rut as rut, people.dv as dv, SUM((production.quantity * production.value_payment)) as value_payment');

			$this->db->join('containers','containers.id = production.containers_id');
			$this->db->join('units','units.id = containers.units_id');
			$this->db->join('products','products.id = production.products_id');
			$this->db->join('varieties','varieties.id = products.varieties_id');
			$this->db->join('people','people.id = production.people_id');
			$this->db->join('process','process.id = production.process_id');
			$this->db->join('quarters','quarters.id = production.quarters_id');
			$this->db->join('orchards','orchards.id = quarters.orchards_id');

			$this->db->from('production');

			$this->db->where('orchards.id', $id);

			$this->db->where('DATE(production.date) >= ', $init);
			$this->db->where('DATE(production.date) <= ', $end);

			$this->db->group_by('production.people_id');

			$this->db->order_by('people.rut', 'asc');

			return $this->db->get()->result_array();
		}
		else if($type == 2)
		{
			$this->db->select('people.contractor as contractor, SUM(production.quantity) as quantity, people.name as name, people.lastname as lastname, people.rut as rut, people.dv as dv, SUM((production.quantity * production.value_payment)) as value_payment');

			$this->db->join('containers','containers.id = production.containers_id');
			$this->db->join('units','units.id = containers.units_id');
			$this->db->join('products','products.id = production.products_id');
			$this->db->join('varieties','varieties.id = products.varieties_id');
			$this->db->join('people','people.id = production.people_id');
			$this->db->join('process','process.id = production.process_id');
			$this->db->join('quarters','quarters.id = production.quarters_id');
			$this->db->join('orchards','orchards.id = quarters.orchards_id');

			$this->db->from('production');

			$this->db->where('quarters.id', $id);

			$this->db->where('DATE(production.date) >= ', $init);
			$this->db->where('DATE(production.date) <= ', $end);

			$this->db->group_by('production.people_id');

			$this->db->order_by('people.rut', 'asc');

			return $this->db->get()->result_array();
		}
		else if($type == 3)
		{
			$this->db->select('people.contractor as contractor, SUM(production.quantity) as quantity, people.name as name, people.lastname as lastname, people.rut as rut, people.dv as dv, SUM((production.quantity * production.value_payment)) as value_payment');

			$this->db->join('containers','containers.id = production.containers_id');
			$this->db->join('units','units.id = containers.units_id');
			$this->db->join('products','products.id = production.products_id');
			$this->db->join('varieties','varieties.id = products.varieties_id');
			$this->db->join('people','people.id = production.people_id');
			$this->db->join('process','process.id = production.process_id');
			$this->db->join('quarters','quarters.id = production.quarters_id');
			$this->db->join('orchards','orchards.id = quarters.orchards_id');

			$this->db->from('production');

			$this->db->where('people.id', $id);

			$this->db->where('DATE(production.date) >= ', $init);
			$this->db->where('DATE(production.date) <= ', $end);

			$this->db->group_by('production.people_id');

			$this->db->order_by('people.rut', 'asc');

			return $this->db->get()->result_array();
		}
		else if($type == 4)
		{
			$this->db->select('people.contractor as contractor, SUM(production.quantity) as quantity, people.name as name, people.lastname as lastname, people.rut as rut, people.dv as dv, SUM((production.quantity * production.value_payment)) as value_payment');

			$this->db->join('containers','containers.id = production.containers_id');
			$this->db->join('units','units.id = containers.units_id');
			$this->db->join('products','products.id = production.products_id');
			$this->db->join('varieties','varieties.id = products.varieties_id');
			$this->db->join('people','people.id = production.people_id');
			$this->db->join('process','process.id = production.process_id');
			$this->db->join('quarters','quarters.id = production.quarters_id');
			$this->db->join('orchards','orchards.id = quarters.orchards_id');

			$this->db->from('production');

			$this->db->where('products.id', $id);

			$this->db->where('DATE(production.date) >= ', $init);
			$this->db->where('DATE(production.date) <= ', $end);

			$this->db->group_by('production.people_id');

			$this->db->order_by('people.rut', 'asc');

			return $this->db->get()->result_array();
		}
		else if($type == 5)
		{
			$this->db->select('people.contractor as contractor, SUM(production.quantity) as quantity, people.name as name, people.lastname as lastname, people.rut as rut, people.dv as dv, SUM((production.quantity * production.value_payment)) as value_payment');

			$this->db->join('containers','containers.id = production.containers_id');
			$this->db->join('units','units.id = containers.units_id');
			$this->db->join('products','products.id = production.products_id');
			$this->db->join('varieties','varieties.id = products.varieties_id');
			$this->db->join('people','people.id = production.people_id');
			$this->db->join('process','process.id = production.process_id');
			$this->db->join('quarters','quarters.id = production.quarters_id');
			$this->db->join('orchards','orchards.id = quarters.orchards_id');

			$this->db->from('production');

			$this->db->where('people.contractor', $id);

			$this->db->where('DATE(production.date) >= ', $init);
			$this->db->where('DATE(production.date) <= ', $end);

			$this->db->group_by('production.people_id');

			$this->db->order_by('people.rut', 'asc');

			return $this->db->get()->result_array();
		}
	}

	//obtener contratista
	public function getContractor()
	{
		$this->db->select('id, name, lastname');
		$this->db->from('people');
		$this->db->where('profiles_id', 3);
		$this->db->order_by('name','asc');

		return $this->db->get()->result_array();
	}

	public function getContractorId($id)
	{
		$this->db->select('name, lastname');
		$this->db->from('people');
		$this->db->where('id', $id);
		$this->db->where('profiles_id', 3);
		$this->db->limit(1);

		$res = $this->db->get()->result_array();
		if(!empty($res))
			return $res[0]['name'].' '.$res[0]['name'];
		else
			return 'N/A';
	}
}

?>