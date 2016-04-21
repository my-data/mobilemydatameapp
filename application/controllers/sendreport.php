<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sendreport extends CI_Controller {

	public function index(){
		$is_logged_in = $this->session->userdata('logged_in');
		//$is_logged_in = true;
		if ($is_logged_in == TRUE){
			if (isset($_POST['alarm'])){
				$alarm = $_POST['alarm'];
				$data['alarm_name'] = $alarm;
			}
			//print_r($alarm);
			//print_r($_POST);
			//$username = $this->session->userdata('username');
			//$this->load->model('user_model', 'use');
			//$user_id = $this->use->get_user_id($username);
			//$user_id = $user_id[0]['user_id'];
			$user_id = $this->input->post('hiddenuserid');
			$data['user_id'] = $user_id;
			//$this->load->model('device_model','device');
			//$sender_id = $this->device->get_sender_id_for_user($user_id);
			//$sender_id = $sender_id[0]['sender_id'];
			$sender_id = $this->input->post('hiddensenderid');
			$data['sender_id'] = $sender_id;
			//$users = $this->use->get_all_users_information();
			//$data['users'] = $users;
			$this->load->model('device_model','devices');
			$data['devices'] = $this->devices->get_device_for_user($user_id);
			$this->load->model('alarm_model');
			$alarm_config = $this->alarm_model->get_alarm_user_sender($sender_id, $user_id);
			//print_r($alarm_config);
			$data['alarm_table'] = $alarm_config;
			$this->load->view('header');
			$this->load->view('email_form', $data);
			$this->load->view('footer');
		} else {
			$this->session->unset_userdata(array("username"=>"","logged_in"=>"","password"=>"","user_id"=>""));
			$this->session->sess_destroy();			
			$this->logout();
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('c=User&m=login');
	}

	public function update(){
		// $this->load->model('user_model', 'use');
		// $username = $this->session->userdata('username');
		// $user_id = $this->use->get_user_id($username);
		// $user_id = $user_id[0]['user_id'];
		// $this->load->model('device_model','device');
		// $sender_id = $this->device->get_sender_id_for_user($user_id);
		// $sender_id = $sender_id[0]['sender_id'];
		//print_r($sender_id);
		//$data = $this->input->post('email');
		$data = array(
			//'user_id' => $this->input->post('user_id'),
			//'sender_id' => $this->input->post('sender_id'),
			'from' => $this->input->post('from'),
			'to' => $this->input->post('to'),
			//'email_address' => $this->input->post('email_address'),
			//'email' => $this->input->post('email'),
			'subject' => $this->input->post('subject'),
			'message' => $this->input->post('message'),
			//'alarm_name' => $this->input->post('alarm_name')
			'alarm_name' => $this->input->post('alarm_name'),
			'alarm_number' => $this->input->post('alarm_number_analogues'),
			'sender_id' => $this->input->post('sender_id')
			);
		$name = $this->input->post('alarm_name');
		$number = $this->input->post('alarm_number_analogues');
		$sender_id = $this->input->post('sender_id');
		$this->load->model('alarm_model');
		//$this->alarm_model->add_alarm($data);
		//$method = $this->input->post('method');
		//if ($method == 'add'){
		//	$this->alarm_model->add_alarm($data);
		//} else if ( $method == 'update'){
		$this->alarm_model->update_alarm_using_sender_id($name,$sender_id,$data,$number);
		//}
		// $this->load->view('header');
		// $this->load->view('success_msg');
		// $this->load->view('footer');
		//$this->index();
		//print_r(json_encode(array($data,$name,$number,$sender_id)));
			echo $_GET['callback'] . '('.json_encode($data).')';
		//print_r(json_encode($data));		
	}

	public function submit(){
		//$this->load->model('user_model', 'use');
		//$username = $this->session->userdata('username');
		//$user_id = $this->use->get_user_id($username);
		//$user_id = $user_id[0]['user_id'];
		//$this->load->model('device_model','device');
		//$sender_id = $this->device->get_sender_id_for_user($user_id);
		//$sender_id = $sender_id[0]['sender_id'];
		//print_r($sender_id);
		$data = $this->input->post('email');
		$data = array(
			'user_id' => $this->input->post('user_id'),
			'sender_id' => $this->input->post('sender_id'),
			'from' => $this->input->post('from'),
			'to' => $this->input->post('to'),
			//'email_address' => $this->input->post('email_address'),
			'email' => $this->input->post('email'),
			'subject' => $this->input->post('subject'),
			'message' => $this->input->post('message'),
			'alarm_name' => $this->input->post('alarm_name'),
			'alarm_number' => $this->input->post('alarm_number_analogues')
			);
		$this->load->model('alarm_model');
		//$this->alarm_model->add_alarm($data);
		//$method = $this->input->post('method');
		$name = $this->input->post('alarm_name');
		$sender_id = $this->input->post('sender_id');
		$user_id = $this->input->post('user_id');
		$number = $data['alarm_number'];
		$result = $this->alarm_model->verify_unqiue_alarm($name, $sender_id, $user_id, $number);
		$is_unique = $result[0];
		if ($result == true){
			$this->alarm_model->add_alarm($data);			
		}
		//if ($method == 'add'){
		//} else if ( $method == 'update'){
		//	$this->alarm_model->update_alarm_using_sender_id($sender_id,$data);
		//}
		// $this->load->view('header');
		// $this->load->view('success_msg');
		// $this->load->view('footer');
		//$this->index();
		print_r(json_encode($result));
	}

	public function all_emails(){
		$this->load->model('email_model', 'email_model');
		$email_logs = $this->email_model->get();
		$email_logs = array_reverse($email_logs);
		$data['email'] = $email_logs;
		//$this->load->view('header');
		$this->load->view('header');
		$this->load->view('email_table', $data);
		$this->load->view('footer');
	}
}