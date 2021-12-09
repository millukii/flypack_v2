<?php

class CBarCode extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('barcode_generator/index');
	}

	public function GeneratePeople()
	{
		$rut = trim($this->input->get('rut', TRUE));

		require_once('./application/libraries/barcode.php');

		$this->db->select('rut, dv, name, lastname');
		$this->db->from('people');
		$this->db->where('rut', $rut);
		$this->db->where('people_states_id', 1);
		$this->db->order_by('rut','asc');
		$res = $this->db->get()->result_array();
		$array_barcodes = array();
		//END DB
		if(!empty($res))
		{
			foreach($res as $r)
			{
				barcode('./assets/barcodes/'.$r['rut'].'.png', $r['rut'], 20, 'horizontal', 'code128', true);
				$temp = array(
					'image' => './assets/barcodes/'.$r['rut'].'.png',
					'name' => $r['name'],
					'lastname' => $r['lastname']
				);
				array_push($array_barcodes, $temp);
			}
		}

		$data = array('title' => 'Código de barra', 'datos' => $array_barcodes);
		$html = $this->load->view('barcode_generator/masivePeople.php', $data, true);
		$this->load->library('M_pdf');
		$this->m_pdf->pdf->WriteHTML($html);
		$filename = "codigos_barra.pdf";
		$this->m_pdf->pdf->Output($filename, "I");
	}

	public function GenerateAllPeople()
	{
		require_once('./application/libraries/barcode.php');

		$this->db->select('rut, dv, name, lastname');
		$this->db->from('people');
		$this->db->where('people_states_id', 1);
		$this->db->order_by('rut','asc');
		$res = $this->db->get()->result_array();
		$array_barcodes = array();
		//END DB
		if(!empty($res))
		{
			foreach($res as $r)
			{
				barcode('./assets/barcodes/'.$r['rut'].'.png', $r['rut'], 20, 'horizontal', 'code128', true);
				$temp = array(
					'image' => './assets/barcodes/'.$r['rut'].'.png',
					'name' => $r['name'],
					'lastname' => $r['lastname']
				);
				array_push($array_barcodes, $temp);
			}
		}

		$data = array('title' => 'Listado completo de personas', 'datos' => $array_barcodes);
		$html = $this->load->view('barcode_generator/masivePeople.php', $data, true);
		$this->load->library('M_pdf');
		$this->m_pdf->pdf->WriteHTML($html);
		$filename = "codigos_barra.pdf";
		$this->m_pdf->pdf->Output($filename, "I");
	}

	public function GenerateIntervalPeople()
	{
		require_once('./application/libraries/barcode.php');

		$from = trim($this->input->get('from', TRUE));
		$to = trim($this->input->get('to', TRUE));

		$this->db->select('rut, dv, name, lastname');
		$this->db->from('people');
		$this->db->where('people_states_id', 1);
		$this->db->where('rut >='.$from);
		$this->db->where('rut <='.$to);
		$this->db->order_by('rut','asc');
		$res = $this->db->get()->result_array();
		$array_barcodes = array();
		//END DB
		if(!empty($res))
		{
			foreach($res as $r)
			{
				barcode('./assets/barcodes/'.$r['rut'].'.png', $r['rut'], 20, 'horizontal', 'code128', true);
				$temp = array(
					'image' => './assets/barcodes/'.$r['rut'].'.png',
					'name' => $r['name'],
					'lastname' => $r['lastname']
				);
				array_push($array_barcodes, $temp);
			}
		}

		$data = array('title' => 'Listado completo de personas', 'datos' => $array_barcodes);
		$html = $this->load->view('barcode_generator/masivePeople.php', $data, true);
		$this->load->library('M_pdf');
		$this->m_pdf->pdf->WriteHTML($html);
		$filename = "codigos_barra.pdf";
		$this->m_pdf->pdf->Output($filename, "I");
	}

}

?>