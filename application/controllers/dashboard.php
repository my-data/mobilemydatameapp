<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index(){
		$is_logged_in = $this->session->userdata('logged_in');
		//$is_logged_in = true;
		if ($is_logged_in == TRUE){
			$user_id = $this->session->userdata('user_id');
			$user_messages = $this->data_model->get_data($user_id);
			$user_id=17;
			$data['messages'] = $user_messages;
			$this->load->model('input_model');
			$input_data = $this->input_model->get_all_inputs_for_user($user_id);
			$data['config'] = $input_data;
			$this->load->model('device_model');
			$datalogger = $this->device_model->get_device_for_user($user_id);
			$data['datalogger'] = $datalogger;
			$this->load->model('user_model');
			$user = $this->user_model->get($user_id);
			$data['user'] = $user;
			$this->load->view('header');
			$this->load->view('wrold_table', $data);
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

}