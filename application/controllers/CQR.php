<?php
class CQR extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		//$this->load->model('MQR', 'modelo');
	}

	public function index()
	{
		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('qr_generator/index');
	}

	public function emitQRCode()
	{
		/*
		$rut = trim($this->input->post('rut', TRUE));
		$dv = trim($this->input->post('dv', TRUE));

		$this->load->library('ciqrcode');

		 //hacemos configuraciones
        $params['data'] = $rut;
        $params['level'] = 'H';
        $params['size'] = 10;
        //$params['framSize'] = 3; //tamaño en blanco

        //decimos el directorio a guardar el codigo qr, en este 
        //caso una carpeta en la raíz llamada qr_code
        $params['savename'] = FCPATH . "assets/qr_codes/qr_".$rut.".png";
        //generamos el código qr
        $this->ciqrcode->generate($params);
        chmod( FCPATH . "assets/qr_codes/qr_".$rut.".png", 0777);
        echo "assets/qr_codes/qr_".$rut.".png";
        */
	}
}
?>



