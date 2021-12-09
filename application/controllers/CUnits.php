<?php

class CUnits extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('MUnits', 'modelo');
	}

	public function index()
	{
		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('units/index');
	}

	public function datatable()
	{
		$start = $this->input->post('start');
		$length = $this->input->post('length');
		$search = $this->input->post('search')['value'];
		$by = $this->input->post('order')['0']['column'];
		$order = $this->input->post('order')['0']['dir'];

		$result = $this->modelo->getUnits($start, $length, $search, $order, $by);

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
		$this->load->view('units/add');
	}

	public function edit()
	{
		$id = trim($this->input->get('id', TRUE));

		$unit = $this->modelo->getUnit($id);

		$data = array('unit' => $unit);

		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('units/edit', $data);
	}

	public function view()
	{
		$id = trim($this->input->get('id', TRUE));

		$unit = $this->modelo->getUnit($id);

		$data = array('unit' => $unit);

		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('units/view', $data);
	}

	public function addUnit()
	{
		$unit 		= trim($this->input->post('unit', TRUE));
		$acronym 	= trim($this->input->post('acronym', TRUE));

		$date_time = date('Y-m-d H:i:s');

		$data = array(
			'unit' => $unit,
			'acronym' => $acronym,
			'created' => $date_time
		);
		if($this->modelo->addUnit($data))
			echo '1';
		else
			echo '0';
	}

	public function editUnit()
	{
		$id 		= trim($this->input->post('id', TRUE));

		$unit 		= trim($this->input->post('unit', TRUE));
		$acronym 	= trim($this->input->post('acronym', TRUE));

		$data = array(
			'unit' 		=> $unit,
			'acronym' 	=> $acronym
		);

		if($this->modelo->editUnit($data, $id))
			echo '1';
		else
			echo '0';
	}

	public function deleteUnit()
	{
		$id = trim($this->input->post('id', TRUE)); 
		if($this->modelo->deleteUnit($id))
			echo '1';
		else
			echo '0';
	}
}

?>