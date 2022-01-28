<?php

class CPrices extends CI_Controller {

	private $letters;

	function __construct()
	{
		parent::__construct();
		$this->load->model('MPrices', 'modelo');
		$this->letters = [
							'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z',
							'AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ'
						];
	}

	public function index()
	{
		$companies = $this->modelo->getAllCompanies();

		$data = array(
			'companies' => $companies
		);

		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('prices/index', $data);
	}

	public function datatable()
	{
		$start = $this->input->post('start');
		$length = $this->input->post('length');
		$search = $this->input->post('search')['value'];
		$by = $this->input->post('order')['0']['column'];
		$order = $this->input->post('order')['0']['dir'];

		$company = trim($this->input->post('company', TRUE));

		$result = $this->modelo->getPrices($start, $length, $search, $order, $by, $company);

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
		$value 	= trim($this->input->post('value', TRUE));
		
		$data = array(
			'value' 	=> $value
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

	public function import_excelfile()
	{
		$company 			= trim($this->input->post('input-company',TRUE));
		
		$this->db->where('companies_id', $company);
		$this->db->delete('rates');

		$this->load->library('excel');

		$ruta = './assets/excel/';
        if (!file_exists($ruta)) {
            mkdir($ruta, 0777, true);
        }

        foreach($_FILES as $key) {
	        if($key['error'] == UPLOAD_ERR_OK) {
	            $nombreArchivo = $key['name'];
	            $temporal = $key['tmp_name'];
	            $destino = $ruta.$nombreArchivo;

	            move_uploaded_file($temporal, $destino);
	            
	            $objReader = PHPExcel_IOFactory::createReader('Excel2007');
	            $objReader->setReadDataOnly(true);

	            $objPHPExcel = $objReader->load($destino);
	            //$objWhorksheet = $objPHPExcel->getActiveSheet();

	            $filas = $objPHPExcel->getActiveSheet()->getHighestRow();

	            for ($i=2; $i <= $filas ; $i++)
	            { 
					$from =  $objPHPExcel->getActiveSheet()->getCell($this->letters[0].$i)->getValue();
					for($j=2; $j <= $filas; $j++)
					{
						$to = $objPHPExcel->getActiveSheet()->getCell($this->letters[0].$j)->getValue();
						$value = $objPHPExcel->getActiveSheet()->getCell($this->letters[$j].$i)->getValue();
						
						if(empty($from))
							$fom = 'N/A';

						if(empty($to))
							$to = 'N/A';

						if(empty($value))
							$value = 0;
						
						$value = str_replace('$','',$value);
						$value = str_replace('.','',$value);
						$value = str_replace(',','',$value);

						$data = array(
							'from' => strtoupper($from),
							'to' => strtoupper($to),
							'value' => $value,
							'companies_id' => $company
						);

						$this->db->insert('rates', $data);
					}

	            }
				unlink($destino);
    		}
	    }
	    
	    header("Location: ".base_url()."index.php/CPrices/index");
	}

	public function export_excelfile()
	{
		$this->load->library('Excel');

		$ruta = './assets/excel/';
        if (!file_exists($ruta)) {
            mkdir($ruta, 0777, true);
        }

		$company = trim($this->input->get('company',TRUE));

		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);

		$objPHPExcel->getActiveSheet()->SetCellValue('A1', "hola");
		$objPHPExcel->getActiveSheet()->SetCellValue('B1',"chao");

		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
		//$objWriter->save($ruta.'precios_'.date('Ymd').'.xlsx');

		// We'll be outputting an excel file
		header('Content-type: application/vnd.ms-excel');

		// It will be called file.xls
		header('Content-Disposition: attachment; filename="precios_'.date('Ymd').'.xlsx"');

		// Write file to the browser
		$objWriter->save('php://output');
	}
}

?>