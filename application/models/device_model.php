<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Device_model extends CI_Model {

	public function add($data){
		$this->db->insert('devices',$data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
	public function delete_device($device_id){
		$this->db->where('datalogger_id', $device_id);
		$this->db->delete('devices');
	}
	public function configure_digital_inputs($data){
		$this->db->where('device_id', $data['device_id']);
		$this->db->get('devices',$data);
	}
	public function add_labels($data){
		$q = $this->db->insert('labels',$data);
		return $q;
	}
	public function add_max_value($data){
		$q = $this->db->insert('max_value',$data);
	return $q;
	}
	public function add_SI_units($data){
		$q = $this->db->insert('si_units',$data);
	return $q;
	}
	public function add_is_display($data){
		$q = $this->db->insert('si_units',$data);
	return $q;
	}
	public function read_is_display($data){
		$q = $this->db->get('si_units',$data);
	return $q;
	}
	public function get_device_for_user($user_id){
		$this->db->where('user_id', $user_id);
		$results = $this->db->get('devices');
		return $results->result_array();
	}
	public function get_device_for_sender_id($sender_id){
		$this->db->where('sender_id', $sender_id);
		$results=$this->db->get('devices');
		return $results->result_array();
	}
	public function update_device_for_sender_id($sender_id, $data){
		$this->db->where('sender_id', $sender_id);
		$this->db->update('devices', $data);
	}
	public function delete_device_for_sender_id($sender_id){
		$this->db->where('sender_id', $sender_id);
		$this->db->delete('devices');
	}
	public function update_time($sender_id){
		$this->db->where('sender_id', $sender_id);
		//$this->db->select('update_time');
		$now = time();
		$data['update_time'] = $now;
		$data['update_time_string'] = gmdate("Y-m-d H:i:s", $now);
		$this->db->update('devices', $data);
	}
	public function get_last_update_time($sender_id){
		$this->db->where('sender_id', $sender_id);
		$this->db->select('update_time');
		$results = $this->db->get('devices');
		return $results->result_array();
	}
	public function get_machinename_for_sender_id($sender_id){
		$this->db->where('sender_id', $sender_id);
		$this->db->select('machine_name');
		$results = $this->db->get('devices');
		return $results->result_array();
	}
		public function get_user_id_for_datalogger_id($datalogger_id){
		$this->db->where('datalogger_id', $datalogger_id);
		$this->db->select('user_id');
		$results = $this->db->get('devices');
		return $results->result_array();
	}
	public function get_dataloggerid_for_senderid($sender_id){
		$this->db->where('sender_id', $sender_id);
		$this->db->select('datalogger_id');
		$results = $this->db->get('devices');
		return $results->result_array();
	}
	public function verify_unique_sender_id($sender_id){
		//echo 'sender_id'. $sender_id;
		$this->db->where('sender_id',$sender_id);
		$results = $this->db->get('devices');
		//echo 'results'. $results;
		if($results->num_rows > 0){
			return 0;
		} else {
			return 1;
		}
	}
	public function get_datalogger_id_for_machine_name($machine_name){
		$this->db->where('machine_name', $machine_name);
		$this->db->select('datalogger_id');
		$results = $this->db->get('devices');
		return $results->result_array();
	}
	public function get_number_of_devices_for_user($user_id){
		$this->db->where('user_id', $user_id);
		$results = $this->db->get('devices');
		return $results->num_rows;
	}
	public function get_sender_id_for_user($user_id){
		$this->db->where('user_id',$user_id);
		$this->db->select('sender_id');
		$this->db->limit(1);
		$results = $this->db->get('devices');
		return $results->result_array();
	}
	public function update_email_sent_time($sender_id){
		$this->db->where('sender_id', $sender_id);
		$timestamp = time();
		$data['last_email_sent'] = $timestamp;
		$data['email_sent_timestamp'] = gmdate("Y-m-d H:i:s", $timestamp);
		$this->db->update('devices', $data);
	}
	public function get_user_id_for_sender_id($sender_id){
		$this->db->where('sender_id', $sender_id);
		$this->db->select('user_id');
		$results = $this->db->get('devices');
		return $results->result_array();
	}
	public function delete_where_user_id($user_id){
		$this->db->where('user_id',$user_id);
		$this->db->delete('devices');
	}
}

?>
		