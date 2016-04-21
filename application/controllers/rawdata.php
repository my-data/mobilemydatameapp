<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rawdata extends CI_Controller {

	 public function __construct()
       {
            parent::__construct();
            // Your own constructor code
       }

	public function index(){
		$is_logged_in = $this->session->userdata('logged_in');
		//$is_logged_in = true;
		if ($is_logged_in == TRUE){
			//print_r($this->session->all_userdata());
			$data['useragent'] = $this->session->userdata('user_agent');
			$this->load->model('user_model', 'user');
			$username = $this->session->userdata('username');
			$user_id = $this->user->get_user_id($username);
			$user_id = $user_id[0]['user_id'];
			$sender_id = $_POST['choose_datalogger'];
			 if(isset($_POST['choose_datalogger'])){
			 	$sender_id = $_POST['choose_datalogger'];
			 } else { 
			 	$this->load->model('user_model', 'usr');
			 	$this->load->model('device_model', 'device');
				$sender_id = $this->device->get_sender_id_for_user($user_id);
			 	$sender_id = $sender_id[0]['sender_id']; 
			 }
			//echo '<b>sender id is</b>'.$sender_id;
			$data['sender_id'] = $sender_id;
			$data['username'] = $username;
			$data['user_id'] = $user_id;
			$this->load->model('user_model', 'user');
			$user = $this->user->get_user_for_id($user_id);
			$data['user'] = $user;
			$this->load->model('data_model', 'data');
			$messages = $this->data->get_messages_for_senderid($sender_id);
			$data['messages'] = $messages;
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
			$this->load->model('outputs_model','digital');
			$data['outputs'] = $this->digital->get_digital_outputs_for_senderid_and_userid($user_id, $sender_id);
			//$this->add_incoming_to_message_table($user_id, $sender_id);
			$this->load->view('header');
			$this->load->view('hellowrold', $data);
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

	public function email_log(){
		//$user_id = $this->session->userdata('user_id');
		//$data['user_id'] = $user_id;
		//$user_id = $this->input->post('user_id');
		$user_id = $this->uri->segment(5);
    	$user_id = $_GET['user_id'];
    	//echo $user_id;

		$query_results = $this->email_model->get_emails_for_user($user_id);
		$data['email_table'] = $query_results;
		
		$this->load->view('header');
		$this->load->view('user_email_table', $data);
		$this->load->view('footer');
	}

	// public function add_incoming_to_message_table($user_id, $sender_id){
	// 	if (!isset($user_id)){
	// 		$user_id = $this->uri->segment(3);
	// 	}
	// 	if (!isset($sender_id)){
	// 		$sender_id = $this->uri->segment(4);
	// 	}
	// 	$this->load->model('device_model', 'device');
	// 	$results = $this->device->get_last_update_time($sender_id);
	// 	$last_update_time = $results[0]['update_time'];
	// 	$this->load->model('incoming_model', 'incoming');
	// 	$command = $this->incoming->get_unadded_messages($last_update_time);
	// 	$last = count($command);
	// 	for ($i=0; $i < $last; $i++){
	// 		if ($command[$i]['command'] != "Ack"){
	// 			$exploded_array = explode(",",$command[$i]['command']);
	// 			$count = count($exploded_array);
	// 			$timestamp = time();
	// 			$datestring = gmdate("Y-m-d H:i:s", $timestamp);
	// 			if ($exploded_array[0] == $sender_id){
	// 				if ($count == 36){
	// 					$message_data = array(
	// 						'sender_id' => $exploded_array[0],
	// 						'user_id' => $user_id,
	// 						'datetime' => $timestamp,
	// 						'datestring' => $datestring,
	// 						'signal_strength' => $exploded_array[3],
	// 						'D0' => $exploded_array[5],
	// 						'D1' => $exploded_array[7],
	// 						'D2' => $exploded_array[9],
	// 						'D3' => $exploded_array[11],
	// 						'D4' => $exploded_array[13],
	// 						'D5' => $exploded_array[15],
	// 						'D6' => $exploded_array[17],
	// 						'D7' => $exploded_array[19],
	// 						'A0' => $exploded_array[21],
	// 						'A1' => $exploded_array[23],
	// 						'A2' => $exploded_array[25],
	// 						'A3' => $exploded_array[27],
	// 						'C0' => $exploded_array[29],
	// 						'C1' => $exploded_array[31],
	// 						'C2' => $exploded_array[33],
	// 						'C3' => $exploded_array[35]
	// 						);
	// 					$json = json_encode($message_data);
	// 					//print_r($json);
	// 				 	$sender_id = $message_data['sender_id'];
	// 				 	$this->load->model('device_model','device');
	// 				 	$this->device->update_time($sender_id);	
	// 				 	$this->load->model('data_model','data');
	// 				 	$this->data->add_messagedata($message_data);
	// 				 }
	// 			}
	// 		}
	// 	}
	// 	//$message_data = "added incoming messages";
	// 	//print_r(json_encode($message_data));
	// }

	private function _getdata(){
		$var = "d1";
		$this->load->model('data_model');
		$this->data_model()->get_chart_data();
		$string = file_get_contents("sampleData.json");
		echo $string;

	}

	public function email(){
		echo '<b>This email is being tested agains threshold, reset levels and direction to tell if should be sent</b>';
		$is_logged_in = $this->session->userdata('logged_in');
		$user_id = $this->session->userdata('user_id');
		$username = $this->session->userdata('username');
		$user_id = $_POST['user_id'];
		echo $user_id;
		$this->load->model('user_model','user_m');
		$sender_id = $_POST['sender_id'];
		echo $sender_id;
		$this->load->model('input_model','conf');
		$inputs = $this->conf->get_inputs_for_sender_id($sender_id);
		$this->load->model('data_model', 'data_model');
		$last_message = $this->data_model->get_last_message_for_sender_id($sender_id);
		$last_message = $last_message[0];
		$finalmessage = $usermessage . "\r\n";
		$all_messages = "";
		$timestamp = $last_message['datetime'];
		print_r(json_encode($last_message));
		print_r(json_encode($inputs));
		for ($i=1;$i<count($last_message)-6;$i++){
			$name = $inputs[$i-1]['name'];
			$input_id = $inputs[$i-1]['input_id'];
			echo 'name:'.$name;
			echo 'input_id:'.$input_id;
			$scaleby =($inputs[$i-1]['max']-$inputs[$i-1]['min'])/1024;
			echo 'theshold'.$inputs[$i-1]['threshold'];
			echo 'Alarm 1 name:'.$name.'<br>message:'.$last_message[$name]*$scaleby.'<br>threshold:'.$inputs[$i-1]['threshold'].'<br>reset:'.$inputs[$i-1]['reset_level'].'<br>is_on:'.$inputs[$i-1]['is_on'].'<br>direction:'.$inputs[$i-1]['direction'].'</h2><br>';
			echo 'Alarm 2 name:'.$name.'<br>message:'.$last_message[$name]*$scaleby.'<br>threshold:'.$inputs[$i-1]['threshold2'].'<br>reset:'.$inputs[$i-1]['reset2'].'<br>is_on:'.$inputs[$i-1]['is_on2'].'<br>direction:'.$inputs[$i-1]['direction2'].'</h2><br>';
			echo 'Alarm 3 name:'.$name.'<br>message:'.$last_message[$name]*$scaleby.'<br>threshold:'.$inputs[$i-1]['threshold3'].'<br>reset:'.$inputs[$i-1]['reset3'].'<br>is_on:'.$inputs[$i-1]['is_on3'].'<br>direction:'.$inputs[$i-1]['direction3'].'</h2><br>';
			echo 'Alarm 4 name:'.$name.'<br>message:'.$last_message[$name]*$scaleby.'<br>threshold:'.$inputs[$i-1]['threshold4'].'<br>reset:'.$inputs[$i-1]['reset4'].'<br>is_on:'.$inputs[$i-1]['is_on4'].'<br>direction:'.$inputs[$i-1]['direction4'].'</h2><br>';
			 //if ($inputs[$i]['is_email'] == 1){
				if ($inputs[$i-1]['type'] == 'analogue'){
					if ($inputs[$i-1]['threshold'] < $last_message[$name]*$scaleby){
						if ($inputs[$i-1]['is_on'] == 1){	
								if ($inputs[$i-1]['direction'] == 1){
									echo 'email sent for'.$inputs[$i-1]['name'].'<br>';
									$this->load->model('input_model','inp');
									echo 'TURN OFF:'.$sender_id.'INPUT_ID'.$input_id.'name'.$name;
								    $this->inp->turn_off($sender_id,$input_id);
								    $alarm_no = 11;
									$this->send_email($sender_id, $name, $alarm_no);
								//} else {
								//	echo $this->email->print_debugger();
								//}
									} else {
										echo $name.'direction is not pos to negative for ' . $inputs[$i-1]['direction'];
								}
							} else {
						echo '<br>alarm is not on for ' .$name;
						}
					} else { echo $name . 'is too small. less than threshold'. $inputs[$i-1]['threshold']. '.At '.$last_message[$name]*$scaleby; }
						} else {
					echo '<br>'.$name.'is not analogue';
					}
					if ($inputs[$i-1]['type'] == 'analogue'){
						if ($inputs[$i-1]['threshold'] > $last_message[$name]*$scaleby){
							if ($inputs[$i-1]['is_on'] == 1){	
									if ($inputs[$i-1]['direction'] == 0){
										echo 'email sent for'.$inputs[$i-1]['name'].'<br>';
										$this->load->model('input_model','inp');
										echo 'TURN OFF:'.$sender_id.'INPUT_ID'.$input_id.'name'.$name;
									    $this->inp->turn_off($sender_id,$input_id);
									    $alarm_no = 10;
									    $this->send_email($sender_id, $name, $alarm_no);
										//} else {
										//	echo $this->email->print_debugger();
										//}
										} else {
											echo $name.'direction is not neg to pos for ' . $inputs[$i-1]['direction'];
									}
								} else {
							echo '<br>alarm is not on for ' .$name;
							}
						} else { echo $name . 'is greater than threshold'. $inputs[$i-1]['threshold']. '.At '.$last_message[$name]*$scaleby; }
						} else {
					echo '<br>'.$name.'is not analogue';
					}
					//alarm 2
					if ($inputs[$i-1]['type'] == 'analogue'){
					if ($inputs[$i-1]['threshold2'] < $last_message[$name]*$scaleby){
						if ($inputs[$i-1]['is_on2'] == 1){	
								if ($inputs[$i-1]['direction2'] == 1){
									echo 'email sent for'.$inputs[$i-1]['name'].'<br>';
									$this->load->model('input_model','inp');
									echo 'TURN OFF:'.$sender_id.'INPUT_ID'.$input_id.'name'.$name;
								    $this->inp->turn_off2($sender_id,$input_id);
								    $alarm_no = 21;
								    $this->send_email($sender_id, $name,$alarm_no);
								//} else {
								//	echo $this->email->print_debugger();
								//}
									} else {
										echo $name.'direction is not pos to negative for ' . $inputs[$i-1]['direction2'].'ALARM2';
								}
							} else {
						echo '<br>alarm is not on for ' .$name.'ALARM2';
						}
					} else { echo $name . 'is too small. less than threshold'. $inputs[$i-1]['threshold']. '.At '.$last_message[$name]*$scaleby.'ALARM2'; }
						} else {
					echo '<br>'.$name.'is not analogue';
					}
					if ($inputs[$i-1]['type'] == 'analogue'){
						if ($inputs[$i-1]['threshold2'] > $last_message[$name]*$scaleby){
							if ($inputs[$i-1]['is_on2'] == 1){	
									if ($inputs[$i-1]['direction2'] == 0){
										echo 'email sent for'.$inputs[$i-1]['name'].'<br>';
										$this->load->model('input_model','inp');
										echo 'TURN OFF:'.$sender_id.'INPUT_ID'.$input_id.'name'.$name;
									    $this->inp->turn_off2($sender_id,$input_id);
									    $alarm_no = 20;
									    $this->send_email($sender_id, $name, $alarm_no);
										//} else {
										//	echo $this->email->print_debugger();
										//}
										} else {
											echo $name.'direction is not neg to pos for ' . $inputs[$i-1]['direction2'].'ALARM2';
									}
								} else {
							echo '<br>alarm is not on for ' .$name.'ALARM2';
							}
						} else { echo $name . 'is too large. greater than threshold'. $inputs[$i-1]['threshold2']. '.At '.$last_message[$name]*$scaleby.'ALARM2'; }
						} else {
					echo '<br>'.$name.'is not analogue'.'ALARM2';
					}
					//alarm 3
					if ($inputs[$i-1]['type'] == 'analogue'){
					if ($inputs[$i-1]['threshold3'] < $last_message[$name]*$scaleby){
						if ($inputs[$i-1]['is_on3'] == 1){	
								if ($inputs[$i-1]['direction3'] == 1){
									echo 'email sent for'.$inputs[$i-1]['name'].'<br>';
									$this->load->model('input_model','inp');
									echo 'TURN OFF:'.$sender_id.'INPUT_ID'.$input_id.'name'.$name;
								    $this->inp->turn_off3($sender_id,$input_id);
								    $alarm_no = 31;
									$this->send_email($sender_id, $name,$alarm_no);
									} else {
										echo $name.'direction is not pos to negative for ' . $inputs[$i-1]['direction3'].'ALARM2';
								}
							} else {
						echo '<br>alarm is not on for ' .$name.'ALARM2';
						}
					} else { echo $name . 'is too small. less than threshold'. $inputs[$i-1]['threshold3']. '.At '.$last_message[$name]*$scaleby.'ALARM3'; }
						} else {
					echo '<br>'.$name.'is not analogue';
					}
					if ($inputs[$i-1]['type'] == 'analogue'){
						if ($inputs[$i-1]['threshold3'] > $last_message[$name]*$scaleby){
							if ($inputs[$i-1]['is_on3'] == 1){	
									if ($inputs[$i-1]['direction3'] == 0){
										echo 'email sent for'.$inputs[$i-1]['name'].'<br>';
										$this->load->model('input_model','inp');
										echo 'TURN OFF:'.$sender_id.'INPUT_ID'.$input_id.'name'.$name;
									    $this->inp->turn_off3($sender_id,$input_id);
									    $alarm_no = 30;
										$this->send_email($sender_id, $name,$alarm_no);
										} else {
											echo $name.'direction is not neg to pos for ' . $inputs[$i-1]['direction3'].'ALARM2';
									}
								} else {
							echo '<br>alarm is not on for ' .$name.'ALARM2';
							}
						} else { echo $name . 'is too large. greater than threshold'. $inputs[$i-1]['threshold3']. '.At '.$last_message[$name]*$scaleby.'ALARM3'; }
						} else {
					echo '<br>'.$name.'is not analogue'.'ALARM3';
					}
					//alarm 4
					if ($inputs[$i-1]['type'] == 'analogue'){
					if ($inputs[$i-1]['threshold4'] < $last_message[$name]*$scaleby){
						if ($inputs[$i-1]['is_on4'] == 1){	
								if ($inputs[$i-1]['direction4'] == 1){
									echo 'email sent for'.$inputs[$i-1]['name'].'<br>';
									$this->load->model('input_model','inp');
									echo 'TURN OFF:'.$sender_id.'INPUT_ID'.$input_id.'name'.$name;
								    $this->inp->turn_off4($sender_id,$input_id);
								    $alarm_no=41;
								    $this->send_email($sender_id, $name,$alarm_no);
									} else {
										echo $name.'direction is not pos to negative for ' . $inputs[$i-1]['direction4'].'ALARM4';
								}
							} else {
						echo '<br>alarm is not on for ' .$name.'ALARM4';
						}
					} else { echo $name . 'is too small. less than threshold'. $inputs[$i-1]['threshold4']. '.At '.$last_message[$name]*$scaleby.'ALARM4'; }
						} else {
					echo '<br>'.$name.'is not analogue';
					}
					if ($inputs[$i-1]['type'] == 'analogue'){
						if ($inputs[$i-1]['threshold4'] > $last_message[$name]*$scaleby){
							if ($inputs[$i-1]['is_on4'] == 1){	
									if ($inputs[$i-1]['direction4'] == 0){
										echo 'email sent for'.$inputs[$i-1]['name'].'<br>';
										$this->load->model('input_model','inp');
										echo 'TURN OFF:'.$sender_id.'INPUT_ID'.$input_id.'name'.$name;
									    $this->inp->turn_off4($sender_id,$input_id);	
									    $alarm_no =40;								
									   	$this->send_email($sender_id, $name,$alarm_no);
									} else {
											echo $name.'direction is not neg to pos for ' . $inputs[$i-1]['direction4'].'ALARM4';
									}
								} else {
							echo '<br>alarm is not on for ' .$name.'ALARM4';
							}
						} else { echo $name . 'is too large. greater than threshold'. $inputs[$i-1]['threshold4']. '.At '.$last_message[$name]*$scaleby.'ALARM4'; }
						} else {
					echo '<br>'.$name.'is not analogue'.'ALARM4';
					}
				if ($inputs[$i-1]['type'] == 'digital'){
					if ($inputs[$i-1]['is_on'] == 1){
						if ($last_message[$name] == "HI"){ $MSGhi = 1;} else {$MSGhi = 0;}
						if ($last_message[$name] == "LO"){ $MSGlo = 1;} else {$MSGlo = 0;}
						if ($MSGhi == $inputs[$i-1]['HI'] || $MSGlo == $inputs[$i-1]['LO']){
							echo 'email sent for'.$inputs[$i-1]['name'].'<br>';
							$this->send_email($sender_id, $name);
						} else {
							echo $name.'digital input is not equal to threshold'.'<br>';
						}
					} else {
						// should this be alarm be reset?
						// if ($MSGlo !== $inputs[$i-1]['LO']){
						// 	$this->model->load('input_model', 'input_model');
						// 	$this->input_model->turn_on($sender_id, $name);
						// 	echo 'alarm'.$name.'has been turned on. msg is '. $MSGhi . ' ' . $MSGlo . ' where HI is ' . $inputs[$i]['HI']. 'and LO is ' .$inputs[$i]['LO'].'<br>';
						// }
						echo 'digital input' . $name . 'is not on'.'<br>';
					}
				} else {
					echo $name . 'input is not digital'.'<br>';
				}
			// } else {
			// 	echo $name . 'is not email';
			// }
			//reset levels
			//print_r($last_message);
			// echo $name;
			// echo 'echo value';
			// print_r($last_message[$name]);
			// echo 'hi';
			// print_r($inputs[$i-1]['HI']);
			// echo 'lo';
			// print_r($inputs[$i-1]['LO']);
			if ($inputs[$i-1]['type'] == 'digital'){
				if ($inputs[$i-1]['is_on'] == 0){
					if ($last_message[$name] == 'LO' && $inputs[$i-1]['HI'] == 1){
						//$this->model->load('input_model', 'input_model');
						//$this->input_model->turn_on($sender_id, $name);
						echo $name .'<h2 style="margin:100px;color:red;"">'.$name.'RESET</h2>'.'<br>';
						$this->load->model('input_ model', 'input_model');
						$this->input_model->turn_on($sender_id, $name);
					} else { echo $name.' msg is '.$inputs[$i-1]['HI']. 'when '.$last_message[$name];}
					if ($last_message[$name] == 'HI' && $inputs[$i-1]['LO'] == 1){
						//$this->model->load('input_model', 'input_model');
						//$this->input_model->turn_on($sender_id, $name);
						echo $name .'<h2 style="margin:100px;color:red;"">'.$name.'RESET</h2>'.'<br>';
						$this->load->model('input_ model', 'input_model');
						$this->input_model->turn_on($sender_id, $name);
					} else { echo $name.'msg is LO and inputs is '/$inputs[$i-1]['HI'];}					
				} else { echo $name.'is already on';}
			}
			if ($inputs[$i-1]['type'] == 'analogue'){ 
				if ($inputs[$i-1]['is_on'] == 0){
					if($inputs[$i-1]['direction'] == 1){
						echo 'name:'.$inputs[$i-1]['name'].'last_message:'.$last_message[$name]. 'reset_level'.$inputs[$i-1]['reset_level'].'direction:'.$inputs[$i-1]['direction'];
						if ($last_message[$name]*$scaleby < $inputs[$i-1]['reset_level']){
							$this->load->model('input_model','inp');
							$this->inp->turn_on($sender_id, $name);
							echo '<h2 style="margin:100px;color:red;"">'.$name.'RESET11</h2>'.'<br>';
						} else {
							echo 'message is grt reset level with direction 1 for ' . $name;
						}
					} else { echo $name. 'direction is 0'; }
				} else { echo $name . ' is not on';}
			} 
			if ($inputs[$i-1]['type'] == 'analogue'){ 
				if ($inputs[$i-1]['is_on'] == 0){
					if ($inputs[$i-1]['direction'] == 0){
						echo 'last_message:'.$last_message[$name]. 'reset_level'.$inputs[$i-1]['reset_level'].'direction:'.$inputs[$i-1]['direction'];
						if ($last_message[$name]*$scaleby > $inputs[$i-1]['reset_level']){
							$this->load->model('input_model','inp');
							$this->inp->turn_on($sender_id, $name);
							echo '<h2 style="margin:100px;color:red;"">'.$name.'RESET10</h2>'.'<br>';
						} else {
								echo 'message is less than reset level with direction 0 for ' . $name;
							}
							} else {
								echo $name.'direction is pos';
							}
						
				} else { echo $name. ' is on'; }
			} else {echo $name. ' is not analogue'; }
			//reset 2
			if ($inputs[$i-1]['type'] == 'analogue'){ 
				if ($inputs[$i-1]['is_on2'] == 0){
					if($inputs[$i-1]['direction2'] == 1){
						echo 'name:'.$inputs[$i-1]['name'].'last_message:'.$last_message[$name]. 'reset_level2'.$inputs[$i-1]['reset2'].'direction:'.$inputs[$i-1]['direction2'];
						if ($last_message[$name]*$scaleby < $inputs[$i-1]['reset_level']){
							$this->load->model('input_model','inp');
							$this->inp->turn_on2($sender_id, $name);
							echo '<h2 style="margin:100px;color:red;"">'.$name.'RESET21</h2>'.'<br>';
						} else {
							echo 'message is grt reset level with direction 1 for ' . $name.'ALARM 2';
						}
					} else { echo $name. 'direction is 0'.'ALARM 2'; }
				} else { echo $name . ' is not on'.'ALARM 2';}
			} 
			if ($inputs[$i-1]['type'] == 'analogue'){ 
				if ($inputs[$i-1]['is_on2'] == 0){
					if ($inputs[$i-1]['direction2'] == 0){
						echo 'last_message:'.$last_message[$name]. 'reset_level2'.$inputs[$i-1]['reset2'].'direction2:'.$inputs[$i-1]['direction2'];
						if ($last_message[$name]*$scaleby > $inputs[$i-1]['reset2']){
							$this->load->model('input_model','inp');
							$this->inp->turn_on2($sender_id, $name);
							echo '<h2 style="margin:100px;color:red;"">'.$name.'RESET20</h2>'.'<br>';
						} else {
								echo 'ALARM2'.'message is less than reset level with direction 0 for ' . $name;
							}
							} else {
								echo 'ALARM2'.$name.'direction is pos';
							}
						
				} else { echo 'ALARM2'.$name. ' is on'; }
			} else {echo 'ALARM2'.$name. ' is not analogue'; }
			//reset 3
			if ($inputs[$i-1]['type'] == 'analogue'){ 
				if ($inputs[$i-1]['is_on3'] == 0){
					if($inputs[$i-1]['direction3'] == 1){
						echo 'name:'.$inputs[$i-1]['name'].'last_message:'.$last_message[$name]. 'reset3'.$inputs[$i-1]['reset3'].'direction:'.$inputs[$i-1]['direction3'];
						if ($last_message[$name]*$scaleby < $inputs[$i-1]['reset3']){
							$this->load->model('input_model','inp');
							$this->inp->turn_on3($sender_id, $name);
							echo '<h2 style="margin:100px;color:red;"">'.$name.'RESET 31</h2>'.'<br>';
						} else {
							echo 'message is grt reset level with direction 1 for ' . $name.'ALARM 3';
						}
					} else { echo $name. 'direction is 0'.'ALARM 3'; }
				} else { echo $name . ' is not on'.'ALARM 3';}
			} 
			if ($inputs[$i-1]['type'] == 'analogue'){ 
				if ($inputs[$i-1]['is_on3'] == 0){
					if ($inputs[$i-1]['direction3'] == 0){
						echo 'last_message:'.$last_message[$name]. 'reset3'.$inputs[$i-1]['reset3'].'direction2:'.$inputs[$i-1]['direction3'];
						if ($last_message[$name]*$scaleby > $inputs[$i-1]['reset3']){
							$this->load->model('input_model','inp');
							$this->inp->turn_on3($sender_id, $name);
							echo '<h2 style="margin:100px;color:red;"">'.$name.'RESET 30</h2>'.'<br>';
						} else {
								echo 'ALARM 3'.'message is less than reset level with direction 0 for ' . $name;
							}
							} else {
								echo 'ALARM 3'.$name.'direction is pos';
							}
						
				} else { echo 'ALARM2'.$name. ' is on'; }
			} else {echo 'ALARM2'.$name. ' is not analogue'; }
			//RESET 4
			if ($inputs[$i-1]['type'] == 'analogue'){ 
				if ($inputs[$i-1]['is_on4'] == 0){
					if($inputs[$i-1]['direction4'] == 1){
						echo 'name:'.$inputs[$i-1]['name'].'last_message:'.$last_message[$name]. 'reset4'.$inputs[$i-1]['reset4'].'direction:'.$inputs[$i-1]['direction4'];
						if ($last_message[$name]*$scaleby < $inputs[$i-1]['reset4']){
							$this->load->model('input_model','inp');
							$this->inp->turn_on4($sender_id, $name);
							echo '<h2 style="margin:100px;color:red;"">'.$name.'RESET 41</h2>'.'<br>';
						} else {
							echo 'message is grt reset level with direction 1 for ' . $name.'ALARM 4';
						}
					} else { echo $name. 'direction is 0'.'ALARM 4'; }
				} else { echo $name . ' is not on'.'ALARM 4';}
			} 
			if ($inputs[$i-1]['type'] == 'analogue'){ 
				if ($inputs[$i-1]['is_on4'] == 0){
					if ($inputs[$i-1]['direction4'] == 0){
						echo 'last_message:'.$last_message[$name]. 'reset4'.$inputs[$i-1]['reset4'].'direction2:'.$inputs[$i-1]['direction4'];
						if ($last_message[$name]*$scaleby > $inputs[$i-1]['reset4']){
							$this->load->model('input_model','inp');
							$this->inp->turn_on4($sender_id, $name);
							echo '<h2 style="margin:100px;color:red;"">'.$name.'RESET 40</h2>'.'<br>';
						} else {
								echo 'ALARM 4'.'message is less than reset level with direction 0 for ' . $name;
							}
							} else {
								echo 'ALARM 4'.$name.'direction is pos';
							}
						
				} else { echo 'ALARM 4'.$name. ' is on'; }
			} else {echo 'ALARM 4'.$name. ' is not analogue'; }
			
		}
		//$this->index();
		//$results = "email sent";
		//$results = json_encode($all_messages);
		//print_r($results);
	}

	public function configure_digital_inputs(){
		//$data = $_POST;
		if ($_POST['D0OUT'] == 'ON'){
			$D0HILO = 'HI';
		} 
		if ($_POST['D0OUT'] == 'OFF'){
			$D0HILO = 'LO';
		}
		if ($_POST['D1OUT'] == 'ON'){
			$D1HILO = 'HI';
		} 
		if ($_POST['D1OUT'] == 'OFF'){
			$D1HILO = 'LO';
		}
		if ($_POST['D2OUT'] == 'ON'){
			$D2HILO = 'HI';
		} 
		if ($_POST['D2OUT'] == 'OFF'){
			$D2HILO = 'LO';
		}
		if ($_POST['D3OUT'] == 'ON'){
			$D3HILO = 'HI';
		}
		if ($_POST['D3OUT'] == 'OFF'){
			$D3HILO = 'LO';
		}
		if ($_POST['D4OUT'] == 'ON'){
			$D4HILO = 'HI';
		} 
		if ($_POST['D4OUT'] == 'OFF'){
			$D4HILO = 'LO';
		}
		if ($_POST['D5OUT'] == 'ON'){
			$D5HILO = 'HI';
		} 
		if ($_POST['D5OUT'] == 'OFF'){
			$D5HILO = 'LO';
		}
		if ($_POST['D6OUT'] == 'ON'){
			$D6HILO = 'HI';
		} 
		if ($_POST['D6OUT'] == 'OFF'){
			$D6HILO = 'LO';
		}
		if ($_POST['D7OUT'] == 'ON'){
			$D7HILO = 'HI';
		} 
		if ($_POST['D7OUT'] == 'OFF'){
			$D7HILO = 'LO';
		}	
		$data = array(
			'user_id' => $_POST['user_id'],
			'sender_id' => $_POST['sender_id'],
			'D0OUT' => $D0HILO,
			'D1OUT' => $D1HILO,
			'D2OUT' => $D2HILO,
			'D3OUT' => $D3HILO,
			'D4OUT' => $D4HILO,
			'D5OUT' => $D5HILO,
			'D6OUT' => $D6HILO,
			'D7OUT' => $D7HILO,
			);
		$this->load->model('outputs_model','digital_inputs');
		$this->digital_inputs->update_digital($data);
		$results = json_encode($data);
		print_r($results);
	}

	public function reset_alarm(){
		$sender_id = $this->input->post('sender_id');
		$name = $this->input->post('name');
		$alarm = $this->input->post('alarm_no');
		$user_id = $this->input->post('user_id');
		$this->load->model('input_model','inp');		
		if ($alarm == 1){
			$this->inp->turn_on($sender_id, $name);
		} else if ($alarm == 2){
			$this->inp->turn_on2($sender_id, $name);
		} else if ($alarm == 3){
			$this->inp->turn_on3($sender_id, $name);
		} else if ($alarm == 4){
			$this->inp->turn_on4($sender_id, $name);			
		}
		$this->input_model->email_reset($name, $sender_id, $user_id, $alarm);
		$data = array(
			'senderid'=>$sender_id,
			'name'=>$name,
			'alarm'=>$alarm,
			'user_id'=>$user_id);
		print_r(json_encode($data));
	}

	public function raw_data_for_user(){
		//print_r($this->session->all_userdata());
		$user_id = $_GET['user_id'];
		$this->load->model('data_model','data');
		$data['results'] = $this->data->get_messages_for_user($user_id);
		$this->load->view('header');
		$this->load->view('raw_data', $data);
		$this->load->view('footer');
	}

	public function send_email($sender_id, $name, $alarm_no){
		$sender_id = $this->input->post('sender_id');
		$name = $this->input->post('name');
		$alarm_no = $this->input->post('alarm_no');
		$user_id = $this->input->post('user_id');
		$timestamp = time();
		$this->load->model('device_model', 'device_model');
		$results = $this->device_model->get_dataloggerid_for_senderid($sender_id);
		$datalogger_id = $results[0]['datalogger_id'];
		$results = $this->device_model->get_user_id_for_datalogger_id($datalogger_id);
		//$user_id = $results[0]['user_id'];
		$results = $this->input_model->get_input_id_for_sender_id($name,$sender_id);
		$input_id = $results[0]['input_id'];
		$this->load->model('alarm_model', 'alarm');
		$email = $this->alarm_model->get_email_for_alarm($user_id, $sender_id, $name, $alarm_no);
		$alarm_id = $email['alarm_id'];
		$this->alarm->update_email_sent($alarm_id);
		//$email = $this->user_model->get_email_address($user_id);
		//$email_to = $email[0]['email'];
		$config = Array(
		    'protocol' => 'smtp',
		    'smtp_host' => 'ssl://smtp.googlemail.com',
		    'smtp_port' => 465,
		    'smtp_user' => 'mydatame@googlemail.com',
		    'smtp_pass' => 'Icarus1987',
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
		if (!isset($usermessage)){
			$usermessage = "User message has not been set";
		}
		$this->load->model('input_model','conf');
		$inputs = $this->conf->get_inputs_for_sender_id($sender_id);
		$scaleby =($inputs[$input_id-1]['max']-$inputs[$input_id]['min'])/1024;
		$this->load->model('data_model', 'data_model');
		$last_message = $this->data_model->get_last_message_for_sender_id($sender_id);
		$last_message = $last_message[0];
		$answer = $this->data_model->get_messages_for_userid_and_senderid($user_id,$sender_id);
		$last_message = array_pop($answer);
		$ucname = strtoupper($name);
		$letter = str_split($ucname,1);
		$poshname = $letter[0] . 'in' . $letter[1];
		if ($letter[0] == 'c'){
			$poshname = $name;
		}
		$last_value = $last_message[$ucname];
		if ($inputs[$input_id]['type'] == 'analogue'){
		$message = $usermessage . "\r\n" . "\r\n" . 'This email was triggered at ' . gmdate("Y-m-d H:i:s", $timestamp) . " (" . $poshname . " alarm " . $alarm_no . ")";
		//	$message =  $inputs[$input_id-1]['name'] . " Alarm " . $alarm_no . ' - ' . $inputs[$input_id-1]['label_name'] . " has reached its threshold " 
		// . ". This reading occured at " . gmdate("Y-m-d H:i:s", $timestamp) . "\r\n" . "\r\n" . $usermessage;
	    //$scaled_value = $last_message[$name]*$scaleby;
		}
		if ($inputs[$input_id-1]['HI'] = 1) {$msg='HI';} else {$msg='LO';}
		if ($inputs[$input_id-1]['type'] == 'digital'){
		$message = $usermessage . "\r\n" . "\r\n" . 'This email was triggered at ' . gmdate("Y-m-d H:i:s", $timestamp) . " (" . $poshname . " alarm " . $alarm_no . ")";		
		//	$message =  $inputs[$input_id-1]['name'] . ' - ' . $inputs[$input_id-1]['label_name'] . " has reached its threshold " 
		//. ". This reading occured at " . gmdate("Y-m-d H:i:s", $timestamp) . "\r\n" . "\r\n" . $usermessage;
		// $scaled_value = $last_message[$name];
		}
		if ($inputs[$input_id]['type'] == 'counter'){
		$message = $usermessage . "\r\n" . "\r\n" . 'This email was triggered at ' . gmdate("Y-m-d H:i:s", $timestamp) . " (" . $poshname . " alarm " . $alarm_no . ")";
		//	$message =  $inputs[$input_id-1]['name'] . ' - ' . $inputs[$input_id-1]['label_name'] . " has reached its threshold " 
		//. ". This reading occured at " . gmdate("Y-m-d H:i:s", $timestamp) . "\r\n" . "\r\n" . $usermessage;
	    // $scaled_value = $last_message[$name];
		}		//print_r($message);
	    //$finalmessage = $finalmessage . $message;
		$this->email->message($message);
		
	//	echo "<h2 style='margin:100px;color:red;'>" . $name ." email sent </h2>";
	   	 		//	echo gmdate("Y-m-d H:i:s", $timestamp);
	   	 			//echo '<b>scaled value is</b>'.$scaled_value;
					$data = array(
	   				 	'user_id' => $user_id,
	   				 	'sender_id' => $sender_id,
	   				 	'alarm_no' => $alarm_no,
		   				'time' => $timestamp,
						'message' => $message,
						'to' => $to,
						'from' => $from,
						'subject' => $subject,
						'usermessage' => $usermessage,
						'type' => $inputs[$input_id-1]['type'],
						'scaleby' => $scaleby,
						'value' => $scaled_value,
						'threshold' => $inputs[$input_id-1]['threshold'] ,
						'is_on' => $inputs[$input_id-1]['is_on'],
						'direction' => $inputs[$input_id-1]['direction'],
						'reset_level' => $inputs[$input_id-1]['reset_level'],
						'threshold' => $inputs[$input_id-1]['threshold'] ,
						'is_on' => $inputs[$input_id-1]['is_on'],
						'direction' => $inputs[$input_id-1]['direction'],
						'reset_level' => $inputs[$input_id-1]['reset_level'],
						'threshold2' => $inputs[$input_id-1]['threshold2'] ,
						'is_on2' => $inputs[$input_id-1]['is_on2'],
						'direction2' => $inputs[$input_id-1]['direction2'],
						'reset2' => $inputs[$input_id-1]['reset2'],
						'threshold3' => $inputs[$input_id-1]['threshold3'] ,
						'is_on3' => $inputs[$input_id-1]['is_on3'],
						'direction3' => $inputs[$input_id-1]['direction3'],
						'reset3' => $inputs[$input_id-1]['reset3'],
						'threshold4' => $inputs[$input_id-1]['threshold4'] ,
						'is_on4' => $inputs[$input_id-1]['is_on4'],
						'direction4' => $inputs[$input_id-1]['direction4'],
						'reset4' => $inputs[$input_id-1]['reset4'],
						'label_name' => $inputs[$input_id-1]['label_name'],
						'units' => $inputs[$input_id-1]['units'],
						'name' => $inputs[$input_id-1]['name']
					);
					//echo '<b>value is data array is</b>'.$data['value'];
					$this->load->model('email_model', 'emaily');
					$this->emaily->add_email($data);
					$this->load->model('user_model', 'user');
					$this->user->log_time_email_sent($user_id);
					$this->load->model('device_model', 'device');
					$this->device->update_time($sender_id);
					$this->device->update_email_sent_time($sender_id);
			if ($this->email->send()){
				$is_sent = true;
				    //echo "Email sent for " . $name . "turn off alarm for this alarm.".$alarm_no;
					
					// $all_messages = $all_messages . $finalmessage;
				} else {
					$is_sent = false;
					//echo $this->email->print_debugger();
				}
				$this->load->model('input_model','inp');
		//			echo 'TURN OFF:'.$sender_id.'INPUT_ID'.$input_id.'name'.$name.'alarm'.$alarm_no;
					if ($alarm_no == 1){
					    $this->inp->turn_off($sender_id,$input_id);
						$this->input_model->email_sent($name, $sender_id, $user_id, $alarm_no);
					}
					if ($alarm_no == 2){
					    $this->inp->turn_off2($sender_id,$input_id);
						$this->input_model->email_sent($name, $sender_id, $user_id, $alarm_no);
					}			
					if ($alarm_no == 3){
					    $this->inp->turn_off3($sender_id,$input_id);
						$this->input_model->email_sent($name, $sender_id, $user_id, $alarm_no);
					}	
					if ($alarm_no == 4){
					    $this->inp->turn_off4($sender_id,$input_id);
						$this->input_model->email_sent($name, $sender_id, $user_id, $alarm_no);
				}
						//print_r($data);	
//					echo 'input in database is now turned off:';
					$this->load->model('input_model','input_model');
					$results = $this->input_model->get_input($user_id, $sender_id, $name);	
					// print_r($results[0]['is_on']);	
					// print_r($results[0]['is_on2']);	
					// print_r($results[0]['is_on3']);	
					// print_r($results[0]['is_on4']);	
					//$json = $data
					// $results_array = array(
					// 	'name' => $name,
					// 	'alarm' => $alarm_no);
					//$to = $email['email_address'];
					$results = array($name, $alarm_no, $last_message, $last_value, $usermessage, $to, $email, $user_id, $sender_id, $is_sent);
					print_r(json_encode($results));
		//	} else {
		//		echo $name . 'alarm is off';
		//	}
	}
}
?>