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
    private $activities_view	= 'activities_view';		// activities_view
    
    function __construct() {
		parent::__construct();

		$ci =& get_instance();
		$this->activities_view		= $this->activities_view;
    }
        
    function get_activities($s) {
        $table1 = $this->activities_view;

        $this->db->select('a.*');
        $this->db->from($table1.' a');
        if($s['acc_id']!=""){ $this->db->where('a.acc_id', $s['acc_id']); }
        if($s['assign_to']!=""){ $this->db->where('a.assign_to_id', $s['assign_to']); }
        if($s['from_date']!=""){ $this->db->where('CAST(a.start_date As Date) >= ', $s['from_date']); }
        if($s['to_date']!=""){ $this->db->where('CAST(a.start_date As Date) <= ', $s['to_date']); }
        if($s['activity_id']!=""){ $this->db->where('a.activity_type_id', $s['activity_id']); }
        if($s['product_id']!=""){ 
          $this->db->where('a.product_id1', $s['product_id']); 
          $this->db->or_where('a.product_id2', $s['product_id']); 
        }
        $query = $this->db->get();
        return $query->result();
    }

}

/* End of file Report_Model.php */
/* Location: ./application/models/Report_Model.php */