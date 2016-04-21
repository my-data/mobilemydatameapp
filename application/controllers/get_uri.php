<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Get_uri extends CI_Controller {

	public function index(){
		$is_logged_in = $this->session->userdata('logged_in');
		//$is_logged_in = true;
		if ($is_logged_in == TRUE){
			$this->load->view('header');
			$this->load->view('uri');
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

	public function post(){

	$username = $this->session->userdata('username');
	$user_id = $this->user_model->get_user_id($username);
	$this->load->model('data_model');
	$message_data = $this->input->get('id');
	$data = $message_data;
	if ($data= null){
		echo "not incoming message found";
	}
	$data = ltrim($data, 'c=');
	$message_data = ltrim($message_data, 'c=');
	$csv_array = explode(",",$message_data);
	//print_r($csv_array);
	$data['Sender_ID'] = $csv_array[0];
	$time=time();
	$data['Datetime'] = $time;
	$ip=$_SERVER['REMOTE_ADDR']; 
	$data['IP_address'] = $ip;
	if (count($csv_array) == 34) {
		$message_data=array(
		 	"Sender_ID" => $csv_array[0],
		 	"user_id" => $user_id,
		 	"datetime" => time(),
		 	"ip_address" => $ip,
		 	"d_0" => $csv_array[3],
		 	"d_1" => $csv_array[5],
		 	"d_2" => $csv_array[7],
		 	"d_3" => $csv_array[9],
		 	"d_4" => $csv_array[11],
		 	"d_5" => $csv_array[13],
		 	"d_6" => $csv_array[15],
		 	"d_7" => $csv_array[17],
		 	"a_0" => $csv_array[19],
		 	"a_1" => $csv_array[21],
		 	"a_2" => $csv_array[23],
		 	"a_3" => $csv_array[25],
		 	"c_0" => $csv_array[27],
		 	"c_1" => $csv_array[29],
		 	"c_2" => $csv_array[31],
		 	"c_3" => $csv_array[33],
		 	);
			$this->data_model->add_messagedata($message_data);
			print_r(json_encode($message_data));
		    $this->data_model->add_message_packet($data);
		    print_r(json_encode($data));
		    echo "<br>";
		    $this->load->model('data_model');
		    $data = $this->data_model->get_digital_configuration($user_id);
		    $output =array();
		    if ($data[0]['D0'] == "HI"){
		     array_push($output, "DOUT0HI");
		 	} else if ($data[0]['d_0'] == "LO"){ 
		      array_push($output, "DOUT0LO");
		 	}
		    if ($data[0]['D1'] == "HI")
		    	{ $array_push($output, "DOUT1HI"); } 
		    else if ($data[0]['d_1'] == "LO")
		    	{ array_push($output, "DOUT1LO");}
		    if ($data[0]['D2'] == "HI")
		    	{ array_push($output, "DOUT2HI");} 
		    else if ($data[0]['d_2'] == "LO")
		    	{ array_push($output, "DOUT2LO");}
		    if ($data[0]['D3'] == "HI"){ 
		    	array_push($output, "DOUT3HI");
		    } else if ($data[0]['d_3'] == "LO"){ 
		    	array_push($output, "DOUT3LO");}
		    if ($data[0]['D4'] == "HI"){ 
		    	array_push($output, "DOUT4HI");
		    } else if ($data[0]['d_4'] == "LO"){ 
		    	array_push($output, "DOUT4LO");
		    }
		    if ($data[0]['D5'] == "HI"){ 
		    	array_push($output, "DOUT5HI");
		    } else if ($data[0]['d_5'] == "LO"){ 
		    	array_push($output, "DOUT5LO");}
		    if ($data[0]['D6'] == "HI"){ 
		    	array_push($output, "DOUT6HI");
		    } else if ($data[0]['d_6'] == "LO"){ 
		    	array_push($output, "DOUT6LO");
		    }
		    if ($data[0]['D7'] == "HI"){ 
		    	array_push($output, "DOUT7HI");
		    } else if ($data[0]['d_7'] == "LO"){ 
		    		array_push($output, "DOUT7LO");
		    	}
		    echo "return";
		    print_r($output);
		    //echo $this->uri->segment(4);
		    if ($this->uri->segment(4) == "xml"){
		    function array_to_xml(array $arr, SimpleXMLElement $xml)
			{
			    foreach ($arr as $k => $v) {
			        is_array($v)
			            ? array_to_xml($v, $xml->addChild($k))
			            : $xml->addChild($k, $v);
			    }
			    return $xml;
			}
			echo array_to_xml($output, new SimpleXMLElement('<root/>'))->asXML();
		    } else if ($this->uri->segment(4) == "json"){
		    	print_r(json_encode($output));
		    } else if ($this->uri->segment(4) == "html"){
		    	print_r($output);
		    }
			$this->index();	
			echo '#ReceivedOK';
	} else {
			echo "<h2>Message data not correct format. Must have 16 values in csv file. Current count is " . count($csv_array) . "</h2>";
		}
	}

public function get(){
	$this->load->model('user_model', 'user');
	$id = $this->uri->segment(3);
	$username = $this->session->userdata('username');
	$user_id = $this->user->get_user_id($username);
	$user_id = $user_id[0]['user_id'];
	//echo $user_id;
	$this->load->model('device_model', 'device');
	$sender_id = $this->device->get_sender_id_for_user($user_id);
	$sender_id= $sender_id[0]['senderid'];
	//echo $sender_id;
	if ($id == "last"){
		$results = $this->data_model->get_last_message();
		$results = json_encode($results);
		print_r($results);
	}
	else if ($id == "input"){
		$input = $this->uri->segment(4);
		//echo $input;
		$sender_id = $this->uri->segment(5);
		//echo $sender_id;
		$this->load->model('data_model', 'data');
		if ($input=="A0"){
			$results = $this->data->get_a_0_timeseries($sender_id);
			$json = json_encode($results);
			$json = preg_replace( "/\"(\d+)\"/", '$1', $json);
			print_r($json);
		}
		else if ($input == "A1"){
			$results = $this->data->get_a_1_timeseries($sender_id);
			$json = json_encode($results);
			$json = preg_replace( "/\"(\d+)\"/", '$1', $json);
			print_r($json);		}
		else if ($input == "A2"){
			$results = $this->data->get_a_2_timeseries($sender_id);
			$json = json_encode($results);
			$json = preg_replace( "/\"(\d+)\"/", '$1', $json);
			print_r($json);
		}
		else if ($input == "A3"){
			$results = $this->data->get_a_3_timeseries($sender_id);
			//only json_numeric_check on php5.3+
			//print_r(json_encode($results,JSON_NUMERIC_CHECK));
			$json = json_encode($results);
			$json = preg_replace( "/\"(\d+)\"/", '$1', $json);
			print_r($json);
		}
			if ($input=="A4"){
			$results = $this->data->get_a_4_timeseries($sender_id);
			$json = json_encode($results);
			$json = preg_replace( "/\"(\d+)\"/", '$1', $json);
			print_r($json);
		}
		else if ($input == "A5"){
			$results = $this->data->get_a_5_timeseries($sender_id);
			$json = json_encode($results);
			$json = preg_replace( "/\"(\d+)\"/", '$1', $json);
			print_r($json);		}
		else if ($input == "A6"){
			$results = $this->data->get_a_6_timeseries($sender_id);
			$json = json_encode($results);
			$json = preg_replace( "/\"(\d+)\"/", '$1', $json);
			print_r($json);
		}
		else if ($input == "A7"){
			$results = $this->data->get_a_7_timeseries($sender_id);
			//only json_numeric_check on php5.3+
			//print_r(json_encode($results,JSON_NUMERIC_CHECK));
			$json = json_encode($results);
			$json = preg_replace( "/\"(\d+)\"/", '$1', $json);
			print_r($json);
		}		if ($input=="A8"){
			$results = $this->data->get_a_8_timeseries($sender_id);
			$json = json_encode($results);
			$json = preg_replace( "/\"(\d+)\"/", '$1', $json);
			print_r($json);
		}
		else if ($input == "A9"){
			$results = $this->data->get_a_9_timeseries($sender_id);
			$json = json_encode($results);
			$json = preg_replace( "/\"(\d+)\"/", '$1', $json);
			print_r($json);		}
		else if ($input == "A10"){
			$results = $this->data->get_a_10_timeseries($sender_id);
			$json = json_encode($results);
			$json = preg_replace( "/\"(\d+)\"/", '$1', $json);
			print_r($json);
		}
		else if ($input == "A11"){
			$results = $this->data->get_a_11_timeseries($sender_id);
			//only json_numeric_check on php5.3+
			//print_r(json_encode($results,JSON_NUMERIC_CHECK));
			$json = json_encode($results);
			$json = preg_replace( "/\"(\d+)\"/", '$1', $json);
			print_r($json);
		}		if ($input=="A12"){
			$results = $this->data->get_a_12_timeseries($sender_id);
			$json = json_encode($results);
			$json = preg_replace( "/\"(\d+)\"/", '$1', $json);
			print_r($json);
		}
		else if ($input == "A13"){
			$results = $this->data->get_a_13_timeseries($sender_id);
			$json = json_encode($results);
			$json = preg_replace( "/\"(\d+)\"/", '$1', $json);
			print_r($json);		}
		else if ($input == "A14"){
			$results = $this->data->get_a_14_timeseries($sender_id);
			$json = json_encode($results);
			$json = preg_replace( "/\"(\d+)\"/", '$1', $json);
			print_r($json);
		}
		else if ($input == "A15"){
			$results = $this->data->get_a_15_timeseries($sender_id);
			//only json_numeric_check on php5.3+
			//print_r(json_encode($results,JSON_NUMERIC_CHECK));
			$json = json_encode($results);
			$json = preg_replace( "/\"(\d+)\"/", '$1', $json);
			print_r($json);
		}		if ($input=="A16"){
			$results = $this->data->get_a_16_timeseries($sender_id);
			$json = json_encode($results);
			$json = preg_replace( "/\"(\d+)\"/", '$1', $json);
			print_r($json);
		}
		else if ($input == "A17"){
			$results = $this->data->get_a_17_timeseries($sender_id);
			$json = json_encode($results);
			$json = preg_replace( "/\"(\d+)\"/", '$1', $json);
			print_r($json);		}
		else if ($input == "A18"){
			$results = $this->data->get_a_18_timeseries($sender_id);
			$json = json_encode($results);
			$json = preg_replace( "/\"(\d+)\"/", '$1', $json);
			print_r($json);
		}
		else if ($input == "A19"){
			$results = $this->data->get_a_19_timeseries($sender_id);
			//only json_numeric_check on php5.3+
			//print_r(json_encode($results,JSON_NUMERIC_CHECK));
			$json = json_encode($results);
			$json = preg_replace( "/\"(\d+)\"/", '$1', $json);
			print_r($json);
		}	
	}
	else if ($id == "user"){
		$user_id = $this->uri->segment(4);
		$this->load->model('user_model', 'user');
		$results = $this->user->get_user_for_id($user_id);
		print_r(json_encode($results));

	}
	else if ($id == "get_device_for_user"){
		$user_id = $this->uri->segment(4);
		$this->load->model('device_model', 'device');
		$results = $this->device->get_device_for_user($user_id);
		print_r(json_encode($results));

	}
	else if ($id == "device"){
		$sender_id = $this->uri->segment(4);
		$this->load->model('device_model', 'device');
		$results = $this->device->get_device_for_sender_id($sender_id);
		print_r(json_encode($results));

	}
	else if ($id == "all"){
		$user_id = $this->uri->segment(4);
		$sender_id = $this->uri->segment(5);
		//echo $user_id;
		//echo $sender_id;
		//$user_id = $this->session->userdata('user_id');
		$this->load->model('data_model', 'data');
		//$results = $this->data->get_messages_for_senderid($sender_id);
		$results = $this->data->get_messages_for_userid_and_senderid($user_id,$sender_id);
		$results = json_encode($results);
		print_r($results);

	}
	else if ($id == "get_inputs_for_sender_id"){
		$user_id = $this->uri->segment(4);
		$sender_id = $this->uri->segment(5);
		$this->load->model('inputs_model', 'inputs');
		$results = $this->inputs->get_inputs_for_senderid($user_id,$sender_id);
		$results = json_encode($results);
		print_r($results);

	}

	// else if ($id == "update_site"){
	// 	$user_id = $this->uri->segment(4);
	// 	$sender_id = $this->uri->segment(5);
	// 	//$this->add_incoming_to_message_table($user_id, $sender_id);
	// 	//echo $user_id;
	// 	//echo $sender_id;
	// 	//$user_id = $this->session->userdata('user_id');
	// 	$this->load->model('data_model', 'data');
	// 	//$results = $this->data->get_messages_for_senderid($sender_id);
	// 	$results = $this->data->get_messages_for_userid_and_senderid($user_id,$sender_id);
	// 	$results = json_encode($results);
	// 	print_r($results);

	// }
	else if ($id == "incoming"){
		$this->load->model('incoming_model', 'incoming');
		$results = $this->incoming->get_all_messages();
		$results = json_encode($results);
		print_r($results);

	}
	else if ($id == "alarm"){
		//ECHO 'ALARM';
		$name = $this->input->post('name');
		$user_id = $this->uri->segment(4);
		$sender_id = $this->uri->segment(5);
		$this->load->model('alarm_model', 'alarm');
		$results = $this->alarm->get_alarm_user_sender($user_id, $sender_id);
		$results = json_encode($results);
		print_r($results);

	}
	else if ($id == "allusers"){
		$this->load->model('user_model', true);
		$results = $this->user_model->get_all_users();
		print_r(json_encode($results));
	}
	else if ($id == "inputs_for_device"){
		$sender_id = $this->uri->segment(4);
		$this->load->model('input_model', true);
		$results = $this->input_model->get_inputs_for_sender_id($sender_id);
		echo $_GET['callback'] . '('.json_encode($results).')';
		//print_r(json_encode($results));
	}
	else if ($id == "inputs_for_user"){
		$user_id = $this->uri->segment(4);
		$this->load->model('input_model', true);
		$results = $this->input_model->get_inputs_for_user_id($user_id);
		print_r(json_encode($results));
	}
	else if ($id == "all_incoming"){
		$sender_id = $this->uri->segment(4);
		$this->load->model('incoming_model', 'incoming');
		$results = $this->incoming->get_all_messages();
		print_r(json_encode($results));
	}
	else if ($id == "get_incoming_for_sender_id"){
		$sender_id = $this->uri->segment(4);
		$this->load->model('incoming_model', 'incoming');
		$results = $this->incoming->get_incoming_for_sender_id();
		$count = count($results);
		for ($i;$i<$count;$i++){
			$test_array = explode($results[$i]);
			if ($test_array[0] == $sender_id){
				print_r(json_encode($test_array));
			}
		}
		//print_r(json_encode($results));
	}
	else if ($id == "get_unadded_messages"){
		$sender_id = $this->uri->segment(4);
		$this->load->model('device_model', 'device');
		$update_time = $this->device->get_last_update_time($sender_id);
		$this->load->model('device_model', 'device');
		$results = $this->device->get_unadded_messages($update_time);
		print_r(json_encode($results));
	}
	else if ($id == "last_update_time"){
		$sender_id = $this->uri->segment(4);
		$this->load->model('device_model', 'device');
		$results = $this->device->get_last_update_time($sender_id);
		$last_update_time = $results[0]['update_time'];
		print_r(json_encode($last_update_time));
	}
	else if ($id == "get_number_of_devices_for_user"){
		$user_id = $this->uri->segment(4);
		$this->load->model('device_model', 'device');
		$results = $this->device->get_number_of_devices_for_user($user_id);
		//$number_of_devices = $results[0]['update_time'];
		print_r(json_encode($results));
	}
	else if ($id == "configuration_for_user"){
		//echo 'in method';
		$user_id = $this->input->post('user_id');
		$user_id = $this->uri->segment(4);
		//echo $user_id;
		$this->load->model('configuration_model', 'configuration');
		$results = $this->configuration->get_configuration_for_user_id($user_id);
		//$number_of_devices = $results[0]['update_time'];
		//print_r($results);
		$json = json_encode($results);
		print_r($json);
	}
	else if ($id == "configuration_for_sender_id"){
		//echo 'in method';
		$sender_id = $this->input->post('sender_id');
		$sender_id = $this->uri->segment(4);
		//echo $user_id;
		$this->load->model('configuration_model', 'configuration');
		$results = $this->configuration->get_configuration_for_sender_id($sender_id);
		//$number_of_devices = $results[0]['update_time'];
		//print_r($results);
		$json = json_encode($results);
		print_r($json);
	}
	else if ($id == "get_user_for_sender_id"){
		$sender_id = $this->uri->segment(4);
		$this->load->model('device_model', 'device');
		$user_id = $this->device->get_user_id_for_sender_id($sender_id);
		$user_id = $user_id[0]['user_id'];
		$results = $this->user_model->get_user($user_id);
		//$number_of_devices = $results[0]['update_time'];
		print_r(json_encode($results));
	}
	else if ($id == "configuration"){
		$user_id = $this->uri->segment(4);
		$sender_id = $this->uri->segment(5);
		$this->load->model('input_model', 'inputs');
		$results = $this->inputs->get_all_inputs_for_user($user_id, $sender_id);
		print_r(json_encode($results));
	} else {
		echo "uri not recognised";
	}
	}


	public function place(){
		$owner = 'ww';
	 	$db = mysql_connect("localhost", "root", "");
		mysql_select_db("mydata",$db);
	 	if (isset($_REQUEST['c']))
	 	{
	  		$c = $_REQUEST['c'];
			$ip = $_SERVER['REMOTE_ADDR'];
	 		$result = mysql_query("INSERT into Incoming (messtype,ip,command,owner) values ('IN','$ip','$c','" . $owner . "')",$db);		
		    if ($c != "Ack")
			{
				echo '#ReceivedOK';
			}
		}
	}

	public function delete(){

		$this->load->model('user_model', 'user');
		$id = $this->uri->segment(3);
		//$username = $this->session->userdata('username');
		//$user_id = $this->user->get_user_id($username);
		//$user_id = $user_id[0]['user_id'];
		//echo $user_id;
		if ($id == "user"){
			$this->load->model('user_model', 'user');
			$user_id = $this->uri->segment(4);
			$this->user->delete($user_id);
		} else if ($id == "device"){
			$user_id = $this->uri->segment(4);
			$this->load->model('device_model', 'device');
			$device_id = $this->device->get_device_for_user($user_id);
			$this->load->model('data_model', 'data');
			$this->data->delete_device($device_id);
		}  else if ($id =="data"){
			$user_id = $this->uri->segment(4);
			$this->load->model('data_model', 'data');
			$this->data->delete_messages_from_user($user_id);
		}  else if ($id =="email"){
			$user_id = $this->input->post('user_id');
			//$this->load->model('email_model', 'email');
			$this->email_model->delete_email_for_user($user_id);
			print_r(json_encode($user_id));
		}  else if ($id =="all_emails"){
			//$user_id = $this->input->post('user_id');
			//$this->load->model('email_model', 'email');
			$deleteemailtime = time();
			$this->email_model->delete_all_emails();
			//print_r(json_encode($user_id));
		} else if ($id == "alarm"){
			//$sender_id = $this->uri->segment(4);
			//$name = $this->uri->segment(5);
			$name = $this->input->post('name');
			$alarm_no = $this->input->post('alarm_no');
			$sender_id = $this->input->post('sender_id');
			$user_id = $this->input->post('user_id');
			$this->load->model('alarm_model','alarm_model');
			$this->alarm_model->delete_alarm($name, $sender_id, $user_id, $alarm_no);
			$arr = array($name, $sender_id, $user_id, $alarm_no);
			print_r(json_encode($arr));
		}
	}

	public function robs_data(){
		$this->load->model('incoming_model', 'incoming');
		$results = $this->incoming->get_all_messages();
		$results = array_reverse($results);
		$data['results'] = $results;
		 $this->load->view('header');
		 $this->load->view('robs_table', $data);
		 $this->load->view('footer');
	}

	public function delete_incoming(){
		$this->load->model('incoming_model', true);
		$this->incoming_model->delete();
		$msg = "all incoming deleted!";
		print_r(json_encode($msg));
	}

	public function add_incoming_admin(){
		// $user_id = $this->input->post('user_id');
		// $sender_id = $this->input->post('sender_id');
		// if (!isset($user_id)){
		// 	$user_id = $this->uri->segment(3);
		// }
		// if (!isset($sender_id)){
		// 	$sender_id = $this->uri->segment(4);
		// }
		// $user_id = 1;
		// $sender_id = 'admin';
		// $this->load->model('user_model','user_model');
		// $results = $this->user_model->is_admin($user_id);
		// $is_admin = $results[0]['is_admin'];
		// if (!isset($is_admin){
		// 	return
		// }
		// $this->load->model('device_model', 'device');
		// $results = $this->device->get_last_update_time($sender_id);
		// $last_update_time = $results[0]['update_time'];]
		$this->load->model('data_model','data_model');
		$results1 = $this->data_model->get_last_message();
		$last_update_time = $results1[0]['datetime'];
		$results2 = $this->data_model->get_last_message_time();
		$last_update_time = $results2[0]['datetime'];
		$last_update_time = date("Y-m-d H:i:s",$last_update_time);
		$last_update_time = $this->data_model->get_last_datestring();
		$last_update_time = $last_update_time[0]['datestring'];
		//echo $last_update_time;
		//$date_object = date_create($last_update_time);
		//echo $date_object;
		//$last_update_time = date_format($date_object, "Y/m/d H:i:s");
		//$last_update_time = strtotime($last_update_time);
		//echo gmdate("Y-m-d H:i:s",$last_update_time);
		//echo gmdate("Y-m-d H:i:s", $last_update_time);
		$this->load->model('incoming_model', 'incoming');
		$results = $this->incoming->get_unadded_messages($last_update_time);
		$last_message = $results;
		//print_r($results);
		$last = count($results);
		$last_incoming_time = $results[0]['datetime'];
		$last_incoming_sender_id = $results[0]['command'];
		//print_r($results1);
		//echo 'time' . $last_incoming_time;
		//echo 'comman' .  $last_incoming//_sender_id;
		// print_r($results);
		// echo $last;
		$command = $results;
		//$idx = $results
		//print_r($command);
		//echo $last;
		 // 		$timestamp = localtime();
		 // print_r($timestamp);
		date_default_timezone_set('Europe/London');
		// echo date(DATE_RFC2822);
		$date = date("Y-m-d H:i:s");
		 //echo strtotime("now"), "\n";
		$timestampBST = strtotime($date);
		//$date = date_create();
		//$timestampBST = date_timestamp_get($date);

		// $localtime = localtime();
		// $sec = $localtime['tm_sec'];
		// $min = $localtime['tm_min'];
		// $hour = $localtime['tm_hour'];
		// $day = $localtime['tm_mday'];
		// $month = $localtime['tm_mon'];
		// $year = $localtime['tm_year'];

		// $timestampBST = mktime($hour, $min, $sec, $month, $day, $year);

		// echo '' . $timestampBST;
		// $date = date();
		// print_r($date);
		if ($last == 0){
			$err_msg = 'no unadded messages';
			$json = json_encode($err_msg);
			print_r($json);
		} else {
			for ($i=0; $i < $last; $i++){
				if ($command[$i]['command'] != "Ack"){
					$idx = $results[0]['idx'];
					$exploded_array = explode(",",$command[$i]['command']);
					//print($exploded_array);
					$count = count($exploded_array);
					//echo $count;
					//date_default_timezone_set('Europe/London');
					// $timestamp = localtime();
					// echo $timestamp;
					// $date = date();
					// echo $date;
					// $date = date(DATE_RFC2822);
					 //echo strtotime("now"), "\n";

					// $timestampBST = strtotime($date);
					//if ($exploded_array[0] == $sender_id){
					//echo 'testie';
					// $this->load->model('device_model', 'device');
					 $sender_id = $exploded_array[0];
					 $results = $this->device_model->get_user_id_for_sender_id($sender_id);
					 $user_id = $results[0]['user_id'];
						if ($count == 36){
							$message_data = array(
								'sender_id' => $sender_id,
								'user_id' => $user_id,
								'datetime' => $timestampBST,
								'datestring' => $date,
								'signal_strength' => $exploded_array[3],
								'D0' => $exploded_array[5],
								'D1' => $exploded_array[7],
								'D2' => $exploded_array[9],
								'D3' => $exploded_array[11],
								'D4' => $exploded_array[13],
								'D5' => $exploded_array[15],
								'D6' => $exploded_array[17],
								'D7' => $exploded_array[19],
								'A0' => $exploded_array[21],
								'A1' => $exploded_array[23],
								'A2' => $exploded_array[25],
								'A3' => $exploded_array[27],
								'C0' => $exploded_array[29],
								'C1' => $exploded_array[31],
								'C2' => $exploded_array[33],
								'C3' => $exploded_array[35]
								);
							//echo 'big tits';
							//print_r($message_data);
						 	$this->load->model('data_model','data');
						 	$this->data->add_messagedata($message_data);
						 	$this->load->model('incoming_model');
						 	$this->incoming_model->delete_incoming_message($idx);
						 	$arr = array(
							 	//'message_data' => $message_data,
							 	'last_message' => $last_message[$i],
							 	'last_update_time'=> $last_update_time,
							 	'datatypeforlastupdate' =>  gettype($last_update_time),
							 	//'current_timestamp'=> gmdate("Y-m-d H:i:s",$timezoneplusonehour),
							 	'number of elements in string'=>$count,
							 	'date' => $date,
							 	'timestamp' => date("Y-m-d H:i:s",$timestampBST));
							  $msg = 'hello';
							  $json = json_encode($arr);
							  print_r($json);
						 }  else if ($count == 66){
						 	$message_data = array(
								'sender_id' => $sender_id,
								'user_id' => $user_id,
								'datetime' => $timestampBST,
								'datestring' => $date,
								'signal_strength' => $exploded_array[3],
								'D0' => $exploded_array[5],
								'D1' => $exploded_array[7],
								'D2' => $exploded_array[9],
								'D3' => $exploded_array[11],
								'D4' => $exploded_array[13],
								'D5' => $exploded_array[15],
								'D6' => $exploded_array[17],
								'D7' => $exploded_array[19],
								'A0' => $exploded_array[21],
								'A1' => $exploded_array[23],
								'A2' => $exploded_array[25],
								'A3' => $exploded_array[27],
								'A4' => $exploded_array[29],
								'A5' => $exploded_array[31],
								'A6' => $exploded_array[33],
								'A7' => $exploded_array[35],
								'A8' => $exploded_array[37],
								'A9' => $exploded_array[39],
								'A10' => $exploded_array[41],
								'A11' => $exploded_array[43],
								'A12' => $exploded_array[45],
								'A13' => $exploded_array[47],
								'A14' => $exploded_array[49],
								'A15' => $exploded_array[51],
								'A16' => $exploded_array[53],
								'A17' => $exploded_array[55],
								'A18' => $exploded_array[57],
								'A19' => $exploded_array[59],
								'C0' => $exploded_array[61],
								'C1' => $exploded_array[63],
								'C2' => $exploded_array[65],
								'C3' => $exploded_array[67]
								);
						 	$this->load->model('data_model','data');
						 	$this->data->add_messagedata($message_data);
						 	 $arr = array(
							 	'message_data' => $message_data,
							 	'last_update_time'=> $last_update_time,
							 	'current_time'=> $date,
							 	'number of elements in string'=>$count);
							 $msg = 'hello';
							  $json = json_encode($arr);
							  print_r($json);
						 } else {
						 	$err_msg = 'The string does not have the correct format of 36 character length';
						 	$json = json_encode($err_msg);
						 	print_r($json);
						 }
					//}
				}
			}
		}
		//$message_data = "added incoming messages";
		//print_r(json_encode($message_data));
	
	}

	public function post_configuration(){
		$data = array(
			'user_id' => $_POST['user_id'],
			'sender_id' => $_POST['sender_id'],
			'display_gauges' => $_POST['show_gauges'],
			'display_digitals' => $_POST['show_digitals'],
			'display_chart' => $_POST['show_charts'],
			'display_bar_chart' => $_POST['show_bar_chart'],
			'display_output' => $_POST['show_output']
			);
		$this->load->model('configuration_model','configuration');
		$this->configuration->save_page_configuration($data);
		$json = json_encode($data);
		print_r($json);
	}

}