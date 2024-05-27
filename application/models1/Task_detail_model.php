<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of Account
 *
 * @author THUSITHA
 */
Class Task_detail_model extends CI_Model {

    protected $table = 'task_details';

    public function __construct() {
        parent::__construct();

        $this->_database = $this->db;
        $this->_table = $this->table;
        
        
    }

    public function get_task_detail_count() {
        
        $this->db->where('deleted', '0');

        return $this->db->count_all_results('task');
    }

   public function get_task_detail_data() {

        $this->db->select('p.*,k.user_fname,c.contact_name,a.acc_name,u.user_fname as assign_to,s.name as td_subject, st.name as td_status');
        $this->db->from('task_details p');
        $this->db->join('contact c', 'p.contact_id=c.contact_id', 'left');
        $this->db->join('account a', 'p.acc_id=a.acc_id', 'left');
        $this->db->join('user u', 'p.assign_to=u.user_id', 'left');
        $this->db->join('user k', 'p.created_by=k.user_id', 'left');
        $this->db->join('subjects s', 'p.task_id=s.id', 'left');
        $this->db->join('status st', 'p.current_status=st.id', 'left');
        $this->db->where('p.deleted', '0');
        $query = $this->db->get();
        return $query->result();
        // return $this->get_all();
    }

    public function get_task_detail($td_id) {

        $this->db->select('task_details.*');
        $this->db->from('task_details');
        $this->db->where('td_id', $td_id);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function add_task_details() {
        $td_id = $this->input->post('td_id');
        $stime=$this->input->post('start_time');
        $start_time = date("G:i", strtotime($stime));
        $etime=$this->input->post('end_time');
        $end_time = date("G:i", strtotime($etime));
        $data = array(
            'task_id' => $this->input->post('task_id'),
            'acc_id' => $this->input->post('acc_id'),
            'product_id' => $this->input->post('product_id'),
            'start_date' => date('Y-m-d', strtotime($this->input->post('start_date'))),
            'start_time' => $start_time,
            'end_date' => date('Y-m-d', strtotime($this->input->post('end_date'))),
            'end_time' => $end_time,
            'assign_to' => $this->input->post('assign_to'),
            'contact_id' => $this->input->post('contact_id'),
            'current_status' => $this->input->post('current_status'),
            'description' => $this->input->post('description'),
        );
        $date = new DateTime();
        $date->setTimezone(new DateTimeZone('Asia/Colombo'));
        $fdate = $date->format('Y-m-d H:i:s'); 
        if ($td_id != 0) {
            $this->db->set('update_by', $this->session->userdata('user_id'));
            $this->db->set('update_date', $fdate);
            $this->db->where('td_id', $td_id);
            $this->db->update('task_details', $data);
            return TRUE;
        } else {
            $this->db->set('created_by', $this->session->userdata('user_id'));
            $this->db->set('created_date',$fdate);
            $this->db->insert('task_details', $data);
            return TRUE;
        }
    }

    function delete($td_id) {
        $date = new DateTime();
$date->setTimezone(new DateTimeZone('Asia/Colombo'));
$fdate = $date->format('Y-m-d H:i:s'); 
        $this->db->set('deleted', '1');
        $this->db->set('update_by', $this->session->userdata('user_id'));
        $this->db->set('update_date',$fdate);
        $this->db->where('td_id', $td_id);
        $this->db->update($this->table);
           return TRUE;
    }

   


}
