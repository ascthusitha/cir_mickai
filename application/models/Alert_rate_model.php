<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Alert_rate_model
 *
 * @author td
 */
class Alert_rate_model extends CI_Model{
     protected $table = 'alert_rates';

    public function __construct()
    {
        parent::__construct();

        $this->_database = $this->db;
        $this->_table = $this->table;
    }
        public function get_rates($today){
            $this->db->select('alert_rates.*');
        $this->db->from('alert_rates');
        $this->db->where('deleted',0);
        $this->db->where('status',1);
        $this->db->where('start_date <=',$today);
        $this->db->where('end_date >=',$today);
       
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }
    
  
}
