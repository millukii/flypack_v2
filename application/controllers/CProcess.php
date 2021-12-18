<?php

class CProcess extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('MProcess', 'modelo');
	}

	public function index()
	{
		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('process/index');
	}

	public function datatable()
	{
		$start = $this->input->post('start');
		$length = $this->input->post('length');
		$search = $this->input->post('search')['value'];
		$by = $this->input->post('order')['0']['column'];
		$order = $this->input->post('order')['0']['dir'];

		$result = $this->modelo->getProcess($start, $length, $search, $order, $by);

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
		$this->load->view('process/add');
	}

	public function edit()
	{
		$id = trim($this->input->get('id', TRUE));

		$process = $this->modelo->getProcess_($id);

		$data = array('process' => $process);

		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('process/edit', $data);
	}

	public function view()
	{
		$id = trim($this->input->get('id', TRUE));

		$process = $this->modelo->getProcess_($id);

		$data = array('process' => $process);

		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('process/view', $data);
	}

	public function addProcess()
	{
		$process 	= trim($this->input->post('process', TRUE));
		$date_time = date('Y-m-d H:i:s');
		$data = array(
			'process' => $process,
			'created' => $date_time
		);
		if($this->modelo->addProcess($data))
			echo '1';
		else
			echo '0';
	}

	public function editProcess()
	{
		$id = trim($this->input->post('id', TRUE));
		$process 	= trim($this->input->post('process', TRUE));

		$data = array(
			'process' 	=> $process
		);

		if($this->modelo->editProcess($data, $id))
			echo '1';
		else
			echo '0';
	}

	public function deleteProcess()
	{
		$id = trim($this->input->post('id', TRUE)); 
		if($this->modelo->deleteProcess($id))
			echo '1';
		else
			echo '0';
	}
}

?>