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

        $this->db->select('p.*,k.user_fname,c.contact_name,a.acc_name,u.user_fname as assign_to');
        $this->db->from('task_details p');
        $this->db->join('contact c', 'p.contact_id=c.contact_id', 'left');
        $this->db->join('account a', 'p.acc_id=a.acc_id', 'left');
        $this->db->join('user u', 'p.assign_to=u.user_id', 'left');
        $this->db->join('user k', 'p.created_by=k.user_id', 'left');
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
        $data = array(
            'task_id' => $this->input->post('task_id'),
            'subject' => $this->input->post('subject'),
            'acc_id' => $this->input->post('acc_id'),
            'start_date' => date('Y-m-d', strtotime($this->input->post('start_date'))),
            'start_time' => $this->input->post('start_time'),
            'product_id1' => $this->input->post('product1'),
            'product_id2' => $this->input->post('product2'),
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

   public function delete($td_id) {
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

      public function get_task_dropdown() {
        $cusarray = array();
        $this->db->select('td_id,task_id');
        $this->db->where('deleted', '0');
               $this->db->order_by('task_id', 'ASC');
        $query = $this->db->get('task_details');
        $cusarray[' '] = '-- Select --';
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $cusarray[$row->td_id] = $row->task_id;
            }
        }
        return $cusarray;
    }
  public function get_alert_data($today, $type)
    {

        $this->db->select('p.*,k.user_fname,c.contact_name,c.contact_id,c.contact_lname,a.acc_name,u.user_fname as assign_to,s.name as td_subject, st.name as td_status,c.email as email,c.mobile as mobile');
        $this->db->from('task_details p');
        $this->db->join('contact c', 'p.contact_id=c.contact_id', 'left');
        $this->db->join('account a', 'p.acc_id=a.acc_id', 'left');
        $this->db->join('user u', 'p.assign_to=u.user_id', 'left');
        $this->db->join('user k', 'p.created_by=k.user_id', 'left');
        $this->db->join('subjects s', 'p.task_id=s.id', 'left');
        $this->db->join('status st', 'p.current_status=st.id', 'left');
        $this->db->where('p.deleted', '0');
        $this->db->where('p.task_id', $type);
        $this->db->where('p.day_7', $today);
        $this->db->or_where('p.day_2', $today);
        
        $query = $this->db->get();
        return $query->result();
        // return $this->get_all();

    }
        function call_update($td_id)
    {
        $date = new DateTime();

        $fdate = $date->format('Y-m-d H:i:s');
        $call_time = date("G:i", strtotime($fdate));
        $this->db->set('call_status', '1');
        $this->db->set('call_date', $fdate);
        $this->db->set('call_time', $call_time);
        $this->db->set('update_by', $this->session->userdata('user_id'));
        $this->db->set('update_date', $fdate);
        $this->db->where('td_id', $td_id);
        $this->db->update($this->table);
        return TRUE;
    }

}
