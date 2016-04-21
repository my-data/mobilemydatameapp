<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_model extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

	public function get_data(){
		$query = $this->db->get('message_data');
		return $query->result_array();
	}

	public function add($data){
		$query = $this->db->insert('mydata', $data);
		return $query->result_array();
	}

	public function add_message_packet($data){
		$this->db->insert('mydata', $data);
		return; 
	}

	public function add_messagedata($message_data){
		print_r($message_data);
		$this->db->insert('message_data', $message_data);
		return;
	}

	public function delete_device($device_id){
		$this->db->where('ID', $device_id);
		$this->db->delete('mydata');
	}

	public function delete_messages_from_user($user_id){
		$this->db->where('User_ID', $user_id);
		$this->db->delete('message_data');
	}

	public function delete_message($message_id){
		$this->db->where('Message_ID', $message_id);
		$this->db->delete('message_data');
	}

	public function delete_messages_for_sender_id($sender_id){
		$this->db->where('sender_id', $sender_id);
		$this->db->delete('message_data');
	}

	public function get_labels($username){
		$this->db->where("username",$username);
		$query=$this->db->get('labels');
		return $query->result_array();
	}

	// public function get_chart_data($columns){
	// 	//$SenderID = "DS0027";
	// 	//$this->db->select($columns);
	// 	$this->db->where('Sender_ID', $SenderID);
	// 	$query = $this->db->get('message_data');		
	// 	return $query->result_array();
	// }

	public function get_digital_configuration($user_id){
		$columns = array('d_0','d_1','d_2','d_3','d_4','d_5','d_6','d_7');
		$this->db->select($columns);
		$this->db->where('user_id', $user_id);
		$this->db->limit(1);
		$query = $this->db->get('message_data');
		return $query->result_array();
	}

	public function get_user_email_list($company){
		$this->db->where('companyname', $company);
		$query = $this->db->get('users');
		return $query->result_array();
	}

	public function get_user_info($user_id){
		$this->db->where('user_id', $user_id);
		$query = $this->db->get('users');
		return $query->result_array();
	}

	public function get_messages_for_user($user_id){
		$this->db->order_by('datetime', 'desc');
		$query = $this->db->get_where('message_data', array('User_ID' => $user_id));
		return $query->result_array();
	}

	public function get_last_message_time(){
		$this->db->select('datetime');
		$this->db->order_by('datetime', 'DESC');
		$result = $this->db->get('message_data');
		return $result->result_array();
	}

	public function get_last_message(){
		$this->db->order_by('datetime','desc');
		$query = $this->db->get('message_data', 1);
		return $query->result_array();
	}

	public function get_last_message_for_sender_id($sender_id){
		//echo $sender_id;
		$this->db->where('sender_id', $sender_id);
		$this->db->limit(1);
		$this->db->order_by('datetime', 'desc');
		$results = $this->db->get('message_data');
		//print_r($results);
		return $results->result_array();
	}

	public function get_last_datestring(){
		$this->db->order_by('datestring','desc');
		$this->db->limit(1);
		$results = $this->db->get('message_data',1);
		return $results->result_array();
	}

	public function get_all_messages(){
		$results = $this->db->get('message_data');
		return $results->result_array();
	}
	public function get_a_0_timeseries($sender_id){
		$this->db->select(array('datetime', 'A0'));
		$this->db->where('sender_id', $sender_id);
		$results = $this->db->get('message_data');
		return $results->result_array();
	}
	public function get_a_1_timeseries($sender_id){
		$this->db->select(array('datetime', 'A1'));
		$this->db->where('sender_id', $sender_id);
		$results = $this->db->get('message_data');
		return $results->result_array();
	}
	public function get_a_2_timeseries($sender_id){
		$this->db->select(array('datetime', 'A2'));
		$this->db->where('sender_id', $sender_id);
		$results = $this->db->get('message_data');
		return $results->result_array();
	}
	public function get_a_3_timeseries($sender_id){
		$this->db->select(array('datetime', 'A3'));
		$this->db->where('sender_id', $sender_id);
		$results = $this->db->get('message_data');
		return $results->result_array();
	}
	public function get_a_4_timeseries($sender_id){
		$this->db->select(array('datetime', 'A4'));
		$this->db->where('sender_id', $sender_id);
		$results = $this->db->get('message_data');
		return $results->result_array();
	}
	public function get_a_5_timeseries($sender_id){
		$this->db->select(array('datetime', 'A5'));
		$this->db->where('sender_id', $sender_id);
		$results = $this->db->get('message_data');
		return $results->result_array();
	}
	public function get_a_6_timeseries($sender_id){
		$this->db->select(array('datetime', 'A6'));
		$this->db->where('sender_id', $sender_id);
		$results = $this->db->get('message_data');
		return $results->result_array();
	}
	public function get_a_7_timeseries($sender_id){
		$this->db->select(array('datetime', 'A7'));
		$this->db->where('sender_id', $sender_id);
		$results = $this->db->get('message_data');
		return $results->result_array();
	}
	public function get_a_8_timeseries($sender_id){
		$this->db->select(array('datetime', 'A8'));
		$this->db->where('sender_id', $sender_id);
		$results = $this->db->get('message_data');
		return $results->result_array();
	}
	public function get_a_9_timeseries($sender_id){
		$this->db->select(array('datetime', 'A9'));
		$this->db->where('sender_id', $sender_id);
		$results = $this->db->get('message_data');
		return $results->result_array();
	}
	public function get_a_10_timeseries($sender_id){
		$this->db->select(array('datetime', 'A10'));
		$this->db->where('sender_id', $sender_id);
		$results = $this->db->get('message_data');
		return $results->result_array();
	}
	public function get_a_11_timeseries($sender_id){
		$this->db->select(array('datetime', 'A11'));
		$this->db->where('sender_id', $sender_id);
		$results = $this->db->get('message_data');
		return $results->result_array();
	}
	public function get_a_12_timeseries($sender_id){
		$this->db->select(array('datetime', 'A12'));
		$this->db->where('sender_id', $sender_id);
		$results = $this->db->get('message_data');
		return $results->result_array();
	}
	public function get_a_13_timeseries($sender_id){
		$this->db->select(array('datetime', 'A13'));
		$this->db->where('sender_id', $sender_id);
		$results = $this->db->get('message_data');
		return $results->result_array();
	}
	public function get_a_14_timeseries($sender_id){
		$this->db->select(array('datetime', 'A14'));
		$this->db->where('sender_id', $sender_id);
		$results = $this->db->get('message_data');
		return $results->result_array();
	}
	public function get_a_15_timeseries($sender_id){
		$this->db->select(array('datetime', 'A15'));
		$this->db->where('sender_id', $sender_id);
		$results = $this->db->get('message_data');
		return $results->result_array();
	}
	public function get_a_16_timeseries($sender_id){
		$this->db->select(array('datetime', 'A16'));
		$this->db->where('sender_id', $sender_id);
		$results = $this->db->get('message_data');
		return $results->result_array();
	}
	public function get_a_17_timeseries($sender_id){
		$this->db->select(array('datetime', 'A17'));
		$this->db->where('sender_id', $sender_id);
		$results = $this->db->get('message_data');
		return $results->result_array();
	}
	public function get_a_18_timeseries($sender_id){
		$this->db->select(array('datetime', 'A18'));
		$this->db->where('sender_id', $sender_id);
		$results = $this->db->get('message_data');
		return $results->result_array();
	}
	public function get_a_19_timeseries($sender_id){
		$this->db->select(array('datetime', 'A19'));
		$this->db->where('sender_id', $sender_id);
		$results = $this->db->get('message_data');
		return $results->result_array();
	}
	public function update_digital($message_id, $data){
		$this->db->where('message_id',$message_id);
		$this->db->update('message_data', $data);
	}
	public function delete_messages_from_user_device($user_id, $datalogger_id){
		$this->db->where('user_id', $user_id);
		$this->db->where('datalogger_id', $datalogger_id);
		$this->db->delete('message_data');
	}
	public function get_messages_for_user_and_datalogger($user_id, $datalogger_id){
		$this->db->where('user_id', $user_id);
		$this->db->where('datalogger_id', $user_id);
		$results = $this->db->get('message_data');
		return $results->result_array();
	}
	public function get_messages_for_userid_and_senderid($user_id, $sender_id){
		$this->db->where('user_id', $user_id);
		$this->db->where('sender_id', $sender_id);
		$results = $this->db->get('message_data');
		return $results->result_array();
	}
	public function get_messages_for_senderid($sender_id){
		$this->db->where('sender_id', $sender_id);
		$results = $this->db->get('message_data');
		return $results->result_array();
	}
	public function delete_messages_for_sender_id_and_user_id($sender_id, $user_id){
		//echo $sender_id;
		//print_r($user_id);
		$this->db->where('sender_id', $sender_id);
		$this->db->where('user_id', $user_id);
		$this->db->delete('message_data');
	}
}

?>
		