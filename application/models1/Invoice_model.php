<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of Invoice
 *
 * @author THUSITHA
 */
Class Invoice_model extends CI_Model {

    protected $table = 'invoice';

    public function __construct() {
        parent::__construct();

        $this->_database = $this->db;
        $this->_table = $this->table;
        $this->load->model('code_generation_m');
        
    }

    public function get_invoice_count() {
        
        $this->db->where('deleted', '0');

        return $this->db->count_all_results('invoice');
    }
   public function get_invoice() {

        $this->db->select('p.*,k.user_fname');
        $this->db->from('invoice p');
        $this->db->join('user k', 'p.created_by=k.user_id', 'left');
       
        $this->db->where('p.deleted', '0');
        $query = $this->db->get();
        return $query->result();
        // return $this->get_all();
    }

    public function get_invoice_detail($inv_id) {

        $this->db->select('invoice.*');
        $this->db->from('invoice');
        $this->db->where('invoice_id', $inv_id);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function addInvoice() {

        $inv_id = $this->input->post('inv_id');
        $data = array(
            
            'acc_id' => $this->input->post('acc_id'),
            'contact_id' => $this->input->post('contact_id'),
            'month_fee' => $this->input->post('month_fee'),
            'ex_fee' => $this->input->post('ex_fee'),
            'st_fee' => $this->input->post('st_fee'),
            'tax' => $this->input->post('tax_amount'),
            'total' => $this->input->post('total'),
        );
        $date = new DateTime();
$date->setTimezone(new DateTimeZone('Asia/Colombo'));
$fdate = $date->format('Y-m-d H:i:s'); 
        if ($inv_id != 0) {
            $this->db->set('update_by', $this->session->userdata('user_id'));
            $this->db->set('update_date', $fdate);
            $this->db->where('inv_id', $inv_id);
            $this->db->update($this->table, $data);
            return $inv_id;
        } else {
            
            $code = $this->code_generation_m->getCode('INV');
            $this->db->set('inv_code', $code);
            $this->db->set('created_by', $this->session->userdata('user_id'));
            $this->db->set('created_date',$fdate);
            $this->db->set('invoice_date',$fdate);
            $this->db->set('invoice_time',$fdate);
            $this->db->insert($this->table, $data);
            $insert_id = $this->db->insert_id(); 
            $this->code_generation_m->updateCode('INV');
            
            return $insert_id;
        }
    }

    function delete($inv_id) {
        $date = new DateTime();
$date->setTimezone(new DateTimeZone('Asia/Colombo'));
$fdate = $date->format('Y-m-d H:i:s'); 
        $this->db->set('deleted', '1');
        $this->db->set('update_by', $this->session->userdata('user_id'));
        $this->db->set('update_date',$fdate);
        $this->db->where('inv_id', $inv_id);
        $this->db->update($this->table);
    }



 

}
