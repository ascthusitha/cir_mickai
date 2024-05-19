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
    public $table_subjects		= 'subjects';
    public $table_contacts		= 'contact';
    public $table_accounts		= 'account';
    public $table_status		= 'status';

    public function __construct() {
        parent::__construct();

        $this->table_phone_call		= $this->table_phone_call;
        $this->table_sales_call		= $this->table_sales_call;
        $this->table_task_details	= $this->table_task_details;
        $this->table_opportunity	= $this->table_opportunity;
        $this->table_subjects		= $this->table_subjects;
        $this->table_contacts		= $this->table_contacts;
        $this->table_accounts		= $this->table_accounts;
        $this->table_status			= $this->table_status;
    }

    public function get_phone_calls_count() {
//        $this->db->where('assign_to', '0');
        return $this->db->count_all_results($this->table_phone_call);
    }

    public function get_sales_calls_count() {
        return $this->db->count_all_results($this->table_sales_call);
    }

    public function get_tasks_count() {
        return $this->db->count_all_results($this->table_task_details);
    }

    public function get_opportunities_count() {
        return $this->db->count_all_results($this->table_opportunity);
    }

    public function get_phone_calls($id=0) {
        $table1 = $this->table_phone_call;
        $table2 = $this->table_subjects;
        $table3 = $this->table_contacts;
        
        $this->db->select('a.pc_id, b.name as subject, c.contact_name');
        $this->db->from($table1.' a');
        $this->db->join($table2.' b', 'b.id=a.subject', 'left');
        $this->db->join($table3.' c', 'c.contact_id=a.contact_id', 'left');
        $this->db->where('a.assign_to', $id);
        $this->db->order_by("a.pc_id ", "desc");
        $this->db->limit(5,0);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function get_sales_calls($id=0) {
        $table1 = $this->table_sales_call;
        $table2 = $this->table_subjects;
        $table3 = $this->table_contacts;

        $this->db->select('a.sc_id, b.name as subject, c.contact_name');
        $this->db->from($table1.' a');
        $this->db->join($table2.' b', 'b.id=a.subject', 'left');
        $this->db->join($table3.' c', 'c.contact_id=a.contact_id', 'left');
        $this->db->where('a.assign_to', $id);
        $this->db->order_by("a.sc_id ", "desc");
        $this->db->limit(5,0);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;        
    }
        
    public function get_tasks($id=0) {
        $table1 = $this->table_task_details;
        $table2 = $this->table_subjects;
        $table3 = $this->table_accounts;

        $this->db->select('a.td_id, b.name as subject, c.acc_name');
        $this->db->from($table1.' a');
        $this->db->join($table2.' b', 'b.id=a.task_id', 'left');
        $this->db->join($table3.' c', 'c.acc_id=a.acc_id', 'left');
        $this->db->where('a.assign_to', $id);
        $this->db->order_by("a.td_id ", "desc");
        $this->db->limit(5,0);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;        
    }

    public function get_opportunities($id=0) {
        $table1 = $this->table_opportunity;
        $table2 = $this->table_status;

        $this->db->select('a.opp_id, a.opp_name, b.name as sales_stage');
        $this->db->from($table1.' a');
        $this->db->join($table2.' b', 'b.id=a.sales_stage', 'left');
        $this->db->where('a.assign_to', $id);
        $this->db->order_by("a.opp_id ", "desc");
        $this->db->limit(5,0);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;        
    }

}
