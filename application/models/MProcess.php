<?php

class MProcess extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	public function getProcess($start, $length, $search, $order, $by) {
		$retornar = array();
		if ($search) {
			$busca = $this->getSearchProcess($search, $start, $length, $order, $by);
			$retornar['numDataFilter'] = $this->getCountSearch($search, $start, $length, $order, $by);
			$retornar['data'] = $busca['datos'];
		}
		else {
			$todo = $this->getAllProcess($start, $length, $order, $by);
			$retornar['numDataFilter'] = $this->getCount();
			$retornar['data'] = $todo['datos'];
		}

		$retornar['numDataTotal'] = $this->getCount();

		return $retornar;
	}

	public function getProcess_($id) {
		$this->db->select('id, process, DATE_FORMAT(created, "%d-%m-%Y %H:%i:%s") as created, DATE_FORMAT(modified, "%d-%m-%Y %H:%i:%s") as modified');
		$this->db->from('process');
		$this->db->where('id', $id);
		$this->db->limit(1);

		return $this->db->get()->result_array();
	}

	// Funciones auxiliares datatable
	public function getAllProcess($start, $length, $order, $by) {
		$this->db->select('id, process, DATE_FORMAT(created, "%d-%m-%Y %H:%i:%s") as created, DATE_FORMAT(modified, "%d-%m-%Y %H:%i:%s") as modified');
		if ($by == 0) {
			$this->db->order_by('id', $order);
		}
		else {
			$this->db->order_by('process', $order);
		}
		$this->db->limit($length, $start);
		$query = $this->db->get('process');
		$retornar = array(
			'datos' => $query->result()
		);
		return $retornar;
	}

	public function getSearchProcess($search, $start, $length, $order, $by) {
		$this->db->select('id, process, DATE_FORMAT(created, "%d-%m-%Y %H:%i:%s") as created, DATE_FORMAT(modified, "%d-%m-%Y %H:%i:%s") as modified');
		$this->db->like('id', $search);
		$this->db->or_like('process', $search);
		if ($by == 0) {
			$this->db->order_by('id', $order);
		}
		else {
			$this->db->order_by('process', $order);
		}
		$this->db->limit($length, $start);
		$query = $this->db->get('process');
		$retornar = array(
			'datos' => $query->result()
		);
		return $retornar;
	}

	public function getCount() {
		return $this->db->count_all('process');
	}

	public function getCountSearch($search, $start, $length, $order, $by) {
		$this->db->select('id');
		$this->db->or_like('process', $search);
		$quer = $this->db->get('process')->num_rows();
		return $quer;
	}
	// fin funciones auxiliares

	//Crud
	public function addProcess($data) {
		if($this->db->insert('process', $data))
			return true;
		else
			return false;
	}

	public function editProcess($data, $id) {
		$this->db->where('id', $id);
		if($this->db->update('process', $data))
			return true;
		else
			return false;
	}

	public function deleteProcess($id) {
		$this->db->where('id', $id);
		if($this->db->delete('process'))
			return true;
		else
			return false;
	}
}

?>