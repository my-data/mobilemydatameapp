<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rawdata extends CI_Controller {

	public function index(){
		$is_logged_in = $this->session->userdata('logged_in');
		if ($is_logged_in == TRUE){
			$this->load->model('user_model', 'user');
			$username = $this->session->userdata('username');
			//print_r($username);
			//echo $username;
			$user_id = $this->user->get_user_id($username);
			$user_id = $user_id[0]['user_id'];
			//$user_id=17;
			//$sender_id ="0000001";
			//$sender_id = $sender_id[0]['sender_id'];
			//print_r($sender_id);
			//$sender_id = $user[0]['sender_id'];
			//print_r($_POST);
			$sender_id = $_POST['choose_datalogger'];
			 if(isset($_POST['choose_datalogger'])){
			 	//echo "set";
			 	$sender_id = $_POST['choose_datalogger'];
			 	//echo $sender_id;
			 } else { 
			 	//echo "not set";
			 	$this->load->model('user_model', 'usr');
				$sender_id = $this->usr->get_sender_id_for_user($user_id);
				//print_r($sender_id);
			 	$sender_id = $sender_id[0]['sender_id']; 
			 	//echo $sender_id;
			 }
			//print_r($sender_id);
			$data['username'] = $username;
			$data['user_id'] = $user_id;
			$this->load->model('user_model', 'user');
			$user = $this->user->get_user_for_id($user_id);
			$data['user'] = $user;
			//$sender_id = $user[0]['sender_id'];
			$this->load->model('data_model', 'data');
			//echo $sender_id;
			$messages = $this->data->get_messages_for_senderid($sender_id);
			$data['messages'] = $messages;
			//print_r($messages);
			$this->load->model('input_model', 'inp');
			$config = $this->inp->get_inputs_for_sender_id($sender_id);
			$data['config'] = $config;
			$this->load->model('device_model', 'device');
			$datalogger = $this->device->get_device_for_user($user_id);
			$data['datalogger'] = $datalogger;
			$data['current_datalogger'] =  $this->device->get_device_for_sender_id($sender_id);
			$this->load->model('alarm_model', 'alarm');
			$alarm = $this->alarm->get_alarm($user_id);
			$data['alarm'] = $alarm;
			$this->load->model('digital_model','digital');
			$data['outputs'] = $this->digital->get_digital_outputs_for_senderid_and_userid($user_id, $sender_id);
			$this->load->view('header');
			$this->load->view('hellowrold', $data);
			$this->load->view('footer');
		} else {
			$this->logout();
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('c=User&m=login');
	}

	public function getdata(){
		$var = "d1";
		$this->load->model('data_model');
		$this->data_model()->get_chart_data();
		$string = file_get_contents("sampleData.json");
		echo $string;

	}

	public function email(){
		//echo "wrold";
		$user_id = $this->session->userdata('user_id');
		//$user_id = 17;
		echo $user_id;
		$this->load->model('user_model','user_m');
		$sender_id = $this->user_m->get_sender_id_for_user($user_id);
		$sender_id = $sender_id[0]['sender_id'];
		echo $sender_id;
		$this->load->model('alarm_model', 'alarm');
		$email = $this->alarm->get_alarm($user_id);
		$alarm_id = $email['alarm_id'];
		$this->alarm->update_email_sent($alarm_id);
		$config = Array(
		    'protocol' => 'smtp',
		    'smtp_host' => 'ssl://smtp.googlemail.com',
		    'smtp_port' => 465,
		    'smtp_user' => 'gadgetsuperman@googlemail.com',
		    'smtp_pass' => 'Ta6-ru7-46r-hv6',
		    'mailtype' => 'text',
		    'newline' => "\r\n"
		);
		$config['smtp_host'] = "ssl://smtp.gmail.com";
		$this->email->initialize($config);
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		$from = $email[0]['from'];
		$this->email->from($from);
		$to = $email[0]['to'];
		$this->email->to($to);
		$subject = $email[0]['subject'];
		$this->email->subject($subject);
		$usermessage = $email[0]['message'];
		$this->load->model('input_model','conf');
		$inputs = $this->conf->get_inputs_for_sender_id($sender_id);
		$this->load->model('data_model', 'data_model');
		$last_message = $this->data_model->get_last_message_for_sender_id($sender_id);
		$last_message = $last_message[0];
		//echo "hello";
		// print_r($last_message);
		// print_r($email);
		// print_r($inputs);
		// echo "penetrate model";
		// $this->load->model('email_model', 'emaily');
		// $data = array(
		// 	'subject' => 'pussy_eaters_club'
		// );
		//$this->emaily->add_email($data);
		$finalmessage = $usermessage . "\r\n";
		$all_messages = "";
		$timestamp = $last_message['datetime'];
		for ($i=0;$i<count($last_message)-8;$i++){
			$name = $inputs[$i]['name'];
			$scaleby = round(($inputs[$i]['max']-$inputs[$i]['min'])/1024,2);
			if ($inputs[$i]['is_email'] == true){
				if ($inputs[$i]['type'] != 'digital'){
					if ($inputs[$i]['threshold'] < $last_message[$name]*$scaleby){
						if ($inputs[$i]['is_on'] == 1){
							if ($inputs[$i]['direction'] == 1){
									$message =  $inputs[$i]['name'] . "\r\n" . $inputs[$i]['label_name'] . " has a value of " . $last_message[$name]*$scaleby
									. " " . $inputs[$i]['units'] . ". This is past its threshold of " .
								    $inputs[$i]['threshold'] . " " . $inputs[$i]['units'] . " when the direction is " . $inputs[$i]['direction'] . ". This reading occured at " . 
								    gmdate("Y-m-d H:i:s", $timestamp) . "\r\n";
								    //print_r($message);
								    $finalmessage = $finalmessage . $message;
								    $this->load->model('input_model','inp');
								    $this->inp->turn_off($sender_id,$name);
								    echo "turn off";
									$this->email->message($finalmessage);
									//$this->model->load('input_model', 'inputs');
									//$this->inputs->is_email_set($sender_id, $name)
									//$this->inputs->is_email_set
									if ($this->email->send()){
							   				echo "<h2 style='margin:100px;color:red;'> email sent </h2>";
							   	 			$time = gmdate("Y-m-d H:i:s", $timestamp);
											$data = array(
							   				 	'user_id' => $user_id,
								   				'time' => $time,
												'message' => $finalmessage,
												'to' => $to,
												'from' => $from,
												'subject' => $subject,
												'usermessage' => $usermessage,
												'type' => $inputs[$i]['type'],
												'threshold' => $inputs[$i]['threshold'] ,
												'value' => $last_message[$name]*$scaleby,
												'is_on' => $inputs[$i]['is_on'],
												'direction' => $inputs[$i]['direction'],
												'label_name' => $inputs[$i]['label_name'],
												'units' => $inputs[$i]['units']
											);
											//print_r($data);
											$this->load->model('email_model', 'emaily');
											$this->emaily->add_email($data);
											$this->load->model('user_model', 'user');
											$this->user->log_time_email_sent($user_id);
											// $all_messages = $all_messages . $finalmessage;
										} else {
											echo $this->email->print_debugger();
									}
							}
						}
					}
					if ($inputs[$i]['threshold'] > $last_message[$name]*$scaleby){
						if ($inputs[$i]['is_on'] == 1){
							if ($inputs[$i]['direction'] == 0){
									$message =  $inputs[$i]['name'] . "\r\n" . $inputs[$i]['label_name'] . " has a value of " . $last_message[$name]*$scaleby
									 . " " . $inputs[$i]['units'] . ". This is past its threshold of " .
								     $inputs[$i]['threshold'] . " " . $inputs[$i]['units'] . ". This reading occured at " . 
								     gmdate("Y-m-d H:i:s", $timestamp) . "\r\n";
								    //print_r($message);
								     $finalmessage = $finalmessage . $message;
								     $this->load->model('input_model','inp');
								     $this->inp->turn_off($sender_id,$name);
								        echo "turn off";
									$this->email->message($finalmessage);
									if ($this->email->send()){
							   			    echo "<h2 style='margin:100px;color:red;'> email sent </h2>";
											$time = gmdate("Y-m-d H:i:s", $timestamp);
											$data = array(
							   				 	'user_id' => $user_id,
								   				'time' => $time,
												'message' => $finalmessage,
												'to' => $to,
												'from' => $from,
												'subject' => $subject,
												'usermessage' => $usermessage,
												'type' => $inputs[$i]['type'],
												'threshold' => $inputs[$i]['threshold'] ,
												'value' => $last_message[$name]*$scaleby,
												'is_on' => $inputs[$i]['is_on'],
												'direction' => $inputs[$i]['direction'],
												'label_name' => $inputs[$i]['label_name'],
												'units' => $inputs[$i]['units']
											);
											//print_r($data);
											$this->load->model('email_model', 'emaily');
											$this->emaily->add_email($data);
											$this->load->model('user_model', 'user');
											$this->user->log_time_email_sent($user_id);
											// $all_messages = $all_messages . $finalmessage;
										} else {
											echo $this->email->print_debugger();
									}
							}
						}
					}
				}	
				if ($inputs[$i]['type'] == 'digital'){
					if ($inputs[$i]['threshold'] == $last_message[$name]){
						$message =  $inputs[$i]['name'] . "\r\n" . $inputs[$i]['label_name'] . " has a value of " . $last_message[$name]*$scaleby
						 . " " . $inputs[$i]['units'] . ". This is past its threshold of " .
					     $inputs[$i]['threshold'] . " " . $inputs[$i]['units'] . ". This reading occured at " . 
					     gmdate("Y-m-d H:i:s", $timestamp) . "\r\n";
					     //print_r($message);
					     $finalmessage = $finalmessage . $message;
					     $this->load->model('input_model','inp');
					     $this->inp->turn_off($sender_id,$name);
					     echo "turn off digital";
						$this->email->message($finalmessage);
						if ($this->email->send()){
				   			echo "<h2 style='margin:100px;color:red;'> email sent </h2>";
							$time = gmdate("Y-m-d H:i:s", $timestamp);
							$data = array(
			   				 	'user_id' => $user_id,
				   				'time' => $time,
								'message' => $finalmessage,
								'to' => $to,
								'from' => $from,
								'subject' => $subject,
								'usermessage' => $usermessage,
								'type' => $inputs[$i]['type'],
								'threshold' => $inputs[$i]['threshold'] ,
								'value' => $last_message[$name]*$scaleby,
								'is_on' => $inputs[$i]['is_on'],
								'direction' => $inputs[$i]['direction'],
								'label_name' => $inputs[$i]['label_name'],
								'units' => $inputs[$i]['units']
							);
							//print_r($data);
							$this->load->model('email_model', 'emaily');
							$this->emaily->add_email($data);
							$this->load->model('user_model', 'user');
							$this->user->log_time_email_sent($user_id);
							// $all_messages = $all_messages . $finalmessage;
						} else {
								echo $this->email->print_debugger();
						}
					}
				}
			}
			if ($inputs[$i]['is_on'] == 0){
				if($inputs[$i]['direction'] = 1){
					if ($last_message[$name] < $inputs[$i]['reset_level']){
						$this->load->model('input_model','inp');
						$this->inp->turn_on($sender_id, $name);
						echo "turn alarm on";
					}
				else if($last_message[$name] > $inputs[$i]['reset_level']){
						$this->load->model('input_model','inp');
						$this->inp->turn_on($sender_id, $name);
						echo "turn alarm on";
					}
				}
			}
		}
		//$this->index();
		//$results = "email sent";
		$results = json_encode($all_messages);
		print_r($results);
	}

	public function configure_digital_inputs(){
		$data = $_POST;
		$data = array(
			"user_id" => $this->session->userdata('user_id'),
			"sender_id" => $this->input->post'sender_id'),
			"D0" => $this->input->post("D0OUT"),
			"D1" => $this->input->post("D1OUT"),
			"D2" => $this->input->post("D2OUT"),
			"D3" => $this->input->post("D3OUT"),
			"D4" => $this->input->post("D4OUT"),
			"D5" => $this->input->post("D5OUT"),
			"D6" => $this->input->post("D6OUT"),
			"D7" => $this->input->post("D7OUT")
			 );
		$this->load->model('digital_model','digital_inputs');
		// $last_message = $this->data_model->get_last_message();
		// $message_id = $last_message[0]['message_id'];
		$this->digital_inputs->update_digital($data);
		//$this->index();
		print_r($data);
		}

	public function raw_data_for_user(){
		$user_id = $this->session->userdata('user_id');
		$this->load->model('data_model','data');
		$data['results'] = $this->data->get_messages_for_user($user_id);
		$this->load->view('header');
		$this->load->view('raw_data', $data);
		$this->load->view('footer');
	}
}
?>