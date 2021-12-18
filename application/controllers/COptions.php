<?php

class COptions extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('MOptions', 'modelo');
	}

	public function index()
	{
		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('options/index');
	}

	//Datatable
	public function datatable()
	{
		$start = $this->input->post('start');
		$length = $this->input->post('length');
		$search = $this->input->post('search')['value'];
		$by = $this->input->post('order')['0']['column'];
		$order = $this->input->post('order')['0']['dir'];

		$result = $this->modelo->getOptions($start, $length, $search, $order, $by);

		$json_data = array(
			"draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($result['numDataTotal']),
            "recordsFiltered" => intval($result['numDataFilter']),
            "data"            => $result['data']
            );

        echo json_encode($json_data);
	}

	public function options_rol()
	{
		$options = $this->modelo->getOptions_();
		$roles = $this->modelo->getRoles();

		$data = array(
			'options' => $options,
			'roles' => $roles
		);

		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('options/options_rol', $data);
	}

	public function getOptions_Rol()
	{
		$roles_id = trim($this->input->post('roles_id', TRUE));
		$options = $this->modelo->getOptions_Rol($roles_id);
		echo json_encode($options);
	}

	public function updateOptions_Rol()
	{
		$roles_id = trim($this->input->post('roles_id', TRUE));
		$options = $this->input->post('options', TRUE);

		if($this->modelo->deleteOptions_Rol($roles_id))
		{
			foreach($options as $opt)
			{
				$data = array(
					'options_id' => $opt,
					'roles_id' => $roles_id
				);

				$this->modelo->addOption_Rol($data);
			}
		}
	}
}

?>