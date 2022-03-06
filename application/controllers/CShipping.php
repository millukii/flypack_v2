<?php

class CShipping extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('MShipping', 'modelo');
	}

	public function index()
	{
		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('shipping/index');
	}

	//Datatable
	public function datatable()
	{
		$start = $this->input->post('start');
		$length = $this->input->post('length');
		$search = $this->input->post('search')['value'];
		$by = $this->input->post('order')['0']['column'];
		$order = $this->input->post('order')['0']['dir'];

		$result = $this->modelo->getShipping($start, $length, $search, $order, $by);
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
		$companies = $this->modelo->getAllCompanies();
		$shipping_states = $this->modelo->getAllShipping_States();
		
		$this->db->select('id');
        $this->db->from('shipping');
        $this->db->order_by('id', 'desc');
        $this->db->limit(1);
        $res = $this->db->get()->result_array();
        $res;
        if(!empty($res[0]['id']))
            $res = intval($res[0]['id']) + 1;
        else
            $res = 1;
    // agregar get a points de quadmins
    $curl = curl_init('https://flash-api.quadminds.com/api/v2/pois/search?limit=100&offset=0');

    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");

    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'x-saas-apikey:  SzaORv8XtExcO1zVX3jcWGsOvyGwsl3y46sOLnmn')
    );

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string

    // Send the request
    $result = curl_exec($curl);

    // Free up the resources $curl is using
    curl_close($curl);

    $points = json_decode($result, true);

		$data = array(
      'points' => $points['data'],
			'companies' => $companies,
			'shipping_states' => $shipping_states,
			'new_id' => $res,
		);

		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('shipping/add', $data);
	}

	public function edit()
	{
		$id = trim($this->input->get('id', TRUE));

		$shipping = $this->modelo->getShipping_($id);
		$companies = $this->modelo->getAllcompanies();
		$shipping_states = $this->modelo->getAllShipping_States();

		$data = array(
			'shipping' => $shipping,
			'companies' => $companies,
			'shipping_states' => $shipping_states,
		);

		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('shipping/edit', $data);
	}

	public function view()
	{
		$id = trim($this->input->get('id', TRUE));

		$shipping = $this->modelo->getShipping_($id);
		$data = array(
			'shipping' => $shipping
		);

		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('shipping/view', $data);
	}

	public function addShipping()
	{
    $id 				= 	trim($this->input->post('id', TRUE));
		$order_nro 				= 	trim($this->input->post('order_nro', TRUE));
		$quadmins_code 				= 	trim($this->input->post('quadmins_code', TRUE));
		$total_amount 				= 	trim($this->input->post('total_amount', TRUE));
		$quadmins_code 			= 	trim($this->input->post('quadmins_code', TRUE));
		$address 			= 	trim($this->input->post('address', TRUE));
		$delivery_name 				= 	trim($this->input->post('delivery_name', TRUE));
		$shipping_date 				= 	trim($this->input->post('shipping_date', TRUE));
    $shipping_type 				= 	trim($this->input->post('shipping_type', TRUE));
		$companies_id 		= 	trim($this->input->post('companies_id', TRUE));
		$shipping_states_id	=	trim($this->input->post('shipping_states_id', TRUE));
		$sender	=	trim($this->input->post('sender', TRUE));
    $address	=	trim($this->input->post('address', TRUE));
    $origin	=	trim($this->input->post('origin', TRUE));
    $destiny	=	trim($this->input->post('destiny', TRUE));
    $receiver_name	=	trim($this->input->post('receiver_name', TRUE));
    $receiver_phone	=	trim($this->input->post('receiver_phone', TRUE));
    $receiver_mail	=	trim($this->input->post('receiver_mail', TRUE));
    $observation	=	trim($this->input->post('observation', TRUE));
    $label	=	trim($this->input->post('label', TRUE));
    $poiId	=	trim($this->input->post('poiId', TRUE));
    $priority	=	trim($this->input->post('priority', TRUE));
    $label	=	trim($this->input->post('label', TRUE));
    $operation_type	=	trim($this->input->post('operation_type', TRUE));

		if(empty($total_amount))
			$total_amount = 'N/A';
		
		if(empty($quadmins_code))
			$quadmins_code = 'N/A';
		
		if(empty($address))
			$address = 'N/A';

    if(empty($label))
			$label = 'N/A';

		if(empty($delivery_name))
			$delivery_name = '000000000';

		if(empty($shipping_date))
			$shipping_date = '';
		
		$date_time = date('Y-m-d H:i:s');

		$data = array(
			'order_nro' 				=> $order_nro,
			'quadmins_code' 				=> $quadmins_code,
			'total_amount' 				=> $total_amount,
			'quadmins_code' 			=> $quadmins_code,
			'address' 			=> $address,
      'sender' 			=> $sender,
      'label' 			=> $label,
      'shipping_type' 			=> $shipping_type,
      'receiver_name' 			=> $receiver_name,
      'receiver_phone' 			=> $receiver_phone,
      'receiver_mail' 			=> $receiver_mail,
			'shipping_date' 			=> $shipping_date,
      'shipping_type' 			=> $shipping_type,
			'delivery_name' 			=> $delivery_name,
      'observation' 			=> $observation,
			'companies_id'		=> $companies_id,
			'shipping_states_id'	=> $shipping_states_id,
			'created'			=> $date_time
		);


		if($this->modelo->addShipping($data))
			echo '1';
		else
			echo '0';
        //agregar llamado a la api de quadmin con los datos necesarios para crear una orden

      $quadminOrder = array(
			'code' 				=> $quadmins_code,
      'poiId' 				=> $poiId,
			'quadmins_code' 				=> $quadmins_code,
      'operation' 				=> $operation_type,
      'label' 				=> $label,
      'priority' 				=> $priority,
      'totalAmount' 				=> $total_amount,
      'totalWithoutTaxes' 				=> $total_amount
		);
    $data_string = json_encode($data);


    $curl = curl_init('https://flash-api.quadminds.com/api/v2/orders');

    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");

    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($data_string),
     'x-saas-apikey: ' . 'SzaORv8XtExcO1zVX3jcWGsOvyGwsl3y46sOLnmn'));

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);  // Insert the data

    // Send the request
    $result = curl_exec($curl);

    // Free up the resources $curl is using
    curl_close($curl);
	}

	public function editShipping()
	{
		$id 				= 	trim($this->input->post('id', TRUE));
		$order_nro 				= 	trim($this->input->post('order_nro', TRUE));
		$quadmins_code 				= 	trim($this->input->post('quadmins_code', TRUE));
		$total_amount 				= 	trim($this->input->post('total_amount', TRUE));
		$quadmins_code 			= 	trim($this->input->post('quadmins_code', TRUE));
		$address 			= 	trim($this->input->post('address', TRUE));
		$delivery_name 				= 	trim($this->input->post('delivery_name', TRUE));
		$shipping_date 				= 	trim($this->input->post('shipping_date', TRUE));
    $shipping_type 				= 	trim($this->input->post('shipping_type', TRUE));
		$companies_id 		= 	trim($this->input->post('companies_id', TRUE));
		$shipping_states_id	=	trim($this->input->post('shipping_states_id', TRUE));
		$sender	=	trim($this->input->post('sender', TRUE));
    $address	=	trim($this->input->post('address', TRUE));
    $receiver_name	=	trim($this->input->post('receiver_name', TRUE));
    $receiver_phone	=	trim($this->input->post('receiver_phone', TRUE));
    $receiver_mail	=	trim($this->input->post('receiver_mail', TRUE));
    $observation	=	trim($this->input->post('observation', TRUE));
    $label	=	trim($this->input->post('label', TRUE));
		
		if(empty($total_amount))
			$total_amount = 'N/A';
		
		if(empty($quadmins_code))
			$quadmins_code = 'N/A';
		
		if(empty($address))
			$address = 'N/A';

		if(empty($delivery_name))
			$delivery_name = '000000000';

		if(empty($shipping_date))
			$shipping_date = 'sin_shipping_date@gmail.com';
		
		$data = array(
			'order_nro' 				=> $order_nro,
			'quadmins_code' 				=> $quadmins_code,
			'total_amount' 				=> $total_amount,
			'quadmins_code' 			=> $quadmins_code,
			'address' 			=> $address,
      'sender' 			=> $sender,
      'shipping_type' 			=> $shipping_type,
      'receiver_name' 			=> $receiver_name,
      'receiver_phone' 			=> $receiver_phone,
      'receiver_mail' 			=> $receiver_mail,
			'shipping_date' 			=> $shipping_date,
      'shipping_type' 			=> $shipping_type,
			'delivery_name' 			=> $delivery_name,
      'observation' 			=> $observation,
			'companies_id'		=> $companies_id,
			'shipping_states_id'	=> $shipping_states_id,
			'updated'			=> $date_time
		);

		if($this->modelo->editShipping($data, $id))
			echo '1';
		else
			echo '0';
	}

	public function deleteShipping()
	{
		$id 	= 	trim($this->input->post('id', TRUE));

		$data = array(
			'shipping_states_id'	=>	'2'
		);

		if($this->modelo->editShipping($data, $id))
			echo '1';
		else
			echo '0';
	}
	
	public function generateMasive()
	{
		$quantity_workers 				= 	trim($this->input->post('quantity_workers', TRUE));

		$this->db->select('id');
        $this->db->from('shipping');
        $this->db->order_by('id', 'desc');
        $this->db->limit(1);
        $res = $this->db->get()->result_array();

        if(!empty($res[0]['id']))
            $res = intval($res[0]['id']);
        else
            $res = 1;

        $date_time = date('Y-m-d H:i:s');
		for($i=0; $i<$quantity_workers; $i++)
		{
		   	$res++;
    		$data = array(
    			'order_nro' 				=> $res,
    			'quadmins_code' 				=> $res,
    			'total_amount' 				=> 'N/A',
    			'quadmins_code' 			=> 'N/A',
    			'address' 			=> 'N/A',
    			'shipping_date' 			=> 'sin_correo@gmail.com',
    			'delivery_name' 			=> '000000000',
    			'profile_id'		=> 2,
    			'shipping_states_id'	=> 1,
    			'created'			=> $date_time
    		);
    
    		$this->modelo->addShipping($data);
		}

        echo '1';		
	}
}

?>