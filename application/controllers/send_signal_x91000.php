<?php

class Send_signal_x91000 extends CI_Controller
{

    function index()
    {
    	$user_id = $this->session->userdata('user_id');
		$user_messages = $this->data_model->get_messages_for_user($user_id);
		$data['user_messages'] = $user_messages;
		$this->load->model('input_model');
		$input_data = $this->input_model->get_all_inputs_for_user($user_id);
		$data['input'] = $input_data;
		$this->load->model('device_model');
		$datalogger = $this->device_model->get_device_for_user($user_id);
		$data['datalogger'] = $datalogger;
		$this->load->model('user_model');
		$user = $this->user_model->get($user_id);
		$data['user'] = $user;
		$this->load->view('header');
        $this->load->view('buttons', $data);
    	$this->load->view('footer');
    }

    function interact_with_x91000(){
    	
    }

}