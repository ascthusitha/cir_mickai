<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of Account
 *
 * @author CHAMINDA
 */
Class Opportunity_model extends CI_Model {

    protected $table = 'opportunity';

    public function __construct() {
        parent::__construct();

        $this->_database = $this->db;
        $this->_table = $this->table;
        
        
    }

    public function get_task_detail_count() {
        
        $this->db->where('deleted', '0');

        return $this->db->count_all_results('task');
    }

   public function get_opportunities() {

        $this->db->select('p.*,k.user_fname as cr_user,c.contact_name,a.acc_name,u.user_fname as assign_to, st.sales_stage, ss.sales_stage as ss_next');
        $this->db->from('opportunity p');
        $this->db->join('contact c', 'p.contact_id=c.contact_id', 'left');
        $this->db->join('account a', 'p.acc_id=a.acc_id', 'left');
        $this->db->join('user u', 'p.assign_to=u.user_id', 'left');
        $this->db->join('user k', 'p.created_by=k.user_id', 'left');
        $this->db->join('sales_stage st', 'p.sales_stage=st.ss_id', 'left');
        $this->db->join('sales_stage ss', 'p.next_step=ss.ss_id', 'left');
        $this->db->where('p.deleted', '0');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_opportunity($opp_id) {

        $this->db->select('opportunity.*');
        $this->db->from('opportunity');
        $this->db->where('opp_id', $opp_id);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function add_opportunity() {

        $id = $this->input->post('opp_id');
        $data = array(
            'opp_name'      => $this->input->post('opp_name'),
            'acc_id'        => $this->input->post('acc_id'),
            'assign_date'   => date('Y-m-d', strtotime($this->input->post('assign_date'))),
            'expected_close'=> $this->input->post('expected_close'),
            'product_id1'   => $this->input->post('product_id1'),
            'product_id2'   => $this->input->post('product_id2'),
            'assign_to'     => $this->input->post('assign_to'),
            'contact_id'    => $this->input->post('contact_id'),
            'description'   => $this->input->post('description'),
            'probability'   => $this->input->post('opp_probability'),
            'sales_stage'   => $this->input->post('opp_sales_stage'),
            'ls_id'         => $this->input->post('opp_lead_source'),
            'next_step'     => $this->input->post('opp_next_step')
        );
        $date = new DateTime();
        $date->setTimezone(new DateTimeZone('Asia/Colombo'));
        $fdate = $date->format('Y-m-d H:i:s'); 
        if ($id != 0) {
            $this->db->set('update_by', $this->session->userdata('user_id'));
            $this->db->set('update_date', $fdate);
            $this->db->where('opp_id', $id);
            $this->db->update('opportunity', $data);
            return TRUE;
        } else {
            $this->db->set('created_by', $this->session->userdata('user_id'));
            $this->db->set('created_date',$fdate);
            $this->db->insert('opportunity', $data);
            return TRUE;
        }
    }

    function delete($id) {
        $date = new DateTime();
$date->setTimezone(new DateTimeZone('Asia/Colombo'));
$fdate = $date->format('Y-m-d H:i:s'); 
        $this->db->set('deleted', '1');
        $this->db->set('update_by', $this->session->userdata('user_id'));
        $this->db->set('update_date',$fdate);
        $this->db->where('opp_id', $id);
        $this->db->update($this->table);
           return TRUE;
    }

}
