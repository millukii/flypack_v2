<?php

class MOptions extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	public function getOptions($start, $length, $search, $order, $by)
	{
		$retornar = array();
		if ($search) {
			$busca = $this->getSearchOptions($search, $start, $length, $order, $by);
			$retornar['numDataFilter'] = $this->getCountSearch($search, $start, $length, $order, $by);
			$retornar['data'] = $busca['datos'];
		}
		else {
			$todo = $this->getAllOptions($start, $length, $order, $by);
			$retornar['numDataFilter'] = $this->getCount();
			$retornar['data'] = $todo['datos'];
		}

		$retornar['numDataTotal'] = $this->getCount();

		return $retornar;
	}

	// Funciones auxiliares datatable
	public function getAllOptions($start, $length, $order, $by)
	{
		$this->db->select('id, code, option, description, created, modified');

		switch ($by)
		{
			case 0:
				$this->db->order_by('id', $order);
				break;
			case 1:
				$this->db->order_by('code', $order);
				break;
			case 2:
				$this->db->order_by('option', $order);
				break;
		}

		$this->db->limit($length, $start);
		$query = $this->db->get('options');

		$retornar = array(
			'datos' => $query->result()
		);
		return $retornar;
	}

	public function getSearchOptions($search, $start, $length, $order, $by)
	{
		$this->db->select('id, code, option, description, created, modified');

		$this->db->like('id', $search);
		$this->db->or_like('code', $search);
		$this->db->or_like('option', $search);

		switch ($by)
		{
			case 0:
				$this->db->order_by('id', $order);
				break;
			case 1:
				$this->db->order_by('code', $order);
				break;
			case 2:
				$this->db->order_by('option', $order);
				break;
		}

		$this->db->limit($length, $start);
		$query = $this->db->get('options');

		$retornar = array(
			'datos' => $query->result()
		);
		return $retornar;
	}

	public function getCount() {
		return $this->db->count_all('options');
	}

	public function getCountSearch($search, $start, $length, $order, $by) {
		$this->db->select('id, code, option, description, created, modified');

		$this->db->like('id', $search);
		$this->db->or_like('code', $search);
		$this->db->or_like('option', $search);

		$query = $this->db->get('options')->num_rows();
		return $query;
	}
	//
	public function getOptions_()
	{
		$this->db->select('id, code, option, description');
		$this->db->from('options');
		$this->db->order_by('code','asc');

		return $this->db->get()->result_array();
	}

	public function getRoles()
	{
		$this->db->select('id, rol');
		$this->db->from('roles');
		$this->db->order_by('rol', 'asc');

		return $this->db->get()->result_array();
	}

	public function getOptions_Rol($roles_id)
	{
		$this->db->select('options_id');
		$this->db->from('option_rol');
		$this->db->where('roles_id', $roles_id);
		$this->db->order_by('options_id', 'asc');

		return $this->db->get()->result_array();
	}

	public function deleteOptions_Rol($roles_id)
	{
		$this->db->where('roles_id', $roles_id);
		if($this->db->delete('option_rol'))
			return true;
		else
			return false;
	}

	public function addOption_Rol($data)
	{
		if($this->db->insert('option_rol', $data))
			return true;
		else
			return false;
	}
}

?>