<?php

class CPeople extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('MPeople', 'modelo');
	}

	public function index()
	{
		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('people/index');
	}

	//Datatable
	public function datatable()
	{
		$start = $this->input->post('start');
		$length = $this->input->post('length');
		$search = $this->input->post('search')['value'];
		$by = $this->input->post('order')['0']['column'];
		$order = $this->input->post('order')['0']['dir'];

		$result = $this->modelo->getPeople($start, $length, $search, $order, $by);
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
		$profiles = $this->modelo->getAllProfiles();
		$people_states = $this->modelo->getAllPeople_States();
		
		$this->db->select('id');
        $this->db->from('people');
        $this->db->order_by('id', 'desc');
        $this->db->limit(1);
        $res = $this->db->get()->result_array();
        $res;
        if(!empty($res[0]['id']))
            $res = intval($res[0]['id']) + 1;
        else
            $res = 1;
    
		$data = array(
			'profiles' => $profiles,
			'people_states' => $people_states,
			'new_id' => $res,
		);

		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('people/add', $data);
	}

	public function edit()
	{
		$id = trim($this->input->get('id', TRUE));

		$people = $this->modelo->getPeople_($id);
		$profiles = $this->modelo->getAllProfiles();
		$people_states = $this->modelo->getAllPeople_States();

		$data = array(
			'people' => $people,
			'profiles' => $profiles,
			'people_states' => $people_states,
		);

		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('people/edit', $data);
	}

	public function view()
	{
		$id = trim($this->input->get('id', TRUE));

		$people = $this->modelo->getPeople_($id);
		$data = array(
			'people' => $people
		);

		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('people/view', $data);
	}

	public function addPeople()
	{
		$rut 				= 	trim($this->input->post('rut', TRUE));
		$dv 				= 	trim($this->input->post('dv', TRUE));
		$name 				= 	trim($this->input->post('name', TRUE));
		$lastname 			= 	trim($this->input->post('lastname', TRUE));
		$address 			= 	trim($this->input->post('address', TRUE));
		$phone 				= 	trim($this->input->post('phone', TRUE));
		$email 				= 	trim($this->input->post('email', TRUE));
		$profiles_id 		= 	trim($this->input->post('profile_id', TRUE));
		$people_states_id	=	trim($this->input->post('people_states_id', TRUE));
		
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
		
		$date_time = date('Y-m-d H:i:s');

		$data = array(
			'rut' 				=> $rut,
			'dv' 				=> $dv,
			'name' 				=> $name,
			'lastname' 			=> $lastname,
			'address' 			=> $address,
			'email' 			=> $email,
			'phone' 			=> $phone,
			'profile_id'		=> $profiles_id,
			'people_states_id'	=> $people_states_id,
			'created'			=> $date_time
		);

		if($this->modelo->addPeople($data))
			echo '1';
		else
			echo '0';
	}

	public function editPeople()
	{
		$id 				= 	trim($this->input->post('id', TRUE));
		$rut 				= 	trim($this->input->post('rut', TRUE));
		$dv 				= 	trim($this->input->post('dv', TRUE));
		$name 				= 	trim($this->input->post('name', TRUE));
		$lastname 			= 	trim($this->input->post('lastname', TRUE));
		$address 			= 	trim($this->input->post('address', TRUE));
		$email 				= 	trim($this->input->post('email', TRUE));
		$phone 				= 	trim($this->input->post('phone', TRUE));
		$profiles_id 		= 	trim($this->input->post('profile_id', TRUE));
		$people_states_id	=	trim($this->input->post('people_states_id', TRUE));
		
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
			'name' 				=> $name,
			'lastname' 			=> $lastname,
			'address' 			=> $address,
			'email' 			=> $email,
			'phone' 			=> $phone,
			'profile_id'		=> $profiles_id,
			'people_states_id'	=> $people_states_id
		);

		if($this->modelo->editPeople($data, $id))
			echo '1';
		else
			echo '0';
	}

	public function deletePeople()
	{
		$id 	= 	trim($this->input->post('id', TRUE));

		$data = array(
			'people_states_id'	=>	'2'
		);

		if($this->modelo->editPeople($data, $id))
			echo '1';
		else
			echo '0';
	}
	
	public function generateMasive()
	{
		$quantity_workers 				= 	trim($this->input->post('quantity_workers', TRUE));

		$this->db->select('id');
        $this->db->from('people');
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
    			'people_states_id'	=> 1,
    			'created'			=> $date_time
    		);
    
    		$this->modelo->addPeople($data);
		}

        echo '1';		
	}
}

?>