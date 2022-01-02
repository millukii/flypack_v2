<?php

class CQuadmins extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		//$this->load->model('MQuadmins', 'modelo');
	}

	public function index()
	{
		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('quadmins/index');
	}

  public function states()
	{
        $this->load->library('guzzle');
        # guzzle client define
        $client     = new GuzzleHttp\Client();

        $date_ini = "2021-12-28";
        $date_end = "2022-01-01";
        $limit = "100";
        $offset = "0";

        $url = "https://flash-api.quadminds.com/api/v2/orders/search?limit=".$limit."&offset=".$offset."&from=".$date_ini."&to=".$date_end;

        $response = $client->request('GET', $url, [
            'headers' => [
              'Accept' => 'application/json',
              'x-saas-apikey' => 'SzaORv8XtExcO1zVX3jcWGsOvyGwsl3y46sOLnmn',
            ],
          ]);
          
        $data_ot =  $response->getBody();

        $data = array(
            'ot' => $data_ot
        );

		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('quadmins/states', $data);
        
	}
}

?>