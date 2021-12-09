<?php

class CProduction extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('MProduction', 'modelo');
	}

	public function index()
	{
		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('production/index');
	}

	//Datatable
	public function datatable()
	{
		$start = $this->input->post('start');
		$length = $this->input->post('length');
		$search = $this->input->post('search')['value'];
		$by = $this->input->post('order')['0']['column'];
		$order = $this->input->post('order')['0']['dir'];

		$result = $this->modelo->getProductions($start, $length, $search, $order, $by);

		$json_data = array(
			"draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($result['numDataTotal']),
            "recordsFiltered" => intval($result['numDataFilter']),
            "data"            => $result['data']
            );

        echo json_encode($json_data);
	}

	public function view()
	{
		$id = trim($this->input->get('id', TRUE));

		$production = $this->modelo->getProduction($id);

		$data = array(
			'production' => $production
		);

		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('production/view', $data);
	}

	public function report()
	{
		$orchards = $this->modelo->getOrchards();
		$quarters = $this->modelo->getQuarters();
		$people = $this->modelo->getPeople();
		$products = $this->modelo->getProducts();
		$contractor = $this->modelo->getContractor();

		$data = array(
			'orchards' => $orchards,
			'quarters' => $quarters,
			'people' => $people,
			'products' => $products,
			'contractor' => $contractor
		);
		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('production/report', $data);
	}

	public function asist()
	{
		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('production/asist');
	}

	public function deleteProduction()
	{
		$date_time = date('Y-m-d H:i:s');

		$id = trim($this->input->post('id', TRUE));

		$production =  serialize($this->modelo->getProduction($id));

		$data = array(
			'description' => $production,
			'subject' => 'PRODUCCIÓN',
			'actions_id' => 3,
			'users_id' => $this->session->userdata('users_id'),
			'created' => $date_time
		);


		if($this->db->insert('logs', $data))
		{
			if($this->modelo->deleteProduction($id))
				echo '1';
			else
				echo '0';
		}
		else
			echo '0';
	}

	//-----------------------------

	public function generateReport()
	{
		$radio_date = trim($this->input->post('radio_date', TRUE));
		$type = trim($this->input->post('type', TRUE));

		if($radio_date == 1)
		{
			$date = trim($this->input->post('date', TRUE));

			if($type == 1)
			{
				$orchard = trim($this->input->post('orchard', TRUE));
				
				$data = $this->modelo->getReportDate($date, $type, $orchard);
				$indice = 0;
				foreach($data as $d)
				{
					$data[$indice]['contractor'] = $this->modelo->getContractorId($d['contractor']);
					$indice++;
				}
				echo json_encode($data);
			}
			else if($type == 2)
			{
				$quarter = trim($this->input->post('quarter', TRUE));
				
				$data = $this->modelo->getReportDate($date, $type, $quarter);
				$indice = 0;
				foreach($data as $d)
				{
					$data[$indice]['contractor'] = $this->modelo->getContractorId($d['contractor']);
					$indice++;
				}
				echo json_encode($data);
			}
			else if($type == 3)
			{
				$people = trim($this->input->post('people', TRUE));
				
				$data = $this->modelo->getReportDate($date, $type, $people);
				$indice = 0;
				foreach($data as $d)
				{
					$data[$indice]['contractor'] = $this->modelo->getContractorId($d['contractor']);
					$indice++;
				}
				echo json_encode($data);
			}
			else if($type == 4)
			{
				$product = trim($this->input->post('product', TRUE));
				
				$data = $this->modelo->getReportDate($date, $type, $product);
				$indice = 0;
				foreach($data as $d)
				{
					$data[$indice]['contractor'] = $this->modelo->getContractorId($d['contractor']);
					$indice++;
				}
				echo json_encode($data);
			}
			else if($type == 5)
			{
				$contractor = trim($this->input->post('contractor', TRUE));
				
				$data = $this->modelo->getReportDate($date, $type, $contractor);
				$indice = 0;
				foreach($data as $d)
				{
					$data[$indice]['contractor'] = $this->modelo->getContractorId($d['contractor']);
					$indice++;
				}
				echo json_encode($data);
			}
		}
		else if($radio_date == 2)
		{
			$date_init = trim($this->input->post('date_init', TRUE));
			$date_end = trim($this->input->post('date_end', TRUE));

			if($type == 1)
			{
				$orchard = trim($this->input->post('orchard', TRUE));
				
				$data = $this->modelo->getReportInterval($date_init, $date_end, $type, $orchard);
				//echo 'hola';
				$indice = 0;
				foreach($data as $d)
				{
					$data[$indice]['contractor'] = $this->modelo->getContractorId($d['contractor']);
					$indice++;
				}
				echo json_encode($data);
				
			}
			else if($type == 2)
			{
				$quarter = trim($this->input->post('quarter', TRUE));
				
				$data = $this->modelo->getReportInterval($date_init, $date_end, $type, $quarter);
				$indice = 0;
				foreach($data as $d)
				{
					$data[$indice]['contractor'] = $this->modelo->getContractorId($d['contractor']);
					$indice++;
				}
				echo json_encode($data);
				
			}
			else if($type == 3)
			{
				$people = trim($this->input->post('people', TRUE));
				
				$data = $this->modelo->getReportInterval($date_init, $date_end, $type, $people);
				$indice = 0;
				foreach($data as $d)
				{
					$data[$indice]['contractor'] = $this->modelo->getContractorId($d['contractor']);
					$indice++;
				}
				echo json_encode($data);
				
			}
			else if($type == 4)
			{
				$product = trim($this->input->post('product', TRUE));
				
				$data = $this->modelo->getReportInterval($date_init, $date_end, $type, $product);
				$indice = 0;
				foreach($data as $d)
				{
					$data[$indice]['contractor'] = $this->modelo->getContractorId($d['contractor']);
					$indice++;
				}
				echo json_encode($data);
				
			}
			else if($type == 5)
			{
				$contractor = trim($this->input->post('contractor', TRUE));
				
				$data = $this->modelo->getReportInterval($date_init, $date_end, $type, $contractor);
				$indice = 0;
				foreach($data as $d)
				{
					$data[$indice]['contractor'] = $this->modelo->getContractorId($d['contractor']);
					$indice++;
				}
				echo json_encode($data);
			}
		}
		else if($radio_date == 0)
		{
			$year = trim($this->input->post('year', TRUE));
			$month = trim($this->input->post('month', TRUE));

			if($type == 1)
			{
				$orchard = trim($this->input->post('orchard', TRUE));
				
				$data = $this->modelo->getReportYearMonth($year, $month, $type, $orchard);
				$indice = 0;
				foreach($data as $d)
				{
					$data[$indice]['contractor'] = $this->modelo->getContractorId($d['contractor']);
					$indice++;
				}
				echo json_encode($data);
				
			}
			else if($type == 2)
			{
				$quarter = trim($this->input->post('quarter', TRUE));
				
				$data = $this->modelo->getReportYearMonth($year, $month, $type, $quarter);
				$indice = 0;
				foreach($data as $d)
				{
					$data[$indice]['contractor'] = $this->modelo->getContractorId($d['contractor']);
					$indice++;
				}
				echo json_encode($data);
				
			}
			else if($type == 3)
			{
				$people = trim($this->input->post('people', TRUE));
				
				$data = $this->modelo->getReportYearMonth($year, $month, $type, $people);
				$indice = 0;
				foreach($data as $d)
				{
					$data[$indice]['contractor'] = $this->modelo->getContractorId($d['contractor']);
					$indice++;
				}
				echo json_encode($data);
				
			}
			else if($type == 4)
			{
				$product = trim($this->input->post('product', TRUE));
				
				$data = $this->modelo->getReportYearMonth($year, $month, $type, $product);
				$indice = 0;
				foreach($data as $d)
				{
					$data[$indice]['contractor'] = $this->modelo->getContractorId($d['contractor']);
					$indice++;
				}
				echo json_encode($data);
			}
			else if($type == 5)
			{
				$contractor = trim($this->input->post('contractor', TRUE));
				
				$data = $this->modelo->getReportYearMonth($year, $month, $type, $contractor);
				$indice = 0;
				foreach($data as $d)
				{
					$data[$indice]['contractor'] = $this->modelo->getContractorId($d['contractor']);
					$indice++;
				}
				echo json_encode($data);
			}

		}
	}


	public function reportAsist()
	{
		$year = trim($this->input->post('year', TRUE));
		$month = trim($this->input->post('month', TRUE));

		$data = $this->modelo->getReportYearMonthAsist($year, $month);

		echo json_encode($data);
	}

	public function response()
	{
		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('production/index_response');
	}

	public function add_response()
	{
		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('production/add_response');
	}

	public function edit_response()
	{
		$id = trim($this->input->get('id', TRUE));

		$response = $this->modelo->getResponse_($id);

		
		$data = array(
			'response' => $response
		);

		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('production/edit_response', $data);
		
	}

	public function getRenderResponse()
	{
		$date = trim($this->input->post('date', TRUE));
		$product = trim($this->input->post('product', TRUE));

		echo $this->modelo->getProductsQuantity($date, $product);
	}

	//Datatable response
	public function datatable_response()
	{
		$start = $this->input->post('start');
		$length = $this->input->post('length');
		$search = $this->input->post('search')['value'];
		$by = $this->input->post('order')['0']['column'];
		$order = $this->input->post('order')['0']['dir'];

		$result = $this->modelo->getResponse($start, $length, $search, $order, $by);

		$json_data = array(
			"draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($result['numDataTotal']),
            "recordsFiltered" => intval($result['numDataFilter']),
            "data"            => $result['data']
            );

        echo json_encode($json_data);
	}

	public function addResponse()
	{
		$date = trim($this->input->post('date', TRUE));
		$products_id = trim($this->input->post('products_id', TRUE));
		$weight = trim($this->input->post('weight', TRUE));
		$quantity = trim($this->input->post('quantity', TRUE));
		$w_q = trim($this->input->post('w_q', TRUE));

		$data = array(
			'date' => $date,
			'products_id' => $products_id,
			'weight' => $weight,
			'quantity' => $quantity,
			'w_q' => $w_q
		);

		if($this->modelo->addResponse($data))
			echo '1';
		else
			echo '0';
	}

	public function editResponse()
	{
		$id = trim($this->input->post('id', TRUE));

		$date = trim($this->input->post('date', TRUE));
		$products_id = trim($this->input->post('products_id', TRUE));
		$weight = trim($this->input->post('weight', TRUE));
		$quantity = trim($this->input->post('quantity', TRUE));
		$w_q = trim($this->input->post('w_q', TRUE));

		$data = array(
			'date' => $date,
			'products_id' => $products_id,
			'weight' => $weight,
			'quantity' => $quantity,
			'w_q' => $w_q
		);

		if($this->modelo->editResponse($data, $id))
			echo '1';
		else
			echo '0';
	}

	public function deleteResponse()
	{
		$id = trim($this->input->post('id', TRUE));

		if($this->modelo->deleteResponse($id))
			echo '1';
		else
			echo '0';
	}

	public function report_response()
	{
		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('production/report_response');
	}

	public function getReportResponse()
	{
		$year = trim($this->input->get('year', TRUE));

		$this->load->library('fpdf/fpdf.php');
		require_once('./application/libraries/barcode.php');

		$pdf = new Fpdf();
		$pdf->AddPage('L', 'A4', 0);
		$pdf->SetAutoPageBreak(true, 20);
		//$y = $pdf->GetY();
		
		$pdf->SetFont('Arial', 'B', 12);
		$pdf->Cell(276, 5, 'RESUMEN TEMPORADA '.$year, 0, 0, 'C');
		$pdf->Ln();

		$pdf->SetFont('Times', '', 10);
		$pdf->Cell(276, 10, 'Listado Resumenes Diarios', 0, 0, 'C');
		$pdf->Ln(20);

		$pdf->SetFont('Times', 'B', 10);
		$pdf->Cell(20, 10, 'ID', 1, 0, 'C');
		$pdf->Cell(40, 10, 'Fecha', 1, 0, 'C');
		$pdf->Cell(60, 10, 'Variedad', 1, 0, 'C');
		$pdf->Cell(30, 10, 'KG', 1, 0, 'C');
		$pdf->Cell(30, 10, 'Cajas', 1, 0, 'C');
		$pdf->Cell(30, 10, 'KPC', 1, 0, 'C');
		$pdf->Cell(30, 10, 'Total', 1, 0, 'C');
		$pdf->Ln();

		//list products 
		$this->db->select('id');
		$this->db->from('products');
		$products = $this->db->get()->result_array();
		//end list products
		if(!empty($products))
		{
			foreach($products as $p)
			{
				$res = $this->modelo->generateReportResumenDiario($year, $p['id']);
				if(!empty($res))
				{
					$sum_total = 0;

					foreach($res as $r)
					{
						$sum_total += $r['weight'];

						$pdf->SetFont('Times', '', 10);
						$pdf->Cell(20, 10, $r['id'], 1, 0, 'C');
						$pdf->Cell(40, 10, $r['date'], 1, 0, 'C');
						$pdf->Cell(60, 10, $r['product'].' | '.$r['variety'], 1, 0, 'C');
						$pdf->Cell(30, 10, $r['weight'], 1, 0, 'C');
						$pdf->Cell(30, 10, $r['quantity'], 1, 0, 'C');
						$pdf->Cell(30, 10, $r['w_q'], 1, 0, 'C');
						$pdf->Cell(30, 10, $sum_total, 1, 0, 'C');
						$pdf->Ln();

						//------------------------------------
						
					}
				}
			}
		}


		
		$pdf->Output();	
	}

	//--------- 26/02/2020

	public function add_out_date()
	{
		$this->load->model('MControl');

		$this->db->select('id, rut, name, lastname');
		$this->db->from('people');
		$this->db->where('people_states_id', 1);
		$this->db->order_by('rut', 'asc');
		$people = $this->db->get()->result_array();

		$orchards = $this->MControl->getOrchards();
		$process = $this->MControl->getProcess();

		$data = array(
			'orchards' => $orchards,
			'process' => $process,
			'people' => $people
		);

		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('production/add_out_of_date', $data);
	}

	public function generateReport_resumen()
	{
		$radio_date = trim($this->input->post('radio_date', TRUE));
		$type = trim($this->input->post('type', TRUE));

		if($radio_date == 1)
		{
			$date = trim($this->input->post('date', TRUE));

			if($type == 1)
			{
				$orchard = trim($this->input->post('orchard', TRUE));
				
				$data = $this->modelo->getReportDate_resumen($date, $type, $orchard);
				$indice = 0;
				foreach($data as $d)
				{
					$data[$indice]['contractor'] = $this->modelo->getContractorId($d['contractor']);
					$indice++;
				}
				echo json_encode($data);
			}
			else if($type == 2)
			{
				$quarter = trim($this->input->post('quarter', TRUE));
				
				$data = $this->modelo->getReportDate_resumen($date, $type, $quarter);
				$indice = 0;
				foreach($data as $d)
				{
					$data[$indice]['contractor'] = $this->modelo->getContractorId($d['contractor']);
					$indice++;
				}
				echo json_encode($data);
			}
			else if($type == 3)
			{
				$people = trim($this->input->post('people', TRUE));
				
				$data = $this->modelo->getReportDate_resumen($date, $type, $people);
				$indice = 0;
				foreach($data as $d)
				{
					$data[$indice]['contractor'] = $this->modelo->getContractorId($d['contractor']);
					$indice++;
				}
				echo json_encode($data);
			}
			else if($type == 4)
			{
				$product = trim($this->input->post('product', TRUE));
				
				$data = $this->modelo->getReportDate_resumen($date, $type, $product);
				$indice = 0;
				foreach($data as $d)
				{
					$data[$indice]['contractor'] = $this->modelo->getContractorId($d['contractor']);
					$indice++;
				}
				echo json_encode($data);
			}
			else if($type == 5)
			{
				$contractor = trim($this->input->post('contractor', TRUE));
				
				$data = $this->modelo->getReportDate_resumen($date, $type, $contractor);
				$indice = 0;
				foreach($data as $d)
				{
					$data[$indice]['contractor'] = $this->modelo->getContractorId($d['contractor']);
					$indice++;
				}
				echo json_encode($data);
			}
		}
		else if($radio_date == 2)
		{
			$date_init = trim($this->input->post('date_init', TRUE));
			$date_end = trim($this->input->post('date_end', TRUE));

			if($type == 1)
			{
				$orchard = trim($this->input->post('orchard', TRUE));
				//echo 'hola2';
				$data = $this->modelo->getReportInterval_resumen($date_init, $date_end, $type, $orchard);
				$indice = 0;
				foreach($data as $d)
				{
					$data[$indice]['contractor'] = $this->modelo->getContractorId($d['contractor']);
					$indice++;
				}
				echo json_encode($data);
				
			}
			else if($type == 2)
			{
				$quarter = trim($this->input->post('quarter', TRUE));
				
				$data = $this->modelo->getReportInterval_resumen($date_init, $date_end, $type, $quarter);
				$indice = 0;
				foreach($data as $d)
				{
					$data[$indice]['contractor'] = $this->modelo->getContractorId($d['contractor']);
					$indice++;
				}
				echo json_encode($data);
				
			}
			else if($type == 3)
			{
				$people = trim($this->input->post('people', TRUE));
				
				$data = $this->modelo->getReportInterval_resumen($date_init, $date_end, $type, $people);
				$indice = 0;
				foreach($data as $d)
				{
					$data[$indice]['contractor'] = $this->modelo->getContractorId($d['contractor']);
					$indice++;
				}
				echo json_encode($data);
				
			}
			else if($type == 4)
			{
				$product = trim($this->input->post('product', TRUE));
				
				$data = $this->modelo->getReportInterval_resumen($date_init, $date_end, $type, $product);
				$indice = 0;
				foreach($data as $d)
				{
					$data[$indice]['contractor'] = $this->modelo->getContractorId($d['contractor']);
					$indice++;
				}
				echo json_encode($data);
				
			}
			else if($type == 5)
			{
				$contractor = trim($this->input->post('contractor', TRUE));
				
				$data = $this->modelo->getReportInterval_resumen($date_init, $date_end, $type, $contractor);
				$indice = 0;
				foreach($data as $d)
				{
					$data[$indice]['contractor'] = $this->modelo->getContractorId($d['contractor']);
					$indice++;
				}
				echo json_encode($data);
				
			}
		}
		else if($radio_date == 0)
		{
			$year = trim($this->input->post('year', TRUE));
			$month = trim($this->input->post('month', TRUE));

			if($type == 1)
			{
				$orchard = trim($this->input->post('orchard', TRUE));
				
				$data = $this->modelo->getReportYearMonth_resumen($year, $month, $type, $orchard);
				$indice = 0;
				foreach($data as $d)
				{
					$data[$indice]['contractor'] = $this->modelo->getContractorId($d['contractor']);
					$indice++;
				}
				echo json_encode($data);
				
			}
			else if($type == 2)
			{
				$quarter = trim($this->input->post('quarter', TRUE));
				
				$data = $this->modelo->getReportYearMonth_resumen($year, $month, $type, $quarter);
				$indice = 0;
				foreach($data as $d)
				{
					$data[$indice]['contractor'] = $this->modelo->getContractorId($d['contractor']);
					$indice++;
				}
				echo json_encode($data);
				
			}
			else if($type == 3)
			{
				$people = trim($this->input->post('people', TRUE));
				
				$data = $this->modelo->getReportYearMonth_resumen($year, $month, $type, $people);
				$indice = 0;
				foreach($data as $d)
				{
					$data[$indice]['contractor'] = $this->modelo->getContractorId($d['contractor']);
					$indice++;
				}
				echo json_encode($data);
				
			}
			else if($type == 4)
			{
				$product = trim($this->input->post('product', TRUE));
				
				$data = $this->modelo->getReportYearMonth_resumen($year, $month, $type, $product);
				$indice = 0;
				foreach($data as $d)
				{
					$data[$indice]['contractor'] = $this->modelo->getContractorId($d['contractor']);
					$indice++;
				}
				echo json_encode($data);
			}
			else if($type == 5)
			{
				$contractor = trim($this->input->post('contractor', TRUE));
				
				$data = $this->modelo->getReportYearMonth_resumen($year, $month, $type, $contractor);
				$indice = 0;
				foreach($data as $d)
				{
					$data[$indice]['contractor'] = $this->modelo->getContractorId($d['contractor']);
					$indice++;
				}
				echo json_encode($data);
			}
		}
	}
	
}

?>