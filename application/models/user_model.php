<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

	public function does_username_exist($username){
		$this->db->where('username', $username);
		$q = $this->db->get('users');
		if ($q->num_rows > 0 ){
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function verify_user($data){
		$this->db->where('username', $data['username']);
		$this->db->where('password', $data['password']);
		//$this->db->limit(1);
		$q = $this->db->get('users');
		if($q->num_rows > 0){
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function get($username){

		if($username === null){
			$q = $this->db->get('users');
		} elseif(is_array($username)){
			$q = $this->db->get('users');
		} else {
			$this->db->where('username', $username);
			$q = $this->db->get('users');
		}
		return $q->result_array();
	}

	public function get_user($user_id){
		//print_r($user_id);
		$this->db->where('user_id', $user_id);
		$results = $this->db->get('users');
		return $results->result_array();
	}

	public function add($form_data){
		$this->db->insert('users',$form_data);
	}

	public function update($user_id, $data){
		//print_r($user_id);
		$this->db->where('user_id', $user_id);
		$this->db->update('users',$data);
	}
	
	public function delete($user_id){

		$this->db->where('user_id', $user_id);
		$this->db->delete('users');
	}

	public function login($username, $password){

		$this->db->where("username",$username);
		$this->db->where("password",$password);

		$query=$this->db->get("users");

		if($query->num_rows()>0)
		{
			foreach($query->result() as $rows)
			{
				$newdata = array(
					'user_id' => $rows->id,
					'user_name' => $rows->username,
					'user_email' => $rows->email,
					'logged_in' => TRUE,
					);
			}
			$this->session->set_userdata($newdata);

			return true;
		}
		return false;
	}

	public function insert_file($data){
		$this->db->insert('file', $data);
		return $this->db->insert_id();

	}

	public function get_all_users(){

		//$this->db->select('username');
		$query = $this->db->get('users');
		return $query->result_array();
	}

	public function get_all_users_information(){
		$results = $this->db->get('users');
		return $results->result_array();
	}

	public function get_user_id($username){

		$this->db->select('user_id');
		$this->db->where('username',$username);
		$query = $this->db->get('users', 1);
		return $query->result_array();
	}

	public function add_last_login($user_id){
		$data['last_login'] = time();
		$this->db->where('user_id', $user_id);
		$this->db->update('users', $data);
	}

	public function get_user_for_id($user_id){
		$this->db->where('user_id', $user_id);
		$results = $this->db->get('users');
		return $results->result_array();
	}

	public function get_sender_id_for_user($user_id){
		$this->db->select('sender_id');
		$this->db->where('user_id', $user_id);
		$result = $this->db->get('users');
		return $result->result_array();
	}

	public function log_time_email_sent($user_id){
		$this->db->select('last_email_sent');
		$this->db->where('user_id', $user_id);
		$time = time();
		$data['last_email_sent'] = $time;
		$this->db->update('users', $data);
	}

	// public function log_email_sent($user_id){
		
	// }

	public function update_user_with_sender_id($user_id, $sender_id){
		$this->db->where('user_id', $user_id);
		$data['sender_id'] = $sender_id;
		$this->db->update('users', $data);
	}

	public function get_password($user_id){
		$this->db->where('user_id', $user_id);
		$this->db->select('salt');
		$results = $this->db->get('users');
		return $results->result_array();
	}

	public function is_admin($user_id){
		$this->db->where('user_id',$user_id);
		$this->db->select('is_admin');
		$results = $this->db->get('users');
		return $results->result_array();
	}

	public function get_email_address($user_id){
		$this->db->select('email');
		$this->db->where('user_id',$user_id);
		$results = $this->db->get('users');
		return $results->result_array();
	}

	public function save_page_configuration($data){
		$this->db->where('user_id',$user_id);
		$this->db->update('users',$data);
	}
}

?>
		