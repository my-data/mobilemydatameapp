<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Get_uri extends CI_Controller {

	public function index(){
		$is_logged_in = $this->session->userdata('logged_in');
		if ($is_logged_in == TRUE){
			$this->load->view('header');
			$this->load->view('uri');
			$this->load->view('footer');
		} else {
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
	$sender_id = $this->user->get_sender_id_for_user($user_id);
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
		else if ($input == "Q13"){
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
	else if ($id == "device"){
		$sender_id = $this->uri->segment(4);
		$this->load->model('device_model', 'device');
		$results = $this->device->get_device_for_sender_id($sender_id);
		print_r(json_encode($results));

	}
	else if ($id == "all"){
		$user_id = $this->uri->segment(4);
		$sender_id = $this->uri->segment(5);
		//$user_id = $this->session->userdata('user_id');
		$this->load->model('data_model', 'data');
		$results = $this->data->get_messages_for_senderid($sender_id);
		$results = json_encode($results);
		print_r($results);

	}
	else if ($id == "incoming"){
		$this->load->model('incoming_model', 'incoming');
		$results = $this->incoming->get_all_messages();
		$results = json_encode($results);
		print_r($results);

	}
	else if ($id == "alarm"){
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
	else if ($id == "inputsfordevice"){
		$sender_id = $this->uri->segment(4);
		$this->load->model('input_model', true);
		$results = $this->input_model->get_inputs_for_device($sender_id);
		print_r(json_encode($results));
	}
	else if ($id == "configuration"){
		$user_id = $this->uri->segment(4);
		$this->load->model('input_model', 'inputs');
		$results = $this->inputs->get_all_inputs_for_user($user_id);
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
		$username = $this->session->userdata('username');
		$user_id = $this->user->get_user_id($username);
		$user_id = $user_id[0]['user_id'];
		echo $user_id;
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

	public function add_incoming_to_message_table(){
		$user_id = $this->uri->segment(3);
		//$this->load->model('user_model','usr');
		//echo $user_id;
		//$sender_id = $this->usr->get_sender_id_for_user($user_id);
		//$sender_id = $sender_id[0]['sender_id'];
		$sender_id = $this->uri->segment(4);
		//echo $sender_id;
		$this->load->model('device_model', 'device');
		$results = $this->device->get_last_update_time($sender_id);
		$last_update_time = $results[0]['update_time'];
		$this->load->model('incoming_model', 'incoming');
		$command = $this->incoming->get_unadded_messages($last_update_time);
		//print_r($command);
		$last = count($command);
		for ($i=0; $i < $last; $i++){
			if ($command[$i]['command'] != "Ack"){
				$exploded_array = explode(",",$command[$i]['command']);
				$count = count($exploded_array);
				if ($exploded_array[0] == $sender_id){
					if ($count == 36){
						$message_data = array(
							'sender_id' => $exploded_array[0],
							'user_id' => $user_id,
							'datetime' => time(),
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
						$json = json_encode($message_data);
						print_r($json);
					 	$sender_id = $message_data['sender_id'];
					 	$this->load->model('device_model','device');
					 	$this->device->update_time($sender_id);	
					 	$this->load->model('data_model','data');
					 	$this->data->add_messagedata($message_data);
					 }
				}
			}
		}
		$message_data = "added incoming messages";
	}

	public function delete_incoming(){
		$this->load->model('incoming_model', true);
		$this->incoming_model->delete();
		$msg = "all incoming deleted!";
		print_r(json_encode($msg));
	}

}