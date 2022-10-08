<?php

class CMasive extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('MMasive', 'modelo');
	}

	public function index()
	{
		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('masive/index');
	}

	public function excelfile()
	{
		$this->load->library('excel');

		$ruta = './assets/excel/';
        if (!file_exists($ruta)) {
            mkdir($ruta, 0777, true);
        }

        $mensaje = '';
        $date_time = date('Y-m-d H:i:s');

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

	            $letras = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');

	            for ($i=2; $i <= $filas ; $i++)
	            { 
					if(!empty($objPHPExcel->getActiveSheet()->getCell($letras[0].$i)->getValue())){
						$data = array(
							'order_nro' 			=> ($objPHPExcel->getActiveSheet()->getCell($letras[0].$i)->getValue() != '' ? $objPHPExcel->getActiveSheet()->getCell($letras[0].$i)->getValue() : ''),
							'total_amount' 			=> ($objPHPExcel->getActiveSheet()->getCell($letras[1].$i)->getValue() != '' ? $objPHPExcel->getActiveSheet()->getCell($letras[1].$i)->getValue() : ''),
							'address' 				=> ($objPHPExcel->getActiveSheet()->getCell($letras[2].$i)->getValue() != '' ? $objPHPExcel->getActiveSheet()->getCell($letras[2].$i)->getValue() : ''),
							'shipping_type' 		=> ($objPHPExcel->getActiveSheet()->getCell($letras[3].$i)->getValue() != '' ? $objPHPExcel->getActiveSheet()->getCell($letras[3].$i)->getValue() : ''),
							'origin' 				=> ($objPHPExcel->getActiveSheet()->getCell($letras[4].$i)->getValue() != '' ? $objPHPExcel->getActiveSheet()->getCell($letras[4].$i)->getValue() : 'N/A'),
							'destination' 			=> ($objPHPExcel->getActiveSheet()->getCell($letras[5].$i)->getValue() != '' ? $objPHPExcel->getActiveSheet()->getCell($letras[5].$i)->getValue() : 'N/A'),
							'packages' 				=> ($objPHPExcel->getActiveSheet()->getCell($letras[6].$i)->getValue() != '' ? $objPHPExcel->getActiveSheet()->getCell($letras[6].$i)->getValue() : 1),
							'receiver_name' 		=> ($objPHPExcel->getActiveSheet()->getCell($letras[7].$i)->getValue() != '' ? $objPHPExcel->getActiveSheet()->getCell($letras[7].$i)->getValue() : 'N/A'),
							'receiver_phone'		=> ($objPHPExcel->getActiveSheet()->getCell($letras[8].$i)->getValue() != '' ? $objPHPExcel->getActiveSheet()->getCell($letras[8].$i)->getValue() : 'N/A'),
							'receiver_mail'			=>  ($objPHPExcel->getActiveSheet()->getCell($letras[9].$i)->getValue() != '' ? $objPHPExcel->getActiveSheet()->getCell($letras[9].$i)->getValue() : 'N/A'),
							'companies_id'			=> $this->session->userdata("companies_id"),
							'users_id'				=> $this->session->userdata("users_id"),
							'shipping_states_id'	=> 1,
							'operation'				=> 'PEDIDO',
							'observation'			=> 'Generada de manera masiva. ('.date('Y-m-d H:i').')'
						);
						print_r($data);
					}
					
	            }

				unlink($destino);

    		}
	    }
	    
	    echo $mensaje;
	}
}

?>