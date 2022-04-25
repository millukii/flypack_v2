<?php

class CShipping extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('MShipping', 'modelo');
        $this->load->model('MSession', 'modelo_session');
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
            "draw" => intval($this->input->post('draw')),
            "recordsTotal" => intval($result['numDataTotal']),
            "recordsFiltered" => intval($result['numDataFilter']),
            "data" => $result['data'],
        );

        echo json_encode($json_data);
    }

    public function add()
    {
        $shipping_states = $this->modelo->getAllShipping_States();
        $user = $this->session->userdata('users_id');
        $userCompany = $this->modelo->getCompanyOfUser($user);
        $branchOffices = $this->modelo->getBranchOfficesOfCompany($userCompany[0]->id);
        $deliveryOptions = $this->modelo->getAllDeliveryOptions();
        $communes = $this->modelo->getAllCommunes();
        $rates = null;
        $rates_sizes = null;
        $type_rate = $userCompany[0]->type_rate;

        if ($type_rate === "1") {
            $rates = $this->modelo->getAllRatesByCompany($userCompany[0]->id);
        }

        if ($type_rate === "2") {
            $rates_sizes = $this->modelo->getAllRatesSizesByCompany($userCompany[0]->id);
        }

        $this->db->select('id');
        $this->db->from('shipping');
        $this->db->order_by('id', 'desc');
        $this->db->limit(1);

        $res = $this->db->get()->result_array();

        if (!empty($res[0]['id'])) {
            $res = intval($res[0]['id']) + 1;
        } else {
            $res = 1;
        }

        // agregar get a points de quadmins
        $curl = curl_init('https://flash-api.quadminds.com/api/v2/pois/search?limit=100&offset=0');

        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");

        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'x-saas-apikey:  SzaORv8XtExcO1zVX3jcWGsOvyGwsl3y46sOLnmn')
        );

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // Make it so the data coming back is put into a string

        // Send the request
        $result = curl_exec($curl);

        // Free up the resources $curl is using
        curl_close($curl);

        $points = json_decode($result, true);

        $data = array(
            'points' => $points['data'],
            'delivery_options' => $deliveryOptions,
            'user_company' => $userCompany,
            'communes' => $communes,
            'type_rate' => $type_rate,
            'rates' => $rates,
            'rates_sizes' => $rates_sizes,
            'branch_offices' => $branchOffices,
            'shipping_states' => $shipping_states,
            'new_id' => $res,
        );

        $this->load->view('header');
        $this->load->view('aside');
        $this->load->view('shipping/add', $data);
    }

    public function edit()
    {
        $id = trim($this->input->get('id', true));
        $user = $this->session->userdata('users_id');
        $userCompany = $this->modelo->getCompanyOfUser($user);
        $branchOffices = $this->modelo->getBranchOfficesOfCompany($userCompany[0]->id);
        $deliveryOptions = $this->modelo->getAllDeliveryOptions();

        $shipping = $this->modelo->getShipping_($id);
        $communes = $this->modelo->getAllCommunes();
        $shipping_states = $this->modelo->getAllShipping_States();
        $delivery = $this->modelo->getAllDeliveryOptions();
        $rates = null;
        $rates_sizes = null;
        $type_rate = $userCompany[0]->type_rate;

        if ($type_rate === "1") {
            //por lista de precio (rates) origen destino
            $rates = $this->modelo->getAllRatesByCompany($userCompany[0]->id);
        }

        if ($type_rate === "2") {
            //por tamaño x m s (rates_sizes)
            $rates_sizes = $this->modelo->getAllRatesSizesByCompany($userCompany[0]->id);

        }

        $data = array(
            'shipping' => $shipping,
            'branch_offices' => $branchOffices,
            'communes' => $communes,
            'user_company' => $userCompany,
            'type_rate' => $type_rate,
            'rates' => $rates,
            'rates_sizes' => $rates_sizes,
            'delivery' => $delivery,
            'shipping_states' => $shipping_states,
        );

        $this->load->view('header');
        $this->load->view('aside');
        $this->load->view('shipping/edit', $data);
    }

    public function view()
    {
        $id = trim($this->input->get('id', true));

        $shipping = $this->modelo->getShipping_($id);
        $data = array(
            'shipping' => $shipping,
        );

        $this->load->view('header');
        $this->load->view('aside');
        $this->load->view('shipping/view', $data);
    }

    public function addShipping()
    {
        $order_nro = trim($this->input->post('order_nro', true));
        $quadmins_code = trim($this->input->post('quadmins_code', true));
        $total_amount = trim($this->input->post('total_amount', true));
        $address = trim($this->input->post('address', true));
        $delivery_name = trim($this->input->post('delivery_name', true));
        $shipping_date = trim($this->input->post('shipping_date', true));
        $shipping_type = trim($this->input->post('shipping_type', true));
        $companies_id = trim($this->input->post('companies_id', true));
        $shipping_states_id = trim($this->input->post('shipping_states_id', true));
        $address = trim($this->input->post('address', true));
        $receiver_name = trim($this->input->post('receiver_name', true));
        $receiver_phone = trim($this->input->post('receiver_phone', true));
        $receiver_mail = trim($this->input->post('receiver_mail', true));
        $observation = trim($this->input->post('observation', true));

        $origin = trim($this->input->post('origin', true));
        $destination = trim($this->input->post('destination', true));

        $originCommuneName = $this->modelo->getCommuneName($origin);
        $destinationCommuneName = $this->modelo->getCommuneName($destination);

        if (empty($total_amount)) {
            $total_amount = 'N/A';
        }

        if (empty($quadmins_code)) {
            $quadmins_code = $order_nro;
        }

        if (empty($address)) {
            $address = 'N/A';
        }

        if (empty($label)) {
            $label = 'N/A';
        }

        if (empty($delivery_name)) {
            $delivery_name = 'N/A';
        }

        if (empty($shipping_date)) {
            $shipping_date = '';
        }

        $date_time = date('Y-m-d H:i:s');

        $user = $this->session->userdata('users_id');
        $companies_id = $this->session->userdata('companies_id');

        $data = array(
            'order_nro' => $order_nro,
            'quadmins_code' => $quadmins_code,
            'total_amount' => $total_amount,
            'address' => $address,
            'shipping_type' => $shipping_type,
            'receiver_name' => $receiver_name,
            'receiver_phone' => $receiver_phone,
            'receiver_mail' => $receiver_mail,
            'shipping_date' => $shipping_date,
            'delivery_name' => $delivery_name,
            'observation' => $observation,
            'companies_id' => $companies_id,
            'shipping_states_id' => 1,
            'origin' => $originCommuneName,
            'destination' => $destinationCommuneName,
            'created' => $date_time,
            'users_id' => $user,
            'companies_id' => $companies_id,
        );

        if ($this->modelo->addShipping($data)) {
               //agregar llamado a la api de quadmin con los datos necesarios para crear una orden

            $quadminOrder = array(
                'code' => $quadmins_code,
                'poiId' => 121245261,
                'quadmins_code' => $quadmins_code,
                'operation' => "PEDIDO",
                'priority' => 0,
                'totalAmount' => (int) $total_amount,
                'totalAmountWithoutTaxes' => (int) $total_amount,
            );
            $orders = [];
            array_push($orders, $quadminOrder);

            $data_string = json_encode($orders);
            $curl = curl_init('https://flash-api.quadminds.com/api/v2/orders');

            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");

            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string),
                'x-saas-apikey: ' . 'SzaORv8XtExcO1zVX3jcWGsOvyGwsl3y46sOLnmn'));

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // Make it so the data coming back is put into a string
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string); // Insert the data

            // Send the request
            $result = curl_exec($curl);

            $array = json_decode($result, true);

            // Free up the resources $curl is using
            curl_close($curl);

            $date_time = date('Y-m-d H:i:s');
            $data = array(
                'quadmins_code' => $array['data'][0]['_id'],
                'modified' => $date_time,
            );
            $this->modelo->editShippingByOrderNro($data, $order_nro));
            echo '1'; 
        }else{ echo '0'; }

    }

    public function editShipping()
    {
        $id = trim($this->input->post('id', true));
        $order_nro = trim($this->input->post('order_nro', true));
        $quadmins_code = trim($this->input->post('quadmins_code', true));
        $total_amount = trim($this->input->post('total_amount', true));
        $delivery_name = trim($this->input->post('delivery_name', true));
        $shipping_type = trim($this->input->post('shipping_type', true));
        $origin = trim($this->input->post('origin', true));
        $destination = trim($this->input->post('destination', true));
        $companies_id = $this->session->userdata("companies_id");
        $shipping_states_id = trim($this->input->post('shipping_states_id', true));
        $address = trim($this->input->post('address', true));
        $receiver_name = trim($this->input->post('receiver_name', true));
        $receiver_phone = trim($this->input->post('receiver_phone', true));
        $receiver_mail = trim($this->input->post('receiver_mail', true));
        $observation = trim($this->input->post('observation', true));

        $originCommuneName = $this->modelo->getCommuneName($origin);
        $destinationCommuneName = $this->modelo->getCommuneName($destination);

        if (empty($total_amount)) {
            $total_amount = 'N/A';
        }

        if (empty($quadmins_code)) {
            $quadmins_code = 'N/A';
        }

        if (empty($address)) {
            $address = 'N/A';
        }

        if (empty($delivery_name)) {
            $delivery_name = '000000000';
        }

        $date_time = date('Y-m-d H:i:s');
        $data = array(
            'order_nro' => $order_nro,
            'quadmins_code' => $quadmins_code,
            'total_amount' => $total_amount,
            'quadmins_code' => $quadmins_code,
            'address' => $address,
            'shipping_type' => $shipping_type,
            'receiver_name' => $receiver_name,
            'receiver_phone' => $receiver_phone,
            'receiver_mail' => $receiver_mail,
            'delivery_name' => $delivery_name,
            'observation' => $observation,
            'companies_id' => $companies_id,
            'shipping_states_id' => $shipping_states_id,
            'origin' => $originCommuneName,
            'destination' => $destinationCommuneName,
            'modified' => $date_time,
        );

        if ($this->modelo->editShipping($data, $id)) {
            echo '1';
        } else {
            echo '0';
        }

    }

    public function deleteShipping()
    {
        $id = trim($this->input->post('id', true));

        $data = array(
            'shipping_states_id' => '2',
        );

        if ($this->modelo->editShipping($data, $id)) {
            echo '1';
        } else {
            echo '0';
        }

    }

    public function generateMasive()
    {
        $quantity_workers = trim($this->input->post('quantity_workers', true));

        $this->db->select('id');
        $this->db->from('shipping');
        $this->db->order_by('id', 'desc');
        $this->db->limit(1);
        $res = $this->db->get()->result_array();

        if (!empty($res[0]['id'])) {
            $res = intval($res[0]['id']);
        } else {
            $res = 1;
        }

        $date_time = date('Y-m-d H:i:s');
        for ($i = 0; $i < $quantity_workers; $i++) {
            $res++;
            $data = array(
                'order_nro' => $res,
                'quadmins_code' => $res,
                'total_amount' => 'N/A',
                'quadmins_code' => 'N/A',
                'address' => 'N/A',
                'shipping_date' => 'sin_correo@gmail.com',
                'delivery_name' => '000000000',
                'profile_id' => 2,
                'shipping_states_id' => 1,
                'created' => $date_time,
            );

            $this->modelo->addShipping($data);
        }

        echo '1';
    }

    public function getRateFromToCompany()
    {
        $companies_id = $this->session->userdata('companies_id');
        $from = trim($this->input->post('from', true));
        $to = trim($this->input->post('to', true));

        $response = $this->modelo->getRateFromToCompany($from, $to, $companies_id);

        $value = 0;
        if (!empty($response)) {
            $value = $response[0]['value'];
        }

        echo $value;
    }
    public function getRateSizeCompany()
    {
        $companies_id = $this->session->userdata('companies_id');
        $size = trim($this->input->post('size', true));
        $response = $this->modelo->getRateSizeCompany($size, $companies_id);

        $value = 0;
        if (!empty($response)) {
            $value = $response[0]['value'];
        }
        echo $value;

    }
}
