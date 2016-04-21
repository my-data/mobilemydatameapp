<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Alarm_model extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function get_alarm($user_id){
        $query = $this->db->get('alarm_email',array('user_id' =>$user_id));
        return $query->result_array();
    }
    function get_alarm_user_sender($sender_id, $user_id){
        $this->db->where('sender_id', $sender_id);
        $this->db->where('user_id', $user_id);
        $results = $this->db->get('alarm_email');
       // print_r($results);
        return $results->result_array();
    }

    function add_alarm($data){
        $this->db->insert('alarm_email', $data);
    }

    function update_alarm($alarm_id, $data){
        $this->db->where('alarm_id', $alarm_id);
        $this->db->update('alarm_email', $data);
    }
    function delete_alarm($name, $sender_id, $user_id, $alarm_no){
        $this->db->where('alarm_name', $name);
        $this->db->where('alarm_number', $alarm_no);
        $this->db->where('sender_id',$sender_id);
        $this->db->where('user_id', $user_id);
        $this->db->delete('alarm_email');
    }
    function get_alarmid_with_userid($user_id){
        $this->db->where('User_id', $user_id);
        $this->db->select('alarm_id');
        $alarm_ID = $this->db->get('alarm_email');
        return $alarm_ID;
    }
    function get_email_details($alarm_id){
        $this->db->where('alarm_ID', $alarm_id);
        $this->db->select('subject, email_address, message, email2');
        $email = $this->db->get('alarm_email', 1);
        return $email->result_array();
    }
    function update_alarm_using_sender_id($name, $sender_id, $data, $number){
        $this->db->where('alarm_name',$name);
        $this->db->where('alarm_number',$number);
        $this->db->where('sender_id',$sender_id);
        $this->db->update('alarm_email', $data);
        //return $results->result_array();
    }
    function update_email_sent($alarm_id){
        $this->db->where('alarm_id', $alarm_id);
        $data['alarm_sent'] = time();
        $this->db->update('alarm_email', $data);
    }

    function get_email_for_alarm($user_id, $sender_id, $name, $alarm_no){
        $this->db->where('user_id',$user_id);
        $this->db->where('sender_id',$sender_id);
        $this->db->where('alarm_name',$name);
        $this->db->where('alarm_number',$alarm_no);
        $results = $this->db->get('alarm_email');
        return $results->result_array();
    }

    function verify_unqiue_alarm($name, $sender_id, $user_id, $number){
        $this->db->where('user_id',$user_id);
        $this->db->where('sender_id',$sender_id);
        $this->db->where('alarm_name',$name);
        $this->db->where('alarm_number',$number);
        $results = $this->db->get('alarm_email');
        if ($results->num_rows() == 0){
            return true;
        } else {
            return false;
        }
        //return $results->result_array();
    }
}