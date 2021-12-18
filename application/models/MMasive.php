<?php

class MMasive extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	public function addPeople($data)
	{
		if($this->db->insert('people', $data))
			return true;
		else
			return false;
	}

	public function editPeople($data, $id)
	{
		$this->db->where('id', $id);
		if($this->db->update('people', $data))
			return true;
		else
			return false;
	}
}

?>