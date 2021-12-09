<?php

class CLogs extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('MLogs', 'modelo');
	}

	public function index()
	{
		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('logs/index');
	}

	public function datatable()
	{
		$start = $this->input->post('start');
		$length = $this->input->post('length');
		$search = $this->input->post('search')['value'];
		$by = $this->input->post('order')['0']['column'];
		$order = $this->input->post('order')['0']['dir'];

		$result = $this->modelo->getLogs($start, $length, $search, $order, $by);

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

		$log = $this->modelo->getLog($id);

		$data = array('log' => $log);

		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('logs/view', $data);
	}
}

?>