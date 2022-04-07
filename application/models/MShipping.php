<?php

class MShipping extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	public function getShipping($start, $length, $search, $order, $by)
	{
		$retornar = array();
		if ($search) {
			$busca = $this->getSearchShipping($search, $start, $length, $order, $by);
			$retornar['numDataFilter'] = $this->getCountSearch($search, $start, $length, $order, $by);
			$retornar['data'] = $busca['datos'];
		}
		else {
			$todo = $this->getAllShipping($start, $length, $order, $by);
			$retornar['numDataFilter'] = $this->getCount();
			$retornar['data'] = $todo['datos'];
		}

		$retornar['numDataTotal'] = $this->getCount();

		return $retornar;
	}

	public function getShipping_($id)
	{
		$this->db->select(
      'shipping.id as id, 
      shipping.order_nro as order_nro, 
      shipping.delivery_name as delivery_name, 
      shipping.quadmins_code as quadmins_code, 
      shipping.shipping_type as shipping_type, 
      shipping.total_amount as total_amount, 
      shipping.address as address, 
      shipping.origin as origin, 
      shipping.destination as destination, 
      shipping.delivery_name as delivery_name, 
      shipping.observation as observation, 
      shipping.receiver_name as receiver_name, 
      shipping.receiver_phone as receiver_phone, 
      shipping.receiver_mail as receiver_mail, 
      shipping.companies_id as companies_id, 
      shipping.shipping_states_id as shipping_states_id, companies.razon as company, 
      shipping_states.state as state,  
      DATE_FORMAT(shipping.created, "%d-%m-%Y %H:%i:%s") as created, 
      DATE_FORMAT(shipping.modified, "%d-%m-%Y %H:%i:%s") as modified,
      DATE_FORMAT(shipping.shipping_date, "%d-%m-%Y %H:%i:%s") as shipping_date
      ');

		$this->db->join('shipping_states','shipping_states.id = shipping.shipping_states_id');
		$this->db->join('companies','companies.id = shipping.companies_id');

		$this->db->from('shipping');
		$this->db->where('shipping.id', $id);
		$this->db->limit(1);
		return $this->db->get()->result_array();
	}

	// Funciones auxiliares datatable
	public function getAllShipping($start, $length, $order, $by)
	{
		$this->db->select(
      'shipping.id as id, 
      shipping.order_nro as order_nro,
      shipping.quadmins_code as quadmins_code, 
      shipping.shipping_type as shipping_type, 
      shipping.total_amount as total_amount, 
      shipping.delivery_name as delivery_name, 
      shipping.shipping_date as shipping_date, 
      shipping_states.state as state, 
      shipping.origin as origin, 
      shipping.destination as destination,
      shipping.shipping_states_id as shipping_states_id,
      shipping.receiver_name as receiver_name, 
      shipping.observation as observation, 
      shipping.address as address, 
      shipping.receiver_phone as receiver_phone, 
      shipping.receiver_mail as receiver_mail, 
      companies.razon as company');

		$this->db->join('shipping_states','shipping_states.id = shipping.shipping_states_id');
		$this->db->join('companies','companies.id = shipping.companies_id');
    //$this->db->where('shipping_states.id != ',2);

		switch ($by)
		{
			case 0:
				$this->db->order_by('shipping.id', $order);
				break;
			case 1:
				$this->db->order_by('shipping.order_nro', $order);
				break;
			case 2:
				$this->db->order_by('shipping_type', $order);
				break;
			case 3:
				$this->db->order_by('total_amount', $order);
				break;
			case 4:
				$this->db->order_by('shipping.receiver_phone', $order);
				break;
			case 5:
				$this->db->order_by('companies.razon', $order);
				break;
		}

		$this->db->limit($length, $start);
		$query = $this->db->get('shipping');

		$retornar = array(
			'datos' => $query->result()
		);
		return $retornar;
	}

	public function getSearchShipping($search, $start, $length, $order, $by)
	{
		$this->db->select(
      'shipping.id as id, 
      shipping.order_nro as order_nro,
      shipping.quadmins_code as quadmins_code, 
      shipping.shipping_type as shipping_type, 
      shipping.total_amount as total_amount, 
      shipping.delivery_name as delivery_name, 
      shipping.shipping_date as shipping_date, 
      shipping_states.state as state, 
      shipping.receiver_name as receiver_name, 
      shipping.origin as origin, 
      shipping.destination as destination,
      shipping.observation as observation, 
      shipping.address as address,
      shipping.receiver_phone as receiver_phone, 
      shipping.receiver_mail as receiver_mail, 
      companies.razon as company');

		$this->db->join('shipping_states','shipping_states.id = shipping.shipping_states_id');
		$this->db->join('companies','companies.id = shipping.companies_id');
    $this->db->where('shipping_states.id <> ', 2);
		$this->db->like('shipping.id', $search);
		$this->db->or_like('shipping.order_nro', $search);
		$this->db->or_like('shipping.shipping_type', $search);
		$this->db->or_like('shipping.total_amount', $search);
		$this->db->or_like('shipping.receiver_phone', $search);
		$this->db->or_like('companies.razon', $search);

		switch ($by)
		{
			case 0:
				$this->db->order_by('shipping.id', $order);
				break;
			case 1:
				$this->db->order_by('shipping.order_nro', $order);
				break;
			case 2:
				$this->db->order_by('shipping_type', $order);
				break;
			case 3:
				$this->db->order_by('total_amount', $order);
				break;
			case 4:
				$this->db->order_by('shipping.receiver_phone', $order);
				break;
			case 5:
				$this->db->order_by('profiles.profile', $order);
				break;
		}

		$this->db->limit($length, $start);
		$query = $this->db->get('shipping');

		$retornar = array(
			'datos' => $query->result()
		);
		return $retornar;
	}

	public function getCount()
	{
    $this->db->where('shipping_states.id <> ', 2);
		return $this->db->count_all('shipping');
     
	}

	public function getCountSearch($search, $start, $length, $order, $by)
	{
		$this->db->select('shipping.id');

		$this->db->join('shipping_states','shipping_states.id = shipping.shipping_states_id');
		$this->db->join('companies','companies.id = shipping.companies_id');
    $this->db->where('shipping_states.id <> ', 2);

		$this->db->like('shipping.id', $search);
		$this->db->or_like('shipping.order_nro', $search);
		$this->db->or_like('shipping.shipping_type', $search);
		$this->db->or_like('shipping.total_amount', $search);
		$this->db->or_like('shipping.receiver_phone', $search);
		$this->db->or_like('companies.razon', $search);

		$query = $this->db->get('shipping')->num_rows();
		return $query;
	}
	//
	//Crud
	public function addShipping($data)
	{
		if($this->db->insert('shipping', $data))
			return true;
		else
			return false;
	}

	public function editShipping($data, $id)
	{
		$this->db->where('id', $id);
		if($this->db->update('shipping', $data))
			return true;
		else
			return false;
	}
	//FUNCTION AUXILIARES
	public function getAllProfiles()
	{
		$this->db->select('id, profile');
		$this->db->from('profiles');
		$this->db->order_by('profile');

		return $this->db->get()->result();
	}
	public function getAllCompanies()
	{
		$this->db->select('id, razon');
		$this->db->from('companies');
		$this->db->order_by('razon');
		return $this->db->get()->result();
	}

  	public function getAllCommunes()
	{
		$this->db->select('id, commune');
		$this->db->from('communes');
		$this->db->order_by('commune');
		return $this->db->get()->result();
	}
	public function getAllShipping_States()
	{
		$this->db->select('id, state');
		$this->db->from('shipping_states');
		$this->db->order_by('state');
		return $this->db->get()->result();
	}


  public function getAllDeliveryOptions()
	{
		$this->db->select('id, name, lastname, rol_id');
		$this->db->from('users');
    $this->db->where('users.rol_id', "3");
		$this->db->order_by('name');
		return $this->db->get()->result();
	}

	public function getCompanyOfUser($id)
	{
		$this->db->select('companies.id,companies.type_rate, companies.razon, companies.city_id, city.city, companies.communes_id,communes.commune, companies.address');
		$this->db->from('companies');
    $this->db->join('city','city.id  = companies.city_id');
    $this->db->join('communes','communes.id  = companies.communes_id');
		$this->db->join('users','users.companies_id  = companies.id');
		$this->db->where('users.id', $id);
		$this->db->order_by('companies.razon', 'asc');

		return $this->db->get()->result();
	}

public function getBranchOfficesOfCompany($id)
	{
		$this->db->select('company_address.id, company_address.city_id, city.city, company_address.communes_id,communes.commune, company_address.address');
		$this->db->from('company_address');
    $this->db->join('communes','communes.id  = company_address.communes_id');
    $this->db->join('city','city.id  = company_address.city_id');
		$this->db->where('company_address.companies_id', $id);
		$this->db->order_by('company_address.address', 'asc');

		return $this->db->get()->result();
	}


}

?>