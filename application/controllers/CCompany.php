<?php

class CCompany extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('MCompany', 'modelo');
	}

	public function index()
	{
		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('companies/index');
	}

	//Datatable
	public function datatable()
	{
		$start = $this->input->post('start');
		$length = $this->input->post('length');
		$search = $this->input->post('search')['value'];
		$by = $this->input->post('order')['0']['column'];
		$order = $this->input->post('order')['0']['dir'];

		$result = $this->modelo->getCompany($start, $length, $search, $order, $by);
    $json_data = array(
			"draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($result['numDataTotal']),
            "recordsFiltered" => intval($result['numDataFilter']),
            "data"            => $result['data']
            );

        echo json_encode($json_data);
	}

	public function add()
	{
		$people = $this->modelo->getAllPeople();

		
		$this->db->select('id');
        $this->db->from('companies');
        $this->db->order_by('id', 'desc');
        $this->db->limit(1);
        $res = $this->db->get()->result_array();
        $res;
        if(!empty($res[0]['id']))
            $res = intval($res[0]['id']) + 1;
        else
            $res = 1;
    
		$data = array(
			'people' => $people,
			'new_id' => $res,
		);

		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('companies/add', $data);
	}

	public function edit()
	{
		$id = trim($this->input->get('id', TRUE));

		$company = $this->modelo->getCompany_($id);

		$data = array(
			'company' => $company
		);

		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('companies/edit', $data);
	}

	public function view()
	{
		$id = trim($this->input->get('id', TRUE));

		$company = $this->modelo->getCompany_($id);
		$users = $this->modelo->getUsersByCompany($id);

		$data = array(
			'company' => $company,
			'users' => $users
		);

		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('companies/view', $data);
	}

	public function addCompany()
	{
		$rut 				= 	trim($this->input->post('rut', TRUE));
		$dv 				= 	trim($this->input->post('dv', TRUE));
		$razon 				= 	trim($this->input->post('razon', TRUE));
		$fantasy 			= 	trim($this->input->post('fantasy', TRUE));
		$address 			= 	trim($this->input->post('address', TRUE));
		$city 				= 	trim($this->input->post('city', TRUE));
		$commune 			= 	trim($this->input->post('commune', TRUE));

		if(empty($razon))
			$razon = 'N/A';
		
		if(empty($fantasy))
			$fantasy = 'N/A';
		
		if(empty($address))
			$address = 'N/A';

		if(empty($city))
			$city = 'N/A';

		if(empty($commune))
			$commune = 'N/A';

		$data = array(
			'rut' 				=> $rut,
			'dv' 				=> $dv,
			'razon' 			=> $razon,
			'fantasy' 			=> $fantasy,
			'address' 			=> $address,
			'city' 				=> $city,
			'commune' 			=> $commune
		);

		$companies_id = $this->modelo->addCompany($data);
		if($companies_id != false)
		{
			$user 			= 	trim($this->input->post('user', TRUE));
			$password 		= 	trim($this->input->post('password', TRUE));
			$roles_id 		= 	2;
			$name 			= 	trim($this->input->post('name', TRUE));
			$lastname 		= 	trim($this->input->post('lastname', TRUE));
			$email 			= 	trim($this->input->post('email', TRUE));
			$phone 			= 	trim($this->input->post('phone', TRUE));
			$companies_id 	= 	$companies_id;
			$user_state_id	= 	1;
			$date_time 		= 	date('Y-m-d H:i:s');
			
			$data = array(
				'user' 				=> 	$user,
				'password' 			=> 	md5($password),
				'rol_id' 			=> 	$roles_id,
				'name'				=>	$name,
				'lastname'			=>	$lastname,
				'email'				=>	$email,
				'phone'				=>	$phone,
				'companies_id' 		=> 	$companies_id,
				'user_state_id' 	=> 	$user_state_id,
				'created'			=> 	$date_time,
				'modified'			=> 	$date_time
			);

			if($this->modelo->addUser($data))
				echo '1';
			else
				echo '0';
		}
		else
			echo '0';
		
	}

	public function editCompany()
	{
		$id 				= 	trim($this->input->post('id', TRUE));
		$rut 				= 	trim($this->input->post('rut', TRUE));
		$dv 				= 	trim($this->input->post('dv', TRUE));
		$razon 				= 	trim($this->input->post('razon', TRUE));
		$fantasy 			= 	trim($this->input->post('fantasy', TRUE));
		$address 			= 	trim($this->input->post('address', TRUE));
		$city 				= 	trim($this->input->post('city', TRUE));
		$commune 				= 	trim($this->input->post('commune', TRUE));
		$company_states_id	=	trim($this->input->post('company_states_id', TRUE));
		
		if(empty($name))
			$name = 'N/A';
		
		if(empty($lastname))
			$lastname = 'N/A';
		
		if(empty($address))
			$address = 'N/A';

		if(empty($phone))
			$phone = '000000000';

		if(empty($email))
			$email = 'sin_email@gmail.com';
		
		$data = array(
			'rut' 				=> $rut,
			'dv' 				=> $dv,
			'razon' 				=> $razon,
			'fantasy' 			=> $fantasy,
			'address' 			=> $address,
			'city' 			=> $city,
			'commune' 			=> $commune
		);

		if($this->modelo->editCompany($data, $id))
			echo '1';
		else
			echo '0';
	}

	public function deleteCompany()
	{
		$id 	= 	trim($this->input->post('id', TRUE));

		$data = array(
			'company_states_id'	=>	'2'
		);

		if($this->modelo->editCompany($data, $id))
			echo '1';
		else
			echo '0';
	}
	
	public function generateMasive()
	{
		$quantity_workers 				= 	trim($this->input->post('quantity_workers', TRUE));

		$this->db->select('id');
        $this->db->from('companies');
        $this->db->order_by('id', 'desc');
        $this->db->limit(1);
        $res = $this->db->get()->result_array();

        if(!empty($res[0]['id']))
            $res = intval($res[0]['id']);
        else
            $res = 1;

        $date_time = date('Y-m-d H:i:s');
		for($i=0; $i<$quantity_workers; $i++)
		{
		   	$res++;
    		$data = array(
    			'rut' 				=> $res,
    			'dv' 				=> $res,
    			'name' 				=> 'N/A',
    			'lastname' 			=> 'N/A',
    			'address' 			=> 'N/A',
    			'email' 			=> 'sin_correo@gmail.com',
    			'phone' 			=> '000000000',
    			'profile_id'		=> 2,
    			'company_states_id'	=> 1,
    			'created'			=> $date_time
    		);
    
    		$this->modelo->addCompany($data);
		}

        echo '1';		
	}
}

?>