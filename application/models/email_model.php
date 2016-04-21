<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email_model extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    function get(){
        $results = $this->db->get('email_log');
        return $results->result_array();
    }

    function add_email($data){
        $this->db->insert('email_log', $data);
    }

    function delete_email_for_user($user_id){
        $this->db->where('user_id',$user_id);
        $this->db->delete('email_log');
    }

    function get_emails_for_user($user_id){
        $this->db->where('user_id', $user_id);
        $this->db->order_by('time', 'desc');
        $results = $this->db->get('email_log');
        return $results->result_array();
    }

    function delete_all_emails(){
        $this->db->delete('email_log');
    }
}