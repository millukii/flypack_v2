<?php

class CShipping extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        ini_set('date.timezone', 'America/Santiago');
        $this->load->model('MShipping', 'modelo');
        $this->load->model('MSession', 'modelo_session');
        $this->load->model('MUsers', 'modelo_users');

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

        $data = array(
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

        $user = $this->session->userdata('users_id');
        $userCompany = $this->modelo->getCompanyOfUser($user);
        $type_rate = $userCompany[0]->type_rate;

        $shipping = $this->modelo->getShipping_($id);
        $data = array(
            'type_rate' => $type_rate,
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
        $shipping_delivery_date = trim($this->input->post('shipping_delivery_date', true));
        $shipping_type = trim($this->input->post('shipping_type', true));
        $companies_id = trim($this->input->post('companies_id', true));
        $shipping_states_id = 1;
        $address = trim($this->input->post('address', true));
        $receiver_name = trim($this->input->post('receiver_name', true));
        $receiver_phone = trim($this->input->post('receiver_phone', true));
        $receiver_mail = trim($this->input->post('receiver_mail', true));
        $observation = trim($this->input->post('observation', true));
        $poId = trim($this->input->post('poId', true));
        $packages = trim($this->input->post('packages', true));
        $operation = trim($this->input->post('operation', true));
        $merchant_id = trim($this->input->post('merchant_id', true));

        $origin = trim($this->input->post('origin', true));
        $destination = trim($this->input->post('destination', true));

        $originCommuneName = $this->modelo->getCommuneName($origin);
        $destinationCommuneName = $this->modelo->getCommuneName($destination);

        if (empty($total_amount)) {
            $total_amount = 0;
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
        if (empty($merchant_id)) {
            $merchant_id = 0;
        }

        $date_time = date('Y-m-d H:i:s');

        $user = $this->session->userdata('users_id');
        $companies_id = $this->session->userdata('companies_id');

        if ($operation == 'RETIRO') {
            $originCommuneName = 'N/A';
            $destinationCommuneName = 'N/A';
            $total_amount = 0;
            $shipping_type = 'N/A';
        }

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
            'shipping_states_id' => $shipping_states_id,
            'origin' => $originCommuneName,
            'destination' => $destinationCommuneName,
            'created' => $date_time,
            'users_id' => $user,
            'companies_id' => $companies_id,
            'packages' => $packages,
            'operation' => $operation,
            'poiId' => (int) $poId,
            'shipping_delivery_date' => $shipping_delivery_date,
        );

        if ($this->modelo->addShipping($data)) {
            //agregar llamado a la api de quadmin con los datos necesarios para crear una orden

            $measures = array();
            $volume = new stdClass;
            $volume->constraintId = 7;
            $volume->value = (int) $total_amount;

            array_push($measures, $volume);

            $merchants = array();
            $merchant = new stdClass;
            $merchant->_id = (int) $merchant_id;
            array_push($merchants, $merchant);

            $quadminOrder = array(
                'code' => $quadmins_code,
                'poiId' => (int) $poId,
                'quadmins_code' => $quadmins_code,
                'date' => $shipping_date,
                'operation' => $operation,
                'priority' => 0,
                'totalAmount' => (int) $total_amount,
                'totalAmountWithoutTaxes' => (int) $total_amount,
                'orderMeasures' => $measures,
                'merchants' => $merchants,
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
            $err = curl_error($curl);
            if ($err) {
                echo "cURL Error #:" . $err;
            }
            $array = json_decode($result, true);
            // Free up the resources $curl is using
            curl_close($curl);
            $date_time = date('Y-m-d H:i:s');
            $data = array(
                'quadmins_code' => $array['data'][0]['_id'],
                'modified' => $date_time,
            );
            $this->modelo->editShippingByOrderNro($data, $order_nro);
            echo '1';
        } else {echo '0';}

    }

    public function editShipping()
    {
        $id = trim($this->input->post('id', true));
        $order_nro = trim($this->input->post('order_nro', true));
        $quadmins_code = trim($this->input->post('quadmins_code', true));
        $total_amount = trim($this->input->post('total_amount', true));
        $delivery_name = trim($this->input->post('delivery_name', true));
        $shipping_type = trim($this->input->post('shipping_type', true));
        $shipping_date = trim($this->input->post('shipping_date', true));
        $origin = trim($this->input->post('origin', true));
        $destination = trim($this->input->post('destination', true));
        $companies_id = $this->session->userdata("companies_id");
        $shipping_states_id = trim($this->input->post('shipping_states_id', true));
        $address = trim($this->input->post('address', true));
        $receiver_name = trim($this->input->post('receiver_name', true));
        $receiver_phone = trim($this->input->post('receiver_phone', true));
        $receiver_mail = trim($this->input->post('receiver_mail', true));
        $observation = trim($this->input->post('observation', true));
        $operation = trim($this->input->post('operation', true));
        $packages = trim($this->input->post('packages', true));
        $poId = trim($this->input->post('poId', true));
        $merchant_id = trim($this->input->post('merchant_id', true));

        $label = trim($this->input->post('label', true));
        $time_windows = trim($this->input->post('time_windows', true));

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
            $delivery_name = 'N/A';
        }

        if (empty($label)) {
            $label = 'N/A';
        }

        if (empty($time_windows)) {
            $time_windows = null;
        }
        if ($operation == 'RETIRO') {
            $originCommuneName = 'N/A';
            $destinationCommuneName = 'N/A';
            $total_amount = 0;
            $shipping_type = 'N/A';
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
            'shipping_date' => $shipping_date,
            'observation' => $observation,
            'operation' => $operation,
            'companies_id' => $companies_id,
            'packages' => $packages,
            'poiId' => (int) $poId,
            'shipping_states_id' => $shipping_states_id,
            'origin' => $originCommuneName,
            'destination' => $destinationCommuneName,
            'modified' => $date_time,
        );

        if ($this->modelo->editShipping($data, $id)) {

            $merchants = array();
            $merchant = new stdClass;
            $merchant->_id = (int) $merchant_id;
            array_push($merchants, $merchant);

            $quadminOrder = array(
// 'code' => $quadmins_code,
                'operation' => $operation,
                'poiId' => (int) $poId,
// 'quadmins_code' => $quadmins_code,
                'date' => $shipping_date,
                'totalAmount' => (int) $total_amount,
                'totalAmountWithoutTaxes' => (int) $total_amount,
                'label' => $label,
                'merchants' => $merchants,
// 'timeWindow' => $time_windows,
            );
            $orders = [];
            array_push($orders, $quadminOrder);

            $data_string = json_encode($orders[0]);

            $endpoint = sprintf("%s/%s", 'https://flash-api.quadminds.com/api/v2/orders', $quadmins_code);

            $curl = curl_init($endpoint);

            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PATCH");

            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string),
                'x-saas-apikey: ' . 'SzaORv8XtExcO1zVX3jcWGsOvyGwsl3y46sOLnmn'));

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // Make it so the data coming back is put into a string
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string); // Insert the data
            // Send the request
            $result = curl_exec($curl);
            $err = curl_error($curl);
            if ($err) {
                echo "cURL Error #:" . $err;
            }

            $array = json_decode($result, true);
            // Free up the resources $curl is using
            curl_close($curl);
            if ($array != null) {
                $date_time = date('Y-m-d H:i:s');
                $data = array(
                    'quadmins_code' => $array['data']['_id'],
                    'modified' => $date_time,
                );

                $orderMeasures = $array['data']['orderMeasures'];
                $orderMeasureTotalAmountId = null;

                foreach ($orderMeasures as $value) {
                    if ($value['constraintId'] == 7) {
                        $orderMeasureTotalAmountId = $value['_id'];
                    }
                }
                $this->modelo->editShippingByOrderNro($data, $order_nro);

            }
            $measure_endpoint = sprintf("%s/%s", 'https://flash-api.quadminds.com/api/v2/order-measures', $orderMeasureTotalAmountId);
            $curl = curl_init($measure_endpoint);

            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PATCH");

            $measure = array(
                'constraintId' => 7,
                'value' => (int) $total_amount,
            );
            $data_string = json_encode($measure);

            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string),
                'x-saas-apikey: ' . 'SzaORv8XtExcO1zVX3jcWGsOvyGwsl3y46sOLnmn'));

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // Make it so the data coming back is put into a string
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string); // Insert the data

            // Send the request
            $result = curl_exec($curl);
            $err = curl_error($curl);
            if ($err) {
                echo "cURL Error #:" . $err;
            }

            $array = json_decode($result, true);
            // Free up the resources $curl is using
            curl_close($curl);

            echo '1';
        } else {
            echo '0';
        }

    }

    public function deleteShipping()
    {
        $id = trim($this->input->post('id', true));
        //obtener id quadmins

        $shipping = $this->modelo->getShipping_($id);

        $date_time = date('Y-m-d H:i:s');

        $user = $this->session->userdata('users_id');

        $userCompany = $this->modelo->getCompanyOfUser($user);

        $new_observations = "Shipping deleted by user_id " . $user . " at " . sprintf("%s", $date_time);
        $data = array(
            'observation' => $new_observations,
            'shipping_states_id' => '2',
            'modified' => $date_time,
        );
        $this->deleteQuadminsOrder($shipping[0]['quadmins_code']);

        if ($this->modelo->editShipping($data, $id)) {
            echo '1';

        } else {
            echo '0';
        }

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

    public function getPoiData()
    {
        $attr = trim($this->input->post('attr', true));
        $value = trim($this->input->post('value', true));

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
        $err = curl_error($curl);
        if ($err) {
            echo "cURL Error #:" . $err;
        }

        // Free up the resources $curl is using
        curl_close($curl);

        $points = json_decode($result, true);
        $filter_data = array();

        if ($points != null) {

            $data = $points['data'];

            foreach ($data as $poId) {
                if ($attr == 1) {
                    if (strpos(strtolower($poId['address']), strtolower($value)) !== false) {
                        //array_push($filter_data, $poId['address']);
                        array_push($filter_data, $poId);
                    }
                } else if ($attr == 2) {
                    if (strpos(strtolower($poId['name']), strtolower($value)) !== false) {
                        //array_push($filter_data, $poId['address']);
                        array_push($filter_data, $poId);
                    }
                }

            }
        }
        echo json_encode($filter_data);
    }

    public function createQuadminPoid()
    {
        $poidCode = trim($this->input->post('poidCode', true));
        $address = trim($this->input->post('address', true));
        $receiver_name = trim($this->input->post('receiver_name', true));
        $receiver_phone = trim($this->input->post('receiver_phone', true));
        $receiver_mail = trim($this->input->post('receiver_mail', true));

        $observation = trim($this->input->post('observation', true));
        $quadminOrder = array(
            'code' => $poidCode,
            'poiType' => 'SIN_TIPO',
            'name' => $receiver_name,
            'email' => $receiver_mail,
            'enabled' => true,
            'phoneNumber' => $receiver_phone,
            'poiDeliveryComments' => $observation,
            'originalAddress' => $address,
            'longAddress' => $address,
            'visitingFrequency' => "weekly",
        );
        $orders = [];
        array_push($orders, $quadminOrder);

        $data_string = json_encode($orders);
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://flash-api.quadminds.com/api/v2/pois',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $data_string,
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Content-Type: application/json',
                'x-saas-apikey: SzaORv8XtExcO1zVX3jcWGsOvyGwsl3y46sOLnmn',
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        }

        curl_close($curl);
        $points = json_decode($response, true);

        $data = $points['data'][0];
        echo json_encode($data);

    }

    public function getAllPoiData()
    {
        $attr = trim($this->input->post('attr', true));
        $value = trim($this->input->post('value', true));

        // agregar get a points de quadmins
        $curl = curl_init('https://flash-api.quadminds.com/api/v2/pois/search?limit=10000&offset=0');

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

        $data = $points['data'];
        echo json_encode($data);
    }

    public function getQRLabel()
    {
        $id = trim($this->input->post('id', true));

        $shipping = $this->modelo->getShipping_($id);

        $receiver_name = $shipping[0]['receiver_name'];
        $address = $shipping[0]['address'];
        $destination = $shipping[0]['destination'];
        $country = 'Chile';
        $receiver_phone = $shipping[0]['receiver_phone'];
        $order_nro = $shipping[0]['order_nro'];

        $data = [
            'title' => 'Datos destino:',
            'order_nro' => $order_nro,
            'receiver_name' => $receiver_name,
            'address' => $address,
            'destination' => $destination,
            'country' => $country,
            'receiver_phone' => $receiver_phone,
            'pathPDF' => '',
        ];
        //QR
        $this->createQR($order_nro);
        $data['pathPDF'] = base_url() . $this->createPDF($data);

        echo json_encode($data, JSON_UNESCAPED_SLASHES);
    }

    public function createPDF($data)
    {
        //PDF
        $path = 'files/' . $this->session->userdata('rut') . '/' . date('Ym') . '/';

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $html = $this->load->view('shipping/labelPDF.php', $data, true);
        $this->load->library('M_pdf');
        $this->m_pdf->pdf->SetDisplayMode('fullwidth');
        $this->m_pdf->pdf->WriteHTML($html);
        $filename = $data['order_nro'] . '.pdf';
        $this->m_pdf->pdf->Output($path . $filename, "F");

        return $path . $filename;
    }

    public function createQR($code)
    {
        $this->load->library('ciqrcode');

        //hacemos configuraciones
        $params['data'] = $code;
        $params['level'] = 'H';
        $params['size'] = 10;
        //$params['framSize'] = 3; //tamaño en blanco

        //decimos el directorio a guardar el codigo qr, en este
        //caso una carpeta en la raíz llamada qr_code
        $params['savename'] = FCPATH . "files/qrs/qr_" . $code . ".png";
        //generamos el código qr
        $this->ciqrcode->generate($params);
        chmod(FCPATH . "files/qrs/qr_" . $code . ".png", 0777);
        //echo "files/qrs/qr_".$code.".png";
    }

    public function readQR()
    {
        $qr = trim($this->input->post('qr', true));

        $this->db->select('order_nro');
        $this->db->from('shipping');
        $this->db->where('order_nro', $qr);
        $this->db->where('((shipping_delivery_date IS NULL) OR (shipping_delivery_date = "0000-00-00 00:00:00"))');
        $this->db->limit(1);
        $res = $this->db->get()->result_array();

        $order_nro = '';

        if (!empty($res[0]['order_nro'])) {
            $order_nro = $res[0]['order_nro'];
        }

        echo $order_nro;
    }

    public function updateQuadminPoid()
    {
        $poidCode = trim($this->input->post('poidCode', true));
        $address = trim($this->input->post('address', true));
        $receiver_name = trim($this->input->post('receiver_name', true));
        $receiver_phone = trim($this->input->post('receiver_phone', true));
        $receiver_mail = trim($this->input->post('receiver_mail', true));

        $observation = trim($this->input->post('observation', true));
        $quadminOrder = array(
            'code' => $poidCode,
            'poiType' => 'SIN_TIPO',
            'name' => $receiver_name,
            'enabled' => true,
            'email' => $receiver_mail,
            'phoneNumber' => $receiver_phone,
            'poiDeliveryComments' => $observation,
            'originalAddress' => $address,
            'longAddress' => $address,
        );

        $data_string = json_encode($quadminOrder);
        $curl = curl_init();

        $endpoint = sprintf("%s/%s", "https://flash-api.quadminds.com/api/v2/pois", $poidCode);

        curl_setopt_array($curl, [
            CURLOPT_URL => $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "PUT",
            CURLOPT_POSTFIELDS => $data_string,
            CURLOPT_HTTPHEADER => [
                "Accept: application/json",
                "Content-Type: application/json",
                "x-saas-apikey: SzaORv8XtExcO1zVX3jcWGsOvyGwsl3y46sOLnmn",
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        }

        $response = curl_exec($curl);

        curl_close($curl);
        $point = json_decode($response, true);

        //$data = $point['data'];
        echo json_encode($point);

    }

    public function validarRetiro()
    {
        $user = trim($this->input->post('input-user', true));
        $password = md5(trim($this->input->post('input-password', true)));
        $order_nro = trim($this->input->post('input-order_nro', true));

        $success = 0;
        $message = '';

        $this->load->model('MWelcome', 'modeloWelcome');
        $data = $this->modeloWelcome->getUserSession($user, $password);
        $userEmail = '';
        //obtener en quadmins,
        $emailCompany = '';
        //obtener por order_nro
        $emailReceiver = '';
        //----------------------------------
        $this->db->select('receiver_mail');
        $this->db->from('shipping');
        $this->db->where('order_nro', $order_nro);
        $this->db->limit(1);
        $res = $this->db->get()->result_array();
        if (!empty($res[0]['receiver_mail'])) {
            $emailReceiver = $res[0]['receiver_mail'];
        }

        if (!empty($data[0]['id'])) {
            if (!empty($data[0]['rol_id']) && $data[0]['rol_id'] == 3) {
                $userEmail = $data[0]['email'];
                $emailCompany = $data[0]['c_email'];
                $message = '<font color="green">Retiro generado correctamente de la orden #<b>' . $order_nro . '</b>.<br>Se han generado las notificaciones pertinentes.</font>';
                $success = 1;
            } else {
                $message = '<font color="red">Usuario no posee el perfil para realizar esta operación.</font>';
            }
        } else {
            $message = '<font color="red">Usuario y/o contraseña no coinciden.</font>';
        }

        if ($success == 1) {
            $date_time = date('Y-m-d H:i:s');
            $dataUpdate = ['shipping_delivery_date' => $date_time, 'delivery_name' => $data[0]['name'] . ' ' . $data[0]['lastname']];
            //update fecha hora retiro
            $this->db->where('order_nro', $order_nro);
            if ($this->db->update('shipping', $dataUpdate)) {
                $this->enviarCorreo('Retiro Generado', '<p>Se ha generado correctamente un retiro con número de orden <b>#' . $order_nro . '</b></p>', $userEmail . ',' . $emailReceiver . ',' . $emailCompany, $date_time);
            }

        }

        $data = ['message' => $message, 'success' => $success, 'operation' => 2];
        $this->load->view('header2');
        //$this->load->view('aside');
        $this->load->view('shipping/readQR', $data);

    }

    public function enviarCorreo($asunto, $mensaje, $emails, $date_time)
    {
        /*
        no-responder@flypack.cl
        .&sNWO2Qt&!J
         */
        $mensaje .= '<br>';
        $mensaje .= 'Fecha hora: ' . $date_time;

        $to = $emails;

        $message = "
        <html>
        <head>
        <title>Notificación</title>
        </head>
        <body>
        <h5>Se generó el retiro</h5>
        " . $mensaje . "
        </body>
        </html>
        ";

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: <no-responder@flypack.cl>' . "\r\n";
        //$headers .= 'Cc: myboss@example.com' . "\r\n";

        mail($to, $asunto, $message, $headers);
    }

    public function enviarCorreo2($asunto, $mensaje, $emails)
    {
        /*
        no-responder@flypack.cl
        .&sNWO2Qt&!J
         */
        $to = $emails;

        $message = $mensaje;

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: <no-responder@flypack.cl>' . "\r\n";
        //$headers .= 'Cc: myboss@example.com' . "\r\n";

        mail($to, $asunto, $message, $headers);
    }

    public function addPickup()
    {
        $data = ['order_nro' => '', 'operation' => 1, 'success' => 0];

        $this->load->view('header');
        $this->load->view('aside');
        $this->load->view('shipping/readQR', $data);
    }

    public function notifications()
    {

        $orders = trim($this->input->post('orders', true));
        $orders_arr = explode(',', $orders);
        $companyEmail = '';
        $companyRazon = '';
        $userEmail = $this->session->userdata('email');
        if (count($orders_arr) > 0) {
            $date_time = date('d-m-Y H:i:s');
            $date_time2 = date('Y-m-d H:i:s');

            foreach ($orders_arr as $order) {
                $this->db->select('companies.email as email, companies.razon as razon');
                $this->db->from('companies');
                $this->db->join('shipping', 'shipping.companies_id=companies.id');
                $this->db->where('shipping.order_nro', $order);
                $this->db->limit(1);
                $res = $this->db->get()->result_array();
                if (!empty($res[0]['email'])) {
                    $companyEmail = $res[0]['email'];
                }
                if (!empty($res[0]['razon'])) {
                    $companyRazon = $res[0]['razon'];
                }
                //enviarCorreo($asunto, $mensaje, $emails, $date_time);
                $this->db->select('receiver_mail');
                $this->db->from('shipping');
                $this->db->where('order_nro', $order);
                $this->db->limit(1);
                $res = $this->db->get()->result_array();
                if (!empty($res[0]['receiver_mail'])) {
                    $res = $res[0]['receiver_mail'];

                    $this->addDelivery_Name_Date($order, $date_time2);
                    $this->enviarCorreo('Retiro Generado', '<p>Estimado cliente, su pedido ya ha sido retirado por Flypack SpA.  Su número de orden es <b># ' . $order . '</b></p>', $res, $date_time);
                }
            }

            $this->enviarCorreo2("Nuevo retiro de paquetes " . date('d-m-Y') . " en " . strtoupper($companyRazon), "Se ha generado un nuevo retiro
                con fecha " . date('d-m-Y') . " en " . strtoupper($companyRazon) . ".<b>Un total de " . count($orders_arr) . " paquetes por el repartidor " . $this->session->userdata('name') . " " . $this->session->userdata('lastname'), $companyEmail . ',' . $userEmail . ', antonio.flypack@gmail.com');

        }

        echo 1;
    }

    private function addDelivery_Name_Date($order, $date_time)
    {

        $data = ['shipping_delivery_date' => $date_time, 'delivery_name' => $this->session->userdata('name') . ' ' . $this->session->userdata('lastname')];
        $this->db->where('order_nro', $order);
        if ($this->db->update('shipping', $data)) {
            return true;
        } else {
            return false;
        }

    }

    public function getMyShippings()
    {
        $this->load->view('header');
        $this->load->view('aside');
        $this->load->view('shipping/index');
    }

    public function deleteQuadminsOrder($id)
    {
        $curl = curl_init();

        $url = "https://flash-api.quadminds.com/api/v2/orders/" . $id;
        echo $url;
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "DELETE",
            CURLOPT_HTTPHEADER => [
                "Accept: application/json",
                "x-saas-apikey: SzaORv8XtExcO1zVX3jcWGsOvyGwsl3y46sOLnmn",
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }

        $data = json_decode($response, true);
        echo json_encode($data);

    }
}
