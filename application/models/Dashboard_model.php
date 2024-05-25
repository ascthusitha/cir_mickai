<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of Account
 *
 * @author CHAMINDA
 */
Class Dashboard_model extends CI_Model {

    public $table_phone_call	= 'phone_call';
    public $table_sales_call	= 'sales_call';
    public $table_task_details	= 'task_details';
    public $table_opportunity	= 'opportunity';

    public function __construct() {
        parent::__construct();

        $this->table_phone_call		= $this->table_phone_call;
        $this->table_sales_call		= $this->table_sales_call;
        $this->table_task_details	= $this->table_task_details;
        $this->table_opportunity	= $this->table_opportunity;
    }

    public function get_phone_calls_count() {
//        $this->db->where('assign_to', '0');
$this->db->where('deleted', '0');
        return $this->db->count_all_results($this->table_phone_call);
    }

    public function get_sales_calls_count() {
        $this->db->where('deleted', '0');
        return $this->db->count_all_results($this->table_sales_call);
    }

    public function get_tasks_count() {
        $this->db->where('deleted', '0');
        return $this->db->count_all_results($this->table_task_details);
    }

    public function get_opportunities_count() {
        $this->db->where('deleted', '0');
        return $this->db->count_all_results($this->table_opportunity);
    }

    public function get_phone_calls($id=0) {
        $id=$this->session->userdata('user_id');
        $table1 = $this->table_phone_call;
        $this->db->select('a.subject');
        $this->db->from($table1.' a');
        $this->db->where('a.assign_to', $id);
        $this->db->order_by("a.pc_id ", "desc");
        $this->db->limit(5,0);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;        
    }

    public function get_sales_calls($id=0) {
        $id=$this->session->userdata('user_id');
        $table1 = $this->table_sales_call;
        $this->db->select('a.subject');
        $this->db->from($table1.' a');
        $this->db->where('a.assign_to', $id);
        $this->db->order_by("a.sc_id ", "desc");
        $this->db->limit(5,0);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;        
    }
        
    public function get_tasks($id=0) {
        $id=$this->session->userdata('user_id');
        $table1 = $this->table_task_details;
        $this->db->select('a.product_id');
        $this->db->from($table1.' a');
        $this->db->where('a.assign_to', $id);
        $this->db->order_by("a.td_id ", "desc");
        $this->db->limit(5,0);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;        
    }

    public function get_opportunities($id=0) {
        $id=$this->session->userdata('user_id');
        $table1 = $this->table_opportunity;
        $this->db->select('a.opp_name');
        $this->db->from($table1.' a');
        $this->db->where('a.assign_to', $id);
        $this->db->order_by("a.opp_id ", "desc");
        $this->db->limit(5,0);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;        
    }

}
