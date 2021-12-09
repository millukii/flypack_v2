<?php

class CContainers extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('MContainers', 'modelo');
	}

	public function index()
	{
		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('containers/index');
	}

	//Datatable
	public function datatable()
	{
		$start = $this->input->post('start');
		$length = $this->input->post('length');
		$search = $this->input->post('search')['value'];
		$by = $this->input->post('order')['0']['column'];
		$order = $this->input->post('order')['0']['dir'];

		$result = $this->modelo->getContainers($start, $length, $search, $order, $by);

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
		$products = $this->modelo->getProducts();
		$units = $this->modelo->getUnits();

		$data = array(
			'products' => $products,
			'units' => $units
		);

		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('containers/add', $data);
	}

	public function edit()
	{
		$id = trim($this->input->get('id', TRUE));

		$container = $this->modelo->getContainer($id);
		$products = $this->modelo->getProducts();
		$units = $this->modelo->getUnits();

		$data = array(
			'container' => $container,
			'products' => $products,
			'units' => $units
		);

		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('containers/edit', $data);
	}

	public function view()
	{
		$id = trim($this->input->get('id', TRUE));

		$container = $this->modelo->getContainer($id);

		$data = array(
			'container' => $container
		);

		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('containers/view', $data);
	}

	public function addContainer()
	{
		$container 			= 	trim($this->input->post('container', TRUE));
		$products_id 		= 	trim($this->input->post('products_id', TRUE));
		$weight 			= 	trim($this->input->post('weight', TRUE));
		$units_id 			= 	trim($this->input->post('units_id', TRUE));
		$value_payment 		= 	trim($this->input->post('value_payment', TRUE));
		$value_sale 		= 	trim($this->input->post('value_sale', TRUE));

		$date_time = date('Y-m-d H:i:s');

		$data = array(
			'container' 				=> $container,
			'products_id' 				=> $products_id,
			'weight' 					=> $weight,
			'units_id' 					=> $units_id,
			'value_payment' 			=> $value_payment,
			'value_sale' 				=> $value_sale,
			'created'					=> $date_time
		);

		if($this->modelo->addContainer($data))
			echo '1';
		else
			echo '0';
	}

	public function editContainer()
	{
		$id 				= 	trim($this->input->post('id', TRUE));
		$container 			= 	trim($this->input->post('container', TRUE));
		$products_id 		= 	trim($this->input->post('products_id', TRUE));
		$weight 			= 	trim($this->input->post('weight', TRUE));
		$units_id 			= 	trim($this->input->post('units_id', TRUE));
		$value_payment 		= 	trim($this->input->post('value_payment', TRUE));
		$value_sale 		= 	trim($this->input->post('value_sale', TRUE));

		$data = array(
			'container' 				=> $container,
			'products_id' 				=> $products_id,
			'weight' 					=> $weight,
			'units_id' 					=> $units_id,
			'value_payment' 			=> $value_payment,
			'value_sale' 				=> $value_sale
		);

		if($this->modelo->editContainer($data, $id))
			echo '1';
		else
			echo '0';
	}

	public function deleteContainer()
	{
		$id 	= 	trim($this->input->post('id', TRUE));

		if($this->modelo->deleteContainer($id))
			echo '1';
		else
			echo '0';
	}
}

?>