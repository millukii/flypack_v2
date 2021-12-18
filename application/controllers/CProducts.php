<?php

class CProducts extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('MProducts', 'modelo');
	}

	public function index()
	{
		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('products/index');
	}

	public function datatable()
	{
		$start = $this->input->post('start');
		$length = $this->input->post('length');
		$search = $this->input->post('search')['value'];
		$by = $this->input->post('order')['0']['column'];
		$order = $this->input->post('order')['0']['dir'];

		$result = $this->modelo->getProducts($start, $length, $search, $order, $by);

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
		$varieties = $this->modelo->getVarieties();
		$data = array(
			'varieties' => $varieties
		);

		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('products/add', $data);
	}

	public function edit()
	{
		$id = trim($this->input->get('id', TRUE));

		$product = $this->modelo->getProduct($id);
		$varieties = $this->modelo->getVarieties();

		$data = array(
			'product' => $product,
			'varieties' => $varieties
		);

		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('products/edit', $data);
	}

	public function view()
	{
		$id = trim($this->input->get('id', TRUE));

		$product = $this->modelo->getProduct($id);

		$data = array('product' => $product);

		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('products/view', $data);
	}

	public function addProduct()
	{
		$product 		= trim($this->input->post('product', TRUE));
		$description 	= trim($this->input->post('description', TRUE));
		$varieties_id 	= trim($this->input->post('varieties_id', TRUE));

		$date_time = date('Y-m-d H:i:s');

		$data = array(
			'product' 			=> $product,
			'description' 		=> $description,
			'varieties_id' 		=> $varieties_id,
			'created' 			=> $date_time
		);
		if($this->modelo->addProduct($data))
			echo '1';
		else
			echo '0';
	}

	public function editProduct()
	{
		$id = trim($this->input->post('id', TRUE));

		$product 		= trim($this->input->post('product', TRUE));
		$description 	= trim($this->input->post('description', TRUE));
		$varieties_id 	= trim($this->input->post('varieties_id', TRUE));
		
		$data = array(
			'product' 			=> $product,
			'description' 		=> $description,
			'varieties_id' 		=> $varieties_id
		);

		if($this->modelo->editProduct($data, $id))
			echo '1';
		else
			echo '0';
	}

	public function deleteProduct()
	{
		$id = trim($this->input->post('id', TRUE)); 
		if($this->modelo->deleteProduct($id))
			echo '1';
		else
			echo '0';
	}
}

?>