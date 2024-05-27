<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of Account
 *
 * @author Chaminda
 */
Class Time_sheet_model extends CI_Model {

    protected $table = 'time_sheet';

    public function __construct() {
        parent::__construct();

        $this->_database = $this->db;
        $this->_table = $this->table;
        
        
    }

    public function get_time_sheets_count() {
        
        $this->db->where('deleted', '0');

        return $this->db->count_all_results('time_sheet');
    }

   public function get_time_sheets() {

        $this->db->select('p.*,k.user_fname,c.contact_name,a.acc_name,u.user_fname as assign_to,s.name AS cstat,pr.name AS product');
        $this->db->from('time_sheet p');
        $this->db->join('contact c', 'p.contact_id=c.contact_id', 'left');
        $this->db->join('account a', 'p.acc_id=a.acc_id', 'left');
        $this->db->join('user u', 'p.assign_to=u.user_id', 'left');
        $this->db->join('user k', 'p.created_by=k.user_id', 'left');
        $this->db->join('status s', 'p.current_status=s.id', 'left');
        $this->db->join('products pr', 'p.product_id=pr.id', 'left');
        $this->db->where('p.deleted', '0');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_time_sheet($ts_id) {
        $this->db->select('time_sheet.*');
        $this->db->from('time_sheet');
        $this->db->where('ts_id', $ts_id);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_time_tracker($ts_id) {
        $this->db->select('tt.*,u.user_fname AS ufname,u.user_lname AS ulname');
        $this->db->from('time_tracker tt');
        $this->db->join('user u', 'tt.user_id=u.user_id', 'left');
        $this->db->where('ts_id', $ts_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function add_time_sheet() {
        $ts_id = $this->input->post('ts_id');
        $data = array(
            'task_id' => $this->input->post('task_id'),
            'ts_name' => $this->input->post('ts_name'),
            'acc_id' => $this->input->post('acc_id'),
            'product_id' => $this->input->post('product_id'),
            'start_date' => date('Y-m-d', strtotime($this->input->post('start_date'))),
            'start_time' => $this->input->post('start_time'),
            'end_date' => date('Y-m-d', strtotime($this->input->post('end_date'))),
            'end_time' => $this->input->post('end_time'),
            'progress' => $this->input->post('progress'),
            'assign_to' => $this->input->post('assign_to'),
            'contact_id' => $this->input->post('contact_id'),
            'current_status' => $this->input->post('current_status'),
            'description' => $this->input->post('description'),
        );
        $date = new DateTime();
        $date->setTimezone(new DateTimeZone('Asia/Colombo'));
        $fdate = $date->format('Y-m-d H:i:s'); 
        if ($ts_id != 0) {
            $this->db->set('update_by', $this->session->userdata('user_id'));
            $this->db->set('update_date', $fdate);
            $this->db->where('ts_id', $ts_id);
            $this->db->update('time_sheet', $data);
            return $ts_id;
        } else {
            $this->db->set('created_by', $this->session->userdata('user_id'));
            $this->db->set('created_date',$fdate);
            $this->db->insert('time_sheet', $data);
            return $this->db->insert_id();
        }
    }

    function start_time($ts_id) {
        $user_id = $this->session->userdata('user_id');
        $date = new DateTime();
        $date->setTimezone(new DateTimeZone('Asia/Colombo'));
        $fdate = $date->format('Y-m-d H:i:s');
        $tt_id = $this->add_timer($ts_id,$fdate,'',0,$user_id);
        $this->db->set('timer', $tt_id);
        $this->db->set('timer_started', $fdate);
        $this->db->set('update_by', $user_id);
        $this->db->set('update_date',$fdate);
        $this->db->where('ts_id', $ts_id);
        $this->db->update($this->table);
        return $tt_id;
    }

    function stop_time($ts_id,$tt_id,$hours,$min,$sec) {
        $date = new DateTime();
        $date->setTimezone(new DateTimeZone('Asia/Colombo'));
        $fdate = $date->format('Y-m-d H:i:s');
        $this->stop_timer($tt_id,$fdate);
        $this->db->set('timer', 0);
        $this->db->set('timer_h', $hours);
        $this->db->set('timer_m', $min);
        $this->db->set('timer_s', $sec);
        $this->db->set('update_by', $this->session->userdata('user_id'));
        $this->db->set('update_date',$fdate);
        $this->db->where('ts_id', $ts_id);
        $this->db->update($this->table);
        return TRUE;
    }

    function add_manual_time($ts_id,$start,$end,$source,$hours,$min,$sec) {
        $user_id = $this->session->userdata('user_id');
        $res = $this->add_timer($ts_id,$start,$end,$source,$user_id);

        $date = new DateTime();
        $date->setTimezone(new DateTimeZone('Asia/Colombo'));
        $fdate = $date->format('Y-m-d H:i:s');
        $this->db->set('timer', 0);
        $this->db->set('timer_h', $hours);
        $this->db->set('timer_m', $min);
        $this->db->set('timer_s', $sec);
        $this->db->set('update_by', $user_id);
        $this->db->set('update_date',$fdate);
        $this->db->where('ts_id', $ts_id);
        $this->db->update($this->table);
        return $res;
    }

    Private function add_timer($ts_id,$start,$end='',$source=0,$user_id){
        $this->db->set('ts_id', $ts_id);
        $this->db->set('start',$start);
        if($end){ $this->db->set('end',$end); }
        $this->db->set('source',$source);
        $this->db->set('user_id',$user_id);
        $this->db->insert('time_tracker');
        return $this->db->insert_id();
    }

    Private function stop_timer($tt_id,$end){
        $this->db->set('end',$end);
        $this->db->where('id', $tt_id);
        $this->db->update('time_tracker');
    }

    function delete($ts_id) {
        $date = new DateTime();
        $date->setTimezone(new DateTimeZone('Asia/Colombo'));
        $fdate = $date->format('Y-m-d H:i:s'); 
        $this->db->set('deleted', '1');
        $this->db->set('update_by', $this->session->userdata('user_id'));
        $this->db->set('update_date',$fdate);
        $this->db->where('ts_id', $ts_id);
        $this->db->update($this->table);
           return TRUE;
    }

}
