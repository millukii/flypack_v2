<?php

class MExportSQL extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	public function getExportSQL($start, $length, $search, $order, $by)
	{
		$retornar = array();
		if ($search) {
			$busca = $this->getSearchExports($search, $start, $length, $order, $by);
			$retornar['numDataFilter'] = $this->getCountExports($search, $start, $length, $order, $by);
			$retornar['data'] = $busca['datos'];
		}
		else {
			$todo = $this->getAllExports($start, $length, $order, $by);
			$retornar['numDataFilter'] = $this->getCount();
			$retornar['data'] = $todo['datos'];
		}

		$retornar['numDataTotal'] = $this->getCount();

		return $retornar;
	}

	public function getExport($id)
	{
		$this->db->select('exports.id as id, exports.name as name, exports.path as path, DATE_FORMAT(exports.created, "%d-%m-%Y %H:%i:%s") as created');
		$this->db->from('exports');
		$this->db->where('exports.id', $id);
		$this->db->limit(1);

		return $this->db->get()->result_array();
	}

	public function getAllExports($start, $length, $order, $by)
	{
		$this->db->select('exports.id as id, exports.name as name, exports.path as path, DATE_FORMAT(exports.created, "%d-%m-%Y %H:%i:%s") as created');

		if ($by == 0)
			$this->db->order_by('exports.id', $order);
		else if($by == 1)
			$this->db->order_by('exports.name', $order);
		else if($by == 2)
			$this->db->order_by('exports.path', $order);
		else
			$this->db->order_by('exports.created', $order);

		$this->db->limit($length, $start);
		$query = $this->db->get('exports');
		$retornar = array(
			'datos' => $query->result()
		);
		return $retornar;
	}

	public function getSearchExport($search, $start, $length, $order, $by)
	{
	    $this->db->select('exports.id as id, exports.name as name, exports.path as path, DATE_FORMAT(exports.created, "%d-%m-%Y %H:%i:%s") as created');

		$this->db->like('exports.id', $search);
		$this->db->or_like('exports.name', $search);
		$this->db->or_like('exports.path', $search);
		$this->db->or_like('exports.created', $search);

		if ($by == 0)
			$this->db->order_by('exports.id', $order);
		else if($by == 1)
			$this->db->order_by('exports.name', $order);
		else if($by == 2)
			$this->db->order_by('exports.path', $order);
		else
			$this->db->order_by('exports.created', $order);

		$this->db->limit($length, $start);
		$query = $this->db->get('exports');
		$retornar = array(
			'datos' => $query->result()
		);
		return $retornar;
	}

	public function getCount()
	{
		return $this->db->count_all('exports');
	}

	public function getCountSearch($search, $start, $length, $order, $by)
	{
		$this->db->select('exports.id as id, exports.name as name, exports.path as path, DATE_FORMAT(exports.created, "%d-%m-%Y %H:%i:%s") as created');

		$this->db->like('exports.id', $search);
		$this->db->or_like('exports.name', $search);
		$this->db->or_like('exports.path', $search);
		$this->db->or_like('exports.created', $search);

		$quer = $this->db->get('exports')->num_rows();
		return $quer;
	}
	
	public function addExport($data)
	{
		if($this->db->insert('exports', $data))
			return true;
		else
			return false;
	}
	
	public function cleanTables()
	{
	    $date_time = date('Y-m-d H:i:s');
	    
	    $sql1 = 'DELETE FROM people WHERE people.profiles_id = 2 OR people.profiles_id = 5;';
	    $sql2 = 'TRUNCATE TABLE production;';
	    $sql3 = 'TRUNCATE TABLE response;';
	    
	    $this->db->select('id');
	    $this->db->from('people');
	    $this->db->order_by('id','DESC');
	    $this->db->limit(1);
	    $res = $this->db->get()->result_array();
	    if(!empty($res[9]['id']))
	        $res = $res[9]['id'];
	    else
	        $res = 0;
	   
	    $res = $res + 1;
	    
	    $sql4 = 'ALTER TABLE people AUTO_INCREMENT='.$res.';';
	    
		$this->db->query($sql1);
		$this->db->query($sql2);
		$this->db->query($sql3);
		$this->db->query($sql4);
		
		$data = array(
			'description' => 'Inicialización de sistema',
			'subject' => 'PRODUCCIÓN',
			'actions_id' => 10,
			'users_id' => $this->session->userdata('users_id'),
			'created' => $date_time
		);


		if($this->db->insert('logs', $data))
			return true;
		else
			return false;

	}

}

?>