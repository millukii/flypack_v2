<?php

class CPrices extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('MPrices', 'modelo');
	}

	public function index()
	{
		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('prices/index');
	}

	public function datatable()
	{
		$start = $this->input->post('start');
		$length = $this->input->post('length');
		$search = $this->input->post('search')['value'];
		$by = $this->input->post('order')['0']['column'];
		$order = $this->input->post('order')['0']['dir'];

		$result = $this->modelo->getPrices($start, $length, $search, $order, $by);

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
		$this->load->view('prices/add');
	}

	public function edit()
	{
		$id = trim($this->input->get('id', TRUE));

		$prices = $this->modelo->getPrice($id);

		$data = array('prices' => $prices);

		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('prices/edit', $data);
	}

	public function view()
	{
		$id = trim($this->input->get('id', TRUE));

		$prices = $this->modelo->getPrice($id);

		$data = array('prices' => $prices);

		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('prices/view', $data);
	}

	public function addPrice()
	{
		$price 	= trim($this->input->post('price', TRUE));
		$date_time = date('Y-m-d H:i:s');
		$data = array(
			'price' => $price,
		//	'created' => $date_time
		);
		if($this->modelo->addPrice($data))
			echo '1';
		else
			echo '0';
	}

	public function editPrice()
	{
		$id = trim($this->input->post('id', TRUE));
		$price 	= trim($this->input->post('price', TRUE));
		
		$data = array(
			'price' 	=> $price
		);

		if($this->modelo->editPrice($data, $id))
			echo '1';
		else
			echo '0';
	}

	public function deletePrice()
	{
		$id = trim($this->input->post('id', TRUE)); 
		if($this->modelo->deletePrice($id))
			echo '1';
		else
			echo '0';
	}
}

?>