<?php 

class Incoming_model extends CI_Model
{
	public function get_all_messages(){
		//$this->db->orderby('Datetime', 'desc');
		$results = $this->db->get('Incoming');
		return $results->result_array();
	}

	public function get_commands(){
		$this->db->select('command');
		$results = $this->db->get('Incoming');
		return $results->result_array();
	}
	public function get_unadded_messages($last_update){
		//$this->db->select('command');
		//$date = gmdate("Y-m-d G:i:s", $last_update);
		//$last_update_datestring = datetostring($last_update_datestring);
		$this->db->where('datetime >', $last_update);
		$results = $this->db->get('Incoming');
		//print_r($results);
		return $results->result_array();
	}
	public function delete(){
		$this->db->delete('incoming');
	}
	public function get_incoming_for_sender_id($sender_id){
		$this->db->select('command');
		$results = $this->db->get('Incoming');
		return $results->result_array();
	}
	public function delete_incoming_message($idx){
		$this->db->where('idx',$idx);
		$this->db->delete('incoming');
	}

	// public function get_commands_since_last_update($update){
	// 	$this->db->where('datatime')
	// }

}

?>