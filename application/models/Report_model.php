<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Report_Model
 *
 * This model represents all the Administration Reports. It operates the following tables:
 * - stock_entry,
 * - 
 * @author CHAMINDA
 */
class Report_Model extends CI_Model {
    private $table_sales_call	= 'sales_call';		// sales_call
	private $table_phone_call	= 'phone_call';		// phone_call
	private $table_task_details	= 'task_details';	// task_details
	private $table_opportunity	= 'opportunity';	// opportunity
        
	private $table_contact		= 'contact';		// contact
	private $table_account		= 'account';		// account
	private $table_user			= 'user';		// user
    
    function __construct() {
		parent::__construct();

		$ci =& get_instance();
		$this->table_sales_call		= $this->table_sales_call;
		$this->table_phone_call		= $this->table_phone_call;
		$this->table_task_details	= $this->table_task_details;
		$this->table_opportunity	= $this->table_opportunity;

		$this->table_contact		= $this->table_contact;
		$this->table_account		= $this->table_account;
		$this->table_user			= $this->table_user;
    }
        
    function get_activities($s) {
        $table1 = $this->table_sales_call;
        $table2 = $this->table_phone_call;
        $table3 = $this->table_contact;
        $table4 = $this->table_account;
        $table5 = $this->table_user;
        $table6 = $this->table_task_details;
        $table7 = $this->table_opportunity;

        $this->db->select('a.sc_id AS activity_id, a.subject AS subject, a.start_date AS start_date, a.start_time AS start_time, a.end_date AS end_date, a.end_time AS end_time, "Sales Call" AS activity_type, a.current_status AS status,
        c.contact_name, d.acc_name, e.user_fname AS assigned_user_fname');
        $this->db->from($table1.' a');
        $this->db->join($table3.' c', 'c.contact_id=a.contact_id', 'left');
        $this->db->join($table4.' d', 'd.acc_id=a.acc_id', 'left');
        $this->db->join($table5.' e', 'e.user_id=a.assign_to', 'left');
        if($s['acc_id']!=""){ $this->db->where('a.acc_id', $s['acc_id']); }
        if($s['assign_to']!=""){ $this->db->where('a.assign_to', $s['assign_to']); }
        $query1 =  $this->db->get_compiled_select();

        $this->db->select('b.pc_id AS activity_id, b.subject AS subject, b.start_date AS start_date, b.start_time AS start_time, b.end_date AS end_date, b.end_time AS end_time, "Phone Call" AS activity_type, b.current_status AS status,
        c.contact_name, d.acc_name, e.user_fname AS assigned_user_fname');
        $this->db->from($table2.' b');
        $this->db->join($table3.' c', 'c.contact_id=b.contact_id', 'left');
        $this->db->join($table4.' d', 'd.acc_id=b.acc_id', 'left');
        $this->db->join($table5.' e', 'e.user_id=b.assign_to', 'left');
        if($s['acc_id']!=""){ $this->db->where('b.acc_id', $s['acc_id']); }
        if($s['assign_to']!=""){ $this->db->where('b.assign_to', $s['assign_to']); }
        $query2 =   $this->db->get_compiled_select();

        $this->db->select('f.td_id AS activity_id, "****" AS subject, f.start_date AS start_date, f.start_time AS start_time, f.end_date AS end_date, f.end_time AS end_time, "Task" AS activity_type, f.current_status AS status,
        c.contact_name, d.acc_name, e.user_fname AS assigned_user_fname');
        $this->db->from($table6.' f');
        $this->db->join($table3.' c', 'c.contact_id=f.contact_id', 'left');
        $this->db->join($table4.' d', 'd.acc_id=f.acc_id', 'left');
        $this->db->join($table5.' e', 'e.user_id=f.assign_to', 'left');
        if($s['acc_id']!=""){ $this->db->where('f.acc_id', $s['acc_id']); }
        if($s['assign_to']!=""){ $this->db->where('f.assign_to', $s['assign_to']); }
        $query3 =   $this->db->get_compiled_select();

        $this->db->select('g.opp_id AS activity_id, g.opp_name AS subject, g.assign_date AS start_date, g.assign_time AS start_time, g.expected_close AS end_date, g.expected_close_time AS end_time, "Oppertunity" AS activity_type, "" AS status,
        c.contact_name, d.acc_name, e.user_fname AS assigned_user_fname');
        $this->db->from($table7.' g');
        $this->db->join($table3.' c', 'c.contact_id=g.contact_id', 'left');
        $this->db->join($table4.' d', 'd.acc_id=g.acc_id', 'left');
        $this->db->join($table5.' e', 'e.user_id=g.assign_to', 'left');
        if($s['acc_id']!=""){ $this->db->where('g.acc_id', $s['acc_id']); }
        if($s['assign_to']!=""){ $this->db->where('g.assign_to', $s['assign_to']); }
        $query4 =   $this->db->get_compiled_select();

        if($s['activity_id']=="1"){
            $query = $this->db->query($query1);
        }else if($s['activity_id']=="2"){
            $query = $this->db->query($query2);
        }else if($s['activity_id']=="3"){
            $query = $this->db->query($query3);
        }else if($s['activity_id']=="4"){
            $query = $this->db->query($query4);
        }else{
            $query = $this->db->query($query1." UNION ".$query2);
        }
        $result = $query->result_array();
        return $result;
    }

}

/* End of file Report_Model.php */
/* Location: ./application/models/Report_Model.php */