<?php

class CRoles extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('MRoles', 'modelo');
	}

	public function index()
	{
		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('roles/index');
	}

	public function datatable()
	{
		$start = $this->input->post('start');
		$length = $this->input->post('length');
		$search = $this->input->post('search')['value'];
		$by = $this->input->post('order')['0']['column'];
		$order = $this->input->post('order')['0']['dir'];

		$result = $this->modelo->getRoles($start, $length, $search, $order, $by);

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
		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('roles/add');
	}

	public function edit()
	{
		$id = trim($this->input->get('id', TRUE));

		$roles = $this->modelo->getRol($id);

		$data = array('roles' => $roles);

		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('roles/edit', $data);
	}

	public function view()
	{
		$id = trim($this->input->get('id', TRUE));

		$roles = $this->modelo->getRol($id);

		$data = array('roles' => $roles);

		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('roles/view', $data);
	}

	public function addRol()
	{
		$rol 	= trim($this->input->post('rol', TRUE));
		$date_time = date('Y-m-d H:i:s');
		$data = array(
			'rol' => $rol,
		//	'created' => $date_time
		);
		if($this->modelo->addRol($data))
			echo '1';
		else
			echo '0';
	}

	public function editRol()
	{
		$id = trim($this->input->post('id', TRUE));
		$rol 	= trim($this->input->post('rol', TRUE));
		
		$data = array(
			'rol' 	=> $rol
		);

		if($this->modelo->editRol($data, $id))
			echo '1';
		else
			echo '0';
	}

	public function deleteRol()
	{
		$id = trim($this->input->post('id', TRUE)); 
		if($this->modelo->deleteRol($id))
			echo '1';
		else
			echo '0';
	}
}

?>