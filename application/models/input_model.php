<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Input_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function get_all_inputs(){
        $query = $this->db->get('inputs');
        return $query->result_array();
    }

    function get_all_inputs_for_user($user_id, $sender_id) {
        $this->db->where('user_id', $user_id);
        $this->db->where('sender_id',$sender_id);
        $this->db->order_by('input_id','asc');
        $inputs = $this->db->get('inputs');
        return $inputs->result_array();
    }

    function get_alarm_threshold($user_id){
        $this->db->where('user_id', $user_id);
        $threshold = $this->db->get('inputs');
        return $threshold->result_array();
    }

    function get_display_type($user_id){

        $this->db->select('type');
        $this->db->where('user_id', $user_id);
        $display_type = $this->db->get('inputs');

        $this->db->where('display_id', $display_type);
        $display_name = $this->db->get('display_types');
    }

    function set_input($data){
        $this->db->insert('inputs', $data);
    }

    function update_input($user_id, $sender_id, $input_id, $data){
        echo 'USERID' . $user_id;
        echo 'SENDERID' .$sender_id;
        echo 'INPUTID'.$input_id;
       print_r($data);
        $this->db->update('inputs', $data, array('user_id' => $user_id, 'sender_id' => $sender_id, 'input_id' => $input_id));
    }
    function get_inputs_for_sender_id($sender_id){
        $this->db->where('sender_id', $sender_id);
        $this->db->order_by('input_id','asc');
        $results = $this->db->get('inputs');
        return $results->result_array();
    }
    function turn_off($sender_id,$input_id){
        //echo '<b>in model turn_off</b>'.$input_id."<b>turning alarm 1 off</b>".$sender_id;
        $this->db->where('sender_id', $sender_id);
        $this->db->where('input_id', $input_id);
        $off = 0;
        $data['is_on'] = $off;
        $this->db->update('inputs', $data);
    }
        function turn_off2($sender_id,$input_id){
        //echo $input_id."turning alarm 2 off".$sender_id;
        $this->db->where('sender_id', $sender_id);
        $this->db->where('input_id', $input_id);
        $off = 0;
       $data['is_on2'] = $off;
        $this->db->update('inputs', $data);
    }
        function turn_off3($sender_id,$input_id){
       // echo $input_id."turning alarm 3 off".$sender_id;
        $this->db->where('sender_id', $sender_id);
        $this->db->where('input_id', $input_id);
        $off = 0;
        $data['is_on3'] = $off;
        $this->db->update('inputs', $data);
    }
        function turn_off4($sender_id,$input_id){
      //  echo $input_id."turning alarm 4 off".$sender_id;
        $this->db->where('sender_id', $sender_id);
        $this->db->where('input_id', $input_id);
        $off = 0;
        $data['is_on4'] = $off;
        $this->db->update('inputs', $data);
    }
    function turn_on($sender_id,$name){
       // echo $name."alarm 1 IS TURNED ON FOR " .$sender_id;
        $this->db->where('sender_id', $sender_id);
        $this->db->where('name', $name);
        $data = array(
            'is_on' => 1
            );
        $this->db->update('inputs', $data);
    }
    function turn_on2($sender_id,$name){
      //  echo $name."alarm 2 IS TURNED ON FOR " .$sender_id;
        $this->db->where('sender_id', $sender_id);
        $this->db->where('name', $name);
        $on = 1;
        $data['is_on2'] = $on;
        //echo 'data on' .$on;
        $this->db->update('inputs', $data);
    }
    function turn_on3($sender_id,$name){
       // echo $name."alarm 3 IS TURNED ON FOR " .$sender_id;
        $this->db->where('sender_id', $sender_id);
        $this->db->where('name', $name);
        $on = 1;
        $data['is_on3'] = $on;
        //echo 'data on' .$on;
        $this->db->update('inputs', $data);
    }
     function turn_on4($sender_id,$name){
      //  echo $name."alarm 4 IS TURNED ON FOR " .$sender_id;
        $this->db->where('sender_id', $sender_id);
        $this->db->where('name', $name);
        $on = 1;
        $data['is_on4'] = $on;
        //echo 'data on' .$on;
        $this->db->update('inputs', $data);
    }
    function add_default_configuration($name, $data){
        $data['name'] == $name;
        $this->db->insert('inputs', $data);
    }
    function add_input_for_device($data){
        //print_r($data);
        $this->db->insert($data);
    }
    function delete_inputs_for_user($user_id){
        $this->db->where('user_id', $user_id);
        $this->db->delete('inputs');
    }
     function delete_inputs_for_sender_id($sender_id){
        $this->db->where('sender_id', $sender_id);
        $this->db->delete('inputs');
    }
       function get_input_id_for_sender_id($name,$sender_id){
        //echo 'get input if for:' .$name;
        //$sender_id = '0000001';
        $this->db->where('sender_id',$sender_id);
        $this->db->where('name', $name);
        $this->db->select('input_id');
        $results = $this->db->get('inputs');
        return $results->result_array();
    }
    function get_inputs_for_datalogger_id($datalogger_id){
        $this->db->where('datalogger_id', $datalogger_id);
        $results = $this->db->get('inputs');
        return $results->result_array();
    }
    function get_inputs_for_user_id($user_id){
        $this->db->where('user_id', $user_id);
        $this->db->order_by('datalogger_id asc, input_id asc');
        $results = $this->db->get('inputs');
        return $results->result_array();
    }
    function verify_unique_sender_id($sender_id){
       //echo 'sender_id'. $sender_id;
        $this->db->where('sender_id',$sender_id);
        $results = $this->db->get('inputs');
       // echo 'results num rows'. $results->num_rows;
        if($results->num_rows > 0){
            return 0;
        } else {
            return 1;
        }
    }
    function save_number_of_alarms($user_id, $sender_id, $data){
        $this->db->where('sender_id', $sender_id, 'user_id', $user_id);
        $this->db->update('inputs',$data);
    }
    function get_row_numbers($user_id, $sender_id){
        $this->db->where('sender_id', $sender_id, 'user_id', $user_id);
        $this->db->select('number_of_alarms');
        $this->db->get('inputs');
    }
    function get_input($user_id, $sender_id, $name){
        $this->db->where('user_id',$user_id);
        $this->db->where('sender_id', $sender_id);
        $this->db->where('name', $name);
        $results = $this->db->get('inputs');
        return $results->result_array();
    }
    function email_sent($name, $sender_id, $user_id, $alarm_no){
        $this->db->where('user_id',$user_id);
        $this->db->where('sender_id',$sender_id);
        $this->db->where('name',$name);
        if ($alarm_no == 1){
            $data['email_sent1'] = 1;
        }
        if ($alarm_no == 2){
            $data['email_sent2'] = 1;
        }
        if ($alarm_no == 3){
            $data['email_sent3'] = 1;
        }
        if ($alarm_no == 4){
            $data['email_sent4'] = 1;
        }
        $this->db->update('inputs',$data);
    }
    function email_reset($name, $sender_id, $user_id, $alarm_no){
        $this->db->where('user_id',$user_id);
        $this->db->where('sender_id',$sender_id);
        $this->db->where('name',$name);
        if ($alarm_no == 1){
            $data['email_sent1'] = 0;
        }
        if ($alarm_no == 2){
            $data['email_sent2'] = 0;
        }
        if ($alarm_no == 3){
            $data['email_sent3'] = 0;
        }
        if ($alarm_no == 4){
            $data['email_sent4'] = 0;
        }
        $this->db->update('inputs',$data);
    }

    function get_inputs_for_senderid($user_id, $sender_id){
        $this->db->where('user_id',$user_id);
        $this->db->where('sender_id',$sender_id);
        $results = $this->db->get('inputs');
        return $results->result_array();
    }
}