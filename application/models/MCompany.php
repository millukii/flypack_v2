<?php

class MCompany extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getCompany($start, $length, $search, $order, $by)
    {
        $retornar = array();
        if ($search) {
            $busca = $this->getSearchCompany($search, $start, $length, $order, $by);
            $retornar['numDataFilter'] = $this->getCountSearch($search, $start, $length, $order, $by);
            $retornar['data'] = $busca['datos'];
        } else {
            $todo = $this->getAllCompanies($start, $length, $order, $by);
            $retornar['numDataFilter'] = $this->getCount();
            $retornar['data'] = $todo['datos'];
        }

        $retornar['numDataTotal'] = $this->getCount();

        return $retornar;
    }

    public function getCompany_($id)
    {
        $this->db->select('*, companies.id as id');
        $this->db->from('companies');
        $this->db->join('companies_state', 'companies_state.id = companies.companies_state_id');
        $this->db->join('city', 'city.id = companies.city_id');
        $this->db->join('communes', 'communes.id = companies.communes_id');
        $this->db->where('companies.id', $id);
        $this->db->limit(1);

        return $this->db->get()->result_array();
    }

    // Funciones auxiliares datatable
    public function getAllCompanies($start, $length, $order, $by)
    {
        $this->db->select('companies.id as id, companies_state.state as state, companies.rut as rut, companies.dv as dv, companies.razon as razon, companies.fantasy as fantasy, companies.address as address, city.city as city, communes.commune as commune');
        $this->db->join('companies_state', 'companies_state.id = companies.companies_state_id');
        $this->db->join('city', 'city.id = companies.city_id');
        $this->db->join('communes', 'communes.id = companies.communes_id');
        switch ($by) {
            case 0:
                $this->db->order_by('companies.id', $order);
                break;
            case 1:
                $this->db->order_by('companies.rut', $order);
                break;
            case 2:
                $this->db->order_by('companies.razon', $order);
                break;
            case 3:
                $this->db->order_by('fantasy', $order);
                break;
            case 4:
                $this->db->order_by('people.id', $order);
                break;
        }

        $this->db->limit($length, $start);
        $query = $this->db->get('companies');

        $retornar = array(
            'datos' => $query->result(),
        );
        return $retornar;
    }

    public function getSearchCompany($search, $start, $length, $order, $by)
    {
        $this->db->select('companies.id as id, companies_state.state as state, companies.rut as rut, companies.dv as dv, companies.razon as razon, companies.fantasy as fantasy, companies.address as address, city.city as city, communes.commune as commune');
        $this->db->join('companies_state', 'companies_state.id = companies.companies_state_id');
        $this->db->join('city', 'city.id = companies.city_id');
        $this->db->join('communes', 'communes.id = companies.communes_id');

        $this->db->like('companies.id', $search);
        $this->db->or_like('companies.rut', $search);
        $this->db->or_like('companies.razon', $search);
        $this->db->or_like('companies.fantasy', $search);

        switch ($by) {
            case 0:
                $this->db->order_by('companies.id', $order);
                break;
            case 1:
                $this->db->order_by('companies.rut', $order);
                break;
            case 2:
                $this->db->order_by('name', $order);
                break;
            case 3:
                $this->db->order_by('fantasy', $order);
                break;
        }

        $this->db->limit($length, $start);
        $query = $this->db->get('companies');

        $retornar = array(
            'datos' => $query->result(),
        );
        return $retornar;
    }

    public function getCount()
    {
        return $this->db->count_all('companies');
    }

    public function getCountSearch($search, $start, $length, $order, $by)
    {
        $this->db->select('companies.id');

        $this->db->join('people', 'people.id = companies.people_id');
        $this->db->join('city', 'city.id = companies.city_id');
        $this->db->join('communes', 'communes.id = companies.communes_id');

        $this->db->like('companies.id', $search);
        $this->db->or_like('companies.rut', $search);
        $this->db->or_like('companies.razon', $search);
        $this->db->or_like('companies.fantasy', $search);

        $query = $this->db->get('companies')->num_rows();
        return $query;
    }
    //
    //Crud
    public function addCompany($data)
    {
        if ($this->db->insert('companies', $data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }

    }

    public function editCompany($data, $id)
    {
        $this->db->where('id', $id);
        if ($this->db->update('companies', $data)) {
            return true;
        } else {
            return false;
        }

    }

    public function getAllPeople()
    {
        $this->db->select('id, rut, dv, name, lastname');
        $this->db->from('people');
        $this->db->order_by('rut');

        return $this->db->get()->result();
    }

    public function addUser($data)
    {
        if ($this->db->insert('users', $data)) {
            return true;
        } else {
            return false;
        }

    }

    public function getUsersByCompany($id)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->join('companies', 'companies.id = users.companies_id');
        $this->db->where('companies.id', $id);
        $this->db->order_by('users.user', 'asc');

        return $this->db->get()->result();
    }

    public function editUsers($data, $id)
    {
        $this->db->where('companies_id', $id);
        if ($this->db->update('users', $data)) {
            return true;
        } else {
            return false;
        }

    }

    public function getAllCompanies_states()
    {
        $this->db->select('id, state');
        $this->db->from('user_state');
        $this->db->order_by('state');

        return $this->db->get()->result();
    }

    public function getCity()
    {
        $this->db->select('id, city');
        $this->db->from('city');
        $this->db->order_by('city');

        return $this->db->get()->result();
    }

    public function getCommunes($city_id = null)
    {
        $this->db->select('id, commune');
        $this->db->from('communes');
        if (!empty($city_id)) {
            $this->db->where('city_id', $city_id);
        }

        $this->db->order_by('commune');

        return $this->db->get()->result();
    }

    public function add_company_address($data)
    {
        if ($this->db->insert('company_address', $data)) {
            return true;
        } else {
            return false;
        }

    }

    public function getSucursales($companies_id)
    {
        $this->db->select('city.city, communes.commune, company_address.address');
        $this->db->from('company_address');
        $this->db->join('city', 'city.id = company_address.city_id');
        $this->db->join('communes', 'communes.id = company_address.communes_id');
        $this->db->where('company_address.companies_id', $companies_id);

        return $this->db->get()->result();
    }

}
