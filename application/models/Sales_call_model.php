<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of Account
 *
 * @author THUSITHA
 */
Class Sales_call_model extends CI_Model {

    protected $table = 'sales_call';

    public function __construct() {
        parent::__construct();

        $this->_database = $this->db;
        $this->_table = $this->table;
        $this->load->model('code_generation_m');
        
    }

    public function get_sales_call_count() {
        
        $this->db->where('deleted', '0');

        return $this->db->count_all_results('sales_call');
    }
   public function get_sales_call() {

        $this->db->select('p.*,k.user_fname,c.contact_name,a.acc_name,u.user_fname as assign_to');
        $this->db->from('sales_call p');
        $this->db->join('contact c', 'p.contact_id=c.contact_id', 'left');
        $this->db->join('account a', 'p.acc_id=a.acc_id', 'left');
        $this->db->join('user u', 'p.assign_to=u.user_id', 'left');
        $this->db->join('user k', 'p.created_by=k.user_id', 'left');
        $this->db->where('p.deleted', '0');
        $query = $this->db->get();
        return $query->result();
        // return $this->get_all();
    }

    public function get_sales_call_detail($sc_id) {

        $this->db->select('sales_call.*');
        $this->db->from('sales_call');
        $this->db->where('sc_id', $sc_id);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function add_sales_call() {

        $sc_id = $this->input->post('sc_id');
        $data = array(
            
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
        if ($sc_id != 0) {
            $this->db->set('update_by', $this->session->userdata('user_id'));
            $this->db->set('update_date', $fdate);
            $this->db->where('sc_id', $sc_id);
            $this->db->update($this->table, $data);
            return TRUE;
        } else {
            
            
            $this->db->set('created_by', $this->session->userdata('user_id'));
            $this->db->set('created_date',$fdate);
            $this->db->insert($this->table, $data);
           

            return TRUE;
        }
    }

    function delete($sc_id) {
        $date = new DateTime();
$date->setTimezone(new DateTimeZone('Asia/Colombo'));
$fdate = $date->format('Y-m-d H:i:s'); 
        $this->db->set('deleted', '1');
        $this->db->set('update_by', $this->session->userdata('user_id'));
        $this->db->set('update_date',$fdate);
        $this->db->where('sc_id', $sc_id);
        $this->db->update($this->table);
           return TRUE;
    }

   


}
