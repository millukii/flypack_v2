<?php

class CWelcome extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('MWelcome', 'modelo');
		$this->load->model('MSession', 'modelo_session');
	}

	public function index()
	{
		
		if($this->session->userdata('user'))
		{
			$this->load->view('header');
			$this->load->view('aside');
			$this->load->view('wrapper');
			$this->load->view('footer');
		}
		else
			$this->load->view('login');
		
		//$this->load->view('login');	
	}

	public function Login()
	{
		$date_time_now = date('Y-m-d H:i:s');
		$dt = new DateTime($date_time_now);
		$date_now = $dt->format('Y-m-d');
		$time_now = $dt->format('H:i:s');

		$user = trim($this->input->post('user', TRUE));
		$password_ = trim($this->input->post('password', TRUE));
		$password = md5(trim($this->input->post('password', TRUE)));
		$ip = trim($this->input->post('ip', TRUE));

		$data = $this->modelo->getUserSession($user, $password);

		if(!empty($data[0]['rol_id']))
		{
			$asession_array = array();
			if(!empty($data))
			{
				if($data[0]['user_state_id'] == 1)
				{
					$session_array = array(
						'user' => $user,
						'password' => $password,
						'password_' => $password_,
						'rol' => $data[0]['rol'],
						'rol_id' => $data[0]['rol_id'],
						'users_id' => $data[0]['id'],
						'name'=> $data[0]['name'],
						'lastname' => $data[0]['lastname'],
						'state' => $data[0]['state'],
						'ip' => $ip,
						'rut' => $data[0]['rut'], 
						'dv' => $data[0]['dv'], 
						'email' => $data[0]['email'], 
						'phone' => $data[0]['phone'],
						'companies_id' => $data[0]['companies_id'],
						'rut' => $data[0]['rut'],
						'dv' => $data[0]['dv'],
						'razon' => $data[0]['razon'],
						'type_rate' => $data[0]['type_rate']
					);
					
					//SESSION START
					$this->session->set_userdata($session_array);
					header('Location: '.base_url().'index.php/CWelcome/index');
				}
				else if($data[0]['user_state_id'] == 2)
				{
					$message = array('message' => '<h6><font color="red">Tu cuenta esta Eliminada.<br>Acercate al Administrador para regularizar tu situación.</font></h6>');
					$this->load->view('login',$message);
				}
				else
				{
					$message = array('message' => '<h6><font color="red">Tu cuenta esta temporalmente suspendida.<br>Acercate al Administrador para regularizar tu situación.</font></h6>');
					$this->load->view('login',$message);
				}
				
			}
			else
			{	
				$message = array('message' => '<h6><font color="red">Usuario o Contraseña Incorrecto</font></h6>');
				$this->load->view('login',$message);
			}	
		}
		else
		{
			$message = array('message' => '<h6><font color="red">Usuario o Contraseña Incorrecto</font></h6>');
			$this->load->view('login',$message);
		}
			

	}

	public function Logout()
	{
		$this->session->userdata = array();
		$this->session->sess_destroy();
		header('Location: '.site_url("CWelcome"));
	}

	public function Profile()
	{
		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view('users/profile');
	}

	public function updateData()
	{
		$password = trim($this->input->post('password', TRUE));
		$name = trim($this->input->post('name', TRUE));
		$lastname = trim($this->input->post('lastname', TRUE));
		$email = trim($this->input->post('email', TRUE));
		$phone = trim($this->input->post('phone', TRUE));

		if(!empty($password))
		{
			$password = md5($password);

			$data = array(
				'password' => $password,
				'name' => $name,
				'lastname' => $lastname,
				'email' => $email,
				'phone' => $phone
			);
		}
		else
		{
			$data = array(
				'name' => $name,
				'lastname' => $lastname,
				'email' => $email,
				'phone' => $phone
			);
		}
			
		$this->db->where('id', $this->session->userdata('users_id'));
		$this->db->update('users',$data);

		$this->Logout();
		
	}
		
}

?>
