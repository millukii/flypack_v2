<?php

class COrchards extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('MOrchards', 'modelo');
	}

	public function index()
	{
		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('orchards/index');
	}

	public function datatable()
	{
		$start = $this->input->post('start');
		$length = $this->input->post('length');
		$search = $this->input->post('search')['value'];
		$by = $this->input->post('order')['0']['column'];
		$order = $this->input->post('order')['0']['dir'];

		$result = $this->modelo->getOrchards($start, $length, $search, $order, $by);

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
		$this->load->view('orchards/add');
	}

	public function edit()
	{
		$id = trim($this->input->get('id', TRUE));

		$orchard = $this->modelo->getOrchard($id);

		$data = array('orchards' => $orchard);

		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('orchards/edit', $data);
	}

	public function view()
	{
		$id = trim($this->input->get('id', TRUE));

		$orchard = $this->modelo->getOrchard($id);

		$data = array('orchards' => $orchard);

		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('orchards/view', $data);
	}

	public function addOrchard()
	{
		$orchard 	= trim($this->input->post('orchard', TRUE));
		$date_time = date('Y-m-d H:i:s');
		$data = array(
			'orchard' => $orchard,
			'created' => $date_time
		);
		if($this->modelo->addOrchard($data))
			echo '1';
		else
			echo '0';
	}

	public function editOrchard()
	{
		$id = trim($this->input->post('id', TRUE));
		$orchard 	= trim($this->input->post('orchard', TRUE));

		$data = array(
			'orchard' 	=> $orchard
		);

		if($this->modelo->editOrchard($data, $id))
			echo '1';
		else
			echo '0';
	}

	public function deleteOrchard()
	{
		$id = trim($this->input->post('id', TRUE)); 
		if($this->modelo->deleteOrchard($id))
			echo '1';
		else
			echo '0';
	}
}

?>