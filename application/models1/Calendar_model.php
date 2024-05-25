<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of calendar_model
 *
 * @author Chaminda
 */
class Calendar_model extends CI_Model{

    //put your code here
    protected $table = 'calender_view';

    public function __construct() {
        parent::__construct();
        $this->_database = $this->db;
        $this->_table = $this->table;
    }

    public function get_activities($user_id='') {

        $this->db->select('p.*');
        $this->db->from('calender_view p');
        if($user_id!=''){ $this->db->where('assign_to',$user_id); }
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

}

?>