<?php

class CVarieties extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('MVarieties', 'modelo');
	}

	public function index()
	{
		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('varieties/index');
	}

	public function datatable()
	{
		$start = $this->input->post('start');
		$length = $this->input->post('length');
		$search = $this->input->post('search')['value'];
		$by = $this->input->post('order')['0']['column'];
		$order = $this->input->post('order')['0']['dir'];

		$result = $this->modelo->getVarieties($start, $length, $search, $order, $by);

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
		$this->load->view('varieties/add');
	}

	public function edit()
	{
		$id = trim($this->input->get('id', TRUE));

		$variety = $this->modelo->getVariety($id);

		$data = array('variety' => $variety);

		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('varieties/edit', $data);
	}

	public function view()
	{
		$id = trim($this->input->get('id', TRUE));

		$variety = $this->modelo->getVariety($id);

		$data = array('variety' => $variety);

		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('varieties/view', $data);
	}

	public function addVariety()
	{
		$variety 	= trim($this->input->post('variety', TRUE));
		$date_time = date('Y-m-d H:i:s');
		$data = array(
			'variety' => $variety,
			'created' => $date_time
		);
		if($this->modelo->addVariety($data))
			echo '1';
		else
			echo '0';
	}

	public function editVariety()
	{
		$id = trim($this->input->post('id', TRUE));
		$variety 	= trim($this->input->post('variety', TRUE));
		
		$data = array(
			'variety' 	=> $variety
		);

		if($this->modelo->editVariety($data, $id))
			echo '1';
		else
			echo '0';
	}

	public function deleteVariety()
	{
		$id = trim($this->input->post('id', TRUE)); 
		if($this->modelo->deleteVariety($id))
			echo '1';
		else
			echo '0';
	}
}

?>