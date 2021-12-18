<?php

class CProfiles extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('MProfiles', 'modelo');
	}

	public function index()
	{
		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('profiles/index');
	}

	//Datatable
	public function datatable()
	{
		$start = $this->input->post('start');
		$length = $this->input->post('length');
		$search = $this->input->post('search')['value'];
		$by = $this->input->post('order')['0']['column'];
		$order = $this->input->post('order')['0']['dir'];

		$result = $this->modelo->getProfiles($start, $length, $search, $order, $by);

		$json_data = array(
			"draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($result['numDataTotal']),
            "recordsFiltered" => intval($result['numDataFilter']),
            "data"            => $result['data']
            );

        echo json_encode($json_data);
	}

	//Vistas
	public function add()
	{
		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('profiles/add');
	}

	public function edit()
	{
		$id = trim($this->input->get('id', TRUE));

		$profile = $this->modelo->getProfile($id);

		$data = array('profiles' => $profile);

		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('profiles/edit', $data);
	}

	public function view()
	{
		$id = trim($this->input->get('id', TRUE));

		$profile = $this->modelo->getProfile($id);

		$data = array('profiles' => $profile);

		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('profiles/view', $data);
	}

	//Crud
	public function addProfile()
	{
		$profile 	= trim($this->input->post('profile', TRUE));
		
		$date_time = date('Y-m-d H:i:s');

		$data = array(
			'profile' => $profile,
			'created' => $date_time
		);

		if($this->modelo->addProfile($data))
			echo '1';
		else
			echo '0';
	}

	public function editProfile()
	{
		$id = trim($this->input->post('id', TRUE));

		$profile 	= trim($this->input->post('profile', TRUE));

		$data = array(
			'profile' 	=> $profile
		);

		if($this->modelo->editProfile($data, $id))
			echo '1';
		else
			echo '0';
	}

	public function deleteProfile()
	{
		$id = trim($this->input->post('id', TRUE)); 
		if($this->modelo->deleteProfile($id))
			echo '1';
		else
			echo '0';
	}
}

?>