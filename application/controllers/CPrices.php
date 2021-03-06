<?php

class CPrices extends CI_Controller
{

    private $letters;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('MPrices', 'modelo');
        $this->load->model('MUsers', 'modeloUsers');
        $this->load->model('MShipping', 'modeloShipping');

        $this->letters = [
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
            'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ',
        ];
    }

    public function index()
    {
        $companies = $this->modelo->getAllCompanies();

        $data = array(
            'companies' => $companies,
        );

        $this->load->view('header');
        $this->load->view('aside');
        $this->load->view('prices/index', $data);
    }

    public function indexclient()
    {

        $userId = $this->session->userdata('users_id');
        $companies_id = $this->session->userdata('companies_id');
        $userCompany = $this->modeloShipping->getCompanyOfUser($userId);

        //$user = $this->modeloUsers->getUser($userId);
        $companies = [$userCompany];

        $data = array(
            'user_company' => $userCompany,
            'companies' => $companies,
        );

        $this->load->view('header');
        $this->load->view('aside');
        $this->load->view('prices/index-client', $data);
    }

    public function datatable()
    {
        if ($this->getType_Rate_() == '1') {
            $start = $this->input->post('start');
            $length = $this->input->post('length');
            $search = $this->input->post('search')['value'];
            $by = $this->input->post('order')['0']['column'];
            $order = $this->input->post('order')['0']['dir'];

            $company = trim($this->input->post('company', true));

            $result = $this->modelo->getPrices($start, $length, $search, $order, $by, $company);

            $json_data = array(
                "draw" => intval($this->input->post('draw')),
                "recordsTotal" => intval($result['numDataTotal']),
                "recordsFiltered" => intval($result['numDataFilter']),
                "data" => $result['data'],
            );
        } else {
            $start = $this->input->post('start');
            $length = $this->input->post('length');
            $search = $this->input->post('search')['value'];
            $by = $this->input->post('order')['0']['column'];
            $order = $this->input->post('order')['0']['dir'];

            $company = trim($this->input->post('company', true));

            $result = $this->modelo->getPrices_($start, $length, $search, $order, $by, $company);

            $json_data = array(
                "draw" => intval($this->input->post('draw')),
                "recordsTotal" => intval($result['numDataTotal']),
                "recordsFiltered" => intval($result['numDataFilter']),
                "data" => $result['data'],
            );
        }

        echo json_encode($json_data);
    }

    public function add()
    {
        $company = trim($this->input->get('company', true));
        $data = ['company' => $company];

        $this->load->view('header');
        $this->load->view('aside');
        $this->load->view('prices/add', $data);
    }

    public function edit()
    {
        $id = trim($this->input->get('id', true));
        $companies_id = trim($this->input->get('companies_id', true));

        $prices = $this->modelo->getPrice($companies_id, $id);

        $data = array('prices' => $prices);

        $this->load->view('header');
        $this->load->view('aside');
        $this->load->view('prices/edit', $data);
    }

    public function view()
    {
        $id = trim($this->input->get('id', true));

        $prices = $this->modelo->getPrice($id);

        $data = array('prices' => $prices);

        $this->load->view('header');
        $this->load->view('aside');
        $this->load->view('prices/view', $data);
    }

    public function addPrice()
    {
        $price = trim($this->input->post('price', true));
        $date_time = date('Y-m-d H:i:s');
        $data = array(
            'price' => $price,
            //    'created' => $date_time
        );
        if ($this->modelo->addPrice($data)) {
            echo '1';
        } else {
            echo '0';
        }

    }

    public function addPriceSize()
    {
        $value = trim($this->input->post('value', true));
        $size = trim($this->input->post('size', true));
        $companies_id = trim($this->input->post('companies_id', true));

        $date_time = date('Y-m-d H:i:s');
        $data = array(
            'value' => $value,
            'size' => $size,
            'companies_id' => $companies_id,
        );
        if ($this->modelo->addPriceSize($data)) {
            echo '1';
        } else {
            echo '0';
        }

    }

    public function editPrice()
    {
        $id = trim($this->input->post('id', true));
        $companies_id = trim($this->input->post('companies_id', true));
        $value = trim($this->input->post('value', true));

        $data = array(
            'value' => $value,
        );

        if ($this->modelo->editPrice($companies_id, $data, $id)) {
            echo '1';
        } else {
            echo '0';
        }

    }

    public function deletePrice()
    {
        $id = trim($this->input->post('id', true));
        if ($this->modelo->deletePrice($id)) {
            echo '1';
        } else {
            echo '0';
        }

    }

    public function import_excelfile()
    {
        $company = trim($this->input->post('input-company', true));
        //TODO: condicionar type_rate
        $this->db->where('companies_id', $company);
        $this->db->delete('rates');

        $this->load->library('excel');

        $ruta = './assets/excel/';
        if (!file_exists($ruta)) {
            mkdir($ruta, 0777, true);
        }

        foreach ($_FILES as $key) {
            if ($key['error'] == UPLOAD_ERR_OK) {
                $nombreArchivo = $key['name'];
                $temporal = $key['tmp_name'];
                $destino = $ruta . $nombreArchivo;

                move_uploaded_file($temporal, $destino);

                $objReader = PHPExcel_IOFactory::createReader('Excel2007');
                $objReader->setReadDataOnly(true);

                $objPHPExcel = $objReader->load($destino);
                //$objWhorksheet = $objPHPExcel->getActiveSheet();

                $filas = $objPHPExcel->getActiveSheet()->getHighestRow();

                for ($i = 2; $i <= $filas; $i++) {
                    $from = $objPHPExcel->getActiveSheet()->getCell($this->letters[0] . $i)->getValue();
                    for ($j = 2; $j <= $filas; $j++) {
                        $to = $objPHPExcel->getActiveSheet()->getCell($this->letters[0] . $j)->getValue();
                        $value = $objPHPExcel->getActiveSheet()->getCell($this->letters[($j - 1)] . $i)->getValue();

                        $value = str_replace('$', '', $value);
                        $value = str_replace('.', '', $value);
                        $value = str_replace(',', '', $value);

                        if (!empty($from)) {
                            $data = array(
                                'from' => strtoupper($from),
                                'to' => strtoupper($to),
                                'value' => $value,
                                'companies_id' => $company,
                            );

                            $this->db->insert('rates', $data);
                        }
                    }

                }
                unlink($destino);
            }
        }

        header("Location: " . base_url() . "index.php/CPrices/index");
    }

    public function export_excelfile()
    {
        $this->load->library('Excel');

        $ruta = './assets/excel/';
        if (!file_exists($ruta)) {
            mkdir($ruta, 0777, true);
        }

        $company = trim($this->input->get('company', true));
        //TODO: condicionar type_rate

        $type_rate = $this->modelo->getType_Rate($company);

        if ($type_rate == 1) {

            $this->db->select('*');
            $this->db->from('rates');
            $this->db->where('companies_id', $company);
            $this->db->order_by('id', 'asc');

            $prices = $this->db->get()->result_array();

            $from = array();
            $from_to = array();

            $objPHPExcel = new PHPExcel();
            $objPHPExcel->setActiveSheetIndex(0);

            $objPHPExcel->getActiveSheet()->SetCellValue('A1', "");
            $indice = 0;
            $indice2 = 0;
            $indice3 = 0;
            for ($i = 0; $i < count($prices); $i++) {
                //crear filas y columnas
                if (!in_array($prices[$i]['from'], $from)) {
                    array_push($from, $prices[$i]['from']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('A' . ($indice + 2), $prices[$i]['from']);
                    $objPHPExcel->getActiveSheet()->SetCellValue($this->letters[($indice + 1)] . '1', $prices[$i]['from']);

                    $indice++;
                    $indice2 = 0;
                }

                //llenar valores
                $objPHPExcel->getActiveSheet()->SetCellValue($this->letters[($indice2 + 1)] . ($indice + 1), $prices[$i]['value']);
                $indice2++;
                /*
            if(!in_array($prices[$i]['from'], $from_to))
            {
            array_push($from_to, $prices[$i]['from']);

            $objPHPExcel->getActiveSheet()->SetCellValue($this->letters[($indice2+1)].($indice3+2),$prices[$i]['value']);
            $indice2++;
            }
            else
            {
            $indice3++;
            $objPHPExcel->getActiveSheet()->SetCellValue($this->letters[($indice2+1)].($indice3+2),$prices[$i]['value']);
            }
             */
            }

            $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
            //$objWriter->save($ruta.'precios_'.date('Ymd').'.xlsx');

            // We'll be outputting an excel file
            header('Content-type: application/vnd.ms-excel');

            // It will be called file.xls
            header('Content-Disposition: attachment; filename="precios_' . date('Ymd') . '.xlsx"');

            // Write file to the browser
            $objWriter->save('php://output');
        } else {
            //exportar segun tipo de cobro por tallas

            $this->db->select('*');
            $this->db->from('rates_size');
            $this->db->where('companies_id', $company);
            $this->db->order_by('id', 'asc');

            $prices = $this->db->get()->result_array();

            $from = array();
            $from_to = array();

            $objPHPExcel = new PHPExcel();
            $objPHPExcel->setActiveSheetIndex(0);

            $objPHPExcel->getActiveSheet()->SetCellValue('A1', "");
            $indice = 0;
            $indice2 = 0;

            $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Tama??o');
            $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Valor');

            for ($i = 0; $i < count($prices); $i++) {
                $objPHPExcel->getActiveSheet()->SetCellValue('A' . ($i + 2), $prices[$i]['size']);
                $objPHPExcel->getActiveSheet()->SetCellValue('B' . ($i + 2), $prices[$i]['value']);
            }

            $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
            //$objWriter->save($ruta.'precios_'.date('Ymd').'.xlsx');

            // We'll be outputting an excel file
            header('Content-type: application/vnd.ms-excel');

            // It will be called file.xls
            header('Content-Disposition: attachment; filename="precios_' . date('Ymd') . '.xlsx"');

            // Write file to the browser
            $objWriter->save('php://output');

        }

    }

    private function getValue($from, $to, $company)
    {
        $this->db->select('value');
        $this->db->from('rates');
        $this->db->where('from', $from);
        $this->db->where('to', $to);
        $this->db->where('companies_id', $company);
        $this->db->limit(1);

        $res = $this->db->get()->result_array();
        if (!empty($res[0]['value'])) {
            return $res[0]['value'];
        } else {
            return 0;
        }

    }

    public function getType_Rate()
    {
        $company = trim($this->input->post('company', true));
        $type_rate = 1;

        $this->db->select('type_rate');
        $this->db->from('companies');
        $this->db->where('companies.id', $company);
        $this->db->limit(1);
        $res = $this->db->get()->result_array();
        if (!empty($res[0]['type_rate'])) {
            $type_rate = $res[0]['type_rate'];
        }

        echo $type_rate;
    }

    public function getType_Rate_()
    {
        $company = trim($this->input->post('company', true));
        $type_rate = 1;

        $this->db->select('type_rate');
        $this->db->from('companies');
        $this->db->where('companies.id', $company);
        $this->db->limit(1);
        $res = $this->db->get()->result_array();
        if (!empty($res[0]['type_rate'])) {
            $type_rate = $res[0]['type_rate'];
        }

        return $type_rate;
    }
}
