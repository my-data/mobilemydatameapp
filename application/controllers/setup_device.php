<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setup_device extends CI_Controller {

	public function index(){
		$is_logged_in = $this->session->userdata('logged_in');
		//$is_logged_in = true;
		if ($is_logged_in == TRUE){
			//print_r($_POST);
			$user_id = $_POST['useridhidden2'];
			// print_r($_POST);
			// if (empty($user_id)){
			// 	redirect('c=setup_users');
			// }
			//$sender_id = $_POST['senderidhidden2'];
			//print_r($_POST);
			$data['user_id'] = $user_id;
			//$sender_id = $_POST['sender_id'];
			$data['sender_id'] = $sender_id;
			//$user_id = $this->session->userdata('user_id');
			$this->load->model('user_model', 'usr');
			$user_info = $this->usr->get_all_users_information();
			$data['info'] = $user_info;
			$user = $this->usr->get_user($user_id);
			$data['user'] = $user;
			//print_r($user);
			$this->load->model('device_model', 'device_model');
			$sender_id= $this->device_model->get_sender_id_for_user($user_id);
			$sender_id = $sender_id[0]['sender_id'];
			$this->load->model('device_model', 'device');
			//echo 'user_id'.$user_id;
			$datalogger = $this->device->get_device_for_user($user_id);
			$data['datalogger'] = $datalogger;
			//print_r($datalogger);
			$user_messages = $this->data_model->get_messages_for_user($user_id);
			$data['messages'] = $user_messages;
			$this->load->model('input_model','inp');
			$input_data = $this->inp->get_all_inputs_for_user($user_id);
			$data['config'] = $input_data;
			$this->load->view('header');
			$this->load->view('setup_device', $data);
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

	public function validate_sender_id(){
		//print_r($_POST);
		$sender_id = $_POST['sender_id'];
		//echo 'sender id'. $sender_id;
		$results = $this->device_model->get_dataloggerid_for_senderid($sender_id);
		$datalogger_id = $results['datalogger_id'];
		//echo 'datalogger id'.$datalogger_id;
		$this->load->model('device_model','device_model');
		$is_unique_senderid = $this->device_model->verify_unique_sender_id($sender_id);
		//echo '<br>is sender id unique'. $is_unique_senderid;
		$this->load->model('input_model','input_model');
		$is_inputs_unique= $this->input_model->verify_unique_sender_id($sender_id);
		//echo 'is inputs unique'. $is_inputs_unique;
		//echo 'is sender unique'. $is_unique_senderid;
		if ($is_inputs_unique == 1 && $is_unique_senderid == 1){			
			//print_r(json_encode(0)) ;
			//redirect('http://www.my-data.org.uk/cloud/setup_users');	
					//$this->validate_sender_id();
			//return 0;
		//} else {
		//	if (){
				$msg=array(
					'validated'=>'true',
					'inputs_unique' =>$is_inputs_unique,
					'device senderid_unique' => $is_unique_senderid,
					'sender_id' => $sender_id					
					);		
				$json = json_encode($msg);
				print_r($json);
				//return
			//redirect('http://www.my-data.org.uk/cloud/setup_users');	
					//$this->validate_sender_id();
			//return 0;
			} else {
				$msg=array(
					'validated'=>'false',
					'inputs_unique' =>$is_inputs_unique,
					'device senderid_unique' => $is_unique_senderid,					
					'sender_id' => $sender_id	
										);		
				$json = json_encode($msg);			
				print_r($json);
				//return
			}
		// 	$msg=array(
		// 		'validated'=>'false',
		// 		'inputs_unique' =>$is_inputs_unique,
		// 		'device senderid_unique' => $is_unique_senderid,
		// 		'sender_id' => $sender_id	
		// 							);		
		// 	$json = json_encode($msg);	
		// 	print_r($json);
		// }		
		//print_r($results);
		//$is_unique_senderid = $results['is_unique_senderid'];		
		//echo '<b>sender_id not unique </b>';
		//$this->load->view('error');
		//return 1;
	}

	public function delete_data(){
		//$user_id = $this->session->userdata('user_id');
		  $user_id = $this->input->post('useridhidden'); 
		  $sender_id = $this->input->post('sender_id');
		  $sender_id = strval($sender_id);
		  $this->load->model('data_model', 'data');
		  $this->data->delete_messages_for_sender_id_and_user_id($sender_id, $user_id);
		  // $this->load->model('input_model', 'input_model');
		  // $this->input_model->get_alarm_user_sender($user_id);
		 // $this->index();
		  $arr = array($user_id,$sender_id);
		  $json=json_encode($arr);
		  print_r($json);
	}

	public function delete_device(){
		 $sender_id = $this->input->post('sender_id');
		 $this->load->model('device_model','dev');
		 $this->dev->delete_device_for_sender_id($sender_id);
		 $this->load->model('input_model', 'input_model');
		 $this->input_model->delete_inputs_for_sender_id($sender_id);
		 //$this->index();
		 $json=json_encode($sender_id);
		  print_r($json);
	}

	public function edit_device(){
		$data = array(
		//'location' => $this->input->post('location'),
		'address1' => $this->input->post('address1'),
		'address2' => $this->input->post('address2'),			
		'user_id' => $this->input->post('useridhidden'),
		'sender_id' => $this->input->post('sender_id'),
		'machine_name' => $this->input->post('name'),
		'type' => $this->input->post('type'),
		'phone' => $this->input->post('phone'),
		'postcode' => $this->input->post('postcode')
		);
		 $sender_id = $this->input->post('sender_id');
		 $this->load->model('device_model', 'devices');
		 $this->devices->update_device_for_sender_id($sender_id,$data);
		 //$this->index();
		  $json=json_encode($data);
		  print_r($json);
	}

	public function add_device(){
		$this->load->model('device_model', 'device_model');
		$time = time();
		$data = array(
			'address1' => $this->input->post('address1'),
			'address2' => $this->input->post('address2'),
			'user_id' => $this->input->post('useridhidden'),
			'type' => $this->input->post('type'),
			'sender_id' => $this->input->post('sender_id'),
			'machine_name' => $this->input->post('name'),
			'phone' => $this->input->post('phone'),
			'created_on' => $time,
			'postcode' => $this->input->post('postcode')
		);
		$sender_id = $data['sender_id'];
		$results = $this->device_model->get_dataloggerid_for_senderid($sender_id);
		$datalogger_id = $results['datalogger_id'];
		// $this->load->model('device_model','device_model');
		// $is_unique_senderid = $this->device_model->verify_unique_sender_id($sender_id);
		// $this->load->model('input_model','input_model');
		// $is_inputs_unique = $this->input_model->verify_unique_sender_id($sender_id);

		//if (!$is_inputs_unique == 1 && !$is_unique_senderid == 1){
						//$this->validate_sender_id();
				//$this->index();
			//}
			//if (){
				//echo '<b>sender_id not unique </b>';
						//$this->validate_sender_id();
				//$this->index();
			//}
			//echo 'is_unique'.$is_unique_senderid;
			//print_r($data);
			//echo 'method'.$method;
			//if ($method == "add_device"){
			// add device
			 $this->load->model('device_model','device_model');
			 $datalogger_id = $this->device_model->add($data);
			// echo 'datalogger id for new device'. $datalogger_id.'<br>';
			 //$datalogger_id = $results['insert_id'];
			 //SET UP A NEW DIGITAL OUTPUTS FOR DEVICE
			$data_dig = array(
				'user_id' => $this->input->post('useridhidden'),
				'sender_id' => $this->input->post('sender_id'),
				'datalogger_id' => $datalogger_id,
				'D0OUT' => 'HI',
				'D1OUT' => 'HI',
				'D2OUT' => 'HI',
				'D3OUT' => 'HI',
				'D4OUT' => 'HI',
				'D5OUT' => 'HI',
				'D6OUT' => 'HI',
				'D7OUT' => 'HI'
				);
			$this->load->model('outputs_model', 'out');
			//print_r($data_dig);
			$this->out->add($data_dig);
			 $this->load->model('input_model', 'input_model');
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
					'datalogger_id' => $datalogger_id,
					'name' => $name,
					'label_name' => $name,
					'type' => 'analogue',
					'threshold' => 0,
					'is_on' => 1,
					'direction' => 1,
					'reset_level' => 1,
					'threshold2' => 0,
					'is_on2' => 1,
					'direction2' => 1,
					'reset2' => 1,
					'threshold3' => 0,
					'is_on3' => 1,
					'direction3' => 1,
					'reset3' => 1,
					'threshold4' => 0,
					'is_on4' => 1,
					'direction4' => 1,
					'reset4' => 1,
					'max' => 100,
					'is_graphed' => 1,
					'is_email' => 1,
					'input_id' => $ana_input_id[$name],
					'user_id' => $this->input->post('useridhidden'),
					'units' => ''
				);
				for ($i=1;$i<5;$i++){
					$analogue_default_email = array(
						'to'=> 'gadgetsuperman@googlemail.com',
						'from' => 'mydata.me',
						'subject'=> 'Test Subject Email',
						'message'=> 'This is a Test User Message',
						'user_id' => $this->input->post('useridhidden'),
						'sender_id'=> $this->input->post('sender_id'),
						'alarm_name' => $name,
						'alarm_number' => $i
						);
					$this->load->model('alarm_model');
					$this->alarm_model->add_alarm($analogue_default_email);
				}
		        //	echo 'add new analogue inputs for '. $data_3['sender_id'].'<br>';
				//	//print_r($name);
				//	print_r($data_3);
					if ($ana_input_id > 5){
						$data_3['is_graphed'] = 0;
					}
					$this->load->model('input_model','inputs');
					$this->inputs->add_default_configuration($name, $data_3);
			 	}
			 // 	//digitals
				$digitals = array("D0", "D1", "D2", "D3", "D4", "D5", "D6", "D7");
				//print_r($digitals);
				$dig_input_id = array(
					"D0" => 21,
					"D1" => 22,
					"D2" => 23,
					"D3" => 24,
					"D4" => 25,
					"D5" => 26,
					"D6" => 27,
					"D7" => 28
					);
			//	print_r($dig_input_id);
				foreach ($digitals as $name){
					$data_4 = array(
					'input_id' => $dig_input_id[$name],
					'sender_id' => $this->input->post('sender_id'),
					'datalogger_id' => $datalogger_id,
					'name' => $name,
					'type' => 'digital',
					'is_on' => 1,
					'user_id' => $this->input->post('useridhidden'),
					'max' => 100,
					'is_graphed' => 1,
					'is_email' => 1,
					'HI' => 1,
					'units' => ''
					//'user_id' => $this->input->post('useridhidden')
					);
			    //   	echo 'add new digital inputs for '. $data_4['sender_id'].'<br>';
					$this->load->model('input_model','inputs');
					$this->inputs->add_default_configuration($name, $data_4);
				for ($i=1;$i<3;$i++){
					$digital_default_email = array(
						'to'=> 'gadgetsuperman@googlemail.com',
						'from' => 'mydata.me',
						'subject'=> 'Test Subject Email',
						'message'=> 'This is a Test User Message',
						'user_id' => $this->input->post('useridhidden'),
						'sender_id'=> $this->input->post('sender_id'),
						'alarm_name' => $name,
						'alarm_number' => $i
						);
					$this->load->model('alarm_model');
					$this->alarm_model->add_alarm($digital_default_email);
				}
				}
				// //counters
				$counters = array("C0", "C1", "C2", "C3");
				//print_r($counters);
				$count_input_id = array(
					"C0" => 29,
					"C1" => 30,
					"C2" => 31,
					"C3" => 32);
				//print_r($count_input_id);
				foreach ($counters as $name){
					$data_5 = array(
					'input_id' => $count_input_id[$name],
					'sender_id' => $this->input->post('sender_id'),
					'datalogger_id' => $datalogger_id,
					'name' => $name,
					'type' => 'counter',
					'is_on' => 1,
					'user_id' => $this->input->post('useridhidden'),
					'max' => 100,
					'is_graphed' => 1,
					'is_email' => 1,
					'units' => ''
					//'user_id' => $this->input->post('useridhidden')
					);
			     //  	echo 'add new counter inputs for '. $data_5['sender_id'].'<br>';
					$data = array(
						'user_id' => $_POST['user_id'],
						'chart_gauges' =>$_POST['show_gauges'],
						'chart_digitals' =>$_POST['show_digitals'],
						'chart_chart' =>$_POST['show_charts'],
						'chart_bar_chart' =>$_POST['show_bar_chart'],
						'chart_output' =>$_POST['show_output']
					);
					$this->load->model('input_model','inputs');
					$this->inputs->add_default_configuration($name, $data_5);
					$default_email = array(
						'to'=> 'gadgetsuperman@googlemail.com',
						'from' => 'mydata.me',
						'subject'=> 'Test Subject Email',
						'message'=> 'This is a Test User Message',
						'user_id' => $this->input->post('useridhidden'),
						'sender_id'=> $this->input->post('sender_id'),
						'alarm_name' => $name,
						'alarm_number' => 1
						);
					$this->load->model('alarm_model');
					$this->alarm_model->add_alarm($default_email);
				}
				$json = json_encode($data);
				 print_r($json);
				 //$this->index();
			// } else {
			// 	$error = 'sender_id not unique';
			// 	print_r(json_encode($error));
			// }
			 //$this->model->load('input_model');
			 //$this->input_model->add_input_for_device($data);
			 //$this->load->view('success_msg');
			// echo '<br><b>legacy of code completed</b>';
			// $this->index();
		// } else if ($method =="delete_data"){
		// 	 $user_id = $this->session->userdata('user_id');
		// 	  $sender_id = $this->input->post('sender_id');
		// 	  $sender_id = strval($sender_id);
		// 	 //echo $sender_id;
		// 	  // echo $user_id;
		// 	 //  $this->load->model->('data_model', 'dats');
		// 	 //  $this->dats->delete_messages_for_sender_id_and_user_id($sender_id, $user_id);
		// 	 //  $this->load->view('success_msg');
		// 	  $this->load->model('data_model', 'data');
		// 	  $this->data->delete_messages_for_sender_id_and_user_id($sender_id, $user_id);
		// 	  $this->load->model('input_model', 'input_model');
		// 	  $this->input_model->get_alarm_user_sender($user_id);
		// 	  $this->index();

		// } else if ($method == "delete_device"){
		// 	//echo $method;
		// 	//echo $sender_id;
		// 	 $sender_id = $this->input->post('sender_id');
		// 	 $this->load->model('device_model','dev');
		// 	 $this->dev->delete_device_for_sender_id($sender_id);
		// 	 //$this->load->view('success_msg');
		// 	 $this->index();
		// } else if ($method == "edit_device"){
		// 	 //echo $method;
		// 	 //echo $sender_id;
		// 	 $sender_id = $this->input->post('sender_id');
		// 	 //print_r($data);
		// 	 $this->load->model('device_model', 'devices');
		// 	 $this->devices->update_device_for_sender_id($sender_id,$data);
		// 	 $this->index();
		// }
	}
}