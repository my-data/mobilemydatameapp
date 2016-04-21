<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setup_users extends CI_Controller {

	public function index(){
		$is_logged_in = $this->session->userdata('logged_in');
		if ($is_logged_in == TRUE){
			$username = $this->session->userdata('username');
			$user_id = $this->user_model->get_user_id($username);
			$user_id = $user_id[0]['user_id'];
			$this->load->model('user_model', 'userem');
			$users = $this->userem->get_all_users();
			$data['users'] = $users;
			$user_info = $this->userem->get_all_users_information();
			$data['info'] = $user_info;
			$this->load->model('device_model');
			$device = $this->device_model->get_device_for_user($user_id);
			$data['datalogger'] = $device;
			$this->load->view('header');
			//print_r($data);
			$this->load->view('setup_users', $data);
			$this->load->view('footer');
		} else {
			$this->logout();
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('c=User&m=login');
	}

	public function add_user(){
		$method = $this->input->post('method');
		if($method == "Add User"){
			$config['upload_path'] = base_url().'Uploads';
			$config['allowed_types'] = 'gif|jpg|png';
			//$config['max_size'] = '100';
			$config['max_width'] = '1024';
			$config['max_height'] = '768';
			$config['image_library'] = 'gd2';
			//$config['encrypt_name'] = true;
			$this->load->library('upload', $config);
			$this->upload->initialize($config); 
		}
		print_r($_FILES);
		if($_FILES['file_upload']['error'] > 0){
		    die('An error ocurred when uploading.');
		}
		if(file_exists(base_url().'Uploads/' . $_FILES['file_upload']['name'])){
		    die('File with that name already exists.');
		}
		// if(!getimagesize($_FILES['file_upload']['tmp_name'])){
		//     die('Please ensure you are uploading an image.');
		// }
		// Check filetype
		// if($_FILES['file_upload']['type'] != 'image/png'){
		//     die('Unsupported filetype uploaded.');
		// }
		// Check filesize
		if($_FILES['file_upload']['size'] > 500000){
		    die('File uploaded exceeds maximum upload size.');
		}		
		// if(!move_uploaded_file($_FILES['file_upload']['tmp_name'], 'Uploads/' . $_FILES['file_upload']['name'])){
		//     die('Error uploading file - check destination is writeable.');
		// }
		$move = base_url() . "/Uploads/".$_FILES['file']['name'];
		echo $move;
	    move_uploaded_file($_FILES['tmp_name'],$move);
		// var_dump(is_dir($config['upload_path']));
		// var_dump(is_writable($config['upload_path']));
		// $file = $config['upload_path'].'/logo.jpg';
		// $file = "web/content/cloud/uploads/logo.jpg";
		// if(is_dir($file))
		//   {
		//   echo ("$file is a directory");
		//   }
		// else
		//   {
		//   echo ("$file is not a directory");
		//   }
		//   if(is_writable($file))
		//   {
		//   echo ("$file is a writable directory");
		//   }
		// else
		//   {
		//   echo ("$file is not a writable directory");
		//   }
		// $write = is_writable('www.my-data.org.uk/cloud/Uploads/logo.jpg');
		// echo "exists: " . $dir. ". Writable: " . $write;
		// print_r($config);
			if(! $this->upload->do_upload() ){
				//print_r($this->upload->display_errors('<p>', '</p>'));
				$filename = "";
				//echo $filename;  
			} else {
				$upload = $this->upload->data();
				$filename = $upload['orig_name'];
				//echo $filename;
			}
			//echo $upload['orig_name'];
		$config['image_library'] = 'gd2';
		$config['source_image']	= base_url().'Uploads/'. $filename;
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = TRUE;
		$config['width']	= 75;
		$config['height']	= 50;
		$config['new_image'] = base_url().'/Uploads/'.$filename;
		$this->load->library('image_lib', $config); 
		$this->image_lib->resize();	
		$data = array(
			'username' => $this->input->post('username'),
			'first_name' => $this->input->post('firstname'),
			'last_name' => $this->input->post('lastname'),
			'password' => $this->input->post('password'),
			'passconf' => $this->input->post('passconf'),
			'companyname' => $this->input->post('companyname'),
			'description' => $this->input->post('description'),
			'email' => $this->input->post('email'),
			'sender_id' => $this->input->post('senderid'),
			'company_logo' => $filename,
			'description' => $this->input->post('description')
			);
		//print_r($data['company_logo']);
		//print_r($data);
		// if ($data['password'] == $data['passconf']){
		// 	echo "<b>This password does not match</b>";
		// 	$this->index();
		// }
		$method = $this->input->post('method');
		$this->load->model('user_model');
		$user_id = $this->input->post('userid');
		if($method == "Add User"){
			$username = $data['username'];
			$username_exists = $this->user_model->does_username_exist($username);
			if ($username_exists == false){
				//print_r($data);
				$this->user_model->add($data);	
				$this->load->model('alarm_model', 'emodel');
				$data_2 = array(
					'email_address' => $this->input->post('email'),
					'user_id' => $user_id,
					'sender_id' => $this->input->post('sender_id')
					);
				$this->emodel->add_alarm($data_2);
				//setup a new configuration record
				$this->load->model('input_model', 'inputs');
				//analogues
				$analogues = array(
					"A0", "A1", "A2", "A3", "A4", "A5", "A6", "A7", "A8", "A9", "A10", 
					"A11", "A12", "A13", "A14", "A15", "A16", "A17", "A18", "A19"
					);
				$ana_input_id = array(
					"A0" => 1,
					"A1" => 2,
					"A2" => 3,
					"A3" => 4,
					"A4" => 5,
					"A5" => 6,
					"A6" => 7,
					"A7" => 8,
					"A8" => 9,
					"A9" => 10,
					"A10" => 11, 
					"A11" => 12,
					"A12" => 13,
					"A13" => 14,
					"A14" => 15,
					"A15" => 16,
					"A16" => 17,
					"A17" => 18,
					"A18" => 19,
					"A19" => 20
					);
				foreach ($analogues as $name){
					$data_3 = array(
					'sender_id' => $this->input->post('sender_id'),
					'label' => $name,
					'type' => 'analogue',
					'is_on' => true,
					'user_id' => $this->input->post('user_id'),
					'max' => 100,
					'is_graphed' => 1,
					'input_id' => $ana_input_id[$name]
				);
					$this->inputs->add_default_configuration($name, $data_3);
			 	}
			 	//digitals
				$digitals = array("D0", "D1", "D2", "D3", "D4", "D5", "D6", "D7");
				$dig_input_id = array(
					"D0" => 21,
					"D1" => 22,
					"D2" => 23,
					"D3" => 24,
					"D4" => 25,
					"D5" => 26,
					"D6" => 27,
					"D7" => 28);
				foreach ($digitals as $name){
					$data_4 = array(
					'input_id' => $dig_input_id[$name],
					'sender_id' => $this->input->post('sender_id'),
					'label' => $name,
					'type' => 'digital',
					'is_on' => true,
					'user_id' => $this->input->post('user_id'),
					'max' => 100,
					'is_graphed' => 1,
					'HI' => 1
					);
					$this->inputs->add_default_configuration($name, $data_4);
				}
				//counters
				$counters = array("C0", "C1", "C2", "C3");
				$count_input_id = array(
					"C0" => 29,
					"C1" => 30,
					"C2" => 31,
					"C3" => 32);
				foreach ($counters as $name){
					$data_5 = array(
					'input_id' => $count_input_id[$name],
					'sender_id' => $this->input->post('sender_id'),
					'label' => $name,
					'type' => 'counter',
					'is_on' => true,
					'user_id' => $this->input->post('user_id'),
					'max' => 100,
					'is_graphed' => 1,
					'threshold' => 1
					);
					$this->inputs->add_default_configuration($name, $data_5);
				}
			 }
			$this->index();
		} else if ($method == "Update User") {
			$this->user_model->update($user_id, $data);
			//print_r($data);
			$this->index();
		} else if ($method == "Delete User") {
			$this->user_model->delete($user_id);
			$this->index();
		}
	}

	
	public function add_device(){

		$method = $this->input->post('action');
		$data = array(
		'location' => $this->input->post('location'),
		'phone' => $this->input->post('phone'),
		'user_id' => $this->input->post('user_id'),
		'datalogger_id' => $this->input->post('device id'),
		'serial_number' => $this->input->post('Serial'),
		'sender_id' => $this->input->post('sender_id'),
		'machine_name' => $this->input->post('machine_name')

		);
		$this->load->model('device_model', 'device');
		$this->device->add($data);
		$this->index();
	}

	
	// 	public function delete_user(){

	// 	$form_data = array(
	// 		'username' => $this->input->post('username'),
	// 		'password' => $this->input->post('password'),
	// 		'companyname' => $this->input->post('companyname'),
	// 		'description' => $this->input->post('description'),
	// 		'email' => $this->input->post('email'));

	// 	if($this->input->post('password') != $this->input->post('confirm password')){
	// 		$this->form_validation->set_error_delimiters('<em>','<em>');
	// 		$data['msg'] = "passwords do not match";
	// 		$this->load->view('setup_users');	
	// 	}

	// 	$this->form_validation->set_rules('username','Username','trim|required|min_length[6]|max_length[12]|is_unique[users.username]|xss_clean');
	// 	$this->form_validation->set_rules('password','Password','trim|required|matches[passconf]|md5|xss_clean');
	// 	$this->form_validation->set_rules('passconf','Password Confirm','trim|required|xss_clean');
	// 	$this->form_validation->set_rules('companyname','Company name','trim|required|xss_clean');
	// 	$this->form_validation->set_rules('description','Description','required');


	// 	if($this->form_validation->run() == FALSE)
	// 	{
	// 		$this->load->view('configuration');
	// 	} else {
	// 		$this->load->view('success_msg');
	// 	}

	// 		$this->load->model('user_model');
	// 		$this->user_model->delete($form_data);
	// 		$data['msg'] = "You have added a new user";
	// 		$this->load->view('setup_users', $data);

	// }


	// public function update_user(){

	// 	$form_data = array(
	// 		'username' => $this->input->post('username'),
	// 		'password' => $this->input->post('password'),
	// 		'companyname' => $this->input->post('companyname'),
	// 		'description' => $this->input->post('description'),
	// 		'email' => $this->input->post('email'),
	// 		'sender_id' => $this->input->post('senderid')
	// 		);
	// 	print_r($form_data);
	// 	if($this->input->post('password') != $this->input->post('confirm password')){
	// 		$this->form_validation->set_error_delimiters('<em>','<em>');
	// 		$data['msg'] = "passwords do not match";
	// 		$this->load->view('setup_users');	
	// 	}
	//  // 	$this->form_validation->set_rules('username','Username','trim|required|min_length[6]|max_length[12]|is_unique[users.username]|xss_clean');
	// 	// $this->form_validation->set_rules('password','Password','trim|required|matches[passconf]|md5|xss_clean');
	// 	// $this->form_validation->set_rules('passconf','Password Confirm','trim|required|xss_clean');
	// 	// $this->form_validation->set_rules('companyname','Company name','trim|required|xss_clean');
	// 	// $this->form_validation->set_rules('description','Description','required');
	// 	// if($this->form_validation->run() == FALSE)
	// 	// {
	// 	// 	$this->load->view('header');
	// 	// 	$this->load->view('setup_users');
	// 	// 	$this->load->view('footer');
	// 	// } else {
	// 	// 	$this->load->view('success_msg');
	// 	// }
	// 		$this->load->model('user_model');
	// 		print_r($form_data);
	// 		$this->user_model->update($form_data);
	// 		$this->load->view('setup_users');
	// }
	
}
