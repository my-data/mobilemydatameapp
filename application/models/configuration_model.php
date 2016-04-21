<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Configuration_model extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_last_configuration(){
        $query = $this->db->order_by('configuration_id','desc')->limit(1)->get('configuration');
        return $query->result_array();
    }

    function get_configuration_for_user_id($user_id){
        $this->db->where('user_id',$user_id);
        $query = $this->db->get('configuration');
        return $query->result_array();
    }
    function get_configuration_for_sender_id($sender_id){
        $this->db->where('sender_id',$sender_id);
        $query = $this->db->get('configuration');
        return $query->result_array();
    }
    function add_configuration($data){
        $this->db->insert('configuration', $data);
    }

    function update_configuration($config_id, $data){
        $this->db->where('configuration_id', $config_id);
        $this->db->update('configuration', $data); 
    }

    function delete_configuration($config_id){
        $this->db->where('configuration_id', $config_id);
        $this->db->delete('configuration'); 
    }

    function save_page_configuration($data){
        $this->db->where('user_id',$data['user_id']);
        $this->db->where('sender_id',$data['sender_id']);
        $this->db->update('configuration',$data);
    }

    function add_analogue_labels($data){
        $this->db->insert('analogues', $data); 
    }

    function add_counter_labels($data){
        $this->db->insert('counters', $data); 
    }

    function add_digital_labels($data){
        $this->db->insert('digitals', $data); 
    }

    function get_last_update_time(){
        $this->db->select('last_update_time');
        $this->db->order_by("last_update_time", "desc"); 
        $this->db->limit(1);
        $results = $this->db->get('configuration');
        return $results->result_array();
    }

    function update_time(){
        $time = time();
        $data['last_update_time'] = $time;
        $this->db->insert('configuration', $data);
    }

}