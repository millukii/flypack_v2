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
		$profile 			= trim($this->input->get('profile',TRUE));

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

	            $letras = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H');

	            for ($i=2; $i <= $filas ; $i++)
	            { 
	            	$data = array(
						'rut' 				=> ($objPHPExcel->getActiveSheet()->getCell($letras[0].$i)->getValue() != '' ? $objPHPExcel->getActiveSheet()->getCell($letras[0].$i)->getValue() : ''),
						'dv' 			=> ($objPHPExcel->getActiveSheet()->getCell($letras[1].$i)->getValue() != '' ? $objPHPExcel->getActiveSheet()->getCell($letras[1].$i)->getValue() : ''),
						'name' 				=> ($objPHPExcel->getActiveSheet()->getCell($letras[2].$i)->getValue() != '' ? $objPHPExcel->getActiveSheet()->getCell($letras[2].$i)->getValue() : ''),
						'lastname' 		=> ($objPHPExcel->getActiveSheet()->getCell($letras[3].$i)->getValue() != '' ? $objPHPExcel->getActiveSheet()->getCell($letras[3].$i)->getValue() : ''),
						'address' 			=> ($objPHPExcel->getActiveSheet()->getCell($letras[4].$i)->getValue() != '' ? $objPHPExcel->getActiveSheet()->getCell($letras[4].$i)->getValue() : 'sin dirección.'),
						'phone' 			=> ($objPHPExcel->getActiveSheet()->getCell($letras[5].$i)->getValue() != '' ? $objPHPExcel->getActiveSheet()->getCell($letras[5].$i)->getValue() : '000000000'),
						'email' 			=> ($objPHPExcel->getActiveSheet()->getCell($letras[6].$i)->getValue() != '' ? $objPHPExcel->getActiveSheet()->getCell($letras[6].$i)->getValue() : 'sin_email@gmail.com'),
						'profiles_id' 		=> $profile,
						'created'			=> $date_time
					);

	            	$rut = $objPHPExcel->getActiveSheet()->getCell($letras[0].$i)->getValue();
	            	if(!empty($rut))
	            	{
	            		//validar si existe
	            		$this->db->select('id');
	            		$this->db->from('people');
	            		$this->db->where('rut', $rut);
	            		$this->db->limit(1);

	            		$res = $this->db->get()->result_array();
	            		if(!empty($res[0]['id']))
	            		{
	            			//existe hay id
	            			$res = $res[0]['id'];

	            			$data2 = array(
								'name' 				=> ($objPHPExcel->getActiveSheet()->getCell($letras[2].$i)->getValue() != '' ? $objPHPExcel->getActiveSheet()->getCell($letras[2].$i)->getValue() : ''),
								'lastname' 		=> ($objPHPExcel->getActiveSheet()->getCell($letras[3].$i)->getValue() != '' ? $objPHPExcel->getActiveSheet()->getCell($letras[3].$i)->getValue() : ''),
								'address' 			=> ($objPHPExcel->getActiveSheet()->getCell($letras[4].$i)->getValue() != '' ? $objPHPExcel->getActiveSheet()->getCell($letras[4].$i)->getValue() : 'sin dirección.'),
								'phone' 			=> ($objPHPExcel->getActiveSheet()->getCell($letras[5].$i)->getValue() != '' ? $objPHPExcel->getActiveSheet()->getCell($letras[5].$i)->getValue() : '000000000'),
								'email' 			=> ($objPHPExcel->getActiveSheet()->getCell($letras[6].$i)->getValue() != '' ? $objPHPExcel->getActiveSheet()->getCell($letras[6].$i)->getValue() : 'sin_email@gmail.com'),
								'profiles_id' 		=> $profile
							);

							if($this->modelo->editPeople($data2, $res))
								echo '1';
							else
								echo '0';
	            		}
	            		else
	            		{
	            			//no existe
	            			$res = 0;
	            			if($this->modelo->addPeople($data))
								$mensaje = '1';
							else
								$mensaje = '0';
							
	            		}
	            	}

					
	            }

				unlink($destino);

    		}
    		/*

	        else if($key['error'] == '') {
	            $mensaje = '1';
	        }
	        else if($key['error'] != '') {
	            $mensaje = '0';
	        }
	        */
	    }
	    
	    echo $mensaje;
	}
}

?>