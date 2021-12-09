<?php

class CExportSQL extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('MExportSQL', 'modelo');
	}

	public function index()
	{
		
		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('export/index');
		
	}
	
	public function add()
	{
	    $this->load->view('header');
		$this->load->view('aside');
		$this->load->view('export/add');
	}
	
	public function datatable()
	{
		$start = $this->input->post('start');
		$length = $this->input->post('length');
		$search = $this->input->post('search')['value'];
		$by = $this->input->post('order')['0']['column'];
		$order = $this->input->post('order')['0']['dir'];

		$result = $this->modelo->getExportSQL($start, $length, $search, $order, $by);

		$json_data = array(
			"draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($result['numDataTotal']),
            "recordsFiltered" => intval($result['numDataFilter']),
            "data"            => $result['data']
            );

        echo json_encode($json_data);
	}
	
	public function add_export_sql()
	{
	    $name    =   trim($this->input->post('name', TRUE));
	    $date_time  =   date('Y-m-d H:i:s');
	    $date = date('Y_m_d');
        $time = date('H_i');
	    $path = './sql_files/export_all_sql_data_'.$date.'_'.$time.'.sql';
	    
	    $data = array(
	        'name' => $name,
	        'path' => $path
	    );
	   
	   if($this->modelo->addExport($data))
	   {
	       $this->load->dbutil();
    	    $prefs = array(
                //'tables'      => array('people'),  // Array of tables to backup.
                'ignore'      => array(),           // List of tables to omit from the backup
                'format'      => 'txt',             // gzip, zip, txt
                'filename'    => 'mybackup.sql',    // File name - NEEDED ONLY WITH ZIP FILES
                'add_drop'    => TRUE,              // Whether to add DROP TABLE statements to backup file
                'add_insert'  => TRUE,              // Whether to add INSERT data to backup file
                'newline'     => "\n"               // Newline character used in backup file
            );
                          
    	    $backup = $this->dbutil->backup($prefs);
    	    $this->load->helper('file');
            write_file($path, $backup);
            
            //$this->load->helper('download');
            //force_download('export_sql.sql', $backup);
            
            if($this->modelo->cleanTables())
                echo '1';
            else
                echo '0';
	   }
	}
	
	public function import_database()
	{
	    $export_id    =   trim($this->input->post('id', TRUE));
	    $this->db->select('path');
	    $this->db->from('exports');
	    $this->db->where('id', $export_id);
	    $res = $this->db->get()->result_array();
	    $path = '';
	    if(!empty($res[0]['path']))
	        $path = $res[0]['path'];
	    
        $temp_line = '';
        $lines = file($path); 
        foreach ($lines as $line)
        {
            if (substr($line, 0, 2) == '--' || $line == '' || substr($line, 0, 1) == '#')
                continue;
            $temp_line .= $line;
            if (substr(trim($line), -1, 1) == ';')
            {
                $this->db->query($temp_line);
                $temp_line = '';
            }
        }
        
        $this->automatic_export_sql();
        
    }

    private function automatic_export_sql()
	{
	    $name    =   'Generado por el sistema automáticamente';
	    $date_time  =   date('Y-m-d H:i:s');
	    $date = date('Y_m_d');
        $time = date('H_i');
	    $path = './sql_files/export_all_sql_data_'.$date.'_'.$time.'.sql';
	    
	    $data = array(
	        'name' => $name,
	        'path' => $path
	    );
	   
	   if($this->modelo->addExport($data))
	   {
	       $this->load->dbutil();
    	    $prefs = array(
                //'tables'      => array('people'),  // Array of tables to backup.
                'ignore'      => array(),           // List of tables to omit from the backup
                'format'      => 'txt',             // gzip, zip, txt
                'filename'    => 'mybackup.sql',    // File name - NEEDED ONLY WITH ZIP FILES
                'add_drop'    => TRUE,              // Whether to add DROP TABLE statements to backup file
                'add_insert'  => TRUE,              // Whether to add INSERT data to backup file
                'newline'     => "\n"               // Newline character used in backup file
            );
                          
    	    $backup = $this->dbutil->backup($prefs);
    	    $this->load->helper('file');
            write_file($path, $backup);
            
            //$this->load->helper('download');
            //force_download('export_sql.sql', $backup);
            //$this->modelo->cleanTables();
	   }
	}

}

?>