<?php

class CCompany extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('MCompany', 'modelo');
    }

    public function index()
    {
        $this->load->view('header');
        $this->load->view('aside');
        $this->load->view('companies/index');
    }

    //Datatable
    public function datatable()
    {
        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $search = $this->input->post('search')['value'];
        $by = $this->input->post('order')['0']['column'];
        $order = $this->input->post('order')['0']['dir'];

        $result = $this->modelo->getCompany($start, $length, $search, $order, $by);
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
        $city = $this->modelo->getCity();
        $data = array(
            'city' => $city,
        );

        $this->load->view('header');
        $this->load->view('aside');
        $this->load->view('companies/add', $data);
    }

    public function edit()
    {
        $id = trim($this->input->get('id', true));

        $company = $this->modelo->getCompany_($id);
        $companies_states = $this->modelo->getAllCompanies_States();
        $city = $this->modelo->getCity();
        $communes = $this->modelo->getCommunes();
        $sucursales = $this->modelo->getSucursales($id);

        $data = array(
            'company' => $company,
            'companies_states' => $companies_states,
            'city' => $city,
            'communes' => $communes,
            'sucursales' => $sucursales,
        );

        $this->load->view('header');
        $this->load->view('aside');
        $this->load->view('companies/edit', $data);
    }

    public function view()
    {
        $id = trim($this->input->get('id', true));

        $company = $this->modelo->getCompany_($id);
        $users = $this->modelo->getUsersByCompany($id);
        $sucursales = $this->modelo->getSucursales($id);

        $data = array(
            'company' => $company,
            'users' => $users,
            'sucursales' => $sucursales,
        );

        $this->load->view('header');
        $this->load->view('aside');
        $this->load->view('companies/view', $data);
    }

    public function addCompany()
    {
        $rut = trim($this->input->post('rut', true));
        $dv = trim($this->input->post('dv', true));
        $razon = trim($this->input->post('razon', true));
        $fantasy = trim($this->input->post('fantasy', true));
        $address = trim($this->input->post('address', true));
        $city_id = trim($this->input->post('city_id', true));
        $communes_id = trim($this->input->post('communes_id', true));
        $type_rate = trim($this->input->post('type_rate', true));

        $merchant_id = trim($this->input->post('merchant_id', true));
        $email = trim($this->input->post('email', true));
        $business_email = trim($this->input->post('business_email', true));

        $sucursales = $this->input->post('sucursales', true);

        if (empty($razon)) {
            $razon = 'N/A';
        }

        if (empty($fantasy)) {
            $fantasy = 'N/A';
        }

        if (empty($address)) {
            $address = 'N/A';
        }

        if (empty($city)) {
            $city = 'N/A';
        }

        if (empty($commune)) {
            $commune = 'N/A';
        }

        if (empty($email)) {
            $email = 'N/A';
        }
        if (empty($business_email)) {
            $business_email = 'N/A';
        }

        if (empty($merchant_id)) {
            $merchant_id = 0;
        }

        $data = array(
            'rut' => $rut,
            'dv' => $dv,
            'razon' => $razon,
            'fantasy' => $fantasy,
            'address' => $address,
            'city_id' => $city_id,
            'communes_id' => $communes_id,
            'type_rate' => $type_rate,
            'merchant_id' => $merchant_id,
            'email' => $business_email,
        );

        $companies_id = $this->modelo->addCompany($data);
        if ($companies_id != false) {
            if (!empty($sucursales)) {
                foreach ($sucursales as $suc) {
                    $data = ['companies_id' => $companies_id, 'city_id' => $suc['suc_city'], 'communes_id' => $suc['suc_commune'], 'address' => $suc['suc_address']];
                    $this->modelo->add_company_address($data);
                }
            }

            $user = trim($this->input->post('user', true));
            $password = trim($this->input->post('password', true));
            if (empty($password)) {
                $password = $this->generatePassword();
            }

            $password_ = $password;
            $roles_id = 2;
            $name = trim($this->input->post('name', true));
            $lastname = trim($this->input->post('lastname', true));
            $email = trim($this->input->post('email', true));
            $phone = trim($this->input->post('phone', true));
            $companies_id = $companies_id;
            $user_state_id = 1;
            $date_time = date('Y-m-d H:i:s');

            if (!empty($user) && !empty($password) && !empty($name) && !empty($lastname)) {
                $data = array(
                    'user' => $user,
                    'password' => md5($password),
                    'rol_id' => $roles_id,
                    'name' => $name,
                    'lastname' => $lastname,
                    'email' => $email,
                    'phone' => $phone,
                    'companies_id' => $companies_id,
                    'user_state_id' => $user_state_id,
                    'created' => $date_time,
                    'modified' => $date_time,
                );

                if ($this->modelo->addUser($data)) {
                    $message = 'Bienvenido ' . $name . '. ';
                    $message .= 'Se ha creado una cuenta para que puedas acceder al portal de Flypack, tus credenciales son: ';
                    $message .= '- Usuario: ' . $user;
                    $message .= '- Password: ' . $password_;
                    //$this->sendEmail('no-reply@flypack.cl', $email, 'Credenciales de acceso', $message);
                    echo '1';
                } else {
                    echo '0';
                }

            } else {
                echo '0';
            }

        } else {
            echo '0';
        }

    }

    public function editCompany()
    {
        $id = trim($this->input->post('id', true));
        $rut = trim($this->input->post('rut', true));
        $dv = trim($this->input->post('dv', true));
        $razon = trim($this->input->post('razon', true));
        $fantasy = trim($this->input->post('fantasy', true));
        $address = trim($this->input->post('address', true));
        $city_id = trim($this->input->post('city_id', true));
        $communes_id = trim($this->input->post('communes_id', true));
        $companies_states_id = trim($this->input->post('companies_states_id', true));
        $merchant_id = trim($this->input->post('merchant_id', true));
        $email = trim($this->input->post('email', true));
        $business_email = trim($this->input->post('business_email', true));

        if (empty($name)) {
            $name = 'N/A';
        }

        if (empty($lastname)) {
            $lastname = 'N/A';
        }

        if (empty($address)) {
            $address = 'N/A';
        }

        if (empty($phone)) {
            $phone = '000000000';
        }

        if (empty($business_email)) {
            $business_email = 'sin_email@gmail.com';
        }

        if (empty($merchant_id)) {
            $merchant_id = 0;
        }

        $data = array(
            'rut' => $rut,
            'dv' => $dv,
            'razon' => $razon,
            'fantasy' => $fantasy,
            'address' => $address,
            'city_id' => $city_id,
            'communes_id' => $communes_id,
            'companies_state_id' => $companies_states_id,
            'merchant_id' => $merchant_id,
            'email' => $business_email,
        );

        if ($this->modelo->editCompany($data, $id)) {
            echo '1';
        } else {
            echo '0';
        }

    }

    public function deleteCompany()
    {
        $id = trim($this->input->post('id', true));

        $data = array(
            'companies_state_id' => '3',
        );

        if ($this->modelo->editCompany($data, $id)) {
            $data = array(
                'user_state_id' => '3',
            );

            if ($this->modelo->editUsers($data, $id)) {
                echo '1';
            }

        } else {
            echo '0';
        }

    }

    public function generateMasive()
    {
        $quantity_workers = trim($this->input->post('quantity_workers', true));

        $this->db->select('id');
        $this->db->from('companies');
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
                'rut' => $res,
                'dv' => $res,
                'name' => 'N/A',
                'lastname' => 'N/A',
                'address' => 'N/A',
                'email' => 'sin_correo@gmail.com',
                'phone' => '000000000',
                'profile_id' => 2,
                'company_states_id' => 1,
                'created' => $date_time,
            );

            $this->modelo->addCompany($data);
        }

        echo '1';
    }

    public function getCommunesByCity()
    {
        $city_id = trim($this->input->post('city_id', true));
        if (!empty($city_id)) {
            $communes = $this->modelo->getCommunes($city_id);
        }

        $salida = '';
        foreach ($communes as $c) {
            $salida .= '<option value="' . $c->id . '">' . $c->commune . '</option>';
        }

        echo $salida;
    }

    private function generatePassword()
    {
        $comb = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array();
        $combLen = strlen($comb) - 1;
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $combLen);
            $pass[] = $comb[$n];
        }
        return implode($pass);
    }

    private function sendEmail($from, $to, $subject, $message)
    {
        $to_ = $to;
        $to = $from . ', ' . $to;
        $headers = "From: " . $from . "\r\n" . "CC: " . $to_;

        mail($to, $subject, $message, $headers);
    }

    public function createQuadminMerchant()
    {
        $name = trim($this->input->post('name', true));
        $email = trim($this->input->post('email', true));

        $emails = [];
        array_push($emails, $email);

        $quadminMerchant = array(
            'name' => $name,
            'emails' => $emails,
        );

        $data_string = json_encode($quadminMerchant);
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://flash-api.quadminds.com/api/v2/merchants",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
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
        $data = json_decode($response, true);

        echo json_encode($data['data']);

    }

}
