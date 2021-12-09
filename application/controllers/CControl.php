<?php

class CControl extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('MControl', 'modelo');
	}

	public function index()
	{
		$orchards = $this->modelo->getOrchards();
		$process = $this->modelo->getProcess();

		$data = array(
			'orchards' => $orchards,
			'process' => $process
		);

		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('control/index', $data);
	}

	public function getQuarters_Orchard()
	{
		$orchards_id = trim($this->input->post('orchards_id', TRUE));
		$quarters = $this->modelo->getQuarters($orchards_id);

		echo json_encode($quarters);
	}

	public function getProducts_Quarter()
	{
		$quarter_id = trim($this->input->post('quarter_id', TRUE));

		//-----------------------------------
		$this->db->select('products.id as id, products.product as product, varieties.variety as variety');

		$this->db->join('products', 'products.id = quarter_product.products_id');
		$this->db->join('varieties', 'varieties.id = products.varieties_id');

		$this->db->from('quarter_product');
		$this->db->where('quarters_id', $quarter_id);

		$products = $this->db->get()->result_array();
		//-----------------------------------
		if(!empty($products))
			$container = $this->modelo->getContainer($products[0]['id']);
		else
			$container = $this->modelo->getContainer(0);

		$data = array(
			'container' => $container,
			'product' => $products
		);

		echo json_encode($data);
	}

	public function getPeople_Rut()
	{
		$rut = trim($this->input->post('rut', TRUE));
		$people = $this->modelo->getPeople($rut);

		echo json_encode($people);
	}

	public function addProduction()
	{
		$date_time = date('Y-m-d H:i:s');
		$new_date = date("Y-m-d",strtotime($date_time));

		$quantity 				= trim($this->input->post('quantity', TRUE));
		$containers_id 			= trim($this->input->post('containers_id', TRUE));
		$products_id 			= trim($this->input->post('products_id', TRUE));
		$people_id 				= trim($this->input->post('people_id', TRUE));
		$process_id 			= trim($this->input->post('process_id', TRUE));
		$quarters_id 			= trim($this->input->post('quarters_id', TRUE));
		$controller_id 			= $this->session->userdata('users_id');
		$value_payment 			= trim($this->input->post('value_payment', TRUE));
		$value_sale 			= trim($this->input->post('value_sale', TRUE));
		$date 					= $date_time;

		$people_   				= $this->modelo->getPeople_($people_id);
		

		if(!empty($people_))
		{
			if($people_[0]['people_states_id'] == 1)
			{
				$data = array(
					'quantity'			=>		$quantity,
					'containers_id'		=>		$containers_id,
					'products_id'		=> 		$products_id,
					'people_id'			=>		$people_id,
					'process_id'		=>		$process_id,
					'quarters_id'		=>		$quarters_id,
					'controller_id'		=>		$controller_id,
					'value_payment'		=>		$value_payment,
					'value_sale'		=>		$value_sale,
					'date'				=>		$date
				);

				$add_production = $this->modelo->addProduction($data);

				if( $add_production != false)
				{
					$production_day_people 	= $this->modelo->getProductionDayPeople($people_id, $new_date);

					if(!empty($production_day_people[0]['quantity']))
						$production_day_people = $production_day_people[0]['quantity'];
					else
						$production_day_people = 0;

					$res = '<font color="green">ÚLTIMO REGISTRO:'.date('d-m-Y H:i:s', strtotime($date_time)).'</font><br><font color="red">'.$people_[0]['rut'].'-'.$people_[0]['dv'].' | '.$people_[0]['name'].' '.$people_[0]['lastname'].'</font><br><font color="blue">'.'ACUMULADO DIARIO: '.$production_day_people.'</font><br>'.'<button class="btn btn-danger" onclick="deleteProduction('.$add_production.');">Eliminar último</button>';

					echo $res;
				}
				else
					echo '0';
			}
			else
				echo '0';
			
		}
		else
			echo '0';
	}

	public function getContainer_Product()
	{
		$products_id = trim($this->input->post('products_id', TRUE));
		$container = $this->modelo->getContainer($products_id);

		$data = array(
			'container' => $container
		);

		echo json_encode($data);
	}

	public function add_out_of_date()
	{
		$date_time = date('Y-m-d H:i:s');

		$n = trim($this->input->post('n', TRUE));
		$people_id = trim($this->input->post('people_id', TRUE));
		$containers_id = trim($this->input->post('containers_id', TRUE));
		$products_id = trim($this->input->post('products_id', TRUE));
		$process_id = trim($this->input->post('process_id', TRUE));
		$quarters_id = trim($this->input->post('quarters_id', TRUE));
		$controller_id = $this->session->userdata('users_id');
		$date = trim($this->input->post('date', TRUE));
		$value_payment = trim($this->input->post('value_payment', TRUE));
		$value_sale = trim($this->input->post('value_sale', TRUE));

		for($i = 0; $i < $n; $i++)
		{
			$data = array(
				'quantity'			=>		1,
				'containers_id'		=>		$containers_id,
				'products_id'		=> 		$products_id,
				'people_id'			=>		$people_id,
				'process_id'		=>		$process_id,
				'quarters_id'		=>		$quarters_id,
				'controller_id'		=>		$controller_id,
				'value_payment'		=>		$value_payment,
				'value_sale'		=>		$value_sale,
				'date'				=>		$date.' 11:30:00'
			);

			$this->modelo->addProduction($data);
		}

		$arr_log = array(
			'cantidad' => $n,
			'people_id' => $people_id,
			'containers_id' => $containers_id,
			'products_id' => $products_id,
			'process_id' => $process_id,
			'quarters_id' => $quarters_id,
			'controller_id' => $controller_id,
			'date' => $date,
		);

		$arr_log = serialize($arr_log);

		$data = array(
			'description' => $arr_log,
			'subject' => 'PRODUCCIÓN',
			'actions_id' => 8,
			'users_id' => $this->session->userdata('users_id'),
			'created' => $date_time
		);


		if($this->db->insert('logs', $data))
			echo '1';
		else
			echo '0';
	}
	
	public function remove_out_of_date()
	{
		$date_time = date('Y-m-d H:i:s');

		$n = trim($this->input->post('n', TRUE));
		$people_id = trim($this->input->post('people_id', TRUE));
		$containers_id = trim($this->input->post('containers_id', TRUE));
		$products_id = trim($this->input->post('products_id', TRUE));
		$process_id = trim($this->input->post('process_id', TRUE));
		$quarters_id = trim($this->input->post('quarters_id', TRUE));
		$controller_id = $this->session->userdata('users_id');
		$date = trim($this->input->post('date', TRUE));
		$value_payment = trim($this->input->post('value_payment', TRUE));
		$value_sale = trim($this->input->post('value_sale', TRUE));
		
		$sql_custom = 'DELETE FROM production WHERE 
		               people_id = '.$people_id.' 
		               AND containers_id = '.$containers_id.' 
		               AND products_id = '.$products_id.' 
		               AND process_id = '.$process_id.' 
		               AND quarters_id = '.$quarters_id.' 
		               AND DATE(date) = "'.$date.'"  
		               ORDER BY id DESC LIMIT '.$n;

        if($this->db->query($sql_custom))
        {
            $arr_log = array(
    			'cantidad' => $n,
    			'people_id' => $people_id,
    			'containers_id' => $containers_id,
    			'products_id' => $products_id,
    			'process_id' => $process_id,
    			'quarters_id' => $quarters_id,
    			'controller_id' => $controller_id,
    			'date' => $date,
    		);
    
    		$arr_log = serialize($arr_log);
    
    		$data = array(
    			'description' => $arr_log,
    			'subject' => 'PRODUCCIÓN',
    			'actions_id' => 9,
    			'users_id' => $this->session->userdata('users_id'),
    			'created' => $date_time
    		);
    
    
    		if($this->db->insert('logs', $data))
    			echo '1';
    		else
    			echo '0';
        }
        else
            echo '0';
	}
}

?>