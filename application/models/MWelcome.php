<?php

class MWelcome extends CI_Model 
{
	function __construct() 
	{
		parent::__construct();
	}

	public function getUserSession($user, $password)
	{
		$this->db->select('users.id as id, users.rol_id, roles.rol, users.name as name, users.lastname as lastname, users.user_state_id, user_state.state,  
		users.phone, companies.rut, companies.dv, companies.razon, companies.id as companies_id');
		$this->db->from('users');
		$this->db->join('roles', 'roles.id = users.rol_id');
		$this->db->join('companies','companies.id = users.companies_id');
		$this->db->join('user_state','user_state.id = users.user_state_id');
		$this->db->where('users.user', $user);
		$this->db->where('users.password', $password);
		$this->db->limit(1);

		return $this->db->get()->result_array();
	}
	
}

?>