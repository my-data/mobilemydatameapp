<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setup_users extends CI_Controller {

	public function index(){
		$is_logged_in = $this->session->userdata('logged_in');
		//$is_logged_in = true;
		if ($is_logged_in == TRUE){
			$username = $this->session->userdata('username');
			$user_id = $this->user_model->get_user_id($username);
			$user_id = $user_id[0]['user_id'];
			$data['user_id'] = $user_id;
			$sender_id = $this->device_model->get_sender_id_for_user($user_id);
			$sender_id = $sender_id[0]['sender_id'];
			$data['sender_id'] = $sender_id;
			$this->load->model('user_model', 'userem');
			$users = $this->userem->get_all_users();
			$data['users'] = $users;
			$user_info = $this->userem->get_all_users_information();
			$data['info'] = $user_info;
			//$this->load->model('device_model');
			//$device = $this->device_model->get_device_for_user($user_id);
			//$data['datalogger'] = $device;
			$this->load->view('header');
			$this->load->view('setup_users', $data);
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

	public function update_user(){
		$user_id = $this->input->post('userid');
		//$password = $this->input->post('password');
		//$encrypted_password = $this->encrypt->sha1($password);
		$is_admin = $this->input->post('is_admin');
		$data = array(
			//'username' => $this->input->post('username'),
			'first_name' => $this->input->post('firstname'),
			'last_name' => $this->input->post('lastname'),
			//'password' => $this->input->post('password'),
			//'passconf' => $this->input->post('passconf'),
			'companyname' => $this->input->post('companyname'),
			'description' => $this->input->post('description'),
			'email' => $this->input->post('email'),
			'is_admin' => $is_admin,
			//'company_logo' => $filename,
			//'salt' => $encrypted_password,
			'description' => $this->input->post('description')
			);
		$this->user_model->update($user_id, $data);
		//print_r($data);
		$this->index();
	}

	public function delete_user(){
		$user_id = $this->input->post('userid');
		$this->user_model->delete($user_id);
		$this->device_model->delete_where_user_id($user_id);
		$this->index();
	}

	public function add_user(){
		//$method = $this->input->post('method');
		//echo $method;
		//if($method == "Add User" || "Update User"){
			//upload image

			// $config['upload_path'] = "\\\\web-123win\winpackage22\my-data.org.uk\www.my-data.org.uk\web\content\cloud\Uploads\\";
			// $config['allowed_types'] = 'gif|jpg|png';
			// $config['image_library'] = 'gd2';
			// $this->load->library('upload', $config);
			// $this->upload->initialize($config); 
			 //$move = base_url() . "Uploads/".$_FILES['userfile']['name'];
			$filename = $_FILES['userfile']['name'];		
			 $move = "\\\\web-123win\winpackage22\my-data.org.uk\www.my-data.org.uk\web\content\cloud\Uploads\\".''.$filename;
			     move_uploaded_file($_FILES['userfile']['tmp_name'],$move);
			//if image has whitespace edit name, send error message and change name of file. 
			//validate image name	
			//remove white space from uploaded filename 
			//$filename=preg_replace('/\s+/', '_', $filename);
			//echo $filename;
			//$config['file_name'] = $filename;

			// if(! $this->upload->do_upload() ){
			// 	$logo = $_FILES['userfile']['name'];
			// 	if(!isset($logo)){
			// 		$logo = 'files_post_failed';
			// 	}
			// } else {
			// 	//$upload = $this->upload->data();
			// 	$logo = 'upload failed';
			// 	//echo $filename;
			// }
			//$logo=$this->input->post('file');
			//echo $upload['orig_name'];

			//resize image
			$config['image_library'] = 'gd2';
			$config['source_image']	= "\\\\web-123win\winpackage22\my-data.org.uk\www.my-data.org.uk\web\content\cloud\Uploads\\".$_FILES['userfile']['name'];
			$config['create_thumb'] = TRUE;
			$config['maintain_ratio'] = TRUE;
			$config['width']	= 75;
			$config['height']	= 50;
			$config['new_image'] = "\\\\web-123win\winpackage22\my-data.org.uk\www.my-data.org.uk\web\content\cloud\Uploads\\".$_FILES['userfile']['name']."_thumbnail";
			$this->load->library('image_lib', $config); 
			$this->image_lib->resize();	

			$config['wm_text'] = 'Copyright';
			$config['wm_type'] = 'text';
			$config['wm_font_path'] = './system/fonts/texb.ttf';
			$config['wm_font_size']	= '16';
			$config['wm_font_color'] = 'ffffff';
			$config['wm_vrt_alignment'] = 'bottom';
			$config['wm_hor_alignment'] = 'center';
			$config['wm_padding'] = '20';
			$this->image_lib->watermark();

		//}
		$password = $this->input->post('password');
		$encrypted = $this->encrypt->encode($password);
		$is_admin = $this->input->post('is_admin');
		if(isset($is_admin)){
			$is_admin = 1;
		}

		$now = time();
		$data = array(
			'username' => $this->input->post('username'),
			'first_name' => $this->input->post('firstname'),
			'last_name' => $this->input->post('lastname'),
			'password' => $this->input->post('password'),
			'passconf' => $this->input->post('passconf'),
			'companyname' => $this->input->post('companyname'),
			'description' => $this->input->post('description'),
			'email' => $this->input->post('email'),
			//'sender_id' => $this->input->post('senderid'),
			'company_logo' => $filename,
			'salt'=> $encrypted,
			'is_admin' => $is_admin,
			'description' => $this->input->post('description'),
			'created_on' => $now
			);
		print_r($data);
		//print_r($data['company_logo']);
		//print_r($data);
		// if ($data['password'] == $data['passconf']){
		// 	echo "<b>This password does not match</b>";
		// 	$this->index();
		// }
		//$method = $this->input->post('method');
		$this->load->model('user_model');
		$user_id = $this->input->post('userid');
		//if($method == "Add User"){
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
				//SET UP A NEW DIGITAL OUTPUTS FILE
				// $data_dig = array(
				// 	'user_id' => $user_id,
				// 	'sender_id' => $sender_id,
				// 	'D0OUT' => 'HI',
				// 	'D1OUT' => 'HI',
				// 	'D2OUT' => 'HI',
				// 	'D3OUT' => 'HI',
				// 	'D4OUT' => 'HI',
				// 	'D5OUT' => 'HI',
				// 	'D6OUT' => 'HI',
				// 	'D7OUT' => 'HI');
				// $this->load->model('digital_outputs_model', 'digital_model');
				// $this->digital_model->add($data_dig);
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
					'label_name' => $name,
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
					'label_name' => $name,
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
					'label_name' => $name,
					'type' => 'counter',
					'is_on' => true,
					'user_id' => $this->input->post('user_id'),
					'max' => 100,
					'is_graphed' => 1,
					'threshold' => 1
					);
					$this->inputs->add_default_configuration($name, $data_5);
				}
				$this->load->model('configuration_model','configuration_model');
				$this->configuration_model->add_configuration($data);
			 }
			//$this->index();
			//redirect('c=setup_device');
		// } else if ($method == "Update User") {
		// //	echo 'userIDIS'.$user_id;
		// 	$this->user_model->update($user_id, $data);
		// 	//print_r($data);
		// 	$this->index();
		// } else if ($method == "Delete User") {
		// 	$this->user_model->delete($user_id);
		// 	$this->index();
		// }
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
