<?php

class CQuarters extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('MQuarters', 'modelo');
	}

	public function index()
	{
		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('quarters/index');
	}

	//Datatable
	public function datatable()
	{
		$start = $this->input->post('start');
		$length = $this->input->post('length');
		$search = $this->input->post('search')['value'];
		$by = $this->input->post('order')['0']['column'];
		$order = $this->input->post('order')['0']['dir'];

		$result = $this->modelo->getQuarters($start, $length, $search, $order, $by);

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
		$orchards = $this->modelo->getOrchards();
		$products = $this->modelo->getProducts();

		$data = array(
			'orchards' => $orchards,
			'products' => $products
		);

		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('quarters/add', $data);
	}

	public function edit()
	{
		$id = trim($this->input->get('id', TRUE));

		$quarter = $this->modelo->getQuarter($id);
		$orchards = $this->modelo->getOrchards();
		$products = $this->modelo->getProducts();

		$products_quarter = $this->modelo->getProducts_Quarter($id);

		$data = array(
			'quarters' => $quarter,
			'orchards' => $orchards,
			'products' => $products,
			'products_quarter' => $products_quarter
		);

		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('quarters/edit', $data);
	}

	public function view()
	{
		$id = trim($this->input->get('id', TRUE));

		$quarter = $this->modelo->getQuarter($id);
		$products = $this->modelo->getProducts_Quarter($id);

		$data = array(
			'quarters' => $quarter,
			'products' => $products
		);

		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('quarters/view', $data);
	}

	//Crud
	public function addQuarter()
	{
		$number 			= trim($this->input->post('number', TRUE));
		$quarter 			= trim($this->input->post('quarter', TRUE));
		$orchards_id 		= trim($this->input->post('orchards_id', TRUE));
		$products 			= $this->input->post('products', TRUE);
		
		$date_time = date('Y-m-d H:i:s');

		$data = array(
			'number' => $number,
			'quarter' => $quarter,
			'orchards_id' => $orchards_id,
			'created' => $date_time
		);

		$last_id = $this->modelo->addQuarter($data);

		if($last_id != false)
		{
			if(!empty($products))
			{
				foreach($products as $p)
				{
					$data_products = array(
						'quarters_id' => $last_id,
						'products_id' => $p
					);

					$this->modelo->addQuarter_Product($data_products);
				}
				
			}
			echo '1';
		}
		else
			echo '0';
	}

	public function editQuarter()
	{
		$id 				= trim($this->input->post('id', TRUE));

		$number 			= trim($this->input->post('number', TRUE));
		$quarter 			= trim($this->input->post('quarter', TRUE));
		$orchards_id 		= trim($this->input->post('orchards_id', TRUE));
		$products			= $this->input->post('products', TRUE);

		$data = array(
			'number' => $number,
			'quarter' => $quarter,
			'orchards_id' => $orchards_id
		);

		if($this->modelo->editQuarter($data, $id))
		{
			if($this->modelo->deleteQuarters_Product($id))
			{
				if(!empty($products))
				{
					foreach($products as $p)
					{
						$data_products = array(
							'quarters_id' => $id,
							'products_id' => $p
						);

						$this->modelo->addQuarter_Product($data_products);
					}
					
				}
				echo '1';
			}
			else
				echo '0';
			
		}
		else
			echo '0';
	}

	public function deleteQuarter()
	{
		$id = trim($this->input->post('id', TRUE)); 
		if($this->modelo->deleteQuarter($id))
			echo '1';
		else
			echo '0';
	}
}

?>