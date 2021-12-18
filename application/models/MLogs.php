<?php

class MLogs extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	public function getLogs($start, $length, $search, $order, $by)
	{
		$retornar = array();
		if ($search) {
			$busca = $this->getSearchLogs($search, $start, $length, $order, $by);
			$retornar['numDataFilter'] = $this->getCountSearch($search, $start, $length, $order, $by);
			$retornar['data'] = $busca['datos'];
		}
		else {
			$todo = $this->getAllLogs($start, $length, $order, $by);
			$retornar['numDataFilter'] = $this->getCount();
			$retornar['data'] = $todo['datos'];
		}

		$retornar['numDataTotal'] = $this->getCount();

		return $retornar;
	}

	public function getLog($id)
	{
		$this->db->select('logs.id as id, logs.description as description, logs.subject as subject, logs.actions_id as actions_id, logs.users_id as users_id, actions.action as action, users.user as user, DATE_FORMAT(logs.created, "%d-%m-%Y %H:%i:%s") as created');
		$this->db->join('actions', 'actions.id = logs.actions_id');
		$this->db->join('users', 'users.id = logs.users_id');
		$this->db->from('logs');
		$this->db->where('logs.id', $id);
		$this->db->limit(1);

		return $this->db->get()->result_array();
	}

	public function getAllLogs($start, $length, $order, $by)
	{
		$this->db->select('logs.id as id, logs.subject as subject, logs.actions_id as actions_id, logs.users_id as users_id, actions.action as action, users.user as user, DATE_FORMAT(logs.created, "%d-%m-%Y %H:%i:%s") as created');

		$this->db->join('actions', 'actions.id = logs.actions_id');
		$this->db->join('users', 'users.id = logs.users_id');

		if ($by == 0)
			$this->db->order_by('logs.id', $order);
		else if($by == 1)
			$this->db->order_by('logs.subject', $order);
		else if($by == 2)
			$this->db->order_by('actions.action', $order);
		else if($by == 3)
			$this->db->order_by('users.user', $order);
		else
			$this->db->order_by('logs.created', $order);

		$this->db->limit($length, $start);
		$query = $this->db->get('logs');
		$retornar = array(
			'datos' => $query->result()
		);
		return $retornar;
	}

	public function getSearchLogs($search, $start, $length, $order, $by)
	{
		$this->db->select('logs.id as id, logs.subject as subject, logs.actions_id as actions_id, logs.users_id as users_id, actions.action as action, users.user as user, DATE_FORMAT(logs.created, "%d-%m-%Y %H:%i:%s") as created');

		$this->db->join('actions', 'actions.id = logs.actions_id');
		$this->db->join('users', 'users.id = logs.users_id');

		$this->db->like('logs.id', $search);
		$this->db->or_like('logs.subject', $search);
		$this->db->or_like('actions.action', $search);
		$this->db->or_like('users.user', $search);
		$this->db->or_like('logs.created', $search);

		if ($by == 0)
			$this->db->order_by('logs.id', $order);
		else if($by == 1)
			$this->db->order_by('logs.subject', $order);
		else if($by == 2)
			$this->db->order_by('actions.action', $order);
		else if($by == 3)
			$this->db->order_by('users.user', $order);
		else
			$this->db->order_by('logs.created', $order);

		$this->db->limit($length, $start);
		$query = $this->db->get('logs');
		$retornar = array(
			'datos' => $query->result()
		);
		return $retornar;
	}

	public function getCount()
	{
		return $this->db->count_all('logs');
	}

	public function getCountSearch($search, $start, $length, $order, $by)
	{
		$this->db->select('logs.id');
		$this->db->join('actions', 'actions.id = logs.actions_id');
		$this->db->join('users', 'users.id = logs.users_id');

		$this->db->like('logs.id', $search);
		$this->db->or_like('logs.subject', $search);
		$this->db->or_like('actions.action', $search);
		$this->db->or_like('users.user', $search);
		$this->db->or_like('logs.created', $search);

		$quer = $this->db->get('logs')->num_rows();
		return $quer;
	}

}

?>