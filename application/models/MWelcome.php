<?php

class MWelcome extends CI_Model 
{
	function __construct() 
	{
		parent::__construct();
	}

	public function getUserSession($user, $password)
	{
		$this->db->select('users.id as id, users.rol_id, roles.rol, users.people_id, people.name as name, people.lastname as lastname, users.user_state_id, user_state.state, people.rut, people.dv, people.address, people.email, people.phone, people.profile_id');
		$this->db->from('users');
		$this->db->join('roles', 'roles.id = users.rol_id');
		$this->db->join('people','people.id = users.people_id');
		$this->db->join('user_state','user_state.id = users.user_state_id');
		$this->db->where('users.user', $user);
		$this->db->where('users.password', $password);
		$this->db->limit(1);

		return $this->db->get()->result_array();
	}
	
}

?>